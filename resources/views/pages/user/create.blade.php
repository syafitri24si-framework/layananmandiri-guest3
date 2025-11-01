@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                    <div class="section-title text-center mb-50">
                        <br><br>
                        <h3 class="mb-15">Tambah User</h3>
                        <p>Silahkan isi form di bawah untuk menambahkan user baru</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-wrapper">

                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                {{-- Nama User --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="name" name="name"
                                            class="form-input @error('name') is-invalid @enderror" placeholder="Nama User"
                                            value="{{ old('name') }}">
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
                                            value="{{ old('email') }}">
                                        <i class="lni lni-envelope position-absolute"
                                            style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="password" id="password" name="password"
                                            class="form-input @error('password') is-invalid @enderror"
                                            placeholder="Password">
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
                                        <input type="password" id="konfirmasi_password" name="konfirmasi_password"
                                            class="form-input @error('konfirmasi_password') is-invalid @enderror"
                                            placeholder="Konfirmasi Password">
                                        <i class="lni lni-lock position-absolute"
                                            style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                        @error('konfirmasi_password')
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
                                            <i class="lni lni-telegram-original"></i> Submit
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
