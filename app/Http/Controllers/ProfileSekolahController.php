<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Youtube;
use App\Models\Berita;
use App\Models\Profile;
use App\Models\Profilesekolah;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

use App\Rules\NoXSSInput;

use Illuminate\Support\Facades\Hash;


class ProfileSekolahController extends Controller
{
    public function Profile()
    {
        return view('Profile.index');

    }
    public function Beranda()
    {
        $youtubeVideos = Youtube::where('status', 'Aktif')->get();
        $profiles = Profile::where('status', 'Aktif')->get();
        $sekolahh = Profilesekolah::where('status', 'Aktif')->get();
        $beritas = Berita::latest()->take(5)->get();
        $beritass = Berita::latest()->paginate(5);
    
        $beritas->transform(function ($berita) {
            $berita->hashedId = substr(hash('sha256', $berita->id . env('APP_KEY')), 0, 8);
            return $berita;
        });
        $profiles->transform(function ($profile) {
            $profile->hashedId = substr(hash('sha256', $profile->id . env('APP_KEY')), 0, 8);
            return $profile;
        });
        return view('Beranda.index', compact('beritas','profiles','youtubeVideos','beritass','sekolahh'));
    }
    
    // public function Beranda()
    // {
    //     $youtubeVideos = Youtube::where('status', 'Aktif')->get();
    //     $beritas = Berita::all();

    //     // Contoh jika $hashedId adalah hasil hashing dari ID pertama Berita
    //     $hashedId = Hash::make($beritas->first()->id); // atau cara lain sesuai kebutuhanmu

    //     // Kirim data ke view
    //     return view('Beranda.index', compact('youtubeVideos','beritas','hashedId'));
    // }
    
    public function create()
    {
        
        return view('Sekolah.create');
    }
    public function getSekolah()
    {
        $sekolah = Profilesekolah::with('User.Guru')->select(['id', 'user_id', 'header','gambar1','gambar1','gambar1','gambar1','gambar2','gambar3','gambar4','gambar5','gambar6','gambar7','gambar8','status'])
            ->get()
            ->map(function ($sekolah) {
                $sekolah->id_hashed = substr(hash('sha256', $sekolah->id . env('APP_KEY')), 0, 8);
                $sekolah->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $sekolah->id_hashed . '">';
                $sekolah->action = '
            <a href="' . route('Sekolah.edit', $sekolah->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $sekolah->Guru_Nama = $sekolah->User->Guru ? $sekolah->User->Guru->Nama : '-';
            $sekolah->gambar1 = $sekolah->gambar1 ? $sekolah->gambar1 : 'we.jpg';
            $sekolah->gambar2 = $sekolah->gambar2 ? $sekolah->gambar2 : 'we.jpg';
            $sekolah->gambar3 = $sekolah->gambar3 ? $sekolah->gambar3 : 'we.jpg';
            $sekolah->gambar4 = $sekolah->gambar4 ? $sekolah->gambar4 : 'we.jpg';
            $sekolah->gambar5 = $sekolah->gambar5 ? $sekolah->gambar5 : 'we.jpg';
            $sekolah->gambar6 = $sekolah->gambar6 ? $sekolah->gambar6 : 'we.jpg';
            $sekolah->gambar7 = $sekolah->gambar7 ? $sekolah->gambar7 : 'we.jpg';
            $sekolah->gambar8 = $sekolah->gambar8 ? $sekolah->gambar8 : 'we.jpg';
                
                return $sekolah;
            });
        return DataTables::of($sekolah)
            ->addColumn('Nama', function ($sekolah) {
                return $sekolah->User->Guru->Nama;
            })
            
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $sekolah = Profilesekolah::with('User.Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$sekolah) {
            abort(404, 'sekolah not found.');
        }
        return view('Sekolah.edit', compact('sekolah','hashedId'));
    }
    public function index()
    {
        return view('Sekolah.index');

    }
    // public function show($hashedId)
    // {
    //     $berita = Berita::all()->first(function ($u) use ($hashedId) {
    //         return substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8) === $hashedId;
    //     });
    
    //     abort_if(!$berita, 404, 'Data tidak ditemukan');
        
