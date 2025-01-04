<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrasiswa;
use App\Models\Ekstrakulikuler;
use App\Models\User;


class EkstrakuController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $users = User::where('id', auth()->id())->with('Siswa')->first();
        $ekstras = Ekstrakulikuler::get();
        return view('Ekstra-ku.index',compact('ekstras','users'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'ekstrakulikuler_id' => 'required|array|min:1',
            'ekstrakulikuler_id.*' => 'exists:tb_ekstrakulikuler,id',
        ]);
    
        $userId = auth()->id();
    
        // Ambil ID ekstrakurikuler yang sudah ada untuk user ini
        $existingEkstraIds = Ekstrasiswa::where('user_id', $userId)->pluck('ekstrakulikuler_id')->toArray();
    
        // Filter hanya ID ekstrakurikuler baru yang belum ada di database
        $newEkstraIds = array_diff($request->ekstrakulikuler_id, $existingEkstraIds);
    
        // Simpan hanya ID yang baru
        foreach ($newEkstraIds as $ekstraId) {
            Ekstrasiswa::create([
                'user_id' => $userId,
                'ekstrakulikuler_id' => $ekstraId,
            ]);
        }
    
        return redirect()->route('Ekstra-ku.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }
    
//     public function store(Request $request)
// {
    
//     $request->validate([
//         'ekstrakulikuler_id' => 'required|array|min:1',
//         'ekstrakulikuler_id.*' => 'exists:tb_ekstrakulikuler,id',
//     ]);
//     $userId = auth()->id();
//     Ekstrasiswa::where('user_id', $userId)->delete();
//     foreach ($request->ekstrakulikuler_id as $ekstraId) {
//         Ekstrasiswa::create([
//             'user_id' => $userId,
//             'ekstrakulikuler_id' => $ekstraId,
//         ]);
//     }
//     return redirect()->route('Ekstra-ku.index')->with('success', 'Ekstrakulikuler berhasil diperbarui.');
// }



}
