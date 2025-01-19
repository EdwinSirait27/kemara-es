<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use App\Models\Tahunakademik;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $organisasi = Organisasi::with('Guru','Tahunakademik')->select(['id', 'guru_id' ,'foto','tahunakademik_id','namaorganisasi','kapasitas', 'status', 'ket','created_at'])
            ->get()
            ->map(function ($organisasi) {
                $organisasi->id_hashed = substr(hash('sha256', $organisasi->id . env('APP_KEY')), 0, 8);
                $organisasi->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $organisasi->id_hashed . '">';
                $organisasi->action = '
            <a href="' . route('Organisasi.edit', $organisasi->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
            $organisasi->foto = $organisasi->foto ? $organisasi->foto : 'we.jpg';

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
        ->addColumn('foto', function ($organisasi) {
            return $organisasi->foto;
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
            'foto' => ['nullable', 'mimes:jpeg,png,jpg', 'max:512'], // Hapus 'image' jika 'mimes' digunakan.

            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'tahunakademik_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'namaorganisasi' => ['required', 'string', 'max:50', new NoXSSInput()],
            'kapasitas' => ['required', 'string', 'max:2', new NoXSSInput()],
            'status' => ['required', 'string', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'ket' => ['required', 'string', 'max:50', new NoXSSInput()],
            
        ]);
        $organisasi = Organisasi::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('public/organisasi', $fileName); // Simpan file ke folder public/fotoguru
            $filePath = $fileName;
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan nilai foto yang lama
            $filePath = $organisasi->foto ?? null; // Ambil foto lama atau null jika tidak ada
        }
        if ($organisasi && $organisasi->foto && Storage::exists('public/organisasi/' . $organisasi->foto)) {
            Storage::delete('public/organisasi/' . $organisasi->foto);
        }
        if (!$organisasi) {
            return redirect()->route('Organisasi.index')->with('error', 'ID tidak valid.');
        }
        $organisasiData = [
            'foto' => $filePath,
         
            'guru_id' => $validatedData['guru_id'],
            'tahunakademik_id' => $validatedData['tahunakademik_id'],
            'namaorganisasi' => $validatedData['namaorganisasi'],
            'kapasitas' => $validatedData['kapasitas'],
            'status' => $validatedData['status'],
            'ket' => $validatedData['ket'],
            // 'ket' => $roles,
        ];
        $organisasi->update($organisasiData);
        if ($filePath && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
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
           'foto' => ['nullable', 'mimes:jpeg,png,jpg', 'max:512'], // Hapus 'image' jika 'mimes' digunakan.

            'guru_id' => ['required', 'string', 'max:50', new NoXSSInput()],
            'namaorganisasi' => ['required', 'string', 'max:50', new NoXSSInput()],
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
            $filePath = $file->storeAs('public/organisasi', $fileName); 
        }
        try {
            Organisasi::create([
            'foto' => $filePath ? basename($filePath) : null,
             
                'guru_id' => $request->guru_id,
                'tahunakademik_id' => $request->tahunakademik_id,
                'namaorganisasi' => $request->namaorganisasi,
                'kapasitas' => $request->kapasitas,
                'status' => $request->status,
                'ket' => $request->ket,
            ]);
            return redirect()->route('Organisasi.index')->with('success', 'Organisasi created successfully!');
        } catch (\Exception $e) {
            if ($filePath && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            return redirect()->back()->with('error', 'Failed to create Organisasi: ' . $e->getMessage());
        }
    }
}
