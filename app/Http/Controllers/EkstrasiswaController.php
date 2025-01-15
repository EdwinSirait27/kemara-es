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
    $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler', 'User')
        ->select(['id', 'ekstrakulikuler_id'])
        ->get()
        ->unique('ekstrakulikuler_id') // Menghapus duplikasi berdasarkan ekstrakulikuler_id
        ->map(function ($ekstrasiswa) {
            $ekstrasiswa->id_hashed = substr(hash('sha256', $ekstrasiswa->id . env('APP_KEY')), 0, 8);
            $ekstrasiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrasiswa->id_hashed . '">';
            $ekstrasiswa->action = '
                <a href="' . route('Ekstrasiswa.show', $ekstrasiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="lihat detail">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>
               <a href="' . route('Ekstrasiswa.download', $ekstrasiswa->id_hashed) . '" 
   class="mx-3" 
   data-bs-toggle="tooltip" 
   data-bs-original-title="Preview Absen" 
   target="_blank" 
   rel="noopener noreferrer">
   <i class="fas fa-upload text-primary"></i>
</a>

                <a href="' . route('Ekstrasiswa.downloadekstrasiswa', $ekstrasiswa->id_hashed) . '"  class="btn btn-primary btn-sm">
                    <i class="fas fa-download"></i> Download Ekstrakulikuler Siswa
                </a>
                ';
            $ekstrasiswa->Guru_Nama = $ekstrasiswa->Ekstrakulikuler->Guru ? $ekstrasiswa->Ekstrakulikuler->Guru->Nama : '-';
            $ekstrasiswa->Tahun_Nama = $ekstrasiswa->Ekstrakulikuler->Tahunakademik ? $ekstrasiswa->Ekstrakulikuler->Tahunakademik->tahunakademik : '-';
            $ekstrasiswa->Semester_Nama = $ekstrasiswa->Ekstrakulikuler->Tahunakademik ? $ekstrasiswa->Ekstrakulikuler->Tahunakademik->semester : '-';
            // $ekstrasiswa->Guru_Nama = $ekstrasiswa->Ekstrakulikuler->Guru ? $ekstrasiswa->Ekstrakulikuler->Guru->Nama : '-';
            $ekstrasiswa->Ekstra_Nama = $ekstrasiswa->Ekstrakulikuler->namaekstra ? $ekstrasiswa->Ekstrakulikuler->namaekstra : '-';
            $ekstrasiswa->Kap_Nama = $ekstrasiswa->Ekstrakulikuler->kapasitas ? $ekstrasiswa->Ekstrakulikuler->kapasitas : '-';
            
            return $ekstrasiswa;
        });

    return DataTables::of($ekstrasiswa)
        ->addColumn('Nama', function ($ekstrasiswa) {
            return $ekstrasiswa->Ekstrakulikuler->Guru->Nama;
        })
        ->addColumn('tahunakademik', function ($ekstrasiswa) {
            return $ekstrasiswa->Ekstrakulikuler->Tahunakademik->tahunakademik;
        })
        ->addColumn('semester', function ($ekstrasiswa) {
            return $ekstrasiswa->Ekstrakulikuler->Tahunakademik->semester;
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
    // Mengambil ekstrasiswa berdasarkan hashedId
    $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler', 'User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->get()
        ->filter(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        })->first();

    if (!$ekstrasiswa) {
        return redirect()->route('Ekstrasiswa.index')->withErrors(['Data tidak ditemukan.']);
    }

    // Menghitung jumlah siswa unik berdasarkan user_id
    $jumlahsiswa = Ekstrasiswa::where('ekstrakulikuler_id', $ekstrasiswa->ekstrakulikuler_id)
        ->distinct('user_id')
        ->count();

    // Mengambil daftar siswa yang unik berdasarkan user_id
    $siswas = Ekstrasiswa::with('User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->where('ekstrakulikuler_id', $ekstrasiswa->ekstrakulikuler_id)
        ->distinct('user_id')
        ->get();

    // Memproses data siswa untuk menambahkan nama lengkap dan kelas
    $siswasProcessed = $siswas->map(function ($siswa) {
        // Menambahkan nama lengkap siswa
        $siswa->NamaLengkap = $siswa->User->Siswa->NamaLengkap ?? 'N/A';

        // Menambahkan kelas siswa
        $pengaturankelassiswa = $siswa->User->Siswa->Pengaturankelassiswa->first();
        $siswa->Kelas = $pengaturankelassiswa ? $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? 'N/A' : 'N/A';

        return $siswa;
    });

    return view('Ekstrasiswa.download', compact('siswasProcessed', 'jumlahsiswa', 'ekstrasiswa'));
}

public function downloadekstrasiswa($hashedId)
    {
       
        $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler', 'User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->get()
        ->filter(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        })->first();

    if (!$ekstrasiswa) {
        return redirect()->route('Ekstrasiswa.index')->withErrors(['Data tidak ditemukan.']);
    }

    $jumlahsiswa = Ekstrasiswa::where('ekstrakulikuler_id', $ekstrasiswa->ekstrakulikuler_id)
        ->distinct('user_id')
        ->count();

    $siswas = Ekstrasiswa::with('User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->where('ekstrakulikuler_id', $ekstrasiswa->ekstrakulikuler_id)
        ->distinct('user_id')
        ->get();

    $siswasProcessed = $siswas->map(function ($siswa) {
        $siswa->NamaLengkap = $siswa->User->Siswa->NamaLengkap ?? 'N/A';
        $pengaturankelassiswa = $siswa->User->Siswa->Pengaturankelassiswa->first();
        $siswa->Kelas = $pengaturankelassiswa ? $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? 'N/A' : 'N/A';
        return $siswa;
    });
    

        $pdf = PDF::loadView('Ekstrasiswa.downloadekstrasiswa', compact( 'siswas','jumlahsiswa', 'ekstrasiswa','siswasProcessed'))
            ->setPaper('f4', 'potrait');
                   $fileName = 'data-absensi-ekstrakulikuler-' . $ekstrasiswa->Ekstrakulikuler->namaekstra . '-tahun akademik-' . $ekstrasiswa->Ekstrakulikuler->Tahunakademik->tahunakademik .  '.pdf';
               return $pdf->download($fileName);
    }
public function getEkstra($hashedId)
{
    $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler', 'User','Pengaturankelassiswa.Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$ekstrasiswa) {
        return redirect()->route('Ekstrasiswa.index')->withErrors(['Data tidak ditemukan.']);
    }
    $ekstras = Ekstrasiswa::with('User')
    ->where('ekstrakulikuler_id', $ekstrasiswa->ekstrakulikuler_id)
    ->get()
    ->unique('user_id');

    return datatables()->of($ekstras)
        ->addColumn('NamaLengkap', function ($row) {
            return $row->User->Siswa->NamaLengkap ?? '-';
        })
        ->addColumn('kelas', function ($row) {
            $pengaturankelassiswa = $row->User->Siswa->Pengaturankelassiswa->first();
            return $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? '-';
        })
        ->rawColumns(['checkbox'])
        ->make(true);

}
    // public function getEkstrasiswa()
    // {
    //     $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler','User')->select(['id', 'ekstrakulikuler_id'])
    //     ->get()
       
    //         ->map(function ($ekstrasiswa) {
    //             $ekstrasiswa->id_hashed = substr(hash('sha256', $ekstrasiswa->id . env('APP_KEY')), 0, 8);
    //             $ekstrasiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrasiswa->id_hashed . '">';
    //             $ekstrasiswa->action = '
    //         <a href="' . route('Ekstrasiswa.show', $ekstrasiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="lihat detail">
    //             <i class="fas fa-user-edit text-secondary"></i>
    //         </a>
    //         <a href="' . route('Ekstrasiswa.downloadekstrasiswa', $ekstrasiswa->id_hashed) . '"  class="btn btn-primary btn-sm">
    //                     <i class="fas fa-download"></i> Download Ekstrakulikuler Siswa
    //                 </a>';
    //         $ekstrasiswa->Guru_Nama = $ekstrasiswa->Ekstrakulikuler->Guru ? $ekstrasiswa->Ekstrakulikuler->Guru->Nama : '-';
    //         $ekstrasiswa->Ekstra_Nama = $ekstrasiswa->Ekstrakulikuler->namaekstra ? $ekstrasiswa->Ekstrakulikuler->namaekstra : '-';
    //         $ekstrasiswa->Kap_Nama = $ekstrasiswa->Ekstrakulikuler->kapasitas ? $ekstrasiswa->Ekstrakulikuler->kapasitas : '-';
            
    //             return $ekstrasiswa;
    //         });
    //     return DataTables::of($ekstrasiswa)
    //     ->addColumn('Nama', function ($ekstrasiswa) {
    //         return $ekstrasiswa->Ekstrakulikuler->Guru->Nama;
    //     })
    //     ->addColumn('namaekstra', function ($ekstrasiswa) {
    //         return $ekstrasiswa->Ekstrakulikuler->namaekstra;
    //     })
    //     ->addColumn('kapasitas', function ($ekstrasiswa) {
    //         return $ekstrasiswa->Ekstrakulikuler->kapasitas;
    //     })
    //         ->rawColumns(['checkbox', 'action'])
    //         ->make(true);

    // }
  
    public function show($hashedId)
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
        return view('Ekstrasiswa.show', compact( 'jumlahsiswa', 'ekstrasiswa','hashedId'));
    }
    // public function downloadekstrasiswa($hashedId)
    // {
    //     $ekstrasiswa = Ekstrasiswa::with('Ekstrakulikuler', 'User')->get()->first(function ($u) use ($hashedId) {
    //         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
    //         return $expectedHash === $hashedId;
    //     });

    //     if (!$ekstrasiswa) {
    //         return redirect()->route('Ekstrasiswa.index')->withErrors(['Data tidak ditemukan.']);
    //     }

    //     $jumlahsiswa = Ekstrasiswa::where('id', $ekstrasiswa->id)
    //     ->get()
    //     ->unique('siswa_id') // Memastikan hanya siswa_id unik yang diambil
    //     ->count(); // Menghitung jumlah siswa unik
    
    //     $siswas = Ekstrasiswa::with('User')
    //     ->where('id', $ekstrasiswa->id)
    //     ->get()
    //     ->unique('id');
    

    //     // Generate PDF
    //     $pdf = PDF::loadView('Ekstrasiswa.downloadekstrasiswa', compact( 'siswas','jumlahsiswa', 'ekstrasiswa'))
    //         ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

    //                $fileName = 'data-ekstrakulikuler-siswa-' . $ekstrasiswa->Ekstrakulikuler->namaekstra.  '.pdf';

    //            return $pdf->download($fileName);
    // }

    public function deleteEkstrasiswa(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
        ]);
    
        // Cari semua ekstrakulikuler_id yang memiliki duplikat
        $duplicateIds = Ekstrasiswa::select('ekstrakulikuler_id')
            ->groupBy('ekstrakulikuler_id')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('ekstrakulikuler_id');
    
        // Hapus semua entri yang memiliki ekstrakulikuler_id duplikat
        Ekstrasiswa::whereIn('ekstrakulikuler_id', $duplicateIds)->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'All duplicate Ekstrakulikuler entries have been deleted successfully.'
        ]);
    }
    












}
