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

        <form action="{{ route('dashboardSU.update', $hashedId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Update User') }}</h6>
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
                                    <label for="password" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Username') }}
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username', $user->username) }}" required
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')">
                                 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Nama" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Nama Lengkap') }}
                                    </label>
                                    <div>
                                        <input class="form-control" value="{{ old('Nama', $user->Guru->Nama ?? '') }}"
                                            type="text" id="Nama" name="Nama" aria-describedby="info-Nama"
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
                                        <input class="form-control" value="{{ old('TempatLahir', $user->Guru->TempatLahir ?? '') }}"
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
                                            <input class="form-control" value="{{ old('TanggalLahir', $user->Guru->TanggalLahir ?? '') }}"
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
                                            <select class="form-control" name="Agama" id="Agama" value="{{ old('Agama', $user->Guru->Agama ?? '') }}" required>
                                                <option value="" disabled {{ old('Agama', $user->Guru->Agama) ? '' : 'selected' }}>{{ __('Pilih Agama') }}</option>
                                                @foreach (['Katolik', 'Kristen Protestan', 'Islam', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                                    <option value="{{ e($agama) }}" 
                                                        {{ old('Agama', $user->Guru->Agama) == $agama ? 'selected' : '' }}>
                                                        {{ $agama }}
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
                                            <label for="JenisKelamin" class="form-control-label">
                                                <i class="fas fa-lock"></i> {{ __('Jenis Kelamin') }}
                                            </label>
                                            <div>
                                                <select class="form-control" name="JenisKelamin" id="JenisKelamin" value="{{ old('JenisKelamin', $user->Guru->JenisKelamin ?? '') }}" required>
                                                    <option value="" disabled {{ old('JenisKelamin', $user->Guru->JenisKelamin) ? '' : 'selected' }}>{{ __('Pilih Jenis Kelamin') }}</option>
                                                    @foreach (['Laki-Laki', 'Perempuan'] as $JenisKelamin)
                                                        <option value="{{ e($JenisKelamin) }}" 
                                                            {{ old('JenisKelamin', $user->Guru->JenisKelamin) == $JenisKelamin ? 'selected' : '' }}>
                                                            {{ $JenisKelamin }}
                                                        </option>
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
                                                <select class="form-control" name="StatusPegawai" id="StatusPegawai" value="{{ old('StatusPegawai', $user->Guru->StatusPegawai ?? '') }}" required>
                                                    <option value="" disabled {{ old('StatusPegawai', $user->Guru->StatusPegawai) ? '' : 'selected' }}>{{ __('Pilih Status Pegawai') }}</option>
                                                    @foreach (['GT', 'GTT', 'Honorer', 'PNS YDP', 'PT', 'PTT'] as $StatusPegawai)

                                                        <option value="{{ e($StatusPegawai) }}" 
                                                            {{ old('StatusPegawai', $user->Guru->StatusPegawai) == $StatusPegawai ? 'selected' : '' }}>
                                                            {{ $StatusPegawai }}
                                                        </option>
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
                                                    <input class="form-control" value="{{ old('Pangkat', $user->Guru->Pangkat ?? '') }}"
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
                                                    <input class="form-control" value="{{ old('jadwalkenaikangaji', $user->Guru->jadwalkenaikangaji ?? '') }}"
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
                                                        <input class="form-control" value="{{ old('jadwalkenaikanpangkat', $user->Guru->jadwalkenaikanpangkat  ?? '') }}"
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
                                                        <input class="form-control" value="{{ old('Jabatan', $user->Guru->Jabatan ?? '') }}"
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
                                            <option value="" disabled {{ old('hakakses', $user->hakakses ?? '') == '' ? 'selected' : '' }}>Pilih Hak Akses</option>
                                            <option value="SU" {{ old('hakakses', $user->hakakses ?? '') == 'SU' ? 'selected' : '' }}>SU</option>
                                            <option value="KepalaSekolah" {{ old('hakakses', $user->hakakses ?? '') == 'KepalaSekolah' ? 'selected' : '' }}>KepalaSekolah</option>
                                            <option value="Admin" {{ old('hakakses', $user->hakakses ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Guru" {{ old('hakakses', $user->hakakses ?? '') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                            <option value="Siswa" {{ old('hakakses', $user->hakakses ?? '') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                                            <option value="Kurikulum" {{ old('hakakses', $user->hakakses ?? '') == 'Kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                                        </select>
                                        @error('hakakses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php
                                    $roles = ['SU', 'KepalaSekolah', 'Admin', 'Guru', 'Kurikulum'];
                                    $selectedRoles = old('Role', explode(',', $user->Role ?? ''));
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
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                                {{ __('Update') }}
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
