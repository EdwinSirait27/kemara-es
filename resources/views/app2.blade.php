
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
