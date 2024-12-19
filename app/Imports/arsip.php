<?php

namespace App\Imports;

use App\Models\ArsipSiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class arsip implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);  // Debugging untuk melihat isi row
        $row = array_change_key_case($row, CASE_LOWER);
        return new ArsipSiswa([
         'NamaLengkap' => $row['namalengkap'],
        'NomorInduk' => $row['nomorinduk'],
        'NamaPanggilan' => $row['namapanggilan'],
        'JenisKelamin' => $row['jeniskelamin'],
        'NISN' => $row['nisn'],
        'TempatLahir' => $row['tempatlahir'],
        'TanggalLahir' => (strtotime($row['tanggallahir']) !== false) 
                    ? date('m-d-Y', strtotime($row['tanggallahir'])) 
                    : null,

        'Agama' => $row['agama'],
        'Alamat' => $row['alamat'],
        'RT' => $row['rt'],
        'RW' => $row['rw'],
        'Kelurahan' => $row['kelurahan'],
        'Kecamatan' => $row['kecamatan'],
        'KabKota' => $row['kabkota'],
        'Provinsi' => $row['provinsi'],
        'KodePos' => $row['kodepos'],
        'Email' => $row['email'],
        'NomorTelephone' => $row['nomortelephone'],
        'Kewarganegaraan' => $row['kewarganegaraan'],
        'NIK' => $row['nik'],
        'GolDarah' => $row['goldarah'],
        'TinggalDengan' => $row['tinggaldengan'],
        'StatusSiswa' => $row['statussiswa'],
        'AnakKe' => $row['anakke'],
        'SaudaraKandung' => $row['saudarakandung'],
        'SaudaraTiri' => $row['saudaratiri'],
        'Tinggicm' => $row['tinggicm'],
        'Beratkg' => $row['beratkg'],
        'RiwayatPenyakit' => $row['riwayatpenyakit'],
        'AsalSD' => $row['asalsd'],
        'AlamatSD' => $row['alamatsd'],
        'NPSNSD' => $row['npsnsd'],
        'KabKotaSD' => $row['kabkotasd'],
        'ProvinsiSD' => $row['provinsisd'],
        'NoIjasah' => $row['noijasah'],
        'DiterimaTanggal' => (strtotime($row['diterimatanggal']) !== false) 
                                ? date('m-d-Y', strtotime($row['diterimatanggal'])) 
                                : null,
        'DiterimaDiKelas' => $row['diterimadikelas'],
        'DiterimaSemester' => $row['diterimasemester'],
        'MutasiAsalSMP' => $row['mutasiasalsmp'],
        'AlasanPindah' => $row['alasanpindah'],
        'TglIjasahSD' => (strtotime($row['tglijasahsd']) !== false) 
                                ? date('m-d-Y', strtotime($row['tglijasahsd'])) 
                                : null,
        'NamaOrangTuaPadaIjasah' => $row['namaorangtuapadaijasah'],
        'NamaAyah' => $row['namaayah'],
        'TahunLahirAyah' => $row['tahunlahirayah'],
        'AlamatAyah' => $row['alamatayah'],
        'NomorTelephoneAyah' => $row['nomortelephoneayah'],
        'AgamaAyah' => $row['agamaayah'],
        'PendidikanTerakhirAyah' => $row['pendidikanterakhirayah'],
        'PekerjaanAyah' => $row['pekerjaanayah'],
        'PenghasilanAyah' => $row['penghasilanayah'],
        'NamaIbu' => $row['namaibu'],
        'TahunLahirIbu' => $row['tahunlahiribu'],
        'AlamatIbu' => $row['alamatibu'],
        'NomorTelephoneIbu' => $row['nomortelephoneibu'],
        'AgamaIbu' => $row['agamaibu'],
        'PendidikanTerakhirIbu' => $row['pendidikanterakhiribu'],
        'PekerjaanIbu' => $row['pekerjaanibu'],
        'PenghasilanIbu' => $row['penghasilanibu'],
        'NamaWali' => $row['namawali'],
        'TahunLahirWali' => $row['tahunlahirwali'],
        'AlamatWali' => $row['alamatwali'],
        'NomorTelephoneWali' => $row['nomortelephonewali'],
        'AgamaWali' => $row['agamawali'],
        'PendidikanTerakhirWali' => $row['pendidikanterakhirwali'],
        'PekerjaanWali' => $row['pekerjaanwali'],
        'WaliPenghasilan' => $row['walipenghasilan'],
        'StatusHubunganWali' => $row['statushubunganwali'],
        'MenerimaBeasiswaDari' => $row['menerimabeasiswadari'],
        'TahunMeninggalkanSekolah' => $row['tahunmeninggalkansekolah'],
        'AlasanSebab' => $row['alasansebab'],
        'InformasiLain' => $row['informasilain'],
        'status' => $row['status'],
        'TahunDaftar' => (strtotime($row['tahundaftar']) !== false) 
                                ? date('m-d-Y', strtotime($row['tahundaftar'])) 
                                : null,
        'TamatBelajarTahun' => (strtotime($row['tamatbelajartahun']) !== false) 
                                ? date('Y-m-d', strtotime($row['tamatbelajartahun'])) 
                                : null,
        ]);
    }
}
// <?php

// namespace App\Imports;

