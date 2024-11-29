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
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <form action="/user-profile" method="POST" role="form text-left">
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


                            {{-- @if (auth()->check() && auth()->user()->guru)
                                <h5 class="mb-1">
                                    {{ auth()->user()->guru->Nama ?? 'tidak ada' }}
                                </h5>
                            @else
                                <h5 class="mb-1">
                                    Tidak ada Nama
                                </h5>
                            @endif --}}
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

                            {{-- <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                    role="tab" aria-controls="overview" aria-selected="true">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2319.000000, -291.000000)"
                                                fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity"
                                                    transform="translate(1716.000000, 291.000000)">
                                                    <g id="box-3d-50" transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z" id="Path"></path>
                                                        <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" id="Path" opacity="0.7"></path>
                                                        <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" id="Path" opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="ms-1">{{ __('Overview') }}</span>
                                </a>
                            </li>
                           
                        </ul> --}}
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
                                        placeholder="username" id="username" name="username">
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
                                 
                                        @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Nama)
                                        <input class="form-control" value="{{ auth()->user()->guru->Nama }}" type="text"
                                            placeholder="Nama" id="Nama" name="Nama"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
                                    @else
                                        <input class="form-control" value="tidak ada data" type="text" placeholder="Nama"
                                            id="Nama" name="Nama">
                                    @endif

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
                                    @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Nama)

                                        <input class="form-control" value="{{ auth()->user()->guru->TempatLahir }}"
                                            type="TempatLahir" placeholder="TempatLahir" id="TempatLahir"
                                            name="TempatLahir">
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
                                        name="TanggalLahir">
                                    @error('TanggalLahir')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                @else
                                    <input class="form-control" value="tidak ada data" type="text"
                                        placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Agama" class="form-control-label">{{ __('Agama') }}</label>
                                <div class="@error('Agama') border border-danger rounded-3 @enderror">
                                    @if (auth()->check() && auth()->user()->guru)
                                    <select class="form-control" name="Agama" id="Agama" required>
                                        <option value="" disabled selected>Pilih Agama</option>
                                        <option value="Islam" {{ auth()->user()->guru->Agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen Protestan" {{ auth()->user()->guru->Agama == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                        <option value="Katolik" {{ auth()->user()->guru->Agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ auth()->user()->guru->Agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ auth()->user()->guru->Agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ auth()->user()->guru->Agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                    @error('Agama')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                @else
                                    <input class="form-control" value="tidak ada data" type="text" placeholder="Agama" id="Agama" name="Agama">
                                @endif
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">

                    <div class="form-group">
                        <label for="JenisKelamin">{{ 'Jenis Kelamin' }}</label>
                        <div class="@error('JenisKelamin')border border-danger rounded-3 @enderror">
                            @if (auth()->check() && auth()->user()->guru)
                            <select class="form-control" name="JenisKelamin" id="JenisKelamin" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Laki-Laki" {{ auth()->user()->guru->JenisKelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ auth()->user()->guru->JenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                               
                            </select>
                            @error('JenisKelamin')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        @else
                            <input class="form-control" value="tidak ada data" type="text" placeholder="Agama" id="Agama" name="Agama">
                        @endif
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="StatusPegawai" class="form-control-label">{{ __('StatusPegawai') }}</label>
                            <div class="@error('StatusPegawai')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Nama)

                                    <input class="form-control" value="{{ auth()->user()->guru->StatusPegawai }}"
                                        type="StatusPegawai" placeholder="Status Pegawai" id="StatusPegawai" 
                                        name="StatusPegawai">
                                    @error('StatusPegawai')
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
                            <label for="NipNips" class="form-control-label">{{ __('NIPNIPS') }}</label>
                            <div class="@error('NipNips')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->NipNips }}"
                                    type="date" placeholder="NipNips" id="NipNips"
                                    name="NipNips">
                                @error('NipNips')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Nuptk" class="form-control-label">{{ __('NUPTK') }}</label>
                            <div class="@error('NipNips')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->NipNips)

                                    <input class="form-control" value="{{ auth()->user()->guru->NipNips }}"
                                        type="NipNips" placeholder="NipNips" id="NipNips"
                                        name="NipNips">
                                    @error('NipNips')
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
                            <label for="Nik" class="form-control-label">{{ __('NIK') }}</label>
                            <div class="@error('Nik')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->Nik }}"
                                    type="text" placeholder="NIK" id="Nik"
                                    name="Nik">
                                @error('Nik')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Npwp" class="form-control-label">{{ __('NPWP') }}</label>
                            <div class="@error('NipNips')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Npwp)

                                    <input class="form-control" value="{{ auth()->user()->guru->Npwp }}"
                                        type="Npwp" placeholder="Npwp" id="Npwp"
                                        name="Npwp">
                                    @error('Npwp')
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
                            <label for="NomorSertifikatPendidik" class="form-control-label">{{ __('Nomor Sertifikat Pendidik') }}</label>
                            <div class="@error('NomorSertifikatPendidik')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->NomorSertifikatPendidik }}"
                                    type="test" placeholder="NomorSertifikatPendidik" id="NomorSertifikatPendidik"
                                    name="NomorSertifikatPendidik">
                                @error('NomorSertifikatPendidik')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunSertifikasi" class="form-control-label">{{ __('Tahun Sertifikasi') }}</label>
                            <div class="@error('TahunSertifikasi')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->TahunSertifikasi)

                                    <input class="form-control" value="{{ auth()->user()->guru->TahunSertifikasi }}"
                                        type="text" placeholder="Tahun Sertifikasi" id="TahunSertifikasi"
                                        name="TahunSertifikasi">
                                    @error('TahunSertifikasi')
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
                            <label for="pangkatgt" class="form-control-label">{{ __('Pangkat GT') }}</label>
                            <div class="@error('pangkatgt')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->pangkatgt }}"
                                    type="text" placeholder="pangkatgt" id="pangkatgt"
                                    name="pangkatgt">
                                @error('Pangkatgt')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jadwalkenaikanpangkat" class="form-control-label">{{ __('Jadwal Kenaikan Pangkat') }}</label>
                            <div class="@error('jadwalkenaikanpangkat')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->jadwalkenaikanpangkat)

                                    <input class="form-control" value="{{ auth()->user()->guru->jadwalkenaikanpangkat }}"
                                        type="date" placeholder="jadwalkenaikanpangkat" id="jadwalkenaikanpangkat"
                                        name="jadwalkenaikanpangkat">
                                    @error('jadwalkenaikanpangkat')
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
                            <label for="jadwalkenaikangaji" class="form-control-label">{{ __('Jadwal Kenaikan Gaji') }}</label>
                            <div class="@error('jadwalkenaikangaji')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->jadwalkenaikangaji }}"
                                    type="date" placeholder="jadwalkenaikangaji" id="jadwalkenaikangaji"
                                    name="jadwalkenaikangaji">
                                @error('jadwalkenaikangaji')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PendidikanAkhir" class="form-control-label">{{ __('Pendidikan Akhir') }}</label>
                            <div class="@error('PendidikanAkhir')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->PendidikanAkhir)

                                    <input class="form-control" value="{{ auth()->user()->guru->PendidikanAkhir }}"
                                        type="text" placeholder="PendidikanAkhir" id="PendidikanAkhir"
                                        name="PendidikanAkhir">
                                    @error('PendidikanAkhir')
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
                            <label for="TahunTamat" class="form-control-label">{{ __('Tahun Tamat') }}</label>
                            <div class="@error('TahunTamat')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->TahunTamat }}"
                                    type="date" placeholder="TahunTamat" id="TahunTamat"
                                    name="TahunTamat">
                                @error('TahunTamat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
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
                                        type="text" placeholder="Jurusan" id="Jurusan"
                                        name="Jurusan">
                                    @error('Jurusan')
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
                            <label for="TugasMengajar" class="form-control-label">{{ __('Tugas Mengajar') }}</label>
                            <div class="@error('TugasMengajar')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->TugasMengajar }}"
                                    type="text" placeholder="TugasMengajar" id="TugasMengajar"
                                    name="TugasMengajar">
                                @error('TugasMengajar')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Jabatan" class="form-control-label">{{ __('Jabatan') }}</label>
                            <div class="@error('Jabatan')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Jabatan)

                                    <input class="form-control" value="{{ auth()->user()->guru->Jabatan }}"
                                        type="text" placeholder="Jabatan" id="Jabatan"
                                        name="Jabatan">
                                    @error('Jabatan')
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
                            <label for="NomorTelephone" class="form-control-label">{{ __('Nomor Telephone') }}</label>
                            <div class="@error('NomorTelephone')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->NomorTelephone }}"
                                    type="phone" placeholder="NomorTelephone" id="NomorTelephone"
                                    name="NomorTelephone">
                                @error('NomorTelephone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                            <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru && auth()->user()->guru->Alamat)

                                    <input class="form-control" value="{{ auth()->user()->guru->Alamat }}"
                                        type="text" placeholder="Alamat" id="Alamat"
                                        name="Alamat">
                                    @error('Alamat')
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
                            <label for="Email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('Email')border border-danger rounded-3 @enderror">
                                @if (auth()->check() && auth()->user()->guru)
                                <input class="form-control" value="{{ auth()->user()->guru->Email }}"
                                    type="email" placeholder="Email" id="Email"
                                    name="Email">
                                @error('Email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
                            @endif
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
                                    name="TahunTamat">
                                @error('TahunTamat')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            @else
                                <input class="form-control" value="tidak ada data" type="text"
                                    placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir">
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
                                        type="text" placeholder="Jurusan" id="Jurusan"
                                        name="Jurusan">
                                    @error('Jurusan')
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
