<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;



class PengumumanController extends Controller
{
    public function downloadPengumuman($id)
{
    $pengumuman = Pengumuman::findOrFail($id);

    if ($pengumuman->pengumuman && Storage::exists('public/pengumuman/' . $pengumuman->pengumuman)) {
        return Storage::download('public/pengumuman/' . $pengumuman->pengumuman);
    }

    return redirect()->back()->with('error', 'File not found.');
}
}
