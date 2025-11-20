@extends('layouts.guest.app')

@section('content')
<section id="contact" class="contact-section contact-style-3">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                <div class="section-title text-center mb-50">
                    <br><br>
                    <h3 class="mb-15">Edit Permohonan Surat</h3>
                    <p>Silahkan perbarui data permohonan surat di bawah.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('permohonan_surat.update', $data->permohonan_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            {{-- Nomor Permohonan --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <input type="text" name="nomor_permohonan"
                                        class="form-input @error('nomor_permohonan') is-invalid @enderror"
                                        value="{{ old('nomor_permohonan', $data->nomor_permohonan) }}"
                                        placeholder="Nomor Permohonan">

                                    <i class="lni lni-tag position-absolute"
                                        style="top:50%; right:15px; transform:translateY(-50%);"></i>

                                    @error('nomor_permohonan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Warga --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <select name="warga_id"
                                        class="form-select @error('warga_id') is-invalid @enderror">
                                        <option value="">-- Pilih Warga --</option>

                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}"
                                                {{ old('warga_id', $data->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} ({{ $w->no_ktp }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jenis Surat --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <select name="jenis_id"
                                        class="form-select @error('jenis_id') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis Surat --</option>

                                        @foreach ($jenisSurat as $js)
                                            <option value="{{ $js->jenis_id }}"
                                                {{ old('jenis_id', $data->jenis_id) == $js->jenis_id ? 'selected' : '' }}>
                                                {{ $js->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('jenis_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tanggal Pengajuan --}}
                            <div class="col-md-6">
                                <div class="single-input position-relative">
                                    <input type="date" name="tanggal_pengajuan"
                                        class="form-input @error('tanggal_pengajuan') is-invalid @enderror"
                                        value="{{ old('tanggal_pengajuan', $data->tanggal_pengajuan) }}">

                                    <i class="lni lni-calendar position-absolute"
                                        style="top:50%; right:15px; transform:translateY(-50%);"></i>

                                    @error('tanggal_pengajuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <select name="status"
                                        class="form-select @error('status') is-invalid @enderror">

                                        <option value="Pending" {{ old('status', $data->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Diproses" {{ old('status', $data->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Selesai" {{ old('status', $data->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>

                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Catatan --}}
                            <div class="col-md-12">
                                <div class="single-input position-relative">
                                    <textarea name="catatan" rows="3"
                                        class="form-input @error('catatan') is-invalid @enderror"
                                        placeholder="Tambahkan catatan jika perlu">{{ old('catatan', $data->catatan) }}</textarea>

                                    <i class="lni lni-pencil position-absolute" style="top:20%; right:15px;"></i>

                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <a href="{{ route('permohonan_surat.index') }}" class="btn btn-danger">
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
