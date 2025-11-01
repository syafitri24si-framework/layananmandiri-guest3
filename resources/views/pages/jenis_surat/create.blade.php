@extends('layouts.guest.app')
@section('content')
<section id="contact" class="contact-section contact-style-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                <div class="section-title text-center mb-50">
                    <br><br>
                    <h3 class="mb-15">Tambahkan Jenis Surat</h3>
                    <p>Silahkan isi form di bawah untuk menambahkan jenis surat baru</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">

                    <form action="{{ route('jenis_surat.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            {{-- Kode Surat --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <input type="text" id="kode" name="kode"
                                           class="form-input @error('kode') is-invalid @enderror"
                                           placeholder="Kode Surat"
                                           value="{{ old('kode') }}">
                                    <i class="lni lni-key position-absolute" style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                    @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Nama Jenis Surat --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <input type="text" id="nama_jenis" name="nama_jenis"
                                           class="form-input @error('nama_jenis') is-invalid @enderror"
                                           placeholder="Nama Jenis Surat"
                                           value="{{ old('nama_jenis') }}">
                                    <i class="lni lni-envelope position-absolute" style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                    @error('nama_jenis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Syarat --}}
                            <div class="col-md-12">
                                <div class="single-input position-relative">
                                    <textarea id="syarat_json" name="syarat_json[]"
                                              class="form-input @error('syarat_json') is-invalid @enderror"
                                              placeholder="Syarat (pisahkan setiap syarat dengan koma)"
                                              rows="4">{{ old('syarat_json') ? implode(', ', old('syarat_json')) : '' }}</textarea>
                                    <i class="lni lni-list position-absolute" style="top:50%; right:15px; transform:translateY(-50%);"></i>
                                    @error('syarat_json')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">Pisahkan setiap syarat dengan koma.</small>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="col-md-12">
                                <div class="form-button mt-3 text-end">
                                    <button type="submit" class="button">
                                        <i class="lni lni-telegram-original"></i> Simpan
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
