<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\NoXSSInput;

use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Tombol;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class InfoUserControllerAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
   
    public function create()
    {
    $user = auth()->user()->load('Guru'); 

    $roles = explode(',', $user->getRawOriginal('Role')); 

  

    return view('laravel-examples/user-profileAdmin', compact('user', 'roles'));
    }
        public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'Nama' => ['nullable', 'string', 'max:50', new NoXSSInput()],
            'Role' => ['nullable', 'string', 'in:SU,KepalaSekolah,Admin,Guru,Kurikulum,Siswa,NonSiswa', new NoXSSInput()],
            'current_password' => ['nullable', 'string', 'max:12', new NoXSSInput()],      
            'password' => ['nullable', 'string', 'min:7','max:12','confirmed', new NoXSSInput()],      
            
           
            'TempatLahir' => ['nullable', 'string', 'max:255', new NoXSSInput()],      
            'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],      
            'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],      
            'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],      
            'StatusPegawai' => ['nullable', 'string','max:255', new NoXSSInput()],      
            'NipNips' => ['nullable', 'string','max:16', new NoXSSInput()],      
            'Nuptk' => ['nullable', 'string','max:16', new NoXSSInput()],      
            'Nik' => ['nullable', 'string','max:16', new NoXSSInput()],      
            'Npwp' => ['nullable', 'string','max:16', new NoXSSInput()],      
            'NomorSertifikatPendidik' => ['nullable', 'string','max:16', new NoXSSInput()],      
            'TahunSertifikasi' => ['nullable', 'date', new NoXSSInput()],      
            'PendidikanAkhir' => ['nullable', 'string', 'max:100', new NoXSSInput()],      
            'TahunTamat' => ['nullable', 'date', new NoXSSInput()],      
            'Jurusan' => ['nullable', 'string', 'max:100', new NoXSSInput()],      
            'TugasMengajar' => ['nullable', 'string', 'max:100', new NoXSSInput()],      
            'TahunPensiun' => ['nullable', 'date', new NoXSSInput()],      
            'Pangkat' => ['nullable', 'string', 'max:50', new NoXSSInput()],      
            'jadwalkenaikangaji' => ['nullable', 'date', new NoXSSInput()],      
            'jadwalkenaikanpangkat' => ['nullable', 'date', new NoXSSInput()],      
            'Jabatan' => ['nullable', 'string', 'max:50', new NoXSSInput()],      
            'NomorTelephone' => ['nullable', 'string', 'max:13', new NoXSSInput()],      
            'Alamat' => ['nullable', 'string', 'max:100', new NoXSSInput()],      
            'Email' => ['nullable', 'string', 'max:100', new NoXSSInput()],      
            'status' => ['nullable', 'in:Aktif,Tidak Aktif', new NoXSSInput()],      
            'username' => [
                'nullable', 
                'string', 
                'max:12', 
                'regex:/^[a-zA-Z0-9_-]+$/', 
                Rule::unique('users', 'username')->ignore($user->id), 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],   
            'foto' => ['nullable','image','mimes:jpeg,png,jpg','max:512'],
        
        ],
    [
        'foto.mimes' => 'harus bertipe jpeg,png,jpg',
        'foto.max' => 'foto harus kurang dari 512 kb',
        'foto.image' => 'harus berupa gambar',
            
        ]
        );

        $filePath = null;
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('public/fotoguru', $fileName); // Simpan file ke folder public/fotosiswa
            // Simpan hanya nama file ke database
            $filePath = $fileName;
            // Hapus file lama jika ada
            if ($user->guru && $user->guru->foto && Storage::exists('public/fotoguru/' . $user->guru->foto)) {
                Storage::delete('public/fotoguru/' . $user->guru->foto);
            }
        }

        try {
            DB::beginTransaction();

            // Validasi password lama jika password baru diinputkan
            if (!empty($request->password)) {
                if (empty($request->current_password) || !Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()
                        ->withErrors(['current_password' => 'Password lama tidak sesuai'])
                        ->withInput();
                }
            }

            // Update data user
            $updateData = [
                'hakakses' => $request->Role,
            ];

            // Hanya update password jika diinputkan
            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            // Update atau buat data guru
            $guru = Guru::updateOrCreate(
                ['guru_id' => $user->guru_id],
                [
                    'foto' => $filePath, 
                    'NipNips' => $request->NipNips,
                    'Nuptk' => $request->Nuptk,
                    'Nik' => $request->Nik,
                    'Npwp' => $request->Npwp,
                    'NomorSertifikatPendidik' => $request->NomorSertifikatPendidik,
                    'PendidikanAkhir' => $request->PendidikanAkhir,
                    'TahunTamat' => $request->TahunTamat,
                    'Jurusan' => $request->Jurusan,
                    'TugasMengajar' => $request->TugasMengajar,
                    'TahunPensiun' => $request->TahunPensiun,
                    'NomorTelephone' => $request->NomorTelephone,
                    'Alamat' => $request->Alamat,
                    'Email' => $request->Email,
                    'status' => $request->status ?? 'Aktif',

                ]
            );

            // Update guru_id pada user
            $user->update(['guru_id' => $guru->guru_id]);

            DB::commit();

            // Redirect berdasarkan role
            $routes = [
                'SU' => 'user-profileSU.create',
                'Admin' => 'user-profileAdmin.create',
                'KepalaSekolah' => 'user-profileKepalaSekolah.create',
                'Kurikulum' => 'user-profileKurikulum.create',
                'Guru' => 'user-profileGuru.create',
                'Siswa' => 'user-profileSiswa.create',
            ];

            return redirect()->route($routes[$user->hakakses] ?? 'logout')
                ->with('success', 'Profil berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file jika transaksi gagal
            if ($filePath && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat atau memperbarui profil guru',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function createdataku()
    {
        $tombol = Tombol::where('url', 'DatakuAdmin')->first();
        if (!$tombol) {
            return redirect()->route('dashboardAdmin.index')->with('warning', 'Dataku tidak tersedia.');
        }
    
        $user = auth()->user()->load('Guru'); 
    
        $roles = explode(',', $user->getRawOriginal('Role')); 
        $start_date = Carbon::parse($tombol->start_date);
        $end_date = Carbon::parse($tombol->end_date);
    
        if (Carbon::now()->between($start_date, $end_date)) {
            return view('laravel-examples/DatakuAdmin', compact('user', 'roles'));
        }
    
        return redirect()->route('dashboardAdmin.index')->with('warning', 'Dataku masih tertutup.');
    }
        public function storeall(Request $request)
        {
            $user = Auth::user();
        
            $this->validate($request, [
                'Nama' => ['nullable', 'string', 'max:50', new NoXSSInput()],
                'TempatLahir' => ['nullable', 'string', 'max:255', new NoXSSInput()],      
                'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],      
                'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],      
                'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],      
                'StatusPegawai' => ['nullable', 'string','max:255', new NoXSSInput()],      
                'username' => [
                    'nullable', 
                    'string', 
                    'max:12', 
                    'regex:/^[a-zA-Z0-9_-]+$/', 
                    Rule::unique('users', 'username')->ignore($user->id), 
                    new NoXSSInput(),
                    function ($attribute, $value, $fail) {
                        $sanitizedValue = strip_tags($value);
                        if ($sanitizedValue !== $value) {
                            $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                        }
                    }
                ],   
            ]);
            try {
                DB::beginTransaction();
                $updateData = [
                    'username' => $request->username,
                ];
                $user->update($updateData);
                $guru = Guru::updateOrCreate(
                    ['guru_id' => $user->guru_id],
                    [
                                        'Nama' => $request->Nama,
                        'TempatLahir' => $request->TempatLahir,
                        'TanggalLahir' => $request->TanggalLahir,
                        'Agama' => $request->Agama,
                        'JenisKelamin' => $request->JenisKelamin,
                        'StatusPegawai' => $request->StatusPegawai,
                      
                        'status' => $request->status ?? 'Aktif',
                    ]
                );
                $user->update(['guru_id' => $guru->guru_id]);
                DB::commit();
                $routes = [
                    'SU' => 'user-profileSU.create',
                    'Admin' => 'user-profileAdmin.create',
                    'KepalaSekolah' => 'user-profileKepalaSekolah.create',
                    'Kurikulum' => 'user-profileKurikulum.create',
                    'Guru' => 'user-profileGuru.create',
                    'Siswa' => 'user-profileSiswa.create',
                ];
        
                return redirect()->route($routes[$user->hakakses] ?? 'logout')
                    ->with('success', 'Profil berhasil diperbarui');
            } catch (\Exception $e) {
                DB::rollBack();    
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat atau memperbarui profil guru',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
}

