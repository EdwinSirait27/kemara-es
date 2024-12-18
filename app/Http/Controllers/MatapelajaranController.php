<?php

namespace App\Http\Controllers;

use App\Models\Matapelajaran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


class MatapelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Matapelajaran.Matapelajaran');

    }
    public function create()
    {
        return view('Matapelajaran.create');
    }
    public function getMatapelajaran()
    {
        $matapelajaran = Matapelajaran::select(['id', 'matapelajaran','kkm', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($matapelajaran) {
                $matapelajaran->id_hashed = substr(hash('sha256', $matapelajaran->id . env('APP_KEY')), 0, 8);
                $matapelajaran->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $matapelajaran->id_hashed . '">';
                $matapelajaran->action = '
            <a href="' . route('Matapelajaran.edit', $matapelajaran->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                // $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
                return $matapelajaran;
            });
        return DataTables::of($matapelajaran)
        ->addColumn('created_at', function ($matapelajaran) {
            return Carbon::parse($matapelajaran->created_at)->format('d-m-Y H:i:s');
        })
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $matapelajaran = Matapelajaran::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$matapelajaran) {
            abort(404, 'Mata Pelajaran not found.');
        }
        return view('Matapelajaran.edit', compact('matapelajaran', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'matapelajaran' => ['required','string','max:50', 'unique:tb_matapelajaran,matapelajaran', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'kkm' => ['required','string','max:4',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'status' => ['required','string','in:Aktif,Tidak Aktif',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'ket' => ['required','string',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            
        ]);
        $matapelajaran = Matapelajaran::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$matapelajaran) {
            return redirect()->route('Matapelajaran.index')->with('error', 'ID tidak valid.');
        }
        $matapelajaranData = [
            'matapelajaran' => $validatedData['matapelajaran'],
            'kkm' => $validatedData['kkm'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $matapelajaran->update($matapelajaranData);
        return redirect()->route('Matapelajaran.index')->with('success', 'Mata Pelajaran Berhasil Diupdate.');
    }
    public function deleteMatapelajaran(Request $request)
    {
        $request->validate([
            'ids' => ['required','array','min:1',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
        ]);
        Matapelajaran::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Matapelajaran and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'matapelajaran' => ['required','string','max:50', 'unique:tb_matapelajaran,matapelajaran',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'kkm' => ['required','string','max:4',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'status' => ['required','string','in:Aktif,Tidak Aktif',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            'ket' => ['required','string',new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],  
            
        ]);
        try {
            Matapelajaran::create([
                'matapelajaran' => $request->matapelajaran,
                'kkm' => $request->kkm,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Matapelajaran.index')->with('success', 'Matapelajaran created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Matapelajaran: ' . $e->getMessage());
        }
    }
}


