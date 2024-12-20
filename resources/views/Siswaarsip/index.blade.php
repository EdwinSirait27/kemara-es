@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Data siswa Arsip')

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
                    <h6><i class="fas fa-user-shield"></i>Data siswa Arsip</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"id="users-table">
                            <thead>
                                <tr>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NamaLengkap
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NomorInduk
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NamaPanggilan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        JenisKelamin
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NISN
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TempatLahir
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TanggalLahir
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Agama
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        RT
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        RW
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kelurahan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kecamatan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KabKota
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Provinsi
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KodePos
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NomorTelephone
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kewarganegaraan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NIK
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        GolDarah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TinggalDengan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        StatusSiswa
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AnakKe
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        SaudaraKandung
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        SaudaraTiri
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tinggicm
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Beratkg
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        RiwayatPenyakit
                                    </th>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AsalSD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AlamatSD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NPSNSD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KabKotaSD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ProvinsiSD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NoIjasah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DiterimaTanggal
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DiterimaDiKelas
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DiterimaSemester
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        MutasiAsalSMP
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AlasanPindah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TglIjasahSD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NamaOrangTuaPadaIjasah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NamaAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TahunLahirAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AlamatAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NomorTelephoneAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AgamaAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PendidikanTerakhirAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PekerjaanAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PenghasilanAyah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NamaIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TahunLahirIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AlamatIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NomorTelephoneIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AgamaIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PendidikanTerakhirIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PekerjaanIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PenghasilanIbu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NamaWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TahunLahirWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AlamatWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NomorTelephoneWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AgamaWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PendidikanTerakhirWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PekerjaanWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        WaliPenghasilan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        StatusHubunganWali
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        MenerimaBeasiswaDari
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TahunMeninggalkanSekolah
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        AlasanSebab
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        InformasiLain
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TahunDaftar
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TamatBelajarTahun
                                    </th>

                                </tr>
                            </thead>

                        </table>
                       
                     
                    </div>
                </div>
                <div class="alert alert-secondary mx-4" role="alert">
                    <span class="text-white">
                        <strong>Keterangan</strong> <br>
                    </span>
                    <span class="text-white">-
                        <strong> Ini adalah daftar siswa yang baru lulus dan baru diubah menjadi alumni, jika ingin menambahkan data ini ke dalam excel arsip siswa dari tahun-tahun sebelumnya, silahkan di copy atau di download lewat excel yak</strong> 
                        <br>
                        
                      
        
                    </span>
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
                ajax: '{{ route('arsipsiswa.dataarsipsiswa') }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                dom: 'Bfrtip', // Tambahkan ini untuk mengaktifkan tombol
                buttons: [
    {
        extend: 'copyHtml5', // Menambahkan tombol copy
        text: 'Copy', // Teks pada tombol
        className: 'btn btn-primary', // Kelas untuk styling
        title: 'Data Siswa Arsip Baru', // Nama file untuk salinan
        exportOptions: {
            columns: ':visible' // Tentukan kolom yang akan dicopy
        }
    },
    {
        extend: 'excelHtml5', 
        text: 'Export to Excel', 
        className: 'btn btn-success', // Kelas untuk styling
        title: 'Data Siswa Arsip Baru', // Nama file Excel
        exportOptions: {
            columns: ':visible' // Tentukan kolom yang akan diekspor
        }
    }
],
                columns: [
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
    name: 'created_at',
    className: 'text-center'
},

{
    data: 'TamatBelajarTahun',
    name: 'TamatBelajarTahun',
    className: 'text-center'
}
// {
//     data: 'TahunDaftar',
//     name: 'TahunDaftar',
//     className: 'text-center'
// },

// {
//     data: 'TamatBelajarTahun',
//     name: 'TamatBelajarTahun',
//     className: 'text-center'
// }
                ]
            });
        });
</script>

@endsection
