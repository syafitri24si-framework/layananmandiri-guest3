{{-- resources/views/pages/user/create.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title text-center mb-50">
                        <h3 class="mb-3">Tambah User Baru</h3>
                        <p class="text-muted">Silahkan isi form berikut untuk menambahkan user baru ke sistem</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="card border-0 shadow-lg overflow-hidden">
                        <div class="card-body p-5">
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

                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf

                                <div class="row">
                                    {{-- Nama User --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="form-label fw-semibold">
                                            Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-user text-muted"></i>
                                            </span>
                                            <input type="text" id="name" name="name"
                                                   class="form-control border-start-0 ps-2 @error('name') is-invalid @enderror"
                                                   placeholder="Masukkan nama lengkap"
                                                   value="{{ old('name') }}"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label fw-semibold">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-envelope text-muted"></i>
                                            </span>
                                            <input type="email" id="email" name="email"
                                                   class="form-control border-start-0 ps-2 @error('email') is-invalid @enderror"
                                                   placeholder="contoh@email.com"
                                                   value="{{ old('email') }}"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="role" class="form-label fw-semibold">
                                            Role User <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-users text-muted"></i>
                                            </span>
                                            <select name="role" id="role"
                                                    class="form-select border-start-0 ps-2 @error('role') is-invalid @enderror"
                                                    required>
                                                <option value="" disabled selected>-- Pilih Role --</option>
                                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Warga" {{ old('role') == 'Warga' ? 'selected' : '' }}>Warga</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Foto Profil --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="profile_picture" class="form-label fw-semibold">
                                            Foto Profil
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-image text-muted"></i>
                                            </span>
                                            <input type="file" id="profile_picture" name="profile_picture"
                                                   class="form-control border-start-0 ps-2 @error('profile_picture') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('profile_picture')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-1 d-block">
                                            <i class="lni lni-info-circle me-1"></i>
                                            Format: JPG, PNG, JPEG, GIF, WEBP. Maksimal 2MB
                                        </small>

                                        {{-- Preview gambar --}}
                                        <div id="imagePreview" class="mt-3 d-none">
                                            <p class="text-muted mb-2">Preview:</p>
                                            <img id="previewImage" src="#" alt="Preview"
                                                 class="rounded-circle border shadow-sm"
                                                 style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password" class="form-label fw-semibold">
                                            Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-lock text-muted"></i>
                                            </span>
                                            <input type="password" id="password" name="password"
                                                   class="form-control border-start-0 ps-2 password-input @error('password') is-invalid @enderror"
                                                   placeholder="Minimal 8 karakter"
                                                   required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-1 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Minimal 8 karakter, maksimal 20 karakter
                                        </small>
                                    </div>

                                    {{-- Konfirmasi Password --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password_confirmation" class="form-label fw-semibold">
                                            Konfirmasi Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-lock-alt text-muted"></i>
                                            </span>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                   class="form-control border-start-0 ps-2 password-input @error('password_confirmation') is-invalid @enderror"
                                                   placeholder="Ketik ulang password"
                                                   required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-1 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Harus sama dengan password di atas
                                        </small>
                                    </div>
                                </div>

                                {{-- Informasi Akun --}}
                                <div class="mb-5">
                                    <div class="border-top pt-4 mt-2">
                                        <h5 class="fw-semibold mb-4 d-flex align-items-center">
                                            <i class="lni lni-info-circle text-primary me-2"></i> Informasi Akun
                                        </h5>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-4">
                                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                                    <div class="bg-primary rounded-circle p-2 me-3">
                                                        <i class="lni lni-key text-white"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Status Password</small>
                                                        <span class="fw-medium text-primary">Terenkripsi AES</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                                    <div class="bg-warning rounded-circle p-2 me-3">
                                                        <i class="lni lni-verified text-dark"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Verifikasi Email</small>
                                                        <span class="fw-medium">Akan dikirim otomatis</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                                    <div class="bg-info rounded-circle p-2 me-3">
                                                        <i class="lni lni-image text-white"></i>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted d-block">Foto Profil</small>
                                                        <span class="fw-medium text-info">Opsional</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-light border">
                                            <div class="d-flex">
                                                <i class="lni lni-bulb text-warning me-3 mt-1 fs-5"></i>
                                                <div>
                                                    <h6 class="fw-semibold mb-2">Catatan Penting:</h6>
                                                    <p class="mb-2">Setelah user dibuat, sistem akan melakukan beberapa proses otomatis:</p>
                                                    <ul class="mb-0 text-muted">
                                                        <li>Mengenkripsi password menggunakan hashing yang aman</li>
                                                        <li>Mengirim email verifikasi ke alamat email yang diinput</li>
                                                        <li>Membuat token remember untuk session management</li>
                                                        <li>Menyimpan foto profil ke storage jika diupload</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="border-top pt-4 mt-2">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="lni lni-arrow-left me-2"></i> Kembali
                                        </a>
                                        <div class="d-flex gap-2">
                                            <button type="reset" class="btn btn-outline-danger px-4">
                                                <i class="lni lni-eraser me-2"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                                <i class="lni lni-save me-2"></i> Simpan User
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

        .toggle-password {
            border-left: 0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            background-color: #e9ecef;
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

        h3 {
            color: #2c3e50;
            font-weight: 700;
        }

        h5 {
            color: #2c3e50;
        }

        .bg-primary {
            background-color: #4361ee !important;
        }

        .text-primary {
            color: #4361ee !important;
        }

        #imagePreview img {
            transition: all 0.3s ease;
        }

        #imagePreview img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        input[type="file"] {
            line-height: 1.5;
        }

        input[type="file"]::file-selector-button {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 6px 12px;
            border-radius: 4px;
            margin-right: 10px;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        input[type="file"]::file-selector-button:hover {
            background: #e9ecef;
            border-color: #adb5bd;
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
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validasi password match
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');

            function validatePassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password && confirmPassword && password !== confirmPassword) {
                    confirmPasswordInput.classList.add('is-invalid');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> Password Tidak Cocok';
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-danger');
                    return false;
                } else {
                    confirmPasswordInput.classList.remove('is-invalid');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="lni lni-save me-2"></i> Simpan User';
                    submitBtn.classList.remove('btn-danger');
                    submitBtn.classList.add('btn-primary');
                    return true;
                }
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);

            // Toggle password visibility
            const togglePasswordBtns = document.querySelectorAll('.toggle-password');
            togglePasswordBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const input = this.parentElement.querySelector('.password-input');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('lni-eye');
                        icon.classList.add('lni-eye-off');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('lni-eye-off');
                        icon.classList.add('lni-eye');
                    }
                });
            });

            // Preview image sebelum upload
            const profilePictureInput = document.getElementById('profile_picture');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');

            profilePictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validasi ukuran file (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        showAlert('Ukuran file maksimal 2MB', 'danger');
                        this.value = '';
                        imagePreview.classList.add('d-none');
                        return;
                    }

                    // Validasi tipe file
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        showAlert('Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WEBP.', 'danger');
                        this.value = '';
                        imagePreview.classList.add('d-none');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('d-none');
                }
            });

            // Fungsi untuk menampilkan alert
            function showAlert(message, type) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
                alertDiv.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                const container = document.querySelector('.card-body');
                container.insertBefore(alertDiv, container.firstChild);

                // Hapus alert setelah 5 detik
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }

            // Validasi form
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });

            // Validasi awal
            validatePassword();
        });
    </script>
@endsection
