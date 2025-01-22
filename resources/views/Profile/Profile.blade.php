<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA KATOLIK KESUMA MATARAM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Top Bar */
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

        /* Header */
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

        /* Navigation */
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

        /* Slider Section */
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

        /* Profile Section */
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

        /* Gallery Section */
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

        /* Slider Navigation */
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
            <a href="#"><span>Facebook</span></a>
            <a href="#"><span>Instagram</span></a>
            <a href="#"><span>YouTube</span></a>
        </div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="logo-section">
            <img src="logo.png" alt="Logo SMA Katolik Kesuma Mataram">
            <div class="school-title">
                <h1>SMA KATOLIK KESUMA MATARAM</h1>
                <p>DISIPLIN-JUJUR-TERAMPIL-MANDIRI</p>
            </div>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Cari sesuatu...">
            <button>CARI</button>
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
                <iframe src="https://www.youtube.com/embed/video-id" frameborder="0" allowfullscreen></iframe>
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