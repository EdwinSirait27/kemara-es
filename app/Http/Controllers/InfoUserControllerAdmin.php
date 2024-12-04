<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use App\Models\Guru;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class InfoUserControllerAdmin extends Controller
{
    public function create()
    {
        $guru = Guru::all();
        $guru = auth()->user()->guru;
        $user = auth()->user();
        $roles = explode(',', $user->getRawOriginal('Role'));


        return view('laravel-examples/user-profileAdmin', compact('guru', 'roles', 'user'));
    }

    public function store(Request $request)
    {
        $guru = auth()->user()->guru;
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'Role' => 'required|string|in:SU,KepalaSekolah,Admin',
            
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'Profil Gagal Diupdate');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::beginTransaction();
            
            $user->username = $request->username;
            $user->hakakses = $request->input('Role');
            $user->save();
            if ($user->guru_id !== null) {
                $guru = Guru::find($user->guru_id);
                if ($guru) {
                    $guru->Nama = $request->Nama;
              
                    $guru->save();
                }
            } else {
                $guru = new Guru();
                $guru->Nama = $request->Nama;
                $guru->save();
                $user->guru_id = $guru->guru_id;
                $user->save();
            }
            DB::commit();
            if ($user->hakakses === 'SU') {
                return redirect()->route('user-profileSU.create')->with('success', 'Profil berhasil diperbarui');
            } elseif ($user->hakakses === 'Admin') {
                return redirect()->route('user-profileAdmin.create')->with('success', 'Profil berhasil diperbarui');
            } elseif ($user->hakakses === 'KepalaSekolah') {
                return redirect()->route('kepalasekolah.dashboard')->with('success', 'Profil berhasil diperbarui');
            } elseif ($user->hakakses === 'Kurikulum') {
                return redirect()->route('kurikulum.dashboard')->with('success', 'Profil berhasil diperbarui');
            } elseif ($user->hakakses === 'Guru') {
                return redirect()->route('guru.dashboard')->with('success', 'Profil berhasil diperbarui');
            } elseif ($user->hakakses === 'Siswa') {
                return redirect()->route('siswa.dashboard')->with('success', 'Profil berhasil diperbarui');
            } else {
                return redirect()->route('logout')->with('success', 'Profil berhasil diperbarui');
            }
           
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat atau memperbarui profil guru',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    
    // public function store(Request $request)
    // {
    //     $guru = auth()->user()->guru;
    //     $user = Auth::user();
    //     $validator = Validator::make($request->all(), [
    //             'foto' => 'image|mimes:jpeg|max:512',
    //         'foto.image' => 'File harus berupa gambar.',
    //         'foto.mimes' => 'Format file gambar harus jpeg.',
    //         'Nama' => 'required|string|max:50',
    //         'username' => 'required|string|max:50|unique:users,username,' . $user->id,
    //         'Role' => 'required|string|in:SU,KepalaSekolah,Admin',
    //         'Guru',
    //         'Kurikulum',
    //         'Siswa',
    //         'TempatLahir' => 'required|string|max:255',
    //         'TanggalLahir' => 'required|date',
    //         'Agama' => 'required|string|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu', // Sesuaikan nilai Agama
    //         'JenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',
    //         'StatusPegawai' => 'required|string|max:255',
    //         'NipNips' => 'nullable|string|max:16', // Nullable jika opsional
    //         'Nuptk' => 'nullable|string|max:16|',
    //         'Nik' => 'required|string|max:16', // Nik harus 16 digit
    //         'Npwp' => 'nullable|string|max:16|',
    //         'NomorSertifikatPendidik' => 'nullable|string|max:16',
    //         'TahunSertifikasi' => 'required',
    //         'jadwalkenaikangaji' => 'required',
    //         'PendidikanAkhir' => 'required|string|max:255',
    //         'TahunTamat' => 'required',
    //         'Jurusan' => 'required|string|max:255',
    //         'TugasMengajar' => 'required|string|max:255',
    //         'TahunPensiun' => 'required', // Asumsi maksimal 50 tahun dari sekarang
    //         'Pangkat' => 'required',
    //         'jadwalkenaikanpangkat' => 'date',
    //         'Jabatan' => 'required|string|max:255',
    //         'NomorTelephone' => 'required|max:13', // Validasi nomor telepon
    //         'Alamat' => 'required|string|max:500',
    //         'Email' => 'required|string|email|max:255',
    //         'status' => 'required|string|max:255', // Validasi status (contoh opsional)
    //     ]);
    //     if ($validator->fails()) {
    //         session()->flash('error', 'Profil Gagal Diupdate');
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    //     try {
    //         DB::beginTransaction();
    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $file->move(storage_path('app//public/fotoguru'), $fileName); // Upload ke folder public/uploads
    //         } else {
    //             $fileName = null; // Jika tidak ada foto
    //         }
    //         $user->username = $request->username;
    //         $user->hakakses = $request->input('Role');
    //         $user->save();
    //         if ($user->guru_id !== null) {
    //             $guru = Guru::find($user->guru_id);
    //             if ($guru) {
    //                 if ($fileName) {
    //                     $guru->foto = $fileName; // Simpan nama file ke kolom foto
    //                 }   
    //                 $guru->Nama = $request->Nama;
    //                 $guru->TempatLahir = $request->TempatLahir;
    //                 $guru->TanggalLahir = $request->TanggalLahir;
    //                 $guru->Agama = $request->Agama;
    //                 $guru->JenisKelamin = $request->JenisKelamin;
    //                 $guru->StatusPegawai = $request->StatusPegawai;
    //                 $guru->NipNips = $request->NipNips;
    //                 $guru->Nuptk = $request->Nuptk;
    //                 $guru->Nik = $request->Nik;
    //                 $guru->Npwp = $request->Npwp;
    //                 $guru->NomorSertifikatPendidik = $request->NomorSertifikatPendidik;
    //                 $guru->TahunSertifikasi = $request->TahunSertifikasi;
    //                 $guru->jadwalkenaikangaji = $request->jadwalkenaikangaji;
    //                 $guru->PendidikanAkhir = $request->PendidikanAkhir;
    //                 $guru->TahunTamat = $request->TahunTamat;
    //                 $guru->Jurusan = $request->Jurusan;
    //                 $guru->TugasMengajar = $request->TugasMengajar;
    //                 $guru->TahunPensiun = $request->TahunPensiun;
    //                 $guru->Pangkat = $request->Pangkat;
    //                 $guru->jadwalkenaikanpangkat = $request->jadwalkenaikanpangkat;
    //                 $guru->Jabatan = $request->Jabatan;
    //                 $guru->NomorTelephone = $request->NomorTelephone;
    //                 $guru->Alamat = $request->Alamat;
    //                 $guru->Email = $request->Email;
    //                 $guru->status = $request->status;
    //                 $guru->save();
    //             }
    //         } else {
    //             $guru = new Guru();
    //             if ($fileName) {
    //                 $guru->foto = $fileName;
    //             }
    //             $guru->Nama = $request->Nama;
    //             $guru->TempatLahir = $request->TempatLahir;
    //             $guru->TanggalLahir = $request->TanggalLahir;
    //             $guru->Agama = $request->Agama;
    //             $guru->JenisKelamin = $request->JenisKelamin;
    //             $guru->StatusPegawai = $request->StatusPegawai;
    //             $guru->NipNips = $request->NipNips;
    //             $guru->Nuptk = $request->Nuptk;
    //             $guru->Nik = $request->Nik;
    //             $guru->Npwp = $request->Npwp;
    //             $guru->NomorSertifikatPendidik = $request->NomorSertifikatPendidik;
    //             $guru->TahunSertifikasi = $request->TahunSertifikasi;
    //             $guru->jadwalkenaikangaji = $request->jadwalkenaikangaji;
    //             $guru->PendidikanAkhir = $request->PendidikanAkhir;
    //             $guru->TahunTamat = $request->TahunTamat;
    //             $guru->Jurusan = $request->Jurusan;
    //             $guru->TugasMengajar = $request->TugasMengajar;
    //             $guru->TahunPensiun = $request->TahunPensiun;
    //             $guru->Pangkat = $request->Pangkat;
    //             $guru->jadwalkenaikanpangkat = $request->jadwalkenaikanpangkat;
    //             $guru->Jabatan = $request->Jabatan;
    //             $guru->NomorTelephone = $request->NomorTelephone;
    //             $guru->Alamat = $request->Alamat;
    //             $guru->Email = $request->Email;
    //             $guru->status = $request->status;
    //             $guru->save();
    //             $user->guru_id = $guru->guru_id;
    //             $user->save();
    //         }
    //         DB::commit();
    //         if ($user->hakakses === 'SU') {
    //             return redirect()->route('user-profileSU.create')->with('success', 'Profil berhasil diperbarui');
    //         } elseif ($user->hakakses === 'Admin') {
    //             return redirect()->route('user-profileAdmin.createAdmin')->with('success', 'Profil berhasil diperbarui');
    //         } elseif ($user->hakakses === 'KepalaSekolah') {
    //             return redirect()->route('kepalasekolah.dashboard')->with('success', 'Profil berhasil diperbarui');
    //         } elseif ($user->hakakses === 'Kurikulum') {
    //             return redirect()->route('kurikulum.dashboard')->with('success', 'Profil berhasil diperbarui');
    //         } elseif ($user->hakakses === 'Guru') {
    //             return redirect()->route('guru.dashboard')->with('success', 'Profil berhasil diperbarui');
    //         } elseif ($user->hakakses === 'Siswa') {
    //             return redirect()->route('siswa.dashboard')->with('success', 'Profil berhasil diperbarui');
    //         } else {
    //             return redirect()->route('logout')->with('success', 'Profil berhasil diperbarui');
    //         }
           
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal membuat atau memperbarui profil guru',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    // public function store(Request $request)
    // {
    //     $guru = auth()->user()->guru;
    //     $user = Auth::user();
    //     $validator = Validator::make($request->all(), [
    //             'foto' => 'image|mimes:jpeg|max:512',
    //         'foto.image' => 'File harus berupa gambar.',
    //         'foto.mimes' => 'Format file gambar harus jpeg.',
    //         'Nama' => 'required|string|max:50',
    //         'username' => 'required|string|max:50|unique:users,username,' . $user->id,
    //         'Role' => 'required|string|in:SU,KepalaSekolah,Admin',
    //         'Guru',
    //         'Kurikulum',
    //         'Siswa',
    //         'TempatLahir' => 'required|string|max:255',
    //         'TanggalLahir' => 'required|date',
    //         'Agama' => 'required|string|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu', // Sesuaikan nilai Agama
    //         'JenisKelamin' => 'required|string|in:Laki-Laki,Perempuan',
    //         'StatusPegawai' => 'required|string|max:255',
    //         'NipNips' => 'nullable|string|max:16', // Nullable jika opsional
    //         'Nuptk' => 'nullable|string|max:16|',
    //         'Nik' => 'required|string|max:16', // Nik harus 16 digit
    //         'Npwp' => 'nullable|string|max:16|',
    //         'NomorSertifikatPendidik' => 'nullable|string|max:16',
    //         'TahunSertifikasi' => 'required',
    //         'jadwalkenaikangaji' => 'required',
    //         'PendidikanAkhir' => 'required|string|max:255',
    //         'TahunTamat' => 'required',
    //         'Jurusan' => 'required|string|max:255',
    //         'TugasMengajar' => 'required|string|max:255',
    //         'TahunPensiun' => 'required', // Asumsi maksimal 50 tahun dari sekarang
    //         'Pangkat' => 'required',
    //         'jadwalkenaikanpangkat' => 'date',
    //         'Jabatan' => 'required|string|max:255',
    //         'NomorTelephone' => 'required|max:13', // Validasi nomor telepon
    //         'Alamat' => 'required|string|max:500',
    //         'Email' => 'required|string|email|max:255',
    //         'status' => 'required|string|max:255', // Validasi status (contoh opsional)
    //     ]);
    //     if ($validator->fails()) {
    //         session()->flash('error', 'Profil Gagal Diupdate');
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    //     try {
    //         DB::beginTransaction();
    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $file->move(storage_path('app//public/fotoguru'), $fileName); // Upload ke folder public/uploads
    //         } else {
    //             $fileName = null; // Jika tidak ada foto
    //         }
    //         $user->username = $request->username;
    //         if (str_contains($request->Role, 'SU')) {
    //             $user->hakakses = 'SU';
    //         } elseif (str_contains($request->Role, 'Admin')) {
    //             $user->hakakses = 'Admin';
    //         } elseif (str_contains($request->Role, 'KepalaSekolah')) {
    //             $user->hakakses = 'KepalaSekolah';
    //         } elseif (str_contains($request->Role, 'Kurikulum')) {
    //             $user->hakakses = 'Kurikulum';
    //         } elseif (str_contains($request->Role, 'Guru')) {
    //             $user->hakakses = 'Guru';
    //         } elseif (str_contains($request->Role, 'Siswa')) {
    //             $user->hakakses = 'Siswa';
    //         } elseif (str_contains($request->Role, 'NonSiswa')) {
    //             $user->hakakses = 'NonSiswa';
    //         }
    //         $user->save();
    //         if ($user->guru_id !== null) {
    //             $guru = Guru::find($user->guru_id);
    //             if ($guru) {
    //                 if ($fileName) {
    //                     $guru->foto = $fileName; // Simpan nama file ke kolom foto
    //                 }   
    //                 $guru->Nama = $request->Nama;
    //                 $guru->TempatLahir = $request->TempatLahir;
    //                 $guru->TanggalLahir = $request->TanggalLahir;
    //                 $guru->Agama = $request->Agama;
    //                 $guru->JenisKelamin = $request->JenisKelamin;
    //                 $guru->StatusPegawai = $request->StatusPegawai;
    //                 $guru->NipNips = $request->NipNips;
    //                 $guru->Nuptk = $request->Nuptk;
    //                 $guru->Nik = $request->Nik;
    //                 $guru->Npwp = $request->Npwp;
    //                 $guru->NomorSertifikatPendidik = $request->NomorSertifikatPendidik;
    //                 $guru->TahunSertifikasi = $request->TahunSertifikasi;
    //                 $guru->jadwalkenaikangaji = $request->jadwalkenaikangaji;
    //                 $guru->PendidikanAkhir = $request->PendidikanAkhir;
    //                 $guru->TahunTamat = $request->TahunTamat;
    //                 $guru->Jurusan = $request->Jurusan;
    //                 $guru->TugasMengajar = $request->TugasMengajar;
    //                 $guru->TahunPensiun = $request->TahunPensiun;
    //                 $guru->Pangkat = $request->Pangkat;
    //                 $guru->jadwalkenaikanpangkat = $request->jadwalkenaikanpangkat;
    //                 $guru->Jabatan = $request->Jabatan;
    //                 $guru->NomorTelephone = $request->NomorTelephone;
    //                 $guru->Alamat = $request->Alamat;
    //                 $guru->Email = $request->Email;
    //                 $guru->status = $request->status;
    //                 $guru->save();
    //             }
    //         } else {
    //             $guru = new Guru();
    //             if ($fileName) {
    //                 $guru->foto = $fileName;
    //             }
    //             $guru->Nama = $request->Nama;
    //             $guru->TempatLahir = $request->TempatLahir;
    //             $guru->TanggalLahir = $request->TanggalLahir;
    //             $guru->Agama = $request->Agama;
    //             $guru->JenisKelamin = $request->JenisKelamin;
    //             $guru->StatusPegawai = $request->StatusPegawai;
    //             $guru->NipNips = $request->NipNips;
    //             $guru->Nuptk = $request->Nuptk;
    //             $guru->Nik = $request->Nik;
    //             $guru->Npwp = $request->Npwp;
    //             $guru->NomorSertifikatPendidik = $request->NomorSertifikatPendidik;
    //             $guru->TahunSertifikasi = $request->TahunSertifikasi;
    //             $guru->jadwalkenaikangaji = $request->jadwalkenaikangaji;
    //             $guru->PendidikanAkhir = $request->PendidikanAkhir;
    //             $guru->TahunTamat = $request->TahunTamat;
    //             $guru->Jurusan = $request->Jurusan;
    //             $guru->TugasMengajar = $request->TugasMengajar;
    //             $guru->TahunPensiun = $request->TahunPensiun;
    //             $guru->Pangkat = $request->Pangkat;
    //             $guru->jadwalkenaikanpangkat = $request->jadwalkenaikanpangkat;
    //             $guru->Jabatan = $request->Jabatan;
    //             $guru->NomorTelephone = $request->NomorTelephone;
    //             $guru->Alamat = $request->Alamat;
    //             $guru->Email = $request->Email;
    //             $guru->status = $request->status;
    //             $guru->save();
    //             $user->guru_id = $guru->guru_id;
    //             $user->save();
    //         }
    //         DB::commit();
    //         if ($request->Role === 'SU') {
    //             session()->flash('success', 'Profil berhasil diperbarui');
    //         return redirect()->back();
    //         } elseif ($request->Role === 'Admin')
    //          {
    //             session()->flash('success', 'Profil berhasil diperbarui');
    //             return redirect()->back();
    //         } elseif ($request->Role === 'KepalaSekolah') {
    //             session()->flash('success', 'Profil berhasil diperbarui');
    //             return redirect()->back();
    //         } elseif ($request->Role === 'Kurikulum') {
    //             session()->flash('success', 'Profil berhasil diperbarui');
    //             return redirect()->back();
    //         } elseif ($request->Role === 'Guru') {
    //             return redirect()->route('guru.dashboard')->with('success', 'Profil berhasil diperbarui');
    //         } elseif ($request->Role === 'Siswa') {
    //             return redirect()->route('siswa.dashboard')->with('success', 'Profil berhasil diperbarui');
    //         } else {

    //         }

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal membuat atau memperbarui profil guru',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
