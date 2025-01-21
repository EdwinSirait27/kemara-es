<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">
  
    <title>Jadwal Kelas {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</title>
    
    
   <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            
        }
        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png'))) }}') center center no-repeat;
            background-size: 500px;
            opacity: 0.1;
            z-index: 0; /* Make sure it stays behind content */
            pointer-events: none; /* Prevent it from interfering with interactions */
        }
            /* .watermark {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/50204458.jpg'))) }}') center center no-repeat;

                background-size: 400px;
                opacity: 0.1;
                z-index: 0;
            } */
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
        .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 30%; 
    }

    .navbar-brand-img {
        max-height: 100%;
    }
    .bold-hr {
    border: 0;
    border-top: 2px solid #000;
    margin: 10px 0; 
}
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/kopsurat.png'))) }}" class="navbar-brand-img h-100 me-2" alt="Logo">

    </div>
    <hr class="bold-hr">

    <div class="watermark"></div>
    <div class="class-info">
        @if($kelassiswa)
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="flex: 1;">
                <h3>Daftar Jadwal Pelajaran Kelas : {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</h3>
                <table style="border: none; width: 100%; margin-bottom: 10px;">
                    {{-- <tr style="border: none;">
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
                    </tr> --}}
                        <tr style="border: none;">
                            <td style="border: none; width: 150px;">Tahun Ajaran</td>
                            <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik) }}</td>
                            <td style="border: none; text-align: right;">Semester</td>
                            <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Tahunakademik->semester) }}</td>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none; width: 150px;">Wali Kelas</td>
                            <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Kelas->Guru->Nama) }}</td>
                         
                        </tr>
                    
                </table>
            </div>
        </div>
    @endif
    <table>
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
    
        <div class="total-info">
            <strong>Total : {{ e($jumlahmata) }} Mata Pelajaran</strong>
        </div>
       
    
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">
  
    <title>Jadwal Kelas {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</title>
    <style>
    
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 125%;
            background: url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') center center no-repeat;
            background-size: 500px;
            opacity: 0.1;
            z-index: 0;
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
        .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%; 
    }

    .navbar-brand-img {
        max-height: 100%;
    }
    .bold-hr {
    border: 0;
    border-top: 5px solid #000;
    margin: 20px 0; 
}
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/kopsurat.png'))) }}" class="navbar-brand-img h-100 me-2" alt="Logo">

    </div>
    <hr class="bold-hr">

    <div class="watermark"></div>
    <div class="class-info">
        @if($kelassiswa)
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="flex: 1;">
                <h3>Jadwal Kelas : {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</h3>
                <table style="border: none; width: 100%; margin-bottom: 10px;">
                    <tr style="border: none;">
                        <td style="border: none; width: 150px;">Tahun Ajaran</td>
                        <td style="border: none;">:{{ e($kelassiswa->Pengaturankelas->Tahunakademik->tahunakademik) }}</td>
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
        </div>
    @endif
    <table>
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
            <h3 style="margin-right: 50px;">Guru Pembina</h3>
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
</html> --}}

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Data Mata Pelajaran</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-image: 
    background-repeat: no-repeat;
    background-size: 300px; 
    background-position: center;
    opacity: 0.9; 
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
</html> --}}
