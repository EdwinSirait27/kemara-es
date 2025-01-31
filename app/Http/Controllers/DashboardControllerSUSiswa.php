<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
// use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Rules\NoXSSInput;

// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Crypt;
class DashboardControllerSUSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function indexSiswa()
    {
        return view('dashboardSUSiswa.dashboardSUSiswa');
    }
    public function createSiswa()
    {
        return view('dashboardSUSiswa.createSiswa');
    }
    public function getUsersSiswa()
    {
        $users = User::with('Siswa')
            ->select(['id', 'siswa_id', 'username', 'hakakses', 'Role', 'created_at'])
            ->whereIn('hakakses', ['Siswa', 'NonSiswa'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8); // 8 karakter pertama dari hash SHA-256
                // $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
                $user->Role = implode(', ', explode(',', $user->Role));
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('dashboardSUSiswa.editSiswa', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
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
    public function editSiswa($hashedId)
    {
        $user = User::with('Siswa')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        $roles = explode(',', $user->getRawOriginal('Role'));


        // Jika user tidak ditemukan
        if (!$user) {
            abort(404, 'User not found.');
        }

        // Kirim data user dan hashedId ke view
        return view('dashboardSUSiswa.editSiswa', compact('user', 'hashedId', 'roles'));
    }
    public function updateSiswa(Request $request, $hashedId) 
    {
        // dd($request->all());

        // Cari user berdasarkan hashed ID
        $user = User::with('Siswa')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
    
        if (!$user) {
            return redirect()->route('dashboardSUSiswa.indexSiswa')->with('error', 'ID tidak valid.');
        }
    
        $validatedData = $request->validate([
            'username' => [
                'required',
                'string',
                'max:12',
                'min:7',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique('users')->ignore($user->id), // Gunakan ID asli
                new NoXSSInput()
            ],
            'password' => ['nullable', 'string', 'min:7', 'max:12', 'confirmed', new NoXSSInput()],
            'hakakses' => ['required', 'string', 'in:Siswa', new NoXSSInput()],
            'Role' => ['required', 'array', 'min:1', 'in:Siswa', new NoXSSInput()],
            'NamaLengkap' => ['nullable', 'string','max:100','min:10', new NoXSSInput()],
            'NomorInduk' => ['nullable', 'string','max:16', new NoXSSInput()],
            'NamaPanggilan' => ['nullable', 'string','max:50','min:3', new NoXSSInput()],
            'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],
            'NISN' => ['nullable', 'string','max:16', new NoXSSInput()],
            'TempatLahir' => ['nullable', 'string','max:30', new NoXSSInput()],
            'TanggalLahir' => ['nullable', 'string','max:30', new NoXSSInput()],
            'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'Alamat' => ['nullable', 'string','max:100', new NoXSSInput()],
            'Email' => ['nullable', 'string','max:100', new NoXSSInput()],
            'NomorTelephone' => ['nullable', 'string','max:13', new NoXSSInput()],
            'NIK' => ['nullable', 'string','max:16', new NoXSSInput()],
            'AsalSD' => ['nullable', 'string','max:255', new NoXSSInput()],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username hanya boleh berupa teks.',
            'username.max' => 'Username maksimal terdiri dari 12 karakter.',
            'username.min' => 'Username minimal terdiri dari 7 karakter.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, tanda hubung, atau underscore.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih username lain.',
            
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal terdiri dari 7 karakter.',
            'password.max' => 'Password maksimal terdiri dari 12 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            
            'hakakses.required' => 'Hak akses wajib dipilih.',
            'hakakses.string' => 'Hak akses harus berupa teks.',
            'hakakses.in' => 'Pilih hak akses yang valid: Siswa.',
            
            'Role.required' => 'Setidaknya satu peran harus dipilih.',
            'Role.array' => 'Peran harus dalam format array.',
            'Role.min' => 'Setidaknya satu peran harus dipilih.',
            'Role.in' => 'Pilih peran yang valid: Siswa.',
            
            'NamaLengkap.string' => 'Nama lengkap harus berupa teks.',
            'NamaLengkap.max' => 'Nama lengkap maksimal terdiri dari 100 karakter.',
            'NamaLengkap.min' => 'Nama lengkap minimal terdiri dari 10 karakter.',
            
            'NomorInduk.string' => 'Nomor induk hanya boleh berupa teks.',
            'NomorInduk.max' => 'Nomor induk maksimal terdiri dari 16 karakter.',
            
            'NamaPanggilan.string' => 'Nama panggilan harus berupa teks.',
            'NamaPanggilan.max' => 'Nama panggilan maksimal terdiri dari 50 karakter.',
            'NamaPanggilan.min' => 'Nama panggilan minimal terdiri dari 3 karakter.',
            
            'JenisKelamin.string' => 'Jenis kelamin harus berupa teks.',
            'JenisKelamin.in' => 'Pilih jenis kelamin yang valid: Laki-Laki atau Perempuan.',
            
            'NISN.string' => 'NISN hanya boleh berupa teks.',
            'NISN.max' => 'NISN maksimal terdiri dari 16 karakter.',
            
            'TempatLahir.string' => 'Tempat lahir harus berupa teks.',
            'TempatLahir.max' => 'Tempat lahir maksimal terdiri dari 30 karakter.',
            
            'TanggalLahir.string' => 'Tanggal lahir harus berupa teks.',
            'TanggalLahir.max' => 'Tanggal lahir maksimal terdiri dari 30 karakter.',
            
            'Agama.string' => 'Agama harus berupa teks.',
            'Agama.in' => 'Pilih agama yang valid: Katolik, Kristen Protestan, Islam, Hindu, Buddha, atau Konghucu.',
            
            'Alamat.string' => 'Alamat harus berupa teks.',
            'Alamat.max' => 'Alamat maksimal terdiri dari 100 karakter.',
            
            'Email.string' => 'Email harus berupa teks.',
            'Email.max' => 'Email maksimal terdiri dari 100 karakter.',
            
            'NomorTelephone.string' => 'Nomor telepon harus berupa teks.',
            'NomorTelephone.max' => 'Nomor telepon maksimal terdiri dari 13 karakter.',
            
            'NIK.string' => 'NIK harus berupa teks.',
            'NIK.max' => 'NIK maksimal terdiri dari 16 karakter.',
            'AsalSD.string' => 'Asal SMP harus berupa teks.',
            'AsalSD.max' => 'Asal SMP maksimal terdiri dari 16 karakter.',
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
        DB::beginTransaction();
            
        // Parse and format the date properly
        $tanggalLahir = null;
        if (!empty($validatedData['TanggalLahir'])) {
            $tanggalLahir = Carbon::createFromFormat('Y-m-d', $validatedData['TanggalLahir'])->format('Y-m-d');
        }
        if ($user->Siswa) {
            $user->Siswa->update([
                'NamaLengkap' => $validatedData['NamaLengkap'],
                'NomorInduk' =>  $validatedData['NomorInduk'],
                'NamaPanggilan' =>  $validatedData['NamaPanggilan'],
                'JenisKelamin' =>  $validatedData['JenisKelamin'],
                'NISN' =>  $validatedData['NISN'],
                'TempatLahir' =>  $validatedData['TempatLahir'],
              'TanggalLahir' =>$tanggalLahir,

                'Agama' =>  $validatedData['Agama'],
                'Alamat' =>  $validatedData['Alamat'],
                'Email' =>  $validatedData['Email'],
                'NomorTelephone' =>  $validatedData['NomorTelephone'],
                'NIK' =>  $validatedData['NIK'],
                'AsalSD' =>  $validatedData['AsalSD'],
                'status' => 'Aktif',
            ]);
        }
    
        return redirect()->route('dashboardSUSiswa.indexSiswa')->with('success', 'User Berhasil Diupdate.');
    }
    public function storeSiswa(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => ['required', 'string', 'max:12','min:7','regex:/^[a-zA-Z0-9_-]+$/', 'unique:users,username', new NoXSSInput()],
            'password' => ['nullable', 'string', 'min:7','max:12','confirmed', new NoXSSInput()],      
            'hakakses' => ['required', 'string', 'in:Siswa,NonSiswa', new NoXSSInput()],      
            'Role' => ['required', 'array', 'min:1','in:Siswa,NonSiswa', new NoXSSInput()],      
            'NamaLengkap' => ['nullable', 'string','max:100','min:10', new NoXSSInput()],
            'NomorInduk' => ['nullable', 'string','max:16', new NoXSSInput()],
            'NamaPanggilan' => ['nullable', 'string','max:50','min:3', new NoXSSInput()],
            'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],
            'NISN' => ['nullable', 'string','max:16', new NoXSSInput()],
            'TempatLahir' => ['nullable', 'string','max:30', new NoXSSInput()],
            'TanggalLahir' => ['nullable', 'string','max:30', new NoXSSInput()],
            'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'Alamat' => ['nullable', 'string','max:100', new NoXSSInput()],
            'Email' => ['nullable', 'string','max:100', new NoXSSInput()],
            'NomorTelephone' => ['nullable', 'string','max:13', new NoXSSInput()],
            'NIK' => ['nullable', 'string','max:16', new NoXSSInput()],
            'AsalSD' => ['nullable', 'string','max:255', new NoXSSInput()],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username hanya boleh berupa teks.',
            'username.max' => 'Username maksimal terdiri dari 12 karakter.',
            'username.min' => 'Username minimal terdiri dari 7 karakter.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, tanda hubung, atau underscore.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih username lain.',
            
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal terdiri dari 7 karakter.',
            'password.max' => 'Password maksimal terdiri dari 12 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            
            'hakakses.required' => 'Hak akses wajib dipilih.',
            'hakakses.string' => 'Hak akses harus berupa teks.',
            'hakakses.in' => 'Pilih hak akses yang valid: Siswa.',
            
            'Role.required' => 'Setidaknya satu peran harus dipilih.',
            'Role.array' => 'Peran harus dalam format array.',
            'Role.min' => 'Setidaknya satu peran harus dipilih.',
            'Role.in' => 'Pilih peran yang valid: Siswa.',
            
            'NamaLengkap.string' => 'Nama lengkap harus berupa teks.',
            'NamaLengkap.max' => 'Nama lengkap maksimal terdiri dari 100 karakter.',
            'NamaLengkap.min' => 'Nama lengkap minimal terdiri dari 10 karakter.',
            
            'NomorInduk.string' => 'Nomor induk hanya boleh berupa teks.',
            'NomorInduk.max' => 'Nomor induk maksimal terdiri dari 16 karakter.',
            
            'NamaPanggilan.string' => 'Nama panggilan harus berupa teks.',
            'NamaPanggilan.max' => 'Nama panggilan maksimal terdiri dari 50 karakter.',
            'NamaPanggilan.min' => 'Nama panggilan minimal terdiri dari 3 karakter.',
            
            'JenisKelamin.string' => 'Jenis kelamin harus berupa teks.',
            'JenisKelamin.in' => 'Pilih jenis kelamin yang valid: Laki-Laki atau Perempuan.',
            
            'NISN.string' => 'NISN hanya boleh berupa teks.',
            'NISN.max' => 'NISN maksimal terdiri dari 16 karakter.',
            
            'TempatLahir.string' => 'Tempat lahir harus berupa teks.',
            'TempatLahir.max' => 'Tempat lahir maksimal terdiri dari 30 karakter.',
            
            'TanggalLahir.string' => 'Tanggal lahir harus berupa teks.',
            'TanggalLahir.max' => 'Tanggal lahir maksimal terdiri dari 30 karakter.',
            
            'Agama.string' => 'Agama harus berupa teks.',
            'Agama.in' => 'Pilih agama yang valid: Katolik, Kristen Protestan, Islam, Hindu, Buddha, atau Konghucu.',
            
            'Alamat.string' => 'Alamat harus berupa teks.',
            'Alamat.max' => 'Alamat maksimal terdiri dari 100 karakter.',
            
            'Email.string' => 'Email harus berupa teks.',
            'Email.max' => 'Email maksimal terdiri dari 100 karakter.',
            
            'NomorTelephone.string' => 'Nomor telepon harus berupa teks.',
            'NomorTelephone.max' => 'Nomor telepon maksimal terdiri dari 13 karakter.',
            
            'NIK.string' => 'NIK harus berupa teks.',
            'NIK.max' => 'NIK maksimal terdiri dari 16 karakter.',
            'AsalSD.string' => 'Asal SMP harus berupa teks.',
            'AsalSD.max' => 'Asal SMP maksimal terdiri dari 16 karakter.',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $tanggalLahir = null;
                if (!empty($request['TanggalLahir'])) {
                    $tanggalLahir = Carbon::createFromFormat('Y-m-d', $request['TanggalLahir'])->format('Y-m-d');
                }
                $siswa = Siswa::create([
                    'NamaLengkap' => $request->NamaLengkap, // Sesuaikan dengan struktur tabel siswa
                    'NomorInduk' => $request['NomorInduk'],
                    'NamaPanggilan' => $request['NamaPanggilan'],
                    'JenisKelamin' => $request['JenisKelamin'],
                    'NISN' => $request['NISN'],
                    'TempatLahir' => $request['TempatLahir'],
                    'TanggalLahir' => $tanggalLahir,
                    'Agama' => $request['Agama'],
                    'Alamat' => $request['Alamat'],
                    'Email' => $request['Email'],
                    'NomorTelephone' => $request['NomorTelephone'],
                    'NIK' => $request['NIK'],
                    'AsalSD' => $request['AsalSD'],
                    'status' => 'Aktif',
                    
                    
                    // Sesuaikan dengan struktur tabel siswa
                ]);
    
                // Buat entri baru di tabel users dengan relasi siswa_id
                User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'hakakses' => $request->hakakses,
                    'Role' => implode(',', $request->Role),
                    'siswa_id' => $siswa->siswa_id, // Menyimpan foreign key siswa_id
                ]);
            });
            // User::create([
            //     'username' => $request->username,
            //     'password' => bcrypt($request->password),
            //     'hakakses' => $request->hakakses,
            //     'Role' => implode(',', $request->Role),
            // ]);
            return redirect()->route('dashboardSUSiswa.createSiswa')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }
    public function deleteUsersSiswa(Request $request)
    {
        // Validasi UUID
        $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],  
            'ids.*' => ['uuid', new NoXSSInput()],  
        ]);

        // Hapus pengguna berdasarkan UUID
        User::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected users and their related data deleted successfully.'
        ]);
    }


}
