<?php

namespace App\Http\Controllers;


use App\Models\Ekstrakulikuler;
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
        return view('Ekstrakulikuler.create');
    }
    public function getEkstrakulikuler()
    {
        $ekstrakulikuler = Ekstrakulikuler::select(['id', 'namaekstra','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($ekstrakulikuler) {
                $ekstrakulikuler->id_hashed = substr(hash('sha256', $ekstrakulikuler->id . env('APP_KEY')), 0, 8);
                $ekstrakulikuler->created_at = Carbon::parse($ekstrakulikuler->created_at)->format('d-m-Y H:i:s');
                $ekstrakulikuler->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrakulikuler->id_hashed . '">';
                $ekstrakulikuler->action = '
            <a href="' . route('Ekstrakulikuler.edit', $ekstrakulikuler->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                return $ekstrakulikuler;
            });
        return DataTables::of($ekstrakulikuler)
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $ekstrakulikuler = Ekstrakulikuler::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$ekstrakulikuler) {
            abort(404, 'ekstrakulikuler not found.');
        }
        return view('Ekstrakulikuler.edit', compact('ekstrakulikuler', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'namaekstra' => ['required', 'string', 'max:50','regex:/^[a-zA-Z ]+$/', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'max:50','regex:/^[a-zA-Z0-9 ]+$/', new NoXSSInput()],

        ]);
        $ekstrakulikuler = Ekstrakulikuler::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$ekstrakulikuler) {
            return redirect()->route('Ekstrakulikuler.index')->with('error', 'ID tidak valid.');
        }
        $ekstrakulikulerData = [
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
            'namaekstra' => ['required', 'string', 'max:50','regex:/^[a-zA-Z ]+$/', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'max:50','regex:/^[a-zA-Z0-9 ]+$/', new NoXSSInput()],

        ]);
        try {
            Ekstrakulikuler::create([
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
