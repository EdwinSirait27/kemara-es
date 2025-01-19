<?php

namespace App\Http\Controllers;

use App\Models\Pengaturankelas;
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
use Illuminate\Validation\Rule;


class PengaturankelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Pengaturankelas.Pengaturankelas');

    }
    public function create()
    {
        $siswas = Siswa::select('siswa_id', 'NamaLengkap', 'status')
               ->where('Status', 'Aktif')
               ->get();

    $tahuns = Tahunakademik::all();
    $datamengajars = Data_mengajar::select('id','matapelajaran_id','guru_id','hari')->get();
    // $kelass = Kelas::all()->where('status','Aktif');
    $kelass = Kelas::with('Tahunakademik')
    ->where('status', 'Aktif')
    ->get();

        return view('Pengaturankelas.create', compact('siswas','tahuns','datamengajars','kelass'));
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
    public function getPengaturankelas()
{
    $pengaturan = Pengaturankelas::with(['Tahunakademik','Kelas'])
        ->select(['id', 'kelas_id', 'tahunakademik_id','ket','status']) // Hanya memilih kolom tahunakademik_id
        ->get()
        ->map(function ($pengaturan) {
            $pengaturan->id_hashed = substr(hash('sha256', $pengaturan->id . env('APP_KEY')), 0, 8);
            $pengaturan->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $pengaturan->id_hashed . '">';
            $pengaturan->action = '
                <a href="' . route('Pengaturankelas.edit', $pengaturan->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Pengaturan Kelas">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';

            $pengaturan->Tahun_Nama = $pengaturan->Tahunakademik ? $pengaturan->Tahunakademik->tahunakademik : 'belum di setel';
            $pengaturan->Semester_Nama = $pengaturan->Tahunakademik ? $pengaturan->Tahunakademik->semester : 'belum di setel';
            $pengaturan->Kelas_Nama = $pengaturan->Kelas ? $pengaturan->Kelas->kelas : 'belum di setel';
            $pengaturan->KelasTahun_Nama = $pengaturan->Kelas->Tahunakademik ? $pengaturan->Kelas->Tahunakademik->tahunakademik : 'blum';
            $pengaturan->Kapasitas_Nama = $pengaturan->Kelas ? $pengaturan->Kelas->kapasitas : 'belum di setel';
            return $pengaturan;
        });
    return DataTables::of($pengaturan)
        ->addColumn('tahunakademik', function ($pengaturan) {
            return $pengaturan->Tahunakademik->tahunakademik;
        })
        ->addColumn('semester', function ($pengaturan) {
            return $pengaturan->Tahunakademik->semester;
        })
        ->addColumn('kelas', function ($pengaturan) {
            return $pengaturan->Kelas->kelas;
        })
        ->addColumn('tahunakademik', function ($pengaturan) {
            return $pengaturan->Kelas->Tahunakademik ? $pengaturan->Kelas->Tahunakademik->tahunakademik : 'Default Tahun Akademik';
        })
        ->addColumn('kapasitas', function ($pengaturan) {
            return $pengaturan->Kelas->kapasitas;
        })
        
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}


    public function edit($hashedId)
{
    $pengaturan = Pengaturankelas::with('Siswa','Tahunakademik','Kelas','Datamengajar')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });
   

    if (!$pengaturan) {
        abort(404, 'Kelas Siswa not found.');
    }
    $tahuns = Tahunakademik::all();
    $kelass = Kelas::all()->where('status','Aktif');


    return view('Pengaturankelas.edit', compact('pengaturan', 'hashedId', 'tahuns','kelass'));
}



public function update(Request $request, $hashedId)
{
    $pengaturan = Pengaturankelas::get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$pengaturan) {
        return redirect()->route('Pengaturankelas.index')->with('error', 'ID tidak valid.');
    }

    // Add validation rules for kelas_id and tahunakademik_id
    $validatedData = $request->validate([
        'kelas_id' => [
            'required',
            Rule::unique('tb_pengaturan_kelas')->where(function ($query) use ($request, $pengaturan) {
                return $query->where('kelas_id', $request->kelas_id)
                            ->where('id', '!=', $pengaturan->id); // Exclude current record
            }),
        ],
        'tahunakademik_id' => ['required',  
        Rule::unique('tb_pengaturan_kelas')->where(function ($query) use ($request, $pengaturan) {
            return $query    ->where('tahunakademik_id', $request->tahunakademik_id)
                        ->where('id', '!=', $pengaturan->id);
        }),
                    ],
        'ket' => ['required', 'max:50', new NoXSSInput()],
        'status' => ['required', 'in:Aktif,NonAktif', new NoXSSInput()],
    ], [
        'kelas_id.unique' => 'Kombinasi Kelas  sudah ada.',
        'tahunakademik_id.unique' => 'Kombinasi Tahunakademik  sudah ada.',
    ]);
                            
    $pengaturan->update([
        'kelas_id' => $validatedData['kelas_id'],
        'tahunakademik_id' => $validatedData['tahunakademik_id'], 
        'ket' => $validatedData['ket'],
        'status' => $validatedData['status'],
    ]);

    return redirect()->route('Pengaturankelas.index')->with('success', 'Pengaturan berhasil diperbarui.');
}

