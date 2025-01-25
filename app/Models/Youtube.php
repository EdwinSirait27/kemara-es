<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Youtube extends Model
{
    use HasFactory;
    protected $table = 'tb_youtube'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'url',
        'status',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}