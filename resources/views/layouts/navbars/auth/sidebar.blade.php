<style>
#sidenav-main {
    height: 100%;
    overflow-y: auto;
    padding-bottom: 20px; /* Opsional, untuk memberi jarak di bawah */
}

html, body {
    height: 100%;
    overflow: hidden; /* Mencegah scroll di body jika sidebar overflow */
}
#main-container {
    display: flex;
    height: 100vh; /* Mengatur tinggi kontainer utama sama dengan tinggi layar */
    overflow: hidden;
}



    .sidenav .navbar-nav .nav-item .nav-link {
        padding: 10px 15px;
        margin-bottom: 5px;
    }

    #sidenav-main {
        width: 250px;
    }

    .navbar-nav .nav-link-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        #sidenav-main {
            width: 200px;
        }

        .sidenav .navbar-nav .nav-item .nav-link {
            font-size: 0.9em;
        }
    }

    .icon i,
    .icon svg {
        color: #5e72e4;
        font-size: 16px;
    }
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-1 fixed-start ms-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav">
        </i>
        <div class="d-flex align-items-center">
            @if (Gate::allows('isSU') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardSU') }}">
            @endif



            @if (Gate::allows('isAdmin') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardAdmin') }}">
            @endif
            @if (Gate::allows('isKepalaSekolah') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardKepalaSekolah') }}">
            @endif
            @if (Gate::allows('isGuru') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardGuru') }}">
            @endif
            @if (Gate::allows('isKurikulum') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardKurikulum') }}">
            @endif
            @if (Gate::allows('isSiswa') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardSiswa') }}">
            @endif
            @if (Gate::allows('isNonSiswa') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isSU'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardNonSiswa') }}">
            @endif

            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).png')}}" class="navbar-brand-img h-100 me-2" alt="Logo">
                <div>
                    <h5 class="ms-3 font-weight-bold d-none d-md-inline">Kemara-ES</h5>

                </div>
            </div>
            </a>
        </div>
    </div>
    @php
        $username = optional(auth()->user())->username;
        $hakakses = optional(auth()->user())->hakakses;
    @endphp
    <small class="d-block font-weight-bold"style="font-size: 0.9em; margin-left: 15px;"> Selamat Datang,
        {{ $username ?? 'Tidak ada' }}</small>
    <small class="text-muted"style="font-size: 0.8em; margin-left: 15px;">Hak Akses
        :{{ $hakakses ?? 'Tidak ada' }}</small>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples" role="button"
                    aria-expanded="false" aria-controls="laravelExamples">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                            <title>profile</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            @if (Gate::allows('isSU'))
                                <a class="nav-link {{ Request::is('user-profileSU') ? 'active' : '' }}"
                                    href="{{ url('user-profileSU') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('DatakuSU') ? 'active' : '' }}"
                                    href="{{ url('DatakuSU') }}">
                                    <span class="nav-link-text ms-1">Data-Ku</span>
                                </a>
                            @endif
                            @if (Gate::allows('isKepalaSekolah'))
                                <a class="nav-link {{ Request::is('user-profileKepalaSekolah') ? 'active' : '' }}"
                                    href="{{ url('user-profileKepalaSekolah') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('DatakuKepalaSekolah') ? 'active' : '' }}"
                                    href="{{ url('DatakuKepalaSekolah') }}">
                                    <span class="nav-link-text ms-1">Data-Ku</span>
                                </a>
                            @endif
                            @if (Gate::allows('isGuru'))
                                <a class="nav-link {{ Request::is('user-profileGuru') ? 'active' : '' }}"
                                    href="{{ url('user-profileGuru') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('DatakuGuru') ? 'active' : '' }}"
                                    href="{{ url('DatakuGuru') }}">
                                    <span class="nav-link-text ms-1">Data-Ku</span>
                                </a>
                            @endif
                            @if (Gate::allows('isKurikulum'))
                                <a class="nav-link {{ Request::is('user-profileKurikulum') ? 'active' : '' }}"
                                    href="{{ url('user-profileKurikulum') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('DatakuKurikulum') ? 'active' : '' }}"
                                href="{{ url('DatakuKurikulum') }}">
                                <span class="nav-link-text ms-1">Data-Ku</span>
                            </a>
                            @endif
                            @if (Gate::allows('isSiswa'))
                                <a class="nav-link {{ Request::is('user-profileSiswa') ? 'active' : '' }}"
                                    href="{{ url('user-profileSiswa') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('DatakuSiswa') ? 'active' : '' }}"
                                href="{{ url('DatakuSiswa') }}">
                                <span class="nav-link-text ms-1">Data-Ku</span>
                            </a>
                                <a class="nav-link {{ Request::is('Ekstra-ku') ? 'active' : '' }}"
                                    href="{{ url('Ekstra-ku') }}">
                                    <span class="nav-link-text ms-1">Ekstrakulikuler-ku</span>
                                </a>
                                <a class="nav-link {{ Request::is('Organisasi-ku') ? 'active' : '' }}"
                                    href="{{ url('Organisasi-ku') }}">
                                    <span class="nav-link-text ms-1">Organisasi-ku</span>
                                </a>
                            @endif
                            @if (Gate::allows('isNonSiswa'))
                                <a class="nav-link {{ Request::is('user-profileNonSiswa') ? 'active' : '' }}"
                                    href="{{ url('user-profileNonSiswa') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isAdmin'))
                                <a class="nav-link {{ Request::is('user-profileAdmin') ? 'active' : '' }}"
                                    href="{{ url('user-profileAdmin') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('DatakuAdmin') ? 'active' : '' }}"
                                href="{{ url('DatakuAdmin') }}">
                                <span class="nav-link-text ms-1">Data-Ku</span>
                            </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            
            @if (Gate::allows('isSU'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardSU') ? 'active' : '' }}"
                        href="{{ url('dashboardSU') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardSUSiswa') ? 'active' : '' }}"
                        href="{{ url('dashboardSUSiswa') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard Siswa</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardAdmin') ? 'active' : '' }}"
                        href="{{ url('dashboardAdmin') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isKepalaSekolah'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardKepalaSekolah') ? 'active' : '' }}"
                        href="{{ url('dashboardKepalaSekolah') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
          
            @if (Gate::allows('isKurikulum'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardKurikulum') ? 'active' : '' }}"
                        href="{{ url('dashboardKurikulum') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isGuru'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardGuru') ? 'active' : '' }}"
                        href="{{ url('dashboardGuru') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isSiswa'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardSiswa') ? 'active' : '' }}"
                        href="{{ url('dashboardSiswa') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isNonSiswa'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardNonSiswa') ? 'active' : '' }}"
                        href="{{ url('dashboardNonSiswa') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                @endif
                {{-- @if (Gate::allows('isKepalaSekolah'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('kepsek') ? 'active' : '' }}"
        href="{{ url('kepsek') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cubes"></i>
        </div>
        <span class="nav-link-text ms-1">Data Kepala Sekolah</span>
    </a>
</li>
@endif --}}
            {{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples1" role="button"
                  aria-expanded="false" aria-controls="laravelExamples1">
                  <div
                      class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-database"></i>
                  </div>
                  <span class="nav-link-text ms-1">Data Master</span>
              </a>
              <div class="collapse" id="laravelExamples1">
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Kurikulum') ? 'active' : '' }}" href="{{ url('Kurikulum') }}">
                              <span class="nav-link-text ms-1">Data Kurikulum</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Tahunakademik') ? 'active' : '' }}" href="{{ url('Tahunakademik') }}">
                              <span class="nav-link-text ms-1">Data Tahun Akademik</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Matapelajaran') ? 'active' : '' }}" href="{{ url('Matapelajaran') }}">
                              <span class="nav-link-text ms-1">Data Mata Pelajaran</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Kelas') ? 'active' : '' }}" href="{{ url('Kelas') }}">
                              <span class="nav-link-text ms-1">Data Kelas</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Ekstrakulikuler') ? 'active' : '' }}" href="{{ url('Ekstrakulikuler') }}">
                              <span class="nav-link-text ms-1">Data Ekstrakulikuler</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Organisasi') ? 'active' : '' }}" href="{{ url('Organisasi') }}">
                              <span class="nav-link-text ms-1">Data Organisasi</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif --}}
            @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples2" role="button"
                  aria-expanded="false" aria-controls="laravelExamples2">
                  <div
                      class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-users"></i> 
                  </div>
                  <span class="nav-link-text ms-1">Tombol Pembukaan</span>
              </a>
              <div class="collapse" id="laravelExamples2">
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Tombol') ? 'active' : '' }}" href="{{ url('Tombol') }}">
                              <span class="nav-link-text ms-1">Tombol URL</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif
            @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples8" role="button"
                  aria-expanded="false" aria-controls="laravelExamples2">
                  <div
                      class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-cloud"></i> 
                  </div>
                  <span class="nav-link-text ms-1">PPDB</span>
              </a>
              <div class="collapse" id="laravelExamples8">
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Siswabaru') ? 'active' : '' }}" href="{{ url('Siswabaru') }}">
                              <span class="nav-link-text ms-1">Data Siswa Baru</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Validasi') ? 'active' : '' }}" href="{{ url('Validasi') }}">
                              <span class="nav-link-text ms-1">Validasi</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif
          {{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples3" role="button"
                aria-expanded="false" aria-controls="laravelExamples3">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-layer-group"></i>
                </div>
                <span class="nav-link-text ms-1">Osis</span>
            </a>
            <div class="collapse" id="laravelExamples3">
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Osis') ? 'active' : '' }}" href="{{ url('Osis') }}">
                            <span class="nav-link-text ms-1">Penambahan Calon</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Voting') ? 'active' : '' }}" href="{{ url('Voting') }}">
                            <span class="nav-link-text ms-1">Pemilihan Ketua Osis</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif --}}
        {{-- ini ppdb tok --}}
        {{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('Siswabaru') ? 'active' : '' }}"
                        href="{{ url('Siswabaru') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">PPDB</span>
                    </a>
                </li>
            @endif --}}
      @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

    <li class="nav-item">
        <a class="nav-link {{ Request::is('Dataguru') ? 'active' : '' }}"
            href="{{ url('Dataguru') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-male"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Guru</span>
        </a>
    </li>
    @endif
    @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples10" role="button"
          aria-expanded="false" aria-controls="laravelExamples10">
          <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users"></i> 
          </div>
          <span class="nav-link-text ms-1">Beranda Sekolah</span>
      </a>
      <div class="collapse" id="laravelExamples10">
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Youtube') ? 'active' : '' }}" href="{{ url('Youtube') }}">
                      <span class="nav-link-text ms-1">Input Url Youtube</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Berita') ? 'active' : '' }}" href="{{ url('Berita') }}">
                      <span class="nav-link-text ms-1">Berita</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Profile') ? 'active' : '' }}" href="{{ url('Profile') }}">
                      <span class="nav-link-text ms-1">Profile</span>
                  </a>
              </li>
          </ul>
      </div>
  </li>
  @endif
    {{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples4" role="button"
          aria-expanded="false" aria-controls="laravelExamples4">
          <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-female"></i>
          </div>
          <span class="nav-link-text ms-1">Daftar Siswa</span>
      </a>
      <div class="collapse" id="laravelExamples4">
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Datasiswa') ? 'active' : '' }}" href="{{ url('Datasiswa') }}">
                      <span class="nav-link-text ms-1">Daftar Siswa</span>
                  </a>
              </li>
          </ul>
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Siswalulus') ? 'active' : '' }}" href="{{ url('Siswalulus') }}">
                      <span class="nav-link-text ms-1">Daftar Siswa Lulus</span>
                  </a>
              </li>
          </ul>
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Siswaarsip') ? 'active' : '' }}" href="{{ url('Siswaarsip') }}">
                      <span class="nav-link-text ms-1">Data Arsip</span>
                  </a>
              </li>
          </ul>
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Siswaarsipall') ? 'active' : '' }}" href="{{ url('Siswaarsipall') }}">
                      <span class="nav-link-text ms-1">Data Seluruh Arsip</span>
                  </a>
              </li>
          </ul>
      </div>
  </li>
@endif --}}
{{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
<li class="nav-item">
    <a class="nav-link {{ Request::is('Datamengajar') ? 'active' : '' }}"
        href="{{ url('Datamengajar') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt"></i>
        </div>
        <span class="nav-link-text ms-1">Data Mengajar</span>
    </a>
</li>
@endif --}}
{{-- @if (Gate::allows('isGuru')|| Gate::allows('isKurikulum')|| Gate::allows('isSiswa'))
    <li class="nav-item">
        <a class="nav-link {{ Request::is('DatasiswaKGS') ? 'active' : '' }}"
            href="{{ url('DatasiswaKGS') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Siswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('DataguruKGS') ? 'active' : '' }}"
            href="{{ url('DataguruKGS') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-male"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Guru</span>
        </a>
    </li>
@endif

@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples2" role="button"
      aria-expanded="false" aria-controls="laravelExamples2">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-cubes"></i> 
      </div>
      <span class="nav-link-text ms-1">Pengaturan Kelas</span>
  </a>
  <div class="collapse" id="laravelExamples2">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Pengaturankelas') ? 'active' : '' }}" href="{{ url('Pengaturankelas') }}">
                  <span class="nav-link-text ms-1">Pengaturan Kelas Siswa</span>
              </a>
          </li>
      </ul>
  </div>
  <div class="collapse" id="laravelExamples2">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Tambahsiswa') ? 'active' : '' }}" href="{{ url('Kelassiswa') }}">
                  <span class="nav-link-text ms-1">Tambah Siswa ke Kelas</span>
              </a>
          </li>
      </ul>
  </div>
 
</li>
@endif
@if (Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))
<li class="nav-item">
  <a class="nav-link {{ Request::is('kelassaya') ? 'active' : '' }}"
      href="{{ url('kelassaya') }}">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-cubes"></i>
      </div>
      <span class="nav-link-text ms-1">Kelas</span>
  </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')||Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('Ekstrasiswa') ? 'active' : '' }}"
        href="{{ url('Ekstrasiswa') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cloud"></i>
        </div>
        <span class="nav-link-text ms-1">Ekstrakulikuler Detail</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')||Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('Organisasisiswa') ? 'active' : '' }}"
        href="{{ url('Organisasisiswa') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-book"></i>
        </div>
        <span class="nav-link-text ms-1">Organisasi</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('menumengajar') ? 'active' : '' }}"
        href="{{ url('menumengajar') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar"></i>
        </div>
        <span class="nav-link-text ms-1">Menu Mengajar</span>
    </a>
</li>
@endif --}}
{{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')|| Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('tugas') ? 'active' : '' }}"
        href="{{ url('tugas') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-coffee"></i>
        </div>
        <span class="nav-link-text ms-1">Tugas</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')|| Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('identitas') ? 'active' : '' }}"
        href="{{ url('identitas') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-desktop"></i>
        </div>
        <span class="nav-link-text ms-1">Identitas Sekolah</span>
    </a>
</li>
@endif --}}
{{-- @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples5" role="button"
      aria-expanded="false" aria-controls="laravelExamples5">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-download"></i> 
      </div>
      <span class="nav-link-text ms-1">Data Laporan</span>
  </a>
  <div class="collapse" id="laravelExamples5">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('dataguruall') ? 'active' : '' }}" href="{{ url('user-profileSU') }}">
                  <span class="nav-link-text ms-1">Data Guru</span>
              </a>
          </li>
      </ul>
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('datasiswaall') ? 'active' : '' }}" href="{{ url('user-profileSU') }}">
                  <span class="nav-link-text ms-1">Data Siswa</span>
              </a>
          </li>
      </ul>
      
  </div>
