<?php

namespace App\Http\Controllers;

use App\Models\Organisasisiswa;
use App\Rules\NoXSSInput;
use Illuminate\Http\Request;

use App\Models\Organisasi;
use App\Models\User;
use App\Models\Tombol;
use Yajra\DataTables\DataTables;


class OrganisasikuController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $tombol = Tombol::where('url', 'Organisasi-ku')
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();
        $users = User::where('id', auth()->id())->with('Siswa')->first();
        $organs = Organisasi::get();
        return view('Organisasi-ku.index',compact('organs','users','tombol'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['nullable', 'array','min:1', new NoXSSInput()],
            'organisasi_id' => ['required','array','min:1', new NoXSSInput()],
            'organisasi_id.*' => ['exists:tb_organisasi,id', new NoXSSInput()],
        ],
    [
        'organisasi_id.required' => 'Anda harus memilih salah satu dari organisasi.',

    ]);
        $userId = auth()->id();
        $existingOrganisasiIds = Organisasisiswa::where('user_id', $userId)->pluck('organisasi_id')->toArray();
        $newOrganisasiIds = array_diff($request->organisasi_id, $existingOrganisasiIds);
    
        // Simpan hanya ID yang baru
        foreach ($newOrganisasiIds as $organisasiId) {
            Organisasisiswa::create([
                'user_id' => $userId,
                'organisasi_id' => $organisasiId,
            ]);
        }
    
        return redirect()->route('Organisasi-ku.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }
    public function getOrganisasiku()
    {
        $userId = auth()->id();
    
        $organisasiku = Organisasisiswa::with('User.Siswa', 'Organisasi')
            ->where('user_id', $userId) // Hanya ambil data milik user yang sedang login
            ->select(['id', 'organisasi_id'])
            ->get()
            ->map(function ($organisasiku) {
                // Tambahkan properti Siswa_Nama dan Ekstra_Nama
                // $ekstraku->Siswa_Nama = $ekstraku->User->Siswa ? $ekstraku->User->Siswa->NamaLengkap : '-';
                $organisasiku->Organisasi_Nama = $organisasiku->Organisasi ? $organisasiku->Organisasi->namaorganisasi : '-';
                return $organisasiku;
            });
    
        return DataTables::of($organisasiku)
        // ->addColumn('NamaLengkap', function ($ekstraku) {
        //     return $ekstraku->Siswa->NamaLengkap;
        // })
        ->addColumn('namaorganisasi', function ($organisasiku) {
            return $organisasiku->Organisasi->namaorganisasi;
        })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
    public function deleteOrganisasiku(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
                    
        ]);
        Organisasisiswa::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Organisasi and their related data deleted successfully.'
        ]);
    }
}
