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
                    <h6><i class="fas fa-user-shield"></i>Data Siswa</h6>

                </div>
                <div class="mb-1 col-1">
                    <label for="filter-status" class="form-label">Status</label>
                    <select id="filter-status" class="form-select">
                        <option value="">Semua</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Alumni">Alumni</option>
                    </select>
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
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th>
                                        <button type="button" id="select-all" class="btn btn-primary btn-sm">
                                            Select All
                                        </button>
                                    </th>

                                    <!-- Checkbox untuk select all -->
                                    {{-- <th class="text-secondary opacity-7">Action</th> --}}
                                </tr>
                            </thead>
                        </table>
                        <button type="button" onclick="window.location='{{ route('Datasiswaall.index') }}'"
                            class="btn btn-primary btn-sm">
                            Lihat Detail
                        </button>
                        <button id="update-status-btn" class="btn btn-success">Update Status Lulus</button>


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
                ajax: {
                    url: "{{ route('datasiswa.datadatasiswa') }}",
                    data: function(d) {
                        d.status = $('#filter-status').val(); // Tambahkan parameter hari
                    }
                },
                columns: [{
                        data: 'siswa_id', // Kolom indeks
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
                            let imageUrl = data ? '{{ asset('storage/fotosiswa') }}/' + data :
                                '{{ asset('storage/fotosiswa/we.jpg') }}';
                            return '<a href="#" class="open-image-modal" data-src="' + imageUrl +
                                '">' +
                                '<img src="' + imageUrl +
                                '" width="100" style="cursor:pointer;" />' +
                                '</a>';
                        }
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
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'checkbox',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
                //             $('#filter-status').change(function () {
                //     table.draw(); // Refresh tabel setelah filter diubah
                // });
            });


            $('#select-all').on('click', function() {
                let checkboxes = $('.user-checkbox');
                let allChecked = checkboxes.filter(':checked').length === checkboxes.length;
                checkboxes.prop('checked', !allChecked);
            });
            $(document).on('mouseenter', '[data-bs-toggle="tooltip"]', function() {
                $(this).tooltip();
            });
            $('#filter-status').change(function() {
                table.draw(); // Refresh tabel setelah filter diubah
            });

            // Delete Selected Users
            $('#delete-selected').on('click', function() {
                let selectedIds = $('.user-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada Osis Yang Dipilih',
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
                            url: '{{ route('datamengajar.delete') }}',
                            method: 'POST',
                            data: {
                                ids: selectedIds,
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
                                    'An error occurred while deleting Osis.',
                                    'error'
                                );
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

            });

        });

        $('#users-table').on('click', '.edit-datasiswa', function(e) {
            e.preventDefault();

            let datasiswaId = $(this).data('siswa_id');

            $.ajax({
                url: `/datasiswa/${datasiswaId}/edit`,
                method: 'GET',
                success: function(response) {
                    // Pastikan `response` memiliki data guru yang dibutuhkan
                    if (response.siswa) {
                        let datasiswa = response.siswa;
                        $('#editUserModal').find('input[name="foto"]').val(datasiswa.foto);
                        $('#editUserModal').find('input[name="NamaLengkap"]').val(datasiswa
                        .NamaLengkap);
                        $('#editUserModal').find('input[name="NomorInduk"]').val(datasiswa.NomorInduk);
                        $('#editUserModal').find('input[name="NamaPanggilan"]').val(datasiswa
                            .NamaPanggilan);
                        $('#editUserModal').find('input[name="JenisKelamin"]').val(datasiswa
                            .JenisKelamin);
                        $('#editUserModal').find('input[name="NISN"]').val(datasiswa.NISN);
                        $('#editUserModal').find('input[name="TempatLahir"]').val(datasiswa
                        .TempatLahir);
                        $('#editUserModal').find('input[name="TanggalLahir"]').val(datasiswa
                            .TanggalLahir);
                        $('#editUserModal').find('input[name="Agama"]').val(datasiswa.Agama);
                        $('#editUserModal').find('input[name="Alamat"]').val(datasiswa.Alamat);
                        $('#editUserModal').find('input[name="RT"]').val(datasiswa.RT);
                        $('#editUserModal').find('input[name="RW"]').val(datasiswa.RW);
                        $('#editUserModal').find('input[name="Kelurahan"]').val(datasiswa.Kelurahan);
                        $('#editUserModal').find('input[name="Kecamatan"]').val(datasiswa.Kecamatan);
                        $('#editUserModal').find('input[name="KabKota"]').val(datasiswa.KabKota);
                        $('#editUserModal').find('input[name="Provinsi"]').val(datasiswa.Provinsi);
                        $('#editUserModal').find('input[name="KodePos"]').val(datasiswa.KodePos);
                        $('#editUserModal').find('input[name="Email"]').val(datasiswa.Email);
                        $('#editUserModal').find('input[name="NomorTelephone"]').val(datasiswa
                            .NomorTelephone);
                        $('#editUserModal').find('input[name="Kewarganegaraan"]').val(datasiswa
                            .Kewarganegaraan);
                        $('#editUserModal').find('input[name="NIK"]').val(datasiswa.NIK);
                        $('#editUserModal').find('input[name="GolDarah"]').val(datasiswa.GolDarah);
                        $('#editUserModal').find('input[name="TinggalDengan"]').val(datasiswa
                            .TinggalDengan);
                        $('#editUserModal').find('input[name="StatusSiswa"]').val(datasiswa
                        .StatusSiswa);
                        $('#editUserModal').find('input[name="AnakKe"]').val(datasiswa.AnakKe);
                        $('#editUserModal').find('input[name="SaudaraKandung"]').val(datasiswa
                            .SaudaraKandung);
                        $('#editUserModal').find('input[name="SaudaraTiri"]').val(datasiswa
                        .SaudaraTiri);
                        $('#editUserModal').find('input[name="Tinggicm"]').val(datasiswa.Tinggicm);
                        $('#editUserModal').find('input[name="Beratkg"]').val(datasiswa.Beratkg);
                        $('#editUserModal').find('input[name="RiwayatPenyakit"]').val(datasiswa
                            .RiwayatPenyakit);
                        $('#editUserModal').find('input[name="AsalSD"]').val(datasiswa.AsalSD);
                        $('#editUserModal').find('input[name="AlamatSD"]').val(datasiswa.AlamatSD);
                        $('#editUserModal').find('input[name="NPSNSD"]').val(datasiswa.NPSNSD);
                        $('#editUserModal').find('input[name="KabKotaSD"]').val(datasiswa.KabKotaSD);
                        $('#editUserModal').find('input[name="ProvinsiSD"]').val(datasiswa.ProvinsiSD);
                        $('#editUserModal').find('input[name="NoIjasah"]').val(datasiswa.NoIjasah);
                        $('#editUserModal').find('input[name="DiterimaTanggal"]').val(datasiswa
                            .DiterimaTanggal);
                        $('#editUserModal').find('input[name="DiterimaDiKelas"]').val(datasiswa
                            .DiterimaDiKelas);
                        $('#editUserModal').find('input[name="DiterimaSemester"]').val(datasiswa
                            .DiterimaSemester);
                        $('#editUserModal').find('input[name="MutasiAsalSMP"]').val(datasiswa
                            .MutasiAsalSMP);
                        $('#editUserModal').find('input[name="AlasanPindah"]').val(datasiswa
                            .AlasanPindah);
                        $('#editUserModal').find('input[name="TglIjasahSD"]').val(datasiswa
                        .TglIjasahSD);
                        $('#editUserModal').find('input[name="NamaOrangTuaPadaIjasah"]').val(datasiswa
                            .NamaOrangTuaPadaIjasah);
                        $('#editUserModal').find('input[name="NamaAyah"]').val(datasiswa.NamaAyah);
                        $('#editUserModal').find('input[name="TahunLahirAyah"]').val(datasiswa
                            .TahunLahirAyah);
                        $('#editUserModal').find('input[name="AlamatAyah"]').val(datasiswa.AlamatAyah);
                        $('#editUserModal').find('input[name="NomorTelephoneAyah"]').val(datasiswa
                            .NomorTelephoneAyah);
                        $('#editUserModal').find('input[name="AgamaAyah"]').val(datasiswa.AgamaAyah);
                        $('#editUserModal').find('input[name="PendidikanTerakhirAyah"]').val(datasiswa
                            .PendidikanTerakhirAyah);
                        $('#editUserModal').find('input[name="PekerjaanAyah"]').val(datasiswa
                            .PekerjaanAyah);
                        $('#editUserModal').find('input[name="PenghasilanAyah"]').val(datasiswa
                            .PenghasilanAyah);
                        $('#editUserModal').find('input[name="NamaIbu"]').val(datasiswa.NamaIbu);
                        $('#editUserModal').find('input[name="TahunLahirIbu"]').val(datasiswa
                            .TahunLahirIbu);
                        $('#editUserModal').find('input[name="AlamatIbu"]').val(datasiswa.AlamatIbu);
                        $('#editUserModal').find('input[name="NomorTelephoneIbu"]').val(datasiswa
                            .NomorTelephoneIbu);
                        $('#editUserModal').find('input[name="AgamaIbu"]').val(datasiswa.AgamaIbu);
                        $('#editUserModal').find('input[name="PendidikanTerakhirIbu"]').val(datasiswa
                            .PendidikanTerakhirIbu);
                        $('#editUserModal').find('input[name="PekerjaanIbu"]').val(datasiswa
                            .PekerjaanIbu);
                        $('#editUserModal').find('input[name="PenghasilanIbu"]').val(datasiswa
                            .PenghasilanIbu);
                        $('#editUserModal').find('input[name="NamaWali"]').val(datasiswa.NamaWali);
                        $('#editUserModal').find('input[name="TahunLahirWali"]').val(datasiswa
                            .TahunLahirWali);
                        $('#editUserModal').find('input[name="AlamatWali"]').val(datasiswa.AlamatWali);
                        $('#editUserModal').find('input[name="NomorTelephoneWali"]').val(datasiswa
                            .NomorTelephoneWali);
                        $('#editUserModal').find('input[name="AgamaWali"]').val(datasiswa.AgamaWali);
                        $('#editUserModal').find('input[name="PendidikanTerakhirWali"]').val(datasiswa
                            .PendidikanTerakhirWali);
                        $('#editUserModal').find('input[name="PekerjaanWali"]').val(datasiswa
                            .PekerjaanWali);
                        $('#editUserModal').find('input[name="WaliPenghasilan"]').val(datasiswa
                            .WaliPenghasilan);
                        $('#editUserModal').find('input[name="StatusHubunganWali"]').val(datasiswa
                            .StatusHubunganWali);
                        $('#editUserModal').find('input[name="MenerimaBeasiswaDari"]').val(datasiswa
                            .MenerimaBeasiswaDari);
                        $('#editUserModal').find('input[name="TahunMeninggalkanSekolah"]').val(datasiswa
                            .TahunMeninggalkanSekolah);
                        $('#editUserModal').find('input[name="AlasanSebab"]').val(datasiswa
                        .AlasanSebab);
                        $('#editUserModal').find('input[name="TamatBelajarTahun"]').val(datasiswa
                            .TamatBelajarTahun);
                        $('#editUserModal').find('input[name="InformasiLain"]').val(datasiswa
                            .InformasiLain);
                        $('#editUserModal').find('input[name="status"]').val(datasiswa.status);

                        $('#editUserModal').modal('show');
                    } else {
                        alert('Data Siswa tidak ditemukan.');
                    }
                },
                error: function(err) {
                    console.error('Error:', err);
                    alert('Terjadi kesalahan saat mengambil data siswa.');
                }
            });
        });
        $('#select-all').on('click', function() {
            let checkboxes = $('.user-checkbox');
            let allChecked = checkboxes.filter(':checked').length === checkboxes.length;
            checkboxes.prop('checked', !allChecked);
        });
        $(document).on('mouseenter', '[data-bs-toggle="tooltip"]', function() {
            $(this).tooltip();
        });


        $('#update-status-btn').on('click', function() {
            let selectedIds = [];
            $('.user-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                alert('Pilih minimal satu siswa untuk diupdate!');
                return;
            }

            // Menampilkan konfirmasi SweetAlert
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin memperbarui status siswa yang dipilih?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('Datasiswa.updateStatus') }}", // Ganti dengan route update status Anda
                        type: "POST",
                        data: {
                            siswa_ids: selectedIds,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status diperbarui',
                                text: response.message
                            }).then(() => {
                                location.reload(); // Reload halaman setelah sukses
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan',
                                text: 'Terjadi kesalahan saat memperbarui status!'
                            });
                        }
                    });
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
