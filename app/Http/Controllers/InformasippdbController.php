<?php

namespace App\Http\Controllers;

use App\Models\Informasippdb;
use App\Models\Tombol;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Rules\NoXSSInput;
use Illuminate\Support\Facades\Storage;

class InformasippdbController extends Controller
{
    public function create()
    {
        return view('Informasi.create');
    }
    public function getInformasippdb()
    {
        $informasippdb = Informasippdb::with('User.Guru')->select(['id', 'user_id', 'header', 'gambar1','gambar1','gambar1','gambar1','gambar2','gambar3','gambar4','gambar5','gambar6','gambar7','gambar8','status'])
            ->get()
            ->map(function ($informasippdb) {
                $informasippdb->id_hashed = substr(hash('sha256', $informasippdb->id . env('APP_KEY')), 0, 8);
                $informasippdb->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $informasippdb->id_hashed . '">';
                $informasippdb->action = '
            <a href="' . route('Informasi.edit', $informasippdb->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $informasippdb->Guru_Nama = $informasippdb->User->Guru ? $informasippdb->User->Guru->Nama : '-';
            $informasippdb->gambar1 = $informasippdb->gambar1 ? $informasippdb->gambar1 : 'we.jpg';
            $informasippdb->gambar2 = $informasippdb->gambar2 ? $informasippdb->gambar2 : 'we.jpg';
            $informasippdb->gambar3 = $informasippdb->gambar3 ? $informasippdb->gambar3 : 'we.jpg';
            $informasippdb->gambar4 = $informasippdb->gambar4 ? $informasippdb->gambar4 : 'we.jpg';
            $informasippdb->gambar5 = $informasippdb->gambar5 ? $informasippdb->gambar5 : 'we.jpg';
            $informasippdb->gambar6 = $informasippdb->gambar6 ? $informasippdb->gambar6 : 'we.jpg';
            $informasippdb->gambar7 = $informasippdb->gambar7 ? $informasippdb->gambar7 : 'we.jpg';
            $informasippdb->gambar8 = $informasippdb->gambar8 ? $informasippdb->gambar8 : 'we.jpg';
                
                return $informasippdb;
            });
        return DataTables::of($informasippdb)
            ->addColumn('Nama', function ($informasippdb) {
                return $informasippdb->User->Guru->Nama;
            })
            
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $informasippdb = Informasippdb::with('User.Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$informasippdb) {
            abort(404, 'informasippdb not found.');
        }
        return view('Informasi.edit', compact('informasippdb','hashedId'));
    }
    public function index()
    {
        return view('Informasi.index');

    }
    // public function show($hashedId)
    // {
    //     $informasippdb = informasippdb::all()->first(function ($u) use ($hashedId) {
    //         return substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8) === $hashedId;
    //     });
    
    //     abort_if(!$informasippdb, 404, 'Data tidak ditemukan');
        
