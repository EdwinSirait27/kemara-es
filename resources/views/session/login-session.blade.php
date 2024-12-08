@extends('layouts.user_type.guest')
@section('title', 'Kesuma-GO | Login')
@section('content')
    <style>
        .input-group .btn {
            height: 100%;
            /* Agar tinggi tombol sama dengan input */
            display: flex;
            align-items: center;
            /* Memposisikan ikon secara vertikal */
            justify-content: center;
            /* Memposisikan ikon secara horizontal */
        }

        .input-group .btn i {
            font-size: 1rem;
            /* Ukuran ikon */
        }

        .form-control {
            height: calc(2.375rem + 2px);
            /* Tinggi default input */
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
                            Mataram.

                            Silakan masuk untuk melanjutkan.</p>
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
                            <img src="{{ asset('assets/img/50204458.jpg')}}" alt="Logo"
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

                                <div class="mb-3">
                                  <label>
                                    <i class="fas fa-user"></i> Username
                                </label>
                                
                                    <div class="mb-3">
                                        <input type="username" class="form-control" name="username" id="username"
                                            placeholder="Username" aria-label="username" aria-describedby="username-addon">
                                        @error('username')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>


                                    <div class="mb-3">
                                      <label>
                                        <i class="fas fa-key"></i> Password
                                    </label>
                                    <div class="mb-3 position-relative">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                                            aria-label="Password" aria-describedby="password-addon">
                                        <i class="fas fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" 
                                            id="togglePassword" style="cursor: pointer;"></i>
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <script>
                                        const togglePassword = document.getElementById('togglePassword');
                                        const passwordInput = document.getElementById('password');
                                    
                                        togglePassword.addEventListener('click', function () {
                                            // Toggle the password visibility
                                            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                            passwordInput.setAttribute('type', type);
                                    
                                            // Toggle the eye icon
                                            this.classList.toggle('fa-eye');
                                            this.classList.toggle('fa-eye-slash');
                                        });
                                    </script>
                                    
                                      {{-- <label>
                                        <i class="fas fa-key"></i> Password
                                    </label>
                                        <div class="mb-3">
                                            <input type="Password" class="form-control" name="password" id="password"
                                                placeholder="password"  aria-label="password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror --}}

                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
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

@endsection
{{-- 
<div class="mb-3">
  <label for="password" class="form-control-label">{{ __('Password') }}</label>
  <input type="Password" class="form-control" name="Password" id="Password" placeholder="Password"  aria-label="Password" aria-describedby="Password-addon">
      @error('Password')
        <p class="text-danger text-xs mt-2">{{ $message }}</p>
      @enderror

</div> --}}
{{-- 
@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                  <p class="mb-0">Create a new acount<br></p>
                  <p class="mb-0">OR Sign in with these credentials:</p>
                  <p class="mb-0">Email <b>admin@softui.com</b></p>
                  <p class="mb-0">Password <b>secret</b></p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="admin@softui.com" aria-label="Email" aria-describedby="email-addon">
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="Password" class="form-control" name="Password" id="Password" placeholder="Password" value="secret" aria-label="Password" aria-describedby="Password-addon">
                      @error('Password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">Forgot you Password? Reset you Password 
                  <a href="/login/forgot-Password" class="text-info text-gradient font-weight-bold">here</a>
                </small>
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection --}}
