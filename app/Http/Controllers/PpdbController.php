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
                'in:NonSiswa'
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
            ],
            'NamaPanggilan' => [
                'required',
                'string',
                'max:100',
            ],
            'JenisKelamin' => [
                'required',
                'string',
                'in:Laki-Laki,Perempuan',
            ],
            'TempatLahir' => [
                'required',
                'string',
                'max:255',
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
            ],
            'AsalSD' => [
                'required',
                'string',
                'max:255',
            ],
            'NomorTelephone' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/'
            ],
            'NomorTelephoneAyah' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/'
            ],
            'siswa_id' => [
                'nullable',
                'numeric',
                'max:4',
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
            
            'AsalSD.required' => 'Asal SD wajib diisi.',
            'AsalSD.string' => 'Asal SD harus berupa teks.',
            'AsalSD.max' => 'Asal SD maksimal terdiri dari 255 karakter.',
            
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
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'hakakses' => [
    //             'nullable',
    //             'string',
    //             'in:NonSiswa',
    //         ],
    //         'Role' => [
    //             'nullable',
    //             'string',
    //             'in:NonSiswa'
    //         ],
    //         'password' => [
    //             'required',
    //             'string',
    //             'min:7',
    //             'max:12',
    //             'confirmed'
    //         ],

    //         'NamaLengkap' => [
    //             'required',
    //             'string',
    //             'max:255',
    //         ],
    //         'NamaPanggilan' => [
    //             'nullable',
    //             'string',
    //             'max:100',
    //         ],
    //         'JenisKelamin' => [
    //             'required',
    //             'string',
    //             'in:Laki-Laki,Perempuan',
    //         ],
    //         'TempatLahir' => [
    //             'nullable',
    //             'string',
    //             'max:255',
    //         ],
    //         'TanggalLahir' => ['nullable', 'date',],
    //         'Agama' => [
    //             'required',
    //             'string',
    //             'in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu',
    //         ],
    //         'status' => [
    //             'nullable',
    //             'string',
    //             'in:Aktif,Tidak Aktif',
    //         ],
    //         'Alamat' => [
    //             'nullable',
    //             'string',
    //             'max:255',

    //         ],
    //         'NomorTelephone' => [
    //             'required',
    //             'string',
    //             'max:13',
                

    //         ],
    //         'NomorTelephoneAyah' => [
    //             'required',
    //             'string',
    //             'max:13',
                
    //         ],
    //         'siswa_id' => [
    //             'nullable',
    //             'numeric',
    //             'max:4',
    //         ],
    //         'username' => [
    //             'required',
    //             'string',
    //             'min:7',
    //             'max:12',
    //             'regex:/^[a-zA-Z0-9_-]+$/',
    //             'unique:users,username',
    //         ], 
    //     ],
    // [
    //     // username
    //     'username.required' => 'username harus diisi seperti keterangan di bawah',
    //     'username.min' => 'username harus diisi minimal 7 karakter bebas seperti keterangan di bawah',
    //     'username.max' => 'username harus diisi maximal 12 karakter seperti keterangan di bawah',
    //     'username.unique' => 'username sudah ada yang memakai, silahkan pilih username yang lain',
    //     'password.required' => 'password harus diisi seperti keterangan di bawah',
    //     'password.min' => 'username harus diisi minimal 7 karakter bebas seperti keterangan di bawah',
    //     'password.max' => 'username harus diisi maximal 12 karakter seperti keterangan di bawah',
    //     'password.confirmation' => 'password dan konfirmasi password harus sama ',
    //     'NomorTelephone.string' => 'nomor telephone diawali dengan angka 0 contoh 086616273123 ',
    //     'NomorTelephoneAyah.string' => 'nomor telephone diawali dengan angka 0 contoh 086616273123 ',
    //     'NomorTelephone.max' => 'nomor telephone maksimal 13 karakter ',
    //     'NomorTelephoneAyah.max' => 'nomor telephone orang tua maksimal 13 karakter ',
    //     ]);
    //     try {
    //         DB::beginTransaction();
    //         $siswa = Siswa::create([
    //             'NamaLengkap' => $validatedData['NamaLengkap'],
    //             'NamaPanggilan' => $validatedData['NamaPanggilan'],
    //             'JenisKelamin' => $validatedData['JenisKelamin'],
    //             'TempatLahir' => $validatedData['TempatLahir'],
    //             'TanggalLahir' => $validatedData['TanggalLahir'],
    //             'Agama' => $validatedData['Agama'],
    //             'Alamat' => $validatedData['Alamat'],
    //             'NomorTelephone' => $validatedData['NomorTelephone'],
    //             'NomorTelephoneAyah' => $validatedData['NomorTelephoneAyah'],
    //             'status' => 'Tidak Aktif',
    //         ]);
    //         User::create([
    //             'username' => $validatedData['username'],
    //             'password' => Hash::make($validatedData['password']),
    //             'hakakses' => 'NonSiswa',
    //             'Role' => 'NonSiswa',
    //             'siswa_id' => $siswa->siswa_id,
    //         ]);
            

    //         $pembayaran = Pembayaran::updateOrCreate(
    //             ['siswa_id' => $siswa->siswa_id],
    //             [
    //                 'status' => 'Menunggu Pembayaran',  
                      
    //             ]
    //         );        
    //         DB::commit();
    //         return redirect()->route('login')->with('success', 'Pendaftaran berhasil dibuat, Silahkan Login');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()
    //             ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
    //             ->withInput();
    //     }
    // }

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

            // Perbarui status user
            $affectedRows = User::whereIn('id', $request->ids)
                ->update(['hakakses' => 'Siswa', 'role' => 'Siswa']);

            // Log jumlah baris yang diperbarui
            Log::info('Jumlah baris yang diperbarui:', ['affected_rows' => $affectedRows]);

            // Response sukses
            if ($affectedRows > 0) {
                return response()->json([
                    'message' => 'Status berhasil diperbarui!',
                    'updated_rows' => $affectedRows,
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
    //         Log::info('Request diterima untuk update status:', ['payload' => $request->all()]);
    //         $request->validate([
    //             'ids' => ['required', 'array', new NoXSSInput()],
    //             'ids.*' => ['string', 'exists:users,id', new NoXSSInput()],
    //         ]);
    //         Log::info('Siswa IDs yang akan diperbarui:', ['ids' => $request->ids]);

    //         $affectedRows = User::whereIn('id', $request->ids)
    //             ->update(['hakakses' => 'Siswa','role'=> 'Siswa']);

    //         Log::info('Jumlah baris yang diperbarui:',['affected_rows' => $affectedRows]);

    //         return response()->json([
    //             'message' => 'Status berhasil diperbarui!',
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Terjadi kesalahan saat update status:', [
    //             'error_message' => $e->getMessage(),
    //             'error_trace' => $e->getTraceAsString(),
    //         ]);
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
    // public function getPpdbs()
    // {
    //     $users = User::with('Siswa.Pembayaran')
    //         ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
    //         ->whereIn('hakakses', ['Nonsiswa'])
    //         ->get()
    //         ->map(function ($user) {
    //             $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
    //             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
    //             $user->action = '
    //         <a href="' . route('Siswabaru.edit', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
    //             <i class="fas fa-user-edit text-secondary"></i>
    //         </a>';
    //             $user->Siswa_Nama = $user->Siswa ? $user->Siswa->NamaLengkap : '-';
    //             $user->Tanggal = $user->Siswa->Pembayaran ? $user->Siswa->Pembayaran->tanggalbukti : '-';
    //             $user->Status = $user->Siswa->Pembayaran ? $user->Siswa->Pembayaran->status : '-';
    //             return $user;
    //         });
    //     return DataTables::of($users)
    //         ->addColumn('created_at', function ($user) {
    //             return Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
    //         })
    //         ->addColumn('Role', function ($user) {
    //             return $user->Role;
    //         })
    //         ->addColumn('tanggalbukti', function ($user) {
    //             return $user->Siswa->Pembayaran->tanggalbukti;
    //         })
    //         ->addColumn('status', function ($user) {
    //             return $user->Siswa->Pembayaran->status;
    //         })
    //         ->rawColumns(['checkbox', 'action'])
    //         ->make(true);

    // }
    public function getPpdbs()
{
    $users = User::with('Siswa.Pembayaran')
        ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
        ->where('hakakses', 'Nonsiswa') // Gunakan where, karena hanya satu nilai
        ->get()
        ->map(function ($user) {
            $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
            $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
            $user->action = '
            <a href="' . route('Siswabaru.edit', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $user->Siswa_Nama = optional($user->Siswa)->NamaLengkap ?? '-';

            // Pastikan Pembayaran tersedia dan ambil data pertama jika merupakan koleksi
            $pembayaran = optional($user->Siswa)->Pembayaran;
            $pembayaran = is_iterable($pembayaran) ? collect($pembayaran)->first() : $pembayaran;

            $user->Tanggal = optional($pembayaran)->tanggalbukti ?? '-';
            $user->Status = optional($pembayaran)->status ?? '-';

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
            return $user->Tanggal; // Pakai nilai yang sudah diproses di map()
        })
        ->addColumn('status', function ($user) {
            return $user->Status; // Pakai nilai yang sudah diproses di map()
        })
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}

    public function indexppdb()
    {
        return view('Siswabaru.Siswabaru');

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
