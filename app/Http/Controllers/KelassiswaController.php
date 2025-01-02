<?php

namespace App\Http\Controllers;

use App\Models\Data_mengajar;
use App\Models\Kelassiswa;
use App\Models\Pengaturankelas;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Rules\NoXSSInput;
class KelassiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Kelassiswa.Kelassiswa');

    }

    public function create()
    {
        $siswas = Siswa::select('siswa_id', 'NamaLengkap', 'status')
            ->where('Status', 'Aktif')
            ->get();
        $datamengajars = Data_mengajar::with('Guru', 'Matapelajaran')->get();

        $pengaturans = Pengaturankelas::with('Tahunakademik')->get();
        $tahunakademik = Kelassiswa::with('Siswa', 'Pengaturankelas.Tahunakademik', 'Pengaturankelas.Kelas')
            ->select('id', 'siswa_id', 'pengaturankelas_id')
            ->get();

        $filterTahunakademik = Tahunakademik::select('id', 'tahunakademik', 'semester')->get();

        return view('Kelassiswa.create', compact('siswas', 'pengaturans', 'tahunakademik', 'filterTahunakademik', 'datamengajars'));
    }

    public function getSiswadankelas(Request $request)
{
    $query = Kelassiswa::with(['Siswa', 'Pengaturankelas'])
        ->select(['siswa_id', 'pengaturankelas_id']) // Hanya pilih kolom yang diperlukan
        ->distinct(); // Ambil data siswa_id yang unik

    if ($request->has('id') && !empty($request->id)) {
        $query->whereHas('Pengaturankelas.Tahunakademik', function ($q) use ($request) {
            $q->where('id', $request->id);
        });
    }

    $lihatsiswa = $query->get()
        ->map(function ($lihatsiswa) {
            $lihatsiswa->Siswa_Nama = $lihatsiswa->Siswa ? $lihatsiswa->Siswa->NamaLengkap : '-';
            $lihatsiswa->Kelas_Nama = $lihatsiswa->Pengaturankelas->Kelas ? $lihatsiswa->Pengaturankelas->Kelas->kelas : '-';
            $lihatsiswa->Tahun_Nama = $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->tahunakademik : '-';
            $lihatsiswa->Semester_Nama = $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->semester : '-';
            return $lihatsiswa;
        });

    return DataTables::of($lihatsiswa)
        ->addColumn('Namalengkap', function ($lihatsiswa) {
            return $lihatsiswa->Siswa ? $lihatsiswa->Siswa->NamaLengkap : '-';
        })
        ->addColumn('kelas', function ($lihatsiswa) {
            return $lihatsiswa->Pengaturankelas->Kelas ? $lihatsiswa->Pengaturankelas->Kelas->kelas : '-';
        })
        ->addColumn('tahunakademik', function ($lihatsiswa) {
            return $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->tahunakademik : '-';
        })
        ->addColumn('semester', function ($lihatsiswa) {
            return $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->semester : '-';
        })
        ->make(true);
}

    // public function getSiswadankelas(Request $request)
    // {
    //     $query = Kelassiswa::with(['Siswa', 'Pengaturankelas'])
    //         ->select(['id', 'siswa_id', 'pengaturankelas_id']);
    //     if ($request->has('id') && !empty($request->id)) {
    //         $query->whereHas('Pengaturankelas.Tahunakademik', function ($q) use ($request) {
    //             $q->where('id', $request->id);
    //         });
    //     }
    //     $lihatsiswa = $query->get()
    //         ->map(function ($lihatsiswa) {
    //             $lihatsiswa->Siswa_Nama = $lihatsiswa->Siswa ? $lihatsiswa->Siswa->NamaLengkap : '-';
    //             $lihatsiswa->Kelas_Nama = $lihatsiswa->Pengaturankelas->Kelas ? $lihatsiswa->Pengaturankelas->Kelas->kelas : '-';
    //             $lihatsiswa->Tahun_Nama = $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->tahunakademik : '-';
    //             $lihatsiswa->Semester_Nama = $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->semester : '-';
    //             return $lihatsiswa;
    //         });
    //     return DataTables::of($lihatsiswa)
    //         ->addColumn('Namalengkap', function ($lihatsiswa) {
    //             return $lihatsiswa->Siswa ? $lihatsiswa->Siswa->NamaLengkap : '-';
    //         })
    //         ->addColumn('kelas', function ($lihatsiswa) {
    //             return $lihatsiswa->Pengaturankelas->Kelas ? $lihatsiswa->Pengaturankelas->Kelas->kelas : '-';
    //         })
    //         ->addColumn('tahunakademik', function ($lihatsiswa) {
    //             return $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->tahunakademik : '-';
    //         })
    //         ->addColumn('semester', function ($lihatsiswa) {
    //             return $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->semester : '-';
    //         })
    //         ->make(true);
    // }
    public function show($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahsiswa = Kelassiswa::where('siswa_id', $kelassiswa->pengaturankelas_id)
            ->count();
        return view('Kelassiswa.show', compact('kelassiswa', 'jumlahsiswa', 'hashedId'));
    }
    public function showmatapelajaran($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahmata = Kelassiswa::where('datamengajar_id', $kelassiswa->pengaturankelas_id)
            ->count();
        // $filterhari = Data_mengajar::select('id', 'guru_id', 'matapelajaran_id','awalpel','akhirpel','hari','awalis','akhiris')->with('Guru','Matapelajaran')->get();
        $filterhari = Data_mengajar::select('id', 'guru_id', 'matapelajaran_id','awalpel','akhirpel','hari','awalis','akhiris')
        ->with('Guru', 'Matapelajaran')
        ->get()
        ->unique('hari');
        return view('Kelassiswa.showmatapelajaran', compact('kelassiswa', 'jumlahmata', 'hashedId','filterhari'));
    }
    public function downloadkelas($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas.Kelas','Pengaturankelas.Tahunakademik')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }

        $jumlahsiswa = Kelassiswa::where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get()
        ->unique('siswa_id') // Memastikan hanya siswa_id unik yang diambil
        ->count(); // Menghitung jumlah siswa unik
    
        $siswas = Kelassiswa::with('Siswa')
        ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get()
        ->unique('siswa_id');
    

        // Generate PDF
        $pdf = PDF::loadView('Kelassiswa.download', compact( 'siswas','jumlahsiswa', 'kelassiswa'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

                   $fileName = 'data-absensi-siswa-kelas-' . $kelassiswa->Pengaturankelas->Kelas->kelas . '-tahun akademik-' . $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik .  '.pdf';

               return $pdf->download($fileName);
    }
    public function downloadmatapelajaran($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
            $hariUrut = [
                'Senin' => 1,
                'Selasa' => 2,
                'Rabu' => 3,
                'Kamis' => 4,
                'Jumat' => 5,
            ];
            
            $datamengajars = Kelassiswa::select('datamengajar_id')
                ->with('Datamengajar') // Mengambil relasi Datamengajar
                ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
                ->get()
                ->unique('datamengajar_id');
            
            // Urutkan berdasarkan hari
            $datamengajars = $datamengajars->sortBy(function ($item) use ($hariUrut) {
                // Mendapatkan hari dari relasi Datamengajar
                return $hariUrut[$item->Datamengajar->hari] ?? 999; // Jika hari tidak ada, beri nilai tinggi
            });
        // Generate PDF
        $pdf = PDF::loadView('Kelassiswa.downloadmatapelajaran', compact('datamengajars', 'kelassiswa'))
            ->setPaper('a4', 'landscape'); 

        $fileName = 'data-jadwal-kelas-' . $kelassiswa->Pengaturankelas->Kelas->kelas . '-tahun akademik-' . $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik .  '.pdf';
        return $pdf->download($fileName);
    }
    // public function downloadmatapelajaran($hashedId)
    // {
    //     $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
    //         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
    //         return $expectedHash === $hashedId;
    //     });

    //     if (!$kelassiswa) {
    //         return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
    //     }
    //         $hariUrut = [
    //             'Senin' => 1,
    //             'Selasa' => 2,
    //             'Rabu' => 3,
    //             'Kamis' => 4,
    //             'Jumat' => 5,
    //         ];
            
    //         $datamengajars = Kelassiswa::select('datamengajar_id')
    //             ->with('Datamengajar') // Mengambil relasi Datamengajar
    //             ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
    //             ->get()
    //             ->unique('datamengajar_id');
            
    //         // Urutkan berdasarkan hari
    //         $datamengajars = $datamengajars->sortBy(function ($item) use ($hariUrut) {
    //             // Mendapatkan hari dari relasi Datamengajar
    //             return $hariUrut[$item->Datamengajar->hari] ?? 999; // Jika hari tidak ada, beri nilai tinggi
    //         });
    //     // Generate PDF
    //     $pdf = PDF::loadView('Kelassiswa.downloadmatapelajaran', compact('datamengajars', 'kelassiswa'))
    //         ->setPaper('a4', 'landscape'); 

    //     $fileName = 'data-kelas-siswa-' . $kelassiswa->Pengaturankelas->Kelas->kelas . '.pdf';
    //     return $pdf->download($fileName);
    // }

    public function previewkelas($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas.Kelas','Pengaturankelas.Tahunakademik')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahsiswa = Kelassiswa::where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get()
        ->unique('siswa_id') // Memastikan hanya siswa_id unik yang diambil
        ->count(); // Menghitung jumlah siswa unik
    
        $siswas = Kelassiswa::with('Siswa')
        ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get()
        ->unique('siswa_id');

        // if (request()->has('download')) {
        //     $pdf = PDF::loadView('Kelassiswa.download', compact('siswas', 'jumlahsiswa', 'kelassiswa'))
        //         ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi
        //     $fileName = 'data-absensi-siswa-kelas-' . $kelassiswa->Pengaturankelas->Kelas->kelas . 'tahun' . $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik .  '.pdf';
        //     return $pdf->download($fileName);
        // }
        return view('Kelassiswa.download', compact('siswas', 'jumlahsiswa', 'kelassiswa'));
    }
    public function previewmatapelajaran($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $jumlahmatapelajaran = Kelassiswa::where('datamengajar_id', $kelassiswa->pengaturankelas_id)->count();
        // $datamengajars = Kelassiswa::select('datamengajar_id')->with('Datamengajar')
        // ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        // ->get()
        // ->unique('datamengajar_id');
        // Urutan hari
$hariUrut = [
    'Senin' => 1,
    'Selasa' => 2,
    'Rabu' => 3,
    'Kamis' => 4,
    'Jumat' => 5,
];

$datamengajars = Kelassiswa::select('datamengajar_id')
    ->with('Datamengajar') // Mengambil relasi Datamengajar
    ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
    ->get()
    ->unique('datamengajar_id');

// Urutkan berdasarkan hari
$datamengajars = $datamengajars->sortBy(function ($item) use ($hariUrut) {
    // Mendapatkan hari dari relasi Datamengajar
    return $hariUrut[$item->Datamengajar->hari] ?? 999; // Jika hari tidak ada, beri nilai tinggi
});


        if (request()->has('downloadmatapelajaran')) {
            $pdf = PDF::loadView('Kelassiswa.downloadmatapelajaran', compact('datamengajars', 'jumlahmatapelajaran', 'kelassiswa'))
                ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi
            $fileName = 'data-matapelajaran-siswa-' . $kelassiswa->Pengaturankelas->Kelas->kelas . '.pdf';
            return $pdf->download($fileName);
        }
        return view('Kelassiswa.downloadmatapelajaran', compact( 'jumlahmatapelajaran', 'kelassiswa','datamengajars'));
    }
    //ini untuk show kelassiswa
    public function getSiswa($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $siswas = Kelassiswa::with('Siswa')
        ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get()
        ->unique('siswa_id'); // Pastikan hanya siswa_id yang unik
    
    
        // $siswas = Kelassiswa::with('Siswa')
        //         ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        //         ->get();

        // Return data untuk DataTables
        return datatables()->of($siswas)
            ->addColumn('NamaLengkap', function ($row) {
                return $row->Siswa->NamaLengkap ?? '-';
            })
            ->addColumn('tahunakademik', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik;
            })
            ->addColumn('semester', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Tahunakademik->semester;
            })
            ->addColumn('kelas', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Kelas->kelas;
            })
            ->addColumn('kapasitas', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Kelas->kapasitas;
            })
            ->rawColumns(['checkbox'])
            ->make(true);

    }
    
    public function getMatapelajaran(Request $request, $hashedId)
{
    $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelassiswa) {
        return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
    }
    $query = Kelassiswa::with('Datamengajar')
        ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id);

    if ($request->has('hari') && !empty($request->hari)) {
        $query->whereHas('Datamengajar', function ($q) use ($request) {
            $q->where('hari', $request->hari);
        });
    }
    $datamengajars = $query->get()->unique('datamengajar_id');
    return datatables()->of($datamengajars)
        ->addColumn('Nama', function ($row) {
            return $row->Datamengajar->Guru->Nama ?? '-';
        })
        ->addColumn('matapelajaran', function ($row) {
            return $row->Datamengajar->Matapelajaran->matapelajaran ?? '-';
        })
        ->addColumn('hari', function ($row) {
            return $row->Datamengajar->hari ?? '-';
        })
        
        ->addColumn('awalpel', function ($row) {
            return $row->Datamengajar->awalpel ?? '-';
        })
        ->addColumn('akhirpel', function ($row) {
            return $row->Datamengajar->akhirpel ?? '-';
        })
        ->addColumn('awalis', function ($row) {
            return $row->Datamengajar->awalis ?? '-';
        })
        ->addColumn('akhiris', function ($row) {
            return $row->Datamengajar->akhiris ?? '-';
        })  
        ->rawColumns(['checkbox'])
        ->make(true);
}

    // public function getMatapelajaran(Request $request, $hashedId)
    // {
    //     $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
    //         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
    //         return $expectedHash === $hashedId;
    //     });
    //     if (!$kelassiswa) {
    //         return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
    //     }
    //     $datamengajars
    //         = Kelassiswa::with('Datamengajar')
    //             ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
    //             ->get();

    //     return datatables()->of($datamengajars)
    //         ->addColumn('Nama', function ($row) {
    //             return $row->Datamengajar->Guru->Nama ?? '-';
    //         })
    //         ->addColumn('matapelajaran', function ($row) {
    //             return $row->Datamengajar->Matapelajaran->matapelajaran ?? '-';
    //         })
    //         ->addColumn('hari', function ($row) {
    //             return $row->Datamengajar->hari ?? '-';
    //         })
    //         ->addColumn('awalpel', function ($row) {
    //             return $row->Datamengajar->awalpel ?? '-';
    //         })
    //         ->addColumn('akhirpel', function ($row) {
    //             return $row->Datamengajar->akhirpel ?? '-';
    //         })
    //         ->addColumn('awalis', function ($row) {
    //             return $row->Datamengajar->awalis ?? '-';
    //         })
    //         ->addColumn('akhiris', function ($row) {
    //             return $row->Datamengajar->akhiris ?? '-';
    //         })  
    //         ->rawColumns(['checkbox'])
    //         ->make(true);

    // }
    // public function getMatapelajaran($hashedId)
    // {
    //     $kelassiswa = Kelassiswa::with('Datamengajar', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
    //         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
    //         return $expectedHash === $hashedId;
    //     });
    //     if (!$kelassiswa) {
    //         return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
    //     }
    //     $datamengajars
    //         = Kelassiswa::with('Datamengajar')
    //             ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
    //             ->get();

    //     return datatables()->of($datamengajars)
    //         ->addColumn('Nama', function ($row) {
    //             return $row->Datamengajar->Guru->Nama ?? '-';
    //         })
    //         ->addColumn('matapelajaran', function ($row) {
    //             return $row->Datamengajar->Matapelajaran->matapelajaran ?? '-';
    //         })
    //         ->addColumn('hari', function ($row) {
    //             return $row->Datamengajar->hari ?? '-';
    //         })
    //         ->addColumn('awalpel', function ($row) {
    //             return $row->Datamengajar->awalpel ?? '-';
    //         })
    //         ->addColumn('akhirpel', function ($row) {
    //             return $row->Datamengajar->akhirpel ?? '-';
    //         })
    //         ->addColumn('awalis', function ($row) {
    //             return $row->Datamengajar->awalis ?? '-';
    //         })
    //         ->addColumn('akhiris', function ($row) {
    //             return $row->Datamengajar->akhiris ?? '-';
    //         })  
    //         ->rawColumns(['checkbox'])
    //         ->make(true);

    // }
   

    public function getKelassiswa()
    {
        $kelassiswa = Kelassiswa::with(['Pengaturankelas', 'Siswa', 'Datamengajar'])
            ->select(['id', 'pengaturankelas_id'])
            ->get()
            ->groupBy('pengaturankelas_id')  // Mengelompokkan berdasarkan pengaturankelas_id
            ->map(function ($group) {
                $kelassiswa = $group->first();
                // <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Daftar Siswa">
                //     <i class="fas fa-user-edit text-secondary"></i>
                // </a>

                $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
                $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
                $kelassiswa->action = '
                <a href="' . route('Kelassiswa.show', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail Siswa">
                    <i class="fas fa-eye text-success"></i>
                </a>
                <a href="' . route('Kelassiswa.showmatapelajaran', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail Matapelajran">
                    <i class="fas fa-eye text-success"></i>
                </a>
                <a href="' . route('Kelassiswa.download', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Preview Absen">
                    <i class="fas fa-upload text-primary"></i>
                </a>
                <a href="' . route('Kelassiswa.downloadmata', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Preview Mata Pelajaran">
                    <i class="fas fa-upload text-primary"></i>
                </a>
                <a href="' . route('Kelassiswa.downloadkelas', $kelassiswa->id_hashed) . '"  
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download Absen
                    </a>
                <a href="' . route('Kelassiswa.downloadmatapelajaran', $kelassiswa->id_hashed) . '"  
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download Jadwal
                    </a>'

                ;
                $kelassiswa->Tahun_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik : 'belum di setel';
                $kelassiswa->Semester_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->semester : 'belum di setel';
                $kelassiswa->Kelas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kelas : 'belum di setel';
                $kelassiswa->Kapasitas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kapasitas : 'belum di setel';
                $kelassiswa->Status_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->status : 'belum di setel';
                return $kelassiswa;
            });

        return DataTables::of($kelassiswa)
            ->addColumn('tahunakademik', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik;
            })
            ->addColumn('semester', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Tahunakademik->semester;
            })
            ->addColumn('kelas', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Kelas->kelas;
            })
            ->addColumn('kapasitas', function ($kelassiswa) {
                return $kelassiswa->Pengaturankelas->Kelas->kapasitas;
            })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }

    //     public function getKelassiswadetail()
