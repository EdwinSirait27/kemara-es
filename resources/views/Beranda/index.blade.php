@extends('layouts.user_type.guest')
@section('title', 'SMAK KESUMA MATARAM')

@section('content')

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }
    
            /* Top Bar */
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
    
            /* Header */
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
                max-height: 400px;
                overflow: hidden;
            }
    
            .slider img {
                width: 100%;
                height: auto;
            }
    
            .slider-content {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0,0,0,0.7);
                color: white;
                padding: 15px;
            }
    
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
    .top-bar, header, nav, main, footer {
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
.navigation-section  ul li a {
            color: white; /* Mengganti warna link menjadi putih */
            text-decoration: none; /* Menghilangkan garis bawah pada link */
        }
.navigation-section  h3 {
            color: white; /* Mengganti warna link menjadi putih */

        }

        </style>
{{--    
</head>
<body> --}}

    <!-- Top Bar -->
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
            <a href="https://api.whatsapp.com/send/?phone=%2B6281353653008&text&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
        
    </div>

    <!-- Header -->
    <header class="header">
        <div class="logo-section">
            <img src="{{ asset('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo SMA Katolik Kesuma Mataram">
            <div class="school-title">
                <h1>SMA KATOLIK KESUMA MATARAM</h1>
                <p>DISIPLIN-JUJUR-TERAMPIL-MANDIRI</p>
            </div>
        </div>
        {{-- <div class="search-box">
            <input type="text" disabled>
            <button>Login</button>
        </div> --}}
    </header>

    <!-- Navigation -->
    {{-- <nav class="nav">
        <ul>
            <li><a href="#">BERANDA</a></li>
            <li><a href="#">PROFIL</a></li>
            <li><a href="#">SARANA & PRASARANA</a></li>
            <li><a href="#">EKSTRAKURIKULER</a></li>
            <li><a href="#">GURU / KARYAWAN</a></li>
            <li><a href="#">GALERI</a></li>
            <li><a href="#">INFORMASI</a></li>
            <li><a href="#">KONTAK</a></li>
        </ul>
    </nav> --}}

    <!-- Slider -->
    <br>
    <div class="slider">
        <img src="slide1.jpg" alt="Slider Image">
        <div class="slider-content">
            <h3>Kunjungan Dari Kemenag Kota Mataram</h3>
            <p>Senin, 16/1/2023 pukul 11.00 wita, Kunjungan dari Kemenag Kota Mataram...</p>
            <a href="#" class="slider-button">Selengkapnya</a>
        </div>
        <div class="slider-nav">
            <button class="prev">❮</button>
            <button class="next">❯</button>
        </div>
    </div>

    <!-- Profile Section -->
    <section class="profile">
        <h2>PROFIL SMA KATOLIK KESUMA MATARAM</h2>
        <div class="profile-content">
            <div class="video-container">
              
                @if ($youtubeVideos->isEmpty())
                <p>Tidak ada video yang aktif.</p>
                <!-- Iframe kosong -->
                <iframe src="" frameborder="0" allowfullscreen></iframe>
    @else
        @foreach ($youtubeVideos as $video)
            <div>
                <iframe 
                  src="{{ ($video->url) }}" 
                    frameborder="0" 
                    allowfullscreen>
                </iframe>
            </div>
        @endforeach
    @endif
            </div>
            <div class="welcome-text">
                <h3>Sambutan Kepala Sekolah</h3>
                <p>Salam sejahtera... SMAK Kesuma Mataram adalah salah satu dari Satuan Pendidikan yang berada di bawah...</p>
                <a href="#" class="slider-button">Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <h2>GALERI & DOKUMENTASI</h2>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="gallery1.jpg" alt="Foto Siswa dan Guru">
                <p>Foto Siswa dan Guru</p>
            </div>
            <div class="gallery-item">
                <img src="gallery2.jpg" alt="Dokumentasi">
                <p>Dokumentasi</p>
            </div>
            <div class="gallery-item">
                <img src="gallery3.jpg" alt="Acara Murid">
                <p>Acara Murid</p>
            </div>
        </div>
    </section>
{{-- </body>
</html> --}}
<footer>
    <div class="footer-content">
        <div class="school-description">
            {{-- <img src="logo.png" alt="Logo Footer"> --}}
        <img src="{{ url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo Footer">

            <h2>SMA KATOLIK KESUMA MATARAM</h2>
            <p>SMAK Kesuma Mataram adalah singkatan dari Sekolah Menengah Atas Katolik Kesuma. Kata Kesuma singkatan dari Keerdasan Suluh Masyarakat. Dan adapun website ini dibikin sebagai media informaasi sekolah kepada masyarakat serta mempermudah dalam penerimaan siswa baru.</p>
        </div>

        <div class="contact-section">
            <h3>HUBUNGI KAMI</h3>
            <p>Jl.Pejanggik No.110 Cakra Negara Mataram-NTB</p>
            <p>Telepon/Fax : +62 370 645 695</p>
            <p>Email : smak_kesuma@yahoo.com</p>
        </div>

        <div class="navigation-section">
            <h3>NAVIGASI</h3>
            <ul>
                <li><a href="#">Profil Sekolah</a></li>
                <li><a href="#">Informasi & Berita</a></li>
                <li><a href="#">Galeri / Dokumentasi</a></li>
                
            </ul>
        </div>
    </div>
</footer>
@endsection