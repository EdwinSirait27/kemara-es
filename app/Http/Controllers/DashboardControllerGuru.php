<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use App\Models\Siswa;



class DashboardControllerGuru extends Controller
{
    
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function index()
    {
        $pengumuman = Pengumuman::all();
        $totaluser = User::count();
        $totallaki = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Laki-Laki');
        })->count();
        $totalperempuan = User::whereHas('Siswa', function ($query) {
            $query->where('JenisKelamin', 'Perempuan');
        })->count();
        $totalguru = User::whereIn('hakakses', ['SU', 'Guru', 'Admin', 'KepalaSekolah', 'Kurikulum'])
            ->count();
        $katolik = Siswa::whereIn('Agama', ['Katolik'])
            ->count();
        $kristen = Siswa::whereIn('Agama', ['Kristen Protestan'])
            ->count();
        $islam = Siswa::whereIn('Agama', ['Islam'])
            ->count();
        $hindu = Siswa::whereIn('Agama', ['Hindu'])
            ->count();
        $buddha = Siswa::whereIn('Agama', ['Buddha'])
            ->count();
        $kong = Siswa::whereIn('Agama', ['Konghucu'])
            ->count();

        return view('dashboardGuru.dashboardGuru', compact('totaluser', 'totallaki', 'totalperempuan', 'totalguru', 'katolik', 'kristen', 'islam', 'hindu', 'buddha', 'kong','pengumuman'));
    }
}

