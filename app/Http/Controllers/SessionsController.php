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

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($attributes)) {
            session()->regenerate();

            $user = Auth::user();
            
            // Pemeriksaan hak akses berdasarkan role pengguna
            if (Gate::allows('isSU', $user)) {
                return redirect('dashboardSU')->with(['success' => 'You are logged in as SU.']);
            }

            if (Gate::allows('isGuru', $user)) {
                return redirect('dashboard-guru')->with(['success' => 'You are logged in as Guru.']);
            }

            if (Gate::allows('isSiswa', $user)) {
                return redirect('dashboard-siswa')->with(['success' => 'You are logged in as Siswa.']);
            }

            return redirect('dashboard')->with(['success' => 'You are logged in.']);
        } else {
            return back()->withErrors(['username' => 'Username or Password invalid.']);
        }
    }
    // public function store()
    // {
    //     $attributes = request()->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);
        
    //     if (Auth::attempt($attributes)) {
    //         session()->regenerate();
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