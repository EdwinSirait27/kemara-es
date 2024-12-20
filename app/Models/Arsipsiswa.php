<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsipsiswa extends Model
{
    protected $table = 'tb_siswaarsip';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'NamaLengkap',
        'NomorInduk',
        'NamaPanggilan',
        'JenisKelamin',
        'NISN',
        'TempatLahir',
        'TanggalLahir',
        'Agama',
        'Alamat',
        'RT',
        'RW',
        'Kelurahan',
        'Kecamatan',
        'KabKota',
        'Provinsi',
        'KodePos',
        'Email',
        'NomorTelephone',
        'Kewarganegaraan',
        'NIK',
        'GolDarah',
        'TinggalDengan',
        'StatusSiswa',
        'AnakKe',
        'SaudaraKandung',
        'SaudaraTiri',
        'Tinggicm',
        'Beratkg',
        'RiwayatPenyakit',
        'AsalSD',
        'AlamatSD',
        'NPSNSD',
        'KabKotaSD',
        'ProvinsiSD',
        'NoIjasah',
        'DiterimaTanggal',
        'DiterimaDiKelas',
        'DiterimaSemester',
        'MutasiAsalSMP',
        'AlasanPindah',
        'TglIjasahSD',
        'NamaOrangTuaPadaIjasah',
        'NamaAyah',
        'TahunLahirAyah',
        'AlamatAyah',
        'NomorTelephoneAyah',
        'AgamaAyah',
        'PendidikanTerakhirAyah',
        'PekerjaanAyah',
        'PenghasilanAyah',
        'NamaIbu',
        'TahunLahirIbu',
        'AlamatIbu',
        'NomorTelephoneIbu',
        'AgamaIbu',
        'PendidikanTerakhirIbu',
        'PekerjaanIbu',
        'PenghasilanIbu',
        'NamaWali',
        'TahunLahirWali',
        'AlamatWali',
        'NomorTelephoneWali',
        'AgamaWali',
        'PendidikanTerakhirWali',
        'PekerjaanWali',
        'WaliPenghasilan',
        'StatusHubunganWali',
        'MenerimaBeasiswaDari',
        'TahunMeninggalkanSekolah',
        'AlasanSebab',
        'InformasiLain',
        'status',
        'TahunDaftar',
        'TamatBelajarTahun',
    ];
    
}