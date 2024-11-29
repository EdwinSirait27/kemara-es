<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'tb_guru'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'guru_id';

    protected $fillable = ['Nama'];
    
}
