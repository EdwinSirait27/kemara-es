<?php

namespace App\Http\Controllers;

use App\Models\Kelassiswa;
use App\Models\Pengaturankelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    $pengaturans = Pengaturankelas::all();
        
        return view('Kelassiswa.create', compact('siswas','pengaturans'));
    }
    public function show()
    {
        $lihatsiswas = Kelassiswa::with('Siswa', 'Pengaturankelas')
        ->select('id', 'pengaturankelas_id')
        ->get()
        ->groupBy('pengaturankelas_id')
        ->map(function ($group) {
            
            return $group->first();
        });
        $jumlahsiswa = Kelassiswa::select('siswa_id')->count();    
        return view('Kelassiswa.show', compact('lihatsiswas','jumlahsiswa'));
    }
    public function downloadkelas()
{
    $lihatsiswas = Kelassiswa::with('Siswa', 'Pengaturankelas')
        ->select('id', 'siswa_id', 'pengaturankelas_id')
        ->get()
        ->groupBy('pengaturankelas_id')
        ->map(function ($group) {
            return $group->first();
        });

    $jumlahsiswa = Kelassiswa::select('siswa_id')->count();
    $kelas = Kelassiswa::select('pengaturankelas_id')->with('Pengaturankelas')->first();

    // Cek jika request meminta PDF
    if (request()->has('download')) {
        // Set orientasi landscape
        $pdf = PDF::loadView('Kelassiswa.download', compact('lihatsiswas', 'jumlahsiswa'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi
            $fileName = 'data-kelas-siswa-' . $kelas->Pengaturankelas->Kelas->kelas . '.pdf';

            return $pdf->download($fileName);
    }

    return view('Kelassiswa.download', compact('lihatsiswas', 'jumlahsiswa'));
}

    // public function downloadkelas()
    // {
    //     $lihatsiswas = Kelassiswa::with('Siswa', 'Pengaturankelas')
    //     ->select('id', 'siswa_id','pengaturankelas_id')
    //     ->get()
    //     ->groupBy('pengaturankelas_id')
    //     ->map(function ($group) {
    //         return $group->first();
    //     });

    // $jumlahsiswa = Kelassiswa::select('siswa_id')->count();    

    // // Cek jika request meminta PDF
    // if(request()->has('download')) {
    //     $pdf = PDF::loadView('Kelassiswa.download', compact('lihatsiswas', 'jumlahsiswa'));
    //     return $pdf->download('data-siswa.pdf');
    // }

    // return view('Kelassiswa.download', compact('lihatsiswas','jumlahsiswa'));
    // }
   


public function getSiswa()
{
    $siswa = Siswa::select('siswa_id', 'NamaLengkap','status')
    ->where('Status', 'Aktif')
    ->get()
        ->map(function ($siswa) {
            $siswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $siswa->id_hashed . '">';
            
            return $siswa;
        });
    return DataTables::of($siswa)
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
            // Ambil hanya satu entri dari setiap kelompok berdasarkan pengaturankelas_id
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
                    <i class="fas fa-download text-primary"></i>
                </a>
            ';

            // Menambahkan informasi terkait Tahun, Semester, Kelas, dan Kapasitas
            $kelassiswa->Tahun_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik : 'belum di setel';
            $kelassiswa->Semester_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->semester : 'belum di setel';
            $kelassiswa->Kelas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kelas : 'belum di setel';
            $kelassiswa->Kapasitas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kapasitas : 'belum di setel';
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

//     public function getKelassiswa()
// {
//     $kelassiswa = Kelassiswa::with(['Pengaturankelas','Siswa'])
//         ->select(['id', 'pengaturankelas_id'])
//         ->get()
//         ->map(function ($kelassiswa) {
//             $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
//             $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
//             $kelassiswa->action = 
//             '
//                 <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Daftar Siswa">
//                     <i class="fas fa-user-edit text-secondary"></i>
//                 </a>
//                 <a href="' . route('Kelassiswa.show', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail Siswa">
//         <i class="fas fa-eye text-primary"></i>
//     </a>
// ';
           
//             $kelassiswa->Tahun_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik : 'belum di setel';
//             $kelassiswa->Semester_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->semester : 'belum di setel';
//             $kelassiswa->Kelas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kelas : 'belum di setel';
//             $kelassiswa->Kapasitas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kapasitas : 'belum di setel';
//             return $kelassiswa;
//         });
//     return DataTables::of($kelassiswa)
//         ->addColumn('tahunakademik', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik;
//         })
//         ->addColumn('semester', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Tahunakademik->semester;
//         })
//         ->addColumn('kelas', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Kelas->kelas;
//         })
//         ->addColumn('kapasitas', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Kelas->kapasitas;
//         })
        
//         ->rawColumns(['checkbox', 'action'])
//         ->make(true);
// }
//     public function getKelassiswa()
// {
//     $kelassiswa = Kelassiswa::with(['Pengaturankelas','Siswa'])
//         ->select(['id', 'pengaturankelas_id']) // Hanya memilih kolom tahunakademik_id
//         ->get()
//         ->map(function ($kelassiswa) {
//             $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
//             $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
//             $kelassiswa->action = 
//             '
//                 <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Daftar Siswa">
//                     <i class="fas fa-user-edit text-secondary"></i>
//                 </a>
//                 <a href="' . route('Kelassiswa.show', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Lihat Detail Siswa">
//         <i class="fas fa-eye text-primary"></i>
//     </a>
// ';
           
//             $kelassiswa->Tahun_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik : 'belum di setel';
//             $kelassiswa->Semester_Nama = $kelassiswa->Pengaturankelas->Tahunakademik ? $kelassiswa->Pengaturankelas->Tahunakademik->semester : 'belum di setel';
//             $kelassiswa->Kelas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kelas : 'belum di setel';
//             $kelassiswa->Kapasitas_Nama = $kelassiswa->Pengaturankelas->Kelas ? $kelassiswa->Pengaturankelas->Kelas->kapasitas : 'belum di setel';
//             return $kelassiswa;
//         });
//     return DataTables::of($kelassiswa)
//         ->addColumn('tahunakademik', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik;
//         })
//         ->addColumn('semester', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Tahunakademik->semester;
//         })
//         ->addColumn('kelas', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Kelas->kelas;
//         })
//         ->addColumn('kapasitas', function ($kelassiswa) {
//             return $kelassiswa->Pengaturankelas->Kelas->kapasitas;
//         })
        
//         ->rawColumns(['checkbox', 'action'])
//         ->make(true);
// }
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
//     public function getKelassiswadetail()
// {
//     $kelassiswa = Kelassiswa::with(['Pengaturankelas','Siswa'])
//         ->select(['id', 'siswa_id','pengaturankelas_id']) 
        
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
    $kelassiswa = Kelassiswa::with('Siswa','Pengaturankelas','Kelas')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
   

    if (!$kelassiswa) {
        abort(404, 'Kelas Siswa not found.');
    }
    $pengaturans = Pengaturankelas::all();
    $siswas = Siswa::select('siswa_id', 'NamaLengkap', 'status')
               ->where('Status', 'Aktif')
               ->get();
               $selectedSiswa = $kelassiswa->Siswa ? $kelassiswa->Siswa->pluck('siswa_id')->toArray() : [];

            

    return view('Kelassiswa.edit', compact('kelassiswa', 'hashedId', 'pengaturans','siswas','selectedSiswa'));
}
public function update(Request $request, $hashedId)
{
    // Validasi input
    $validatedData = $request->validate([
        'siswa_id' => ['required', 'array', new NoXSSInput()],
        'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
        'pengaturankelas_id' => ['required', 'numeric', new NoXSSInput()],
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
        'pengaturankelas_id' => ['required', 'numeric', new NoXSSInput()],
        'siswa_id' => ['required', 'array', new NoXSSInput()],
        'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
    ]);

    try {
        $siswa_ids = $request->input('siswa_id');
        $pengaturankelas_id = $request->input('pengaturankelas_id');
        $pengaturankelas = Pengaturankelas::with('Kelas')->find($pengaturankelas_id);
        $kapasitas = $pengaturankelas->Kelas->kapasitas ?? 0;

        // Hitung jumlah siswa saat ini di kelas
        $jumlah_siswa_sekarang = Kelassiswa::where('pengaturankelas_id', $pengaturankelas_id)->count();

        // Hitung total siswa setelah penambahan
        $total_siswa = $jumlah_siswa_sekarang + count($siswa_ids);

        // Validasi apakah melebihi kapasitas
        if ($total_siswa > $kapasitas) {
            return redirect()->back()->with('error', 'Jumlah siswa melebihi kapasitas kelas. Kapasitas: ' . $kapasitas);
        }

        // Jika validasi lolos, simpan data
        foreach ($siswa_ids as $siswa_id) {
            Kelassiswa::create([
                'pengaturankelas_id' => $pengaturankelas_id,
                'siswa_id' => $siswa_id,
            ]);
        }

        return redirect()->route('Kelassiswa.index')->with('success', 'Data pengaturan kelas created successfully!');
    } catch (\Exception $e) {
        \Log::error('Failed to store data: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to create Data pengaturan kelas: ' . $e->getMessage());
    }
}

// public function store(Request $request)
// {
//     $request->validate([
//         'pengaturankelas_id' => ['required', 'numeric', new NoXSSInput()],
//         'siswa_id' => ['required', 'array', new NoXSSInput()],
//         'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()],
//     ]);

//     try {
//         $siswa_ids = $request->input('siswa_id');
//         $pengaturankelas_id = $request->input('pengaturankelas_id');

//         foreach ($siswa_ids as $siswa_id) {
//             Kelassiswa::create([
//                 'pengaturankelas_id' => $pengaturankelas_id,
//                 'siswa_id' => $siswa_id,
//             ]);
//         }

//         return redirect()->route('Kelassiswa.index')->with('success', 'Data pengaturan kelas created successfully!');
//     } catch (\Exception $e) {
//         \Log::error('Failed to store data: ' . $e->getMessage());
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

