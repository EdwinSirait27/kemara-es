<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;
class KGSController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.xss');
    }
    public function indexSiswa()
    {
        return view('DatasiswaKGS.index');

    }
    public function indexGuru()
    {
        return view('DataGuruKGS.index');

    }
    
    public function getDatasiswaKGS()
    {
        
        $siswa = Siswa::select(['siswa_id', 'foto', 'NamaLengkap', 'Agama', 'NomorTelephone', 'Alamat', 'Email'])
            ->get()
            ->map(function ($siswa) {
                $siswa->foto = $siswa->foto ? $siswa->foto : 'we.jpg';
                return $siswa;
            });
        return DataTables::of($siswa)
            ->addColumn('foto', function ($siswa) {
                return $siswa->foto;
            })
            ->make(true);
    }
    public function getDataguruKGS()
    {
        $guru = Guru::select(['guru_id', 'foto', 'Nama', 'TugasMengajar', 'NomorTelephone', 'Alamat', 'Email'])
            ->get()
            ->map(function ($guru) {
                $guru->foto = $guru->foto ? $guru->foto : 'we.jpg';
                return $guru;
            });
        return DataTables::of($guru)
            ->addColumn('foto', function ($guru) {
                return $guru->foto;
            })
            ->make(true);
    }
}
