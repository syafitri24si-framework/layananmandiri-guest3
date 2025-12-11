{{-- resources/views/pages/berkas_persyaratan/index.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section class="berkas-section py-5">
        <div class="container">
            <div class="row mb-4 align-items-center" style="margin-top: 30px;">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="mb-2" style="margin-bottom: 20px !important;">
                        <i class="lni lni-folder me-2"></i> Berkas Persyaratan
                    </h3>
                    <p class="text-muted mb-0">Kelola berkas persyaratan untuk setiap permohonan surat.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('berkas_persyaratan.create', ['permohonan_id' => request('permohonan_id')]) }}"
                        class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah Berkas
                    </a>
                </div>
            </div>

            {{-- FORM FILTER --}}
            <form method="GET" action="{{ route('berkas_persyaratan.index') }}" class="mb-4">
                <div class="row align-items-center">
                    {{-- Filter Permohonan --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-notepad"></i>
                            <select class="form-select" name="permohonan_id">
                                <option value="">Semua Permohonan</option>
                                @foreach ($permohonanList as $permohonan)
                                    <option value="{{ $permohonan->permohonan_id }}"
                                        {{ request('permohonan_id') == $permohonan->permohonan_id ? 'selected' : '' }}>
                                        #{{ $permohonan->nomor_permohonan }} - {{ $permohonan->warga->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Filter Status Validasi --}}
                    <div class="col-md-2 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-checkmark-circle"></i>
                            <select class="form-select" name="valid">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('valid') == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="valid" {{ request('valid') == 'valid' ? 'selected' : '' }}>Valid</option>
                                <option value="tidak_valid" {{ request('valid') == 'tidak_valid' ? 'selected' : '' }}>Tidak
                                    Valid</option>
                            </select>
                        </div>
                    </div>

                    {{-- Filter Jenis Berkas --}}
                    <div class="col-md-2 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-files"></i>
                            <select class="form-select" name="nama_berkas">
                                <option value="">Semua Jenis</option>
                                <option value="KTP" {{ request('nama_berkas') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                <option value="KK" {{ request('nama_berkas') == 'KK' ? 'selected' : '' }}>KK</option>
                                <option value="Surat Pengantar RT/RW"
                                    {{ request('nama_berkas') == 'Surat Pengantar RT/RW' ? 'selected' : '' }}>Surat
                                    Pengantar</option>
                                <option value="Pas Foto" {{ request('nama_berkas') == 'Pas Foto' ? 'selected' : '' }}>Pas
                                    Foto</option>
                                <option value="Surat Keterangan"
                                    {{ request('nama_berkas') == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan
                                </option>
                                <option value="Ijazah" {{ request('nama_berkas') == 'Ijazah' ? 'selected' : '' }}>Ijazah
                                </option>
                                <option value="Akte Kelahiran"
                                    {{ request('nama_berkas') == 'Akte Kelahiran' ? 'selected' : '' }}>Akte Kelahiran
                                </option>
                                <option value="Akte Nikah" {{ request('nama_berkas') == 'Akte Nikah' ? 'selected' : '' }}>
                                    Akte Nikah</option>
                                <option value="NPWP" {{ request('nama_berkas') == 'NPWP' ? 'selected' : '' }}>NPWP
                                </option>
                                <option value="Lainnya" {{ request('nama_berkas') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama berkas..."
                                value="{{ request('search') }}">
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
                    <div class="col-md-2">
                        @if (request()->hasAny(['permohonan_id', 'valid', 'nama_berkas', 'search']))
                            <a href="{{ route('berkas_persyaratan.index') }}" class="btn btn-outline-secondary w-100">
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

            {{-- CARD GRID BERKAS --}}
            <div class="row g-4">
                @forelse ($berkasData as $berkas)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                {{-- Header dengan Nama Berkas --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">
                                        <i class="lni lni-file me-1"></i>
                                        {{ $berkas->nama_berkas == 'Lainnya' ? $berkas->nama_berkas_custom ?? 'Lainnya' : $berkas->nama_berkas }}
                                    </h5>
                                    <span
                                        class="badge
                                    @if ($berkas->valid == 'valid') bg-success
                                    @elseif($berkas->valid == 'tidak_valid') bg-danger
                                    @else bg-warning text-dark @endif">
                                        {{ ucfirst(str_replace('_', ' ', $berkas->valid)) }}
                                    </span>
                                </div>

                                {{-- Informasi Dasar --}}
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center text-muted mb-1">
                                                <i class="lni lni-notepad me-2"></i>
                                                <small>No. Permohonan</small>
                                            </div>
                                            <p class="mb-0">
                                                <strong>#{{ $berkas->permohonan->nomor_permohonan }}</strong>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center text-muted mb-1">
                                                <i class="lni lni-user me-2"></i>
                                                <small>Pemohon</small>
                                            </div>
                                            <p class="mb-0">{{ $berkas->permohonan->warga->nama }}</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Detail Jenis Surat dan Berkas --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-files me-2"></i>
                                        <small>Detail</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Jenis Surat</small>
                                            <p class="mb-2">{{ $berkas->permohonan->jenisSurat->nama_jenis ?? '-' }}</p>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Jenis Berkas</small>
                                            <p class="mb-2">
                                                {{ $berkas->nama_berkas == 'Lainnya' ? 'Berkas Kustom' : $berkas->nama_berkas }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($berkas->nama_berkas == 'Lainnya' && $berkas->nama_berkas_custom)
                                        <div class="row">
                                            <div class="col-12">
                                                <small class="text-muted d-block">Nama Berkas Kustom</small>
                                                <p class="mb-0"><em>{{ $berkas->nama_berkas_custom }}</em></p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- File Upload Details --}}
                                @php
                                    $mediaFiles = App\Models\Media::where('ref_table', 'berkas_persyaratan')
                                        ->where('ref_id', $berkas->berkas_id)
                                        ->get();
                                @endphp

                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between text-muted mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="lni lni-paperclip me-2"></i>
                                            <small>File Upload</small>
                                        </div>
                                        @if ($mediaFiles->count() > 0)
                                            <span class="badge bg-primary">{{ $mediaFiles->count() }} file</span>
                                        @endif
                                    </div>

                                    @if ($mediaFiles->count() > 0)
                                        <div class="file-list">
                                            @foreach ($mediaFiles->take(3) as $index => $media)
                                                <div class="file-item d-flex align-items-center mb-2 p-2 bg-light rounded">
                                                    <div class="me-2">
                                                        @php
                                                            $fileIcon = 'lni lni-file';
                                                            $fileExt = pathinfo($media->file_name, PATHINFO_EXTENSION);
                                                            if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                                $fileIcon = 'lni lni-image';
                                                            } elseif ($fileExt == 'pdf') {
                                                                $fileIcon = 'lni lni-empty-file';
                                                            } elseif (in_array($fileExt, ['doc', 'docx'])) {
                                                                $fileIcon = 'lni lni-files';
                                                            } elseif (in_array($fileExt, ['xls', 'xlsx'])) {
                                                                $fileIcon = 'lni lni-bar-chart';
                                                            }
                                                        @endphp
                                                        <i class="{{ $fileIcon }} text-primary"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between">
                                                            <small class="text-truncate" style="max-width: 120px;"
                                                                title="{{ $media->file_name }}">
                                                                {{ $media->file_name }}
                                                            </small>
                                                            @if ($media->caption)
                                                                <span class="badge bg-info"
                                                                    title="Caption: {{ $media->caption }}">C</span>
                                                            @endif
                                                        </div>
                                                        <small class="text-muted d-block">
                                                            {{ \Carbon\Carbon::parse($media->created_at)->format('d M Y') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if ($mediaFiles->count() > 3)
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">
                                                        <i class="lni lni-more-alt me-1"></i>
                                                        dan {{ $mediaFiles->count() - 3 }} file lainnya
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-2 bg-light rounded">
                                            <small class="text-danger">
                                                <i class="lni lni-warning me-1"></i> Belum ada file diupload
                                            </small>
                                        </div>
                                    @endif
                                </div>

                                {{-- Timestamps --}}
                                <div class="border-top pt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Dibuat</small>
                                            <small>{{ \Carbon\Carbon::parse($berkas->created_at)->format('d M Y H:i') }}</small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Diperbarui</small>
                                            <small>{{ \Carbon\Carbon::parse($berkas->updated_at)->format('d M Y H:i') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- FOOTER - ACTION BUTTONS --}}
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <div class="d-flex justify-content-between">
                                    {{-- TOMBOL DETAIL --}}
                                    <a href="{{ route('berkas_persyaratan.show', $berkas->berkas_id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="lni lni-eye me-1"></i> Detail
                                    </a>

                                    {{-- TOMBOL EDIT --}}
                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                        <a href="{{ route('berkas_persyaratan.edit', $berkas->berkas_id) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="lni lni-pencil-alt me-1"></i> Edit
                                        </a>

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('berkas_persyaratan.destroy', $berkas->berkas_id) }}"
                                            method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus berkas ini? File akan dihapus permanen.')">
                                                <i class="lni lni-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="lni lni-folder text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">Belum ada berkas persyaratan</h5>
                            <p class="text-muted">Silakan tambah berkas untuk permohonan surat</p>
                            <a href="{{ route('berkas_persyaratan.create') }}" class="btn btn-primary mt-2">
                                <i class="lni lni-plus"></i> Tambah Berkas Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if ($berkasData->hasPages())
                <div class="mt-5">
                    {{ $berkasData->links('pagination::bootstrap-5') }}
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

        /* Perbaikan untuk text alignment */
        .card-title {
            font-size: 1rem;
            line-height: 1.4;
        }

        .card-body {
            padding: 1.25rem;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Berkas index page loaded');
        });
    </script>
@endsection
