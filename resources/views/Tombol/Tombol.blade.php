@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tombol')

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
                    <h6><i class="fas fa-user-shield"></i> Data Tombol</h6>

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
                                        URL</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Mulai</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Berakhir</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Deskripsi</th>
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
                        <button type="button" onclick="window.location='{{ route('Tombol.create') }}'"
                            class="btn btn-primary btn-sm">
                            Tambah Tombol
                        </button>
                        <button type="button" id="delete-selected" class="btn btn-danger btn-sm">
                            Delete
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
                ajax: '{{ route('tombol.datatombol') }}',
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
                    // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
                    {
                        data: 'url',
                        name: 'url',
                        className: 'text-center'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        className: 'text-center'
                    },

                    {
                        data: 'end_date',
                        name: 'end_date',
                        className: 'text-center'
                    },
                    {
                        data: 'ket',
                        name: 'ket',
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
                        title: 'Tidak Ada URL Yang Dipilih',
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
                            url: '{{ route('tombol.delete') }}',
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
                                        'Failed to delete tombol.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting tombol.',
                                    'error'
                                );
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

            });

        });
        $('#users-table').on('click', '.edit-tombol', function(e) {
            e.preventDefault();
            let tombolId = $(this).data('id');
            $.ajax({
                url: `/tombol/${tombolId}/edit`,
                method: 'GET',
                success: function(response) {
                    let tombol = response.tombol;
                    $('#editUserModal').find('input[name="url"]').val(tombol
                        .url);
                    $('#editUserModal').find('input[name="start_date"]').val(tombol.start_date);
                    $('#editUserModal').find('input[name="end_date"]').val(tombol.end_date);
                    $('#editUserModal').find('input[name="ket"]').val(tombol.ket);
                    $('#editUserModal').modal('show');
                },
                error: function(err) {
                    console.log('Error:', err);
                }
            });
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection
