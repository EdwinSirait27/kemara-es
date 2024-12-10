@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Kurikulum')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Kurikulum') }}</div>

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
                        <form method="POST" id="create-user-form" action="{{ route('Kurikulum.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kurikulum" class="form-control-label">{{ __('Kurikulum') }}</label>
                                        <div class="@error('kurikulum')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($kurikulum ?? '') }}"
                                            type="text"
                                                id="kurikulum" name="kurikulum" aria-describedby="info-kurikulum"
                                                maxlength="50" required>
                                                @error('kurikulum')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        {{-- <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                                        <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                            @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Alamat)
                                                <input class="form-control" value="{{ auth()->user()->Guru->Alamat }}"
                                                    type="text" placeholder="Alamat" id="Alamat" name="Alamat"
                                                    maxlength="50" required>
                                                @error('Alamat')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            @else
                                                <input class="form-control" value="tidak ada data" type="text" id="Alamat"
                                                    name="Alamat"required>
                                            @endif --}}
        
        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                        <div class="@error('status')border border-danger rounded-3 @enderror">
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                                
                                            </select>
                                            @error('status')
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
                                        <label for="ket" class="form-control-label">{{ __('Deskripsi') }}</label>
                                        <div class="@error('ket')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($ket ?? '') }}"
                                            type="text"
                                                id="ket" name="ket" aria-describedby="info-ket"
                                                maxlength="50" required>
                                                @error('ket')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        {{-- <label for="Alamat" class="form-control-label">{{ __('Alamat') }}</label>
                                        <div class="@error('Alamat')border border-danger rounded-3 @enderror">
                                            @if (auth()->check() && auth()->user()->Guru && auth()->user()->Guru->Alamat)
                                                <input class="form-control" value="{{ auth()->user()->Guru->Alamat }}"
                                                    type="text" placeholder="Alamat" id="Alamat" name="Alamat"
                                                    maxlength="50" required>
                                                @error('Alamat')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            @else
                                                <input class="form-control" value="tidak ada data" type="text" id="Alamat"
                                                    name="Alamat"required>
                                            @endif --}}
        
        
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Kurikulum') }}
                                    </button>

                                    <a href="{{ route('Kurikulum.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Kurikulum?",
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
