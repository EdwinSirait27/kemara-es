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
                        <form action={{ route('Dataguru.update', $hashedId) }} method="POST" role="form text-left"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($guru->foto)
    <img src="{{ $guru->foto ? asset('storage/fotoguru/' . $guru->foto) : '' }}" 
         alt="Foto Guru" width="100" height="100"
         class="w-100 border-radius-lg shadow-sm" id="imagePopup">
@endif
<a href="javascript:;"
   class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
   id="uploadBtn">
    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
       title="Upload Gambar"></i>
</a>
<input type="file" id="foto" name="foto" style="display: none;"
       class="form-control" accept="image/*">

                            {{-- // @if ($guru->foto) --}}
                            
                            {{-- // <img src="{{ $guru->foto ? asset('storage/fotoguru/'. $guru->foto" alt="Foto Guru" width="100" height="100"
                            // alt="Foto Guru" class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                            // @endif
                            // <a href="javascript:;"
                            //     class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                            //     id="uploadBtn">
                            //     <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                            //         title="Upload Gambar"></i>
                            // </a>
                            // <input type="file"  value="{{ $guru->foto }}"id="foto" name="foto" style="display: none;"
                            //     class="form-control" accept="image/*"> --}}
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
                            $guruNama = $guru->Nama;
                            $gurutugas = $guru->TugasMengajar;
                        @endphp

                        <h5 class="mb-1">
                            {{ $guruNama ?? 'Tidak ada Nama' }}
                        </h5>

                        <p class="mb-0 font-weight-bold text-sm">
                            Tugas Mengajar :{{ $gurutugas ?? 'Tidak ada ' }}

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
                <h6 class="mb-0">{{ __('Update Guru') }}</h6>
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
                            <label for="Nama" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Nama Lengkap') }}
                            </label>
                            <div>
                                <input class="form-control" value="{{ $guru->Nama ?? ''}}"
                                    type="text" id="Nama" name="Nama" aria-describedby="info-Nama" required>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TempatLahir" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Tempat Lahir') }}
                            </label>
                            {{-- <label for="TempatLahir" class="form-control-label">{{ __('Tempat Lahir') }}</label> --}}
                            <div class="@error('TempatLahir')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->TempatLahir ?? '' }}" type="text"
                                    id="TempatLahir" name="TempatLahir" aria-describedby="info-TempatLahir"
                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"maxlength="30"
                                    required>
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
                            <label for="TanggalLahir" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Tanggal Lahir') }}</label>
                            {{-- <label for="TanggalLahir" class="form-control-label">{{ __('Tanggal Lahir') }}</label> --}}
                            <div class="@error('TanggalLahir') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->TanggalLahir }}"
                                    type="date" placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir"
                                    required>
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
                                    <option value="" disabled selected>{{ __('Pilih Agama') }}</option>
                                    @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ e($agama) }}"
                                            {{ $guru->Agama == $agama ? 'selected' : '' }}>
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
                            <label for="JenisKelamin" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Jenis Kelamin') }}</label>

                            {{-- <label for="JenisKelamin" class="form-control-label">{{ __('Jenis Kelamin') }}</label> --}}
                            <div class="@error('JenisKelamin') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="JenisKelamin" id="JenisKelamin" required>
                                    <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}</option>
                                    @foreach (['Laki-Laki', 'Perempuan'] as $jenis)
                                        <option value="{{ e($jenis) }}"
                                            {{ $guru->JenisKelamin == $jenis ? 'selected' : '' }}>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="StatusPegawai" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Status Pegawai') }}</label>

                            {{-- <label for="StatusPegawai" class="form-control-label">{{ __('Status Pegawai') }}</label> --}}
                            <div class="@error('StatusPegawai') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="StatusPegawai" id="StatusPegawai" required>
                                    <option value="" disabled selected>{{ __('Pilih Status Pegawai') }}</option>
                                    @foreach (['GT', 'PNS YDP', 'GTT', 'Honorer', 'PT', 'PTT'] as $pegawai)
                                        <option value="{{ e($pegawai) }}"
                                            {{ $guru->StatusPegawai == $pegawai ? 'selected' : '' }}>
                                            {{ e($pegawai) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('StatusPegawai')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                           

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NipNips" class="form-control-label">{{ __('NIP NIPS') }}</label>
                            <div class="@error('NipNips')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->NipNips ?? '' }}" type="text"
                                    id="NipNips" name="NipNips" aria-describedby="info-NipNips"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                @error('NipNips')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          
                            <label for="Nuptk" class="form-control-label">{{ __('NUPTK') }}</label>
                            <div class="@error('Nuptk')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Nuptk ?? '' }}" type="text"
                                    id="Nuptk" name="Nuptk" aria-describedby="info-Nuptk"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                @error('Nuptk')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Nik" class="form-control-label">{{ __('NIK') }}</label>
                            <div class="@error('Nik')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Nik ?? '' }}" type="text"
                                    id="Nik" name="Nik" aria-describedby="info-Nik"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                @error('Nik')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Npwp" class="form-control-label">{{ __('NPWP') }}</label>
                            <div class="@error('Npwp')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Npwp ?? '' }}" type="text"
                                    id="Npwp" name="Npwp" aria-describedby="info-Npwp"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                @error('Npwp')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorSertifikatPendidik"
                            class="form-control-label">{{ __('Nomor Sertifikat Pendidik') }}</label>
                        <div class="@error('NomorSertifikatPendidik')border border-danger rounded-3 @enderror">
                            <input class="form-control"
                                value="{{ $guru->NomorSertifikatPendidik ?? '' }}"
                                type="text" id="NomorSertifikatPendidik" name="NomorSertifikatPendidik"
                                aria-describedby="info-NomorSertifikatPendidik"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                            @error('NomorSertifikatPendidik')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunSertifikasi"
                                class="form-control-label">{{ __('Tahun Sertifikasi') }}</label>
                            <div class="@error('TahunSertifikasi') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->TahunSertifikasi }}"
                                    type="date" placeholder="TahunSertifikasi" id="TahunSertifikasi"
                                    name="TahunSertifikasi" required>
                                @error('TahunSertifikasi')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jadwalkenaikangaji" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Jadwal Kenaikan Gaji') }}</label>

                            <div class="@error('jadwalkenaikangaji') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->jadwalkenaikangaji }}"
                                    type="date" placeholder="jadwalkenaikangaji" id="jadwalkenaikangaji"
                                    name="jadwalkenaikangaji" required>
                                @error('jadwalkenaikangaji')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PendidikanAkhir"
                                class="form-control-label">{{ __('Pendidikan Akhir') }}</label>
                            <div class="@error('PendidikanAkhir')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->PendidikanAkhir ?? '' }}"
                                    type="text" id="PendidikanAkhir" name="PendidikanAkhir"
                                    aria-describedby="info-PendidikanAkhir" maxlength="30" required>
                                @error('PendidikanAkhir')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunTamat" class="form-control-label">{{ __('Tahun Tamat') }}</label>
                            <div class="@error('TahunTamat') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->TahunTamat }}"
                                    type="date" placeholder="TahunTamat" id="TahunTamat" name="TahunTamat"
                                    required>
                                @error('TahunTamat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Jurusan" class="form-control-label">{{ __('Jurusan') }}</label>
                            <div class="@error('Jurusan')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Jurusan ?? '' }}" type="text"
                                    id="Jurusan" name="Jurusan" aria-describedby="info-Jurusan" maxlength="30"
                                    required>
                                @error('Jurusan')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TugasMengajar" class="form-control-label">{{ __('Tugas Mengajar') }}</label>
                            <div class="@error('TugasMengajar')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->TugasMengajar ?? '' }}"
                                    type="text" id="TugasMengajar" name="TugasMengajar"
                                    aria-describedby="info-TugasMengajar" maxlength="50" required>
                                @error('TugasMengajar')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunPensiun" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Tahun Pensiun') }}</label>
                            <div class="@error('TahunPensiun') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->TahunPensiun }}"
                                    type="date" placeholder="TahunPensiun" id="TahunPensiun" name="TahunPensiun"
                                    required>
                                @error('TahunPensiun')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Pangkat" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Pangkat') }}</label>
                            <div class="@error('Pangkat')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Pangkat ?? '' }}" type="text"
                                    id="Pangkat" name="Pangkat" aria-describedby="info-Pangkat" maxlength="50"
                                    required>
                                @error('Pangkat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jadwalkenaikanpangkat" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Jadwal Kenaikan Pangkat') }}</label>

                            <div class="@error('jadwalkenaikanpangkat') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->jadwalkenaikanpangkat }}"
                                    type="date" placeholder="jadwalkenaikanpangkat" id="jadwalkenaikanpangkat"
                                    name="jadwalkenaikanpangkat" required>
                                @error('jadwalkenaikanpangkat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Jabatan" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Jabatan') }}</label>

                            <div class="@error('Jabatan')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Jabatan ?? '' }}" type="text"
                                    id="Jabatan" name="Jabatan" aria-describedby="info-Jabatan" maxlength="30"
                                    required>
                                @error('Jabatan')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NomorTelephone"
                                class="form-control-label">{{ __('Nomor Telephone') }}</label>
                            <div class="@error('NomorTelephone')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->NomorTelephone ?? ''}}"
                                    type="phone" id="NomorTelephone" name="NomorTelephone"
                                    aria-describedby="info-NomorTelephone" maxlength="13"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                @error('NomorTelephone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                            <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Alamat ?? '' }}" type="text"
                                    id="Alamat" name="Alamat" aria-describedby="info-Alamat" maxlength="50"
                                    required>
                                @error('Alamat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('Email')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $guru->Email ?? '' }}" type="email"
                                    id="Email" name="Email" aria-describedby="info-Email" maxlength="50"
                                    required>
                                @error('Email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                         
                            <label for="status" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Status') }}</label>

                            <div class="@error('status') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="status" id="status" required>
                                    <option value="" disabled selected>{{ __('Pilih status') }}</option>
                                    @foreach (['Aktif', 'Tidak Aktif'] as $status)
                                        <option value="{{ e($status) }}"
                                            {{ $guru->status == $status ? 'selected' : '' }}>
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

            <div class="alert alert-secondary mx-4" role="alert">
                <span class="text-white">
                    <strong>Keterangan</strong> <br>
                </span>
                <span class="text-white">-
                    <strong class="fa fa-lock"></strong>
                    <strong> Icon Data Tidak Dapat Dirubah</strong> <br>
                    <strong>- Upload file type JPEG</strong> <br>
                    <strong>- Upload Foto Ukuran Kurang Dari 512 KB.</strong> <br>

                </span>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
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
