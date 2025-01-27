<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA KATOLIK KESUMA MATARAM</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004b93;
            --secondary-color: #159895;
            --accent-color: #57c5b6;
            --light-background: #f0f9ff;
            --third-color: black;
            --text-color: #333;
            --white: #ffffff;
            --soft-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --hover-transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-background);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;

        }


        .top-bar {
            background-color: var(--primary-color);
            color: var(--white);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

            padding: 12px 0;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;

        }

        .contact-info span {
            margin-right: 15px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .social-icons a {
            color: white;
            margin-left: 10px;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            transition: var(--hover-transition);
            opacity: 0.8;
        }

        .social-icons a:hover {
            opacity: 1;
            transform: scale(1.1);
            color: var(--accent-color);
        }

        .header {
            background: white;
            box-shadow: var(--soft-shadow);
            padding: 20px 0;
        }

        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            transition: var(--hover-transition);
        }

        .logo-section:hover {
            transform: scale(1.02);
        }

        .logo-section img {
            width: 100px;
            height: auto;
            border-radius: 10px;
            box-shadow: var(--soft-shadow);
        }

        .school-title h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .school-title p {
            color: var(--primary-color);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);

        }

        .navbar ul {
            display: flex;
            list-style: none;
            justify-content: center;
            gap: 10px;

        }

        .main-content {
            display: flex;
            gap: 30px;
            margin: 30px 0;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            /* transition: background-color 0.3s ease; */
            transition: var(--hover-transition);
            position: relative;
            font-weight: 500;
        }

        .navbar ul li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--accent-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .navbar ul li a:hover::after {
            transform: scaleX(1);
        }

        .navbar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);

        }

        .slider {
            height: 800px; 
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--soft-shadow);
            transition: var(--hover-transition);
            margin: 20px 0;
        }

        .slider:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }


        .container h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .slider-section {
            flex: 3;
        }

        .news-list {
            flex: ;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--soft-shadow);
            max-height: 800px;
            overflow-y: auto;
        }

        .news-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: var(--hover-transition);
        }

        .news-item:hover {
            background-color: var(--light-background);
            transform: translateX(5px);
        }

        .news-item h4 {
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .news-item .news-meta {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 8px;
        }

        .news-item p {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .news-item .read-more {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--hover-transition);
        }

        .news-item .read-more:hover {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .news-list {
                max-height: 400px;
            }
        }

        .slider-item {
            height: 550px;
            display: flex;
            align-items: right;
            flex-direction: column;
        }

        .slider-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;

        }

        .slider-image:hover {
            transform: scale(1.05);
        }

        .slider-content {
            padding: 20px;
            width: 50%;
        }

        .slider-title {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 2rem;

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
            transition: var(--hover-transition);

        }

        .slider-nav button:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile {
            padding: 40px 0;
            text-align: center;
            background-color: var(--white);

        }

        .profile h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .profile-content {
            display: flex;
            gap: 20px;
            align-items: stretch;

        }

        .video-container {
            flex: 1;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--soft-shadow);
            transition: var(--hover-transition);
        }

        .video-container:hover {
            transform: scale(1.02);
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
            box-shadow: var(--soft-shadow);
            flex-direction: column;
            justify-content: space-between;
        }

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
                <span><i class="fas fa-phone"></i> +62 370 645 695</span>
                <span><i class="fab fa-yahoo"></i> SMAK_KESUMA@YAHOO.COM</span>

            </div>
            <div class="social-icons">
                <a href="https://web.facebook.com/SMAK.KESUMA.MATARAM/?_rdc=1&_rdr#" target="_blank"><i
                        class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/smak.kesuma.mtr/" target="_blank"><i
                        class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/@smakkesumamataram" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="https://api.whatsapp.com/send/?phone=%2B6281353653008&text&type=phone_number&app_absent=0"
                    target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="logo-section">
                <img src="{{ url('/assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}"
                    alt="Logo SMA Katolik Kesuma Mataram">
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
                <li><a href="{{ route('Beranda.index') }}">BERANDA</a></li>
                <li><a href="#">BERITA</a></li>
                <li><a href="{{ route('login') }}">LOGIN</a></li>

            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="main-content">
            <div class="slider-section">
                @if ($beritas->isNotEmpty())
                    <div class="slider">
                        <div class="slider-item">
                            <img src="{{ asset('storage/berita/' . $beritas[0]->gambar1) }}"
                                alt="{{ $beritas[0]->header }}" class="slider-image">
                            <div class="slider-content">
                                <h3 class="slider-title">{{ $beritas[0]->header }}</h3>
                                <p>{{ str($beritas[0]->body)->limit(100) }}</p>

                                <p class="author-info">
                                    Ditulis oleh: <strong>{{ $beritas[0]->User->Guru->Nama }}</strong>
                                    <span style="color: gray;">{{ $beritas[0]->created_at->diffForHumans() }}</span>
                                </p>

                                <a href="{{ route('Berita.show', ['id' => $beritas[0]->id]) }}"
                                    class="btn btn-primary slider-link">
                                    Lihat Berita
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
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

                    // Early return if not enough items
                    if (beritas.length <= 1) {
                        prevButton.style.display = 'none';
                        nextButton.style.display = 'none';
                        return;
                    }

                    let currentIndex = 0;

                    // Cache DOM elements to avoid repeated querying
                    const sliderImage = sliderItem.querySelector('.slider-image');
                    const sliderTitle = sliderItem.querySelector('.slider-title');
                    const sliderContent = sliderItem.querySelector('.slider-content p');
                    const sliderLink = sliderItem.querySelector('.slider-link');

                    function updateSlider() {
                        const currentBerita = beritas[currentIndex];

                        // Optimize image path
                        sliderImage.src = `/storage/berita/${currentBerita.gambar1 || 'default.jpg'}`;

                        // Safely set text content
                        sliderTitle.textContent = currentBerita.header || 'Judul Berita';

                        // Improved text truncation
                        sliderContent.textContent = currentBerita.body ?
                            (currentBerita.body.length > 100 ?
                                currentBerita.body.substring(0, 100) + '...' :
                                currentBerita.body) :
                            'Tidak ada konten';

                        // Update link with error handling
                        sliderLink.href = currentBerita.id ?
                            `/Berita/show/${currentBerita.id}` :
                            '#';
                    }

                    // Optimize navigation with modulo arithmetic
                    function navigateSlider(direction) {
                        currentIndex = (currentIndex + direction + beritas.length) % beritas.length;
                        updateSlider();
                    }

                    // Event listeners with more robust handling
                    prevButton.addEventListener('click', () => navigateSlider(-1));
                    nextButton.addEventListener('click', () => navigateSlider(1));

                    // Initial render
                    updateSlider();
                });
            </script>
              <div class="news-list">
                <h3>Berita Terbaru</h3>
                @foreach($beritas as $berita)
                <div class="news-item">
                    <h4>{{ $berita->header }}</h4>
                    <div class="news-meta">
                        <span><i class="fas fa-user"></i> {{ $berita->User->Guru->Nama }}</span>
                        <span><i class="fas fa-clock"></i> {{ $berita->created_at->diffForHumans() }}</span>
                    </div>
                    <p>{{ str($berita->body)->limit(50) }}</p>
                    <a href="{{ route('Berita.show', ['id' => $berita->id]) }}" class="read-more">
                        Baca selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
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
                        @if ($profiles->isEmpty())
                        <p>Tidak ada Profile.</p>
                        
                    @else
                        @foreach ($profiles as $profile)
                        <h3>{{$profile->header}}</h3>
                        
                        <p>{{ str($berita->body)->limit(100) }}</p>
                        <a href="{{ route('Profile.show', ['id' => $profile->id]) }}" class="read-more">
                            Baca selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                        @endforeach
                    @endif
                     
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
                        <p>SMAK Kesuma Mataram adalah lembaga pendidikan yang berdedikasi untuk mengembangkan potensi
                            siswa melalui pendidikan berkualitas dan berkarakter.</p>
                    </div>
                    <div class="contact-section">
                        <h3>HUBUNGI KAMI</h3>

                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="https://nlink.at/KHul" target="_blank" style="color: white;">
                                Jl. Pejanggik No. 110 Cakra Negara
                            </a>
                        </p>


                        <p>Mataram, Nusa Tenggara Barat</p>
                        <p><i class="fas fa-phone"></i>+62 370 645 695</p>
                        <p>Email: smak_kesuma@yahoo.com</p>
                    </div>
                </div>
            </div>
        </footer>
</body>

</html>
