<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\tes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class DashboardControllerSU extends Controller
{
    public function index()
    {
        return view('dashboardSU.dashboardSU');

    }
    public function create()
    {
        return view('dashboardSU.create');
    }
    

    public function getUsers()
    {
        $users = User::with('Guru')  // Pastikan relasi Guru dimuat
    ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
    ->get()
    ->map(function ($user) {
        $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
        $user->Role = explode(',', $user->Role);
        $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
        $user->action = '
            <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
        
        // Menambahkan kolom 'Guru.Nama' secara manual ke dalam data
        $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';

        return $user;
    });

return DataTables::of($users)
    ->addColumn('Role', function ($user) {
        return implode(', ', $user->Role);
    })
    ->rawColumns(['checkbox', 'action'])
    ->make(true);

        // // Ambil data user dengan relasi Guru
        // $users = tes::with('Guru')  // Memuat relasi Guru
        //     // ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
        //     ->get()
        //     ->map(function ($user) {
        //         // Format created_at menggunakan Carbon
        //         $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
                
        //         // Memisahkan Role menjadi array
        //         $user->Role = explode(',', $user->Role);
                
        //         // Menambahkan checkbox untuk setiap user
        //         $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
                
        //         // Menambahkan action untuk edit
        //         $user->action = '
        //             <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
        //                 <i class="fas fa-user-edit text-secondary"></i>
        //             </a>';
    
        //         return $user;
        //     });
    
        // // Log data users untuk debugging
        // Log::info('Data Users:', ['users' => $users]);
    
        // // Menampilkan data dalam format DataTables
        // return DataTables::of($users)
        //     ->addColumn('Role', function ($user) {
        //         // Menampilkan Role yang dipisahkan dengan koma
        //         return implode(', ', $user->Role);
        //     })
            
        //     ->rawColumns(['checkbox', 'action'])
        //     ->make(true);
    }
    
//     public function getUsers()
// {
//     $users = User::with('Guru')->get();
//     Log::info('Debugging Users Data:', ['users' => $users]);
//     return response()->json($users);
// }
    

  
    // public function getUsers()
    // {
    //     $users = User::with('Guru')->select(['id','username', 'hakakses', 'Role', 'created_at'])
    //         ->get()
    //         ->map(function ($user) {
    //             $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
    //             $user->Role = explode(',', $user->Role);
    //             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
    //             $user->action = '
    //                 <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
    //                     <i class="fas fa-user-edit text-secondary"></i>
    //                 </a>';
    //                 $user->guru_id = $user->Guru->guru_id ?? '-';
    //                 $user->Guru_Nama = $user->Guru->Nama ?? '-';
    //             return $user;
    //         });
    //     return DataTables::of($users)
    //         ->addColumn('Role', function ($user) {
    //             return implode(', ', $user->Role);
    //         })
           
    //         ->rawColumns(['checkbox', 'action'])
    //         ->make(true);
    // }
    // public function getUsers()
    // {
    //     $users = User::select(['id', 'username', 'hakakses', 'Role', 'created_at'])
    //         ->get()
    //         ->map(function ($user) {
    //             $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
    //             $user->Role = explode(',', $user->Role);
    //             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
    //             $user->action = '
    //                 <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
    //                     <i class="fas fa-user-edit text-secondary"></i>
    //                 </a>';
    //             return $user;
    //         });
    //     return DataTables::of($users)
    //         ->addColumn('Role', function ($user) {
    //             return implode(', ', $user->Role);
    //         })
    //         ->rawColumns(['checkbox', 'action'])
    //         ->make(true);
    // }
    
    // public function getUsers()
    // {
    //     $users = User::select(['id', 'Username', 'hakakses','Role', 'created_at'])
    //         ->get()
    //         ->map(function ($user) {
    //             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
    //             $user->action = '
    //             <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
    //                 <i class="fas fa-user-edit text-secondary"></i>
    //             </a>';
    //             return $user;
    //         });
    //     return DataTables::of($users)
    //         ->rawColumns(['checkbox', 'action'])
    //         ->make(true);
    // }
    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:8|confirmed',
        'hakakses' => 'required|string|in:SU,KepalaSekolah,Admin','Guru','Kurikulum','Siswa',
        'Role' => 'required|array',
        'Role.*' => 'required|string|in:SU,KepalaSekolah,Admin','Guru','Kurikulum','Siswa',
    ]);

    try {
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
         'hakakses' => $request->hakakses, // Simpan enum langsung
         'Role' => implode(',', $request->Role), // Simpan set sebagai JSON
        ]);
        return redirect()->route('dashboardSU.create')->with('success', 'User created successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
    }
}


    
//     public function store(Request $request)
// {
//     $request->validate([
//         'username' => 'required|string|max:255|unique:users,username', // Pastikan username unik
//         'password' => 'required|string|min:8|confirmed', // Validasi password
//         'Role' => 'required|string|in:SU,Admin',
//     ]);

//     User::create([
//         'username' => $request->username,
//         'password' => bcrypt($request->password),
//         'Role' => $request->Role,
//     ]);

//     return redirect()->route('dashboardSU.index')->with('success', 'User created successfully!');
// }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string|max:255',
    //         'Role' => 'required|string|in:SU,Admin',
    //     ]);

    //     User::create($request->only('username', 'Role'));

    //     return redirect()->route('dashboardSU.index')->with('success', 'User created successfully!');
    // }
    public function deleteUsers(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);
        User::whereIn('id', $request->ids)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Selected users and their related data deleted successfully.'
        ]);
    }

}

// public function getUsers()
// {
//     $users = User::select(['id', 'Username', 'Role','created_at']);
//     // $users = User::select('*'); 
//     return DataTables::of($users)->make(true);

// }