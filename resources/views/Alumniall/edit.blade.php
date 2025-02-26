@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Alumni')

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
                        <form action={{ route('Alumniall.update', $hashedId) }} method="POST" role="form text-left"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                          
     {{-- @if ($guru->foto && $guru->foto)
     <img src="{{ asset('storage/fotoguru/' . $guru->foto) }}"
          alt="Foto siswa" width="100" height="100"
          class="w-100 border-radius-lg shadow-sm" id="imagePopup">
 @else
     <img src="{{ asset('img/we.jpg') }}"
          alt="Foto siswa" width="100" height="100"
          class="w-100 border-radius-lg shadow-sm" id="imagePopup">
 @endif --}}
 @if (!empty($alumni->foto) && Storage::exists('alumni/' . $alumni->foto))
 <img src="{{ asset('storage/alumni/' . $alumni->foto) }}"
      alt="Foto guru" width="100" height="100"
      class="w-100 border-radius-lg shadow-sm" id="imagePopup">
@else
 <img src="{{ asset('storage/alumni/we.jpg') }}"
      alt="Foto default" width="100" height="100"
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
                            $guruNama = $alumni->NamaLengkap;
                            
                        @endphp

                        <h5 class="mb-1">
                            {{ $guruNama ?? 'Tidak ada Nama' }}
                        </h5>

                        
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
                <h6 class="mb-0">{{ __('Update Alumni') }}</h6>
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
                                <input class="form-control" value="{{ $alumni->NamaLengkap ?? ''}}"
                                    type="text" id="NamaLengkap" name="NamaLengkap" aria-describedby="info-NamaLengkap" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="JenisKelamin" class="form-control-label">
                                <i class="fas fa-lock"></i> {{ __('Jenis Kelamin') }}
                            </label>
                            {{-- <label for="TempatLahir" class="form-control-label">{{ __('Tempat Lahir') }}</label> --}}
                            <div class="@error('JenisKelamin')border border-danger rounded-3 @enderror">
                                <select class="form-control" name="JenisKelamin" id="JenisKelamin" required>
                                    <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}</option>
                                    @foreach (['Laki-Laki', 'Perempuan'] as $JenisKelamin)
                                        <option value="{{ e($JenisKelamin) }}"
                                            {{ $alumni->JenisKelamin == $JenisKelamin ? 'selected' : '' }}>
                                            {{ e($JenisKelamin) }}
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
                            <label for="TanggalLahir" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Tanggal Lahir') }}</label>
                            {{-- <label for="TanggalLahir" class="form-control-label">{{ __('Tanggal Lahir') }}</label> --}}
                            <div class="@error('TanggalLahir') border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->TanggalLahir }}"
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
                                            {{ $alumni->Agama == $agama ? 'selected' : '' }}>
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
                            <label for="NomorTelephone"
                            class="form-control-label">{{ __('Nomor Telephone') }}</label>
                        <div class="@error('NomorTelephone')border border-danger rounded-3 @enderror">
                            <input class="form-control"
                                value="{{ $alumni->NomorTelephone ?? ''}}"
                                type="phone" id="NomorTelephone" name="NomorTelephone"
                                aria-describedby="info-NomorTelephone" maxlength="13"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                            @error('NomorTelephone')
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
                                    value="{{ $alumni->Email ?? '' }}" type="email"
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
                                <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                                <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                    <input class="form-control"
                                        value="{{ $alumni->Alamat ?? '' }}" type="text"
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
                            <label for="TahunMasuk" class="form-control-label">{{ __('Tahun Masuk') }}</label>
                            <div class="@error('TahunMasuk')border border-danger rounded-3 @enderror">
                                <input type="number" class="form-control @error('TahunMasuk') is-invalid @enderror"
                                name="TahunMasuk" id="TahunMasuk"value="{{ $alumni->TahunMasuk }}" min="1900"
                                max="{{ date('Y') }}"placeholder="Tahun Masuk" required>
                            @error('TahunMasuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TahunLulus" class="form-control-label">{{ __('Tahun Lulus') }}</label>
                            <div class="@error('TahunLulus')border border-danger rounded-3 @enderror">
                                <input type="number" class="form-control @error('TahunLulus') is-invalid @enderror"
                                name="TahunLulus" id="TahunLulus"value="{{ $alumni->TahunLulus }}" min="1900"
                                max="{{ date('Y') }}"placeholder="Tahun Lulus" required>
                            @error('TahunLulus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Jurusan" class="form-control-label">{{ __('Jurusan') }}</label>
                            <div class="@error('Jurusan')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->Jurusan ?? '' }}" type="text"
                                    id="Jurusan" name="Jurusan" aria-describedby="info-Jurusan"
                                     maxlength="255" required>
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
                            <label for="ProgramStudi" class="form-control-label">{{ __('Program Studi') }}</label>
                            <div class="@error('ProgramStudi')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->ProgramStudi ?? '' }}" type="text"
                                    id="ProgramStudi" name="ProgramStudi" aria-describedby="info-ProgramStudi"
                                     maxlength="255" required>
                                @error('ProgramStudi')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Gelar" class="form-control-label">{{ __('Gelar') }}</label>
                            <div class="@error('Gelar')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->Gelar ?? '' }}" type="text"
                                    id="Gelar" name="Gelar" aria-describedby="info-Gelar"
                                     maxlength="255" required>
                                @error('Gelar')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PerguruanTinggi" class="form-control-label">{{ __('Perguruan Tinggi') }}</label>
                            <div class="@error('PerguruanTinggi')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->PerguruanTinggi ?? '' }}" type="text"
                                    id="PerguruanTinggi" name="PerguruanTinggi" aria-describedby="info-PerguruanTinggi"
                                     maxlength="255" required>
                                @error('PerguruanTinggi')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="StatusPekerja" class="form-control-label"><i class="fas fa-lock"></i>
                                {{ __('Status Pekerja') }}</label>

                            <div class="@error('StatusPekerja') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="StatusPekerja" id="StatusPekerja" required>
                                    <option value="" disabled selected>{{ __('Pilih Status Pekerja') }}</option>
                                    @foreach (['Bekerja', 'Wirausaha', 'Belum Bekerja'] as $StatusPekerja)
                                        <option value="{{ e($StatusPekerja) }}"
                                            {{ $alumni->StatusPekerja == $StatusPekerja ? 'selected' : '' }}>
                                            {{ e($StatusPekerja) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('StatusPekerja')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NamaPerusahaan" class="form-control-label">{{ __('Nama Perusahaan') }}</label>
                            <div class="@error('NamaPerusahaan')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->NamaPerusahaan ?? '' }}" type="text"
                                    id="NamaPerusahaan" name="NamaPerusahaan" aria-describedby="info-NamaPerusahaan"
                                     maxlength="255" required>
                                @error('NamaPerusahaan')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Ig" class="form-control-label">{{ __('Instagram') }}</label>
                            <div class="@error('Ig')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->Ig ?? '' }}" type="text"
                                    id="Ig" name="Ig" aria-describedby="info-Ig" maxlength="255"
                                    required>
                                @error('Ig')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Linkedin" class="form-control-label">{{ __('LinkedIn') }}</label>
                            <div class="@error('Linkedin')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->Linkedin ?? '' }}"
                                    type="text" id="Linkedin" name="Linkedin"
                                    aria-describedby="info-Linkedin" maxlength="255" required>
                                @error('Linkedin')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Facebook" class="form-control-label">{{ __('Facebook') }}</label>
                            <div class="@error('Facebook')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->Facebook ?? '' }}"
                                    type="text" id="Facebook" name="Facebook"
                                    aria-describedby="info-Facebook" maxlength="255" required>
                                @error('Facebook')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Testimoni" class="form-control-label">{{ __('Testimoni') }}</label>
                            <div class="@error('Testimoni')border border-danger rounded-3 @enderror">
                                <input class="form-control"
                                    value="{{ $alumni->Testimoni ?? '' }}"
                                    type="text" id="Testimoni" name="Testimoni"
                                    aria-describedby="info-Testimoni"  required>
                                @error('Testimoni')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
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
                    <strong>- Tolong diisi semua.</strong> <br>
                    <strong>- Data NULL harap diisi.</strong> <br>

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