</li>
@endif --}}
              </aside> 

{{-- <style>
#sidenav-main {
    height: 100%;
    overflow-y: auto;
    padding-bottom: 20px; /* Opsional, untuk memberi jarak di bawah */
}

html, body {
    height: 100%;
    overflow: hidden; /* Mencegah scroll di body jika sidebar overflow */
}
#main-container {
    display: flex;
    height: 100vh; /* Mengatur tinggi kontainer utama sama dengan tinggi layar */
    overflow: hidden;
}



    .sidenav .navbar-nav .nav-item .nav-link {
        padding: 10px 15px;
        margin-bottom: 5px;
    }

    #sidenav-main {
        width: 250px;
    }

    .navbar-nav .nav-link-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        #sidenav-main {
            width: 200px;
        }

        .sidenav .navbar-nav .nav-item .nav-link {
            font-size: 0.9em;
        }
    }

    .icon i,
    .icon svg {
        color: #5e72e4;
        font-size: 16px;
    }
</style>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-1 fixed-start ms-2"
    id="sidenav-main" style="max-width: 250px; overflow-y: auto;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
            aria-hidden="true" id="iconSidenav">
        </i>
        <div class="d-flex align-items-center">
            @if (Gate::allows('isSU') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardSU') }}">
            @endif
            @if (Gate::allows('isAdmin') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardAdmin') }}">
            @endif
            @if (Gate::allows('isKepalaSekolah') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardKepalaSekolah') }}">
            @endif
            @if (Gate::allows('isGuru') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardGuru') }}">
            @endif
            @if (Gate::allows('isKurikulum') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardKurikulum') }}">
            @endif
            @if (Gate::allows('isSiswa') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSU') &&
                    Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardSiswa') }}">
            @endif
            @if (Gate::allows('isNonSiswa') &&
                    Gate::denies('isAdmin') &&
                    Gate::denies('isGuru') &&
                    Gate::denies('isKepalaSekolah') &&
                    Gate::denies('isKurikulum') &&
                    Gate::denies('isSiswa') &&
                    Gate::denies('isSU'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardNonSiswa') }}">
            @endif

            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/50204458.jpg') }}" class="navbar-brand-img h-100 me-2" alt="Logo"
                    style="max-height: 50px;">
                <h5 class="ms-3 font-weight-bold d-none d-md-inline">Kemara-ES</h5>
            </div>
            </a>
        </div>
    </div>

    @php
        $username = optional(auth()->user())->username;
        $hakakses = optional(auth()->user())->hakakses;
    @endphp

    <small class="d-block font-weight-bold" style="font-size: 0.9em; margin-left: 15px;">Selamat Datang,
        {{ $username ?? 'Tidak ada' }}</small>
    <small class="text-muted" style="font-size: 0.8em; margin-left: 15px;">Hak Akses
        :{{ $hakakses ?? 'Tidak ada' }}</small>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples" role="button"
                    aria-expanded="false" aria-controls="laravelExamples">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>profile</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            @if (Gate::allows('isSU'))
                                <a class="nav-link {{ Request::is('user-profileSU') ? 'active' : '' }}"
                                    href="{{ url('user-profileSU') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isKepalaSekolah'))
                                <a class="nav-link {{ Request::is('user-profileKepalaSekolah') ? 'active' : '' }}"
                                    href="{{ url('user-profileKepalaSekolah') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isGuru'))
                                <a class="nav-link {{ Request::is('user-profileGuru') ? 'active' : '' }}"
                                    href="{{ url('user-profileGuru') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isKurikulum'))
                                <a class="nav-link {{ Request::is('user-profileKurikulum') ? 'active' : '' }}"
                                    href="{{ url('user-profileKurikulum') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isSiswa'))
                                <a class="nav-link {{ Request::is('user-profileSiswa') ? 'active' : '' }}"
                                    href="{{ url('user-profileSiswa') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('Ekstra-ku') ? 'active' : '' }}"
                                    href="{{ url('Ekstra-ku') }}">
                                    <span class="nav-link-text ms-1">Ekstrakulikuler-ku</span>
                                </a>
                                <a class="nav-link {{ Request::is('Organisasi-ku') ? 'active' : '' }}"
                                    href="{{ url('Organisasi-ku') }}">
                                    <span class="nav-link-text ms-1">Organisasi-ku</span>
                                </a>
                            @endif
                            @if (Gate::allows('isNonSiswa'))
                                <a class="nav-link {{ Request::is('user-profileNonSiswa') ? 'active' : '' }}"
                                    href="{{ url('user-profileNonSiswa') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isAdmin'))
                                <a class="nav-link {{ Request::is('user-profileAdmin') ? 'active' : '' }}"
                                    href="{{ url('user-profileAdmin') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            @if (Gate::allows('isSU'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboardSU') ? 'active' : '' }}"
                    href="{{ url('dashboardSU') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background opacity-6"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboardSUSiswa') ? 'active' : '' }}"
                    href="{{ url('dashboardSUSiswa') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background opacity-6"
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard Siswa</span>
                </a>
            </li>
        @endif
        @if (Gate::allows('isAdmin'))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboardAdmin') ? 'active' : '' }}"
                href="{{ url('dashboardAdmin') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
    @endif
    @if (Gate::allows('isKepalaSekolah'))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboardKepalaSekolah') ? 'active' : '' }}"
                href="{{ url('dashboardKepalaSekolah') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
    @endif
  
    @if (Gate::allows('isKurikulum'))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboardKurikulum') ? 'active' : '' }}"
                href="{{ url('dashboardKurikulum') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
    @endif
    @if (Gate::allows('isGuru'))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboardGuru') ? 'active' : '' }}"
                href="{{ url('dashboardGuru') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
    @endif
    @if (Gate::allows('isSiswa'))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboardSiswa') ? 'active' : '' }}"
                href="{{ url('dashboardSiswa') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
    @endif
    @if (Gate::allows('isNonSiswa'))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboardNonSiswa') ? 'active' : '' }}"
                href="{{ url('dashboardNonSiswa') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                    <g transform="translate(0.000000, 148.000000)">
                                        <path class="color-background opacity-6"
                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                        </path>
                                        <path class="color-background"
                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        @endif
        @if (Gate::allows('isKepalaSekolah'))

        <li class="nav-item">
            <a class="nav-link {{ Request::is('kepsek') ? 'active' : '' }}"
                href="{{ url('kepsek') }}">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-cubes"></i>
                </div>
                <span class="nav-link-text ms-1">Data Kepala Sekolah</span>
            </a>
        </li>
        @endif
                    @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples1" role="button"
                          aria-expanded="false" aria-controls="laravelExamples1">
                          <div
                              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                              <i class="fas fa-database"></i>
                          </div>
                          <span class="nav-link-text ms-1">Data Master</span>
                      </a>
                      <div class="collapse" id="laravelExamples1">
                          <ul class="nav ms-4">
                              <li class="nav-item">
                                  <a class="nav-link {{ Request::is('Kurikulum') ? 'active' : '' }}" href="{{ url('Kurikulum') }}">
                                      <span class="nav-link-text ms-1">Data Kurikulum</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav ms-4">
                              <li class="nav-item">
                                  <a class="nav-link {{ Request::is('Tahunakademik') ? 'active' : '' }}" href="{{ url('Tahunakademik') }}">
                                      <span class="nav-link-text ms-1">Data Tahun Akademik</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav ms-4">
                              <li class="nav-item">
                                  <a class="nav-link {{ Request::is('Matapelajaran') ? 'active' : '' }}" href="{{ url('Matapelajaran') }}">
                                      <span class="nav-link-text ms-1">Data Mata Pelajaran</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav ms-4">
                              <li class="nav-item">
                                  <a class="nav-link {{ Request::is('Kelas') ? 'active' : '' }}" href="{{ url('Kelas') }}">
                                      <span class="nav-link-text ms-1">Data Kelas</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav ms-4">
                              <li class="nav-item">
                                  <a class="nav-link {{ Request::is('Ekstrakulikuler') ? 'active' : '' }}" href="{{ url('Ekstrakulikuler') }}">
                                      <span class="nav-link-text ms-1">Data Ekstrakulikuler</span>
                                  </a>
                              </li>
                          </ul>
                          <ul class="nav ms-4">
                              <li class="nav-item">
                                  <a class="nav-link {{ Request::is('Organisasi') ? 'active' : '' }}" href="{{ url('Organisasi') }}">
                                      <span class="nav-link-text ms-1">Data Organisasi</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  @endif
                  @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples2" role="button"
                        aria-expanded="false" aria-controls="laravelExamples2">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users"></i> 
                        </div>
                        <span class="nav-link-text ms-1">Tombol Pembukaan</span>
                    </a>
                    <div class="collapse" id="laravelExamples2">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('Tombol') ? 'active' : '' }}" href="{{ url('Tombol') }}">
                                    <span class="nav-link-text ms-1">Tombol URL</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples3" role="button"
                      aria-expanded="false" aria-controls="laravelExamples3">
                      <div
                          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fas fa-layer-group"></i>
                      </div>
                      <span class="nav-link-text ms-1">Osis</span>
                  </a>
                  <div class="collapse" id="laravelExamples3">
                      <ul class="nav ms-4">
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('Osis') ? 'active' : '' }}" href="{{ url('Osis') }}">
                                  <span class="nav-link-text ms-1">Penambahan Calon</span>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav ms-4">
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('Voting') ? 'active' : '' }}" href="{{ url('Voting') }}">
                                  <span class="nav-link-text ms-1">Pemilihan Ketua Osis</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              @endif
            @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
      
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Dataguru') ? 'active' : '' }}"
                  href="{{ url('Dataguru') }}">
                  <div
                      class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-male"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Guru</span>
              </a>
          </li>
          @endif
          @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
      
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples4" role="button"
                aria-expanded="false" aria-controls="laravelExamples4">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-female"></i>
                </div>
                <span class="nav-link-text ms-1">Daftar Siswa</span>
            </a>
            <div class="collapse" id="laravelExamples4">
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Datasiswa') ? 'active' : '' }}" href="{{ url('Datasiswa') }}">
                            <span class="nav-link-text ms-1">Daftar Siswa</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Siswalulus') ? 'active' : '' }}" href="{{ url('Siswalulus') }}">
                            <span class="nav-link-text ms-1">Daftar Siswa Lulus</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Siswaarsip') ? 'active' : '' }}" href="{{ url('Siswaarsip') }}">
                            <span class="nav-link-text ms-1">Data Arsip</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Siswaarsipall') ? 'active' : '' }}" href="{{ url('Siswaarsipall') }}">
                            <span class="nav-link-text ms-1">Data Seluruh Arsip</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
      @endif
      @if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
<li class="nav-item">
    <a class="nav-link {{ Request::is('Datamengajar') ? 'active' : '' }}"
        href="{{ url('Datamengajar') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt"></i>
        </div>
        <span class="nav-link-text ms-1">Data Mengajar</span>
    </a>
</li>
@endif
@if (Gate::allows('isGuru')|| Gate::allows('isKurikulum')|| Gate::allows('isSiswa'))
    <li class="nav-item">
        <a class="nav-link {{ Request::is('DatasiswaKGS') ? 'active' : '' }}"
            href="{{ url('DatasiswaKGS') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Siswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('DataguruKGS') ? 'active' : '' }}"
            href="{{ url('DataguruKGS') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-male"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Guru</span>
        </a>
    </li>
@endif

@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))
<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples2" role="button"
      aria-expanded="false" aria-controls="laravelExamples2">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-cubes"></i> 
      </div>
      <span class="nav-link-text ms-1">Pengaturan Kelas</span>
  </a>
  <div class="collapse" id="laravelExamples2">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Pengaturankelas') ? 'active' : '' }}" href="{{ url('Pengaturankelas') }}">
                  <span class="nav-link-text ms-1">Pengaturan Kelas Siswa</span>
              </a>
          </li>
      </ul>
  </div>
  <div class="collapse" id="laravelExamples2">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Tambahsiswa') ? 'active' : '' }}" href="{{ url('Kelassiswa') }}">
                  <span class="nav-link-text ms-1">Tambah Siswa ke Kelas</span>
              </a>
          </li>
      </ul>
  </div>
 
