@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Organisasi')

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
                    <h6><i class="fas fa-user-shield"></i> Data Organisasi</h6>

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
                                        Organisasi</th>
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
                        <button type="button" onclick="window.location='{{ route('Organisasi.create') }}'" 
    class="btn btn-primary btn-sm">
    Tambah Organisasi
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
        ajax: '{{ route('organisasi.dataorganisasi') }}',
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
          // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
          { data: 'Tahun_Nama', name: 'Tahun_Nama', className: 'text-center' },
          { data: 'Semester_Nama', name: 'Semester_Nama', className: 'text-center' },
          { data: 'Guru_Nama', name: 'Guru_Nama', className: 'text-center' },
          { data: 'namaorganisasi', name: 'namaorganisasi', className: 'text-center' },
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
                title: 'Tidak Ada Organisasi Yang Dipilih',
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
                    url: '{{ route('organisasi.delete') }}',
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
                                'Failed to delete organisasi.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting organisasi.',
                            'error'
                        );
                        console.error(xhr.responseText);
                    }
                });
            }
        });
        
    });
    
});
$('#users-table').on('click', '.edit-organisasi', function(e) {
        e.preventDefault();
        let kelasId = $(this).data('id');
        $.ajax({
            url: `/organisasi/${organisasiId}/edit`,
            method: 'GET',
            success: function(response) {
                let organisasi = response.organisasi;
                $('#editUserModal').find('input[name="guru_id"]').val(organisasi.guru_id);
                $('#editUserModal').find('input[name="tahunakademik_id"]').val(organisasi.tahunakademik_id);
                $('#editUserModal').find('input[name="namaorganisasi"]').val(organisasi.namaorganisasi);
                $('#editUserModal').find('input[name="kapasitas"]').val(organisasi.kapasitas);
                $('#editUserModal').find('input[name="status"]').val(organisasi.status);
                $('#editUserModal').find('textarea[name="ket"]').val(organisasi.ket);
                $('#editUserModal').modal('show');
            },
            error: function(err) {
                console.log('Error:', err);
            }
        });
    });
</script>
  
@endsection
 