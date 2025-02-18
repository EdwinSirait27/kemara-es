@extends('app2') 
@section('content')
@section('title', 'Informasi - SMA KATOLIK KESUMA MATARAM')

@section('meta_description', 'Informasi tambahakan SMAK Kesuma Mataram')

@section('meta_keywords', 'Informasi SMAK Kesuma Mataram')

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.container h1 {
    color: var(--primary-color);
    margin-bottom: 20px;
    text-align: center;
    font-size: 2rem;
}

.slider-wrapper {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: var(--soft-shadow);
}

.slider {
    min-height: 700px; 
    display: flex;
    align-items: center;
    justify-content: center;
}


.slider-item {
    display: none;
}

.slider-item img.slider-image {
    width: 120%; 
    max-height: 100vh;
    height: auto;
    width: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
}


.slider-item img.slider-image:hover {
    transform: scale(5.02);
}

.slider-nav {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 15px;
}

.slider-nav button {
    background-color: var(--secondary-color);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-nav button:hover {
    background-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.slider-content {
    padding: 20px;
    line-height: 1.6;
}

.slider-content p {
    margin-bottom: 1em;
    text-align: justify;
    color: var(--text-color);
}

.author-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.author-info p {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.author-info strong {
    color: var(--primary-color);
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    .slider-wrapper {
        padding: 15px;
    }
    
    .slider-item img.slider-image {
        max-height: 300px;
    }
    
    .slider-nav button {
        padding: 8px 15px;
        font-size: 14px;
    }
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    position: relative;
}

.container h1 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    text-align: center;
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    font-weight: 700;
    letter-spacing: -0.5px;
    position: relative;
    padding-bottom: 1rem;
}

.container h1::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    border-radius: 2px;
}

/* Modern Slider Wrapper */
.slider-wrapper {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.slider-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

/* Modern Slider Component */
.slider {
    position: relative;
    margin-bottom: 2rem;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.slider-item {
    display: none;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
}

.slider-item img.slider-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 12px;
    transition: all 0.5s ease;
}

.slider-item:hover img.slider-image {
    transform: scale(1.03);
    filter: brightness(1.05);
}

/* Modern Slider Navigation */
.slider-nav {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}

.slider-nav button {
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.slider-nav button:hover {
    background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Modern Content Section */
.slider-content {
    padding: 2rem;
    line-height: 1.8;
}

.slider-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
    color: var(--text-color);
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Modern Author Information */
.author-info {
    margin-top: 2rem;
    padding: 1.5rem;
    background: linear-gradient(to right, rgba(var(--primary-color-rgb), 0.05), rgba(var(--accent-color-rgb), 0.05));
    border-radius: 12px;
    border: 1px solid rgba(var(--primary-color-rgb), 0.1);
}

.author-info p {
    font-size: 0.95rem;
    color: var(--text-color);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.author-info strong {
    color: var(--primary-color);
    font-weight: 600;
}

/* Glass Morphism Effect */
.glass-effect {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
}

/* Loading Skeleton Animation */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 1000px 100%;
    animation: shimmer 2s infinite;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .container {
        padding: 1.5rem;
    }
    
    .slider-item img.slider-image {
        height: 400px;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .slider-wrapper {
        padding: 1rem;
    }
    
    .slider-item img.slider-image {
        height: 300px;
    }
    
    .slider-nav button {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
    
    .slider-content p {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .slider-item img.slider-image {
        height: 250px;
    }
    
    .author-info {
        padding: 1rem;
    }
}

/* Print Styles */
@media print {
    .slider-nav {
        display: none;
    }
    
    .slider-wrapper {
        box-shadow: none;
    }
    
    .slider-item {
        page-break-inside: avoid;
    }
}
</style>
<  <div class="container">
        <h1>{{$informasippdb->header}}</h1>
        <div class="slider-wrapper">
            <div class="slider">
                @for ($i = 1; $i <= 8; $i++)
                    @php $gambar = 'gambar' . $i; @endphp
                    @if (!empty($informasippdb->$gambar))
                        <div class="slider-item">
                            <img src="{{ asset('storage/informasippdb/' . $informasippdb->$gambar) }}" alt="{{ $informasippdb->header }}" class="slider-image">
                        </div>
                    @endif
                @endfor
            
                <div class="slider-nav">
                    <button class="prev" style="display: none;">❮</button>
                    <button class="next" style="display: none;">❯</button>
                </div>
            </div>
            
            <div class="article-container" style="font-family: Arial, sans-serif; line-height: 1.8; color: #333;">
                <div class="article-header" style="margin-bottom: 20px; text-align: center;">
                    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">{{ $informasippdb->header }}</h1>
                    <p style="font-size: 14px; color: #777;">
                        <strong>Pembuat:</strong> {{ $informasippdb->User->Guru->Nama }} |
                        <strong>Dipublikasikan:</strong> {{ \Carbon\Carbon::parse($informasippdb->created_at)->diffForHumans() }}
                    </p>
                </div>
            
                <div class="article-body" style="text-align: justify;">
                    {{-- @php
                        $bodyText = str($informasippdb->body);
                        $words = explode(' ', $bodyText);
                        $chunks = array_chunk($words, 50);
                    @endphp
            
                    @foreach ($chunks as $chunk)
                        <p style="margin-bottom: 15px;">{{ implode(' ', $chunk) }}</p>
                    @endforeach --}}
                    {{-- @php
    $bodyLines = explode("\n", $informasippdb->body);
@endphp

@foreach ($bodyLines as $line)
    @php
        $trimmedLine = trim($line); // Hapus spasi di awal dan akhir
    @endphp

    @if (Str::startsWith($trimmedLine, '•') || Str::startsWith($trimmedLine, '-'))
        <li>{{ ltrim($trimmedLine, '•- ') }}</li>
    @elseif (Str::endsWith($trimmedLine, ':'))
        <h4 style="margin-top: 15px;">{{ $trimmedLine }}</h4>
    @elseif (!empty($trimmedLine))
        <p style="margin-bottom: 10px;">{{ $trimmedLine }}</p>
    @endif
@endforeach --}}
{{-- @php
    $bodyLines = explode("\n", $informasippdb->body);
    $isTableSection = false; // Flag untuk mendeteksi apakah sedang dalam tabel
    $tableData = []; // Menampung data tabel
@endphp

@foreach ($bodyLines as $line)
    @php
        $trimmedLine = trim($line); // Hapus spasi di awal dan akhir
    @endphp

    @if (Str::startsWith($trimmedLine, 'Dapatkan Promo Menarik di Setiap Gelombangnya'))
        <h4 style="margin-top: 15px;">{{ $trimmedLine }}</h4>
        @php
            $isTableSection = true;
            $tableData = []; // Reset data tabel
        @endphp
    @elseif ($isTableSection && Str::startsWith($trimmedLine, 'No'))
        @php
            $headers = explode("\t", $trimmedLine); // Pisahkan berdasarkan tab (atau bisa pakai "|")
        @endphp
    @elseif ($isTableSection && is_numeric(substr($trimmedLine, 0, 1)))
        @php
            $tableData[] = explode("\t", $trimmedLine); // Pisahkan berdasarkan tab
        @endphp
    @elseif ($isTableSection && empty($trimmedLine))
        @php
            $isTableSection = false;
        @endphp

        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-top: 10px;">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th style="background-color: #f2f2f2; text-align: center;">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($tableData as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td style="text-align: center;">{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if (Str::startsWith($trimmedLine, '•') || Str::startsWith($trimmedLine, '-'))
            <li>{{ ltrim($trimmedLine, '•- ') }}</li>
        @elseif (Str::endsWith($trimmedLine, ':'))
            <h4 style="margin-top: 15px;">{{ $trimmedLine }}</h4>
        @elseif (!empty($trimmedLine))
            <p style="margin-bottom: 10px;">{{ $trimmedLine }}</p>
        @endif
    @endif
@endforeach
 --}}
 @php
    // Pisahkan teks berdasarkan baris baru (\n)
    $bodyLines = explode("\n", $informasippdb->body);
    $isTableSection = false; // Flag untuk mendeteksi apakah sedang dalam tabel
    $tableData = []; // Menampung data tabel
@endphp

@foreach ($bodyLines as $line)
    @php
        $trimmedLine = trim($line); // Hapus spasi di awal dan akhir
    @endphp

    @if (Str::startsWith($trimmedLine, 'Dapatkan Promo Menarik di Setiap Gelombangnya'))
        {{-- Jika menemukan judul tabel, mulai mode tabel --}}
        <h4 style="margin-top: 15px;">{{ $trimmedLine }}</h4>
        @php
            $isTableSection = true;
            $tableData = []; // Reset data tabel
        @endphp
    @elseif ($isTableSection && Str::startsWith($trimmedLine, 'No'))
        {{-- Jika menemukan header tabel, simpan di tabel --}}
        @php
            $headers = explode("\t", $trimmedLine); // Pisahkan berdasarkan tab (atau bisa pakai "|")
        @endphp
    @elseif ($isTableSection && is_numeric(substr($trimmedLine, 0, 1)))
        {{-- Jika baris ini bagian dari isi tabel (dimulai dengan angka) --}}
        @php
            $tableData[] = explode("\t", $trimmedLine); // Pisahkan berdasarkan tab
        @endphp
    @elseif ($isTableSection && empty($trimmedLine))
        {{-- Jika ada baris kosong setelah tabel, akhiri tabel --}}
        @php
            $isTableSection = false;
        @endphp

        {{-- Render tabel --}}
        {{-- <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-top: 10px;">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th style="background-color: #f2f2f2; text-align: center;">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($tableData as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td style="text-align: center;">{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <style>
            .table-responsive {
                width: 100%;
                overflow-x: auto; /* Aktifkan scroll horizontal jika perlu */
                -webkit-overflow-scrolling: touch; /* Agar smooth scrolling di iOS */
            }
        
            table {
                width: 100%;
                border-collapse: collapse;
            }
        
            th, td {
                padding: 8px;
                text-align: center;
                border: 1px solid #ddd;
                white-space: nowrap; /* Mencegah pemotongan teks */
            }
        
            th {
                background-color: #f2f2f2;
            }
        
            /* Untuk layar kecil, teks dibuat lebih kecil */
            @media screen and (max-width: 600px) {
                th, td {
                    padding: 6px;
                    font-size: 12px;
                }
            }
        </style>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableData as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    @elseif (Str::startsWith($trimmedLine, 'II. KETENTUAN LAIN'))
        {{-- Menampilkan judul "KETENTUAN LAIN" --}}
        <h4 style="margin-top: 20px;">{{ $trimmedLine }}</h4>
    @elseif (Str::startsWith($trimmedLine, '1.') || Str::startsWith($trimmedLine, '2.') || Str::startsWith($trimmedLine, '3.') || Str::startsWith($trimmedLine, '4.'))
        {{-- Menampilkan daftar bernomor --}}
        <p style="margin-bottom: 5px;">{{ $trimmedLine }}</p>
    @elseif (Str::startsWith($trimmedLine, 'Informasi lanjut'))
        {{-- Menampilkan judul "Informasi Lanjut" --}}
        <h4 style="margin-top: 20px;">{{ $trimmedLine }}</h4>
    @elseif (Str::startsWith($trimmedLine, 'Panitia PPDB'))
        {{-- Menampilkan alamat panitia --}}
        <p style="margin-bottom: 5px; font-weight: bold;">{{ $trimmedLine }}</p>
    @elseif (preg_match('/^0\d+/', $trimmedLine))
        {{-- Menampilkan nomor telepon dan contact person --}}
        <p style="margin-bottom: 5px;">📞 {{ $trimmedLine }}</p>
    @else
        {{-- Format lainnya tetap sama seperti sebelumnya --}}
        @if (Str::startsWith($trimmedLine, '•') || Str::startsWith($trimmedLine, '-'))
            <li>{{ ltrim($trimmedLine, '•- ') }}</li>
        @elseif (Str::endsWith($trimmedLine, ':'))
            <h4 style="margin-top: 15px;">{{ $trimmedLine }}</h4>
        @elseif (!empty($trimmedLine))
            <p style="margin-bottom: 10px;">{{ $trimmedLine }}</p>
        @endif
    @endif
@endforeach
<h4 style="margin-top: 20px;">Link Pendaftaran PPDB </h4>
{{-- <p style="margin-bottom: 5px;">
    <a href="{{ url($ppdb->url) }}" style="text-decoration: none; color: inherit;">Daftar PPDB</a>
</p> --}}
{{-- <p style="margin-bottom: 5px;">
    <a href="{{ url($ppdb->url) }}" 
       style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s ease;">
       Daftar PPDB
    </a>
</p> --}}
@if (!empty($ppdb->url))
    <p style="margin-bottom: 5px;">
        <a href="{{ url($ppdb->url) }}" 
           style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s ease;">
           Daftar PPDB
        </a>
    </p>
    @else 
    <p style="margin-bottom: 5px;">Sudah Tertutup</p>
@endif







                    
                </div>
            </div>
            
          
            
          
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const sliderItems = document.querySelectorAll(".slider-item");
                    const prevButton = document.querySelector(".slider-nav .prev");
                    const nextButton = document.querySelector(".slider-nav .next");
                    let currentSlide = 0;
            
                    if (sliderItems.length > 1) {
                        prevButton.style.display = "block";
                        nextButton.style.display = "block";
                    }
            
                    function updateSlides() {
                        sliderItems.forEach((item, index) => {
                            item.style.display = index === currentSlide ? "block" : "none";
                        });
                    }
            
                    prevButton.addEventListener("click", function () {
                        currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
                        updateSlides();
                    });
            
                    nextButton.addEventListener("click", function () {
                        currentSlide = (currentSlide + 1) % sliderItems.length;
                        updateSlides();
                    });
            
                    updateSlides();
                });
            </script>
  
</div>
</div>
@endsection
