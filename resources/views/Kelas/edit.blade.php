@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Kelas')

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
        {{-- @if ($success->any())
            <div class="alert alert-success" role='alert'>
                <ul>
                    @foreach ($success->all() as $suc)
                        <li>{{ $suc }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('Kelas.update', $hashedId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Edit Kelas') }}</h6>
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
                                            <option value="{{ $guru->guru_id }}" {{ $kelas->guru_id == $guru->guru_id ? 'selected' : '' }}>
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
                                    <label for="kelas" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Kelas') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="kelas" name="kelas"
                                        value="{{ old('kelas', $kelas->kelas) }}" required
                                         maxlength="4">
                                        <p class="text-muted text-xs mt-2">Contoh : XIIA</p>
                                 
                                 
                                    
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kapasitas" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Kapasitas') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                                        value="{{ old('kapasitas', $kelas->kapasitas) }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required
                                         maxlength="2">
                                        <p class="text-muted text-xs mt-2">Contoh : 2</p>
                                 
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Status') }}
                                    </label>
                                    <div class="@error('status') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" disabled {{ old('status', $kelas->status ?? '') == '' ? 'selected' : '' }}>Pilih Status</option>
                                            <option value="Aktif" {{ old('status', $kelas->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Tidak Aktif" {{ old('status', $kelas->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                   
                                    </div>
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
                                        value="{{ old('ket', $kelas->ket) }}" required
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');" maxlength="50">
                                  
                                   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahunakademik_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                    </label>
                                    <div>
                                        <select name="tahunakademik_id" id="tahunakademik_id" class="form-select">
                                            <option value="" selected disabled>Pilih Tahun</option>
                                            @foreach ($tahuns as $tahun)
                                            <option value="{{ $tahun->id }}" {{ $kelas->kurikulum_id == $tahun->id ? 'selected' : '' }}>
                                                {{ $tahun->id }} - {{ $tahun->tahunakademik }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('tahunakademik_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu</p>
                                        
                                   
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                       
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 me-2">
                                {{ __('Update') }}
                            </button> 
                            <a href="{{ route('Kelas.index') }}" class="btn btn-secondary mt-4 mb-4">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                        
                        {{-- <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                                {{ __('Update') }}
                            </button> 
                            <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary mt-4 mb-4">
                                {{ __('Cancel') }}
                            </a>
                        </div> --}}
                        
                        {{-- <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update' }}</button>
                            <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">Cancel

                            </a>

                        </div> --}}
        </form>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Keterangan</strong> <br>
            </span>
            <span class="text-white">-
                <strong> Jika sudah ada Wali kelas dan kelas yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br>
               
                    <br>

            </span>
        </div>
    </div>
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
