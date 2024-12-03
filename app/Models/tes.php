<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tes extends Model
{
    use HasFactory;

    protected $table = 'users'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'guru_id',
        'siswa_id',
        'username',
        'password',
        'hakakses',
        'Role',
        'created_at',
        
    ];
    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'guru_id');
    }
}
