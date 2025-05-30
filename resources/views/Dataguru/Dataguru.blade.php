@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Data Guru')

@section('content')
    <style>
        .text-center {
            text-align: center;
        }

        /* Responsif untuk Tablet */
        @media screen and (max-width: 768px) {
            .modal-content {
                width: 80%;
                /* Lebih besar di tablet */
            }
        }

        /* Responsif untuk HP */
        @media screen and (max-width: 480px) {
            .modal-content {
                width: 90%;
                /* Hampir full screen di HP */
                padding: 15px;
            }

            .close {
                font-size: 20px;
                /* Ukuran tombol close lebih kecil */
            }
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
                                        Foto</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th> --}}

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Lengkap</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tugas Mengajar</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nomor Telephone</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>

                                    <!-- Checkbox untuk select all -->
                                    {{-- <th class="text-secondary opacity-7">Action</th> --}}
                                </tr>
                            </thead>

                        </table>
                        <button type="button" onclick="window.location='{{ route('Dataguruall.index') }}'"
                            class="btn btn-primary btn-sm">
                            Lihat Detail
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dataguru.datadataguru') }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: 'guru_id', // Kolom indeks
                        name: 'guru_id',
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
                            let imageUrl = data ? '{{ asset('storage/fotoguru') }}/' + data :
                                '{{ asset('storage/fotoguru/we.jpg') }}';
                            return '<a href="#" class="open-image-modal" data-src="' + imageUrl +
                                '">' +
                                '<img src="' + imageUrl +
                                '" width="100" style="cursor:pointer;" />' +
                                '</a>';
                        }
                    },

                    {
                        data: 'Nama',
                        name: 'Nama',
                        className: 'text-center'
                    },

                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar',
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });
        });
        $('#users-table').on('click', '.edit-dataguru', function(e) {
            e.preventDefault();

            let dataguruId = $(this).data('guru_id');

            $.ajax({
                url: `/dataguru/${dataguruId}/edit`,
                method: 'GET',
                success: function(response) {
                    if (response.guru) {
                        let dataguru = response.guru;

                        $('#editUserModal').find('input[name="foto"]').val(dataguru.foto);
                        $('#editUserModal').find('input[name="Nama"]').val(dataguru.Nama);
                        $('#editUserModal').find('input[name="TempatLahir"]').val(dataguru.TempatLahir);
                        $('#editUserModal').find('input[name="TanggalLahir"]').val(dataguru
                            .TanggalLahir);
                        $('#editUserModal').find('input[name="Agama"]').val(dataguru.Agama);
                        $('#editUserModal').find('input[name="JenisKelamin"]').val(dataguru
                            .JenisKelamin);
                        $('#editUserModal').find('input[name="StatusPegawai"]').val(dataguru
                            .StatusPegawai);
                        $('#editUserModal').find('input[name="NipNips"]').val(dataguru.NipNips);
                        $('#editUserModal').find('input[name="Nuptk"]').val(dataguru.Nuptk);
                        $('#editUserModal').find('input[name="Nik"]').val(dataguru.Nik);
                        $('#editUserModal').find('input[name="Npwp"]').val(dataguru.Npwp);
                        $('#editUserModal').find('input[name="NomorSertifikatPendidik"]').val(dataguru
                            .NomorSertifikatPendidik);
                        $('#editUserModal').find('input[name="TahunSertifikasi"]').val(dataguru
                            .TahunSertifikasi);
                        $('#editUserModal').find('input[name="jadwalkenaikangaji"]').val(dataguru
                            .jadwalkenaikangaji);
                        $('#editUserModal').find('input[name="PendidikanAkhir"]').val(dataguru
                            .PendidikanAkhir);
                        $('#editUserModal').find('input[name="TahunTamat"]').val(dataguru.TahunTamat);
                        $('#editUserModal').find('input[name="Jurusan"]').val(dataguru.Jurusan);
                        $('#editUserModal').find('input[name="TugasMengajar"]').val(dataguru
                            .TugasMengajar);
                        $('#editUserModal').find('input[name="TahunPensiun"]').val(dataguru
                            .TahunPensiun);
                        $('#editUserModal').find('input[name="Pangkat"]').val(dataguru.Pangkat);
                        $('#editUserModal').find('input[name="jadwalkenaikanpangkat"]').val(dataguru
                            .jadwalkenaikanpangkat);
                        $('#editUserModal').find('input[name="Jabatan"]').val(dataguru.Jabatan);
                        $('#editUserModal').find('input[name="NomorTelephone"]').val(dataguru
                            .NomorTelephone);
                        $('#editUserModal').find('input[name="Alamat"]').val(dataguru.Alamat);
                        $('#editUserModal').find('input[name="Email"]').val(dataguru.Email);
                        $('#editUserModal').find('input[name="status"]').val(dataguru.status);

                        // Tambahkan field lain sesuai kebutuhan

                        // Tampilkan modal
                        $('#editUserModal').modal('show');
                    } else {
                        alert('Data guru tidak ditemukan.');
                    }
                },
                error: function(err) {
                    console.error('Error:', err);
                    alert('Terjadi kesalahan saat mengambil data guru.');
                }
            });
        });

        $(document).on('click', '.open-image-modal', function(e) {
            e.preventDefault();
            let imgSrc = $(this).data('src');
            Swal.fire({
                imageUrl: imgSrc,
                imageAlt: 'Alumni Photo',
                showConfirmButton: false,
                showCloseButton: true,
                width: 'auto'
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('warning') }}',
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

@endsection
