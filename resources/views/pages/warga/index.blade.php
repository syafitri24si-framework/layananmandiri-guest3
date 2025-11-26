@extends('layouts.guest.app')

@section('content')
    <section class="warga-section py-5">
        <div class="container">
            <div class="row mb-4 align-items-center" style="margin-top: 30px;">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="mb-2" style="margin-bottom: 20px !important;">Bina Desa - Daftar Warga</h3>
                    <p class="text-muted mb-0">Berikut adalah data warga yang telah diinputkan.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('warga.create') }}" class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah Data
                    </a>
                </div>
            </div>

            {{-- FORM FILTER DENGAN SEARCH --}}
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
                            <input type="text" name="search" class="form-control" placeholder="Cari nama, NIK, email, telepon, atau pekerjaan..."
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

            {{-- CARD GRID --}}
            <div class="row g-4">
                @forelse($warga as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                {{-- Header dengan Nama Warga --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                                    <span class="badge bg-primary">{{ $item->jenis_kelamin }}</span>
                                </div>

                                {{-- No KTP --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-credit-cards me-2"></i>
                                        <small>No KTP</small>
                                    </div>
                                    <p class="mb-0">{{ $item->no_ktp }}</p>
                                </div>

                                {{-- Agama --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-heart me-2"></i>
                                        <small>Agama</small>
                                    </div>
                                    <p class="mb-0">{{ $item->agama }}</p>
                                </div>

                                {{-- Pekerjaan --}}
                                @if ($item->pekerjaan)
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-briefcase me-2"></i>
                                            <small>Pekerjaan</small>
                                        </div>
                                        <p class="mb-0">{{ $item->pekerjaan }}</p>
                                    </div>
                                @endif

                                {{-- Kontak --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-phone me-2"></i>
                                        <small>Kontak</small>
                                    </div>
                                    <p class="mb-0">
                                        @if($item->telp) {{ $item->telp }} @endif
                                        @if($item->telp && $item->email) • @endif
                                        @if($item->email) {{ $item->email }} @endif
                                    </p>
                                </div>

                                {{-- Tanggal Dibuat & Diupdate --}}
                                <div class="small text-muted mt-3 pt-3 border-top">
                                    <div class="d-flex justify-content-between">
                                        <span>Dibuat:</span>
                                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Diupdate:</span>
                                        <span>{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- FOOTER - ACTION BUTTONS --}}
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="lni lni-pencil-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus data warga ini?')">
                                            <i class="lni lni-trash me-1"></i> Hapus
                                        </button>
                                    </form>
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
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .empty-state {
            opacity: 0.7;
        }
        .btn-outline-primary, .btn-outline-danger {
            border-width: 1px;
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }
    </style>
@endsection
