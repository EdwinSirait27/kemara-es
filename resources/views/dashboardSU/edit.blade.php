{{-- @extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah User') 
@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pengguna</h1>
    <form action="{{ route('dashboardSU.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="guru_id" class="form-label">Guru ID</label>
            <input 
                type="text" 
                class="form-control @error('guru_id') is-invalid @enderror" 
                id="guru_id" 
                name="guru_id" 
                value="{{ old('guru_id', $user->guru_id) }}"
            >
            @error('guru_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input 
                type="text" 
                class="form-control @error('username') is-invalid @enderror" 
                id="username" 
                name="username" 
                value="{{ old('username', $user->username) }}"
            >
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hakakses" class="form-label">Hak Akses</label>
            <select 
                class="form-control @error('hakakses') is-invalid @enderror" 
                id="hakakses" 
                name="hakakses"
            >
                <option value="admin" {{ old('hakakses', $user->hakakses) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ old('hakakses', $user->hakakses) == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                <option value="guest" {{ old('hakakses', $user->hakakses) == 'guest' ? 'selected' : '' }}>Guest</option>
            </select>
            @error('hakakses')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Role" class="form-label">Role</label>
            <input 
                type="text" 
                class="form-control @error('Role') is-invalid @enderror" 
                id="Role" 
                name="Role" 
                value="{{ old('Role', implode(', ', explode(',', $user->Role))) }}"
            >
            @error('Role')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dashboardSU.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection --}}
@extends('layouts.user_type.auth')
@section('content')
    <p>Konten ini harus muncul jika layout berhasil dimuat.</p>
@endsection
