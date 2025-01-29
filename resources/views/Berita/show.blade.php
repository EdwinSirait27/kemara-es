@extends('app2') 
@section('content')
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
    position: relative;
    margin-bottom: 30px;
    border-radius: 8px;
    overflow: hidden;
}

.slider-item {
    display: none;
}

.slider-item img.slider-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.slider-item img.slider-image:hover {
    transform: scale(1.02);
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
/* .container {
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
    position: relative;
    margin-bottom: 30px;
    border-radius: 8px;
    overflow: hidden;
}

.slider-item {
    display: none;
}

.slider-item img.slider-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.slider-item img.slider-image:hover {
    transform: scale(1.02);
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
} */
 /* Modern Container Styles */
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
<div class="container">
    <h1>{{$berita->header}}</h1>
    <div class="slider-wrapper">
        <div class="slider">
            @for ($i = 1; $i <= 8; $i++)
                @php $gambar = 'gambar' . $i; @endphp
                @if (!empty($berita->$gambar))
                    <div class="slider-item">
                        <img src="{{ asset('storage/berita/' . $berita->$gambar) }}" alt="{{ $berita->header }}" class="slider-image">
                    </div>
                @endif
            @endfor
        
            <div class="slider-nav">
                <button class="prev" style="display: none;">❮</button>
                <button class="next" style="display: none;">❯</button>
            </div>
        </div>
        
        <div class="slider-content" style="text-align: justify;">
            @php
                $bodyText = str($berita->body);
                $words = explode(' ', $bodyText);
                $chunks = array_chunk($words, 50);
            @endphp
        
            @foreach ($chunks as $chunk)
                <p>{{ implode(' ', $chunk) }}</p>
            @endforeach
            <div class="author-info" style="margin-top: 20px; font-size: 14px; color: #555;">
                <p><strong>Pembuat:</strong> {{ $berita->User->Guru->Nama }}</p>
                <p><strong>Dipublikasikan:</strong> {{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}</p>
            </div>
        </div>
        
        <style>
            .slider-content p {
                margin-bottom: 1em;
            }
        </style>
        
        
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
{{-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">

    <title>{{$berita->header}}</title>
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
            display: flex;
    justify-content: center;
    align-items: center; 
    height: 100%; 
    text-align: center;
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
  
    <div class="container">
        <h1>{{$berita->header}}</h1>
        <div class="slider-wrapper">
            <div class="slider">
                @for ($i = 1; $i <= 8; $i++)
                    @php $gambar = 'gambar' . $i; @endphp
                    @if (!empty($berita->$gambar))
                        <div class="slider-item">
                            <img src="{{ asset('storage/berita/' . $berita->$gambar) }}" alt="{{ $berita->header }}" class="slider-image">
                        </div>
                    @endif
                @endfor
            
                <div class="slider-nav">
                    <button class="prev" style="display: none;">❮</button>
                    <button class="next" style="display: none;">❯</button>
                </div>
            </div>
            
            <div class="slider-content" style="text-align: justify;">
                @php
                    $bodyText = str($berita->body);
                    $words = explode(' ', $bodyText);
                    $chunks = array_chunk($words, 50);
                @endphp
            
                @foreach ($chunks as $chunk)
                    <p>{{ implode(' ', $chunk) }}</p>
                @endforeach
                <div class="author-info" style="margin-top: 20px; font-size: 14px; color: #555;">
                    <p><strong>Pembuat:</strong> {{ $berita->User->Guru->Nama }}</p>
                    <p><strong>Dipublikasikan:</strong> {{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}</p>
                </div>
            </div>
            
            <style>
                .slider-content p {
                    margin-bottom: 1em;
                }
            </style>
            
            
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
</html>  --}}
