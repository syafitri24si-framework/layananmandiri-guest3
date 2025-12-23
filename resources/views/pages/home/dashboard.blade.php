@extends('layouts.guest.app')

@section('content')
    <!-- ========================= Hero Section start ========================= -->
    <section id="home" class="hero-section-wrapper-5">
        <div class="hero-section hero-style-5 img-bg"
            style="background-image: url('{{ asset('assets/assets-admin/img/hero/hero-5/hero-bg.svg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-content-wrapper">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">
                                Selamat Datang di Layanan Mandiri Suratku
                            </h2>
                            <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">
                                Sistem layanan mandiri berbasis digital yang membantu masyarakat dalam pengurusan surat dan
                                administrasi desa secara cepat, mudah, dan transparan.
                            </p>
                            <a href="#layanan" class="button button-lg radius-50 wow fadeInUp" data-wow-delay=".6s">
                                Lihat Layanan <i class="lni lni-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-end">
                        <div class="hero-image wow fadeInUp" data-wow-delay=".5s">
                            <img src="{{ asset('assets/assets-admin/img/hero/hero-5/hero-img.svg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Hero Section end ========================= -->

<!-- ========================= Slideshow Carousel Section start ========================= -->
<section id="slideshow" class="slideshow-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h3 class="fw-bold mb-3 display-5" data-wow-delay=".2s">Galeri Pelayanan Desa Digital</h3>
                <p class="lead text-muted" data-wow-delay=".4s">
                    Lihat bagaimana Layanan Mandiri Suratku membantu masyarakat dalam pengurusan administrasi
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <!-- Enhanced Carousel -->
                <div id="desaCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators custom-indicators">
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="3"></button>
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner rounded-4 shadow-lg">
                        <!-- Slide 1 - Enhanced -->
                        <div class="carousel-item active">
                            <div class="carousel-slide-content" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="row align-items-center h-100">
                                    <div class="col-lg-6">
                                        <div class="carousel-text p-5 text-white">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-rocket me-2"></i>Fitur Unggulan
                                                </span>
                                            </div>
                                            <h2 class="display-6 fw-bold mb-4">Pelayanan Surat Online</h2>
                                            <p class="mb-4 opacity-90 fs-5">
                                                Permohonan surat keterangan, surat domisili, dan surat administrasi lainnya dapat dilakukan secara online tanpa harus datang ke kantor desa.
                                            </p>
                                            <div class="features-list">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="feature-icon me-3">
                                                        <i class="lni lni-bolt-alt fs-3"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-1">Proses Lebih Cepat</h6>
                                                        <p class="mb-0 opacity-75">Hemat waktu hingga 70%</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="feature-icon me-3">
                                                        <i class="lni lni-timer fs-3"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-1">Tanpa Antri</h6>
                                                        <p class="mb-0 opacity-75">Layanan 24/7 dari rumah</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="feature-icon me-3">
                                                        <i class="lni lni-eye fs-3"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-1">Real-time Tracking</h6>
                                                        <p class="mb-0 opacity-75">Pantau status setiap saat</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="carousel-image-container p-5">
                                            <div class="floating-image">
                                                <img src="{{ asset('assets/img/logo/slide1.jpeg') }}"
                                                     alt="Pelayanan Digital"
                                                     class="img-fluid rounded-4 shadow-lg">
                                                <div class="floating-element floating-1">
                                                    <i class="lni lni-checkmark-circle text-success"></i>
                                                </div>
                                                <div class="floating-element floating-2">
                                                    <i class="lni lni-download text-primary"></i>
                                                </div>
                                                <div class="floating-element floating-3">
                                                    <i class="lni lni-calendar text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 - Enhanced -->
                        <div class="carousel-item">
                            <div class="carousel-slide-content" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="row align-items-center h-100">
                                    <div class="col-lg-6 order-lg-2">
                                        <div class="carousel-text p-5 text-white">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-cloud-upload me-2"></i>Upload Digital
                                                </span>
                                            </div>
                                            <h2 class="display-6 fw-bold mb-4">Upload Berkas Digital</h2>
                                            <p class="mb-4 opacity-90 fs-5">
                                                Upload berkas persyaratan dengan mudah melalui sistem kami. Dukung berbagai format file dengan keamanan terjamin.
                                            </p>
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <div class="stat-card text-center p-3 rounded-3" style="background: rgba(255,255,255,0.15);">
                                                        <i class="lni lni-files fs-1 mb-2"></i>
                                                        <h5 class="fw-bold mb-1">15+</h5>
                                                        <small>Format File</small>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="stat-card text-center p-3 rounded-3" style="background: rgba(255,255,255,0.15);">
                                                        <i class="lni lni-protection fs-1 mb-2"></i>
                                                        <h5 class="fw-bold mb-1">256-bit</h5>
                                                        <small>Enkripsi</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="progress-container">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <small>Kapasitas Upload</small>
                                                        <small>50MB/file</small>
                                                    </div>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar bg-white" style="width: 85%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 order-lg-1">
                                        <div class="carousel-image-container p-5">
                                            <div class="floating-image">
                                                <img src="{{ asset('assets/img/logo/slide2.jpeg') }}"
                                                     alt="Upload Berkas"
                                                     class="img-fluid rounded-4 shadow-lg">
                                                <div class="upload-animation">
                                                    <div class="upload-circle">
                                                        <i class="lni lni-upload"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 - Enhanced -->
                        <div class="carousel-item">
                            <div class="carousel-slide-content" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <div class="row align-items-center h-100">
                                    <div class="col-lg-6">
                                        <div class="carousel-text p-5 text-white">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-map me-2"></i>Tracking Real-time
                                                </span>
                                            </div>
                                            <h2 class="display-6 fw-bold mb-4">Tracking Permohonan</h2>
                                            <p class="mb-4 opacity-90 fs-5">
                                                Lacak perkembangan permohonan surat Anda dari awal pengajuan hingga selesai melalui dashboard yang interaktif.
                                            </p>

                                            <div class="progress-timeline">
                                                <div class="timeline-step active">
                                                    <div class="step-icon">
                                                        <i class="lni lni-paperclip"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1">Pengajuan</h6>
                                                        <small class="opacity-75">Permohonan diterima</small>
                                                    </div>
                                                </div>
                                                <div class="timeline-step active">
                                                    <div class="step-icon">
                                                        <i class="lni lni-checkmark-circle"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1">Verifikasi</h6>
                                                        <small class="opacity-75">Data diverifikasi</small>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div class="step-icon">
                                                        <i class="lni lni-cogs"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1">Proses</h6>
                                                        <small class="opacity-75">Sedang diproses</small>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div class="step-icon">
                                                        <i class="lni lni-checkmark"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1">Selesai</h6>
                                                        <small class="opacity-75">Tunggu konfirmasi</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="carousel-image-container p-5">
                                            <div class="floating-image">
                                                <img src="{{ asset('assets/img/logo/slide3.jpeg') }}"
                                                     alt="Tracking Permohonan"
                                                     class="img-fluid rounded-4 shadow-lg">
                                                <div class="tracking-animation">
                                                    <div class="tracking-dot dot-1"></div>
                                                    <div class="tracking-dot dot-2"></div>
                                                    <div class="tracking-dot dot-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 - Enhanced -->
                        <div class="carousel-item">
                            <div class="carousel-slide-content" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <div class="row align-items-center h-100">
                                    <div class="col-lg-6 order-lg-2">
                                        <div class="carousel-text p-5 text-white">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-users me-2"></i>Komunitas Digital
                                                </span>
                                            </div>
                                            <h2 class="display-6 fw-bold mb-4">Komunitas Digital Desa</h2>
                                            <p class="mb-4 opacity-90 fs-5">
                                                Bergabung dengan komunitas digital desa untuk mendapatkan informasi terbaru, tips, dan bantuan dalam penggunaan sistem.
                                            </p>

                                            <div class="community-stats">
                                                <div class="row g-3">
                                                    <div class="col-4">
                                                        <div class="stat-card text-center p-3 rounded-3" style="background: rgba(255,255,255,0.2);">
                                                            <h3 class="fw-bold mb-0">500+</h3>
                                                            <small>Pengguna Aktif</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="stat-card text-center p-3 rounded-3" style="background: rgba(255,255,255,0.2);">
                                                            <h3 class="fw-bold mb-0">98%</h3>
                                                            <small>Kepuasan</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="stat-card text-center p-3 rounded-3" style="background: rgba(255,255,255,0.2);">
                                                            <h3 class="fw-bold mb-0">24/7</h3>
                                                            <small>Support</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-light btn-lg rounded-pill px-4">
                                                    <i class="lni lni-arrow-right me-2"></i>Bergabung Sekarang
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 order-lg-1">
                                        <div class="carousel-image-container p-5">
                                            <div class="floating-image">
                                                <img src="{{ asset('assets/img/logo/slide4.jpeg') }}"
                                                     alt="Komunitas Desa"
                                                     class="img-fluid rounded-4 shadow-lg">
                                                <div class="community-animation">
                                                    <div class="user-avatar avatar-1">
                                                        <i class="lni lni-user"></i>
                                                    </div>
                                                    <div class="user-avatar avatar-2">
                                                        <i class="lni lni-user"></i>
                                                    </div>
                                                    <div class="user-avatar avatar-3">
                                                        <i class="lni lni-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Controls -->
                    <button class="carousel-control-prev custom-control" type="button" data-bs-target="#desaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next custom-control" type="button" data-bs-target="#desaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
