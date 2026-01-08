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
                            @auth
                                Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}!
                            @else
                                Selamat Datang di Layanan Mandiri Suratku
                            @endauth
                        </h2>
                        <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">
                            Sistem layanan mandiri berbasis digital yang membantu masyarakat dalam pengurusan surat dan
                            administrasi desa secara cepat, mudah, dan transparan.
                        </p>

                        {{-- TOMBOL LIhat Layanan dengan conditional --}}
                        @auth
                            {{-- Jika sudah login --}}
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('layanan') }}"
                                   class="button button-lg radius-50 wow fadeInUp"
                                   data-wow-delay=".6s">
                                    Lihat Layanan <i class="lni lni-chevron-right"></i>
                                </a>
                                <a href="{{ route('permohonan_surat.create') }}"
                                   class="button button-lg radius-50 wow fadeInUp"
                                   data-wow-delay=".7s"
                                   style="background: #10b981; border-color: #10b981;">
                                    Ajukan Surat <i class="lni lni-plus"></i>
                                </a>
                            </div>
                        @else
                            {{-- Jika belum login, arahkan ke login dulu --}}
                            <a href="{{ route('auth.index') }}"
                               class="button button-lg radius-50 wow fadeInUp"
                               data-wow-delay=".6s">
                                Login / Daftar <i class="lni lni-user"></i>
                            </a>
                        @endauth
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
<section id="slideshow" class="slideshow-section py-6">
    <div class="container">
        <div class="row justify-content-center mb-6">
            <div class="col-lg-8 text-center">
                <div class="section-header">
                    <h2 class="fw-bold mb-3 display-5" data-wow-delay=".2s">
                        Galeri Pelayanan Suratku
                    </h2>
                    <p class="lead text-muted mb-0" data-wow-delay=".4s">
                        Layanan Mandiri Suratku membantu masyarakat dalam pengurusan administrasi secara digital
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Enhanced Carousel -->
                <div id="desaCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators custom-indicators">
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner rounded-4 shadow-lg overflow-hidden">
                        <!-- Slide 1 - Pelayanan Surat Online -->
                        <div class="carousel-item active">
                            <div class="carousel-slide-content slide-1">
                                <div class="row g-0 h-100">
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="carousel-text p-4 p-lg-5">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-rocket me-2"></i>Fitur Unggulan
                                                </span>
                                            </div>
                                            <h3 class="display-6 fw-bold mb-4 text-white">Pelayanan Surat Online</h3>
                                            <p class="text-white mb-4 opacity-90 fs-5">
                                                Permohonan surat keterangan, surat domisili, dan surat administrasi lainnya dapat dilakukan secara online tanpa harus datang ke kantor desa.
                                            </p>
                                            <div class="features-list">
                                                <div class="feature-item">
                                                    <div class="feature-icon">
                                                        <i class="lni lni-bolt-alt"></i>
                                                    </div>
                                                    <div class="feature-content">
                                                        <h6 class="fw-bold mb-1 text-white">Proses Lebih Cepat</h6>
                                                        <p class="mb-0 text-white opacity-75">Hemat waktu hingga 70%</p>
                                                    </div>
                                                </div>
                                                <div class="feature-item">
                                                    <div class="feature-icon">
                                                        <i class="lni lni-timer"></i>
                                                    </div>
                                                    <div class="feature-content">
                                                        <h6 class="fw-bold mb-1 text-white">Tanpa Antri</h6>
                                                        <p class="mb-0 text-white opacity-75">Layanan 24/7 dari rumah</p>
                                                    </div>
                                                </div>
                                                <div class="feature-item">
                                                    <div class="feature-icon">
                                                        <i class="lni lni-eye"></i>
                                                    </div>
                                                    <div class="feature-content">
                                                        <h6 class="fw-bold mb-1 text-white">Real-time Tracking</h6>
                                                        <p class="mb-0 text-white opacity-75">Pantau status setiap saat</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="carousel-image-container p-4 p-lg-5">
                                            <div class="image-wrapper position-relative">
                                                <img src="{{ asset('assets/img/logo/slide1.jpeg') }}"
                                                     alt="Pelayanan Digital"
                                                     class="img-fluid rounded-3 shadow-lg slide-image">
                                                <div class="floating-elements">
                                                    <div class="floating-element element-1">
                                                        <i class="lni lni-checkmark-circle"></i>
                                                    </div>
                                                    <div class="floating-element element-2">
                                                        <i class="lni lni-download"></i>
                                                    </div>
                                                    <div class="floating-element element-3">
                                                        <i class="lni lni-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 - Upload Berkas Digital -->
                        <div class="carousel-item">
                            <div class="carousel-slide-content slide-2">
                                <div class="row g-0 h-100">
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="carousel-image-container p-4 p-lg-5">
                                            <div class="image-wrapper position-relative">
                                                <img src="{{ asset('assets/img/logo/slide2.jpeg') }}"
                                                     alt="Upload Berkas"
                                                     class="img-fluid rounded-3 shadow-lg slide-image">
                                                <div class="upload-animation">
                                                    <div class="upload-circle">
                                                        <i class="lni lni-upload"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="carousel-text p-4 p-lg-5">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-cloud-upload me-2"></i>Upload Digital
                                                </span>
                                            </div>
                                            <h3 class="display-6 fw-bold mb-4 text-white">Upload Berkas Digital</h3>
                                            <p class="text-white mb-4 opacity-90 fs-5">
                                                Upload berkas persyaratan dengan mudah melalui sistem kami. Dukung berbagai format file dengan keamanan terjamin.
                                            </p>
                                            <div class="stats-grid mb-4">
                                                <div class="stat-card">
                                                    <div class="stat-icon">
                                                        <i class="lni lni-files"></i>
                                                    </div>
                                                    <div class="stat-content">
                                                        <h5 class="fw-bold mb-1 text-white">15+</h5>
                                                        <small class="text-white opacity-75">Format File</small>
                                                    </div>
                                                </div>
                                                <div class="stat-card">
                                                    <div class="stat-icon">
                                                        <i class="lni lni-protection"></i>
                                                    </div>
                                                    <div class="stat-content">
                                                        <h5 class="fw-bold mb-1 text-white">256-bit</h5>
                                                        <small class="text-white opacity-75">Enkripsi</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="progress-section">
                                                <div class="progress-label d-flex justify-content-between mb-2">
                                                    <span class="text-white opacity-75">Kapasitas Upload</span>
                                                    <span class="text-white opacity-75">50MB/file</span>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-white" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 - Tracking Permohonan -->
                        <div class="carousel-item">
                            <div class="carousel-slide-content slide-3">
                                <div class="row g-0 h-100">
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="carousel-text p-4 p-lg-5">
                                            <div class="slide-badge mb-4">
                                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                                    <i class="lni lni-map me-2"></i>Tracking Real-time
                                                </span>
                                            </div>
                                            <h3 class="display-6 fw-bold mb-4 text-white">Tracking Permohonan</h3>
                                            <p class="text-white mb-4 opacity-90 fs-5">
                                                Lacak perkembangan permohonan surat Anda dari awal pengajuan hingga selesai melalui dashboard yang interaktif.
                                            </p>
                                            <div class="timeline">
                                                <div class="timeline-step active">
                                                    <div class="step-icon">
                                                        <i class="lni lni-paperclip"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1 text-white">Pengajuan</h6>
                                                        <small class="text-white opacity-75">Permohonan diterima</small>
                                                    </div>
                                                </div>
                                                <div class="timeline-step active">
                                                    <div class="step-icon">
                                                        <i class="lni lni-checkmark-circle"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1 text-white">Verifikasi</h6>
                                                        <small class="text-white opacity-75">Data diverifikasi</small>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div class="step-icon">
                                                        <i class="lni lni-cogs"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1 text-white">Proses</h6>
                                                        <small class="text-white opacity-75">Sedang diproses</small>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div class="step-icon">
                                                        <i class="lni lni-checkmark"></i>
                                                    </div>
                                                    <div class="step-content">
                                                        <h6 class="fw-bold mb-1 text-white">Selesai</h6>
                                                        <small class="text-white opacity-75">Tunggu konfirmasi</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="carousel-image-container p-4 p-lg-5">
                                            <div class="image-wrapper position-relative">
                                                <img src="{{ asset('assets/img/logo/slide3.jpeg') }}"
                                                     alt="Tracking Permohonan"
                                                     class="img-fluid rounded-3 shadow-lg slide-image">
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


                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#desaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#desaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Section Styling */
    .slideshow-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 80px 0;
    }

    .mb-6 {
        margin-bottom: 4rem !important;
    }

    .section-header h2 {
        color: #2c3e50;
        position: relative;
        padding-bottom: 15px;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #4361ee, #3a0ca3);
        border-radius: 2px;
    }

    /* Carousel Styling */
    #desaCarousel {
        max-width: 1200px;
        margin: 0 auto;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        overflow: hidden;
    }

    .carousel-inner {
        height: 600px;
        background: #fff;
    }

    .carousel-slide-content {
        height: 100%;
        width: 100%;
    }

    /* Slide Backgrounds */
    .slide-1 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .slide-2 {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .slide-3 {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .slide-4 {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    /* Text Content */
    .carousel-text {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .carousel-text h3 {
        font-size: 2.5rem;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .carousel-text p {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Image Container */
    .carousel-image-container {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-wrapper {
        width: 100%;
        max-width: 500px;
        position: relative;
    }

    .slide-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .slide-image:hover {
        transform: scale(1.02);
    }

    /* Features List */
    .features-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .feature-content h6 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stat-card h4, .stat-card h5 {
        font-size: 1.75rem;
        margin-bottom: 0.25rem;
    }

    /* Timeline */
    .timeline {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .timeline-step {
        display: flex;
        align-items: center;
        gap: 1rem;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    .timeline-step.active {
        opacity: 1;
    }

    .step-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .step-content h6 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    /* Progress Bar */
    .progress-section {
        margin-top: 2rem;
    }

    .progress-label {
        font-size: 0.9rem;
    }

    .progress {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .progress-bar {
        border-radius: 3px;
    }

    /* Action Button */
    .action-btn {
        margin-top: 2rem;
    }

    .btn-light {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Floating Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .floating-element {
        position: absolute;
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .element-1 {
        top: 20px;
        left: 20px;
        color: #27ae60;
        animation-delay: 0s;
    }

    .element-2 {
        top: 20px;
        right: 20px;
        color: #4361ee;
        animation-delay: 2s;
    }

    .element-3 {
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: #f39c12;
        animation-delay: 4s;
    }

    /* Upload Animation */
    .upload-animation {
        position: absolute;
        top: -20px;
        right: -20px;
    }

    .upload-circle {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #f5576c;
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Tracking Animation */
    .tracking-animation {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
    }

    .tracking-dot {
        width: 12px;
        height: 12px;
        background: white;
        border-radius: 50%;
        animation: bounce 1.5s ease-in-out infinite;
    }

    .dot-1 { animation-delay: 0s; }
    .dot-2 { animation-delay: 0.2s; }
    .dot-3 { animation-delay: 0.4s; }

    /* Community Animation */
    .community-animation {
        position: absolute;
        top: -20px;
        left: -20px;
        display: flex;
        gap: 10px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: #38f9d7;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        animation: float 4s ease-in-out infinite;
    }

    .avatar-1 { animation-delay: 0s; }
    .avatar-2 { animation-delay: 1.3s; }
    .avatar-3 { animation-delay: 2.6s; }

    /* Carousel Controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        margin: 0 20px;
        opacity: 1;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-size: 60%;
        width: 30px;
        height: 30px;
    }

    /* Indicators */
    .carousel-indicators {
        bottom: -60px;
        margin-bottom: 0;
    }

    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #dee2e6;
        border: none;
        margin: 0 6px;
        transition: all 0.3s ease;
    }

    .carousel-indicators button.active {
        background-color: #4361ee;
        transform: scale(1.3);
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .carousel-inner {
            height: auto;
            min-height: 800px;
        }

        .carousel-text,
        .carousel-image-container {
            padding: 2rem;
        }

        .carousel-text h3 {
            font-size: 2rem;
        }

        .slide-image {
            height: 300px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .slideshow-section {
            padding: 60px 0;
        }

        .carousel-inner {
            min-height: 900px;
        }

        .row.g-0 > div {
            width: 100%;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            margin: 0 10px;
        }

        .carousel-indicators {
            bottom: -50px;
        }
    }

    @media (max-width: 576px) {
        .carousel-text h3 {
            font-size: 1.75rem;
        }

        .carousel-text p {
            font-size: 1rem;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('desaCarousel');
        const carouselInstance = new bootstrap.Carousel(carousel, {
            interval: 5000,
            wrap: true,
            pause: 'hover'
        });

        // Auto-play carousel
        carousel.addEventListener('mouseenter', () => {
            carouselInstance.pause();
        });

        carousel.addEventListener('mouseleave', () => {
            carouselInstance.cycle();
        });

        // Add smooth transitions between slides
        const slides = document.querySelectorAll('.carousel-item');
        slides.forEach(slide => {
            slide.addEventListener('slide.bs.carousel', function () {
                const activeSlide = this.querySelector('.carousel-item.active');
                if (activeSlide) {
                    activeSlide.classList.add('transitioning');
                    setTimeout(() => {
                        activeSlide.classList.remove('transitioning');
                    }, 600);
                }
            });
        });
    });
</script>
<!-- ========================= Slideshow Carousel Section end ========================= -->

   <!-- ========================= Identitas Pengembang & Footer Section start ========================= -->
<section id="pengembang" class="contact-section contact-style-5 pt-80 pb-50" style="background: linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 100%);">
    <div class="container">
        <!-- Header Section dengan warna -->
        <div class="row justify-content-center mb-50">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3" style="color: #1E3A8A;">
                    Pengembang Sistem
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
