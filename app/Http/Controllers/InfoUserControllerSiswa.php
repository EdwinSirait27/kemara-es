<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Tombol;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Rules\NoXSSInput;
use Illuminate\Validation\Rule;


class InfoUserControllerSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function create()
    {
        $user = auth()->user()->load('Siswa', 'Siswa.PengaturanKelasSiswa.Pengaturankelas.Kelas');
    
        $roles = explode(',', $user->getRawOriginal('Role'));
    
        // Ambil semua nama kelas dari relasi pengaturankelas
        $pengaturankelasNames = $user->Siswa->PengaturanKelasSiswa->flatMap(function ($pengaturan) {
            return $pengaturan->Pengaturankelas->Kelas->where('status', 'Aktif')->pluck('kelas');
        })->unique()->values()->implode(', ');
        
        
        // $pengaturankelasNames = $user->Siswa->PengaturanKelasSiswa->flatMap(function ($pengaturan) {
        //     return $pengaturan->Pengaturankelas->Kelas->pluck('kelas');
        // });
    
        return view('laravel-examples/user-profileSiswa', compact('user', 'roles', 'pengaturankelasNames'));
    }
    
    // public function create()
    // {
    // $user = auth()->user()->load('Siswa','Siswa.Pengaturankelassiswa.Pengaturankelas'); 

    // $roles = explode(',', $user->getRawOriginal('Role')); 

    // // Validasi jika guru tidak ada
    // $PengaturankelasIds = $user->Siswa->PengaturanKelasSiswa->Pnegaturankelas->pluck('namakelas');


    // return view('laravel-examples/user-profileSiswa', compact('user', 'roles','PengaturankelasIds'));
    // }

    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'hakakses' => ['nullable', 'string','in:NonSiswa,Siswa', new NoXSSInput()],
            'Role' => ['nullable', 'string','in:NonSiswa,Siswa', new NoXSSInput()],
            'current_password' => ['nullable', 'string','max:12', new NoXSSInput()],
            'password' => ['nullable', 'string','max:12','min:7','confirmed', new NoXSSInput()],
            
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
            'status' => ['nullable', 'string','in:Aktif,Tidak Aktif', new NoXSSInput()],
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
            $file->storeAs('public/fotosiswa', $fileName); // Simpan file ke folder public/fotosiswa
        
            // Simpan hanya nama file ke database
            $filePath = $fileName;
        
            // Hapus file lama jika ada
            if ($user->siswa && $user->siswa->foto && Storage::exists('public/fotosiswa/' . $user->siswa->foto)) {
                Storage::delete('public/fotosiswa/' . $user->siswa->foto);
            }
        }
        
        
    
        try {
            DB::beginTransaction();
    
            if (!empty($request->password)) {
                if (empty($request->current_password) || !Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()
                        ->withErrors(['current_password' => 'Password lama tidak sesuai'])
                        ->withInput();
                }
            }
    
            $updateData = [
                'username' => $request->username,
                'hakakses' => $request->Role,
            ];
    
            if (!empty($request->password)) {
                $updateData['password'] = Hash::make($request->password);
            }
    
            $user->update($updateData);
    
            $siswa = Siswa::updateOrCreate(
                ['siswa_id' => $user->siswa_id],
                [
                                    // 'Nama' => $request->Nama,
                    'foto' => $filePath, 
                    'NamaLengkap' => $request->NamaLengkap,
                    'NomorInduk' => $request->NomorInduk,
                    'NamaPanggilan' => $request->NamaPanggilan,
                    'JenisKelamin' => $request->JenisKelamin,
                    'NISN' => $request->NISN,
                    'TempatLahir' => $request->TempatLahir,
                  'TanggalLahir' => $request->TanggalLahir ? Carbon::parse($request->TanggalLahir)->format('Y-m-d') : null, // Format tanggal diperbaiki
                    
                    'Agama' => $request->Agama,
                    'Alamat' => $request->Alamat,
                    'Email' => $request->Email,
                    'NomorTelephone' => $request->NomorTelephone,
                    'NIK' => $request->NIK,
                    'status' => $request->status ?? 'Aktif',

                ]
            );
    
            $user->update(['siswa_id' => $siswa->siswa_id]);
    
            DB::commit();
    
            $routes = [
                'Siswa' => 'user-profileSiswa.create',
                
            ];
    
            return redirect()->route($routes[$user->hakakses] ?? 'logout')
                ->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
    
            // Hapus foto baru jika transaksi gagal
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
        $tombol = Tombol::where('url', 'DatakuSiswa')->first();
        if (!$tombol) {
            return redirect()->route('dashboardSiswa.index')->with('warning', 'Dataku tidak tersedia.');
        }
    
        $user = auth()->user()->load('Siswa'); 
    
        $roles = explode(',', $user->getRawOriginal('Role')); 
        $start_date = Carbon::parse($tombol->start_date);
        $end_date = Carbon::parse($tombol->end_date);
    
        if (Carbon::now()->between($start_date, $end_date)) {
            return view('laravel-examples/DatakuSiswa', compact('user', 'roles'));
        }
    
        return redirect()->route('dashboardSiswa.index')->with('warning', 'Dataku masih tertutup.');
    }
        public function storeall(Request $request)
        {
            $user = Auth::user();
        
            $this->validate($request, [
                
                'NamaLengkap' => ['nullable', 'string','max:100','min:10', new NoXSSInput()],
                'NomorInduk' => ['nullable', 'string','max:16', new NoXSSInput()],
                'NamaPanggilan' => ['nullable', 'string','max:50','min:3', new NoXSSInput()],
                'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],
                'status' => ['nullable', 'string','in:Aktif', new NoXSSInput()],
                'NISN' => ['nullable', 'string','max:16', new NoXSSInput()],
                'TempatLahir' => ['nullable', 'string','max:30', new NoXSSInput()],
                'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],
                'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
                'username' => [
                    'nullable', 
                    'string', 
                    'max:12', 
                    'regex:/^[a-zA-Z0-9_-]+$/', 
                    Rule::unique('users', 'username')->ignore($user->id), 
                    new NoXSSInput()
                ],   
            ]);
            try {
                DB::beginTransaction();
                $updateData = [
                    'username' => $request->username,
                ];
                $user->update($updateData);
                $siswa = Siswa::updateOrCreate(
                    ['siswa_id' => $user->siswa_id],
                    [
                                        'NamaLengkap' => $request->NamaLengkap,
                                        'NomorInduk' => $request->NomorInduk,
                                        'NamaPanggilan' => $request->NamaPanggilan,
                                        'JenisKelamin' => $request->JenisKelamin,
                                        'NISN' => $request->NISN,
                        'TempatLahir' => $request->TempatLahir,
                        'TanggalLahir' => $request->TanggalLahir,
                        'Agama' => $request->Agama,
                        'status' => $request->status ?? 'Aktif',
                    ]
                );
                $user->update(['siswa_id' => $siswa->siswa_id]);
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
