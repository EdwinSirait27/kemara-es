@extends('layouts.user_type.auth')

@section('content')
<style>
    .avatar {
        position: relative;
    }
    .iframe-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%; /* Aspect ratio 16:9 */
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
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm" id="imagePopup">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2" id="uploadBtn">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Gambar"></i>
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
                       

                        @if (auth()->check() && auth()->user()->Guru)
                        <h5 class="mb-1">
                            {{ auth()->user()->Guru->Nama ?? 'tidak ada' }}
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
                <form action="/user-profile" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
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
                                    <input class="form-control" value="{{ auth()->user()->username }}" type="text" placeholder="username" id="username" name="username">
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
                                    {{-- @if ($guru->isNotEmpty())

                                    @foreach ($guru as $item)
                                    <input class="form-control" value="{{ auth()->user()->$guru->Nama }}" type="Nama" placeholder="Nama" id="Nama" name="Nama">
                                        @error('Nama')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        @endforeach
                                        @else
                                        <input class="form-control" type="Nama" placeholder="Nama" id="Nama" name="Nama" >

                                        @endif --}}
                                        @if (auth()->check() && auth()->user()->Guru)
                                        {{-- <input 
                                            class="form-control" 
                                            value="{{ auth()->user()->Guru->Nama ?? 'tidak ada' }}" 
                                            type="text" 
                                            placeholder="Nama" 
                                            id="Nama" 
                                            name="Nama"
                                        > --}}
                                        <input class="form-control" value="{{ auth()->user()->Guru->Nama }}" type="text" placeholder="Nama" id="Nama" name="Nama" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">

                                    @else
                                        <input 
                                            class="form-control" 
                                            value="tidak ada data" 
                                            type="text" 
                                            placeholder="Nama" 
                                            id="Nama" 
                                            name="Nama"
                                        >
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
                                            <option value="{{ $role }}" {{ auth()->user()->Role == $role ? 'selected' : '' }}>
                                                {{ ucfirst($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Role')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                    
                                    {{-- <select name="Role" class="form-control" required>
                                        <option  disabled selected>Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                    @error('Role')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror --}}
                                    
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="Role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('Role')border border-danger rounded-3 @enderror">
                                  
                                        <select name="Role[]" class="form-control" multiple required>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role }}" selected>{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                        @error('Role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror 
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <label for="user-email" class="form-control-label">{{ __('Email') }}</label> --}}
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    {{-- <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label> --}}
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    {{-- <input class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <label for="user.location" class="form-control-label">{{ __('Location') }}</label> --}}
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    {{-- <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{-- <label for="about">{{ 'About Me' }}</label> --}}
                        <div class="@error('user.about')border border-danger rounded-3 @enderror">
                            {{-- <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea> --}}
                        </div>
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
    $(document).ready(function(){
        $('#imagePopup').click(function(){
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