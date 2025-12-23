{{-- resources/views/pages/jenis_surat/show.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="jenis-surat-show" style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm position-relative" style="z-index: 10;">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('jenis_surat.index') }}" class="text-decoration-none">
                                        <i class="lni lni-folder me-1"></i> Jenis Surat
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Jenis Surat
                                </li>
                            </ol>
                        </nav>
                        <h3 class="mb-0 text-primary">
                            <i class="lni lni-eye me-2"></i>
                            Detail Jenis Surat
                        </h3>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('jenis_surat.index') }}"
                           class="btn btn-outline-secondary px-3 py-2">
                            <i class="lni lni-arrow-left me-2"></i> Kembali
                        </a>
                        @if (Auth::check() && Auth::user()->role === 'Admin')
                        <a href="{{ route('jenis_surat.edit', $jenisSurat->jenis_id) }}"
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
                                <i class="lni lni-file me-2"></i>
                                {{ $jenisSurat->nama_jenis }}
                            </h5>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                Kode: {{ $jenisSurat->kode }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Kolom Kiri: Info Dasar --}}
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-notepad me-2"></i> Informasi Jenis Surat
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Kode Surat</small>
                                                <p class="mb-0 fw-semibold text-uppercase">{{ $jenisSurat->kode }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Nama Lengkap</small>
                                                <p class="mb-0 fw-semibold">{{ $jenisSurat->nama_jenis }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Dibuat</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($jenisSurat->created_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Diperbarui</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($jenisSurat->updated_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Statistik --}}
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-stats-up me-2"></i> Statistik
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="text-center p-3 bg-white rounded border">
                                                    <i class="lni lni-layers display-6 text-primary mb-2"></i>
                                                    <h4 class="mb-1 fw-bold">{{ $totalPermohonan ?? 0 }}</h4>
                                                    <small class="text-muted">Total Permohonan</small>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="text-center p-3 bg-white rounded border">
                                                    <i class="lni lni-checkmark-circle display-6 text-success mb-2"></i>
                                                    <h4 class="mb-1 fw-bold">{{ $permohonanSelesai ?? 0 }}</h4>
                                                    <small class="text-muted">Selesai</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Syarat Section --}}
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h6 class="card-title border-bottom pb-2 mb-3">
                                    <i class="lni lni-list me-2"></i> Syarat-Syarat
                                </h6>

                                @php
                                    $syaratArray = $jenisSurat->syarat_json ?? [];
                                    if (is_string($syaratArray)) {
                                        $syaratArray = json_decode($syaratArray, true) ?? [];
                                    }
                                    $syaratArray = is_array($syaratArray) ? $syaratArray : [];
                                @endphp

                                @if(count($syaratArray) > 0)
                                    <div class="row g-3">
                                        @foreach($syaratArray as $index => $syarat)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="d-flex align-items-start p-3 bg-white rounded border">
                                                    <span class="badge bg-primary rounded-circle me-3" style="width: 32px; height: 32px; line-height: 32px;">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                    <div>
                                                        <p class="mb-0 fw-medium">{{ $syarat }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="lni lni-empty-file display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada syarat yang ditambahkan</h5>
                                        <p class="text-muted mb-0">Silahkan edit untuk menambahkan syarat</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- File Template Section --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-info text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="lni lni-files me-2"></i>
                                File Template/Contoh ({{ $templateFiles->count() ?? 0 }})
                            </h5>

                            @if(($templateFiles->count() ?? 0) > 0)
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
                                    <li><hr class="dropdown-divider"></li>
                                    @foreach($templateFiles ?? [] as $template)
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route('jenis_surat.download_template', $template->media_id) }}">
                                            <i class="lni lni-file me-2"></i>
                                            {{ $template->file_name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        @if(($templateFiles->count() ?? 0) > 0)
                            <div class="row g-4">
                                @foreach($templateFiles ?? [] as $template)
                                <div class="col-md-6 col-lg-4">
                                    <div class="file-card border rounded p-3 h-100 position-relative bg-white">
                                        {{-- File Icon & Info --}}
                                        <div class="d-flex align-items-start">
                                            <div class="file-icon-wrapper
                                                @if(str_contains($template->mime_type, 'image/')) image
                                                @elseif($template->mime_type == 'application/pdf') pdf
                                                @elseif(str_contains($template->mime_type, 'word') || str_contains($template->mime_type, 'document')) word
                                                @else other @endif me-3">
                                                <i class="
                                                    @if(str_contains($template->mime_type, 'image/')) lni lni-image
                                                    @elseif($template->mime_type == 'application/pdf') lni lni-empty-file
                                                    @elseif(str_contains($template->mime_type, 'word') || str_contains($template->mime_type, 'document')) lni lni-files
                                                    @else lni lni-file @endif">
                                                </i>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" title="{{ $template->file_name }}">
                                                    {{ strlen($template->file_name) > 20 ? substr($template->file_name, 0, 17) . '...' : $template->file_name }}
                                                </h6>

                                                <small class="text-muted d-block">{{ $template->mime_type }}</small>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($template->created_at)->format('d/m/Y H:i') }}
                                                </small>

                                                @if($template->caption)
                                                <div class="mt-2 bg-light p-2 rounded">
                                                    <small class="text-muted">Caption:</small>
                                                    <p class="mb-0 small">{{ $template->caption }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            @if(str_contains($template->mime_type, 'image/') || $template->mime_type == 'application/pdf')
                                            <button type="button"
                                                    class="btn btn-outline-primary btn-sm preview-file-btn"
                                                    data-url="{{ Storage::url('uploads/jenis_surat/' . $template->file_name) }}"
                                                    data-filename="{{ $template->file_name }}"
                                                    data-mimetype="{{ $template->mime_type }}">
                                                <i class="lni lni-eye me-1"></i> Preview
                                            </button>
                                            @endif

                                            <a href="{{ route('jenis_surat.download_template', $template->media_id) }}"
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
                                <h5 class="text-muted">Belum ada file template yang diupload</h5>
                                <p class="text-muted mb-4">Silahkan edit untuk menambahkan file template</p>
                                <a href="{{ route('jenis_surat.edit', $jenisSurat->jenis_id) }}"
                                   class="btn btn-primary px-4 py-2">
                                    <i class="lni lni-plus me-2"></i> Tambah File Template
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
    .jenis-surat-show {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding-bottom: 60px;
    }

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
    }

    .position-relative {
        z-index: 10;
    }

    .file-card {
        transition: all 0.3s ease;
        background: white;
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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

    .file-icon-wrapper.word {
        background: #3498db;
        color: white;
    }

    .file-icon-wrapper.other {
        background: #95a5a6;
        color: white;
    }

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

    /* Perbaikan spacing untuk header */
    html {
        scroll-padding-top: 120px;
    }

    @media (max-width: 768px) {
        .jenis-surat-show {
            padding-top: 100px !important;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 10px;
        }

        .d-flex.gap-2 {
            flex-direction: column;
            width: 100%;
        }

        .d-flex.gap-2 .btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .jenis-surat-show {
            padding-top: 90px !important;
        }

        .col-md-6, .col-lg-4 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk adjust spacing
    function adjustHeaderSpacing() {
        const header = document.querySelector('header');
        const section = document.querySelector('.jenis-surat-show');

        if (header && section) {
            const headerHeight = header.offsetHeight;
            const newPaddingTop = headerHeight + 40; // 40px buffer
            section.style.paddingTop = newPaddingTop + 'px';

            // Update scroll padding
            document.documentElement.style.scrollPaddingTop = (headerHeight + 20) + 'px';
        }
    }

    // Initial adjustment
    adjustHeaderSpacing();

    // Adjust on resize dan load
    window.addEventListener('resize', adjustHeaderSpacing);
    window.addEventListener('load', adjustHeaderSpacing);

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

            previewModalTitle.innerHTML = `<i class="lni lni-eye me-2"></i> Preview: ${fileName}`;
            downloadPreviewBtn.href = fileUrl;
            downloadPreviewBtn.download = fileName;

            if (mimeType.startsWith('image/')) {
                previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <img src="${fileUrl}" class="preview-image" alt="${fileName}"
                             onerror="this.onerror=null; this.src='#'; showImageError()">
                    </div>
                `;
            } else if (mimeType === 'application/pdf') {
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
                                <a href="${fileUrl}" target="_blank" class="btn btn-success btn-lg">
                                    <i class="lni lni-external-link me-2"></i>
                                    <strong>Buka PDF di Tab Baru</strong>
                                </a>
                                <a href="${fileUrl}" class="btn btn-outline-primary" download="${fileName}">
                                    <i class="lni lni-download me-2"></i>
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            } else {
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
            alert('Fitur download semua file akan mengunduh file dalam format ZIP. Fitur ini membutuhkan konfigurasi tambahan di server.');
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
