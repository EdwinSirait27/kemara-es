@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Tombol')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Tombol') }}</div>

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
                        <form method="POST" id="create-user-form" action="{{ route('Tombol.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('URL') }}
                                        </label>
                                        <div class="@error('url')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($url ?? '') }}"
                                            type="text"
                                                id="url" name="url" aria-describedby="info-url"
                                                maxlength="50" required>
                                                @error('url')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            {{-- <p class="text-muted text-xs mt-2">Contoh : Osis </p> --}}

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
                                        <label for="start_date" class="form-control-label">{{ __('Tanggal Mulai') }}</label>
                                        <div class="@error('start_date')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($start_date ?? '') }}"
                                            type="datetime-local"
                                                id="start_date" name="start_date" aria-describedby="info-start_date"
                                                 required>
                                                @error('start_date')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            {{-- <p class="text-muted text-xs mt-2">Contoh : 2</p> --}}




                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-control-label">{{ __('Tanggal Akhir') }}</label>
                                        <div class="@error('end_date')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($end_date ?? '') }}"
                                            type="datetime-local"
                                                id="end_date" name="end_date" aria-describedby="info-end_date"
                                                 required>
                                                @error('end_date')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            {{-- <p class="text-muted text-xs mt-2">Contoh : 2</p> --}}



                                       
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
                                        <label for="ket" class="form-control-label">{{ __('Keterangan') }}</label>
                                        <div class="@error('ket')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($ket ?? '') }}"
                                            type="text"
                                                id="ket" name="ket" aria-describedby="info-ket"
                                                 required>
                                                @error('ket')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            {{-- <p class="text-muted text-xs mt-2">Contoh : 2</p> --}}




                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Tombol') }}
                                    </button>

                                    <a href="{{ route('Tombol.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Tombol?",
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
