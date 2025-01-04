<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Organisasisiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_organisasi_siswa'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'organisasi_id',
        'user_id',
        
    ];
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Organisasi(){
        return $this->belongsTo(Organisasi::class,'oeganisasi_id','id');
    }
}