// use App\Models\ArsipSiswa;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class arsip implements ToModel, WithHeadingRow
// {
//     /**
//      * @param array $row
//      * @return \Illuminate\Database\Eloquent\Model|null
//      */
//     public function model(array $row)
//     {
//         // dd($row);  // Debugging untuk melihat isi row
//         $row = array_change_key_case($row, CASE_LOWER);
//         return new ArsipSiswa([
//          'NamaLengkap' => $row['namalengkap'],
//         'NomorInduk' => $row['nomorinduk'],
//         'NamaPanggilan' => $row['namapanggilan'],
//         'JenisKelamin' => $row['jeniskelamin'],
//         'NISN' => $row['nisn'],
//         'TempatLahir' => $row['tempatlahir'],
//         'TanggalLahir' => (strtotime($row['tanggallahir']) !== false) 
//                                 ? date('m/d/Y', strtotime($row['tanggallahir'])) 
//                                 : null,
//         'Agama' => $row['agama'],
//         'Alamat' => $row['alamat'],
//         'RT' => $row['rt'],
//         'RW' => $row['rw'],
//         'Kelurahan' => $row['kelurahan'],
//         'Kecamatan' => $row['kecamatan'],
//         'KabKota' => $row['kabkota'],
//         'Provinsi' => $row['provinsi'],
//         'KodePos' => $row['kodepos'],
//         'Email' => $row['email'],
//         'NomorTelephone' => $row['nomortelephone'],
//         'Kewarganegaraan' => $row['kewarganegaraan'],
//         'NIK' => $row['nik'],
//         'GolDarah' => $row['goldarah'],
//         'TinggalDengan' => $row['tinggaldengan'],
//         'StatusSiswa' => $row['statussiswa'],
//         'AnakKe' => $row['anakke'],
//         'SaudaraKandung' => $row['saudarakandung'],
//         'SaudaraTiri' => $row['saudaratiri'],
//         'Tinggicm' => $row['tinggicm'],
//         'Beratkg' => $row['beratkg'],
//         'RiwayatPenyakit' => $row['riwayatpenyakit'],
//         'AsalSD' => $row['asalsd'],
//         'AlamatSD' => $row['alamatsd'],
//         'NPSNSD' => $row['npsnsd'],
//         'KabKotaSD' => $row['kabkotasd'],
//         'ProvinsiSD' => $row['provinsisd'],
//         'NoIjasah' => $row['noijasah'],
//         'DiterimaTanggal' => (strtotime($row['diterimatanggal']) !== false) 
//                                 ? date('m-d-Y', strtotime($row['diterimatanggal'])) 
//                                 : null,
//         'DiterimaDiKelas' => $row['diterimadikelas'],
//         'DiterimaSemester' => $row['diterimasemester'],
//         'MutasiAsalSMP' => $row['mutasiasalsmp'],
//         'AlasanPindah' => $row['alasanpindah'],
//         'TglIjasahSD' => (strtotime($row['tglijasahsd']) !== false) 
//                                 ? date('m-d-Y', strtotime($row['tglijasahsd'])) 
//                                 : null,
//         'NamaOrangTuaPadaIjasah' => $row['namaorangtuapadaijasah'],
//         'NamaAyah' => $row['namaayah'],
//         'TahunLahirAyah' => $row['tahunlahirayah'],
//         'AlamatAyah' => $row['alamatayah'],
//         'NomorTelephoneAyah' => $row['nomortelephoneayah'],
//         'AgamaAyah' => $row['agamaayah'],
//         'PendidikanTerakhirAyah' => $row['pendidikanterakhirayah'],
//         'PekerjaanAyah' => $row['pekerjaanayah'],
//         'PenghasilanAyah' => $row['penghasilanayah'],
//         'NamaIbu' => $row['namaibu'],
//         'TahunLahirIbu' => $row['tahunlahiribu'],
//         'AlamatIbu' => $row['alamatibu'],
//         'NomorTelephoneIbu' => $row['nomortelephoneibu'],
//         'AgamaIbu' => $row['agamaibu'],
//         'PendidikanTerakhirIbu' => $row['pendidikanterakhiribu'],
//         'PekerjaanIbu' => $row['pekerjaanibu'],
//         'PenghasilanIbu' => $row['penghasilanibu'],
//         'NamaWali' => $row['namawali'],
//         'TahunLahirWali' => $row['tahunlahirwali'],
//         'AlamatWali' => $row['alamatwali'],
//         'NomorTelephoneWali' => $row['nomortelephonewali'],
//         'AgamaWali' => $row['agamawali'],
//         'PendidikanTerakhirWali' => $row['pendidikanterakhirwali'],
//         'PekerjaanWali' => $row['pekerjaanwali'],
//         'WaliPenghasilan' => $row['walipenghasilan'],
//         'StatusHubunganWali' => $row['statushubunganwali'],
//         'MenerimaBeasiswaDari' => $row['menerimabeasiswadari'],
//         'TahunMeninggalkanSekolah' => $row['tahunmeninggalkansekolah'],
//         'AlasanSebab' => $row['alasansebab'],
//         'InformasiLain' => $row['informasilain'],
//         'status' => $row['status'],
//         'TahunDaftar' => (strtotime($row['tahundaftar']) !== false) 
//                                 ? date('m-d-Y', strtotime($row['tahundaftar'])) 
//                                 : null,
//         'TamatBelajarTahun' => (strtotime($row['tamatbelajartahun']) !== false) 
//                                 ? date('Y-m-d', strtotime($row['tamatbelajartahun'])) 
//                                 : null,
//         ]);
//     }
// }
