@extends('layouts.user_type.auth')
@section('title', 'Pemilihan')
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
    </style>


    <div class="container">
        {{-- <h3 class="text-center mb-4">Pemilihan Ketua OSIS</h3> --}}
        <h5 class="font-weight-bolder text-center mb-4">Pemilihan Calon Ketua Osis</h5>
        <p class="mb-1 pt-2 text-bold">Selamat datang di Pemilihan Ketua Osis SMAK KESUMA MATARAM</p>
        <p class=" mb-4" style="text-align: justify;">
            Bacalah profil
            singkat atau visi-misi setiap kandidat, lalu pilih kandidat Ketua OSIS yang Anda dukung dengan mengklik tombol
            pilih atau tanda centang di bawah foto kandidat. Selanjutnya, konfirmasi pilihan Anda dan pastikan sudah benar
            sebelum menekan tombol Vote. Setelah itu, Anda akan menerima notifikasi bahwa voting telah
            selesai.
        </p>
        <hr>
        <br>
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <span class="alert-text text-white">
                        {{ $error }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('Voting.store') }}" id="voteForm">
            @csrf
            <div class="row">
                @foreach ($osiss as $osis)
                    <div class="col-md-4 col-sm-6">
                        <div class="osis-card">
                            <div class="image view view-first">
                                <img src="{{ asset('storage/fotosiswa/' . $osis->siswa->foto) }}"
                                    alt="Foto {{ $osis->siswa->NamaLengkap }}" />
                            </div>
                            <div class="caption">
                                <p><strong>Nama Lengkap:</strong> {{ $osis->siswa->NamaLengkap }}</p>
                                <p><strong>Visi:</strong> {{ $osis->visi }}</p>
                                <p><strong>Misi:</strong> {{ $osis->misi }}</p>
                                <div class="form-check text-center">
                                    <input type="checkbox" name="osis_id[]" value="{{ $osis->id }}"> Pilih
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>

            <div class="text-center vote-button">
                <button type="submit" id="voteButton" class="btn btn-primary">Vote!</button>
            </div>
        </form>
    </div>
    <br>
    <br>
    <hr>
    {{-- disini --}}
    {{-- <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><i class="fas fa-user-shield"></i>Daftar Pemilih</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"id="users-table">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No.</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pemilih</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Calon Ketua Osis</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Waktu Pemilihan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><i class="fas fa-user-shield"></i>Hasil Voting</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"id="users-table1">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No.</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Calon Ketua Osis</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jumlah Suara</th>

                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <!-- Elemen Daftar Pemilih -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><i class="fas fa-user-shield"></i>Daftar Pemilih</h6>
                </div>
                <div class="col-3">
                <label for="NamaLengkapFilter">Filter Calon:</label>
                <select id="NamaLengkapFilter" class="form-control">
                    <option value="">Semua</option>
                    @foreach($osiss as $osis)
                        <option value="{{ $osis->Siswa->NamaLengkap }}">{{ $osis->Siswa->NamaLengkap }}</option>
                    @endforeach
                </select>
            </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="users-table">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No.
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pemilih
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Calon Ketua Osis
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Waktu Pemilihan
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Elemen Hasil Voting -->
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><i class="fas fa-user-shield"></i>Hasil Voting</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="users-table1">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No.
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Calon Ketua Osis
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jumlah Suara
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // $(document).ready(function() {
        //     let table = $('#users-table').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: '{{ route('voting.voting') }}',
                
        //         lengthMenu: [
        //             [10, 25, 50, 100, -1],
        //             [10, 25, 50, 100, "All"]
        //         ],
        //         columns: [{
        //                 data: 'id', // Kolom indeks
        //                 name: 'id',
        //                 className: 'text-center',
        //                 render: function(data, type, row, meta) {
        //                     return meta.row + 1;
        //                 },
        //             },
        //             {
        //                 data: 'Semua_Nama',
        //                 name: 'Semua_Nama',
        //                 className: 'text-center'
        //             },
        //             {
        //                 data: 'SiswaOsis_Nama',
        //                 name: 'SiswaOsis_Nama',
        //                 className: 'text-center'
        //             },
        //             {
        //                 data: 'created_at',
        //                 name: 'created_at',
        //                 className: 'text-center'
        //             }
        //         ]
        //     });
        // });
        $(document).ready(function() {
    let table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("voting.voting") }}',
            data: function(d) {
                d.NamaLengkap = $('#NamaLengkapFilter').val(); // Kirim filter
            }
        },
        columns: [
            { 
                data: null, 
                name: 'index',
                orderable: false, 
                searchable: false,
                className: 'text-center',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Hitung nomor urut
                }
            },
            { data: 'Semua_Nama', name: 'Semua_Nama',className: 'text-center' },
            { data: 'SiswaOsis_Nama', name: 'SiswaOsis_Nama',className: 'text-center' },
            { data: 'created_at', name: 'created_at',className: 'text-center' }
        ]
    });

    // Event listener untuk dropdown filter
    $('#NamaLengkapFilter').change(function() {
        table.ajax.reload(); // Reload DataTables dengan filter baru
    });
});

    </script>
    <script>
        $(document).ready(function() {
            let table = $('#users-table1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('hasil.hasil') }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: 'id', // Kolom indeks
                        name: 'id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'Semua_Nama',
                        name: 'Semua_Nama',
                        className: 'text-center'
                    },
                    {
                        data: 'jumlahsuara',
                        name: 'jumlahsuara',
                        className: 'text-center'
                    }
                ]
            });
        });
    </script>
   <script>
    document.getElementById('voteButton').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah pengiriman form langsung
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Ingin memilih calon ini sebagai masa depan sekolah?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Ragu'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengkonfirmasi, submit form
                document.getElementById('voteForm').submit();
            }
        });
    });
</script>
@endsection
