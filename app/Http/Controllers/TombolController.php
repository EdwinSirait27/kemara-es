<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tombol;
// use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class TombolController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Tombol.Tombol');

    }
    public function create()
    {
        return view('Tombol.create');
    }
    public function getTombol()
    {
        $tombol = Tombol::select(['id', 'url', 'start_date', 'end_date','ket'])
            ->get()
            ->map(function ($tombol) {
                $tombol->id_hashed = substr(hash('sha256', $tombol->id . env('APP_KEY')), 0, 8);
                $tombol->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $tombol->id_hashed . '">';
                $tombol->action = '
            <a href="' . route('Tombol.edit', $tombol->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                // $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';
                return $tombol;
            });
        return DataTables::of($tombol)
                        ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $tombol = Tombol::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tombol) {
            abort(404, 'tombol not found.');
        }
        return view('Tombol.edit', compact('tombol', 'hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'url' => 'required|string|max:50|regex:/^[a-zA-Z0-9_-]+$/',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'ket' => 'required',
            
        ]);
        $tombol = Tombol::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$tombol) {
            return redirect()->route('Tombol.index')->with('error', 'ID tidak valid.');
        }
        $tombolData = [
            'url' => $validatedData['url'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'ket' => $validatedData['ket'],
            
        ];
        $tombol->update($tombolData);
        return redirect()->route('Tombol.index')->with('success', 'Tombol Berhasil Diupdate.');
    }
    public function deleteTombol(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            // 'ids.*' => 'uuid',
        ]);
        Tombol::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Tombol and their related data deleted successfully.'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'url' => 'required|string|max:50|regex:/^[a-zA-Z0-9_-]+$/',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'ket' => 'required',
        ]);
        try {
            Tombol::create([
               'url' => $request->url,
               'start_date' => $request->start_date,
               'end_date' => $request->end_date,
               'ket' => $request->ket,
            
            ]);
            return redirect()->route('Tombol.index')->with('success', 'Tombol created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Tombol: ' . $e->getMessage());
        }
    }
}
