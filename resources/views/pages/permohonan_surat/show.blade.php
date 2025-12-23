{{-- resources/views/pages/permohonan_surat/show.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="permohonan-surat-show" style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm position-relative" style="z-index: 10;">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('permohonan_surat.index') }}" class="text-decoration-none">
                                        <i class="lni lni-folder me-1"></i> Permohonan Surat
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Permohonan Surat
                                </li>
                            </ol>
                        </nav>
                        <h3 class="mb-0 text-primary">
                            <i class="lni lni-eye me-2"></i>
                            Detail Permohonan Surat
                        </h3>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('permohonan_surat.index') }}"
                           class="btn btn-outline-secondary px-3 py-2">
                            <i class="lni lni-arrow-left me-2"></i> Kembali
                        </a>
                        @if (Auth::check() && Auth::user()->role === 'Admin')
                        <a href="{{ route('permohonan_surat.edit', $data->permohonan_id) }}"
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
                                Permohonan: #{{ $data->nomor_permohonan }}
                            </h5>
                            <span class="badge
                                @if($data->status == 'diajukan') bg-warning text-dark
                                @elseif($data->status == 'diproses') bg-info
                                @elseif($data->status == 'selesai') bg-success
                                @else bg-danger @endif
                                fs-6 px-3 py-2">
                                {{ ucfirst($data->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Kolom Kiri: Info Permohonan --}}
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-notepad me-2"></i> Informasi Permohonan
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">No. Permohonan</small>
                                                <p class="mb-0 fw-semibold">{{ $data->nomor_permohonan }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Status</small>
                                                <p class="mb-0 fw-semibold text-capitalize">{{ $data->status }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Pemohon</small>
                                                <p class="mb-0 fw-semibold">{{ $data->warga->nama }}</p>
                                                <small class="text-muted">{{ $data->warga->no_ktp }}</small>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Jenis Surat</small>
                                                <p class="mb-0 fw-semibold">{{ $data->jenisSurat->nama_jenis }}</p>
                                                <small class="text-muted">({{ $data->jenisSurat->kode }})</small>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Tanggal Pengajuan</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d F Y') }}
                                                </p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Dibuat</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Catatan --}}
                                        @if($data->catatan)
                                            <div class="mt-4 pt-3 border-top">
                                                <small class="text-muted d-block mb-2">
                                                    <i class="lni lni-notepad me-1"></i> Catatan
                                                </small>
                                                <div class="bg-white p-3 rounded border">
                                                    <p class="mb-0">{{ $data->catatan }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Informasi Warga --}}
                            <div class="col-md-6 mb-4">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-user me-2"></i> Informasi Pemohon
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Nama Lengkap</small>
                                                <p class="mb-0 fw-semibold">{{ $data->warga->nama }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">No. KTP</small>
                                                <p class="mb-0">{{ $data->warga->no_ktp }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Jenis Kelamin</small>
                                                <p class="mb-0">{{ $data->warga->jenis_kelamin ?? '-' }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">No. Telepon</small>
                                                <p class="mb-0">{{ $data->warga->no_telepon ?? '-' }}</p>
                                            </div>

                                            <div class="col-12">
                                                <small class="text-muted d-block">Alamat</small>
                                                <p class="mb-0">{{ $data->warga->alamat ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Syarat Section --}}
                        @if($data->berkasPersyaratan && $data->berkasPersyaratan->count() > 0)
                            <div class="card border-0 bg-light mb-4">
                                <div class="card-body">
                                    <h6 class="card-title border-bottom pb-2 mb-3">
                                        <i class="lni lni-list me-2"></i> Syarat-Syarat yang Diperlukan
                                        <span class="badge bg-primary ms-2">{{ $data->berkasPersyaratan->count() }}</span>
                                    </h6>

                                    <div class="row g-3">
                                        @foreach($data->berkasPersyaratan as $index => $berkas)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="d-flex align-items-start p-3 bg-white rounded border">
                                                    <span class="badge
                                                        @if($berkas->valid == 'valid') bg-success
                                                        @elseif($berkas->valid == 'tidak_valid') bg-danger
                                                        @else bg-warning text-dark @endif
                                                        rounded-circle me-3"
                                                        style="width: 32px; height: 32px; line-height: 32px;">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-1 fw-medium">{{ $berkas->nama_berkas }}</p>
                                                        <small class="text-muted">Status:
                                                            <span class="badge
                                                                @if($berkas->valid == 'valid') bg-success
                                                                @elseif($berkas->valid == 'tidak_valid') bg-danger
                                                                @else bg-warning text-dark @endif">
                                                                {{ $berkas->valid }}
                                                            </span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Riwayat Status Section --}}
                        @if($data->riwayatStatus && $data->riwayatStatus->count() > 0)
                            <div class="card border-0 bg-light mb-4">
                                <div class="card-body">
                                    <h6 class="card-title border-bottom pb-2 mb-3">
                                        <i class="lni lni-history me-2"></i> Riwayat Status
                                        <span class="badge bg-info ms-2">{{ $data->riwayatStatus->count() }}</span>
                                    </h6>

                                    <div class="timeline">
                                        @foreach($data->riwayatStatus as $riwayat)
                                            <div class="timeline-item mb-3">
                                                <div class="d-flex">
                                                    <div class="timeline-marker
                                                        @if($riwayat->status == 'selesai') bg-success
                                                        @elseif($riwayat->status == 'diproses') bg-info
                                                        @elseif($riwayat->status == 'ditolak') bg-danger
                                                        @else bg-warning @endif">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-1 text-capitalize">{{ $riwayat->status }}</h6>
                                                            <small class="text-muted">
                                                                {{ \Carbon\Carbon::parse($riwayat->waktu)->format('d M Y H:i') }}
                                                            </small>
                                                        </div>
                                                        @if($riwayat->keterangan)
                                                            <p class="mb-1 small">{{ $riwayat->keterangan }}</p>
                                                        @endif
                                                        @if($riwayat->petugas)
                                                            <small class="text-muted">
                                                                Petugas: {{ $riwayat->petugas->nama }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Berkas Pendukung Section --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-info text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="lni lni-files me-2"></i>
                                Berkas Pendukung ({{ $data->mediaFiles->count() ?? 0 }})
                            </h5>

                            @if(($data->mediaFiles->count() ?? 0) > 0)
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
                                    @foreach($data->mediaFiles ?? [] as $berkas)
                                    <li>
                                        <a class="dropdown-item" href="{{ $berkas->file_url }}" download="{{ $berkas->file_name }}">
                                            <i class="lni lni-file me-2"></i>
                                            {{ $berkas->file_name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        @if(($data->mediaFiles->count() ?? 0) > 0)
                            <div class="row g-4">
                                @foreach($data->mediaFiles ?? [] as $berkas)
                                <div class="col-md-6 col-lg-4">
                                    <div class="file-card border rounded p-3 h-100 position-relative bg-white">
                                        {{-- File Icon & Info --}}
                                        <div class="d-flex align-items-start">
                                            <div class="file-icon-wrapper
                                                @if(str_contains($berkas->mime_type, 'image/')) image
                                                @elseif($berkas->mime_type == 'application/pdf') pdf
                                                @elseif(str_contains($berkas->mime_type, 'word') || str_contains($berkas->mime_type, 'document')) word
                                                @else other @endif me-3">
                                                <i class="
                                                    @if(str_contains($berkas->mime_type, 'image/')) lni lni-image
                                                    @elseif($berkas->mime_type == 'application/pdf') lni lni-empty-file
                                                    @elseif(str_contains($berkas->mime_type, 'word') || str_contains($berkas->mime_type, 'document')) lni lni-files
                                                    @else lni lni-file @endif">
                                                </i>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" title="{{ $berkas->file_name }}">
                                                    {{ strlen($berkas->file_name) > 20 ? substr($berkas->file_name, 0, 17) . '...' : $berkas->file_name }}
                                                </h6>

                                                <small class="text-muted d-block">{{ $berkas->mime_type }}</small>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($berkas->created_at)->format('d/m/Y H:i') }}
                                                </small>

                                                @if($berkas->caption)
                                                <div class="mt-2 bg-light p-2 rounded">
                                                    <small class="text-muted">Caption:</small>
                                                    <p class="mb-0 small">{{ $berkas->caption }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            @if(str_contains($berkas->mime_type, 'image/') || $berkas->mime_type == 'application/pdf')
                                            <button type="button"
                                                    class="btn btn-outline-primary btn-sm preview-file-btn"
                                                    data-url="{{ $berkas->file_url }}"
                                                    data-filename="{{ $berkas->file_name }}"
                                                    data-mimetype="{{ $berkas->mime_type }}">
                                                <i class="lni lni-eye me-1"></i> Preview
                                            </button>
                                            @endif

                                            <a href="{{ $berkas->file_url }}"
                                               class="btn btn-outline-success btn-sm"
                                               download="{{ $berkas->file_name }}">
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
                                <h5 class="text-muted">Belum ada berkas pendukung yang diupload</h5>
                                <p class="text-muted mb-4">Silahkan edit untuk menambahkan berkas pendukung</p>
                                <a href="{{ route('permohonan_surat.edit', $data->permohonan_id) }}"
                                   class="btn btn-primary px-4 py-2">
                                    <i class="lni lni-plus me-2"></i> Tambah Berkas
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
                    <i class="lni lni-eye me-2"></i> Preview Berkas
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

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 20px;
    }

    .timeline-item {
        position: relative;
    }

    .timeline-marker {
        position: absolute;
        left: -20px;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 3px #dee2e6;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 12px;
        bottom: -20px;
        width: 2px;
        background: #dee2e6;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Show page loaded for Permohonan Surat');

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
            previewModalTitle.innerHTML = `<i class="lni lni-eye me-2"></i> Preview: ${fileName}`;

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
            alert('Fitur download semua file akan mengunduh berkas dalam format ZIP. Fitur ini membutuhkan konfigurasi tambahan di server.');
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
