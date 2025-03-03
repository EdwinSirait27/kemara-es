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
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                        <form method="POST" id="create-user-form" action="{{ route('Kelassiswa.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pengaturankelas_id" class="form-control-label">
                                            <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                        </label>
                                        <div class="@error('pengaturankelas_id')border border-danger rounded-3 @enderror">
                                            <select name="pengaturankelas_id" id="pengaturankelas_id" class="form-select">
                                                <option value="" selected disabled>Pilih Tahun</option>
                                                @foreach ($pengaturans as $pengaturan)
                                                    <option value="{{ $pengaturan->id }}">Tahun Akademik : {{ $pengaturan->Tahunakademik->tahunakademik }} Semester : {{ $pengaturan->Tahunakademik->semester }} Kelas : {{$pengaturan->Kelas->kelas}} Tahun Akademik Kelas : {{$pengaturan->Kelas->Tahunakademik->tahunakademik}}</option>
                                                @endforeach             
                                            </select>
                                            @error('pengaturankelas_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <p class="text-muted text-xs mt-2">Contoh : Pilih salah satu </p>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <h5>Pilih siswa yang akan dimasukkan kedalam kelas</h5>
    
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label"></label>
                                    @error('siswa_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    <table id="siswaTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Lengkap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siswas as $siswa)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="siswa_id[]" value="{{ $siswa->siswa_id }}">
                                                </td>
                                                <td>{{ $siswa->NamaLengkap }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <h5>Pilih Mata Pelajaran yang akan dimasukkan kedalam kelas</h5>
    
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label"></label>
                                    @error('datamengajar_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                    <table id="datamengajarTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Guru</th>
                                                <th>Mata pelajaran</th>
                                                <th>Hari</th>
                                                <th>Awal Pelajaran </th>
                                                <th>Akhir Pelajaran</th>
                                                <th>Awal Istirahat</th>
                                                <th>Akhir Istirahat</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datamengajars as $datamengajar)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="datamengajar_id[]" value="{{ $datamengajar->id }}">
                                                </td>
                                                <td>{{ $datamengajar->Guru->Nama }}</td>
                                                <td>{{ $datamengajar->Matapelajaran->matapelajaran }}</td>
                                                <td>{{ $datamengajar->hari }}</td>
                                                <td>{{ $datamengajar->awalpel }}</td>
                                                <td>{{ $datamengajar->akhirpel }}</td>
                                                <td>{{ $datamengajar->awalis }}</td>
                                                <td>{{ $datamengajar->akhiris }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                
                               {{-- ini punya data awal --}}
                            </div>
                                <div class="form-group mb-0">
                                    <button type="button" id="submit-btn" class="btn btn-primary">
                                        {{ __('Masukkan Siswa dan Mata pelajaran') }}
                                    </button>

                                    <a href="{{ route('Kelassiswa.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                        </form>
                        <br>
                        <br>
                        <br>
                        <h5>Daftar siswa yang sudah masuk kelas</h5>
                        <form id="filterForm">
                            <div class="form-group">
                                <label for="tahunakademik">Filter Tahun Akademik</label>
                                <select id="tahunakademik" name="tahunakademik_id" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach ($filterTahunakademik as $tahun)
                                        <option value="{{ $tahun->id }}">Tahun Akademik: {{ $tahun->tahunakademik }} - Semester: {{$tahun->semester}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                            <table id="siswakelasTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tahun Akademik</th>
                                        <th>Semester</th>
                                        <th>Kelas</th>
                                        <th>Tahun Akademik Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($lihatsiswas as $siswa)
                                    <tr>
                                        <td>{{ $siswa->Siswa->NamaLengkap }}</td>
                                        <td>{{ $siswa->Pengaturankelas->Kelas->kelas }}</td>
                                        
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-secondary mx-4" role="alert">
                            <span class="text-white">
                                <strong>Keterangan</strong> <br>
                            </span>
                            <span class="text-white">-
                                <strong> Jika siswa yang di checkbox sudah ada di dalam kelas pada tahun akademik yang sama, maka tidak perlu lagi dimasukkan, kecuali di tahun akademik yang berbeda boleh dimasukkan.</strong> <br>
                               
                                    <br>
                
                            </span>
                        </div>
                        



                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('submit-btn').addEventListener('click', function(e) {
                                Swal.fire({
                                    title: 'Apakah Yakin?',
                                    text: "Buat Pengaturan Kelas?",
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
                        </script>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        
                        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#siswaTable').DataTable();
                                $('#datamengajarTable').DataTable();
                                // $('#siswakelasTable').DataTable();
                                
                                
                            });


                        </script>
                     <script>
                        $(document).ready(function() {
                            let table = $('#siswakelasTable').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: {
                            url: "{{ route('Kelassiswa.getSiswadankelas') }}",
                            data: function (d) {
                d.id = $('#tahunakademik').val();
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
                                        data: 'Siswa_Nama',
                                        name: 'Siswa_Nama',
                                        className: 'text-center'
                                    },
                                    {
                                        data: 'Tahun_Nama',
                                        name: 'Tahun_Nama',
                                        className: 'text-center'
                                    },
                                    
                                    {
                                        data: 'Semester_Nama',
                                        name: 'Semester_Nama',
                                        className: 'text-center'
                                    },
                                    {
                                        data: 'Kelas_Nama',
                                        name: 'Kelas_Nama',
                                        className: 'text-center'
                                    },
                                    {
                                        data: 'KelasTahun_Nama',
                                        name: 'KelasTahun_Nama',
                                        className: 'text-center'
                                    }
                                ]
                            });    
                            $('#tahunakademik').change(function () {
        table.ajax.reload();
    });
});
                    </script>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection