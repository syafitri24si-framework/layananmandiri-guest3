@extends('layouts.guest.app')

@section('content')
<!-- ========================= Layanan Section start ========================= -->
<section id="layanan" class="layanan-section py-5">
    <div class="container">
        <!-- Hero Header -->
        <div class="row justify-content-center mb-5 pt-4">
            <div class="col-lg-10 text-center">
                <div class="hero-badge mb-4">
                    <span class="badge bg-primary-subtle text-primary px-4 py-2 rounded-pill">
                        <i class="lni lni-rocket me-2"></i>Layanan Digital Desa
                    </span>
                </div>
                <h1 class="display-5 fw-bold mb-4 text-gradient-primary">
                    Layanan Administrasi Digital Desa
                </h1>
                <p class="lead text-muted mb-4 px-lg-5">
                    Akses semua layanan administrasi desa secara online dengan mudah dan cepat
                </p>
            </div>
        </div>

        <!-- 6 Services Grid -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="services-grid">
                    <!-- Jenis Surat -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="lni lni-files"></i>
                        </div>
                        <div class="service-content">
                            <h3>Jenis Surat</h3>
                            <p>Akses berbagai jenis surat resmi desa dengan template terstandarisasi</p>
                            <ul class="service-features">
                                <li>15+ template surat</li>
                                <li>Format digital</li>
                                <li>Download langsung</li>
                            </ul>
                            <a href="{{ route('jenis_surat.index') }}" class="service-btn">
                                <span>Buka Layanan</span>
                                <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>
                        <div class="service-decoration"></div>
                    </div>

                    <!-- Permohonan Surat -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="lni lni-clipboard"></i>
                        </div>
                        <div class="service-content">
                            <h3>Permohonan Surat</h3>
                            <p>Ajukan permohonan surat online dengan tracking real-time</p>
                            <ul class="service-features">
                                <li>Pengajuan online</li>
                                <li>Notifikasi real-time</li>
                                <li>Status tracking</li>
                            </ul>
                            <a href="{{ route('permohonan_surat.index') }}" class="service-btn">
                                <span>Ajukan Sekarang</span>
                                <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>
                        <div class="service-decoration"></div>
                    </div>

                    <!-- Data Warga -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="lni lni-users"></i>
                        </div>
                        <div class="service-content">
                            <h3>Data Warga</h3>
                            <p>Database terintegrasi warga desa untuk layanan administrasi</p>
                            <ul class="service-features">
                                <li>Data terpadu</li>
                                <li>Pencarian cepat</li>
                                <li>Update real-time</li>
                            </ul>
                            <a href="{{ route('warga.index') }}" class="service-btn">
                                <span>Lihat Database</span>
                                <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>
                        <div class="service-decoration"></div>
                    </div>

                    <!-- Berkas Persyaratan -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="lni lni-folder"></i>
                        </div>
                        <div class="service-content">
                            <h3>Berkas Persyaratan</h3>
                            <p>Upload dan kelola dokumen pendukung untuk setiap permohonan</p>
                            <ul class="service-features">
                                <li>Upload multiple file</li>
                                <li>Format beragam</li>
                                <li>Enkripsi data</li>
                            </ul>
                            <a href="{{ route('berkas_persyaratan.index') }}" class="service-btn">
                                <span>Kelola Berkas</span>
                                <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>
                        <div class="service-decoration"></div>
                    </div>

                    <!-- Riwayat & Tracking -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="lni lni-timer"></i>
                        </div>
                        <div class="service-content">
                            <h3>Riwayat & Tracking</h3>
                            <p>Lacak riwayat status setiap permohonan dengan timeline yang jelas</p>
                            <ul class="service-features">
                                <li>Timeline interaktif</li>
                                <li>Histori lengkap</li>
                                <li>Export laporan</li>
                            </ul>
                            <a href="{{ route('riwayat_status.index') }}" class="service-btn">
                                <span>Lacak Status</span>
                                <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>
                        <div class="service-decoration"></div>
                    </div>

                    <!-- Manajemen Pengguna -->
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="lni lni-cog"></i>
                        </div>
                        <div class="service-content">
                            <h3>Manajemen Pengguna</h3>
                            <p>Kelola akun pengguna dengan berbagai level akses dan verifikasi</p>
                            <ul class="service-features">
                                <li>Multi-level akses</li>
                                <li>Verifikasi identitas</li>
                                <li>Reset password</li>
                            </ul>
                            <a href="{{ route('user.index') }}" class="service-btn">
                                <span>Kelola Pengguna</span>
                                <i class="lni lni-arrow-right"></i>
                            </a>
                        </div>
                        <div class="service-decoration"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works - Simple Version -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="how-it-works">
                    <h3 class="text-center fw-bold mb-4">Bagaimana Cara Kerjanya?</h3>
                    <div class="steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <h4>Pilih Layanan</h4>
                            <p>Pilih jenis layanan yang Anda butuhkan dari daftar di atas</p>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <h4>Isi Formulir</h4>
                            <p>Lengkapi data dengan benar sesuai dengan persyaratan</p>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <h4>Proses & Track</h4>
                            <p>Pantau status pengajuan Anda secara real-time</p>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <h4>Selesai</h4>
                            <p>Terima dan download dokumen yang sudah selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Section -->
        <div class="row">
            <div class="col-lg-12">
                <div class="support-banner">
                    <div class="support-content">
                        <h3 class="fw-bold mb-3">Butuh Bantuan?</h3>
                        <p class="mb-4">Tim support kami siap membantu Anda 24/7 melalui berbagai channel</p>
                        <div class="support-channels">
                            <a href="https://wa.me/6281363504725" target="_blank" class="support-channel">
                                <i class="lni lni-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>
                            <a href="mailto:support@suratku.id" class="support-channel">
                                <i class="lni lni-envelope"></i>
                                <span>Email</span>
                            </a>
                            <div class="support-channel">
                                <i class="lni lni-phone"></i>
                                <span>Telepon</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Layanan Section end ========================= -->

