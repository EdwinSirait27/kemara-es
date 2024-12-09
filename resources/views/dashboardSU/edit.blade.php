{{-- @extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Update Data')

@section('content')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

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

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{ old('password', $user->password) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@endsection --}}
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

{{-- @php
                                $oldRoles = old('hakakses', $hakakses); 
                            @endphp --}}
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
                        </div>
                        <div class="row">
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