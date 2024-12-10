<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Kurikulum extends Model
{
    protected $table = 'tb_kurikulum'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'kurikulum',
        'status',
        'ket',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
}
