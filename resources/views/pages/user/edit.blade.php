{{-- resources/views/pages/user/edit.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                    <div class="section-title text-center mb-50">
                        <br><br>
                        <h3 class="mb-15">Edit Data User: {{ $user->name }}</h3>
                        <p>Perbarui data user di bawah. Kosongkan password jika tidak ingin mengganti.</p>
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

                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-4">

                                {{-- Foto Profil Saat Ini --}}
                                <div class="col-12">
                                    <div class="text-center mb-4">
                                        <div class="current-photo">
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ $user->profile_picture_url }}"
                                                     alt="{{ $user->name }}"
                                                     class="rounded-circle border shadow mb-3"
                                                     style="width: 150px; height: 150px; object-fit: cover;">
                                                @if($user->has_default_avatar)
                                                    <span class="badge bg-info position-absolute"
                                                          style="bottom: 10px; right: 10px;">
                                                        <i class="lni lni-stars me-1"></i> Generated
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-muted mb-2">
                                                @if($user->profile_picture)
                                                    Foto Profil Saat Ini (Custom)
                                                @else
                                                    Avatar Saat Ini (Auto-generated)
                                                @endif
                                            </p>
                                            @if($user->profile_picture)
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="remove_profile_picture"
                                                           id="remove_profile_picture" value="1">
                                                    <label class="form-check-label text-danger" for="remove_profile_picture">
                                                        <i class="lni lni-trash me-1"></i> Hapus foto custom
                                                    </label>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">
                                                        <i class="lni lni-info-circle me-1"></i>
                                                        Jika dihapus, akan kembali ke avatar auto-generated
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Upload Foto Baru --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Upload Foto Custom</label>
                                        <div class="single-input position-relative">
                                            <input type="file" id="profile_picture" name="profile_picture"
                                                   class="form-input @error('profile_picture') is-invalid @enderror"
                                                   accept="image/*">
                                            <i class="lni lni-image position-absolute"
                                               style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                            @error('profile_picture')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted mt-1">
                                            <i class="lni lni-info-circle me-1"></i>
                                            Format: JPG, PNG, JPEG, GIF, WEBP. Maksimal 2MB
                                        </small>

                                        {{-- Preview gambar baru --}}
                                        <div id="imagePreview" class="mt-3 d-none">
                                            <p class="mb-2"><small>Preview foto baru:</small></p>
                                            <img id="previewImage" src="#" alt="Preview"
                                                 class="rounded-circle border"
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                {{-- Nama User --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Nama User <span class="text-danger">*</span></label>
                                        <div class="single-input position-relative">
                                            <input type="text" id="name" name="name"
                                                class="form-input @error('name') is-invalid @enderror"
                                                placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}"
                                                required>
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
                                                placeholder="Masukkan alamat email" value="{{ old('email', $user->email) }}"
                                                required>
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
                                        <label class="form-label mb-2">Role <span class="text-danger">*</span></label>
                                        <div class="single-input position-relative">
                                            <select name="role" id="role"
                                                class="form-input select-input @error('role') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="Admin"
                                                    {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="Warga"
                                                    {{ old('role', $user->role) == 'Warga' ? 'selected' : '' }}>Warga
                                                </option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Password Baru (Opsional) --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Password Baru</label>
                                        <div class="single-input position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-input @error('password') is-invalid @enderror"
                                                placeholder="Kosongkan jika tidak ingin mengganti">
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

                                {{-- Konfirmasi Password Baru --}}
                                <div class="col-md-6">
                                    <div class="position-relative">
                                        <label class="form-label mb-2">Konfirmasi Password Baru</label>
                                        <div class="single-input position-relative">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="form-input @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Konfirmasi password baru">
                                            <i class="lni lni-lock position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted mt-1">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Harus sama dengan password baru di atas
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
                                                    <div class="col-md-3 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="lni lni-id-card text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted d-block">User ID</small>
                                                                <strong>#{{ $user->id }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="lni lni-image text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Avatar</small>
                                                                @if($user->profile_picture)
                                                                    <span class="badge bg-success">
                                                                        <i class="lni lni-checkmark-circle me-1"></i>
                                                                        Custom
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-info">
                                                                        <i class="lni lni-stars me-1"></i> Auto-generated
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="lni lni-verified text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Status Email</small>
                                                                @if ($user->email_verified_at)
                                                                    <span class="badge bg-success">
                                                                        <i class="lni lni-checkmark-circle me-1"></i>
                                                                        Terverifikasi
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark">
                                                                        <i class="lni lni-timer me-1"></i> Belum Verifikasi
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="lni lni-key text-primary me-2"></i>
                                                            <div>
                                                                <small class="text-muted d-block">Status Password</small>
                                                                <span class="badge bg-success">
                                                                    <i class="lni lni-checkmark-circle me-1"></i>
                                                                    Terenkripsi
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($user->email_verified_at)
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="d-flex align-items-center">
                                                                <i class="lni lni-calendar text-primary me-2"></i>
                                                                <div>
                                                                    <small class="text-muted d-block">Tanggal
                                                                        Verifikasi</small>
                                                                    <strong>{{ \Carbon\Carbon::parse($user->email_verified_at)->format('d M Y H:i') }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="d-flex align-items-center">
                                                                <i class="lni lni-timer text-primary me-2"></i>
                                                                <div>
                                                                    <small class="text-muted d-block">Terakhir
                                                                        Login</small>
                                                                    <strong>{{ $user->updated_at->format('d M Y H:i') }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="alert alert-info mb-0">
                                                    <div class="d-flex">
                                                        <i class="lni lni-bulb text-info me-2 mt-1"></i>
                                                        <div>
                                                            <small>
                                                                <strong>Catatan Avatar:</strong>
                                                                <ul class="mb-0 mt-2">
                                                                    <li>Avatar auto-generated dibuat dari nama user</li>
                                                                    <li>Anda bisa upload foto custom untuk mengganti avatar</li>
                                                                    <li>Foto custom akan dihapus jika checkbox "Hapus foto custom" dicentang</li>
                                                                    <li>Sistem akan kembali ke avatar auto-generated jika tidak ada foto custom</li>
                                                                </ul>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Timestamps --}}
                                <div class="col-md-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title d-flex align-items-center">
                                                <i class="lni lni-history me-2"></i> Informasi Timestamp
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="lni lni-calendar text-primary me-3"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Dibuat Pada</small>
                                                            <strong>{{ $user->created_at->format('d M Y H:i:s') }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="lni lni-reload text-primary me-3"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Diperbarui Pada</small>
                                                            <strong>{{ $user->updated_at->format('d M Y H:i:s') }}</strong>
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
                                            <i class="lni lni-telegram-original me-2"></i> Perbarui User
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

        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .alert-info {
            background-color: #e8f4fc;
            border-color: #b6e0fe;
            color: #2c3e50;
        }

        .border-top {
            border-top: 1px solid #e9ecef !important;
        }

        /* Styling select */
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

        .select-input::-ms-expand {
            display: none;
        }

        .select-input:focus {
            border-color: #3498db !important;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            outline: none;
        }

        /* Style untuk input file */
        input[type="file"] {
            padding: 12px !important;
            line-height: 1.5;
            height: auto !important;
        }

        input[type="file"]::file-selector-button {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 8px 16px;
            border-radius: 6px;
            margin-right: 10px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        input[type="file"]::file-selector-button:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }

        /* Style untuk preview image */
        #previewImage {
            border: 3px solid #f8f9fa;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Style untuk foto profil saat ini */
        .current-photo img {
            transition: all 0.3s ease;
        }

        .current-photo img:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        /* Style untuk checkbox hapus foto */
        .form-check-input:checked {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .form-check-label {
            cursor: pointer;
            font-size: 14px;
        }

        /* Style untuk badge position */
        .position-relative .badge {
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validasi password match
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');

            function validatePassword() {
                if (passwordInput.value !== '' && confirmPasswordInput.value !== '') {
                    if (passwordInput.value !== confirmPasswordInput.value) {
                        confirmPasswordInput.classList.add('is-invalid');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> Password tidak cocok';
                        submitBtn.classList.remove('btn-success');
                        submitBtn.classList.add('btn-danger');
                        return false;
                    } else {
                        confirmPasswordInput.classList.remove('is-invalid');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="lni lni-telegram-original me-2"></i> Perbarui User';
                        submitBtn.classList.remove('btn-danger');
                        submitBtn.classList.add('btn-success');
                        return true;
                    }
                }

                if (passwordInput.value === '' && confirmPasswordInput.value === '') {
                    confirmPasswordInput.classList.remove('is-invalid');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="lni lni-telegram-original me-2"></i> Perbarui User';
                    submitBtn.classList.remove('btn-danger');
                    submitBtn.classList.add('btn-success');
                    return true;
                }

                if ((passwordInput.value === '' && confirmPasswordInput.value !== '') ||
                    (passwordInput.value !== '' && confirmPasswordInput.value === '')) {
                    confirmPasswordInput.classList.add('is-invalid');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> Harap isi kedua kolom password';
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-danger');
                    return false;
                }
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);

            // Preview image baru sebelum upload
            const profilePictureInput = document.getElementById('profile_picture');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const removePhotoCheckbox = document.getElementById('remove_profile_picture');

            profilePictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validasi ukuran file (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file maksimal 2MB');
                        this.value = '';
                        imagePreview.classList.add('d-none');
                        return;
                    }

                    // Validasi tipe file
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WEBP.');
                        this.value = '';
                        imagePreview.classList.add('d-none');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('d-none');

                        // Uncheck remove photo checkbox jika upload foto baru
                        if (removePhotoCheckbox) {
                            removePhotoCheckbox.checked = false;
                        }
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('d-none');
                }
            });

            // Jika checkbox hapus foto dicentang, disable input upload
            if (removePhotoCheckbox) {
                removePhotoCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        profilePictureInput.disabled = true;
                        profilePictureInput.value = '';
                        imagePreview.classList.add('d-none');
                    } else {
                        profilePictureInput.disabled = false;
                    }
                });
            }

            // Toggle password visibility
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

            // Validasi awal
            validatePassword();

            // Jika email sudah terverifikasi, tampilkan warning
            const emailInput = document.getElementById('email');
            const originalEmail = "{{ $user->email }}";

            if (emailInput.value !== originalEmail) {
                const emailVerified = "{{ $user->email_verified_at ? 'true' : 'false' }}";

                if (emailVerified === 'true') {
                    const warningDiv = document.createElement('div');
                    warningDiv.className = 'alert alert-warning mt-2';
                    warningDiv.innerHTML = `
                        <i class="lni lni-warning me-2"></i>
                        <strong>Perhatian:</strong> Email sudah terverifikasi. Mengganti email akan memerlukan verifikasi ulang.
                    `;
                    emailInput.parentElement.parentElement.appendChild(warningDiv);
                }
            }
        });
    </script>
@endsection
