<?php

namespace App\Http\Controllers;

use App\Models\Kelassiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Data_mengajar;
use App\Models\Siswa;
use App\Models\Tahunakademik;
use App\Models\Kelas;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
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

    $tahuns = Tahunakademik::all();
    $datamengajars = Data_mengajar::select('id','matapelajaran_id','guru_id','hari')->get();
    $kelass = Kelas::all();
        
        return view('Kelassiswa.create', compact('siswas','tahuns','datamengajars','kelass'));
    }
    

public function getSiswa()
{
    $siswa = Siswa::select(['siswa_id', 'NamaLengkap'])
        ->get()
        ->map(function ($siswa) {
            $siswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $siswa->id_hashed . '">';
            
            return $siswa;
        });
    return DataTables::of($siswa)
        ->rawColumns(['checkbox'])
        ->make(true);
}
 public function getDatamengajar()
    {
        $datamengajar = Data_mengajar::with(['Guru','Matapelajaran'])
            ->select(['id', 'matapelajaran_id', 'guru_id'])
            ->get()
            ->map(function ($datamengajar) {
                $datamengajar->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $datamengajar->id_hashed . '">';
                $datamengajar->Guru_Nama = $datamengajar->Guru ? $datamengajar->Guru->Nama : '-';
                $datamengajar->Mata_Nama = $datamengajar->Matapelajaran ? $datamengajar->Matapelajaran->matapelajaran : '-';
                return $datamengajar;
            });
        return DataTables::of($datamengajar)
            ->addColumn('Nama', function ($datamengajar) {
                return $datamengajar->Guru->Nama;
            })
            ->addColumn('matapelajaran', function ($datamengajar) {
                return $datamengajar->Matapelajaran->matapelajaran;
            })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
    public function getKelassiswa()
{
    $kelassiswa = Kelassiswa::with(['Tahunakademik','Kelas'])
        ->select(['id', 'kelas_id', 'tahunakademik_id','ket']) // Hanya memilih kolom tahunakademik_id
        ->get()
        ->map(function ($kelassiswa) {
            $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
            $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
            $kelassiswa->action = '
                <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';

            $kelassiswa->Tahun_Nama = $kelassiswa->Tahunakademik ? $kelassiswa->Tahunakademik->tahunakademik : 'belum di setel';
            $kelassiswa->Semester_Nama = $kelassiswa->Tahunakademik ? $kelassiswa->Tahunakademik->semester : 'belum di setel';
            $kelassiswa->Kelas_Nama = $kelassiswa->Kelas ? $kelassiswa->Kelas->kelas : 'belum di setel';
            $kelassiswa->Kapasitas_Nama = $kelassiswa->Kelas ? $kelassiswa->Kelas->kapasitas : 'belum di setel';
            return $kelassiswa;
        });
    return DataTables::of($kelassiswa)
        ->addColumn('tahunakademik', function ($kelassiswa) {
            return $kelassiswa->Tahunakademik->tahunakademik;
        })
        ->addColumn('semester', function ($kelassiswa) {
            return $kelassiswa->Tahunakademik->semester;
        })
        ->addColumn('kelas', function ($kelassiswa) {
            return $kelassiswa->Kelas->kelas;
        })
        ->addColumn('kapasitas', function ($kelassiswa) {
            return $kelassiswa->Kelas->kapasitas;
        })
        
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}

// public function getKelassiswa()
// {
//     $kelassiswa = Kelassiswa::with(['Siswa','Tahunakademik','Kelas','Datamengajar'])
//         ->select(['id', 'siswa_id', 'kelas_id', 'tahunakademik_id','datamengajar_id','ket'])
//         ->get()
//         ->map(function ($kelassiswa) {
//             $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
//             $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
//             $kelassiswa->action = '
//                 <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
//                     <i class="fas fa-user-edit text-secondary"></i>
//                 </a>';

//             $kelassiswa->Siswa_Nama = $kelassiswa->Siswa ? $kelassiswa->Siswa->NamaLengkap : '-';
//             $kelassiswa->Tahun_Nama = $kelassiswa->Tahunakademik ? $kelassiswa->Tahunakademik->tahunakademik : 'belum di setel';
//             $kelassiswa->Semester_Nama = $kelassiswa->Tahunakademik ? $kelassiswa->Tahunakademik->semester : 'belum di setel';
//             $kelassiswa->Kelas_Nama = $kelassiswa->Kelas ? $kelassiswa->Kelas->kelas : 'belum di setel';
//             $kelassiswa->Kapasitas_Nama = $kelassiswa->Kelas ? $kelassiswa->Kelas->kapasitas : 'belum di setel';
//             return $kelassiswa;
//         });
//     return DataTables::of($kelassiswa)
//         ->addColumn('NamaLengkap', function ($kelassiswa) {
//             return $kelassiswa->Siswa->NamaLengkap;
//         })
//         ->addColumn('tahunakademik', function ($kelassiswa) {
//             return $kelassiswa->Tahunakademik->tahunakademik;
//         })
//         ->addColumn('semester', function ($kelassiswa) {
//             return $kelassiswa->Tahunakademik->semester;
//         })
//         ->addColumn('kelas', function ($kelassiswa) {
//             return $kelassiswa->Kelas->kelas;
//         })
//         ->addColumn('kapasitas', function ($kelassiswa) {
//             return $kelassiswa->Kelas->kapasitas;
//         })
        
//         ->rawColumns(['checkbox', 'action'])
//         ->make(true);
// }

    public function edit($hashedId)
{
    $kelassiswa = Kelassiswa::with('Siswa','Tahunakademik','Kelas','Datamengajar')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
   

    if (!$kelassiswa) {
        abort(404, 'Kelas Siswa not found.');
    }
    $tahuns = Tahunakademik::all();
    $kelass = Kelas::all();

    return view('Kelassiswa.edit', compact('kelassiswa', 'hashedId', 'tahuns','kelass'));
}
//     public function edit($hashedId)
// {
//     $kelassiswa = Kelassiswa::with('Siswa','Tahunakademik','Kelas','Datamengajar')->get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });
//     $selectedSiswa = $kelassiswa->Siswa()->pluck('siswa_id')->toArray();

//     $selectedMengajar = $kelassiswa->Datamengajar()->pluck('id')->toArray();
   

//     if (!$kelassiswa) {
//         abort(404, 'Kelas Siswa not found.');
//     }
//     $siswas = Siswa::all();
//     $tahuns = Tahunakademik::all();
//     $datamengajars = Data_mengajar::all();
//     $kelass = Kelas::all();

//     return view('Kelassiswa.edit', compact('kelassiswa', 'hashedId', 'siswas','tahuns','datamengajars','kelass','selectedSiswa','selectedMengajar'));
// }
public function update(Request $request, $hashedId)
{
   
    $validatedData = $request->validate([
        'siswa_id' => ['required','array', new NoXSSInput()],
        'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()], 
        'datamengajar_id' => ['required','array', new NoXSSInput()],
        'datamengajar_id.*' => ['exists:tb_datamengajar,id', new NoXSSInput()],
        'kelas_id' => ['required','numeric', new NoXSSInput()],
        'tahunakademik_id' => ['required','numeric', new NoXSSInput(),
        function ($attribute, $value, $fail) use ($request) {
            $count = Kelassiswa::where('tahunakademik_id', $value)
                ->count();
            if ($count >= 1) {
                $fail("Tahun Akademik sudah Terdaftar.");
            }
        },
        function ($attribute, $value, $fail) {
            $sanitizedValue = strip_tags($value);
            if ($sanitizedValue !== $value) {
                $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
            }
        }
    ],
        'ket' => ['required','max:50', new NoXSSInput()],     
    ]);
    $kelassiswa = Kelassiswa::get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
    if (!$kelassiswa) {
        return redirect()->route('Kelassiswa.index')->with('error', 'ID tidak valid.');
    }
    $kelassiswaData = [
        'siswa_id' => $validatedData['siswa_id'],
        'datamengajar_id' => $validatedData['datamengajar_id'],
        'kelas_id' => $validatedData['kelas_id'],
        'tahunakademik_id' => $validatedData['tahunakademik_id'],
        'ket' => $validatedData['ket'],
        // 'ket' => $roles,
    ];
    $kelassiswa->update($kelassiswaData);
    return redirect()->route('Kelassiswa.index')->with('success', 'Organisasi Berhasil Diupdate.');
}
    public function store(Request $request)
{

    $request->validate([
        'kelas_id' => ['required','numeric', new NoXSSInput()],
        'tahunakademik_id' => ['required','numeric', new NoXSSInput(),
        function ($attribute, $value, $fail) use ($request) {
            $count = Kelassiswa::where('tahunakademik_id', $value)
                ->count();
            if ($count >= 1) {
                $fail("Tahun Akademik sudah terdaftar.");
            }
        },
        function ($attribute, $value, $fail) {
            $sanitizedValue = strip_tags($value);
            if ($sanitizedValue !== $value) {
                $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
            }
        }
    ],
        'ket' => ['required','max:50', new NoXSSInput()],
    ]);
    $tahunakademik_id = $request->input('tahunakademik_id');
    $kelas_id = $request->input('kelas_id');
    $ket = $request->input('ket');
            DB::table('tb_kelas_siswa')->insert([
                'tahunakademik_id' => $tahunakademik_id,
                'kelas_id' => $kelas_id,
                'ket' => $ket,
                
            ]);
    return redirect()->route('Kelassiswa.index')->with('success', 'Data berhasil disimpan.');
}
//     public function store(Request $request)
// {

//     $request->validate([
//         'siswa_id' => ['required','array', new NoXSSInput()],
//         'siswa_id.*' => ['exists:tb_siswa,siswa_id', new NoXSSInput()], 
//         'datamengajar_id' => ['required','array', new NoXSSInput()],
//         'datamengajar_id.*' => ['exists:tb_datamengajar,id', new NoXSSInput()],
//         'kelas_id' => ['required','numeric', new NoXSSInput()],
//         'tahunakademik_id' => ['required','numeric', new NoXSSInput(),
//         function ($attribute, $value, $fail) use ($request) {
//             $count = Kelassiswa::where('tahunakademik_id', $value)
//                 ->count();
//             if ($count >= 1) {
//                 $fail("Tahun Akademik $value sudah memiliki maksimal 2 semester (Ganjil dan Genap).");
//             }
//         },
//         function ($attribute, $value, $fail) {
//             $sanitizedValue = strip_tags($value);
//             if ($sanitizedValue !== $value) {
//                 $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//             }
//         }
//     ],
//         'ket' => ['required','max:50', new NoXSSInput()],
//     ]);

//     $siswa_ids = $request->input('siswa_id');
//     $datamengajar_ids = $request->input('datamengajar_id');
//     $tahunakademik_id = $request->input('tahunakademik_id');
//     $kelas_id = $request->input('kelas_id');
//     $ket = $request->input('ket');

//     foreach ($siswa_ids as $siswa_id) {
//         foreach ($datamengajar_ids as $datamengajar_id) {
//             DB::table('tb_kelas_siswa')->insert([
//                 'siswa_id' => $siswa_id,
//                 'datamengajar_id' => $datamengajar_id,
//                 'tahunakademik_id' => $tahunakademik_id,
//                 'kelas_id' => $kelas_id,
//                 'ket' => $ket,
                
//             ]);
//         }
//     }

//     return redirect()->route('Kelassiswa.index')->with('success', 'Data berhasil disimpan.');
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

    
}