</section>

<!-- ========================= Slideshow Carousel Section end ========================= -->

   <!-- ========================= Identitas Pengembang & Footer Section start ========================= -->
<section id="pengembang" class="contact-section contact-style-5 pt-80 pb-50" style="background: linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 100%);">
    <div class="container">
        <!-- Header Section dengan warna -->
        <div class="row justify-content-center mb-50">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3" style="color: #1E3A8A;">
                    Tim Pengembang Sistem
                </h2>
                <p class="lead" style="color: #4a5568;">
                    Sistem Layanan Mandiri Desa untuk Digitalisasi Pelayanan Administratif
                </p>
            </div>
        </div>

         <!-- Main Content Grid -->
        <div class="row justify-content-center g-4">
            <!-- Left Column - Developer Info (Warna Biru) -->
            <div class="col-lg-4">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1E3A8A 0%, #2d4b9e 100%); color: white; border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="lni lni-user me-2"></i>Identitas Pengembang
                        </h5>

                        <!-- Profile Photo -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('assets/img/logo/profilpengembang.jpeg') }}"
                                     alt="Developer"
                                     class="rounded-circle img-fluid mb-3 border border-4 border-white"
                                     style="width: 140px; height: 140px; object-fit: cover; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-2 border-white">
                                    <i class="lni lni-checkmark-circle"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold mb-1">Aulia Syafitri Hasibuan</h6>
                            <p class="opacity-75 mb-3">Developer Sistem</p>
                        </div>

                        <!-- Personal Info -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                <i class="lni lni-license me-3" style="color: #93c5fd;"></i>
                                <div>
                                    <small class="d-block opacity-75">NIM</small>
                                    <span class="fw-bold">2457301023</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                <i class="lni lni-university me-3" style="color: #93c5fd;"></i>
                                <div>
                                    <small class="d-block opacity-75">Perguruan Tinggi</small>
                                    <span class="fw-bold">Politeknik Caltex Riau</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                <i class="lni lni-graduation me-3" style="color: #93c5fd;"></i>
                                <div>
                                    <small class="d-block opacity-75">Program Studi</small>
                                    <span class="fw-bold">Sistem Informasi</span>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Hubungi Saya</h6>
                            <div class="d-flex gap-2">
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/in/aulia-syafitri-051b44394/"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-sm"
                                   style="background: #0077b5; color: white;"
                                   title="LinkedIn Profile">
                                    <i class="lni lni-linkedin-original"></i>
                                </a>

                                <!-- GitHub -->
                                <a href="https://github.com/syafitri24si-framework"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-sm"
                                   style="background: #333; color: white;"
                                   title="GitHub Profile">
                                    <i class="lni lni-github-original"></i>
                                </a>

                                <!-- Instagram -->
                                <a href="https://www.instagram.com/auliasyftr9?igsh=MXB6ZXZobW91ejk3bg=="
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-sm"
                                   style="background: #e1306c; color: white;"
                                   title="Instagram Profile">
                                    <i class="lni lni-instagram-original"></i>
                                </a>

                                <!-- Email -->
                                <a href="mailto:aulia.syafitri@example.com"
                                   class="btn btn-sm"
                                   style="background: #28a745; color: white;"
                                   title="Kirim Email">
                                    <i class="lni lni-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Middle Column - System Info (Warna Hijau Muda) -->
            <div class="col-lg-4">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%); color: white; border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="lni lni-layers me-2"></i>Informasi Sistem
                        </h5>

                        <!-- System Features -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Fitur Utama</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="lni lni-checkmark-circle me-2" style="color: #d1fae5;"></i>
                                    <span>Layanan Surat Online</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="lni lni-checkmark-circle me-2" style="color: #d1fae5;"></i>
                                    <span>Upload Berkas Digital</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="lni lni-checkmark-circle me-2" style="color: #d1fae5;"></i>
                                    <span>Tracking Permohonan</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="lni lni-checkmark-circle me-2" style="color: #d1fae5;"></i>
                                    <span>Database Terintegrasi</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="lni lni-checkmark-circle me-2" style="color: #d1fae5;"></i>
                                    <span>Laporan Otomatis</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Quick Links -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Akses Cepat</h6>
                            <div class="d-flex flex-column">
                                <a href="{{ route('layanan') }}" class="text-decoration-none text-white mb-2">
                                    <i class="lni lni-arrow-right me-2"></i>Lihat Layanan
                                </a>
                                <a href="{{ route('about') }}" class="text-decoration-none text-white mb-2">
                                    <i class="lni lni-arrow-right me-2"></i>Tentang Sistem
                                </a>
                                <a href="{{ route('jenis_surat.index') }}" class="text-decoration-none text-white mb-2">
                                    <i class="lni lni-arrow-right me-2"></i>Jenis Surat
                                </a>
                                <a href="{{ route('permohonan_surat.index') }}" class="text-decoration-none text-white">
                                    <i class="lni lni-arrow-right me-2"></i>Permohonan
                                </a>
                            </div>
                        </div>

                        <!-- Update Subscription -->
                        <div class="mt-4 p-3 rounded" style="background: rgba(255,255,255,0.2);">
                            <h6 class="fw-bold mb-2">Info Terbaru</h6>
                            <p class="small opacity-75 mb-2">
                                Dapatkan update terbaru tentang sistem dan fitur baru.
                            </p>
                            <div class="input-group">
                                <input type="email" class="form-control form-control-sm" placeholder="Email Anda"
                                       style="border-radius: 8px 0 0 8px; border: none;">
                                <button class="btn btn-sm" type="button"
                                        style="background: #1E3A8A; color: white; border-radius: 0 8px 8px 0;">
                                    <i class="lni lni-envelope"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Contact & Resources (Warna Ungu) -->
            <div class="col-lg-4">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); color: white; border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="lni lni-support me-2"></i>Bantuan & Dukungan
                        </h5>

                        <!-- Contact Info -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Kontak Desa</h6>
                            <div class="d-flex align-items-start mb-3 p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                <i class="lni lni-map-marker mt-1 me-3" style="color: #c4b5fd;"></i>
                                <div>
                                    <small class="d-block opacity-75">Alamat</small>
                                    <span class="small">Jl. Pahlawan Kerja No. 91, Pekanbaru</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                <i class="lni lni-phone me-3" style="color: #c4b5fd;"></i>
                                <div>
                                    <small class="d-block opacity-75">Telepon</small>
                                    <span class="small">+62 812 3456 7890</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                <i class="lni lni-envelope me-3" style="color: #c4b5fd;"></i>
                                <div>
                                    <small class="d-block opacity-75">Email</small>
                                    <span class="small">info@suratku.id</span>
                                </div>
                            </div>
                        </div>

                        <!-- Resources -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Sumber Daya</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="#" class="badge text-decoration-none" style="background: rgba(255,255,255,0.2); color: white;">Panduan Pengguna</a>
                                <a href="#" class="badge text-decoration-none" style="background: rgba(255,255,255,0.2); color: white;">FAQ</a>
                                <a href="#" class="badge text-decoration-none" style="background: rgba(255,255,255,0.2); color: white;">Video Tutorial</a>
                                <a href="#" class="badge text-decoration-none" style="background: rgba(255,255,255,0.2); color: white;">Dokumentasi</a>
                            </div>
                        </div>

                        <!-- About Developer -->
                        <div class="mt-4 p-3 rounded" style="background: rgba(255,255,255,0.2);">
                            <h6 class="fw-bold mb-2">Tentang Pengembang</h6>
                            <p class="small opacity-75 mb-0">
                                Sistem ini dikembangkan oleh mahasiswa Sistem Informasi sebagai bagian dari pengabdian masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================= Footer Section start ========================= -->
