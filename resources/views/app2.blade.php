{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA KATOLIK KESUMA MATARAM</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

</html> --}}
{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMA KATOLIK KESUMA MATARAM')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   
</head>
<body>
    <!-- Top Bar -->
    @include('topbar')
  

    <!-- Header -->
    @include('header')
  

    <!-- Navbar -->
    @include('navbar')
    

    <!-- Main Content -->
        @yield('content')
    
    
    <!-- Footer -->
    @include('footer')
   
    @stack('scripts')
</body>
</html> --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMA KATOLIK KESUMA MATARAM')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        } */
         /* CSS Variables */
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

/* Base Styles */
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

/* Top Bar */
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

/* Header */
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

/* Navigation */
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
    background-color: rgba(255, 255, 255, 0.1);
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

/* Responsive Design for remaining components */
@media (max-width: 768px) {
    .top-bar .container,
    .logo-section,
    .navbar ul,
    .footer-content {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body>
    <!-- Top Bar -->
    @include('topbar')
  
    <!-- Header -->
    @include('header')
  
    <!-- Navbar -->
    @include('navbar')
    
    <!-- Main Content -->
        @yield('content')
    
    <!-- Footer -->
    @include('footer')
   
    @stack('scripts')
</body>
</html>
{{-- /* Container Styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background-color: #f8f9fa;
}

/* Slider Styles */
.slider-wrapper {
    margin-bottom: 3rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.slider {
    position: relative;
    width: 100%;
    margin-bottom: 2rem;
}

.slider-item {
    width: 100%;
    height: 500px;
    position: relative;
}

.slider-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px 8px 0 0;
}

/* Navigation Buttons */
.slider-nav button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.slider-nav button:hover {
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.slider-nav .prev {
    left: 20px;
}

.slider-nav .next {
    right: 20px;
}

/* Article Container */
.article-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2.5rem;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

/* Article Header */
.article-header {
    margin-bottom: 2.5rem;
    text-align: center;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 1.5rem;
}

.article-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.article-header p {
    font-size: 0.95rem;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

/* Article Body */
.article-body {
    color: #333;
    font-size: 1.1rem;
    line-height: 1.8;
}

.article-body p {
    margin-bottom: 1.8rem;
    text-align: justify;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }

    .slider-item {
        height: 300px;
    }

    .article-container {
        padding: 1.5rem;
    }

    .article-header h1 {
        font-size: 1.8rem;
    }

    .article-body {
        font-size: 1rem;
    }

    .slider-nav button {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
}

/* Typography Enhancements */
* {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

/* Animation */
.slider-item {
    transition: opacity 0.3s ease-in-out;
}

/* Print Styles */
@media print {
    .slider-nav {
        display: none;
    }

    .article-container {
        box-shadow: none;
    }
} --}}