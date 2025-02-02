<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'tb_profile'; // Tentukan nama tabel secara eksplisit
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
    public function setHeaderAttribute($value)
    {
        $this->attributes['header'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Method untuk mendapatkan berita berdasarkan slug
    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
