@extends('layouts.user_type.guest')
@section('title', 'KESUMA MATARAM')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .top-bar {
            background: #004d99;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .contact span {
            margin-right: 15px;
            font-size: 14px;
        }
        .social-icons a {
            color: white;
            margin-left: 10px;
            text-decoration: none;
        }
        .header {
            padding: 15px;
            background: white;
        }
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        .logo-section img {
            width: 80px;
            height: auto;
        }

        .school-title h1 {
            font-size: 1.2rem;
            color: #004d99;
        }

        .school-title p {
            font-size: 0.8rem;
            color: #666;
        }

        .search-box {
            display: flex;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-box button {
            padding: 8px 15px;
            background: #004d99;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Navigation */
        .nav {
            background: #004d99;
            padding: 10px;
            overflow-x: auto;
        }

        .nav ul {
            display: flex;
            list-style: none;
            white-space: nowrap;
        }

        .nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            font-size: 0.9rem;
        }

        /* Slider */
        .slider {
            position: relative;
            max-height: 800px;
            overflow: hidden;
        }

        .slider img {
            width: 60%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .slider-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.1);
            color: white;
            padding: 15px;

        }

        .slider-content p h3 a {
            align-items: center;

        }

        /* Konten Slider */
        .slider-button {
            display: inline-block;
            padding: 8px 15px;
            background: #004d99;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        /* Profile Section */
        .profile {
            padding: 20px;
        }

        .profile h2 {
            color: #004d99;
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Gallery */
        .gallery {
            padding: 20px;
        }

        .gallery h2 {
            color: #004d99;
            margin-bottom: 20px;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .gallery-item p {
            text-align: center;
            margin-top: 10px;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                text-align: center;
            }

            .social-icons {
                margin-top: 10px;
            }

            .logo-section {
                flex-direction: column;
                text-align: center;
            }

            .school-title h1 {
                font-size: 1rem;
            }

            .nav ul {
                gap: 5px;
            }

            .nav a {
                padding: 8px 10px;
                font-size: 0.8rem;
            }
        }

        footer {
            background-color: #004b93;
            color: white;
            padding: 50px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
        }

        @media (max-width: 768px) {

            .top-bar,
            header,
            nav,
            main,
            footer {
                padding: 15px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            nav ul {
                flex-direction: column;
            }

            .logo-container {
                flex-direction: column;
                text-align: center;
            }

            .search-bar {
                margin-top: 15px;
            }
        }

        .school-description img {
            width: 100px;
            margin-bottom: 5px;
        }

        .school-description p {
            color: white;
        }

        .school-description h2 {
            color: white;
        }

        .contact-section h3 {
            color: white;
        }

        .navigation-section ul li a {
            color: white;
            text-decoration: none;
        }

        .navigation-section h3 {
            color: white;

        }

        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .prev,
        .next {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            font-size: 30px;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }
        .berita-detail {
    max-width: 800px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
}
        .berita-detail h1{
            color: #004d99;
            margin-bottom: 20px;
            text-align: center;
    /* font-family: Arial, sans-serif; */
}

.image-slider {
    position: relative;
    width: 100%;
    max-height: 500px;
    overflow: hidden;
    margin-bottom: 20px;
}

.slider-images {
    display: flex;
    transition: transform 0.5s ease;
}

.slider-images img {
    width: 100%;
    object-fit: cover;
    flex-shrink: 0;
}

.slider-nav {
    display: flex;
    justify-content: space-between;
    position: absolute;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
}

.slider-nav button {
    background: rgba(0,0,0,0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
}
.berita-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    color: #666;
    font-size: 0.9em;
}

.berita-meta .author,
.berita-meta .timestamp {
    font-style: italic;
}
/* .berita-content {
    padding: 20px;
    line-height: 1.6;
}
.berita-content p{
    padding: 20px;
    line-height: 1.6;
} */
.berita-content {
    padding: 15px;
}

.berita-content p {
    text-align: justify;
    line-height: 1.5;
    margin-bottom: 15px;
}
    </style>
    <div class="top-bar">
        <div class="contact">
            <span>📞 +62 370 645 695</span>
            <span>📧 SMAK_KESUMA@YAHOO.COM</span>
        </div>
        <div class="social-icons">
            <a href="https://web.facebook.com/SMAK.KESUMA.MATARAM/?_rdc=1&_rdr#" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.instagram.com/smak.kesuma.mtr/" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/@smakkesumamataram" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="https://api.whatsapp.com/send/?phone=%2B6281353653008&text&type=phone_number&app_absent=0"
                target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
    <header class="header">
        <div class="logo-section">
            <img src="{{ asset('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo SMA Katolik Kesuma Mataram">
            <div class="school-title">
                <h1>SMA KATOLIK KESUMA MATARAM</h1>
                <p>DISIPLIN-JUJUR-TERAMPIL-MANDIRI</p>
            </div>
        </div>
    </header>
    <br> 
    {{-- <div class="below-header">
        <div class="announcement">
            <h2>Pengumuman</h2>
            <p>Kunjungi halaman <a href="/pengumuman">Pengumuman</a> untuk informasi terbaru mengenai kegiatan sekolah, penerimaan siswa baru, dan lainnya.</p>
        </div>
        <div class="important-links">
            <h2>Link Penting</h2>
            <ul>
                <li><a href="/kurikulum">Kurikulum</a></li>
                <li><a href="/ekstrakurikuler">Ekstrakurikuler</a></li>
                <li><a href="/prestasi">Prestasi</a></li>
                <li><a href="/galeri">Galeri</a></li>
            </ul>
        </div>
    </div> --}}
    <div class="berita-detail">
        <h1>{{ $berita->header }}</h1>
        
        <div class="image-slider">
            <div class="slider-images" id="slider-images">
                @php
                    $images = [];
                    for ($i = 1; $i <= 8; $i++) {
                        $imageKey = 'gambar' . $i;
                        if ($berita->$imageKey) {
                            $images[] = $berita->$imageKey;
                        }
                    }
                @endphp
                
                @foreach($images as $image)
                    <img src="{{ asset('storage/berita/' . $image) }}" alt="{{ $berita->header }}">
                @endforeach
            </div>
            
            @if(count($images) > 1)
            <div class="slider-nav">
                <button onclick="moveSlider(-1)">❮</button>
                <button onclick="moveSlider(1)">❯</button>
            </div>
            @endif
        </div>
    
        {{-- <div class="berita-content">
            <p>{{ $berita->body }}</p>
        </div> --}}
        @php
function splitTextIntoParagraphs($text, $wordsPerParagraph = 150) {
    $words = explode(' ', $text);
    $paragraphs = [];
    $currentParagraph = [];

    foreach ($words as $word) {
        $currentParagraph[] = $word;
        
        if (count($currentParagraph) >= $wordsPerParagraph) {
            $paragraphs[] = implode(' ', $currentParagraph);
            $currentParagraph = [];
        }
    }

    // Tambahkan sisa paragraf
    if (!empty($currentParagraph)) {
        $paragraphs[] = implode(' ', $currentParagraph);
    }

    return $paragraphs;
}

$textParagraphs = splitTextIntoParagraphs($berita->body);
@endphp

<div class="berita-content">
    @foreach($textParagraphs as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach
</div>
<div class="berita-meta">
    <span class="author">Diunggah oleh: {{ $berita->User->Guru->Nama ?? 'Admin' }}</span>
    <span class="timestamp">{{ $berita->created_at->diffForHumans() }}</span>
</div>
    </div>
    
    <script>
        let currentIndex = 0;
        const sliderImages = document.getElementById('slider-images');
        const images = sliderImages.querySelectorAll('img');
    
        function moveSlider(direction) {
            currentIndex += direction;
            
            if (currentIndex < 0) {
                currentIndex = images.length - 1;
            } else if (currentIndex >= images.length) {
                currentIndex = 0;
            }
    
            const offset = -currentIndex * 100;
            sliderImages.style.transform = `translateX(${offset}%)`;
        }
    </script>
    <br> 
    <footer>
        <div class="footer-content">
            <div class="school-description">
                <img src="{{ url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo Footer">
                <h2>SMA KATOLIK KESUMA MATARAM</h2>
                <p>SMAK Kesuma Mataram adalah singkatan dari Sekolah Menengah Atas Katolik Kesuma. Kata Kesuma singkatan
                    dari Keerdasan Suluh Masyarakat. Dan adapun website ini dibikin sebagai media informaasi sekolah kepada
                    masyarakat serta mempermudah dalam penerimaan siswa baru.</p>
            </div>
            <div class="contact-section">
                <h3>HUBUNGI KAMI</h3>
                <p>Jl.Pejanggik No.110 Cakra Negara Mataram-NTB</p>
                <p>Telepon/Fax : +62 370 645 695</p>
                <p>Email : smak_kesuma@yahoo.com</p>
            </div>
        </div>
    </footer>
@endsection
<!-- Profile Section -->
    {{-- <section class="profile">
        <h2>PROFIL SMA KATOLIK KESUMA MATARAM</h2>
        <div class="profile-content">
            <div class="video-container">
                @if ($youtubeVideos->isEmpty())
                    <p>Tidak ada video yang aktif.</p>
                    <iframe src="" frameborder="0" allowfullscreen></iframe>
                @else
                    @foreach ($youtubeVideos as $video)
                        <div>
                            <iframe src="{{ $video->url }}" frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="welcome-text">
                <h3>Sambutan Kepala Sekolah</h3>
                <p>Salam sejahtera... SMAK Kesuma Mataram adalah salah satu dari Satuan Pendidikan yang berada di bawah...
                </p>
                <a href="#" class="slider-button">Selengkapnya</a>
            </div>
        </div>
    </section> --}}
    <!-- Gallery Section -->