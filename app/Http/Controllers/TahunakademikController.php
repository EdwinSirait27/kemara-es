<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunakademik;
use App\Models\Kurikulum;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;



class TahunakademikController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        
        return view('Tahunakademik.Tahunakademik');
        
    }
    public function create()
    {
        $kurikulums = Kurikulum::all(); // Pastikan model Kurikulum benar // Ambil hanya kolom yang diperlukan
        return view('Tahunakademik.create',compact('kurikulums'));
    }
    public function getTahunakademik()
    {
        $tahunakademik = Tahunakademik::with('Kurikulum')->select(['id', 'kurikulum_id','tahunakademik', 'semester', 'tanggalmulai','tanggalakhir','created_at','updated_at','status', 'ket'])
            ->get()
            ->map(function ($tahunakademik) {
                $tahunakademik->id_hashed = substr(hash('sha256', $tahunakademik->id . env('APP_KEY')), 0, 8);
                $tahunakademik->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $tahunakademik->id_hashed . '">';
                $tahunakademik->action = '
            <a href="' . route('Tahunakademik.edit', $tahunakademik->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $tahunakademik->Kurikulum_Nama = $tahunakademik->Kurikulum ? $tahunakademik->Kurikulum->kurikulum : '-';
            
                return $tahunakademik;
            });
        return DataTables::of($tahunakademik)
        ->addColumn('kurikulum', function ($tahunakademik) {
            return $tahunakademik->Kurikulum->kurikulum;
        })
        ->addColumn('tanggalmulai', function ($tahunakademik) {
            return Carbon::parse($tahunakademik->tanggalmulai)->format('d-m-Y');
        })
        ->addColumn('tanggalakhir', function ($tahunakademik) {
            return Carbon::parse($tahunakademik->tanggalakhir)->format('d-m-Y');
        })
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $tahunakademik = Tahunakademik::with('Kurikulum')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tahunakademik) {
            abort(404, 'Tahun akademik not found.');
        }
        $kurikulums = Kurikulum::all();

        return view('Tahunakademik.edit', compact('tahunakademik', 'hashedId','kurikulums'));
    }
    public function update(Request $request, $hashedId)
    {
// dd($request->all());

        $validatedData = $request->validate([
            'kurikulum_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput()],

            'tahunakademik' => [
                'required', 
                'string', 
                'max:4', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) use ($request) {
                    // Cek jumlah entri tahunakademik dan semester di database
                    $count = Tahunakademik::where('tahunakademik', $value)
                        ->whereIn('semester', ['Ganjil', 'Genap'])
                        ->count();
                    if ($count >= 2) {
                        $fail("Tahun Akademik $value sudah memiliki maksimal 2 semester (Ganjil dan Genap).");
                    }
                },
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'semester' => [
                'required',
                'string',
                'in:Ganjil,Genap',
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'tanggalmulai' => [
                'required', 
                'date', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'tanggalakhir' => [
                'required', 
                'date', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'status' => [
                'required', 
                'string', 
                'in:Aktif,Tidak Aktif', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'ket' => [
                'required', 
                'string', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
        ]);
        
        $tahunakademik = Tahunakademik::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tahunakademik) {
            return redirect()->route('Tahunakademik.index')->with('error', 'ID tidak valid.');
        }
        $tahunakademikData = [
            'kurikulum_id' => $validatedData['kurikulum_id'],
            'tahunakademik' => $validatedData['tahunakademik'],
            'semester' => $validatedData['semester'],
            'tanggalmulai' => $validatedData['tanggalmulai'],
            'tanggalakhir' => $validatedData['tanggalakhir'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $tahunakademik->update($tahunakademikData);
        return redirect()->route('Tahunakademik.index')->with('success', 'Tahun Akademik Berhasil Diupdate.');
    }
    public function deleteTahunakademik(Request $request)
    {
        $request->validate([
            'ids' => ['required','array','min:1'],  
        ]);
        Tahunakademik::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Kurikulum and their related data deleted successfully.'
        ]);
    }

 

    public function store(Request $request) 
    {
        $request->validate([
            'kurikulum_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput()],
    
            'tahunakademik' => [
                'required', 
                'string', 
                'max:4', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) use ($request) {
                    // Cek apakah semester Ganjil dan Genap sudah terdaftar untuk tahun akademik yang sama
                    $semesterExist = Tahunakademik::where('tahunakademik', $value)
                        ->where('semester', $request->semester)
                        ->exists();
    
                    if ($semesterExist) {
                        $fail("Semester {$request->semester} untuk Tahun Akademik $value sudah terdaftar.");
                    }
                },
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'semester' => [
                'required',
                'string',
                'in:Ganjil,Genap',
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'tanggalmulai' => [
                'required', 
                'date', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'tanggalakhir' => [
                'required', 
                'date', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'status' => [
                'required', 
                'string', 
                'in:Aktif,Tidak Aktif', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
            'ket' => [
                'required', 
                'string', 
                new NoXSSInput(),
                function ($attribute, $value, $fail) {
                    $sanitizedValue = strip_tags($value);
                    if ($sanitizedValue !== $value) {
                        $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                    }
                }
            ],
        ]);
    
        try {
            Tahunakademik::create([
                'kurikulum_id' => $request->kurikulum_id,
                'tahunakademik' => $request->tahunakademik,
                'semester' => $request->semester,
                'tanggalmulai' => $request->tanggalmulai,
                'tanggalakhir' => $request->tanggalakhir,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Tahunakademik.index')->with('success', 'Tahun Akademik created successfully!');
        } catch (\Exception $e) {
            \Log::error("Failed to create Tahunakademik: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create Tahunakademik. Please try again later.');
        }
    }
    
//     public function store(Request $request)
// {
// // dd($request->all());

//     $request->validate([
//         'kurikulum_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput()],

//         'tahunakademik' => [
//             'required', 
//             'string', 
//             'max:4', 
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) use ($request) {
//                 // Cek jumlah entri tahunakademik dan semester di database
//                 $count = Tahunakademik::where('tahunakademik', $value)
//                     ->whereIn('semester', ['Ganjil', 'Genap'])
//                     ->count();
    
//                 // Jika lebih dari dua entri, tolak input
//                 if ($count >= 2) {
//                     $fail("Tahun Akademik $value sudah memiliki maksimal 2 semester (Ganjil dan Genap).");
//                 }
//             },
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ],
//         'semester' => [
//             'required',
//             'string',
//             'in:Ganjil,Genap',
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ],
//         'tanggalmulai' => [
//             'required', 
//             'date', 
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ],
//         'tanggalakhir' => [
//             'required', 
//             'date', 
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ],
//         'status' => [
//             'required', 
//             'string', 
//             'in:Aktif,Tidak Aktif', 
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ],
//         'ket' => [
//             'required', 
//             'string', 
//             new NoXSSInput(),
//             function ($attribute, $value, $fail) {
//                 $sanitizedValue = strip_tags($value);
//                 if ($sanitizedValue !== $value) {
//                     $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
//                 }
//             }
//         ],
//     ]);

//     try {
//         Tahunakademik::create([
//             'kurikulum_id' => $request->kurikulum_id,
//             'tahunakademik' => $request->tahunakademik,
//             'semester' => $request->semester,
//             'tanggalmulai' => $request->tanggalmulai,
//             'tanggalakhir' => $request->tanggalakhir,
//             'status' => $request->status,
//             'ket' => $request->ket,
//         ]);
//         return redirect()->route('Tahunakademik.index')->with('success', 'Tahun Akademik created successfully!');
//     } catch (\Exception $e) {
//         \Log::error("Failed to create Tahunakademik: " . $e->getMessage());
//         return redirect()->back()->with('error', 'Failed to create Tahunakademik. Please try again later.');
//     }
// }

}