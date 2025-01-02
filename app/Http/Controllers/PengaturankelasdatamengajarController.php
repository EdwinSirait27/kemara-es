<?php

namespace App\Http\Controllers;

use App\Models\Data_mengajar;
use App\Models\Pengaturankelasdatamengajar;
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
    $kelasdatamengajar = Data_mengajar::all()->with('Guru','Matapelajaran')->get();

    $pengaturans = Pengaturankelas::with('Tahunakademik')->get();
    $tahunakademik = Pengaturankelasdatamengajar::with('Datamengajar', 'Pengaturankelas.Tahunakademik', 'Pengaturankelas.Kelas')
        ->select('id', 'siswa_id', 'pengaturankelas_id')
        ->get();
    
    $filterTahunakademik = Tahunakademik::select('id', 'tahunakademik','semester')->get();
        
    return view('Pengaturankelasdatamengajar.create', compact('kelasdatamengajar', 'pengaturans', 'tahunakademik', 'filterTahunakademik'));
}

    public function show($hashedId)
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with('Datamengajar', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelasdatamengajar) {
        return redirect()->route('Pengaturankelasdatamengajar.index')->withErrors(['Data tidak ditemukan.']);
    }
    
    return view('Pengaturankelasdatamengajar.show', compact('kelasdatamengajar','hashedId'));
}
public function downloadkelasdatamengajar($hashedId)
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with('Datamengajar', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$kelasdatamengajar) {
        return redirect()->route('Pengaturankelasdatamengajar.index')->withErrors(['Data tidak ditemukan.']);
    }

    
    $datas = Data_mengajar::with('Datamengajar','Guru')
        ->where('pengaturankelas_id', $kelasdatamengajar->pengaturankelas_id)
        ->get();

    // Generate PDF
    $pdf = PDF::loadView('Pengaturankelasdatamengajar.download', compact('datas', 'jumlahsiswa', 'kelassiswa'))
        ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

    $fileName = 'data-jadwal-siswa-' . $kelasdatamengajar->Pengaturankelas->Kelas->kelas . '.pdf';
    return $pdf->download($fileName);
}

public function previewkelasdatamengajar($hashedId)
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with('Datamengajar', 'Pengaturankelas.Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelasdatamengajar) {
        return redirect()->route('Pengaturankelasdatamengajar.index')->withErrors(['Data tidak ditemukan.']);
    }
    $datas = Data_mengajar::with('Guru','Matapelajaran')
        ->where('pengaturankelas_id', $kelasdatamengajar->pengaturankelas_id)
        ->get();

    if (request()->has('download')) {
        $pdf = PDF::loadView('Pengaturankelasdatamengajar.download', compact('datas',  'kelasdatamengajar'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi
        $fileName = 'data-jadwal-siswa-' . $kelasdatamengajar->Pengaturankelas->Kelas->kelas . '.pdf';
        return $pdf->download($fileName);
    }
    return view('Pengaturankelasdatamengajar.download', compact('datas',  'kelasdatamengajar'));
}

public function getkelasdatamengajar($hashedId)
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with('Datamengajar', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelasdatamengajar) {
        return redirect()->route('Pengaturankelasdatamengajar.index')->withErrors(['Data tidak ditemukan.']);
    }
    $datas = Data_mengajar::with('Guru','Matapelajran')
        ->where('pengaturankelas_id', $kelasdatamengajar->pengaturankelas_id)
        ->get();

    // Return data untuk DataTables
    return datatables()->of($datas)
        ->addColumn('Nama', function ($row) {
            return $row->Guru->Nama ?? '-';
        })
        
        ->rawColumns(['checkbox'])
        ->make(true);

}

