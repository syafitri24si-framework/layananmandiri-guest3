@extends('layouts.guest.app')

@section('content')
<section class="warga-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h3 class="mb-3">Daftar Warga</h3>
                <p>Berikut adalah data warga yang telah diinputkan.</p>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('warga.create') }}" class="btn btn-success">
                    <i class="lni lni-plus"></i> Tambah Data
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
            @forelse($warga as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text mb-1"><strong>No KTP:</strong> {{ $item->no_ktp }}</p>
                            <p class="card-text mb-1"><strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin }}</p>
                            <p class="card-text mb-1"><strong>Agama:</strong> {{ $item->agama }}</p>
                            @if($item->pekerjaan)
                                <p class="card-text mb-1"><strong>Pekerjaan:</strong> {{ $item->pekerjaan }}</p>
                            @endif
                            @if($item->telp)
                                <p class="card-text mb-1"><strong>Telp:</strong> {{ $item->telp }}</p>
                            @endif
                            @if($item->email)
                                <p class="card-text mb-1"><strong>Email:</strong> {{ $item->email }}</p>
                            @endif

                        </div>
                         <div class="card-footer text-end bg-transparent border-top-0">
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data warga ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-center">
                    <p class="text-muted">Belum ada data warga.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
