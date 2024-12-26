@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Pengaturan Kelas')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat  Pengaturan Kelas') }}</div>
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
                        <form method="POST" id="create-user-form" action="{{ route('Kelassiswa.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pengaturankelas_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                        </label>
                                        <div class="@error('pengaturankelas_id')border border-danger rounded-3 @enderror">
                                            <select name="pengaturankelas_id" id="pengaturankelas_id" class="form-select">
                                                <option value="" selected disabled>Pilih Tahun</option>
                                                @foreach ($pengaturans as $pengaturan)
                                                    <option value="{{ $pengaturan->id }}">Tahun Akademik : {{ $pengaturan->Tahunakademik->tahunakademik }} Semester : {{ $pengaturan->Tahunakademik->semester }} Kelas : {{$pengaturan->Kelas->kelas}}</option>
                                                @endforeach
                                            </select>
                                            @error('pengaturankelas_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <h5>Pilih Siswa</h5>
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label"></label>
                                    <table id="siswaTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Lengkap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siswas as $siswa)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="siswa_id[]" value="{{ $siswa->siswa_id }}">
                                                </td>
                                                <td>{{ $siswa->NamaLengkap }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                
                               {{-- ini punya data awal --}}
                            </div>
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Masukkan Siswa') }}
                                    </button>

                                    <a href="{{ route('Kelassiswa.index') }}" class="btn btn-secondary">
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
                                    text: "Buat Pengaturan Kelas?",
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
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        
                        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#siswaTable').DataTable();

                                
                            });


                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection