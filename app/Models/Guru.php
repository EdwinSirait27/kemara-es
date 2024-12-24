<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'tb_guru'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'guru_id';

    protected $fillable = [
        'foto',
        'Nama',
        'TempatLahir',
        'TanggalLahir',
        'Agama',
        'JenisKelamin',
        'StatusPegawai',
        'NipNips',
        'Nuptk',
        'Nik',
        'Npwp',
        'NomorSertifikatPendidik',
        'TahunSertifikasi',
        'jadwalkenaikangaji',
        'PendidikanAkhir',
        'TahunTamat',
        'Jurusan',
        'TugasMengajar',
        'TahunPensiun',
        'Pangkat',
        'jadwalkenaikanpangkat',
        'Jabatan',
        'NomorTelephone',
        'Alamat',
        'Email',
        'status',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    
    public function Kelassiswa()
    {
        return $this->hasMany(Kelassiswa::class, 'guru_id', 'id');
    }
    
}
