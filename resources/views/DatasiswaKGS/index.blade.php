@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Data Siswa')

@section('content')
    <style>
        .text-center {
            text-align: center;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    {{-- <h6>Role & Hak Akses</h6> --}}
                    <h6><i class="fas fa-user-shield"></i>Data Siswa</h6>

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
                                        Foto</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Lengkap</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Agama</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nomor Telephone</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
                                   
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
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                let table = $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('datasiswaKGS.datadatasiswaKGS') }}',
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    columns: [
                        {
                            data: 'siswa_id',
                            name: 'siswa_id',
                            className: 'text-center',
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            },
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/fotosiswa') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                        {
                            data: 'NamaLengkap',
                            name: 'NamaLengkap',
                            className: 'text-center'
                        },
                        {
                            data: 'Agama',
                            name: 'Agama',
                            className: 'text-center'
                        },
                        {
                            data: 'NomorTelephone',
                            name: 'NomorTelephone',
                            className: 'text-center'
                        },
                        {
                            data: 'Alamat',
                            name: 'Alamat',
                            className: 'text-center'
                        },
                        {
                            data: 'Email',
                            name: 'Email',
                            className: 'text-center'
                        }
                    ]
                });
            });
        
        </script>
@endsection
