<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahunakademik extends Model
{
    use HasFactory;
    protected $table = 'tb_tahunakademik'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahunakademik',
        'semester',
        'status',
        'ket',
    ];
}