<style>
/* Base Styles */
.layanan-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f0f4f8 100%);
    min-height: 100vh;
    padding-top: 100px !important;
    padding-bottom: 60px;
}

/* Hero Section */
.hero-badge {
    margin-top: 20px;
}

.text-gradient-primary {
    background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.highlight-text {
    position: relative;
    display: inline-block;
}

.highlight-text::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(90deg, #F59E0B, #FBBF24);
    opacity: 0.3;
    z-index: -1;
    border-radius: 3px;
}

/* Services Grid */
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin: 40px 0;
}

.service-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
    border-color: #1E3A8A;
}

.service-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #1E3A8A, #3B82F6);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 25px;
}

.service-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.service-content h3 {
    color: #1E3A8A;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.5rem;
    line-height: 1.3;
}

.service-content p {
    color: #6B7280;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 1rem;
    flex: 1;
}

.service-features {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.service-features li {
    padding: 8px 0;
    padding-left: 28px;
    position: relative;
    color: #4B5563;
    font-size: 0.95rem;
}

.service-features li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #10B981;
    font-weight: bold;
    font-size: 1.1rem;
}

.service-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background: linear-gradient(135deg, #1E3A8A, #3B82F6);
    color: white;
    border: none;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    margin-top: auto;
    width: 100%;
}

.service-btn:hover {
    transform: translateX(5px);
    box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
    color: white;
}

.service-btn i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.service-btn:hover i {
    transform: translateX(5px);
}

.service-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, transparent 50%, rgba(30, 58, 138, 0.05) 50%);
    border-radius: 0 20px 0 80px;
    pointer-events: none;
}

