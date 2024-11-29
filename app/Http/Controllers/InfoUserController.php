<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use App\Models\Guru;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InfoUserController extends Controller
{

    public function create()
    {
        $guru = Guru::all(); 
        $guru = auth()->user()->guru;
        $user = auth()->user();
        $roles = explode(',', $user->Role);
        

        return view('laravel-examples/user-profile',compact('guru','roles','user'));
    }

    public function store(Request $request)
{
    $user = Auth::user();
    $validator = Validator::make($request->all(), [
        'Nama' => 'required|string|max:50',
        'username' => 'required|string|max:50|unique:users,username,' . $user->id, // Validasi username
        'Role' => 'required|string|max:255', // Validasi role, harus sesuai dengan tipe data SET
    ]);

    if ($validator->fails()) {
        session()->flash('error', 'Profil Gagal Diupdate');
        return redirect()->back()
            ->withErrors($validator)
            ->withInput(); 
    }

    try {
        DB::beginTransaction();

        // Update Nama, username, dan role
        $user->username = $request->username; // Mengupdate username
        $user->Role = $request->Role; // Mengupdate role

        // Logika untuk menentukan hakakses berdasarkan role
        if (str_contains($request->Role, 'SU')) {
            $user->hakakses = 'SU';
        } elseif (str_contains($request->Role, 'Admin')) {
            $user->hakakses = 'Admin';
        } elseif (str_contains($request->Role, 'KepalaSekolah')) {
            $user->hakakses = 'KepalaSekolah';
        }  elseif (str_contains($request->Role, 'Kurikulum')) {
            $user->hakakses = 'Kurikulum';
        } elseif (str_contains($request->Role, 'Guru')) {
            $user->hakakses = 'Guru';
        }elseif (str_contains($request->Role, 'Siswa')) {
            $user->hakakses = 'Siswa';
        }elseif (str_contains($request->Role, 'NonSiswa')) {
            $user->hakakses = 'NonSiswa';
        }

        $user->save(); // Simpan perubahan pada user

        // Update Nama Guru jika ada
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
        session()->flash('success', 'Profil berhasil diperbarui');
        return redirect()->back();  
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Gagal membuat atau memperbarui profil guru',
            'error' => $e->getMessage()
        ], 500);
    }
}

//     public function store(Request $request)
// {
//     $user = Auth::user();
//     $validator = Validator::make($request->all(), [
//         'Nama' => 'required|string|max:50',
//         'username' => 'required|string|max:50|unique:users,username,' . $user->id,  // Validasi username, kecuali jika username tidak berubah
//         'hakakses' => 'required|in:SU,Admin,KepalaSekolah','Guru','Kurikulum','Siswa','NonSiswa',
        
//     ]);
    
//     if ($validator->fails()) {
//         session()->flash('error', 'Profil Gagal Diupdate');
//         return redirect()->back()
//             ->withErrors($validator)
//             ->withInput(); 
//     }

//     try {
//         DB::beginTransaction();

//         // Update Nama dan username
//         $user->username = $request->username;  // Mengupdate username
//         $user->hakakses = $request->hakakses;  // Mengupdate username
//         $user->save();  // Simpan perubahan pada user

//         if ($user->guru_id !== null) {
//             $guru = Guru::find($user->guru_id);
//             if ($guru) {
//                 $guru->Nama = $request->Nama;
//                 $guru->save();
//             }
//         } else {
//             $guru = new Guru();
//             $guru->Nama = $request->Nama;
//             $guru->save();
//             $user->guru_id = $guru->guru_id;
//             $user->save();
//         }

