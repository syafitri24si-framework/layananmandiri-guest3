{{-- resources/views/pages/permohonan_surat/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section class="permohonan-surat-section" style="padding-top: 120px; min-height: 100vh;">
        <div class="container">
            {{-- HEADER --}}
            <div class="row mb-4 align-items-center" style="margin-top: 30px;">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="mb-2" style="margin-bottom: 20px !important;">
                        <i class="lni lni-files me-2"></i>
                        @if(Auth::user()->isAdmin())
                            Permohonan Surat
                        @else
                            Permohonan Saya
                        @endif
                    </h3>
                    <p class="text-muted mb-0">
                        @if(Auth::user()->isAdmin())
                            Kelola permohonan surat yang diajukan warga.
                        @else
                            Lihat dan kelola permohonan surat Anda.
                        @endif
                    </p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    {{-- WARGA HANYA BISA BUAT PERMOHONAN JIKA SUDAH PUNYA DATA WARGA --}}
                    @if(Auth::user()->isAdmin() || (Auth::user()->isWarga() && Auth::user()->hasWargaData()))
                        <a href="{{ route('permohonan_surat.create') }}" class="btn btn-success">
                            <i class="lni lni-plus"></i>
                            @if(Auth::user()->isAdmin())
                                Tambah Permohonan
                            @else
                                Ajukan Permohonan
                            @endif
                        </a>
                    @elseif(Auth::user()->isWarga())
                        <button class="btn btn-success" disabled title="Silakan lengkapi data warga terlebih dahulu">
                            <i class="lni lni-plus"></i> Ajukan Permohonan
                        </button>
                    @endif
                </div>
            </div>

            {{-- INFO BOX UNTUK WARGA YANG BELUM PUNYA DATA --}}
            @if(Auth::user()->isWarga() && !Auth::user()->hasWargaData())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="lni lni-warning me-2"></i>
                    <strong>Perhatian!</strong> Anda belum dapat mengajukan permohonan karena belum memiliki data warga.
                    Silakan <a href="{{ route('warga.create') }}" class="alert-link">lengkapi data pribadi</a> terlebih dahulu.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- FORM FILTER (Hanya untuk Admin) --}}
            @if(Auth::user()->isAdmin())
            <form method="GET" action="{{ route('permohonan_surat.index') }}" class="mb-4">
                <div class="row align-items-center">
                    {{-- Filter Status --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-list"></i>
                            <select class="form-select" name="status">
                                <option value="">Semua Status</option>
                                <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan
                                </option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Filter Jenis Surat --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-files"></i>
                            <select class="form-select" name="jenis_id">
                                <option value="">Semua Jenis</option>
                                @foreach ($jenisSurat as $jenis)
                                    <option value="{{ $jenis->jenis_id }}"
                                        {{ request('jenis_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Filter Warga --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-users"></i>
                            <select class="form-select" name="warga_id">
                                <option value="">Semua Warga</option>
                                @foreach ($wargaList as $w)
                                    <option value="{{ $w->warga_id }}"
                                        {{ request('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari no. permohonan atau nama warga..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="lni lni-search-alt me-1"></i> Search
                            </button>
                        </div>
                    </div>

                    {{-- Tombol Reset --}}
                    <div class="col-md-12 mt-3">
                        @if (request()->hasAny(['status', 'jenis_id', 'warga_id', 'search']))
                            <a href="{{ route('permohonan_surat.index') }}" class="btn btn-outline-secondary">
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

            {{-- STATISTICS CARD (Hanya untuk Admin) --}}
            @if(Auth::user()->isAdmin())
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-start border-primary border-4 bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Diajukan</h6>
                                    <h4 class="mb-0">{{ $data->where('status', 'diajukan')->count() }}</h4>
                                </div>
                                <div class="bg-primary rounded-circle p-3">
                                    <i class="lni lni-timer text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-start border-info border-4 bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Diproses</h6>
                                    <h4 class="mb-0">{{ $data->where('status', 'diproses')->count() }}</h4>
                                </div>
                                <div class="bg-info rounded-circle p-3">
                                    <i class="lni lni-cog text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-start border-success border-4 bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Selesai</h6>
                                    <h4 class="mb-0">{{ $data->where('status', 'selesai')->count() }}</h4>
                                </div>
                                <div class="bg-success rounded-circle p-3">
                                    <i class="lni lni-checkmark-circle text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-start border-danger border-4 bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Ditolak</h6>
                                    <h4 class="mb-0">{{ $data->where('status', 'ditolak')->count() }}</h4>
                                </div>
                                <div class="bg-danger rounded-circle p-3">
                                    <i class="lni lni-close text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- CARD GRID --}}
            <div class="row g-4">
                @forelse($data as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                {{-- Header dengan Nomor Permohonan dan Status --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0" title="{{ $item->nomor_permohonan }}">
                                        {{ Str::limit($item->nomor_permohonan, 15) }}
                                    </h5>
                                    <span
                                        class="badge
                                    @if ($item->status == 'diajukan') bg-warning text-dark
                                    @elseif($item->status == 'diproses') bg-info
                                    @elseif($item->status == 'selesai') bg-success
                                    @else bg-danger @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>

                                {{-- Informasi Pemohon --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-user me-2"></i>
                                        <small>Pemohon</small>
                                    </div>
                                    <p class="mb-0">
                                        <strong>{{ $item->warga->nama }}</strong>
                                        <small class="text-muted d-block">{{ $item->warga->no_ktp }}</small>
                                    </p>
                                </div>

                                {{-- Jenis Surat --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-files me-2"></i>
                                        <small>Jenis Surat</small>
                                    </div>
                                    <p class="mb-0">
                                        <strong>{{ $item->jenisSurat->nama_jenis }}</strong>
                                        <small class="text-muted d-block">({{ $item->jenisSurat->kode }})</small>
                                    </p>
                                </div>

                                {{-- Tanggal Pengajuan --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-calendar me-2"></i>
                                        <small>Tanggal Pengajuan</small>
                                    </div>
                                    <p class="mb-0">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                    </p>
                                </div>

                                {{-- Berkas Pendukung --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between text-muted mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="lni lni-paperclip me-2"></i>
                                            <small>Berkas Pendukung</small>
                                        </div>
                                        @if ($item->mediaFiles && $item->mediaFiles->count() > 0)
                                            <span class="badge bg-primary">{{ $item->mediaFiles->count() }} file</span>
                                        @endif
                                    </div>

                                    @if ($item->mediaFiles && $item->mediaFiles->count() > 0)
                                        <div class="file-list">
                                            @foreach ($item->mediaFiles->take(2) as $media)
                                                <div class="file-item d-flex align-items-center mb-2 p-2 bg-light rounded">
                                                    <div class="me-2">
                                                        @php
                                                            $fileExt = pathinfo($media->file_name, PATHINFO_EXTENSION);
                                                            $fileIcon = 'lni lni-file';
                                                            if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                                $fileIcon = 'lni lni-image';
                                                            } elseif ($fileExt == 'pdf') {
                                                                $fileIcon = 'lni lni-empty-file';
                                                            } elseif (in_array($fileExt, ['doc', 'docx'])) {
                                                                $fileIcon = 'lni lni-files';
                                                            }
                                                        @endphp
                                                        <i class="{{ $fileIcon }} text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <small class="text-truncate d-block" style="max-width: 120px;"
                                                            title="{{ $media->file_name }}">
                                                            {{ Str::limit($media->file_name, 15) }}
                                                        </small>
                                                        @if ($media->caption)
                                                            <small class="text-muted d-block"
                                                                title="Caption: {{ $media->caption }}">
                                                                {{ Str::limit($media->caption, 15) }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                    <div class="ms-2">
                                                        <a href="{{ $media->file_url }}" class="text-success" download
                                                            title="Download">
                                                            <i class="lni lni-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if ($item->mediaFiles->count() > 2)
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">
                                                        <i class="lni lni-more-alt me-1"></i>
                                                        dan {{ $item->mediaFiles->count() - 2 }} berkas lainnya
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-2 bg-light rounded">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i> Belum ada berkas
                                            </small>
                                        </div>
                                    @endif
                                </div>

                                {{-- Catatan --}}
                                @if ($item->catatan)
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center text-muted mb-1">
                                            <i class="lni lni-notepad me-2"></i>
                                            <small>Catatan</small>
                                        </div>
                                        <p class="mb-0 small text-truncate" style="max-height: 40px; overflow: hidden;"
                                            title="{{ $item->catatan }}">
                                            {{ $item->catatan }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Timestamps --}}
                                <div class="border-top pt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Dibuat</small>
                                            <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Diperbarui</small>
                                            <small>{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- FOOTER - ACTION BUTTONS --}}
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <div class="d-flex justify-content-between">

                                    {{-- TOMBOL DETAIL --}}
                                    <a href="{{ route('permohonan_surat.show', $item->permohonan_id) }}"
                                        class="btn btn-sm btn-outline-info">
                                        <i class="lni lni-eye me-1"></i> Detail
                                    </a>

                                    {{-- TOMBOL EDIT & DELETE: Cek authorization --}}
                                    @if(Auth::user()->isAdmin() || (Auth::user()->isWarga() && Auth::user()->canAccessPermohonan($item->permohonan_id)))
                                        {{-- TOMBOL EDIT --}}
                                        <a href="{{ route('permohonan_surat.edit', $item->permohonan_id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="lni lni-pencil-alt me-1"></i> Edit
                                        </a>

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('permohonan_surat.destroy', $item->permohonan_id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus permohonan ini? Semua berkas terkait juga akan dihapus.')">
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
                            <i class="lni lni-files text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">
                                @if(Auth::user()->isAdmin())
                                    Belum ada permohonan surat
                                @else
                                    Anda belum memiliki permohonan surat
                                @endif
                            </h5>
                            <p class="text-muted">
                                @if(Auth::user()->isAdmin())
                                    Silakan tambah permohonan surat baru untuk memulai
                                @elseif(Auth::user()->isWarga() && Auth::user()->hasWargaData())
                                    Silakan ajukan permohonan surat pertama Anda
                                @else
                                    Silakan lengkapi data pribadi terlebih dahulu
                                @endif
                            </p>
                            @if(Auth::user()->isAdmin() || (Auth::user()->isWarga() && Auth::user()->hasWargaData()))
                                <a href="{{ route('permohonan_surat.create') }}" class="btn btn-primary mt-2">
                                    <i class="lni lni-plus"></i>
                                    @if(Auth::user()->isAdmin())
                                        Tambah Permohonan Pertama
                                    @else
                                        Ajukan Permohonan
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if ($data->hasPages())
                <div class="mt-5">
                    {{ $data->links('pagination::bootstrap-5') }}
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

        .input-group .btn {
            white-space: nowrap;
        }

        .card {
            transition: transform 0.2s ease-in-out;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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

        .file-item {
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .file-item:hover {
            background-color: #f8f9fa !important;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .statistics-card .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .statistics-card .rounded-circle {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .border-start {
            border-left-width: 4px !important;
        }

        .btn-outline-info {
            color: #0dcaf0;
            border-color: #0dcaf0;
        }

        .btn-outline-info:hover {
            background-color: #0dcaf0;
            color: white;
        }

        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto reset search jika input kosong
            const searchInput = document.querySelector('input[name="search"]');
            const searchForm = document.querySelector('form');

            if (searchInput && searchForm) {
                searchInput.addEventListener('input', function() {
                    if (this.value === '') {
                        // Hapus parameter search dari URL tanpa reload
                        const url = new URL(window.location);
                        url.searchParams.delete('search');
                        window.history.replaceState({}, '', url);
                    }
                });
            }

            // Konfirmasi sebelum hapus
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm(
                            'Apakah Anda yakin ingin menghapus permohonan ini? Semua berkas terkait juga akan dihapus.'
                            )) {
                        e.preventDefault();
                    }
                });
            });

            // Quick filter status
            const statusBadges = document.querySelectorAll('.badge');
            statusBadges.forEach(badge => {
                badge.style.cursor = 'pointer';
                badge.addEventListener('click', function() {
                    const status = this.textContent.toLowerCase();
                    const url = new URL(window.location);
                    url.searchParams.set('status', status);
                    window.location.href = url.toString();
                });
            });

            console.log('Permohonan surat index page loaded');
        });
    </script>
@endsection
