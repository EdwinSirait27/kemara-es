@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Dataku')
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
            <div class="page-header min-height-100 border-radius-xl mt-4"
            style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-8"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <form action={{ route('DatakuSiswa.storeall') }} method="POST" role="form text-left"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                    
                                 <img src="{{ auth()->check() && optional(auth()->user()->siswa)->foto 
                                 ? asset('storage/fotosiswa/' . auth()->user()->siswa->foto) 
                                 : asset('storage/fotosiswa/we.jpg') }}"
                                alt="Foto Guru" 
                                class="w-100 border-radius-lg shadow-sm" 
                                id="imagePopup">
                   
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
                                $SiswaNama = optional(auth()->user()->Siswa)->NamaLengkap;
                            @endphp

                            <h5 class="mb-1">
                                Nama Siswa : {{ $SiswaNama ?? 'Tidak ada Nama' }}
                            </h5>
                           
                            
                            <p class="mb-0 font-weight-bold text-sm">
                
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
                                <label for="username" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Username') }}
                                </label>
                                
                                <div>
                                    <input class="form-control" value="{{ e(optional(auth()->user())->username ?? '') }}"
                                        type="text" id="username" name="username" required
                                        aria-describedby="info-username">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NamaLengkap" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Nama Lengkap') }}
                                </label>
                                <div>
                                    <input class="form-control" value="{{ e(optional(auth()->user())->Siswa->NamaLengkap ?? '') }}"
                                        type="text" id="NamaLengkap" name="NamaLengkap" aria-describedby="info-NamaLengkap" required>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NomorInduk" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Nomor Induk') }}
                                </label>
                                <div class="@error('NomorInduk')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->siswa->NomorInduk ?? '') }}" type="text"
                                        id="NomorInduk" name="NomorInduk" aria-describedby="info-NomorInduk"
                                        maxlength="20" required>
                                        @error('NomorInduk')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                           
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NamaPanggilan" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Nama Panggilan') }}</label>
                                <div class="@error('NamaPanggilan') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('NamaPanggilan', optional(auth()->user()->Siswa)->NamaPanggilan) }}"
                                        type="text" placeholder="NamaPanggilan" id="NamaPanggilan" name="NamaPanggilan"
                                        required>
                                    @error('NamaPanggilan')
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

                                <div class="@error('JenisKelamin') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="JenisKelamin" id="JenisKelamin" required>
                                        <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}</option>
                                        @foreach (['Laki-Laki', 'Perempuan'] as $jenis)
                                            <option value="{{ e($jenis) }}"
                                                {{ auth()->check() && optional(auth()->user()->Siswa)->JenisKelamin == $jenis ? 'selected' : '' }}>
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
                                <label for="NISN" class="form-control-label"><i class="fas fa-lock"></i> {{ __('NISN') }}</label>

                                <div class="@error('NISN')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Siswa->NISN ?? '') }}" type="text"
                                        id="NISN" name="NISN" aria-describedby="info-NISN"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                                        @error('NISN')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                
                                <label for="TempatLahir" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Tempat Lahir') }}
                                </label>
                                <div class="@error('TempatLahir')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ e(optional(auth()->user())->Siswa->TempatLahir ?? '') }}" type="text"
                                        id="TempatLahir" name="TempatLahir" aria-describedby="info-TempatLahir"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"maxlength="30" required>
                                        @error('TempatLahir')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                
                                </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="TanggalLahir" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Tanggal Lahir') }}</label>
                                <div class="@error('TanggalLahir') border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ old('TanggalLahir', optional(auth()->user()->Siswa)->TanggalLahir) }}"
                                        type="date" placeholder="TanggalLahir" id="TanggalLahir" name="TanggalLahir"
                                        required>
                                    @error('TanggalLahir')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                               
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                               <label for="Agama" class="form-control-label"><i class="fas fa-lock"></i> {{ __('Agama') }}</label>
                                
                                <div class="@error('Agama') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="Agama" id="Agama" required>
                                        <option value="" disabled selected>{{ __('Pilih Agama') }}</option>
                                        @foreach (['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                            <option value="{{ e($agama) }}"
                                                {{ auth()->check() && optional(auth()->user()->Siswa)->Agama == $agama ? 'selected' : '' }}>
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

                <div class="alert alert-secondary mx-4" role="alert">
                    <span class="text-white">
                        <strong>Keterangan</strong> <br>
                    </span>
                    <span class="text-white">-
                        <strong class="fa fa-lock"></strong>
                        <strong> Menu ini hanya dapat terbuka tergantung dari Admin yang berfungsi untuk memperbaiki data-data yang kosong atau salah input dari Siswa maupun Tenaga Pengajar </strong>


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
                $('#imageIframe').attr('src', $(this).attr('src'));
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
