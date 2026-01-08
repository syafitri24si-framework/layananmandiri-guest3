{{-- resources/views/pages/permohonan_surat/create.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section id="contact" class="contact-section contact-style-3">
    <div class="container">
        <!-- Page Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <div class="page-header mb-4">
                    <h1 class="page-title mb-3">
                        <i class="lni lni-envelope-add text-primary me-3"></i>
                        Buat Permohonan Surat
                    </h1>
                    <p class="page-subtitle text-muted">
                        Silahkan isi form berikut untuk mengajukan permohonan surat
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">

                        <!-- Alert Messages -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="lni lni-checkmark-circle me-3 fs-4"></i>
                                    <div class="flex-grow-1">
                                        {{ session('success') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="lni lni-warning me-3 fs-4"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="alert-heading mb-2">Terjadi kesalahan:</h6>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <!-- Form -->
                        <form action="{{ route('permohonan_surat.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            <div class="row g-4">

                                <!-- Row 1: Nomor Permohonan & Warga -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="lni lni-tag me-1 text-muted"></i>
                                            Nomor Permohonan <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" id="nomor_permohonan" name="nomor_permohonan"
                                                   class="form-control form-control-lg"
                                                   value="{{ old('nomor_permohonan', App\Models\PermohonanSurat::generateNomorPermohonan()) }}"
                                                   readonly>
                                        </div>
                                        <div class="form-text mt-2">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Nomor permohonan akan di-generate otomatis
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="lni lni-user me-1 text-muted"></i>
                                            Warga <span class="text-danger">*</span>
                                        </label>
                                        <select name="warga_id" class="form-select form-select-lg @error('warga_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Warga --</option>
                                            @foreach ($warga as $item)
                                                <option value="{{ $item->warga_id }}"
                                                    {{ old('warga_id') == $item->warga_id ? 'selected' : '' }}>
                                                    {{ $item->nama }} ({{ $item->no_ktp }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warga_id')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text mt-2">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Pilih warga yang mengajukan permohonan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Jenis Surat & Tanggal Pengajuan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="lni lni-envelope me-1 text-muted"></i>
                                            Jenis Surat <span class="text-danger">*</span>
                                        </label>
                                        <select name="jenis_id" id="jenis_id" class="form-select form-select-lg @error('jenis_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Jenis Surat --</option>
                                            @foreach ($jenisSurat as $js)
                                                <option value="{{ $js->jenis_id }}"
                                                    {{ old('jenis_id') == $js->jenis_id ? 'selected' : '' }}
                                                    data-syarat="{{ json_encode($js->syarat_json ?? []) }}">
                                                    {{ $js->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_id')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text mt-2">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Pilih jenis surat yang diajukan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="lni lni-calendar me-1 text-muted"></i>
                                            Tanggal Pengajuan <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan"
                                                   class="form-control form-control-lg @error('tanggal_pengajuan') is-invalid @enderror"
                                                   value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}" required>
                                        </div>
                                        @error('tanggal_pengajuan')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text mt-2">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Tanggal pengajuan permohonan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Status & Catatan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="lni lni-bolt me-1 text-muted"></i>
                                            Status <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" id="status" class="form-select form-select-lg @error('status') is-invalid @enderror" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                            <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text mt-2">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Status awal permohonan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="lni lni-pencil-alt me-1 text-muted"></i>
                                            Catatan <span class="text-muted fw-normal">(Opsional)</span>
                                        </label>
                                        <textarea name="catatan" id="catatan" rows="2"
                                                  class="form-control form-control-lg @error('catatan') is-invalid @enderror"
                                                  placeholder="Tambahkan catatan jika ada">{{ old('catatan') }}</textarea>
                                        @error('catatan')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text mt-2">
                                            <small class="text-muted">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Catatan tambahan untuk permohonan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Syarat yang Harus Dipenuhi -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-3">
                                            <i class="lni lni-list text-primary me-2"></i>
                                            Syarat yang Harus Dilampirkan
                                        </label>
                                        <div id="syaratContainer" class="syarat-checklist-container">
                                            <div class="alert alert-info m-0">
                                                <div class="d-flex align-items-center">
                                                    <i class="lni lni-info-circle me-3 fs-5"></i>
                                                    <div>Pilih jenis surat terlebih dahulu untuk melihat daftar syarat</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Berkas Pendukung -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold mb-3">
                                            <i class="lni lni-cloud-upload text-primary me-2"></i>
                                            Upload Berkas Pendukung
                                            <span class="text-danger">*</span>
                                        </label>

                                        <!-- Hidden File Input -->
                                        <input type="file" name="berkas_files[]" id="berkasFiles"
                                               class="d-none @error('berkas_files') is-invalid @enderror"
                                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                               multiple required>

                                        <!-- Upload Area -->
                                        <div class="file-upload-area border rounded-3 p-5 mb-4" id="uploadArea">
                                            <div class="text-center py-3">
                                                <div class="upload-icon mb-3">
                                                    <i class="lni lni-cloud-upload display-4 text-primary"></i>
                                                </div>
                                                <h5 class="mb-2 fw-semibold">Seret & Lepas Berkas di Sini</h5>
                                                <p class="text-muted mb-3">Atau klik untuk memilih berkas dari komputer</p>
                                                <button type="button" class="btn btn-outline-primary btn-lg px-4" id="browseBtn">
                                                    <i class="lni lni-folder me-1"></i> Browse Files
                                                </button>
                                                <div class="mt-3">
                                                    <small class="text-muted">
                                                        <i class="lni lni-info-circle me-1"></i>
                                                        Format yang didukung: PDF, JPG, PNG, DOC, DOCX | Maks: 5MB per file
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        @error('berkas_files')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @error('berkas_files.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                        <!-- File Preview Container -->
                                        <div id="filePreviewContainer" class="mt-4" style="display: none;">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0 fw-semibold">
                                                    <i class="lni lni-files me-2"></i> Berkas yang Dipilih
                                                    <span class="badge bg-primary ms-2" id="fileCount">0</span>
                                                </h6>
                                                <button type="button" class="btn btn-outline-danger btn-sm" id="clearAllBtn">
                                                    <i class="lni lni-trash-can me-1"></i> Hapus Semua
                                                </button>
                                            </div>
                                            <div id="fileList" class="row g-3">
                                                <!-- File previews will be inserted here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
                                        <a href="{{ route('permohonan_surat.index') }}" class="btn btn-outline-danger px-4 py-3 btn-lg">
                                            <i class="lni lni-cross-circle me-2"></i> Batal
                                        </a>
                                        <button type="submit" class="btn btn-success px-4 py-3 btn-lg" id="submitBtn">
                                            <i class="lni lni-telegram-original me-2"></i> Ajukan Permohonan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                <h5 class="modal-title fw-semibold" id="previewModalTitle">
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
    /* GLOBAL STYLING */
    * {
        box-sizing: border-box;
    }

    /* Page Header */
    .page-header {
        padding: 1rem 0;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Card Styling */
    .card {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 3rem !important;
    }

    /* Form Group Styling */
    .form-group {
        margin-bottom: 2rem;
    }

    /* Form Label Styling */
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 12px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        padding-left: 5px;
    }

    .form-label i {
        margin-right: 10px;
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
    }

    /* Input Styling - SEMUA SAMA UKURAN */
    .form-control,
    .form-select {
        width: 100%;
        padding: 16px 20px;
        font-size: 1rem;
        border: 2px solid #e1e5eb;
        border-radius: 12px;
        background-color: #fff;
        transition: all 0.3s ease;
        height: 56px;
        font-weight: 500;
    }

    .form-control-lg,
    .form-select-lg {
        padding: 18px 22px;
        font-size: 1.05rem;
        height: 58px;
    }

    /* Textarea Styling */
    textarea.form-control {
        height: auto;
        min-height: 58px;
        resize: vertical;
        line-height: 1.6;
        padding-top: 16px;
        padding-bottom: 16px;
    }

    /* Focus State */
    .form-control:focus,
    .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        outline: none;
        background-color: #fff;
    }

    /* Readonly Field */
    .form-control[readonly] {
        background-color: #f8fafc;
        border-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    /* Form Text Styling */
    .form-text {
        font-size: 0.9rem;
        margin-top: 10px;
        color: #6c757d;
        line-height: 1.5;
        padding-left: 5px;
    }

    .form-text i {
        margin-right: 8px;
        font-size: 0.95rem;
        opacity: 0.7;
    }

    /* Invalid Feedback */
    .invalid-feedback {
        font-size: 0.9rem;
        margin-top: 6px;
        padding-left: 5px;
    }

    /* Syarat Checklist Styles */
    .syarat-checklist-container {
        background-color: #f8fafc;
        border-radius: 15px;
        padding: 1.5rem;
        border: 2px solid #e9ecef;
    }

    .syarat-checklist {
        margin-top: 1.5rem;
    }

    .syarat-item {
        background-color: white;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .syarat-item:hover {
        border-color: #3498db;
        background-color: #f8fafc;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .syarat-item .form-check-input {
        width: 20px;
        height: 20px;
        margin-right: 12px;
        border: 2px solid #dee2e6;
    }

    .syarat-item .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }

    .syarat-item .form-check-label {
        font-weight: 500;
        color: #2c3e50;
        cursor: pointer;
        font-size: 1rem;
        flex: 1;
    }

    /* File Upload Styles */
    .file-upload-area {
        border: 3px dashed #3498db;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f8ff 100%);
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
    }

    .file-upload-area:hover {
        border-color: #2ecc71;
        background: linear-gradient(135deg, #f1f8ff 0%, #e8f5e9 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(46, 204, 113, 0.15);
    }

    .file-upload-area.drag-over {
        border-color: #2ecc71;
        background: linear-gradient(135deg, #e8f5e9 0%, #d4edda 100%);
        transform: scale(1.02);
        box-shadow: 0 15px 35px rgba(46, 204, 113, 0.2);
    }

    .upload-icon {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    /* File Card Styles */
    .file-card {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        padding: 20px;
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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

    .file-icon-wrapper.pdf { background: linear-gradient(135deg, #ff6b6b, #ff8e8e); }
    .file-icon-wrapper.image { background: linear-gradient(135deg, #4ecdc4, #6ae0d8); }
    .file-icon-wrapper.word { background: linear-gradient(135deg, #3498db, #5dade2); }
    .file-icon-wrapper.excel { background: linear-gradient(135deg, #2ecc71, #52d681); }
    .file-icon-wrapper.other { background: linear-gradient(135deg, #95a5a6, #b0bec5); }

    .remove-file-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 14px;
        opacity: 0.7;
        transition: all 0.3s;
        z-index: 10;
    }

    .file-card:hover .remove-file-btn {
        opacity: 1;
        transform: scale(1.1);
    }

    .btn-file-action {
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .caption-input {
        font-size: 0.9rem;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        width: 100%;
        margin-top: 10px;
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
        padding: 2rem;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* Button Styling */
    .btn {
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        font-size: 1rem;
    }

    .btn-lg {
        padding: 16px 32px;
        font-size: 1.05rem;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
    }

    /* Alert Styles */
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
    }

    /* Spinner Animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .spin {
        animation: spin 1s linear infinite;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .card-body {
            padding: 2rem !important;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .form-control,
        .form-select {
            padding: 14px 18px;
            height: 52px;
        }
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }

        .page-title {
            font-size: 1.6rem;
        }

        .form-control,
        .form-select {
            padding: 12px 16px;
            height: 50px;
            font-size: 0.95rem;
        }

        .btn {
            padding: 12px 20px;
            font-size: 0.95rem;
        }

        .file-upload-area {
            min-height: 180px;
            padding: 2rem !important;
        }

        .upload-icon i {
            font-size: 3rem;
        }

        .syarat-item {
            padding: 12px 16px;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1rem !important;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .d-flex.justify-content-end {
            flex-direction: column;
            gap: 1rem;
        }

        .d-flex.justify-content-end .btn {
            width: 100%;
        }

        .file-icon-wrapper {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .syarat-item .form-check-label {
            font-size: 0.95rem;
        }

        .page-title {
            font-size: 1.4rem;
        }

        .page-subtitle {
            font-size: 0.95rem;
        }
    }
</style>

<script>
    let uploadedFiles = [];

    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const jenisSuratSelect = document.getElementById('jenis_id');
        const syaratContainer = document.getElementById('syaratContainer');
        const fileInput = document.getElementById('berkasFiles');
        const uploadArea = document.getElementById('uploadArea');
        const browseBtn = document.getElementById('browseBtn');
        const fileList = document.getElementById('fileList');
        const filePreviewContainer = document.getElementById('filePreviewContainer');
        const fileCount = document.getElementById('fileCount');
        const clearAllBtn = document.getElementById('clearAllBtn');
        const previewModal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
        const previewModalTitle = document.getElementById('previewModalTitle');
        const previewModalBody = document.getElementById('previewModalBody');
        const downloadPreviewBtn = document.getElementById('downloadPreviewBtn');
        const uploadForm = document.getElementById('uploadForm');

        // Jenis Surat Change Handler
        if (jenisSuratSelect) {
            jenisSuratSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const syaratData = selectedOption.getAttribute('data-syarat');
                syaratContainer.innerHTML = '';

                if (syaratData) {
                    try {
                        const syaratList = JSON.parse(syaratData);
                        if (syaratList.length > 0) {
                            let syaratHtml = `
                                <div class="alert alert-success mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="lni lni-checkmark-circle me-3 fs-5"></i>
                                        <div>
                                            <strong class="d-block mb-1">Syarat yang diperlukan:</strong>
                                            Silakan checklist syarat yang telah Anda penuhi untuk <strong>${selectedOption.text}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="syarat-checklist">
                            `;

                            syaratList.forEach((syarat, index) => {
                                syaratHtml += `
                                    <div class="syarat-item">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox"
                                                   id="syarat_${index}"
                                                   name="syarat_checked[]"
                                                   value="${syarat}">
                                            <label class="form-check-label ms-2" for="syarat_${index}">
                                                ${index + 1}. ${syarat}
                                            </label>
                                        </div>
                                    </div>
                                `;
                            });

                            syaratHtml += `</div>`;
                            syaratContainer.innerHTML = syaratHtml;
                        } else {
                            syaratContainer.innerHTML = `
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="lni lni-warning me-3 fs-5"></i>
                                        <div>Jenis surat <strong>${selectedOption.text}</strong> tidak memiliki syarat khusus</div>
                                    </div>
                                </div>
                            `;
                        }
                    } catch (e) {
                        console.error('Error parsing syarat:', e);
                        syaratContainer.innerHTML = `
                            <div class="alert alert-danger">
                                <div class="d-flex align-items-center">
                                    <i class="lni lni-warning me-3 fs-5"></i>
                                    <div>Terjadi kesalahan saat memuat daftar syarat</div>
                                </div>
                            </div>
                        `;
                    }
                } else {
                    syaratContainer.innerHTML = `
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="lni lni-info-circle me-3 fs-5"></i>
                                <div>Pilih jenis surat terlebih dahulu untuk melihat daftar syarat</div>
                            </div>
                        </div>
                    `;
                }
            });

            if (jenisSuratSelect.value) {
                jenisSuratSelect.dispatchEvent(new Event('change'));
            }
        }

        // File Upload Handlers
        if (browseBtn) browseBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.click();
        });

        if (uploadArea) uploadArea.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.click();
        });

        if (fileInput) fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

        if (clearAllBtn) clearAllBtn.addEventListener('click', clearAllFiles);

        // Functions
        function handleFiles(files) {
            for (let file of files) {
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File "${file.name}" melebihi ukuran maksimal 5MB`);
                    continue;
                }
                if (!uploadedFiles.some(f => f.name === file.name && f.size === file.size)) {
                    uploadedFiles.push(file);
                }
            }
            updateFilePreview();
        }

        function updateFilePreview() {
            fileList.innerHTML = '';

            if (uploadedFiles.length === 0) {
                filePreviewContainer.style.display = 'none';
                fileCount.textContent = '0';
                uploadArea.innerHTML = `
                    <div class="text-center">
                        <div class="upload-icon mb-3">
                            <i class="lni lni-cloud-upload display-4 text-primary"></i>
                        </div>
                        <h5 class="mb-2 fw-semibold">Seret & Lepas Berkas di Sini</h5>
                        <p class="text-muted mb-3">Atau klik untuk memilih berkas dari komputer</p>
                        <button type="button" class="btn btn-outline-primary btn-lg px-4" id="browseBtn">
                            <i class="lni lni-folder me-1"></i> Browse Files
                        </button>
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="lni lni-info-circle me-1"></i>
                                Format yang didukung: PDF, JPG, PNG, DOC, DOCX | Maks: 5MB per file
                            </small>
                        </div>
                    </div>
                `;
                document.getElementById('browseBtn').addEventListener('click', () => fileInput.click());
                return;
            }

            filePreviewContainer.style.display = 'block';
            fileCount.textContent = uploadedFiles.length;
            uploadArea.innerHTML = `
                <div class="text-center">
                    <div class="upload-icon mb-3">
                        <i class="lni lni-checkmark-circle display-4 text-success"></i>
                    </div>
                    <h5 class="mb-2 text-success fw-semibold">${uploadedFiles.length} Berkas Dipilih</h5>
                    <p class="text-muted mb-3">Klik untuk menambah atau mengganti berkas</p>
                </div>
            `;

            uploadedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'col-md-6 col-lg-4';
                const iconClass = getFileIconClass(file.type);
                const icon = getFileIcon(file.type);
                const size = formatFileSize(file.size);
                const name = file.name.length > 25 ? file.name.substring(0, 22) + '...' : file.name;
                const canPreview = file.type.startsWith('image/') || file.type === 'application/pdf';

                fileItem.innerHTML = `
                    <div class="file-card" data-file-index="${index}">
                        <button type="button" class="btn btn-danger btn-sm remove-file-btn"
                                data-index="${index}" title="Hapus berkas">
                            <i class="lni lni-close"></i>
                        </button>
                        <div class="d-flex align-items-start">
                            <div class="file-icon-wrapper ${iconClass} me-3">
                                <i class="${icon}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-semibold" title="${file.name}">${name}</h6>
                                <small class="text-muted d-block mb-2">${size}</small>
                                <div class="mt-3">
                                    <input type="text" name="captions[${index}]"
                                           class="form-control caption-input"
                                           placeholder="Masukkan caption (opsional)"
                                           value="${file.name.split('.')[0]}">
                                </div>
                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    ${canPreview ? `<button type="button" class="btn btn-outline-primary btn-sm btn-file-action preview-file-btn"
                                            data-index="${index}" data-filename="${file.name}">
                                        <i class="lni lni-eye me-1"></i> Preview
                                    </button>` : ''}
                                    <button type="button" class="btn btn-outline-success btn-sm btn-file-action download-file-btn"
                                            data-index="${index}">
                                        <i class="lni lni-download me-1"></i> Download
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                fileList.appendChild(fileItem);
            });

            attachFileCardEvents();
        }

        function attachFileCardEvents() {
            document.querySelectorAll('.preview-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    previewFile(index, this.getAttribute('data-filename'));
                });
            });

            document.querySelectorAll('.download-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    downloadFile(parseInt(this.getAttribute('data-index')));
                });
            });

            document.querySelectorAll('.remove-file-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    removeFile(parseInt(this.getAttribute('data-index')));
                });
            });
        }

        function removeFile(index) {
            if (confirm('Apakah Anda yakin ingin menghapus berkas ini?')) {
                uploadedFiles.splice(index, 1);
                updateFilePreview();
            }
        }

        function clearAllFiles() {
            if (uploadedFiles.length > 0 && confirm('Apakah Anda yakin ingin menghapus semua berkas?')) {
                uploadedFiles = [];
                fileInput.value = '';
                updateFilePreview();
            }
        }

        function previewFile(index, fileName) {
            const file = uploadedFiles[index];
            if (!file) return;

            previewModalTitle.innerHTML = `<i class="lni lni-eye me-2"></i> Preview: ${fileName}`;
            downloadPreviewBtn.href = '#';
            downloadPreviewBtn.onclick = (e) => { e.preventDefault(); downloadFile(index); };

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewModalBody.innerHTML = `<div class="preview-container"><img src="${e.target.result}" class="preview-image" alt="${fileName}"></div>`;
                    previewModal.show();
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <div class="text-center py-4">
                            <div class="mb-4"><i class="lni lni-empty-file display-1 text-primary"></i></div>
                            <h4 class="mb-3">${fileName}</h4>
                            <p class="text-muted mb-3">File PDF (${formatFileSize(file.size)})</p>
                            <div class="alert alert-info mb-4">
                                <i class="lni lni-info-circle me-2"></i>
                                Pilih cara untuk melihat file PDF:
                            </div>
                            <div class="d-grid gap-3">
                                <button class="btn btn-success btn-lg" id="openPdfBtn">
                                    <i class="lni lni-external-link me-2"></i>
                                    <strong>Buka PDF di Tab Baru</strong>
                                </button>
                                <button class="btn btn-outline-primary" onclick="downloadFile(${index})">
                                    <i class="lni lni-download me-2"></i> Download PDF
                                </button>
                            </div>
                        </div>
                    </div>`;
                previewModal.show();
                document.getElementById('openPdfBtn').addEventListener('click', () => openPDFInNewTab(index));
            } else {
                previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <div class="text-center py-4">
                            <i class="lni lni-file display-1 text-muted mb-3"></i>
                            <h4 class="mb-3">${fileName}</h4>
                            <p class="text-muted mb-3">${file.type} (${formatFileSize(file.size)})</p>
                            <div class="alert alert-info mb-4">
                                <i class="lni lni-info-circle me-2"></i>
                                Berkas ini tidak dapat dipreview langsung di browser.
                            </div>
                            <button class="btn btn-primary" onclick="downloadFile(${index})">
                                <i class="lni lni-download me-1"></i> Download Berkas
                            </button>
                        </div>
                    </div>`;
                previewModal.show();
            }
        }

        function openPDFInNewTab(index) {
            const file = uploadedFiles[index];
            if (!file) return;
            const url = URL.createObjectURL(file);
            const newWindow = window.open(url, '_blank');
            if (!newWindow) {
                alert('Popup diblokir! Silakan izinkan popup untuk situs ini.');
                downloadFile(index);
            }
            setTimeout(() => URL.revokeObjectURL(url), 10000);
        }

        function downloadFile(index) {
            const file = uploadedFiles[index];
            if (!file) return;
            try {
                const url = URL.createObjectURL(file);
                const a = document.createElement('a');
                a.href = url;
                a.download = file.name;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                setTimeout(() => URL.revokeObjectURL(url), 1000);
                showToast('Success', `Berkas ${file.name} berhasil di-download`, 'success');
            } catch (error) {
                showToast('Error', `Gagal mendownload berkas: ${error.message}`, 'danger');
            }
        }

        window.downloadFile = downloadFile;

        function showToast(title, message, type = 'info') {
            const toastHtml = `
                <div class="toast align-items-center text-bg-${type} border-0 position-fixed bottom-0 end-0 m-3" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <strong>${title}:</strong> ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>`;
            document.body.insertAdjacentHTML('beforeend', toastHtml);
            const toastEl = document.querySelector('.toast:last-child');
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
            toastEl.addEventListener('hidden.bs.toast', function() { this.remove(); });
        }

        function getFileIconClass(mimeType) {
            if (mimeType.includes('image/')) return 'image';
            if (mimeType.includes('pdf')) return 'pdf';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'excel';
            return 'other';
        }

        function getFileIcon(mimeType) {
            if (mimeType.includes('image/')) return 'lni lni-image';
            if (mimeType.includes('pdf')) return 'lni lni-empty-file';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'lni lni-files';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'lni lni-bar-chart';
            return 'lni lni-file';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Drag and Drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => uploadArea.classList.add('drag-over'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => uploadArea.classList.remove('drag-over'), false);
        });

        uploadArea.addEventListener('drop', function(e) {
            e.stopPropagation();
            handleFiles(e.dataTransfer.files);
            uploadArea.classList.remove('drag-over');
        }, false);

        // Form Validation
        if (uploadForm) {
            uploadForm.addEventListener('submit', function(e) {
                if (uploadedFiles.length === 0) {
                    e.preventDefault();
                    alert('Minimal harus ada satu berkas pendukung yang diupload!');
                    return false;
                }
                const totalSize = uploadedFiles.reduce((sum, file) => sum + file.size, 0);
                if (totalSize > 50 * 1024 * 1024) {
                    e.preventDefault();
                    alert(`Total ukuran berkas melebihi 50MB. Ukuran saat ini: ${formatFileSize(totalSize)}`);
                    return false;
                }
                const submitBtn = document.getElementById('submitBtn');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="lni lni-spinner-solid spin me-2"></i> Mengajukan...';
                }
                return true;
            });
        }
    });
</script>
@endsection
