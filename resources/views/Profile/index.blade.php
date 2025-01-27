@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Profile')

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
                    <h6><i class="fas fa-user-shield"></i> Data Profile Sekolah</h6>
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
                                        Pembuat</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Header</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Body</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 1</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 2</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 3</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 4</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 5</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 6</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 7</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar 8</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>

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
                        <button type="button" onclick="window.location='{{ route('Profile.create') }}'"
                            class="btn btn-primary btn-sm">
                            Buat
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
                ajax: '{{ route('profile.profile') }}',
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
                        data: 'Guru_Nama',
                        name: 'Guru_Nama',
                        className: 'text-center'
                    },
                    // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
                    {
                        data: 'header',
                        name: 'header',
                        className: 'text-center'
                    },
                    {
    data: 'body',
    name: 'body',
    className: 'text-center',
    render: function (data, type, row) {
        if (data) {
            let words = data.split(' '); // Memecah teks menjadi array berdasarkan spasi
            let formattedBody = ''; // Inisialisasi teks hasil format
            for (let i = 0; i < words.length; i += 10) {
                formattedBody += words.slice(i, i + 10).join(' ') + '<br>'; // Gabungkan setiap 25 kata dan tambahkan baris baru
            }
            return `<div style="text-align: justify;">${formattedBody}</div>`; // Tambahkan gaya justify
        }
        return data;
    }
},


                    // {
                    //     data: 'body',
                    //     name: 'body',
                    //     className: 'text-center'
                    // },
                    {
                            data: 'gambar1',
                            name: 'gambar1',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar2',
                            name: 'gambar2',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar3',
                            name: 'gambar3',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar4',
                            name: 'gambar4',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar5',
                            name: 'gambar5',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar6',
                            name: 'gambar6',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar7',
                            name: 'gambar7',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
                    {
                            data: 'gambar8',
                            name: 'gambar8',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/profile') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
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
                        title: 'Tidak Ada profile Yang Dipilih',
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
                            url: '{{ route('profile.delete') }}',
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
                                        'Failed to delete profile.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting profile.',
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
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('warning') }}',
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Good...',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
@endsection
