@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Tahun Akademik')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Tahun Akademik') }}</div>
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
                        <form method="POST" id="create-user-form" action="{{ route('Tahunakademik.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunakademik" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                        </label>
                                 
                                        <div class="@error('tahunakademik')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($tahunakademik ?? '') }}"
                                            type="text"
                                                id="tahunakademik" name="tahunakademik" aria-describedby="info-tahunakademik"
                                                 placeholder="masukkan tahun akademik" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                                @error('tahunakademik')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : 2024</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="semester" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Semester') }}
                                        </label>
                                        
                                        <div class="@error('semester')border border-danger rounded-3 @enderror">
                                            <select class="form-control" name="semester" id="semester" required>
                                                <option value="" disabled selected>Pilih Semester</option>
                                                <option value="Genap">Genap</option>
                                                <option value="Ganjil">Ganjil</option>
                                                
                                            </select>
                                            @error('semester')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                {{-- <p class="text-muted text-xs mt-2">Contoh : Kurikulum Merdeka</p> --}}
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalmulai" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tanggal Mulai') }}
                                        </label>
                                        
                                        <div class="@error('tanggalmulai')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($tanggalmulai ?? '') }}"
                                            type="date"
                                                id="tanggalmulai" name="tanggalmulai" aria-describedby="info-tanggalmulai"
                                                 required>
                                                @error('tanggalmulai')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                       
        
        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalakhir" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tanggal Akhir') }}
                                        </label>
                                        
                                      
                                        <div class="@error('tanggalakhir')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($tanggalakhir ?? '') }}"
                                            type="date"
                                                id="tanggalakhir" name="tanggalakhir" aria-describedby="info-tanggalakhir"
                                                 required>
                                                @error('tanggalakhir')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Status') }}
                                        </label>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ket" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Keterangan') }}
                                    </label>
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
                            </div>
                            </div>
                          
                            
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Tahun Akademik') }}
                                    </button>

                                    <a href="{{ route('Tahunakademik.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Tahun Akademik?",
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
