@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buat User') }}</div>

                    <div class="card-body">
                        {{-- Tampilkan pesan sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
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

                        {{-- Form untuk membuat user --}}
                        <form method="POST" id="create-user-form" action="{{ route('dashboardSUSiswa.storeSiswa') }}">
                            @csrf

                            {{-- Input Username --}}
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus required maxlength="12" oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="text-muted text-xs mt-2">Tidak mengandung spasi dan simbol, panjang 7-12 karakter.</p>
                            </div>

                            {{-- Input Password --}}
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" maxlength="12">

                                    <span class="input-group-text">
                                        <i id="eye-icon1" class="fas fa-eye" style="cursor: pointer;"></i>
                                    </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                <p class="text-muted text-xs mt-2">Tidak mengandung spasi dan simbol, 7-12 karakter
                                    .</p>
                            </div>
                            <script>
                                document.getElementById('eye-icon1').addEventListener('click', function() {
                                    var passwordField = document.getElementById('password');
                                    var icon = document.getElementById('eye-icon1');
                                    
                                    // Toggle the type of password field between password and text
                                    if (passwordField.type === 'password') {
                                        passwordField.type = 'text';
                                        icon.classList.remove('fa-eye');
                                        icon.classList.add('fa-eye-slash');
                                    } else {
                                        passwordField.type = 'password';
                                        icon.classList.remove('fa-eye-slash');
                                        icon.classList.add('fa-eye');
                                    }
                                });
                            </script>

                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" maxlength="12">
                                    <span class="input-group-text">
                                        <i id="eye-icon" class="fas fa-eye" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <script>
                                document.getElementById('eye-icon').addEventListener('click', function() {
                                    var passwordField = document.getElementById('password_confirmation');
                                    var icon = document.getElementById('eye-icon');
                                    
                                    // Toggle the type of password field between password and text
                                    if (passwordField.type === 'password') {
                                        passwordField.type = 'text';
                                        icon.classList.remove('fa-eye');
                                        icon.classList.add('fa-eye-slash');
                                    } else {
                                        passwordField.type = 'password';
                                        icon.classList.remove('fa-eye-slash');
                                        icon.classList.add('fa-eye');
                                    }
                                });
                            </script>
                            
                            <div class="form-group mb-3">


                                <label for="hakakses" class="form-control-label">{{ __('Hak Akses') }}</label>
                                <div class="@error('hakakses') border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="hakakses" id="hakakses" required>
                                        <option value="" disabled selected>Pilih Hak Akses</option>
                                        <option value="Siswa">Siswa</option>
                                        <option value="NonSiswa">NonSiswa</option>
                                        
                                    </select>
                                    @error('hakakses')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="Role" class="form-label">{{ __('Role') }}</label> <br>

                                    <input type="checkbox" name="Role[]" value="Siswa">Siswa<br>
                                    <input type="checkbox" name="Role[]" value="NonSiswa">NonSiswa<br>

                                    @error('Role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Submit Button --}}
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Create User') }}
                                    </button>

                                    <a href="{{ route('dashboardSUSiswa.indexSiswa') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong> Jika sudah ada Username yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br>
                               
                                    <br>
                
                            </span>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat User?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Gas!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Submit the form if the user confirms
                                        document.getElementById('create-user-form').submit();
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