//         DB::commit();
//         session()->flash('success', 'Profil berhasil diperbarui');
//         return redirect()->back();  
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
    //     $user = Auth::user();
    //     $validator = Validator::make($request->all(), [
    //         'Nama' => 'required|string|max:50',
    //         'username' => 'required|string|max:50',
    //     ]);
    //     if ($validator->fails()) {
    //         session()->flash('error', 'Profil Gagal Diupdate');
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput(); 
    //     }
    //     try {
    //         DB::beginTransaction();
    //         if ($user->guru_id !== null) {
    //             $guru = Guru::find($user->guru_id);
    //             if ($guru) {
    //                 $guru->Nama = $request->Nama;
    //                 $guru->save();
    //             }
    //         } else {
    //             $guru = new Guru();
    //             $guru->Nama = $request->Nama;
    //             $guru->save();
    //             $user->guru_id = $guru->guru_id;
    //             $user->save();
    //         }
    //         DB::commit();
    //         session()->flash('success', 'Profil berhasil diperbarui');
    //         return redirect()->back();  
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
    //     $user = Auth::user();
    
    //     $validator = Validator::make($request->all(), [
    //         'guru_id' => 'required|exists:tb_guru,guru_id',
    //         'Nama' => 'required|string|max:255',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors()
    //         ], 400);
    //     }
    
    //     // Tambahkan pengecekan hak akses
    //     if ($user->hakakses !== 'SU') {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Anda tidak memiliki izin untuk melakukan update'
    //         ], 403);
    //     }
    
    //     try {
    //         DB::beginTransaction();
    
    //         $user->guru_id = $request->guru_id;
    //         $user->save();
    
    //         $guru = Guru::findOrFail($request->guru_id);
    //         $guru->Nama = $request->Nama;
    //         $guru->save();
    
    //         DB::commit();
    
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Profil berhasil diupdate',
    //             'user' => $user,
    //             'detail' => $guru
    //         ], 200);
    
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal update profil',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    // public function store(Request $request)
    // {

    //     $attributes = request()->validate([
    //         'name' => ['required', 'max:50'],
    //         'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
    //         'phone'     => ['max:50'],
    //         'location' => ['max:70'],
    //         'about_me'    => ['max:150'],
    //     ]);
    //     if($request->get('email') != Auth::user()->email)
    //     {
    //         if(env('IS_DEMO') && Auth::user()->id == 1)
    //         {
    //             return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

    //         }

    //     }
    //     else{
    //         $attribute = request()->validate([
    //             'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
    //         ]);
    //     }


    //     User::where('id',Auth::user()->id)
    //     ->update([
    //         'name'    => $attributes['name'],
    //         'email' => $attribute['email'],
    //         'phone'     => $attributes['phone'],
    //         'location' => $attributes['location'],
    //         'about_me'    => $attributes["about_me"],
    //     ]);


    //     return redirect('/user-profile')->with('success','Profile updated successfully');
    // }
}
// 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
// 'TempatLahir' => 'required|string|max:255',
// 'TanggalLahir' => 'required|date',
// 'Agama' => 'required|string|max:50',
// 'JenisKelamin' => 'required|in:Laki_laki,Perempuan', // L = Laki-laki, P = Perempuan
// 'StatusPegawai' => 'required|string|max:50',
// 'NipNips' => 'nullable|string|max:50',
// 'Nuptk' => 'nullable|string|max:50',
// 'Nik' => 'nullable|string|max:16',
// 'Npwp' => 'nullable|string|max:15',
// 'NomorSertifikatPendidik' => 'nullable|string|max:50',
// 'TahunSertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
// 'pangkatgt' => 'nullable|string|max:50',
// 'jadwalkenaikanpangkat' => 'nullable|date',
// 'jadwalkenaikangaji' => 'nullable|date',
// 'TMT' => 'nullable|date',
// 'PendidikanAkhir' => 'nullable|string|max:50',
// 'TahunTamat' => 'nullable|integer|min:1900|max:' . date('Y'),
// 'Jurusan' => 'nullable|string|max:100',
// 'TugasMengajar' => 'nullable|string|max:255',
// 'TugasTambahan' => 'nullable|string|max:255',
// 'JamPerMinggu' => 'nullable|integer|min:0',
// 'TahunPensiun' => 'nullable|integer|min:1900|max:' . (date('Y') + 50),
// 'Berkala' => 'nullable|string|max:50',
// 'Pangkat' => 'nullable|string|max:50',
// 'Jabatan' => 'nullable|string|max:50',
// 'NomorTelephone' => 'nullable|string|max:15',
// 'Alamat' => 'nullable|string|max:255',
// 'Email' => 'nullable|email|max:255',
// 'status' => 'required|boolean',



