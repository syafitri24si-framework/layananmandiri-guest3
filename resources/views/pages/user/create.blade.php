{{-- resources/views/pages/user/create.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                    <div class="section-title text-center mb-50">
                        <br><br>
                        <h3 class="mb-15">Tambah User Baru</h3>
                        <p>Silahkan isi form berikut untuk menambah user baru</p>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">

                                {{-- Nama User --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Nama User <span class="text-danger">*</span></label>
                                        <div class="single-input position-relative">
                                            <input type="text" id="name" name="name"
                                                class="form-input @error('name') is-invalid @enderror"
                                                placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                                            <i class="lni lni-user position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Email <span class="text-danger">*</span></label>
                                        <div class="single-input position-relative">
                                            <input type="email" id="email" name="email"
                                                class="form-input @error('email') is-invalid @enderror"
                                                placeholder="Masukkan alamat email" value="{{ old('email') }}" required>
                                            <i class="lni lni-envelope position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Role --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Pilih Role <span class="text-danger">*</span></label>
                                        <div class="single-input position-relative">

                                            <select name="role" id="role"
                                                class="form-input select-input @error('role') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="Warga" {{ old('role') == 'Warga' ? 'selected' : '' }}>Warga
                                                </option>
                                            </select>


                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Password <span class="text-danger">*</span></label>
                                        <div class="single-input position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-input @error('password') is-invalid @enderror"
                                                placeholder="Masukkan password" required>
                                            <i class="lni lni-lock position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted mt-1">
                                            <i class="lni lni-info-circle me-1"></i>
                                            Minimal 8 karakter, maksimal 20 karakter
                                        </small>
                                    </div>
                                </div>

                                {{-- Konfirmasi Password --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Konfirmasi Password <span
                                                class="text-danger">*</span></label>
                                        <div class="single-input position-relative">
                                            <input type="password" id="konfirmasi_password" name="konfirmasi_password"
                                                class="form-input @error('konfirmasi_password') is-invalid @enderror"
                                                placeholder="Masukkan ulang password" required>
                                            <i class="lni lni-lock position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                            @error('konfirmasi_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted mt-1">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Harus sama dengan password di atas
                                        </small>
                                    </div>
                                </div>

                                {{-- Informasi Akun --}}
                                <div class="col-md-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title d-flex align-items-center">
                                                <i class="lni lni-info-circle me-2"></i> Informasi Akun
                                            </h6>
                                            <div class="text-muted">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="lni lni-key text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Status Password</small>
                                                                <span class="badge bg-success">
                                                                    <i class="lni lni-checkmark-circle me-1"></i>
                                                                    Terenkripsi AES
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="lni lni-verified text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Verifikasi Email</small>
                                                                <span class="badge bg-warning text-dark">
                                                                    <i class="lni lni-timer me-1"></i> Akan dikirim
                                                                    otomatis
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
                                                                <strong>Catatan:</strong> Setelah user dibuat, sistem akan:
                                                                <ul class="mb-0 mt-2">
                                                                    <li>Mengenkripsi password menggunakan hashing</li>
                                                                    <li>Mengirim email verifikasi ke alamat email yang
                                                                        diinput</li>
                                                                    <li>Membuat token remember untuk session</li>
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
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-danger px-4">
                                            <i class="lni lni-cross-circle me-2"></i> Batal
                                        </a>
                                        <button type="submit" class="btn btn-success px-4" id="submitBtn">
                                            <i class="lni lni-telegram-original me-2"></i> Simpan User
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

        .card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
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

        /* Agar select ukurannya sama persis dengan input */
        .select-input {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 100%;
            height: 50px !important;
            padding-right: 45px !important;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            background-color: #fff;
            font-size: 16px;
            color: #2c3e50;
        }

        /* Ketika focus */
        .select-input:focus {
            border-color: #3498db !important;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            outline: none;
        }

        /* Dropdown arrow hilang biar rapi */
        .select-input::-ms-expand {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validasi password match
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('konfirmasi_password');
            const submitBtn = document.getElementById('submitBtn');

            function validatePassword() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('is-invalid');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> Password tidak cocok';
                    return false;
                } else {
                    confirmPasswordInput.classList.remove('is-invalid');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="lni lni-telegram-original me-2"></i> Simpan User';
                    return true;
                }
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);

            // Validasi awal
            validatePassword();

            // Toggle password visibility (opsional)
            const togglePasswordBtns = document.querySelectorAll('.single-input i.lni-lock');
            togglePasswordBtns.forEach(icon => {
                icon.style.cursor = 'pointer';
                icon.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.remove('lni-lock');
                        this.classList.add('lni-unlock');
                    } else {
                        input.type = 'password';
                        this.classList.remove('lni-unlock');
                        this.classList.add('lni-lock');
                    }
                });
            });
        });
    </script>
@endsection
