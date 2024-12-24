<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Data_mengajar extends Model
{
    protected $table = 'tb_datamengajar'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'guru_id',
        'matapelajaran_id',
        'hari',
        'awalpel',
        'akhirpel',
        'awalis',
        'akhiris',
        'ket',
    ];
    
    public function Matapelajaran()
    {
        return $this->belongsTo(Matapelajaran::class, 'matapelajaran_id');
    }
    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    public function KelasSiswa()
{
    return $this->hasMany(Kelassiswa::class, 'datamengajar_id', 'id');
}
    public function Pengaturankelas()
{
    return $this->hasMany(Pengaturankelas::class, 'datamengajar_id', 'id');
}

}
