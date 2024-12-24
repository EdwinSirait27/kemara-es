<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Matapelajaran extends Model
{
    use HasFactory;
    protected $table = 'tb_matapelajaran'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'matapelajaran',
        'kkm',
        'status',
        'ket',
    ];
    public function Kelassiswa()
    {
        return $this->hasMany(Kelassiswa::class, 'matapelajaran_id', 'id');
    }
   
    
}
