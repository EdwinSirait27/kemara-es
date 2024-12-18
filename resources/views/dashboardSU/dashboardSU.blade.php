@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Dashboard SU')

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
                    <h6><i class="fas fa-user-shield"></i> Role & Hak Akses</h6>

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
                        <button type="button" onclick="window.location='{{ route('dashboardSU.create') }}'" 
    class="btn btn-primary btn-sm">
    Tambah User
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
        ajax: '{{ route('users.dataguru') }}',
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        columns: [
          {
            data: null, // Kolom indeks
            name: 'id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
          // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
          { data: 'Guru_Nama', name: 'Guru_Nama', className: 'text-center' },

          { data: 'username', name: 'username', className: 'text-center' },
            { data: 'hakakses', name: 'hakakses', className: 'text-center' },
            { data: 'Role', name: 'Role', className: 'text-center' },
            { data: 'created_at', name: 'created_at', className: 'text-center' },
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
                    url: '{{ route('users.delete') }}',
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
                $('#editUserModal').find('input[name="guru_id"]').val(user.guru_id);
                $('#editUserModal').modal('show'); // Menampilkan modal edit
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
    {{-- <script>
      $(document).ready(function() {
          let table = $('#users-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{ route('users.data') }}',
              lengthMenu: [
                  [10, 25, 50, 100, -1],
                  [10, 25, 50, 100, "All"]
              ],
              columns: [
                  {
                      data: 'id',
                      name: 'checkbox',
                      orderable: false,
                      searchable: false,
                      className: 'text-center',
                      render: function(data, type, row) {
                          return `<input type="checkbox" class="user-checkbox" value="${row.id}">`;
                      }
                  },
                  { data: 'id', name: 'id', className: 'text-center' },
                  { data: 'Username', name: 'Username', className: 'text-center' },
                  { data: 'Role', name: 'Role', className: 'text-center' },
                  { data: 'created_at', name: 'created_at', className: 'text-center' },
                  {
                      data: 'action',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      className: 'text-center'
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
          $('#delete-selected').on('click', function() {
              let selectedIds = $('.user-checkbox:checked').map(function() {
                  return $(this).val();
              }).get();
      if (selectedIds.length === 0) {
                  alert('Please select at least one user to delete.');
                  return;
              }
              if (confirm('Are you sure you want to delete selected users?')) {
                  $.ajax({
                      url: '{{ route('users.delete') }}',
                      method: 'POST', // Use POST for CSRF compatibility
                      data: {
                          ids: selectedIds,
                          _method: 'DELETE', // Simulate DELETE request
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(response) {
                          if (response.success) {
                              alert(response.message);
                              table.ajax.reload();
                          } else {
                              alert('Failed to delete users.');
                          }
                      },
                      error: function(xhr) {
                          alert('An error occurred while deleting users.');
                          console.error(xhr.responseText);
                      }
                  });
              }
          });
      });
  </script> --}}
@endsection
 {{-- <tbody>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">John Michael</h6>
                      <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Manager</p>
                  <p class="text-xs text-secondary mb-0">Organization</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Alexa Liras</h6>
                      <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programator</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                      <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Executive</p>
                  <p class="text-xs text-secondary mb-0">Projects</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user4">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Michael Levi</h6>
                      <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programator</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user5">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Richard Gran</h6>
                      <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Manager</p>
                  <p class="text-xs text-secondary mb-0">Executive</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Miriam Eric</h6>
                      <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programtor</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
            </tbody> --}}