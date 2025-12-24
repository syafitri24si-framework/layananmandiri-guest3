{{-- resources/views/pages/riwayat_status/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="riwayat-status-show" style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
        <div class="row mb-4 align-items-center" style="margin-top: 30px;">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="mb-2" style="margin-bottom: 20px !important;">
                    <i class="lni lni-history me-2"></i>
                    @if(Auth::user()->isAdmin())
                        Riwayat Status Permohonan
                    @else
                        Riwayat Status Saya
                    @endif
                </h3>
                <p class="text-muted mb-0">
                    @if(Auth::user()->isAdmin())
                        Lacak perjalanan status setiap permohonan surat.
                    @else
                        Lacak perjalanan status permohonan Anda.
                    @endif
                </p>
            </div>

            <div class="col-md-6 text-center text-md-end">
                @if(request('permohonan_id'))
                    <a href="{{ route('permohonan_surat.show', request('permohonan_id')) }}"
                       class="btn btn-outline-primary me-2">
                        <i class="lni lni-arrow-left me-1"></i> Kembali ke Permohonan
                    </a>
                @endif
            </div>
        </div>

        {{-- INFO BOX UNTUK WARGA --}}
        @if(Auth::user()->isWarga() && !Auth::user()->hasWargaData())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="lni lni-warning me-2"></i>
                <strong>Perhatian!</strong> Anda belum memiliki riwayat status karena belum memiliki data warga.
                Silakan <a href="{{ route('warga.create') }}" class="alert-link">lengkapi data pribadi</a> terlebih dahulu.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- FORM FILTER --}}
        <form method="GET" action="{{ route('riwayat_status.index') }}" class="mb-4">
            <div class="row align-items-center">
                {{-- Filter Permohonan --}}
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-notepad"></i>
                        <select class="form-select" name="permohonan_id">
                            <option value="">Semua Permohonan</option>
                            @foreach($permohonanList as $permohonan)
                                <option value="{{ $permohonan->permohonan_id }}"
                                        {{ request('permohonan_id') == $permohonan->permohonan_id ? 'selected' : '' }}>
                                    #{{ $permohonan->nomor_permohonan }} - {{ $permohonan->warga->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Filter Status --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-list"></i>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
                        </select>
                    </div>
                </div>

                {{-- Filter Tanggal --}}
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="date" name="start_date" class="form-control"
                                   value="{{ request('start_date') }}" placeholder="Dari Tanggal">
                        </div>
                        <div class="col-6">
                            <input type="date" name="end_date" class="form-control"
                                   value="{{ request('end_date') }}" placeholder="Sampai Tanggal">
                        </div>
                    </div>
                </div>

                {{-- Search --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari petugas/keterangan..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="lni lni-search-alt"></i>
                        </button>
                    </div>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-2">
                    @if(request()->hasAny(['permohonan_id', 'status', 'start_date', 'end_date', 'search']))
                        <a href="{{ route('riwayat_status.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="lni lni-close me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>

        {{-- CARD TIMELINE --}}
        <div class="row">
            <div class="col-12">
                @forelse ($riwayatData as $riwayat)
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                {{-- Status Badge --}}
                                <div class="col-md-2">
                                    <div class="text-center mb-3 mb-md-0">
                                        <span class="badge
                                            @if($riwayat->status == 'selesai') bg-success
                                            @elseif($riwayat->status == 'ditolak') bg-danger
                                            @elseif($riwayat->status == 'diproses') bg-primary
                                            @elseif($riwayat->status == 'diambil') bg-info
                                            @else bg-secondary @endif
                                            fs-6 px-3 py-2">
                                            {{ strtoupper($riwayat->status) }}
                                        </span>
                                        <div class="text-muted small mt-2">
                                            {{ $riwayat->waktu->format('H:i') }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Informasi --}}
                                <div class="col-md-6">
                                    <h6 class="mb-1">
                                        <i class="lni lni-notepad me-1"></i>
                                        Permohonan #{{ $riwayat->permohonan->nomor_permohonan }}
                                    </h6>
                                    <p class="mb-1 text-muted">
                                        <i class="lni lni-user me-1"></i>
                                        {{ $riwayat->permohonan->warga->nama }}
                                        <small class="ms-2">
                                            ({{ $riwayat->permohonan->jenisSurat->nama_jenis }})
                                        </small>
                                    </p>

                                    @if($riwayat->petugas)
                                        <p class="mb-1">
                                            <i class="lni lni-user-check me-1"></i>
                                            Petugas: {{ $riwayat->petugas->nama }}
                                        </p>
                                    @endif

                                    @if($riwayat->keterangan)
                                        <div class="alert alert-light mt-2 mb-0 p-2 small">
                                            <i class="lni lni-comment me-1"></i>
                                            {{ $riwayat->keterangan }}
                                        </div>
                                    @endif

                                    {{-- File Pendukung --}}
                                    @php
                                        $mediaFiles = App\Models\Media::where('ref_table', 'riwayat_status_surat')
                                            ->where('ref_id', $riwayat->riwayat_id)
                                            ->get();
                                    @endphp

                                    @if($mediaFiles->count() > 0)
                                        <div class="mt-2">
                                            <small class="text-muted d-block mb-1">
                                                <i class="lni lni-paperclip me-1"></i> File Pendukung:
                                            </small>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($mediaFiles as $file)
                                                    <a href="{{ asset('uploads/riwayat_status/' . $file->file_name) }}"
                                                       target="_blank" class="badge bg-light text-dark">
                                                        <i class="lni
                                                            @if(str_contains($file->mime_type, 'image')) lni-image
                                                            @elseif($file->mime_type == 'application/pdf') lni-empty-file
                                                            @else lni-file @endif me-1">
                                                        </i>
                                                        {{ $file->caption ?? 'File' }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Tanggal & Aksi --}}
                                <div class="col-md-4 text-md-end">
                                    <div class="text-muted mb-2">
                                        <i class="lni lni-calendar me-1"></i>
                                        {{ $riwayat->waktu->format('d M Y') }}
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('riwayat_status.show', $riwayat->permohonan_id) }}"
                                           class="btn btn-outline-primary">
                                            <i class="lni lni-eye me-1"></i> Lihat
                                        </a>
                                        {{-- UPLOAD FILE: Hanya untuk Admin --}}
                                        @if(Auth::user()->isAdmin())
                                            <button type="button" class="btn btn-outline-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalFile{{ $riwayat->riwayat_id }}">
                                                <i class="lni lni-upload me-1"></i> File
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL UPLOAD FILE (Hanya untuk Admin) --}}
                    @if(Auth::user()->isAdmin())
                    <div class="modal fade" id="modalFile{{ $riwayat->riwayat_id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('riwayat_status.upload', $riwayat->riwayat_id) }}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload File Pendukung</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">File Pendukung</label>
                                            <input type="file" name="files[]" multiple class="form-control"
                                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                            <small class="text-muted">Upload bukti/file pendukung untuk riwayat ini</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan File</label>
                                            <input type="text" name="caption" class="form-control"
                                                   placeholder="Contoh: Bukti tanda tangan, Foto dokumentasi">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="lni lni-history text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">
                                @if(Auth::user()->isAdmin())
                                    Belum ada riwayat status
                                @else
                                    Belum ada riwayat status permohonan Anda
                                @endif
                            </h5>
                            <p class="text-muted">
                                @if(Auth::user()->isAdmin())
                                    Riwayat akan muncul setelah ada perubahan status permohonan
                                @elseif(Auth::user()->isWarga() && Auth::user()->hasWargaData())
                                    Anda belum memiliki permohonan surat
                                @else
                                    Silakan lengkapi data pribadi terlebih dahulu
                                @endif
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- PAGINATION --}}
        @if($riwayatData->hasPages())
            <div class="mt-5">
                {{ $riwayatData->links('pagination::bootstrap-5') }}
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
    .card {
        transition: transform 0.2s ease-in-out;
        border-left: 4px solid #dee2e6;
    }
    .card:hover {
        transform: translateY(-2px);
        border-left-color: #0d6efd;
    }
    .badge {
        font-size: 0.75em;
    }
    .empty-state {
        opacity: 0.7;
    }
</style>
@endsection
