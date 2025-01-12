<?php

namespace App\Http\Controllers;


use App\Models\Ekstrakulikuler;
use App\Models\Guru;
use App\Models\Tahunakademik;
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
        $tahuns = Tahunakademik::select('id','tahunakademik','semester')->get();

        return view('Ekstrakulikuler.create',compact('gurus','tahuns'));
    }
    public function getEkstrakulikuler()
    {
        $ekstrakulikuler = Ekstrakulikuler::with('Guru','Tahunakademik')->select(['id', 'guru_id','tahunakademik_id','namaekstra','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($ekstrakulikuler) {
                $ekstrakulikuler->id_hashed = substr(hash('sha256', $ekstrakulikuler->id . env('APP_KEY')), 0, 8);
                $ekstrakulikuler->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrakulikuler->id_hashed . '">';
                $ekstrakulikuler->action = '
            <a href="' . route('Ekstrakulikuler.edit', $ekstrakulikuler->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $ekstrakulikuler->Guru_Nama = $ekstrakulikuler->Guru ? $ekstrakulikuler->Guru->Nama : '-';
            $ekstrakulikuler->Tahun_Nama = $ekstrakulikuler->Tahunakademik ? $ekstrakulikuler->Tahunakademik->tahunakademik : '-';
            $ekstrakulikuler->Semester_Nama = $ekstrakulikuler->Tahunakademik ? $ekstrakulikuler->Tahunakademik->semester : '-';
            // $ekstrakulikuler->Guru_Nama = $ekstrakulikuler->guru ? $ekstrakulikuler->guru->Nama : '-';

                return $ekstrakulikuler;
            });
        return DataTables::of($ekstrakulikuler)
        ->addColumn('Nama', function ($ekstrakulikuler) {
            return $ekstrakulikuler->Guru->Nama;
        })
        ->addColumn('tahunakademik', function ($ekstrakulikuler) {
            return $ekstrakulikuler->Tahunakademik->tahunakademik;
        })
        ->addColumn('semester', function ($ekstrakulikuler) {
            return $ekstrakulikuler->Tahunakademik->semester;
        })
        ->addColumn('created_at', function ($ekstrakulikuler) {
            return Carbon::parse($ekstrakulikuler->created_at)->format('d-m-Y H:i:s');
        })
        
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $ekstrakulikuler = Ekstrakulikuler::with('Guru','Tahunakademik')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$ekstrakulikuler) {
            abort(404, 'ekstrakulikuler not found.');
        }
        $gurus = Guru::select('guru_id','Nama')->get();
        $tahuns = Tahunakademik::select('id','tahunakademik','semester')->get();

        return view('Ekstrakulikuler.edit', compact('ekstrakulikuler','tahuns' ,'hashedId','gurus'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'tahunakademik_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'namaekstra' => ['required', 'string', 'max:50', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'max:50', new NoXSSInput()],

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
            'tahunakademik_id' => $validatedData['tahunakademik_id'],
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
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
         
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
            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'namaekstra' => ['required', 'string', 'max:50', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'max:50', new NoXSSInput()],

        ]);
        try {
            Ekstrakulikuler::create([
                'guru_id' => $request->guru_id,
                'tahunakademik_id' => $request->tahunakademik_id,
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
