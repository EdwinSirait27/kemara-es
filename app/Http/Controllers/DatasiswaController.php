<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Datasiswa.Datasiswa');

    }
}
