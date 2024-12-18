@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Osis')

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

        <form action="{{ route('Osis.update', $hashedId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Edit Calon Ketua Osis') }}</h6>
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
                                    <label for="siswa_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Nama Siswa') }}
                                    </label>
                                    <div>
                                        <select name="siswa_id" id="siswa_id" class="form-select">
                                            <option value="" selected disabled>Pilih Siswa</option>
                                            @foreach ($siswas as $optionSiswa)
                                                <option value="{{ $optionSiswa->siswa_id }}" 
                                                    {{ old('siswa_id', $siswa->siswa_id ?? '') == $optionSiswa->siswa_id ? 'selected' : '' }}>
                                                    {{ $optionSiswa->NamaLengkap }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('siswa_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu</p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visi" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Visi') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="visi" name="visi"
                                        value="{{ old('visi', $siswa->visi) }}" required
                                         maxlength="255">
                                        <p class="text-muted text-xs mt-2">Contoh : blablabla</p>
                                 
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="misi" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Misi') }}
                                    </label>
                                    <div> 
                                          <input type="text" class="form-control" id="misi" name="misi"
                                        value="{{ old('misi', $siswa->misi) }}" required
                                         maxlength="255">
                                        <p class="text-muted text-xs mt-2">Contoh : blablabla</p>
                                    </div>
                                </div>
                            </div>
                         

{{-- @php
                                $oldRoles = old('hakakses', $hakakses); 
                            @endphp --}}
                          

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 me-2">
                                {{ __('Update') }}
                            </button> 
                            <a href="{{ route('Osis.index') }}" class="btn btn-secondary mt-4 mb-4">
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
                <strong> Jika sudah ada Calon Ketua Osis yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br>
               
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
