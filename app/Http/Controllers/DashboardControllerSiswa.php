<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardControllerSiswa extends Controller
{
    public function index()
    {
        return view('dashboardSiswa.index');

    }
}