// public function update(Request $request, $hashedId)
// {
//     $pengaturan = Pengaturankelas::get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });
//     if (!$pengaturan) {
//         return redirect()->route('Pengaturankelas.index')->with('error', 'ID tidak valid.');
//     }
//     $validatedData = $request->validate([
//         'kelas_id' => [
//             'required',
//             'numeric',
//             new NoXSSInput(),
//         ],
//         'tahunakademik_id' => [
//             'required',
//             'numeric',
//             new NoXSSInput(),
           
//         ],
//         'ket' => ['required', 'max:50', new NoXSSInput()],
//         'status' => ['required', 'in:Aktif,NonAktif', new NoXSSInput()],
//     ]);
//     $pengaturan->update([
//         'kelas_id' => $validatedData['kelas_id'],
//         'tahunakademik_id' => $validatedData['tahunakademik_id'],
//         'ket' => $validatedData['ket'],
//         'status' => $validatedData['status'],
//     ]);
//     return redirect()->route('Pengaturankelas.index')->with('success', 'Pengaturan berhasil diperbarui.');
// }

// public function update(Request $request, $hashedId)
// {  
//     $validatedData = $request->validate([
//         'kelas_id' => [
//             'required',
//             'numeric',
//             new NoXSSInput(),
//             Rule::unique('pengaturankelas')->where(function ($query) use ($request) {
//                 return $query->where('tahunakademik_id', $request->tahunakademik_id);
//             })->ignore($pengaturankelas->id)
//         ],
//         'tahunakademik_id' => [
//             'required',
//             'numeric',
//             new NoXSSInput(),
//         ],
//         'ket' => ['required','max:50', new NoXSSInput()],     
//         'status' => ['required','in:Aktif,NonAktif', new NoXSSInput()],     
//     ]);
//     $pengaturan = Pengaturankelas::get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });
//     if (!$pengaturan) {
//         return redirect()->route('Pengaturankelas.index')->with('error', 'ID tidak valid.');
//     }
//     $pengaturanData = [
//         'kelas_id' => $validatedData['kelas_id'],
//         'tahunakademik_id' => $validatedData['tahunakademik_id'],
//         'ket' => $validatedData['ket'],
//         'status' => $validatedData['status'],
//     ];
//     $pengaturan->update($pengaturanData);
//     return redirect()->route('Pengaturankelas.index')->with('success', 'Organisasi Berhasil Diupdate.');
// }
public function store(Request $request)
{
    $request->validate([
       'kelas_id' => [
    'required',
    'numeric',
    new NoXSSInput(),
    function ($attribute, $value, $fail) use ($request) {
        $tahunakademikId = $request->input('tahunakademik_id');

        // Cek apakah pasangan kelas_id dan tahunakademik_id sudah ada
        $exists = Pengaturankelas::where('kelas_id', $value)
            ->where('tahunakademik_id', $tahunakademikId)
            ->exists();

        if ($exists) {
            $fail("Pasangan Kelas dan Tahun Akademik sudah terdaftar.");
        }
    },
],
        'tahunakademik_id' => ['required','numeric', new NoXSSInput(),
        function ($attribute, $value, $fail) use ($request) {
            $count = Pengaturankelas::where('tahunakademik_id', $value)
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
        'status' => ['required','in:Aktif,NonAktif', new NoXSSInput()],
    ]);
    // dd($request->all());
    try {
        Pengaturankelas::create([
            'tahunakademik_id' => $request->tahunakademik_id,
            'kelas_id' => $request->kelas_id,
            'ket' => $request->ket,
            'status' => $request->status,
            
        ]);
        return redirect()->route('Pengaturankelas.index')->with('success', 'Data pengaturan kelas created successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to create Data pengaturan kelas: ' . $e->getMessage());
    }

}
public function deletePengaturankelas(Request $request)
{
    $request->validate([
        'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
    ]);
    Pengaturankelas::whereIn('id', $request->ids)->delete();
    return response()->json([
        'success' => true,
        'message' => 'Selected Kelas siswa and their related data deleted successfully.'
    ]);
}
}
