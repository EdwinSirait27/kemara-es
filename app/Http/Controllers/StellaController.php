<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StellaController extends Controller
{
    public function index(){
        return view('Stella.index');
    }
}
