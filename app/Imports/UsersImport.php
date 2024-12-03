<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
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
        $guruId = is_numeric($row[1]) ? (int) $row[1] : null;
        $siswaId = is_numeric($row[2]) ? (int) $row[2] : null;
        $hakakses = in_array($row[5], $this->validHakakses) ? $row[5] : null;
        $role = in_array($row[6], $this->validRoles) ? $row[6] : null;

        return new User([
            // 'id' => $row[0] ?: Str::uuid(),
            'id' => $row[0] ? $row[0] : Str::uuid(),

            'guru_id' => $guruId,
            'siswa_id' => $siswaId,
            'Username' => $row[3], 
            'Password' => Hash::make($row[4]), 
            'hakakses' => $hakakses, 
            'Role' => $role, 
            'remember_token' => null, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
