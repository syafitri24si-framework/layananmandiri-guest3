{{-- resources/views/pages/user/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="user-show" style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
        {{-- Header Section --}}
        <div class="row mb-4 align-items-center" style="margin-top: 30px;">
            <div class="col-md-8 text-center text-md-start">
                <h3 class="mb-2" style="margin-bottom: 20px !important;">
                    <i class="lni lni-users me-2"></i>
                    @if(Auth::user()->isAdmin())
                        Daftar User
                    @else
                        Profil Saya
                    @endif
                </h3>
                <p class="text-muted mb-2">
                    @if(Auth::user()->isAdmin())
                        Kelola data user sistem Bina Desa.
                    @else
                        Kelola profil dan data pribadi Anda.
                    @endif
                </p>

                {{-- Informasi Jumlah Data (Hanya untuk Admin) --}}
                @if(Auth::user()->isAdmin())
                <div class="data-info-container mb-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <div class="data-info-card p-3 rounded border">
                                <div class="d-flex align-items-center">
                                    <div class="data-icon me-3">
                                        <i class="lni lni-database text-primary" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <div class="data-label text-muted small">Total User</div>
                                        <div class="data-value h4 mb-0 text-primary">{{ $user->total() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="data-info-card p-3 rounded border">
                                <div class="d-flex align-items-center">
                                    <div class="data-icon me-3">
                                        <i class="lni lni-checkmark-circle text-success" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <div class="data-label text-muted small">Terverifikasi</div>
                                        <div class="data-value h4 mb-0 text-success">
                                            {{ $user->whereNotNull('email_verified_at')->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="data-info-card p-3 rounded border">
                                <div class="d-flex align-items-center">
                                    <div class="data-icon me-3">
                                        <i class="lni lni-users text-info" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <div class="data-label text-muted small">Admin</div>
                                        <div class="data-value h4 mb-0 text-info">
                                            {{ $user->where('role', 'Admin')->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="data-info-card p-3 rounded border">
                                <div class="d-flex align-items-center">
                                    <div class="data-icon me-3">
                                        <i class="lni lni-user text-warning" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <div class="data-label text-muted small">Warga</div>
                                        <div class="data-value h4 mb-0 text-warning">
                                            {{ $user->where('role', 'Warga')->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Pagination --}}
                    @if($user->total() > 0)
                        <div class="mt-3">
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <div class="pagination-info">
                                    <span class="badge bg-primary">
                                        <i class="lni lni-list me-1"></i>
                                        Halaman {{ $user->currentPage() }} dari {{ $user->lastPage() }}
                                    </span>
                                </div>
                                <div class="pagination-info">
                                    <span class="badge bg-secondary">
                                        <i class="lni lni-layers me-1"></i>
                                        Menampilkan {{ $user->count() }} dari {{ $user->total() }} data
                                        @if(request()->hasAny(['name', 'email', 'search']))
                                            <span class="ms-1">
                                                (Hasil filter)
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                @if($user->count() < $user->total())
                                    <div class="pagination-info">
                                        <span class="badge bg-info">
                                            <i class="lni lni-files me-1"></i>
                                            {{ $user->perPage() }} data per halaman
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- TOMBOL CREATE (Hanya untuk Admin) --}}
            <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('user.create') }}" class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah User
                    </a>
                @else
                    {{-- Warga bisa edit profil sendiri --}}
                    <a href="{{ route('user.edit', Auth::id()) }}" class="btn btn-success">
                        <i class="lni lni-pencil-alt"></i> Edit Profil
                    </a>
                @endif
            </div>
        </div>

        {{-- FORM FILTER (Hanya untuk Admin) --}}
        @if(Auth::user()->isAdmin())
        <form method="GET" action="{{ route('user.index') }}" class="mb-4">
            <div class="row align-items-center">
                {{-- Filter Nama --}}
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-user"></i>
                        <select class="form-select" name="name">
                            <option value="">Semua Nama</option>
                            @foreach($user_names as $name)
                                <option value="{{ $name }}" {{ request('name') == $name ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Filter Email --}}
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-envelope"></i>
                        <select class="form-select" name="email">
                            <option value="">Semua Email</option>
                            @foreach($user_emails as $email)
                                <option value="{{ $email }}" {{ request('email') == $email ? 'selected' : '' }}>
                                    {{ $email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Search Input --}}
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nama atau email..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="lni lni-search-alt me-1"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-danger ms-2">
                                <i class="lni lni-close me-1"></i> Clear
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-2">
                    @if(request()->hasAny(['name', 'email', 'search']))
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="lni lni-close me-1"></i> Reset All
                        </a>
                    @endif
                </div>
            </div>
        </form>
        @endif

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="lni lni-checkmark-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- CARD GRID USER --}}
        <div class="row g-4">
            @forelse ($user as $item)
                {{-- WARGA HANYA BISA LIHAT DATA DIRI SENDIRI --}}
                @if(Auth::user()->isAdmin() || (Auth::user()->isWarga() && Auth::id() == $item->id))
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                {{-- Header dengan Foto Profil --}}
                                <div class="d-flex align-items-start mb-3">
                                    {{-- Foto Profil --}}
                                    <div class="me-3 position-relative">
                                        <div class="avatar-container">
                                            @if($item->has_default_avatar)
                                                {{-- Default Avatar: Kepala + Badan --}}
                                                <div class="default-avatar-placeholder rounded-circle border shadow-sm d-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px; background-color: #f8f9fa;">
                                                    <div class="avatar-icon">
                                                        <svg width="40" height="40" viewBox="0 0 40 40">
                                                            <!-- Kepala -->
                                                            <circle cx="20" cy="15" r="8" fill="none" stroke="#6c757d" stroke-width="2"/>
                                                            <!-- Badan -->
                                                            <path d="M12,25 Q20,30 28,25" fill="none" stroke="#6c757d" stroke-width="2"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @else
                                                {{-- Foto Custom --}}
                                                <img src="{{ $item->profile_picture_url }}"
                                                     alt="{{ $item->name }}"
                                                     class="rounded-circle border shadow-sm custom-avatar"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                        </div>
                                        {{-- Badge untuk default avatar --}}
                                        @if($item->has_default_avatar)
                                            <span class="badge bg-light text-dark position-absolute"
                                                  style="bottom: -5px; right: -5px; font-size: 8px; padding: 2px 5px; border: 1px solid #dee2e6;">
                                                <i class="lni lni-user" style="font-size: 8px;"></i>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Info User --}}
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1">
                                            {{ $item->name }}
                                        </h5>
                                        <p class="text-muted mb-1 small">{{ $item->email }}</p>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge
                                                @if($item->role == 'Admin') bg-danger
                                                @else bg-primary @endif">
                                                {{ $item->role }}
                                            </span>
                                            <span class="badge
                                                @if ($item->email_verified_at) bg-success
                                                @else bg-warning text-dark @endif small">
                                                @if ($item->email_verified_at)
                                                    <i class="lni lni-checkmark-circle me-1"></i> Terverifikasi
                                                @else
                                                    <i class="lni lni-timer me-1"></i> Belum
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Informasi Dasar --}}
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center text-muted mb-1">
                                                <i class="lni lni-id-card me-2"></i>
                                                <small>User ID</small>
                                            </div>
                                            <p class="mb-0">
                                                <strong>#{{ $item->id }}</strong>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center text-muted mb-1">
                                                <i class="lni lni-image me-2"></i>
                                                <small>Foto Profil</small>
                                            </div>
                                            <p class="mb-0">
                                                @if($item->profile_picture)
                                                    <span class="badge bg-success">
                                                        <i class="lni lni-checkmark-circle me-1"></i> Custom
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="lni lni-user me-1"></i> Default
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Detail Email Verification --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-checkmark-circle me-2"></i>
                                        <small>Verifikasi Email</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Status</small>
                                            <p class="mb-2">
                                                @if ($item->email_verified_at)
                                                    <span class="text-success">Terverifikasi</span>
                                                @else
                                                    <span class="text-warning">Belum</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Tanggal Verifikasi</small>
                                            <p class="mb-2">
                                                @if ($item->email_verified_at)
                                                    {{ \Carbon\Carbon::parse($item->email_verified_at)->format('d M Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Keamanan Akun --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-lock me-2"></i>
                                        <small>Keamanan Akun</small>
                                    </div>
                                    <div class="bg-light p-2 rounded">
                                        <div class="row">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Password</small>
                                                <span class="badge bg-success">
                                                    <i class="lni lni-lock me-1"></i> Terenkripsi
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Avatar</small>
                                                @if($item->profile_picture)
                                                    <span class="badge bg-primary">
                                                        <i class="lni lni-image me-1"></i> Custom
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-dark border">
                                                        <i class="lni lni-user me-1"></i> Default
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mt-2">
                                            <i class="lni lni-history me-1"></i> Update: {{ $item->updated_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>

                                {{-- Timestamps --}}
                                <div class="border-top pt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Dibuat</small>
                                            <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Diperbarui</small>
                                            <small>{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y H:i') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- FOOTER - ACTION BUTTONS --}}
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <div class="d-flex justify-content-between">
                                    {{-- TOMBOL DETAIL --}}
                                    <a href="{{ route('user.show', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="lni lni-eye me-1"></i> Detail
                                    </a>

                                    {{-- TOMBOL EDIT & DELETE: Cek authorization --}}
                                    @if(Auth::user()->isAdmin() || (Auth::user()->isWarga() && Auth::id() == $item->id))
                                        {{-- TOMBOL EDIT --}}
                                        <a href="{{ route('user.edit', $item->id) }}"
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="lni lni-pencil-alt me-1"></i> Edit
                                        </a>

                                        {{-- TOMBOL HAPUS (Hanya untuk Admin, dan tidak boleh hapus diri sendiri) --}}
                                        @if(Auth::user()->isAdmin() && Auth::id() != $item->id)
                                            <form action="{{ route('user.destroy', $item->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Hapus user ini?')">
                                                    <i class="lni lni-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                {{-- Empty State --}}
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="lni lni-users text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">
                            @if(Auth::user()->isAdmin())
                                Belum ada data user
                            @else
                                Profil tidak ditemukan
                            @endif
                        </h5>
                        <p class="text-muted">
                            @if(Auth::user()->isAdmin())
                                Silakan tambah user baru untuk memulai
                            @else
                                Terjadi kesalahan saat memuat profil
                            @endif
                        </p>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                                <i class="lni lni-plus"></i> Tambah User Pertama
                            </a>
                        @else
                            <a href="{{ route('user.edit', Auth::id()) }}" class="btn btn-primary mt-2">
                                <i class="lni lni-pencil-alt"></i> Edit Profil
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION (Hanya untuk Admin) --}}
        @if(Auth::user()->isAdmin() && $user->hasPages())
            <div class="mt-5">
                {{ $user->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>

<style>
    .select-wrapper {
        position: relative;
    }
    .select-wrapper i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        color: #6c757d;
    }
    .select-wrapper .form-select {
        padding-left: 40px;
    }
    .input-group {
        display: flex;
        gap: 8px;
    }
    .input-group .form-control {
        flex: 1;
    }
    .card {
        transition: transform 0.2s ease-in-out;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .empty-state {
        opacity: 0.7;
    }
    .card-footer {
        padding: 1rem 1.25rem;
        background: transparent;
    }
    .card-footer .btn {
        border-radius: 6px;
        font-size: 12px;
        padding: 5px 10px;
    }
    .badge {
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 20px;
    }
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-title {
        font-size: 1rem;
        line-height: 1.4;
    }
    .card-body {
        padding: 1.25rem;
    }

    /* ✅ STYLE KHUSUS UNTUK DEFAULT AVATAR (KEPALA+BADAN) */
    .default-avatar-placeholder {
        background-color: #f8f9fa;
        border: 2px dashed #dee2e6 !important;
    }

    .default-avatar-placeholder:hover {
        background-color: #e9ecef;
        border-color: #adb5bd !important;
    }

    .avatar-icon svg {
        opacity: 0.7;
    }

    .avatar-icon svg:hover {
        opacity: 1;
    }

    /* Style untuk foto custom */
    .custom-avatar {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .custom-avatar:hover {
        border-color: #3498db;
        transform: scale(1.05);
    }

    /* Style untuk badge kecil */
    .badge.small {
        font-size: 10px;
        padding: 2px 6px;
    }

    /* Badge untuk default avatar */
    .position-relative .badge {
        border: 1px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* ✅ STYLE UNTUK INFORMASI DATA */
    .data-info-card {
        background-color: #fff;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
    }

    .data-info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-color: #3498db;
    }

    .data-icon {
        width: 50px;
        height: 50px;
        background-color: #f8f9fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .data-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .data-value {
        font-weight: 700;
        line-height: 1.2;
    }

    .pagination-info .badge {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 20px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('User index page loaded');

        // Hover effect untuk foto custom
        const customAvatars = document.querySelectorAll('.custom-avatar');
        customAvatars.forEach(img => {
            img.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
                this.style.borderColor = '#3498db';
            });

            img.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
                this.style.borderColor = '#e9ecef';
            });
        });

        // Hover effect untuk default avatar
        const defaultAvatars = document.querySelectorAll('.default-avatar-placeholder');
        defaultAvatars.forEach(div => {
            div.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#e9ecef';
                this.style.borderColor = '#adb5bd !important';
                this.querySelector('svg').style.opacity = '1';
            });

            div.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '#f8f9fa';
                this.style.borderColor = '#dee2e6 !important';
                this.querySelector('svg').style.opacity = '0.7';
            });
        });

        // Hover effect untuk data info cards
        const dataInfoCards = document.querySelectorAll('.data-info-card');
        dataInfoCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
                this.style.borderColor = '#3498db';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
                this.style.borderColor = '#e9ecef';
            });
        });
    });
</script>
@endsection
