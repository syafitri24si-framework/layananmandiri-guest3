@extends('layouts.guest.app')

@section('content')
<!-- ========================= Contact Section Start ========================= -->
<section id="contact" class="contact-section">
    <div class="container">
        <!-- Header Section -->
        <div class="row justify-content-center mb-5 pt-4">
            <div class="col-lg-8 text-center">
                <div class="hero-badge mb-4">
                    <span class="badge bg-primary-subtle text-primary px-4 py-2 rounded-pill">
                        <i class="lni lni-headphone-alt me-2"></i>Hubungi Kami
                    </span>
                </div>
                <h1 class="display-5 fw-bold mb-4">
                    Hubungi <span class="text-gradient-primary">Tim Kami</span>
                </h1>
                <p class="lead text-muted">
                    Butuh bantuan atau informasi lebih lanjut? Tim kami siap membantu Anda.
                </p>
            </div>
        </div>

        <!-- Contact Grid -->
        <div class="row g-4 mb-5">
            <!-- Contact Info Card -->
            <div class="col-lg-4">
                <div class="contact-card">
                    <div class="contact-header mb-4">
                        <div class="contact-icon mb-3">
                            <i class="lni lni-headphone-alt"></i>
                        </div>
                        <h3 class="mb-3">Informasi Kontak</h3>
                        <p class="text-muted">Hubungi kami melalui berbagai channel yang tersedia.</p>
                    </div>

                    <div class="contact-details">
                        <!-- Address -->
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div>
                                <h6>Alamat Kantor</h6>
                                <p class="small mb-0">
                                    Kantor Desa Digital<br>
                                    Jl. Pahlawan Kerja No. 91<br>
                                    Pekanbaru, Riau 28156
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div>
                                <h6>Telepon & WhatsApp</h6>
                                <p class="small mb-0">
                                    +62 812 3456 7890<br>
                                    <span class="text-muted">Senin - Jumat, 08:00 - 16:00</span>
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div>
                                <h6>Email Resmi</h6>
                                <p class="small mb-0">
                                    info@suratku.id<br>
                                    support@suratku.id
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-card">
                    <h3 class="mb-4">Kirim Pesan kepada Kami</h3>
                    <p class="text-muted mb-4">Isi formulir di bawah ini dan tim kami akan segera menghubungi Anda.</p>

                    <form id="contactForm" class="contact-form">
                        <div class="row g-3">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullName" class="form-label">Nama Lengkap *</label>
                                    <div class="input-group">
                                        <span class="input-group-icon">
                                            <i class="lni lni-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="fullName"
                                               placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email *</label>
                                    <div class="input-group">
                                        <span class="input-group-icon">
                                            <i class="lni lni-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email"
                                               placeholder="nama@email.com" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-icon">
                                            <i class="lni lni-phone"></i>
                                        </span>
                                        <input type="tel" class="form-control" id="phone"
                                               placeholder="+62 812 3456 7890">
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="form-label">Subjek *</label>
                                    <div class="input-group">
                                        <span class="input-group-icon">
                                            <i class="lni lni-briefcase"></i>
                                        </span>
                                        <select class="form-select" id="subject" required>
                                            <option value="" selected disabled>Pilih subjek pesan</option>
                                            <option value="support">Bantuan Teknis</option>
                                            <option value="information">Informasi Layanan</option>
                                            <option value="complaint">Pengaduan</option>
                                            <option value="suggestion">Saran & Masukan</option>
                                            <option value="other">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message" class="form-label">Pesan *</label>
                                    <div class="input-group">
                                        <span class="input-group-icon">
                                            <i class="lni lni-comment-alt"></i>
                                        </span>
                                        <textarea class="form-control" id="message" rows="5"
                                                  placeholder="Tulis pesan Anda di sini..." required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newsletter">
                                        <label class="form-check-label text-muted small" for="newsletter">
                                            Berlangganan newsletter kami
                                        </label>
                                    </div>
                                    <button type="submit" class="btn-primary">
                                        <i class="lni lni-send me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-card">
                    <div class="row align-items-center">
                        <div class="col-lg-4 text-center mb-4 mb-lg-0">
                            <div class="faq-icon mb-3">
                                <i class="lni lni-question-circle"></i>
                            </div>
                            <h3>Pertanyaan Umum</h3>
                            <p class="text-muted small">Temukan jawaban cepat untuk pertanyaan Anda</p>
                        </div>
                        <div class="col-lg-8">
                            <div class="faq-accordion">
                                <!-- FAQ 1 -->
                                <div class="faq-item">
                                    <button class="faq-question">
                                        <span>Bagaimana cara mengajukan surat secara online?</span>
                                        <i class="lni lni-chevron-down"></i>
                                    </button>
                                    <div class="faq-answer">
                                        <p class="small mb-0">Anda dapat mengajukan surat dengan login ke akun Anda, pilih jenis surat yang dibutuhkan, isi formulir pengajuan, dan upload dokumen pendukung. Status permohonan dapat dipantau melalui dashboard Anda.</p>
                                    </div>
                                </div>

                                <!-- FAQ 2 -->
                                <div class="faq-item">
                                    <button class="faq-question">
                                        <span>Berapa lama waktu proses pembuatan surat?</span>
                                        <i class="lni lni-chevron-down"></i>
                                    </button>
                                    <div class="faq-answer">
                                        <p class="small mb-0">Waktu proses bervariasi tergantung jenis surat. Umumnya, surat sederhana diproses dalam 1-2 hari kerja, sementara surat yang memerlukan verifikasi lebih lanjut dapat memakan waktu 3-5 hari kerja.</p>
                                    </div>
                                </div>

                                <!-- FAQ 3 -->
                                <div class="faq-item">
                                    <button class="faq-question">
                                        <span>Apakah sistem ini aman untuk data pribadi saya?</span>
                                        <i class="lni lni-chevron-down"></i>
                                    </button>
                                    <div class="faq-answer">
                                        <p class="small mb-0">Ya, kami menggunakan enkripsi 256-bit untuk melindungi data Anda. Data pribadi hanya dapat diakses oleh petugas yang berwenang dan digunakan sesuai dengan kebijakan privasi kami.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map & Location -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-card">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="mb-3">Lokasi Kantor Kami</h3>
                            <p class="text-muted mb-4">
                                Anda juga dapat mengunjungi kantor kami secara langsung untuk konsultasi langsung dengan tim.
                            </p>
                            <div class="location-details mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="location-info mb-3">
                                            <h6 class="mb-2">
                                                <i class="lni lni-clock text-primary me-2"></i>
                                                Jam Operasional
                                            </h6>
                                            <p class="small mb-0">
                                                Senin - Jumat: 08:00 - 16:00<br>
                                                Sabtu: 08:00 - 12:00<br>
                                                Minggu & Hari Libur: Tutup
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="location-info">
                                            <h6 class="mb-2">
                                                <i class="lni lni-direction-alt text-primary me-2"></i>
                                                Akses Transportasi
                                            </h6>
                                            <p class="small mb-0">
                                                • 10 menit dari pusat kota<br>
                                                • Parkir luas tersedia<br>
                                                • Akses untuk penyandang disabilitas
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="map-card">
                                <i class="lni lni-map-marker"></i>
                                <h6>Kantor Desa Digital</h6>
                                <p class="small mb-0">
                                    Jl. Pahlawan Kerja No. 91<br>
                                    Pekanbaru, Riau
                                </p>
                                <a href="#" class="btn-outline">
                                    <i class="lni lni-map me-1"></i>Lihat di Google Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Channels -->
        <div class="row">
            <div class="col-lg-12">
                <div class="support-channels">
                    <h3 class="text-center fw-bold mb-5">Channel Dukungan Lainnya</h3>
                    <div class="row g-4">
                        <!-- WhatsApp Support -->
                        <div class="col-md-4">
                            <div class="support-card">
                                <div class="support-icon whatsapp">
                                    <i class="lni lni-whatsapp"></i>
                                </div>
                                <h4 class="mb-3">WhatsApp Support</h4>
                                <p class="small mb-3">
                                    Dukungan cepat melalui WhatsApp untuk pertanyaan mendesak.
                                </p>
                                <a href="https://wa.me/6281363504725" target="_blank" class="btn-success">
                                    <i class="lni lni-whatsapp me-2"></i>Chat via WhatsApp
                                </a>
                            </div>
                        </div>

                        <!-- Email Support -->
                        <div class="col-md-4">
                            <div class="support-card">
                                <div class="support-icon email">
                                    <i class="lni lni-envelope"></i>
                                </div>
                                <h4 class="mb-3">Email Support</h4>
                                <p class="small mb-3">
                                    Kirim email untuk pertanyaan detail atau dokumen resmi.
                                </p>
                                <a href="mailto:support@suratku.id" class="btn-primary">
                                    <i class="lni lni-envelope me-2"></i>Kirim Email
                                </a>
                            </div>
                        </div>

                        <!-- Live Chat -->
                        <div class="col-md-4">
                            <div class="support-card">
                                <div class="support-icon chat">
                                    <i class="lni lni-support"></i>
                                </div>
                                <h4 class="mb-3">Live Chat</h4>
                                <p class="small mb-3">
                                    Chat langsung dengan tim support kami (tersedia jam kerja).
                                </p>
                                <button class="btn-warning" onclick="openLiveChat()">
                                    <i class="lni lni-comments me-2"></i>Mulai Live Chat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Contact Section End ========================= -->

