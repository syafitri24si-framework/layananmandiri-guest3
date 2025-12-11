{{-- resources/views/pages/user/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="user-section py-5">
    <div class="container">
        {{-- Header Section --}}
        <div class="row mb-4 align-items-center" style="margin-top: 30px;">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="mb-2" style="margin-bottom: 20px !important;">
                    <i class="lni lni-users me-2"></i> Daftar User
                </h3>
                <p class="text-muted mb-0">Kelola data user sistem Bina Desa.</p>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="lni lni-plus"></i> Tambah User
                </a>
            </div>
        </div>

        {{-- FORM FILTER --}}
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
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            {{-- Header dengan Nama User --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">
                                    <i class="lni lni-user me-1"></i>
                                    {{ $item->name }}
                                </h5>
                                <span class="badge
                                    @if ($item->email_verified_at) bg-success
                                    @else bg-warning text-dark @endif">
                                    @if ($item->email_verified_at)
                                        <i class="lni lni-checkmark-circle me-1"></i> Verified
                                    @else
                                        <i class="lni lni-timer me-1"></i> Unverified
                                    @endif
                                </span>
                            </div>

                            {{-- Informasi Dasar --}}
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-id-card me-2"></i>
                                            <small>User ID and Role</small>
                                        </div>
                                        <p class="mb-0">
                                            <strong>#{{ $item->id }},{{$item->role}}</strong>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-envelope me-2"></i>
                                            <small>Email</small>
                                        </div>
                                        <p class="mb-0 text-truncate">{{ $item->email }}</p>
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
                                                <span class="text-warning">Belum Verifikasi</span>
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

                            {{-- Password Information --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-1">
                                    <i class="lni lni-lock me-2"></i>
                                    <small>Password</small>
                                </div>
                                <div class="bg-light p-2 rounded">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <small class="text-muted">Status Password</small>
                                        <span class="badge bg-success">
                                            <i class="lni lni-checkmark-circle me-1"></i> Terenkripsi
                                        </span>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        <i class="lni lni-key me-1"></i> Terakhir diubah: {{ $item->updated_at->format('d M Y') }}
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

                                {{-- TOMBOL EDIT --}}
                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                <a href="{{ route('user.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    <i class="lni lni-pencil-alt me-1"></i> Edit
                                </a>

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('user.destroy', $item->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus user ini?')">
                                        <i class="lni lni-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="lni lni-users text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Belum ada data user</h5>
                        <p class="text-muted">Silakan tambah user baru untuk memulai</p>
                        <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                            <i class="lni lni-plus"></i> Tambah User Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($user->hasPages())
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('User index page loaded');
    });
</script>
@endsection