// {
//     $kelassiswa = Kelassiswa::with(['Pengaturankelas','Siswa'])
//         ->select(['id', 'siswa_id']) 

    //         ->get()
//         ->map(function ($kelassiswa) {
//             $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->siswa_id . env('APP_KEY')), 0, 8);
//             $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
//             $kelassiswa->Siswa_Nama = $kelassiswa->Siswa->NamaLengkap ? $kelassiswa->Siswa->NamaLengkap : 'belum di setel';

    //             return $kelassiswa;
//         });
//     return DataTables::of($kelassiswa)
//     ->addColumn('NamaLengkap', function ($kelassiswa) {
//         return optional($kelassiswa->Siswa)->NamaLengkap ?? 'Tidak Ada Nama';
//     })
//         ->rawColumns(['checkbox'])
//         ->make(true);
// }

    public function edit($hashedId)
    {
        $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas', 'Kelas', 'Datamengajar')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
        }
        $pengaturans = Pengaturankelas::all();
        $siswas = Siswa::select('siswa_id', 'NamaLengkap', 'status')
            ->where('Status', 'Aktif')
            ->get();
        $siswass = Kelassiswa::select('siswa_id')->with('Siswa')
            ->get()->unique('siswa_id');
        $datamengajars = Data_mengajar::select('id','guru_id','matapelajaran_id','hari','awalpel','akhirpel','awalis','akhiris')->with('Guru', 'Matapelajaran')->get();
        $datamengajarss = Kelassiswa::select('datamengajar_id')->with('Datamengajar')->get()->unique('datamengajar_id');
        $selectedSiswa = $kelassiswa->Siswa ? $kelassiswa->Siswa->pluck('siswa_id')->toArray() : [];
        $selectedMata = $kelassiswa->Datamengajar ? $kelassiswa->Datamengajar->pluck('id')->toArray() : [];
        return view('Kelassiswa.edit', compact('kelassiswa', 'hashedId', 'pengaturans', 'siswas','datamengajarss', 'siswass','selectedSiswa', 'selectedMata', 'datamengajars'));
    }
    public function getEditsiswadankelas(Request $request)
    {

        $query = Kelassiswa::with(['Siswa', 'Pengaturankelas.Tahunakademik'])
            ->select(['id', 'siswa_id', 'pengaturankelas_id']);
        // Filter berdasarkan tahun akademik
        if ($request->has('id') && !empty($request->id)) {
            $query->whereHas('Pengaturankelas.Tahunakademik', function ($q) use ($request) {
                $q->where('id', $request->id);
            });
        }

        $siswakelass = $query->get()
            ->map(function ($lihatsiswa) {
                $lihatsiswa->Siswa_Nama = $lihatsiswa->Siswa ? $lihatsiswa->Siswa->NamaLengkap : '-';
                $lihatsiswa->Tahun_Nama = $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->tahunakademik : '-';
                $lihatsiswa->Semester_Nama = $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->semester : '-';
                return $lihatsiswa;
            });

        return DataTables::of($siswakelass)
            ->addColumn('Namalengkap', function ($lihatsiswa) {
                return $lihatsiswa->Siswa ? $lihatsiswa->Siswa->NamaLengkap : '-';
            })
            ->addColumn('tahunakademik', function ($lihatsiswa) {
                return $lihatsiswa->Pengaturankelas->Tahunakademik ? $lihatsiswa->Pengaturankelas->Tahunakademik->tahunakademik : '-';
            })
            ->make(true);
    }

    public function update(Request $request, $hashedId)
    {
        
        $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        // Validasi input
        $validatedData = $request->validate([
            'pengaturankelas_id' => [
                'required',
                'numeric',
                'exists:tb_pengaturan_kelas,id',
                new NoXSSInput()
                // ,
                // function ($attribute, $value, $fail) use ($kelassiswa) {
                //     // Periksa apakah pengaturankelas_id sudah digunakan oleh record lain
                //     if (
                //         Kelassiswa::where('pengaturankelas_id', $value)
                //             ->where('id', '!=', $kelassiswa->id) // Abaikan record yang sedang diupdate
                //             ->exists()
                //     ) {
                //         $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
                //     }
                // },
            ],
       'siswa_id' => [
    'required',
    'array',
    'min:1',
    new NoXSSInput(),
    function ($attribute, $value, $fail) use ($request) {
        $pengaturankelasId = $request->input('pengaturankelas_id');
        $currentKelassiswaId = $request->input('id'); // ID yang sedang diupdate

        if (empty($pengaturankelasId)) {
            $fail("Pengaturankelas ID harus disertakan.");
            return;
        }

        // Ambil siswa_id yang sudah ada di database untuk pengaturankelas_id ini, tanpa duplikasi
        $existingSiswaIds = Kelassiswa::where('pengaturankelas_id', $pengaturankelasId)
            ->where('id', '!=', $currentKelassiswaId) // Kecualikan data lama berdasarkan ID
            ->distinct()
            ->pluck('siswa_id')
            ->toArray();

        // Cek apakah ada siswa_id yang sudah terdaftar
        $conflictingSiswaIds = array_intersect($value, $existingSiswaIds);

        if (!empty($conflictingSiswaIds)) {
            $conflictingSiswa = Kelassiswa::whereIn('siswa_id', $conflictingSiswaIds)
                ->with('Siswa')
                ->get()
                ->pluck('Siswa.NamaLengkap')
                ->unique()
                ->join(', ');

            $fail("Siswa berikut sudah terdaftar dalam kelas ini: $conflictingSiswa. Silakan pilih siswa lainnya.");
        }
    },
],





            // 'siswa_id' => [
            //     'required',
            //     'array',
            //     'min:1',
            //     new NoXSSInput(),
            //     function ($attribute, $value, $fail) use ($request) {
            //         // Ambil pengaturankelas_id dari request
            //         $pengaturankelasId = $request->input('pengaturankelas_id');

            //         if (empty($pengaturankelasId)) {
            //             $fail("Pengaturankelas ID harus disertakan.");
            //             return;
            //         }

            //         // Cari siswa_id yang sudah ada di tabel Kelassiswa dengan pengaturankelas_id yang sama
            //         $existingSiswa = Kelassiswa::whereIn('siswa_id', $value)
            //             ->where('pengaturankelas_id', $pengaturankelasId)
            //             ->with('Siswa')
            //             ->get();

            //         // Jika ditemukan siswa dengan pengaturankelas_id yang sama, validasi gagal
            //         if ($existingSiswa->isNotEmpty()) {
            //             $namaSiswa = $existingSiswa->pluck('Siswa.NamaLengkap')->unique()->join(', ');
            //             $fail("Siswa berikut sudah terdaftar dalam kelas ini: $namaSiswa. Silakan pilih siswa lainnya.");
            //         }
            //     },
            // ],
            // 'siswa_id' => ['required', 'array', new NoXSSInput()],
            // 'pengaturankelas_id' => ['required', 'numeric', new NoXSSInput()],
            'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
        ]);

        // Mencari Kelassiswa berdasarkan hashedId
        $kelassiswa = Kelassiswa::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        // Jika data Kelassiswa tidak ditemukan
        if (!$kelassiswa) {
            return redirect()->route('Kelassiswa.index')->with('error', 'ID tidak valid.');
        }

        // Ambil data siswa_id dan pengaturankelas_id dari input
        $siswa_ids = $request->input('siswa_id');
        $pengaturankelas_id = $request->input('pengaturankelas_id');

        // Hapus data siswa yang sebelumnya terhubung dengan pengaturankelas_id ini
        Kelassiswa::where('pengaturankelas_id', $pengaturankelas_id)->delete();

        // Tambahkan data baru untuk setiap siswa
        foreach ($siswa_ids as $siswa_id) {
            Kelassiswa::create([
                'siswa_id' => $siswa_id,  // Gunakan siswa_id dari input
                'pengaturankelas_id' => $pengaturankelas_id, // Gunakan pengaturankelas_id dari input
            ]);
        }

        return redirect()->route('Kelassiswa.index')->with('success', 'Organisasi Berhasil Diupdate.');
    }
    public function store(Request $request)
{
    $request->validate([
        'pengaturankelas_id' => [
            'required',
            'numeric',
            'exists:tb_pengaturan_kelas,id',
            new NoXSSInput(),
            function ($attribute, $value, $fail) {
                if (Kelassiswa::where('pengaturankelas_id', $value)->exists()) {
                    $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
                }
            },
        ],
        'siswa_id' => [
            'required',
            'array',
            'min:1',
            'distinct', // Tidak boleh ada duplikat dalam array
            new NoXSSInput(),
            function ($attribute, $value, $fail) use ($request) {
                $pengaturankelasId = $request->input('pengaturankelas_id');

                if (empty($pengaturankelasId)) {
                    $fail("Pengaturankelas ID harus disertakan.");
                    return;
                }

                $existingSiswa = Kelassiswa::whereIn('siswa_id', $value)
                    ->where('pengaturankelas_id', $pengaturankelasId)
                    ->with('Siswa')
                    ->get();

                if ($existingSiswa->isNotEmpty()) {
                    $namaSiswa = $existingSiswa->pluck('Siswa.NamaLengkap')->join(', ');
                    $fail("Siswa berikut sudah terdaftar dalam kelas ini: $namaSiswa. Silakan pilih siswa lainnya.");
                }
            },
        ],
        'datamengajar_id' => [
            'required',
            'array',
            'min:1',
            'distinct', // Tidak boleh ada duplikat dalam array
            'exists:tb_datamengajar,id', // Validasi bahwa datamengajar_id valid
            new NoXSSInput(),
        ],
        'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
    ], [
        'pengaturankelas_id.required' => 'Pengaturan kelas harus dipilih.',
        'pengaturankelas_id.exists' => 'Pengaturan kelas yang dipilih tidak valid.',
        'siswa_id.required' => 'Minimal satu siswa harus dipilih.',
        'siswa_id.*.exists' => 'Salah satu siswa yang dipilih tidak valid.',
    ]);

    try {
        DB::transaction(function () use ($request) {
            $siswa_ids = $request->input('siswa_id');
            $datamengajar_ids = $request->input('datamengajar_id');
            $pengaturankelas_id = $request->input('pengaturankelas_id');

            $pengaturankelas = Pengaturankelas::with('Kelas')->findOrFail($pengaturankelas_id);
            $kapasitas = $pengaturankelas->Kelas->kapasitas ?? 0;

            $jumlah_siswa_sekarang = Kelassiswa::where('pengaturankelas_id', $pengaturankelas_id)->count();
            $total_siswa = $jumlah_siswa_sekarang + count($siswa_ids);

            if ($total_siswa > $kapasitas) {
                throw new \Exception("Jumlah siswa melebihi kapasitas kelas maksimal ({$kapasitas}) orang.");
            }

            $dataToInsert = collect($siswa_ids)->flatMap(function ($siswa_id) use ($pengaturankelas_id, $datamengajar_ids) {
                return collect($datamengajar_ids)->map(function ($datamengajar_id) use ($pengaturankelas_id, $siswa_id) {
                    return [
                        'pengaturankelas_id' => $pengaturankelas_id,
                        'siswa_id' => $siswa_id,
                        'datamengajar_id' => $datamengajar_id,
                    ];
                });
            });

            Kelassiswa::insert($dataToInsert->toArray());
        });

        return redirect()->route('Kelassiswa.index')->with('success', 'Data pengaturan kelas berhasil ditambahkan!');
    } catch (\Throwable $e) {
        \Log::error('Gagal menyimpan data pengaturan kelas.', [
            'error' => $e->getMessage(),
            'pengaturankelas_id' => $request->input('pengaturankelas_id'),
            'siswa_ids' => $request->input('siswa_id', []),
            'datamengajar_ids' => $request->input('datamengajar_id', []),
        ]);
        return redirect()->back()->with('error', 'Gagal menyimpan data pengaturan kelas. Silakan coba lagi.');
    }
}

    // public function store(Request $request)
