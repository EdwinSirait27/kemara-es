@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Data siswa')

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
                    <h6><i class="fas fa-user-shield"></i>Data Siswa</h6>

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
                                        Nama Lengkap
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Induk
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Panggilan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jenis Kelamin
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NISN
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tempat Lahir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Lahir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Agama
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        RT
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        RW
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kelurahan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kecamatan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KabKota
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Provinsi
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KodePos
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Telephone
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kewarganegaraan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NIK
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Golongan Darah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tinggal Dengan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status Siswa
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Anak Ke
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Saudara Kandung
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Saudara Tiri
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tinggi CM
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Berat KG
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Riwayat Penyakit
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Asal SD
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat SD
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NPSN SD
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kab Kota SD
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Provinsi SD
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        No Ijasah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Diterima Tanggal
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Diterima DiKelas
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Diterima Semester
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mutasi Asal SMP
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alasan Pindah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tgl Ijasah SD
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Orang Tua Pada Ijasah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Lahir Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Telephone Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Agama Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pendidikan Terakhir Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pekerjaan Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Penghasilan Ayah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Lahir Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Telephone Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Agama Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pendidikan Terakhir Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pekerjaan Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Penghasilan Ibu
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Lahir Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Telephone Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Agama Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pendidikan Terakhir Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pekerjaan Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Wali Penghasilan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status Hubungan Wali
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Menerima Beasiswa Dari
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Meninggalkan Sekolah
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alasan Sebab
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tamat Belajar Tahun
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Informasi Lain
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tahun Daftar
                                    </th>

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
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('datasiswaall.datadatasiswaall') }}',
                
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                dom: '<"top"lBf>rt<"bottom"ip><"clear">', // Update dom untuk menampilkan "Show entries"
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: 'Copy',
                        className: 'btn btn-primary',
                        title: 'Data Siswa',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        className: 'btn btn-success',
                        title: 'Data Siswa',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                columns: [
                    {
                        data: 'siswa_id',
                        name: 'siswa_id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'NamaLengkap',
                        name: 'NamaLengkap',
                        className: 'text-center'
                    },
                    {
                        data: 'NomorInduk',
                        name: 'NomorInduk',
                        className: 'text-center'
                    },
                    {
                        data: 'NamaPanggilan',
                        name: 'NamaPanggilan',
                        className: 'text-center'
                    },
                    {
                        data: 'JenisKelamin',
                        name: 'JenisKelamin',
                        className: 'text-center'
                    },
                    {
                        data: 'NISN',
                        name: 'NISN',
                        className: 'text-center'
                    },
                    {
                        data: 'TempatLahir',
                        name: 'TempatLahir',
                        className: 'text-center'
                    },
                    {
                        data: 'TanggalLahir',
                        name: 'TanggalLahir',
                        className: 'text-center'
                    },
                    {
                        data: 'Agama',
                        name: 'Agama',
                        className: 'text-center'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat',
                        className: 'text-center'
                    },
                    {
                        data: 'RT',
                        name: 'RT',
                        className: 'text-center'
                    },
                    {
                        data: 'RW',
                        name: 'RW',
                        className: 'text-center'
                    },
                    {
                        data: 'Kelurahan',
                        name: 'Kelurahan',
                        className: 'text-center'
                    },
                    {
                        data: 'Kecamatan',
                        name: 'Kecamatan',
                        className: 'text-center'
                    },
                    {
                        data: 'KabKota',
                        name: 'KabKota',
                        className: 'text-center'
                    },
                    {
                        data: 'Provinsi',
                        name: 'Provinsi',
                        className: 'text-center'
                    },
                    {
                        data: 'KodePos',
                        name: 'KodePos',
                        className: 'text-center'
                    },
                    {
                        data: 'Email',
                        name: 'Email',
                        className: 'text-center'
                    },
                    {
                        data: 'NomorTelephone',
                        name: 'NomorTelephone',
                        className: 'text-center'
                    },
                    {
                        data: 'Kewarganegaraan',
                        name: 'Kewarganegaraan',
                        className: 'text-center'
                    },
                    {
                        data: 'NIK',
                        name: 'NIK',
                        className: 'text-center'
                    },
                    {
                        data: 'GolDarah',
                        name: 'GolDarah',
                        className: 'text-center'
                    },
                    {
                        data: 'TinggalDengan',
                        name: 'TinggalDengan',
                        className: 'text-center'
                    },
                    {
                        data: 'StatusSiswa',
                        name: 'StatusSiswa',
                        className: 'text-center'
                    },
                    {
                        data: 'AnakKe',
                        name: 'AnakKe',
                        className: 'text-center'
                    },
                    {
                        data: 'SaudaraKandung',
                        name: 'SaudaraKandung',
                        className: 'text-center'
                    },
                    {
                        data: 'SaudaraTiri',
                        name: 'SaudaraTiri',
                        className: 'text-center'
                    },
                    {
                        data: 'Tinggicm',
                        name: 'Tinggicm',
                        className: 'text-center'
                    },
                    {
                        data: 'Beratkg',
                        name: 'Beratkg',
                        className: 'text-center'
                    },
                    {
                        data: 'RiwayatPenyakit',
                        name: 'RiwayatPenyakit',
                        className: 'text-center'
                    },
                    {
                        data: 'AsalSD',
                        name: 'AsalSD',
                        className: 'text-center'
                    },
                    {
                        data: 'AlamatSD',
                        name: 'AlamatSD',
                        className: 'text-center'
                    },
                    {
                        data: 'NPSNSD',
                        name: 'NPSNSD',
                        className: 'text-center'
                    },
                    {
                        data: 'KabKotaSD',
                        name: 'KabKotaSD',
                        className: 'text-center'
                    },
                    {
                        data: 'ProvinsiSD',
                        name: 'ProvinsiSD',
                        className: 'text-center'
                    },
                    {
                        data: 'NoIjasah',
                        name: 'NoIjasah',
                        className: 'text-center'
                    },
                    {
                        data: 'DiterimaTanggal',
                        name: 'DiterimaTanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'DiterimaDiKelas',
                        name: 'DiterimaDiKelas',
                        className: 'text-center'
                    },
                    {
                        data: 'DiterimaSemester',
                        name: 'DiterimaSemester',
                        className: 'text-center'
                    },
                    {
                        data: 'MutasiAsalSMP',
                        name: 'MutasiAsalSMP',
                        className: 'text-center'
                    },
                    {
                        data: 'AlasanPindah',
                        name: 'AlasanPindah',
                        className: 'text-center'
                    },
                    {
                        data: 'TglIjasahSD',
                        name: 'TglIjasahSD',
                        className: 'text-center'
                    },
                    {
                        data: 'NamaOrangTuaPadaIjasah',
                        name: 'NamaOrangTuaPadaIjasah',
                        className: 'text-center'
                    },
                    {
                        data: 'NamaAyah',
                        name: 'NamaAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunLahirAyah',
                        name: 'TahunLahirAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'AlamatAyah',
                        name: 'AlamatAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'NomorTelephoneAyah',
                        name: 'NomorTelephoneAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'AgamaAyah',
                        name: 'AgamaAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'PendidikanTerakhirAyah',
                        name: 'PendidikanTerakhirAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'PekerjaanAyah',
                        name: 'PekerjaanAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'PenghasilanAyah',
                        name: 'PenghasilanAyah',
                        className: 'text-center'
                    },
                    {
                        data: 'NamaIbu',
                        name: 'NamaIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunLahirIbu',
                        name: 'TahunLahirIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'AlamatIbu',
                        name: 'AlamatIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'NomorTelephoneIbu',
                        name: 'NomorTelephoneIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'AgamaIbu',
                        name: 'AgamaIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'PendidikanTerakhirIbu',
                        name: 'PendidikanTerakhirIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'PekerjaanIbu',
                        name: 'PekerjaanIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'PenghasilanIbu',
                        name: 'PenghasilanIbu',
                        className: 'text-center'
                    },
                    {
                        data: 'NamaWali',
                        name: 'NamaWali',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunLahirWali',
                        name: 'TahunLahirWali',
                        className: 'text-center'
                    },
                    {
                        data: 'AlamatWali',
                        name: 'AlamatWali',
                        className: 'text-center'
                    },
                    {
                        data: 'NomorTelephoneWali',
                        name: 'NomorTelephoneWali',
                        className: 'text-center'
                    },
                    {
                        data: 'AgamaWali',
                        name: 'AgamaWali',
                        className: 'text-center'
                    },
                    {
                        data: 'PendidikanTerakhirWali',
                        name: 'PendidikanTerakhirWali',
                        className: 'text-center'
                    },
                    {
                        data: 'PekerjaanWali',
                        name: 'PekerjaanWali',
                        className: 'text-center'
                    },
                    {
                        data: 'WaliPenghasilan',
                        name: 'WaliPenghasilan',
                        className: 'text-center'
                    },
                    {
                        data: 'StatusHubunganWali',
                        name: 'StatusHubunganWali',
                        className: 'text-center'
                    },
                    {
                        data: 'MenerimaBeasiswaDari',
                        name: 'MenerimaBeasiswaDari',
                        className: 'text-center'
                    },
                    {
                        data: 'TahunMeninggalkanSekolah',
                        name: 'TahunMeninggalkanSekolah',
                        className: 'text-center'
                    },
                    {
                        data: 'AlasanSebab',
                        name: 'AlasanSebab',
                        className: 'text-center'
                    },
                    {
                        data: 'TamatBelajarTahun',
                        name: 'TamatBelajarTahun',
                        className: 'text-center'
                    },
                    {
                        data: 'InformasiLain',
                        name: 'InformasiLain',
                        className: 'text-center'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            });
        });
    </script>

@endsection
