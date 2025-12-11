{{-- resources/views/pages/jenis_surat/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section class="jenis-surat-section py-5">
        <div class="container">
            {{-- HEADER --}}
            <div class="row mb-4 align-items-center" style="margin-top: 30px;">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="mb-2" style="margin-bottom: 20px !important;">
                        <i class="lni lni-files me-2"></i> Jenis Surat
                    </h3>
                    <p class="text-muted mb-0">Kelola jenis-jenis surat yang tersedia di sistem.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('jenis_surat.create') }}" class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah Jenis Surat
                    </a>
                </div>
            </div>

            {{-- FORM FILTER --}}
            <form method="GET" action="{{ route('jenis_surat.index') }}" class="mb-4">
                <div class="row align-items-center">
                    {{-- Filter Kode Surat --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-tag"></i>
                            <select class="form-select" name="kode">
                                <option value="">Semua Kode Surat</option>
                                @foreach ($kodeSurat as $kode)
                                    <option value="{{ $kode->kode }}"
                                        {{ request('kode') == $kode->kode ? 'selected' : '' }}>
                                        {{ $kode->kode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari nama jenis surat atau kode..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="lni lni-search-alt me-1"></i> Search
                            </button>
                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                    class="btn btn-outline-danger ms-2">
                                    <i class="lni lni-close me-1"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Reset --}}
                    <div class="col-md-3">
                        @if (request()->hasAny(['kode', 'search']))
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
                                        <i class="lni lni-key me-2"></i>
                                        <small>Kode Surat</small>
                                    </div>
                                    <p class="mb-0">
                                        <strong>{{ $item->kode }}</strong>
                                    </p>
                                </div>

                                {{-- Syarat --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-list me-2"></i>
                                        <small>Syarat</small>
                                    </div>
                                    @php
                                        // Karena sudah ada accessor di Model, syarat_json otomatis jadi array
                                        $syaratArray = $item->syarat_json ?? [];
                                        // Pastikan selalu array
                                        if (is_string($syaratArray)) {
                                            $syaratArray = json_decode($syaratArray, true) ?? [];
                                        }
                                        $syaratArray = is_array($syaratArray) ? $syaratArray : [];
                                    @endphp

                                    @if (count($syaratArray) > 0)
                                        <div class="syarat-list">
                                            @foreach ($syaratArray as $index => $syarat)
                                                @if ($index < 3)
                                                    {{-- Tampilkan maksimal 3 syarat --}}
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="lni lni-checkmark-circle text-success me-2"
                                                            style="font-size: 0.8rem;"></i>
                                                        <span class="small">{{ $syarat }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if (count($syaratArray) > 3)
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">
                                                        <i class="lni lni-more-alt me-1"></i>
                                                        dan {{ count($syaratArray) - 3 }} syarat lainnya
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-2 bg-light rounded">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i> Tidak ada syarat
                                            </small>
                                        </div>
                                    @endif
                                </div>

                                {{-- File Attachment Info --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between text-muted mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="lni lni-paperclip me-2"></i>
                                            <small>File Template/Contoh</small>
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
                                                            {{ $media->file_name }}
                                                        </small>
                                                        @if ($media->caption)
                                                            <small class="text-muted d-block"
                                                                title="Caption: {{ $media->caption }}">
                                                                {{ Str::limit($media->caption, 15) }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if ($item->mediaFiles->count() > 2)
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">
                                                        <i class="lni lni-more-alt me-1"></i>
                                                        dan {{ $item->mediaFiles->count() - 2 }} file lainnya
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-2 bg-light rounded">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i> Belum ada file template
                                            </small>
                                        </div>
                                    @endif
                                </div>

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
                                    {{-- TOMBOL DETAIL (MENGARAH KE SHOW PAGE) --}}
                                    <a href="{{ route('jenis_surat.show', $item->jenis_id) }}"
                                        class="btn btn-sm btn-outline-info">
                                        <i class="lni lni-eye me-1"></i> Detail
                                    </a>
                                    {{-- TOMBOL EDIT --}}
                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                        <a href="{{ route('jenis_surat.edit', $item->jenis_id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="lni lni-pencil-alt me-1"></i> Edit
                                        </a>

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('jenis_surat.destroy', $item->jenis_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus jenis surat ini?')">
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
            @if ($jenisSurat->hasPages())
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
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
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
        }

        .file-item:hover {
            background-color: #f8f9fa !important;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .syarat-list .lni-checkmark-circle {
            font-size: 0.8rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Jenis surat index page loaded');
        });
    </script>
@endsection
