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
        ->unique('organisasi_id') // Menghapus duplikasi berdasarkan ekstrakulikuler_id
        ->map(function ($organisasisiswa)  {
                $organisasisiswa->id_hashed = substr(hash('sha256', $organisasisiswa->id . env('APP_KEY')), 0, 8);
                $organisasisiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $organisasisiswa->id_hashed . '">';
                $organisasisiswa->action = '
            <a href="' . route('Organisasisiswa.show', $organisasisiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="lihat detail">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>
              <a href="' . route('Organisasisiswa.download', $organisasisiswa->id_hashed) . '" 
   class="mx-3" 
   data-bs-toggle="tooltip" 
   data-bs-original-title="Preview Absen" 
   target="_blank" 
   rel="noopener noreferrer">
   <i class="fas fa-upload text-primary"></i>
</a>
            <a href="' . route('Organisasisiswa.downloadorganisasisiswa', $organisasisiswa->id_hashed) . '"  class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download PDF 
                    </a>';
            $organisasisiswa->Guru_Nama = $organisasisiswa->Organisasi->Guru ? $organisasisiswa->Organisasi->Guru->Nama : '-';
            $organisasisiswa->Organisasi_Nama = $organisasisiswa->Organisasi->namaorganisasi ? $organisasisiswa->Organisasi->namaorganisasi : '-';
            $organisasisiswa->Kap_Nama = $organisasisiswa->Organisasi->kapasitas ? $organisasisiswa->Organisasi->kapasitas : '-';
            $organisasisiswa->Tahun_Nama = $organisasisiswa->Organisasi->Tahunakademik ? $organisasisiswa->Organisasi->Tahunakademik->tahunakademik : '-';
            $organisasisiswa->Semester_Nama = $organisasisiswa->Organisasi->Tahunakademik ? $organisasisiswa->Organisasi->Tahunakademik->semester : '-';
            // $ekstrasiswa->Semester_Nama = $ekstrasiswa->Ekstrakulikuler->Tahunakademik ? $ekstrasiswa->Ekstrakulikuler->Tahunakademik->semester : '-';
            
                return $organisasisiswa;
            });
        return DataTables::of($organisasisiswa)
        ->addColumn('Nama', function ($organisasisiswa) {
            return $organisasisiswa->Organisasi->Guru->Nama;
        })
        ->addColumn('tahunakademik', function ($organisasisiswa) {
            return $organisasisiswa->Organisasi->Tahunakademik->tahunakademik;
        })
        ->addColumn('semester', function ($organisasisiswa) {
            return $organisasisiswa->Organisasi->Tahunakademik->semester;
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
        $organisasisiswa = Organisasisiswa::with('User', 'Organisasi', 'Pengaturankelassiswa.Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasisiswa) {
            return redirect()->route('Organisasisiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahsiswa = Organisasisiswa::where('organisasi_id', $organisasisiswa->organisasi_id)
        ->distinct('user_id')
        ->count();

    // Mengambil daftar siswa yang unik berdasarkan user_id
    $siswas = Organisasisiswa::with('User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->where('organisasi_id', $organisasisiswa->organisasi_id)
        ->distinct('user_id')
        ->get();

    // Memproses data siswa untuk menambahkan nama lengkap dan kelas
    $siswasProcessed = $siswas->map(function ($siswa) {
        // Menambahkan nama lengkap siswa
        $siswa->NamaLengkap = $siswa->User->Siswa->NamaLengkap ?? 'N/A';

        // Menambahkan kelas siswa
        $pengaturankelassiswa = $siswa->User->Siswa->Pengaturankelassiswa()
        ->whereHas('Pengaturankelas', function ($query) {
            $query->where('status', 'Aktif');
        })
        ->first();
    
    $siswa->Kelas = $pengaturankelassiswa 
        ? $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? 'N/A' 
        : 'N/A';
        return $siswa;
    });

    return view('Organisasisiswa.download', compact('siswasProcessed', 'jumlahsiswa', 'organisasisiswa'));
    }
    public function downloadorganisasisiswa($hashedId)
    {
        $organisasisiswa = Organisasisiswa::with('Organisasi', 'User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->get()
        ->filter(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        })->first();

    if (!$organisasisiswa) {
        return redirect()->route('Organisasisiswa.index')->withErrors(['Data tidak ditemukan.']);
    }

    $jumlahsiswa = Organisasisiswa::where('organisasi_id', $organisasisiswa->organisasi_id)
        ->distinct('user_id')
        ->count();

    $siswas = Organisasisiswa::with('User', 'Pengaturankelassiswa.Pengaturankelas.Kelas')
        ->where('organisasi_id', $organisasisiswa->organisasi_id)
        ->distinct('user_id')
        ->get();

    $siswasProcessed = $siswas->map(function ($siswa) {
        $siswa->NamaLengkap = $siswa->User->Siswa->NamaLengkap ?? 'N/A';
        $pengaturankelassiswa = $siswa->User->Siswa->Pengaturankelassiswa()
        ->whereHas('Pengaturankelas', function ($query) {
            $query->where('status', 'Aktif');
        })
        ->first();
    
    $siswa->Kelas = $pengaturankelassiswa 
        ? $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? 'N/A' 
        : 'N/A';
        return $siswa;
    });
    

        $pdf = PDF::loadView('Organisasisiswa.downloadorganisasisiswa', compact( 'siswas','jumlahsiswa', 'organisasisiswa','siswasProcessed'))
            ->setPaper('a4', 'landscape');
                   $fileName = 'data-absensi-Organisasi-' . $organisasisiswa->Organisasi->namaorganisasi . '-tahun akademik-' . $organisasisiswa->Organisasi->Tahunakademik->tahunakademik .  '.pdf';
               return $pdf->download($fileName);
    }

    public function getOrganisasi($hashedId)
    {
        $organisasisiswa = Organisasisiswa::with('Organisasi', 'User','Pengaturankelassiswa.Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasisiswa) {
            return redirect()->route('Organisasisiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $organs = Organisasisiswa::with('User')
        ->where('organisasi_id', $organisasisiswa->organisasi_id)
        ->get()
        ->unique('user_id');
    
        return datatables()->of($organs)
            ->addColumn('NamaLengkap', function ($row) {
                return $row->User->Siswa->NamaLengkap ?? '-';
            })
            ->addColumn('kelas', function ($row) {
                $pengaturankelassiswa = $row->User->Siswa->Pengaturankelassiswa()
                ->whereHas('Pengaturankelas', function ($query) {
                    $query->where('status', 'Aktif');
                })
                ->first();
            
            return $pengaturankelassiswa 
                ? $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? '-' 
                : '-';
            
            })
            ->rawColumns(['checkbox'])
            ->make(true);
    
    }
    // public function show($hashedId)
    
    //     {
    //         $organisasisiswa = Organisasi::with('User', 'Organisasi')->get()->first(function ($u) use ($hashedId) {
    //             $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
    //             return $expectedHash === $hashedId;
    //         });
    //         if (!$organisasisiswa) {
    //             return redirect()->route('Organisasisiswa.index')->withErrors(['Data tidak ditemukan.']);
    //         }
    //         $jumlahsiswa = Organisasisiswa::where('id', $organisasisiswa->id)
    //         ->get()
    //         ->unique('siswa_id')
    //         ->count(); 
    //         return view('Organisasisiswa.show', compact( 'jumlahsiswa', 'organisasisiswa','hashedId'));
    //     }
    public function show($hashedId)

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
        return view('Organisasisiswa.show', compact( 'jumlahsiswa', 'organisasisiswa','hashedId'));
    }

        
        public function deleteOrganisasisiswa(Request $request)
        {
            $request->validate([
                'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
            ]);
        
            // Cari semua ekstrakulikuler_id yang memiliki duplikat
            $duplicateIds = Organisasisiswa::select('organisasi_id')
                ->groupBy('organisasi_id')
                ->havingRaw('COUNT(*) > 1')
                ->pluck('organisasi_id');
        
            // Hapus semua entri yang memiliki ekstrakulikuler_id duplikat
            Organisasisiswa::whereIn('organisasi_id', $duplicateIds)->delete();
        
            return response()->json([
                'success' => true,
                'message' => 'All duplicate organisasisiswa entries have been deleted successfully.'
            ]);
        }
        
    
    
    
    
    
    
    
    
}
