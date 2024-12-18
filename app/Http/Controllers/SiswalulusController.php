<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Rules\NoXSSInput;

class SiswalulusController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        return view('Siswalulus.index');

    }
    public function create()
    {
        return view('Siswalulus.create');
    }
    public function getSiswalulus()
    {
        $users = User::with('Siswa')
            ->select(['id', 'siswa_id', 'hakakses','created_at'])
            ->whereIn('hakakses', ['Siswa'])
            ->get()
            ->map(function ($user) {
                $user->id_hashed = substr(hash('sha256', $user->id . env('APP_KEY')), 0, 8);
                // $user->created_at = Carbon::parse($user->created_at)->format('d-m-Y'); $user->Role = implode(', ', explode(',', $user->Role));
                $user->checkbox = '<input type="checkbox" class="user-checkbox" value="' . $user->id_hashed . '">';
                $user->action = '
            <a href="' . route('dashboardSU.edit1', $user->id_hashed) . '" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>';
                $user->Siswa_Nama = $user->Siswa ? $user->Siswa->NamaLengkap : '-';
                $user->Siswa_NomorTelephone = $user->Siswa ? $user->Siswa->NomorTelephone : '-';
                $user->Siswa_NomorTelephoneAyah = $user->Siswa ? $user->Siswa->NomorTelephoneAyah : '-';
                $user->Siswa_NomorTelephoneAyah = $user->Siswa ? $user->Siswa->NomorTelephoneAyah : '-';
                $user->Siswa_Alamat = $user->Siswa ? $user->Siswa->Alamat : '-';
                $user->Siswa_Email = $user->Siswa ? $user->Siswa->Email : '-';
                $user->Siswa_Email = $user->Siswa ? $user->Siswa->Email : '-';
                return $user;
            });
        return DataTables::of($users)
        ->addColumn('created_at', function ($user) {
            return Carbon::parse($user->created_at)->format('d-m-Y');
        })
            ->rawColumns(['checkbox', 'action'])
            ->make(true);

    }

}
