<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileSekolahController extends Controller
{
    public function profile()
    {
        return view('Profile/index');

    }
    public function beranda()
    {
        return view('Beranda/index');

    }
}
