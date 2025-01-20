<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Kelas  {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }} </title>
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
            background: url('data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/50204458.jpg'))) }}') center center no-repeat;

            background-size: 400px;
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
        {{-- <img src="data:image/png;base64,base64,{{ base64_encode(file_get_contents(public_path('assets/img/kopsurat.png'))) }}')" class="navbar-brand-img h-100 me-2" alt="Logo"> --}}
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/kopsurat.png'))) }}" class="navbar-brand-img h-100 me-2" alt="Logo">

    </div>
    
    
    <hr class="bold-hr">
    <div class="watermark"></div>
    <div class="class-info">
        @if($kelassiswa)
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="flex: 1;">
                <h3>Daftar Absensi Kelas : {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</h3>
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
                    <tr style="border: none;">
                        <td style="border: none;">Kapasitas Kelas</td>
                        <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Kelas->kapasitas) }} Siswa </td>
                    </tr>
                </table>
            </div>
    
            {{-- <div style="margin-left: 20px;">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/50204458.jpg'))) }}" 
                 alt="Gambar Kelas" style="max-width: 125px; ">
            </div> --}}
        </div>
    @endif
    @if ($jumlahsiswa > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 30%;">Nama Siswa</th>
                <th colspan="20" class="absen-header">Absensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $siswa)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>              
                <td style="text-align: center; vertical-align: middle;">{{ $siswa->Siswa->NamaLengkap ?? 'N/A' }}</td>
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
            <h3> {{ e($kelassiswa->Pengaturankelas->Kelas->Guru->Nama) }} </h3>

        </div>
        </div>
    {{-- <div class="container">
        <h1>Judul Halaman</h1>
        <p>Ini adalah contoh halaman dengan watermark menggunakan gambar dari folder asset Laravel.</p>
    </div> --}}
</body>
</html>
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Absensi Siswa</title>
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
        <img src="{{ asset('assets/img/kopsurat.png')}}" class="navbar-brand-img h-100 me-2" alt="Logo">
    </div>
    
    
    <hr class="bold-hr">

    <div class="class-info">
        @if($kelassiswa)
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="flex: 1;">
                <h3>Daftar Absensi Kelas : {{ e($kelassiswa->Pengaturankelas->Kelas->kelas) }}</h3>
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
                    <tr style="border: none;">
                        <td style="border: none;">Kapasitas Kelas</td>
                        <td style="border: none;">: {{ e($kelassiswa->Pengaturankelas->Kelas->kapasitas) }} Siswa </td>
                    </tr>
                </table>
            </div>
            
        </div>
    @endif



   
   

    @if ($jumlahsiswa > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 30%;">Nama Siswa</th>
                <th colspan="20" class="absen-header">Absensi</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($siswas as $siswa)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>              
                <td style="text-align: center; vertical-align: middle;">{{ $siswa->Siswa->NamaLengkap ?? 'N/A' }}</td>
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