<footer class="footer-section py-4" style="background: linear-gradient(135deg, #1E3A8A 0%, #2563eb 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo & Info -->
            <div class="col-lg-5 mb-3 mb-lg-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle p-2 me-3">
                        <i class="lni lni-code fs-4" style="color: #1E3A8A;"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-bold">Layanan Mandiri dan Surat</h5>
                        <p class="mb-0 small opacity-75">
                            Sistem Layanan Mandiri Desa Berbasis Digital
                        </p>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="col-lg-7 text-lg-end">
                <p class="mb-0 fw-bold">
                    <i class="lni lni-copyright me-1"></i>
                    {{ date('Y') }} Layanan Mandiri Suratku
                </p>
                <p class="mb-0 small opacity-75">
                    Semua Hak Dilindungi | Dibangun untuk kemajuan desa digital
                </p>
            </div>
        </div>

        <!-- Separator -->
        <div class="row mt-4">
            <div class="col-12">
                <hr style="border-color: rgba(255,255,255,0.2);">
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="row mt-3">
            <!-- Links -->
            <div class="col-lg-7 mb-3 mb-lg-0">
                <div class="d-flex flex-wrap gap-3">
                    <a href="#" class="text-white text-decoration-none small">
                        <i class="lni lni-shield me-1"></i>Kebijakan Privasi
                    </a>
                    <a href="#" class="text-white text-decoration-none small">
                        <i class="lni lni-files me-1"></i>Syarat & Ketentuan
                    </a>
                    <a href="#" class="text-white text-decoration-none small">
                        <i class="lni lni-map me-1"></i>Peta Situs
                    </a>
                    <a href="#" class="text-white text-decoration-none small">
                        <i class="lni lni-help me-1"></i>Bantuan
                    </a>
                </div>
            </div>

            <!-- Social Media -->
            <div class="col-lg-5">
                <div class="d-flex justify-content-lg-end gap-3">
                    <span class="small opacity-75">Ikuti Kami:</span>
                    <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" class="text-white text-decoration-none">
                        <i class="lni lni-facebook fs-5"></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" class="text-white text-decoration-none">
                        <i class="lni lni-twitter fs-5"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="text-white text-decoration-none">
                        <i class="lni lni-instagram fs-5"></i>
                    </a>
                    <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" class="text-white text-decoration-none">
                        <i class="lni lni-youtube fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6281363504725?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20Layanan%20Mandiri%20Suratku"
   class="whatsapp-float"
   target="_blank"
   rel="noopener noreferrer"
   title="Chat via WhatsApp">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png"
         alt="WhatsApp"
         width="55"
         height="55">
