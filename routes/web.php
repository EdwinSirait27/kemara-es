<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardControllerSU;
use App\Http\Controllers\DashboardControllerSUSiswa;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\DashboardControllerSiswa;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InfoUserControllerAdmin;
use App\Http\Controllers\InfoUserControllerKepalaSekolah;
use App\Http\Controllers\InfoUserControllerKurikulum;
use App\Http\Controllers\InfoUserControllerGuru;
use App\Http\Controllers\InfoUserControllerSiswa;
use App\Http\Controllers\InfoUserControllerNonSiswa;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
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
  Route::get('/pengumuman/data', [DashboardControllerAdmin::class, 'getPengumuman'])->name('pengumuman.data');
  Route::post('/dashboardAdmin/store', [DashboardControllerAdmin::class, 'store'])->name('dashboardAdmin.store');
  Route::delete('/pengumuman/delete', [DashboardControllerAdmin::class, 'deletePengumuman'])->name('pengumuman.delete');
  
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
Route::get('/Kurikulum', [KurikulumController::class, 'index'])->name('Kurikulum.index');
    Route::get('/kurikulum/datakurikulum', [KurikulumController::class, 'getUsers'])->name('kurikulum.datakurikulum');
    Route::delete('/kurikulum/delete', [KurikulumController::class, 'deleteUsers'])->name('kurikulum.delete');
    Route::get('Kurikulum/create', [KurikulumController::class, 'create'])->name('Kurikulum.create');
    Route::post('/Kurikulum', [KurikulumController::class, 'store'])->name('Kurikulum.store');
Route::get('/Kurikulum/edit/{hashedId}', [KurikulumController::class, 'edit'])->name('Kurikulum.edit');
Route::put('/Kurikulum/{hashedId}', [KurikulumController::class, 'update'])->name('Kurikulum.update');



Route::middleware(['auth','can:isKepalaSekolah','prevent.xss'])->group(function () {
 // Kepala Sekolah
 Route::get('dashboardKepalaSekolah', function () {
    return view('dashboardKepalaSekolah');  // Halaman untuk Guru
});
Route::get('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'create'])->name('user-profileKepalaSekolah.create');
    Route::put('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'store'])->name('user-profileKepalaSekolah.store');


});
Route::middleware(['auth','can:isKurikulum','prevent.xss'])->group(function () {
// Kurikulum
Route::get('dashboardKurikulum', function () {
    return view('dashboardKurikulum');  // Halaman untuk Siswa
});
Route::get('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'create'])->name('user-profileKurikulum.create');
Route::put('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'store'])->name('user-profileKurikulum.store');

});
Route::middleware(['auth','can:isGuru','prevent.xss'])->group(function () {
    Route::get('dashboardGuru', function () {
        return view('dashboardGuru');  // Halaman untuk Siswa
    })->middleware('can:isGuru');
    Route::get('/user-profileGuru', [InfoUserControllerGuru::class, 'create'])->name('user-profileGuru.create');
        Route::put('/user-profileGuru', [InfoUserControllerGuru::class, 'store'])->name('user-profileGuru.store');
    
});
Route::middleware(['auth','can:isSiswa','prevent.xss'])->group(function () {
    Route::get('/dashboardSiswa', [DashboardControllerSiswa::class, 'index'])->name('dashboardSiswa.index');

    Route::get('/user-profileSiswa', [InfoUserControllerSiswa::class, 'create'])->name('user-profileSiswa.create');
    Route::put('/user-profileSiswa', [InfoUserControllerSiswa::class, 'store'])->name('user-profileSiswa.store');
    
});
Route::middleware(['auth','can:isNonSiswa','prevent.xss'])->group(function () {
    Route::get('dashboardNonSiswa', function () {
        return view('dashboardNonSiswa');  // Halaman untuk Siswa
    })->middleware('can:isNonSiswa');
    Route::get('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'create']);
    Route::post('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'store']);
    
});

// Halaman login hanya dapat diakses oleh pengguna yang belum login
Route::middleware(['guest','prevent.xss'])->get('/login', function () {
    return view('session/login-session');
})->name('login');
Route::match(['GET', 'POST'], '/logout', [SessionsController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth');





// Guru

// Siswa
// Route::get('dashboardSiswa', function () {
//     return view('dashboardSiswa');  // Halaman untuk Siswa
// })->middleware('can:isSiswa');

// Calon Siswa
