@extends('layouts.user_type.guest')
@section('title', 'Daftar PPDB')
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
                        <h2 class="text-white mb-2 mt-5">Selamat Datang Calon Peserta Didik SMAK Kesuma Mataram </h2>
                        <p class="text-lead text-white">
                            Silahkan diisi format berikut dengan benar<br>
                            jika belum paham, silahkan kunjungi Instagram dari SMAK Kesuma Mataram untuk melihat tutorial pendaftaran siswa baru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-20 col-lg-12 col-md-14">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Kemara-ES</h5>
                            <img src="{{ asset('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo"
                                style="width: 125px; height: 125px; margin-right: 10px; border-radius: 0.5rem;">
                        </div>
                        <div class="card-body">
                            <form id="ppdb-form" role="form" method="POST" action="{{ route('Ppdb.store') }}">
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

                                {{-- <!-- Nama Lengkap --> tidak boleh angka dan simbol --}}
                                <div class="row mb-3">
                                    <!-- Nama Lengkap -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Nama Lengkap Siswa</label>
                                        <input type="text" 
       class="form-control form-control-sm" 
       name="NamaLengkap" 
       id="NamaLengkap" 
       placeholder="Nama Lengkap" 
       aria-label="NamaLengkap" 
       maxlength="100" 
       required 
       oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" value="{{ old('NamaLengkap') }}">

                                        @error('NamaLengkap')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-envelope"></i> Nama Panggilan Siswa</label>
                                        <input type="text" class="form-control form-control-sm" name="NamaPanggilan"
                                            id="NamaPanggilan" placeholder="NamaPanggilan" maxlength="20" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"value="{{ old('NamaPanggilan') }}">
                                        @error('NamaPanggilan')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Username -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Tempat Lahir Siswa</label>
                                        <input type="text" class="form-control form-control-sm" name="TempatLahir"
                                            id="TempatLahir" placeholder="TempatLahir" aria-label="TempatLahir"
                                            aria-describedby="TempatLahir-addon" maxlength="50" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" value="{{ old('TempatLahir') }}">
                                        {{-- oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')" --}}
                                        @error('TempatLahir')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Nama Lengkap -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Tanggal Lahir Siswa</label>
                                        <input type="date" class="form-control form-control-sm" name="TanggalLahir"
                                            id="TanggalLahir" aria-label="TanggalLahir" required value="{{ old('TanggalLahir') }}">
                                        @error('TanggalLahir')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-envelope"> </i> Jenis Kelamin Siswa</label>
                                        <select class="form-control" name="JenisKelamin" id="JenisKelamin" required >
                                            <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}
                                            </option>
                                            @foreach (['Laki-Laki', 'Perempuan'] as $jenis)
                                            <option value="{{ e($jenis) }}" {{ old('JenisKelamin') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                            @endforeach
                                        </select>
                                        @error('JenisKelamin')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <!-- Username -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i>Agama Siswa</label>
                                        <select class="form-control" name="Agama" id="Agama" required value="{{ old('Agama') }}">
                                            <option value="" disabled selected>{{ __('Pilih Agama') }}</option>
                                            @foreach (['Katolik', 'Kristen Protestan', 'Islam', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                            <option value="{{ e($agama) }}" {{ old('Agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>

                                                {{-- <option value="{{ e($agama) }}">{{ $agama }}</option> --}}
                                            @endforeach
                                        </select>
                                        @error('Agama')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Nama Lengkap -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Alamat Siswa</label>
                                        <input type="text" class="form-control form-control-sm" name="Alamat"
                                            id="Alamat" placeholder="Alamat" aria-label="Alamat"required maxlength="100" oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,]/g, '')"value="{{ old('Alamat') }}">
                                        @error('Alamat')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-envelope"></i> Nomor Telephone Siswa</label>
                                        <input type="phone" class="form-control form-control-sm" name="NomorTelephone"
                                            id="NomorTelephone" placeholder="NomorTelephone"required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')"value="{{ old('NomorTelephone') }}">
                                        @error('NomorTelephone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Username -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Nomor Telephone Orang Tua</label>
                                        <input type="phone" class="form-control form-control-sm"
                                            name="NomorTelephoneAyah" id="NomorTelephoneAyah"
                                            placeholder="NomorTelephone" aria-label="NomorTelephoneAyah"
                                            aria-describedby="NomorTelephoneAyah-addon" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('NomorTelephoneAyah') }}">
                                        @error('NomorTelephoneAyah')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Nama Lengkap -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Username Siswa</label>
                                        <input type="text" class="form-control form-control-sm" name="username"
                                            id="username"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')"
                                            placeholder="Masukkan Username" aria-label="username" maxlength="12"
                                            required oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')" value="{{ old('username') }}">
                                        @error('username')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label><i class="fas fa-envelope"></i> Password</label>
                                        <div
                                            class="@error('password') border border-danger rounded-3 @enderror position-relative">
                                            <input class="form-control" type="password" placeholder="Masukkan Password"
                                                id="password" name="password" maxlength="12" oninput="this.value = this.value.replace(/<script.*?>.*?<\/script>/gi, '')">
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
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label><i class="fas fa-user"></i> Konfirmasi Password</label>
                                        <div
                                            class="@error('password_confirmation') border border-danger rounded-3 @enderror position-relative">
                                            <input class="form-control" type="password"
                                                placeholder="Konfirmasi Password Baru" id="password_confirmation"
                                                name="password_confirmation" maxlength="12" oninput="this.value = this.value.replace(/<script.*?>.*?<\/script>/gi, '')">
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

                                <!-- Submit -->
                                <div class="text-center">
                                    <!-- Tombol Daftar -->
                                    <button type="submit" id="daftar-btn"
                                        class="btn bg-gradient-info w-35 mt-4 mb-0">Daftar</button>

                                    <!-- Tombol Cancel -->
                                    <a href="/login" id="cancel-btn"
                                        class="btn bg-gradient-secondary w-35 mt-4 mb-0">Cancel</a>
                                </div>

                            </form>
                        </div>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong class="fa fa-lock"></strong>
                                <strong> Silahkan diisi semua formnya ya</strong> <br>
                                <strong>- Untuk pengisian username itu bebas tetapi tidak boleh spasi dan simbol, minimal 7
                                    karakter sampai 12 karakter, contoh username: edwin1234567</strong> <br>
                                <strong>- untuk password huruf, angka, dan simbol, tetapi tidak boleh ada spasi, minimal 7
                                    sampai 12 karakter contoh password : edwin12345@!. </strong> <br>
                                <strong>- untuk konfirmasi password silahkan masukkan password yang baru saya dibuat dan
                                    harus sama dengan password yang baru dibuat.</strong> <br>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            document.getElementById('daftar-btn').addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah pengiriman form langsung
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pastikan data yang Anda masukkan sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Daftar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengkonfirmasi, submit form
                        document.getElementById('ppdb-form').submit();
                    }
                });
            });
        </script>


    @endsection
