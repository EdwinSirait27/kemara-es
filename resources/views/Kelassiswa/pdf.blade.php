// 1. Install DomPDF package
// composer require barryvdh/laravel-dompdf

// 2. Di Controller, tambahkan use statement:
use Barryvdh\DomPDF\Facade\Pdf;

class KelassiswaController extends Controller
{
    public function generatePDF()
    {
        // Ambil data yang diperlukan
        $lihatsiswas = // Query untuk mengambil data siswa
        $jumlahsiswa = // Query untuk menghitung jumlah siswa
        
        // Load view dengan data
        $pdf = PDF::loadView('pdf.siswa-list', [
            'lihatsiswas' => $lihatsiswas,
            'jumlahsiswa' => $jumlahsiswa
        ]);
        
        // Download PDF dengan nama custom
        return $pdf->download('daftar-siswa.pdf');
        
        // Atau untuk preview di browser:
        // return $pdf->stream('daftar-siswa.pdf');
    }
}

// 3. Buat view baru di resources/views/pdf/siswa-list.blade.php
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        @foreach ($lihatsiswas as $lihat)
            <h3>Daftar Siswa Kelas {{ $lihat->Pengaturankelas->Kelas->kelas }}</h3>
            <p>Wali Kelas: {{ $lihat->Pengaturankelas->Kelas->Guru->Nama }}</p>
            <p>Kapasitas Kelas: {{ $lihat->Pengaturankelas->Kelas->kapasitas }} Siswa</p>
        @endforeach
        
        @if ($jumlahsiswa > 0)
            <p>Jumlah saat ini: {{ $jumlahsiswa }} Siswa</p>
        @else
            <p>Tidak ada siswa.</p>
        @endif
    </div>

    @if ($jumlahsiswa > 0)
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lihatsiswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->Siswa_Nama }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