</li>
@endif
@if (Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))
<li class="nav-item">
  <a class="nav-link {{ Request::is('kelassaya') ? 'active' : '' }}"
      href="{{ url('kelassaya') }}">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-cubes"></i>
      </div>
      <span class="nav-link-text ms-1">Kelas</span>
  </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')||Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('Ekstrasiswa') ? 'active' : '' }}"
        href="{{ url('Ekstrasiswa') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cloud"></i>
        </div>
        <span class="nav-link-text ms-1">Ekstrakulikuler Detail</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')||Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('Organisasisiswa') ? 'active' : '' }}"
        href="{{ url('Organisasisiswa') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-book"></i>
        </div>
        <span class="nav-link-text ms-1">Organisasi</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('menumengajar') ? 'active' : '' }}"
        href="{{ url('menumengajar') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar"></i>
        </div>
        <span class="nav-link-text ms-1">Menu Mengajar</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')|| Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('tugas') ? 'active' : '' }}"
        href="{{ url('tugas') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-coffee"></i>
        </div>
        <span class="nav-link-text ms-1">Tugas</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah')|| Gate::allows('isKurikulum')|| Gate::allows('isGuru')|| Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('identitas') ? 'active' : '' }}"
        href="{{ url('identitas') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-desktop"></i>
        </div>
        <span class="nav-link-text ms-1">Identitas Sekolah</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin')|| Gate::allows('isKepalaSekolah'))

