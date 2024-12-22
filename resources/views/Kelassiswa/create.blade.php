@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Tambah Pengaturan Kelas')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Buat  Pengaturan Kelas') }}</div>
                    <div class="card-body">
                        {{-- Tampilkan pesan sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" id="create-user-form" action="{{ route('Kelassiswa.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunakademik_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                        </label>
                                 
                                        <div class="@error('tahunakademik_id')border border-danger rounded-3 @enderror">
                                            <select name="tahunakademik_id" id="tahunakademik_id" class="form-select">
                                                <option value="" selected disabled>Pilih Tahun Akademik</option>
                                                @foreach ($tahuns as $tahun)
                                                    <option value="{{ $tahun->tahunakademik_id }}">{{ $tahun->tahunakademik }}</option>
                                                @endforeach
                                            </select>
                                            @error('tahunakademik_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Kelas') }}
                                        </label>
                                 
                                        <div class="@error('kelas_id')border border-danger rounded-3 @enderror">
                                            <select name="kelas_id" id="kelas_id" class="form-select">
                                                <option value="" selected disabled>Pilih Kelas</option>
                                                @foreach ($kelass as $kelas)
                                                    <option value="{{ $kelas->kelas_id }}">{{ $kelas->kelas }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ket" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Keterangan') }}
                                        </label>
                                        
                                        <div class="@error('ket')border border-danger rounded-3 @enderror">
                                            <input class="form-control"
                                            value="{{ e($ket ?? '') }}"
                                            type="text"
                                                id="ket" name="ket" aria-describedby="info-ket"
                                                 required>
                                                @error('ket')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                       
        
        
                                        </div>
                                    </div>
                                </div>

                                {{-- disini --}}
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            {{-- <h6>Role & Hak Akses</h6> --}}
                                            <h6><i class="fas fa-user-shield"></i> Data Siswa</h6>
                        
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
                                               
                        
                                                
                                              </div>
                                            </div>
                                          </div>
                                </div>
                                {{-- data mengajar --}}
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            {{-- <h6>Role & Hak Akses</h6> --}}
                                            <h6><i class="fas fa-user-shield"></i> Data Mata Pelajaran</h6>
                        
                                        </div>
                                        <div class="card-body px-0 pt-0 pb-2">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center mb-0"id="users-table1">
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
                                                                Mata Pelajran</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Aksi</th>
                                                          
                                                                 
                                                        </tr>
                                                    </thead>
                                                   
                                                </table>
                                               
                        
                                                
                                              </div>
                                            </div>
                                          </div>
                                </div>






                               {{-- ini punya data awal --}}
                            </div>
                          
                            
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Buat Pengaturan Kelas') }}
                                    </button>

                                    <a href="{{ route('Kelassiswa.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong> Jika sudah ada Tahun Akademik yang sama dengan nilai semester Ganjil dan Genap, maka tidak bisa menginputkan data kembali </strong> <br>
                               
                                    <br>
                
                            </span>
                        </div>
                        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Tahun Akademik?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Gas!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Submit the form if the user confirms
                                        document.getElementById('create-user-form').submit();
                                    }
                                });
                            });
                        </script> --}}

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
        ajax: '{{ route('siswa.siswa') }}',
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
          { data: 'NamaLengkap', name: 'NamaLengkap', className: 'text-center' },
          
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
    
    });
    $(document).ready(function() {
    let table = $('#users-table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('mengajar.mengajar') }}',
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
          { data: 'Guru_Nama', name: 'Guru_Nama', className: 'text-center' },
          { data: 'Matpel_Nama', name: 'Matpel_Nama', className: 'text-center' },
          
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
    
    });
</script>
@endsection