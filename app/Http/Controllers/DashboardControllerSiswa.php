<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardControllerSiswa extends Controller
{
    public function __construct()
{
    $this->middleware('prevent.xss');
}
    public function index()
    {
        return view('dashboardSiswa.dashboardSiswa');

    }
    public function create()
    {
        return view('dashboardSiswa.create');
    }
}