    //     return view('informasippdb.show', compact('informasippdb', 'hashedId'));
    // }
    public function show($slug)
    {
        $informasippdb = Informasippdb::findBySlug($slug);
        
        if (!$informasippdb) {
                abort(404, 'informasippdb not found.');
        }
        $ppdb = Tombol::where('url', 'Ppdb')
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();
    
        return view('Informasi.show', compact('informasippdb','ppdb'));
    }
        public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'header' => ['required', 'string', 'max:255', new NoXSSInput()],
            'body' => ['required', 'string', new NoXSSInput()],
            'status' => ['required', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'gambar1' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar2' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar3' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar4' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar5' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar6' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar7' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'gambar8' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ], [
             
            'gambar1.mimes' => 'foto pertama harus bertipe jpeg, png, atau jpg',
            'gambar1.max' => 'foto pertama harus kurang dari 1024 KB',
            'gambar1.image' => 'foto pertama harus berupa gambar',
        
            'gambar2.mimes' => 'foto kedua harus bertipe jpeg, png, atau jpg',
            'gambar2.max' => 'foto kedua harus kurang dari 1024 KB',
            'gambar2.image' => 'foto kedua harus berupa gambar',
        
            'gambar3.mimes' => 'foto ketiga harus bertipe jpeg, png, atau jpg',
            'gambar3.max' => 'foto ketiga harus kurang dari 1024 KB',
            'gambar3.image' => 'foto ketiga harus berupa gambar',
        
            'gambar4.mimes' => 'foto keempat harus bertipe jpeg, png, atau jpg',
            'gambar4.max' => 'foto keempat harus kurang dari 1024 KB',
            'gambar4.image' => 'foto keempat harus berupa gambar',
        
            'gambar5.mimes' => 'foto kelima harus bertipe jpeg, png, atau jpg',
            'gambar5.max' => 'foto kelima harus kurang dari 1024 KB',
            'gambar5.image' => 'foto kelima harus berupa gambar',
        
            'gambar6.mimes' => 'foto keenam harus bertipe jpeg, png, atau jpg',
            'gambar6.max' => 'foto keenam harus kurang dari 1024 KB',
            'gambar6.image' => 'foto keenam harus berupa gambar',
        
            'gambar7.mimes' => 'foto ketujuh harus bertipe jpeg, png, atau jpg',
            'gambar7.max' => 'foto ketujuh harus kurang dari 1024 KB',
            'gambar7.image' => 'foto ketujuh harus berupa gambar',
        
            'gambar8.mimes' => 'foto kedelapan harus bertipe jpeg, png, atau jpg',
            'gambar8.max' => 'foto kedelapan harus kurang dari 1024 KB',
            'gambar8.image' => 'foto kedelapan harus berupa gambar',
        ]);
    
        // Cari informasippdb berdasarkan hash
        $informasippdb = Informasippdb::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
    
        if (!$informasippdb) {
            return redirect()->route('Informasi.index')->with('error', 'ID tidak valid.');
        }
    
        // List gambar yang akan diproses
        $gambarFields = [
            'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'gambar6', 'gambar7', 'gambar8'
        ];
    
        $gambarPaths = [];
    
        foreach ($gambarFields as $index => $gambarField) {
            // Ambil path lama dari model
            $oldFilePath = $informasippdb->{$gambarField};
    
            // Proses upload gambar jika ada file yang di-upload
            if ($request->hasFile($gambarField)) {
                $file = $request->file($gambarField);
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->storeAs('public/informasippdb', $fileName);
                $gambarPaths[$gambarField] = $fileName;
    
                // Hapus file lama jika ada
                if ($oldFilePath && Storage::exists('public/informasippdb/' . $oldFilePath)) {
                    Storage::delete('public/informasippdb/' . $oldFilePath);
                }
            } else {
                // Jika tidak ada file yang diupload, pakai file lama
                $gambarPaths[$gambarField] = $oldFilePath;
            }
        }
    
        // Ambil user_id dari yang sedang login
        $userId = auth()->id();
    
        // Data untuk diupdate
        $informasippdbData = [
            'user_id' => $userId,
            'header' => $validatedData['header'],
            'body' => $validatedData['body'],
            'status' => $validatedData['status'],
        ];
    
        // Gabungkan path gambar ke data yang akan diupdate
        foreach ($gambarPaths as $gambarField => $filePath) {
            $informasippdbData[$gambarField] = $filePath;
        }
    
        // Update data informasippdb
        $informasippdb->update($informasippdbData);
    
        return redirect()->route('Informasi.index')->with('success', 'informasippdb Berhasil Diupdate.');
    }
    
    public function deleteInformasippdb(Request $request)
    {
        $request->validate([

            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],


        ]);
        Informasippdb::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected informasippdb and their related data deleted successfully.'
        ]);
    }

    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'header' => ['required', 'string', 'max:255', new NoXSSInput()],
        'body' => ['required', 'string', new NoXSSInput()],
        'status' => ['required', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
        'gambar1' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar2' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar3' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar4' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar5' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar6' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar7' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        'gambar8' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
    ], [
             'gambar1.required' => 'foto pertama wajib diisi',
        'gambar1.mimes' => 'foto pertama harus bertipe jpeg, png, atau jpg',
        'gambar1.max' => 'foto pertama harus kurang dari 1024 KB',
        'gambar1.image' => 'foto pertama harus berupa gambar',
    
        'gambar2.mimes' => 'foto kedua harus bertipe jpeg, png, atau jpg',
        'gambar2.max' => 'foto kedua harus kurang dari 1024 KB',
        'gambar2.image' => 'foto kedua harus berupa gambar',
    
        'gambar3.mimes' => 'foto ketiga harus bertipe jpeg, png, atau jpg',
        'gambar3.max' => 'foto ketiga harus kurang dari 1024 KB',
        'gambar3.image' => 'foto ketiga harus berupa gambar',
    
        'gambar4.mimes' => 'foto keempat harus bertipe jpeg, png, atau jpg',
        'gambar4.max' => 'foto keempat harus kurang dari 1024 KB',
        'gambar4.image' => 'foto keempat harus berupa gambar',
    
        'gambar5.mimes' => 'foto kelima harus bertipe jpeg, png, atau jpg',
        'gambar5.max' => 'foto kelima harus kurang dari 1024 KB',
        'gambar5.image' => 'foto kelima harus berupa gambar',
    
        'gambar6.mimes' => 'foto keenam harus bertipe jpeg, png, atau jpg',
        'gambar6.max' => 'foto keenam harus kurang dari 1024 KB',
        'gambar6.image' => 'foto keenam harus berupa gambar',
    
        'gambar7.mimes' => 'foto ketujuh harus bertipe jpeg, png, atau jpg',
        'gambar7.max' => 'foto ketujuh harus kurang dari 1024 KB',
        'gambar7.image' => 'foto ketujuh harus berupa gambar',
    
        'gambar8.mimes' => 'foto kedelapan harus bertipe jpeg, png, atau jpg',
        'gambar8.max' => 'foto kedelapan harus kurang dari 1024 KB',
        'gambar8.image' => 'foto kedelapan harus berupa gambar',
    ]);

    // List gambar yang akan diproses
    $gambarFields = [
        'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'gambar6', 'gambar7', 'gambar8'
    ];

    $gambarPaths = [];

    // Proses setiap gambar jika di-upload
    foreach ($gambarFields as $gambarField) {
        // Proses upload gambar jika ada file yang di-upload
        if ($request->hasFile($gambarField)) {
            $file = $request->file($gambarField);
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('public/informasippdb', $fileName);
            $gambarPaths[$gambarField] = $fileName;
        } else {
            // Jika tidak ada file yang di-upload, set ke null
            $gambarPaths[$gambarField] = null;
        }
    }

    // Ambil user_id dari yang sedang login
    $userId = auth()->id();

    // Data untuk disimpan
    $informasippdbData = [
        'user_id' => $userId,
        'header' => $validatedData['header'],
        'body' => $validatedData['body'],
        'status' => $validatedData['status'],
    ];

    // Gabungkan path gambar ke data informasippdb
    foreach ($gambarPaths as $gambarField => $filePath) {
        $informasippdbData[$gambarField] = $filePath;
    }

    // Simpan informasippdb baru
    Informasippdb::create($informasippdbData);

    // Redirect setelah berhasil
    return redirect()->route('Informasi.index')->with('success', 'Informasi Berhasil Ditambahkan.');
}
}
