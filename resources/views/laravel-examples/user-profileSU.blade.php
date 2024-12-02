@extends('layouts.user_type.auth')
@section('content')
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
                style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-8"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <form action="/user-profileSU" method="POST" role="form text-left">
                                @csrf
                                <img src="../assets/img/bruce-mars.jpg" alt="..."
                                    class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                                <a href="javascript:;"
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"
                                    id="uploadBtn">
                                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Upload Gambar"></i>
                                </a>
                                <!-- Input file yang tersembunyi -->
                                <input type="file" id="fileInput" style="display: none;" accept="image/*">
                        </div>
                    </div>
                    <script>
                        document.getElementById('uploadBtn').addEventListener('click', function() {
                            // Trigger klik pada input file saat tombol diklik
                            document.getElementById('fileInput').click();
                        });

                        document.getElementById('fileInput').addEventListener('change', function(event) {
                            // Ambil file yang dipilih
                            var file = event.target.files[0];
                            if (file) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    // Ganti sumber gambar dengan file yang baru dipilih
                                    document.getElementById('imagePopup').src = e.target.result;
                                }
                                reader.readAsDataURL(file); // Baca file sebagai URL data
                            }
                        });
                    </script>
                    <div class="col-auto my-auto">
                        <div class="h-100">

                            @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Nama)
                                <h5 class="mb-1">
                                    {{ auth()->user()->guru->Nama }}
                                </h5>
                            @else
                                <h5 class="mb-1">
                                    Tidak ada Nama
                                </h5>
                            @endif




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
                            <span class="alert-text text-white">
                                {{ $errors->first() }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
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

                                <label for="username" class="form-control-label">
                                    <i class="fa fa-lock me-2"></i>{{ __('Username') }}
                                </label>

                                <div class="@error('username')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->username }}" type="text"
                                        placeholder="username" id="username" name="username"required>
                                    @error('username')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Nama" class="form-control-label">{{ __('Nama Lengkap') }}</label>
                                <div class="@error('Nama')border border-danger rounded-3 @enderror">

                                    @if (auth()->check() && auth()->user()->guru)
                                        <input class="form-control"
                                            value="{{ auth()->user()->guru->Nama ?? 'Tidak Ada Data' }}" type="text"
                                            placeholder="Nama" id="Nama" name="Nama"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"maxlength="50"
                                            required>
                                        @error('Nama')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="Tidak Ada Data" type="text" placeholder="Nama"
                                            id="Nama" name="Nama">
                                    @endif

                                    {{-- blok nomor koma oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('Role')border border-danger rounded-3 @enderror">
                                    <select name="Role" class="form-control" required>
                                        <option disabled selected>Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ auth()->user()->Role == $role ? 'selected' : '' }}>
                                                {{ ucfirst($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Role')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TempatLahir" class="form-control-label">{{ __('Tempat Lahir') }}</label>
                                <div class="@error('TempatLahir')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->TempatLahir)
                                        <input class="form-control" value="{{ auth()->user()->guru->TempatLahir }}"
                                            type="text" placeholder="TempatLahir" id="TempatLahir" name="TempatLahir"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"maxlength="50"
                                            required>
                                        @error('TempatLahir')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" value="tidak ada data" type="text"
                                            id="TempatLahir" name="TempatLahir">
                                    @endif



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TanggalLahir" class="form-control-label">{{ __('Tanggal Lahir') }}</label>
                                <div class="@error('TanggalLahir')border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->guru)
                                        <input class="form-control" value="{{ auth()->user()->guru->TanggalLahir }}"
                                            type="date" placeholder="TanggalLahir" id="TanggalLahir"
                                            name="TanggalLahir"required>
                                        @error('TanggalLahir')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input class="form-control" {{-- value="2000-12-27"  --}} type="date"
                                            id="TanggalLahir" name="TanggalLahir">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="Agama" class="form-control-label">{{ __('Agama') }}</label>
                                <div class="@error('Agama') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="Agama" id="Agama" required>
                                        <option value="" disabled selected>Pilih Agama</option>
                                    @if (auth()->check() && auth()->user()->guru)
                                            <option value="Islam"
                                                {{ auth()->user()->guru->Agama == 'Islam' ? 'selected' : '' }}>Islam
                                            </option>
                                            <option value="Kristen Protestan"
                                                {{ auth()->user()->guru->Agama == 'Kristen Protestan' ? 'selected' : '' }}>
                                                Kristen Protestan</option>
                                            <option value="Katolik"
                                                {{ auth()->user()->guru->Agama == 'Katolik' ? 'selected' : '' }}>Katolik
                                            </option>
                                            <option value="Hindu"
                                                {{ auth()->user()->guru->Agama == 'Hindu' ? 'selected' : '' }}>Hindu
                                            </option>
                                            <option value="Buddha"
                                                {{ auth()->user()->guru->Agama == 'Buddha' ? 'selected' : '' }}>Buddha
                                            </option>
                                            <option value="Konghucu"
                                                {{ auth()->user()->guru->Agama == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                            </option>
                                        @else
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                    @endif
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
                                    <label for="JenisKelamin" class="form-control-label">{{ __('Jenis Kelamin') }}</label>
                                    <div class="@error('JenisKelamin') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="JenisKelamin" id="JenisKelamin" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        @if (auth()->check() && auth()->user()->guru)
                                                <option value="Laki-Laki"
                                                    {{ auth()->user()->guru->JenisKelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ auth()->user()->guru->JenisKelamin == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                                
                                            @else
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                
                                        @endif
                                        </select>
                                        @error('JenisKelamin')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="StatusPegawai" class="form-control-label">{{ __('Status Pegawai') }}</label>
                                    <div class="@error('StatusPegawai') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="StatusPegawai" id="StatusPegawai" required>
                                            <option value="" disabled selected>Pilih Status Pegawai</option>
                                        @if (auth()->check() && auth()->user()->guru)
                                                <option value="GT"
                                                    {{ auth()->user()->guru->StatusPegawai == 'GT' ? 'selected' : '' }}>GT
                                                </option>
                                                <option value="PNS YDP"
                                                    {{ auth()->user()->guru->StatusPegawai == 'PNS YDP' ? 'selected' : '' }}>PNS YDP
                                                </option>
                                                <option value="GTT"
                                                    {{ auth()->user()->guru->StatusPegawai == 'GTT' ? 'selected' : '' }}>GTT
                                                </option>
                                                <option value="Honorer"
                                                    {{ auth()->user()->guru->StatusPegawai == 'Honorer' ? 'selected' : '' }}>Honorer
                                                </option>
                                                <option value="PT"
                                                {{ auth()->user()->guru->StatusPegawai == 'PT' ? 'selected' : '' }}>PT
                                            </option>
                                            <option value="PTT"
                                                {{ auth()->user()->guru->StatusPegawai == 'PTT' ? 'selected' : '' }}>PTT
                                            </option>
                                                
                                                
                                            @else
                                                <option value="GT">GT</option>
                                                <option value="PNS YDP">PNS YDP</option>
                                                <option value="GTT">GTT</option>
                                                <option value="Honorer">Honorer</option>
                                                <option value="PT">PT</option>
                                                <option value="PTT">PTT</option>
                                                >
                                                
                                        @endif
                                        </select>
                                        @error('StatusPegawai')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror


                                    {{-- <label for="StatusPegawai">{{ 'Status Pegawai' }}</label>
                                    <div class="@error('StatusPegawai')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru)
                                            <select class="form-control" name="StatusPegawai" id="StatusPegawai"
                                                required>
                                                <option value="" disabled selected>Pilih Status Pegawai</option>
                                                <option value="GT"
                                                    {{ auth()->user()->guru->StatusPegawai == 'GT' ? 'selected' : '' }}>GT
                                                </option>
                                                <option value="PNS YDP"
                                                    {{ auth()->user()->guru->StatusPegawai == 'PNS YDP' ? 'selected' : '' }}>
                                                    PNS YDP</option>
                                                <option value="GTT"
                                                    {{ auth()->user()->guru->StatusPegawai == 'GTT' ? 'selected' : '' }}>
                                                    GTT
                                                </option>
                                                <option value="Honorer"
                                                    {{ auth()->user()->guru->StatusPegawai == 'Honorer' ? 'selected' : '' }}>
                                                    Honorer</option>
                                                <option value="PT"
                                                    {{ auth()->user()->guru->StatusPegawai == 'PT' ? 'selected' : '' }}>PT
                                                </option>
                                                <option value="PTT"
                                                    {{ auth()->user()->guru->StatusPegawai == 'PTT' ? 'selected' : '' }}>
                                                    PTT
                                                </option>
                                              
                                            </select>
                                            @error('JenisKelamin')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @endif --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NipNips" class="form-control-label">{{ __('NIP NIPS') }}</label>
                                    <div class="@error('NipNips')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->NipNips)
                                            <input class="form-control" value="{{ auth()->user()->guru->NipNips }}"
                                                type="text" placeholder="NipNips" id="NipNips" name="NipNips"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16"
                                                required>
                                            @error('NipNips')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="0" type="text" id="NipNips"
                                                name="NipNips">
                                        @endif


                                        {{-- hanya angka oninput="this.value = this.value.replace(/[^0-9]/g, '');"  maxlength="16" --}}

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nuptk" class="form-control-label">{{ __('NUPTK') }}</label>
                                    <div class="@error('Nuptk')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Nuptk)
                                            <input class="form-control" value="{{ auth()->user()->guru->Nuptk }}"
                                                type="text" placeholder="Nuptk" id="Nuptk" name="Nuptk"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16"
                                                required>
                                            @error('Nuptk')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="0" type="text" id="Nuptk"
                                                name="Nuptk">
                                        @endif




                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nik" class="form-control-label">{{ __('NIK') }}</label>
                                    <div class="@error('Nik')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Nik)
                                            <input class="form-control" value="{{ auth()->user()->guru->Nik }}"
                                                type="text" placeholder="Nik" id="Nik" name="Nik"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16"
                                                required>
                                            @error('Nik')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="0" type="text" id="Nik"
                                                name="Nik">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Npwp" class="form-control-label">{{ __('NPWP') }}</label>
                                    <div class="@error('Npwp')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Npwp)
                                            <input class="form-control" value="{{ auth()->user()->guru->Npwp }}"
                                                type="text" placeholder="Npwp" id="Npwp"
                                                name="Npwp"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                maxlength="16" required>
                                            @error('Npwp')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="0" type="text" id="Npwp"
                                                name="Npwp">
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomorSertifikatPendidik"
                                        class="form-control-label">{{ __('Nomor Sertifikat Pendidik') }}</label>
                                    <div
                                        class="@error('NomorSertifikatPendidik')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru)
                                            <input class="form-control"
                                                value="{{ auth()->user()->guru->NomorSertifikatPendidik }}"
                                                type="text" placeholder="NomorSertifikatPendidik"
                                                id="NomorSertifikatPendidik"
                                                name="NomorSertifikatPendidik"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                maxlength="16" required>
                                            @error('NomorSertifikatPendidik')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="0" type="text"
                                                placeholder="NomorSertifikatPendidik" id="NomorSertifikatPendidik"
                                                name="NomorSertifikatPendidik">
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="TahunSertifikasi"
                                        class="form-control-label">{{ __('Tahun Sertifikasi') }}</label>
                                    <div class="@error('TahunSertifikasi')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->TahunSertifikasi)
                                            <input class="form-control"
                                                value="{{ auth()->user()->guru->TahunSertifikasi }}" type="date"
                                                placeholder="Tahun Sertifikasi" id="TahunSertifikasi"
                                                name="TahunSertifikasi" required>
                                            @error('TahunSertifikasi')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" type="date" id="TahunSertifikasi"
                                                name="TahunSertifikasi">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jadwalkenaikangaji"
                                        class="form-control-label">{{ __('Jadwal Kenaikan Gaji') }}</label>
                                    <div class="@error('jadwalkenaikangaji')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru)
                                            <input class="form-control"
                                                value="{{ auth()->user()->guru->jadwalkenaikangaji }}" type="date"
                                                placeholder="jadwalkenaikangaji" id="jadwalkenaikangaji"
                                                name="jadwalkenaikangaji" required>
                                            @error('jadwalkenaikangaji')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="date"
                                                placeholder="jadwalkenaikangaji" id="jadwalkenaikangaji"
                                                name="jadwalkenaikangaji">
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="PendidikanAkhir"
                                        class="form-control-label">{{ __('Pendidikan Akhir') }}</label>
                                    <div class="@error('PendidikanAkhir')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->PendidikanAkhir)
                                            <input class="form-control"
                                                value="{{ auth()->user()->guru->PendidikanAkhir }}" type="text"
                                                placeholder="PendidikanAkhir" id="PendidikanAkhir"
                                                name="PendidikanAkhir"maxlength="50" required>
                                            @error('PendidikanAkhir')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="text"
                                                id="PendidikanAkhir" name="PendidikanAkhir">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TahunTamat" class="form-control-label">{{ __('Tahun Tamat') }}</label>
                                    <div class="@error('TahunTamat')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru)
                                            <input class="form-control" value="{{ auth()->user()->guru->TahunTamat }}"
                                                type="date" placeholder="TahunTamat" id="TahunTamat"
                                                name="TahunTamat" required>
                                            @error('TahunTamat')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="date"
                                                placeholder="TahunTamat" id="TahunTamat" name="TahunTamat">
                                        @endif



                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Jurusan" class="form-control-label">{{ __('Jurusan') }}</label>
                                    <div class="@error('Jurusan')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Jurusan)
                                            <input class="form-control" value="{{ auth()->user()->guru->Jurusan }}"
                                                type="text" placeholder="Jurusan" id="Jurusan" name="Jurusan"
                                                maxlength="50" required>
                                            @error('Jurusan')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="text"
                                                id="Jurusan" name="Jurusan">
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TugasMengajar"
                                        class="form-control-label">{{ __('Tugas Mengajar') }}</label>
                                    <div class="@error('TugasMengajar')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->TugasMengajar)
                                            <input class="form-control" value="{{ auth()->user()->guru->TugasMengajar }}"
                                                type="text" placeholder="Tugas Mengajar" id="TugasMengajar"
                                                name="TugasMengajar" maxlength="50"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required>
                                            @error('TugasMengajar')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" type="text" id="TugasMengajar"
                                                value="tidak ada data" name="TugasMengajar">
                                        @endif



                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TahunPensiun"
                                        class="form-control-label">{{ __('Tahun Pensiun') }}</label>
                                    <div class="@error('TahunPensiun')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru)
                                            <input class="form-control" value="{{ auth()->user()->guru->TahunPensiun }}"
                                                type="date" placeholder="TahunPensiun" id="TahunPensiun"
                                                name="TahunPensiun" required>
                                            @error('TahunPensiun')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="date"
                                                placeholder="TahunPensiun" id="TahunPensiun" name="TahunPensiun">
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Pangkat" class="form-control-label">{{ __('Pangkat') }}</label>
                                    <div class="@error('Pangkat')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Pangkat)
                                            <input class="form-control" value="{{ auth()->user()->guru->Pangkat }}"
                                                type="text" placeholder="Pangkat" id="Pangkat" name="Pangkat"
                                                maxlength="50" required>
                                            @error('Pangkat')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" type="text" id="Pangkat"
                                                value="tidak ada data"name="Pangkat">
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jadwalkenaikanpangkat"
                                        class="form-control-label">{{ __('Jadwal Kenaikan Pangkat') }}</label>
                                    <div class="@error('jadwalkenaikanpangkat')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->jadwalkenaikanpangkat)
                                            <input class="form-control"
                                                value="{{ auth()->user()->guru->jadwalkenaikanpangkat }}" type="date"
                                                placeholder="jadwalkenaikanpangkat" id="jadwalkenaikanpangkat"
                                                name="jadwalkenaikanpangkat" required>
                                            @error('jadwalkenaikanpangkat')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="date"
                                                id="jadwalkenaikanpangkat" name="jadwalkenaikanpangkat">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Jabatan" class="form-control-label">{{ __('Jabatan') }}</label>
                                    <div class="@error('Jabatan')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Jabatan)
                                            <input class="form-control" value="{{ auth()->user()->guru->Jabatan }}"
                                                type="text" placeholder="Jabatan" id="Jabatan" name="Jabatan"
                                                maxlength="50" required>
                                            @error('Jabatan')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="text"
                                                id="Jabatan" name="Jabatan">
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomorTelephone"
                                        class="form-control-label">{{ __('Nomor Telephone') }}</label>
                                    <div class="@error('NomorTelephone')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->NomorTelephone)
                                            <input class="form-control"
                                                value="{{ auth()->user()->guru->NomorTelephone }}" type="phone"
                                                placeholder="NomorTelephone" id="NomorTelephone" name="NomorTelephone"
                                                maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                required>
                                            @error('NomorTelephone')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" type="phone" id="NomorTelephone"
                                                value="0"name="NomorTelephone">
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                                    <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Alamat)
                                            <input class="form-control" value="{{ auth()->user()->guru->Alamat }}"
                                                type="text" placeholder="Alamat" id="Alamat" name="Alamat"
                                                maxlength="50" required>
                                            @error('Alamat')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" value="tidak ada data" type="text"
                                                id="Alamat" name="Alamat">
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email" class="form-control-label">{{ __('Email') }}</label>
                                    <div class="@error('Email')border border-danger rounded-3 @enderror">
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Email)
                                            <input class="form-control" value="{{ auth()->user()->guru->Email }}"
                                                type="email" placeholder="Email" id="Email" name="Email"
                                                maxlength="50" required>
                                            @error('Email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input class="form-control" type="email" id="Email"
                                                value="tidak ada data"name="Email">
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                    <div class="@error('status') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" disabled selected>Pilih Status</option>
                                            @if (auth()->check() && auth()->user()->guru)
                                                <option value="Aktif"
                                                    {{ auth()->user()->guru->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="Tidak Aktif"
                                                    {{ auth()->user()->guru->status == 'Tidak Aktif' ? 'selected' : '' }}>
                                                    Tidak Aktif</option>
                                            @else
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            @endif
                                        </select>
                                        @error('status')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>




                                </div>
                            </div>
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
