<!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 {{ (Request::is('static-sign-up') ? 'w-100 shadow-none  navbar-transparent mt-4' : 'blur blur-rounded shadow py-2 start-0 end-0 mx4') }}">
  <div class="container-fluid {{ (Request::is('static-sign-up') ? 'container' : 'container-fluid') }}">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 {{ (Request::is('login') ? 'text-black' : '') }}" href="{{ url('login') }}">
      Kemara-ES
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mx-auto">
     
        
        {{-- <li class="nav-item ms-auto">
          <a class="nav-link me-2" href="{{  ? url('') : url('') }}">
              <i class="fas fa-key opacity-6 me-1 {{ (Request::is('') ? '' : 'text-dark') }}"></i>
              Profile
          </a>
      </li> --}}
      <li class="nav-item ms-auto">
        <a class="nav-link me-2" href="{{ url('/Beranda') }}">
            <i class="fas fa-users opacity-6 me-1 {{ Request::is('Beranda') ? '' : 'text-dark' }}"></i>
            Beranda
        </a>
    </li>
      <li class="nav-item ms-auto">
        <a class="nav-link me-2" href="{{ url('/Profile') }}">
            <i class="fas fa-news opacity-6 me-1 {{ Request::is('Profile') ? '' : 'text-dark' }}"></i>
            Profile
        </a>
    </li>
      <li class="nav-item ms-auto">
        <a class="nav-link me-2" href="{{ url('/login') }}">
            <i class="fas fa-news opacity-6 me-1 {{ Request::is('login') ? '' : 'text-dark' }}"></i>
            Login
        </a>
    </li>
    
      
      
        {{-- <li class="nav-item">
          <a class="nav-link me-2" href="{{ auth()->user() ? url('static-sign-in') : url('login') }}">
            <i class="fas fa-key opacity-6 me-1 {{ (Request::is('static-sign-up') ? '' : 'text-dark') }}"></i>
            About
          </a>
        </li> --}}
      </ul>
   
    </div>
  </div>
</nav>
<!-- End Navbar -->
