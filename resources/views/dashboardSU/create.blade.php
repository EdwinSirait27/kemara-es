@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Tambah User Guru')

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

        <form method="POST" id="create-user-form" action="{{ route('dashboardSU.store') }}">
            @csrf
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Tambah User Guru') }}</h6>
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
                                    <label for="username" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Username') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username') }}" placeholder="Username" required
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')">
                                 
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Password') }}
                                    </label>
                                    <div>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" aria-describedby="password-addon" 
                                            maxlength="12"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '');" />
                                    </div>
                                </div>
                            </div>
                            
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password Baru') }}</label>
                                <div
                                    class="@error('password') border border-danger rounded-3 @enderror position-relative">
                                    <input class="form-control" type="password" placeholder="Password Baru"
                                        id="password" name="password" maxlength="8">
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
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
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nama" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Nama Lengkap') }}
                                    </label>
                                    <div>
                                        <input class="form-control" value="{{ old('Nama' ?? '') }}"
                                            type="text" id="Nama" name="Nama" placeholder="Nama Lengkap" aria-describedby="info-Nama"
                                             maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TempatLahir" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tempat Lahir') }}
                                    </label>
                                    <div>
                                        <input class="form-control" value="{{ old('TempatLahir' ?? '') }}"
                                            type="text" id="TempatLahir" placeholder="Tempat Lahir" name="TempatLahir" aria-describedby="info-TempatLahir"
                                             maxlength="255">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="TanggalLahir" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tanggal Lahir') }}
                                        </label>
                                        <div>
                                            <input class="form-control" value="{{ old('TanggalLahir' ?? '') }}"
                                                type="date" id="TanggalLahir" name="TanggalLahir" aria-describedby="info-TanggalLahir"
                                                 required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Agama" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Agama') }}
                                        </label>
                                        <div>
                                            <select class="form-control" name="Agama" id="Agama" value="{{ old('Agama') }}"required>
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
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="JenisKelamin" class="form-control-label">
                                                <i class="fas fa-lock"></i> {{ __('Jenis Kelamin') }}
                                            </label>
                                            <div>
                                                <select class="form-control" name="JenisKelamin" id="JenisKelamin" value="{{ old('JenisKelamin') }}"required>
                                                    <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}</option>
                                                    @foreach (['Laki-Laki', 'Perempuan'] as $JenisKelamin)
                                                    <option value="{{ e($JenisKelamin) }}" {{ old('JenisKelamin') == $JenisKelamin ? 'selected' : '' }}>{{ $JenisKelamin }}</option>
                    
                                                        {{-- <option value="{{ e($agama) }}">{{ $agama }}</option> --}}
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
                                            <label for="StatusPegawai" class="form-control-label">
                                                <i class="fas fa-lock"></i> {{ __('Status Pegawai') }}
                                            </label>
                                            <div>
                                                <select class="form-control" name="StatusPegawai" id="StatusPegawai" value="{{ old('StatusPegawai') }}"required>
                                                    <option value="" disabled selected>{{ __('Pilih Status Pegawai') }}</option>
                                                    @foreach (['GT', 'GTT', 'Honorer', 'PNS YDP', 'PT', 'PTT'] as $StatusPegawai)
                                                    <option value="{{ e($StatusPegawai) }}" {{ old('StatusPegawai') == $StatusPegawai ? 'selected' : '' }}>{{ $StatusPegawai }}</option>
                    
                                                        {{-- <option value="{{ e($agama) }}">{{ $agama }}</option> --}}
                                                    @endforeach
                                                </select>
                                                @error('StatusPegawai')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Pangkat" class="form-control-label">
                                                    <i class="fas fa-lock"></i> {{ __('Pangkat') }}
                                                </label>
                                                <div>
                                                    <input class="form-control" value="{{ old('Pangkat' ?? '') }}"
                                                    type="text" id="Pangkat" placeholder="Pangkat" name="Pangkat" aria-describedby="info-Pangkat"
                                                     maxlength="255" required>
                                                    @error('Pangkat')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jadwalkenaikangaji" class="form-control-label">
                                                        <i class="fas fa-lock"></i> {{ __('Jadwal Kenaikan Gaji') }}
                                                    </label>
                                                    <div>
                                                        <input class="form-control" value="{{ old('jadwalkenaikangaji' ?? '') }}"
                                                            type="date" id="jadwalkenaikangaji" name="jadwalkenaikangaji" aria-describedby="info-jadwalkenaikangaji"
                                                             >
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jadwalkenaikanpangkat" class="form-control-label">
                                                            <i class="fas fa-lock"></i> {{ __('Jadwal Kenaikan Pangkat') }}
                                                        </label>
                                                        <div>
                                                            <input class="form-control" value="{{ old('jadwalkenaikanpangkat' ?? '') }}"
                                                                type="date" id="jadwalkenaikanpangkat" name="jadwalkenaikanpangkat" aria-describedby="info-jadwalkenaikanpangkat"
                                                                 >
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Jabatan" class="form-control-label">
                                                                <i class="fas fa-lock"></i> {{ __('Jabatan') }}
                                                            </label>
                                                            <div>
                                                                <input class="form-control" value="{{ old('Jabatan' ?? '') }}"
                                                                type="text" id="Jabatan" placeholder="Jabatan" name="Jabatan" aria-describedby="info-Jabatan"
                                                                 maxlength="255">
                                                                @error('Jabatan')
                                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                  
{{-- @php
                                $oldRoles = old('hakakses', $hakakses); 
                                
                            @endphp --}}
                         

                            <div class="row">

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hakakses" class="form-control-label">{{ __('Hak Akses') }}</label>
                                    <div class="@error('hakakses') border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="hakakses" id="hakakses" required>
                                            <option value="" disabled {{ old('hakakses' ?? '') == '' ? 'selected' : '' }}>Pilih Hak Akses</option>
                                            <option value="SU" {{ old('hakakses' ?? '') == 'SU' ? 'selected' : '' }}>SU</option>
                                            <option value="KepalaSekolah" {{ old('hakakses' ?? '') == 'KepalaSekolah' ? 'selected' : '' }}>KepalaSekolah</option>
                                            <option value="Admin" {{ old('hakakses' ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Guru" {{ old('hakakses' ?? '') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                            <option value="Kurikulum" {{ old('hakakses' ?? '') == 'Kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                                        </select>
                                        @error('hakakses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>
                                </div>
                            </div>
                        {{-- $selectedRoles = old('Role', explode(',', $user->Role ?? '')); --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php
                                    $roles = ['SU', 'KepalaSekolah', 'Admin', 'Guru', 'Kurikulum'];
                                    // Jika old('Role') sudah berupa array, gunakan langsung, jika tidak, explode dulu
                                    $selectedRoles = is_array(old('Role')) ? old('Role') : (old('Role') ? explode(',', old('Role')) : []);
                                @endphp
                                
                                <label for="Role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('Role') border border-danger rounded-3 @enderror">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="Role[]" 
                                                id="role_{{ $role }}" 
                                                value="{{ $role }}" 
                                                {{ in_array($role, $selectedRoles) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="role_{{ $role }}">
                                                {{ $role }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('Role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>
                                </div>
                                </div>
                                
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php
                                    $roles = ['SU', 'KepalaSekolah', 'Admin', 'Guru', 'Kurikulum'];
                                    $selectedRoles = old('Role') ? explode(',', old('Role')) : [];

                                @endphp
                                
                                <label for="Role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('Role') border border-danger rounded-3 @enderror">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="Role[]" 
                                                id="role_{{ $role }}" 
                                                value="{{ $role }}" 
                                                {{ in_array($role, $selectedRoles) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="role_{{ $role }}">
                                                {{ $role }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('Role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                                                      
                                    </div>
                                </div>
                            </div>
                          

                        </div> --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                                {{ __('Simpan') }}
                            </button>
                            <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary mt-4 mb-4">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                        
                        {{-- <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update' }}</button>
                            <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">Cancel

                            </a>

                        </div> --}}
        </form>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Keterangan</strong> <br>
            </span>
            <span class="text-white">-
                <strong> Jika sudah ada Username yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br>
                {{-- <strong> Pemberian hakakses itu hanya diperbolehkan 1, dan usahakan pemilihan role itu harus sama dengan pemberian hakakses contoh, hakakses Admin dipilih maka Role yang dipilih harus ada Jika sudah ada Username yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br> --}}
               
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

{{-- @extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buat User') }}</div>

                    <div class="card-body">
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

                        <form method="POST" id="create-user-form" action="{{ route('dashboardSU.store') }}">
                            @csrf

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

                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Create User') }}
                                    </button>

                                    <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">
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

@endsection --}}
