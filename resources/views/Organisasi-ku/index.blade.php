@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Organisasi-Ku')
@section('content')
@if ($tombol)
    
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg- text-white">
                        <h5 class="mb-0">Daftar Organisasi</h5>
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

                        <form action="{{ route('Organisasi-ku.store') }}" id="create-user-form" method="POST">
                            @csrf
                            <h6 class="mb-3">Pilih Organisasi:</h6>
                            <div class="row">
                                @foreach ($organs as $organ)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="organisasi_id[]" value="{{ $organ->id }}"
                                                id="organ-{{ $organ->id }}" class="form-check-input">
                                            <label for="organ-{{ $organ->id }}"
                                                class="form-check-label">{{ $organ->namaorganisasi }}</label>
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
                </div>

                

            </div>
        </div>
    </div>
    
@else
    
@endif
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg- text-white">
                        <h5 class="mb-0">List Organsasi Anda</h5>
                    </div>

                    {{-- <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

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
                                @foreach ($ekstras as $ekstra)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="ekstrakulikuler_id[]" value="{{ $ekstra->id }}"
                                                id="ekstra-{{ $ekstra->id }}" class="form-check-input">
                                            <label for="ekstra-{{ $ekstra->id }}"
                                                class="form-check-label">{{ $ekstra->namaekstra }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('dashboardSiswa.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div> --}}
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"id="users-table">
                            <thead>
                                <tr>
                                    <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          No.</th>
                                      <th
                                          class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                          Organisasi</th>
                                    
                                          <th>
                                            <button type="button" id="select-all" class="btn btn-primary btn-sm">
                                                Select All
                                            </button></th> 
                                    
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @if ($kelassiswa)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="siswa_id[]">
                                    </td>
                                    <td>{{ $kelassiswa->Siswa->NamaLengkap }}</td>
                                </tr>
                            @endif
                            </tbody> --}}
                        </table>
                        @if ($tombol)
                        <button type="button" id="delete-selected" class="btn btn-danger btn-sm">
                            Delete
                        </button> 
                        @else
                        @endif
                </div>

                </div>
                <div class="alert alert-secondary mt-4" role="alert">
                    <strong>Keterangan:</strong><br>
                    - Silahkan di centang agar bisa mendaftarkan diri anda ke sebuah Organisasi.

                </div>
               

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
                    document.getElementById('create-user-form').submit();
                }
            });
        });
        </script>
   <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                
                ajax: '{{ route('getorganisasiku.getorganisasiku') }}',
       
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'Organisasi_Nama',
                        name: 'Organisasi_Nama',
                        className: 'text-center',
                        defaultContent: '-'
                    },
                    {
                        data: 'id',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="user-checkbox" value="${row.id}">`;
                        }
                    }
                ]
            });
            $('#select-all').on('click', function() {
                let checkboxes = $('.user-checkbox');
                let allChecked = checkboxes.filter(':checked').length === checkboxes.length;
                checkboxes.prop('checked', !allChecked);
            });
            $(document).on('mouseenter', '[data-bs-toggle="tooltip"]', function() {
                $(this).tooltip();
            });

            $('#delete-selected').on('click', function() {
                let selected_Ids = $('.user-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selected_Ids.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada Ekstrakulikuler Yang Dipilih',
                        text: 'Tolong Pilih Salah Satu.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Tidak Bisa Diubah Lagi Jika di di Delete!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Iya, Delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('organisasiku.hapus') }}',
                            method: 'POST',
                            data: {
                                ids: selected_Ids,
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    );
                                    table.ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        'Failed to delete Osis.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting siswa.',
                                    'error'
                                );
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection
