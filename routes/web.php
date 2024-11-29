<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
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

   

// 	Route::get('billing', function () {
// 		return view('billing');
// 	})->name('billing');

// 	Route::get('profile', function () {
// 		return view('profile');
// 	})->name('profile');

// 	Route::get('rtl', function () {
// 		return view('rtl');
// 	})->name('rtl');

// 	Route::get('user-management', function () {
// 		return view('laravel-examples/user-management');
// 	})->name('user-management');

// 	Route::get('tables', function () {
// 		return view('tables');
// 	})->name('tables');

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

    
    Route::get('dashboardSU', function () {
        return view('dashboardSU');  // Halaman untuk SU
    })->middleware('can:isSU');
	Route::get('/user-profile', [InfoUserController::class, 'create'])->middleware('can:isSU');
	Route::post('/user-profile', [InfoUserController::class, 'store'])->middleware('can:isSU');

    Route::get('dashboard-guru', function () {
        return view('dashboard-guru');  // Halaman untuk Guru
    })->middleware('can:isGuru');

    Route::get('dashboard-siswa', function () {
        return view('dashboard-siswa');  // Halaman untuk Siswa
    })->middleware('can:isSiswa');
});

// Halaman login hanya dapat diakses oleh pengguna yang belum login
Route::middleware('guest')->get('/login', function () {
    return view('session/login-session');
})->name('login');
