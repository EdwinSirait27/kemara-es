@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Profile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Pofile Sekolah') }}</div>

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
                        <form method="POST" id="create-user-form" action="{{ route('Profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="header" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Buat Header') }}
                                        </label>
                                        <div class="@error('header')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($header ?? '') }}"
                                            type="text"
                                                id="header" name="header" aria-describedby="info-header"
                                                maxlength="255" required>
                                                @error('header')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : SMAK KESUMA MATARAM MEMENANGKAN blablabla</p>
                                        </div>
                                    </div>
                                </div>
                           
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="body" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Body') }}
                                        </label>
                                        <div>
                                            <input class="form-control"
                                            value="{{ e($body ?? '') }}"
                                            type="text"
                                                id="body" name="body" aria-describedby="info-body"
maxlength="255" required>
                                                @error('body')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
    
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="body" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Body') }}
                                    </label>
                                    <div>
                                        <textarea 
                                            class="form-control"
                                            id="body" name="body" aria-describedby="info-body"
                                             required
                                            style="resize: both; overflow: auto;">{{ e($body ?? '') }}</textarea>
                                        @error('body')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                                        
                            
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar1" class="form-control-label">{{ __('gambar1') }}</label>
                                    <div class="@error('gambar1')border border-danger rounded-3 @enderror">
                                        <input type="file" class="form-control @error('gambar1') is-invalid @enderror" id="gambar1" name="gambar1" accept="image/*" required>
                                            @error('gambar1')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">maksimal 1 mb</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar2" class="form-control-label">{{ __('gambar2') }}</label>
                                    <div class="@error('gambar2')border border-danger rounded-3 @enderror">
                                        <input type="file" class="form-control @error('gambar2') is-invalid @enderror" id="gambar2" name="gambar2" accept="image/*" >
                                            @error('gambar2')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">maksimal 1 mb</p>

                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gambar3" class="form-control-label">{{ __('gambar3') }}</label>
                                        <div class="@error('gambar3')border border-danger rounded-3 @enderror">
                                            <input type="file" class="form-control @error('gambar3') is-invalid @enderror" id="gambar3" name="gambar3" accept="image/*" required>
                                                @error('gambar3')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">maksimal 1 mb</p>
    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gambar4" class="form-control-label">{{ __('gambar4') }}</label>
                                        <div class="@error('gambar4')border border-danger rounded-3 @enderror">
                                            <input type="file" class="form-control @error('gambar4') is-invalid @enderror" id="gambar4" name="gambar4" accept="image/*" >
                                                @error('gambar4')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">maksimal 1 mb</p>
    
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gambar5" class="form-control-label">{{ __('gambar5') }}</label>
                                            <div class="@error('gambar5')border border-danger rounded-3 @enderror">
                                                <input type="file" class="form-control @error('gambar5') is-invalid @enderror" id="gambar5" name="gambar5" accept="image/*" required>
                                                    @error('gambar5')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                                <p class="text-muted text-xs mt-2">maksimal 1 mb</p>
        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gambar6" class="form-control-label">{{ __('gambar6') }}</label>
                                            <div class="@error('gambar6')border border-danger rounded-3 @enderror">
                                                <input type="file" class="form-control @error('gambar6') is-invalid @enderror" id="gambar6" name="gambar6" accept="image/*" >
                                                    @error('gambar6')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                                <p class="text-muted text-xs mt-2">maksimal 1 mb</p>
        
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gambar7" class="form-control-label">{{ __('gambar7') }}</label>
                                                <div class="@error('gambar7')border border-danger rounded-3 @enderror">
                                                    <input type="file" class="form-control @error('gambar7') is-invalid @enderror" id="gambar7" name="gambar7" accept="image/*" required>
                                                        @error('gambar7')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                    <p class="text-muted text-xs mt-2">maksimal 1 mb</p>
            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gambar8" class="form-control-label">{{ __('gambar8') }}</label>
                                                <div class="@error('gambar8')border border-danger rounded-3 @enderror">
                                                    <input type="file" class="form-control @error('gambar8') is-invalid @enderror" id="gambar8" name="gambar8" accept="image/*" >
                                                        @error('gambar8')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                    <p class="text-muted text-xs mt-2">maksimal 1 mb</p>
            
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    <div class="row">

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
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Profile') }}
                                    </button>

                                    <a href="{{ route('Profile.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                <strong> Gambar 1 harus ada fotonya gambar 2-8 bebas mau dimasukkan atau tidak</strong> <br>
                                
                                    <br>
                
                            </span>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Profile Sekolah?",
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
