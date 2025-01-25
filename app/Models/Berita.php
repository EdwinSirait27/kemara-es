<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'tb_berita'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'header',
        'body',
        'gambar1',
        'gambar2',
        'gambar3',
        'gambar4',
        'gambar5',
        'gambar6',
        'gambar7',
        'gambar8',
        'status',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

