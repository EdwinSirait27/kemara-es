@extends('layouts.user_type.auth')
@section('content')
@section('title', 'Kemara-ES | Edit Kelas Siswa')

<style>
    .avatar {
        position: relative;
    }

    .iframe-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%;
        /* Aspect ratio 16:9 */
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>

<div>
    <div class="container-fluid">


        <form action="{{ route('Kelassiswa.update', $hashedId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Edit Tahun Akademik') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">

                        @if ($errors->any())
                            <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <span class="alert-text text-white">
                                        {{ $error }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengaturankelas_id" class="form-control-label">
                                        <i class="fas fa-lock"></i> {{ __('Tahun Akademik') }}
                                    </label>
                                    <div>
                                        <select name="pengaturankelas_id" id="pengaturankelas_id" class="form-select"
                                            readonly>
                                            <option value="" selected disabled>Pilih Pengaturan Kelas</option>
                                            @foreach ($pengaturans as $peng)
                                                <option value="{{ $peng->id }}"
                                                    {{ $kelassiswa->pengaturankelas_id == $peng->id ? 'selected' : '' }}>
                                                    Tahun Akademik : {{ $peng->Tahunakademik->tahunakademik }} Semester
                                                    : {{ $peng->Tahunakademik->semester }} Kelas :
                                                    {{ $peng->Kelas->kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pengaturankelas_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <p class="text-muted text-xs mt-2">Data ini tidak bisa diganti</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h5>Pilih Siswa yang akan dimasukkan kedalam kelas</h5>

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <label for="siswa_id" class="form-label"></label>
                                    <table id="siswaTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Nama Lengkap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswas as $siswa)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="siswa_id[]"
                                                            value="{{ $siswa->siswa_id }}"
                                                            @if (in_array($siswa->siswa_id, $selectedSiswa)) checked @endif>
                                                    </td>
                                                    <td>{{ $siswa->NamaLengkap }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <h5>Pilih Mata pelajaran yang akan dimasukkan kedalam kelas</h5>

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <label for="siswa_id" class="form-label"></label>
                                    <table id="siswaTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Guru</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Awal Pelajaran</th>
                                                <th>Akhir Pelajaran</th>
                                                <th>Awal Istirahat</th>
                                                <th>Akhir Istirahat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datamengajars as $data)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="datamengajar_id[]"
                                                            value="{{ $data->id }}"
                                                            @if (in_array($data->id, $selectedMata)) checked @endif>
                                                    </td>
                                                    <td>{{ $data->Guru->Nama }}</td>
                                                    <td>{{ $data->Matapelajaran->matapelajaran }}</td>
                                                    <td>{{ $data->awalpel }}</td>
                                                    <td>{{ $data->akhirpel }}</td>
                                                    <td>{{ $data->awalis }}</td>
                                                    <td>{{ $data->akhiris }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                            @if ($kelassiswa && $kelassiswa->Pengaturankelas->Kelas)
                                <h5>Siswa yang sudah masuk kedalam kelas
                                    {{ $kelassiswa->Pengaturankelas->Kelas->kelas ?? 'Nama kelas tidak tersedia' }}
                                    Tahun akademik
                                    {{ $kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik ?? 'Nama kelas tidak tersedia' }}
                                    Semester
                                    {{ $kelassiswa->Pengaturankelas->Tahunakademik->semester ?? 'Nama kelas tidak tersedia' }}
                                </h5>
                            @else
                                <p>Data kelas tidak ditemukan.</p>
                            @endif

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table id="tabelsiswakelas" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswass as $siswa)
                                                <tr>
                                                    <td>{{ $siswa->Siswa->NamaLengkap ?? 'Data tidak tersedia' }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <br>
                            <br>
                            <br>

                            @if ($kelassiswa && optional($kelassiswa->Pengaturankelas)->Kelas)
                            <h5>Mata pelajaran yang sudah masuk kedalam kelas
                                {{ $kelassiswa->Pengaturankelas->Kelas->kelas ?? 'Nama kelas tidak tersedia' }}
                                Tahun akademik
                                {{ optional($kelassiswa->Pengaturankelas->Tahunakademik)->tahunakademik ?? 'Tahun akademik tidak tersedia' }}
                                Semester
                                {{ optional($kelassiswa->Pengaturankelas->Tahunakademik)->semester ?? 'Semester tidak tersedia' }}
                            </h5>
                        @else
                            <p>Data kelas tidak ditemukan.</p>
                        @endif
                        

                            <div class="row">
                                <div class="table-responsive p-0">
                                    <table id="tabelmatapelajarankelas" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Guru</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Awal Pelajaran</th>
                                                <th>Akhir Pelajaran</th>
                                                <th>Awal Istirahat</th>
                                                <th>Akhir Istirahat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datamengajarss as $datamengajar)
                                                <tr>
                                                    <td>{{ $datamengajar->Datamengajar->Guru->Nama }}</td>
                                                    <td>{{ $datamengajar->Datamengajar->Matapelajaran->matapelajaran }}</td>
                                                    <td>{{ $datamengajar->Datamengajar->awalpel }}</td>
                                                    <td>{{ $datamengajar->Datamengajar->akhirpel }}</td>
                                                    <td>{{ $datamengajar->Datamengajar->awalis }}</td>
                                                    <td>{{ $datamengajar->Datamengajar->akhiris }}</td>
                                                   
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 me-2">
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('Kelassiswa.index') }}" class="btn btn-secondary mt-4 mb-4">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </div>

        </form>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Keterangan</strong> <br>
            </span>
            <span class="text-white">-
                <strong> Untuk pengeditan Tahun Akademik tidak diaktifkan fitur ini hanya untuk menambahkan siswa ke
                    dalam kelas, untuk tabel kedua itu adalah daftar siswa yang sudah masuk kedalam kelas, bisa
                    menggunakan filter berdasarkan Tahun Akademik yang sedang diakses saat ini.</strong> <br>
                <br>
            </span>
        </div>
    </div>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
    @if (session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#siswaTable').DataTable();
        $('#tabelsiswakelas').DataTable();
        $('#tabelmatapelajarankelas').DataTable();

    });
</script>
{{-- <script>
    $(document).ready(function() {
        let table = $('#tabelsiswakelas').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
        url: "{{ route('Kelassiswa.getEditsiswadankelas') }}",
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
                }
            ]
        });    
        $('#tahunakademik').change(function () {
table.ajax.reload();
});
});
</script> --}}

@endsection
{{-- //disini --}}
{{-- @if ($kelassiswa && $kelassiswa->Pengaturankelas->Kelas)
                        <h5>Nama Kelas: {{ $kelassiswa->Pengaturankelas->Kelas->kelas ?? 'Nama kelas tidak tersedia' }}
                        </h5>
                    @else
                        <p>Data kelas tidak ditemukan.</p>
                    @endif

                    <div class="row">
                        <label for="siswa_id" class="form-label"></label>
                        <table id="siswaTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswakelass as $siswakelas)
                                    <tr>

                                        <td>{{ $siswakelas->Siswa->NamaLengkap }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
