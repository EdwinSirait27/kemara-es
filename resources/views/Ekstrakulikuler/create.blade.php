@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Ekstrakulikuler')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Ekstrakulikuler') }}</div>

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
                        <form method="POST" id="create-user-form" action="{{ route('Ekstrakulikuler.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="guru_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Wali Kelas') }}
                                        </label>
                                        <div class="@error('guru_id')border border-danger rounded-3 @enderror">
                                            <select name="guru_id" id="guru_id" class="form-select">
                                                <option value="" selected disabled>Pilih Guru</option>
                                                @foreach ($gurus as $guru)
                                                    <option value="{{ $guru->guru_id }}">{{ $guru->Nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('guru_id')
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
                                        <label for="namaekstra" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Ekstrakulikuler') }}
                                        </label>
                                        <div class="@error('namaekstra')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($namaekstra ?? '') }}"
                                            type="text"
                                                id="namaekstra" name="namaekstra" aria-describedby="info-namaekstra"
                                                maxlength="50" required>
                                                @error('namaekstra')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Olimpiade</p>

                                       



                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kapasitas" class="form-control-label">{{ __('Kapasitas') }}</label>
                                        <div class="@error('kapasitas')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($kapasitas ?? '') }}"
                                            type="text"
                                                id="kapasitas" name="kapasitas" aria-describedby="info-kapasitas"
                                                maxlength="2" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                @error('kapasitas')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : 2</p>

                                      


                                       
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
        
                                        </div>
                                    </div>
                                </div>
                           
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Ekstrakulikuler') }}
                                    </button>

                                    <a href="{{ route('Ekstrakulikuler.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong> Jika sudah ada Nama Ekstrakulikuler yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong> <br>
                               
                                    <br>
                
                            </span>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Ekstrakulikuler?",
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
