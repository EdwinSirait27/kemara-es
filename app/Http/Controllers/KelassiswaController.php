<?php

namespace App\Http\Controllers;

use App\Models\Kelassiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $siswas = Siswa::select('siswa_id','NamaLengkap')->get(); // Ambil hanya kolom yang diperlukan
    $tahuns = Tahunakademik::all();
    $datamengajars = Data_mengajar::all();
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
    $kelassiswa = Kelassiswa::with('Siswa','Tahunakademik','Kelas','Datamengajar')
        ->select(['id', 'siswa_id', 'kelas_id', 'tahunakademik_id','datamengajar_id','ket'])
        ->get()
        ->map(function ($kelassiswa) {
            $kelassiswa->id_hashed = substr(hash('sha256', $kelassiswa->id . env('APP_KEY')), 0, 8);
            $kelassiswa->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelassiswa->id_hashed . '">';
            $kelassiswa->action = '
                <a href="' . route('Kelassiswa.edit', $kelassiswa->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';

            $kelassiswa->Siswa_Nama = $kelassiswa->Siswa ? $kelassiswa->Siswa->NamaLengkap : '-';
            $kelassiswa->Tahun_Nama = $kelassiswa->Tahunakademik ? $kelassiswa->Tahunakademik->tahunakademik : 'belum di setel';
            $kelassiswa->Semester_Nama = $kelassiswa->Tahunakademik ? $kelassiswa->Tahunakademik->semester : 'belum di setel';
            $kelassiswa->Kelas_Nama = $kelassiswa->Kelas ? $kelassiswa->Kelas->kelas : 'belum di setel';
            $kelassiswa->Kapasitas_Nama = $kelassiswa->Kelas ? $kelassiswa->Kelas->kapasitas : 'belum di setel';
            return $kelassiswa;
        });
    return DataTables::of($kelassiswa)
        ->addColumn('NamaLengkap', function ($kelassiswa) {
            return $kelassiswa->Siswa->NamaLengkap;
        })
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

    public function edit($hashedId)
{
    $kelassiswa = Kelassiswa::with('Siswa','Tahunakademik','Kelas','Datamengajar')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$kelassiswa) {
        abort(404, 'Kelas Siswa not found.');
    }

    $siswas = Siswa::all();
    $tahuns = Tahunakademik::all();
    $datamengajars = Data_mengajar::all();
    $kelass = Kelas::all();

    return view('Kelassiswa.edit', compact('kelassiswa', 'hashedId', 'siswas','tahuns','datamengajars','kelass'));
}
    public function store(Request $request)
    {
        $request->validate([
            'tahunakademik_id' => ['required', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'datamengajar_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'kelas_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'siswa_id' => ['nullable', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'ket' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
        ]);
        try {
            Kelassiswa::create([
                'siswa_id' => implode(',', $request->siswa_id),
                'datamengajar_id' => implode(',', $request->datamengajar_id),
                
                'kelas_id' => $request->kelas_id,
                'tahunakademik_id' => $request->tahunakademik_id,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Kelassiswa.index')->with('success', 'Kelas Siswa created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Kelas Siswa: ' . $e->getMessage());
        }

    }
    // public function update(Request $request, $hashedId)
    // {
    //     // dd($request->all());
        
    //     $validatedData = $request->validate([
    //         'siswa_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput()],
    //         'visi' => ['required', 'string', 'max:50', new NoXSSInput()],
    //         'misi' => ['required', 'string', 'max:50', new NoXSSInput()],
    //     ]);
    //     $osis = Osis::get()->first(function ($u) use ($hashedId) {
    //         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
    //         return $expectedHash === $hashedId;
    //     });
    //     if (!$osis) {
    //         return redirect()->route('Osis.index')->with('error', 'ID tidak valid.');
    //     }
    //     $osisData = [
    //         'siswa_id' => $validatedData['siswa_id'],
    //         'visi' => $validatedData['visi'],
    //         'misi' => $validatedData['misi'],
    //         // 'ket' => $roles,
    //     ];
    //     $osis->update($osisData);
    //     return redirect()->route('Osis.index')->with('success', 'Osis Berhasil Diupdate.');
    // }
    // public function deleteOsis(Request $request)
    // {
    //     $request->validate([
    //         'ids' => ['required', 'array', 'min:1', new NoXSSInput(),
    //         function ($attribute, $value, $fail) {
    //             $sanitizedValue = strip_tags($value);
    //             if ($sanitizedValue !== $value) {
    //                 $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
    //             }
    //         }],
    //     ]);
    //     Osis::whereIn('id', $request->ids)->delete();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Selected Osis and their related data deleted successfully.'
    //     ]);
    // }
}

