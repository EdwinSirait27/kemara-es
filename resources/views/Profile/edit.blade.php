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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- @if ($success->any())
            <div class="alert alert-success" role='alert'>
                <ul>
                    @foreach ($success->all() as $suc)
                        <li>{{ $suc }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('Profile.update', $hashedId) }}" method="POST"enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Edit Profile Sekolah') }}</h6>
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
                                    <label for="header" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Header') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="header" name="header"
                                            value="{{ old('header', $profile->header) }}" required maxlength="255">
                                        <p class="text-muted text-xs mt-2">Contoh : masukkan header</p>



                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="body" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Body') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="body" name="body"
                                            value="{{ old('body', $profile->body) }}" required>
                                        <p class="text-muted text-xs mt-2">Contoh : isi dari konten</p>



                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar1" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 1') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar1" id="gambar1" class="form-control">

                                        @error('gambar1')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar2" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 2') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar2" id="gambar2" class="form-control">

                                        @error('gambar2')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar3" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload gGambar 3') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar3" id="gambar3" class="form-control">

                                        @error('gambar3')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar4" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 4') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar4" id="gambar4" class="form-control">

                                        @error('gambar4')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar5" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 5') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar5" id="gambar5" class="form-control">

                                        @error('gambar5')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar6" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 6') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar6" id="gambar6" class="form-control">

                                        @error('gambar6')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar7" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 7') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar7" id="gambar7" class="form-control">

                                        @error('gambar7')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar8" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Upload Gambar 8') }}
                                    </label>

                                    <div>
                                        <input type="file" name="gambar8" id="gambar8" class="form-control">

                                        @error('gambar8')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Status') }}
                                    </label>
                                    <div class="@error('status') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" disabled
                                                {{ old('status', $profile->status ?? '') == '' ? 'selected' : '' }}>
                                                Pilih Status</option>
                                            <option value="Aktif"
                                                {{ old('status', $profile->status ?? '') == 'Aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="Tidak Aktif"
                                                {{ old('status', $profile->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>
                                                Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 me-2">
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('Profile.index') }}" class="btn btn-secondary mt-4 mb-4">
                            {{ __('Cancel') }}
                        </a>
                    </div>


        </form>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Keterangan</strong> <br>
            </span>
            <span class="text-white">-
                <strong> Gambar 1 harus ada fotonya gambar 2-8 bebas mau dimasukkan atau tidak</strong> <br>

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
@endsection
