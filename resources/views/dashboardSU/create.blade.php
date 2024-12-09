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

                    @if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

                    {{-- Form untuk membuat user --}}
                    <form method="POST" id="create-user-form" action="{{ route('dashboardSU.store') }}">
                        @csrf

                        {{-- Input Username --}}
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">{{ __('Username') }}</label>
                            <input id="username" type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Input Password --}}
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                                   <i class="fas fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" 
                                   id="togglePassword" style="cursor: pointer;"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
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



                        {{-- Input Password Confirmation --}}
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" 
                                   class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group mb-3">
                            
                            
                            <label for="hakakses" class="form-control-label">{{ __('Hak Akses') }}</label>
                            <div class="@error('hakakses') border border-danger rounded-3 @enderror">
                                <select class="form-control" name="hakakses" id="hakakses" required>
                                    <option value="" disabled selected>Pilih Hak Akses</option>
                                <option value="SU">SU</option>
                                <option value="KepalaSekolah">KepalaSekolah</option>
                                <option value="Admin">Admin</option>
                                <option value="Guru">Guru</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Kurikulum">Kurikulum</option>
                                </select>
                                @error('hakakses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="Role" class="form-label">{{ __('Role') }}</label> <br>
                           
                                <input type="checkbox" name="Role[]" value="SU"> SU<br>
                                <input type="checkbox" name="Role[]" value="KepalaSekolah"> Kepala Sekolah<br>
                                <input type="checkbox" name="Role[]" value="Admin"> Admin<br>
                                <input type="checkbox" name="Role[]" value="Guru"> Guru<br>
                                <input type="checkbox" name="Role[]" value="Kurikulum"> Kurikulum<br>
                                <input type="checkbox" name="Role[]" value="Siswa"> Siswa<br>
                           
                            @error('Role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        {{-- Submit Button --}}
                        <div class="form-group mb-0">
                            <button type="button"  id="submit-btn" class="btn btn-primary">
                                {{ __('Create User') }}
                            </button>
    
                            <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submit-btn').addEventListener('click', function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to create this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, create it!'
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
