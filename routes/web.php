<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardControllerNonSiswa;
use App\Http\Controllers\DashboardControllerSU;
use App\Http\Controllers\DashboardControllerSUSiswa;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\DashboardControllerKepalaSekolah;
use App\Http\Controllers\DashboardControllerKurikulum;
use App\Http\Controllers\DashboardControllerGuru;
use App\Http\Controllers\DashboardControllerSiswa;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InfoUserControllerAdmin;
use App\Http\Controllers\InfoUserControllerKepalaSekolah;
use App\Http\Controllers\InfoUserControllerKurikulum;
use App\Http\Controllers\InfoUserControllerGuru;
use App\Http\Controllers\InfoUserControllerSiswa;
use App\Http\Controllers\InfoUserControllerNonSiswa;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\TahunakademikController;
use App\Http\Controllers\TombolController;
use App\Http\Controllers\MatapelajaranController;
use App\Http\Controllers\KelasController;
// use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\KGSNController;
use App\Http\Controllers\DatasiswaController;
use App\Http\Controllers\DataguruController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\OsisController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AdminKepalaSekolahController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::group(['middleware' => 'auth'], function () {





//     Route::get('virtual-reality', function () {
// 		return view('virtual-reality');
// 	})->name('virtual-reality');

//     Route::get('static-sign-in', function () {
// 		return view('static-sign-in');
// 	})->name('sign-in');

//     Route::get('static-sign-up', function () {
// 		return view('static-sign-up');
// 	})->name('sign-up');

//     // Route::get('/logout', [SessionsController::class, 'destroy']);
// 	  Route::match(['GET', 'POST'], '/logout', [SessionsController::class, 'destroy'])
//         ->name('logout')
//         ->middleware('auth');
// 	Route::get('/user-profile', [InfoUserController::class, 'create']);
// 	Route::post('/user-profile', [InfoUserController::class, 'store']);
// });
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    // Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});
// routes semua roles
Route::middleware(['auth','can:isSemua','prevent.xss'])->group(function () {
    Route::get('/pengumuman/download/{id}', [PengumumanController::class, 'downloadPengumuman'])->name('download.pengumuman');
    Route::get('/Dataguru', [DataguruController::class, 'index'])->name('Dataguru.index');
    Route::get('/Datasiswa', [DatasiswaController::class, 'index'])->name('Datasiswa.index');

    
   });
   // route kurikulum, guru, siswa, nonsiswa
Route::middleware(['auth','can:isKGSN','prevent.xss'])->group(function () {
    
    Route::get('/pengumumansemua/data', [KGSNController::class, 'getPengumumanKGSN'])->name('pengumumansemua.data');
    
    
   });
//    voting su kepsek siswa guru kur admin
Route::middleware(['auth','can:isvoting','prevent.xss'])->group(function () {
    
Route::get('/Voting', [VotingController::class, 'index'])->name('Voting.index');
Route::post('/Voting', [VotingController::class, 'store'])->name('Voting.store');

    
   });

//    adminkepalasekolah
Route::middleware(['auth','can:isAdminKepalaSekolah','prevent.xss'])->group(function () {
    Route::get('/pengumuman/data', [AdminKepalaSekolahController::class, 'getPengumuman'])->name('pengumuman.data');
    Route::post('/dashboardAdmin/store', [AdminKepalaSekolahController::class, 'store'])->name('dashboardAdmin.store');
    Route::post('/dashboardKepalaSekolah/store', [AdminKepalaSekolahController::class, 'storeKP'])->name('dashboardKepalaSekolah.store');
    Route::delete('/pengumuman/delete', [AdminKepalaSekolahController::class, 'deletePengumuman'])->name('pengumuman.delete');
    //kurikulum
    Route::get('/Kurikulum', [KurikulumController::class, 'index'])->name('Kurikulum.index');
    Route::get('/kurikulum/datakurikulum', [KurikulumController::class, 'getUsers'])->name('kurikulum.datakurikulum');
    Route::delete('/kurikulum/delete', [KurikulumController::class, 'deleteUsers'])->name('kurikulum.delete');
    Route::get('Kurikulum/create', [KurikulumController::class, 'create'])->name('Kurikulum.create');
    Route::post('/Kurikulum', [KurikulumController::class, 'store'])->name('Kurikulum.store');
Route::get('/Kurikulum/edit/{hashedId}', [KurikulumController::class, 'edit'])->name('Kurikulum.edit');
Route::put('/Kurikulum/{hashedId}', [KurikulumController::class, 'update'])->name('Kurikulum.update');
// Tahunakademik
Route::get('/Tahunakademik', [TahunakademikController::class, 'index'])->name('Tahunakademik.index');
    Route::get('/Tahunakademik/datatahunakademik', [TahunakademikController::class, 'getTahunakademik'])->name('tahunakademik.datatahunakademik');
    Route::delete('/Tahunakademik/delete', [TahunakademikController::class, 'deleteTahunakademik'])->name('tahunakademik.delete');
    Route::get('Tahunakademik/create', [TahunakademikController::class, 'create'])->name('Tahunakademik.create');
    Route::post('/Tahunakademik', [TahunakademikController::class, 'store'])->name('Tahunakademik.store');
Route::get('/Tahunakademik/edit/{hashedId}', [TahunakademikController::class, 'edit'])->name('Tahunakademik.edit');
Route::put('/Tahunakademik/{hashedId}', [TahunakademikController::class, 'update'])->name('Tahunakademik.update');
//matapelajaran
Route::get('/Matapelajaran', [MatapelajaranController::class, 'index'])->name('Matapelajaran.index');
    Route::get('/Matapelajaran/datamatapelajaran', [MatapelajaranController::class, 'getMatapelajaran'])->name('matapelajaran.datamatapelajaran');
    Route::delete('/Matapelajaran/delete', [MatapelajaranController::class, 'deleteMatapelajaran'])->name('matapelajaran.delete');
    Route::get('Matapelajaran/create', [MatapelajaranController::class, 'create'])->name('Matapelajaran.create');
    Route::post('/Matapelajaran', [MatapelajaranController::class, 'store'])->name('Matapelajaran.store');
Route::get('/Matapelajaran/edit/{hashedId}', [MatapelajaranController::class, 'edit'])->name('Matapelajaran.edit');
Route::put('/Matapelajaran/{hashedId}', [MatapelajaranController::class, 'update'])->name('Matapelajaran.update');
//kelas
Route::get('/Kelas', [KelasController::class, 'index'])->name('Kelas.index');
    Route::get('/Kelas/datakelas', [KelasController::class, 'getKelas'])->name('kelas.datakelas');
    Route::delete('/Kelas/delete', [KelasController::class, 'deleteKelas'])->name('kelas.delete');
    Route::get('Kelas/create', [KelasController::class, 'create'])->name('Kelas.create');
    Route::post('/Kelas', [KelasController::class, 'store'])->name('Kelas.store');
Route::get('/Kelas/edit/{hashedId}', [KelasController::class, 'edit'])->name('Kelas.edit');
Route::put('/Kelas/{hashedId}', [KelasController::class, 'update'])->name('Kelas.update');
//ekstrakulikuler
Route::get('/Ekstrakulikuler', [EkstrakulikulerController::class, 'index'])->name('Ekstrakulikuler.index');
    Route::get('/Ekstrakulikuler/dataekstrakulikuler', [EkstrakulikulerController::class, 'getEkstrakulikuler'])->name('ekstrakulikuler.dataekstrakulikuler');
    Route::delete('/Ekstrakulikuler/delete', [EkstrakulikulerController::class, 'deleteekstrakulikuler'])->name('ekstrakulikuler.delete');
    Route::get('Ekstrakulikuler/create', [EkstrakulikulerController::class, 'create'])->name('Ekstrakulikuler.create');
    Route::post('/Ekstrakulikuler', [EkstrakulikulerController::class, 'store'])->name('Ekstrakulikuler.store');
Route::get('/Ekstrakulikuler/edit/{hashedId}', [EkstrakulikulerController::class, 'edit'])->name('Ekstrakulikuler.edit');
Route::put('/Ekstrakulikuler/{hashedId}', [EkstrakulikulerController::class, 'update'])->name('Ekstrakulikuler.update');
//organisasi
Route::get('/Organisasi', [OrganisasiController::class, 'index'])->name('Organisasi.index');
    Route::get('/Organisasi/dataorganisasi', [OrganisasiController::class, 'getOrganisasi'])->name('organisasi.dataorganisasi');
    Route::delete('/Organisasi/delete', [OrganisasiController::class, 'deleteOrganisasi'])->name('organisasi.delete');
    Route::get('Organisasi/create', [OrganisasiController::class, 'create'])->name('Organisasi.create');
    Route::post('/Organisasi', [OrganisasiController::class, 'store'])->name('Organisasi.store');
Route::get('/Organisasi/edit/{hashedId}', [OrganisasiController::class, 'edit'])->name('Organisasi.edit');
Route::put('/Organisasi/{hashedId}', [OrganisasiController::class, 'update'])->name('Organisasi.update');
//tombol
Route::get('/Tombol', [TombolController::class, 'index'])->name('Tombol.index');
    Route::get('/Tombol/datatombol', [TombolController::class, 'getTombol'])->name('tombol.datatombol');
    Route::delete('/Tombol/delete', [TombolController::class, 'deleteTombol'])->name('tombol.delete');
    Route::get('Tombol/create', [TombolController::class, 'create'])->name('Tombol.create');
    Route::post('/Tombol', [TombolController::class, 'store'])->name('Tombol.store');
Route::get('/Tombol/edit/{hashedId}', [TombolController::class, 'edit'])->name('Tombol.edit');
Route::put('/Tombol/{hashedId}', [TombolController::class, 'update'])->name('Tombol.update');
//Osis
Route::get('/Osis', [OsisController::class, 'index'])->name('Osis.index');
    Route::get('/Osis/dataosis', [OsisController::class, 'getOsis'])->name('osis.dataosis');
    Route::delete('/Osis/delete', [OsisController::class, 'deleteOsis'])->name('osis.delete');
    Route::get('Osis/create', [OsisController::class, 'create'])->name('Osis.create');
    Route::post('/Osis', [OsisController::class, 'store'])->name('Osis.store');
Route::get('/Osis/edit/{hashedId}', [OsisController::class, 'edit'])->name('Osis.edit');
Route::put('/Osis/{hashedId}', [OsisController::class, 'update'])->name('Osis.update');
// dataguru
Route::get('/dataguru/datadataguru', [DataguruController::class, 'getDataguru'])->name('dataguru.datadataguru');
Route::get('/Dataguru/edit/{hashedId}', [DataguruController::class, 'edit'])->name('Dataguru.edit');
Route::put('/Dataguru/{hashedId}', [DataguruController::class, 'update'])->name('Dataguru.update');
// datasiswa
Route::get('/datasiswa/datadatasiswa', [DatasiswaController::class, 'getDatasiswa'])->name('datasiswa.datadatasiswa');
Route::get('/Datasiswa/edit/{hashedId}', [DatasiswaController::class, 'edit'])->name('Datasiswa.edit');
Route::put('/Datasiswa/{hashedId}', [DatasiswaController::class, 'update'])->name('Datasiswa.update');
Route::get('/Dataguruall', [DataguruController::class, 'indexGuruall'])->name('Dataguruall.index');
Route::get('/dataguruall/datadataguruall', [DataguruController::class, 'getDataguruall'])->name('dataguruall.datadataguruall');
Route::get('/Datasiswaall', [DatasiswaController::class, 'indexSiswaall'])->name('Datasiswaall.index');
Route::get('/datasiswaall/datadatasiswaall', [DatasiswaController::class, 'getDatasiswaall'])->name('datasiswaall.datadatasiswaall');

   
   });
Route::middleware(['auth','can:isSU','prevent.xss'])->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Route::get('/logout', [SessionsController::class, 'destroy']);
    
    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');

    Route::get('user-management', function () {
        return view('laravel-examples/user-management');
    })->name('user-management');

    Route::get('tables', function () {
        return view('tables');
    })->name('tables');
    // SU

    Route::get('/dashboardSU', [DashboardControllerSU::class, 'index'])->name('dashboardSU.index');
    Route::get('/users/dataguru', [DashboardControllerSU::class, 'getUsers'])->name('users.dataguru');
    Route::delete('/users/delete', [DashboardControllerSU::class, 'deleteUsers'])->name('users.delete');
    Route::get('/user-profileSU', [InfoUserController::class, 'create'])->name('user-profileSU.create');
    Route::put('/user-profileSU', [InfoUserController::class, 'store'])->name('user-profileSU.store'); 
    Route::get('dashboardSU/create', [DashboardControllerSU::class, 'create'])->name('dashboardSU.create');
    Route::post('/dashboardSU', [DashboardControllerSU::class, 'store'])->name('dashboardSU.store');
Route::get('/dashboardSU/edit1/{hashedId}', [DashboardControllerSU::class, 'edit'])->name('dashboardSU.edit1');
Route::put('/dashboardSU/{hashedId}', [DashboardControllerSU::class, 'update'])->name('dashboardSU.update');

//    SUSiswa
Route::get('/dashboardSUSiswa', [DashboardControllerSUSiswa::class, 'indexSiswa'])->name('dashboardSUSiswa.indexSiswa');
    Route::get('/users/data', [DashboardControllerSUSiswa::class, 'getUsersSiswa'])->name('users.data');
    Route::delete('/users/delete', [DashboardControllerSUSiswa::class, 'deleteUsersSiswa'])->name('users.delete');
   Route::get('dashboardSUSiswa/createSiswa', [DashboardControllerSUSiswa::class, 'createSiswa'])->name('dashboardSUSiswa.createSiswa');
    Route::post('/dashboardSUSiswa', [DashboardControllerSUSiswa::class, 'storeSiswa'])->name('dashboardSUSiswa.storeSiswa');
Route::get('/dashboardSUSiswa/editSiswa/{hashedId}', [DashboardControllerSUSiswa::class, 'editSiswa'])->name('dashboardSUSiswa.editSiswa');
Route::put('/dashboardSUSiswa/{hashedId}', [DashboardControllerSUSiswa::class, 'updateSiswa'])->name('dashboardSUSiswa.updateSiswa');


      
   
});
Route::middleware(['auth','can:isAdmin','prevent.xss'])->group(function () {
  // Admin
  Route::get('/dashboardAdmin', [DashboardControllerAdmin::class, 'index'])->name('dashboardAdmin.index');
 
  Route::get('/user-profileAdmin', [InfoUserControllerAdmin::class, 'create'])->name('user-profileAdmin.create');
  Route::put('/user-profileAdmin', [InfoUserControllerAdmin::class, 'store'])->name('user-profileAdmin.store');
  Route::get('billing', function () {
    return view('billing');
})->name('billing');

Route::get('profile', function () {
    return view('profile');
})->name('profile');

Route::get('rtl', function () {
    return view('rtl');
})->name('rtl');

Route::get('user-management', function () {
    return view('laravel-examples/user-management');
})->name('user-management');

Route::get('tables', function () {
    return view('tables');
})->name('tables');
});

