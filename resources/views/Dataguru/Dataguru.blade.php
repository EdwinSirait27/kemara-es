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
        columns: [
          {
            data: 'guru_id', // Kolom indeks
            name: 'guru_id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
          // { data: 'Guru->Nama', name: 'Guru->Nama', className: 'text-center' },
          {
                        data: 'foto',
                        name: 'foto',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data) {
                                return '<img src="' + '{{ asset('storage/fotoguru') }}/' + data +
                                    '" width="100" />';
                            } else {
                                return '<span>Foto tidak tersedia</span>';
                                // return '<img src="' + '{{ asset('storage/fotoguru/we.jpg') }}' + '" width="100" />';
                            }
                        },


                    },
          { data: 'Nama', name: 'Nama', className: 'text-center' },

          { data: 'TugasMengajar', name: 'TugasMengajar', className: 'text-center' },
          { data: 'NomorTelephone', name: 'NomorTelephone', className: 'text-center' },
          { data: 'Alamat', name: 'Alamat', className: 'text-center' },
          { data: 'Email', name: 'Email', className: 'text-center' },
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
            // Pastikan `response` memiliki data guru yang dibutuhkan
            if (response.guru) {
                let dataguru = response.guru;

                // Set nilai form di modal
                $('#editUserModal').find('input[name="Nama"]').val(dataguru.Nama);
                $('#editUserModal').find('input[name="Email"]').val(dataguru.Email);
                $('#editUserModal').find('input[name="TempatLahir"]').val(dataguru.TempatLahir);
                $('#editUserModal').find('input[name="TanggalLahir"]').val(dataguru.TanggalLahir);
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

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('warning'))
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
 