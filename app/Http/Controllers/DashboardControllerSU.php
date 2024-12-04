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
    $users = User::with('Guru')
        ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
        ->get()
        ->map(function ($user) {
            $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
            // Mengonversi Role menjadi array dan menampilkan dalam format yang mudah dibaca
            $user->Role = implode(', ', explode(',', $user->Role));

            // Checkbox untuk setiap user
            $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';

            // Tombol aksi Edit, arahkan ke halaman edit user
            $user->action = '
                <a href="' . route('dashboardSU.edit', $user->id) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';

            // Nama Guru, jika ada
            $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';

            return $user;
        });

    return DataTables::of($users)
        // Menambahkan kolom Role yang sudah diubah
        ->addColumn('Role', function ($user) {
            return $user->Role;
        })
        // Menambahkan kolom dengan elemen HTML yang sudah diubah (checkbox dan action)
        ->rawColumns(['checkbox', 'action'])
        ->make(true);
}


//     public function getUsers()
// {
//     $users = User::with('Guru')
//         ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
//         ->get()
//         ->map(function ($user) {
//             $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
//             $user->Role = explode(',', $user->Role);
//             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
//             $user->action = '
//                 <a href="' . route('users.edit', $user->id) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
//                     <i class="fas fa-user-edit text-secondary"></i>
//                 </a>';
//             $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';

//             return $user;
//         });

//     return response()->json($users);
    
// }

//     public function getUsers()
//     {
//         $users = User::with('Guru')
//     ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
//     ->get()
//     ->map(function ($user) {
//         $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
//         $user->Role = explode(',', $user->Role);
//         $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
//         $user->action = '
//             <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
//                 <i class="fas fa-user-edit text-secondary"></i>
//             </a>';
//         $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';

//         return $user;
//     });

// return DataTables::of($users)
//     ->addColumn('Role', function ($user) {
//         return implode(', ', $user->Role);
//     })
//     ->rawColumns(['checkbox', 'action'])
//     ->make(true);
//     }

public function edit($id)
{
    // Ambil data user berdasarkan ID
    $user = User::with('Guru')->findOrFail($id);

    
    // Pastikan hanya user dengan peran yang benar yang dapat mengakses
    $this->authorize('isSU', $user);

    // Mengirim data user ke view edit
    return view('dashboardSU.edit', compact('user'));
}

// Mengupdate data user
public function update(Request $request, $id)
{
    // Validasi inputan
    $request->validate([
        'username' => 'required|string|max:255',
        'role' => 'required|array',
        'role.*' => 'in:guest,admin,superadmin', // Menentukan role yang valid
    ]);

    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Pastikan hanya user dengan peran yang benar yang dapat mengakses
    $this->authorize('isSU', $user);

    // Update data user
    $user->username = $request->input('username');
    $user->Role = implode(',', $request->input('role')); // Menyimpan role sebagai string
    $user->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('dashboardSU.edit', $user->id)
        ->with('success', 'User updated successfully');
}

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

