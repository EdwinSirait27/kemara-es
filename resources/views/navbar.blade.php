{{-- <nav class="navbar">
    <div class="container">
        <ul>
            <li><a href="{{ route('Beranda.index') }}">BERANDA</a></li>
            @if ($informasippdb)
            <li>
                <a href="{{ route('Informasi.show', ['slug' => $informasippdb->slug]) }}">
                    INFORMASI PPDB
                </a>
            </li>
            @else
        @endif
        
        </ul>
    </div>
</nav> --}}
<nav class="navbar">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('Beranda.index') }}">BERANDA</a></li>
            @if ($informasippdb)
                <li>
                    <a href="{{ route('Informasi.show', ['slug' => $informasippdb->slug]) }}">
                        INFORMASI PPDB
                     </a>
                </li>
                @else
            @endif
            <li>
                <a href="{{ route('Alumni.index')}}">
                    DAFTAR ALUMNI
                </a>
            </li>
            <li>
                <a href="{{ route('Listalumni.index')}}">
                    List Alumni
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- Breadcrumbs SEO dengan JSON-LD --}}

