@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Tahun Akademik')

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
        

        <form action="{{ route('Tahunakademik.update', $hashedId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Edit Tahun Akademik') }}</h6>
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
                                    <label for="tahunakademik" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="tahunakademik"
                                        name="tahunakademik"
                                        value="{{ old('tahunakademik', $tahunakademik->tahunakademik) }}" required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="4">
                                        <p class="text-muted text-xs mt-2">Contoh : 2024</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="semester" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Semester') }}
                                    </label>
                                        <div class="@error('semester') border border-danger rounded-3 @enderror">
                                            <select class="form-control" name="semester" id="semester" required>
                                                <option value="" disabled
                                                    {{ old('semester', $tahunakademik->semester ?? '') == '' ? 'selected' : '' }}>
                                                    Pilih Semester</option>
                                                <option value="Ganjil"
                                                    {{ old('semester', $tahunakademik->semester ?? '') == 'Ganjil' ? 'selected' : '' }}>
                                                    Ganjil</option>
                                                <option value="Genap"
                                                    {{ old('semester', $tahunakademik->semester ?? '') == 'Genap' ? 'selected' : '' }}>
                                                    Genap</option>
                                            </select>
                                            @error('semester')
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
                                    <label for="tanggalmulai" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tanggal Mulai') }}
                                    </label>
                                    <div>
                                        <input type="date" class="form-control" id="tanggalmulai"
                                            name="tanggalmulai"
                                            value="{{ old('tanggalmulai', $tahunakademik->tanggalmulai) }}"
                                            required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggalakhir" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tanggal Akhir') }}
                                    </label>
                                        <input type="date" class="form-control" id="tanggalakhir"
                                            name="tanggalakhir"
                                            value="{{ old('tanggalakhir', $tahunakademik->tanggalakhir) }}"
                                            required>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Status') }}
                                    </label>
                                    <div class="@error('status') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" disabled {{ old('status', $tahunakademik->status ?? '') == '' ? 'selected' : '' }}>Pilih Status</option>
                                            <option value="Aktif" {{ old('status', $tahunakademik->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Tidak Aktif" {{ old('status', $tahunakademik->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ket" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Ketssserangan') }}
                                    </label>
                                        <input type="text" class="form-control" id="ket" name="ket"
                                            value="{{ old('ket', $tahunakademik->ket) }}" required
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');"
                                            maxlength="50">

                                    </div>
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
                            <a href="{{ route('Tahunakademik.index') }}" class="btn btn-secondary mt-4 mb-4">
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
