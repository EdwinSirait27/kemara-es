@extends('app2') 
        {{-- <style>
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
    padding: 20px;

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
            background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

        .slider {
            position: relative;
    overflow: hidden;
    border-radius: 8px;
    height: 500px;
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
            position: relative;
            margin-bottom: 40px;
        }

        .news-list {
            padding: 30px;
        }

        .news-item {
    margin-bottom: 30px;
    padding: 20px;
    border-radius: 8px;
    background: #f8f9fa;
    transition: transform 0.3s ease;
}

        .news-item:hover {
            background-color: var(--light-background);
            transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);

        }

        .news-item h4 {
            color: var(--primary-color);
            font-size: 1.4rem;
    margin-bottom: 10px;
    
        }

    .news-meta {
        margin-bottom: 15px;
    color: #666;
    font-size: 0.9rem;
        }
        .news-meta span {
    margin-right: 20px;
}
.news-meta i {
    margin-right: 5px;
    color: #3498db;
}


        .news-item p {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .read-more {
    display: inline-block;
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #2980b9;
}

.read-more i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(5px);
}
        news-list h3 {
    font-size: 1.8rem;
    margin-bottom: 25px;
    color: #333;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
}
     

        .slider-item {
            position: relative;
    width: 100%;
    height: 100%;
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
            position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 30px;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: #fff;
        }

        .slider-title {
            color: var(--primary-color);
            font-size: 2rem;
    margin-bottom: 15px;
    

        }

        .slider-nav {
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: var(--light-background);
        }

        .slider-nav button {
            position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.7);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.3s ease;
            

        }

        .slider-nav button:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .slider-nav .prev {
    left: 20px;
}

