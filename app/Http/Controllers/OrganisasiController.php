<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


class OrganisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Organisasi.Organisasi');

    }
    public function create()
    {
        $gurus = Guru::select('guru_id','Nama')->get();

        return view('Organisasi.create',compact('gurus'));
    }
    public function getOrganisasi()
    {
        $organisasi = Organisasi::with('guru')->select(['id', 'guru_id' ,'namaorganisasi','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($organisasi) {
                $organisasi->id_hashed = substr(hash('sha256', $organisasi->id . env('APP_KEY')), 0, 8);
                $organisasi->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $organisasi->id_hashed . '">';
                $organisasi->action = '
            <a href="' . route('Organisasi.edit', $organisasi->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $organisasi->Guru_Nama = $organisasi->guru ? $organisasi->guru->Nama : '-';

                return $organisasi;
            });
        return DataTables::of($organisasi)
        ->addColumn('Nama', function ($organisasi) {
            return $organisasi->guru->Nama;
        })
        ->addColumn('created_at', function ($organisasi) {
            return Carbon::parse($organisasi->created_at)->format('d-m-Y H:i:s');
        })
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $organisasi = Organisasi::with('guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasi) {
            abort(404, 'organisasi not found.');
        }
        $gurus = Guru::select('guru_id','Nama')->get();

        return view('Organisasi.edit', compact('organisasi', 'hashedId',compact('gurus')));
    }
    public function update(Request $request, $hashedId)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'namaorganisasi' => ['required', 'string', 'max:50', 'unique:tb_organisasi,organisasi',new NoXSSInput(),
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
            'ket' => ['required', 'string', 'regex:/^[a-zA-Z0-9 ]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            
        ]);
        $organisasi = Organisasi::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasi) {
            return redirect()->route('Organisasi.index')->with('error', 'ID tidak valid.');
        }
        $organisasiData = [
            'guru_id' => $validatedData['guru_id'],
            'namaorganisasi' => $validatedData['namaorganisasi'],
            'kapasitas' => $validatedData['kapasitas'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $organisasi->update($organisasiData);
        return redirect()->route('Organisasi.index')->with('success', 'Organisasi Berhasil Diupdate.');
    }
    public function deleteOrganisasi(Request $request)
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
        Organisasi::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Organisasi and their related data deleted successfully.'
        ]);
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
         'guru_id' => ['required', 'string', new NoXSSInput(),
         function ($attribute, $value, $fail) {
             $sanitizedValue = strip_tags($value);
             if ($sanitizedValue !== $value) {
                 $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
             }
         }],
         'namaorganisasi' => ['required', 'string', 'max:4','unique:tb_namaorganisasi,namaorganisasi',new NoXSSInput(),
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
            'ket' => ['required', 'string',  new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
    
        ]);
        try {
            Organisasi::create([
                'guru_id' => $request->guru_id,
                'namaorganisasi' => $request->namaorganisasi,
                'kapasitas' => $request->kapasitas,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Organisasi.index')->with('success', 'Organisasi created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Organisasi: ' . $e->getMessage());
        }
    }
}
