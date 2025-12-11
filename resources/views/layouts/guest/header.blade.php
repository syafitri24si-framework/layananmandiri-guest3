<div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================= preloader end ========================= -->

    <!-- ========================= hero-section-wrapper-5 start ========================= -->
    <section id="home" class="hero-section-wrapper-5">

 <header class="header header-6">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#home">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" height="60">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                                    @if(Auth::check())
                                    <li class="nav-item">
                                       <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#home">
                                        Home
                                    </a></li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#about">
                                        About
                                    </a></li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#layanan">
                                        Layanan
                                    </a></li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.index') }}#kontak">
                                        Kontak
                                    </a></li>
                                    <li class="nav-item"><a class="page-scroll" href="{{route('auth.logout')}}">Logout</a></li>
                                    @else
                                    <li class="nav-item"><a class="btn btn-primary" href="{{route('auth.index')}}">Login</a></li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