// kurikulum



Route::middleware(['auth','can:isKepalaSekolah','prevent.xss'])->group(function () {
 // Kepala Sekolah
 Route::get('/dashboardKepalaSekolah', [DashboardControllerKepalaSekolah::class, 'index'])->name('dashboardKepalaSekolah.index');

Route::get('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'create'])->name('user-profileKepalaSekolah.create');
    Route::put('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'store'])->name('user-profileKepalaSekolah.store');


});
Route::middleware(['auth','can:isKurikulum','prevent.xss'])->group(function () {
// Kurikulum
Route::get('/dashboardKurikulum', [DashboardControllerKurikulum::class, 'index'])->name('dashboardKurikulum.index');

Route::get('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'create'])->name('user-profileKurikulum.create');
Route::put('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'store'])->name('user-profileKurikulum.store');

});
Route::middleware(['auth','can:isGuru','prevent.xss'])->group(function () {
    Route::get('/dashboardGuru', [DashboardControllerGuru::class, 'index'])->name('dashboardGuru.index');

    Route::get('/user-profileGuru', [InfoUserControllerGuru::class, 'create'])->name('user-profileGuru.create');
        Route::put('/user-profileGuru', [InfoUserControllerGuru::class, 'store'])->name('user-profileGuru.store');
    
});
Route::middleware(['auth','can:isSiswa','prevent.xss'])->group(function () {
    Route::get('/dashboardSiswa', [DashboardControllerSiswa::class, 'index'])->name('dashboardSiswa.index');

    Route::get('/user-profileSiswa', [InfoUserControllerSiswa::class, 'create'])->name('user-profileSiswa.create');
    Route::put('/user-profileSiswa', [InfoUserControllerSiswa::class, 'store'])->name('user-profileSiswa.store');
    
});
Route::middleware(['auth','can:isNonSiswa','prevent.xss'])->group(function () {
    Route::get('/dashboardNonSiswa', [DashboardControllerNonSiswa::class, 'index'])->name('dashboardNonSiswa.index');

    Route::get('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'create']);
    Route::post('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'store']);
    
});

// Halaman login hanya dapat diakses oleh pengguna yang belum login
// Route::middleware(['guest','prevent.xss'])->group(function () {
//     Route::get('/Login', [SessionsController::class, 'create'])->name('Login.create');
//     // return view('session/login-session');
// });

Route::middleware(['guest', 'prevent.xss'])->group(function () {
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::get('/Ppdb', [PpdbController::class, 'index'])->name('Ppdb.index');
    Route::post('/Ppdb', [PpdbController::class, 'store'])->name('Ppdb.store');
});

// Route::middleware('guest')->group(function () {
//     // Registrasi
    
//     Route::get('/login', [SessionsController::class, 'create'])->name('login');
//     Route::get('/Ppdb', [PpdbController::class, 'index'])->name('Ppdb.index');
//     Route::post('/Ppdb', [PpdbController::class, 'store'])->name('Ppdb.store');
    
// });

Route::match(['GET', 'POST'], '/logout', [SessionsController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth');





// Guru

// Siswa
// Route::get('dashboardSiswa', function () {
//     return view('dashboardSiswa');  // Halaman untuk Siswa
// })->middleware('can:isSiswa');

// Calon Siswa
