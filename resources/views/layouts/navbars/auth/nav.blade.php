<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-none border-radius-xl px-0 mx-4" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="d-flex justify-content-between w-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
            </nav>

            <!-- Navbar right items -->
            <ul class="navbar-nav  justify-content-end align-items-center">
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
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ auth()->user()->username }} | {{ auth()->user()->hakakses }}</span>
                        <i class="fa fa-cog cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="/user-profile">
                                <h6 class="text text-secondary mb-0">
                                    <i class="fa fa-male me-2"></i>
                                    Profile
                                </h6>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <h6 class="text text-secondary mb-0">
                                    <i class="fa fa-home me-2"></i>
                                    Dashboard
                                </h6>
                            </a>
                        </li>
                        <form method="POST" action="{{ url('/logout')}}" class="d-inline">
                            <li class="mb-2">
                                @csrf
                                <button type="submit" class="dropdown-item border-radius-md" style="background:none; border:none; width:100%; text-align:left;">
                                    <h6 class="text text-secondary mb-0">
                                        <i class="fa fa-reply me-2" style="color: #ff0040;"></i>
                                        Sign-Out
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
<!-- End Navbar -->

<!-- End Navbar -->
{{-- <!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
       
           
            <ul class="navbar-nav  justify-content-end">
           
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
                </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center" >
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <span>{{ auth()->user()->username }} | {{ auth()->user()->hakakses }}</span>
                <i class="fa fa-cog  cursor-pointer"></i>
            </a>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="/user-profile">
                        <h6 class="text text-secondary mb-0">
                            <i class="fa fa-male me-2"></i>
                            Profile
                        </h6>
                    </a>
                </li>

                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="javascript:;">
                        <h6 class="text text-secondary mb-0">
                            <i class="fa fa-home me-2"></i>
                            Dashboard
                        </h6>
                    </a>
                </li>
                <form method="POST" action="{{ url('/logout')}}" class="d-inline">
                <li class="mb-2">
                        @csrf
                        <button type="submit" class="dropdown-item border-radius-md" style="background:none; border:none; width:100%; text-align:left;">
                            <h6 class="text text-secondary mb-0">
                                <i class="fa fa-reply me-2" style="color: #ff0040;"></i>
                                Sign-Out
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
<!-- End Navbar --> --}}