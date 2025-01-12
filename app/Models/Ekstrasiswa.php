<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ekstrasiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_ekstra_siswa'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'ekstrakulikuler_id',
        'user_id',
        
    ];
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Ekstrakulikuler(){
        return $this->belongsTo(Ekstrakulikuler::class,'ekstrakulikuler_id','id');
    }
    public function Pengaturankelassiswa()
    {
        return $this->hasMany(Pengaturankelassiswa::class, 'siswa_id', 'siswa_id');
    }
    public function Pengaturankelas()
    {
        return $this->hasMany(Pengaturankelas::class, 'siswa_id', 'siswa_id');
    }

}
