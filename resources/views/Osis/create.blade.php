@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Calon')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Calon Ketua Osis') }}</div>

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
                        <form method="POST" id="create-user-form" action="{{ route('Osis.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="siswa_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Calon Ketua Osis') }}
                                        </label>
                                        <div class="@error('siswa_id')border border-danger rounded-3 @enderror">
                                            <select name="siswa_id" id="siswa_id" class="form-select">
                                                <option value="" selected disabled>Pilih Siswa</option>
                                                @foreach ($siswas as $siswa)
                                                    <option value="{{ $siswa->siswa_id }}">{{ $siswa->NamaLengkap }}</option>
                                                @endforeach
                                            </select>
                                            @error('siswa_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>

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
                                        <label for="visi" class="form-control-label">{{ __('Visi') }}</label>
                                        <div class="@error('visi')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($visi ?? '') }}"
                                            type="text"
                                                id="visi" name="visi" aria-describedby="info-misi"
                                                maxlength="255" required>
                                                @error('visi')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : semoga blablabla</p>




                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="misi" class="form-control-label">{{ __('Misi') }}</label>
                                        <div class="@error('misi')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($misi ?? '') }}"
                                            type="text"
                                                id="misi" name="misi" aria-describedby="info-misi"
                                                maxlength="255" required>
                                                @error('misi')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : semoga blablabla</p>

        
                                        </div>
                                    </div>
                                </div>
                                
                               
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Calon') }}
                                    </button>

                                    <a href="{{ route('Osis.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong> Jika sudah ada Calon Ketua Osis yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br>
                               
                                    <br>
                
                            </span>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Osis?",
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
