<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    {{-- <title>@yield('title', 'SMA KATOLIK KESUMA MATARAM')</title> --}}
    <title>@yield('title')</title>

    <meta name="description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform yang dirancang khusus untuk memfasilitasi data di lembaga pendidikan sekolah...')">
    <meta name="keywords" content="@yield('meta_keywords', 'SMAK Kesuma Mataram, Sistem Informasi Akademik, Pendidikan')">
    <meta name="author" content="SMAK Kesuma Mataram">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Language Alternatives -->
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="id" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}/en">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'SMA KATOLIK KESUMA MATARAM')">
    <meta property="og:description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform...')">
    <meta property="og:image" content="{{ asset('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}">
<meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SMA KATOLIK KESUMA MATARAM')">
    <meta name="twitter:description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform...')">
    <meta name="twitter:image" content="@yield('meta_image', asset('assets/img/Shield_Logos__SMAK_KESUMA-ConvertImage_55x55.jpg'))">
    
    <!-- PWA -->
    <meta name="theme-color" content="#4a90e2">
    
    <!-- Resource Hints -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">

<link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <!-- Structured Data -->
  <!-- Di dalam tag <head> di app2.blade.php -->
    <script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "School",
        "name": "SMA KATOLIK KESUMA MATARAM",
        "description": "Sistem Informasi Akademik Kemara-ES adalah platform yang dirancang khusus untuk memfasilitasi data di lembaga pendidikan sekolah",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Pejanggik No. 102",
            "addressLocality": "Mataram",
            "addressRegion": "NTB",
            "postalCode": "83238",
            "addressCountry": "ID"
        },
        "url": "{{ url()->current() }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}",
            "width": "1200",
            "height": "630",
            "caption": "Logo SMA KATOLIK KESUMA MATARAM"
        },
        "image": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/img/Shield_Logos__SMAK_KESUMAaaaa.png') }}",
            "width": "1200",
            "height": "630"
        },
        "sameAs": [
            "https://www.facebook.com/SMAK.KESUMA.MATARAM/?_rdc=2&_rdr#",
            "https://www.instagram.com/smak.kesuma.mtr/",
            "https://www.youtube.com/@smakkesumamataram",
            https://www.tiktok.com/@smakkesuma.mtr

        ]
    }
    </script>
</script>

    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
    :root {
        /* 004b93
        2563eb */
        --primary-color: #004b93;
        --secondary-color: #2563eb;
        --accent-color: #60a5fa;
        --light-background: #f8fafc;
        --text-color: #1e293b;
        --white: #ffffff;
        --gradient-primary: linear-gradient(135deg, #004b93 0%, #2563eb 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --card-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
        --hover-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --blur-effect: blur(10px);
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        scroll-behavior: smooth;
    }
    
    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        line-height: 1.7;
        color: var(--text-color);
        background: 
            radial-gradient(circle at 0% 0%, rgba(37, 99, 235, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 100% 100%, rgba(96, 165, 250, 0.1) 0%, transparent 50%),
            var(--light-background);
    }
    
    /* Modern Glassmorphism Top Bar */
    .top-bar {
        background: var(--glass-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border-bottom: 100px solid #004b93;
        position: relative;
        z-index: 1000;
    }
    
    .top-bar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
        padding: 1rem 2rem;
    }
    
    .contact-info span {
        margin-right: 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-color);
        font-weight: 500;
    }
    
    .social-icons a {
        color: var(--primary-color);
        margin-left: 1.5rem;
        font-size: 1.25rem;
        transition: var(--hover-transition);
        display: inline-flex;
        align-items: center;
    }
    
    .social-icons a:hover {
        transform: translateY(-3px) scale(1.1);
        color: var(--secondary-color);
    }
    
    /* Modern Header with Animation */
    .header {
        background: var(--white);
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }
    
    .header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
    }
    
    .logo-section {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem 2rem;
        position: relative;
    }
    
    .logo-section img {
        width: 130px;
        height: auto;
        border-radius: 1rem;
        transition: var(--hover-transition);
        box-shadow: var(--card-shadow);
    }
    
    .logo-section:hover img {
        transform: translateY(-5px) rotate(2deg);
    }
    
    .school-title h1 {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -0.03em;
        line-height: 1.2;
    }
    
    /* Modern Floating Navbar */
    .navbar {
        background: var(--glass-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border-radius: 1rem;
        margin: 1rem auto;
        max-width: 1200px;
        position: sticky;
        top: 1rem;
        z-index: 1000;
        box-shadow: var(--card-shadow);
    }
    
    .navbar ul {
        display: flex;
        list-style: none;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.5rem;
    }
    
    .navbar ul li a {
        color: var(--text-color);
        text-decoration: none;
        padding: 1rem 1.5rem;
        display: block;
        transition: var(--hover-transition);
        font-weight: 600;
        border-radius: 0.75rem;
        position: relative;
        overflow: hidden;
    }
    
    .navbar ul li a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--gradient-primary);
        opacity: 0;
        transition: var(--hover-transition);
        z-index: -1;
    }
    
    .navbar ul li a:hover {
        color: var(--white);
    }
    
    .navbar ul li a:hover::before {
        opacity: 1;
    }
    
    /* Modern Cards */
    .card {
        background: var(--white);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--card-shadow);
        transition: var(--hover-transition);
        position: relative;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
    }
    
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transition: var(--hover-transition);
    }
    
    .card:hover::before {
        transform: scaleX(1);
    }
    
    /* Modern Footer */
    .footer {
        background: var(--gradient-primary);
        color: var(--white);
        padding: 6rem 0 4rem;
        margin-top: 6rem;
        position: relative;
        overflow: hidden;
    }
    
    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: var(--white);
        transform: skewY(-3deg) translateY(-50%);
    }
    
    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 4rem;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
    }
    
    .school-description img {
        width: 140px;
        margin-bottom: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    /* Modern Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Enhanced Mobile Responsiveness */
    @media (max-width: 768px) {
        .navbar {
            margin: 1rem;
            border-radius: 0.75rem;
        }
        
        .navbar ul {
            flex-direction: column;
        }
        
        .navbar ul li a {
            text-align: center;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
        }
        
        .school-description {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }
    
    /* Scroll Animations */
    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: 1s all ease;
    }
    
    .scroll-reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Modern Button Styles */
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: var(--hover-transition);
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--gradient-primary);
        color: var(--white);
        border: none;
        cursor: pointer;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
    }
    
    /* Modern Input Styles */
    .input {
        padding: 1rem;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.75rem;
        transition: var(--hover-transition);
        background: var(--white);
        width: 100%;
    }
    
    .input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
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
