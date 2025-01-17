<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\Rule;


class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Kelas.Kelas');

    }
    public function create()
    {
        $gurus = Guru::select('guru_id','Nama')->get();
        $tahuns = Tahunakademik::select('id','tahunakademik','semester')->get();

        return view('Kelas.create',compact('gurus','tahuns'));
    }
    public function getKelas()
    {
        $kelas = Kelas::with('Guru','Tahunakademik')->select(['id','guru_id','tahunakademik_id' ,'kelas','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($kelas) {
                $kelas->id_hashed = substr(hash('sha256', $kelas->id . env('APP_KEY')), 0, 8);
                $kelas->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelas->id_hashed . '">';
                $kelas->action = '
            <a href="' . route('Kelas.edit', $kelas->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $kelas->Guru_Nama = $kelas->Guru ? $kelas->Guru->Nama : '-';
            $kelas->Tahun_Nama = $kelas->Tahunakademik ? $kelas->Tahunakademik->tahunakademik : 'blum';
            $kelas->Semester_Nama = $kelas->Tahunakademik ? $kelas->Tahunakademik->semester : '-';
               
            return $kelas;
            });
        return DataTables::of($kelas)
        ->addColumn('Nama', function ($kelas) {
            return $kelas->Guru->Nama;
        })
        ->addColumn('tahunakademik', function ($kelas) {
            return $kelas->Tahunakademik ? $kelas->Tahunakademik->tahunakademik : 'Default Tahun Akademik';
        })
        
       
        ->addColumn('created_at', function ($kelas) {
            return Carbon::parse($kelas->created_at)->format('d-m-Y H:i:s');
        })
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $kelas = Kelas::with('Guru','Tahunakademik')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelas) {
            abort(404, 'Kelas not found.');
        }
        $gurus = Guru::select('guru_id','Nama')->get();
        $tahuns = Tahunakademik::select('id','tahunakademik','semester')->get();


        return view('Kelas.edit', compact('kelas', 'hashedId','gurus','tahuns'));
    }
    public function update(Request $request, $hashedId)
{
    // dd($request->all());

    // Temukan kelas berdasarkan hashed ID
    $kelas = Kelas::get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$kelas) {
        return redirect()->route('Kelas.index')->with('error', 'ID tidak valid.');
    }

    // Validasi data input
    $validatedData = $request->validate([
        'guru_id' => [
            'required',
            'exists:tb_guru,guru_id',
            new NoXSSInput(),
            function ($attribute, $value, $fail) use ($request, $kelas) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }

                // Cek apakah sudah ada kelas lain dengan guru_id dan kelas yang sama pada tahun akademik yang sama
                $existingKelas = Kelas::where('guru_id', $value)
                    ->where('kelas', $request->kelas)
                    ->where('tahunakademik_id', $request->tahunakademik_id)
                    ->where('id', '!=', $kelas->id) // Abaikan data kelas yang sedang diupdate
                    ->first();

                if ($existingKelas) {
                    $fail("Guru dengan ID $value sudah memiliki kelas '{$request->kelas}' pada tahun akademik ini.");
                }
            }
        ],
        'tahunakademik_id' => [
            'required',
            'exists:tb_tahunakademik,id',
            new NoXSSInput()
        ],
        'kelas' => 'required|string|max:255',
        'kapasitas' => 'nullable|integer',
        'status' => 'nullable|string|max:50',
        'ket' => 'nullable|string|max:255',
    ]);

    // // Cek apakah kombinasi guru_id dan kelas sudah ada
    // $existingKelas = Kelas::where('guru_id', $validatedData['guru_id'])
    //     ->where('kelas', $validatedData['kelas'])
    //     ->where('id', '!=', $kelas->id)->first();

    // if ($existingKelas) {
    //     return redirect()->back()->with('error', 'Guru ID sudah ada dengan Kelas yang sama.');
    // }

    // Data untuk pembaruan
    $kelasData = [
        'guru_id' => $validatedData['guru_id'],
        'tahunakademik_id' => $validatedData['tahunakademik_id'],
        'kelas' => $validatedData['kelas'],
        'kapasitas' => $validatedData['kapasitas'] ?? $kelas->kapasitas,
        'status' => $validatedData['status'] ?? $kelas->status,
        'ket' => $validatedData['ket'] ?? $kelas->ket,
    ];

    // Perbarui data kelas
    $kelas->update($kelasData);

    return redirect()->route('Kelas.index')->with('success', 'Kelas Berhasil Diupdate.');
}


    public function deleteKelas(Request $request)
    {
        $request->validate([
            
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],

        
        ]);
        Kelas::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Kelas and their related data deleted successfully.'
        ]);
    }

