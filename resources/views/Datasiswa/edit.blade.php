@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Profile')

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
        <div class="page-header min-height-100 border-radius-xl mt-4"
            style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-8"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <form action={{ route('Datasiswa.update', $hashedId) }} method="POST" role="form text-left"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- @if ($siswa->foto)
                                <img src="{{ $siswa->foto ? asset('storage/fotosiswa/' . $siswa->foto) : '' }}"
                                    alt="Foto siswa" width="100" height="100"
                                    class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                            @endif
                            <a href="javascript:;"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                                id="uploadBtn">
                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Upload Gambar"></i>
                            </a>
                            <input type="file" id="foto" name="foto" style="display: none;"
                                class="form-control" accept="image/*"> --}}
                                @if (!empty($siswa->foto) && Storage::exists('fotosiswa/' . $siswa->foto))
                                <img src="{{ asset('storage/fotosiswa/' . $siswa->foto) }}" alt="Foto guru" width="100"
                                    height="100" class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                            @else
                                <img src="{{ asset('storage/fotosiswa/we.jpg') }}" alt="Foto default" width="100"
                                    height="100" class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                            @endif

                            <a href="javascript:;"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                                id="uploadBtn">
                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Upload Gambar"></i>
                            </a>
                            <input type="file" id="foto" name="foto" style="display: none;"
                                class="form-control" accept="image/*">
                    </div>
                </div>
                <script>
                    document.getElementById('uploadBtn').addEventListener('click', function() {
                        document.getElementById('foto').click();
                    });
                    document.getElementById('foto').addEventListener('change', function(event) {
                        var file = event.target.files[0];
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('imagePopup').src = e.target.result;
                            }
                            reader.readAsDataURL(file);
                        }
                    });
                </script>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        @php
                            $siswaNama = $siswa->NamaLengkap;
                            $siswatugas = $siswa->TugasMengajar;
                        @endphp

                        <h5 class="mb-1">
                            Nama Siswa : {{ $siswaNama ?? 'Tidak ada Nama' }}
                        </h5>

                        <p class="mb-0 font-weight-bold text-sm">
                            {{-- Tugas Mengajar :{{ $siswatugas ?? 'Tidak ada ' }} --}}

                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Update siswa') }}</h6>
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
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
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
                            <label for="NamaLengkap" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Lengkap') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NamaLengkap', $siswa->NamaLengkap ?? '') }}" type="text"
                                    id="NamaLengkap" name="NamaLengkap" aria-describedby="info-NamaLengkap" placeholder="NamaLengkap" required>
                                @error('NamaLengkap')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorInduk" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nomor Induk') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NomorInduk', $siswa->NomorInduk ?? '') }}" type="text"
                                    id="NomorInduk" name="NomorInduk" aria-describedby="info-NomorInduk" placeholder="NomorInduk" required>
                                @error('NomorInduk')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaPanggilan" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Panggilan') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NamaPanggilan', $siswa->NamaPanggilan ?? '') }}" type="text"
                                    id="NamaPanggilan" name="NamaPanggilan" aria-describedby="info-NamaPanggilan" required placeholder="NamaPanggilan">
                                @error('NamaPanggilan')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="JenisKelamin" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Jenis Kelamin') }}</label>
                            <div class="@error('JenisKelamin') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="JenisKelamin" id="JenisKelamin" required>
                                    <option value="" disabled {{ old('JenisKelamin', $siswa->JenisKelamin ?? '') == '' ? 'selected' : '' }}>
                                        {{ __('Pilih Jenis Kelamin') }}
                                    </option>
                                    @foreach (['Laki-Laki', 'Perempuan'] as $jenis)
                                        <option value="{{ e($jenis) }}" {{ old('JenisKelamin', $siswa->JenisKelamin ?? '') == $jenis ? 'selected' : '' }}>
                                            {{ e($jenis) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('JenisKelamin')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NISN" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('NISN') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NISN', $siswa->NISN ?? '') }}" type="text"
                                    id="NISN" name="NISN" aria-describedby="info-NISN" placeholder="NISN" required>
                                @error('NISN')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TempatLahir" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tempat Lahir') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('TempatLahir', $siswa->TempatLahir ?? '') }}" type="text"
                                    id="TempatLahir" name="TempatLahir" aria-describedby="info-TempatLahir" placeholder="Tempat Lahir" required>
                                @error('TempatLahir')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TanggalLahir" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tanggal Lahir') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('TanggalLahir', $siswa->TanggalLahir ?? '') }}" type="date"
                                    id="TanggalLahir" name="TanggalLahir" aria-describedby="info-TanggalLahir" placeholder="Tanggal Lahir" required>
                                @error('TanggalLahir')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Agama" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Agama') }}</label>
                            <div class="@error('Agama') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="Agama" id="Agama" required>
                                    <option value="" disabled {{ old('Agama', $siswa->Agama ?? '') == '' ? 'selected' : '' }}>
                                        {{ __('Pilih Agama') }}
                                    </option>
                                    @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ e($agama) }}" {{ old('Agama', $siswa->Agama ?? '') == $agama ? 'selected' : '' }}>
                                            {{ e($agama) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Agama')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Alamat" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Alamat') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('Alamat', $siswa->Alamat ?? '') }}" type="text"
                                    id="Alamat" name="Alamat" aria-describedby="info-Alamat" placeholder="Alamat" required>
                                @error('Alamat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="RT" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('RT') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('RT', $siswa->RT ?? '') }}" type="text"
                                    id="RT" name="RT" aria-describedby="info-RT" placeholder="RT" required>
                                @error('RT')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="RW" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('RW') }}
                            </label>
                            <input class="form-control" type="text" id="RW" name="RW" value="{{ $siswa->RW ?? '' }}" placeholder="RW" required>
                            @error('RW')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Kelurahan" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Kelurahan') }}
                            </label>
                            <input class="form-control" type="text" id="Kelurahan" name="Kelurahan" value="{{ $siswa->Kelurahan ?? '' }}" placeholder="Kelurahan" required>
                            @error('Kelurahan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Kecamatan" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Kecamatan') }}
                            </label>
                            <input class="form-control" type="text" id="Kecamatan" name="Kecamatan" value="{{ $siswa->Kecamatan ?? '' }}" placeholder="Kecamatan" required>
                            @error('Kecamatan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="KabKota" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Kab/Kota') }}
                            </label>
                            <input class="form-control" type="text" id="KabKota" name="KabKota" value="{{ $siswa->KabKota ?? '' }}" placeholder="Kabupaten Kota" required>
                            @error('KabKota')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Provinsi" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Provinsi') }}
                            </label>
                            <input class="form-control" type="text" id="Provinsi" name="Provinsi" value="{{ $siswa->Provinsi ?? '' }}" placeholder="Provinsi" required>
                            @error('Provinsi')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="KodePos" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Kode Pos') }}
                            </label>
                            <input class="form-control" type="text" id="KodePos" name="KodePos" value="{{ $siswa->KodePos ?? '' }}" placeholder="Kode Pos" required>
                            @error('KodePos')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Email') }}
                            </label>
                            <input class="form-control" type="email" id="Email" name="Email" value="{{ $siswa->Email ?? '' }}" placeholder="Email" required>
                            @error('Email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorTelephone" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nomor Telephone') }}
                            </label>
                            <input class="form-control" type="tel" id="NomorTelephone" name="NomorTelephone" value="{{ $siswa->NomorTelephone ?? '' }}" placeholder="Nomor Telephone" required>
                            @error('NomorTelephone')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Kewarganegaraan" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Kewarganegaraan') }}
                            </label>
                            <input class="form-control" value="{{ old('Kewarganegaraan', $siswa->Kewarganegaraan ?? '') }}"
                                type="text" id="Kewarganegaraan" name="Kewarganegaraan" placeholder="Kewarganegaraan" required>
                            @error('Kewarganegaraan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NIK" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('NIK') }}
                            </label>
                            <input class="form-control" value="{{ old('NIK', $siswa->NIK ?? '') }}" type="text"
                                id="NIK" name="NIK" placeholder="NIK" required>
                            @error('NIK')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="GolDarah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Gol Darah') }}
                            </label>
                            <select class="form-control @error('GolDarah') is-invalid @enderror" name="GolDarah" id="GolDarah" required>
                                <option value="" disabled>{{ __('Pilih') }}</option>
                                @foreach (['A+', 'A-', 'A', 'B+', 'B-', 'B', 'AB+', 'AB-', 'AB', 'O+', 'O-', 'O'] as $Gol)
                                    <option value="{{ $Gol }}" {{ old('GolDarah', $siswa->GolDarah ?? '') == $Gol ? 'selected' : '' }}>
                                        {{ $Gol }}
                                    </option>
                                @endforeach
                            </select>
                            @error('GolDarah')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TinggalDengan" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tinggal Dengan') }}
                            </label>
                            <input class="form-control" value="{{ old('TinggalDengan', $siswa->TinggalDengan ?? '') }}" type="text"
                                id="TinggalDengan" name="TinggalDengan" placeholder="Tinggal Dengan" required>
                            @error('TinggalDengan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="StatusSiswa" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Status Siswa') }}
                            </label>
                            <select class="form-control @error('StatusSiswa') is-invalid @enderror" name="StatusSiswa" id="StatusSiswa" required>
                                <option value="" disabled>{{ __('Pilih Status Siswa') }}</option>
                                @foreach (['Lengkap', 'Yatim', 'Piatu', 'Yatim Piatu'] as $status)
                                    <option value="{{ $status }}" {{ old('StatusSiswa', $siswa->StatusSiswa ?? '') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('StatusSiswa')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AnakKe" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Anak Ke') }}
                            </label>
                            <select class="form-control @error('AnakKe') is-invalid @enderror" name="AnakKe" id="AnakKe" required>
                                <option value="" disabled>{{ __('Pilih') }}</option>
                                @foreach (range(1, 5) as $anak)
                                    <option value="{{ $anak }}" {{ old('AnakKe', $siswa->AnakKe ?? '') == $anak ? 'selected' : '' }}>
                                        {{ $anak }}
                                    </option>
                                @endforeach
                            </select>
                            @error('AnakKe')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="SaudaraKandung" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Saudara Kandung') }}
                            </label>
                            <select class="form-control @error('SaudaraKandung') is-invalid @enderror" name="SaudaraKandung" id="SaudaraKandung" required>
                                <option value="" disabled>{{ __('Pilih') }}</option>
                                @foreach (range(1, 5) as $saudara)
                                    <option value="{{ $saudara }}" {{ old('SaudaraKandung', $siswa->SaudaraKandung ?? '') == $saudara ? 'selected' : '' }}>
                                        {{ $saudara }}
                                    </option>
                                @endforeach
                            </select>
                            @error('SaudaraKandung')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="SaudaraTiri" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Saudara Tiri') }}
                            </label>
                            <select class="form-control @error('SaudaraTiri') is-invalid @enderror" name="SaudaraTiri" id="SaudaraTiri" required>
                                <option value="" disabled>{{ __('Pilih') }}</option>
                                @foreach (range(1, 5) as $tiri)
                                    <option value="{{ $tiri }}" {{ old('SaudaraTiri', $siswa->SaudaraTiri ?? '') == $tiri ? 'selected' : '' }}>
                                        {{ $tiri }}
                                    </option>
                                @endforeach
                            </select>
                            @error('SaudaraTiri')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Tinggicm" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tinggi (cm)') }}
                            </label>
                            <input class="form-control" value="{{ old('Tinggicm', $siswa->Tinggicm ?? '') }}" type="text"
                                id="Tinggicm" name="Tinggicm" placeholder="Tinggi dalam cm" required>
                            @error('Tinggicm')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Beratkg" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Berat (kg)') }}
                            </label>
                            <input class="form-control" value="{{ old('Beratkg', $siswa->Beratkg ?? '') }}" type="text"
                                id="Beratkg" name="Beratkg" placeholder="Berat dalam kg" required>
                            @error('Beratkg')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="RiwayatPenyakit" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Riwayat Penyakit') }}
                            </label>
                            <input class="form-control" value="{{ old('RiwayatPenyakit', $siswa->RiwayatPenyakit ?? '') }}"
                                type="text" id="RiwayatPenyakit" name="RiwayatPenyakit" placeholder="Contoh: jantung, asma..." required>
                            @error('RiwayatPenyakit')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="AsalSD" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('Asal SMP') }}
            </label>
            <div>
                <input class="form-control" value="{{ old('AsalSD', $siswa->AsalSD ?? '') }}" placeholder="Asal SMP" type="text"
                    id="AsalSD" name="AsalSD" aria-describedby="info-AsalSD" required>
                @error('AsalSD')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="AlamatSD" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('Alamat SMP') }}
            </label>
            <div>
                <input class="form-control" value="{{ old('AlamatSD', $siswa->AlamatSD ?? '') }}" type="text"
                    id="AlamatSD" name="AlamatSD" aria-describedby="info-AlamatSD" placeholder="Alamat SMP" required>
                @error('AlamatSD')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="NPSNSD" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('NPSN SMP') }}
            </label>
            <div>
                <input class="form-control" value="{{ old('NPSNSD', $siswa->NPSNSD ?? '') }}" type="text"
                    id="NPSNSD" name="NPSNSD" placeholder="NPSN SMP" aria-describedby="info-NPSNSD" required>
                @error('NPSNSD')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="KabKotaSD" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('Kab/Kota SMP') }}
            </label>
            <div>
                <input class="form-control" value="{{ old('KabKotaSD', $siswa->KabKotaSD ?? '') }}" type="text"
                    id="KabKotaSD" name="KabKotaSD" aria-describedby="info-KabKotaSD" placeholder="Kabupaten/Kota SMP" required>
                @error('KabKotaSD')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ProvinsiSD" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('Provinsi SMP') }}
            </label>
            <div>
                <input class="form-control" value="{{ old('ProvinsiSD', $siswa->ProvinsiSD ?? '') }}" type="text"
                    id="ProvinsiSD" name="ProvinsiSD" aria-describedby="info-ProvinsiSD" placeholder="Provinsi SMP" required>
                @error('ProvinsiSD')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="NoIjasah" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('No Ijasah') }}
            </label>
            <div>
                <input class="form-control" placeholder="No Ijasah" value="{{ old('NoIjasah', $siswa->NoIjasah ?? '') }}" type="text"
                    id="NoIjasah" name="NoIjasah" aria-describedby="info-NoIjasah" required>
                @error('NoIjasah')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="DiterimaTanggal" class="form-control-label">
                <i class="fas fa-lock"></i> {{ __('Diterima Tanggal') }}
            </label>
            <div>
                <input class="form-control" value="{{ old('DiterimaTanggal', $siswa->DiterimaTanggal ?? '') }}"
                    type="date" id="DiterimaTanggal" name="DiterimaTanggal"
                    aria-describedby="info-DiterimaTanggal" placeholder="Diterima Tanggal" required>
                @error('DiterimaTanggal')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="DiterimaDiKelas" class="form-control-label"><i class="fas fa-lock"></i>
                {{ __('Diterima Di Kelas') }}</label>
            <div class="@error('DiterimaDiKelas') border border-danger rounded-3 @enderror">
                <select class="form-control" name="DiterimaDiKelas" id="DiterimaDiKelas" required>
                    <option value="" disabled {{ old('DiterimaDiKelas', $siswa->DiterimaDiKelas ?? '') == '' ? 'selected' : '' }}>
                        {{ __('Pilih') }}
                    </option>
                    @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $DiterimaDiKelas)

                        <option value="{{ e($DiterimaDiKelas) }}" {{ old('DiterimaDiKelas', $siswa->DiterimaDiKelas ?? '') == $DiterimaDiKelas ? 'selected' : '' }}>
                            {{ e($DiterimaDiKelas) }}
                        </option>
                    @endforeach
                </select>
                @error('DiterimaDiKelas')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label for="DiterimaDiKelas" class="form-control-label"><i class="fas fa-lock"></i>
                {{ __('Diterima Di Kelas') }}</label>
            <div class="@error('DiterimaDiKelas') border border-danger rounded-3 @enderror">
                <select class="form-control" name="DiterimaDiKelas" id="DiterimaDiKelas" required>
                    <option value="" disabled selected>{{ __('Pilih') }}</option>
                    @foreach (['X', 'XI', 'XII'] as $kelas)
                        <option value="{{ e($kelas) }}"
                            {{ $siswa->DiterimaDiKelas == $kelas ? 'selected' : '' }}>
                            {{ e($kelas) }}
                        </option>
                    @endforeach
                </select>
                @error('DiterimaDiKelas')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="DiterimaSemester" class="form-control-label"><i class="fas fa-lock"></i>
                {{ __('Diterima Semester') }}</label>
            <div class="@error('DiterimaSemester') border border-danger rounded-3 @enderror">
                <select class="form-control" name="DiterimaSemester" id="DiterimaSemester" required>
                    <option value="" disabled {{ old('DiterimaSemester', $siswa->DiterimaSemester ?? '') == '' ? 'selected' : '' }}>
                        {{ __('Pilih') }}
                    </option>
                    @foreach (['Ganjil', 'Genap'] as $DiterimaSemester)

                        <option value="{{ e($DiterimaSemester) }}" {{ old('DiterimaSemester', $siswa->DiterimaSemester ?? '') == $DiterimaSemester ? 'selected' : '' }}>
                            {{ e($DiterimaSemester) }}
                        </option>
                    @endforeach
                </select>
                @error('DiterimaSemester')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="MutasiAsalSD" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Mutasi Asal SMP') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('MutasiAsalSD', $siswa->MutasiAsalSD ?? '') }}"
                                    type="text" id="MutasiAsalSD" name="MutasiAsalSD" placeholder="Mutasi Asal SMP"
                                    aria-describedby="info-MutasiAsalSD">
                                    @error('MutasiAsalSD')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
