@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Data Mengajar')

<style>
    .avatar {
        position: relative;
    }

    .iframe-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%;
        /* Aspect ratio 16:9 */
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>
<div>
    <div class="container-fluid">
       
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       

        <form action="{{ route('Datamengajar.update', $hashedId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Edit Data Mengajar') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">

                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <span class="alert-text text-white">
                                        {{ $error }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guru_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Nama Guru') }}
                                    </label>
                                    <div>
                                        <select name="guru_id" id="guru_id" class="form-select">
                                            <option value="" selected disabled>Pilih Guru</option>
                                            @foreach ($gurus as $guru)
                                            <option value="{{ $guru->guru_id }}" {{ $datamengajar->guru_id == $guru->guru_id ? 'selected' : '' }}>
                                                {{ $guru->guru_id }} - {{ $guru->Nama }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('guru_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu</p>
                                        
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="matapelajaran_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Mata Pelajaran') }}
                                    </label>
                                    <div>
                                        <select name="matapelajaran_id" id="matapelajaran_id" class="form-select">
                                            <option value="" selected disabled>Pilih Matpel</option>
                                            @foreach ($matpels as $mata)
                                            <option value="{{ $mata->id }}" {{ $datamengajar->matapelajaran_id == $mata->id ? 'selected' : '' }}>
                                                {{ $mata->id }} - {{ $mata->matapelajaran }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('matapelajaran_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu</p>
                                        
                                    
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hari" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Hari') }}
                                    </label>
                                    <div>
                                        <select class="form-control" name="hari" id="hari" required>
                                            <option value="" disabled
                                                {{ old('hari', $datamengajar->hari ?? '') == '' ? 'selected' : '' }}>
                                                Pilih Hari</option>
                                            <option value="Senin"
                                                {{ old('hari', $datamengajar->hari ?? '') == 'Senin' ? 'selected' : '' }}>
                                                Senin</option>
                                           
                                            <option value="Senin"
                                                {{ old('hari', $datamengajar->hari ?? '') == 'Selasa' ? 'selected' : '' }}>
                                                Selasa</option>
                                           
                                            <option value="Rabu"
                                                {{ old('hari', $datamengajar->hari ?? '') == 'Rabu' ? 'selected' : '' }}>
                                                Rabu</option>
                                           
                                            <option value="Kamis"
                                                {{ old('hari', $datamengajar->hari ?? '') == 'Kamis' ? 'selected' : '' }}>
                                                Kamis</option>
                                           
                                            <option value="Jumat"
                                                {{ old('hari', $datamengajar->hari ?? '') == 'Jumat' ? 'selected' : '' }}>
                                                Jumat</option>
                                           
                                            
                                           
                                        </select>
                                        @error('hari')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="awalpel" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Awal Waktu Pelajaran') }}
                                    </label>
                                    <div>
                                        <input type="time" class="form-control" id="awalpel"
                                            name="awalpel"
                                            value="{{ old('awalpel', $datamengajar->awalpel) }}"
                                            required>
                                   
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="akhirpel" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Akhir Waktu Pelajaran') }}
                                    </label>
                                    <div>
                                        <input type="time" class="form-control" id="akhirpel" name="akhirpel"
                                        value="{{ old('akhirpel', $datamengajar->akhirpel) }}" required
                                         >
                                 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="awalis" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Awal Istirahat') }}
                                    </label>
                                    <div>
                                        <input type="time" class="form-control" id="awalis"
                                            name="awalis"
                                            value="{{ old('awalis', $datamengajar->awalis) }}"
                                            required>
                                   
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="akhiris" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Akhir Istirahat') }}
                                    </label>
                                    <div>
                                        <input type="time" class="form-control" id="akhiris" name="akhiris"
                                        value="{{ old('akhiris', $datamengajar->akhiris) }}" required
                                         >
                                 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ket" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Keterangan') }}
                                        </label>
                                        <div>
                                            <input type="text" class="form-control" id="ket" name="ket"
                                            value="{{ old('ket', $datamengajar->ket) }}" required
                                             maxlength="50">
                                     
                                        </div>
                                    </div>
                                </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 me-2">
                                {{ __('Update') }}
                            </button> 
                            <a href="{{ route('Datamengajar.index') }}" class="btn btn-secondary mt-4 mb-4">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                        
                  
        </form>
    </div>
</div>
<div class="alert alert-secondary mx-4" role="alert">
    <span class="text-white">
        <strong>Keterangan</strong> <br>
    </span>
    <span class="text-white">-
        <strong> Silahkan mengatur guru dan mata pelajran dan sesuaikan jadwalnya dari hari senin sampai jumat agar jadwal mata pelajaran dibuat </strong>
        
            <br>

    </span>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