<style>
    /* Contact Page Styles - SENADA DENGAN LAYANAN */
    .contact-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f0f4f8 100%);
        min-height: 100vh;
        padding-top: 100px !important;
        padding-bottom: 60px;
    }

    /* Hero Section - SAMA DENGAN LAYANAN */
    .hero-badge {
        margin-top: 20px;
    }

    h1.display-5 {
        color: #1E3A8A;
        font-weight: 800;
        line-height: 1.3;
    }

    .text-gradient-primary {
        background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        display: inline-block;
    }

    /* Contact Card - STYLE SENADA */
    .contact-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        border-color: #1E3A8A;
    }

    /* Contact Header */
    .contact-header {
        text-align: center;
    }

    .contact-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1E3A8A, #3B82F6);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        margin: 0 auto 20px;
    }

    /* Contact Details */
    .contact-details {
        margin-top: 30px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        padding: 20px;
        margin-bottom: 15px;
        background: #f9fafb;
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }

    .contact-item-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        background: rgba(30, 58, 138, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #1E3A8A;
        margin-right: 15px;
    }

    .contact-item:hover .contact-item-icon {
        background: #1E3A8A;
        color: white;
        transform: scale(1.05);
    }

    .contact-item h6 {
        color: #1E3A8A;
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .contact-item p {
        color: #6B7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #4B5563;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .input-group {
        position: relative;
    }

    .input-group-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6B7280;
        z-index: 10;
    }

    .form-control,
    .form-select {
        padding-left: 45px;
        border-radius: 12px !important;
        border: 1px solid #e5e7eb;
        height: 50px;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1E3A8A;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.15);
    }

    textarea.form-control {
        height: 150px;
        resize: vertical;
        padding-top: 15px;
    }

    /* Buttons - STYLE SENADA */
    .btn-primary,
    .btn-success,
    .btn-warning,
    .btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #1E3A8A, #3B82F6);
        color: white;
    }

    .btn-primary:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
        color: white;
    }

    .btn-success {
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
    }

    .btn-success:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
        color: white;
    }

    .btn-warning {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: white;
    }

    .btn-warning:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        color: white;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #1E3A8A;
        color: #1E3A8A;
    }

    .btn-outline:hover {
        background: #1E3A8A;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(30, 58, 138, 0.2);
    }

    /* Section Card - STYLE SENADA */
    .section-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin: 40px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    /* FAQ */
    .faq-icon {
        width: 100px;
        height: 100px;
        background: rgba(30, 58, 138, 0.1);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #1E3A8A;
        margin: 0 auto 20px;
    }

    .faq-accordion {
        margin-top: 20px;
    }

    .faq-item {
        border: 2px solid #F3F4F6;
        border-radius: 15px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .faq-question {
        width: 100%;
        padding: 20px;
        background: #F9FAFB;
        border: none;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        color: #1F2937;
        font-size: 1rem;
    }

    .faq-question:hover {
        background: #F3F4F6;
    }

    .faq-question i {
        transition: transform 0.3s ease;
        font-size: 0.9rem;
    }

    .faq-question.active i {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-answer p {
        padding: 20px 0;
        color: #6B7280;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Map Card */
    .map-card {
        background: #f0f7ff;
        border: 2px dashed #1E3A8A;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .map-card:hover {
        border-color: #2563eb;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .map-card i {
        font-size: 2.5rem;
        color: #1E3A8A;
        margin-bottom: 15px;
        display: block;
    }

    .map-card h6 {
        color: #1E3A8A;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .map-card p {
        color: #6B7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    /* Support Cards */
    .support-card {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 16px;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .support-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border-color: #1E3A8A;
    }

    .support-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin: 0 auto 20px;
    }

    .support-icon.whatsapp {
        background: linear-gradient(135deg, #25D366, #128C7E);
    }

    .support-icon.email {
        background: linear-gradient(135deg, #1E3A8A, #3B82F6);
    }

    .support-icon.chat {
        background: linear-gradient(135deg, #F59E0B, #D97706);
    }

    .support-card h4 {
        color: #1E3A8A;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1.25rem;
    }

    .support-card p {
        color: #6B7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    /* Responsive Design - SAMA DENGAN LAYANAN */
    @media (max-width: 768px) {
        .contact-section {
            padding-top: 90px !important;
            padding-bottom: 40px;
        }

        .contact-card,
        .section-card {
            padding: 25px;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .contact-item {
            padding: 15px;
        }

        .contact-item-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            font-size: 1.1rem;
        }

        .faq-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .support-card {
            padding: 20px;
            margin-bottom: 20px;
        }

        .support-icon {
            width: 60px;
            height: 60px;
            font-size: 1.75rem;
        }
    }

    @media (max-width: 576px) {
        .contact-section {
            padding-top: 80px !important;
            padding-bottom: 30px;
        }

        h1.display-5 {
            font-size: 2.2rem;
        }

        .lead {
            font-size: 1.1rem;
        }

        .contact-card,
        .section-card {
            padding: 20px;
        }

        .form-control,
        .form-select {
            height: 45px;
        }

        textarea.form-control {
            height: 120px;
        }
    }

    /* Animations - SAMA DENGAN LAYANAN */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-8px);
        }
    }

    .contact-card:hover .contact-icon,
    .support-card:hover .support-icon {
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

    .contact-card,
    .support-card,
    .faq-item,
    .map-card {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .contact-card:nth-child(1) { animation-delay: 0.1s; }
    .contact-card:nth-child(2) { animation-delay: 0.2s; }
    .support-card:nth-child(1) { animation-delay: 0.3s; }
    .support-card:nth-child(2) { animation-delay: 0.4s; }
    .support-card:nth-child(3) { animation-delay: 0.5s; }
    .faq-item:nth-child(1) { animation-delay: 0.1s; }
    .faq-item:nth-child(2) { animation-delay: 0.2s; }
    .faq-item:nth-child(3) { animation-delay: 0.3s; }

    /* Scroll padding - SAMA DENGAN LAYANAN */
    html {
        scroll-padding-top: 120px;
    }

    /* Smooth transitions */
    .contact-card,
    .support-card,
    .contact-item,
    .btn-primary,
    .btn-success,
    .btn-warning,
    .btn-outline,
    .faq-question {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Adjust header spacing - SAMA DENGAN LAYANAN
    function adjustHeaderSpacing() {
        const header = document.querySelector('header');
        const contactSection = document.querySelector('.contact-section');

        if (header && contactSection) {
            const headerHeight = header.offsetHeight;
            const paddingTop = headerHeight + 40;
            contactSection.style.paddingTop = paddingTop + 'px';
            document.documentElement.style.scrollPaddingTop = (headerHeight + 20) + 'px';
        }
    }

    // Initial adjustment
    adjustHeaderSpacing();

    // Adjust on resize and load
    window.addEventListener('resize', adjustHeaderSpacing);
    window.addEventListener('load', adjustHeaderSpacing);

    // Contact Form Submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // Validate form
            if (!fullName || !email || !subject || !message) {
                showAlert('error', 'Harap lengkapi semua field yang wajib diisi.');
                return;
            }

            if (!validateEmail(email)) {
                showAlert('error', 'Format email tidak valid.');
                return;
            }

            // Simulate form submission
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<i class="lni lni-spinner-arrow spin me-2"></i>Mengirim...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success message
                showAlert('success', 'Pesan Anda berhasil dikirim! Tim kami akan menghubungi Anda dalam 1-2 hari kerja.');

                // Reset form
                contactForm.reset();

                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Scroll to top of form
                contactForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 2000);
        });
    }

    // Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Alert function
    function showAlert(type, message) {
        // Remove existing alert
        const existingAlert = document.querySelector('.custom-alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        // Create alert element
        const alert = document.createElement('div');
        alert.className = `custom-alert alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show position-fixed`;
        alert.style.cssText = `
            top: 100px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: none;
            border-radius: 10px;
        `;

        // Alert content
        alert.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="lni lni-${type === 'error' ? 'close-circle' : 'checkmark-circle'} me-3 fs-4"></i>
                <div>
                    <strong class="d-block">${type === 'error' ? 'Error!' : 'Sukses!'}</strong>
                    ${message}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Add to document
        document.body.appendChild(alert);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }

    // Live Chat function
    window.openLiveChat = function() {
        const chatModal = document.createElement('div');
        chatModal.className = 'live-chat-modal position-fixed';
        chatModal.style.cssText = `
            bottom: 20px;
            right: 20px;
            width: 350px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            z-index: 9999;
            overflow: hidden;
        `;

        chatModal.innerHTML = `
            <div class="chat-header" style="background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%); color: white; padding: 15px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="lni lni-support me-2 fs-4"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Live Chat Support</h6>
                            <small class="opacity-75">Online - Balas cepat</small>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-light" onclick="this.closest('.live-chat-modal').remove()">
                        <i class="lni lni-close"></i>
                    </button>
                </div>
            </div>
            <div class="chat-body p-3" style="height: 300px; overflow-y: auto; background: #f8f9fa;">
                <div class="chat-message received mb-3">
                    <div class="message-bubble bg-light p-3 rounded-3">
                        <p class="mb-0">Halo! Ada yang bisa kami bantu?</p>
                        <small class="text-muted d-block mt-2">Support - Baru saja</small>
                    </div>
                </div>
                <div class="chat-message sent mb-3 text-end">
                    <div class="message-bubble" style="background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%); color: white; padding: 10px 15px; border-radius: 15px; display: inline-block;">
                        <p class="mb-0">Saya butuh bantuan dengan sistem...</p>
                    </div>
                </div>
            </div>
            <div class="chat-footer p-3 border-top">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Ketik pesan Anda..." style="border-radius: 10px 0 0 10px;">
                    <button class="btn btn-primary" style="border-radius: 0 10px 10px 0;">
                        <i class="lni lni-send"></i>
                    </button>
                </div>
                <small class="text-muted d-block mt-2">
                    <i class="lni lni-clock me-1"></i>Jam operasional: Senin-Jumat, 08:00-16:00
                </small>
            </div>
        `;

        document.body.appendChild(chatModal);

        // Add close on outside click
        setTimeout(() => {
            document.addEventListener('click', function outsideClick(e) {
                if (!chatModal.contains(e.target) && !e.target.closest('.btn-warning')) {
                    chatModal.remove();
                    document.removeEventListener('click', outsideClick);
                }
            });
        }, 100);
    };

    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = '+62' + value.substring(1);
            }
            e.target.value = formatPhoneNumber(value);
        });

        function formatPhoneNumber(phoneNumber) {
            const cleaned = phoneNumber.replace(/\D/g, '');
            const match = cleaned.match(/^(\d{2})(\d{3})(\d{4})(\d{0,})$/);
            if (match) {
                return match[1] + ' ' + match[2] + ' ' + match[3] + (match[4] ? ' ' + match[4] : '');
            }
            return phoneNumber;
        }
    }

    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const isActive = this.classList.contains('active');

            // Close all other FAQs
            faqQuestions.forEach(q => {
                q.classList.remove('active');
                q.nextElementSibling.style.maxHeight = null;
            });

            // Toggle current FAQ
            if (!isActive) {
                this.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });

    // Open first FAQ by default
    if (faqQuestions.length > 0) {
        faqQuestions[0].click();
    }

    // Add CSS for spinner and animations
    const style = document.createElement('style');
    style.textContent = `
        .spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .message-bubble {
            max-width: 80%;
        }

        .chat-message.sent .message-bubble {
            background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
