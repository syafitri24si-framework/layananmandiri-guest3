{{-- resources/views/pages/permohonan_surat/edit.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section id="contact" class="contact-section contact-style-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                <div class="section-title text-center mb-50">
                    <br><br>
                    <h3 class="mb-15">Edit Permohonan Surat</h3>
                    <p>Silahkan perbarui data permohonan surat di bawah</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="contact-form-wrapper">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="lni lni-checkmark-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="lni lni-warning me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('permohonan_surat.update', $data->permohonan_id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">

                            {{-- Nomor Permohonan --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <label class="form-label mb-2">Nomor Permohonan <span class="text-danger">*</span></label>
                                    <input type="text" id="nomor_permohonan" name="nomor_permohonan"
                                           class="form-input @error('nomor_permohonan') is-invalid @enderror"
                                           placeholder="Contoh: PS2024120001"
                                           value="{{ old('nomor_permohonan', $data->nomor_permohonan) }}" required readonly>
                                    <i class="lni lni-tag position-absolute"
                                       style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                    @error('nomor_permohonan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Nomor permohonan tidak dapat diubah</small>
                                </div>
                            </div>

                            {{-- Warga --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <label class="form-label mb-2">Warga <span class="text-danger">*</span></label>
                                    <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($warga as $item)
                                            <option value="{{ $item->warga_id }}"
                                                {{ old('warga_id', $data->warga_id) == $item->warga_id ? 'selected' : '' }}>
                                                {{ $item->nama }} ({{ $item->no_ktp }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="lni lni-user position-absolute"
                                       style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Warga yang mengajukan permohonan</small>
                                </div>
                            </div>

                            {{-- Jenis Surat --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <label class="form-label mb-2">Jenis Surat <span class="text-danger">*</span></label>
                                    <select name="jenis_id" id="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis Surat --</option>
                                        @foreach ($jenisSurat as $js)
                                            <option value="{{ $js->jenis_id }}"
                                                {{ old('jenis_id', $data->jenis_id) == $js->jenis_id ? 'selected' : '' }}
                                                data-syarat="{{ json_encode($js->syarat_json ?? []) }}">
                                                {{ $js->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="lni lni-text-format position-absolute"
                                       style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                    @error('jenis_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Jenis surat yang diajukan</small>
                                </div>
                            </div>

                            {{-- Tanggal Pengajuan --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <label class="form-label mb-2">Tanggal Pengajuan <span class="text-danger">*</span></label>
                                    <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan"
                                           class="form-input @error('tanggal_pengajuan') is-invalid @enderror"
                                           value="{{ old('tanggal_pengajuan', $data->tanggal_pengajuan) }}" required>
                                    <i class="lni lni-calendar position-absolute"
                                       style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                    @error('tanggal_pengajuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Tanggal pengajuan permohonan</small>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <label class="form-label mb-2">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="diajukan" {{ old('status', $data->status) == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                        <option value="diproses" {{ old('status', $data->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ old('status', $data->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ old('status', $data->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <i class="lni lni-stats-up position-absolute"
                                       style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Status permohonan saat ini</small>
                                </div>
                            </div>

                            {{-- Catatan --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <label class="form-label mb-2">Catatan <span class="text-muted">(Opsional)</span></label>
                                    <textarea name="catatan" id="catatan" rows="2"
                                              class="form-input @error('catatan') is-invalid @enderror"
                                              placeholder="Tambahkan catatan jika ada">{{ old('catatan', $data->catatan) }}</textarea>
                                    <i class="lni lni-pencil position-absolute" style="top: 20%; right: 15px;"></i>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Catatan tambahan untuk permohonan</small>
                                </div>
                            </div>

                            {{-- BERKAS YANG SUDAH ADA --}}
                            <div class="col-md-12">
                                <div class="position-relative">
                                    <label class="form-label mb-3 d-flex align-items-center">
                                        <i class="lni lni-files me-2"></i>
                                        Berkas Pendukung yang Sudah Ada
                                        @if($data->mediaFiles && $data->mediaFiles->count() > 0)
                                            <span class="badge bg-primary ms-2">{{ $data->mediaFiles->count() }}</span>
                                        @endif
                                    </label>

                                    @if($data->mediaFiles && $data->mediaFiles->count() > 0)
                                        <div id="existingFilesContainer" class="mt-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">
                                                    <i class="lni lni-folder me-2"></i> Berkas Terupload
                                                </h6>
                                                <button type="button" class="btn btn-outline-danger btn-sm" id="selectAllDeleteBtn">
                                                    <i class="lni lni-trash-can me-1"></i> Pilih Semua untuk Hapus
                                                </button>
                                            </div>
                                            <div id="existingFileList" class="row g-3">
                                                @foreach($data->mediaFiles as $media)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="file-card p-3 position-relative border border-primary" data-file-id="{{ $media->media_id }}">
                                                            <div class="form-check position-absolute top-0 end-0 m-2">
                                                                <input type="checkbox"
                                                                       class="form-check-input delete-checkbox"
                                                                       name="delete_files[]"
                                                                       id="delete_file_{{ $media->media_id }}"
                                                                       value="{{ $media->media_id }}">
                                                                <label class="form-check-label" for="delete_file_{{ $media->media_id }}"></label>
                                                            </div>

                                                            <div class="d-flex align-items-start">
                                                                <div class="file-icon-wrapper
                                                                    @if($media->mime_type == 'application/pdf') pdf
                                                                    @elseif(str_contains($media->mime_type, 'image/')) image
                                                                    @elseif(str_contains($media->mime_type, 'word') || str_contains($media->mime_type, 'document')) word
                                                                    @else other @endif
                                                                    me-3">
                                                                    <i class="
                                                                        @if($media->mime_type == 'application/pdf') lni lni-empty-file
                                                                        @elseif(str_contains($media->mime_type, 'image/')) lni lni-image
                                                                        @elseif(str_contains($media->mime_type, 'word') || str_contains($media->mime_type, 'document')) lni lni-files
                                                                        @else lni lni-file @endif
                                                                    "></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-1" title="{{ $media->file_name }}">
                                                                        {{ Str::limit($media->file_name, 20) }}
                                                                    </h6>
                                                                    <small class="text-muted d-block">
                                                                        {{ $media->mime_type }}
                                                                    </small>
                                                                    <small class="text-muted">
                                                                        {{ \Carbon\Carbon::parse($media->created_at)->format('d/m/Y H:i') }}
                                                                    </small>

                                                                    <div class="mt-3">
                                                                        <input type="text"
                                                                               name="captions[{{ $media->media_id }}]"
                                                                               class="form-control form-control-sm caption-input"
                                                                               placeholder="Caption (opsional)"
                                                                               value="{{ old('captions.' . $media->media_id, $media->caption) }}">
                                                                    </div>

                                                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                                                        @if(str_contains($media->mime_type, 'image/') || $media->mime_type == 'application/pdf')
                                                                            <button type="button"
                                                                                    class="btn btn-outline-primary btn-sm btn-file-action preview-existing-btn"
                                                                                    data-media-id="{{ $media->media_id }}"
                                                                                    data-filename="{{ $media->file_name }}"
                                                                                    data-mimetype="{{ $media->mime_type }}"
                                                                                    data-url="{{ Storage::url('uploads/permohonan_surat/' . $media->file_name) }}">
                                                                                <i class="lni lni-eye me-1"></i> Preview
                                                                            </button>
                                                                        @endif
                                                                        <a href="{{ Storage::url('uploads/permohonan_surat/' . $media->file_name) }}"
                                                                           class="btn btn-outline-success btn-sm btn-file-action"
                                                                           download="{{ $media->file_name }}">
                                                                            <i class="lni lni-download me-1"></i> Download
                                                                        </a>
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
                                            <i class="lni lni-warning me-2"></i> Belum ada berkas pendukung yang diupload.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- TAMBAH BERKAS BARU --}}
                            <div class="col-md-12">
                                <div class="position-relative">
                                    <label class="form-label mb-3 d-flex align-items-center">
                                        <i class="lni lni-cloud-upload me-2"></i>
                                        Tambah Berkas Pendukung Baru <span class="text-muted">(Opsional)</span>
                                    </label>

                                    {{-- File Input yang Tersembunyi --}}
                                    <input type="file" name="berkas_files[]" id="berkasFiles"
                                           class="d-none @error('berkas_files') is-invalid @enderror"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                           multiple>

                                    {{-- Area Upload yang Dapat Diklik --}}
                                    <div class="file-upload-area border rounded p-5 mb-4" id="uploadArea">
                                        <div class="text-center">
                                            <div class="upload-icon mb-3">
                                                <i class="lni lni-plus display-4 text-primary"></i>
                                            </div>
                                            <h5 class="mb-2">Seret & Lepas Berkas di Sini</h5>
                                            <p class="text-muted mb-3">Atau klik untuk menambah berkas baru</p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="browseBtn">
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

                                    {{-- File Preview Container untuk File Baru --}}
                                    <div id="filePreviewContainer" class="mt-4" style="display: none;">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">
                                                <i class="lni lni-plus-circle me-2"></i> Berkas Baru
                                                <span class="badge bg-success ms-2" id="fileCount">0</span>
                                            </h6>
                                            <button type="button" class="btn btn-outline-danger btn-sm" id="clearAllBtn">
                                                <i class="lni lni-trash-can me-1"></i> Hapus Semua
                                            </button>
                                        </div>
                                        <div id="fileList" class="row g-3">
                                            {{-- File previews will be inserted here --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                                    <a href="{{ route('permohonan_surat.index') }}" class="btn btn-outline-danger px-4">
                                        <i class="lni lni-cross-circle me-2"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-success px-4" id="submitBtn">
                                        <i class="lni lni-telegram-original me-2"></i> Perbarui Permohonan
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
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .file-upload-area {
        border: 2px dashed #3498db;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f8ff 100%);
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 200px;
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

    .file-card {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        position: relative;
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
    }

    .file-icon-wrapper.pdf { background: #ff6b6b; color: white; }
    .file-icon-wrapper.image { background: #4ecdc4; color: white; }
    .file-icon-wrapper.word { background: #3498db; color: white; }
    .file-icon-wrapper.excel { background: #2ecc71; color: white; }
    .file-icon-wrapper.other { background: #95a5a6; color: white; }

    .remove-file-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 10;
    }

    .file-card:hover .remove-file-btn {
        opacity: 1;
    }

    .btn-file-action {
        padding: 4px 10px;
        font-size: 12px;
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

    .preview-pdf {
        width: 100%;
        height: 100%;
        border: none;
    }

    .no-preview {
        text-align: center;
        padding: 3rem;
    }

    /* Checkbox style for deletion */
    .form-check-input:checked {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Loading spinner */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .spin {
        animation: spin 1s linear infinite;
    }
</style>

<script>
    // Global array untuk menyimpan file objects baru
    let newFiles = [];

    document.addEventListener('DOMContentLoaded', function() {
        // ========== FILE UPLOAD UNTUK FILE BARU ==========
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
                if (confirm('Apakah Anda yakin ingin menghapus semua berkas baru?')) {
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
                        <h5 class="mb-2">Seret & Lepas Berkas di Sini</h5>
                        <p class="text-muted mb-3">Atau klik untuk menambah berkas baru</p>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="browseBtn">
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
                    <h5 class="mb-2 text-success">${newFiles.length} Berkas Baru Dipilih</h5>
                    <p class="text-muted mb-3">Klik untuk menambah berkas lagi</p>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="lni lni-reload me-1"></i>
                            Klik area ini untuk menambah berkas lagi
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
                    <div class="file-card p-3 position-relative" data-file-index="${index}">
                        <button type="button" class="btn btn-danger btn-sm remove-file-btn"
                                data-index="${index}" title="Hapus berkas">
                            <i class="lni lni-close"></i>
                        </button>

                        <div class="d-flex align-items-start">
                            <div class="file-icon-wrapper ${fileIconClass} me-3">
                                <i class="${fileIcon}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1" title="${file.name}">${fileName}</h6>
                                <small class="text-muted d-block">${fileSize}</small>
                                <small class="text-muted">${file.type || 'Unknown type'}</small>

                                <div class="mt-3">
                                    <input type="text"
                                           name="new_captions[${index}]"
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
        }

        // ========== PREVIEW BERKAS YANG SUDAH ADA ==========
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
                                Berkas ini tidak dapat dipreview langsung di browser.
                            </div>
                            <a href="${fileUrl}" class="btn btn-primary" download="${fileName}">
                                <i class="lni lni-download me-1"></i> Download Berkas
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
                                Berkas ini tidak dapat dipreview langsung di browser.
                            </div>
                            <button class="btn btn-primary" onclick="downloadNewFile(${index})">
                                <i class="lni lni-download me-1"></i> Download Berkas
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
            if (confirm('Apakah Anda yakin ingin menghapus berkas ini?')) {
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

                showToast('Success', `Berkas ${file.name} berhasil di-download`, 'success');
            } catch (error) {
                showToast('Error', `Gagal mendownload berkas: ${error.message}`, 'danger');
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
                            Terjadi kesalahan saat memuat berkas ${fileName}.
                        </p>
                        <button class="btn btn-primary" onclick="downloadNewFile(${index})">
                            <i class="lni lni-download me-1"></i> Download Berkas
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

        // ========== VALIDASI FORM SEBELUM SUBMIT ==========
        const uploadForm = document.getElementById('uploadForm');
        if (uploadForm) {
            uploadForm.addEventListener('submit', function(e) {
                // Validasi file size total
                let totalSize = 0;
                newFiles.forEach(file => {
                    totalSize += file.size;
                });

                const maxTotalSize = 50 * 1024 * 1024; // 50MB total
                if (totalSize > maxTotalSize) {
                    e.preventDefault();
                    alert(`Total ukuran berkas melebihi 50MB. Ukuran saat ini: ${formatFileSize(totalSize)}`);
                    return false;
                }

                // Show loading
                const submitBtn = document.getElementById('submitBtn');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="lni lni-spinner-solid spin me-2"></i> Memperbarui...';
                }

                return true;
            });
        }
    });
</script>
@endsection
