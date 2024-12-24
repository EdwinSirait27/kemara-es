@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Kelas Siswa')

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
       

        <form action="{{ route('Kelassiswa.update', $hashedId) }}" method="POST">
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
                                    <label for="tahunakademik_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                    </label>
                                    <div>
                                        <select name="tahunakademik_id" id="tahunakademik_id" class="form-select">
                                            <option value="" selected disabled>Pilih Tahun Akademik</option>
                                            @foreach ($tahuns as $tahun)
                                            <option value="{{ $tahun->id }}" {{ $kelassiswa->tahunakademik_id == $tahun->id ? 'selected' : '' }}>
                                                Tahun Akademik {{ $tahun->tahunakademik }} Semester {{ $tahun->semester }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('tahunakademik_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu</p>
                                        
                                    {{-- <label for="tahunakademik_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                    </label>
                                    <div>
                                        <select name="tahunakademik_id" id="tahunakademik_id" class="form-select">
                                            <option value="" selected disabled>Pilih Tahun Akademik</option>
                                            @foreach ($tahuns as $tahun)
                                            <option value="{{ $tahun->id }}" {{ $kelassiswa->tahunakademik_id == $tahun->id ? 'selected' : '' }}>
                                                {{ $tahun->id }} - {{ $tahun->tahunakademik }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('tahunakademik_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu</p>
                                         --}}
                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Kelas') }}
                                    </label>
                                    <div>
                                        <select name="kelas_id" id="kelas_id" class="form-select">
                                            <option value="" selected disabled>Pilih Kelas</option>
                                            @foreach ($kelass as $kelas)
                                            <option value="{{ $kelas->id }}" {{ $kelassiswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                {{ $kelas->id }} - {{ $kelas->kelas }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('kelas_id')
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
                                    <label for="ket" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Keterangan') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="ket" name="ket"
                                        value="{{ old('ket', $kelassiswa->ket) }}" required
                                         maxlength="50">
                                    </div>
                                </div>
                            </div>

                          
                           

                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 me-2">
                                {{ __('Update') }}
                            </button> 
                            <a href="{{ route('Kelassiswa.index') }}" class="btn btn-secondary mt-4 mb-4">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    
        </form>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Keterangan</strong> <br>
            </span>
            <span class="text-white">-
                <strong> Jika sudah ada Tahun Akademik yang sama dengan nilai semester Ganjil dan Genap, maka tidak bisa menginputkan data kembali </strong> <br>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    
               
@endsection
{{-- //disini --}}
