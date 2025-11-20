@extends('layouts.guest.app')

@section('content')
    <section class="warga-section py-5">
        <div class="container">

            {{-- HEADER --}}
            <div class="row mb-4 align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <br><br>
                    <h3 class="mb-3">Daftar Permohonan Surat</h3>
                    <p>Berikut adalah daftar permohonan surat yang telah diajukan warga.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('permohonan_surat.create') }}" class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah Permohonann
                    </a>
                </div>
            </div>

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- CARD GRID --}}
            <div class="row g-4">
                @forelse ($data as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">

                            <div class="card-body">
                                <h5 class="card-title">Nomor: {{ $item->nomor_permohonan }}</h5>

                                <p class="card-text mb-1">
                                    <strong>Nama Pemohon:</strong> {{ $item->warga->nama }}
                                </p>

                                <p class="card-text mb-1">
                                    <strong>Jenis Surat:</strong> {{ $item->jenisSurat->nama_jenis }}
                                </p>

                                <p class="card-text mb-1">
                                    <strong>Tgl Pengajuan:</strong> {{ $item->tanggal_pengajuan }}
                                </p>

                                <p class="card-text mb-1">
                                    <strong>Status:</strong>
                                    <span
                                        class="badge
                                    @if ($item->status == 'pending') bg-warning text-dark
                                    @elseif($item->status == 'diproses') bg-primary
                                    @else bg-success @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </p>

                                @if ($item->catatan)
                                    <p class="card-text mb-1">
                                        <strong>Catatan:</strong> {{ $item->catatan }}
                                    </p>
                                @endif
                            </div>


                            {{-- FOOTER --}}
                            <div class="card-footer text-end bg-transparent border-top-0">
                                <a href="{{ route('permohonan_surat.edit', $item->permohonan_id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="lni lni-pencil-alt"></i> Edit
                                </a>

                                <form action="{{ route('permohonan_surat.destroy', $item->permohonan_id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus permohonan ini?')">
                                        <i class="lni lni-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col text-center">
                        <p class="text-muted">Belum ada permohonan surat.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
