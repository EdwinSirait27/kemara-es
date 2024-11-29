<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
     /**
     * Daftar nilai valid untuk kolom enum.
     */
    
    private $validHakakses = ['SU', 'Admin', 'Siswa','Guru','Kurikulum','NonSiswa','KepalaSekolah'];
    private $validRoles = ['SU', 'Admin', 'Siswa','Guru','Kurikulum','NonSiswa','KepalaSekolah'];
    /**
     * Memetakan setiap baris dalam file Excel ke model User.
     *
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $guruId = is_numeric($row[0]) ? (int) $row[0] : null;
        $siswaId = is_numeric($row[1]) ? (int) $row[1] : null;
        // $tahun = is_numeric($row[7]) ? (int) $row[7] : null;
        $hakakses = in_array($row[4], $this->validHakakses) ? $row[4] : null;
        $role = in_array($row[5], $this->validRoles) ? $row[5] : null;

        return new User([
            'guru_id' => $guruId,
            'siswa_id' => $siswaId,
            'Username' => $row[2], 
            'Password' => Hash::make($row[3]), 
            'hakakses' => $hakakses, 
            'Role' => $role, 
           
            // 'no_pdf' => $row[6], 
            // 'tahundaftar' => $tahun,
            'remember_token' => null, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
