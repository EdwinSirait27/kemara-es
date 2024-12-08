<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InfoUserControllerSiswa extends Controller
{
    public function create()
    {
    $user = auth()->user()->load('Siswa'); 

    $roles = explode(',', $user->getRawOriginal('Role')); 

    // Validasi jika guru tidak ada
   

    return view('laravel-examples/user-profileSiswa', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
    
        $this->validate($request, [
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'Role' => 'required|string|in:Siswa',
            'current_password' => 'nullable|string', 
            'password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
            'NamaLengkap' => 'required|string|max:255',
            'NomorInduk' => 'required|numeric',
            'NamaPanggilan' => 'nullable|string|max:100',
            'JenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',

            'NISN' => 'nullable|numeric',
            'TempatLahir' => 'nullable|string|max:255',
            'TanggalLahir' => 'nullable|date',
            'Agama' => 'nullable|string|max:100',
            'Alamat' => 'nullable|string|max:255','Email' => 'nullable|email|max:255',
            'NomorTelephone' => 'nullable|numeric',
            'NIK' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            
        ]);
        
    
        $filePath = null;
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $filePath = 'public/fotosiswa/' . $fileName;
    
            // Hapus foto lama jika ada
            if ($user->siswa && $user->siswa->foto && Storage::exists($user->siswa->foto)) {
                Storage::delete($user->siswa->foto);
            }
    
            $file->storeAs('public/fotosiswa', $fileName);
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
                    'TanggalLahir' => $request->TanggalLahir,
                    'Agama' => $request->Agama,
                    'Alamat' => $request->Alamat,
                    'Email' => $request->Email,
                    'NomorTelephone' => $request->NomorTelephone,
                    'NIK' => $request->NIK,
                    'status' => $request->status,
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
}
