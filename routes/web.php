<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardControllerSU;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InfoUserControllerAdmin;
use App\Http\Controllers\InfoUserControllerKepalaSekolah;
use App\Http\Controllers\InfoUserControllerKurikulum;
use App\Http\Controllers\InfoUserControllerGuru;
use App\Http\Controllers\InfoUserControllerSiswa;
use App\Http\Controllers\InfoUserControllerNonSiswa;
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
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::match(['GET', 'POST'], '/logout', [SessionsController::class, 'destroy'])
        ->name('logout')
        ->middleware('auth');
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

    Route::get('/dashboardSU', [DashboardControllerSU::class, 'index'])->name('dashboardSU.index')->middleware('can:isSU');
    Route::get('/users/data', [DashboardControllerSU::class, 'getUsers'])->name('users.data')->middleware('can:isSU');
    Route::delete('/users/delete', [DashboardControllerSU::class, 'deleteUsers'])->name('users.delete')->middleware('can:isSU');
    // Route::get('Das/create', [DashboardControllerSU::class, 'create'])->name('users.create');
    Route::get('/user-profileSU', [InfoUserController::class, 'create'])->name('user-profileSU.create')->middleware('can:isSU');
    Route::put('/user-profileSU', [InfoUserController::class, 'store'])->name('user-profileSU.store')->middleware('can:isSU');
    
    // Route::get('dashboardSU/create', [InfoUserController::class, 'create'])->name('dashboardSU.create')->middleware('can:isSU');
    Route::get('dashboardSU/create', [DashboardControllerSU::class, 'create'])->name('dashboardSU.create')->middleware('can:isSU');
    Route::post('/dashboardSU', [DashboardControllerSU::class, 'store'])->name('dashboardSU.store')->middleware('can:isSU');
    // Route::get('/dashboardSU/{id}/edit', [DashboardControllerSU::class, 'edit'])->name('dashboardSU.edit')->middleware('can:isSU');
    Route::get('/dashboardSU/{id}/edit', [DashboardControllerSU::class, 'edit'])
        ->name('dashboardSU.edit')
        ->middleware('can:isSU');

    // Rute untuk menyimpan perubahan pada data
    Route::put('/dashboardSU/{id}', [DashboardControllerSU::class, 'update'])
        ->name('dashboardSU.update')
        ->middleware('can:isSU');

        // Admin
        Route::get('/dashboardAdmin', [DashboardControllerAdmin::class, 'index'])->name('dashboardAdmin.index')->middleware('can:isAdmin');

        Route::get('/user-profileAdmin', [InfoUserControllerAdmin::class, 'create'])->name('user-profileAdmin.create')->middleware('can:isAdmin');
        Route::put('/user-profileAdmin', [InfoUserControllerAdmin::class, 'store'])->name('user-profileAdmin.store')->middleware('can:isAdmin');


    // Kepala Sekolah
    Route::get('dashboardKepalaSekolah', function () {
        return view('dashboardKepalaSekolah');  // Halaman untuk Guru
    })->middleware('can:isKepalaSekolah');
    Route::get('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'create'])->name('user-profileKepalaSekolah.create')->middleware('can:isKepalaSekolah');
        Route::put('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'store'])->name('user-profileKepalaSekolah.store')->middleware('can:isKepalaSekolah');


    // Kurikulum
    Route::get('dashboardKurikulum', function () {
        return view('dashboardKurikulum');  // Halaman untuk Siswa
    })->middleware('can:isKurikulum');
    Route::get('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'create'])->name('user-profileKurikulum.create')->middleware('can:isKurikulum');
    Route::put('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'store'])->name('user-profileKurikulum.store')->middleware('can:isKurikulum');

    // Guru
    Route::get('dashboardGuru', function () {
        return view('dashboardGuru');  // Halaman untuk Siswa
    })->middleware('can:isGuru');
    Route::get('/user-profileGuru', [InfoUserControllerGuru::class, 'create'])->name('user-profileGuru.create')->middleware('can:isGuru');
        Route::put('/user-profileGuru', [InfoUserControllerGuru::class, 'store'])->name('user-profileGuru.store')->middleware('can:isGuru');

    // Siswa
    Route::get('dashboardSiswa', function () {
        return view('dashboardSiswa');  // Halaman untuk Siswa
    })->middleware('can:isSiswa');
    Route::get('/user-profileSiswa', [InfoUserControllerSiswa::class, 'create'])->middleware('can:isSiswa');
    Route::post('/user-profileSiswa', [InfoUserControllerSiswa::class, 'store'])->middleware('can:isSiswa');

    // Calon Siswa
    Route::get('dashboardNonSiswa', function () {
        return view('dashboardNonSiswa');  // Halaman untuk Siswa
    })->middleware('can:isNonSiswa');
    Route::get('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'create'])->middleware('can:isNonSiswa');
    Route::post('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'store'])->middleware('can:isNonSiswa');

});

// Halaman login hanya dapat diakses oleh pengguna yang belum login
Route::middleware('guest')->get('/login', function () {
    return view('session/login-session');
})->name('login');
