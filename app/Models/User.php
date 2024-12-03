<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Indikasi bahwa primary key menggunakan UUID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Kolom primary key tidak auto-increment.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Nama kolom primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Properti yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'password',
        'hakakses',
        'Role',
        'guru_id',
        'siswa_id',
    ];

    /**
     * Properti yang harus disembunyikan saat serialisasi.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Properti yang harus dikonversi ke tipe data asli.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string', // Cast UUID sebagai string
        'email_verified_at' => 'datetime',
        // 'Role' => 'array',
    ];

    /**
     * Boot method untuk mengatur UUID secara otomatis.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
        public function findForAuth($username)
    {
        return $this->where('username', $username)->first();
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m-d-Y H:i');
    }
    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'guru_id');
    }
    
    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
// <?php

// namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
// use Carbon\Carbon;
// class User extends Authenticatable
// {
//     use HasApiTokens, HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var string[]
//      */
//     protected $fillable = [
//         'guru_id',
//         'siswa_id',
//         'username',
//         'password',
//         'hakakses',
//         'Role',
//         // 'no_pdf',
//         'tahundaftar',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array
//      */
//     protected $casts = [
//         'email_verified_at' => 'datetime',
//         // 'Role' => 'array',
//     ];
//     public function findForAuth($username)
//     {
//         return $this->where('username', $username)->first();
//     }
//     public function getCreatedAtAttribute($value)
//     {
//         // Mengubah format `created_at` menjadi `m-d-Y H:i` (bulan-hari-tahun jam:menit)
//         return Carbon::parse($value)->format('m-d-Y H:i');
//     }
//     public function Guru()
//     {
//         return $this->belongsTo(Guru::class, 'guru_id');
//     }

//     // Relasi dengan tabel Siswa
//     public function Siswa()
//     {
//         return $this->belongsTo(Siswa::class, 'siswa_id');
//     }
// }
