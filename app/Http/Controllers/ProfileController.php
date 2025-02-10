<?php
namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\Informasippdb;
use App\Models\Tombol;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Rules\NoXSSInput;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function create()
    {
        return view('Profile.create');
    }
    public function getProfile()
    {
        $profile = Profile::with('User.Guru')->select(['id', 'user_id', 'header', 'gambar1','gambar1','gambar1','gambar1','gambar2','gambar3','gambar4','gambar5','gambar6','gambar7','gambar8','status'])
            ->get()
            ->map(function ($profile) {
                $profile->id_hashed = substr(hash('sha256', $profile->id . env('APP_KEY')), 0, 8);
                $profile->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $profile->id_hashed . '">';
                $profile->action = '
            <a href="' . route('Profile.edit', $profile->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $profile->Guru_Nama = $profile->User->Guru ? $profile->User->Guru->Nama : '-';
            $profile->gambar1 = $profile->gambar1 ? $profile->gambar1 : 'we.jpg';
            $profile->gambar2 = $profile->gambar2 ? $profile->gambar2 : 'we.jpg';
            $profile->gambar3 = $profile->gambar3 ? $profile->gambar3 : 'we.jpg';
            $profile->gambar4 = $profile->gambar4 ? $profile->gambar4 : 'we.jpg';
            $profile->gambar5 = $profile->gambar5 ? $profile->gambar5 : 'we.jpg';
            $profile->gambar6 = $profile->gambar6 ? $profile->gambar6 : 'we.jpg';
            $profile->gambar7 = $profile->gambar7 ? $profile->gambar7 : 'we.jpg';
            $profile->gambar8 = $profile->gambar8 ? $profile->gambar8 : 'we.jpg';
                
                return $profile;
            });
        return DataTables::of($profile)
            ->addColumn('Nama', function ($profile) {
                return $profile->User->Guru->Nama;
            })
            
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
    public function edit($hashedId)
    {
        $profile = Profile::with('User.Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        if (!$profile) {
            abort(404, 'profile not found.');
        }
        return view('Profile.edit', compact('profile','hashedId'));
    }
    public function index()
    {
        return view('Profile.index');

    }
    // public function show($hashedId)
    // {
    //     $profile = profile::all()->first(function ($u) use ($hashedId) {
    //         return substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8) === $hashedId;
    //     });
    
    //     abort_if(!$profile, 404, 'Data tidak ditemukan');
        
    //     return view('profile.show', compact('profile', 'hashedId'));
    // }
    public function show($slug)
    {
        $profile = Profile::findBySlug($slug);
        
        if (!$profile) {
                abort(404, 'profile not found.');
        }
        $informasippdb = Informasippdb::where('status', 'Aktif')->first();
  
       
    
    
        return view('Profile.show', compact('profile','informasippdb'));
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
    
        // Cari profile berdasarkan hash
        $profile = Profile::get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
    
        if (!$profile) {
            return redirect()->route('Profile.index')->with('error', 'ID tidak valid.');
        }
    
        // List gambar yang akan diproses
        $gambarFields = [
            'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'gambar6', 'gambar7', 'gambar8'
        ];
    
        $gambarPaths = [];
    
        foreach ($gambarFields as $index => $gambarField) {
            // Ambil path lama dari model
            $oldFilePath = $profile->{$gambarField};
    
            // Proses upload gambar jika ada file yang di-upload
            if ($request->hasFile($gambarField)) {
                $file = $request->file($gambarField);
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $file->storeAs('public/profile', $fileName);
                $gambarPaths[$gambarField] = $fileName;
    
                // Hapus file lama jika ada
                if ($oldFilePath && Storage::exists('public/profile/' . $oldFilePath)) {
                    Storage::delete('public/profile/' . $oldFilePath);
                }
            } else {
                // Jika tidak ada file yang diupload, pakai file lama
                $gambarPaths[$gambarField] = $oldFilePath;
            }
        }
    
        // Ambil user_id dari yang sedang login
        $userId = auth()->id();
    
        // Data untuk diupdate
        $profileData = [
            'user_id' => $userId,
            'header' => $validatedData['header'],
            'body' => $validatedData['body'],
            'status' => $validatedData['status'],
        ];
    
        // Gabungkan path gambar ke data yang akan diupdate
        foreach ($gambarPaths as $gambarField => $filePath) {
            $profileData[$gambarField] = $filePath;
        }
    
        // Update data profile
        $profile->update($profileData);
    
        return redirect()->route('Profile.index')->with('success', 'profile Berhasil Diupdate.');
    }
    
    public function deleteProfile(Request $request)
    {
        $request->validate([

            'ids' => ['required', 'array', 'min:1', new NoXSSInput()],


        ]);
        Profile::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected profile and their related data deleted successfully.'
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
            $file->storeAs('public/profile', $fileName);
            $gambarPaths[$gambarField] = $fileName;
        } else {
            // Jika tidak ada file yang di-upload, set ke null
            $gambarPaths[$gambarField] = null;
        }
    }

    // Ambil user_id dari yang sedang login
    $userId = auth()->id();

    // Data untuk disimpan
    $profileData = [
        'user_id' => $userId,
        'header' => $validatedData['header'],
        'body' => $validatedData['body'],
        'status' => $validatedData['status'],
    ];

    // Gabungkan path gambar ke data profile
    foreach ($gambarPaths as $gambarField => $filePath) {
        $profileData[$gambarField] = $filePath;
    }

    // Simpan profile baru
    Profile::create($profileData);

    // Redirect setelah berhasil
    return redirect()->route('Profile.index')->with('success', 'profile Berhasil Ditambahkan.');
}
}
