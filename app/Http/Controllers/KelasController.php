<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;


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
        return view('Kelas.create');
    }
    public function getKelas()
    {
        $kelas = Kelas::select(['id', 'kelas','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($kelas) {
                $kelas->id_hashed = substr(hash('sha256', $kelas->id . env('APP_KEY')), 0, 8);
                $kelas->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $kelas->id_hashed . '">';
                $kelas->action = '
            <a href="' . route('Kelas.edit', $kelas->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                // $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
                return $kelas;
            });
        return DataTables::of($kelas)
        ->addColumn('created_at', function ($kelas) {
            return Carbon::parse($kelas->created_at)->format('d-m-Y H:i:s');
        })
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $kelas = Kelas::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelas) {
            abort(404, 'Kelas not found.');
        }
        return view('Kelas.edit', compact('kelas', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'kelas' => ['required', 'string', 'max:4', 'regex:/^[a-zA-Z]+$/', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'regex:/^[a-zA-Z0-9 ]+$/', new NoXSSInput()],
    
        ]);
        $kelas = Kelas::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$kelas) {
            return redirect()->route('Kelas.index')->with('error', 'ID tidak valid.');
        }
        $kelasData = [
            'kelas' => $validatedData['kelas'],
            'kapasitas' => $validatedData['kapasitas'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
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
        $request->validate([
         'kelas' => ['required', 'string', 'max:4', 'regex:/^[a-zA-Z]+$/', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'regex:/^[a-zA-Z0-9 ]+$/', new NoXSSInput()],
    
        ]);
        try {
            Kelas::create([
                'kelas' => $request->kelas,
                'kapasitas' => $request->kapasitas,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Kelas.index')->with('success', 'Kelas created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Kelas: ' . $e->getMessage());
        }
    }
}
