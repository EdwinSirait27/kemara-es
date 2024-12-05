<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }
    public function store(Request $request)
    {
        // Validasi input
        $attributes = $request->validate([
            'username' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Proses autentikasi
        if (Auth::attempt($attributes)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Mapping role ke dashboard
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
                    return redirect($dashboard)->with(['success' => "You are logged in as $gate."]);
                }
            }

            // Default dashboard jika tidak ada role yang cocok
            return redirect('dashboard')->with(['success' => 'You are logged in.']);
        }

        // Gagal login
        return back()->withErrors(['login' => 'Username or Password invalid.']);
    }
    // public function store()
    // {
    //     $attributes = request()->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);
        
    //     if (Auth::attempt($attributes)) {
    //         session()->regenerate();

    //         $user = Auth::user();
            
    //         // Pemeriksaan hak akses berdasarkan role pengguna
    //         if (Gate::allows('isSU', $user)) {
    //             return redirect('dashboardSU')->with(['success' => 'You are logged in as SU.']);
    //         }

    //         if (Gate::allows('isGuru', $user)) {
    //             return redirect('dashboardGuru')->with(['success' => 'You are logged in as Guru.']);
    //         }

    //         if (Gate::allows('isSiswa', $user)) {
    //             return redirect('dashboardSiswa')->with(['success' => 'You are logged in as Siswa.']);
    //         }
    //         if (Gate::allows('isKepalaSekolah', $user)) {
    //             return redirect('dashboardKepalaSekolah')->with(['success' => 'You are logged in as Kepala Sekolah.']);
    //         }
    //         if (Gate::allows('isNonSiswa', $user)) {
    //             return redirect('dashboardNonSiswa')->with(['success' => 'You are logged in as Non Siswa.']);
    //         }
    //         if (Gate::allows('isKurikulum', $user)) {
    //             return redirect('dashboardKurikulum')->with(['success' => 'You are logged in as Kurikulum.']);
    //         }
    //         if (Gate::allows('isAdmin', $user)) {
    //             return redirect('dashboardAdmin')->with(['success' => 'You are logged in as Admin.']);
    //         }

    //         return redirect('dashboard')->with(['success' => 'You are logged in.']);
    //     } else {
    //         return back()->withErrors(['username' => 'Username or Password invalid.']);
    //     }
    // }
   
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
