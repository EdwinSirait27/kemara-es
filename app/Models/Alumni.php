<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Alumni extends Model
{
    use HasFactory;

    protected $table = 'tb_alumni';
    protected $primaryKey = 'id';
  
    protected $fillable = [
        'foto',
        'NamaLengkap',
        'JenisKelamin',
        'TempatLahir',
        'TanggalLahir',
        'Agama',
        'Alamat',
        'Email',
        'NomorTelephone',
        'TahunLulus',
        'Jurusan',
        'ProgramStudi',
        'Gelar',
        'PerguruanTinggi',
        'StatusPekerja',
        'NamaPerusahaan',
        'Ig',
        'Linkedin',
        'Tiktok',
        'Instagram',
        'Facebook',
        'Testimoni',
    ];
}
