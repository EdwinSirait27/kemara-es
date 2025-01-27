<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">

    <title>{{$profile->header}}</title>
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
    --soft-shadow: 0 4px 6px rgba(0,0,0,0.1);
    --hover-transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
    scroll-behavior: smooth;
        }

        body {
            font-family:'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);

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
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);

        }

        .navbar ul {
            display: flex;
            list-style: none;
            justify-content: center;
    gap: 10px;

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
            background-color: rgba(255,255,255,0.1);

        }

        .slider {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--soft-shadow);
            transition: var(--hover-transition);

            margin: 20px 0;
        }
        .slider:hover {
    box-shadow: 0 8px 15px rgba(0,0,0,0.15);
}


        .container h1 {
    color: var(--primary-color);
    margin-bottom: 20px;
    margin-top: 20px;
    text-align: center;
}


        .slider-item {
            /* display: flex;
            align-items: center; */
            display: flex;
    justify-content: center; /* Center secara horizontal */
    align-items: center; /* Center secara vertikal */
    height: 100%; /* Pastikan induk memiliki tinggi penuh */
    text-align: center; /* Opsional, untuk memastikan teks juga di tengah */
        }

        .slider-image {
            width: 50%;
            height: 50%;
            object-fit: cover;
    transition: transform 0.4s ease;

        }
        .slider-image:hover {
    transform: scale(1.05);
}

        .slider-content {
            padding: 20px;
            width: 100%;
            text-align: justify;
        }

        .slider-title {
            color: var(--primary-color);
            margin-bottom: 10px;
    font-size: 1.5rem;

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
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
                <li><a href="{{ route('login') }}">LOGIN</a></li>

            </ul>
        </div>
    </nav>
        {{-- <div class="container">
            <h1>profile TERKINI SMA KATOLIK KESUMA MATARAM</h1>
            <div class="slider">
                <div class="slider-item">
                    <img src="{{ asset('storage/profile/' . $profile->gambar1) }}" alt="{{ $profile->header }}"
                        class="slider-image">
                    <div class="slider-content">
                        <h3 class="slider-title">{{ $profile->header }}</h3>
                        <p>{{ str($profile->body)->limit(100) }}</p>
                       

                    </div>
                </div>
                <div class="slider-nav">
                    <button class="prev">❮</button>
                    <button class="next">❯</button>
                </div>
            </div>
           
   
    </div> --}}
    <div class="container">
        <h1>{{$profile->header}}</h1>
        <div class="slider-wrapper">
            <!-- Slider Section -->
            <div class="slider">
                <!-- Dynamic Slider Items -->
                @for ($i = 1; $i <= 8; $i++)
                    @php $gambar = 'gambar' . $i; @endphp
                    @if (!empty($profile->$gambar))
                        <div class="slider-item">
                            <img src="{{ asset('storage/profile/' . $profile->$gambar) }}" alt="{{ $profile->header }}" class="slider-image">
                        </div>
                    @endif
                @endfor
            
                <!-- Navigation Buttons -->
                <div class="slider-nav">
                    <button class="prev" style="display: none;">❮</button>
                    <button class="next" style="display: none;">❯</button>
                </div>
            </div>
            
            <!-- Slider Content Section -->
            <div class="article-container" style="font-family: Arial, sans-serif; line-height: 1.8; color: #333;">
                <!-- Judul Artikel -->
                <div class="article-header" style="margin-bottom: 20px; text-align: center;">
                    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">{{ $profile->title }}</h1>
                    <p style="font-size: 14px; color: #777;">
                        <strong>Pembuat:</strong> {{ $profile->User->Guru->Nama }} |
                        <strong>Dipublikasikan:</strong> {{ \Carbon\Carbon::parse($profile->created_at)->diffForHumans() }}
                    </p>
                </div>
            
                <!-- Konten Artikel -->
                <div class="article-body" style="text-align: justify;">
                    @php
                        // Memecah teks menjadi paragraf setiap 50 kata
                        $bodyText = str($profile->body);
                        $words = explode(' ', $bodyText);
                        $chunks = array_chunk($words, 50);
                    @endphp
            
                    @foreach ($chunks as $chunk)
                        <p style="margin-bottom: 15px;">{{ implode(' ', $chunk) }}</p>
                    @endforeach
                </div>
            </div>
            
          
            
            <style>
                .slider-content p {
                    margin-bottom: 1em; /* Jarak antar-paragraf */
                }
                .article-container {
                    max-width: 800px;
                    margin: 0 auto; /* Pusatkan artikel di tengah halaman */
                    padding: 20px;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
            
                .article-header h1 {
                    color: #222;
                }
            
                .article-body p {
                    font-size: 16px;
                    line-height: 1.8;
                }
            
            </style>
            
            
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const sliderItems = document.querySelectorAll(".slider-item");
                    const prevButton = document.querySelector(".slider-nav .prev");
                    const nextButton = document.querySelector(".slider-nav .next");
                    let currentSlide = 0;
            
                    // Show navigation buttons if there is more than one image
                    if (sliderItems.length > 1) {
                        prevButton.style.display = "block";
                        nextButton.style.display = "block";
                    }
            
                    // Function to update slide visibility
                    function updateSlides() {
                        sliderItems.forEach((item, index) => {
                            item.style.display = index === currentSlide ? "block" : "none";
                        });
                    }
            
                    // Navigate to previous slide
                    prevButton.addEventListener("click", function () {
                        currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
                        updateSlides();
                    });
            
                    // Navigate to next slide
                    nextButton.addEventListener("click", function () {
                        currentSlide = (currentSlide + 1) % sliderItems.length;
                        updateSlides();
                    });
            
                    // Initialize the slider
                    updateSlides();
                });
            </script>
  
</div>
</div>
<br>
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
