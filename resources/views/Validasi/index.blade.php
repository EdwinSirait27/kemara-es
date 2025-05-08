@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Valdiasi')

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
                    <h6><i class="fas fa-user-shield"></i> Data Validasi</h6>

                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filter-status">Filter Status:</label>
                        <select id="filter-status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            @foreach ($statusList as $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
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
                                        Nama Siswa</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Bukti Upload</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Pembuatan Akun</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Keterangan</th>
                                 
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                        <th>
                                 
                                </tr>
                            </thead>
                           
                        </table>
                        <button type="button" onclick="window.location='{{ route('dashboardAdmin.index') }}'" 
    class="btn btn-primary btn-sm">
    Kembali
</button>

                      </div>
                    </div>
                  </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
{{-- <script>
    $(document).ready(function() {
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("validasi.validasi") }}',
                data: function (d) {
                    d.status = $('#filter-status').val();
                }
            },
            columns: [
                {
            data: 'id', 
            name: 'id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
        { data: 'Siswa_Nama', name: 'Siswa_Nama', className: 'text-center' },
          { data: 'status', name: 'status', className: 'text-center' },
          { data: 'tanggalbukti', name: 'tanggalbukti', className: 'text-center' },
          { data: 'created_at', name: 'created_at', className: 'text-center' },
          { data: 'ket', name: 'ket', className: 'text-center' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
              }
            ]
        });
    
        $('#filter-status').on('change', function () {
            table.ajax.reload();
        });
    });
    </script> --}}
    <script>
        $(document).ready(function () {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("validasi.validasi") }}',
                    data: function (d) {
                        d.status = $('#filter-status').val();
                    }
                },
                columns: [
                    {
            data: 'id', 
            name: 'id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
        { data: 'Siswa_Nama', name: 'Siswa_Nama', className: 'text-center' },
          { data: 'status', name: 'status', className: 'text-center' },
          { data: 'tanggalbukti', name: 'tanggalbukti', className: 'text-center' },
          { data: 'created_at', name: 'created_at', className: 'text-center' },
          { data: 'ket', name: 'ket', className: 'text-center' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
              },
                ]
            });
        
            $('#filter-status').change(function () {
                table.ajax.reload();
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
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
    });
</script>
@endif
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Good...',
        text: '{{ session('success') }}',
    });
</script>
@endif
@endsection
 