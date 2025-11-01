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
                            <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Selamat Datang di Layanan Mandiri Bina Desa</h2>
                            <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">
                                Sistem layanan mandiri berbasis digital yang membantu masyarakat dalam pengurusan surat dan administrasi desa secara cepat, mudah, dan transparan.
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

    <!-- ========================= About Section ========================= -->
    <section id="about" class="about-section about-style-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title mb-30">
                            <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Tentang Layanan Mandiri Bina Desa</h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                <strong>Layanan Mandiri Bina Desa</strong> adalah sistem digital yang dirancang untuk memudahkan masyarakat dalam mengakses berbagai pelayanan administratif desa, seperti pembuatan surat keterangan, surat domisili, dan layanan kependudukan lainnya secara online.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay=".35s">
                                Melalui platform ini, warga dapat melakukan pengajuan dokumen tanpa harus datang langsung ke kantor desa, cukup dengan beberapa klik dari perangkat Anda.
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

    <!-- ========================= Layanan Section ========================= -->
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
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".2s">
                        <div class="icon mb-3">
                            <i class="lni lni-envelope"></i>
                        </div>
                        <h5>Jenis Surat</h5>
                        <p>Kelola berbagai jenis surat dan dokumen resmi yang dikeluarkan oleh desa.</p>
                    </div>
                </div>
                <!-- User -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".4s">
                        <div class="icon mb-3">
                            <i class="lni lni-user"></i>
                        </div>
                        <h5>User</h5>
                        <p>Data akun pengguna yang memiliki akses ke sistem layanan mandiri.</p>
                    </div>
                </div>
                <!-- Warga -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp text-center" data-wow-delay=".6s">
                        <div class="icon mb-3">
                            <i class="lni lni-users"></i>
                        </div>
                        <h5>Warga</h5>
                        <p>Informasi lengkap warga desa untuk mendukung pelayanan digital yang terintegrasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