</a>

<style>
/* Dashboard Stats Styles */
.stats-overview {
    background: #f8fafc;
}

.stat-box {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    background: linear-gradient(135deg, rgba(30, 58, 138, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
}

.stat-icon.text-primary {
    background: linear-gradient(135deg, rgba(30, 58, 138, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
}

.stat-icon.text-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(52, 211, 153, 0.1) 100%);
}

.stat-icon.text-warning {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(251, 191, 36, 0.1) 100%);
}

.stat-icon.text-info {
    background: linear-gradient(135deg, rgba(6, 182, 212, 0.1) 0%, rgba(34, 211, 238, 0.1) 100%);
}

.stat-number {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #1e293b;
}

.stat-label {
    font-size: 0.9rem;
    color: #64748b;
    margin-bottom: 0;
}

/* Slideshow Styles */
.slideshow-section {
    position: relative;
    overflow: hidden;
}

.carousel-inner {
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}

.carousel-slide-content {
    min-height: 450px;
    display: flex;
    align-items: center;
}

.carousel-image img {
    max-height: 350px;
    width: auto;
    margin: 0 auto;
    display: block;
}

.carousel-text {
    padding: 20px 0;
}

/* Carousel Indicators */
.carousel-indicators {
    bottom: -50px;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #ddd;
    border: none;
    margin: 0 5px;
}

.carousel-indicators button.active {
    background-color: #1E3A8A;
}

/* Carousel Controls */
.carousel-control-prev,
.carousel-control-next {
    width: 50px;
    height: 50px;
    background-color: rgba(30, 58, 138, 0.8);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.8;
    transition: all 0.3s ease;
}

.carousel-control-prev {
    left: -25px;
}

.carousel-control-next {
    right: -25px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background-color: #1E3A8A;
    opacity: 1;
}

/* Timeline Styles */
.tracking-timeline {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
    position: relative;
}

.tracking-timeline::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 3px;
    background: #e5e7eb;
    z-index: 1;
}

