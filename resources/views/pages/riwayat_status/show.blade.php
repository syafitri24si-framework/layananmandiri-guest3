@extends('layouts.guest.app')

@section('content')
<section class="riwayat-status-show" style="padding-top: 120px; min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    {{-- Header --}}
                    <div
                        class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm position-relative">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('riwayat_status.index') }}" class="text-decoration-none">
                                            <i class="lni lni-folder me-1"></i> Riwayat Status Surat
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail Riwayat</li>
                                </ol>
                            </nav>

                            <h3 class="mb-0 text-primary">
                                <i class="lni lni-eye me-2"></i>
                                Detail Riwayat Status
                            </h3>
                        </div>

                        <a href="{{ route('riwayat_status.index') }}" class="btn btn-outline-secondary px-3 py-2">
                            <i class="lni lni-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    {{-- Alert --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            <i class="lni lni-checkmark-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Card Detail --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0">
                                <i class="lni lni-notepad me-2"></i>
                                Status: {{ ucfirst($data->status) }}
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                {{-- Informasi Status --}}
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="card-title border-bottom pb-2 mb-3">
                                                <i class="lni lni-info me-2"></i> Informasi Status
                                            </h6>

                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <small class="text-muted">Status</small>
                                                    <p class="fw-semibold text-capitalize">{{ $data->status }}</p>
                                                </div>

                                                <div class="col-6">
                                                    <small class="text-muted">Waktu</small>
                                                    <p>
                                                        {{ \Carbon\Carbon::parse($data->waktu)->format('d F Y H:i') }}
                                                    </p>
                                                </div>

                                                @if ($data->petugas)
                                                    <div class="col-12">
                                                        <small class="text-muted">Petugas</small>
                                                        <p class="fw-semibold">{{ $data->petugas->nama }}</p>
                                                    </div>
                                                @endif

                                                @if ($data->keterangan)
                                                    <div class="col-12">
                                                        <small class="text-muted">Keterangan</small>
                                                        <p>{{ $data->keterangan }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Informasi Permohonan --}}
                                <div class="col-md-6 mb-4">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="card-title border-bottom pb-2 mb-3">
                                                <i class="lni lni-folder me-2"></i>
                                                Permohonan Terkait
                                            </h6>

                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <small class="text-muted">Nomor Permohonan</small>
                                                    <p class="fw-semibold">{{ $data->permohonan->nomor_permohonan }}</p>
                                                </div>

                                                <div class="col-6">
                                                    <small class="text-muted">Jenis Surat</small>
                                                    <p class="fw-semibold">{{ $data->permohonan->jenisSurat->nama_jenis }}
                                                    </p>
                                                </div>

                                                <div class="col-12">
                                                    <small class="text-muted">Nama Pemohon</small>
                                                    <p>{{ $data->permohonan->warga->nama }}</p>
                                                </div>

                                                <div class="col-12">
                                                    <a href="{{ route('permohonan_surat.show', $data->permohonan->permohonan_id) }}"
                                                        class="btn btn-primary btn-sm mt-2">
                                                        <i class="lni lni-eye me-1"></i> Lihat Permohonan
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- File Upload --}}
                            <div class="card border-0 bg-light mt-2">
                                <div class="card-body">
                                    <h6 class="card-title border-bottom pb-2 mb-3">
                                        <i class="lni lni-files me-2"></i> Lampiran ({{ $data->mediaFiles->count() }})
                                    </h6>

                                    @if ($data->mediaFiles->count() > 0)
                                        <div class="row g-4">
                                            @foreach ($data->mediaFiles as $file)
                                                <div class="col-md-4">
                                                    <div class="file-card bg-white border rounded p-3 h-100">
                                                        <h6 class="fw-semibold">
                                                            {{ strlen($file->file_name) > 20 ? substr($file->file_name, 0, 17) . '...' : $file->file_name }}
                                                        </h6>

                                                        <small class="text-muted">{{ $file->mime_type }}</small>

                                                        @if ($file->caption)
                                                            <div class="bg-light p-2 rounded mt-2">
                                                                <small class="text-muted">Caption:</small>
                                                                <p class="small mb-0">{{ $file->caption }}</p>
                                                            </div>
                                                        @endif

                                                        <div class="mt-3">
                                                            <a href="{{ $file->file_url }}"
                                                                class="btn btn-outline-success btn-sm" download>
                                                                <i class="lni lni-download me-1"></i> Download
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="lni lni-empty-file display-4 text-muted"></i>
                                            <p class="text-muted mb-0 mt-2">Belum ada lampiran pada riwayat ini.</p>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