public function store(Request $request)
{
    // dd($request->all());

    $validatedData = $request->validate([
        'guru_id' => [
            'required',
            'exists:tb_guru,guru_id',
            new NoXSSInput(),
            function ($attribute, $value, $fail) use ($request) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
    
                // Cek apakah sudah ada kelas dengan guru_id dan kelas yang sama pada tahun akademik yang sama
                $existingKelas = Kelas::where('guru_id', $value)
                    ->where('kelas', $request->kelas)
                    ->where('tahunakademik_id', $request->tahunakademik_id)
                    ->first();
    
                if ($existingKelas) {
                    $fail("Guru dengan ID $value sudah memiliki kelas '{$request->kelas}' pada tahun akademik ini.");
                }
            }
        ],
        'tahunakademik_id' => [
            'required',
            'exists:tb_tahunakademik,id',
            new NoXSSInput()
        ],
        'kelas' => 'required|string|max:255',
        'kapasitas' => 'nullable|integer',
        'status' => 'nullable|string|max:50',
        'ket' => 'nullable|string|max:255',
    ]);

    // Log data yang sudah divalidasi
    Log::info('Validated Data:', $validatedData);

 
    try {
        // Log sebelum menyimpan data
        Log::info('Creating Kelas with data:', $validatedData);

        Kelas::create([
            'guru_id' => $validatedData['guru_id'],
            'tahunakademik_id' => $validatedData['tahunakademik_id'],
            'kelas' => $validatedData['kelas'],
            'kapasitas' => $validatedData['kapasitas'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
        ]);

        return redirect()->route('Kelas.index')->with('success', 'Kelas berhasil dibuat!');
    } catch (\Exception $e) {
        // Log jika ada error saat menyimpan
        Log::error('Error creating kelas:', [
            'error' => $e->getMessage(),
            'data' => $validatedData
        ]);
        return redirect()->back()->with('error', 'Gagal membuat Kelas: ' . $e->getMessage());
    }
}

//     public function store(Request $request)
// {
//         // dd($request->all());

//     $validatedData = $request->validate([
//         'guru_id' => [
//             'required',
//             'exists:tb_guru,guru_id',
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ], // pastikan guru_id valid
//         'tahunakademik_id' => [
//             'required',
//             'exists:tb_tahunakademik,id',
//             new NoXSSInput()], // pastikan guru_id valid
//         'kelas' => 'required|string',
//         'kapasitas' => 'nullable|integer',
//         'status' => 'nullable|string',
//         'ket' => 'nullable|string',
//     ]);

//     $existingKelas = Kelas::where('guru_id', $validatedData['guru_id'])
//         ->where('kelas', $validatedData['kelas'])
//         ->first();

//     if ($existingKelas) {
//         return redirect()->back()->with('error', 'Guru ID sudah ada dengan Kelas yang sama.');
//     }

//     try {
//         Kelas::create([
//             'guru_id' => $validatedData['guru_id'],
//             'tahunakademik_id' => $validatedData['tahunakademik_id'],
//             'kelas' => $validatedData['kelas'],
//             'kapasitas' => $validatedData['kapasitas'],
//             'status' => $validatedData['status'],
//             'ket' => $validatedData['ket'],
//         ]);

//         return redirect()->route('Kelas.index')->with('success', 'Kelas berhasil dibuat!');
//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'Gagal membuat Kelas: ' . $e->getMessage());
//     }
// }

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //      'guru_id' => ['required', 'string','unique:tb_kelas,guru_id',new NoXSSInput(),
    //      function ($attribute, $value, $fail) {
    //          $sanitizedValue = strip_tags($value);
    //          if ($sanitizedValue !== $value) {
    //              $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
    //          }
    //      }],
    //      'kelas' => ['required', 'string', 'max:4','unique:tb_kelas,kelas',new NoXSSInput(),
    //      function ($attribute, $value, $fail) {
    //          $sanitizedValue = strip_tags($value);
    //          if ($sanitizedValue !== $value) {
    //              $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
    //          }
    //      }],
    //         'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput(),
    //         function ($attribute, $value, $fail) {
    //             $sanitizedValue = strip_tags($value);
    //             if ($sanitizedValue !== $value) {
    //                 $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
    //             }
    //         }],
    //         'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput(),
    //         function ($attribute, $value, $fail) {
    //             $sanitizedValue = strip_tags($value);
    //             if ($sanitizedValue !== $value) {
    //                 $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
    //             }
    //         }],
    //         'ket' => ['required', 'string',  new NoXSSInput(),
    //         function ($attribute, $value, $fail) {
    //             $sanitizedValue = strip_tags($value);
    //             if ($sanitizedValue !== $value) {
    //                 $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
    //             }
    //         }],
    
    //     ]);
    //     try {
    //         Kelas::create([
    //             'guru_id' => $request->guru_id,
    //             'kelas' => $request->kelas,
    //             'kapasitas' => $request->kapasitas,
    //             'status' => $request->status,
    //             'ket' => $request->ket,
    //         ]);
    //         return redirect()->route('Kelas.index')->with('success', 'Kelas created successfully!');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to create Kelas: ' . $e->getMessage());
    //     }
    // }
}
