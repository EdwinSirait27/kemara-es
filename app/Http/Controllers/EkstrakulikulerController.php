<?php

namespace App\Http\Controllers;


use App\Models\Ekstrakulikuler;
use App\Models\Guru;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;

class EkstrakulikulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Ekstrakulikuler.Ekstrakulikuler');

    }
    public function create()
    {
        $gurus = Guru::select('guru_id','Nama')->get();

        return view('Ekstrakulikuler.create',compact('gurus'));
    }
    public function getEkstrakulikuler()
    {
        $ekstrakulikuler = Ekstrakulikuler::with('guru')->select(['id', 'guru_id','namaekstra','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($ekstrakulikuler) {
                $ekstrakulikuler->id_hashed = substr(hash('sha256', $ekstrakulikuler->id . env('APP_KEY')), 0, 8);
                $ekstrakulikuler->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrakulikuler->id_hashed . '">';
                $ekstrakulikuler->action = '
            <a href="' . route('Ekstrakulikuler.edit', $ekstrakulikuler->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $ekstrakulikuler->Guru_Nama = $ekstrakulikuler->guru ? $ekstrakulikuler->guru->Nama : '-';

                return $ekstrakulikuler;
            });
        return DataTables::of($ekstrakulikuler)
        ->addColumn('Nama', function ($ekstrakulikuler) {
            return $ekstrakulikuler->guru->Nama;
        })
        ->addColumn('created_at', function ($ekstrakulikuler) {
            return Carbon::parse($ekstrakulikuler->created_at)->format('d-m-Y H:i:s');
        })
        
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $ekstrakulikuler = Ekstrakulikuler::with('guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$ekstrakulikuler) {
            abort(404, 'ekstrakulikuler not found.');
        }
        $gurus = Guru::select('guru_id','Nama')->get();

        return view('Ekstrakulikuler.edit', compact('ekstrakulikuler', 'hashedId','gurus'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'namaekstra' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput(),
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
        $ekstrakulikuler = Ekstrakulikuler::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$ekstrakulikuler) {
            return redirect()->route('Ekstrakulikuler.index')->with('error', 'ID tidak valid.');
        }
        $ekstrakulikulerData = [
            'guru_id' => $validatedData['guru_id'],
            'namaekstra' => $validatedData['namaekstra'],
            'kapasitas' => $validatedData['kapasitas'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $ekstrakulikuler->update($ekstrakulikulerData);
        return redirect()->route('Ekstrakulikuler.index')->with('success', 'ekstrakulikuler Berhasil Diupdate.');
    }
    public function deleteEkstrakulikuler(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
         
        ]);
        Ekstrakulikuler::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected ekstrakulikuler and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'namaekstra' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput(),
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
            Ekstrakulikuler::create([
                'guru_id' => $request->guru_id,
                'namaekstra' => $request->namaekstra,
                'kapasitas' => $request->kapasitas,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Ekstrakulikuler.index')->with('success', 'Ekstrakulikuler created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Ekstrakulikuler: ' . $e->getMessage());
        }
    }
}
