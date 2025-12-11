{{-- resources/views/pages/warga/create.blade.php --}}
@extends('layouts.guest.app')

@section('content')
<section id="contact" class="contact-section contact-style-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                <div class="section-title text-center mb-50">
                    <br><br>
                    <h3 class="mb-15">Tambah Data Warga Baru</h3>
                    <p>Silahkan isi form berikut untuk menambah data warga baru</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="lni lni-checkmark-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="lni lni-warning me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('warga.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">

                            {{-- No KTP --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <label class="form-label mb-2">No. KTP <span class="text-danger">*</span></label>
                                    <div class="single-input position-relative">
                                        <input type="text" id="no_ktp" name="no_ktp"
                                            class="form-input @error('no_ktp') is-invalid @enderror"
                                            placeholder="Masukkan nomor KTP"
                                            value="{{ old('no_ktp') }}"
                                            required
                                            maxlength="16">
                                        <i class="lni lni-id-card position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted mt-1">
                                        <i class="lni lni-info-circle me-1"></i>
                                        Maksimal 16 digit angka
                                    </small>
                                </div>
                            </div>

                            {{-- Nama --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <label class="form-label mb-2">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="single-input position-relative">
                                        <input type="text" id="nama" name="nama"
                                            class="form-input @error('nama') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ old('nama') }}"
                                            required
                                            maxlength="100">
                                        <i class="lni lni-user position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <label class="form-label mb-2">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="select-wrapper">
                                        <i class="lni lni-user"></i>
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Agama --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <label class="form-label mb-2">Agama <span class="text-danger">*</span></label>
                                    <div class="single-input position-relative">
                                        <input type="text" id="agama" name="agama"
                                            class="form-input @error('agama') is-invalid @enderror"
                                            placeholder="Masukkan agama"
                                            value="{{ old('agama') }}"
                                            required
                                            maxlength="50">
                                        <i class="lni lni-book position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Pekerjaan --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <label class="form-label mb-2">Pekerjaan</label>
                                    <div class="single-input position-relative">
                                        <input type="text" id="pekerjaan" name="pekerjaan"
                                            class="form-input @error('pekerjaan') is-invalid @enderror"
                                            placeholder="Masukkan pekerjaan (opsional)"
                                            value="{{ old('pekerjaan') }}"
                                            maxlength="100">
                                        <i class="lni lni-briefcase position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted mt-1">
                                        <i class="lni lni-info-circle me-1"></i>
                                        Opsional, boleh dikosongkan
                                    </small>
                                </div>
                            </div>

                            {{-- No. Telepon --}}
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <label class="form-label mb-2">No. Telepon</label>
                                    <div class="single-input position-relative">
                                        <input type="text" id="telp" name="telp"
                                            class="form-input @error('telp') is-invalid @enderror"
                                            placeholder="Masukkan nomor telepon (opsional)"
                                            value="{{ old('telp') }}"
                                            maxlength="15">
                                        <i class="lni lni-phone position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted mt-1">
                                        <i class="lni lni-info-circle me-1"></i>
                                        Maksimal 15 digit
                                    </small>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-12">
                                <div class="position-relative">
                                    <label class="form-label mb-2">Email</label>
                                    <div class="single-input position-relative">
                                        <input type="email" id="email" name="email"
                                            class="form-input @error('email') is-invalid @enderror"
                                            placeholder="Masukkan alamat email (opsional)"
                                            value="{{ old('email') }}">
                                        <i class="lni lni-envelope position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted mt-1">
                                        <i class="lni lni-info-circle me-1"></i>
                                        Opsional, tetapi harus unik jika diisi
                                    </small>
                                </div>
                            </div>

                            {{-- Informasi Data Warga --}}
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title d-flex align-items-center">
                                            <i class="lni lni-info-circle me-2"></i> Informasi Data Warga
                                        </h6>
                                        <div class="text-muted">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="lni lni-warning text-primary me-2"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Data yang Wajib</small>
                                                            <span class="badge bg-danger">
                                                                <i class="lni lni-star me-1"></i> Wajib Diisi
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="lni lni-checkmark-circle text-primary me-2"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Data yang Opsional</small>
                                                            <span class="badge bg-success">
                                                                <i class="lni lni-checkmark-circle me-1"></i> Opsional
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-info mb-0">
                                                <div class="d-flex">
                                                    <i class="lni lni-bulb text-info me-2 mt-1"></i>
                                                    <div>
                                                        <small>
                                                            <strong>Catatan Penting:</strong>
                                                            <ul class="mb-0 mt-2">
                                                                <li>Nomor KTP harus unik dan tidak boleh duplikat</li>
                                                                <li>Email harus unik jika diisi</li>
                                                                <li>Data yang ditandai dengan <span class="text-danger">*</span> wajib diisi</li>
                                                                <li>Sistem akan mencatat waktu pembuatan data secara otomatis</li>
                                                            </ul>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                                    <a href="{{ route('warga.index') }}" class="btn btn-outline-danger px-4">
                                        <i class="lni lni-cross-circle me-2"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-success px-4" id="submitBtn">
                                        <i class="lni lni-telegram-original me-2"></i> Simpan Data Warga
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

<style>
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .single-input {
        position: relative;
    }

    .form-input {
        padding-right: 45px !important;
        height: 50px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .form-input:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        outline: none;
    }

    .form-input.is-invalid {
        border-color: #e74c3c;
    }

    .form-input.is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
    }

    .invalid-feedback {
        font-size: 14px;
        margin-top: 5px;
    }

    .single-input i {
        color: #6c757d;
        z-index: 10;
    }

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
        height: 50px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    .select-wrapper .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        outline: none;
    }
    .select-wrapper .form-select.is-invalid {
        border-color: #e74c3c;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 500;
    }

    .btn-outline-danger {
        border-color: #e74c3c;
        color: #e74c3c;
    }

    .btn-outline-danger:hover {
        background-color: #e74c3c;
        color: white;
    }

    .btn-success {
        background-color: #27ae60;
        border-color: #27ae60;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #219955;
        border-color: #219955;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
    }

    .alert-info {
        background-color: #e8f4fc;
        border-color: #b6e0fe;
        color: #2c3e50;
    }

    .border-top {
        border-top: 1px solid #e9ecef !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format input KTP (hanya angka)
        const ktpInput = document.getElementById('no_ktp');
        if (ktpInput) {
            ktpInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        }

        // Format input telepon (hanya angka)
        const telpInput = document.getElementById('telp');
        if (telpInput) {
            telpInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });
        }

        // Validasi KTP minimal 16 digit
        const submitBtn = document.getElementById('submitBtn');

        function validateKTP() {
            if (ktpInput.value.length < 16 && ktpInput.value.length > 0) {
                ktpInput.classList.add('is-invalid');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> KTP minimal 16 digit';
                return false;
            } else {
                ktpInput.classList.remove('is-invalid');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="lni lni-telegram-original me-2"></i> Simpan Data Warga';
                return true;
            }
        }

        if (ktpInput) {
            ktpInput.addEventListener('input', validateKTP);
            validateKTP(); // Validasi awal
        }

        // Toggle agama dropdown atau input text
        const agamaInput = document.getElementById('agama');
        if (agamaInput) {
            // Bisa ditambahkan autocomplete untuk agama
            const agamaOptions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

            agamaInput.addEventListener('focus', function() {
                // Bisa ditambahkan datalist untuk autocomplete
                if (!this.list) {
                    const datalist = document.createElement('datalist');
                    datalist.id = 'agamaList';
                    agamaOptions.forEach(agama => {
                        const option = document.createElement('option');
                        option.value = agama;
                        datalist.appendChild(option);
                    });
                    this.parentNode.appendChild(datalist);
                    this.setAttribute('list', 'agamaList');
                }
            });
        }
    });
</script>
@endsection
