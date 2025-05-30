@extends('app2')
@section('content')
@section('title', 'Berita - SMA KATOLIK KESUMA MATARAM')

@section('meta_description', 'Berita SMA Kesuma Mataram.')

@section('meta_keywords', 'Berita,SMA Katolik Kesuma Mataram')
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
        from {
            opacity: 0;
            transform: scale(0.98);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
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
        0% {
            background-position: -1000px 0;
        }

        100% {
            background-position: 1000px 0;
        }
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
    <h1>{{ $berita->header }}</h1>
    <div class="slider-wrapper">
        <div class="slider">
            {{-- @for ($i = 1; $i <= 8; $i++)
                @php $gambar = 'gambar' . $i; @endphp
                @if (!empty($berita->$gambar))
                    <div class="slider-item">
                        <img src="{{ asset('storage/berita/' . $berita->$gambar) }}" alt="{{ $berita->header }}"
                            class="slider-image">
                    </div>
                @endif
            @endfor --}}
            @for ($i = 1; $i <= 8; $i++)
                @php $gambar = 'gambar' . $i; @endphp
                @if (!empty($berita->$gambar))
                    <div class="slider-item">
                        <img src="{{ asset('storage/berita/' . $berita->$gambar) }}" alt="{{ $berita->header }}"
                            class="slider-image" style="cursor: pointer;">
                    </div>
                @endif
            @endfor


            <div class="slider-nav">
                <button class="prev" style="display: none;">❮</button>
                <button class="next" style="display: none;">❯</button>
            </div>
        </div>

        <div class="article-container" style="font-family: Arial, sans-serif; line-height: 1.8; color: #333;">
            <div class="article-header" style="margin-bottom: 20px; text-align: center;">
                <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">{{ $berita->header }}</h1>
                <p style="font-size: 14px; color: #777;">
                    <strong>Pembuat:</strong> {{ $berita->User->Guru->Nama }} |
                    <strong>Dipublikasikan:</strong> {{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}
                    <strong><i class="fas fa-eye"></i> Dilihat :</strong> {{ $berita->views }}


                </p>
            </div>

            {{-- <div class="article-body" style="text-align: justify;">
                    @php
                        $bodyText = str($berita->body);
                        $words = explode(' ', $bodyText);
                        $chunks = array_chunk($words, 50);
                    @endphp
            
                    @foreach ($chunks as $chunk)
                        <p style="margin-bottom: 15px;">{{ implode(' ', $chunk) }}</p>
                    @endforeach
                </div> --}}
            @php
                $paragraphs = explode("\n", trim($berita->body));
            @endphp

            <div class="article-body"
                style="text-align: justify; font-family: 'Arial', sans-serif; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                @foreach ($paragraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

        </div>




        <script>
            document.addEventListener("DOMContentLoaded", function() {
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

                prevButton.addEventListener("click", function() {
                    currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
                    updateSlides();
                });

                nextButton.addEventListener("click", function() {
                    currentSlide = (currentSlide + 1) % sliderItems.length;
                    updateSlides();
                });

                updateSlides();
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const images = document.querySelectorAll('.slider-image');
                images.forEach(img => {
                    img.addEventListener('click', function() {
                        Swal.fire({
                            imageUrl: img.src,
                            imageAlt: img.alt,
                            showCloseButton: true,
                            showConfirmButton: false,
                            width: '80%',
                            background: '#fff',
                            backdrop: `rgba(0,0,0,0.8)`
                        });
                    });
                });
            });
        </script>
    </div>
</div>
@endsection
