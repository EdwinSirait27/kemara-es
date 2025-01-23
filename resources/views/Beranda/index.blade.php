<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <title>SMA KATOLIK KESUMA MATARAM</title>
    {{-- <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .top-bar {
            background-color: #004b93;
            color: white;
            padding: 8px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .social-icons a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }

        .header {
            background: white;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-section img {
            width: 60px;
        }

        .school-title {
            color: #004b93;
        }

        .school-title p {
            color: #666;
            font-size: 14px;
        }

        .search-box {
            display: flex;
            gap: 10px;
        }

        .search-box input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-box button {
            background: #004b93;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
        }

        .nav {
            background: #004b93;
            padding: 0 50px;
        }

        .nav ul {
            list-style: none;
            display: flex;
        }

        .nav ul li a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
        }

        .slider {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .slider-content h3 {
            color: #004b93;
            margin-bottom: 10px;
        }

        .slider-button {
            background: #004b93;
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            border-radius: 4px;
        }

        .profile {
            padding: 50px;
            text-align: center;
        }

        .profile h2 {
            color: #004b93;
            margin-bottom: 30px;
        }

        .profile-content {
            display: flex;
            gap: 30px;
            align-items: start;
        }

        .video-container {
            flex: 1;
        }

        .video-container iframe {
            width: 100%;
            aspect-ratio: 16/9;
        }

        .welcome-text {
            flex: 1;
            text-align: left;
            line-height: 1.6;
        }

        .gallery {
            padding: 50px;
            text-align: center;
        }

        .gallery h2 {
            color: #004b93;
            margin-bottom: 30px;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .gallery-item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 3px;
        }

        .gallery-item p {
            margin-top: 10px;
            color: #666;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .slider-nav button {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .profile-content {
                flex-direction: column;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            
            .nav ul {
                flex-direction: column;
            }
        }
    </style> --}}
    
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
        </style>
   
</head>
<body>
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
        <div class="search-box">
            <input type="text" disabled>
            <button>Login</button>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav">
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
    </nav>

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
                <iframe 
                    src="https://www.youtube.com/embed/Cfv19SQd11w?si=2FlbXMhS1NpjjIdg&autoplay=1&mute=0"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
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
</body>
</html>