.slider-nav .next {
    right: 20px;
}
        .profile {
            padding: 40px 0;
            text-align: center;
            background-color: var(--white);

        }

        .profile h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
    font-size: 2rem;
        }

        .profile-content {
            display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    align-items: start;

        }

        .video-container {
            position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
        }

        .video-container:hover {
            transform: scale(1.02);
        }

        .video-container iframe {
            position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 8px;
        }

        .welcome-text {
            background-color: white;
            box-shadow: var(--soft-shadow);
            padding: 20px;
        }
        .welcome-text h3 {
    font-size: 1.6rem;
    margin-bottom: 15px;
    color: #2c3e50;
}
.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
.btn-primary:hover {
    background-color: #2980b9;
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
        .author-info {
    font-size: 0.9rem;
    margin-bottom: 15px;
}


        @media (max-width: 768px) {

            .top-bar .container,
            .logo-section,
            .navbar ul,
            .profile-content,
            .footer-content {
                grid-template-columns: 1fr;
            }
            .slider {
        height: 400px;
    }
    .slider-title {
        font-size: 1.5rem;
    }
    .news-item h4 {
        font-size: 1.2rem;
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
        </style> --}}
        <style>
            /* Main Container Layout */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.main-content {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* Slider Section */
.slider-section {
    position: relative;
    margin-bottom: 40px;
}

.slider {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    height: 500px;
}

.slider:hover {
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.slider-item {
    position: relative;
    width: 100%;
    height: 100%;
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
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 30px;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: #fff;
}

.slider-title {
    color: var(--primary-color);
    font-size: 2rem;
    margin-bottom: 15px;
}

.slider-nav {
    display: flex;
    justify-content: center;
    padding: 10px;
    background-color: var(--light-background);
}

.slider-nav button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.7);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.3s ease;
}

.slider-nav button:hover {
    background-color: var(--primary-color);
    transform: translateY(-3px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.slider-nav .prev {
    left: 20px;
}

.slider-nav .next {
    right: 20px;
}

/* News List Section */
.news-list {
    padding: 30px;
}

.news-list h3 {
    font-size: 1.8rem;
    margin-bottom: 25px;
    color: #333;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
}

.news-item {
    margin-bottom: 30px;
    padding: 20px;
    border-radius: 8px;
    background: #f8f9fa;
    transition: transform 0.3s ease;
}

.news-item:hover {
    background-color: var(--light-background);
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.news-item h4 {
    color: var(--primary-color);
    font-size: 1.4rem;
    margin-bottom: 10px;
}

.news-meta {
    margin-bottom: 15px;
    color: #666;
    font-size: 0.9rem;
}

.news-meta span {
    margin-right: 20px;
}

.news-meta i {
    margin-right: 5px;
    color: #3498db;
}

.news-item p {
    font-size: 0.9rem;
    margin-bottom: 10px;
}

/* Profile Section */
.profile {
    padding: 40px 0;
    text-align: center;
    background-color: var(--white);
}

.profile h2 {
    color: var(--primary-color);
    margin-bottom: 20px;
    text-align: center;
    font-size: 2rem;
}

.profile-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    align-items: start;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}

.video-container:hover {
    transform: scale(1.02);
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 8px;
}

.welcome-text {
    background-color: white;
    box-shadow: var(--soft-shadow);
    padding: 20px;
}

.welcome-text h3 {
    font-size: 1.6rem;
    margin-bottom: 15px;
    color: #2c3e50;
}

/* Common Components */
.read-more {
    display: inline-block;
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #2980b9;
}

.read-more i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(5px);
}

.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.author-info {
    font-size: 0.9rem;
    margin-bottom: 15px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-content {
        grid-template-columns: 1fr;
    }
    
    .slider {
        height: 400px;
    }
    
    .slider-title {
        font-size: 1.5rem;
    }
    
    .news-item h4 {
        font-size: 1.2rem;
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
.pagination-container {
    margin-top: 20px;
    text-align: center;
}

.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
}

.pagination > li {
    display: inline;
}

.pagination > li > a,
.pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #007bff;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}

.pagination > li:first-child > a,
.pagination > li:first-child > span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.pagination > li:last-child > a,
.pagination > li:last-child > span {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
    z-index: 2;
    color: #0056b3;
    background-color: #eee;
    border-color: #ddd;
}

.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    cursor: default;
}

.pagination > .disabled > span,
.pagination > .disabled > span:hover,
.pagination > .disabled > span:focus,
.pagination > .disabled > a,
.pagination > .disabled > a:hover,
.pagination > .disabled > a:focus {
  color: #777;
  background-color: #fff;
  border-color: #ddd;
  cursor: not-allowed;
}
        </style>
       
{{-- <div class="container">
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

                    if (beritas.length <= 1) {
                        prevButton.style.display = 'none';
                        nextButton.style.display = 'none';
                        return;
                    }

                    let currentIndex = 0;

                    const sliderImage = sliderItem.querySelector('.slider-image');
                    const sliderTitle = sliderItem.querySelector('.slider-title');
                    const sliderContent = sliderItem.querySelector('.slider-content p');
                    const sliderLink = sliderItem.querySelector('.slider-link');

                    function updateSlider() {
                        const currentBerita = beritas[currentIndex];

                        sliderImage.src = `/storage/berita/${currentBerita.gambar1 || 'default.jpg'}`;

                        sliderTitle.textContent = currentBerita.header || 'Judul Berita';

                        sliderContent.textContent = currentBerita.body ?
                            (currentBerita.body.length > 100 ?
                                currentBerita.body.substring(0, 100) + '...' :
                                currentBerita.body) :
                            'Tidak ada konten';

                        sliderLink.href = currentBerita.id ?
                            `/Berita/show/${currentBerita.id}` :
                            '#';
                    }

                    function navigateSlider(direction) {
                        currentIndex = (currentIndex + direction + beritas.length) % beritas.length;
                        updateSlider();
                    }

                    prevButton.addEventListener('click', () => navigateSlider(-1));
                    nextButton.addEventListener('click', () => navigateSlider(1));

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
        </div>  --}}
        {{-- @extends('app2') --}}

        @section('content')
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
        
                {{-- <div class="news-list">
                    <!-- News list content tetap sama -->
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
                </div> --}}
                <div class="news-list">
                    <h3>Berita Terbaru</h3>
                    @if($beritass->isEmpty())
                        <p>Belum ada berita terbaru.</p>
                    @else
                        @foreach($beritass as $berita)
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
                    @endif
                
                    {{-- Pagination Links --}}
                    <div class="pagination-container">
                        {{ $beritass->links('vendor.pagination.custom') }}
                    </div>
                </div>
               

        
                <section class="profile">
                    <!-- Profile section tetap sama -->
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
        </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const slider = document.querySelector('.slider');
                    const sliderItem = document.querySelector('.slider-item');
                    const prevButton = document.querySelector('.prev');
                    const nextButton = document.querySelector('.next');
                    const beritas = @json($beritas);

                    if (beritas.length <= 1) {
                        prevButton.style.display = 'none';
                        nextButton.style.display = 'none';
                        return;
                    }

                    let currentIndex = 0;

                    const sliderImage = sliderItem.querySelector('.slider-image');
                    const sliderTitle = sliderItem.querySelector('.slider-title');
                    const sliderContent = sliderItem.querySelector('.slider-content p');
                    const sliderLink = sliderItem.querySelector('.slider-link');

                    function updateSlider() {
                        const currentBerita = beritas[currentIndex];

                        sliderImage.src = `/storage/berita/${currentBerita.gambar1 || 'default.jpg'}`;

                        sliderTitle.textContent = currentBerita.header || 'Judul Berita';

                        sliderContent.textContent = currentBerita.body ?
                            (currentBerita.body.length > 100 ?
                                currentBerita.body.substring(0, 100) + '...' :
                                currentBerita.body) :
                            'Tidak ada konten';

                        sliderLink.href = currentBerita.id ?
                            `/Berita/show/${currentBerita.id}` :
                            '#';
                    }

                    function navigateSlider(direction) {
                        currentIndex = (currentIndex + direction + beritas.length) % beritas.length;
                        updateSlider();
                    }

                    prevButton.addEventListener('click', () => navigateSlider(-1));
                    nextButton.addEventListener('click', () => navigateSlider(1));

                    updateSlider();
                });
            </script>
        
        @endsection