@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Data Guru')

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
                    <h6><i class="fas fa-user-shield"></i>Data Guru</h6>

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
                                        Nama
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tempat Lahir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Lahir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Agama
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jenis Kelamin
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status Pegawai
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nip Nips
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nuptk
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nik
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Npwp
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Sertifikat Pendidik
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Sertifikasi
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jadwal Kenaikan Gaji
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pendidikan Akhir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Tamat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jurusan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tugas Mengajar
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Pensiun
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pangkat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jadwal Kenaikan Pangkat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jabatan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Telephone
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        status
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
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dataguruall.datadataguruall') }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                dom: 'Bfrtip', // Tambahkan ini untuk mengaktifkan tombol
                buttons: [
                    {
                        extend: 'excelHtml5', // Tombol untuk ekspor ke Excel
                        text: 'Export to Excel', // Teks tombol
                        className: 'btn btn-success', // Tambahkan kelas untuk styling
                        title: 'Data Guru', // Nama file Excel
                        exportOptions: {
                            columns: ':visible' // Tentukan kolom yang akan diekspor
                        }
                    }
                ],
                columns: [{
                        data: 'guru_id', 
                        name: 'guru_id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'Nama',
                        name: 'Nama',
                        className: 'text-center'
                    },
                    {
                        data: 'TempatLahir',
                        name: 'TempatLahir',
                        className: 'text-center'
                    },
                    {
                        data: 'TanggalLahir',
                        name: 'TanggalLahir',
                        className: 'text-center'
                    },
                    {
                        data: 'Agama',
                        name: 'Agama',
                        className: 'text-center'
                    },
                    {
                        data: 'JenisKelamin',
                        name: 'JenisKelamin',
                        className: 'text-center'
                    },
                    {
                        data: 'StatusPegawai',
                        name: 'StatusPegawai',
                        className: 'text-center'
                    },
                    {
                        data: 'NipNips',
                        name: 'NipNips',
                        className: 'text-center'
                    },
                    {
                        data: 'Nuptk',
                        name: 'Nuptk',
                        className: 'text-center'
                    },
                    {
                        data: 'Nik',
                        name: 'Nik',
                        className: 'text-center'
                    },
                    {
                        data: 'Npwp',
                        name: 'Npwp',
                        className: 'text-center'
                    },
                    {
                        data: 'NomorSertifikatPendidik',
                        name: 'NomorSertifikatPendidik',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunSertifikasi',
                        name: 'TahunSertifikasi',
                        className: 'text-center'
                    },
                    {
                        data: 'jadwalkenaikangaji',
                        name: 'jadwalkenaikangaji',
                        className: 'text-center'
                    },
                    {
                        data: 'PendidikanAkhir',
                        name: 'PendidikanAkhir',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunTamat',
                        name: 'TahunTamat',
                        className: 'text-center'
                    },
                    {
                        data: 'Jurusan',
                        name: 'Jurusan',
                        className: 'text-center'
                    },
                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunPensiun',
                        name: 'TahunPensiun',
                        className: 'text-center'
                    },
                    {
                        data: 'Pangkat',
                        name: 'Pangkat',
                        className: 'text-center'
                    },
                    {
                        data: 'jadwalkenaikanpangkat',
                        name: 'jadwalkenaikanpangkat',
                        className: 'text-center'
                    },
                    {
                        data: 'Jabatan',
                        name: 'Jabatan',
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
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    }

                ]
            });
        });
    </script> 
@endsection
