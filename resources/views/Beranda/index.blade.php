<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA KATOLIK KESUMA MATARAM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004b93;
            --secondary-color: #159895;
            --accent-color: #57c5b6;
            --light-background: #f0f9ff;
            --third-color: black;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-background);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;

        }
       

        /* Top Bar */
        .top-bar {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 0;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact-info span {
            margin-right: 15px;
            font-size: 0.9rem;
        }

        .social-icons a {
            color: white;
            margin-left: 10px;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--accent-color);
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px 0;
        }

        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .logo-section img {
            width: 100px;
            height: auto;
        }

        .school-title h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .school-title p {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        /* Navigation */
        .navbar {
            background-color: var(--primary-color);
        }

        .navbar ul {
            display: flex;
            list-style: none;
            justify-content: center;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .navbar ul li a:hover {
            background-color: var(--secondary-color);
        }

        /* Slider */
        .slider {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin: 20px 0;
        }
        .container h1 {
    color: var(--primary-color);
    margin-bottom: 20px;
    margin-top: 20px;
    text-align: center; /* Pusatkan teks secara horizontal */
}


        .slider-item {
            display: flex;
            align-items: center;
        }

        .slider-image {
            width: 50%;
            object-fit: cover;
        }

        .slider-content {
            padding: 20px;
            width: 50%;
        }

        .slider-title {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: var(--light-background);
        }

        .slider-nav button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slider-nav button:hover {
            background-color: var(--primary-color);
        }

        /* Profile Section */
        .profile {
            padding: 40px 0;
            text-align: center;
        }

        .profile h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .profile-content {
            display: flex;
            gap: 20px;
        }

        .video-container {
            flex: 1;
        }

        .video-container iframe {
            width: 100%;
            height: 300px;
            border-radius: 10px;
        }

        .welcome-text {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .school-description img {
            width: 100px;
            margin-bottom: 15px;
        }

        .school-description h2 {
            margin-bottom: 10px;
            color: white;
        }

        .contact-section h3 {
            margin-bottom: 15px;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .top-bar .container,
            .logo-section,
            .navbar ul,
            .profile-content,
            .footer-content {
                flex-direction: column;
                align-items: center;
            }

            .slider-item {
                flex-direction: column;
            }

            .slider-image,
            .slider-content {
                width: 100%;
            }

            .video-container iframe {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="container">
            <div class="contact-info">
                <span>📞 +62 370 645 695</span>
                <span>📧 SMAK_KESUMA@YAHOO.COM</span>
            </div>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="logo-section">
                <img src="{{ url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo SMA Katolik Kesuma Mataram">
                <div class="school-title">
                    <h1>SMA KATOLIK KESUMA MATARAM</h1>
                    <p>DISIPLIN-JUJUR-TERAMPIL-MANDIRI</p>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <ul>
                <li><a href="#">BERANDA</a></li>
                <li><a href="#">LOGIN</a></li>
                <li><a href="#">PROFIL</a></li>
                <li><a href="#">AKADEMIK</a></li>
                <li><a href="#">KONTAK</a></li>
            </ul>
        </div>
    </nav>
@if($beritas->isNotEmpty())
<div class="container">
    <h1>BERITA TERKINI SMA KATOLIK KESUMA MATARAM</h1>
    <div class="slider">
            <div class="slider-item">
                <img src="{{ asset('storage/berita/' . $beritas[0]->gambar1) }}" alt="{{ $beritas[0]->header }}"  class="slider-image">
                <div class="slider-content">
                    <h3 class="slider-title">{{ $beritas[0]->header }}</h3>
                    <p>{{ str($beritas[0]->body)->limit(100) }}</p>
                    <a href="{{ route('Berita.show', ['hashedId' => $beritas[0]->hashedId]) }}" class="btn btn-primary slider-link">
                        Lihat Berita
                    </a>

                </div>
            </div>
            <div class="slider-nav">
                <button class="prev">❮</button>
                <button class="next">❯</button>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    const sliderItem = document.querySelector('.slider-item');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const beritas = @json($beritas);

    if (beritas.length > 1) {
        let currentIndex = 0;

        function updateSlider() {
            if (beritas.length > 0) {
                const currentBerita = beritas[currentIndex];
                
                // Update image
                sliderItem.querySelector('.slider-image').src = 
                    `/storage/berita/${currentBerita.gambar1}`;
                
                // Update title
                sliderItem.querySelector('.slider-title').textContent = 
                    currentBerita.header;
                
                // Update body text (limit to 100 characters)
                sliderItem.querySelector('.slider-content p').textContent = 
                    currentBerita.body.length > 100 
                        ? currentBerita.body.substring(0, 100) + '...' 
                        : currentBerita.body;
                
                // Update link
                const link = sliderItem.querySelector('.slider-link');
                link.href = `/berita/${currentBerita.hashedId}`;
            }
        }

        // Previous button functionality
        prevButton.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + beritas.length) % beritas.length;
            updateSlider();
        });

        // Next button functionality
        nextButton.addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % beritas.length;
            updateSlider();
        });
    } else {
        // Hide navigation buttons if only one news item
        prevButton.style.display = 'none';
        nextButton.style.display = 'none';
    }
});
        </script>
