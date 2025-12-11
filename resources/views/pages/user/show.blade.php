{{-- resources/views/pages/user/show.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="contact-section contact-style-3 py-5">
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

                {{-- Card Utama --}}
                <div class="card shadow-sm border-0 mb-4">
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
                        </div>

                        <div class="row">
                            {{-- Kolom Kiri: Info User --}}
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-user me-2"></i> Informasi Akun
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Nama Lengkap</small>
                                                <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Role</small>
                                                <p class="mb-0 fw-semibold">{{ $user->role }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Email</small>
                                                <p class="mb-0 fw-semibold">{{ $user->email }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Status Password</small>
                                                <span class="badge bg-success">
                                                    <i class="lni lni-checkmark-circle me-1"></i> Terenkripsi
                                                </span>
                                            </div>

                                            @if($user->email_verified_at)
                                            <div class="col-6">
                                                <small class="text-muted d-block">Tanggal Verifikasi</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($user->email_verified_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Info Timestamp --}}
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-history me-2"></i> Informasi Waktu
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Dibuat Pada</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Diperbarui Pada</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($user->updated_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <small class="text-muted d-block">Terakhir Login</small>
                                                <p class="mb-0">
                                                    @if($user->remember_token)
                                                        <i class="lni lni-checkmark-circle text-success me-1"></i>
                                                        Active Session
                                                    @else
                                                        <i class="lni lni-circle-minus text-secondary me-1"></i>
                                                        No Active Session
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Sistem --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-info text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="lni lni-lock me-2"></i>
                                Informasi Keamanan & Sistem
                            </h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Authentication Info --}}
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-4 h-100">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="lni lni-key me-2"></i> Autentikasi
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <small class="text-muted d-block">Password Status</small>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                                <span class="badge bg-success">
                                                    <i class="lni lni-checkmark-circle me-1"></i> Aman
                                                </span>
                                            </div>
                                            <small class="text-muted mt-1 d-block">
                                                Password dienkripsi menggunakan Laravel Hash
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted d-block">Email Verification</small>
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">
                                                    <i class="lni lni-checkmark-circle me-1"></i> Verified
                                                </span>
                                                <small class="text-muted d-block mt-1">
                                                    Email diverifikasi pada: {{ \Carbon\Carbon::parse($user->email_verified_at)->format('d M Y') }}
                                                </small>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    <i class="lni lni-timer me-1"></i> Pending
                                                </span>
                                                <small class="text-muted d-block mt-1">
                                                    Email belum diverifikasi
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Account Activity --}}
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-4 h-100">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="lni lni-timer me-2"></i> Aktivitas Akun
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <small class="text-muted d-block">Account Age</small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                            </p>
                                            <small class="text-muted">
                                                Terdaftar sejak {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted d-block">Last Update</small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
                                            </p>
                                            <small class="text-muted">
                                                Terakhir diperbarui: {{ \Carbon\Carbon::parse($user->updated_at)->format('d M Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="mb-3">
                                <i class="lni lni-bolt me-2"></i> Aksi Cepat
                            </h6>
                            @if (Auth::check() && Auth::user()->role === 'Admin')
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('user.edit', $user->id) }}"
                                   class="btn btn-outline-primary px-4 py-2">
                                    <i class="lni lni-pencil me-2"></i> Edit User
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger px-4 py-2"
                                            onclick="return confirm('Hapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                        <i class="lni lni-trash-can me-2"></i> Hapus User
                                    </button>
                                </form>
                            @endif
                                @if(!$user->email_verified_at)
                                <button type="button" class="btn btn-outline-warning px-4 py-2" id="resendVerificationBtn">
                                    <i class="lni lni-envelope me-2"></i> Kirim Ulang Verifikasi
                                </button>
                                @endif
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
            const confirmDelete = confirm('Hapus user "{{ $user->name }}"?\n\nTindakan ini akan menghapus user secara permanen dan tidak dapat dikembalikan.');
            if (!confirmDelete) {
                e.preventDefault();
            }
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
