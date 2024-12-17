<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunakademik;
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
        return view('Tahunakademik.create');
    }
    public function getTahunakademik()
    {
        $tahunakademik = Tahunakademik::select(['id', 'tahunakademik', 'semester', 'tanggalmulai','tanggalakhir','created_at','updated_at','status', 'ket'])
            ->get()
            ->map(function ($tahunakademik) {
                $tahunakademik->id_hashed = substr(hash('sha256', $tahunakademik->id . env('APP_KEY')), 0, 8);
                $tahunakademik->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $tahunakademik->id_hashed . '">';
                $tahunakademik->action = '
            <a href="' . route('Tahunakademik.edit', $tahunakademik->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                return $tahunakademik;
            });
        return DataTables::of($tahunakademik)
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
        $tahunakademik = Tahunakademik::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tahunakademik) {
            abort(404, 'Tahun akademik not found.');
        }
        return view('Tahunakademik.edit', compact('tahunakademik', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'tahunakademik' => ['required','string','max:4','regex:/^[0-9]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'semester' => ['required','string','in:Ganjil,Genap', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'tanggalmulai' => ['required','date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'tanggalakhir' => ['required','date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'status' => ['required','string','in:Aktif,Tidak Aktif', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'ket' => ['required','string', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
        ]);
        $tahunakademik = Tahunakademik::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tahunakademik) {
            return redirect()->route('Tahunakademik.index')->with('error', 'ID tidak valid.');
        }
        $tahunakademikData = [
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
            'ids' => ['required','array','min:1', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
        ]);
        Tahunakademik::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Kurikulum and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tahunakademik' => ['required','string','max:4','regex:/^[0-9]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'semester' => ['required','string','in:Ganjil,Genap', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'tanggalmulai' => ['required','date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'tanggalakhir' => ['required','date', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'status' => ['required','string','in:Aktif,Tidak Aktif', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'ket' => ['required','string', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
        ]);
        try {
            Tahunakademik::create([
                'tahunakademik' => $request->tahunakademik,
                'semester' => $request->semester,
                'tanggalmulai' => $request->tanggalmulai,
                'tanggalakhir' => $request->tanggalakhir,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Tahunakademik.index')->with('success', 'Tahunakademik created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Tahunakademik: ' . $e->getMessage());
        }
    }
}