.timeline-step {
    position: relative;
    z-index: 2;
    text-align: center;
}

.step-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #1E3A8A;
    color: white;
    border-radius: 50%;
    font-weight: bold;
    margin: 0 auto 10px;
    box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
}

.step-text {
    display: block;
    font-size: 14px;
    color: #4b5563;
    font-weight: 500;
}

/* Stats Styles */
.stats-container {
    border: 2px solid #e5e7eb;
}

.stat-item {
    padding: 15px 0;
}

.stat-item h3 {
    font-size: 2.5rem;
    margin-bottom: 5px;
}

.stat-item p {
    font-size: 0.9rem;
}

/* Feature Box */
.feature-box {
    border: 2px solid #e5e7eb;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.feature-box:hover {
    border-color: #1E3A8A;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

/* Card Hover Effects */
.card {
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* Badge Styling */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 500;
    transition: all 0.2s;
}

.badge:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

/* WhatsApp Button */
.whatsapp-float {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 999;
    transition: all 0.3s ease;
    filter: drop-shadow(0 5px 10px rgba(0,0,0,0.2));
}

.whatsapp-float:hover {
    transform: scale(1.1) rotate(5deg);
    filter: drop-shadow(0 8px 15px rgba(0,0,0,0.3));
}

/* Responsive */
@media (max-width: 768px) {
    .carousel-slide-content {
        padding: 30px 20px;
        min-height: auto;
    }

    .carousel-image img {
        max-height: 250px;
        margin-bottom: 20px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        display: none;
    }

    .tracking-timeline {
        flex-wrap: wrap;
        gap: 20px;
    }

    .timeline-step {
        flex: 0 0 calc(50% - 10px);
    }

    .card {
        margin-bottom: 20px;
    }

    .footer-section .text-lg-end {
        text-align: left !important;
        margin-top: 15px;
    }

    .whatsapp-float {
        width: 50px;
        height: 50px;
    }

    .stat-box {
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 1.8rem;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #1E3A8A 0%, #2563eb 100%);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #163070 0%, #1d4ed8 100%);
}

/* Auto Slide Animation */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.carousel-item.active .carousel-text {
    animation: slideIn 0.8s ease-out;
}

/* Image Styling */
.img-fluid.rounded {
    border-radius: 10px !important;
}
</style>

<script>
// Slideshow Auto Play Configuration
document.addEventListener('DOMContentLoaded', function() {
    const carousel = new bootstrap.Carousel(document.getElementById('desaCarousel'), {
        interval: 5000, // Change slide every 5 seconds
        wrap: true,
        pause: 'hover'
    });

    // Animate stat numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 50);
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                clearInterval(timer);
                stat.textContent = finalValue;
            } else {
                stat.textContent = currentValue;
            }
        }, 30);
    });

    // Add hover effect to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.25)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
        });
    });

    // Update Subscription Form
    const subscribeBtn = document.querySelector('.btn[type="button"]');
    const emailInput = document.querySelector('input[type="email"]');

    if (subscribeBtn && emailInput) {
        subscribeBtn.addEventListener('click', function() {
            if (emailInput.value && emailInput.value.includes('@')) {
                // Success animation
                this.innerHTML = '<i class="lni lni-checkmark"></i>';
                this.style.background = '#10b981';

                setTimeout(() => {
                    alert('🎉 Terima kasih! Update akan dikirim ke: ' + emailInput.value);
                    emailInput.value = '';
                    this.innerHTML = '<i class="lni lni-envelope"></i>';
                    this.style.background = '#1E3A8A';
                }, 300);
            } else {
                // Error animation
                emailInput.style.border = '2px solid #ef4444';
                setTimeout(() => {
                    emailInput.style.border = 'none';
                }, 1000);
                alert('⚠️ Masukkan email yang valid!');
            }
        });
    }
});
</script>
<!-- ========================= Identitas Pengembang & Footer Section end ========================= -->
@endsection
