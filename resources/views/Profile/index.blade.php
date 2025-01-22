<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA KATOLIK KESUMA MATARAM</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f5f5f5;
}

/* Top Bar Styles */
.top-bar {
    background-color: #004b93;
    color: white;
    padding: 8px 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.contact-info span {
    margin-right: 20px;
    font-size: 14px;
}

.social-icons a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    font-size: 14px;
}

/* Header Styles */
header {
    background: white;
    padding: 20px 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 20px;
}

.logo-container img {
    width: 80px;
    height: auto;
}

.school-info h1 {
    color: #004b93;
    font-size: 24px;
    margin-bottom: 5px;
}

.motto {
    color: #666;
    font-size: 14px;
}

.search-bar {
    display: flex;
    gap: 10px;
}

.search-bar input {
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 250px;
}

.search-bar button {
    background-color: #004b93;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 4px;
    cursor: pointer;
}

/* Navigation Menu */
nav {
    background-color: #004b93;
    padding: 0 50px;
}

nav ul {
    list-style: none;
    display: flex;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 15px 20px;
    display: block;
    font-size: 14px;
    transition: background-color 0.3s;
}

nav ul li a:hover {
    background-color: #003972;
}

/* Main Content */
main {
    padding: 30px 50px;
    min-height: 400px;
}

.breadcrumb {
    margin-bottom: 30px;
    color: #666;
}

.breadcrumb a {
    color: #004b93;
    text-decoration: none;
}

.search-results h2 {
    color: #004b93;
    margin-bottom: 15px;
    font-size: 24px;
}

/* Footer Styles */
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

.school-description img {
    width: 100px;
    margin-bottom: 5px;
}

.school-description h2 {
    margin-bottom: 15px;
    font-size: 20px;
}

.school-description p {
    font-size: 14px;
    line-height: 1.6;
}

.contact-section h3,
.navigation-section h3 {
    margin-bottom: 20px;
    font-size: 18px;
}

.contact-section p {
    margin-bottom: 10px;
    font-size: 14px;
}

.navigation-section ul {
    list-style: none;
}

.navigation-section ul li {
    margin-bottom: 10px;
}

.navigation-section ul li a {
    color: white;
    text-decoration: none;
    font-size: 14px;
}

/* Responsive Adjustments */
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
    </style>
    <!-- Top Contact Bar -->
    <div class="top-bar">
        <div class="contact-info">
            <span>📞 +62 370 645 695</span>
            <span>📧 SMAK_KESUMA@YAHOO.COM</span>
        </div>
        <div class="social-icons">
            <a href="#" class="facebook">Facebook</a>
            <a href="#" class="instagram">Instagram</a>
            <a href="#" class="youtube">YouTube</a>
            <a href="#" class="whatsapp">WhatsApp</a>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="logo-container">
            {{-- <img src="url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png')" alt="Logo SMA Katolik Kesuma Mataram"> --}}
            <img src="{{ url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo SMA Katolik Kesuma Mataram">

            <div class="school-info">
                <h1>SMA KATOLIK KESUMA MATARAM</h1>
                <p class="motto">DISIPLIN-JUJUR-TERAMPIL-MANDIRI</p>
            </div>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Cari sesuatu...">
            <button type="submit">CARI</button>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav>
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

    <!-- Main Content -->
    <main>
        <div class="breadcrumb">
            <a href="#">Beranda</a> > Cari
        </div>
        
        <section class="search-results">
            <h2>Hasil Pencarian</h2>
            <p>Dari kata kunci : gatau</p>
            <!-- Search results content would go here -->
        </section>
    </main>

    <!-- Footer -->
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
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>