@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                    <div class="section-title text-center mb-50">
                        <br><br>
                        <h3 class="mb-15">Edit User</h3>
                        <p>Perbarui data user di bawah. Kosongkan password jika tidak ingin mengganti.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-wrapper">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">

                                {{-- Nama User --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="name" name="name"
                                            class="form-input @error('name') is-invalid @enderror" placeholder="Nama User"
                                            value="{{ old('name', $user->name) }}">
                                        <i class="lni lni-user position-absolute"
                                            style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="email" id="email" name="email"
                                            class="form-input @error('email') is-invalid @enderror" placeholder="Email"
                                            value="{{ old('email', $user->email) }}">
                                        <i class="lni lni-envelope position-absolute"
                                            style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password (kosongkan jika tidak ingin ganti) --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password', $user->password) }}">
                                        <i class="lni lni-lock position-absolute"
                                            style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Konfirmasi Password --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                       <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password', $user->password) }}">
                                        <i class="lni lni-lock position-absolute"
                                            style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tombol --}}
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <a href="{{ route('user.index') }}" class="btn btn-danger">
                                            <i class="lni lni-cross-circle"></i> Batal
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="lni lni-telegram-original"></i> Perbarui
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
