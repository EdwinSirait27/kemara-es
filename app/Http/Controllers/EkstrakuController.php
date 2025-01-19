<?php

namespace App\Http\Controllers;

use App\Rules\NoXSSInput;
use Illuminate\Http\Request;
use App\Models\Ekstrasiswa;
use App\Models\Ekstrakulikuler;
use App\Models\User;
use App\Models\Tombol;
use Yajra\DataTables\DataTables;




class EkstrakuController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $tombol = Tombol::where('url', 'Ekstra-ku')
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();
        $users = User::where('id', auth()->id())->with('Siswa')->first();
        $ekstras = Ekstrakulikuler::get();
        return view('Ekstra-ku.index',compact('ekstras','users','tombol'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['nullable', 'array','min:1', new NoXSSInput()],
            'ekstrakulikuler_id' => ['required','array','min:1', new NoXSSInput()],
            'ekstrakulikuler_id.*' => ['exists:tb_ekstrakulikuler,id', new NoXSSInput()],

        ],[
            'ekstrakulikuler_id.required' => 'Anda harus memilih salah satu dari ektrakulikuler.',
            // 'osis_id.max' => 'Hanya diperbolehkan memilih 1 kandidat.',
            // 'password.min' => 'Password tidak boleh kurang dari 7 karakter.',
    ]);
        $userId = auth()->id();
        $existingEkstraIds = Ekstrasiswa::where('user_id', $userId)->pluck('ekstrakulikuler_id')->toArray();
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
    public function getEkstraku()
    {
        $userId = auth()->id();
    
        $ekstraku = Ekstrasiswa::with('User.Siswa', 'Ekstrakulikuler')
            ->where('user_id', $userId) // Hanya ambil data milik user yang sedang login
            ->select(['id', 'ekstrakulikuler_id'])
            ->get()
            ->map(function ($ekstraku) {
                // Tambahkan properti Siswa_Nama dan Ekstra_Nama
                // $ekstraku->Siswa_Nama = $ekstraku->User->Siswa ? $ekstraku->User->Siswa->NamaLengkap : '-';
                $ekstraku->Ekstra_Nama = $ekstraku->Ekstrakulikuler ? $ekstraku->Ekstrakulikuler->namaekstra : '-';
                return $ekstraku;
            });
    
        return DataTables::of($ekstraku)
        // ->addColumn('NamaLengkap', function ($ekstraku) {
        //     return $ekstraku->Siswa->NamaLengkap;
        // })
        ->addColumn('namaekstra', function ($ekstraku) {
            return $ekstraku->Ekstrakulikuler->namaekstra;
        })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
    public function deleteEkstraku(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
                    
        ]);
        Ekstrasiswa::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Organisasi and their related data deleted successfully.'
        ]);
    }


}
