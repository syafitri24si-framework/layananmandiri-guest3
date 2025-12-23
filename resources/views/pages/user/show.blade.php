{{-- resources/views/pages/user/show.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="user-show" style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm position-relative" style="z-index: 10;">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.index') }}"
                                       class="text-decoration-none">
                                        <i class="lni lni-users me-1"></i> Daftar User
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail User
                                </li>
                            </ol>
                        </nav>
                        <h3 class="mb-0 text-primary">
                            <i class="lni lni-eye me-2"></i>
                            Detail User
                        </h3>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('user.index') }}"
                           class="btn btn-outline-secondary px-3 py-2">
                            <i class="lni lni-arrow-left me-2"></i> Kembali
                        </a>
                        @if (Auth::check() && Auth::user()->role === 'Admin')
                        <a href="{{ route('user.edit', $user->id) }}"
                           class="btn btn-warning px-3 py-2">
                            <i class="lni lni-pencil me-2"></i> Edit
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="lni lni-checkmark-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Foto Profil dan Info Utama --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body text-center">
                                @if($user->has_default_avatar)
                                    {{-- Default Avatar: Kepala + Badan --}}
                                    <div class="default-avatar-large-show rounded-circle border shadow mb-4 d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 180px; height: 180px; background-color: #f8f9fa; border: 3px dashed #dee2e6 !important;">
                                        <div class="avatar-large-icon-show">
                                            <svg width="100" height="100" viewBox="0 0 100 100">
                                                <!-- Kepala -->
                                                <circle cx="50" cy="35" r="20" fill="none" stroke="#6c757d" stroke-width="4"/>
                                                <!-- Badan -->
                                                <path d="M30,70 Q50,85 70,70" fill="none" stroke="#6c757d" stroke-width="4"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h5 class="mb-2">Default Avatar</h5>
                                    <p class="text-muted mb-0 small">
                                        <i class="lni lni-user me-1"></i> Kepala + Badan
                                    </p>
                                @else
                                    {{-- Foto Custom --}}
                                    <img src="{{ $user->profile_picture_url }}"
                                         alt="{{ $user->name }}"
                                         class="rounded-circle border shadow mb-4 custom-avatar-show"
                                         style="width: 180px; height: 180px; object-fit: cover;">
                                    <h5 class="mb-2">Foto Profil Custom</h5>
                                    <p class="text-muted mb-0 small">
                                        <i class="lni lni-image me-1"></i> Diupload oleh user
                                    </p>
                                @endif

                                {{-- Status Avatar --}}
                                <div class="mt-3">
                                    @if($user->profile_picture)
                                        <span class="badge bg-success">
                                            <i class="lni lni-checkmark-circle me-1"></i> Custom Avatar
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="lni lni-user me-1"></i> Default Avatar
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-primary text-white py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="lni lni-user me-2"></i>
                                        {{ $user->name }}
                                    </h5>
                                    <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                        ID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                {{-- Status Badge --}}
                                <div class="mb-4">
                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="badge
                                            @if($user->email_verified_at) bg-success
                                            @else bg-warning text-dark @endif fs-6 p-3">
                                            @if($user->email_verified_at)
                                                <i class="lni lni-checkmark-circle me-1"></i>
                                                Email Terverifikasi
                                            @else
                                                <i class="lni lni-timer me-1"></i>
                                                Email Belum Verifikasi
                                            @endif
                                        </span>

                                        <span class="badge
                                            @if($user->role == 'Admin') bg-danger
                                            @else bg-primary @endif fs-6 p-3">
                                            @if($user->role == 'Admin')
                                                <i class="lni lni-shield me-1"></i>
                                                Administrator
                                            @else
                                                <i class="lni lni-user me-1"></i>
                                                Warga
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                {{-- Informasi Dasar --}}
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-user me-1"></i> Nama Lengkap
                                            </small>
                                            <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-envelope me-1"></i> Email
                                            </small>
                                            <p class="mb-0 fw-semibold">{{ $user->email }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-key me-1"></i> Status Password
                                            </small>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success">
                                                    <i class="lni lni-checkmark-circle me-1"></i> Terenkripsi
                                                </span>
                                                <small class="text-muted">
                                                    Terakhir diubah: {{ $user->updated_at->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-image me-1"></i> Avatar
                                            </small>
                                            @if($user->profile_picture)
                                                <span class="badge bg-primary">
                                                    <i class="lni lni-image me-1"></i> Custom Foto
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="lni lni-user me-1"></i> Default (Kepala+Badan)
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detail Informasi --}}
                <div class="row">
                    {{-- Informasi Akun --}}
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-info text-white py-3">
                                <h5 class="mb-0">
                                    <i class="lni lni-info-circle me-2"></i> Detail Informasi
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @if($user->email_verified_at)
                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-calendar me-1"></i> Tanggal Verifikasi Email
                                            </small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($user->email_verified_at)->format('d F Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-calendar me-1"></i> Akun Dibuat
                                            </small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y H:i') }}
                                            </p>
                                            <small class="text-muted">
                                                ({{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }})
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-reload me-1"></i> Terakhir Diperbarui
                                            </small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($user->updated_at)->format('d F Y H:i') }}
                                            </p>
                                            <small class="text-muted">
                                                ({{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }})
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-timer me-1"></i> Status Session
                                            </small>
                                            <div class="d-flex align-items-center">
                                                @if($user->remember_token)
                                                    <span class="badge bg-success me-2">
                                                        <i class="lni lni-checkmark-circle me-1"></i> Active Session
                                                    </span>
                                                    <small class="text-muted">
                                                        User sedang login
                                                    </small>
                                                @else
                                                    <span class="badge bg-secondary me-2">
                                                        <i class="lni lni-circle-minus me-1"></i> No Active Session
                                                    </span>
                                                    <small class="text-muted">
                                                        User tidak sedang login
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Keamanan Akun --}}
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-warning text-white py-3">
                                <h5 class="mb-0">
                                    <i class="lni lni-lock me-2"></i> Keamanan Akun
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-key me-1"></i> Enkripsi Password
                                            </small>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                                <span class="badge bg-success">
                                                    <i class="lni lni-checkmark-circle me-1"></i> 100% Aman
                                                </span>
                                            </div>
                                            <small class="text-muted mt-1 d-block">
                                                Password dienkripsi dengan Laravel Hash (Bcrypt)
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-verified me-1"></i> Verifikasi Email
                                            </small>
                                            @if($user->email_verified_at)
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-success me-2">
                                                        <i class="lni lni-checkmark-circle me-1"></i> Terverifikasi
                                                    </span>
                                                    <small class="text-muted">
                                                        Email telah diverifikasi
                                                    </small>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-warning text-dark me-2">
                                                        <i class="lni lni-timer me-1"></i> Belum Terverifikasi
                                                    </span>
                                                    <small class="text-muted">
                                                        Email belum diverifikasi
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-shield me-1"></i> Level Akses
                                            </small>
                                            <div class="d-flex align-items-center">
                                                @if($user->role == 'Admin')
                                                    <span class="badge bg-danger me-2">
                                                        <i class="lni lni-shield me-1"></i> Administrator
                                                    </span>
                                                    <small class="text-muted">
                                                        Akses penuh ke semua fitur
                                                    </small>
                                                @else
                                                    <span class="badge bg-primary me-2">
                                                        <i class="lni lni-user me-1"></i> Warga
                                                    </span>
                                                    <small class="text-muted">
                                                        Akses terbatas sesuai peran
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="info-item">
                                            <small class="text-muted d-block">
                                                <i class="lni lni-image me-1"></i> Keamanan Avatar
                                            </small>
                                            @if($user->profile_picture)
                                                <span class="badge bg-info">
                                                    <i class="lni lni-checkmark-circle me-1"></i> Foto Tersimpan Aman
                                                </span>
                                                <small class="text-muted mt-1 d-block">
                                                    Foto profil disimpan di storage yang aman
                                                </small>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="lni lni-user me-1"></i> Avatar Default
                                                </span>
                                                <small class="text-muted mt-1 d-block">
                                                    Menggunakan avatar default sistem
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Aksi Cepat --}}
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="lni lni-bolt me-2"></i> Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('user.index') }}"
                               class="btn btn-outline-secondary px-4 py-2">
                                <i class="lni lni-arrow-left me-2"></i> Kembali ke Daftar
                            </a>

                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                <a href="{{ route('user.edit', $user->id) }}"
                                   class="btn btn-warning px-4 py-2">
                                    <i class="lni lni-pencil-alt me-2"></i> Edit User
                                </a>

                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger px-4 py-2"
                                            onclick="return confirm('Hapus user ini?\n\nUser "{{ $user->name }}" akan dihapus permanen.\n\nFoto profil juga akan dihapus dari storage.\n\nTindakan ini tidak dapat dibatalkan.')">
                                        <i class="lni lni-trash-can me-2"></i> Hapus User
                                    </button>
                                </form>
                            @endif

                            @if(!$user->email_verified_at)
                                <button type="button" class="btn btn-outline-warning px-4 py-2" id="resendVerificationBtn">
                                    <i class="lni lni-envelope me-2"></i> Kirim Ulang Verifikasi
                                </button>
                            @endif

                            <button type="button" class="btn btn-outline-info px-4 py-2" onclick="window.print()">
                                <i class="lni lni-printer me-2"></i> Cetak Detail
                            </button>
                        </div>

                        {{-- Catatan Penting --}}
                        <div class="mt-4 pt-3 border-top">
                            <div class="alert alert-info mb-0">
                                <div class="d-flex">
                                    <i class="lni lni-bulb text-info me-2 mt-1"></i>
                                    <div>
                                        <small>
                                            <strong>Catatan:</strong>
                                            <ul class="mb-0 mt-2">
                                                <li>Default avatar menampilkan <strong>kepala dan badan</strong> saja</li>
                                                <li>Foto profil custom dapat diupload melalui halaman edit user</li>
                                                <li>User dapat memiliki avatar default atau foto custom</li>
                                                <li>Password dienkripsi menggunakan hashing Bcrypt</li>
                                            </ul>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 0.5rem;
    }

    .btn {
        cursor: pointer !important;
        position: relative;
        z-index: 5 !important;
        pointer-events: auto !important;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .position-relative {
        z-index: 10;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 500;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 4px;
    }

    .progress-bar {
        border-radius: 4px;
    }

    .border-top {
        border-top: 1px solid #dee2e6 !important;
    }

    .btn-outline-primary {
        border-color: #3498db;
        color: #3498db;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        color: white;
    }

    .btn-outline-danger {
        border-color: #e74c3c;
        color: #e74c3c;
    }

    .btn-outline-danger:hover {
        background-color: #e74c3c;
        color: white;
    }

    .btn-outline-warning {
        border-color: #f39c12;
        color: #f39c12;
    }

    .btn-outline-warning:hover {
        background-color: #f39c12;
        color: white;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
        border-color: #e67e22;
        color: white;
    }

    .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: white;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    /* ✅ STYLE KHUSUS DEFAULT AVATAR SHOW (KEPALA+BADAN) */
    .default-avatar-large-show {
        background-color: #f8f9fa;
        border: 3px dashed #dee2e6 !important;
        transition: all 0.3s ease;
    }

    .default-avatar-large-show:hover {
        background-color: #e9ecef;
        border-color: #adb5bd !important;
    }

    .avatar-large-icon-show svg {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .default-avatar-large-show:hover .avatar-large-icon-show svg {
        opacity: 1;
    }

    /* Style untuk foto custom show */
    .custom-avatar-show {
        border: 3px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .custom-avatar-show:hover {
        border-color: #3498db;
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    /* Style untuk info item */
    .info-item {
        padding: 12px 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .default-avatar-large-show,
        .custom-avatar-show {
            width: 150px !important;
            height: 150px !important;
        }

        .avatar-large-icon-show svg {
            width: 80px;
            height: 80px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('User show page loaded');

    // Resend verification button
    const resendVerificationBtn = document.getElementById('resendVerificationBtn');
    if (resendVerificationBtn) {
        resendVerificationBtn.addEventListener('click', function() {
            if (confirm('Kirim ulang email verifikasi ke ' + "{{ $user->email }}" + '?')) {
                // Disable button dan show loading
                this.disabled = true;
                this.innerHTML = '<i class="lni lni-spinner-solid spin me-2"></i> Mengirim...';

                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                    alertDiv.innerHTML = `
                        <i class="lni lni-checkmark-circle me-2"></i>
                        Email verifikasi telah dikirim ke {{ $user->email }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                    // Insert before the quick actions section
                    const quickActions = document.querySelector('.mt-4.pt-3.border-top');
                    quickActions.parentElement.insertBefore(alertDiv, quickActions);

                    // Reset button
                    this.disabled = false;
                    this.innerHTML = '<i class="lni lni-envelope me-2"></i> Kirim Ulang Verifikasi';
                }, 1500);
            }
        });
    }

    // Delete confirmation
    const deleteForm = document.querySelector('form[action*="destroy"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const confirmDelete = confirm('Hapus user "{{ $user->name }}"?\n\nTindakan ini akan:\n1. Menghapus user secara permanen\n2. Menghapus foto profil dari storage\n3. Tidak dapat dikembalikan\n\nLanjutkan?');
            if (!confirmDelete) {
                e.preventDefault();
            }
        });
    }

    // Hover effect untuk avatar besar
    const defaultAvatarShow = document.querySelector('.default-avatar-large-show');
    if (defaultAvatarShow) {
        defaultAvatarShow.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#e9ecef';
            this.style.borderColor = '#adb5bd !important';
            this.querySelector('svg').style.opacity = '1';
        });

        defaultAvatarShow.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '#f8f9fa';
            this.style.borderColor = '#dee2e6 !important';
            this.querySelector('svg').style.opacity = '0.7';
        });
    }

    // Hover effect untuk foto custom besar
    const customAvatarShow = document.querySelector('.custom-avatar-show');
    if (customAvatarShow) {
        customAvatarShow.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
            this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.1)';
            this.style.borderColor = '#3498db';
        });

        customAvatarShow.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
            this.style.borderColor = '#e9ecef';
        });
    }

    // Add spinner animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spin {
            animation: spin 1s linear infinite;
            display: inline-block;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
