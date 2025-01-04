@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Ekstra-Ku')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg- text-white">
                    <h5 class="mb-0">List Ekstrakurikuler</h5>
                </div>

                <div class="card-body">
                    {{-- Tampilkan pesan sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tampilkan pesan error jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('Ekstra-ku.store') }}" id="create-user-form" method="POST">
                        @csrf
                        <h6 class="mb-3">Pilih Ekstrakurikuler:</h6>
                        <div class="row">
                            @foreach($ekstras as $ekstra)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="ekstrakulikuler_id[]" value="{{ $ekstra->id }}" id="ekstra-{{ $ekstra->id }}" class="form-check-input">
                                        <label for="ekstra-{{ $ekstra->id }}" class="form-check-label">{{ $ekstra->namaekstra }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('dashboardSiswa.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
                <h1>tes</h1>
            </div>

            <div class="alert alert-secondary mt-4" role="alert">
                <strong>Keterangan:</strong><br>
                - Jika sudah ada organisasi yang terdaftar, maka tidak bisa menginputkan data kembali.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submit-btn').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Apakah Yakin?',
            text: "Buat Organisasi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gas!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('create-user-form').submit();
            }
        });
    });
</script>

@endsection
