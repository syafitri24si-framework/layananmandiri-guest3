@extends('layouts.guest.app')

@section('content')
    <section class="jenis-surat-section py-5">
        <div class="container">
            <div class="row mb-4 align-items-center" style="margin-top: 30px;">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="mb-2" style="margin-bottom: 20px !important;">Bina Desa - Daftar Jenis Surat</h3>
                    <p class="text-muted mb-0">Berikut adalah data jenis surat yang telah diinputkan.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('jenis_surat.create') }}" class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah Jenis Surat
                    </a>
                </div>
            </div>

            {{-- FORM FILTER DENGAN SEARCH --}}
            <form method="GET" action="{{ route('jenis_surat.index') }}" class="mb-4">
                <div class="row align-items-center">
                    {{-- Filter Kode Surat --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-tag"></i>
                            <select class="form-select" name="kode">
                                <option value="">Semua Kode Surat</option>
                                @foreach($kodeSurat as $kode)
                                    <option value="{{ $kode->kode }}" {{ request('kode') == $kode->kode ? 'selected' : '' }}>
                                        {{ $kode->kode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama jenis surat atau kode..."
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
                        @if(request()->hasAny(['kode', 'search']))
                            <a href="{{ route('jenis_surat.index') }}" class="btn btn-outline-secondary w-100">
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
                @forelse($jenisSurat as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                {{-- Header dengan Nama Jenis Surat --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $item->nama_jenis }}</h5>
                                    <span class="badge bg-primary">{{ $item->kode }}</span>
                                </div>

                                {{-- Kode Surat --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-tag me-2"></i>
                                        <small>Kode Surat</small>
                                    </div>
                                    <p class="mb-0">{{ $item->kode }}</p>
                                </div>

                                {{-- Syarat --}}
                                @if (!empty($item->syarat_json))
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-list me-2"></i>
                                            <small>Syarat</small>
                                        </div>
                                        <ul class="mb-0 ps-3 small">
                                            @foreach ($item->syarat_json as $syarat)
                                                <li>{{ $syarat }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

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
                                    <a href="{{ route('jenis_surat.edit', $item->jenis_id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="lni lni-pencil-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('jenis_surat.destroy', $item->jenis_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus jenis surat ini?')">
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
                            <i class="lni lni-files text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">Belum ada data jenis surat</h5>
                            <p class="text-muted">Silakan tambah jenis surat baru untuk memulai</p>
                            <a href="{{ route('jenis_surat.create') }}" class="btn btn-primary mt-2">
                                <i class="lni lni-plus"></i> Tambah Jenis Surat Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($jenisSurat->hasPages())
                <div class="mt-5">
                    {{ $jenisSurat->links('pagination::bootstrap-5') }}
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
