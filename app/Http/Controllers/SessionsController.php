<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Rules\NoXSSInput;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\PreventXSS;

use Illuminate\Support\Facades\RateLimiter;

class SessionsController extends Controller
{
    public function __construct()
{
    $this->middleware('prevent.xss');
}

    public function create()
    {
        return view('session.login-session');
    }
    public function store(Request $request)
{
    $attributes = $request->validate([
        'username' => [
            'required', 
            'string', 
            'min:3', 
            'max:255', 
            'regex:/^[a-zA-Z0-9_-]+$/',
            new NoXSSInput()
        ],
        'password' => [
            'required', 
            'string', 
            'min:7', 
            'max:255',
            new NoXSSInput()
        ],
    ]);

    $rateLimiterKey = "login:{$request->ip()}:{$request->username}";

    if (RateLimiter::tooManyAttempts($rateLimiterKey, 5)) {
        Log::warning("Multiple login attempts for username: {$request->username}");
        return back()->withErrors(['login' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.']);
    }

    try {
        if (Auth::attempt($attributes, $request->boolean('remember'))) {
            $request->session()->regenerate();
            Log::info("Successful login for username: {$request->username}");

            RateLimiter::clear($rateLimiterKey);

            $user = Auth::user();    
            $dashboards = [
                'isSU' => 'dashboardSU',
                'isGuru' => 'dashboardGuru',
                'isSiswa' => 'dashboardSiswa',
                'isKepalaSekolah' => 'dashboardKepalaSekolah',
                'isNonSiswa' => 'dashboardNonSiswa',
                'isKurikulum' => 'dashboardKurikulum',
                'isAdmin' => 'dashboardAdmin',
            ];

            foreach ($dashboards as $gate => $dashboard) {
                if (Gate::allows($gate, $user)) {
                    Log::info("User {$user->username} logged in with role: $gate");
                    return redirect($dashboard)->with(['success' => "Anda berhasil login sebagai $gate"]);
                }
            }

            Auth::logout();
            return redirect('login')->with(['error' => 'Akses tidak diizinkan.']);
        }

        Log::warning("Failed login attempt for username: {$request->username}");
        RateLimiter::hit($rateLimiterKey);
        return back()->withErrors(['login' => 'Username atau Password salah.']);
    } catch (\Exception $e) {
        Log::error("Login error: " . $e->getMessage());
        return back()->withErrors(['login' => 'Terjadi kesalahan. Silakan coba lagi.']);
    }
}

    // public function store(Request $request)
    // {
    //     $attributes = $request->validate([
    //         'username' => [
    //             'required', 
    //             'string', 
    //             'min:3', 
    //             'max:255', 
    //             'regex:/^[a-zA-Z0-9_-]+$/',
    //             new NoXSSInput()
    //         ],
    //         'password' => [
    //             'required', 
    //             'string', 
    //             'min:7', 
    //             'max:255',
    //             new NoXSSInput()
    //         ],
    //     ]);
    //     if (RateLimiter::tooManyAttempts($request->username, 5)) {
    //         Log::warning("Multiple login attempts for username: {$request->username}");
    //         return back()->withErrors(['login' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.']);
    //     }
    //     try {
    //         if (Auth::attempt($attributes, $request->boolean('remember'))) {
    //             $request->session()->regenerate();
    //             Log::info("Successful login for username: {$request->username}");
    //             $user = Auth::user();    
    //             $dashboards = [
    //                 'isSU' => 'dashboardSU',
    //             'isGuru' => 'dashboardGuru',
    //             'isSiswa' => 'dashboardSiswa',
    //             'isKepalaSekolah' => 'dashboardKepalaSekolah',
    //             'isNonSiswa' => 'dashboardNonSiswa',
    //             'isKurikulum' => 'dashboardKurikulum',
    //             'isAdmin' => 'dashboardAdmin',
    //             ];
    
    //             foreach ($dashboards as $gate => $dashboard) {
    //                 if (Gate::allows($gate, $user)) {
    //                     Log::info("User {$user->username} logged in with role: $gate");
    //                     return redirect($dashboard)->with(['success' => "Anda berhasil login sebagai $gate"]);
    //                 }
    //             }
    //             Auth::logout();
    //             return redirect('login')->with(['error' => 'Akses tidak diizinkan.']);
    //         }
    //         Log::warning("Failed login attempt for username: {$request->username}");
    //         return back()->withErrors(['login' => 'Username atau Password salah.']);
    //     } catch (\Exception $e) {
    //         Log::error("Login error: " . $e->getMessage());
    //         return back()->withErrors(['login' => 'Terjadi kesalahan. Silakan coba lagi.']);
    //     }
    // }

    
    

    // public function store(Request $request)
    // {
    //     $attributes = $request->validate([
    //         'username' => 'required|string|min:3|max:255',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     if (Auth::attempt($attributes)) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();

    //         // Mapping role ke dashboard
    //         $dashboards = [
    //             'isSU' => 'dashboardSU',
    //             'isGuru' => 'dashboardGuru',
    //             'isSiswa' => 'dashboardSiswa',
    //             'isKepalaSekolah' => 'dashboardKepalaSekolah',
    //             'isNonSiswa' => 'dashboardNonSiswa',
    //             'isKurikulum' => 'dashboardKurikulum',
    //             'isAdmin' => 'dashboardAdmin',
    //         ];

    //         foreach ($dashboards as $gate => $dashboard) {
    //             if (Gate::allows($gate, $user)) {
    //                 return redirect($dashboard)->with(['success' => "You are logged in as $gate."]);
    //             }
    //         }
    //         return redirect('login')->with(['error' => 'gak bhakakses tidak memenuhi.']);
    //     }

    //     return back()->withErrors(['login' => 'Username or Password invalid.']);
    // }
   
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
