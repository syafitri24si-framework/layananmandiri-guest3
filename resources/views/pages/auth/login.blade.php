@extends('layouts.guest.applog')

@section('content')
<section class="auth-section">
    <div class="blur-overlay"></div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg border-0" style="border-radius: 15px; background-color: rgba(255,255,255,0.95);">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4" style="color:#0d6efd;">Login Bina Desa</h3>

                        {{-- Alert --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('auth.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value="1">

                            {{-- Email --}}
                            <div class="mb-3 position-relative">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" value="{{ old('email') }}" required>
                                <i class="lni lni-envelope position-absolute"
                                    style="top:50%; right:15px; transform: translateY(-50%); color:#0d6efd;"></i>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3 position-relative">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" required>
                                <i class="lni lni-lock position-absolute"
                                    style="top:50%; right:15px; transform: translateY(-50%); color:#0d6efd;"></i>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Login --}}
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="background-color:#0d6efd; border:none; border-radius:10px;">
                                    <i class="lni lni-telegram-original"></i> Login
                                </button>
                            </div>

                            <p class="text-center mb-0">
                                Belum punya akun?
                                <a href="{{ route('auth.create') }}" class="text-primary">Daftar di sini</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
