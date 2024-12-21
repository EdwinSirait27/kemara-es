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
    public function tahunAkademik()
    {
        return $this->hasMany(TahunAkademik::class, 'kurikulum_id', 'id');
    }
}
