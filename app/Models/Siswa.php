<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'siswa_id';

    protected $fillable = ['Nama'];
    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi dengan tabel Siswa
    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
