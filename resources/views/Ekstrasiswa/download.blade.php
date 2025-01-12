<!DOCTYPE html>
<html>
<head>
    <title>Absensi Ekstrakulikuler</title>
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
            background-color: white;
            border-radius: 5px;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid black;
        
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        text-align: center;
        vertical-align: middle;
    
    }
    
        tr:nth-child(even) {
            background-color: white;
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
    <div class="class-info">
        @if($ekstrasiswa)
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <!-- Bagian Tabel -->
            <div style="flex: 1;">
                <h3>Daftar Absensi Ekstrakulikuler : {{ e($ekstrasiswa->Ekstrakulikuler->namaekstra) }}</h3>
                <table style="border: none; width: 100%; margin-bottom: 10px;">
                    <tr style="border: none;">
                        <td style="border: none; width: 150px;">Tahun Ajaran</td>
                        <td style="border: none;">: {{ e($ekstrasiswa->Ekstrakulikuler->Tahunakademik->tahunakademik) }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none; width: 150px;">Semester</td>
                        <td style="border: none;">: {{ e($ekstrasiswa->Ekstrakulikuler->Tahunakademik->semester) }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Guru Pembina</td>
                        <td style="border: none;">: {{ e($ekstrasiswa->Ekstrakulikuler->Guru->Nama) }} </td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Kapasitas Ekstrakulikuler</td>
                        <td style="border: none;">: {{ e($ekstrasiswa->Ekstrakulikuler->kapasitas) }} Siswa </td>
                    </tr>
                </table>
            </div>
    
            <!-- Bagian Gambar -->
            <div style="margin-left: 20px;">
                <img src="{{ asset('assets/img/50204458.jpg') }}" alt="Gambar Kelas" style="max-width: 125px; ">
            </div>
        </div>
    @endif



   
   

    @if ($jumlahsiswa > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 30%;">Nama Siswa</th>
                <th style="width: 5%;">Kelas Siswa</th>
                {{-- <th colspan="20" class="No">Absensi</th> --}}
                <th colspan="20" class="absen-header">Absensi</th>
            </tr>
        </thead>
        <tbody>
            
            {{-- @if($siswas)
            <tr>
                <td>{{ $siswas->siswa_id ?? '-' }}</td>
                @for($i = 1; $i <= 20; $i++)
                <td class="absen-cell"></td>
            @endfor
            </tr>
            @endif --}}
            {{-- @foreach ($siswas as $siswa)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>              
                <td style="text-align: center; vertical-align: middle;">{{ $siswa->User->Siswa->NamaLengkap ?? 'N/A' }}</td>
                @endforeach

                @foreach ($siswas->Pengaturankelassiswa as $pengaturan)
                @if($pengaturan->Pengaturankelas)
                <td style="text-align: center; vertical-align: middle;">{{ $pengaturan->Pengaturankelas->Kelas->kelas ?? 'N/A' }}</td>
                
            @endif
                @endforeach
                @for($i = 1; $i <= 20; $i++)
                <td class="absen-cell"></td>
                @endfor     --}}
                {{-- @foreach($siswas as $siswa)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                    
                    <!-- Menampilkan Nama Lengkap Siswa -->
                    <td style="text-align: center; vertical-align: middle;">
                        {{ $siswa->User->Siswa->NamaLengkap ?? 'N/A' }}
                    </td>

                    <!-- Menampilkan Kelas Siswa -->
                    <td style="text-align: center; vertical-align: middle;">
                        @php
                            $pengaturankelassiswa = $siswa->User->Siswa->Pengaturankelassiswa->first();
                        @endphp
                        {{ $pengaturankelassiswa ? $pengaturankelassiswa->Pengaturankelas->Kelas->kelas ?? 'N/A' : 'N/A' }}
                    </td>

                    <!-- Kolom Absen (misalnya 20 kolom absen) -->
                    @for($i = 1; $i <= 20; $i++)
                        <td class="absen-cell"></td>
                    @endfor
                </tr>
            @endforeach --}}

        <!-- Kolom Absen -->
        {{-- @for ($i = 1; $i <= 20; $i++)
            <td class="absen-cell"></td>
        @endfor --}}
        {{-- @endforeach --}}
        @foreach($siswasProcessed as $siswa)
        <tr>
            <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $siswa->NamaLengkap }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $siswa->Kelas }}</td>
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
        <br>
        <br>
        <h3 style="margin-right: 50px;">Guru Pembina</h3>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h3> {{ e($ekstrasiswa->Ekstrakulikuler->Guru->Nama) }} </h3>
    </div>
    </div>
    {{-- <div class="class-info1">
    <h3>Wali Kelas</h3>
    <br>
    <br>
    <br>
    <br>
    <h4>{{ e($kelassiswa->Pengaturankelas->Kelas->Guru->Nama) }}</h4>
    </div> --}}
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