<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples5" role="button"
      aria-expanded="false" aria-controls="laravelExamples5">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-download"></i> 
      </div>
      <span class="nav-link-text ms-1">Data Laporan</span>
  </a>
  <div class="collapse" id="laravelExamples5">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('dataguruall') ? 'active' : '' }}" href="{{ url('user-profileSU') }}">
                  <span class="nav-link-text ms-1">Data Guru</span>
              </a>
          </li>
      </ul>
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('datasiswaall') ? 'active' : '' }}" href="{{ url('user-profileSU') }}">
                  <span class="nav-link-text ms-1">Data Siswa</span>
              </a>
          </li>
      </ul>
      
  </div>
</li>
@endif
        </ul>
    </div>
</aside> --}}

{{-- <style>
  .icon i, .icon svg {
    color: #5e72e4; 
    font-size: 16px; 
}
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-1 fixed-start ms-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav">
        </i>
        <div class="d-flex align-items-center">
            @if (Gate::allows('isSU') && Gate::denies('isAdmin') && Gate::denies('isGuru') && Gate::denies('isKepalaSekolah') && Gate::denies('isKurikulum') && Gate::denies('isSiswa') && Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardSU') }}">
            @endif



            @if (Gate::allows('isAdmin') && Gate::denies('isSU') && Gate::denies('isGuru') && Gate::denies('isKepalaSekolah') && Gate::denies('isKurikulum') && Gate::denies('isSiswa') && Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardAdmin') }}">
            @endif
            @if (Gate::allows('isKepalaSekolah') && Gate::denies('isAdmin') && Gate::denies('isGuru') && Gate::denies('isSU') && Gate::denies('isKurikulum') && Gate::denies('isSiswa') && Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardKepalaSekolah') }}">
            @endif
            @if (Gate::allows('isGuru') && Gate::denies('isAdmin') && Gate::denies('isSU') && Gate::denies('isKepalaSekolah') && Gate::denies('isKurikulum') && Gate::denies('isSiswa') && Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardGuru') }}">
            @endif
            @if (Gate::allows('isKurikulum') && Gate::denies('isAdmin') && Gate::denies('isGuru') && Gate::denies('isKepalaSekolah') && Gate::denies('isSU') && Gate::denies('isSiswa') && Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardKurikulum') }}">
            @endif
            @if (Gate::allows('isSiswa') && Gate::denies('isAdmin') && Gate::denies('isGuru') && Gate::denies('isKepalaSekolah') && Gate::denies('isKurikulum') && Gate::denies('isSU') && Gate::denies('isNonSiswa'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardSiswa') }}">
            @endif
            @if (Gate::allows('isNonSiswa') && Gate::denies('isAdmin') && Gate::denies('isGuru') && Gate::denies('isKepalaSekolah') && Gate::denies('isKurikulum') && Gate::denies('isSiswa') && Gate::denies('isSU'))
                <a class="navbar-brand text-wrap" href="{{ url('dashboardNonSiswa') }}">
            @endif

            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/50204458.jpg')}}" class="navbar-brand-img h-100 me-2" alt="Logo">
                <div>
                    <h5 class="ms-3 font-weight-bold d-none d-md-inline">Kemara-ES</h5>

                </div>
            </div>
            </a>
        </div>
    </div>
    @php
        $username = optional(auth()->user())->username;
        $hakakses = optional(auth()->user())->hakakses;
    @endphp
    <small class="d-block font-weight-bold"style="font-size: 0.9em; margin-left: 15px;"> Selamat Datang,
        {{ $username ?? 'Tidak ada' }}</small>
    <small class="text-muted"style="font-size: 0.8em; margin-left: 15px;">Hak Akses
        :{{ $hakakses ?? 'Tidak ada' }}</small>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples" role="button"
                    aria-expanded="false" aria-controls="laravelExamples">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                            <title>profile</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6"
                                                d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                            </path>
                                            <path class="color-background"
                                                d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            @if (Gate::allows('isSU'))
                                <a class="nav-link {{ Request::is('user-profileSU') ? 'active' : '' }}"
                                    href="{{ url('user-profileSU') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isKepalaSekolah'))
                                <a class="nav-link {{ Request::is('user-profileKepalaSekolah') ? 'active' : '' }}"
                                    href="{{ url('user-profileKepalaSekolah') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isGuru'))
                                <a class="nav-link {{ Request::is('user-profileGuru') ? 'active' : '' }}"
                                    href="{{ url('user-profileGuru') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isKurikulum'))
                                <a class="nav-link {{ Request::is('user-profileKurikulum') ? 'active' : '' }}"
                                    href="{{ url('user-profileKurikulum') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isSiswa'))
                                <a class="nav-link {{ Request::is('user-profileSiswa') ? 'active' : '' }}"
                                    href="{{ url('user-profileSiswa') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                                <a class="nav-link {{ Request::is('Ekstra-ku') ? 'active' : '' }}"
                                    href="{{ url('Ekstra-ku') }}">
                                    <span class="nav-link-text ms-1">Ekstrakulikuler-ku</span>
                                </a>
                                <a class="nav-link {{ Request::is('Organisasi-ku') ? 'active' : '' }}"
                                    href="{{ url('Organisasi-ku') }}">
                                    <span class="nav-link-text ms-1">Organisasi-ku</span>
                                </a>
                            @endif
                            @if (Gate::allows('isNonSiswa'))
                                <a class="nav-link {{ Request::is('user-profileNonSiswa') ? 'active' : '' }}"
                                    href="{{ url('user-profileNonSiswa') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                            @if (Gate::allows('isAdmin'))
                                <a class="nav-link {{ Request::is('user-profileAdmin') ? 'active' : '' }}"
                                    href="{{ url('user-profileAdmin') }}">
                                    <span class="nav-link-text ms-1">Edit Profile</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
            
            @if (Gate::allows('isSU'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardSU') ? 'active' : '' }}"
                        href="{{ url('dashboardSU') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardSUSiswa') ? 'active' : '' }}"
                        href="{{ url('dashboardSUSiswa') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard Siswa</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isAdmin'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardAdmin') ? 'active' : '' }}"
                        href="{{ url('dashboardAdmin') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isKepalaSekolah'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardKepalaSekolah') ? 'active' : '' }}"
                        href="{{ url('dashboardKepalaSekolah') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
          
            @if (Gate::allows('isKurikulum'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardKurikulum') ? 'active' : '' }}"
                        href="{{ url('dashboardKurikulum') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isGuru'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardGuru') ? 'active' : '' }}"
                        href="{{ url('dashboardGuru') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isSiswa'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardSiswa') ? 'active' : '' }}"
                        href="{{ url('dashboardSiswa') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (Gate::allows('isNonSiswa'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboardNonSiswa') ? 'active' : '' }}"
                        href="{{ url('dashboardNonSiswa') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                @endif
                @if (Gate::allows('isKepalaSekolah'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('kepsek') ? 'active' : '' }}"
        href="{{ url('kepsek') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cubes"></i>
        </div>
        <span class="nav-link-text ms-1">Data Kepala Sekolah</span>
    </a>
</li>
@endif
            @if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples1" role="button"
                  aria-expanded="false" aria-controls="laravelExamples1">
                  <div
                      class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-database"></i>
                  </div>
                  <span class="nav-link-text ms-1">Data Master</span>
              </a>
              <div class="collapse" id="laravelExamples1">
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Kurikulum') ? 'active' : '' }}" href="{{ url('Kurikulum') }}">
                              <span class="nav-link-text ms-1">Data Kurikulum</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Tahunakademik') ? 'active' : '' }}" href="{{ url('Tahunakademik') }}">
                              <span class="nav-link-text ms-1">Data Tahun Akademik</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Matapelajaran') ? 'active' : '' }}" href="{{ url('Matapelajaran') }}">
                              <span class="nav-link-text ms-1">Data Mata Pelajaran</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Kelas') ? 'active' : '' }}" href="{{ url('Kelas') }}">
                              <span class="nav-link-text ms-1">Data Kelas</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Ekstrakulikuler') ? 'active' : '' }}" href="{{ url('Ekstrakulikuler') }}">
                              <span class="nav-link-text ms-1">Data Ekstrakulikuler</span>
                          </a>
                      </li>
                  </ul>
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Organisasi') ? 'active' : '' }}" href="{{ url('Organisasi') }}">
                              <span class="nav-link-text ms-1">Data Organisasi</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif
            @if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples2" role="button"
                  aria-expanded="false" aria-controls="laravelExamples2">
                  <div
                      class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-users"></i> 
                  </div>
                  <span class="nav-link-text ms-1">Tombol Pembukaan</span>
              </a>
              <div class="collapse" id="laravelExamples2">
                  <ul class="nav ms-4">
                      <li class="nav-item">
                          <a class="nav-link {{ Request::is('Tombol') ? 'active' : '' }}" href="{{ url('Tombol') }}">
                              <span class="nav-link-text ms-1">Tombol URL</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif
          @if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples3" role="button"
                aria-expanded="false" aria-controls="laravelExamples3">
                <div
                    class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-layer-group"></i>
                </div>
                <span class="nav-link-text ms-1">Osis</span>
            </a>
            <div class="collapse" id="laravelExamples3">
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Osis') ? 'active' : '' }}" href="{{ url('Osis') }}">
                            <span class="nav-link-text ms-1">Penambahan Calon</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('Voting') ? 'active' : '' }}" href="{{ url('Voting') }}">
                            <span class="nav-link-text ms-1">Pemilihan Ketua Osis</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif
      @if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))

    <li class="nav-item">
        <a class="nav-link {{ Request::is('Dataguru') ? 'active' : '' }}"
            href="{{ url('Dataguru') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-male"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Guru</span>
        </a>
    </li>
    @endif
    @if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples4" role="button"
          aria-expanded="false" aria-controls="laravelExamples4">
          <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-female"></i>
          </div>
          <span class="nav-link-text ms-1">Daftar Siswa</span>
      </a>
      <div class="collapse" id="laravelExamples4">
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Datasiswa') ? 'active' : '' }}" href="{{ url('Datasiswa') }}">
                      <span class="nav-link-text ms-1">Daftar Siswa</span>
                  </a>
              </li>
          </ul>
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Siswalulus') ? 'active' : '' }}" href="{{ url('Siswalulus') }}">
                      <span class="nav-link-text ms-1">Daftar Siswa Lulus</span>
                  </a>
              </li>
          </ul>
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Siswaarsip') ? 'active' : '' }}" href="{{ url('Siswaarsip') }}">
                      <span class="nav-link-text ms-1">Data Arsip</span>
                  </a>
              </li>
          </ul>
          <ul class="nav ms-4">
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('Siswaarsipall') ? 'active' : '' }}" href="{{ url('Siswaarsipall') }}">
                      <span class="nav-link-text ms-1">Data Seluruh Arsip</span>
                  </a>
              </li>
          </ul>
      </div>
  </li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))
<li class="nav-item">
    <a class="nav-link {{ Request::is('Datamengajar') ? 'active' : '' }}"
        href="{{ url('Datamengajar') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt"></i>
        </div>
        <span class="nav-link-text ms-1">Data Mengajar</span>
    </a>
</li>
@endif
@if (Gate::allows('isGuru') || Gate::allows('isKurikulum') || Gate::allows('isSiswa'))
    <li class="nav-item">
        <a class="nav-link {{ Request::is('DatasiswaKGS') ? 'active' : '' }}"
            href="{{ url('DatasiswaKGS') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Siswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('DataguruKGS') ? 'active' : '' }}"
            href="{{ url('DataguruKGS') }}">
            <div
                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-male"></i>
            </div>
            <span class="nav-link-text ms-1">Daftar Guru</span>
        </a>
    </li>
@endif

@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))
<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples2" role="button"
      aria-expanded="false" aria-controls="laravelExamples2">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-cubes"></i> 
      </div>
      <span class="nav-link-text ms-1">Pengaturan Kelas</span>
  </a>
  <div class="collapse" id="laravelExamples2">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Pengaturankelas') ? 'active' : '' }}" href="{{ url('Pengaturankelas') }}">
                  <span class="nav-link-text ms-1">Pengaturan Kelas Siswa</span>
              </a>
          </li>
      </ul>
  </div>
  <div class="collapse" id="laravelExamples2">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('Tambahsiswa') ? 'active' : '' }}" href="{{ url('Kelassiswa') }}">
                  <span class="nav-link-text ms-1">Tambah Siswa ke Kelas</span>
              </a>
          </li>
      </ul>
  </div>
 
</li>
@endif
@if (Gate::allows('isKurikulum') || Gate::allows('isGuru') || Gate::allows('isSiswa'))
<li class="nav-item">
  <a class="nav-link {{ Request::is('kelassaya') ? 'active' : '' }}"
      href="{{ url('kelassaya') }}">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-cubes"></i>
      </div>
      <span class="nav-link-text ms-1">Kelas</span>
  </a>
</li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah') || Gate::allows('isKurikulum') || Gate::allows('isGuru') || Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('Ekstrasiswa') ? 'active' : '' }}"
        href="{{ url('Ekstrasiswa') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cloud"></i>
        </div>
        <span class="nav-link-text ms-1">Ekstrakulikuler Detail</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah') || Gate::allows('isKurikulum') || Gate::allows('isGuru') || Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('Organisasisiswa') ? 'active' : '' }}"
        href="{{ url('Organisasisiswa') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-book"></i>
        </div>
        <span class="nav-link-text ms-1">Organisasi</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('menumengajar') ? 'active' : '' }}"
        href="{{ url('menumengajar') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar"></i>
        </div>
        <span class="nav-link-text ms-1">Menu Mengajar</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah') || Gate::allows('isKurikulum') || Gate::allows('isGuru') || Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('tugas') ? 'active' : '' }}"
        href="{{ url('tugas') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-coffee"></i>
        </div>
        <span class="nav-link-text ms-1">Tugas</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah') || Gate::allows('isKurikulum') || Gate::allows('isGuru') || Gate::allows('isSiswa'))

<li class="nav-item">
    <a class="nav-link {{ Request::is('identitas') ? 'active' : '' }}"
        href="{{ url('identitas') }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-desktop"></i>
        </div>
        <span class="nav-link-text ms-1">Identitas Sekolah</span>
    </a>
</li>
@endif
@if (Gate::allows('isAdmin') || Gate::allows('isKepalaSekolah'))

<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples5" role="button"
      aria-expanded="false" aria-controls="laravelExamples5">
      <div
          class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-download"></i> 
      </div>
      <span class="nav-link-text ms-1">Data Laporan</span>
  </a>
  <div class="collapse" id="laravelExamples5">
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('dataguruall') ? 'active' : '' }}" href="{{ url('user-profileSU') }}">
                  <span class="nav-link-text ms-1">Data Guru</span>
              </a>
          </li>
      </ul>
      <ul class="nav ms-4">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('datasiswaall') ? 'active' : '' }}" href="{{ url('user-profileSU') }}">
                  <span class="nav-link-text ms-1">Data Siswa</span>
              </a>
          </li>
      </ul>
      
  </div>
</li>
@endif
              </aside> --}}
