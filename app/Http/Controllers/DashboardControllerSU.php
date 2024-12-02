<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class DashboardControllerSU extends Controller
{
    public function index()
    {
        // return view('DashboardSU.DashboardSU');
        return view('dashboardSU/dashboardSU');

    }

    // public function getUsers()
    // {
    //     $users = User::select(['id', 'Username', 'Role','created_at']);
    //     // $users = User::select('*'); 
    //     return DataTables::of($users)->make(true);
        
    // }
    public function create()
    {
        return view('DashboardSU.create');
    }
    
    public function getUsers()
{
    $users = User::select(['id', 'Username', 'Role', 'created_at'])
        ->get()
        ->map(function($user) {
            // Tambahkan kolom checkbox ke setiap user
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
