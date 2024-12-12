<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Rules\NoXSSInput;
use App\Models\Tombol;
use Carbon\Carbon;
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
            $currentDateTime = Carbon::now(); // Tanggal dan waktu saat ini
            $tombol = Tombol::where('start_date', '<=', $currentDateTime)
                            ->where('end_date', '>=', $currentDateTime)
                            ->first(); // Ambil satu tombol yang aktif
        
            return view('session.login-session', compact('tombol'));
        }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => [
                'required',
                'string',
                'min:7',
                'max:12',
                'regex:/^[a-zA-Z0-9_-]+$/',
                new NoXSSInput()
            ],
            'password' => [
                'required',
                'string',
                'min:7',
                'max:15',
                new NoXSSInput()
            ],
        ]);
    
        $rateLimiterKey = "login:{$request->ip()}:{$request->username}";
    
        if (RateLimiter::tooManyAttempts($rateLimiterKey, 5)) {
            Log::warning("Rate limiter triggered for username: {$request->username}");
            return back()->withErrors(['login' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.']);
        }
        
        try {
            if (Auth::attempt($attributes, $request->boolean('remember'))) {
                $request->session()->regenerate();
                Log::info("Successful login for username: {$request->username}");
        
                // Clear rate limiter on success
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
                return redirect('Login.create')->with(['error' => 'Akses tidak diizinkan.']);
            }
        
            Log::warning("Failed login attempt for username: {$request->username}");
            RateLimiter::hit($rateLimiterKey, 60); // Expire in 60 seconds
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

    //     $rateLimiterKey = "login:{$request->ip()}:{$request->username}";

    //     if (RateLimiter::tooManyAttempts($rateLimiterKey, 5)) {
    //         Log::warning("Multiple login attempts for username: {$request->username}");
    //         return back()->withErrors(['login' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.']);
    //     }

    //     try {
    //         if (Auth::attempt($attributes, $request->boolean('remember'))) {
    //             $request->session()->regenerate();
    //             Log::info("Successful login for username: {$request->username}");

    //             RateLimiter::clear($rateLimiterKey);

    //             $user = Auth::user();
    //             $dashboards = [
    //                 'isSU' => 'dashboardSU',
    //                 'isGuru' => 'dashboardGuru',
    //                 'isSiswa' => 'dashboardSiswa',
    //                 'isKepalaSekolah' => 'dashboardKepalaSekolah',
    //                 'isNonSiswa' => 'dashboardNonSiswa',
    //                 'isKurikulum' => 'dashboardKurikulum',
    //                 'isAdmin' => 'dashboardAdmin',
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
    //         RateLimiter::hit($rateLimiterKey);
    //         return back()->withErrors(['login' => 'Username atau Password salah.']);
    //     } catch (\Exception $e) {
    //         Log::error("Login error: " . $e->getMessage());
    //         return back()->withErrors(['login' => 'Terjadi kesalahan. Silakan coba lagi.']);
    //     }
    // }

   

    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
