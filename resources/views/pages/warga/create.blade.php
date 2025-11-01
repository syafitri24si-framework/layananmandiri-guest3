@extends('layouts.guest.app')
@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                    <div class="section-title text-center mb-50">
                        <br><br>
                        <h3 class="mb-15">Tambahkan data anda</h3>
                        <p>Silahkan isi form dibawa untuk kelengkapan anda</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-wrapper">



                        <form action="{{ route('warga.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                {{-- No KTP --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="no_ktp" name="no_ktp"
                                            class="form-input @error('no_ktp') is-invalid @enderror" placeholder="No KTP"
                                            value="{{ old('no_ktp') }}">
                                        <i class="lni lni-id-card position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Nama --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="nama" name="nama"
                                            class="form-input @error('nama') is-invalid @enderror"
                                            placeholder="Nama Lengkap" value="{{ old('nama') }}">
                                        <i class="lni lni-user position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Jenis Kelamin --}}
                                <div class="col-md-6">
                                    <div class=" position-relative">
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        <i class=" position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Agama --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="agama" name="agama"
                                            class="form-input @error('agama') is-invalid @enderror" placeholder="Agama"
                                            value="{{ old('agama') }}">
                                        <i class="lni lni-book position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pekerjaan --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="pekerjaan" name="pekerjaan"
                                            class="form-input @error('pekerjaan') is-invalid @enderror"
                                            placeholder="Pekerjaan" value="{{ old('pekerjaan') }}">
                                        <i class="lni lni-briefcase position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- No Telp --}}
                                <div class="col-md-6">
                                    <div class="single-input position-relative">
                                        <input type="text" id="telp" name="telp"
                                            class="form-input @error('telp') is-invalid @enderror" placeholder="No Telepon"
                                            value="{{ old('telp') }}">
                                        <i class="lni lni-phone position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('telp')
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
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tombol --}}
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <a href="{{ route('warga.index') }}" class="btn btn-danger">
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
