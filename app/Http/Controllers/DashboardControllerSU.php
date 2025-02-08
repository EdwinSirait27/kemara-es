<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class DashboardControllerSU extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('dashboardSU.dashboardSU');

    }
    public function create()
    {
        return view('dashboardSU.create');
    }
    public function getUsers()
    {
        $users = User::with('Guru')
            ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
            ->whereIn('hakakses', ['SU', 'Admin', 'KepalaSekolah', 'Guru', 'Kurikulum'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
                // $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y'); $user->Role = implode(', ', explode(',', $user->Role));
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('dashboardSU.edit1', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
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
    public function edit($hashedId)
    {
        $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        $roles = explode(',', $user->getRawOriginal('Role'));
        if (!$user) {
            abort(404, 'User not found.');
        }
        return view('dashboardSU.edit', compact('user', 'hashedId', 'roles'));
    }
    public function update(Request $request, $hashedId) 
{
    // Cari user berdasarkan hashed ID
    $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$user) {
        return redirect()->route('dashboardSU.index')->with('error', 'ID tidak valid.');
    }

    $validatedData = $request->validate([
        'hakakses' => ['required', 'string', 'in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput()],
        'Role' => ['required', 'array', 'min:1', 'in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput()],
        'Nama' => ['required', 'string', 'max:255', new NoXSSInput()],
        'TempatLahir' => ['nullable', 'string', 'max:255', new NoXSSInput()],      
        'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],      
        'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],      
        'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],      
        'StatusPegawai' => ['nullable', 'string','max:255', new NoXSSInput()],  
        'Pangkat' => ['nullable', 'string', 'max:50', new NoXSSInput()],      
        'jadwalkenaikangaji' => ['nullable', 'date', new NoXSSInput()],      
        'jadwalkenaikanpangkat' => ['nullable', 'date', new NoXSSInput()],      
        'Jabatan' => ['nullable', 'string', 'max:50', new NoXSSInput()],      
        
        'password' => ['nullable', 'string', 'min:7', 'max:12', new NoXSSInput()],
        'username' => [
            'required',
            'string',
            'max:12',
            'min:7',
            'regex:/^[a-zA-Z0-9_-]+$/',
            Rule::unique('users')->ignore($user->id), // Gunakan ID asli
            new NoXSSInput()
        ],
    ],
        [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username hanya boleh berupa teks.',
            'username.max' => 'Username maksimal terdiri dari 12 karakter.',
            'username.min' => 'Username minimal terdiri dari 7 karakter.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, tanda hubung, atau underscore.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih username lain.',

            'hakakses.required' => 'Hak akses wajib dipilih.',
    'hakakses.string' => 'Hak akses harus berupa teks.',
    'hakakses.in' => 'Pilih hak akses yang valid: SU, KepalaSekolah, Admin, Guru, atau Kurikulum.',
    
    'Role.required' => 'Setidaknya satu Role harus dipilih.',
    'Role.array' => 'Role harus dalam format array.',
    'Role.min' => 'Setidaknya satu Role harus dipilih.',
    'Role.in' => 'Pilih role yang valid: SU, KepalaSekolah, Admin, Guru, atau Kurikulum.',
    
    'Nama.required' => 'Nama wajib diisi.',
    'Nama.string' => 'Nama hanya boleh berupa teks.',
    'Nama.max' => 'Nama maksimal terdiri dari 255 karakter.',
    
    'TempatLahir.string' => 'Tempat lahir hanya boleh berupa teks.',
    'TempatLahir.max' => 'Tempat lahir maksimal terdiri dari 255 karakter.',
    
    'TanggalLahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
    
    'Agama.string' => 'Agama harus berupa teks.',
    'Agama.in' => 'Pilih agama yang valid: Katolik, Kristen Protestan, Islam, Hindu, Buddha, atau Konghucu.',
    
    'JenisKelamin.string' => 'Jenis kelamin harus berupa teks.',
    'JenisKelamin.in' => 'Pilih jenis kelamin yang valid: Laki-Laki atau Perempuan.',
    
    'StatusPegawai.string' => 'Status pegawai hanya boleh berupa teks.',
    'StatusPegawai.max' => 'Status pegawai maksimal terdiri dari 255 karakter.',
    
    'Pangkat.string' => 'Pangkat hanya boleh berupa teks.',
    'Pangkat.max' => 'Pangkat maksimal terdiri dari 50 karakter.',
    
    'jadwalkenaikangaji.date' => 'Tanggal kenaikan gaji harus berupa tanggal yang valid.',
    
    'jadwalkenaikanpangkat.date' => 'Tanggal kenaikan pangkat harus berupa tanggal yang valid.',
    
    'Jabatan.string' => 'Jabatan hanya boleh berupa teks.',
    'Jabatan.max' => 'Jabatan maksimal terdiri dari 50 karakter.',
    
    'password.string' => 'Password harus berupa teks.',
    'password.min' => 'Password minimal terdiri dari 7 karakter.',
    'password.max' => 'Password maksimal terdiri dari 12 karakter.',
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
    // if ($user->Guru) {

    //     $user->Guru->update([
    //         'Nama' => $validatedData['Nama'],
    //         'TempatLahir' => $validatedData['TempatLahir'],
    //         'TanggalLahir' => $tanggalLahir,
    //         'Agama' => $validatedData['Agama'],
    //         'JenisKelamin' => $validatedData['JenisKelamin'],
    //         'StatusPegawai' => $validatedData['StatusPegawai'],
    //         'jadwalkenaikangaji' => $validatedData['jadwalkenaikangaji'],
    //         'Pangkat' => $validatedData['Pangkat'],
    //         'jadwalkenaikanpangkat' => $validatedData['jadwalkenaikanpangkat'],
    //         'Jabatan' => $validatedData['Jabatan'],
    //         'status' => 'Aktif',
    //     ]);
    // }
    if ($user->Guru) {
        $user->Guru->update([
            'Nama' => $validatedData['Nama'],
            'TempatLahir' => $validatedData['TempatLahir'],
            'TanggalLahir' => $tanggalLahir,
            'Agama' => $validatedData['Agama'],
            'JenisKelamin' => $validatedData['JenisKelamin'],
            'StatusPegawai' => $validatedData['StatusPegawai'],
            'Pangkat' => $validatedData['Pangkat'],
           'jadwalkenaikangaji' => !empty($validatedData['jadwalkenaikangaji']) ? $validatedData['jadwalkenaikangaji'] : null,
'jadwalkenaikanpangkat' => !empty($validatedData['jadwalkenaikanpangkat']) ? $validatedData['jadwalkenaikanpangkat'] : null,

            'Jabatan' => $validatedData['Jabatan'],
            'status' => 'Aktif',
        ]);
    }
    return redirect()->route('dashboardSU.index')->with('success', 'User Guru Berhasil Diupdate.');
}
 
    public function deleteUsers(Request $request)
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
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:12','min:7','regex:/^[a-zA-Z0-9_-]+$/', 'unique:users,username', new NoXSSInput()],
            'password' => ['nullable', 'string', 'min:7','max:12', new NoXSSInput()],      
            'hakakses' => ['required', 'string', 'in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput()],      
            'Role' => ['required', 'array', 'min:1','in:SU,KepalaSekolah,Admin,Guru,Kurikulum', new NoXSSInput()],
            'Nama' => ['required', 'string', 'max:100', new NoXSSInput()], // Tambahkan input untuk siswa
            'TempatLahir' => ['nullable', 'string', 'max:255', new NoXSSInput()],      
            'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],      
            'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],      
            'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],      
            'StatusPegawai' => ['nullable', 'string','max:255', new NoXSSInput()],  
            'Pangkat' => ['nullable', 'string', 'max:50', new NoXSSInput()],      
            'jadwalkenaikangaji' => ['nullable', 'date', new NoXSSInput()],      
            'jadwalkenaikanpangkat' => ['nullable', 'date', new NoXSSInput()],      
            'Jabatan' => ['nullable', 'string', 'max:50', new NoXSSInput()],      
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
            
            'hakakses.required' => 'Hak akses wajib dipilih.',
            'hakakses.string' => 'Hak akses harus berupa teks.',
            'hakakses.in' => 'Pilih hak akses yang valid: SU, KepalaSekolah, Admin, Guru, atau Kurikulum.',
            
            'Role.required' => 'Setidaknya satu Role harus dipilih.',
            'Role.array' => 'Role harus dalam format array.',
            'Role.min' => 'Setidaknya satu Role harus dipilih.',
            'Role.in' => 'Pilih Role yang valid: SU, KepalaSekolah, Admin, Guru, atau Kurikulum.',
            
            'Nama.required' => 'Nama wajib diisi.',
            'Nama.string' => 'Nama hanya boleh berupa teks.',
            'Nama.max' => 'Nama maksimal terdiri dari 100 karakter.',
            
            'TempatLahir.string' => 'Tempat lahir hanya boleh berupa teks.',
            'TempatLahir.max' => 'Tempat lahir maksimal terdiri dari 255 karakter.',
            
            'TanggalLahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            
            'Agama.string' => 'Agama harus berupa teks.',
            'Agama.in' => 'Pilih agama yang valid: Katolik, Kristen Protestan, Islam, Hindu, Buddha, atau Konghucu.',
            
            'JenisKelamin.string' => 'Jenis kelamin harus berupa teks.',
            'JenisKelamin.in' => 'Pilih jenis kelamin yang valid: Laki-Laki atau Perempuan.',
            
            'StatusPegawai.string' => 'Status pegawai hanya boleh berupa teks.',
            'StatusPegawai.max' => 'Status pegawai maksimal terdiri dari 255 karakter.',
            
            'Pangkat.string' => 'Pangkat hanya boleh berupa teks.',
            'Pangkat.max' => 'Pangkat maksimal terdiri dari 50 karakter.',
            
            'jadwalkenaikangaji.date' => 'Tanggal kenaikan gaji harus berupa tanggal yang valid.',
            
            'jadwalkenaikanpangkat.date' => 'Tanggal kenaikan pangkat harus berupa tanggal yang valid.',
            
            'Jabatan.string' => 'Jabatan hanya boleh berupa teks.',
            'Jabatan.max' => 'Jabatan maksimal terdiri dari 50 karakter.',
        ]);
    
        try {
            DB::transaction(function () use ($request) {
                $tanggalLahir = null;
                if (!empty($request['TanggalLahir'])) {
                    $tanggalLahir = Carbon::createFromFormat('Y-m-d', $request['TanggalLahir'])->format('Y-m-d');
                }
                $guru = Guru::create([
                    'Nama' => $request['Nama'], // Sesuaikan dengan struktur tabel siswa
                    'TempatLahir' => $request['TempatLahir'],
                    'TanggalLahir' => $tanggalLahir,
                    'Agama' => $request['Agama'],
                    'JenisKelamin' => $request['JenisKelamin'],
                    'StatusPegawai' => $request['StatusPegawai'],
                    'Pangkat' => $request['Pangkat'],
                   'jadwalkenaikangaji' => !empty($request['jadwalkenaikangaji']) ? $request['jadwalkenaikangaji'] : '1965-08-05',
'jadwalkenaikanpangkat' => !empty($request['jadwalkenaikanpangkat']) ? $request['jadwalkenaikanpangkat'] : '1965-08-05',

                    'Jabatan' => $request['Jabatan'],
                    'status' => 'Aktif',
                    
                    
                    // Sesuaikan dengan struktur tabel siswa
                ]);
    
                // Buat entri baru di tabel users dengan relasi siswa_id
                User::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'hakakses' => $request->hakakses,
                    'Role' => implode(',', $request->Role),
                    'guru_id' => $guru->guru_id, // Menyimpan foreign key siswa_id
                ]);
            });
    
            return redirect()->route('dashboardSU.index')->with('success', 'User Guru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat User Guru: ' . $e->getMessage());
        }
    }
}

