<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Organisasi extends Model
{
    use HasFactory;
    protected $table = 'tb_organisasi'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'guru_id',
        'tahunakademik_id',
        'namaorganisasi',
        'kapasitas',
        'status',
        'ket',
    ];
    public function Guru(){
        return $this->belongsTo(Guru::class,'guru_id');
    }
    public function Tahunakademik(){
        return $this->belongsTo(Tahunakademik::class,'tahunakademik_id','id');
    }
}
