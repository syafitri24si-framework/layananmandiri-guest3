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
                    <h3 class="fw-bold mb-3" data-wow-delay=".2s">Pelayanan Desa Digital</h3>
                    <p class="text-muted" data-wow-delay=".4s">
                        Lihat bagaimana Layanan Mandiri Suratku membantu masyarakat dalam pengurusan administrasi
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <!-- Carousel -->
                    <div id="desaCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#desaCarousel" data-bs-slide-to="3"></button>
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner rounded-4">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <div class="carousel-slide-content bg-white p-4 p-md-5 rounded-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="carousel-image">
                                                <img src="{{ asset('assets/img/logo/slide1.jpeg') }}"
                                                     alt="Pelayanan Digital"
                                                     class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="carousel-text ps-md-4">
                                                <h4 class="fw-bold mb-3 text-primary">Pelayanan Surat Online</h4>
                                                <p class="mb-4">
                                                    Permohonan surat keterangan, surat domisili, dan surat administrasi lainnya dapat dilakukan secara online tanpa harus datang ke kantor desa.
                                                </p>
                                                <ul class="list-unstyled">
                                                    <li class="mb-2">
                                                        <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                        Proses lebih cepat dan efisien
                                                    </li>
                                                    <li class="mb-2">
                                                        <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                        Tidak perlu antri panjang
                                                    </li>
                                                    <li class="mb-2">
                                                        <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                        Pantau status secara real-time
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="carousel-slide-content bg-white p-4 p-md-5 rounded-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="carousel-image">
                                                <img src="{{ asset('assets/img/logo/slide2.jpeg') }}"
                                                     alt="Upload Berkas"
                                                     class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="carousel-text ps-md-4">
                                                <h4 class="fw-bold mb-3 text-primary">Upload Berkas Digital</h4>
                                                <p class="mb-4">
                                                    Upload berkas persyaratan dengan mudah melalui sistem kami. Dukung berbagai format file dan ukuran yang optimal.
                                                </p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="feature-box text-center p-3">
                                                            <i class="lni lni-cloud-upload fs-1 text-primary mb-2"></i>
                                                            <h6 class="fw-bold">Multi Upload</h6>
                                                            <small>Upload beberapa file sekaligus</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="feature-box text-center p-3">
                                                            <i class="lni lni-protection fs-1 text-success mb-2"></i>
                                                            <h6 class="fw-bold">Aman & Terenkripsi</h6>
                                                            <small>Data tersimpan dengan aman</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <div class="carousel-slide-content bg-white p-4 p-md-5 rounded-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="carousel-image">
                                                <img src="{{ asset('assets/img/logo/slide3.jpeg') }}"
                                                     alt="Tracking Permohonan"
                                                     class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="carousel-text ps-md-4">
                                                <h4 class="fw-bold mb-3 text-primary">Tracking Permohonan</h4>
                                                <p class="mb-4">
                                                    Lacak perkembangan permohonan surat Anda dari awal pengajuan hingga selesai melalui dashboard yang mudah dipahami.
                                                </p>
                                                <div class="tracking-timeline">
                                                    <div class="timeline-step">
                                                        <span class="step-number">1</span>
                                                        <span class="step-text">Pengajuan</span>
                                                    </div>
                                                    <div class="timeline-step">
                                                        <span class="step-number">2</span>
                                                        <span class="step-text">Verifikasi</span>
                                                    </div>
                                                    <div class="timeline-step">
                                                        <span class="step-number">3</span>
                                                        <span class="step-text">Proses</span>
                                                    </div>
                                                    <div class="timeline-step">
                                                        <span class="step-number">4</span>
                                                        <span class="step-text">Selesai</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 4 -->
                            <div class="carousel-item">
                                <div class="carousel-slide-content bg-white p-4 p-md-5 rounded-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="carousel-image">
                                                <img src="{{ asset('assets/img/logo/slide4.jpeg') }}"
                                                     alt="Komunitas Desa"
                                                     class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="carousel-text ps-md-4">
                                                <h4 class="fw-bold mb-3 text-primary">Komunitas Digital Desa</h4>
                                                <p class="mb-4">
                                                    Bergabung dengan komunitas digital desa untuk mendapatkan informasi terbaru, tips, dan bantuan dalam penggunaan sistem.
                                                </p>
                                                <div class="d-flex gap-3">
                                                    <div class="stat-box text-center p-3 rounded-3 bg-primary text-white">
                                                        <h4 class="fw-bold mb-0">500+</h4>
                                                        <small>Pengguna Aktif</small>
                                                    </div>
                                                    <div class="stat-box text-center p-3 rounded-3 bg-success text-white">
                                                        <h4 class="fw-bold mb-0">1,200+</h4>
                                                        <small>Surat Diproses</small>
                                                    </div>
                                                    <div class="stat-box text-center p-3 rounded-3 bg-warning text-white">
                                                        <h4 class="fw-bold mb-0">98%</h4>
                                                        <small>Kepuasan</small>
                                                    </div>
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

            <!-- Stats Section -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="stats-container p-4 bg-white rounded-4 shadow-sm">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <h3 class="text-primary fw-bold">24/7</h3>
                                    <p class="text-muted mb-0">Layanan Online</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <h3 class="text-primary fw-bold">15+</h3>
                                    <p class="text-muted mb-0">Jenis Surat</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <h3 class="text-primary fw-bold">50%</h3>
                                    <p class="text-muted mb-0">Waktu Lebih Cepat</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <h3 class="text-primary fw-bold">100%</h3>
                                    <p class="text-muted mb-0">Transparansi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Slideshow Carousel Section end ========================= -->

    <!-- ========================= About Section start ========================= -->
    <section id="pricing" class="pricing-section pricing-style-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6"></div>
                <div class="col-xl-7 col-lg-6">
                    <div class="pricing-active-wrapper wow fadeInUp" data-wow-delay=".4s">
                        <div class="pricing-active">
                            <div class="single-pricing-wrapper"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= About Section end ========================= -->

    <!-- ========================= Tentang Section start ========================= -->
    <section id="about" class="about-section about-style-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title mb-30">
                            <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                                Tentang Layanan Mandiri Suratku
                            </h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                <strong>Layanan Mandiri Suratku</strong> adalah sistem digital yang dirancang untuk
                                memudahkan masyarakat dalam mengakses berbagai pelayanan administratif desa, seperti
                                pembuatan surat keterangan, surat domisili, dan layanan kependudukan lainnya secara online.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay=".35s">
                                Melalui platform ini, warga dapat melakukan pengajuan dokumen tanpa harus datang langsung ke
                                kantor desa, cukup dengan beberapa klik dari perangkat Anda.
                            </p>
                        </div>

                        <ul>
                            <li class="wow fadeInUp" data-wow-delay=".4s">
                                <i class="lni lni-checkmark-circle"></i>
                                Proses pembuatan surat lebih cepat dan efisien.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".45s">
                                <i class="lni lni-checkmark-circle"></i>
                                Data warga tersimpan secara aman dan terintegrasi.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".5s">
                                <i class="lni lni-checkmark-circle"></i>
                                Pelayanan terbuka, transparan, dan mudah digunakan oleh semua kalangan.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".55s">
                                <i class="lni lni-checkmark-circle"></i>
                                Upload multiple file untuk berkas pendukung dengan mudah.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".6s">
                                <i class="lni lni-checkmark-circle"></i>
                                Lacak riwayat status permohonan secara real-time.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-6">
                    <div class="about-image text-lg-right wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('assets/assets-admin/img/about/about-4/about-img.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Tentang Section end ========================= -->

