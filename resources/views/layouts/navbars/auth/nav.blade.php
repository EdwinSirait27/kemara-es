{{-- @php
    $user = auth()->user();
    $username = optional($user)->username;
    $hakakses = optional($user)->hakakses;
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-none border-radius-xl px-0 mx-4" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="d-flex justify-content-between w-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                   
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', e(Request::path())) }}</h4>
            </nav>
            <ul class="navbar-nav justify-content-end align-items-center">
                <li class="nav-item d-xl-none ps-3">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2">
                    <a href="javascript:;" class="nav-link text-body p-0 d-inline-flex align-items-center" id="dropdownMenuButton" 
   data-bs-toggle="dropdown" aria-expanded="false" title="Pengaturan">
    <span>{{ $username ?? 'Guest' }}|{{ ucfirst($hakakses ?? 'unknown') }}</span>
    <i class="fa fa-cog cursor-pointer ms-2"></i>
</a>

                 
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        @if (Gate::allows('isSU'))
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('user-profileSU.create') }}">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-male me-2"></i> Profile
                                    </h6>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('dashboardSU.index') }}">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-home me-2"></i> Dashboard
                                    </h6>
                                </a>
                            </li>
                        @endif
                        @if (Gate::allows('isKepalaSekolah'))
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('user-profileKepalaSekolah.create') }}">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-male me-2"></i> Profile
                                    </h6>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('dashboardKepalaSekolah.index') }}">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-home me-2"></i> Dashboard
                                    </h6>
                                </a>
                            </li>
                        @endif
                        @if (Gate::allows('isAdmin'))
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('user-profileAdmin.create') }}">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-male me-2"></i> Profile
                                    </h6>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('dashboardAdmin.index') }}">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-home me-2"></i> Dashboard
                                    </h6>
                                </a>
                            </li>
                        @endif
                        <!-- Other roles -->
                        <form method="POST" action="{{ url('/logout') }}" class="d-inline">
                            @csrf
                            <li class="mb-2">
                                <button type="submit" class="dropdown-item border-radius-md btn-logout">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-reply me-2" style="color: #ff0040;"></i> Sign-Out
                                    </h6>
                                </button>
                            </li>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 576px) {
        .navbar .navbar-nav {
            margin-left: 0 !important;
        }
        .navbar .nav-item {
            margin-right: 0px;
        }
        .navbar .dropdown-menu {
            position: absolute !important;
            top: 50px;
            left: 50;
            right: 0;
            width: 100% !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-top: 5px;
        }
        .navbar .sidenav-toggler-inner {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    width: 25px;
    margin-left: auto; /* Geser elemen sepenuhnya ke kanan */
    margin-right: -70px; /* Tambahkan jarak dari sisi kanan */
    margin-top: -25px; /* Tambahkan jarak dari sisi kanan */
}


    }
</style> --}}
@php
    $user = auth()->user();
    $username = optional($user)->username;
    $hakakses = optional($user)->hakakses;
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm border-radius-xl" id="navbarBlur">
    <div class="container-fluid py-2">
        <div class="d-flex justify-content-between align-items-center w-100">
            <!-- Breadcrumb and Page Title -->
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                            {{ str_replace('-', ' ', e(Request::path())) }}
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Right Navigation Items -->
            <div class="navbar-nav-wrapper d-flex align-items-center">
                <!-- Mobile Toggle -->
                <button class="navbar-toggler d-block d-lg-none ms-auto me-3" type="button" id="iconNavbarSidenav">
                    <span class="navbar-toggler-icon-custom">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </span>
                </button>

                <!-- User Menu -->
                <div class="nav-item dropdown">
                    <a href="javascript:;" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline-block">
                            {{ $username ?? 'Guest' }} | {{ ucfirst($hakakses ?? 'unknown') }}
                        </span>
                        <i class="fa fa-cog ms-2"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @if (Gate::allows('isSU'))
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('user-profileSU.create') }}">
                                    <i class="fa fa-male me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('dashboardSU.index') }}">
                                    <i class="fa fa-home me-2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        @if (Gate::allows('isKepalaSekolah'))
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('user-profileKepalaSekolah.create') }}">
                                    <i class="fa fa-male me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('dashboardKepalaSekolah.index') }}">
                                    <i class="fa fa-home me-2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        @if (Gate::allows('isAdmin'))
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('user-profileAdmin.create') }}">
                                    <i class="fa fa-male me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('dashboardAdmin.index') }}">
                                    <i class="fa fa-home me-2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        
                        <li>
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fa fa-reply me-2"></i> Sign-Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
}

.navbar-brand-wrapper {
    max-width: 70%;
}

.breadcrumb {
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.navbar-toggler {
    padding: 0;
    border: none;
    background: transparent;
}

.navbar-toggler-icon-custom {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 24px;
}

.sidenav-toggler-line {
    height: 2px;
    width: 24px;
    background-color: #344767;
    margin: 2px 0;
    transition: all 0.3s ease;
    border-radius: 1px;
}

.dropdown-menu {
    min-width: 200px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 0.5rem;
}

.dropdown-item {
    transition: all 0.2s ease;
    border-radius: 0.25rem;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

@media (max-width: 991.98px) {
    .navbar-brand-wrapper {
        max-width: 60%;
    }
    
    .breadcrumb {
        font-size: 0.875rem;
    }
}

@media (max-width: 767.98px) {
    .navbar-brand-wrapper {
        max-width: 50%;
    }
    
    .dropdown-menu {
        position: absolute;
        right: 0;
        left: auto;
        width: 200px;
    }
}

@media (max-width: 575.98px) {
    .navbar-brand-wrapper {
        max-width: 40%;
    }
    
    .breadcrumb-item {
        font-size: 0.75rem;
    }
}
</style>