public function getPengaturankelasatamengajar()
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with(['Pengaturankelas', 'Guru','Matapelajaran'])
        ->select(['id', 'pengaturankelas_id'])
        ->get()
        ->groupBy('pengaturankelas_id')  // Mengelompokkan berdasarkan pengaturankelas_id
        ->map(function ($group) {
            $kelasdatamengajar = $group->first();

            $kelasdatamengajar->id_hashed = substr(hash('sha256', $kelasdatamengajar->id . env('APP_KEY')), 0, 8);
            $kelasdatamengajar->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelasdatamengajar->id_hashed . '">';
            $kelasdatamengajar->action = '
                <a href="' . route('Pengaturankelasdatamengajar.edit', $kelasdatamengajar->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Daftar Siswa">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>
                <a href="' . route('Pengaturankelasdatamengajar.show', $kelasdatamengajar->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail Siswa">
                    <i class="fas fa-eye text-success"></i>
                </a>
                <a href="' . route('Pengaturankelasdatamengajar.download', $kelasdatamengajar->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Preview">
                    <i class="fas fa-upload text-primary"></i>
                </a>
                <a href="' . route('Pengaturankelasdatamengajar.downloaddatamengajar', $kelasdatamengajar->id_hashed) . '"  
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download PDF
                    </a>'

            ;
 $kelasdatamengajar->Tahun_Nama = $kelasdatamengajar->Pengaturankelas->Tahunakademik ? $kelasdatamengajar->Pengaturankelas->Tahunakademik->tahunakademik : 'belum di setel';
            $kelasdatamengajar->Semester_Nama = $kelasdatamengajar->Pengaturankelas->Tahunakademik ? $kelasdatamengajar->Pengaturankelas->Tahunakademik->semester : 'belum di setel';
            $kelasdatamengajar->Kelas_Nama = $kelasdatamengajar->Pengaturankelas->Kelas ? $kelasdatamengajar->Pengaturankelas->Kelas->kelas : 'belum di setel';
            $kelasdatamengajar->Kapasitas_Nama = $kelasdatamengajar->Pengaturankelas->Kelas ? $kelasdatamengajar->Pengaturankelas->Kelas->kapasitas : 'belum di setel';
            $kelasdatamengajar->Status_Nama = $kelasdatamengajar->Pengaturankelas->Kelas ? $kelasdatamengajar->Pengaturankelas->Kelas->status : 'belum di setel';
            return $kelasdatamengajar;
        });

    return DataTables::of($kelasdatamengajar)
        ->addColumn('tahunakademik', function ($kelasdatamengajar) {
            return $kelasdatamengajar->Pengaturankelas->Tahunakademik->tahunakademik;
        })
        ->addColumn('semester', function ($kelasdatamengajar) {
            return $kelasdatamengajar->Pengaturankelas->Tahunakademik->semester;
        })
        ->addColumn('kelas', function ($kelasdatamengajar) {
            return $kelasdatamengajar->Pengaturankelas->Kelas->kelas;
        })
        ->addColumn('kapasitas', function ($kelasdatamengajar) {
            return $kelasdatamengajar->Pengaturankelas->Kelas->kapasitas;
        })
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}

    public function getKelassiswadetail()
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with(['Pengaturankelas','Matapelajaran','Guru'])
        ->select(['id', 'siswa_id']) 
        
        ->get()
        ->map(function ($kelassiswa) {
            $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->siswa_id . env('APP_KEY')), 0, 8);
            $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
            $kelassiswa->Siswa_Nama = $kelassiswa->Siswa->NamaLengkap ? $kelassiswa->Siswa->NamaLengkap : 'belum di setel';
             
            return $kelassiswa;
        });
    return DataTables::of($kelasdatamengajar)
    ->addColumn('NamaLengkap', function ($kelasdatamengajar) {
        return optional($kelasdatamengajar->Matapelajaran)->matapelajaran ?? 'Tidak Ada Nama';
    })
        ->rawColumns(['checkbox'])
        ->make(true);
}

    public function edit($hashedId)
{
    $kelasdatamengajar = Pengaturankelasdatamengajar::with('Guru','Matapelajaran', 'Pengaturankelas', 'Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelasdatamengajar) {
        return redirect()->route('Pengaturankelasdatamengajar.index')->withErrors(['Data tidak ditemukan.']);
    }
    $pengaturans = Pengaturankelas::all();
    $datamengajars = Data_mengajar::all();
               $selectedDatamengajar = $kelasdatamengajar->Matapelajaran ? $kelasdatamengajar->Matapelajaran->pluck('id')->toArray() : [];
    return view('Pengaturankelasdatamengajar.edit', compact('kelasdatamengajar','hashedId', 'pengaturans','datamengajars','selectedSiswa'));
}
public function getEditdatamengajar(Request $request)
{
    $query = Pengaturankelasdatamengajar::with(['Datamengajar', 'Pengaturankelas.Tahunakademik'])
        ->select(['id', 'datamengajar_id', 'pengaturankelas_id']);

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
    $kelasdatamengajar = Pengaturankelasdatamengajar::with('Datamengajar','Pengaturankelas','Kelas')->get()->first(function ($u) use ($hashedId) {
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
            function ($attribute, $value, $fail) use ($kelasdatamengajar) {
                // Periksa apakah pengaturankelas_id sudah digunakan oleh record lain
                if (Pengaturankelasdatamengajar::where('pengaturankelas_id', $value)
                    ->where('id', '!=', $kelasdatamengajar->id) // Abaikan record yang sedang diupdate
                    ->exists()) {
                    $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
                }
            },
        ],
      'datamengajar_id' => [
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
        $existingDatamengajar = Pengaturankelasdatamengajar::whereIn('datamengajar_id', $value)
            ->where('pengaturankelas_id', $pengaturankelasId)
            ->with('Guru','Matapelajaran')
            ->get();

        // Jika ditemukan siswa dengan pengaturankelas_id yang sama, validasi gagal
        if ($existingDatamengajar->isNotEmpty()) {
            $namaMatapelajaran = $existingDatamengajar->pluck('Matapelajaran.matapelajaran')->join(', ');
            $fail("Mata pelajaran berikut sudah terdaftar dalam kelas ini: $namaMatapelajaran. Silakan pilih siswa lainnya.");
        }
    },
],
        // 'siswa_id' => ['required', 'array', new NoXSSInput()],
        // 'pengaturankelas_id' => ['required', 'numeric', new NoXSSInput()],
        'datamengajar_id.*' => ['exists:tb_datamengajar,id', new NoXSSInput()],
    ]);

    // Mencari Kelassiswa berdasarkan hashedId
    $kelasdatamengjar = Pengaturankelasdatamengajar::get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    // Jika data Kelassiswa tidak ditemukan
    if (!$kelasdatamengjar) {
        return redirect()->route('Pengaturankelasdatamengajar.index')->with('error', 'ID tidak valid.');
    }

    // Ambil data siswa_id dan pengaturankelas_id dari input
    $datamengajar_ids = $request->input('datamengajar_id');
    $pengaturankelas_id = $request->input('pengaturankelas_id');

    // Hapus data siswa yang sebelumnya terhubung dengan pengaturankelas_id ini
    Pengaturankelasdatamengajar::where('pengaturankelas_id', $pengaturankelas_id)->delete();

    // Tambahkan data baru untuk setiap siswa
    foreach ($datamengajar_ids as $datamengajar_id) {
        Pengaturankelasdatamengajar::create([
            'datamengajar_id' => $datamengajar_id,  // Gunakan siswa_id dari input
            'pengaturankelas_id' => $pengaturankelas_id, // Gunakan pengaturankelas_id dari input
        ]);
    }

    return redirect()->route('Pengaturankelasdatamengajar.index')->with('success', 'Organisasi Berhasil Diupdate.');
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
                if (Pengaturankelasdatamengajar::where('pengaturankelas_id', $value)->exists()) {
                    $fail("Pengaturan kelas ini sudah digunakan. Silakan pilih pengaturan kelas yang lain.");
                }
            },
        ],
      'datamengajar_id' => [
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
        $existingDatamengajar = Pengaturankelasdatamengajar::whereIn('datamengajar_id', $value)
            ->where('pengaturankelas_id', $pengaturankelasId)
            ->with('Guru','Matapelajaran')
            ->get();

        // Jika ditemukan siswa dengan pengaturankelas_id yang sama, validasi gagal
        if ($existingDatamengajar->isNotEmpty()) {
            $namaMatapelajaran = $existingDatamengajar->pluck('Matapelajaran.matapelajaran')->join(', ');
            $fail("Mata pelajran berikut sudah terdaftar dalam kelas ini: $namaMatapelajaran. Silakan pilih mata pelajran lainnya.");
        }
    },
],

    
        'datamengajar_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
    ], [
        'pengaturankelas_id.required' => 'Pengaturan kelas harus dipilih.',
        'pengaturankelas_id.exists' => 'Pengaturan kelas yang dipilih tidak valid.',
        'datamengajar_id.required' => 'Minimal satu mata pelajaran harus dipilih.',
        'datamengajar_id.*.exists' => 'Salah satu mata pelajaran yang dipilih tidak valid.',
    ]);
    try {
        $datamengajar_ids = $request->input('datamengajar');
        $pengaturankelas_id = $request->input('pengaturankelas_id');

        
        // Persiapkan data untuk insert
        $dataToInsert = collect($datamengajar_ids)->map(fn($datamengajar_id) => [
            'pengaturankelas_id' => $pengaturankelas_id,
            'datamengajar_id' => $datamengajar_id,
        ])->toArray();

        // Batch insert data
        Pengaturankelasdatamengajar::insert($dataToInsert);

        return redirect()->route('Pengaturankelasdatamengajar.index')->with('success', 'Data pengaturan kelas berhasil ditambahkan!');
    } catch (\Throwable $e) {
        \Log::error('Gagal menyimpan data pengaturan kelas.', [
            'error' => $e->getMessage(),
            'pengaturankelas_id' => $pengaturankelas_id ?? null,
            'datamengajar_ids' => $datamengajar_ids ?? [],
        ]);
        return redirect()->back()->with('error', 'Gagal menyimpan data pengaturan kelas. Silakan coba lagi.');
    }
}

public function deleteKelasdatamengajar(Request $request)
{
    $request->validate([
        'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
    ]);
    Pengaturankelasdatamengajar::whereIn('id', $request->ids)->delete();
    return response()->json([
        'success' => true,
        'message' => 'Selected Kelas siswa and their related data deleted successfully.'
    ]);
}

public function deleteDatamengajardarikelas(Request $request)
{
    $request->validate([
        'datamengajar_ids' => ['required', 'array', 'min:1'],
        'datamengajar_ids.*' => ['integer', 'exists:tb_pengaturankelas_datamengajar,id'], // Validasi setiap ID
    ]);

    try {
        // Update kolom siswa_id menjadi null
        Pengaturankelasdatamengajar::whereIn('datamengajar_id', $request->datamengajar_ids)
            ->update(['datamengajar_id' => null]);

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
