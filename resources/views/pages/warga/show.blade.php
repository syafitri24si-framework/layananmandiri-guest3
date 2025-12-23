{{-- resources/views/pages/warga/show.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section class="warga-show" style="padding-top: 120px; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm position-relative" style="z-index: 10;">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('warga.index') }}"
                                       class="text-decoration-none">
                                        <i class="lni lni-users me-1"></i> Daftar Warga
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Warga
                                </li>
                            </ol>
                        </nav>
                        <h3 class="mb-0 text-primary">
                            <i class="lni lni-eye me-2"></i>
                            Detail Data Warga
                        </h3>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('warga.index') }}"
                           class="btn btn-outline-secondary px-3 py-2">
                            <i class="lni lni-arrow-left me-2"></i> Kembali
                        </a>
                        @if (Auth::check() && Auth::user()->role === 'Admin')
                        <a href="{{ route('warga.edit', $warga->warga_id) }}"
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
                                <i class="lni lni-user me-2"></i>
                                {{ $warga->nama }}
                            </h5>
                            <span class="badge bg-white text-primary fs-6 px-3 py-2">
                                ID: #{{ str_pad($warga->warga_id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Status Badge --}}
                        <div class="mb-4">
                            <span class="badge
                                @if($warga->jenis_kelamin == 'Laki-laki') bg-primary
                                @else bg-pink @endif fs-6 p-3">
                                @if($warga->jenis_kelamin == 'Laki-laki')
                                    <i class="lni lni-male me-1"></i>
                                    Laki-laki
                                @else
                                    <i class="lni lni-female me-1"></i>
                                    Perempuan
                                @endif
                            </span>
                        </div>

                        <div class="row">
                            {{-- Kolom Kiri: Informasi Pribadi --}}
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-id-card me-2"></i> Informasi Pribadi
                                        </h6>

                                        <div class="row g-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">No. KTP</small>
                                                <p class="mb-0 fw-semibold">{{ $warga->no_ktp }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Nama Lengkap</small>
                                                <p class="mb-0 fw-semibold">{{ $warga->nama }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Jenis Kelamin</small>
                                                <p class="mb-0">{{ $warga->jenis_kelamin }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Agama</small>
                                                <p class="mb-0">{{ $warga->agama }}</p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Pekerjaan</small>
                                                <p class="mb-0">
                                                    @if($warga->pekerjaan)
                                                        {{ $warga->pekerjaan }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Status Data</small>
                                                <span class="badge bg-success">
                                                    <i class="lni lni-checkmark-circle me-1"></i> Aktif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Informasi Kontak & Waktu --}}
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="card-title border-bottom pb-2 mb-3">
                                            <i class="lni lni-phone me-2"></i> Informasi Kontak & Waktu
                                        </h6>

                                        <div class="row g-3">
                                            @if($warga->telp)
                                            <div class="col-6">
                                                <small class="text-muted d-block">No. Telepon</small>
                                                <p class="mb-0 fw-semibold">{{ $warga->telp }}</p>
                                            </div>
                                            @endif

                                            @if($warga->email)
                                            <div class="{{ $warga->telp ? 'col-6' : 'col-12' }}">
                                                <small class="text-muted d-block">Email</small>
                                                <p class="mb-0 fw-semibold text-truncate">{{ $warga->email }}</p>
                                            </div>
                                            @endif

                                            <div class="col-6">
                                                <small class="text-muted d-block">Dibuat Pada</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($warga->created_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>

                                            <div class="col-6">
                                                <small class="text-muted d-block">Diperbarui Pada</small>
                                                <p class="mb-0">
                                                    {{ \Carbon\Carbon::parse($warga->updated_at)->format('d F Y H:i') }}
                                                </p>
                                            </div>

                                            @if(!$warga->telp && !$warga->email)
                                            <div class="col-12">
                                                <div class="alert alert-warning mb-0 mt-2">
                                                    <i class="lni lni-warning me-2"></i>
                                                    <small>Belum ada informasi kontak (telepon/email)</small>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Tambahan --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-info text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="lni lni-notepad me-2"></i>
                                Informasi Tambahan
                            </h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Statistik Warga --}}
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-4 h-100">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="lni lni-stats-up me-2"></i> Statistik Warga
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <small class="text-muted d-block">Usia Data</small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($warga->created_at)->diffForHumans() }}
                                            </p>
                                            <small class="text-muted">
                                                Terdaftar sejak {{ \Carbon\Carbon::parse($warga->created_at)->format('d M Y') }}
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted d-block">Terakhir Diperbarui</small>
                                            <p class="mb-0 fw-semibold">
                                                {{ \Carbon\Carbon::parse($warga->updated_at)->diffForHumans() }}
                                            </p>
                                            <small class="text-muted">
                                                Perubahan terakhir: {{ \Carbon\Carbon::parse($warga->updated_at)->format('d M Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Kelengkapan Data --}}
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-4 h-100">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="lni lni-checkmark-circle me-2"></i> Status Kelengkapan Data
                                    </h6>
                                    <div class="row g-3">
                                        @php
                                            $totalFields = 7; // total field warga
                                            $filledFields = 0;
                                            $fields = [
                                                'No KTP' => $warga->no_ktp,
                                                'Nama' => $warga->nama,
                                                'Jenis Kelamin' => $warga->jenis_kelamin,
                                                'Agama' => $warga->agama,
                                                'Pekerjaan' => $warga->pekerjaan,
                                                'Telepon' => $warga->telp,
                                                'Email' => $warga->email,
                                            ];

                                            foreach ($fields as $field => $value) {
                                                if (!empty($value)) $filledFields++;
                                            }
                                            $completionPercentage = round(($filledFields / $totalFields) * 100);
                                        @endphp

                                        <div class="col-12">
                                            <small class="text-muted d-block mb-2">Kelengkapan Data</small>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 10px;">
                                                    <div class="progress-bar
                                                        @if($completionPercentage >= 80) bg-success
                                                        @elseif($completionPercentage >= 50) bg-warning
                                                        @else bg-danger @endif"
                                                        role="progressbar"
                                                        style="width: {{ $completionPercentage }}%"
                                                        aria-valuenow="{{ $completionPercentage }}"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <span class="badge
                                                    @if($completionPercentage >= 80) bg-success
                                                    @elseif($completionPercentage >= 50) bg-warning
                                                    @else bg-danger @endif">
                                                    {{ $completionPercentage }}%
                                                </span>
                                            </div>
                                            <small class="text-muted mt-1 d-block">
                                                {{ $filledFields }} dari {{ $totalFields }} data terisi
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted d-block">Data yang Belum Lengkap</small>
                                            <div class="mt-1">
                                                @if(empty($warga->pekerjaan))
                                                <span class="badge bg-warning text-dark me-1 mb-1">Pekerjaan</span>
                                                @endif
                                                @if(empty($warga->telp))
                                                <span class="badge bg-warning text-dark me-1 mb-1">Telepon</span>
                                                @endif
                                                @if(empty($warga->email))
                                                <span class="badge bg-warning text-dark me-1 mb-1">Email</span>
                                                @endif
                                                @if($filledFields == $totalFields)
                                                <span class="badge bg-success">Semua Data Lengkap</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="mb-3">
                                <i class="lni lni-bolt me-2"></i> Aksi Cepat
                            </h6>
                            <div class="d-flex flex-wrap gap-3">
                                @if (Auth::check() && Auth::user()->role === 'Admin')
                                <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                   class="btn btn-outline-primary px-4 py-2">
                                    <i class="lni lni-pencil me-2"></i> Edit Data Warga
                                </a>
                                <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger px-4 py-2"
                                            onclick="return confirm('Hapus data warga ini? Tindakan ini tidak dapat dibatalkan.')">
                                        <i class="lni lni-trash-can me-2"></i> Hapus Warga
                                    </button>
                                </form>
                                @endif
                                @if($warga->email)
                                <button type="button" class="btn btn-outline-success px-4 py-2" id="sendEmailBtn">
                                    <i class="lni lni-envelope me-2"></i> Kirim Email
                                </button>
                                @endif
                                <button type="button" class="btn btn-outline-info px-4 py-2" id="printDataBtn">
                                    <i class="lni lni-printer me-2"></i> Cetak Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .position-relative {
        z-index: 10;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 500;
    }

    .bg-pink {
        background-color: #f78fb3 !important;
        color: #fff;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 4px;
    }

    .progress-bar {
        border-radius: 4px;
    }

    .border-top {
        border-top: 1px solid #dee2e6 !important;
    }

    .btn-outline-primary {
        border-color: #3498db;
        color: #3498db;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        color: white;
    }

    .btn-outline-danger {
        border-color: #e74c3c;
        color: #e74c3c;
    }

    .btn-outline-danger:hover {
        background-color: #e74c3c;
        color: white;
    }

    .btn-outline-success {
        border-color: #27ae60;
        color: #27ae60;
    }

    .btn-outline-success:hover {
        background-color: #27ae60;
        color: white;
    }

    .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: white;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
        border-color: #e67e22;
        color: white;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Warga show page loaded');

    // Send email button
    const sendEmailBtn = document.getElementById('sendEmailBtn');
    if (sendEmailBtn) {
        sendEmailBtn.addEventListener('click', function() {
            const email = "{{ $warga->email }}";
            if (confirm('Kirim email ke ' + email + '?')) {
                // Disable button dan show loading
                this.disabled = true;
                this.innerHTML = '<i class="lni lni-spinner-solid spin me-2"></i> Mengirim...';

                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                    alertDiv.innerHTML = `
                        <i class="lni lni-checkmark-circle me-2"></i>
                        Email telah dikirim ke ${email}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;

                    // Insert before the quick actions section
                    const quickActions = document.querySelector('.mt-4.pt-3.border-top');
                    quickActions.parentElement.insertBefore(alertDiv, quickActions);

                    // Reset button
                    this.disabled = false;
                    this.innerHTML = '<i class="lni lni-envelope me-2"></i> Kirim Email';
                }, 1500);
            }
        });
    }

    // Print data button
    const printDataBtn = document.getElementById('printDataBtn');
    if (printDataBtn) {
        printDataBtn.addEventListener('click', function() {
            // Create print content
            const printContent = `
                <html>
                <head>
                    <title>Data Warga - {{ $warga->nama }}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
                        .info-section { margin-bottom: 20px; }
                        .info-row { display: flex; margin-bottom: 8px; }
                        .info-label { font-weight: bold; width: 150px; }
                        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #666; }
                        .timestamp { font-size: 12px; color: #999; text-align: right; }
                    </style>
                </head>
                <body>
                    <div class="timestamp">Dicetak pada: ${new Date().toLocaleString()}</div>
                    <h2>Data Warga - {{ $warga->nama }}</h2>

                    <div class="info-section">
                        <h3>Informasi Pribadi</h3>
                        <div class="info-row"><span class="info-label">Warga ID:</span> #{{ $warga->warga_id }}</div>
                        <div class="info-row"><span class="info-label">No. KTP:</span> {{ $warga->no_ktp }}</div>
                        <div class="info-row"><span class="info-label">Nama:</span> {{ $warga->nama }}</div>
                        <div class="info-row"><span class="info-label">Jenis Kelamin:</span> {{ $warga->jenis_kelamin }}</div>
                        <div class="info-row"><span class="info-label">Agama:</span> {{ $warga->agama }}</div>
                        <div class="info-row"><span class="info-label">Pekerjaan:</span> {{ $warga->pekerjaan ?: '-' }}</div>
                    </div>

                    <div class="info-section">
                        <h3>Informasi Kontak</h3>
                        <div class="info-row"><span class="info-label">Telepon:</span> {{ $warga->telp ?: '-' }}</div>
                        <div class="info-row"><span class="info-label">Email:</span> {{ $warga->email ?: '-' }}</div>
                    </div>

                    <div class="info-section">
                        <h3>Informasi Sistem</h3>
                        <div class="info-row"><span class="info-label">Dibuat Pada:</span> {{ $warga->created_at->format('d F Y H:i') }}</div>
                        <div class="info-row"><span class="info-label">Diperbarui Pada:</span> {{ $warga->updated_at->format('d F Y H:i') }}</div>
                    </div>

                    <div class="footer">
                        <hr>
                        <p>Data warga - Sistem Bina Desa</p>
                        <p>Dokumen ini dicetak dari sistem administrasi warga</p>
                    </div>
                </body>
                </html>
            `;

            // Open print window
            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.focus();

            // Wait for content to load then print
            setTimeout(() => {
                printWindow.print();
                // printWindow.close(); // Optional: close after printing
            }, 500);
        });
    }

    // Delete confirmation
    const deleteForm = document.querySelector('form[action*="destroy"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const confirmDelete = confirm('Hapus data warga "{{ $warga->nama }}" (KTP: {{ $warga->no_ktp }})?\n\nTindakan ini akan menghapus data warga secara permanen dan tidak dapat dikembalikan.');
            if (!confirmDelete) {
                e.preventDefault();
            }
        });
    }

    // Add spinner animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spin {
            animation: spin 1s linear infinite;
            display: inline-block;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
