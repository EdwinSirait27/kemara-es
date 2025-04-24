<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $tanggalLahir = $row[2];
    
        // Jika kolom TanggalLahir kosong atau tidak bisa diparse, set null
        if (empty($tanggalLahir) || !Carbon::hasFormat($tanggalLahir, 'Y-m-d')) {
            $tanggalLahir = null;
        } else {
            // Menggunakan Carbon untuk memastikan format tanggal yang benar
            $tanggalLahir = Carbon::parse($tanggalLahir)->format('Y-m-d');
        }

        return new Siswa([            
            'NamaLengkap' => $row[0],
            'TempatLahir' => $row[1],
             'TanggalLahir' => $tanggalLahir,
             'JenisKelamin' => ($row[3] == 'Laki-Laki' || $row[3] == 'Perempuan') ? $row[3] : null,  
            'Alamat' => $row[4],
            'NomorTelephone' => $row[5],
            'AsalSD' => $row[6],
            'NamaAyah' => $row[7],
            'PekerjaanAyah' => ($row[8] == 'PNS' || $row[8] == 'TNI/POLRI' || $row[8] == 'WIRASWASTA' || $row[8] == 'BUMN' || $row[8] == 'PEGAWAI SWASTA' || $row[8] == 'PETANI/NELAYAN') ? $row[8] : null,
            'PenghasilanAyah' => ($row[9] == 'DIBAWAH 1 JT' || $row[9] == '1 Jt s/d 2,5 Jt' || $row[9] == '2,5 Jt s/d 4 Jt' || $row[9] == 'DI ATAS 4 Jt') ? $row[9] : null,
            'NamaIbu' => $row[10],
            'PekerjaanIbu' => ($row[11] == 'PNS' || $row[11] == 'TNI/POLRI' || $row[11] == 'WIRASWASTA' || $row[11] == 'BUMN' || $row[11] == 'PEGAWAI SWASTA' || $row[11] == 'PETANI/NELAYAN') ? $row[11] : null,
            'PenghasilanIbu' => ($row[12] == 'DIBAWAH 1 JT' || $row[12] == '1 Jt s/d 2,5 Jt' || $row[12] == '2,5 Jt s/d 4 Jt' || $row[12] == 'DI ATAS 4 Jt') ? $row[12] : null,
            'NamaWali' => $row[13],
            'PekerjaanWali' => ($row[14] == 'PNS' || $row[14] == 'TNI/POLRI' || $row[14] == 'WIRASWASTA' || $row[14] == 'BUMN' || $row[14] == 'PEGAWAI SWASTA' || $row[14] == 'PETANI/NELAYAN') ? $row[14] : null,
            'StatusHubunganWali' => ($row[15] == 'KAKEK/NENEK' || $row[15] == 'SAUDARA KANDUNG' || $row[15] == 'OM/TANTE/PAMAN/BIBI' || $row[15] == 'KELUARGA LAINNYA') ? $row[15] : null,
            
            ]);
    }
}
