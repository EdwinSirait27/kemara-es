@extends('layouts.user_type.guest')
@section('title', 'Kesuma-GO | Login')
@section('content')
<style>
    .input-group .btn {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .input-group .btn i {
        font-size: 1rem;
    }
    .form-control {
        height: calc(2.375rem + 2px);
        border-radius: 0.75rem;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
        border-color: #17a2b8;
        box-shadow: 0px 4px 8px rgba(23, 162, 184, 0.5);
    }
    .btn {
        border-radius: 0.75rem;
    }
    .card {
        border-radius: 1rem;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .page-header {
        background-size: cover;
        background-position: center;
        border-radius: 1rem;
    }
    .btn.bg-gradient-info {
        background: linear-gradient(87deg, #11cdef 0, #117a8b 100%);
        box-shadow: 0px 4px 12px rgba(17, 202, 239, 0.5);
    }
    .btn.bg-gradient-info:hover {
        background: linear-gradient(87deg, #117a8b 0, #11cdef 100%);
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
        style="background-image: url('{{ asset('assets/img/curved-images/white-curved.jpeg') }}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h2 class="text-white mb-2 mt-5">Selamat Datang di Kemara-ES</h2>
                    <p class="text-lead text-white">
                        Sistem Informasi Akademik Terintegrasi<br>
                        Akses mudah, data akurat, dan layanan optimal untuk mendukung kegiatan akademik SMPK KESUMA
                        Mataram. Silakan masuk untuk melanjutkan.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Kemara-ES</h5>
                        <img src="{{ asset('assets/img/50204458.jpg') }}" alt="Logo"
                            style="width: 100px; height: 125px; margin-right: 10px; border-radius: 0.5rem;">
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="/session">
                            @csrf
                            @if ($errors->has('throttle'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('throttle') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label><i class="fas fa-user"></i> Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Username" aria-label="username" aria-describedby="username-addon"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')">
                                @error('username')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label><i class="fas fa-key"></i> Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password" aria-label="Password"
                                        aria-describedby="password-addon"
                                        oninput="this.value = this.value.replace(/\s/g, '')">
                                    <i class="fas fa-eye position-absolute top-50 end-0 translate-middle-y me-3"
                                        id="togglePassword" style="cursor: pointer;"></i>
                                </div>
                                @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                            </div>
                           
                            @if ($tombol && $tombol->url)
                            <p class="text-sm mt-3 mb-0">Daftar PPDB? 
                                    <a href="{{ $tombol->url }}" class="text-info font-weight-bolder">Klik Disini</a>
                                @else
                                    <span class="text-muted"></span>
                                @endif
                            </p>
                            
                                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');
      togglePassword.addEventListener('click', function() {
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          this.classList.toggle('fa-eye');
          this.classList.toggle('fa-eye-slash');
      });
  </script>
</section>
@endsection

{{-- @extends('layouts.user_type.guest')
@section('title', 'Kesuma-GO | Login')
@section('content')
    <style>
        .input-group .btn {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-group .btn i {
            font-size: 1rem;
        }
        .form-control {
            height: calc(2.375rem + 2px);
        }
    </style>
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
            style="background-image: url('{{ asset('assets/img/curved-images/white-curved.jpeg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h2 class="text-white mb-2 mt-5">Selamat Datang di Kemara-ES</h2>
                        <p class="text-lead text-white">Sistem Informasi Akademik Terintegrasi
                            Akses mudah, data akurat, dan layanan optimal untuk mendukung kegiatan akademik SMPK KESUMA
                            Mataram.Silakan masuk untuk melanjutkan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Kemara-ES</h5>
                            <img src="{{ asset('assets/img/50204458.jpg') }}" alt="Logo"
                                style="width: 100px; height: 125px; margin-right: 10px;">
                        </div>
                        <div class="row px-xl-5 px-sm-4 px-3">
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="/session">
                                @csrf
                                @if ($errors->has('throttle'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('throttle') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label>
                                        <i class="fas fa-user"></i> Username
                                    </label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Username" aria-label="username" aria-describedby="username-addon"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')">
                                        @error('username')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>
                                            <i class="fas fa-key"></i> Password
                                        </label>
                                        <div class="mb-3 position-relative">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon"
                                                oninput="this.value = this.value.replace(/\s/g, '')">
                                            <i class="fas fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                                id="togglePassword" style="cursor: pointer;"></i>
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <script>
                                            const togglePassword = document.getElementById('togglePassword');
                                            const passwordInput = document.getElementById('password');
                                            togglePassword.addEventListener('click', function() {
                                                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                                passwordInput.setAttribute('type', type);
                                                this.classList.toggle('fa-eye');
                                                this.classList.toggle('fa-eye-slash');
                                            });
                                        </script>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Daftar PPDB? <a href="register"
                                            class="text-dark font-weight-bolder">Klik Disini</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}