    //     return view('sekolah.show', compact('sekolah', 'hashedId'));
    // }
    public function show($id)
    {
        $sekolah = Profilesekolah::find($id);
        
        if (!$sekolah) {
                abort(404, 'sekolah not found.');
        }
    
        return view('Sekolah.show', compact('sekolah'));
    }
        public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'header' => ['required', 'string', 'max:255', new NoXSSInput()],
            'body' => ['required', 'string', new NoXSSInput()],
            'status' => ['required', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
            'gambar1' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar2' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar3' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar4' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar5' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar6' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar7' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'gambar8' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ], [
             
            'gambar1.mimes' => 'foto pertama harus bertipe jpeg, png, atau jpg',
            'gambar1.max' => 'foto pertama harus kurang dari 5120 KB',
            'gambar1.image' => 'foto pertama harus berupa gambar',
        
            'gambar2.mimes' => 'foto kedua harus bertipe jpeg, png, atau jpg',
            'gambar2.max' => 'foto kedua harus kurang dari 5120 KB',
            'gambar2.image' => 'foto kedua harus berupa gambar',
        
            'gambar3.mimes' => 'foto ketiga harus bertipe jpeg, png, atau jpg',
            'gambar3.max' => 'foto ketiga harus kurang dari 5120 KB',
            'gambar3.image' => 'foto ketiga harus berupa gambar',
        
            'gambar4.mimes' => 'foto keempat harus bertipe jpeg, png, atau jpg',
            'gambar4.max' => 'foto keempat harus kurang dari 5120 KB',
            'gambar4.image' => 'foto keempat harus berupa gambar',
        
            'gambar5.mimes' => 'foto kelima harus bertipe jpeg, png, atau jpg',
            'gambar5.max' => 'foto kelima harus kurang dari 5120 KB',
            'gambar5.image' => 'foto kelima harus berupa gambar',
        
            'gambar6.mimes' => 'foto keenam harus bertipe jpeg, png, atau jpg',
            'gambar6.max' => 'foto keenam harus kurang dari 5120 KB',
            'gambar6.image' => 'foto keenam harus berupa gambar',
        
            'gambar7.mimes' => 'foto ketujuh harus bertipe jpeg, png, atau jpg',
            'gambar7.max' => 'foto ketujuh harus kurang dari 5120 KB',
            'gambar7.image' => 'foto ketujuh harus berupa gambar',
        
            'gambar8.mimes' => 'foto kedelapan harus bertipe jpeg, png, atau jpg',
            'gambar8.max' => 'foto kedelapan harus kurang dari 5120 KB',
            'gambar8.image' => 'foto kedelapan harus berupa gambar',
        ]);
    
        // Cari berita berdasarkan hash
        $sekolah = Profilesekolah::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
    
        if (!$sekolah) {
            return redirect()->route('Sekolah.index')->with('error', 'ID tidak valid.');
        }
    
        // List gambar yang akan diproses
        $gambarFields = [
            'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'gambar6', 'gambar7', 'gambar8'
        ];
    
        $gambarPaths = [];
    
        foreach ($gambarFields as $index => $gambarField) {
            // Ambil path lama dari model
            $oldFilePath = $sekolah->{$gambarField};
    
            // Proses upload gambar jika ada file yang di-upload
            if ($request->hasFile($gambarField)) {
                $file = $request->file($gambarField);
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->storeAs('public/sekolah', $fileName);
                $gambarPaths[$gambarField] = $fileName;
    
                // Hapus file lama jika ada
                if ($oldFilePath && Storage::exists('public/sekolah/' . $oldFilePath)) {
                    Storage::delete('public/sekolah/' . $oldFilePath);
                }
            } else {
                // Jika tidak ada file yang diupload, pakai file lama
                $gambarPaths[$gambarField] = $oldFilePath;
            }
        }
    
        // Ambil user_id dari yang sedang login
        $userId = auth()->id();
    
        // Data untuk diupdate
        $sekolahData = [
            'user_id' => $userId,
            'header' => $validatedData['header'],
            'body' => $validatedData['body'],
            'status' => $validatedData['status'],
        ];
    
        // Gabungkan path gambar ke data yang akan diupdate
        foreach ($gambarPaths as $gambarField => $filePath) {
            $sekolahData[$gambarField] = $filePath;
        }
    
        // Update data sekolah
        $sekolah->update($sekolahData);
    
        return redirect()->route('Sekolah.index')->with('success', 'sekolah Berhasil Diupdate.');
    }
    
    public function deleteSekolah(Request $request)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],
        ]);
    
        try {
            // Ambil data berita yang akan dihapus
            $sekolahh = Profilesekolah::whereIn('id', $validated['ids'])->get();
    
            foreach ($sekolahh as $sekolah) {
                // Hapus gambar1 sampai gambar8 jika ada
                for ($i = 1; $i <= 8; $i++) {
                    $gambarField = 'gambar' . $i;
                    if ($sekolah->$gambarField && Storage::exists('public/sekolah/' . $sekolah->$gambarField)) {
                        Storage::delete('public/sekolah/' . $sekolah->$gambarField);
                    }
                }
            }
    
            // Setelah menghapus file gambar, hapus record sekolah
            $count = Profilesekolah::whereIn('id', $validated['ids'])->delete();
            
            return response()->json([
                'success' => true,
                'message' => $count . ' sekolah dan file gambar terkait berhasil dihapus.'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sekolah: ' . $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'header' => ['required', 'string', 'max:255', new NoXSSInput()],
        'body' => ['required', 'string', new NoXSSInput()],
        'status' => ['required', 'in:Aktif,Tidak Aktif', new NoXSSInput()],
        'gambar1' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar2' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar3' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar4' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar5' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar6' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar7' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'gambar8' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
    ], [
             'gambar1.required' => 'foto pertama wajib diisi',
        'gambar1.mimes' => 'foto pertama harus bertipe jpeg, png, atau jpg',
        'gambar1.max' => 'foto pertama harus kurang dari 5120 KB',
        'gambar1.image' => 'foto pertama harus berupa gambar',
    
        'gambar2.mimes' => 'foto kedua harus bertipe jpeg, png, atau jpg',
        'gambar2.max' => 'foto kedua harus kurang dari 5120 KB',
        'gambar2.image' => 'foto kedua harus berupa gambar',
    
        'gambar3.mimes' => 'foto ketiga harus bertipe jpeg, png, atau jpg',
        'gambar3.max' => 'foto ketiga harus kurang dari 5120 KB',
        'gambar3.image' => 'foto ketiga harus berupa gambar',
    
        'gambar4.mimes' => 'foto keempat harus bertipe jpeg, png, atau jpg',
        'gambar4.max' => 'foto keempat harus kurang dari 5120 KB',
        'gambar4.image' => 'foto keempat harus berupa gambar',
    
        'gambar5.mimes' => 'foto kelima harus bertipe jpeg, png, atau jpg',
        'gambar5.max' => 'foto kelima harus kurang dari 5120 KB',
        'gambar5.image' => 'foto kelima harus berupa gambar',
    
        'gambar6.mimes' => 'foto keenam harus bertipe jpeg, png, atau jpg',
        'gambar6.max' => 'foto keenam harus kurang dari 5120 KB',
        'gambar6.image' => 'foto keenam harus berupa gambar',
    
        'gambar7.mimes' => 'foto ketujuh harus bertipe jpeg, png, atau jpg',
        'gambar7.max' => 'foto ketujuh harus kurang dari 5120 KB',
        'gambar7.image' => 'foto ketujuh harus berupa gambar',
    
        'gambar8.mimes' => 'foto kedelapan harus bertipe jpeg, png, atau jpg',
        'gambar8.max' => 'foto kedelapan harus kurang dari 5120 KB',
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
            $file->storeAs('public/sekolah', $fileName);
            $gambarPaths[$gambarField] = $fileName;
        } else {
            // Jika tidak ada file yang di-upload, set ke null
            $gambarPaths[$gambarField] = null;
        }
    }

    // Ambil user_id dari yang sedang login
    $userId = auth()->id();

    // Data untuk disimpan
    $sekolahData = [
        'user_id' => $userId,
        'header' => $validatedData['header'],
        'body' => $validatedData['body'],
        'status' => $validatedData['status'],
    ];

    // Gabungkan path gambar ke data sekolah
    foreach ($gambarPaths as $gambarField => $filePath) {
        $sekolahData[$gambarField] = $filePath;
    }

    // Simpan sekolah baru
    Profilesekolah::create($sekolahData);

    // Redirect setelah berhasil
    return redirect()->route('Sekolah.index')->with('success', 'profile skeolah Berhasil Ditambahkan.');
}

}
