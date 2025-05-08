<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tombol;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Rules\NoXSSInput;
class PpdbController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $ppdb = Tombol::where('url', 'Ppdb')->first();
        if (!$ppdb) {
            return redirect()->back()->with('warning', 'Data PPDB tidak tersedia.');
        }
        $start_date = Carbon::parse($ppdb->start_date);
        $end_date = Carbon::parse($ppdb->end_date);
        if (Carbon::now()->between($start_date, $end_date)) {
            return view('Ppdb.Ppdb');
        }
        return redirect()->back()->with('warning', 'PPDB masih tertutup.');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hakakses' => [
                'nullable',
                'string',
                'in:NonSiswa',



            ],
            'Role' => [
                'nullable',
                'string',
                'in:NonSiswa',


            ],
            'password' => [
                'required',
                'string',
                'min:7',
                'max:12',
                'confirmed'
            ],
          'NamaLengkap' => [
    'required',
    'string',
    'max:255',
    'regex:/^[a-zA-Z\s]+$/',
    Rule::unique('tb_siswa')->where(function ($query) {
        return $query->whereRaw('LOWER(NamaLengkap) = LOWER(?)', [request('NamaLengkap')]);
    }),
],
            'NamaAyah' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',


            ],
            'NamaIbu' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',


            ],
            'NamaWali' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
            ],

            'NamaPanggilan' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/',


            ],
            'JenisKelamin' => [
                'required',
                'string',
                'in:Laki-Laki,Perempuan',


            ],
            'PekerjaanAyah' => [
                'required',
                'string',
            ],
            'PekerjaanIbu' => [
                'required',
                'string',
            ],
            'PekerjaanWali' => [
                'nullable',
                'string',
            ],
            'StatusHubunganWali' => [
                'nullable',
                'string',
            ],
            'PenghasilanAyah' => [
                'required',
                'string',
            ],
            'PenghasilanIbu' => [
                'required',
                'string',
            ],
            'TempatLahir' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',


            ],
            'TanggalLahir' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before:today'
            ],
            'Agama' => [
                'required',
                'string',
                'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu',
            ],
            'status' => [
                'nullable',
                'string',
                'in:Aktif,Tidak Aktif',
            ],
            'Alamat' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s,.]+$/',


            ],
            'AsalSD' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s.]+$/',


            ],
            'NomorTelephone' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'NomorTelephoneAyah' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'siswa_id' => [
                'nullable',
                'numeric',
                'max:4',
                'regex:/^[0-9]+$/',

            ],
            'nis' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[0-9]+$/',

            ],
            'username' => [
                'required',
                'string',
                'min:7',
                'max:12',
                'regex:/^[a-zA-Z0-9_-]+$/',
                'unique:users,username',
            ],
        ], [
            'hakakses.nullable' => 'Hak akses tidak wajib diisi.',
            'hakakses.string' => 'Hak akses harus berupa teks.',
            'hakakses.in' => 'Pilih hak akses yang valid: NonSiswa.',

            'Role.nullable' => 'Peran tidak wajib diisi.',
            'Role.string' => 'Peran harus berupa teks.',
            'Role.in' => 'Pilih peran yang valid: NonSiswa.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal terdiri dari 7 karakter.',
            'password.max' => 'Password maksimal terdiri dari 12 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',

            'NamaLengkap.required' => 'Nama lengkap wajib diisi.',
            'NamaLengkap.string' => 'Nama lengkap harus berupa teks.',
            'NamaLengkap.max' => 'Nama lengkap maksimal terdiri dari 255 karakter.',

            'NamaPanggilan.required' => 'Nama panggilan wajib diisi.',
            'NamaPanggilan.string' => 'Nama panggilan harus berupa teks.',
            'NamaPanggilan.max' => 'Nama panggilan maksimal terdiri dari 100 karakter.',

            'JenisKelamin.required' => 'Jenis kelamin wajib diisi.',
            'JenisKelamin.string' => 'Jenis kelamin harus berupa teks.',
            'JenisKelamin.in' => 'Pilih jenis kelamin yang valid: Laki-Laki atau Perempuan.',

            'TempatLahir.required' => 'Tempat lahir wajib diisi.',
            'TempatLahir.string' => 'Tempat lahir harus berupa teks.',
            'TempatLahir.max' => 'Tempat lahir maksimal terdiri dari 255 karakter.',

            'TanggalLahir.required' => 'Tanggal lahir wajib diisi.',
            'TanggalLahir.date' => 'Tanggal lahir harus berupa tanggal.',
            'TanggalLahir.date_format' => 'Tanggal lahir harus dalam format: Y-m-d.',
            'TanggalLahir.before' => 'Tanggal lahir harus sebelum hari ini.',

            'Agama.required' => 'Agama wajib diisi.',
            'Agama.string' => 'Agama harus berupa teks.',
            'Agama.in' => 'Pilih agama yang valid: Katolik, Kristen Protestan, Islam, Hindu, Buddha, atau Konghucu.',

            'status.nullable' => 'Status tidak wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Pilih status yang valid: Aktif atau Tidak Aktif.',

            'Alamat.required' => 'Alamat wajib diisi.',
            'Alamat.string' => 'Alamat harus berupa teks.',
            'Alamat.max' => 'Alamat maksimal terdiri dari 255 karakter.',

            'AsalSD.required' => 'Asal SMP wajib diisi.',
            'AsalSD.string' => 'Asal SMP harus berupa teks.',
            'AsalSD.max' => 'Asal SMP maksimal terdiri dari 255 karakter.',

            'NomorTelephone.required' => 'Nomor telepon wajib diisi.',
            'NomorTelephone.string' => 'Nomor telepon harus berupa teks.',
            'NomorTelephone.max' => 'Nomor telepon maksimal terdiri dari 13 karakter.',
            'NomorTelephone.regex' => 'Nomor telepon hanya boleh mengandung angka.',

            'NomorTelephoneAyah.required' => 'Nomor telepon ayah wajib diisi.',
            'NomorTelephoneAyah.string' => 'Nomor telepon ayah harus berupa teks.',
            'NomorTelephoneAyah.max' => 'Nomor telepon ayah maksimal terdiri dari 13 karakter.',
            'NomorTelephoneAyah.regex' => 'Nomor telepon ayah hanya boleh mengandung angka.',

            'siswa_id.nullable' => 'ID siswa tidak wajib diisi.',
            'siswa_id.numeric' => 'ID siswa harus berupa angka.',
            'siswa_id.max' => 'ID siswa maksimal terdiri dari 4 angka.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.min' => 'Username minimal terdiri dari 7 karakter.',
            'username.max' => 'Username maksimal terdiri dari 12 karakter.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, tanda hubung, atau underscore.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih username lain.',
        ]);

        try {
            DB::beginTransaction();

            // Parse and format the date properly
            $tanggalLahir = null;
            if (!empty($validatedData['TanggalLahir'])) {
                $tanggalLahir = Carbon::createFromFormat('Y-m-d', $validatedData['TanggalLahir'])->format('Y-m-d');
            }

            $siswa = Siswa::create([
                'NamaLengkap' => $validatedData['NamaLengkap'],
                'NamaPanggilan' => $validatedData['NamaPanggilan'],
                'JenisKelamin' => $validatedData['JenisKelamin'],
                'TempatLahir' => $validatedData['TempatLahir'],
                'TanggalLahir' => $tanggalLahir,
                'Agama' => $validatedData['Agama'],
                'Alamat' => $validatedData['Alamat'],
                'NomorTelephone' => $validatedData['NomorTelephone'],
                'AsalSD' => $validatedData['AsalSD'],
                'NomorTelephoneAyah' => $validatedData['NomorTelephoneAyah'],
                'status' => 'Tidak Aktif',
                'nis' => Siswa::generateNIS(),
                'NamaAyah' => $validatedData['NamaAyah'],
                'NamaIbu' => $validatedData['NamaIbu'],
                'NamaWali' => $validatedData['NamaWali'],
                'PekerjaanAyah' => $validatedData['PekerjaanAyah'],
                'PenghasilanAyah' => $validatedData['PenghasilanAyah'],
                'PenghasilanIbu' => $validatedData['PenghasilanIbu'],
                'PekerjaanIbu' => $validatedData['PekerjaanIbu'],
                'PekerjaanWali' => $validatedData['PekerjaanWali'],
                'StatusHubunganWali' => $validatedData['StatusHubunganWali'],

            ]);

            User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'hakakses' => 'NonSiswa',
                'Role' => 'NonSiswa',
                'siswa_id' => $siswa->siswa_id,
            ]);

            $pembayaran = Pembayaran::updateOrCreate(
                ['siswa_id' => $siswa->siswa_id],
                [
                    'status' => 'Menunggu Pembayaran',
                    'ket' => 'Kosong',
                ]
            );

            DB::commit();
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil dibuat, Silahkan Login');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            // Log request
            Log::info('Request diterima untuk update status:', ['payload' => $request->all()]);
    
            // Validasi input
            $request->validate([
                'ids' => ['required', 'array'],
                'ids.*' => ['string', 'exists:users,id'],
            ]);
    
            // Log siswa IDs
            Log::info('Siswa IDs yang akan diperbarui:', ['ids' => $request->ids]);
    
            // Perbarui status user dan siswa terkait
            
            // Perbarui status di model Siswa melalui relasi
            $affectedSiswaRows = 0;
            $users = User::with('Siswa')->whereIn('id', $request->ids)->get();
            
            foreach ($users as $user) {
                if ($user->siswa) {
                    $user->siswa->update(['status' => 'Aktif']);
                    $affectedSiswaRows++;
                }
            }
    
            Log::info('Jumlah baris yang diperbarui:', [
                'affected_siswa_rows' => $affectedSiswaRows
            ]);
    
            // Response sukses
            if ($affectedSiswaRows > 0) {
                return response()->json([
                    'message' => 'Status berhasil diperbarui!',
                    'updated_siswa_rows' => $affectedSiswaRows,
                ]);
            }
    
            // Jika tidak ada baris yang diperbarui
            return response()->json([
                'message' => 'Tidak ada perubahan yang diterapkan.',
            ], 400);
    
        } catch (\Exception $e) {
            // Log error
            Log::error('Terjadi kesalahan saat update status:', [
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString(),
            ]);
    
            // Response error
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // public function updateStatus(Request $request)
    // {
    //     try {
    //         // Log request
    //         Log::info('Request diterima untuk update status:', ['payload' => $request->all()]);
    
    //         // Validasi input
    //         $request->validate([
    //             'ids' => ['required', 'array'],
    //             'ids.*' => ['string', 'exists:users,id'],
    //         ]);
    
    //         // Log siswa IDs
    //         Log::info('Siswa IDs yang akan diperbarui:', ['ids' => $request->ids]);
    
    //         // Perbarui status user dan siswa terkait
    //         $affectedUserRows = User::whereIn('id', $request->ids)
    //             ->update([
    //                 'hakakses' => 'Siswa', 
    //                 'role' => 'Siswa'
    //             ]);
    
    //         // Perbarui status di model Siswa melalui relasi
    //         $affectedSiswaRows = 0;
    //         $users = User::with('Siswa')->whereIn('id', $request->ids)->get();
            
    //         foreach ($users as $user) {
    //             if ($user->siswa) {
    //                 $user->siswa->update(['status' => 'Aktif']);
    //                 $affectedSiswaRows++;
    //             }
    //         }
    
    //         Log jumlah baris yang diperbarui
    //         Log::info('Jumlah baris yang diperbarui:', [
    //             'affected_user_rows' => $affectedUserRows,
    //             'affected_siswa_rows' => $affectedSiswaRows
    //         ]);
    
    //         // Response sukses
    //         if ($affectedUserRows > 0 || $affectedSiswaRows > 0) {
    //             return response()->json([
    //                 'message' => 'Status berhasil diperbarui!',
    //                 'updated_user_rows' => $affectedUserRows,
    //                 'updated_siswa_rows' => $affectedSiswaRows,
    //             ]);
    //         }
    
    //         // Jika tidak ada baris yang diperbarui
    //         return response()->json([
    //             'message' => 'Tidak ada perubahan yang diterapkan.',
    //         ], 400);
    
    //     } catch (\Exception $e) {
    //         // Log error
    //         Log::error('Terjadi kesalahan saat update status:', [
    //             'error_message' => $e->getMessage(),
    //             'error_trace' => $e->getTraceAsString(),
    //         ]);
    
    //         // Response error
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat memperbarui status!',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
   

    public function edit($hashedId)
    {
        $user = User::with('Siswa')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        $roles = explode(',', $user->getRawOriginal('Role'));
        if (!$user) {
            abort(404, 'User not found.');
        }
        return view('Siswabaru.edit', compact('user', 'hashedId', 'roles'));
    }

   
//     public function getPpdbs()
// {
//     $users = User::with('Siswa.Pembayaran')
//         ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
//         ->where('hakakses', 'Nonsiswa')
//         ->orderByRaw('CAST(username AS UNSIGNED)') // Urutkan sebagai angka
//         ->get()
//         ->map(function ($user) {
//             $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
//             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
//             $user->action = '
//         <a href="' . route('Siswabaru.edit', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
//             <i class="fas fa-user-edit text-secondary"></i>
//         </a>';
//             $user->Siswa_Nama = optional($user->Siswa)->NamaLengkap ?? '-';

//             // Pastikan Pembayaran tersedia dan ambil data pertama jika merupakan koleksi
//             $pembayaran = optional($user->Siswa)->Pembayaran;
//             $pembayaran = is_iterable($pembayaran) ? collect($pembayaran)->first() : $pembayaran;

//             $user->Tanggal = optional($pembayaran)->tanggalbukti ?? '-';
//             $user->Status = optional($pembayaran)->status ?? '-';
//             $user->Ket = optional($pembayaran)->ket ?? '-';

//             return $user;
//         });
public function getPpdbs()
{
    $filterYear = request()->get('year'); // Tangkap input tahun, misal ?year=2024

    $usersQuery = User::with('Siswa.Pembayaran')
        ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
        ->where('hakakses', 'Nonsiswa');

    // Tambahkan filter berdasarkan tahun created_at jika tersedia
    if ($filterYear) {
        $usersQuery->whereYear('created_at', $filterYear);
    }

    $users = $usersQuery
        ->orderByRaw('CAST(username AS UNSIGNED)')
        ->get()
        ->map(function ($user) {
            $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
            $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
            $user->action = '
            <a href="' . route('Siswabaru.edit', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';

            $user->Siswa_Nama = optional($user->Siswa)->NamaLengkap ?? '-';
            $user->Tempat_Lahir = optional($user->Siswa)->TempatLahir ?? '-';
            $user->Tanggal_Lahir = optional($user->Siswa)->TanggalLahir ?? '-';
            $user->Jenis_Kelamin = optional($user->Siswa)->JenisKelamin ?? '-';
            $user->Alamat_ = optional($user->Siswa)->Alamat ?? '-';
            $user->Agama_ = optional($user->Siswa)->Agama ?? '-';
            $user->Nomor_Telephone = optional($user->Siswa)->NomorTelephone ?? '-';
            $user->Asal_SD = optional($user->Siswa)->AsalSD ?? '-';
            $user->Nama_Ayah = optional($user->Siswa)->NamaAyah ?? '-';
            $user->Pekerjaan_Ayah = optional($user->Siswa)->PekerjaanAyah ?? '-';
            $user->Penghasilan_Ayah = optional($user->Siswa)->PenghasilanAyah?? '-';
            $user->Nama_Wali = optional($user->Siswa)->NamaWali ?? '-';
            $user->Pekerjaan_Wali = optional($user->Siswa)->PekerjaanWali ?? '-';
            $user->Status_Hubungan_Wali = optional($user->Siswa)->StatusHubunganWali ?? '-';
            $user->Nama_Ibu = optional($user->Siswa)->NamaIbu ?? '-';
            $user->Pekerjaan_Ibu = optional($user->Siswa)->PekerjaanIbu ?? '-';
            $user->Penghasilan_Ibu = optional($user->Siswa)->Penghasilan_Ibu ?? '-';

            $pembayaran = optional($user->Siswa)->Pembayaran;
            $pembayaran = is_iterable($pembayaran) ? collect($pembayaran)->first() : $pembayaran;

            $user->Tanggal = optional($pembayaran)->tanggalbukti ?? '-';
            $user->Status = optional($pembayaran)->status ?? '-';
            $user->Ket = optional($pembayaran)->ket ?? '-';

            return $user;
        });

    return DataTables::of($users)
        ->addColumn('created_at', function ($user) {
            return Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
        })
        ->addColumn('Role', function ($user) {
            return $user->Role;
        })
        ->addColumn('tanggalbukti', function ($user) {
            return $user->Tanggal;
        })
        ->addColumn('status', function ($user) {
            return $user->Status;
        })
        ->addColumn('ket', function ($user) {
            return $user->Ket;
        })
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}

    public function indexppdb()
    {
        $years = DB::table('users')
        ->selectRaw('YEAR(created_at) as year')
        ->where('hakakses', 'Nonsiswa')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year'); // menghasilkan array: [2025, 2024, 2023, ...]
        return view('Siswabaru.Siswabaru', compact('years'));

    }
    public function deletesiswabaru(Request $request)
    {
        $request->validate([

            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
            'ids.*' => ['uuid', new NoXSSInput()],

        ]);
        User::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected users and their related data deleted successfully.'
        ]);
    }
    public function update(Request $request, $hashedId)
    {
        $user = User::with('Siswa')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$user) {
            return redirect()->route('Siswabaru.indexppdb')->with('error', 'ID tidak valid.');
        }

        $validatedData = $request->validate([
            'username' => [
                'required',
                'string',
                'max:12',
                'min:7',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique('users')->ignore($user->id),
                new NoXSSInput()
            ],
            'password' => ['nullable', 'string', 'min:7', 'max:12', new NoXSSInput()],
            'hakakses' => ['required', 'string', 'in:Siswa,NonSiswa', new NoXSSInput()],
            'Role' => ['required', 'array', 'min:1', 'in:Siswa,NonSiswa', new NoXSSInput()],
            'NamaLengkap' => ['required', 'string', 'max:255', new NoXSSInput()],
        ]);

        $roles = implode(',', $validatedData['Role']);
        $userData = [
            'username' => $validatedData['username'],
            'hakakses' => $validatedData['hakakses'],
            'Role' => $roles,
        ];

        if (!empty($validatedData['password'])) {
            $userData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($userData);

        if ($user->Siswa) {
            $user->Siswa->update([
                'NamaLengkap' => $validatedData['NamaLengkap'],
            ]);
        }


        return redirect()->route('Siswabaru.indexppdb')->with('success', 'User Berhasil Diupdate.');
    }
}
