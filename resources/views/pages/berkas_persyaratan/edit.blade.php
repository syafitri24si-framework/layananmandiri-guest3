{{-- resources/views/pages/berkas_persyaratan/edit.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section id="contact" class="contact-section contact-style-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10">
                <div class="section-title text-center mb-40">
                    <br><br>
                    <h3 class="mb-15">Edit Berkas Persyaratan</h3>
                    <p class="text-muted">Silahkan perbarui data berkas persyaratan di bawah</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="contact-form-wrapper">
                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="lni lni-checkmark-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="lni lni-warning me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('berkas_persyaratan.update', $berkas->berkas_id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        @method('PUT')

                        <!-- Form Grid -->
                        <div class="row g-3">
                            <!-- Informasi Permohonan (Readonly) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold mb-2">
                                        Permohonan Surat
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-md bg-light" readonly
                                               value="#{{ $berkas->permohonan->nomor_permohonan }} - {{ $berkas->permohonan->warga->nama }}">
                                        <span class="input-group-text bg-light border-start-0">
                                            <i class="lni lni-notepad text-muted"></i>
                                        </span>
                                    </div>
                                    <input type="hidden" name="permohonan_id" value="{{ $berkas->permohonan_id }}">
                                    <small class="text-muted mt-1 d-block">Permohonan tidak dapat diubah</small>
                                </div>
                            </div>

                            <!-- Status Validasi -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold mb-2">
                                        Status Validasi <span class="text-danger">*</span>
                                    </label>
                                    <select name="valid" class="form-select form-select-md @error('valid') is-invalid @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="menunggu" {{ old('valid', $berkas->valid) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="valid" {{ old('valid', $berkas->valid) == 'valid' ? 'selected' : '' }}>Valid</option>
                                        <option value="tidak_valid" {{ old('valid', $berkas->valid) == 'tidak_valid' ? 'selected' : '' }}>Tidak Valid</option>
                                    </select>
                                    @error('valid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Berkas -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold mb-2">
                                        Nama Berkas <span class="text-danger">*</span>
                                    </label>
                                    <select name="nama_berkas" id="nama_berkas" class="form-select form-select-md @error('nama_berkas') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis Berkas --</option>
                                        <option value="KTP" {{ old('nama_berkas', $berkas->nama_berkas) == 'KTP' ? 'selected' : '' }}>KTP</option>
                                        <option value="KK" {{ old('nama_berkas', $berkas->nama_berkas) == 'KK' ? 'selected' : '' }}>Kartu Keluarga (KK)</option>
                                        <option value="Surat Pengantar RT/RW" {{ old('nama_berkas', $berkas->nama_berkas) == 'Surat Pengantar RT/RW' ? 'selected' : '' }}>Surat Pengantar RT/RW</option>
                                        <option value="Pas Foto" {{ old('nama_berkas', $berkas->nama_berkas) == 'Pas Foto' ? 'selected' : '' }}>Pas Foto</option>
                                        <option value="Surat Keterangan" {{ old('nama_berkas', $berkas->nama_berkas) == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan</option>
                                        <option value="Ijazah" {{ old('nama_berkas', $berkas->nama_berkas) == 'Ijazah' ? 'selected' : '' }}>Ijazah</option>
                                        <option value="Akte Kelahiran" {{ old('nama_berkas', $berkas->nama_berkas) == 'Akte Kelahiran' ? 'selected' : '' }}>Akte Kelahiran</option>
                                        <option value="Akte Nikah" {{ old('nama_berkas', $berkas->nama_berkas) == 'Akte Nikah' ? 'selected' : '' }}>Akte Nikah</option>
                                        <option value="NPWP" {{ old('nama_berkas', $berkas->nama_berkas) == 'NPWP' ? 'selected' : '' }}>NPWP</option>
                                        <option value="Lainnya" {{ old('nama_berkas', $berkas->nama_berkas) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('nama_berkas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Berkas Custom -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold mb-2">
                                        Nama Berkas Kustom
                                    </label>
                                    <div class="input-group">
                                        <input type="text" id="nama_berkas_custom" name="nama_berkas_custom"
                                               class="form-control form-control-md @error('nama_berkas_custom') is-invalid @enderror"
                                               placeholder="Masukkan nama berkas jika memilih 'Lainnya'"
                                               value="{{ $berkas->nama_berkas == 'Lainnya' ? $berkas->nama_berkas : '' }}"
                                               {{ $berkas->nama_berkas == 'Lainnya' ? '' : 'disabled' }}>
                                        <span class="input-group-text bg-transparent border-start-0">
                                            <i class="lni lni-edit text-muted"></i>
                                        </span>
                                    </div>
                                    @error('nama_berkas_custom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- File yang Sudah Ada -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-semibold mb-3 d-flex align-items-center">
                                        <i class="lni lni-files me-2"></i>
                                        File yang Sudah Ada
                                        @if($mediaFiles->count() > 0)
                                            <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }}</span>
                                        @endif
                                    </label>

                                    @if($mediaFiles->count() > 0)
                                        <div id="existingFilesContainer" class="mt-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0 fw-semibold">
                                                    <i class="lni lni-folder me-2"></i> File Terupload
                                                </h6>
                                                <button type="button" class="btn btn-outline-danger btn-sm" id="selectAllDeleteBtn">
                                                    <i class="lni lni-trash-can me-1"></i> Pilih Semua untuk Hapus
                                                </button>
                                            </div>
                                            <div id="existingFileList" class="row g-3">
                                                @foreach($mediaFiles as $index => $media)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="file-card border border-primary" data-file-id="{{ $media->media_id }}">
                                                        <!-- Delete Checkbox -->
                                                        <div class="form-check position-absolute top-0 end-0 m-2 z-2">
                                                            <input type="checkbox"
                                                                   class="form-check-input delete-checkbox"
                                                                   name="delete_media[{{ $media->media_id }}]"
                                                                   id="delete_media_{{ $media->media_id }}"
                                                                   value="1">
                                                            <label class="form-check-label" for="delete_media_{{ $media->media_id }}"></label>
                                                        </div>

                                                        <!-- File Content -->
                                                        <div class="p-3">
                                                            <div class="d-flex align-items-start">
                                                                <!-- File Icon -->
                                                                <div class="file-icon-wrapper {{ $media->mime_type == 'application/pdf' ? 'pdf' : (str_contains($media->mime_type, 'image/') ? 'image' : 'other') }} me-3">
                                                                    <i class="{{ $media->mime_type == 'application/pdf' ? 'lni lni-empty-file' : (str_contains($media->mime_type, 'image/') ? 'lni lni-image' : 'lni lni-file') }}"></i>
                                                                </div>

                                                                <!-- File Info -->
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-1" title="{{ $media->file_name }}">
                                                                        {{ strlen($media->file_name) > 20 ? substr($media->file_name, 0, 17) . '...' : $media->file_name }}
                                                                    </h6>
                                                                    <small class="text-muted d-block mb-2">
                                                                        {{ $media->mime_type }}
                                                                    </small>
                                                                    <small class="text-muted">
                                                                        {{ \Carbon\Carbon::parse($media->created_at)->format('d/m/Y H:i') }}
                                                                    </small>

                                                                    <!-- Caption Input -->
                                                                    <div class="mt-3">
                                                                        <input type="text"
                                                                               name="existing_captions[{{ $media->media_id }}]"
                                                                               class="form-control form-control-sm caption-input"
                                                                               placeholder="Caption (opsional)"
                                                                               value="{{ old('existing_captions.' . $media->media_id, $media->caption) }}">
                                                                    </div>

                                                                    <!-- Action Buttons -->
                                                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                                                        @if(str_contains($media->mime_type, 'image/') || $media->mime_type == 'application/pdf')
                                                                        <button type="button"
                                                                                class="btn btn-outline-primary btn-sm btn-file-action preview-existing-btn"
                                                                                data-media-id="{{ $media->media_id }}"
                                                                                data-filename="{{ $media->file_name }}"
                                                                                data-mimetype="{{ $media->mime_type }}"
                                                                                data-url="{{ asset('storage/uploads/berkas_persyaratan/' . $media->file_name) }}">
                                                                            <i class="lni lni-eye me-1"></i> Preview
                                                                        </button>
                                                                        @endif
                                                                        <a href="{{ route('berkas_persyaratan.download', $media->media_id) }}"
                                                                           class="btn btn-outline-success btn-sm btn-file-action">
                                                                            <i class="lni lni-download me-1"></i> Download
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="lni lni-warning me-2"></i> Belum ada file yang diupload.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- TAMBAH FILE BARU -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-semibold mb-3 d-flex align-items-center">
                                        <i class="lni lni-cloud-upload me-2"></i>
                                        Tambah File Baru (Optional)
                                    </label>

                                    <!-- Hidden File Input -->
                                    <input type="file" name="files[]" id="files"
                                           class="d-none @error('files') is-invalid @enderror"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                                           multiple>

                                    <!-- Upload Area -->
                                    <div class="file-upload-area border rounded-3 p-4 mb-3" id="uploadArea">
                                        <div class="text-center py-3">
                                            <div class="upload-icon mb-3">
                                                <i class="lni lni-plus display-4 text-primary"></i>
                                            </div>
                                            <h5 class="mb-2">Seret & Lepas File di Sini</h5>
                                            <p class="text-muted mb-3">Atau klik untuk menambah file baru</p>
                                            <button type="button" class="btn btn-outline-primary btn-md px-4" id="browseBtn">
                                                <i class="lni lni-folder me-1"></i> Browse Files
                                            </button>
                                            <div class="mt-3">
                                                <small class="text-muted">
                                                    <i class="lni lni-info-circle me-1"></i>
                                                    Format yang didukung: PDF, JPG, PNG, DOC, XLS | Maks: 10MB per file
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    @error('files')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('files.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <!-- File Preview Container untuk File Baru -->
                                    <div id="filePreviewContainer" class="mt-4" style="display: none;">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0 fw-semibold">
                                                <i class="lni lni-plus-circle me-2"></i> File Baru
                                                <span class="badge bg-success ms-2" id="fileCount">0</span>
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

                            <!-- Informasi Warga Card -->
                            <div class="col-12">
                                <div class="card border shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title d-flex align-items-center fw-semibold mb-3">
                                            <i class="lni lni-user me-2 text-primary"></i> Informasi Warga
                                        </h6>
                                        <div id="wargaInfo">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="lni lni-user text-primary me-2 fs-5"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Nama Warga</small>
                                                            <strong class="fs-6">{{ $berkas->permohonan->warga->nama }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="lni lni-tag text-primary me-2 fs-5"></i>
                                                        <div>
                                                            <small class="text-muted d-block">No. Permohonan</small>
                                                            <strong class="fs-6">{{ $berkas->permohonan->nomor_permohonan }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="lni lni-envelope text-primary me-2 fs-5"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Jenis Surat</small>
                                                            <strong class="fs-6">{{ $berkas->permohonan->jenisSurat->nama_jenis ?? 'N/A' }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="lni lni-calendar text-primary me-2 fs-5"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Tanggal Permohonan</small>
                                                            <strong class="fs-6">{{ \Carbon\Carbon::parse($berkas->permohonan->created_at)->format('d/m/Y') }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                                    <a href="{{ route('berkas_persyaratan.index', ['permohonan_id' => $berkas->permohonan_id]) }}"
                                       class="btn btn-outline-danger px-4 py-2">
                                        <i class="lni lni-cross-circle me-2"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-success px-4 py-2" id="submitBtn">
                                        <i class="lni lni-save me-2"></i> Perbarui Berkas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    /* Form Styles */
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-select-md,
    .form-control-md {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-select-md:focus,
    .form-control-md:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        outline: none;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    /* File Upload Styles */
    .file-upload-area {
        border: 2px dashed #3498db;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f8ff 100%);
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .file-upload-area:hover {
        border-color: #2ecc71;
        background: linear-gradient(135deg, #f1f8ff 0%, #e8f5e9 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(46, 204, 113, 0.1);
    }

    .file-upload-area.drag-over {
        border-color: #2ecc71;
        background: linear-gradient(135deg, #e8f5e9 0%, #d4edda 100%);
        transform: scale(1.01);
        box-shadow: 0 8px 25px rgba(46, 204, 113, 0.15);
    }

    .upload-icon {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* File Card Styles */
    .file-card {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        background: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .file-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        border-color: #3498db;
    }

    .file-card.border-primary {
        border-color: #3498db !important;
    }

    .file-icon-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .file-icon-wrapper.pdf { background: #ff6b6b; color: white; }
    .file-icon-wrapper.image { background: #4ecdc4; color: white; }
    .file-icon-wrapper.word { background: #3498db; color: white; }
    .file-icon-wrapper.excel { background: #2ecc71; color: white; }
    .file-icon-wrapper.other { background: #95a5a6; color: white; }

    .btn-file-action {
        padding: 4px 10px;
        font-size: 12px;
        border-radius: 6px;
    }

    .caption-input {
        font-size: 0.85rem;
        padding: 0.375rem 0.5rem;
        border-radius: 6px;
    }

    /* Delete Checkbox Style */
    .form-check-input:checked {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .form-check-input:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    /* Preview Modal Styles */
    #filePreviewModal .modal-body {
        height: 65vh;
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
        padding: 1rem;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .file-card {
            padding: 12px;
        }

        .file-icon-wrapper {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .btn-file-action {
            font-size: 11px;
            padding: 3px 8px;
        }

        .modal-dialog {
            margin: 0.5rem;
        }

        #filePreviewModal .modal-body {
            height: 50vh;
        }
    }

    @media (max-width: 576px) {
        .form-select-md,
        .form-control-md {
            padding: 0.375rem 0.5rem;
            font-size: 0.85rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
        }

        .file-upload-area {
            min-height: 150px;
            padding: 1rem;
        }

        .upload-icon i {
            font-size: 3rem;
        }

        .card-title {
            font-size: 1rem;
        }
    }
</style>

<script>
    // Global array untuk menyimpan file objects baru
    let newFiles = [];

    document.addEventListener('DOMContentLoaded', function() {
        // Handle custom nama berkas
        const namaBerkasSelect = document.getElementById('nama_berkas');
        const namaBerkasCustomInput = document.getElementById('nama_berkas_custom');

        namaBerkasSelect.addEventListener('change', function() {
            if (this.value === 'Lainnya') {
                namaBerkasCustomInput.disabled = false;
                namaBerkasCustomInput.required = true;
                namaBerkasCustomInput.placeholder = "Masukkan nama berkas";
                namaBerkasCustomInput.focus();
            } else {
                namaBerkasCustomInput.disabled = true;
                namaBerkasCustomInput.required = false;
                namaBerkasCustomInput.value = '';
                namaBerkasCustomInput.placeholder = "Masukkan nama berkas jika memilih 'Lainnya'";
            }
        });

        // Initialize jika sudah ada value
        if (namaBerkasSelect.value === 'Lainnya') {
            namaBerkasCustomInput.disabled = false;
            namaBerkasCustomInput.required = true;
            if (namaBerkasCustomInput.value === '') {
                namaBerkasCustomInput.value = '{{ $berkas->nama_berkas }}';
            }
        }

        // Multiple file upload handling untuk file baru
        const fileInput = document.getElementById('files');
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

        // Event untuk klik tombol browse
        browseBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            fileInput.click();
        });

        // Event untuk klik area upload
        uploadArea.addEventListener('click', function(e) {
            e.stopPropagation();
            fileInput.click();
        });

        // Event untuk perubahan file input
        fileInput.addEventListener('change', function(e) {
            handleFiles(this.files);
        });

        // Event untuk hapus semua file baru
        clearAllBtn.addEventListener('click', function() {
            if (newFiles.length > 0) {
                if (confirm('Apakah Anda yakin ingin menghapus semua file baru?')) {
                    newFiles = [];
                    fileInput.value = '';
                    updateFilePreview();
                }
            }
        });

        // Handle files dari input
        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Check if file already exists
                const fileExists = newFiles.some(existingFile =>
                    existingFile.name === file.name && existingFile.size === file.size
                );

                if (!fileExists) {
                    newFiles.push(file);
                }
            }

            // Update DataTransfer untuk file input
            const dt = new DataTransfer();
            newFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;

            updateFilePreview();
        }

        // Update preview files baru
        function updateFilePreview() {
            fileList.innerHTML = '';

            if (newFiles.length === 0) {
                filePreviewContainer.style.display = 'none';
                fileCount.textContent = '0';

                // Reset area upload
                uploadArea.innerHTML = `
                    <div class="text-center">
                        <div class="upload-icon mb-3">
                            <i class="lni lni-plus display-4 text-primary"></i>
                        </div>
                        <h5 class="mb-2">Seret & Lepas File di Sini</h5>
                        <p class="text-muted mb-3">Atau klik untuk menambah file baru</p>
                        <button type="button" class="btn btn-outline-primary btn-md px-4" id="browseBtn">
                            <i class="lni lni-folder me-1"></i> Browse Files
                        </button>
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="lni lni-info-circle me-1"></i>
                                Format yang didukung: PDF, JPG, PNG, DOC, XLS | Maks: 10MB per file
                            </small>
                        </div>
                    </div>
                `;

                // Re-attach browse button event
                document.getElementById('browseBtn').addEventListener('click', function(e) {
                    e.stopPropagation();
                    fileInput.click();
                });

                return;
            }

            // Update tampilan area upload
            uploadArea.innerHTML = `
                <div class="text-center">
                    <div class="upload-icon mb-3">
                        <i class="lni lni-checkmark-circle display-4 text-success"></i>
                    </div>
                    <h5 class="mb-2 text-success">${newFiles.length} File Baru Dipilih</h5>
                    <p class="text-muted mb-3">Klik untuk menambah file lagi</p>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="lni lni-reload me-1"></i>
                            Klik area ini untuk menambah file lagi
                        </small>
                    </div>
                </div>
            `;

            // Show preview container
            filePreviewContainer.style.display = 'block';
            fileCount.textContent = newFiles.length;

            // Render each file card untuk file baru
            newFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'col-md-6 col-lg-4';

                const fileIconClass = getFileIconClass(file.type);
                const fileIcon = getFileIcon(file.type);
                const fileSize = formatFileSize(file.size);
                const fileName = file.name.length > 20 ? file.name.substring(0, 17) + '...' : file.name;

                const canPreview = file.type.startsWith('image/') || file.type === 'application/pdf';

                fileItem.innerHTML = `
                    <div class="file-card" data-file-index="${index}">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-file-btn"
                                data-index="${index}" title="Hapus file">
                            <i class="lni lni-close"></i>
                        </button>

                        <div class="p-3">
                            <div class="d-flex align-items-start">
                                <div class="file-icon-wrapper ${fileIconClass} me-3">
                                    <i class="${fileIcon}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" title="${file.name}">${fileName}</h6>
                                    <small class="text-muted d-block mb-2">${fileSize}</small>
                                    <small class="text-muted">${file.type || 'Unknown type'}</small>

                                    <div class="mt-3">
                                        <input type="text"
                                               name="captions[${index}]"
                                               class="form-control form-control-sm caption-input"
                                               placeholder="Caption (opsional)"
                                               data-index="${index}"
                                               value="${file.name.split('.')[0]}">
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        ${canPreview ? `
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-file-action preview-new-file-btn"
                                                data-index="${index}" data-filename="${file.name}">
                                            <i class="lni lni-eye me-1"></i> Preview
                                        </button>
                                        ` : ''}
                                        <button type="button" class="btn btn-outline-success btn-sm btn-file-action download-new-file-btn"
                                                data-index="${index}">
                                            <i class="lni lni-download me-1"></i> Download
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                fileList.appendChild(fileItem);
            });

            // Attach event listeners untuk file baru
            attachNewFileEvents();
        }

        function attachNewFileEvents() {
            // Preview button untuk file baru
            document.querySelectorAll('.preview-new-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    const fileName = this.getAttribute('data-filename');
                    previewNewFile(index, fileName);
                });
            });

            // Download button untuk file baru
            document.querySelectorAll('.download-new-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    downloadNewFile(index);
                });
            });

            // Remove file button untuk file baru
            document.querySelectorAll('.remove-file-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-index'));
                    removeNewFile(index);
                });
            });

            // Caption input change handler untuk file baru
            document.querySelectorAll('.caption-input').forEach(input => {
                input.addEventListener('change', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    showToast('Success', 'Caption berhasil diubah', 'success');
                });
            });
        }

        // Preview untuk file yang sudah ada
        document.querySelectorAll('.preview-existing-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const mediaId = this.getAttribute('data-media-id');
                const fileName = this.getAttribute('data-filename');
                const mimeType = this.getAttribute('data-mimetype');
                const fileUrl = this.getAttribute('data-url');

                previewExistingFile(mediaId, fileName, mimeType, fileUrl);
            });
        });

        function previewExistingFile(mediaId, fileName, mimeType, fileUrl) {
            // Set modal title
            previewModalTitle.innerHTML = `<i class="lni lni-eye me-2"></i> Preview: ${fileName}`;

            // Set download button
            downloadPreviewBtn.href = fileUrl;
            downloadPreviewBtn.download = fileName;

            if (mimeType.startsWith('image/')) {
                // Preview gambar
                previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <img src="${fileUrl}" class="preview-image" alt="${fileName}" onerror="this.onerror=null; this.src='#'; showImageError()">
                    </div>
                `;
                previewModal.show();
            } else if (mimeType === 'application/pdf') {
                // Preview PDF (buka di tab baru)
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
                                <button class="btn btn-success btn-lg" id="openExistingPdfBtn">
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

                previewModal.show();

                // Attach event untuk tombol buka PDF
                document.getElementById('openExistingPdfBtn').addEventListener('click', function() {
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
                previewModal.show();
            }
        }

        function previewNewFile(index, fileName) {
            const file = newFiles[index];
            if (!file) return;

            // Set modal title
            previewModalTitle.innerHTML = `<i class="lni lni-eye me-2"></i> Preview: ${fileName}`;

            // Set download button
            downloadPreviewBtn.href = '#';
            downloadPreviewBtn.onclick = function(e) {
                e.preventDefault();
                downloadNewFile(index);
            };
            downloadPreviewBtn.download = fileName;

            const isImage = file.type.startsWith('image/');
            const isPDF = file.type === 'application/pdf';
            const fileSize = formatFileSize(file.size);

            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewModalBody.innerHTML = `
                        <div class="preview-container">
                            <img src="${e.target.result}" class="preview-image" alt="${fileName}">
                        </div>
                    `;
                    previewModal.show();
                };
                reader.onerror = function() {
                    showPreviewError(fileName, index, 'gambar');
                };
                reader.readAsDataURL(file);
            } else if (isPDF) {
                previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <div class="text-center py-4">
                            <div class="mb-4">
                                <i class="lni lni-empty-file display-1 text-primary"></i>
                            </div>
                            <h4>${fileName}</h4>
                            <p class="text-muted mb-3">File PDF (${fileSize})</p>

                            <div class="alert alert-info mb-4">
                                <i class="lni lni-info-circle me-2"></i>
                                Pilih cara untuk melihat file PDF:
                            </div>

                            <div class="d-grid gap-3">
                                <button class="btn btn-success btn-lg" id="openNewPdfBtn">
                                    <i class="lni lni-external-link me-2"></i>
                                    <strong>Buka PDF di Tab Baru</strong>
                                </button>

                                <button class="btn btn-outline-primary" onclick="downloadNewFile(${index})">
                                    <i class="lni lni-download me-2"></i>
                                    Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                previewModal.show();

                document.getElementById('openNewPdfBtn').addEventListener('click', function() {
                    openNewPDFInNewTab(index);
                });
            } else {
                previewModalBody.innerHTML = `
                    <div class="preview-container">
                        <div class="text-center py-4">
                            <i class="lni lni-file display-1 text-muted mb-3"></i>
                            <h4>${fileName}</h4>
                            <p class="text-muted mb-3">${file.type || 'Unknown type'} (${fileSize})</p>
                            <div class="alert alert-info mb-4">
                                <i class="lni lni-info-circle me-2"></i>
                                File ini tidak dapat dipreview langsung di browser.
                            </div>
                            <button class="btn btn-primary" onclick="downloadNewFile(${index})">
                                <i class="lni lni-download me-1"></i> Download File
                            </button>
                        </div>
                    </div>
                `;
                previewModal.show();
            }
        }

        function openNewPDFInNewTab(index) {
            const file = newFiles[index];
            if (!file) return;

            const url = URL.createObjectURL(file);
            const newWindow = window.open(url, '_blank');

            if (!newWindow) {
                alert('Popup diblokir! Silakan izinkan popup untuk situs ini.');
                downloadNewFile(index);
            }

            setTimeout(() => {
                URL.revokeObjectURL(url);
            }, 10000);
        }

        function removeNewFile(index) {
            if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                newFiles.splice(index, 1);

                const dt = new DataTransfer();
                newFiles.forEach(file => dt.items.add(file));
                fileInput.files = dt.files;

                updateFilePreview();
            }
        }

        function downloadNewFile(index) {
            const file = newFiles[index];
            if (!file) return;

            try {
                const url = URL.createObjectURL(file);
                const a = document.createElement('a');
                a.href = url;
                a.download = file.name;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);

                setTimeout(() => {
                    URL.revokeObjectURL(url);
                }, 1000);

                showToast('Success', `File ${file.name} berhasil di-download`, 'success');
            } catch (error) {
                showToast('Error', `Gagal mendownload file: ${error.message}`, 'danger');
            }
        }

        window.downloadNewFile = downloadNewFile;

        function showPreviewError(fileName, index, type) {
            previewModalBody.innerHTML = `
                <div class="preview-container">
                    <div class="text-center py-4">
                        <i class="lni lni-warning display-1 text-danger mb-3"></i>
                        <h4>Gagal Memuat ${type === 'gambar' ? 'Gambar' : 'File'}</h4>
                        <p class="text-muted mb-4">
                            Terjadi kesalahan saat memuat file ${fileName}.
                        </p>
                        <button class="btn btn-primary" onclick="downloadNewFile(${index})">
                            <i class="lni lni-download me-1"></i> Download File
                        </button>
                    </div>
                </div>
            `;
            previewModal.show();
        }

        function showImageError() {
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
        }

        function showToast(title, message, type = 'info') {
            const toastHtml = `
                <div class="toast align-items-center text-bg-${type} border-0 position-fixed bottom-0 end-0 m-3" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <strong>${title}:</strong> ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', toastHtml);
            const toastEl = document.querySelector('.toast:last-child');
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();

            toastEl.addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
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

        // Drag and drop functionality untuk file baru
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            uploadArea.classList.add('drag-over');
        }

        function unhighlight() {
            uploadArea.classList.remove('drag-over');
        }

        uploadArea.addEventListener('drop', function(e) {
            e.stopPropagation();
            const dt = e.dataTransfer;
            const files = dt.files;

            handleFiles(files);
            unhighlight();
        }, false);

        // Fungsi untuk select all delete checkbox
        const selectAllDeleteBtn = document.getElementById('selectAllDeleteBtn');
        if (selectAllDeleteBtn) {
            selectAllDeleteBtn.addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.delete-checkbox');
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                checkboxes.forEach(cb => {
                    cb.checked = !allChecked;
                });

                this.innerHTML = allChecked
                    ? '<i class="lni lni-trash-can me-1"></i> Pilih Semua untuk Hapus'
                    : '<i class="lni lni-checkmark-circle me-1"></i> Batalkan Pilihan Semua';
            });
        }
    });
</script>
@endsection
