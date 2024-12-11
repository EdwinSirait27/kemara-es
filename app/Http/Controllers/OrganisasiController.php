<?php

namespace App\Http\Controllers;


use App\Models\Ekstrakulikuler;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

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
        return view('Organisasi.create');
    }
    public function getOrganisasi()
    {
        $organisasi = Organisasi::select(['id', 'namaorganisasi','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($organisasi) {
                $organisasi->id_hashed = substr(hash('sha256', $organisasi->id . env('APP_KEY')), 0, 8);
                $organisasi->created_at = Carbon::parse($organisasi->created_at)->format('d-m-Y H:i:s');
                $organisasi->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $organisasi->id_hashed . '">';
                $organisasi->action = '
            <a href="' . route('Organisasi.edit', $organisasi->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                return $organisasi;
            });
        return DataTables::of($organisasi)
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $organisasi = Organisasi::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasi) {
            abort(404, 'organisasi not found.');
        }
        return view('Organisasi.edit', compact('organisasi', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
        //   
'namaorganisasi' => 'required|string|max:50|regex:/^[a-zA-Z ]+$/',

            'kapasitas' => 'required|string|max:2',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'ket' => 'required|string|regex:/^[a-zA-Z0-9 ]+$/',
        ]);
        $organisasi = Organisasi::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$organisasi) {
            return redirect()->route('Organisasi.index')->with('error', 'ID tidak valid.');
        }
        $organisasiData = [
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
            'ids' => 'required|array|min:1',
            // 'ids.*' => 'uuid',
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
            // 'namaekstra' => 'required|string|max:50|regex:/^[a-zA-Z]+$/',
'namaorganisasi' => 'required|string|max:50|regex:/^[a-zA-Z ]+$/',

            'kapasitas' => 'required|string|max:2',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'ket' => 'required|string|regex:/^[a-zA-Z0-9 ]+$/',
        ]);
        try {
            Organisasi::create([
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