// {
//     $request->validate([
//         'pengaturankelas_id' => [
//             'required',
//             'numeric',
//             'exists:tb_pengaturan_kelas,id',
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 if (Kelassiswa::where('pengaturankelas_id', $value)->exists()) {
//                     $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
//                 }
//             },
//         ],
//       'siswa_id' => [
//     'required',
//     'array',
//     'min:1',
//     new NoXSSInput(),
//     function ($attribute, $value, $fail) use ($request) {
//         $pengaturankelasId = $request->input('pengaturankelas_id');

    //         if (empty($pengaturankelasId)) {
//             $fail("Pengaturankelas ID harus disertakan.");
//             return;
//         }

    //         $existingSiswa = Kelassiswa::whereIn('siswa_id', $value)
//             ->where('pengaturankelas_id', $pengaturankelasId)
//             ->with('Siswa')
//             ->get();

    //         if ($existingSiswa->isNotEmpty()) {
//             $namaSiswa = $existingSiswa->pluck('Siswa.NamaLengkap')->join(', ');
//             $fail("Siswa berikut sudah terdaftar dalam kelas ini: $namaSiswa. Silakan pilih siswa lainnya.");
//         }
//     },
// ],
//       'datamengajar_id' => [
//     'required',
//     'array',
//     'min:1',
//     new NoXSSInput(),

    // ],

    //         'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
//     ], [
//         'pengaturankelas_id.required' => 'Pengaturan kelas harus dipilih.',
//         'pengaturankelas_id.exists' => 'Pengaturan kelas yang dipilih tidak valid.',
//         'siswa_id.required' => 'Minimal satu siswa harus dipilih.',
//         'siswa_id.*.exists' => 'Salah satu siswa yang dipilih tidak valid.',
//     ]);
//     try {
//         $siswa_ids = $request->input('siswa_id');
//         $datamengajar_ids = $request->input('datamengajar_id');
//         $pengaturankelas_id = $request->input('pengaturankelas_id');

    //         $pengaturankelas = Pengaturankelas::with('Kelas')->findOrFail($pengaturankelas_id);
//         $kapasitas = $pengaturankelas->Kelas->kapasitas ?? 0;

    //         $jumlah_siswa_sekarang = Kelassiswa::where('pengaturankelas_id', $pengaturankelas_id)->count();
//         $total_siswa = $jumlah_siswa_sekarang + count($siswa_ids);

    //         if ($total_siswa > $kapasitas) {
//             return redirect()->back()->with('error', "Jumlah siswa melebihi kapasitas kelas maksimal ({$kapasitas}) orang.");
//         }

    //         $dataToInsert = collect($siswa_ids)->map(fn($siswa_id) => [
//             'pengaturankelas_id' => $pengaturankelas_id,
//             'siswa_id' => $siswa_id,
//             'datamengajar_id' => $datamengajar_id,
//         ])->toArray();
//         $dataToInsert1 = collect($datamengajar_ids)->map(fn($datamengajar_id) => [

    //             'datamengajar_id' => $datamengajar_id,
//         ])->toArray();


    //         Kelassiswa::insert($dataToInsert);

    //         return redirect()->route('Kelassiswa.index')->with('success', 'Data pengaturan kelas berhasil ditambahkan!');
//     } catch (\Throwable $e) {
//         \Log::error('Gagal menyimpan data pengaturan kelas.', [
//             'error' => $e->getMessage(),
//             'pengaturankelas_id' => $pengaturankelas_id ?? null,
//             'siswa_ids' => $siswa_ids ?? [],
//             'datamengajar_ids' => $datamengajar_ids ?? [],
//         ]);
//         return redirect()->back()->with('error', 'Gagal menyimpan data pengaturan kelas. Silakan coba lagi.');
//     }
// }







// public function deleteKelassiswa(Request $request)
// {
//     $request->validate([
//         'ids' => ['required', 'array', 'min:1', 'exists:tb_pengaturankelas_siswa,id'], // Pastikan ID ada di tabel
//     ]);

//     $pengaturankelasIds = DB::table('tb_pengaturankelas_siswa')
//         ->whereIn('id', $request->ids)
//         ->pluck('pengaturankelas_id')
//         ->unique();

//     $duplicatePengaturanKelasIds = DB::table('tb_pengaturankelas_siswa')
//         ->whereIn('pengaturankelas_id', $pengaturankelasIds)
//         ->groupBy('pengaturankelas_id')
//         ->havingRaw('COUNT(*) > 1')
//         ->pluck('pengaturankelas_id');

//     if ($duplicatePengaturanKelasIds->isNotEmpty()) {
//         DB::table('tb_pengaturankelas_siswa')
//             ->whereIn('pengaturankelas_id', $duplicatePengaturanKelasIds)
//             ->delete();
//     } else {
//         DB::table('tb_pengaturankelas_siswa')
//             ->whereIn('id', $request->ids)
//             ->delete();
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Selected Kelas siswa and their related data deleted successfully.',
//     ]);
// }


public function deleteKelassiswa(Request $request)
{
    $request->validate([
        'ids' => ['required', 'array', 'min:1', 'exists:tb_pengaturankelas_siswa,id'],
    ]);

    // Ambil semua pengaturankelas_id yang terkait dengan ID yang dipilih
    $pengaturankelasIds = DB::table('tb_pengaturankelas_siswa')
        ->whereIn('id', $request->ids)
        ->pluck('pengaturankelas_id')
        ->unique();

    // Hapus entri yang memiliki pengaturankelas_id yang dipilih
    DB::table('tb_pengaturankelas_siswa')
        ->whereIn('pengaturankelas_id', $pengaturankelasIds)
        ->delete();

    return response()->json([
        'success' => true,
        'message' => 'Selected Kelas siswa and their related data deleted successfully.',
    ]);
}

    // public function deleteKelassiswa(Request $request)
    // {
    //     $request->validate([
    //         'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
    //     ]);
    //     Kelassiswa::whereIn('id', $request->ids)->delete();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Selected Kelas siswa and their related data deleted successfully.'
    //     ]);
    // }

    public function deleteSiswadarikelas(Request $request)
    {
        $request->validate([
            'siswa_ids' => ['required', 'array', 'min:1'],
            'siswa_ids.*' => ['integer', 'exists:tb_pengaturankelas_siswa,siswa_id'], // Validasi setiap ID
        ]);

        try {
            // Update kolom siswa_id menjadi null
            Kelassiswa::whereIn('siswa_id', $request->siswa_ids)
                ->update(['siswa_id' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Selected siswa_id has been set to null successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to set siswa_id to null. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




}

