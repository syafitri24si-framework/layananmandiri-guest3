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
                                Selamat Datang di Layanan Mandiri Bina Desa
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
                                Tentang Layanan Mandiri Bina Desa
                            </h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                <strong>Layanan Mandiri Bina Desa</strong> adalah sistem digital yang dirancang untuk
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
                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Layanan Bina Desa</h3>
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
                                <i class="lni lni-envelope"></i>
                            </div>
                            <h5>Jenis Surat</h5>
                            <p>Kelola berbagai jenis surat dan dokumen resmi yang dikeluarkan oleh desa.</p>
                        </div>
                    </a>
                </div>

                <!-- User -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('user.index') }}" class="text-decoration-none text-dark">
                        <div class="single-feature wow fadeInUp text-center" data-wow-delay=".4s">
                            <div class="icon mb-3">
                                <i class="lni lni-user"></i>
                            </div>
                            <h5>User</h5>
                            <p>Data akun pengguna yang memiliki akses ke sistem layanan mandiri.</p>
                        </div>
                    </a>
                </div>

                <!-- Permohonan Surat -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('permohonan_surat.index') }}" class="text-decoration-none text-dark">
                        <div class="single-feature wow fadeInUp text-center" data-wow-delay=".8s">
                            <div class="icon mb-3">
                                <i class="lni lni-clipboard"></i>
                            </div>
                            <h5>Permohonan Surat</h5>
                            <p>Kelola pengajuan surat dari warga, mulai dari pengajuan hingga status selesai.</p>
                        </div>
                    </a>
                </div>

                <!-- Warga -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('warga.index') }}" class="text-decoration-none text-dark">
                        <div class="single-feature wow fadeInUp text-center" data-wow-delay=".6s">
                            <div class="icon mb-3">
                                <i class="lni lni-users"></i>
                            </div>
                            <h5>Warga</h5>
                            <p>Informasi lengkap warga desa untuk mendukung pelayanan digital yang terintegrasi.</p>
                        </div>
                    </a>
                </div>

                <!-- Berkas Persyaratan -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('berkas_persyaratan.index') }}" class="text-decoration-none text-dark">
                        <div class="single-feature wow fadeInUp text-center" data-wow-delay="1.0s">
                            <div class="icon mb-3">
                                <i class="lni lni-folder"></i>
                            </div>
                            <h5>Berkas Persyaratan</h5>
                            <p>Kelola dokumen dan berkas pendukung untuk setiap permohonan surat.</p>
                            <small class="text-muted d-block mt-2">
                                <i class="lni lni-upload"></i> Upload multiple file
                            </small>
                        </div>
                    </a>
                </div>

                <!-- Riwayat Status -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('riwayat_status.index') }}" class="text-decoration-none text-dark">
                        <div class="single-feature wow fadeInUp text-center" data-wow-delay="1.2s">
                            <div class="icon mb-3">
                                <i class="lni lni-history"></i>
                            </div>
                            <h5>Riwayat Status</h5>
                            <p>Lacak perkembangan dan riwayat status setiap permohonan surat.</p>
                            <small class="text-muted d-block mt-2">
                                <i class="lni lni-timer"></i> Real-time tracking
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

    <!-- ========================= Kontak Section start ========================= -->
    <section id="kontak" class="contact-section contact-style-5 pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-8">
                    <div class="section-title text-center mb-60">
                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Kontak Kami</h3>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan hubungi kami melalui
                            kontak di bawah ini.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-4">
                <!-- Alamat -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact text-center wow fadeInUp" data-wow-delay=".2s"
                        style="padding:30px; border-radius:15px; background-color:#f8f9fa;">
                        <div class="icon mb-3">
                            <i class="lni lni-map-marker"></i>
                        </div>
                        <h5>Alamat</h5>
                        <p>Jl. Pahlawan Kerja No. 91, Marpoyan Damai, Pekanbaru</p>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact text-center wow fadeInUp" data-wow-delay=".4s"
                        style="padding:30px; border-radius:15px; background-color:#f8f9fa;">
                        <div class="icon mb-3">
                            <i class="lni lni-phone"></i>
                        </div>
                        <h5>Telepon</h5>
                        <p>+62 812 3456 7890</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact text-center wow fadeInUp" data-wow-delay=".6s"
                        style="padding:30px; border-radius:15px; background-color:#f8f9fa;">
                        <div class="icon mb-3">
                            <i class="lni lni-envelope"></i>
                        </div>
                        <h5>Email</h5>
                        <p>info@binadesa.id</p>
                    </div>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <form action="" method="POST" class="contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Anda"
                                    value="{{ old('nama') }}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Anda"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subjek" class="form-control" placeholder="Subjek"
                                    value="{{ old('subjek') }}" required>
                            </div>
                            <div class="col-md-12">
                                <textarea name="pesan" rows="5" class="form-control" placeholder="Pesan Anda" required>{{ old('pesan') }}</textarea>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="lni lni-telegram-original"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Kontak Section end ========================= -->
@endsection
