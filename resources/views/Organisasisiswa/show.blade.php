@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Daftar Organisasi')
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
                    
                    <h3><i class="fas fa-user-shield"></i> Daftar Organisasi
                    {{ e($organisasisiswa->Organisasi->namaorganisasi) }}</h6>
                    <h4>Tahun Akademik : {{ e($organisasisiswa->Organisasi->Tahunakademik->tahunakademik) }}</h4>
                    <h4>Semester : {{ e($organisasisiswa->Organisasi->Tahunakademik->semester) }}</h4>
                    <h4>Guru Pembina : {{ e($organisasisiswa->Organisasi->Guru->Nama) }}</h4>
                    <h4>Kapasitas Organisasi: {{ e($organisasisiswa->Organisasi->kapasitas) }} Siswa</h4>

                    <br>
                    <br>
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
                                      
                                              <th>
                                                <button type="button" id="select-all" class="btn btn-primary btn-sm">
                                                    Select All
                                                </button></th> 
                                        
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @if ($ekstrasiswa)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="siswa_id[]">
                                        </td>
                                        <td>{{ $ekstrasiswa->Siswa->NamaLengkap }}</td>
                                    </tr>
                                @endif
                                </tbody> --}}
                            </table>
                        <div class="form-group mb-0 ms-3">
                                <button type="button" id="delete-selected" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                           
                            {{-- <a href="{{ route('ekstrasiswa.index') }}" class="btn btn-secondary">
                                {{ __('Kembali') }}
                            </a> --}}
                         
                             
                            
                                            </div>
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
                
                ajax: '{{ route("getorganisasisiswadetail.getorganisasisiswadetail", $hashedId) }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'NamaLengkap',
                        name: 'NamaLengkap',
                        className: 'text-center',
                        defaultContent: '-'
                    },
                   
                    {
                        data: 'id',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="user-checkbox" value="${row.siswa_id}">`;
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

            $('#delete-selected').on('click', function() {
                let selectedsiswa_Ids = $('.user-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedsiswa_Ids.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada Siswa Yang Dipilih',
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
                            url: '{{ route('organisasisiswashow.hapus') }}',
                            method: 'POST',
                            data: {
                                siswa_ids: selectedsiswa_Ids,
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
                                    'An error occurred while deleting siswa.',
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
@endsection
{{-- ajax: '{{ route('getekstrasiswadetail.getekstrasiswadetail') }}', --}}