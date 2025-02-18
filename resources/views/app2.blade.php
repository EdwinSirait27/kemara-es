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
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Language Alternatives -->
    <link rel="alternate" hreflang="id" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}/en">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'SMA KATOLIK KESUMA MATARAM')">
    <meta property="og:description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform...')">
    <meta property="og:image" content="@yield('meta_image', asset('assets/img/default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SMA KATOLIK KESUMA MATARAM')">
    <meta name="twitter:description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform...')">
    <meta name="twitter:image" content="@yield('meta_image', asset('assets/img/default.jpg'))">
    
    <!-- PWA -->
    <meta name="theme-color" content="#4a90e2">
    
    <!-- Resource Hints -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}">
    
    <!-- Structured Data -->
  <!-- Di dalam tag <head> di app2.blade.php -->
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
        "logo": "{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}"
    }
    </script>
    <!-- CSS -->
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
{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'SMA KATOLIK KESUMA MATARAM')</title>
    <meta name="description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform yang dirancang khusus untuk memfasilitasi data di lembaga pendidikan sekolah...')">
    <meta name="keywords" content="@yield('meta_keywords', 'SMAK Kesuma Mataram, Sistem Informasi Akademik, Pendidikan')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="@yield('title', 'SMA KATOLIK KESUMA MATARAM')">
    <meta property="og:description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform...')">
    <meta property="og:image" content="@yield('meta_image', asset('assets/img/default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SMA KATOLIK KESUMA MATARAM')">
    <meta name="twitter:description" content="@yield('meta_description', 'Sistem Informasi Akademik Kemara-ES adalah platform...')">
    <meta name="twitter:image" content="@yield('meta_image', asset('assets/img/default.jpg'))">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}">

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
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
            </style>
</head>
<body>
    @include('topbar')

    @include('header')

    @include('navbar')

    @yield('content')

    @include('footer')

    @stack('scripts')
</body>
</html> --}}

{{-- 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $metaDescription ?? 'Sistem Informasi Akademik Kemara-ES adalah platform yang dirancang khusus untuk memfasilitasi data di lembaga pendidikan sekolah. Dengan menggunakan teknologi informasi dan komunikasi, sistem ini bertujuan untuk meningkatkan efisiensi dalam proses pendataan dan manajemen sekolah serta mendorong transparansi dan akuntabilitas dalam pengelolaan pendidikan. Dengan Sistem Informasi Akademik Kemara-ES, sekolah dapat mengoptimalkan proses akademik, meningkatkan kualitas pendidikan, dan memperkuat hubungan antara siswa, dan pihak sekolah.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'SMAK Kesuma Mataram' }}">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMA KATOLIK KESUMA MATARAM')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico') }}">
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
    .footer-content {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body>
    @include('topbar')
  
    @include('header')
  
    @include('navbar')
    
        @yield('content')
    
    @include('footer')
   
    @stack('scripts')
</body>
</html> --}}
