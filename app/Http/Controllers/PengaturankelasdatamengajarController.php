<?php

namespace App\Http\Controllers;

use App\Models\Data_mengajar;
use App\Models\Kelassiswa;
use App\Models\Pengaturankelas;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Rules\NoXSSInput;


class PengaturankelasdatamengajarController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Pengaturankelasdatamengajar.Pengaturankelasdatamengajar');

    }
  
    public function create() 
{
    $datamengajars = Data_mengajar::all()->with('Guru','Matapelajaran')->get();

    $pengaturans = Pengaturankelas::with('Tahunakademik')->get();
    $tahunakademik = Kelassiswa::with('Siswa', 'Pengaturankelas.Tahunakademik', 'Pengaturankelas.Kelas')
        ->select('id', 'siswa_id', 'pengaturankelas_id')
        ->get();
    
    $filterTahunakademik = Tahunakademik::select('id', 'tahunakademik','semester')->get();
        
    return view('Pengaturankelasdatamengajar.create', compact('datamengajars', 'pengaturans', 'tahunakademik', 'filterTahunakademik'));
}

    // public function getSiswadankelas(Request $request)
    // {
    //     $query = Kelassiswa::with(['Siswa', 'Pengaturankelas'])
    //         ->select(['id', 'siswa_id', 'pengaturankelas_id']);
    //         if ($request->has('id') && !empty($request->id)) {
    //             $query->whereHas('Pengaturankelas.Tahunakademik', function ($q) use ($request) {
    //                 $q->where('id', $request->id);
    //             });
    //         }
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
    return view('Kelassiswa.show', compact('kelassiswa', 'jumlahsiswa','hashedId'));
}
public function downloadkelas($hashedId)
{
    $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$kelassiswa) {
        return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
    }

    $jumlahsiswa = Kelassiswa::where('siswa_id', $kelassiswa->pengaturankelas_id)->count();

    $siswas = Kelassiswa::with('Siswa')
        ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get();

    // Generate PDF
    $pdf = PDF::loadView('Kelassiswa.download', compact('siswas', 'jumlahsiswa', 'kelassiswa'))
        ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

    $fileName = 'data-kelas-siswa-' . $kelassiswa->Pengaturankelas->Kelas->kelas . '.pdf';
    return $pdf->download($fileName);
}

