@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Ekstrakulikuler')

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
                    <h6><i class="fas fa-user-shield"></i> Data Ekstrakulikuler</h6>

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
                                        Tahunakademik</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Semester</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Guru Pembina</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ekstrakulikuler</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Foto</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th> --}}
                                    
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kapasitas</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Dibuat Pada</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                        <th>
                                          <button type="button" id="select-all" class="btn btn-primary btn-sm">
                                              Select All
                                          </button></th> 
                                        <!-- Checkbox untuk select all -->
                                    {{-- <th class="text-secondary opacity-7">Action</th> --}}
                                </tr>
                            </thead>
                           
                        </table>
                        <button type="button" onclick="window.location='{{ route('Ekstrakulikuler.create') }}'" 
    class="btn btn-primary btn-sm">
    Tambah Ekstrakulikuler
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
        ajax: '{{ route('ekstrakulikuler.dataekstrakulikuler') }}',
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        columns: [
          {
            data: 'id', // Kolom indeks
            name: 'id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
        { data: 'Tahun_Nama', name: 'Tahun_Nama', className: 'text-center' },
          { data: 'Semester_Nama', name: 'Semester_Nama', className: 'text-center' },
          // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
          { data: 'Guru_Nama', name: 'Guru_Nama', className: 'text-center' },
          { data: 'namaekstra', name: 'namaekstra', className: 'text-center' },
          {
                            data: 'foto',
                            name: 'foto',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="' + '{{ asset('storage/ekskul') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return '<span>Foto tidak tersedia</span>';
                                }
                            },
                        },
          { data: 'kapasitas', name: 'kapasitas', className: 'text-center' },

          { data: 'status', name: 'status', className: 'text-center' },
            { data: 'ket', name: 'ket', className: 'text-center' },
            { data: 'created_at', name: 'created_at', className: 'text-center' },
            // { data: 'updated_at', name: 'updated_at', className: 'text-center' },
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
                    url: '{{ route('ekstrakulikuler.delete') }}',
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
$('#users-table').on('click', '.edit-ekstrakulikuler', function(e) {
        e.preventDefault();
        let kelasId = $(this).data('id');
        $.ajax({
            url: `/ekstrakulikuler/${ekstrakulikulerId}/edit`,
            method: 'GET',
            success: function(response) {
                let ekstrakulikuler = response.ekstrakulikuler;
                $('#editUserModal').find('input[name="guru_id"]').val(ekstrakulikuler.guru_id);
                $('#editUserModal').find('input[name="foto"]').val(ekstrakulikuler.foto);

                $('#editUserModal').find('input[name="tahunakademik_id"]').val(ekstrakulikuler.tahunakademik_id);
                $('#editUserModal').find('input[name="namaekstra"]').val(ekstrakulikuler.namaekstra);
                $('#editUserModal').find('input[name="kapasitas"]').val(ekstrakulikuler.kapasitas);
                $('#editUserModal').find('input[name="status"]').val(ekstrakulikuler.status);
                $('#editUserModal').find('textarea[name="ket"]').val(ekstrakulikuler.ket);
                $('#editUserModal').modal('show');
            },
            error: function(err) {
                console.log('Error:', err);
            }
        });
    });
</script>
  
@endsection
 