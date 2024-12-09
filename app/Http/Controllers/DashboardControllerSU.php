<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Guru;
// use App\Models\tes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;



class DashboardControllerSU extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('dashboardSU.dashboardSU');

    }
   
    public function create()
    {
        return view('dashboardSU.create');
    }
   
    //     public function getUsers()
// {
//     $users = User::with('Guru')
//         ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
//         ->get()
//         ->map(function ($user) {
//             $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
//             $user->Role = implode(', ', explode(',', $user->Role)); 
//             $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
//             $user->action = '
//             <a href="' . route('dashboardSU.edit1', $user->id) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
//                 <i class="fas fa-user-edit text-secondary"></i>
//             </a>';

    //             // Nama Guru
//             $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';

    //             return $user;
//         });
//     return DataTables::of($users)
//         ->addColumn('Role', function ($user) {
//             return $user->Role;
//         })
//         ->rawColumns(['checkbox', 'action'])
//         ->make(true);
// }

    public function getUsers()
    {
        $users = User::with('Guru')
            ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
            ->whereIn('hakakses', ['SU', 'Admin', 'KepalaSekolah', 'Guru', 'Kurikulum'])
            ->get()
            ->map(function ($user) {
                // Generate secure short hash
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8); // 8 karakter pertama dari hash SHA-256
    
                // Format created_at
                $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');

                // Handle Role
                $user->Role = implode(', ', explode(',', $user->Role));

                // Tambahkan checkbox dan action
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('dashboardSU.edit1', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';

                // Nama Guru
                $user->Guru_Nama = $user->Guru ? $user->Guru->Nama : '-';

                return $user;
            });

        return DataTables::of($users)
            ->addColumn('Role', function ($user) {
                return $user->Role;
            })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }
   
    public function edit($hashedId)
    {
        $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });
        $roles = explode(',', $user->getRawOriginal('Role'));


        // Jika user tidak ditemukan
        if (!$user) {
            abort(404, 'User not found.');
        }

        // Kirim data user dan hashedId ke view
        return view('dashboardSU.edit', compact('user', 'hashedId', 'roles'));
    }
  

    // public function edit($hashedId)
// {
//     $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });

    //     if (!$user) {
//         abort(404, 'User not found.');
//     }
//     return view('dashboardSU.edit', compact('user'));
// }
    public function update(Request $request, $hashedId)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:12|min:7|regex:/^[a-zA-Z0-9_-]+$/',
            'password' => 'nullable|string|max:12|min:7',
            'hakakses' => 'required|string|in:SU,KepalaSekolah,Admin,Guru,Kurikulum',
            'Role' => 'required|array|min:1|in:SU,KepalaSekolah,Admin,Guru,Kurikulum',
            'Nama' => 'required|string|max:255',
        ]);

        $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
            $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
            return $expectedHash === $hashedId;
        });

        if (!$user) {
            return redirect()->route('dashboardSU.index')->with('error', 'ID tidak valid.');
        }

        // Convert Role array to comma-separated string
        $roles = implode(',', $validatedData['Role']);

        $userData = [
            'username' => $validatedData['username'],
            'hakakses' => $validatedData['hakakses'],
            'Role' => $roles, // Simpan sebagai string
        ];

        if (!empty($validatedData['password'])) {
            $userData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($userData);

        if ($user->Guru) {
            $user->Guru->update([
                'Nama' => $validatedData['Nama'],
            ]);
        }

        return redirect()->route('dashboardSU.index')->with('success', 'User Berhasil Diupdate.');
    }
    

    // public function update(Request $request, $hashedId)
// {
//     // Validasi input
//     $validatedData = $request->validate([
//         'username' => 'required|string|max:12|min:7|regex:/^[a-zA-Z0-9_-]+$/',
//         'password' => 'nullable|string|max:12|min:7', 
//         // 'hakakses' => 'required|string',
//         'role' => 'required|in:SU,KepalaSekolah,Admin','Guru','Kurikulum',
//         'hakakses' => 'required|in:SU,KepalaSekolah,Admin','Guru','Kurikulum',
//         'Nama'     => 'required|string|max:255',
//         'permissions' => 'array', // Pastikan input berupa array
//     'permissions.*' => 'in:read,write,execute', // Setiap nilai dalam array harus valid
//     ]);

    //     // Temukan user berdasarkan hashedId
//     $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });

    //     if (!$user) {
//         return redirect()->route('dashboardSU.index')->with('error', 'ID tidak valid.');
//     }

    //     // Update data user
//     $userData = [
//         'username' => $validatedData['username'],
//         'hakakses' => $validatedData['hakakses'],
//         'Role'     => $validatedData['Role'],
//     ];

    //     // Hash password jika ada
//     if (!empty($validatedData['password'])) {
//         $userData['password'] = bcrypt($validatedData['password']); // Hash password sebelum menyimpan
//     }

    //     $user->update($userData);

    //     // Update data Guru jika ada
//     if ($user->Guru) {
//         $user->Guru->update([
//             'Nama' => $validatedData['Nama'],
//         ]);
//     }

    //     return redirect()->route('dashboardSU.index')->with('success', 'User berhasil diperbarui.');
// }
    
    // public function update(Request $request, $hashedId)
// {
//     $validatedData = $request->validate([
//         'username' => 'required|string|max:12|min:7|regex:/^[a-zA-Z0-9_-]+$/',
//         'password' => 'nullable|string|max:12|min:7',
//         'hakakses' => 'required|string',
//         'Role'     => 'required|string',
//         'Nama' => 'required|string|max:255', 
//     ]);
//     $user = User::with('Guru')->get()->first(function ($u) use ($hashedId) {
//         $expectedHash = substr(hash('sha256', $u->id . env('APP_KEY')), 0, 8);
//         return $expectedHash === $hashedId;
//     });
//     if (!$user) {
//         return redirect()->route('dashboardSU.index')->with('error', 'ID tidak valid.');
//     }
//     $user->update([
//         'username' => $validatedData['username'],
//         'password' => $validatedData['password'],
//         'hakakses' => $validatedData['hakakses'],
//         'Role'     => $validatedData['Role'],
//     ]);
//     if ($user->Guru) {
//         $user->Guru->update([
//             'Nama' => $validatedData['Nama'],
//         ]);
//     }
//     return redirect()->route('dashboardSU.index')->with('success', 'User BerhasilDiupdate.');
// }
    public function deleteUsers(Request $request)
    {
        // Validasi UUID
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'uuid',  // Pastikan ID yang dikirimkan adalah UUID
        ]);

        // Hapus pengguna berdasarkan UUID
        User::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected users and their related data deleted successfully.'
        ]);
    }
  
    // public function deleteUsers(Request $request)
    // {
    //     $request->validate([
    //         'ids' => 'required|array|min:1',
    //         'ids.*' => 'integer',
    //     ]);
    //     User::whereIn('id', $request->ids)->delete();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Selected users and their related data deleted successfully.'
    //     ]);
    // }

}

