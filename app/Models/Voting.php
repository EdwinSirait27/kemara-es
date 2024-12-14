<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voting extends Model
{
    use HasFactory;
    protected $table = 'tb_voting'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'osis_id',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Osis()
    {
        return $this->belongsTo(Osis::class, 'osis_id');
    }
}
