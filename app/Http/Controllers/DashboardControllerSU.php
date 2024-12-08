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
    public function getUsers()
{
    $users = User::with('Guru')
        ->select(['id', 'guru_id', 'username', 'hakakses', 'Role', 'created_at'])
        ->get()
        ->map(function ($user) {
            $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
            $user->Role = implode(', ', explode(',', $user->Role));
            $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
        

               
        $user->action = '
        <a href="' . route('dashboardSU.edit1', $user->id) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
            <i class="fas fa-user-edit text-secondary"></i>
        </a>';
            // $user->action = '
            //     <a href="' . route('dashboardSU.edit1', $user->uuid) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
            //         <i class="fas fa-user-edit text-secondary"></i>
            //     </a>';
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
//     $user->action = '<a href="' . route('dashboardSU.edit1', $user->uuid) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
        //     <i class="fas fa-user-edit text-secondary"></i>
        //   </a>';




public function edit($uuid)
{
   
    // Temukan user berdasarkan UUID (pastikan UUID valid)
    // $user = User::with('Guru')->findOrFail($uuid);
    $user = User::where('id', $uuid)->with('Guru')->firstOrFail(); // Ambil user berdasarkan UUID

    // Ambil semua data guru
    $gurus = Guru::all();

    // Return view dengan data yang diperlukan
    return view('dashboardSU.edit', compact('user', 'gurus'));
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
         'hakakses' => $request->hakakses, 
         'Role' => implode(',', $request->Role),
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

