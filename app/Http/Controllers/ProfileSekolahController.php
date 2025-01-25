<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Youtube;


class ProfileSekolahController extends Controller
{
    public function profile()
    {
        return view('Profile/index');

    }
    public function beranda()
    {
        $youtubeVideos = Youtube::where('status', 'Aktif')->get();
    
        // Kirim data ke view
        return view('Beranda/index', compact('youtubeVideos'));
    }
    
}
