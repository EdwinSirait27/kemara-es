<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tombol extends Model
{
    use HasFactory;
    protected $table = 'tb_tombol'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';
    protected $fillable = [
        'url',
        'start_date',
        'end_date',
        'ket',
    ];
   
}
