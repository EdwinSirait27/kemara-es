@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit')

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
                          
                                
        <form action="{{ route('Validasi.update', $hashedId) }}" method="POST"enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
                    
                                <img src="{{ optional($pembayaran->Siswa)->foto  
                                ? asset('storage/fotosiswa/' . $pembayaran->Siswa->foto)  
                                : asset('storage/fotosiswa/we.jpg') }}"  
                        alt="Foto Siswa"  
                        class="w-100 border-radius-lg shadow-sm"  
                        id="imagePopup">
                    
                            
                            {{-- <a href="javascript:;"
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
                               $siswaNama = $pembayaran->Siswa->NamaLengkap;
                            //    $siswatugas = $siswa->TugasMengajar;
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
                                <label for="NamaLengkap" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Nama Siswa') }}
                                </label>
                                
                                <div>
                                    <input class="form-control" value="{{ $pembayaran->Siswa->NamaLengkap ?? ''}}"
                                    type="text" id="NamaLengkap" name="NamaLengkap" aria-describedby="info-NamaLengkap" readonly>
                           
                            @error('NamaLengkap')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                        </div>
                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto" class="form-control-label">
                                    <i class="fas fa-lock"></i> {{ __('Foto Bukti') }}
                                </label>
                        
                                <div>
                                    @if ($pembayaran->foto)
                                        <div class="mt-2">
                                            <img id="buktiFoto" src="{{ asset('storage/bukti_pembayaran/' . $pembayaran->foto) }}" 
                                                 alt="Foto Bukti" style="max-width: 500px; cursor: pointer;">
                                        </div>
                                    @endif
                        
                                    @error('foto')
                                        <div class="text-danger">{{ $message }}</div>
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
                                <option value="" disabled selected>{{ __('Pilih Status ') }}</option>
                                @foreach (['Dalam Antrian', 'Lunas','Menyicil'] as $status)
                                    <option value="{{ e($status) }}"
                                        {{ $pembayaran->status == $status ? 'selected' : '' }}>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ket" class="form-control-label"><i class="fas fa-lock"></i>
                            {{ __('Keterangan') }}</label>

                        <div class="@error('ket') border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{ $pembayaran->ket ?? ''}}"
                            type="text" id="ket" name="ket" aria-describedby="info-ket" maxlength="255">
                   
                            @error('ket')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>
                </div>
               
                <div class="d-flex justify-content-between">
                    <a href="{{ route('Validasi.index') }}" class="btn btn-secondary btn-md mt-4 mb-4">Back</a>
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
        document.getElementById('buktiFoto').addEventListener('click', function () {
            Swal.fire({
                title: 'Foto Bukti Pembayaran',
                imageUrl: '{{ asset('storage/bukti_pembayaran/' . $pembayaran->foto) }}',
                imageAlt: 'Foto Bukti',
                showCloseButton: true,
                showConfirmButton: false,
                width: 'auto',
                background: '#fff',
                padding: '1em',
                customClass: {
                    popup: 'rounded'
                }
            });
        });
    </script>
    
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
