{{-- create
@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Pengaturan Kelas')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat  Pengaturan Kelas') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" id="create-user-form" action="{{ route('Kelassiswa.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunakademik_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                        </label>
                                        <div class="@error('tahunakademik_id')border border-danger rounded-3 @enderror">
                                            <select name="tahunakademik_id" id="tahunakademik_id" class="form-select">
                                                <option value="" selected disabled>Pilih Tahun</option>
                                                @foreach ($tahuns as $tahun)
                                                    <option value="{{ $tahun->id }}">{{ $tahun->tahunakademik }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Kelas') }}
                                        </label>
                                        <div class="@error('kelas_id')border border-danger rounded-3 @enderror">
                                            <select name="kelas_id" id="kelas_id" class="form-select">
                                                <option value="" selected disabled>Pilih Kelas</option>
                                                @foreach ($kelass as $kelas)
                                                    <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>

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
                                        
                                        <div class="@error('ket')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($ket ?? '') }}"
                                            type="text"
                                                id="ket" name="ket" aria-describedby="info-ket"
                                                 required>
                                                @error('ket')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                       
        
        
                                        </div>
                                    </div>
                                </div>
                                disini
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                    <table id="siswaTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Lengkap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siswas as $siswa)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="siswa_id[]" value="{{ $siswa->siswa_id }}">
                                                </td>
                                                <td>{{ $siswa->NamaLengkap }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="datamengajar_id" class="form-label">Pilih Data Mengajar</label>
                                    <table id="mengajarTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Guru</th>
                                                <th>Hari</th>
                                                <th>Mata pelajaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datamengajars as $datamengajar)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="datamengajar_id[]" value="{{ $datamengajar->id }}">
                                                </td>
                                                <td>{{ $datamengajar->Guru->Nama }}</td>
                                                <td>{{ $datamengajar->hari }}</td>
                                                <td>{{ $datamengajar->Matapelajaran->matapelajaran }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Pengaturan Kelas') }}
                                    </button>

                                    <a href="{{ route('Kelassiswa.index') }}" class="btn btn-secondary">
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
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Tahun Akademik?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Gas!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('create-user-form').submit();
                                    }
                                });
                            });
                        </script>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        
                        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#siswaTable').DataTable();
                                $('#mengajarTable').DataTable();
                                
                            });


                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

edit
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

                            <div class="mb-3">
                                <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                <table id="siswaTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Nama Lengkap</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswas as $siswa)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="siswa_id[]" value="{{ $siswa->siswa_id }}"
                                {{ in_array($siswa->siswa_id, $selectedSiswa) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $siswa->NamaLengkap }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <pre>{{ print_r($selectedSiswa) }}</pre>
<pre>{{ print_r($selectedMengajar) }}</pre>

                    
                            <div class="mb-3">
                                
                                <label for="datamengajar_id" class="form-label">Pilih Data Mengajar</label>
                                <table id="mengajarTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Guru</th>
                                            <th>Hari</th>
                                            <th>Mata pelajaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datamengajars as $datamengajar)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="datamengajar_id[]" value="{{ $datamengajar->id }}"
                                                {{ in_array($datamengajar->id, $selectedMengajar) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $datamengajar->Guru->Nama }}</td>
                                            <td>{{ $datamengajar->hari }}</td>
                                            <td>{{ $datamengajar->Matapelajaran->matapelajaran }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                    
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#siswaTable').DataTable();
                            $('#mengajarTable').DataTable();
                            
                        });


                    </script>
@endsection --}}