<!-- ========================= Layanan Section start ========================= -->
<section id="layanan" class="feature-section feature-style-5 bg-light pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-8">
                <div class="section-title text-center mb-60">
                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Layanan Suratku</h3>
                    <p class="wow fadeInUp" data-wow-delay=".4s">
                        Pilih layanan yang tersedia untuk kebutuhan administrasi Anda.
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Jenis Surat -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('jenis_surat.index') }}" class="text-decoration-none text-dark">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".2s">
                        <div class="icon mb-3">
                            <i class="lni lni-envelope" style="color: #1E3A8A;"></i>
                        </div>
                        <h5>Jenis Surat</h5>
                        <p>Kelola berbagai jenis surat dan dokumen resmi yang dikeluarkan oleh desa.</p>
                        <!-- Tambahkan placeholder untuk alignment -->
                        <div class="placeholder" style="height: 24px;"></div>
                    </div>
                </a>
            </div>

            <!-- User -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('user.index') }}" class="text-decoration-none text-dark">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".4s">
                        <div class="icon mb-3">
                            <i class="lni lni-user" style="color: #10b981;"></i>
                        </div>
                        <h5>User</h5>
                        <p>Data akun pengguna yang memiliki akses ke sistem layanan mandiri.</p>
                        <div class="placeholder" style="height: 24px;"></div>
                    </div>
                </a>
            </div>

            <!-- Permohonan Surat -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('permohonan_surat.index') }}" class="text-decoration-none text-dark">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".8s">
                        <div class="icon mb-3">
                            <i class="lni lni-clipboard" style="color: #8b5cf6;"></i>
                        </div>
                        <h5>Permohonan Surat</h5>
                        <p>Kelola pengajuan surat dari warga, mulai dari pengajuan hingga status selesai.</p>
                        <div class="placeholder" style="height: 24px;"></div>
                    </div>
                </a>
            </div>

            <!-- Warga -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('warga.index') }}" class="text-decoration-none text-dark">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".6s">
                        <div class="icon mb-3">
                            <i class="lni lni-users" style="color: #f59e0b;"></i>
                        </div>
                        <h5>Warga</h5>
                        <p>Informasi lengkap warga desa untuk mendukung pelayanan digital yang terintegrasi.</p>
                        <div class="placeholder" style="height: 24px;"></div>
                    </div>
                </a>
            </div>

            <!-- Berkas Persyaratan -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('berkas_persyaratan.index') }}" class="text-decoration-none text-dark">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay="1.0s">
                        <div class="icon mb-3">
                            <i class="lni lni-folder" style="color: #ef4444;"></i>
                        </div>
                        <h5>Berkas Persyaratan</h5>
                        <p>Kelola dokumen dan berkas pendukung untuk setiap permohonan surat.</p>
                        <small class="text-muted d-block mt-2">
                            <i class="lni lni-upload" style="color: #ef4444;"></i> Upload multiple file
                        </small>
                    </div>
                </a>
            </div>

            <!-- Riwayat Status -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('riwayat_status.index') }}" class="text-decoration-none text-dark">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay="1.2s">
                        <div class="icon mb-3">
                            <i class="lni lni-timer" style="color: #06b6d4;"></i>
                        </div>
                        <h5>Riwayat Status</h5>
                        <p>Lacak perkembangan dan riwayat status setiap permohonan surat.</p>
                        <small class="text-muted d-block mt-2">
                            <i class="lni lni-timer" style="color: #06b6d4;"></i> Real-time tracking
                        </small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
    <!-- ========================= Layanan Section end ========================= -->

    <!-- ========================= Fitur Upload Section start ========================= -->
    <section id="fitur-upload" class="feature-section feature-style-3 pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-8">
                    <div class="section-title text-center mb-60">
                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Fitur Unggulan</h3>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Sistem upload file multiple untuk mendukung administrasi digital desa.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Upload Multiple File -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".2s">
                        <div class="icon mb-3">
                            <i class="lni lni-cloud-upload"></i>
                        </div>
                        <h5>Upload Multiple File</h5>
                        <p>Upload beberapa file sekaligus untuk kelengkapan berkas persyaratan.</p>
                        <div class="feature-list mt-3">
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> JPG, PNG, PDF, DOC</small><br>
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Max 5MB per file</small><br>
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Organize by category</small>
                        </div>
                    </div>
                </div>

                <!-- Media Management -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".4s">
                        <div class="icon mb-3">
                            <i class="lni lni-database"></i>
                        </div>
                        <h5>Sistem Media Terpusat</h5>
                        <p>Semua file tersimpan dalam satu database dengan pengelolaan yang mudah.</p>
                        <div class="feature-list mt-3">
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Tabel media terintegrasi</small><br>
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Kategorisasi otomatis</small><br>
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Pencarian cepat</small>
                        </div>
                    </div>
                </div>

                <!-- Status Tracking -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".6s">
                        <div class="icon mb-3">
                            <i class="lni lni-map"></i>
                        </div>
                        <h5>Pelacakan Riwayat</h5>
                        <p>Monitor setiap perubahan status dengan timeline yang jelas dan detail.</p>
                        <div class="feature-list mt-3">
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Timeline visual</small><br>
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> File pendukung status</small><br>
                            <small><i class="lni lni-checkmark-circle text-success me-1"></i> Notifikasi real-time</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-lg-8 text-center">
                    <div class="alert alert-info wow fadeInUp" data-wow-delay=".8s">
                        <h6><i class="lni lni-information me-2"></i> Cara Menggunakan Fitur Upload:</h6>
                        <ol class="text-start mt-3" style="display: inline-block;">
                            <li>Masuk ke menu <strong>Berkas Persyaratan</strong> atau <strong>Riwayat Status</strong></li>
                            <li>Klik tombol <strong>"Upload File"</strong> atau <strong>"Tambah Berkas"</strong></li>
                            <li>Pilih file yang ingin diupload (bisa multiple)</li>
                            <li>Tambahkan keterangan jika diperlukan</li>
                            <li>File akan otomatis tersimpan dan terorganisir</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Fitur Upload Section end ========================= -->

   <!-- ========================= Identitas Pengembang & Footer Section start ========================= -->
