<!DOCTYPE html>
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
</html>