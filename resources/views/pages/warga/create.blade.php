{{-- resources/views/pages/warga/create.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title text-center mb-40">
                        <h2 class="fw-bold mb-3">Tambah Data Warga Baru</h2>
                        <p class="text-muted fs-5">Silahkan isi form berikut untuk menambahkan data warga baru</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                                    <i class="lni lni-checkmark-circle me-3 fs-4"></i>
                                    <div class="flex-grow-1">{{ session('success') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <div class="d-flex align-items-start">
                                        <i class="lni lni-warning me-3 mt-1 fs-4"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="alert-heading mb-2">Terjadi Kesalahan</h6>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('warga.store') }}" method="POST" class="needs-validation" novalidate id="tambahWargaForm">
                                @csrf

                                <div class="row">
                                    {{-- No KTP --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="no_ktp" class="form-label fw-semibold">
                                            No. KTP <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-id-card text-muted"></i>
                                            </span>
                                            <input type="text" id="no_ktp" name="no_ktp"
                                                   class="form-control border-start-0 ps-2 @error('no_ktp') is-invalid @enderror"
                                                   placeholder="Masukkan 16 digit nomor KTP"
                                                   value="{{ old('no_ktp') }}"
                                                   required
                                                   maxlength="16"
                                                   pattern="\d{16}"
                                                   title="Harus 16 digit angka">
                                            @error('no_ktp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-info-circle me-1"></i>
                                            Harus 16 digit angka (tanpa spasi atau karakter khusus)
                                        </small>
                                    </div>

                                    {{-- Nama --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="nama" class="form-label fw-semibold">
                                            Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-user text-muted"></i>
                                            </span>
                                            <input type="text" id="nama" name="nama"
                                                   class="form-control border-start-0 ps-2 @error('nama') is-invalid @enderror"
                                                   placeholder="Masukkan nama lengkap"
                                                   value="{{ old('nama') }}"
                                                   required
                                                   maxlength="100">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="jenis_kelamin" class="form-label fw-semibold">
                                            Jenis Kelamin <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-users text-muted"></i>
                                            </span>
                                            <select name="jenis_kelamin" id="jenis_kelamin"
                                                    class="form-select border-start-0 ps-2 @error('jenis_kelamin') is-invalid @enderror"
                                                    required>
                                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Agama --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="agama" class="form-label fw-semibold">
                                            Agama <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-book text-muted"></i>
                                            </span>
                                            <select name="agama" id="agama"
                                                    class="form-select border-start-0 ps-2 @error('agama') is-invalid @enderror"
                                                    required>
                                                <option value="" disabled selected>-- Pilih Agama --</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                                <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('agama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-info-circle me-1"></i>
                                            Pilih "Lainnya" untuk agama selain yang tercantum
                                        </small>
                                    </div>

                                    {{-- Pekerjaan --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="pekerjaan" class="form-label fw-semibold">
                                            Pekerjaan
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-briefcase text-muted"></i>
                                            </span>
                                            <input type="text" id="pekerjaan" name="pekerjaan"
                                                   class="form-control border-start-0 ps-2 @error('pekerjaan') is-invalid @enderror"
                                                   placeholder="Contoh: PNS, Wiraswasta, Karyawan Swasta"
                                                   value="{{ old('pekerjaan') }}"
                                                   maxlength="100">
                                            @error('pekerjaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Opsional, boleh dikosongkan
                                        </small>
                                    </div>

                                    {{-- No. Telepon --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="telp" class="form-label fw-semibold">
                                            No. Telepon
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-phone text-muted"></i>
                                            </span>
                                            <input type="text" id="telp" name="telp"
                                                   class="form-control border-start-0 ps-2 @error('telp') is-invalid @enderror"
                                                   placeholder="Contoh: 081234567890"
                                                   value="{{ old('telp') }}"
                                                   maxlength="15">
                                            @error('telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Opsional, maksimal 15 digit
                                        </small>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12 mb-4">
                                        <label for="email" class="form-label fw-semibold">
                                            Email
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-envelope text-muted"></i>
                                            </span>
                                            <input type="email" id="email" name="email"
                                                   class="form-control border-start-0 ps-2 @error('email') is-invalid @enderror"
                                                   placeholder="contoh@email.com (opsional)"
                                                   value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Opsional, tetapi harus unik dan valid jika diisi
                                        </small>
                                    </div>
                                </div>

                                {{-- Informasi Data Warga --}}
                                <div class="border-top pt-4 mt-3 mb-5">
                                    <h5 class="fw-semibold mb-4 d-flex align-items-center">
                                        <i class="lni lni-info-circle text-primary me-2"></i> Informasi Data Warga
                                    </h5>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-danger rounded-circle p-2 me-3">
                                                    <i class="lni lni-star text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Data Wajib</small>
                                                    <span class="fw-medium text-danger">Wajib Diisi</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-success rounded-circle p-2 me-3">
                                                    <i class="lni lni-checkmark-circle text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Data Opsional</small>
                                                    <span class="fw-medium text-success">Boleh Kosong</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-warning rounded-circle p-2 me-3">
                                                    <i class="lni lni-warning text-dark"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Validasi Data</small>
                                                    <span class="fw-medium text-warning">Harus Unik</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-light border">
                                        <div class="d-flex">
                                            <i class="lni lni-bulb text-warning me-3 mt-1 fs-4"></i>
                                            <div>
                                                <h6 class="fw-semibold mb-2">Catatan Penting:</h6>
                                                <ul class="mb-0 text-muted">
                                                    <li><strong>Nomor KTP</strong> harus 16 digit dan tidak boleh duplikat</li>
                                                    <li><strong>Email</strong> harus unik jika diisi (tidak boleh sama dengan warga lain)</li>
                                                    <li>Data yang ditandai dengan <span class="text-danger fw-bold">*</span> wajib diisi</li>
                                                    <li>Sistem akan mencatat waktu pembuatan data secara otomatis</li>
                                                    <li>Pastikan data yang dimasukkan sudah sesuai dan benar</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="border-top pt-4 mt-2">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="lni lni-arrow-left me-2"></i> Kembali
                                        </a>
                                        <div class="d-flex gap-2">
                                            <button type="reset" class="btn btn-outline-danger px-4" id="resetBtn">
                                                <i class="lni lni-eraser me-2"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                                <i class="lni lni-save me-2"></i> Simpan Data Warga
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .card {
            border-radius: 12px;
        }

        .card-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-label {
            font-size: 0.95rem;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .input-group {
            border-radius: 8px;
            overflow: hidden;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: 0;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .form-control, .form-select {
            border-left: 0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            height: 48px;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
            border-color: #86b7fe;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
        }

        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .form-text {
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(58, 86, 212, 0.2);
        }

        .btn-outline-secondary {
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.1);
        }

        .btn-outline-danger {
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.2);
        }

        .alert-light {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }

        .border {
            border-color: #e9ecef !important;
        }

        .border-top {
            border-top-color: #e9ecef !important;
        }

        h2 {
            color: #2c3e50;
            font-weight: 700;
        }

        h5 {
            color: #2c3e50;
        }

        .bg-primary {
            background-color: #4361ee !important;
        }

        .bg-danger {
            background-color: #e74c3c !important;
        }

        .bg-success {
            background-color: #27ae60 !important;
        }

        .bg-warning {
            background-color: #f39c12 !important;
        }

        .text-primary {
            color: #4361ee !important;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .d-flex.gap-2 {
                width: 100%;
                justify-content: stretch;
            }

            .btn {
                width: 100%;
            }

            .border-top {
                margin-top: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simpan nilai default untuk reset
            const defaultValues = {
                no_ktp: '',
                nama: '',
                jenis_kelamin: '',
                agama: '',
                pekerjaan: '',
                telp: '',
                email: ''
            };

            // Format input KTP (hanya angka, maksimal 16 digit)
            const ktpInput = document.getElementById('no_ktp');
            if (ktpInput) {
                ktpInput.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '').slice(0, 16);

                    // Validasi real-time
                    validateKTP();
                });
            }

            // Format input telepon (hanya angka)
            const telpInput = document.getElementById('telp');
            if (telpInput) {
                telpInput.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '').slice(0, 15);
                });
            }

            // Validasi KTP
            const submitBtn = document.getElementById('submitBtn');

            function validateKTP() {
                if (!ktpInput) return true;

                const ktpValue = ktpInput.value;
                const errorDiv = ktpInput.parentElement.parentElement.querySelector('.ktp-error');

                // Hapus error sebelumnya
                if (errorDiv) {
                    errorDiv.remove();
                }

                // Validasi panjang
                if (ktpValue && ktpValue.length !== 16) {
                    ktpInput.classList.add('is-invalid');

                    // Tambahkan pesan error custom
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback ktp-error';
                    errorMessage.textContent = 'Nomor KTP harus 16 digit';
                    ktpInput.parentElement.parentElement.appendChild(errorMessage);

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> KTP Tidak Valid';
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-danger');
                    return false;
                } else {
                    ktpInput.classList.remove('is-invalid');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="lni lni-save me-2"></i> Simpan Data Warga';
                    submitBtn.classList.remove('btn-danger');
                    submitBtn.classList.add('btn-primary');
                    return true;
                }
            }

            // Validasi form sebelum submit
            const form = document.getElementById('tambahWargaForm');
            form.addEventListener('submit', function(event) {
                if (!validateKTP()) {
                    event.preventDefault();
                    event.stopPropagation();

                    // Tampilkan alert jika KTP tidak valid
                    showAlert('Nomor KTP harus 16 digit angka', 'danger');
                    ktpInput.focus();
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            });

            // Fungsi reset form
            document.getElementById('resetBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan dihapus.')) {
                    resetForm();
                    showAlert('Form telah direset', 'info');
                }
            });

            function resetForm() {
                // Reset semua input
                Object.keys(defaultValues).forEach(key => {
                    const input = document.getElementById(key);
                    if (input) {
                        input.value = defaultValues[key];
                        input.classList.remove('is-invalid');
                        input.classList.remove('was-validated');
                    }
                });

                // Reset select elements
                document.querySelectorAll('select').forEach(select => {
                    select.value = '';
                    select.classList.remove('is-invalid');
                });

                // Reset validation states
                form.classList.remove('was-validated');

                // Reset submit button
                validateKTP();

                // Focus ke field pertama
                ktpInput.focus();
            }

            // Fungsi untuk menampilkan alert
            function showAlert(message, type) {
                // Hapus alert sebelumnya dengan class 'auto-dismiss'
                document.querySelectorAll('.alert.auto-dismiss').forEach(alert => {
                    alert.remove();
                });

                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show mt-3 auto-dismiss`;
                alertDiv.innerHTML = `
                    <i class="lni lni-${type === 'danger' ? 'warning' : type === 'warning' ? 'warning' : 'info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                form.insertBefore(alertDiv, form.firstChild);

                // Hapus alert setelah 3 detik
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 3000);
            }

            // Validasi awal
            validateKTP();

            // Auto-focus pada KTP input
            if (ktpInput) {
                ktpInput.focus();
            }
        });
    </script>
@endsection
