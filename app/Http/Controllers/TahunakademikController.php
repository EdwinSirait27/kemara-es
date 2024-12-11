<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunakademik;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;


class TahunakademikController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Tahunakademik.Tahunakademik');

    }
    public function create()
    {
        return view('Tahunakademik.create');
    }
    public function getTahunakademik()
    {
        $tahunakademik = Tahunakademik::select(['id', 'tahunakademik', 'semester', 'tanggalmulai','tanggalakhir','created_at','updated_at','status', 'ket'])
            ->get()
            ->map(function ($tahunakademik) {
                $tahunakademik->id_hashed = substr(hash('sha256', $tahunakademik->id . env('APP_KEY')), 0, 8);
                $tahunakademik->created_at = Carbon::parse($tahunakademik->created_at)->format('d-m-Y H:i:s');
                $tahunakademik->updated_at = Carbon::parse($tahunakademik->updated_at)->format('d-m-Y H:i:s');
                $tahunakademik->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $tahunakademik->id_hashed . '">';
                $tahunakademik->action = '
            <a href="' . route('Tahunakademik.edit', $tahunakademik->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                // $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
                return $tahunakademik;
            });
        return DataTables::of($tahunakademik)
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $tahunakademik = Tahunakademik::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tahunakademik) {
            abort(404, 'Tahun akademik not found.');
        }
        return view('Tahunakademik.edit', compact('tahunakademik', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            // 'tahunakademik' => 'required|string|max:4|regex:/^[a-zA-Z0-9_-]+$/',
            'tahunakademik' => 'required|string|max:4|regex:/^[0-9]+$/',
            'semester' => 'required|string|in:Ganjil,Genap',
            'tanggalmulai' => 'required',
            'tanggalakhir' => 'required',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'ket' => 'required|string|regex:/^[a-zA-Z0-9_-]+$/',
        ]);
        $tahunakademik = Tahunakademik::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tahunakademik) {
            return redirect()->route('Tahunakademik.index')->with('error', 'ID tidak valid.');
        }
        $tahunakademikData = [
            'tahunakademik' => $validatedData['tahunakademik'],
            'semester' => $validatedData['semester'],
            'tanggalmulai' => $validatedData['tanggalmulai'],
            'tanggalakhir' => $validatedData['tanggalakhir'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $tahunakademik->update($tahunakademikData);
        return redirect()->route('Tahunakademik.index')->with('success', 'Tahun Akademik Berhasil Diupdate.');
    }
    public function deleteTahunakademik(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            // 'ids.*' => 'uuid',
        ]);
        Tahunakademik::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Kurikulum and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tahunakademik' => 'required|string|max:4|regex:/^[0-9]+$/',
            'semester' => 'required|string|in:Ganjil,Genap',
            'tanggalmulai' => 'required',
            'tanggalakhir' => 'required',
            'status' => 'required|string|in:Aktif,Tidak Aktif',
            'ket' => 'required|string|regex:/^[a-zA-Z0-9_-]+$/',
            // 'ket' => 'required|string|regex:/^[a-zA-Z0-9 ]+$/',
        ]);
        try {
            Tahunakademik::create([
                'tahunakademik' => $request->tahunakademik,
                'semester' => $request->semester,
                'tanggalmulai' => $request->tanggalmulai,
                'tanggalakhir' => $request->tanggalakhir,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Tahunakademik.index')->with('success', 'Tahunakademik created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Tahunakademik: ' . $e->getMessage());
        }
    }
}


