{{-- resources/views/pages/berkas_persyaratan/show.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section class="berkas-persyaratan-show" style="padding-top: 120px; min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm position-relative"
                        style="z-index: 10;">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('berkas_persyaratan.index', ['permohonan_id' => $berkas->permohonan_id]) }}"
                                            class="text-decoration-none">
                                            <i class="lni lni-folder me-1"></i> Berkas Persyaratan
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Detail Berkas
                                    </li>
                                </ol>
                            </nav>
                            <h3 class="mb-0 text-primary">
                                <i class="lni lni-eye me-2"></i>
                                Detail Berkas Persyaratan
                            </h3>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('berkas_persyaratan.index', ['permohonan_id' => $berkas->permohonan_id]) }}"
                                class="btn btn-outline-secondary px-3 py-2">
                                <i class="lni lni-arrow-left me-2"></i> Kembali
                            </a>
                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                <a href="{{ route('berkas_persyaratan.edit', $berkas->berkas_id) }}"
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
                                    <i class="lni lni-folder me-2"></i>
                                    {{ $berkas->nama_berkas == 'Lainnya' ? $berkas->nama_berkas_custom ?? 'Lainnya' : $berkas->nama_berkas }}
                                </h5>
                                <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                    ID: #{{ str_pad($berkas->berkas_id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- Status Badge --}}
                            <div class="mb-4">
                                <span
                                    class="badge
                                @if ($berkas->valid == 'valid') bg-success
                                @elseif($berkas->valid == 'tidak_valid') bg-danger
                                @else bg-warning text-dark @endif fs-6 p-3">
                                    <i class="lni lni-checkmark-circle me-1"></i>
                                    Status: {{ ucfirst(str_replace('_', ' ', $berkas->valid)) }}
                                </span>
                            </div>

                            <div class="row">
                                {{-- Kolom Kiri: Info Berkas --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="card-title border-bottom pb-2 mb-3">
                                                <i class="lni lni-file me-2"></i> Informasi Berkas
                                            </h6>

                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Nama Berkas</small>
                                                    <p class="mb-0 fw-semibold">
                                                        {{ $berkas->nama_berkas == 'Lainnya' ? 'Berkas Kustom' : $berkas->nama_berkas }}
                                                    </p>
                                                </div>

                                                @if ($berkas->nama_berkas == 'Lainnya' && $berkas->nama_berkas_custom)
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Nama Kustom</small>
                                                        <p class="mb-0 fw-semibold">{{ $berkas->nama_berkas_custom }}</p>
                                                    </div>
                                                @endif

                                                <div class="col-6">
                                                    <small class="text-muted d-block">Dibuat</small>
                                                    <p class="mb-0">
                                                        {{ \Carbon\Carbon::parse($berkas->created_at)->format('d F Y H:i') }}
                                                    </p>
                                                </div>

                                                <div class="col-6">
                                                    <small class="text-muted d-block">Diperbarui</small>
                                                    <p class="mb-0">
                                                        {{ \Carbon\Carbon::parse($berkas->updated_at)->format('d F Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Kanan: Info Permohonan --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="card-title border-bottom pb-2 mb-3">
                                                <i class="lni lni-notepad me-2"></i> Informasi Permohonan
                                            </h6>

                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <small class="text-muted d-block">No. Permohonan</small>
                                                    <p class="mb-0 fw-semibold">
                                                        #{{ $berkas->permohonan->nomor_permohonan }}</p>
                                                </div>

                                                <div class="col-6">
                                                    <small class="text-muted d-block">Pemohon</small>
                                                    <p class="mb-0 fw-semibold">{{ $berkas->permohonan->warga->nama }}</p>
                                                </div>

                                                <div class="col-6">
                                                    <small class="text-muted d-block">Jenis Surat</small>
                                                    <p class="mb-0">
                                                        {{ $berkas->permohonan->jenisSurat->nama_jenis ?? '-' }}</p>
                                                </div>

                                                <div class="col-6">
                                                    <small class="text-muted d-block">Alamat</small>
                                                    <p class="mb-0">{{ $berkas->permohonan->warga->alamat ?? '-' }}</p>
                                                </div>

                                                <div class="col-12">
                                                    <small class="text-muted d-block">No. Telepon</small>
                                                    <p class="mb-0">{{ $berkas->permohonan->warga->no_telepon ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- File Upload Section --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-info text-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="lni lni-files me-2"></i>
                                    File Berkas ({{ $mediaFiles->count() }})
                                </h5>

                                @if ($mediaFiles->count() > 0)
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="lni lni-download me-1"></i> Download
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#" id="downloadAllBtn">
                                                    <i class="lni lni-download me-2"></i> Download Semua
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            @foreach ($mediaFiles as $media)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('berkas_persyaratan.download', $media->media_id) }}">
                                                        <i class="lni lni-file me-2"></i>
                                                        {{ $media->file_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($mediaFiles->count() > 0)
                                <div class="row g-4">
                                    @foreach ($mediaFiles as $media)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="file-card border rounded p-3 h-100 position-relative bg-white">
                                                {{-- File Icon & Info --}}
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="file-icon-wrapper
                                                @if (str_contains($media->mime_type, 'image/')) image
                                                @elseif($media->mime_type == 'application/pdf') pdf
                                                @else other @endif me-3">
                                                        <i
                                                            class="
                                                    @if (str_contains($media->mime_type, 'image/')) lni lni-image
                                                    @elseif($media->mime_type == 'application/pdf') lni lni-empty-file
                                                    @else lni lni-file @endif">
                                                        </i>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1" title="{{ $media->file_name }}">
                                                            {{ strlen($media->file_name) > 20 ? substr($media->file_name, 0, 17) . '...' : $media->file_name }}
                                                        </h6>

                                                        <small class="text-muted d-block">{{ $media->mime_type }}</small>
                                                        <small class="text-muted">
                                                            {{ \Carbon\Carbon::parse($media->created_at)->format('d/m/Y H:i') }}
                                                        </small>

                                                        @if ($media->caption)
                                                            <div class="mt-2 bg-light p-2 rounded">
                                                                <small class="text-muted">Caption:</small>
                                                                <p class="mb-0 small">{{ $media->caption }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- Action Buttons --}}
                                                <div class="d-flex flex-wrap gap-2 mt-3">
                                                    @if (str_contains($media->mime_type, 'image/') || $media->mime_type == 'application/pdf')
                                                        <button type="button"
                                                            class="btn btn-outline-primary btn-sm preview-file-btn"
                                                            data-url="{{ asset('storage/uploads/berkas_persyaratan/' . $media->file_name) }}"
                                                            data-filename="{{ $media->file_name }}"
                                                            data-mimetype="{{ $media->mime_type }}">
                                                            <i class="lni lni-eye me-1"></i> Preview
                                                        </button>
                                                    @endif

                                                    <a href="{{ route('berkas_persyaratan.download', $media->media_id) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="lni lni-download me-1"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="lni lni-empty-file display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada file yang diupload</h5>
                                    <p class="text-muted mb-4">Silahkan tambahkan file melalui menu edit</p>
                                    <a href="{{ route('berkas_persyaratan.edit', $berkas->berkas_id) }}"
                                        class="btn btn-primary px-4 py-2">
                                        <i class="lni lni-plus me-2"></i> Tambah File
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for File Preview -->
    <div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalTitle">
                        <i class="lni lni-eye me-2"></i> Preview File
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" id="previewModalBody">
                    <!-- Preview content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-success" id="downloadPreviewBtn">
                        <i class="lni lni-download me-1"></i> Download
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="lni lni-close me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* PERBAIKAN UTAMA UNTUK TOMBOL */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0.5rem;
        }

        /* Pastikan tombol bisa diklik */
        .btn {
            cursor: pointer !important;
            position: relative;
            z-index: 5 !important;
            pointer-events: auto !important;
        }

        /* Pastikan header tidak menutup tombol */
        .position-relative {
            z-index: 10;
        }

        .file-card {
            transition: all 0.3s ease;
            background: white;
        }

        .file-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-color: #3498db;
        }

        .file-icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .file-icon-wrapper.pdf {
            background: #ff6b6b;
            color: white;
        }

        .file-icon-wrapper.image {
            background: #4ecdc4;
            color: white;
        }

        .file-icon-wrapper.other {
            background: #95a5a6;
            color: white;
        }

        /* Preview Modal Styles */
        #filePreviewModal .modal-body {
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
        }

        .preview-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .btn-file-action {
            padding: 4px 10px;
            font-size: 12px;
        }

        /* CSS untuk debug - bisa dihapus setelah fix */
        .debug-border {
            border: 1px solid red !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Show page loaded');

            // Debug: Cek apakah tombol ada dan bisa diklik
            const backBtn = document.querySelector('a[href*="berkas_persyaratan.index"]');
            const editBtn = document.querySelector('a[href*="berkas_persyaratan.edit"]');

            console.log('Back button exists:', !!backBtn);
            console.log('Edit button exists:', !!editBtn);

            // Tambahkan event listener untuk debug
            if (backBtn) {
                backBtn.addEventListener('click', function(e) {
                    console.log('Back button clicked');
                });
            }

            if (editBtn) {
                editBtn.addEventListener('click', function(e) {
                    console.log('Edit button clicked');
                });
            }

            const previewModal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
            const previewModalTitle = document.getElementById('previewModalTitle');
            const previewModalBody = document.getElementById('previewModalBody');
            const downloadPreviewBtn = document.getElementById('downloadPreviewBtn');

            // Preview file
            document.querySelectorAll('.preview-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fileUrl = this.getAttribute('data-url');
                    const fileName = this.getAttribute('data-filename');
                    const mimeType = this.getAttribute('data-mimetype');

                    // Set modal title
                    previewModalTitle.innerHTML =
                        `<i class="lni lni-eye me-2"></i> Preview: ${fileName}`;

                    // Set download button
                    downloadPreviewBtn.href = fileUrl;
                    downloadPreviewBtn.download = fileName;

                    if (mimeType.startsWith('image/')) {
                        // Preview gambar
                        previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <img src="${fileUrl}" class="preview-image" alt="${fileName}"
                             onerror="this.onerror=null; this.src='#'; showImageError()">
                    </div>
                `;
                    } else if (mimeType === 'application/pdf') {
                        // Preview PDF
                        previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <div class="text-center py-4">
                            <div class="mb-4">
                                <i class="lni lni-empty-file display-1 text-primary"></i>
                            </div>
                            <h4>${fileName}</h4>
                            <p class="text-muted mb-3">File PDF</p>
                            <div class="alert alert-info mb-4">
                                <i class="lni lni-info-circle me-2"></i>
                                Pilih cara untuk melihat file PDF:
                            </div>
                            <div class="d-grid gap-3">
                                <button class="btn btn-success btn-lg" id="openPdfBtn">
                                    <i class="lni lni-external-link me-2"></i>
                                    <strong>Buka PDF di Tab Baru</strong>
                                </button>
                                <a href="${fileUrl}" class="btn btn-outline-primary" download="${fileName}">
                                    <i class="lni lni-download me-2"></i>
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                        // Attach event untuk tombol buka PDF
                        document.getElementById('openPdfBtn').addEventListener('click', function() {
                            window.open(fileUrl, '_blank');
                        });
                    } else {
                        // File lain
                        previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <div class="text-center py-4">
                            <i class="lni lni-file display-1 text-muted mb-3"></i>
                            <h4>${fileName}</h4>
                            <p class="text-muted mb-3">${mimeType}</p>
                            <div class="alert alert-info mb-4">
                                <i class="lni lni-info-circle me-2"></i>
                                File ini tidak dapat dipreview langsung di browser.
                            </div>
                            <a href="${fileUrl}" class="btn btn-primary" download="${fileName}">
                                <i class="lni lni-download me-1"></i> Download File
                            </a>
                        </div>
                    </div>
                `;
                    }

                    previewModal.show();
                });
            });

            // Download all files button
            const downloadAllBtn = document.getElementById('downloadAllBtn');
            if (downloadAllBtn) {
                downloadAllBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert(
                        'Fitur download semua file akan mengunduh file dalam format ZIP. Fitur ini membutuhkan konfigurasi tambahan di server.');
                });
            }

            // Function untuk handle error gambar
            window.showImageError = function() {
                const imgElement = document.querySelector('.preview-image');
                if (imgElement) {
                    imgElement.parentElement.innerHTML = `
                <div class="text-center py-4">
                    <i class="lni lni-warning display-1 text-danger mb-3"></i>
                    <h4>Gagal Memuat Gambar</h4>
                    <p class="text-muted mb-4">
                        Tidak dapat memuat gambar. File mungkin rusak atau format tidak didukung.
                    </p>
                </div>
            `;
                }
            };
        });
    </script>
@endsection
