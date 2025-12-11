{{-- resources/views/pages/warga/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="warga-section py-5">
    <div class="container">
        {{-- Header Section --}}
        <div class="row mb-4 align-items-center" style="margin-top: 30px;">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="mb-2" style="margin-bottom: 20px !important;">
                    <i class="lni lni-users me-2"></i> Daftar Warga
                </h3>
                <p class="text-muted mb-0">Kelola data warga sistem Bina Desa.</p>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('warga.create') }}" class="btn btn-success">
                    <i class="lni lni-plus"></i> Tambah Data
                </a>
            </div>
        </div>

        {{-- FORM FILTER --}}
        <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
            <div class="row align-items-center">
                {{-- Filter Jenis Kelamin --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-user"></i>
                        <select class="form-select" name="jenis_kelamin">
                            <option value="">Semua Gender</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                {{-- Filter Agama --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-heart"></i>
                        <select class="form-select" name="agama">
                            <option value="">Semua Agama</option>
                            <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>
                </div>

                {{-- Search Input --}}
                <div class="col-md-5 mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nama, NIK, email, telepon, atau pekerjaan..."
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
                <div class="col-md-3">
                    @if(request()->hasAny(['jenis_kelamin', 'agama', 'search']))
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
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

        {{-- CARD GRID WARGA --}}
        <div class="row g-4">
            @forelse ($warga as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            {{-- Header dengan Nama Warga --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">
                                    <i class="lni lni-user me-1"></i>
                                    {{ $item->nama }}
                                </h5>
                                <span class="badge
                                    @if($item->jenis_kelamin == 'Laki-laki') bg-primary
                                    @else bg-pink @endif">
                                    <i class="lni
                                        @if($item->jenis_kelamin == 'Laki-laki') lni-male
                                        @else lni-female @endif me-1">
                                    </i>
                                    {{ $item->jenis_kelamin }}
                                </span>
                            </div>

                            {{-- Informasi Dasar --}}
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-id-card me-2"></i>
                                            <small>Warga ID</small>
                                        </div>
                                        <p class="mb-0">
                                            <strong>#{{ $item->warga_id }}</strong>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-credit-cards me-2"></i>
                                            <small>No KTP</small>
                                        </div>
                                        <p class="mb-0 text-truncate">{{ $item->no_ktp }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Detail Agama dan Pekerjaan --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-1">
                                    <i class="lni lni-heart me-2"></i>
                                    <small>Agama & Pekerjaan</small>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Agama</small>
                                        <p class="mb-2">{{ $item->agama }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Pekerjaan</small>
                                        <p class="mb-2">
                                            @if($item->pekerjaan)
                                                {{ $item->pekerjaan }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kontak Information --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-1">
                                    <i class="lni lni-phone me-2"></i>
                                    <small>Kontak</small>
                                </div>
                                <div class="bg-light p-2 rounded">
                                    <div class="row">
                                        @if($item->telp)
                                        <div class="col-6">
                                            <small class="text-muted d-block">Telepon</small>
                                            <p class="mb-1 fw-semibold">
                                                <i class="lni lni-phone me-1"></i> {{ $item->telp }}
                                            </p>
                                        </div>
                                        @endif
                                        @if($item->email)
                                        <div class="{{ $item->telp ? 'col-6' : 'col-12' }}">
                                            <small class="text-muted d-block">Email</small>
                                            <p class="mb-1 fw-semibold text-truncate">
                                                <i class="lni lni-envelope me-1"></i> {{ $item->email }}
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                    @if(!$item->telp && !$item->email)
                                    <div class="text-center">
                                        <small class="text-muted">
                                            <i class="lni lni-info-circle me-1"></i> Belum ada kontak
                                        </small>
                                    </div>
                                    @endif
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
                                <a href="{{ route('warga.show', $item->warga_id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="lni lni-eye me-1"></i> Detail
                                </a>
                             @if (Auth::check() && Auth::user()->role === 'Admin')
                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('warga.edit', $item->warga_id) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    <i class="lni lni-pencil-alt me-1"></i> Edit
                                </a>

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('warga.destroy', $item->warga_id) }}"
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus data warga ini?')">
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
                        <h5 class="text-muted mt-3">Belum ada data warga</h5>
                        <p class="text-muted">Silakan tambah data warga baru untuk memulai</p>
                        <a href="{{ route('warga.create') }}" class="btn btn-primary mt-2">
                            <i class="lni lni-plus"></i> Tambah Warga Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($warga->hasPages())
            <div class="mt-5">
                {{ $warga->links('pagination::bootstrap-5') }}
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
    .bg-pink {
        background-color: #f78fb3 !important;
        color: #fff;
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
        console.log('Warga index page loaded');
    });
</script>
@endsection
