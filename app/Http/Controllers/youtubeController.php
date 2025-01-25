<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Rules\NoXSSInput;
use Illuminate\Support\Facades\Log;
class youtubeController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Youtube.index');

    }
    public function create()
    {
        
        return view('Youtube.create');
    }
    public function getYoutube()
    {
        $youtube = Youtube::with('User.Guru')->select(['id', 'user_id', 'url', 'status'])
            ->get()
            ->map(function ($youtube) {
                $youtube->id_hashed = substr(hash('sha256', $youtube->id . env('APP_KEY')), 0, 8);
                $youtube->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $youtube->id_hashed . '">';
                $youtube->action = '
            <a href="' . route('Youtube.edit', $youtube->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $youtube->Guru_Nama = $youtube->User->Guru ? $youtube->User->Guru->Nama : '-';
                
                return $youtube;
            });
        return DataTables::of($youtube)
            ->addColumn('Nama', function ($youtube) {
                return $youtube->User->Guru->Nama;
            })
            
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $youtube = Youtube::with('User.Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$youtube) {
            abort(404, 'youtube not found.');
        }
        return view('Youtube.edit', compact('youtube','hashedId'));
    }
    public function update(Request $request, $hashedId)
    {
        $youtube = Youtube::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$youtube) {
            return redirect()->route('Youtube.index')->with('error', 'ID tidak valid.');
        }
        $validatedData = $request->validate([
        
            'url' => ['required','string','max:255', new NoXSSInput()], 
            'status' => ['nullable', 'in:Aktif,Tidak Aktif', new NoXSSInput()],      
        ]);
        $userId = auth()->id();
        $youtubeData = [
            'user_id' => $userId,
            'url' => $validatedData['url'],
            'status' => $validatedData['status'],
        ];
        $youtube->update($youtubeData);
        return redirect()->route('Youtube.index')->with('success', 'Url Berhasil Diupdate.');
    }
    public function deleteYoutube(Request $request)
    {
        $request->validate([

            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],


        ]);
        Youtube::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected Kelas and their related data deleted successfully.'
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            
            'url' => [
                'required','string','max:255',
                new NoXSSInput()
            ],
            'status' => [
                'required','in:Aktif,Tidak Aktif',
                new NoXSSInput()
            ],
            
        ]);

        // Log data yang sudah divalidasi
        Log::info('Validated Data:', $validatedData);


        try {
            // Log sebelum menyimpan data
            Log::info('Creating youtube with data:', $validatedData);

            Youtube::create([
                'user_id' => auth()->id(),
                'status' => $validatedData['status'],
                'url' => $validatedData['url'],
                
            ]);

            return redirect()->route('Youtube.index')->with('success', 'Youtube berhasil dibuat!');
        } catch (\Exception $e) {
            // Log jika ada error saat menyimpan
            Log::error('Error creating kelas:', [
                'error' => $e->getMessage(),
                'data' => $validatedData
            ]);
            return redirect()->back()->with('error', 'Gagal membuat Youtube: ' . $e->getMessage());
        }
    }
}
