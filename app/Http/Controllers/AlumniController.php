<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasippdb;

class AlumniController extends Controller
{
    public function Alumni()
    {
        $informasippdb = Informasippdb::where('status', 'Aktif')->first();
  
        
        return view('Alumni.index', compact('informasippdb'));
    }
}
