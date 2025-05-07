@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | PPDB')

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
                    <h6><i class="fas fa-user-shield"></i> Data Siswa Baru</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <select id="filterYear" class="form-select mb-3" style="width: 200px;">
                            <option value="">-- Filter Tahun --</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>

                        <table class="table align-items-center mb-0"id="users-table">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No.</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Siswa</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th> --}}

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Username</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hak Akses</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pembuatan Akun</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Bukti Pembayaran</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Pembayaran</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th>
                                        <button type="button" id="select-all" class="btn btn-primary btn-sm">
                                            Select All
                                        </button>
                                    </th>

                                </tr>
                            </thead>

                        </table>
                        <button type="button" id="delete-selected" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                        <button id="update-status-btn" class="btn btn-success">Update Status Siswa</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- DataTables & Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('siswabaru.siswabaru') }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: null, // Kolom indeks
                        name: 'id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
                    {
                        data: 'Siswa_Nama',
                        name: 'Siswa_Nama',
                        className: 'text-center'
                    },

                    {
                        data: 'username',
                        name: 'username',
                        className: 'text-center'
                    },
                    {
                        data: 'hakakses',
                        name: 'hakakses',
                        className: 'text-center'
                    },
                    {
                        data: 'Role',
                        name: 'Role',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
                    },
                    {
                        data: 'Tanggal',
                        name: 'Tanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'Status',
                        name: 'Status',
                        className: 'text-center'
                    },
                    {
                        data: 'Ket',
                        name: 'Ket',
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
            }); --}}
            <script>
                $(document).ready(function() {
                    let table = $('#users-table').DataTable({
                        processing: true,
                        serverSide: true,
                        dom: 'Bfrtip', // aktifkan tombol export
                        buttons: [
                            'copyHtml5',
                            {
                                extend: 'excelHtml5',
                                title: 'Data Siswa Baru'
                            }
                        ],
                        ajax: {
                            url: '{{ route('siswabaru.siswabaru') }}',
                            data: function(d) {
                                d.year = $('#filterYear').val(); // kirim parameter tahun ke controller
                            }
                        },
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        columns: [
                            {
                                data: null,
                                name: 'id',
                                className: 'text-center',
                                render: function(data, type, row, meta) {
                                    return meta.row + 1;
                                },
                            },
                            { data: 'Siswa_Nama', name: 'Siswa_Nama', className: 'text-center' },
                            { data: 'username', name: 'username', className: 'text-center' },
                            { data: 'hakakses', name: 'hakakses', className: 'text-center' },
                            { data: 'Role', name: 'Role', className: 'text-center' },
                            { data: 'created_at', name: 'created_at', className: 'text-center' },
                            { data: 'Tanggal', name: 'Tanggal', className: 'text-center' },
                            { data: 'Status', name: 'Status', className: 'text-center' },
                            { data: 'Ket', name: 'Ket', className: 'text-center' },
                            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' },
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
            
                    // Reload table saat filter tahun diganti
                    $('#filterYear').change(function() {
                        table.ajax.reload();
                    });
            

            $('#update-status-btn').on('click', function() {
                let selectedIds = [];
                $('.user-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                // if (selectedIds.length === 0) {
                //     alert('Pilih minimal satu siswa untuk diupdate!');
                //     return;
                // }
                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada User Yang Dipilih',
                        text: 'Pilih minimal satu siswa untuk diupdate menjadi siswa.'
                    });
                    return;
                }

                // Menampilkan konfirmasi SweetAlert
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin memperbarui status siswa yang dipilih menjadi Aktif?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, perbarui!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('siswabaru.updateStatus') }}", // Ganti dengan route update status Anda
                            type: "POST",
                            data: {
                                ids: selectedIds,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Status diperbarui',
                                    text: response.message
                                }).then(() => {
                                    location
                                .reload(); // Reload halaman setelah sukses
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

            $('#select-all').on('click', function() {
                let checkboxes = $('.user-checkbox');
                let allChecked = checkboxes.filter(':checked').length === checkboxes.length;
                checkboxes.prop('checked', !allChecked);
            });
            $(document).on('mouseenter', '[data-bs-toggle="tooltip"]', function() {
                $(this).tooltip();
            });

            // Delete Selected Users
            $('#delete-selected').on('click', function() {
                let selectedIds = $('.user-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada User Yang Dipilih',
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
                            url: '{{ route('siswabaru.delete') }}',
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
                                        'Failed to delete users.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting users.',
                                    'error'
                                );
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

            });

        });
        $('#users-table').on('click', '.edit-user', function(e) {
            e.preventDefault();
            let userId = $(this).data('id'); // Ambil ID pengguna yang ingin diedit

            // Panggil API untuk mendapatkan data pengguna
            $.ajax({
                url: `/users/${userId}/edit`, // URL untuk mendapatkan data pengguna
                method: 'GET',
                success: function(response) {
                    // Misalnya, kita ingin menampilkan data dalam modal
                    let user = response.user;

                    // Isi form atau modal dengan data pengguna
                    $('#editUserModal').find('input[name="username"]').val(user.username);
                    $('#editUserModal').find('input[name="hakakses"]').val(user.hakakses);
                    $('#editUserModal').find('textarea[name="Role"]').val(user.Role.join(', '));
                    $('#editUserModal').find('input[name="siswa_id"]').val(user.siswa_id);
                    $('#editUserModal').modal('show'); // Menampilkan modal edit
                },
                error: function(err) {
                    console.log('Error:', err);
                }
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
@endsection
