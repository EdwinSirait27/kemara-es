<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturankelasdatamengajar extends Model
{
    protected $table = 'tb_pengaturankelas_datamengajar'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'datamengajar_id',
        'pengaturankelas_id',
        
 
    ];
    public function Datamengajar()
    {
        return $this->belongsTo(Data_mengajar::class, 'datamengajar_id','id');
    }
    public function Pengaturankelas()
    {
        return $this->belongsTo(Pengaturankelas::class,'pengaturankelas_id','id');
    }
}