public function previewkelas($hashedId)
{
    $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelassiswa) {
        return redirect()->route('Kelassiswa.index')->withErrors(['Data tidak ditemukan.']);
    }
    $jumlahsiswa = Kelassiswa::where('siswa_id', $kelassiswa->pengaturankelas_id)->count();
    $siswas = Kelassiswa::with('Siswa')
        ->where('pengaturankelas_id', $kelassiswa->pengaturankelas_id)
        ->get();

    if (request()->has('download')) {
        $pdf = PDF::loadView('Kelassiswa.download', compact('siswas', 'jumlahsiswa', 'kelassiswa'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi
        $fileName = 'data-kelas-siswa-' . $kelassiswa->Pengaturankelas->Kelas->kelas . '.pdf';
        return $pdf->download($fileName);
    }
    return view('Kelassiswa.download', compact('siswas', 'jumlahsiswa', 'kelassiswa'));
}

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
        ->get();

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

public function getKelassiswa()
{
    $kelassiswa = Kelassiswa::with(['Pengaturankelas', 'Siswa'])
        ->select(['id', 'pengaturankelas_id'])
        ->get()
        ->groupBy('pengaturankelas_id')  // Mengelompokkan berdasarkan pengaturankelas_id
        ->map(function ($group) {
            $kelassiswa = $group->first();

            $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
            $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
            $kelassiswa->action = '
                <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Daftar Siswa">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>
                <a href="' . route('Kelassiswa.show', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail Siswa">
                    <i class="fas fa-eye text-success"></i>
                </a>
                <a href="' . route('Kelassiswa.download', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Preview">
                    <i class="fas fa-upload text-primary"></i>
                </a>
                <a href="' . route('Kelassiswa.downloadkelas', $kelassiswa->id_hashed) . '"  
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download PDF
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

    public function getKelassiswadetail()
{
    $kelassiswa = Kelassiswa::with(['Pengaturankelas','Siswa'])
        ->select(['id', 'siswa_id']) 
        
        ->get()
        ->map(function ($kelassiswa) {
            $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->siswa_id . env('APP_KEY')), 0, 8);
            $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
            $kelassiswa->Siswa_Nama = $kelassiswa->Siswa->NamaLengkap ? $kelassiswa->Siswa->NamaLengkap : 'belum di setel';
             
            return $kelassiswa;
        });
    return DataTables::of($kelassiswa)
    ->addColumn('NamaLengkap', function ($kelassiswa) {
        return optional($kelassiswa->Siswa)->NamaLengkap ?? 'Tidak Ada Nama';
    })
        ->rawColumns(['checkbox'])
        ->make(true);
}

    public function edit($hashedId)
{
    $kelassiswa = Kelassiswa::with('Siswa', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
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
               $selectedSiswa = $kelassiswa->Siswa ? $kelassiswa->Siswa->pluck('siswa_id')->toArray() : [];
    return view('Kelassiswa.edit', compact('kelassiswa','hashedId', 'pengaturans','siswas','selectedSiswa'));
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

// public function update(Request $request, $hashedId)
// {
    

//     $kelassiswa = Kelassiswa::get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });

//     if (!$kelassiswa) {
//         return redirect()->route('Kelassiswa.index')->with('error', 'ID tidak valid.');
//     }

    
// }
public function update(Request $request, $hashedId)
{
    $kelassiswa = Kelassiswa::with('Siswa','Pengaturankelas','Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    // Validasi input
    $validatedData = $request->validate([
        'pengaturankelas_id' => [
            'required',
            'numeric',
            'exists:tb_pengaturan_kelas,id',
            new NoXSSInput(),
            function ($attribute, $value, $fail) use ($kelassiswa) {
                // Periksa apakah pengaturankelas_id sudah digunakan oleh record lain
                if (Kelassiswa::where('pengaturankelas_id', $value)
                    ->where('id', '!=', $kelassiswa->id) // Abaikan record yang sedang diupdate
                    ->exists()) {
                    $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
                }
            },
        ],
      'siswa_id' => [
    'required',
    'array',
    'min:1',
    new NoXSSInput(),
    function ($attribute, $value, $fail) use ($request) {
        // Ambil pengaturankelas_id dari request
        $pengaturankelasId = $request->input('pengaturankelas_id');

        if (empty($pengaturankelasId)) {
            $fail("Pengaturankelas ID harus disertakan.");
            return;
        }

        // Cari siswa_id yang sudah ada di tabel Kelassiswa dengan pengaturankelas_id yang sama
        $existingSiswa = Kelassiswa::whereIn('siswa_id', $value)
            ->where('pengaturankelas_id', $pengaturankelasId)
            ->with('Siswa')
            ->get();

        // Jika ditemukan siswa dengan pengaturankelas_id yang sama, validasi gagal
        if ($existingSiswa->isNotEmpty()) {
            $namaSiswa = $existingSiswa->pluck('Siswa.NamaLengkap')->join(', ');
            $fail("Siswa berikut sudah terdaftar dalam kelas ini: $namaSiswa. Silakan pilih siswa lainnya.");
        }
    },
],
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
                // Periksa apakah sudah ada pengaturankelas_id ini di tabel Kelassiswa
                if (Kelassiswa::where('pengaturankelas_id', $value)->exists()) {
                    $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
                }
            },
        ],
      'siswa_id' => [
    'required',
    'array',
    'min:1',
    new NoXSSInput(),
    function ($attribute, $value, $fail) use ($request) {
        // Ambil pengaturankelas_id dari request
        $pengaturankelasId = $request->input('pengaturankelas_id');

        if (empty($pengaturankelasId)) {
            $fail("Pengaturankelas ID harus disertakan.");
            return;
        }

        // Cari siswa_id yang sudah ada di tabel Kelassiswa dengan pengaturankelas_id yang sama
        $existingSiswa = Kelassiswa::whereIn('siswa_id', $value)
            ->where('pengaturankelas_id', $pengaturankelasId)
            ->with('Siswa')
            ->get();

        // Jika ditemukan siswa dengan pengaturankelas_id yang sama, validasi gagal
        if ($existingSiswa->isNotEmpty()) {
            $namaSiswa = $existingSiswa->pluck('Siswa.NamaLengkap')->join(', ');
            $fail("Siswa berikut sudah terdaftar dalam kelas ini: $namaSiswa. Silakan pilih siswa lainnya.");
        }
    },
],


    //     'siswa_id' => ['required', 'array', 'min:1',    new NoXSSInput(),
    //     function ($attribute, $value, $fail) {
    //         $existingSiswa = Kelassiswa::whereIn('siswa_id', $value)
    //             ->with(['Siswa','Pengaturankelas']) // Pastikan relasi ke model Siswa sudah ada
    //             ->get();
          

    //         if ($existingSiswa->isNotEmpty()) {
    //             $namaSiswa = $existingSiswa->pluck('Siswa.NamaLengkap')->join(', '); 
                
    //             $fail("Siswa berikut sudah ada dalam kelas ini atau kelas lain: $namaSiswa. Silakan pilih siswa lainnya.");
    //         }
    //     },
    // ],
    
        'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
    ], [
        'pengaturankelas_id.required' => 'Pengaturan kelas harus dipilih.',
        'pengaturankelas_id.exists' => 'Pengaturan kelas yang dipilih tidak valid.',
        'siswa_id.required' => 'Minimal satu siswa harus dipilih.',
        'siswa_id.*.exists' => 'Salah satu siswa yang dipilih tidak valid.',
    ]);
    try {
        $siswa_ids = $request->input('siswa_id');
        $pengaturankelas_id = $request->input('pengaturankelas_id');

        $pengaturankelas = Pengaturankelas::with('Kelas')->findOrFail($pengaturankelas_id);
        $kapasitas = $pengaturankelas->Kelas->kapasitas ?? 0;

        // Hitung jumlah siswa saat ini dan total siswa setelah penambahan
        $jumlah_siswa_sekarang = Kelassiswa::where('pengaturankelas_id', $pengaturankelas_id)->count();
        $total_siswa = $jumlah_siswa_sekarang + count($siswa_ids);

        if ($total_siswa > $kapasitas) {
            return redirect()->back()->with('error', "Jumlah siswa melebihi kapasitas kelas maksimal ({$kapasitas}) orang.");
        }

        // Persiapkan data untuk insert
        $dataToInsert = collect($siswa_ids)->map(fn($siswa_id) => [
            'pengaturankelas_id' => $pengaturankelas_id,
            'siswa_id' => $siswa_id,
        ])->toArray();

        // Batch insert data
        Kelassiswa::insert($dataToInsert);

        return redirect()->route('Kelassiswa.index')->with('success', 'Data pengaturan kelas berhasil ditambahkan!');
    } catch (\Throwable $e) {
        \Log::error('Gagal menyimpan data pengaturan kelas.', [
            'error' => $e->getMessage(),
            'pengaturankelas_id' => $pengaturankelas_id ?? null,
            'siswa_ids' => $siswa_ids ?? [],
        ]);
        return redirect()->back()->with('error', 'Gagal menyimpan data pengaturan kelas. Silakan coba lagi.');
    }
}

// public function store(Request $request)
// {
//     $request->validate([
//         'pengaturankelas_id' => ['required', 'numeric', 'exists:tb_pengaturan_kelas,id', new NoXSSInput()],
//         'siswa_id' => ['required', 'array', new NoXSSInput()],
//         'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
//     ]);

//     try {
//         $siswa_ids = $request->input('siswa_id');
//         $pengaturankelas_id = $request->input('pengaturankelas_id');

//         $pengaturankelas = Pengaturankelas::with('Kelas')->findOrFail($pengaturankelas_id);
//         $kapasitas = $pengaturankelas->Kelas->kapasitas ?? 0;

//         $jumlah_siswa_sekarang = Kelassiswa::where('pengaturankelas_id', $pengaturankelas_id)->count();
//         $total_siswa = $jumlah_siswa_sekarang + count($siswa_ids);

//         if ($total_siswa > $kapasitas) {
//             return redirect()->back()->with('error', "Jumlah siswa melebihi kapasitas kelas maksimal ({$kapasitas}) orang.");
//         }

//         $dataToInsert = [];
//         foreach ($siswa_ids as $siswa_id) {
//             $dataToInsert[] = [
//                 'pengaturankelas_id' => $pengaturankelas_id,
//                 'siswa_id' => $siswa_id,
              
//             ];
//         }

//         Kelassiswa::insert($dataToInsert);

//         return redirect()->route('Kelassiswa.index')->with('success', 'Data pengaturan kelas created successfully!');
//     } catch (\Exception $e) {
//         \Log::error('Failed to store data', [
//             'error' => $e->getMessage(),
//             'pengaturankelas_id' => $pengaturankelas_id,
//             'siswa_ids' => $siswa_ids,
//         ]);
//         return redirect()->back()->with('error', 'Failed to create Data pengaturan kelas: ' . $e->getMessage());
//     }
// }



public function deleteKelassiswa(Request $request)
{
    $request->validate([
        'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
    ]);
    Kelassiswa::whereIn('id', $request->ids)->delete();
    return response()->json([
        'success' => true,
        'message' => 'Selected Kelas siswa and their related data deleted successfully.'
    ]);
}

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
