<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'tb_pembayaran'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'siswa_id',
        'status',
        'foto',
        'tanggalbukti',
        'ket',
            ];
            public function Siswa()
            {
                return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
            }
            public function User()
            {
                return $this->belongsTo(User::class, 'siswa_id');
            }
            public function getCreatedAtAttribute($value)
            {
                return Carbon::parse($value)
                    ->setTimezone('Asia/Makassar')
                    ->format('Y-m-d H:i:s'); // Format sesuai kebutuhan
            }
}
