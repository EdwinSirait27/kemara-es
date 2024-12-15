<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'tb_ekstrakulikuler'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'namaekstra',
        'kapasitas',
        'status',
        'ket',
    ];
   
}
