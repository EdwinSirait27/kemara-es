<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kelassiswa extends Model
{
    protected $table = 'tb_kelas_siswa'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'pengaturankelas_id',
        'ket',
 
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function Pengaturankelas()
    {
        return $this->belongsTo(Pengaturankelas::class, 'pengaturankelas_id');
    }
   
}
