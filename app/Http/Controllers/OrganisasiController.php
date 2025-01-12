<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use App\Models\Tahunakademik;
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
        $tahuns = Tahunakademik::select('id','tahunakademik','semester')->get();

        return view('Organisasi.create',compact('gurus','tahuns'));
    }
    public function getOrganisasi()
    {
        $organisasi = Organisasi::with('Guru','Tahunakademik')->select(['id', 'guru_id' ,'tahunakademik_id','namaorganisasi','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($organisasi) {
                $organisasi->id_hashed = substr(hash('sha256', $organisasi->id . env('APP_KEY')), 0, 8);
                $organisasi->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $organisasi->id_hashed . '">';
                $organisasi->action = '
            <a href="' . route('Organisasi.edit', $organisasi->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $organisasi->Guru_Nama = $organisasi->Guru ? $organisasi->Guru->Nama : '-';
            $organisasi->Tahun_Nama = $organisasi->Tahunakademik ? $organisasi->Tahunakademik->tahunakademik : '-';
            $organisasi->Semester_Nama = $organisasi->Tahunakademik ? $organisasi->Tahunakademik->semester : '-';

                return $organisasi;
            });
        return DataTables::of($organisasi)
        ->addColumn('Nama', function ($organisasi) {
            return $organisasi->Guru->Nama;
        })
        ->addColumn('tahunakademik', function ($organisasi) {
            return $organisasi->Tahunakademik->tahunakademik;
        })
        ->addColumn('created_at', function ($organisasi) {
            return Carbon::parse($organisasi->created_at)->format('d-m-Y H:i:s');
        })
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $organisasi = Organisasi::with('Guru','Tahunakademik')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasi) {
            abort(404, 'organisasi not found.');
        }
        $gurus = Guru::select('guru_id','Nama')->get();
        $tahuns = Tahunakademik::select('id','tahunakademik','semester')->get();


        return view('Organisasi.edit', compact('organisasi', 'hashedId','gurus','tahuns'));
    }
    public function update(Request $request, $hashedId)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()
            ],
            'namaorganisasi' => ['required', 'string', 'max:50', new NoXSSInput()],
            'tahunakademik_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'regex:/^[a-zA-Z0-9 ]+$/', new NoXSSInput()],
            
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
            'tahunakademik_id' => $validatedData['tahunakademik_id'],
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
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
                    
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
         'guru_id' => ['required', 'string', new NoXSSInput()],
         'tahunakademik_id' => ['required', 'string', new NoXSSInput()],
         'namaorganisasi' => ['required', 'string', 'max:50',new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string',  new NoXSSInput()],
        ]);
        try {
            Organisasi::create([
                'guru_id' => $request->guru_id,
                'tahunakademik_id' => $request->tahunakademik_id,
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
