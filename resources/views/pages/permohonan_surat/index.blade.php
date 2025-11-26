@extends('layouts.guest.app')

@section('content')
<section class="warga-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center" style="margin-top: 30px;">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="mb-2" style="margin-bottom: 20px !important;">Bina Desa - Daftar Permohonan Surat</h3>
                <p class="text-muted mb-0">Berikut adalah daftar permohonan surat yang telah diajukan warga.</p>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('permohonan_surat.create') }}" class="btn btn-success">
                    <i class="lni lni-plus"></i> Tambah Permohonan
                </a>
            </div>
        </div>

        {{-- FORM FILTER DENGAN SEARCH --}}
        <form method="GET" action="{{ route('permohonan_surat.index') }}" class="mb-4">
            <div class="row align-items-center">
                {{-- Filter Status --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-list"></i>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>

                {{-- Filter Jenis Surat --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-files"></i>
                        <select class="form-select" name="jenis_id">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisSurat as $jenis)
                                <option value="{{ $jenis->jenis_id }}" {{ request('jenis_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Filter Warga --}}
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="select-wrapper">
                        <i class="lni lni-users"></i>
                        <select class="form-select" name="warga_id">
                            <option value="">Semua Warga</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ request('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Search Input --}}
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari no. permohonan, nama warga, atau jenis surat..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="lni lni-search-alt me-1"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-danger ms-2">
                                <i class="lni lni-close me-1"></i> Clear
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-2">
                    @if(request()->hasAny(['status', 'jenis_id', 'warga_id', 'search']))
                        <a href="{{ route('permohonan_surat.index') }}" class="btn btn-outline-secondary w-100">
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
            @forelse ($data as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            {{-- Header dengan Nomor Permohonan --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">#{{ $item->nomor_permohonan }}</h5>
                                <span class="badge
                                    @if ($item->status == 'pending') bg-warning text-dark
                                    @elseif($item->status == 'diproses') bg-primary
                                    @elseif($item->status == 'selesai') bg-success
                                    @else bg-danger @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            {{-- Informasi Pemohon --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-1">
                                    <i class="lni lni-user me-2"></i>
                                    <small>Pemohon</small>
                                </div>
                                <p class="mb-0">{{ $item->warga->nama }}</p>
                            </div>

                            {{-- Jenis Surat --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-1">
                                    <i class="lni lni-files me-2"></i>
                                    <small>Jenis Surat</small>
                                </div>
                                <p class="mb-0">{{ $item->jenisSurat->nama_jenis }}</p>
                            </div>

                            {{-- Tanggal Pengajuan --}}
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-1">
                                    <i class="lni lni-calendar me-2"></i>
                                    <small>Tanggal Pengajuan</small>
                                </div>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}</p>
                            </div>

                            {{-- Catatan --}}
                            @if ($item->catatan)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-notepad me-2"></i>
                                        <small>Catatan</small>
                                    </div>
                                    <p class="mb-0 small">{{ $item->catatan }}</p>
                                </div>
                            @endif

                            {{-- Tanggal Dibuat & Diupdate --}}
                            <div class="small text-muted mt-3 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <span>Dibuat:</span>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Diupdate:</span>
                                    <span>{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- FOOTER - ACTION BUTTONS --}}
                        <div class="card-footer bg-transparent border-top-0 pt-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('permohonan_surat.edit', $item->permohonan_id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="lni lni-pencil-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('permohonan_surat.destroy', $item->permohonan_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus permohonan ini?')">
                                        <i class="lni lni-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="lni lni-files text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Belum ada permohonan surat</h5>
                        <p class="text-muted">Silakan tambah permohonan surat baru untuk memulai</p>
                        <a href="{{ route('permohonan_surat.create') }}" class="btn btn-primary mt-2">
                            <i class="lni lni-plus"></i> Tambah Permohonan Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($data->hasPages())
            <div class="mt-5">
                {{ $data->links('pagination::bootstrap-5') }}
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
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .empty-state {
        opacity: 0.7;
    }
</style>
@endsection
