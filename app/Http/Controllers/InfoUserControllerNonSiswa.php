<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\NoXSSInput;

use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class InfoUserControllerNonSiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function create()
    {
        $user = auth()->user()->load('Siswa');

        $roles = explode(',', $user->getRawOriginal('Role'));

        // Validasi jika guru tidak ada


        return view('laravel-examples/user-profileNonSiswa', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'NamaLengkap' => ['nullable', 'string','max:100','min:10', new NoXSSInput()],
            'Role' => ['nullable', 'string','in:NonSiswa,Siswa', new NoXSSInput()],
            
            'NamaPanggilan' => ['nullable', 'string','max:50','min:3', new NoXSSInput()],
            'JenisKelamin' => ['nullable', 'string','in:Laki-Laki,Perempuan', new NoXSSInput()],
            'TempatLakir' => ['nullable', 'string','max:30', new NoXSSInput()],
            'TanggalLahir' => ['nullable', 'date', new NoXSSInput()],
            'Agama' => ['nullable', 'string','in:Katolik,Kristen Protestan,Islam,Hindu,Buddha,Konghucu', new NoXSSInput()],
            'Alamat' => ['nullable', 'string','max:100', new NoXSSInput()],
            'NomorTelephone' => ['nullable', 'string','max:13', new NoXSSInput()],
            'NomorTelephoneAyah' => ['nullable', 'string','max:13', new NoXSSInput()],
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
            'siswa_id' => [
                'nullable',
                'numeric',
                'max:4',
            ],
            'foto' => ['required','image','mimes:jpeg,png,jpg','max:1024'],
        
        ],
    [
        'foto.required' => 'foto wajib diisi',
        'foto.mimes' => 'harus bertipe jpeg,png,jpg',
        'foto.max' => 'foto harus kurang dari 1024 kb',
        'foto.image' => 'harus berupa gambar',
            
        ]);
        
    
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
                    'NamaPanggilan' => $request->NamaPanggilan,
                    'JenisKelamin' => $request->JenisKelamin,
                    'TempatLahir' => $request->TempatLahir,
                    'TanggalLahir' => $request->TanggalLahir,
                    'Agama' => $request->Agama,
                    'Alamat' => $request->Alamat,
                    'NomorTelephone' => $request->NomorTelephone,
                    'NomorTelephoneAyah' => $request->NomorTelephoneAyah,
                    
                ]
            );
    
            $user->update(['siswa_id' => $siswa->siswa_id]);
    
            DB::commit();
    
            $routes = [
                'NonSiswa' => 'user-profileNonSiswa.create',
                
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
                'message' => 'Gagal membuat atau memperbarui profil siswa',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}