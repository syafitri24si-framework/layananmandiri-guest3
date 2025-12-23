@extends('layouts.guest.app')

@section('content')
    <!-- ========================= Tentang Section start ========================= -->
    <section id="about" class="about-section about-style-4" style="padding-top: 120px; padding-bottom: 80px;">
        <div class="container">
            <!-- Header Section - DIUBAH MENJADI LEBIH MENARIK -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 text-center">
                    <div class="hero-badge mb-4">
                        <span class="badge bg-primary-bg text-primary px-4 py-2 rounded-pill">
                            <i class="lni lni-rocket me-2"></i>Tentang Kami
                        </span>
                    </div>
                    <h1 class="display-5 fw-bold mb-4">
                        <span class="text-primary">Tentang</span>
                        <span class="text-gradient-primary">Suratku</span>
                    </h1>
                    <p class="lead text-muted mb-4 px-lg-5">
                        Platform digital inovatif yang mengubah pelayanan administratif desa menjadi lebih cepat, mudah,
                        dan transparan
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                        <span class="badge bg-primary-bg text-primary px-3 py-2 rounded-pill">
                            <i class="lni lni-bolt-alt me-1"></i>Digitalisasi Desa
                        </span>
                        <span class="badge bg-success-bg text-success px-3 py-2 rounded-pill">
                            <i class="lni lni-checkmark-circle me-1"></i>Pelayanan Online
                        </span>
                        <span class="badge bg-warning-bg text-warning px-3 py-2 rounded-pill">
                            <i class="lni lni-timer me-1"></i>Proses Cepat
                        </span>
                        <span class="badge bg-info-bg text-info px-3 py-2 rounded-pill">
                            <i class="lni lni-eye me-1"></i>Transparan
                        </span>
                    </div>
                </div>
            </div>

            <!-- Vision & Mission -->
            <div class="row mb-6">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="vision-card card border-0 h-100 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="vision-icon mb-4">
                                <i class="lni lni-target fs-1 text-primary"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Visi</h4>
                            <p class="mb-0">
                                Menjadi platform digital terdepan dalam pelayanan administratif desa yang efisien,
                                transparan, dan mudah diakses oleh seluruh masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="mission-card card border-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">
                                <i class="lni lni-bullhorn me-2 text-primary"></i>Misi
                            </h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="lni lni-checkmark-circle text-success mt-1 me-2"></i>
                                            <span>Menyediakan layanan administrasi desa berbasis digital 24/7</span>
                                        </li>
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="lni lni-checkmark-circle text-success mt-1 me-2"></i>
                                            <span>Mempermudah akses masyarakat terhadap layanan publik</span>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="lni lni-checkmark-circle text-success mt-1 me-2"></i>
                                            <span>Meningkatkan transparansi dan akuntabilitas pelayanan</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="lni lni-checkmark-circle text-success mt-1 me-2"></i>
                                            <span>Mengurangi waktu dan biaya pelayanan administrasi</span>
                                        </li>
                                        <li class="mb-3 d-flex align-items-start">
                                            <i class="lni lni-checkmark-circle text-success mt-1 me-2"></i>
                                            <span>Membangun sistem terintegrasi untuk pengelolaan data warga</span>
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="lni lni-checkmark-circle text-success mt-1 me-2"></i>
                                            <span>Mendorong transformasi digital pemerintahan desa</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row align-items-center mb-6">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title mb-30">
                            <h3 class="fw-bold mb-4">
                                Apa itu <span class="text-primary">Layanan Mandiri Suratku</span>?
                            </h3>
                            <p>
                                <strong>Layanan Mandiri Suratku</strong> adalah platform digital inovatif yang dirancang
                                khusus untuk memodernisasi pelayanan administratif di tingkat desa. Sistem ini merupakan
                                jawaban atas tantangan pelayanan konvensional yang seringkali memakan waktu, birokratis, dan
                                kurang transparan.
                            </p>
                            <p>
                                Dengan mengadopsi teknologi terkini, kami menyediakan solusi lengkap untuk berbagai
                                kebutuhan administrasi masyarakat, mulai dari pembuatan surat keterangan, surat domisili,
                                hingga layanan kependudukan lainnya. Semua dapat diakses kapan saja dan dari mana saja
                                melalui perangkat digital.
                            </p>
                        </div>

                        <div class="features-grid mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="feature-card p-3 rounded-3">
                                        <i class="lni lni-bolt-alt fs-3 mb-3 text-primary"></i>
                                        <h6 class="fw-bold">Proses Instan</h6>
                                        <p class="small mb-0">Waktu pemrosesan surat berkurang hingga 70%</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card p-3 rounded-3">
                                        <i class="lni lni-lock-alt fs-3 mb-3 text-success"></i>
                                        <h6 class="fw-bold">Data Aman</h6>
                                        <p class="small mb-0">Enkripsi 256-bit untuk keamanan data warga</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card p-3 rounded-3">
                                        <i class="lni lni-eye fs-3 mb-3 text-info"></i>
                                        <h6 class="fw-bold">Transparansi</h6>
                                        <p class="small mb-0">Pantau status permohonan secara real-time</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card p-3 rounded-3">
                                        <i class="lni lni-support fs-3 mb-3 text-warning"></i>
                                        <h6 class="fw-bold">Support 24/7</h6>
                                        <p class="small mb-0">Tim support siap membantu kapan saja</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="about-image">
                        <div class="position-relative">
                            <img src="{{ asset('assets/assets-admin/img/about/about-4/about-img.svg') }}"
                                alt="Layanan Digital" class="img-fluid rounded-3 shadow-lg">
                            <div class="position-absolute top-0 start-0 mt-4 ms-4">
                                <div class="bg-primary text-white px-3 py-2 rounded-pill">
                                    <i class="lni lni-star-fill me-1"></i>Terpercaya
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="row mb-6">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">
                            <h3 class="fw-bold text-center mb-5">
                                <i class="lni lni-benefits me-2 text-primary"></i>Manfaat Layanan Mandiri Suratku
                            </h3>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="benefit-item text-center p-3">
                                        <div class="benefit-icon mb-3">
                                            <i class="lni lni-users fs-1 text-primary"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Untuk Masyarakat</h5>
                                        <ul class="list-unstyled text-start">
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Tidak perlu antri panjang
                                            </li>
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Hemat waktu dan biaya transport
                                            </li>
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Layanan 24/7 dari rumah
                                            </li>
                                            <li>
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Transparansi proses
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="benefit-item text-center p-3">
                                        <div class="benefit-icon mb-3">
                                            <i class="lni lni-briefcase fs-1 text-success"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Untuk Pemerintah Desa</h5>
                                        <ul class="list-unstyled text-start">
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Efisiensi administrasi
                                            </li>
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Database terintegrasi
                                            </li>
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Pengarsipan digital
                                            </li>
                                            <li>
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Laporan real-time
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="benefit-item text-center p-3">
                                        <div class="benefit-icon mb-3">
                                            <i class="lni lni-stats-up fs-1 text-warning"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Untuk Desa</h5>
                                        <ul class="list-unstyled text-start">
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Modernisasi pelayanan
                                            </li>
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Image positif desa digital
                                            </li>
                                            <li class="mb-2">
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Efektivitas pelayanan
                                            </li>
                                            <li>
                                                <i class="lni lni-checkmark-circle text-success me-2"></i>
                                                Kepuasan warga meningkat
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technology Stack -->
            <div class="row mb-6">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">
                            <h3 class="fw-bold text-center mb-5">
                                Teknologi yang Digunakan
                            </h3>
                            <div class="row g-4 text-center">
                                <div class="col-md-3 col-6">
                                    <div class="tech-item p-3">
                                        <div class="tech-icon mb-3">
                                            <i class="lni lni-laravel fs-1 text-danger"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Laravel</h6>
                                        <p class="small mb-0 text-muted">Framework Backend</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="tech-item p-3">
                                        <div class="tech-icon mb-3">
                                            <i class="lni lni-bootstrap fs-1 text-purple"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Bootstrap 5</h6>
                                        <p class="small mb-0 text-muted">Frontend Framework</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="tech-item p-3">
                                        <div class="tech-icon mb-3">
                                            <i class="lni lni-database fs-1 text-primary"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">MySQL</h6>
                                        <p class="small mb-0 text-muted">Database</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="tech-item p-3">
                                        <div class="tech-icon mb-3">
                                            <!-- Ikon untuk AlwaysData -->
                                            <div class="alwaysdata-icon d-inline-block">
                                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#00A1E0" />
                                                    <path d="M2 17L12 22L22 17" stroke="#00A1E0" stroke-width="2" />
                                                    <path d="M2 12L12 17L22 12" stroke="#00A1E0" stroke-width="2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <h6 class="fw-bold mb-1">AlwaysData</h6>
                                        <p class="small mb-0 text-muted">Cloud Hosting</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Tentang Section end ========================= -->

    <style>
        /* Halaman About - DIUBAH WARNA MENJADI SENADA DENGAN LAYANAN & CONTACT */

        /* Background Gradient - SAMA DENGAN LAYANAN & CONTACT */
        .about-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }

        /* Hero Header - SAMA DENGAN LAYANAN & CONTACT */
        .hero-badge {
            margin-top: 20px;
        }

        h1.display-5 {
            color: #1E3A8A;
            font-weight: 800;
            line-height: 1.3;
        }

        .text-primary {
            color: #1E3A8A !important;
        }

        .text-gradient-primary {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            display: inline-block;
        }

        /* Badge Colors - SAMA DENGAN LAYANAN & CONTACT */
        .bg-primary-bg {
            background-color: rgba(30, 58, 138, 0.1) !important;
        }

        .bg-success-bg {
            background-color: rgba(16, 185, 129, 0.1) !important;
        }

        .bg-warning-bg {
            background-color: rgba(245, 158, 11, 0.1) !important;
        }

        .bg-info-bg {
            background-color: rgba(59, 130, 246, 0.1) !important;
        }

        /* Text Colors - SAMA DENGAN LAYANAN & CONTACT */
        .text-success {
            color: #059669 !important;
        }

        .text-warning {
            color: #D97706 !important;
        }

        .text-info {
            color: #3B82F6 !important;
        }

        .text-danger {
            color: #DC2626 !important;
        }

        .text-purple {
            color: #7C3AED !important;
        }

        /* Vision & Mission Cards - WARNA DIUBAH */
        .vision-card {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05) 0%, rgba(30, 58, 138, 0.02) 100%);
            border-left: 4px solid #1E3A8A !important;
        }

        .mission-card {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(16, 185, 129, 0.02) 100%);
            border-left: 4px solid #059669 !important;
        }

        .vision-icon,
        .benefit-icon,
        .tech-icon {
            background: rgba(30, 58, 138, 0.1);
        }

        /* Feature Cards - WARNA DIUBAH */
        .feature-card {
            background: white;
            border: 1px solid rgba(30, 58, 138, 0.1);
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: #1E3A8A;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1);
            transform: translateY(-5px);
        }

        /* Benefit Items - WARNA DIUBAH */
        .benefit-item {
            background: rgba(249, 250, 251, 0.8);
            border: 1px solid rgba(30, 58, 138, 0.1);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            background: white;
            border-color: #1E3A8A;
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.08);
            transform: translateY(-5px);
        }

        /* Technology Items - WARNA DIUBAH */
        .tech-item {
            background: rgba(249, 250, 251, 0.8);
            border: 1px solid rgba(30, 58, 138, 0.1);
            transition: all 0.3s ease;
        }

        .tech-item:hover {
            background: white;
            border-color: #1E3A8A;
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.08);
            transform: translateY(-5px);
        }

        /* Warna untuk Technology Icons */
        .tech-item .lni-laravel {
            color: #F9322C !important;
        }

        .tech-item .lni-bootstrap {
            color: #7952B3 !important;
        }

        .tech-item .lni-database {
            color: #00758F !important;
        }

        /* Warna untuk Checkmark - SAMA DENGAN LAYANAN */
        .text-success i,
        .list-unstyled i.lni-checkmark-circle {
            color: #059669 !important;
        }

        /* Border radius untuk konsistensi - SAMA DENGAN LAYANAN */
        .card,
        .feature-card,
        .benefit-item,
        .tech-item {
            border-radius: 12px !important;
        }

        /* Shadow yang lebih soft - SAMA DENGAN LAYANAN */
        .shadow-sm {
            box-shadow: 0 4px 20px rgba(30, 58, 138, 0.05) !important;
        }

        .card {
            box-shadow: 0 4px 20px rgba(30, 58, 138, 0.05) !important;
        }

        /* Tag pada image */
        .bg-primary.text-white {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%) !important;
        }

        /* Responsive Design - TETAP SAMA */
        @media (max-width: 768px) {
            .about-section {
                padding-top: 100px !important;
                padding-bottom: 40px !important;
            }

            .vision-icon,
            .benefit-icon,
            .tech-icon {
                width: 60px;
                height: 60px;
            }
        }

        /* Animations - SAMA DENGAN LAYANAN */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .vision-card,
        .mission-card,
        .feature-card,
        .benefit-item,
        .tech-item {
            animation: fadeIn 0.6s ease-out;
        }

        /* Smooth transitions */
        .feature-card,
        .benefit-item,
        .tech-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adjust header spacing - SAMA DENGAN LAYANAN & CONTACT
            function adjustContentPadding() {
                const header = document.querySelector('header');
                const aboutSection = document.querySelector('.about-section');

                if (header && aboutSection) {
                    const headerHeight = header.offsetHeight;
                    const newPaddingTop = headerHeight + 40;
                    aboutSection.style.paddingTop = newPaddingTop + 'px';
                    document.documentElement.style.scrollPaddingTop = (headerHeight + 20) + 'px';
                }
            }

            // Adjust on load and resize
            adjustContentPadding();
            window.addEventListener('resize', adjustContentPadding);
            window.addEventListener('load', adjustContentPadding);

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && href.startsWith('#') && document.querySelector(href)) {
                        e.preventDefault();
                        const targetElement = document.querySelector(href);
                        const headerHeight = document.querySelector('header')?.offsetHeight || 80;
                        const targetPosition = targetElement.offsetTop - headerHeight - 20;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection
