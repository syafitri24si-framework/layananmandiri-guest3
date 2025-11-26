@extends('layouts.guest.app')

@section('content')
    <section class="user-section py-5">
        <div class="container">
            {{-- Header Section --}}
            <div class="row mb-4 align-items-center" style="margin-top: 30px;">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="mb-2" style="margin-bottom: 20px !important;">Bina Desa - Daftar User</h3>
                    <p class="text-muted mb-0">Berikut adalah data user yang telah diinputkan.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('user.create') }}" class="btn btn-success">
                        <i class="lni lni-plus"></i> Tambah User
                    </a>
                </div>
            </div>

            {{-- Filter Section --}}
            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                <div class="row align-items-center">
                    {{-- Filter Nama --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-user"></i>
                            <select class="form-select" name="name">
                                <option value="">Semua Nama</option>
                                @foreach($user_names as $name)
                                    <option value="{{ $name }}" {{ request('name') == $name ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Filter Email --}}
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="select-wrapper">
                            <i class="lni lni-envelope"></i>
                            <select class="form-select" name="email">
                                <option value="">Semua Email</option>
                                @foreach($user_emails as $email)
                                    <option value="{{ $email }}" {{ request('email') == $email ? 'selected' : '' }}>
                                        {{ $email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-4 mb-2 mb-md-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="input-group-text bg-primary text-white">
                                <i class="lni lni-search-alt me-1"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="input-group-text text-danger">
                                    <i class="lni lni-close me-1"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Reset --}}
                    <div class="col-md-2">
                        @if(request()->hasAny(['name', 'email', 'search']))
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="lni lni-close me-1"></i> Reset All
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="lni lni-checkmark-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- User Cards --}}
            <div class="row g-4">
                @forelse($user as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                {{-- User Info --}}
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="lni lni-user text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0">{{ $item->name }}</h5>
                                        <small class="text-muted">User ID: {{ $item->id }}</small>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-envelope me-2"></i>
                                        <small>Email</small>
                                    </div>
                                    <p class="mb-0 text-break">{{ $item->email }}</p>
                                </div>

                                {{-- Password (truncated for security) --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="lni lni-lock me-2"></i>
                                        <small>Password</small>
                                    </div>
                                    <p class="mb-0 font-monospace small text-truncate" title="Password terenkripsi">
                                        ••••••••••
                                    </p>
                                </div>

                                {{-- Additional Info --}}
                                <div class="small text-muted">
                                    <div class="d-flex justify-content-between">
                                        <span>Dibuat:</span>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Diupdate:</span>
                                        <span>{{ $item->updated_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('user.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="lni lni-pencil-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus user ini?')">
                                            <i class="lni lni-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="lni lni-users text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">Belum ada data user</h5>
                            <p class="text-muted">Silakan tambah user baru untuk memulai</p>
                            <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                                <i class="lni lni-plus"></i> Tambah User Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($user->hasPages())
                <div class="mt-5">
                    {{ $user->links('pagination::bootstrap-5') }}
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
        .input-group .form-control {
            border-right: 0;
        }
        .input-group-text {
            border-left: 0;
        }
        .input-group .text-danger {
            border-left: 1px solid #dee2e6;
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
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endsection
