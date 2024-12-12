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
                            <form action={{ route('user-profileAdmin.store') }} method="POST" role="form text-left"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                  
                                <img src="{{ auth()->check() && optional(auth()->user()->guru)->foto 
                                ? asset('storage/fotoguru/' . auth()->user()->guru->foto) 
                                : asset('storage/fotoguru/we.jpg') }}"
                                alt="Foto Guru" 
                                class="w-100 border-radius-lg shadow-sm" 
                                id="imagePopup">
                            
                                {{-- <img src="{{ asset('storage/' . str_replace('public/', '', auth()->user()->guru->foto)) }}" 
                                alt="Foto Guru" class="w-100 border-radius-lg shadow-sm" id="imagePopup"> --}}
                           
                           

                                <a href="javascript:;"
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                                    id="uploadBtn">
                                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Upload Gambar"></i>
                                </a>
                                <!-- Input file yang tersembunyi -->
                                {{-- <label for="foto">Foto</label> --}}
                                <input type="file" id="foto" name="foto" style="display: none;"
                                    class="form-control" accept="image/*">
                   
                                {{-- <img src="{{ asset('storage/fotoguru/' . (auth()->user()->guru->foto ?? 'we.jpg')) }}"
                                alt="Foto Guru" class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                            <a href="javascript:;"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                                id="uploadBtn">
                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Upload Gambar"></i>
                            </a>
                            <input type="file" id="foto" name="foto" style="display: none;"
                                class="form-control" accept="image/*"> --}}

                                {{-- <img src="{{ Storage::exists(Auth::user()->Guru->foto ?? '') ? Storage::url(Auth::user()->Guru->foto) : asset('we.jpg') }}"
                                    alt="Foto Guru" class="w-100 border-radius-lg shadow-sm" id="imagePopup">

                                <a href="javascript:;"
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                                    id="uploadBtn">
                                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Upload Gambar"></i>
                                </a>
                                <input type="file" id="foto" name="foto" style="display: none;"
                                    class="form-control" accept="image/*"> --}}
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
                                $GuruNama = optional(auth()->user()->Guru)->Nama;
                            @endphp

                            <h5 class="mb-1">
                                {{ $GuruNama ?? 'Tidak ada Nama' }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ __(' CEO / Co-Founder') }}
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
                    <h6 class="mb-0">{{ __('Detail Profile') }}</h6>
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
                                {{-- <label for="username" class="form-control-label " >{{ __('Username') }}</label> --}}
                                <label for="username" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Username') }}
                                </label>
                                
                                <div>
                                    <input class="form-control" value="{{ e(optional(auth()->user())->username ?? '') }}"
                                        type="text" id="username" name="username" readonly
                                        aria-describedby="info-username">
                                    {{-- <small id="info-username" class="text-muted">Username tidak dapat diubah.</small> --}}


                                    {{-- <label for="username" class="form-control-label">{{ __('Username') }}</label>
                                <div class="@error('username') border border-danger rounded-3 @enderror">
                                    <input 
                                        class="form-control" 
                                        value="{{ old('username', optional(auth()->user())->username ?? '') }}" 
                                        type="text" 
                                        placeholder="Masukkan username Anda" 
                                        id="username" 
                                        name="username" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                        maxlength="10" 
                                        required 
                                        aria-describedby="error-username">
                                    @error('username')
                                        <p id="error-username" class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror --}}



                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Nama" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Nama Lengkap') }}
                                </label>
                                <div>
                                    <input class="form-control" value="{{ e(optional(auth()->user())->Guru->Nama ?? '') }}"
                                        type="text" id="Nama" name="Nama" aria-describedby="info-Nama" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('Role') border border-danger rounded-3 @enderror">
                                    <select name="Role" id="Role" class="form-control" required>
                                        <option value="" disabled selected>Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ e($role) }}"
                                                {{ $user->hakakses === $role ? 'selected' : '' }}>
                                                {{ e($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Role')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @else
                                        <p class="text-muted text-xs mt-2">Pilih salah satu role yang tersedia.</p>
                                    @enderror
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
                                        value="{{ e(optional(auth()->user())->Guru->TempatLahir ?? '') }}" type="text"
                                        id="TempatLahir" name="TempatLahir" aria-describedby="info-TempatLahir"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"maxlength="30" readonly>
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
                                <label for="TanggalLahir" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Tanggal Lahir') }}</label>
                                {{-- <label for="TanggalLahir" class="form-control-label">{{ __('Tanggal Lahir') }}</label> --}}
                                <div class="@error('TanggalLahir') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('TanggalLahir', optional(auth()->user()->Guru)->TanggalLahir) }}"
                                        type="date" placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir"
                                        readonly>
                                    @error('TanggalLahir')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Agama" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Agama') }}</label>
                                
                                {{-- <label for="Agama" class="form-control-label">{{ __('Agama') }}</label> --}}
                                <div class="@error('Agama') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="Agama" id="Agama" readonly>
                                        <option value="" disabled selected>{{ __('Pilih Agama') }}</option>
                                        @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                            <option value="{{ e($agama) }}"
                                                {{ auth()->check() && optional(auth()->user()->Guru)->Agama == $agama ? 'selected' : '' }}>
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
                                <label for="JenisKelamin" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Jenis Kelamin') }}</label>

                                {{-- <label for="JenisKelamin" class="form-control-label">{{ __('Jenis Kelamin') }}</label> --}}
                                <div class="@error('JenisKelamin') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="JenisKelamin" id="JenisKelamin" readonly>
                                        <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}</option>
                                        @foreach (['Laki-Laki', 'Perempuan'] as $jenis)
                                            <option value="{{ e($jenis) }}"
                                                {{ auth()->check() && optional(auth()->user()->Guru)->JenisKelamin == $jenis ? 'selected' : '' }}>
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
                                <label for="StatusPegawai" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Status Pegawai') }}</label>

                                {{-- <label for="StatusPegawai" class="form-control-label">{{ __('Status Pegawai') }}</label> --}}
                                <div class="@error('StatusPegawai') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="StatusPegawai" id="StatusPegawai" readonly>
                                        <option value="" disabled selected>{{ __('Pilih Status Pegawai') }}</option>
                                        @foreach (['GT', 'PNS YDP','GTT','Honorer','PT','PTT'] as $pegawai)
                                            <option value="{{ e($pegawai) }}"
                                                {{ auth()->check() && optional(auth()->user()->Guru)->StatusPegawai == $pegawai ? 'selected' : '' }}>
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
                                        value="{{ e(optional(auth()->user())->Guru->NipNips ?? '') }}" type="text"
                                        id="NipNips" name="NipNips" aria-describedby="info-NipNips"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                        @error('NipNips')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                              
                                    {{-- <label for="NipNips" class="form-control-label">{{ __('NIP NIPS') }}</label>
                                <div class="@error('NipNips')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->NipNips)
                                        <input class="form-control" value="{{ auth()->user()->Guru->NipNips }}"
                                            type="text" placeholder="NipNips" id="NipNips" name="NipNips"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16"
                                            required>
                                        @error('NipNips')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="0" type="text" id="NipNips"
                                            name="NipNips"required>
                                    @endif --}}


                                    {{-- hanya angka oninput="this.value = this.value.replace(/[^0-9]/g, '');"  maxlength="16" --}}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Nuptk" class="form-control-label">{{ __('NUPTK') }}</label>
                                <div class="@error('Nuptk')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->Nuptk ?? '') }}" type="text"
                                        id="Nuptk" name="Nuptk" aria-describedby="info-Nuptk"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                        @error('Nuptk')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Nuptk" class="form-control-label">{{ __('NUPTK') }}</label>
                                <div class="@error('Nuptk')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Nuptk)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Nuptk }}"
                                            type="text" placeholder="Nuptk" id="Nuptk" name="Nuptk"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16"
                                            required>
                                        @error('Nuptk')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="0" type="text" id="Nuptk"
                                            name="Nuptk"required>
                                    @endif --}}




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
                                        value="{{ e(optional(auth()->user())->Guru->Nik ?? '') }}" type="text"
                                        id="Nik" name="Nik" aria-describedby="info-Nik"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                        @error('Nik')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Nik" class="form-control-label">{{ __('NIK') }}</label>
                                <div class="@error('Nik')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Nik)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Nik }}"
                                            type="text" placeholder="Nik" id="Nik" name="Nik"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16"
                                            required>
                                        @error('Nik')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="0" type="text" id="Nik"
                                            name="Nik"required>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Npwp" class="form-control-label">{{ __('NPWP') }}</label>
                                <div class="@error('Npwp')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->Npwp ?? '') }}" type="text"
                                        id="Npwp" name="Npwp" aria-describedby="info-Npwp"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                        @error('Npwp')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Npwp" class="form-control-label">{{ __('NPWP') }}</label>
                                <div class="@error('Npwp')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Npwp)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Npwp }}"
                                            type="text" placeholder="Npwp" id="Npwp"
                                            name="Npwp"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            maxlength="16" required>
                                        @error('Npwp')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="0" type="text" id="Npwp"
                                            name="Npwp"required>
                                    @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NomorSertifikatPendidik" class="form-control-label">{{ __('Nomor Sertifikat Pendidik') }}</label>
                                <div class="@error('NomorSertifikatPendidik')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->NomorSertifikatPendidik ?? '') }}" type="text"
                                        id="NomorSertifikatPendidik" name="NomorSertifikatPendidik" aria-describedby="info-NomorSertifikatPendidik"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                        @error('NomorSertifikatPendidik')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="NomorSertifikatPendidik"
                                    class="form-control-label">{{ __('Nomor Sertifikat Pendidik') }}</label>
                                <div class="@error('NomorSertifikatPendidik')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru)
                                        <input class="form-control"
                                            value="{{ auth()->user()->Guru->NomorSertifikatPendidik }}" type="text"
                                            placeholder="NomorSertifikatPendidik" id="NomorSertifikatPendidik"
                                            name="NomorSertifikatPendidik"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            maxlength="16" required>
                                        @error('NomorSertifikatPendidik')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="0" type="text"
                                            placeholder="NomorSertifikatPendidik" id="NomorSertifikatPendidik"
                                            name="NomorSertifikatPendidik"required>
                                    @endif --}}

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TahunSertifikasi" class="form-control-label">{{ __('Tahun Sertifikasi') }}</label>
                                <div class="@error('TahunSertifikasi') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('TahunSertifikasi', optional(auth()->user()->Guru)->TahunSertifikasi) }}"
                                        type="date" placeholder="TahunSertifikasi" id="TahunSertifikasi" name="TahunSertifikasi"
                                        required>
                                    @error('TahunSertifikasi')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="TahunSertifikasi"
                                    class="form-control-label">{{ __('Tahun Sertifikasi') }}</label>
                                <div class="@error('TahunSertifikasi')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->TahunSertifikasi)
                                        <input class="form-control" value="{{ auth()->user()->Guru->TahunSertifikasi }}"
                                            type="date" placeholder="Tahun Sertifikasi" id="TahunSertifikasi"
                                            name="TahunSertifikasi" required>
                                        @error('TahunSertifikasi')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" type="date" id="TahunSertifikasi"
                                            name="TahunSertifikasi" required>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <label for="jadwalkenaikangaji" class="form-control-label">{{ __('Jadwal Kenaikan Gaji') }}</label> --}}
                                <label for="jadwalkenaikangaji" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Jadwal Kenaikan Gaji') }}</label>

                                <div class="@error('jadwalkenaikangaji') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('jadwalkenaikangaji', optional(auth()->user()->Guru)->jadwalkenaikangaji) }}"
                                        type="date" placeholder="jadwalkenaikangaji" id="jadwalkenaikangaji" name="jadwalkenaikangaji"
                                        readonly>
                                    @error('jadwalkenaikangaji')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                               


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="PendidikanAkhir" class="form-control-label">{{ __('Pendidikan Akhir') }}</label>
                                <div class="@error('PendidikanAkhir')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->PendidikanAkhir ?? '') }}" type="text"
                                        id="PendidikanAkhir" name="PendidikanAkhir" aria-describedby="info-PendidikanAkhir"
                                        maxlength="30" required>
                                        @error('PendidikanAkhir')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="PendidikanAkhir"
                                    class="form-control-label">{{ __('Pendidikan Akhir') }}</label>
                                <div class="@error('PendidikanAkhir')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->PendidikanAkhir)
                                        <input class="form-control" value="{{ auth()->user()->Guru->PendidikanAkhir }}"
                                            type="text" placeholder="PendidikanAkhir" id="PendidikanAkhir"
                                            name="PendidikanAkhir"maxlength="50" required>
                                        @error('PendidikanAkhir')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="text"
                                            id="PendidikanAkhir" name="PendidikanAkhir"required>
                                    @endif --}}
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
                                        value="{{ old('TahunTamat', optional(auth()->user()->Guru)->TahunTamat) }}"
                                        type="date" placeholder="TahunTamat" id="TahunTamat" name="TahunTamat"
                                        required>
                                    @error('TahunTamat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="TahunTamat" class="form-control-label">{{ __('Tahun Tamat') }}</label>
                                <div class="@error('TahunTamat')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru)
                                        <input class="form-control" value="{{ auth()->user()->Guru->TahunTamat }}"
                                            type="date" placeholder="TahunTamat" id="TahunTamat" name="TahunTamat"
                                            required>
                                        @error('TahunTamat')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="date"
                                            placeholder="TahunTamat" id="TahunTamat" name="TahunTamat"required>
                                    @endif --}}



                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Jurusan" class="form-control-label">{{ __('Jurusan') }}</label>
                                <div class="@error('Jurusan')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->Jurusan ?? '') }}" type="text"
                                        id="Jurusan" name="Jurusan" aria-describedby="info-Jurusan"
                                        maxlength="30" required>
                                        @error('Jurusan')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Jurusan" class="form-control-label">{{ __('Jurusan') }}</label>
                                <div class="@error('Jurusan')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Jurusan)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Jurusan }}"
                                            type="text" placeholder="Jurusan" id="Jurusan" name="Jurusan"
                                            maxlength="50" required>
                                        @error('Jurusan')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="text" id="Jurusan"
                                            name="Jurusan"required>
                                    @endif --}}

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
                                        value="{{ e(optional(auth()->user())->Guru->TugasMengajar ?? '') }}" type="text"
                                        id="TugasMengajar" name="TugasMengajar" aria-describedby="info-TugasMengajar"
                                        maxlength="50" required>
                                        @error('TugasMengajar')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="TugasMengajar" class="form-control-label">{{ __('Tugas Mengajar') }}</label>
                                <div class="@error('TugasMengajar')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->TugasMengajar)
                                        <input class="form-control" value="{{ auth()->user()->Guru->TugasMengajar }}"
                                            type="text" placeholder="Tugas Mengajar" id="TugasMengajar"
                                            name="TugasMengajar" maxlength="50"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required>
                                        @error('TugasMengajar')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" type="text" id="TugasMengajar"
                                            value="tidak ada data" name="TugasMengajar"required>
                                    @endif --}}



                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TahunPensiun" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Tahun Pensiun') }}</label>

                                {{-- <label for="TahunPensiun" class="form-control-label">{{ __('Tahun Pensiun') }}</label> --}}
                                puki
                                <div class="@error('TahunPensiun') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('TahunPensiun', optional(auth()->user()->Guru)->TahunPensiun) }}"
                                        type="date" placeholder="TahunPensiun" id="TahunPensiun" name="TahunPensiun"
                                        required>
                                    @error('TahunPensiun')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="TahunPensiun" class="form-control-label">{{ __('Tahun Pensiun') }}</label>
                                <div class="@error('TahunPensiun')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru)
                                        <input class="form-control" value="{{ auth()->user()->Guru->TahunPensiun }}"
                                            type="date" placeholder="TahunPensiun" id="TahunPensiun"
                                            name="TahunPensiun" required>
                                        @error('TahunPensiun')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="date"
                                            placeholder="TahunPensiun" id="TahunPensiun" name="TahunPensiun" required>
                                    @endif --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Pangkat" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Pangkat') }}</label>

                                {{-- <label for="Pangkat" class="form-control-label">{{ __('Pangkat') }}</label> --}}
                                <div class="@error('Pangkat')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->Pangkat ?? '') }}" type="text"
                                        id="Pangkat" name="Pangkat" aria-describedby="info-Pangkat"
                                        maxlength="50" readonly>
                                        @error('Pangkat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Pangkat" class="form-control-label">{{ __('Pangkat') }}</label>
                                <div class="@error('Pangkat')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Pangkat)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Pangkat }}"
                                            type="text" placeholder="Pangkat" id="Pangkat" name="Pangkat"
                                            maxlength="50" required>
                                        @error('Pangkat')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" type="text" id="Pangkat"
                                            value="tidak ada data"name="Pangkat" required>
                                    @endif --}}


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jadwalkenaikanpangkat" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Jadwal Kenaikan Pangkat') }}</label>

                                {{-- <label for="jadwalkenaikanpangkat" class="form-control-label">{{ __('Jadwal Kenaikan Pangkat') }}</label> --}}
                                <div class="@error('jadwalkenaikanpangkat') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('jadwalkenaikanpangkat', optional(auth()->user()->Guru)->jadwalkenaikanpangkat) }}"
                                        type="date" placeholder="jadwalkenaikanpangkat" id="jadwalkenaikanpangkat" name="jadwalkenaikanpangkat"
                                        readonly>
                                    @error('jadwalkenaikanpangkat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="jadwalkenaikanpangkat"
                                    class="form-control-label">{{ __('Jadwal Kenaikan Pangkat') }}</label>
                                <div class="@error('jadwalkenaikanpangkat')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->jadwalkenaikanpangkat)
                                        <input class="form-control"
                                            value="{{ auth()->user()->Guru->jadwalkenaikanpangkat }}" type="date"
                                            placeholder="jadwalkenaikanpangkat" id="jadwalkenaikanpangkat"
                                            name="jadwalkenaikanpangkat" required>
                                        @error('jadwalkenaikanpangkat')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="date"
                                            id="jadwalkenaikanpangkat" name="jadwalkenaikanpangkat" required>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Jabatan" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Jabatan') }}</label>

                                {{-- <label for="Jabatan" class="form-control-label">{{ __('Jabatan') }}</label> --}}
                                <div class="@error('Jabatan')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->Jabatan ?? '') }}" type="text"
                                        id="Jabatan" name="Jabatan" aria-describedby="info-Jabatan"
                                        maxlength="30" readonly>
                                        @error('Jabatan')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Jabatan" class="form-control-label">{{ __('Jabatan') }}</label>
                                <div class="@error('Jabatan')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Jabatan)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Jabatan }}"
                                            type="text" placeholder="Jabatan" id="Jabatan" name="Jabatan"
                                            maxlength="50" required>
                                        @error('Jabatan')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="text" id="Jabatan"
                                            name="Jabatan"required>
                                    @endif --}}


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NomorTelephone" class="form-control-label">{{ __('Nomor Telephone') }}</label>
                                <div class="@error('NomorTelephone')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->NomorTelephone ?? '') }}" type="phone"
                                        id="NomorTelephone" name="NomorTelephone" aria-describedby="info-NomorTelephone"
                                        maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        @error('NomorTelephone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="NomorTelephone"
                                    class="form-control-label">{{ __('Nomor Telephone') }}</label>
                                <div class="@error('NomorTelephone')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->NomorTelephone)
                                        <input class="form-control" value="{{ auth()->user()->Guru->NomorTelephone }}"
                                            type="phone" placeholder="NomorTelephone" id="NomorTelephone"
                                            name="NomorTelephone" maxlength="13"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        @error('NomorTelephone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" type="phone" id="NomorTelephone"
                                            value="0"name="NomorTelephone" required>
                                    @endif --}}

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
                                        value="{{ e(optional(auth()->user())->Guru->Alamat ?? '') }}" type="text"
                                        id="Alamat" name="Alamat" aria-describedby="info-Alamat"
                                        maxlength="50" required>
                                        @error('Alamat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                                <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Alamat)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Alamat }}"
                                            type="text" placeholder="Alamat" id="Alamat" name="Alamat"
                                            maxlength="50" required>
                                        @error('Alamat')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="text" id="Alamat"
                                            name="Alamat"required>
                                    @endif --}}


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('Email')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Guru->Email ?? '') }}" type="email"
                                        id="Email" name="Email" aria-describedby="info-Email"
                                        maxlength="50" required>
                                        @error('Email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="Email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('Email')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Email)
                                        <input class="form-control" value="{{ auth()->user()->Guru->Email }}"
                                            type="email" placeholder="Email" id="Email" name="Email"
                                            maxlength="50" required>
                                        @error('Email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" type="email" id="Email"
                                            value="tidak ada data"name="Email" required>
                                    @endif --}}


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="status" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Status') }}</label>
                            
                                {{-- <label for="status" class="form-control-label">{{ __('Status') }}</label> --}}
                                <div class="@error('status') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="status" id="status" readonly>
                                        <option value="" disabled selected>{{ __('Pilih status') }}</option>
                                        @foreach (['Aktif', 'Tidak Aktif'] as $status)
                                            <option value="{{ e($status) }}"
                                                {{ auth()->check() && optional(auth()->user()->Guru)->status == $status ? 'selected' : '' }}>
                                                {{ e($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                {{-- <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                <div class="@error('status') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        @if (auth()->check() && auth()->user()->Guru)
                                            <option value="Aktif"
                                                {{ auth()->user()->Guru->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="Tidak Aktif"
                                                {{ auth()->user()->Guru->status == 'Tidak Aktif' ? 'selected' : '' }}>
                                                Tidak Aktif</option>
                                        @else
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        @endif
                                    </select>
                                    @error('status')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_password" class="form-control-label">{{ __('Password Lama') }}</label>
<div class="@error('current_password') border border-danger rounded-3 @enderror position-relative">
    <input 
        class="form-control" 
        type="password" 
        placeholder="Password Lama"
        id="current_password" 
        name="current_password" 
        maxlength="8">
    <span 
        class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" 
        onclick="togglePasswordVisibility('current_password')">
        <i id="eye-icon-current_password" class="fas fa-eye"></i>
    </span>
    @error('current_password')
        <p class="text-danger text-xs mt-2">{{ $message }}</p>
    @enderror
    <script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(`eye-icon-${inputId}`);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password Baru') }}</label>
<div class="@error('password') border border-danger rounded-3 @enderror position-relative">
    <input 
        class="form-control" 
        type="password" 
        placeholder="Password Baru"
        id="password" 
        name="password" 
        maxlength="8">
    <span 
        class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" 
        onclick="togglePasswordVisibility('password')">
        <i id="eye-icon-password" class="fas fa-eye"></i>
    </span>
    @error('password')
        <p class="text-danger text-xs mt-2">{{ $message }}</p>
    @enderror
    <script>
        function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(`eye-icon-${inputId}`);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

    </script>

                                {{-- <label for="password" class="form-control-label">{{ __('Password Baru') }}</label>
                                <div class="@error('password')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="password" placeholder="Password Baru"
                                        id="password" name="password" maxlength="8">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">{{ __('Konfirmasi Password Baru') }}</label>
<div class="@error('password_confirmation') border border-danger rounded-3 @enderror position-relative">
    <input 
        class="form-control" 
        type="password" 
        placeholder="Konfirmasi Password Baru"
        id="password_confirmation" 
        name="password_confirmation" 
        maxlength="8">
    <span 
        class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" 
        onclick="togglePasswordVisibility('password_confirmation')">
        <i id="eye-icon-password_confirmation" class="fas fa-eye"></i>
    </span>
    @error('password_confirmation')
        <p class="text-danger text-xs mt-2">{{ $message }}</p>
    @enderror
<script>
    function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(`eye-icon-${inputId}`);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

</script>
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
                        <strong class="fa fa-lock"></strong>
                        <strong> Icon Data Tidak Dapat Dirubah</strong> <br>
                        <strong>- Upload Foto Ekstensi .JPEG</strong> <br>
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
