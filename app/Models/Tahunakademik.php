<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tahunakademik extends Model
{
    use HasFactory;
    protected $table = 'tb_tahunakademik'; // Tentukan nama tabel secara eksplisit
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahunakademik',
        'semester',      
        'tanggalmulai',      
        'tanggalakhir',      
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
// <div class="row">
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="tahunakademik" class="form-control-label">
//                                         <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
//                                     </label>
//                                     <div>
//                                         <input type="text" class="form-control" id="tahunakademik"
//                                             name="tahunakademik"
//                                             value="{{ old('tahunakademik', $tahunakademik->tahunakademik) }}" required
//                                             oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="4">
//                                             <p class="text-muted text-xs mt-2">Contoh : 2024</p>

//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="semester" class="form-control-label">
//                                         <i class="fas fa-lock"></i> {{ __('Semester') }}
//                                     </label>
//                                         <div class="@error('semester') border border-danger rounded-3 @enderror">
//                                             <select class="form-control" name="semester" id="semester" required>
//                                                 <option value="" disabled
//                                                     {{ old('semester', $tahunakademik->semester ?? '') == '' ? 'selected' : '' }}>
//                                                     Pilih Semester</option>
//                                                 <option value="Ganjil"
//                                                     {{ old('semester', $tahunakademik->semester ?? '') == 'Ganjil' ? 'selected' : '' }}>
//                                                     Ganjil</option>
//                                                 <option value="Genap"
//                                                     {{ old('semester', $tahunakademik->semester ?? '') == 'Genap' ? 'selected' : '' }}>
//                                                     Genap</option>
//                                             </select>
//                                             @error('semester')
//                                                 <span class="invalid-feedback" role="alert">
//                                                     <strong>{{ $message }}</strong>
//                                                 </span>
//                                             @enderror
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="row">
//                                 <div class="col-md-6">
//                                     <div class="form-group">
//                                         <label for="tanggalmulai" class="form-control-label">
//                                             <i class="fas fa-lock"></i> {{ __('Tanggal Mulai') }}
//                                         </label>
//                                         <div>
//                                             <input type="date" class="form-control" id="tanggalmulai"
//                                                 name="tanggalmulai"
//                                                 value="{{ old('tanggalmulai', $tahunakademik->tanggalmulai) }}"
//                                                 required>
//                                         </div>
//                                     </div>
//                                 </div>
//                                 <div class="col-md-6">
//                                     <div class="form-group">
//                                         <label for="tanggalakhir" class="form-control-label">
//                                             <i class="fas fa-lock"></i> {{ __('Tanggal Akhir') }}
//                                         </label>
//                                             <input type="date" class="form-control" id="tanggalakhir"
//                                                 name="tanggalakhir"
//                                                 value="{{ old('tanggalakhir', $tahunakademik->tanggalakhir) }}"
//                                                 required>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="row">
//                                 <div class="col-md-6">
//                                     <div class="form-group">
//                                         <label for="status" class="form-control-label">
//                                             <i class="fas fa-lock"></i> {{ __('Status') }}
//                                         </label>
//                                         <div class="@error('status') border border-danger rounded-3 @enderror">
//                                             <select class="form-control" name="status" id="status" required>
//                                                 <option value="" disabled
//                                                     {{ old('status', $tahunakademik->status ?? '') == '' ? 'selected' : '' }}>
//                                                     Pilih Status</option>
//                                                 <option value="Aktif"
                            //                         {{ old('status', $tahunakademik->status ?? '') == 'Aktif' ? 'selected' : '' }}>
                            //                         Aktif</option>
                            //                     <option value="Tidak Aktif"
                            //                         {{ old('status', $tahunakademik->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>
                            //                         Tidak Aktif</option>
                            //                 </select>
                            //                 @error('status')
                            //                     <span class="invalid-feedback" role="alert">
                            //                         <strong>{{ $message }}</strong>
                            //                     </span>
                            //                 @enderror
                            //             </div>
                            //         </div>
                            //     </div>
                            //     <div class="col-md-6">
                            //         <div class="form-group">
                            //             <label for="ket" class="form-control-label">
                            //                 <i class="fas fa-lock"></i> {{ __('Ketssserangan') }}
                            //             </label>
                            //                 <input type="text" class="form-control" id="ket" name="ket"
                            //                     value="{{ old('ket', $tahunakademik->ket) }}" required
                            //                     oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');"
                            //                     maxlength="50">
                            //             </div>
                            //         </div>
                            //     </div>
                            // </div>
