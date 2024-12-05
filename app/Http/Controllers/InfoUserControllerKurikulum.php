<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InfoUserControllerKurikulum extends Controller
{
    public function create()
    {
    $user = auth()->user()->load('Guru'); 

    $roles = explode(',', $user->getRawOriginal('Role')); 

    // Validasi jika guru tidak ada
    if (!$user->guru) {
        abort(404, 'Guru tidak ditemukan.');
    }

    return view('laravel-examples/user-profileKurikulum', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'Nama' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'Role' => 'required|string|in:SU,KepalaSekolah,Admin',
            'current_password' => 'nullable|string', 
            'password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
                    'TempatLahir' => 'required|string|max:255',
            'TanggalLahir' => 'required|date',
            'Agama' => 'required|in:' . implode(',', config('agama')),
            // 'Agama' => 'required|string|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu', // Sesuaikan nilai Agama
            'JenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',
            'StatusPegawai' => 'required|string|max:255',
            'NipNips' => 'nullable|string|max:16',
            'Nuptk' => 'nullable|string|max:16',
            'Nik' => 'required|string|max:16', 
            'Npwp' => 'nullable|string|max:16',
            'NomorSertifikatPendidik' => 'nullable|string|max:16',
            'TahunSertifikasi' => 'required',
            'jadwalkenaikangaji' => 'required',
            'PendidikanAkhir' => 'required|string|max:255',
            'TahunTamat' => 'required',
            'Jurusan' => 'required|string|max:255',
            'TugasMengajar' => 'required|string|max:255',
            'TahunPensiun' => 'required', 
            'Pangkat' => 'required',
            'jadwalkenaikanpangkat' => 'date',
            'Jabatan' => 'required|string|max:255',
            'NomorTelephone' => 'required|max:13',
            'Alamat' => 'required|string|max:500',
            'Email' => 'required|string|email|max:255',
            'status' => 'required|string|max:255',
        ]);

        $filePath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $filePath = 'public/fotoguru/' . $fileName;
            $file->storeAs('public/fotoguru', $fileName); // Unggah file ke storage
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
                'username' => $request->username,
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
                    'Nama' => $request->Nama,
                    'foto' => $filePath, 
                    'TempatLahir' => $request->TempatLahir,
                    'TanggalLahir' => $request->TanggalLahir,
                    'Agama' => $request->Agama,
                    'JenisKelamin' => $request->JenisKelamin,
                    'StatusPegawai' => $request->StatusPegawai,
                    'NipNips' => $request->NipNips,
                    'Nuptk' => $request->Nuptk,
                    'Nik' => $request->Nik,
                    'Npwp' => $request->Npwp,
                    'NomorSertifikatPendidik' => $request->NomorSertifikatPendidik,
                    'TahunSertifikasi' => $request->TahunSertifikasi,
                    'jadwalkenaikangaji' => $request->jadwalkenaikangaji,
                    'PendidikanAkhir' => $request->PendidikanAkhir,
                    'TahunTamat' => $request->TahunTamat,
                    'Jurusan' => $request->Jurusan,
                    'TugasMengajar' => $request->TugasMengajar,
                    'TahunPensiun' => $request->TahunPensiun,
                    'Pangkat' => $request->Pangkat,
                    'jadwalkenaikanpangkat' => $request->jadwalkenaikanpangkat,
                    'Jabatan' => $request->Jabatan,
                    'NomorTelephone' => $request->NomorTelephone,
                    'Alamat' => $request->Alamat,
                    'Email' => $request->Email,
                    'status' => $request->status,
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
}
