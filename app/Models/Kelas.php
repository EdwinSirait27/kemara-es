<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'tb_kelas'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'guru_id',
        'tahunakademik_id',
        'kelas',
        'kapasitas',
        'status',
        'ket',
    ];
    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    public function Tahunakademik()
    {
        return $this->belongsTo(Tahunakademik::class, 'tahunakademik_id','id');
    }
    // public function Kelassiswa()
    // {
    //     return $this->hasMany(Kelassiswa::class, 'kelas_id', 'id');
    // }
    public function Pengaturankelas()
    {
        return $this->hasMany(Pengaturankelas::class, 'kelas_id', 'id');
    }

}
