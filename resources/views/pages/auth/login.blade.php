@extends('layouts.guest.applog')

@section('content')
<section class="auth-section">
    <div class="blur-overlay"></div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg border-0" style="border-radius: 15px; background-color: rgba(255,255,255,0.95);">
                    <div class="card-body p-4">
                        {{-- Logo Section --}}
                        <div class="text-center mb-4">
                            <div class="logo-container mb-3">
                                @if(file_exists(public_path('assets/img/logo/logobinadesa2.png')))
                                    {{-- Jika logo sudah ada --}}
                                    <img src="{{ asset('assets/img/logo/logobinadesa2.png') }}"
                                         alt="Logo Bina Desa"
                                         class="img-fluid"
                                         style="max-height: 200px;">
                                @elseif(file_exists(public_path('img/logo.png')))
                                    {{-- Alternatif lokasi logo --}}
                                    <img src="{{ asset('assets/img/logo/logobinadesa2.png') }}"
                                         alt="Logo Bina Desa"
                                         class="img-fluid"
                                         style="max-height: 80px;">
                                @elseif(file_exists(public_path('images/logo.png')))
                                    {{-- Alternatif lain --}}
                                    <img src="{{ asset('assets/img/logo/logobinadesa2.png') }}"
                                         alt="Logo Bina Desa"
                                         class="img-fluid"
                                         style="max-height: 80px;">
                                @else
                                    {{-- Placeholder jika logo belum ada --}}
                                    <div class="logo-placeholder d-inline-flex align-items-center justify-content-center rounded-circle"
                                         style="width: 80px; height: 80px; background: linear-gradient(135deg, #0d6efd, #198754);">
                                        <span class="text-white fw-bold" style="font-size: 24px;">BD</span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <a href="#" class="text-decoration-none"
                                               data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                                                Upload logo
                                            </a>
                                        </small>
                                    </div>
                                @endif
                            </div>

                            <h3 class="mb-0" style="color:#0d6efd;">Login Suratku</h3>
                            <p class="text-muted small mt-1">Masukkan email dan password Anda</p>
                        </div>

                        {{-- Alert --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('auth.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value="1">

                            {{-- Email --}}
                            <div class="mb-3 position-relative">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" value="{{ old('email') }}" required>
                                <i class="lni lni-envelope position-absolute"
                                    style="top:50%; right:15px; transform: translateY(-50%); color:#0d6efd;"></i>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3 position-relative">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" required>
                                <i class="lni lni-lock position-absolute"
                                    style="top:50%; right:15px; transform: translateY(-50%); color:#0d6efd;"></i>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Login --}}
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="background-color:#0d6efd; border:none; border-radius:10px;">
                                    <i class="lni lni-telegram-original"></i> Login
                                </button>
                            </div>

                            <p class="text-center mb-0">
                                Belum punya akun?
                                <a href="{{ route('auth.create') }}" class="text-primary">Daftar di sini</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal untuk upload logo (opsional) --}}
<div class="modal fade" id="uploadLogoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Untuk menambahkan logo:</p>
                <ol>
                    <li>Simpan logo dengan nama <code>logo.png</code></li>
                    <li>Letakkan di salah satu folder berikut:
                        <ul>
                            <li><code>public/assets/img/</code></li>
                            <li><code>public/img/</code></li>
                            <li><code>public/images/</code></li>
                        </ul>
                    </li>
                    <li>Refresh halaman ini</li>
                </ol>
                <div class="alert alert-info">
                    <small>
                        <strong>Catatan:</strong> Logo akan otomatis muncul setelah diupload ke folder yang sesuai.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
