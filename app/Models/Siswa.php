<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'siswa_id';

    protected $fillable = [
        'foto',
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
        'TamatBelajarTahun',
        'InformasiLain',
        'status',
    ];
    
    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi dengan tabel Siswa
    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    // ini cara nampilin tb user kepunyaan dari siswa contoh siswa_id primary key di tbsiswa terus foreign keynya ada di user
    public function user()
    {
        return $this->hasOne(User::class, 'siswa_id', 'siswa_id');
    }
    public function Kelassiswa()
    {
        return $this->hasMany(Kelassiswa::class, 'siswa_id', 'siswa_id');
    }

}
