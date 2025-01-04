<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-image: 
    background-repeat: no-repeat;
    background-size: 300px; /* Atur ukuran gambar watermark */
    background-position: center;
    opacity: 0.9; /* Sesuaikan transparansi gambar watermark */
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
    @if($kelassiswa)
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <!-- Bagian Tabel -->
        <div style="flex: 1;">
            <h3>Daftar Mata Pelajaran Kelas : {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</h3>
            <table style="border: none; width: 100%; margin-bottom: 10px;">
                <tr style="border: none;">
                    <td style="border: none; width: 150px;">Tahun Ajaran</td>
                    <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik) }}</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; width: 150px;">Semester</td>
                    <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Tahunakademik->semester) }}</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none;">Wali Kelas</td>
                    <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Kelas->Guru->Nama) }} </td>
                </tr>
            </table>
        </div>

        <!-- Bagian Gambar -->
        <div style="margin-left: 20px;">
            <img src="{{ asset('assets/img/50204458.jpg') }}" alt="Gambar Kelas" style="max-width: 125px; ">
        </div>
    </div>
@endif

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; text-align: center; vertical-align: middle;">
        <thead>
            <tr>
                <th style="width: 5%;">Hari</th>
                <th style="width: 20%;">Guru</th>
                <th style="width: 15%;">Mata Pelajaran</th>
                <th style="width: 15%;">Awal Pelajaran</th>
                <th style="width: 15%;">Akhir Pelajaran</th>
                <th style="width: 15%;">Awal Istirahat</th>
                <th style="width: 15%;">Akhir Istirahat</th>
            </tr>
        </thead>
        <tbody>
            @php
                $previousHari = null;
                $rowspan = 1; 
            @endphp
            {{-- @foreach ($datamengajars as $key => $datamengajar)
                @if ($datamengajar->Datamengajar->hari !== $previousHari)
                    @php
                        $rowspan = $datamengajars->where('Datamengajar.hari', $datamengajar->Datamengajar->hari)->count();
                    @endphp
                @endif
                <tr>
                    @if ($datamengajar->Datamengajar->hari !== $previousHari)
                        <td rowspan="{{ $rowspan }}">{{ $datamengajar->Datamengajar->hari ?? '-' }}</td>
                    @endif
                    <td>{{ $datamengajar->Datamengajar->Guru->Nama ?? '-' }}</td>
                    <td>{{ $datamengajar->Datamengajar->Matapelajaran->matapelajaran ?? '-' }}</td>
                    <td>{{ $datamengajar->Datamengajar->awalpel ?? '-' }}</td>
                    <td>{{ $datamengajar->Datamengajar->akhirpel ?? '-' }}</td>
                    <td>{{ $datamengajar->Datamengajar->awalis ?? '-' }}</td>
                    <td>{{ $datamengajar->Datamengajar->akhiris ?? '-' }}</td>
                </tr>
                @php
                    $previousHari = $datamengajar->Datamengajar->hari;
                @endphp
            @endforeach --}}
            @foreach ($datamengajars as $key => $datamengajar)
            @if ($datamengajar->Datamengajar->hari !== $previousHari)
                @php
                    $rowspan = $datamengajars->where('Datamengajar.hari', $datamengajar->Datamengajar->hari)->count();
                @endphp
            @endif
            <tr>
                @if ($datamengajar->Datamengajar->hari !== $previousHari)
                    <td rowspan="{{ $rowspan }}" style="text-align: center; vertical-align: middle;">
                        {{ $datamengajar->Datamengajar->hari ?? '-' }}
                    </td>
                @endif
                <td style="text-align: center; vertical-align: middle;">
                    {{ $datamengajar->Datamengajar->Guru->Nama ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{ $datamengajar->Datamengajar->Matapelajaran->matapelajaran ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{ $datamengajar->Datamengajar->awalpel ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{ $datamengajar->Datamengajar->akhirpel ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{ $datamengajar->Datamengajar->awalis ?? '-' }}
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    {{ $datamengajar->Datamengajar->akhiris ?? '-' }}
                </td>
            </tr>
            @php
                $previousHari = $datamengajar->Datamengajar->hari;
            @endphp
        @endforeach
        </tbody>
    </table>
    <div class="page-number">
        Dicetak pada: {{ date('d/m/Y H:i') }}
        <br>
        <br>
        <h3 style="margin-right: 50px;">Wali Kelas</h3>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h3> {{ e($kelassiswa->Pengaturankelas->Kelas->Guru->Nama) }} </h3>
    </div>
 
    
    
    </div>
</body>
</html>

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran</title>
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
        th, td {
            border: 1px solid white;
            padding: 12px;
        }
        th {
            background-color: white;
            color: black;
            font-weight: bold;
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
        @if($kelassiswa)

        <h3>Daftar Mata Pelajaran Kelas : {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</h3>
        <table style="border: none; width: 100%; margin-bottom: 10px;">
            <tr style="border: none;">
                <td style="border: none; width: 150px;">Tahun Ajaran</td>
                <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik) }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; width: 150px;">Semester</td>
                <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Tahunakademik->semester) }}</td>
            </tr>
           
            <tr style="border: none;">
                <td style="border: none;">Wali Kelas</td>
                <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Kelas->Guru->Nama) }} </td>
            </tr>
      
        </table>
    </div>
    @endif
    <table  style="width: 100%; border-collapse: collapse; margin-top: 20px; text-align: center; vertical-align: middle;">
        <thead>
            <tr>
                <th style="width: 5%;">Hari </th>
                <th style="width: 20%;">Guru </th>
                <th style="width: 15%;">Mata Pelajaran</th>
                <th style="width: 15%;">Awal Pelajaran</th>
                <th style="width: 15%;">Akhir Pelajaran</th>
                <th style="width: 15%;">Awal Istirahat</th>
                <th style="width: 15%;">Akhir Istirahat</th>
                
            </tr>
        </thead>
        <tbody>  
            @php
            $previousHari = null;
            $rowspan = 1; 
        @endphp
        
        @foreach ($datamengajars as $key => $datamengajar)
            @if ($datamengajar->Datamengajar->hari !== $previousHari)
                @php
                    $rowspan = $datamengajars->where('Datamengajar.hari', $datamengajar->Datamengajar->hari)->count();
                    @endphp
                    @endif
            <tr>
                @if ($datamengajar->Datamengajar->hari !== $previousHari)
                    <td rowspan="{{ $rowspan }}">{{ $datamengajar->Datamengajar->hari ?? '-' }}</td>
                @endif
                <td>{{ $datamengajar->Datamengajar->Guru->Nama ?? '-' }}</td>
                <td>{{ $datamengajar->Datamengajar->Matapelajaran->matapelajaran ?? '-' }}</td>
                <td>{{ $datamengajar->Datamengajar->awalpel ?? '-' }}</td>
                <td>{{ $datamengajar->Datamengajar->akhirpel ?? '-' }}</td>
                <td>{{ $datamengajar->Datamengajar->awalis ?? '-' }}</td>
                <td>{{ $datamengajar->Datamengajar->akhiris ?? '-' }}</td>
            </tr>
            @php
                $previousHari = $datamengajar->Datamengajar->hari;
            @endphp
        @endforeach
        </tbody>
    </table>
    <div class="page-number">
        Dicetak pada: {{ date('d/m/Y H:i') }}
    </div>
</body>
</html> --}}