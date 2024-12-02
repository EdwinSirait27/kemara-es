<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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
        $users = User::select(['id', 'Username', 'Role', 'created_at'])
            ->get()
            ->map(function ($user) {
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id . '">';
                $user->action = '
                <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                    <i class="fas fa-user-edit text-secondary"></i>
                </a>';
                return $user;
            });
        return DataTables::of($users)
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
    public function store(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
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