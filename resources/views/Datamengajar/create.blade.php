@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Data Mengajar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat Data Mengajar') }}</div>
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
                        <form method="POST" id="create-user-form" action="{{ route('Datamengajar.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="guru_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Nama Guru') }}
                                        </label>
                                        <div class="@error('guru_id')border border-danger rounded-3 @enderror">
                                            <select name="guru_id" id="guru_id" class="form-select">
                                                <option value="" selected disabled>Pilih Guru</option>
                                                @foreach ($gurus as $guru)
                                                    <option value="{{ $guru->guru_id }}">{{ $guru->guru_id }}-{{ $guru->Nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('guru_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>
                      

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="matapelajaran_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Mata Pelajaran') }}
                                        </label>
                                        <div class="@error('matapelajaran_id')border border-danger rounded-3 @enderror">
                                            <select name="matapelajaran_id" id="matapelajaran_id" class="form-select">
                                                <option value="" selected disabled>Pilih Mata Pelajaran</option>
                                                @foreach ($matpels as $mata)
                                                    <option value="{{ $mata->id }}">{{ $mata->id }}-{{ $mata->matapelajaran }}</option>
                                                @endforeach
                                            </select>
                                            @error('matapelajaran_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>
                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hari" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Hari') }}
                                        </label>
                                        <div class="@error('hari')border border-danger rounded-3 @enderror">
                                            <select class="form-control" name="hari" id="hari" required>
                                                <option value="" disabled selected>Pilih Hari</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                
                                            </select>
                                            @error('hari')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                              
                                       
        
        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="awalpel" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Awal Pelajran') }}
                                        </label>
                                        
                                      
                                        <div class="@error('awalpel')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($awalpel ?? '') }}"
                                            type="time"
                                                id="awalpel" name="awalpel" aria-describedby="info-awalpel"
                                                 required>
                                                @error('awalpel')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akhirpel" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Akhir Pelajaran') }}
                                        </label>
                                        
                                      
                                        <div class="@error('akhirpel')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($akhirpel ?? '') }}"
                                            type="time"
                                                id="akhirpel" name="akhirpel" aria-describedby="info-akhirpel"
                                                 required>
                                                @error('akhirpel')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror                             
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="awalis" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Awal Istirahat') }}
                                        </label>
                                        
                                      
                                        <div class="@error('awalis')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($awalis ?? '') }}"
                                            type="time"
                                                id="awalis" name="awalis" aria-describedby="info-awalis"
                                                 required>
                                                @error('awalis')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akhiris" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Akhir Istirahat') }}
                                        </label>
                                        
                                      
                                        <div class="@error('akhiris')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($akhiris ?? '') }}"
                                            type="time"
                                                id="akhiris" name="akhiris" aria-describedby="info-akhiris"
                                                 required>
                                                @error('akhiris')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
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
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong> Jika sudah ada Tahun Akademik yang sama dengan nilai semester Ganjil dan Genap, maka tidak bisa menginputkan data kembali </strong> <br>
                               
                                    <br>
                
                            </span>
                        </div>
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