// 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
// 'TempatLahir' => 'required|string|max:255',
// 'TanggalLahir' => 'required|date',
// 'Agama' => 'required|string|max:50',
// 'JenisKelamin' => 'required|in:Laki_laki,Perempuan', // L = Laki-laki, P = Perempuan
// 'StatusPegawai' => 'required|string|max:50',
// 'NipNips' => 'nullable|string|max:50',
// 'Nuptk' => 'nullable|string|max:50',
// 'Nik' => 'nullable|string|max:16',
// 'Npwp' => 'nullable|string|max:15',
// 'NomorSertifikatPendidik' => 'nullable|string|max:50',
// 'TahunSertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
// 'pangkatgt' => 'nullable|string|max:50',
// 'jadwalkenaikanpangkat' => 'nullable|date',
// 'jadwalkenaikangaji' => 'nullable|date',
// 'TMT' => 'nullable|date',
// 'PendidikanAkhir' => 'nullable|string|max:50',
// 'TahunTamat' => 'nullable|integer|min:1900|max:' . date('Y'),
// 'Jurusan' => 'nullable|string|max:100',
// 'TugasMengajar' => 'nullable|string|max:255',
// 'TugasTambahan' => 'nullable|string|max:255',
// 'JamPerMinggu' => 'nullable|integer|min:0',
// 'TahunPensiun' => 'nullable|integer|min:1900|max:' . (date('Y') + 50),
// 'Berkala' => 'nullable|string|max:50',
// 'Pangkat' => 'nullable|string|max:50',
// 'Jabatan' => 'nullable|string|max:50',
// 'NomorTelephone' => 'nullable|string|max:15',
// 'Alamat' => 'nullable|string|max:255',
// 'Email' => 'nullable|email|max:255',
// 'status' => 'required|boolean',

// $guru->foto = $request->foto;
// $guru->TempatLahir = $request->TempatLahir;
// $guru->TanggalLahir = $request->TanggalLahir;
// $guru->Agama = $request->Agama;
// $guru->JenisKelamin = $request->JenisKelamin;
// $guru->StatusPegawai = $request->StatusPegawai;
// $guru->NipNips = $request->NipNips;
// $guru->Nuptk = $request->Nuptk;
// $guru->Nik = $request->Nik;
// $guru->Npwp = $request->Npwp;
// $guru->NomorSertifikatPendidik = $request->NomorSertifikatPendidik;
// $guru->TahunSertifikasi = $request->TahunSertifikasi;
// $guru->pangkatgt = $request->pangkatgt;
// $guru->jadwalkenaikanpangkat = $request->jadwalkenaikanpangkat;
// $guru->jadwalkenaikangaji = $request->jadwalkenaikangaji;
// $guru->TMT = $request->TMT;
// $guru->PendidikanAkhir = $request->PendidikanAkhir;
// $guru->TahunTamat = $request->TahunTamat;
// $guru->Jurusan = $request->Jurusan;
// $guru->TugasMengajar = $request->TugasMengajar;
// $guru->TugasTambahan = $request->TugasTambahan;
// $guru->JamPerMinggu = $request->JamPerMinggu;
// $guru->TahunPensiun = $request->TahunPensiun;
// $guru->Berkala = $request->Berkala;
// $guru->Pangkat = $request->Pangkat;
// $guru->Jabatan = $request->Jabatan;
// $guru->NomorTelephone = $request->NomorTelephone;
// $guru->Alamat = $request->Alamat;
// $guru->Email = $request->Email;
// $guru->status = $request->status;



// <?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\View;

// class InfoUserController extends Controller
// {

//     public function create()
//     {
//         return view('laravel-examples/user-profile');
//     }

//     public function store(Request $request)
//     {

//         $attributes = request()->validate([
//             'name' => ['required', 'max:50'],
//             'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
//             'phone'     => ['max:50'],
//             'location' => ['max:70'],
//             'about_me'    => ['max:150'],
//         ]);
//         if($request->get('email') != Auth::user()->email)
//         {
//             if(env('IS_DEMO') && Auth::user()->id == 1)
//             {
//                 return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
                
//             }
            
//         }
//         else{
//             $attribute = request()->validate([
//                 'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
//             ]);
//         }
        
        
//         User::where('id',Auth::user()->id)
//         ->update([
//             'name'    => $attributes['name'],
//             'email' => $attribute['email'],
//             'phone'     => $attributes['phone'],
//             'location' => $attributes['location'],
//             'about_me'    => $attributes["about_me"],
//         ]);


//         return redirect('/user-profile')->with('success','Profile updated successfully');
//     }
// }
