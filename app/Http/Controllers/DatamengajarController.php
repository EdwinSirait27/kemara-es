<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Guru;
use App\Models\Matapelajaran;
use App\Models\Data_mengajar;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;

class DatamengajarController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Datamengajar.Datamengajar');

    }
    public function create()
    {
        $gurus = Guru::select('guru_id','Nama')->get(); // Ambil hanya kolom yang diperlukan
        $matpels = Matapelajaran::select('id','matapelajaran')->get(); // Ambil hanya kolom yang diperlukan
        return view('Datamengajar.create', compact('gurus','matapels'));
    }
    

public function getDatamengajar()
{
    $datamengajar = Data_mengajar::with(['Guru','Matapelajaran'])
        ->select(['id', 'matapelajaran_id', 'guru_id','hari','awalpel','akhirpel','awalis','akhiris','ket'])
        ->get()
        ->map(function ($datamengajar) {
            $datamengajar->id_hashed = substr(hash('sha256', $datamengajar->id . env('APP_KEY')), 0, 8);
            $datamengajar->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $datamengajar->id_hashed . '">';
            $datamengajar->action = '
                <a href="' . route('Datamengajar.edit', $datamengajar->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';

            $datamengajar->Guru_Nama = $datamengajar->Guru ? $datamengajar->Guru->Nama : '-';
            $datamengajar->Mata_Nama = $datamengajar->Matapelajaran ? $datamengajar->Matapelajaran->matapelajaran : '-';
            return $datamengajar;
        });
    return DataTables::of($datamengajar)
        ->addColumn('Nama', function ($datamengajar) {
            return $datamengajar->Guru->Nama;
        })
        ->addColumn('matapelajaran', function ($datamengajar) {
            // Menampilkan gambar di tabel jika ada foto
            return $datamengajar->Matapelajaran->matapelajaran;
        })
        
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}

    public function edit($hashedId)
{
    $datamengajar = Data_mengajar::with(['Guru','Matapelajaran'])->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$datamengajar) {
        abort(404, 'Data mengajar not found.');
    }

    // Ambil semua data siswa untuk dropdown
    $matpels = Matapelajaran::all();
    $gurus = Guru::all();

    return view('Datamengajar.edit', compact('datamengajar', 'hashedId', 'gurus','matpels'));
}
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'matapelajaran_id' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],

            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'awalpel' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'akhirpel' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'awalis' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'akhiris' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'ket' => ['required', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
        ]);
        // dd($request->all());
        try {
            Data_mengajar::create([
                'guru_id' => $request->guru_id,
                'matapelajaran_id' => $request->matapelajaran_id,
                'hari' => $request->hari,
                'awalpel' => $request->awalpel,
                'akhirpel' => $request->akhirpel,
                'awalis' => $request->awalis,
                'akhiris' => $request->akhiris,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Datamengajar.index')->with('success', 'Data mengajar created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Data mengajar: ' . $e->getMessage());
        }

    }
    public function update(Request $request, $hashedId)
    {
        // dd($request->all());
        
        $validatedData = $request->validate([
           'guru_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'matapelajaran_id' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],

            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'awalpel' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'akhirpel' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'awalis' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'akhiris' => ['required', 'time', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'ket' => ['required', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
        ]);
        $datamengajar = Data_mengajar::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$datamengajar) {
            return redirect()->route('Datamengajar.index')->with('error', 'ID tidak valid.');
        }
        $datamengajarData = [
            'guru_id' => $validatedData['guru_id'],
            'matapelajaran_id' => $validatedData['matapelajaran_id'],
            'hari' => $validatedData['hari'],
            'awalpel' => $validatedData['awalpel'],
            'akhirpel' => $validatedData['akhirpel'],
            'awalis' => $validatedData['awalis'],
            'akhiris' => $validatedData['akhiris'],
            'ket' => $validatedData['ket'],
            
        ];
        $datamengajar->update($datamengajarData);
        return redirect()->route('Datamengajar.index')->with('success', 'datamengajar Berhasil Diupdate.');
    }
    public function deleteDatamengajar(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1'],
        ]);
        Data_mengajar::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Osis and their related data deleted successfully.'
        ]);
    }
}
