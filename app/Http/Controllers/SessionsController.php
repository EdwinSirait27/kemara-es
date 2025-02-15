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
        $ppdb = Tombol::where('url', 'Ppdb')
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first(); // Ambil data pertama yang sesuai
        return view('session.login-session', compact('ppdb'));
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
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:7',
                'max:12',
            ],
        ], [
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 12 karakter.',
            'password.min' => 'Username tidak boleh lebih dari 7 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.max' => 'Password tidak boleh lebih dari 12 karakter.',
            'password.min' => 'Password tidak boleh kurang dari 7 karakter.',
        ]);
    
        
        $rateLimiterKey = "login:{$request->ip()}:{$request->username}";
    
        if (RateLimiter::tooManyAttempts($rateLimiterKey, 10)) {
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
                return redirect('login')->with(['error' => 'Akses tidak diizinkan.']);
            }
        
            Log::warning("Failed login attempt for username: {$request->username}");
            RateLimiter::hit($rateLimiterKey, 60); // Expire in 60 seconds
            return back()->withErrors(['login' => 'Username atau Password salah.']);
        } catch (\Exception $e) {
            Log::error("Login error: " . $e->getMessage());
            return back()->withErrors(['login' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
        
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login');
    }
    public function index()
    {
        return view('profile/user-profileSU', compact('user', 'roles'));

    }

}
