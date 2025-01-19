@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Data Mengajar')

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
                    <h6><i class="fas fa-user-shield"></i> Data Mengajar</h6>

                </div>
                <div class="mb-1 col-1">
                    <label for="filter-hari" class="form-label">Filter Hari</label>
                    <select id="filter-hari" class="form-select">
                        <option value="">Semua Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
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
                                        Nama Guru</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mata Pelajaran</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hari</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Awal Pelajaran</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Akhir Pelajaran</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Awal Istirahat</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Akhir Istirahat</th>
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
                                    <!-- Checkbox untuk select all -->
                                    {{-- <th class="text-secondary opacity-7">Action</th> --}}
                                </tr>
                            </thead>

                        </table>
                        <button type="button" onclick="window.location='{{ route('Datamengajar.create') }}'"
                            class="btn btn-primary btn-sm">
                            Tambah Data Mengajar
                        </button>

                        {{-- <a href="{{ route('dashboardSU.create') }}" class="btn btn-primary mb-3">
                          Create New User
                      </a> --}}
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
                ajax: {
            url: "{{ route('datamengajar.datamengajar') }}",
            data: function (d) {
                d.hari = $('#filter-hari').val(); // Tambahkan parameter hari
            }
        },
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
                        data: 'Guru_Nama',
                        name: 'Guru_Nama',
                        className: 'text-center'
                    },
                    {
                        data: 'Mata_Nama',
                        name: 'Mata_Nama',
                        className: 'text-center'
                    },
                    
                    {
                        data: 'hari',
                        name: 'hari',
                        className: 'text-center'
                    },
                    {
                        data: 'awalpel',
                        name: 'awalpel',
                        className: 'text-center'
                    },
                    {
                        data: 'akhirpel',
                        name: 'akhirpel',
                        className: 'text-center'
                    },
                    {
                        data: 'awalis',
                        name: 'awalis',
                        className: 'text-center'
                    },
                    {
                        data: 'akhiris',
                        name: 'akhiris',
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
            $('#filter-hari').change(function () {
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
        $('#users-table').on('click', '.edit-datamengajar', function(e) {
            e.preventDefault();
            let datamengajarId = $(this).data('id');
            $.ajax({
                url: `/datamengajar/${datamengajarId}/edit`,
                method: 'GET',
                success: function(response) {
                    let datamengajar = response.datamengajar;
                    $('#editUserModal').find('input[name="guru_id"]').val(datamengajar.guru_id);
                    $('#editUserModal').find('input[name="matapelajaran_id"]').val(datamengajar.matapelajaran_id);
                    $('#editUserModal').find('textarea[name="hari"]').val(datamengajar.hari);
                    $('#editUserModal').find('textarea[name="awalpel"]').val(datamengajar.awalpel);
                    $('#editUserModal').find('textarea[name="akhirpel"]').val(datamengajar.akhirpel);
                    $('#editUserModal').find('textarea[name="awalis"]').val(datamengajar.awalis);
                    $('#editUserModal').find('textarea[name="akhiris"]').val(datamengajar.akhiris);
                    $('#editUserModal').find('textarea[name="ket"]').val(datamengajar.ket);
                    $('#editUserModal').modal('show');
                },
                error: function(err) {
                    console.log('Error:', err);
                }
            });
        });
    </script>
@if(session('warning'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: '{{ session('warning') }}',
    });
</script>
@endif
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'berhasil',
        text: '{{ session('success') }}',
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
    });
</script>
@endif
@endsection
