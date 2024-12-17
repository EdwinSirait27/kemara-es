<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Osis;
use App\Models\Siswa;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


class OsisController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Osis.Osis');

    }
    public function create()
    {
        $siswas = Siswa::select('siswa_id','NamaLengkap')->get(); // Ambil hanya kolom yang diperlukan
        return view('Osis.create', compact('siswas'));
    }
    

public function getOsis()
{
    $siswa = Osis::with('Siswa')
        ->select(['id', 'siswa_id', 'visi', 'misi'])
        ->get()
        ->map(function ($osis) {
            $osis->id_hashed = substr(hash('sha256', $osis->id . env('APP_KEY')), 0, 8);
            $osis->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $osis->id_hashed . '">';
            $osis->action = '
                <a href="' . route('Osis.edit', $osis->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';

            $osis->Siswa_Nama = $osis->Siswa ? $osis->Siswa->NamaLengkap : '-';
            $osis->Siswa_Foto = $osis->Siswa ? $osis->Siswa->foto : '-';
            return $osis;
        });
    return DataTables::of($siswa)
        ->addColumn('NamaLengkap', function ($osis) {
            return $osis->Siswa->NamaLengkap;
        })
        ->addColumn('foto', function ($osis) {
            // Menampilkan gambar di tabel jika ada foto
            return $osis->Siswa->foto;
        })
        
        ->rawColumns(['checkbox', 'action','Foto'])
        ->make(true);
}

    public function edit($hashedId)
{
    $siswa = Osis::with('Siswa')->get()->first(function ($u) use ($hashedId) {
        $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
        return $expectedHash === $hashedId;
    });

    if (!$siswa) {
        abort(404, 'Siswa not found.');
    }

    // Ambil semua data siswa untuk dropdown
    $siswas = Siswa::all();

    return view('Osis.edit', compact('siswa', 'hashedId', 'siswas'));
}
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'visi' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
            'misi' => ['required', 'string', 'max:50', new NoXSSInput(),
            function ($attribute, $value, $fail) {
                $sanitizedValue = strip_tags($value);
                if ($sanitizedValue !== $value) {
                    $fail("Input $attribute mengandung tag HTML yang tidak diperbolehkan.");
                }
            }],
        ]);
        // dd($request->all());
        try {
            Osis::create([
                'siswa_id' => $request->siswa_id,
                'visi' => $request->visi,
                'misi' => $request->misi,
            ]);
            return redirect()->route('Osis.index')->with('success', 'Osis created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Osis: ' . $e->getMessage());
        }

    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'siswa_id' => ['nullable', 'numeric', 'regex:/^[a-zA-Z0-9_-]+$/', new NoXSSInput()],
            'visi' => ['required', 'string', 'max:50', new NoXSSInput()],
            'misi' => ['required', 'string', 'max:50', new NoXSSInput()],
        ]);
        $osis = Osis::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$osis) {
            return redirect()->route('Osis.index')->with('error', 'ID tidak valid.');
        }
        $osisData = [
            'siswa_id' => $validatedData['siswa_id'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            // 'ket' => $roles,
        ];
        $osis->update($osisData);
        return redirect()->route('Osis.index')->with('success', 'Osis Berhasil Diupdate.');
    }
    public function deleteOsis(Request $request)
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
        Osis::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Osis and their related data deleted successfully.'
        ]);
    }


}
