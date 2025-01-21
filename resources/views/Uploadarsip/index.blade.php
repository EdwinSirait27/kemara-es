@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Arsip')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Upload Arsip Siswa') }}</div>

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

                        <form action="{{ route('Uploadarsip.store') }}" id="create-user-form" method="POST" enctype="multipart/form-data">    @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file" class="form-control-label">{{ __('Upload File Excel') }}</label>
                                        <div class="@error('file')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="file" name="file" id="file" required>
                                                @error('file')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">tipe file : .xlsx</p>


                                     
                                        </div>
                                    </div>
                                </div>
                               
                               
                                <div class="form-group mb-0 d-flex justify-content-between align-items-center">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Upload') }}
                                    </button>
                                    <a href="{{ route('Siswaarsip.indexArsipall') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                                
                        </form>
                        
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Upload?",
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
                <div class="alert alert-secondary mx-4" role="alert">
                    <span class="text-white">
                        <strong>Keterangan</strong> <br>
                    </span>
                    <span class="text-white">-
                        <strong> Jika sudah ada Calon Ketua Osis yang sudah terdaftar, maka tidak bisa menginputkan data kembali </strong>
                         <br>
                       
                            <br>
        
                    </span>
                </div>
            </div>
        </div>
    </div>

@endsection