<div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AlasanPindah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Alasan Pindah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('AlasanPindah', $siswa->AlasanPindah ?? '') }}" type="text"
                                    id="AlasanPindah"  placeholder="Alasan Pindah" name="AlasanPindah" aria-describedby="info-AlasanPindah"
                                    required>
                                    @error('AlasanPindah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TglIjasahSD" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tanggal Ijasah SMP') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('TglIjasahSD', $siswa->TglIjasahSD ?? '') }}" type="date"
                                    id="TglIjasahSD" name="TglIjasahSD" aria-describedby="info-TglIjasahSD" placeholder="Tgl Ijasah SMP " required>
                                    @error('TglIjasahSD')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>

                    
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaOrangTuaPadaIjasah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Orang Tua Pada Ijasah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NamaOrangTuaPadaIjasah', $siswa->NamaOrangTuaPadaIjasah ?? '') }}"
                                    type="text" id="NamaOrangTuaPadaIjasah" name="NamaOrangTuaPadaIjasah"
                                    aria-describedby="info-NamaOrangTuaPadaIjasah" placeholder="Nama Orang Tua Pada Ijasah" required>
                                    @error('NamaOrangTuaPadaIjasah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Ayah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NamaAyah', $siswa->NamaAyah ?? '') }}" type="text"
                                    id="NamaAyah" name="NamaAyah" placeholder="Nama Ayah" aria-describedby="info-NamaAyah" required>
                                    @error('NamaAyah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunLahirAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tahun Lahir Ayah') }}
                            </label>
                            <div>
                                <input class="form-control" placeholder="Tahun Lahir Ayah" value="{{ old('TahunLahirAyah', $siswa->TahunLahirAyah ?? '') }}"
                                    type="number" id="TahunLahirAyah" name="TahunLahirAyah"
                                    aria-describedby="info-TahunLahirAyah" required>
                                    @error('TahunLahirAyah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    </div>
                </div>
                {{-- darisini kurang error input sama placeholder --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AlamatAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Alamat Ayah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('AlamatAyah', $siswa->AlamatAyah ?? '') }}" type="text"
                                    id="AlamatAyah" name="AlamatAyah" placeholder="Alamat Ayah" aria-describedby="info-AlamatAyah" required>
                                    @error('AlamatAyah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorTelephoneAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nomor Telephone Ayah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NomorTelephoneAyah', $siswa->NomorTelephoneAyah ?? '') }}"
                                    type="number" placeholder="Nomor Telephone Ayah" id="NomorTelephoneAyah" name="NomorTelephoneAyah"
                                    aria-describedby="info-NomorTelephoneAyah" required>
                                    @error('NomorTelephoneAyah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="AgamaAyah" class="form-control-label"><i class="fas fa-lock"></i>
                            {{ __('Agama Ayah') }}</label>
                        <div class="@error('AgamaAyah') border border-danger rounded-3 @enderror">
                            <select class="form-control" name="AgamaAyah" id="AgamaAyah" required>
                                <option value="" disabled {{ old('AgamaAyah', $siswa->AgamaAyah ?? '') == '' ? 'selected' : '' }}>
                                    {{ __('Pilih Agama') }}
                                </option>
                                @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $AgamaAyah)
                                    <option value="{{ e($AgamaAyah) }}" {{ old('AgamaAyah', $siswa->AgamaAyah ?? '') == $AgamaAyah ? 'selected' : '' }}>
                                        {{ e($AgamaAyah) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('AgamaAyah')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PendidikanTerakhirAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Pendidikan Terakhir Ayah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('PendidikanTerakhirAyah', $siswa->PendidikanTerakhirAyah ?? '') }}"
                                    type="text" id="PendidikanTerakhirAyah" name="PendidikanTerakhirAyah"
                                    aria-describedby="info-PendidikanTerakhirAyah" placeholder="Pendidikan Terakhir Ayah" required>
                                    @error('PendidikanTerakhirAyah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PekerjaanAyah" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Pekerjaan Ayah') }}</label>

                            <div class="@error('PekerjaanAyah') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="PekerjaanAyah" id="PekerjaanAyah" required>
                                    <option value="" disabled selected>{{ __('Pilih') }}</option>
                                    @foreach (['PNS', 'TNI/POLRI', 'WIRASWASTA', 'BUMN','PEGAWAI SWASTA','PETANI/NELAYAN'] as $PekerjaanAyah)

                                        <option value="{{ e($PekerjaanAyah) }}"
                                            {{ $siswa->PekerjaanAyah == $PekerjaanAyah ? 'selected' : '' }}>
                                            {{ e($PekerjaanAyah) }}
                                        </option>
                                    @endforeach
                                </select>
                               
                            </div>
                        </div>
                        </div>
                    </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="PekerjaanAyah" class="form-control-label"><i class="fas fa-lock"></i>
                                    {{ __('Pekerjaan Ayah') }}</label>
                                <div class="@error('PekerjaanAyah') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="PekerjaanAyah" id="PekerjaanAyah" required>
                                        <option value="" disabled selected>{{ __('Pilih') }}</option>
                                        @foreach (['PNS', 'TNI/POLRI', 'WIRASWASTA', 'BUMN','PEGAWAI SWASTA','PETANI/NELAYAN'] as $PekerjaanAyah)
                                            <option value="{{ e($PekerjaanAyah) }}"
                                                {{ $siswa->PekerjaanAyah == $PekerjaanAyah ? 'selected' : '' }}>
                                                {{ e($PekerjaanAyah) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div> --}}
                        {{-- <div class="row">

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="PenghasilanAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Penghasilan Ayah') }}
                            </label>
                            <div>
                                <div class="@error('PenghasilanAyah') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="PenghasilanAyah" id="PenghasilanAyah" required>
                                        <option value="" disabled selected>{{ __('Pilih') }}</option>
                                        @foreach (['DIBAWAH 1 JT', '1 Jt s/d 2,5 Jt', '2,5 Jt s/d 4 Jt', 'DIATAS 4 Jt'] as $PenghasilanAyah)
                                            <option value="{{ e($PenghasilanAyah) }}"
                                                {{ $siswa->PenghasilanAyah == $PenghasilanAyah ? 'selected' : '' }}>
                                                {{ e($PenghasilanAyah) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('PenghasilanAyah')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PenghasilanAyah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Penghasilan Ayah') }}
                            </label>
                                <div class="@error('PenghasilanAyah') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="PenghasilanAyah" id="PenghasilanAyah" required>
                                        <option value="" disabled selected>{{ __('Pilih') }}</option>
                                        @foreach (['DIBAWAH 1 JT', '1 Jt s/d 2,5 Jt', '2,5 Jt s/d 4 Jt', 'DIATAS 4 Jt'] as $PenghasilanAyah)
                                            <option value="{{ e($PenghasilanAyah) }}"
                                                {{ $siswa->PenghasilanAyah == $PenghasilanAyah ? 'selected' : '' }}>
                                                {{ e($PenghasilanAyah) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('PenghasilanAyah')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaIbu" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Ibu') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NamaIbu', $siswa->NamaIbu ?? '') }}" type="text"
                                    id="NamaIbu" placeholder="NamaIbu" name="NamaIbu" aria-describedby="info-NamaIbu" required>
                                    @error('NamaIbu')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                             </div>
                         </div>
                    </div>
                    </div>
                    <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunLahirIbu" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tahun Lahir Ibu') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('TahunLahirIbu', $siswa->TahunLahirIbu ?? '') }}"
                                    type="number" id="TahunLahirIbu" name="TahunLahirIbu"
                                    aria-describedby="info-TahunLahirIbu" placeholder="Tahun Lahir Ibu" required>
                                    @error('TahunLahirIbu')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AlamatIbu" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Alamat Ibu') }}
                            </label>
                            <div>
                                <input class="form-control"  value="{{ old('AlamatIbu', $siswa->AlamatIbu ?? '') }}" type="text"
                                    id="AlamatIbu" placeholder="Alamat Ibu" name="AlamatIbu" aria-describedby="info-AlamatIbu" required>
                                    @error('AlamatIbu')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorTelephoneIbu" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nomor Telephone Ibu') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NomorTelephoneIbu', $siswa->NomorTelephoneIbu ?? '') }}"
                                    type="number" id="NomorTelephoneIbu" placeholder="Nomor Telephone Ibu" name="NomorTelephoneIbu"
                                    aria-describedby="info-NomorTelephoneIbu" required>
                                    @error('NomorTelephoneIbu')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="AgamaIbu" class="form-control-label"><i class="fas fa-lock"></i>
                            {{ __('Agama Ibu') }}</label>

                        <div class="@error('AgamaIbu') border border-danger rounded-3 @enderror">
                            <select class="form-control" name="AgamaIbu" id="AgamaIbu" required>
                                <option value="" disabled selected>{{ __('Pilih Agama') }}</option>
                                @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $AgamaIbu)
                                    <option value="{{ e($AgamaIbu) }}"
                                        {{ $siswa->AgamaIbu == $AgamaIbu ? 'selected' : '' }}>
                                        {{ e($AgamaIbu) }}
                                    </option>
                                @endforeach
                            </select>
                           
                        </div>
                    </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="PendidikanTerakhirIbu" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Pendidikan Terakhir Ibu') }}
                                </label>
                                <div>
                                    <input class="form-control" value="{{ old('PendidikanTerakhirIbu', $siswa->PendidikanTerakhirIbu ?? '') }}"
                                        type="text" placeholder="Pendidikan Terakhir Ibu" id="PendidikanTerakhirIbu" name="PendidikanTerakhirIbu"
                                        aria-describedby="info-PendidikanTerakhirIbu" required>
                                        @error('PendidikanTerakhirIbu')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="PekerjaanIbu" class="form-control-label"><i class="fas fa-lock"></i>
                                    {{ __('Pekerjaan Ibu') }}</label>
    
                                <div class="@error('PekerjaanIbu') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="PekerjaanIbu" id="PekerjaanIbu" required>
                                        <option value="" disabled selected>{{ __('Pilih') }}</option>
                                        @foreach (['PNS', 'TNI/POLRI', 'WIRASWASTA', 'BUMN','PEGAWAI SWASTA','PETANI/NELAYAN'] as $PekerjaanIbu)
    
                                            <option value="{{ e($PekerjaanIbu) }}"
                                                {{ $siswa->PekerjaanIbu == $PekerjaanIbu ? 'selected' : '' }}>
                                                {{ e($PekerjaanIbu) }}
                                            </option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                            </div>
                            </div>
                        </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="PekerjaanIbu" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Pekerjaan Ibu') }}
                            </label>
                                <div class="@error('PekerjaanIbu') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="PekerjaanIbu" id="PekerjaanIbu" required>
                                        <option value="" disabled selected>{{ __('Pilih') }}</option>
                                        @foreach (['PNS', 'TNI/POLRI', 'WIRASWASTA', 'BUMN','PEGAWAI SWASTA','PETANI/NELAYAN'] as $PekerjaanIbu)
                                            <option value="{{ e($PekerjaanIbu) }}"
                                                {{ $siswa->PekerjaanIbu == $PekerjaanIbu ? 'selected' : '' }}>
                                                {{ e($PekerjaanIbu) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('PekerjaanIbu')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PenghasilanIbu" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Penghasilan Ibu') }}
                            </label>
                                <div class="@error('PenghasilanIbu') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="PenghasilanIbu" id="PenghasilanIbu" required>
                                        <option value="" disabled selected>{{ __('Pilih') }}</option>
                                        @foreach (['DIBAWAH 1 JT', '1 Jt s/d 2,5 Jt', '2,5 Jt s/d 4 Jt', 'DIATAS 4 Jt'] as $PenghasilanIbu)
                                        
                                        <option value="{{ e($PenghasilanIbu) }}"
                                                {{ $siswa->PenghasilanIbu==$PenghasilanIbu ? 'selected' : '' }}>
                                                {{ e($PenghasilanIbu) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('PenghasilanIbu')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                        </div>
                    </div>
                </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Wali') }}
                            </label>
                                <input class="form-control" value="{{ $siswa->NamaWali ?? '' }}" type="text"
                                    id="NamaWali" name="NamaWali" aria-describedby="info-NamaWali" required>
                            </div>
                        </div>
                    </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Wali') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NamaWali', $siswa->NamaWali ?? '') }}" type="text"
                                    id="NamaWali" name="NamaWali" aria-describedby="info-NamaWali" placeholder="Nama Wali" required>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TahunLahirWali" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Tahun Lahir Wali') }}
                                </label>
                                <div>
                                    <input class="form-control" value="{{ old('TahunLahirWali', $siswa->TahunLahirWali ?? '') }}"
                                        type="number" id="TahunLahirWali" name="TahunLahirWali"
                                        aria-describedby="info-TahunLahirWali" placeholder="Tahun Lahir Wali" required>
                                        @error('TahunLahirWali')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AlamatWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Alamat Wali') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('AlamatWali', $siswa->AlamatWali ?? '') }}" type="text"
                                    id="AlamatWali" placeholder="Alamat Wali" name="AlamatWali" aria-describedby="info-AlamatWali" required>
                                    @error('AlamatWali')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorTelephoneWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nomor Telephone Wali') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('NomorTelephoneWali', $siswa->NomorTelephoneWali ?? '') }}" 
                                    type="phone" id="NomorTelephoneWali" placeholder="Nomor NomorTelephone Wali" name="NomorTelephoneWali"
                                    aria-describedby="info-NomorTelephoneWali" required>
                                    @error('NomorTelephoneWali')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AgamaWali" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Agama Wali') }}</label>
                            <div class="@error('AgamaWali') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="AgamaWali" id="AgamaWali" required>
                                    <option value="" disabled {{ old('AgamaWali', $siswa->AgamaWali ?? '') == '' ? 'selected' : '' }}>
                                        {{ __('Pilih Agama') }}
                                    </option>
                                    @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $AgamaWali)
                                        <option value="{{ e($AgamaWali) }}" {{ old('AgamaWali', $siswa->AgamaWali ?? '') == $AgamaWali ? 'selected' : '' }}>
                                            {{ e($AgamaWali) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('AgamaWali')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PendidikanTerakhirWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Pendidikan Terakhir Wali') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('PendidikanTerakhirWali', $siswa->PendidikanTerakhirWali ?? '') }}"
                                    type="text" id="PendidikanTerakhirWali" placeholder="Pendidikan Terakhir Wali" name="PendidikanTerakhirWali"
                                    aria-describedby="info-PendidikanTerakhirWali" required>
                                    @error('PendidikanTerakhirWali')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PekerjaanWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Pekerjaan Wali') }}
                            </label>
                            <div>
                                <select class="form-control" name="PekerjaanWali" id="PekerjaanWali" required>
                                    <option value="" disabled selected>{{ __('Pilih') }}</option>
                                    @foreach (['PNS', 'TNI/POLRI', 'WIRASWASTA', 'BUMN','PEGAWAI SWASTA','PETANI/NELAYAN'] as $PekerjaanWali)
                                        <option value="{{ e($PekerjaanWali) }}"
                                            {{ $siswa->PekerjaanWali == $PekerjaanWali ? 'selected' : '' }}>
                                            {{ e($PekerjaanWali) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('PekerjaanWali')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="WaliPenghasilan" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Penghasilan Wali') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('WaliPenghasilan', $siswa->WaliPenghasilan ?? '') }}"
                                    type="text" id="WaliPenghasilan" name="WaliPenghasilan"
                                    aria-describedby="info-WaliPenghasilan" placeholder="Penghasilan Wali" required>
                                    @error('WaliPenghasilan')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="StatusHubunganWali" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Status Hubungan Wali') }}
                            </label>
                            <div>
                                <select class="form-control" name="StatusHubunganWali" id="StatusHubunganWali" required>
                                    <option value="" disabled selected>{{ __('Pilih') }}</option>
                                    @foreach (['KAKEK/NENEK', 'SAUDARA KANDUNG', 'OM/TANTE/PAMAN/BIBI', 'KELUARGA LAINNYA'] as $StatusHubunganWali)
                                        <option value="{{ e($StatusHubunganWali) }}"
                                            {{ $siswa->StatusHubunganWali == $StatusHubunganWali ? 'selected' : '' }}>
                                            {{ e($StatusHubunganWali) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('StatusHubunganWali')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="MenerimaBeasiswaDari" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Menerima Beasiswa Dari') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('MenerimaBeasiswaDari', $siswa->MenerimaBeasiswaDari ?? '') }}"
                                    type="text" id="MenerimaBeasiswaDari" placeholder="Menerima Beasiswa Dari" name="MenerimaBeasiswaDari"
                                    aria-describedby="info-MenerimaBeasiswaDari">
                                    @error('MenerimaBeasiswaDari')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunMeninggalkanSekolah" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tahun Meninggalkan Sekolah') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('TahunMeninggalkanSekolah', $siswa->TahunMeninggalkanSekolah ?? '') }}"
                                    type="number" placeholder="Tahun Meningggalkan Sekolah" id="TahunMeninggalkanSekolah" name="TahunMeninggalkanSekolah"
                                    aria-describedby="info-TahunMeninggalkanSekolah">
                                    @error('TahunMeninggalkanSekolah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AlasanSebab" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Alasan Sebab') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('AlasanSebab', $siswa->AlasanSebab ?? '') }}" type="text"
                                    id="AlasanSebab" name="AlasanSebab" placeholder="Alasan atau sebab" aria-describedby="info-AlasanSebab">
                                    @error('AlasanSebab')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TamatBelajarTahun" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tamat Belajar Tahun') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('TamatBelajarTahun', $siswa->TamatBelajarTahun ?? '') }}"
                                    type="date" id="TamatBelajarTahun" placeholder="Tamat Belajar Tahun" name="TamatBelajarTahun"
                                    aria-describedby="info-TamatBelajarTahun">
                                    @error('TamatBelajarTahun')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InformasiLain" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Informasi Lain') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ old('InformasiLain', $siswa->InformasiLain ?? '') }}"
                                    type="text" id="InformasiLain" placeholder="Informasi lain" name="InformasiLain"
                                    aria-describedby="info-InformasiLain">
                                    @error('InformasiLain')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Status') }}</label>
                                <div>
                            <div class="@error('status') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="status" id="status" required>
                                    <option value="" disabled selected>{{ __('Pilih Status') }}</option>
                                    @foreach (['Aktif', 'Tidak Aktif', 'Lulus', 'Alumni'] as $status)
                                        <option value="{{ e($status) }}"
                                            {{ $siswa->status == $status ? 'selected' : '' }}>
                                            {{ e($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
                <div class="alert alert-secondary mx-4" role="alert">
                    <span class="text-white">
                        <strong>Keterangan</strong> <br>
                    </span>
                    <span class="text-white">-
                        <strong> Diisi - jika tidak tahu informasi siswa</strong> <br>
                        <strong>- Upload file type JPEG</strong> <br>
                        <strong>- Upload Foto Ukuran Kurang Dari 512 KB.</strong> <br>

                    </span>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit"
                        class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Profile Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="iframe-container">
                    <iframe id="imageIframe" src="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#imagePopup').click(function() {
            // Set src iframe dengan URL gambar
            $('#imageIframe').attr('src', $(this).attr('src'));
            // Tampilkan modal
            $('#imageModal').modal('show');
        });
    });
</script>
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
