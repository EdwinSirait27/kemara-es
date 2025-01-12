<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturankelassiswa extends Model
{
    protected $table = 'tb_pengaturankelas_siswa'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'pengaturankelas_id',
        'datamengajar_id',
        
 
    ];
    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','id');
    }
    public function Pengaturankelas()
    {
        return $this->belongsTo(Pengaturankelas::class,'pengaturankelas_id','id');
    }
    public function Datamengajar()
    {
        return $this->belongsTo(Data_mengajar::class,'datamengajar_id','id');
    }

}
