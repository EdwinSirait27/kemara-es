<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Voting;

use App\Models\Ekstrasiswa;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;


use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


class EkstrasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Ekstrasiswa.Ekstrasiswa');

    }
    public function getEkstrasiswa()
    {
        $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler','User')->select(['id', 'ekstrakulikuler_id'])
        ->get()
        // <a href="' . route('Kelassiswa.previewekstrasiswa', $ekstrasiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Preview Mata Pelajaran">
        //        <i class="fas fa-upload text-primary"></i>
        //        </a>
            ->map(function ($ekstrasiswa) {
                $ekstrasiswa->id_hashed = substr(hash('sha256', $ekstrasiswa->id . env('APP_KEY')), 0, 8);
                $ekstrasiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrasiswa->id_hashed . '">';
                $ekstrasiswa->action = '
            <a href="' . route('Ekstrasiswa.show', $ekstrasiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="lihat detail">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>
            <a href="' . route('Ekstrasiswa.downloadekstrasiswa', $ekstrasiswa->id_hashed) . '"  class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download Ekstrakulikuler Siswa
                    </a>';
            $ekstrasiswa->Guru_Nama = $ekstrasiswa->Ekstrakulikuler->Guru ? $ekstrasiswa->Ekstrakulikuler->Guru->Nama : '-';
            $ekstrasiswa->Ekstra_Nama = $ekstrasiswa->Ekstrakulikuler->namaekstra ? $ekstrasiswa->Ekstrakulikuler->namaekstra : '-';
            $ekstrasiswa->Kap_Nama = $ekstrasiswa->Ekstrakulikuler->kapasitas ? $ekstrasiswa->Ekstrakulikuler->kapasitas : '-';
            
                return $ekstrasiswa;
            });
        return DataTables::of($ekstrasiswa)
        ->addColumn('Nama', function ($ekstrasiswa) {
            return $ekstrasiswa->Ekstrakulikuler->Guru->Nama;
        })
        ->addColumn('namaekstra', function ($ekstrasiswa) {
            return $ekstrasiswa->Ekstrakulikuler->namaekstra;
        })
        ->addColumn('kapasitas', function ($ekstrasiswa) {
            return $ekstrasiswa->Ekstrakulikuler->kapasitas;
        })
       
        
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function previewekstrasiswa($hashedId)
    {
        $ekstrasiswa = Ekstrasiswa::with('User', 'Ekstrakulikuler')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$ekstrasiswa) {
            return redirect()->route('Ekstrasiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahsiswa = Ekstrasiswa::where('id', $ekstrasiswa->id)
        ->get()
        ->unique('siswa_id')
        ->count(); 
        return view('Ekstrasiswa.show', compact( 'jumlahsiswa', 'ekstrasiswa'));
    }
    public function downloadekstrasiswa($hashedId)
    {
        $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler', 'User')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$ekstrasiswa) {
            return redirect()->route('Ekstrasiswa.index')->withErrors(['Data tidak ditemukan.']);
        }

        $jumlahsiswa = Ekstrasiswa::where('id', $ekstrasiswa->id)
        ->get()
        ->unique('siswa_id') // Memastikan hanya siswa_id unik yang diambil
        ->count(); // Menghitung jumlah siswa unik
    
        $siswas = Ekstrasiswa::with('User')
        ->where('id', $ekstrasiswa->id)
        ->get()
        ->unique('id');
    

        // Generate PDF
        $pdf = PDF::loadView('Ekstrasiswa.downloadekstrasiswa', compact( 'siswas','jumlahsiswa', 'ekstrasiswa'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

                   $fileName = 'data-ekstrakulikuler-siswa-' . $ekstrasiswa->Ekstrakulikuler->namaekstra.  '.pdf';

               return $pdf->download($fileName);
    }














}