@endif
        <section class="profile">
            <h2>PROFIL SMA KATOLIK KESUMA MATARAM</h2>
            <div class="profile-content">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="welcome-text">
                    <h3>Sambutan Kepala Sekolah</h3>
                    <p>Salam sejahtera... SMAK Kesuma Mataram adalah salah satu Satuan Pendidikan yang berkomitmen untuk menghasilkan lulusan berkualitas...</p>
                    <a href="#" class="btn">Selengkapnya</a>
                </div>
            </div>
        </section>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="school-description">
                    <img src="{{ url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}" alt="Logo Footer">
                    <h2>SMA KATOLIK KESUMA MATARAM</h2>
                    <p>SMAK Kesuma Mataram adalah lembaga pendidikan yang berdedikasi untuk mengembangkan potensi siswa melalui pendidikan berkualitas dan berkarakter.</p>
                </div>
                <div class="contact-section">
                    <h3>HUBUNGI KAMI</h3>
                    https://nlink.at/KHul

                    <p><i class="fas fa-map-marker-alt"></i> Jl. Pejanggik No. 110 Cakra Negara</p>

                    <p>Mataram, Nusa Tenggara Barat</p>
                    <p><i class="fas fa-phone"></i>+62 370 645 695</p>
                    <p>Email: smak_kesuma@yahoo.com</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA KATOLIK KESUMA MATARAM</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>

{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f5f5f5;
}

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
    <nav>
        <ul>
            <li><a href="#">BERANDA</a></li>
            <li><a href="#">LOGIN</a></li>
           
        </ul>
    </nav>
    <br>
    
        @if($beritas->isNotEmpty())
        <div class="slider">
        <h2>BERITA SMAK KESUMA MATARAM</h2>

            <div class="slider-item" id="slider-item-1">
                <img src="{{ asset('storage/berita/' . $beritas[0]->gambar1) }}" alt="{{ $beritas[0]->header }}" class="slider-image">
                <div class="slider-content">
                    <h3 class="slider-title">{{ $beritas[0]->header }}</h3>
                    <p class="slider-body">{{ str($beritas[0]->body)->limit(100) }}</p>
                    <a href="{{ route('Berita.show', ['hashedId' => $beritas[0]->hashedId]) }}" class="btn btn-primary slider-link">
                        Lihat Berita
                    </a>
                </div>
            </div>
            <div class="slider-nav">
                <button class="prev" onclick="moveSlider(-1)">❮</button>
                <button class="next" onclick="moveSlider(1)">❯</button>
            </div>
        </div>
    @endif
    <br>
    <br>
    <br>
    <script>
        let currentIndex = 0;
        const beritas = @json($beritas);
    
        function updateSlider() {
            if (beritas.length === 0) return;
            
            const sliderItem = document.getElementById('slider-item-1');
            const berita = beritas[currentIndex];
    
            if (!berita.hashedId) {
                console.error('hashedId tidak tersedia');
                return;
            }
    
            sliderItem.querySelector('.slider-image').src = '/storage/berita/' + berita.gambar1;
            sliderItem.querySelector('.slider-title').innerText = berita.header;
            sliderItem.querySelector('.slider-body').innerText = berita.body.substring(0, 100) + '...';
            sliderItem.querySelector('.slider-link').href = "{{ route('Berita.show', ':hashedId') }}".replace(':hashedId', berita.hashedId);
        }
    
        function moveSlider(direction) {
            currentIndex += direction;
            if (currentIndex < 0) {
                currentIndex = beritas.length - 1;
            } else if (currentIndex >= beritas.length) {
                currentIndex = 0;
            }
            updateSlider();
        }
    
        updateSlider();
    </script>
        
        <section class="profile">
            <h2>PROFIL SMA KATOLIK KESUMA MATARAM</h2>
            <div class="profile-content">
                <div class="video-container">
                    @if ($youtubeVideos->isEmpty())
                        <p>Tidak ada video yang aktif.</p>
                        <iframe src="" frameborder="0" allowfullscreen></iframe>
                    @else
                        @foreach ($youtubeVideos as $video)
                            <div>
                                <iframe src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
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

</body>
</html> --}}
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
    {{-- <section class="gallery">
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
    </section> --}}