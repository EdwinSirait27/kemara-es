<?php

namespace App\Http\Controllers;


use App\Models\Ekstrakulikuler;
use App\Models\Guru;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

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
        $ekstrakulikuler = Ekstrakulikuler::with('Guru','Tahunakademik')->select(['id', 'guru_id','tahunakademik_id','namaekstra','kapasitas', 'status', 'ket','created_at','foto'])
            ->get()
            ->map(function ($ekstrakulikuler) {
                $ekstrakulikuler->id_hashed = substr(hash('sha256', $ekstrakulikuler->id . env('APP_KEY')), 0, 8);
                $ekstrakulikuler->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $ekstrakulikuler->id_hashed . '">';
                $ekstrakulikuler->action = '
            <a href="' . route('Ekstrakulikuler.edit', $ekstrakulikuler->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $ekstrakulikuler->foto = $ekstrakulikuler->foto ? $ekstrakulikuler->foto : 'we.jpg';
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
        ->addColumn('foto', function ($ekstrakulikuler) {
            return $ekstrakulikuler->foto;
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
            // 'foto' => ['nullable','image', 'mimes:jpeg,png,jpg', 'max:512'],
            'foto' => ['nullable', 'mimes:jpeg,png,jpg', 'max:512'], // Hapus 'image' jika 'mimes' digunakan.

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
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('public/ekskul', $fileName); // Simpan file ke folder public/fotoguru
            $filePath = $fileName;
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan nilai foto yang lama
            $filePath = $ekstrakulikuler->foto ?? null; // Ambil foto lama atau null jika tidak ada
        }
        if ($ekstrakulikuler && $ekstrakulikuler->foto && Storage::exists('public/ekskul/' . $ekstrakulikuler->foto)) {
            Storage::delete('public/ekskul/' . $ekstrakulikuler->foto);
        }
        if (!$ekstrakulikuler) {
            return redirect()->route('Ekstrakulikuler.index')->with('error', 'ID tidak valid.');
        }
        $ekstrakulikulerData = [
            'foto' => $filePath,
            'guru_id' => $validatedData['guru_id'],
            'tahunakademik_id' => $validatedData['tahunakademik_id'],
            'namaekstra' => $validatedData['namaekstra'],
            'kapasitas' => $validatedData['kapasitas'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $ekstrakulikuler->update($ekstrakulikulerData);
        if ($filePath && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
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
    // Validasi input
    $request->validate([
       'foto' => ['nullable', 'mimes:jpeg,png,jpg', 'max:512'], // Hapus 'image' jika 'mimes' digunakan.

        'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()],
        'namaekstra' => ['required', 'string', 'max:50', new NoXSSInput()],
        'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
        'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
        'ket' => ['required', 'string', 'max:50', new NoXSSInput()],
    ]);

    $filePath = null;

    // Upload file jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        
        // Simpan file ke storage
        $filePath = $file->storeAs('public/ekskul', $fileName); 
    }

    try {
        // Simpan data ke database
        Ekstrakulikuler::create([
            'foto' => $filePath ? basename($filePath) : null,
            'guru_id' => $request->guru_id,
            'tahunakademik_id' => $request->tahunakademik_id,
            'namaekstra' => $request->namaekstra,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
            'ket' => $request->ket,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('Ekstrakulikuler.index')->with('success', 'Ekstrakulikuler created successfully!');
    } catch (\Exception $e) {
        // Hapus file yang sudah di-upload jika terjadi kesalahan
        if ($filePath && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Redirect dengan pesan error
        return redirect()->back()->with('error', 'Failed to create Ekstrakulikuler: ' . $e->getMessage());
    }
}

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'foto' => [
    //             'nullable', 
    //             'image', 
    //             'mimes:jpeg,png,jpg', 
    //             'max:512'
    //         ],
    //         'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()],
    //         'namaekstra' => ['required', 'string', 'max:50', new NoXSSInput()],
    //         'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
    //         'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
    //         'ket' => ['required', 'string', 'max:50', new NoXSSInput()],

    //     ]);
    //     $filePath = null;
    
    //     if ($request->hasFile('foto')) {
    //         $file = $request->file('foto');
    //         $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
    //         $file->storeAs('public/ekskul', $fileName); 
    //         $filePath = $fileName;
    //         if ($->foto && $->foto && Storage::exists('public/ekskul/' . $->foto)) {
    //             Storage::delete('public/ekskul/' . $->foto);
    //         }
    //     }
    //     try {
    //         Ekstrakulikuler::create([
    //             'foto' => $filePath, 

    //             'guru_id' => $request->guru_id,
    //             'tahunakademik_id' => $request->tahunakademik_id,
    //             'namaekstra' => $request->namaekstra,
    //             'kapasitas' => $request->kapasitas,
    //             'status' => $request->status,
    //             'ket' => $request->ket,
    //         ]);
    //         return redirect()->route('Ekstrakulikuler.index')->with('success', 'Ekstrakulikuler created successfully!');
    //     } catch (\Exception $e) {
    //         if ($filePath && Storage::exists($filePath)) {
    //             Storage::delete($filePath);
    //         }
    //         return redirect()->back()->with('error', 'Failed to create Ekstrakulikuler: ' . $e->getMessage());
    //     }
    // }
}