<section id="pengembang" class="contact-section contact-style-5 pt-80 pb-50" style="background: linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 100%);">
    <div class="container">
        <!-- Header Section dengan warna -->
        <div class="row justify-content-center mb-50">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3" style="color: #1E3A8A;">
                    <i class="lni lni-code me-2"></i>Layanan Mandiri dan Surat
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
                                <a href="#layanan" class="text-decoration-none text-white mb-2">
                                    <i class="lni lni-arrow-right me-2"></i>Lihat Layanan
                                </a>
                                <a href="#about" class="text-decoration-none text-white mb-2">
                                    <i class="lni lni-arrow-right me-2"></i>Tentang Sistem
                                </a>
                                <a href="#fitur-upload" class="text-decoration-none text-white mb-2">
                                    <i class="lni lni-arrow-right me-2"></i>Fitur Unggulan
                                </a>
                                <a href="{{ route('jenis_surat.index') }}" class="text-decoration-none text-white">
                                    <i class="lni lni-arrow-right me-2"></i>Jenis Surat
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
/* Global Styles */
body {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
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

/* Form Input Styling */
.form-control {
    border: none;
    padding: 10px 15px;
}

.form-control:focus {
    box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
}

/* Button Styling */
.btn {
    transition: all 0.3s ease;
    padding: 8px 16px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Social Icons Hover */
.btn-sm:hover {
    opacity: 0.9;
    transform: scale(1.1);
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

/* Footer Links */
.footer-section a {
    transition: all 0.3s ease;
    opacity: 0.9;
}

.footer-section a:hover {
    opacity: 1;
    transform: translateY(-2px);
    text-decoration: none !important;
}

.footer-section i {
    transition: all 0.3s ease;
}

.footer-section a:hover i {
    transform: scale(1.2);
}

/* Background Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.5s ease-out;
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

/* Email Link */
a[href^="mailto:"] {
    text-decoration: none;
}

a[href^="mailto:"]:hover {
    text-decoration: none;
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

    // Add click handler for indicators
    const indicators = document.querySelectorAll('.carousel-indicators button');
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            carousel.to(index);
        });
    });

    // Add animation to slides
    const carouselItems = document.querySelectorAll('.carousel-item');
    carouselItems.forEach(item => {
        item.addEventListener('slid.bs.carousel', function() {
            const activeItem = document.querySelector('.carousel-item.active');
            const textElements = activeItem.querySelectorAll('.carousel-text, .carousel-image');

            textElements.forEach((el, index) => {
                el.style.animation = 'none';
                setTimeout(() => {
                    el.style.animation = 'slideIn 0.8s ease-out';
                }, 50);
            });
        });
    });

    // Interactive Elements
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

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Animate stats on scroll
    const statNumbers = document.querySelectorAll('.stat-item h3');
    const observerOptions = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stat = entry.target;
                const finalValue = stat.textContent;
                const startValue = 0;
                const duration = 2000;
                const increment = finalValue.replace(/[^0-9]/g, '') / (duration / 50);

                let currentValue = startValue;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        clearInterval(timer);
                        stat.textContent = finalValue;
                    } else {
                        stat.textContent = Math.floor(currentValue);
                    }
                }, 50);

                observer.unobserve(stat);
            }
        });
    }, observerOptions);

    statNumbers.forEach(stat => observer.observe(stat));

    // Social media link confirmation
    const socialLinks = document.querySelectorAll('.card .btn-sm[target="_blank"]');
    socialLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            console.log('Membuka link:', this.href);
        });
    });
});
</script>
<!-- ========================= Identitas Pengembang & Footer Section end ========================= -->
@endsection
