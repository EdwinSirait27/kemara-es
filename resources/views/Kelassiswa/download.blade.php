<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .school-info {
            margin-bottom: 20px;
        }
        .class-info {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
        }
        th {
            background-color: black;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-info {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .page-number {
            text-align: right;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    {{-- <div class="header">
        @foreach ($lihatsiswas as $lihat)
        <h2>DAFTAR SISWA</h2>
        <h3>Tahun Ajaran {{ e($lihat->Pengaturankelas->Tahunakademik->tahunakademik) }} </h3>
        <h3>Semester {{ e($lihat->Pengaturankelas->Tahunakademik->semester) }} </h3>
        @endforeach
    </div> --}}

   
    <div class="class-info">
        @foreach ($lihatsiswas as $lihat)

        <h3>Daftar Siswa Kelas : {{ e($lihat->Pengaturankelas->Kelas->kelas) }}</h3>
        <table style="border: none; width: 100%; margin-bottom: 10px;">
            <tr style="border: none;">
                <td style="border: none; width: 150px;">Tahun Ajaran</td>
                <td style="border: none;">: {{ e($lihat->Pengaturankelas->Tahunakademik->tahunakademik) }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; width: 150px;">Semester</td>
                <td style="border: none;">: {{ e($lihat->Pengaturankelas->Tahunakademik->semester) }}</td>
            </tr>
           
            <tr style="border: none;">
                <td style="border: none;">Wali Kelas</td>
                <td style="border: none;">: {{ e($lihat->Pengaturankelas->Kelas->Guru->Nama) }} Siswa</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Kapasitas Kelas</td>
                <td style="border: none;">: {{ e($lihat->Pengaturankelas->Kelas->kapasitas) }} Siswa</td>
            </tr>
        </table>
    </div>
    @endforeach

    @if ($jumlahsiswa > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 30%;">Nama Siswa</th>
                <th colspan="20" class="absen-header">Absensi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $counter = 1; // Variabel untuk nomor urut
        @endphp
            @foreach($lihatsiswas as $index => $siswa)
            <tr>
                <td style="text-align: center;">{{ $counter }}</td> 
                <td>{{ $siswa->Siswa->NamaLengkap ?? '-' }}</td>
                @for($i = 1; $i <= 20; $i++)
                <td class="absen-cell"></td>
            @endfor
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-info">
        <strong>Total : {{ e($jumlahsiswa) }} Siswa</strong>
    </div>
    @else
    <div class="alert">
        <p>Tidak ada siswa terdaftar dalam kelas ini.</p>
    </div>
    @endif

    <div class="page-number">
        Dicetak pada: {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    @foreach ($lihatsiswas as $lihat)
    <h3><i class="fas fa-user-shield"></i> Daftar Siswa Kelas
        {{ e($lihat->Pengaturankelas->Kelas->kelas) }}</h6>
        <h4>Wali Kelas : {{ e($lihat->Pengaturankelas->Kelas->Guru->Nama) }}</h4>
        <h4>Kapasitas Kelas: {{ e($lihat->Pengaturankelas->Kelas->kapasitas) }} Siswa</h4>
@endforeach
@if ($jumlahsiswa > 0)
    <h4>Total : {{ e($jumlahsiswa) }} Siswa </h4>
@else
    <h4>Tidak ada siswa.</h4>
@endif
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lihatsiswas as $index => $siswa)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->Siswa->Nama ?? '-' }}</td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}