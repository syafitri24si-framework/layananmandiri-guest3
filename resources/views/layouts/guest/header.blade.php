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
                            <!-- Logo dan Nama Website -->
                            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                                <!-- Logo -->
                                <img src="{{ asset('assets/img/logo/logohorizontal.png') }}" alt="Bina Desa"
                                    style="height: 100px; width: auto; max-width: 900px;">

                                <!-- Nama Website di samping Logo -->
                                <div class="ms-3">
                                    <h1 class="mb-0" style="color: #333; font-size: 24px; font-weight: 700;"></h1>
                                    <p class="mb-0" style="color: #666; font-size: 14px; font-weight: 400;"></p>
                                </div>
                            </a>

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                                    @if (Auth::check())
                                        <!-- Untuk user yang sudah login -->
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                                href="{{ route('dashboard') }}">
                                                Home
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                                href="{{ route('about') }}">
                                                About
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}"
                                                href="{{ route('layanan') }}">
                                                Layanan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                                href="{{ route('contact') }}">
                                                Kontak
                                            </a>
                                        </li>


                                        <!-- Dropdown User Profile -->
                                        <li class="nav-item dropdown ms-3">
                                            <a class="nav-link dropdown-toggle d-flex align-items-center"
                                               href="#"
                                               role="button"
                                               data-bs-toggle="dropdown"
                                               aria-expanded="false">
                                                <!-- Foto Profil -->
                                                <div class="user-avatar me-2">
                                                    @if(Auth::user()->profile_picture)
                                                        <img src="{{ Auth::user()->profile_picture_url }}"
                                                             alt="{{ Auth::user()->name }}"
                                                             class="rounded-circle"
                                                             style="width: 35px; height: 35px; object-fit: cover;">
                                                    @else
                                                        <div class="default-avatar rounded-circle d-flex align-items-center justify-content-center"
                                                             style="width: 35px; height: 35px; background-color: #f0f0f0;">
                                                            <i class="lni lni-user" style="font-size: 18px; color: #6c757d;"></i>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Nama User dan Role -->
                                                <div class="user-info text-start">
                                                    <span class="d-block" style="font-size: 14px; font-weight: 600;">
                                                        {{ Auth::user()->name }}
                                                    </span>
                                                    <small class="d-block text-muted" style="font-size: 11px;">
                                                        {{ Auth::user()->role }}
                                                    </small>
                                                </div>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!-- Info User -->
                                                <li class="dropdown-header">
                                                    <div class="d-flex align-items-center p-2">
                                                        @if(Auth::user()->profile_picture)
                                                            <img src="{{ Auth::user()->profile_picture_url }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="rounded-circle me-2"
                                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                                        @else
                                                            <div class="default-avatar rounded-circle d-flex align-items-center justify-content-center me-2"
                                                                 style="width: 40px; height: 40px; background-color: #f0f0f0;">
                                                                <i class="lni lni-user" style="font-size: 20px; color: #6c757d;"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>

                                                <!-- Menu Profile -->
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.show', Auth::id()) }}">
                                                        <i class="lni lni-user me-2"></i> Profil Saya
                                                    </a>
                                                </li>

                                                <!-- Menu Edit Profile -->
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.edit', Auth::id()) }}">
                                                        <i class="lni lni-cog me-2"></i> Edit Profil
                                                    </a>
                                                </li>

                                                <!-- Menu Dashboard Admin (hanya untuk Admin) -->
                                                @if(Auth::user()->role === 'Admin')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                                        <i class="lni lni-dashboard me-2"></i> Dashboard Admin
                                                    </a>
                                                </li>
                                                @endif

                                                <li><hr class="dropdown-divider"></li>

                                                <!-- Menu Logout -->
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}">
                                                        <i class="lni lni-exit me-2"></i> Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                    @else
                                        <!-- Untuk user belum login -->
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                                href="{{ route('home') }}">
                                                Home
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                                href="{{ route('about') }}">
                                                About
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}"
                                                href="{{ route('layanan') }}">
                                                Layanan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                                href="{{ route('contact') }}">
                                                Kontak
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="btn btn-primary" href="{{ route('auth.index') }}">
                                                Login
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

<style>
    /* User Dropdown Styling */
    .user-avatar img {
        border: 2px solid #e9ecef;
        transition: border-color 0.3s ease;
    }

    .user-avatar img:hover {
        border-color: #1E3A8A;
    }

    .default-avatar {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .default-avatar:hover {
        background-color: #e9ecef !important;
        border-color: #1E3A8A;
    }

    .user-info {
        min-width: 120px;
    }

    /* Dropdown Menu Styling */
    .dropdown-menu {
        min-width: 250px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 10px 0;
    }

    .dropdown-header {
        padding: 10px 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .dropdown-item {
        padding: 10px 20px;
        border-radius: 5px;
        margin: 2px 10px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f0f7ff;
        color: #1E3A8A;
    }

    .dropdown-item i {
        width: 20px;
        text-align: center;
    }

    /* Navbar Responsive */
    @media (max-width: 991px) {
        .user-info {
            display: none;
        }

        .dropdown-menu {
            position: static;
            float: none;
            width: 100%;
            margin-top: 10px;
        }

        .navbar-nav .dropdown-menu {
            position: static;
            float: none;
            width: 100%;
            margin-top: 0;
            border: 1px solid #e9ecef;
        }

        .nav-item.dropdown {
            margin-top: 10px;
            padding: 10px 0;
            border-top: 1px solid #e9ecef;
        }
    }

    /* Badge Role */
    .role-badge {
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: 600;
    }

    .role-badge-admin {
        background-color: #1E3A8A;
        color: white;
    }

    .role-badge-warga {
        background-color: #10b981;
        color: white;
    }

    /* Navbar Link Active State */
    .nav-link.active {
        color: #1E3A8A !important;
        font-weight: 600;
        position: relative;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #1E3A8A;
        border-radius: 3px;
    }

    /* Button Login */
    .btn-primary {
        background-color: #1E3A8A;
        border-color: #1E3A8A;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #163070;
        border-color: #163070;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Highlight active dropdown items
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        if (item.href === window.location.href) {
            item.classList.add('active');
        }
    });

    // Mobile dropdown toggle functionality
    const dropdownToggle = document.querySelector('.navbar-nav .dropdown-toggle');
    if (dropdownToggle) {
        dropdownToggle.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();
                const dropdownMenu = this.nextElementSibling;

                // Close other open dropdowns
                const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                openDropdowns.forEach(dropdown => {
                    if (dropdown !== dropdownMenu) {
                        dropdown.classList.remove('show');
                    }
                });

                // Toggle current dropdown
                dropdownMenu.classList.toggle('show');
            }
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });

    // Add active class to current nav link
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
});
</script>
