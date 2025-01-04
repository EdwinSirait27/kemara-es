<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Organisasi;
use App\Models\Organisasisiswa;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;


use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


class OrganisasisiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Organisasisiswa.Organisasisiswa');

    }
    public function getOrganisasisiswa()
    {
        $organisasisiswa = Organisasisiswa::with('Organisasi','User')->select(['id', 'organisasi_id'])
        ->get()
        // <a href="' . route('Kelassiswa.previewekstrasiswa', $ekstrasiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Preview Mata Pelajaran">
        //        <i class="fas fa-upload text-primary"></i>
        //        </a>
            ->map(function ($organisasisiswa) {
                $organisasisiswa->id_hashed = substr(hash('sha256', $organisasisiswa->id . env('APP_KEY')), 0, 8);
                $organisasisiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $organisasisiswa->id_hashed . '">';
                $organisasisiswa->action = '
            <a href="' . route('Organisasisiswa.show', $organisasisiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="lihat detail">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>
            <a href="' . route('Organisasisiswa.downloadorganisasisiswa', $organisasisiswa->id_hashed) . '"  class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download Organisasi siswa Siswa
                    </a>';
            $organisasisiswa->Guru_Nama = $organisasisiswa->Organisasi->Guru ? $organisasisiswa->Organisasi->Guru->Nama : '-';
            $organisasisiswa->Organisasi_Nama = $organisasisiswa->Organisasi->namaekstra ? $organisasisiswa->Organisasi->namaorganisasi : '-';
            $organisasisiswa->Kap_Nama = $organisasisiswa->Organisasi->kapasitas ? $organisasisiswa->Organisasi->kapasitas : '-';
            
                return $organisasisiswa;
            });
        return DataTables::of($organisasisiswa)
        ->addColumn('Nama', function ($organisasisiswa) {
            return $organisasisiswa->Organisasi->Guru->Nama;
        })
        ->addColumn('namaorganisasi', function ($organisasisiswa) {
            return $organisasisiswa->Organisasi->namaorganisasi;
        })
        ->addColumn('kapasitas', function ($organisasisiswa) {
            return $organisasisiswa->Organisasi->kapasitas;
        })
       
        
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function previeworganisasisiswa($hashedId)
    {
        $organisasisiswa = Organisasisiswa::with('User', 'Organisasi')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasisiswa) {
            return redirect()->route('Organisasisiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahsiswa = Organisasisiswa::where('id', $organisasisiswa->id)
        ->get()
        ->unique('siswa_id')
        ->count(); 
        return view('Organisasisiswa.show', compact( 'jumlahsiswa', 'organisasisiswa'));
    }
    public function downloadorganisasisiswa($hashedId)
    {
        $organisasisiswa = Organisasisiswa::with('Organisasi', 'User')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$organisasisiswa) {
            return redirect()->route('Organisasisiswa.index')->withErrors(['Data tidak ditemukan.']);
        }

        $jumlahsiswa = Organisasisiswa::where('id', $organisasisiswa->id)
        ->get()
        ->unique('siswa_id') // Memastikan hanya siswa_id unik yang diambil
        ->count(); // Menghitung jumlah siswa unik
    
        $siswas = Organisasisiswa::with('User')
        ->where('id', $organisasisiswa->id)
        ->get()
        ->unique('id');
    

        // Generate PDF
        $pdf = PDF::loadView('Organisasisiswa.downloadorganisasisiswa', compact( 'siswas','jumlahsiswa', 'organisasisiswa'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

                   $fileName = 'data-organisasi-siswa-' . $organisasisiswa->Organisasi->namaorganisasi.  '.pdf';

               return $pdf->download($fileName);
    }


}
