<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Youtube;
use App\Models\Berita;
use App\Models\Profile;

use Illuminate\Support\Facades\Hash;


class ProfileSekolahController extends Controller
{
    public function Profile()
    {
        return view('Profile.index');

    }
    public function Beranda()
    {
        $youtubeVideos = Youtube::where('status', 'Aktif')->get();
        $profiles = Profile::where('status', 'Aktif')->get();
        $beritas = Berita::latest()->take(5)->get();
    
        $beritas->transform(function ($berita) {
            $berita->hashedId = substr(hash('sha256', $berita->id . env('APP_KEY')), 0, 8);
            return $berita;
        });
        $profiles->transform(function ($profile) {
            $profile->hashedId = substr(hash('sha256', $profile->id . env('APP_KEY')), 0, 8);
            return $profile;
        });
        return view('Beranda.index', compact('beritas','profiles','youtubeVideos'));
    }
    
    // public function Beranda()
    // {
    //     $youtubeVideos = Youtube::where('status', 'Aktif')->get();
    //     $beritas = Berita::all();

    //     // Contoh jika $hashedId adalah hasil hashing dari ID pertama Berita
    //     $hashedId = Hash::make($beritas->first()->id); // atau cara lain sesuai kebutuhanmu

    //     // Kirim data ke view
    //     return view('Beranda.index', compact('youtubeVideos','beritas','hashedId'));
    // }
    
  
}
