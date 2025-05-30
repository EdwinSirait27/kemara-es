<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Informasippdb;
use Yajra\DataTables\DataTables;
use App\Rules\NoXSSInput;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function create()
    {
        
        return view('Berita.create');
    }
    public function getBerita()
    {
        $berita = Berita::with('User.Guru')->select(['id', 'user_id', 'header','gambar1','gambar1','gambar1','gambar1','gambar2','gambar3','gambar4','gambar5','gambar6','gambar7','gambar8','status'])
            ->get()
            ->map(function ($berita) {
                $berita->id_hashed = substr(hash('sha256', $berita->id . env('APP_KEY')), 0, 8);
                $berita->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $berita->id_hashed . '">';
                $berita->action = '
            <a href="' . route('Berita.edit', $berita->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $berita->Guru_Nama = $berita->User->Guru ? $berita->User->Guru->Nama : '-';
            $berita->gambar1 = $berita->gambar1 ? $berita->gambar1 : 'we.jpg';
            $berita->gambar2 = $berita->gambar2 ? $berita->gambar2 : 'we.jpg';
            $berita->gambar3 = $berita->gambar3 ? $berita->gambar3 : 'we.jpg';
            $berita->gambar4 = $berita->gambar4 ? $berita->gambar4 : 'we.jpg';
            $berita->gambar5 = $berita->gambar5 ? $berita->gambar5 : 'we.jpg';
            $berita->gambar6 = $berita->gambar6 ? $berita->gambar6 : 'we.jpg';
            $berita->gambar7 = $berita->gambar7 ? $berita->gambar7 : 'we.jpg';
            $berita->gambar8 = $berita->gambar8 ? $berita->gambar8 : 'we.jpg';
                
                return $berita;
            });
        return DataTables::of($berita)
            ->addColumn('Nama', function ($berita) {
                return $berita->User->Guru->Nama;
            })
            
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $berita = Berita::with('User.Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$berita) {
            abort(404, 'berita not found.');
        }
        return view('Berita.edit', compact('berita','hashedId'));
    }
    public function index()
    {
        return view('Berita.index');

    }
    
    public function show($slug)
{
    $berita = Berita::findBySlug($slug);
    $berita->increment('views');
    $informasippdb = Informasippdb::where('status', 'Aktif')->first();
    return view('Berita.show', compact('berita','informasippdb'));
}
// public function show($slug)
// {
//     $berita = Berita::where('slug', $slug)->first();
    
//     if (!$berita) {
//         abort(404, 'Berita tidak ditemukan');
//     }

//     $berita->increment('views');
//     $updated = $berita->fresh();

//     dd([
//         'slug' => $slug,
//         'views' => $updated->views,
//     ]);
// }


        public function update(Request $request, $hashedId)
    {
         // Cari berita berdasarkan hash
         $berita = Berita::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
    
        if (!$berita) {
            return redirect()->route('Berita.index')->with('error', 'ID tidak valid.');
        }

        $validatedData = $request->validate([
            'header' => ['required', 'string', 'max:255', Rule::unique('tb_berita')->ignore($berita->id), new NoXSSInput()],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('tb_berita')->ignore($berita->id), new NoXSSInput()],
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
    
       
    
        // List gambar yang akan diproses
        $gambarFields = [
            'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'gambar6', 'gambar7', 'gambar8'
        ];
    
        $gambarPaths = [];
    
        foreach ($gambarFields as $index => $gambarField) {
            // Ambil path lama dari model
            $oldFilePath = $berita->{$gambarField};
    
            // Proses upload gambar jika ada file yang di-upload
            if ($request->hasFile($gambarField)) {
                $file = $request->file($gambarField);
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->storeAs('public/berita', $fileName);
                $gambarPaths[$gambarField] = $fileName;
    
                // Hapus file lama jika ada
                if ($oldFilePath && Storage::exists('public/berita/' . $oldFilePath)) {
                    Storage::delete('public/berita/' . $oldFilePath);
                }
            } else {
                // Jika tidak ada file yang diupload, pakai file lama
                $gambarPaths[$gambarField] = $oldFilePath;
            }
        }
    
        // Ambil user_id dari yang sedang login
        $userId = auth()->id();
    
        // Data untuk diupdate
        $beritaData = [
            'user_id' => $userId,
            'header' => $validatedData['header'],
            'body' => $validatedData['body'],
            'status' => $validatedData['status'],
        ];
    
        // Gabungkan path gambar ke data yang akan diupdate
        foreach ($gambarPaths as $gambarField => $filePath) {
            $beritaData[$gambarField] = $filePath;
        }
    
        // Update data berita
        $berita->update($beritaData);
    
        return redirect()->route('Berita.index')->with('success', 'Berita Berhasil Diupdate.');
    }
   
    public function deleteBerita(Request $request)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
        ]);
    
        try {
            // Ambil data berita yang akan dihapus
            $beritas = Berita::whereIn('id', $validated['ids'])->get();
    
            foreach ($beritas as $berita) {
                // Hapus gambar1 sampai gambar8 jika ada
                for ($i = 1; $i <= 8; $i++) {
                    $gambarField = 'gambar' . $i;
                    if ($berita->$gambarField && Storage::exists('public/berita/' . $berita->$gambarField)) {
                        Storage::delete('public/berita/' . $berita->$gambarField);
                    }
                }
            }
    
            // Setelah menghapus file gambar, hapus record berita
            $count = Berita::whereIn('id', $validated['ids'])->delete();
            
            return response()->json([
                'success' => true,
                'message' => $count . ' berita dan file gambar terkait berhasil dihapus.'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'header' => ['required', 'string', 'max:255', 'unique:tb_berita,header', new NoXSSInput()],
            'slug' => ['nullable','unique:tb_berita,slug', new NoXSSInput()],
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
            $file->storeAs('public/berita', $fileName);
            $gambarPaths[$gambarField] = $fileName;
        } else {
            // Jika tidak ada file yang di-upload, set ke null
            $gambarPaths[$gambarField] = null;
        }
    }

    // Ambil user_id dari yang sedang login
    $userId = auth()->id();

    // Data untuk disimpan
    $beritaData = [
        'user_id' => $userId,
        'header' => $validatedData['header'],
        'body' => $validatedData['body'],
        'status' => $validatedData['status'],
    ];

    // Gabungkan path gambar ke data berita
    foreach ($gambarPaths as $gambarField => $filePath) {
        $beritaData[$gambarField] = $filePath;
    }

    // Simpan berita baru
    Berita::create($beritaData);

    // Redirect setelah berhasil
    return redirect()->route('Berita.index')->with('success', 'Berita Berhasil Ditambahkan.');
}
}
