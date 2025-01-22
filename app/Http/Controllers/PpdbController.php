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
                'nullable',
                'string',
                'max:100',
            ],
            'JenisKelamin' => [
                'required',
                'string',
                'in:Laki-Laki,Perempuan',
            ],
            'TempatLahir' => [
                'nullable',
                'string',
                'max:255',
            ],
            'TanggalLahir' => ['nullable', 'date',],
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
                'nullable',
                'string',
                'max:255',

            ],
            'NomorTelephone' => [
                'nullable',
                'numeric',
            ],
            'NomorTelephoneAyah' => [
                'nullable',
                'numeric',
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
        ]);
        try {
            DB::beginTransaction();
            $siswa = Siswa::create([
                'NamaLengkap' => $validatedData['NamaLengkap'],
                'NamaPanggilan' => $validatedData['NamaPanggilan'],
                'JenisKelamin' => $validatedData['JenisKelamin'],
                'TempatLahir' => $validatedData['TempatLahir'],
                'TanggalLahir' => $validatedData['TanggalLahir'],
                'Agama' => $validatedData['Agama'],
                'Alamat' => $validatedData['Alamat'],
                'NomorTelephone' => $validatedData['NomorTelephone'],
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
                ['siswa_id' => $siswa->siswa_id], // Kondisi pencarian
                [
                    'status' => 'Menunggu Pembayaran',  // Nilai kolom status
                    'tanggalbukti' => Carbon::now()    // Nilai tanggalbukti menggunakan Carbon
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
    public function getPpdbs()
    {
        $users = User::with('Siswa')
            ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
            ->whereIn('hakakses', ['Nonsiswa'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
                // $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y'); $user->Role = implode(', ', explode(',', $user->Role));
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('Siswabaru.edit', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $user->Siswa_Nama = $user->Siswa ? $user->Siswa->NamaLengkap : '-';
                return $user;
            });
        return DataTables::of($users)
            ->addColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('Role', function ($user) {
                return $user->Role;
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