/* Color variations for different services */
.service-card:nth-child(1) .service-icon {
    background: linear-gradient(135deg, #1E3A8A, #3B82F6);
}

.service-card:nth-child(2) .service-icon {
    background: linear-gradient(135deg, #059669, #10B981);
}

.service-card:nth-child(3) .service-icon {
    background: linear-gradient(135deg, #D97706, #F59E0B);
}

.service-card:nth-child(4) .service-icon {
    background: linear-gradient(135deg, #7C3AED, #8B5CF6);
}

.service-card:nth-child(5) .service-icon {
    background: linear-gradient(135deg, #DC2626, #EF4444);
}

.service-card:nth-child(6) .service-icon {
    background: linear-gradient(135deg, #475569, #64748B);
}

/* How It Works */
.how-it-works {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin: 50px 0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.step {
    text-align: center;
    padding: 20px;
    border-radius: 16px;
    background: #f8fafc;
    transition: all 0.3s ease;
}

.step:hover {
    background: white;
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #1E3A8A, #3B82F6);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    margin: 0 auto 15px;
}

.step h4 {
    color: #1E3A8A;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

.step p {
    color: #6B7280;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

/* Support Banner */
.support-banner {
    background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
    border-radius: 20px;
    padding: 40px;
    color: white;
    text-align: center;
}

.support-content h3 {
    font-size: 1.75rem;
    margin-bottom: 15px;
}

.support-content p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 30px;
}

.support-channels {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.support-channel {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    text-decoration: none;
    color: white;
    transition: all 0.3s ease;
    min-width: 120px;
    border: 1px solid transparent;
}

.support-channel:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-5px);
}

.support-channel i {
    font-size: 2rem;
    margin-bottom: 10px;
}

.support-channel span {
    font-weight: 600;
    font-size: 0.95rem;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .layanan-section {
        padding-top: 90px !important;
        padding-bottom: 40px;
    }

    .services-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .service-card {
        padding: 25px;
    }

    .service-icon {
        width: 60px;
        height: 60px;
        font-size: 1.75rem;
        margin-bottom: 20px;
    }

    .how-it-works {
        padding: 30px;
        margin: 30px 0;
    }

    .steps {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .step {
        padding: 15px;
    }

    .support-banner {
        padding: 30px 20px;
    }

    .support-channels {
        gap: 15px;
    }

    .support-channel {
        min-width: 100px;
        padding: 15px;
    }
}

@media (max-width: 576px) {
    .layanan-section {
        padding-top: 80px !important;
        padding-bottom: 30px;
    }

    h1.display-5 {
        font-size: 2.2rem;
    }

    .lead {
        font-size: 1.1rem;
    }

    .service-card {
        padding: 20px;
    }

    .service-content h3 {
        font-size: 1.3rem;
    }

    .service-features li {
        font-size: 0.9rem;
    }

    .support-channel {
        min-width: 90px;
        padding: 12px;
    }

    .support-channel i {
        font-size: 1.75rem;
    }
}

/* Animations */
@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-8px);
    }
}

.service-card:hover .service-icon {
    animation: float 2s ease-in-out infinite;
}

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

.service-card {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}

.service-card:nth-child(1) { animation-delay: 0.1s; }
.service-card:nth-child(2) { animation-delay: 0.2s; }
.service-card:nth-child(3) { animation-delay: 0.3s; }
.service-card:nth-child(4) { animation-delay: 0.4s; }
.service-card:nth-child(5) { animation-delay: 0.5s; }
.service-card:nth-child(6) { animation-delay: 0.6s; }

/* Scroll padding for anchor links */
html {
    scroll-padding-top: 120px;
}

/* Smooth transitions */
.service-card,
.service-btn,
.support-channel,
.step {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Adjust header spacing
    function adjustHeaderSpacing() {
        const header = document.querySelector('header');
        const layananSection = document.querySelector('.layanan-section');

        if (header && layananSection) {
            const headerHeight = header.offsetHeight;
            const paddingTop = headerHeight + 40;
            layananSection.style.paddingTop = paddingTop + 'px';
            document.documentElement.style.scrollPaddingTop = (headerHeight + 20) + 'px';
        }
    }

    // Initial adjustment
    adjustHeaderSpacing();

    // Adjust on resize and load
    window.addEventListener('resize', adjustHeaderSpacing);
    window.addEventListener('load', adjustHeaderSpacing);

    // Add hover effects to service cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });

        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });

    // Add click animation to service buttons
    const serviceBtns = document.querySelectorAll('.service-btn');
    serviceBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Add ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.7);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                top: ${y}px;
                left: ${x}px;
                pointer-events: none;
            `;

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        .service-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);

    // Animate steps on scroll
    const steps = document.querySelectorAll('.step');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    });

    steps.forEach(step => {
        step.style.opacity = '0';
        step.style.transform = 'translateY(20px)';
        step.style.transition = 'all 0.6s ease';
        observer.observe(step);
    });

    // Support channel hover effects
    const supportChannels = document.querySelectorAll('.support-channel');
    supportChannels.forEach(channel => {
        channel.addEventListener('mouseenter', function() {
            const icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1.2)';
            }
        });

        channel.addEventListener('mouseleave', function() {
            const icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1)';
            }
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.startsWith('#') && document.querySelector(href)) {
                e.preventDefault();
                const targetElement = document.querySelector(href);
                const headerHeight = document.querySelector('header')?.offsetHeight || 80;
                const targetPosition = targetElement.offsetTop - headerHeight - 30;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Parallax effect on scroll
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const services = document.querySelector('.services-grid');
        if (services) {
            const rate = scrolled * 0.05;
            services.style.transform = `translateY(${rate}px)`;
        }
    });
});
</script>
@endsection
