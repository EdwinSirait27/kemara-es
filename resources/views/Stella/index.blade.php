<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stella Gracia - Elegant Jewelry Collection</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cormorant Garamond', serif;
        }

        body {
            background-color: #f9f7f5;
            color: #333;
            line-height: 1.6;
        }

        /* Typography */
        h1, h2, h3, h4 {
            font-weight: 400;
            color: #222;
        }

        h1 {
            font-size: 2.5rem;
            letter-spacing: 3px;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
        }

        p {
            margin-bottom: 1rem;
            color: #555;
        }

        a {
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #b8860b;
        }

        /* Layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            font-size: 1.8rem;
            letter-spacing: 3px;
            font-weight: 300;
        }

        .logo a {
            color: #222;
        }

        /* Navigation */
        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav a {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        /* Hero section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/api/placeholder/1200/800') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero-content {
            max-width: 700px;
            padding: 30px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border: 2px solid #fff;
            background-color: transparent;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #fff;
            color: #333;
        }

        /* Collections section */
        .collections {
            padding: 100px 0;
            text-align: center;
        }

        .collections-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .collection-item {
            position: relative;
            overflow: hidden;
            height: 400px;
        }

        .collection-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .collection-item:hover img {
            transform: scale(1.05);
        }

        .collection-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
        }

        .collection-overlay h3 {
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        /* About section */
        .about {
            padding: 100px 0;
            background-color: #fff;
        }

        .about-inner {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-text {
            flex: 1;
        }

        .about-image {
            flex: 1;
            height: 500px;
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            text-align: center;
            background-color: #f5f2ee;
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 50px auto 0;
        }

        .testimonial {
            padding: 30px;
        }

        .testimonial p {
            font-style: italic;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: bold;
        }

        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 50px 0 20px;
        }

        .footer-inner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-column h3 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #ccc;
        }

        .footer-column a:hover {
            color: #fff;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            color: #fff;
            font-size: 1.2rem;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #888;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
            
            .about-inner {
                flex-direction: column;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="#">STELLA GRACIA SCHOOL</a>
                </div>
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">TES</a></li>
                        <li><a href="#">TES</a></li>
                        <li><a href="#">TES</a></li>
                        <li><a href="#">TES</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>TES</h1>
            <p>TEST.</p>
            <a href="#" class="btn">Explore </a>
        </div>
    </section>

    <!-- Collections Section -->
    <section class="collections">
        <div class="container">
            <h2>TES</h2>
            <p>TES</p>
            
            <div class="collections-grid">
                <div class="collection-item">
                    <img src="/api/placeholder/400/500" alt="Necklaces Collection">
                    <div class="collection-overlay">
                        <h3>TES</h3>
                        <a href="#">TES</a>
                    </div>
                </div>
                
                <div class="collection-item">
                    <img src="/api/placeholder/400/500" alt="Earrings Collection">
                    <div class="collection-overlay">
                        <h3>TES</h3>
                        <a href="#">TES</a>
                    </div>
                </div>
                
                <div class="collection-item">
                    <img src="/api/placeholder/400/500" alt="Bracelets Collection">
                    <div class="collection-overlay">
                        <h3>TES</h3>
                        <a href="#">TES</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="about-inner">
                <div class="about-text">
                    <h2>TEST</h2>
                    <p>Founded in 2015, Stella Gracia was born .....</p>
                    <p>.</p>
                    <p>.</p>
                    <a href="#" class="btn" style="color: #333; border-color: #333;">Learn More</a>
                </div>
                <div class="about-image">
                    <img src="/api/placeholder/600/800" alt="Stella Gracia Workshop">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2> Testimonials</h2>
            <div class="testimonial-slider">
                <div class="testimonial">
                    <p>"TEST."</p>
                    <div class="testimonial-author">- TEST J.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-column">
                    <h3>Stella Gracia</h3>
                    <p>TEST.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>TEST</h3>
                    <ul>
                        <li><a href="#">TEST</a></li>
                        <li><a href="#">TEST</a></li>
                        <li><a href="#">TEST</a></li>
                        <li><a href="#">TEST</a></li>
                        <li><a href="#">TEST</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Information</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Care Guide</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">TEST</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">TEST</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Stella Gracia. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stella Gracia - Elegant Jewelry Collection</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cormorant Garamond', serif;
        }

        body {
            background-color: #f9f7f5;
            color: #333;
            line-height: 1.6;
        }

        /* Typography */
        h1, h2, h3, h4 {
            font-weight: 400;
            color: #222;
        }

        h1 {
            font-size: 2.5rem;
            letter-spacing: 3px;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
        }

        p {
            margin-bottom: 1rem;
            color: #555;
        }

        a {
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #b8860b;
        }

        /* Layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            font-size: 1.8rem;
            letter-spacing: 3px;
            font-weight: 300;
        }

        .logo a {
            color: #222;
        }

        /* Navigation */
        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav a {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        /* Hero section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/api/placeholder/1200/800') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero-content {
            max-width: 700px;
            padding: 30px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border: 2px solid #fff;
            background-color: transparent;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #fff;
            color: #333;
        }

        /* Collections section */
        .collections {
            padding: 100px 0;
            text-align: center;
        }

        .collections-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .collection-item {
            position: relative;
            overflow: hidden;
            height: 400px;
        }

        .collection-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .collection-item:hover img {
            transform: scale(1.05);
        }

        .collection-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
        }

        .collection-overlay h3 {
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        /* About section */
        .about {
            padding: 100px 0;
            background-color: #fff;
        }

        .about-inner {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-text {
            flex: 1;
        }

        .about-image {
            flex: 1;
            height: 500px;
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            text-align: center;
            background-color: #f5f2ee;
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 50px auto 0;
        }

        .testimonial {
            padding: 30px;
        }

        .testimonial p {
            font-style: italic;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: bold;
        }

        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 50px 0 20px;
        }

        .footer-inner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-column h3 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #ccc;
        }

        .footer-column a:hover {
            color: #fff;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            color: #fff;
            font-size: 1.2rem;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #888;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
            
            .about-inner {
                flex-direction: column;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="#">STELLA GRACIA</a>
                </div>
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Collections</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Timeless Elegance</h1>
            <p>Discover our handcrafted jewelry collection that celebrates beauty, craftsmanship, and the art of adornment.</p>
            <a href="#" class="btn">Explore Collection</a>
        </div>
    </section>

    <!-- Collections Section -->
    <section class="collections">
        <div class="container">
            <h2>Our Collections</h2>
            <p>Each piece is meticulously crafted with attention to detail and passion for design</p>
            
            <div class="collections-grid">
                <div class="collection-item">
                    <img src="/api/placeholder/400/500" alt="Necklaces Collection">
                    <div class="collection-overlay">
                        <h3>Necklaces</h3>
                        <a href="#">View Collection</a>
                    </div>
                </div>
                
                <div class="collection-item">
                    <img src="/api/placeholder/400/500" alt="Earrings Collection">
                    <div class="collection-overlay">
                        <h3>Earrings</h3>
                        <a href="#">View Collection</a>
                    </div>
                </div>
                
                <div class="collection-item">
                    <img src="/api/placeholder/400/500" alt="Bracelets Collection">
                    <div class="collection-overlay">
                        <h3>Bracelets</h3>
                        <a href="#">View Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="about-inner">
                <div class="about-text">
                    <h2>The Stella Gracia Story</h2>
                    <p>Founded in 2015, Stella Gracia was born from a passion for creating jewelry that combines traditional craftsmanship with contemporary design. Each piece tells a story and is crafted to become a treasured heirloom.</p>
                    <p>Our designs are inspired by nature, architecture, and cultural elements from around the world. We work with skilled artisans who share our commitment to quality and sustainable practices.</p>
                    <p>Every Stella Gracia creation is made with ethically sourced materials, ensuring that our jewelry not only looks beautiful but also represents responsible luxury.</p>
                    <a href="#" class="btn" style="color: #333; border-color: #333;">Learn More</a>
                </div>
                <div class="about-image">
                    <img src="/api/placeholder/600/800" alt="Stella Gracia Workshop">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2>Client Testimonials</h2>
            <div class="testimonial-slider">
                <div class="testimonial">
                    <p>"The craftsmanship of my Stella Gracia necklace is exceptional. I receive compliments every time I wear it. It's truly a piece I'll cherish forever."</p>
                    <div class="testimonial-author">- Sarah J.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-column">
                    <h3>Stella Gracia</h3>
                    <p>Exquisite jewelry for the modern woman. Handcrafted with love and attention to detail.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="#">Necklaces</a></li>
                        <li><a href="#">Earrings</a></li>
                        <li><a href="#">Bracelets</a></li>
                        <li><a href="#">Rings</a></li>
                        <li><a href="#">Gift Cards</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Information</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Care Guide</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">Shipping & Returns</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Size Guide</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Stella Gracia. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> --}}