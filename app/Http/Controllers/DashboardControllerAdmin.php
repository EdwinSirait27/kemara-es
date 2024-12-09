<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardControllerAdmin extends Controller
{
    public function index()
    {
        $totaluser = User::count();
        $totallaki = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Laki-Laki');
        })->count();
        $totalperempuan = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Perempuan');
        })->count();
        $totalguru = User::whereIn('hakakses', ['SU', 'Guru', 'Admin','KepalaSekolah','Kurikulum'])
                ->count();

        return view('dashboardAdmin.dashboardAdmin', compact('totaluser','totallaki','totalperempuan','totalguru'));

    }
}
