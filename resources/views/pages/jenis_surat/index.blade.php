@extends('layouts.guest.app')

@section('content')
<section class="jenis-surat-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <br><br>
                <h3 class="mb-3">Daftar Jenis Surat</h3>
                <p>Berikut adalah data jenis surat yang telah diinputkan.</p>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('jenis_surat.create') }}" class="btn btn-success">
                    <i class="lni lni-plus"></i> Tambah Jenis Surat
                </a>
            </div>
        </div>

        <div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="row g-4">
            @forelse($jenisSurat as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_jenis }}</h5>
                            <p class="card-text mb-1"><strong>Kode:</strong> {{ $item->kode }}</p>
                            @if(!empty($item->syarat_json))
                                <p class="card-text mb-1"><strong>Syarat:</strong></p>
                                <ul>
                                    @foreach($item->syarat_json as $syarat)
                                        <li>{{ $syarat }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="card-footer text-end bg-transparent border-top-0">
                            <a href="{{ route('jenis_surat.edit', $item->jenis_id) }}"
                               class="btn btn-sm btn-primary me-2">
                                <i class="lni lni-pencil-alt me-1"></i> Edit
                            </a>
                            <form action="{{ route('jenis_surat.destroy', $item->jenis_id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus jenis surat ini?')">
                                    <i class="lni lni-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-center">
                    <p class="text-muted">Belum ada data jenis surat.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
