@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Ekstra-Ku')
@section('content')
<style>
    .chart-canvas {
        display: block;
        width: 100%;
        height: 300px;
        z-index: 1;
    }

    .osis-card {
        margin-bottom: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .osis-card:hover {
        transform: scale(1.05);
    }

    .osis-card img {
        width: 80%;
        height: 400px;
        object-fit: cover;
    }

    .osis-card .caption {
        padding: 15px;
        background-color: #f8f9fa;
    }

    .osis-card p {
        margin: 5px 0;
    }

    .vote-button {
        margin-top: 15px;
    }

    .card:hover {
        transform: translateY(-10px);
        transition: transform 0.3s ease;
    }

    .icon {
        font-size: 32px;
        /* Ukuran ikon lebih besar */
        color: #fff;
    }

    .numbers h5 {
        font-size: 1.5rem;
    }

    .col-4.text-center {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .zoomable-image {
    transition: transform 0.3s ease;
    width: auto;
    height: auto;
}
#original-dimensions {
    font-weight: bold;
    color: #4CAF50;
    margin-top: 10px;
}


.zoomable-image:hover {
    transform: scale(1.2); /* Perbesar gambar saat di-hover */
}


</style>

@if ($tombol)
    
    <div class="container mt-4 col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg- text-white">
                        <h5 class="mb-0">Daftar Ekstrakurikuler</h5>
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
                                @foreach ($ekstras as $ekstra)
                                <div class="col-12-md-4 col-sm-6">
                                    <div class="osis-card">
                                        <div class="image view view-first">
                                            {{-- <img src="{{ asset('storage/ekskul/' . $ekstra->foto) }}"
                                                alt="Foto {{ $ekstra->namaekstra }}" /> --}}
                                                <img src="{{ asset('storage/ekskul/' . $ekstra->foto) }}" 
                                                alt="Foto {{ $ekstra->namaekstra }}" 
                                                class="zoomable-image" />
                                           

                                        </div>
                                        <div class="caption">
                                            <p><strong>Ekstrakulikuler:</strong> {{ $ekstra->namaekstra }}</p>
                                            <p><strong>Keterangan:</strong> {{ $ekstra->ket }}</p>
                                            <p><strong>Kapasitas:</strong> {{ $ekstra->kapasitas }}</p>
                                            <div class="form-check text-center">
                                                <input type="checkbox" name="ekstrakulikuler_id[]" value="{{ $ekstra->id }}"
                                                id="ekstra-{{ $ekstra->id }}" class="form-check-input">
                                            <label for="ekstra-{{ $ekstra->id }}"
                                                class="form-check-label">{{ $ekstra->namaekstra }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            @endforeach



                                {{-- @foreach ($ekstras as $ekstra)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="ekstrakulikuler_id[]" value="{{ $ekstra->id }}"
                                                id="ekstra-{{ $ekstra->id }}" class="form-check-input">
                                            <label for="ekstra-{{ $ekstra->id }}"
                                                class="form-check-label">{{ $ekstra->namaekstra }}</label>
                                        </div>
                                    </div>
                                @endforeach --}}
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
                        <h5 class="mb-0">List Ekstrakurikuler Anda</h5>
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
                                          Ekstrakulikuler</th>
                                    
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
                    - Silahkan di centang agar bisa mendaftarkan diri anda ke sebuah Ekstrakulikuler.
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
   <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                
                ajax: '{{ route('getekstraku.getekstraku') }}',
       
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
                        data: 'Ekstra_Nama',
                        name: 'Ekstra_Nama',
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
                            url: '{{ route('ekstraku.hapus') }}',
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
                                        'Failed to delete Ekstrakulikuler.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting Ekstrakulikuler.',
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
