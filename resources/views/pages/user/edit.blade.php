{{-- resources/views/pages/user/edit.blade.php --}}
@extends('layouts.guest.app')

@section('content')
    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="section-title text-center mb-40">
                        <h2 class="fw-bold mb-3">Edit Data User</h2>
                        <p class="text-muted fs-5">Perbarui data untuk user: <span class="text-primary fw-semibold">{{ $user->name }}</span></p>
                        <p class="text-muted">Kosongkan kolom password jika tidak ingin mengubah password</p>
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

                            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editUserForm">
                                @csrf
                                @method('PUT')

                                {{-- Foto Profil Saat Ini --}}
                                <div class="text-center mb-5 pb-4 border-bottom">
                                    <div class="position-relative d-inline-block mb-3">
                                        <img src="{{ $user->profile_picture_url }}"
                                             alt="{{ $user->name }}"
                                             class="rounded-circle border shadow-lg"
                                             style="width: 160px; height: 160px; object-fit: cover;">
                                        @if($user->has_default_avatar)
                                            <span class="badge bg-info position-absolute shadow-sm"
                                                  style="bottom: 15px; right: 15px; border: 2px solid white;">
                                                <i class="lni lni-stars me-1"></i> Generated
                                            </span>
                                        @endif
                                    </div>
                                    <h5 class="fw-semibold mb-2">{{ $user->name }}</h5>
                                    <p class="text-muted mb-3">
                                        @if($user->profile_picture)
                                            <i class="lni lni-image me-1"></i> Foto Profil Custom
                                        @else
                                            <i class="lni lni-stars me-1"></i> Avatar Auto-generated
                                        @endif
                                    </p>

                                    @if($user->profile_picture)
                                        <div class="d-inline-block text-start">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                       name="remove_profile_picture"
                                                       id="remove_profile_picture" value="1">
                                                <label class="form-check-label text-danger fw-medium" for="remove_profile_picture">
                                                    <i class="lni lni-trash-can me-1"></i> Hapus foto custom
                                                </label>
                                            </div>
                                            <small class="text-muted d-block">
                                                <i class="lni lni-info-circle me-1"></i>
                                                Jika dihapus, akan kembali ke avatar auto-generated
                                            </small>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    {{-- Upload Foto Baru --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="profile_picture" class="form-label fw-semibold">
                                            Upload Foto Custom Baru
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-upload text-muted"></i>
                                            </span>
                                            <input type="file" id="profile_picture" name="profile_picture"
                                                   class="form-control border-start-0 ps-2 @error('profile_picture') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('profile_picture')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-info-circle me-1"></i>
                                            Format: JPG, PNG, JPEG, GIF, WEBP. Maksimal 2MB
                                        </small>

                                        {{-- Preview gambar baru --}}
                                        <div id="imagePreview" class="mt-3 d-none">
                                            <p class="text-muted mb-2">Preview foto baru:</p>
                                            <div class="d-flex align-items-center">
                                                <img id="previewImage" src="#" alt="Preview"
                                                     class="rounded-circle border shadow-sm me-3"
                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                                <div>
                                                    <small class="text-success d-block">
                                                        <i class="lni lni-checkmark-circle me-1"></i>
                                                        Foto siap diupload
                                                    </small>
                                                    <small class="text-muted">
                                                        Klik Simpan untuk mengganti foto
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                   value="{{ old('name', $user->name) }}"
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
                                                   value="{{ old('email', $user->email) }}"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if($user->email_verified_at && old('email', $user->email) !== $user->email)
                                            <div class="alert alert-warning mt-2 p-2" id="emailVerificationWarning">
                                                <i class="lni lni-warning me-1"></i>
                                                <small>Email sudah terverifikasi. Mengganti email memerlukan verifikasi ulang.</small>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="role" class="form-label fw-semibold">
                                            Role <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-users text-muted"></i>
                                            </span>
                                            <select name="role" id="role"
                                                    class="form-select border-start-0 ps-2 @error('role') is-invalid @enderror"
                                                    required>
                                                <option value="" disabled {{ old('role', $user->role) ? '' : 'selected' }}>-- Pilih Role --</option>
                                                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Warga" {{ old('role', $user->role) == 'Warga' ? 'selected' : '' }}>Warga</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Password Baru (Opsional) --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password" class="form-label fw-semibold">
                                            Password Baru
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-lock text-muted"></i>
                                            </span>
                                            <input type="password" id="password" name="password"
                                                   class="form-control border-start-0 ps-2 password-input @error('password') is-invalid @enderror"
                                                   placeholder="Kosongkan jika tidak ingin mengubah">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Minimal 8 karakter, maksimal 20 karakter
                                        </small>
                                    </div>

                                    {{-- Konfirmasi Password Baru --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="password_confirmation" class="form-label fw-semibold">
                                            Konfirmasi Password Baru
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="lni lni-lock-alt text-muted"></i>
                                            </span>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                   class="form-control border-start-0 ps-2 password-input @error('password_confirmation') is-invalid @enderror"
                                                   placeholder="Konfirmasi password baru">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted mt-2 d-block">
                                            <i class="lni lni-checkmark-circle me-1"></i>
                                            Harus sama dengan password baru di atas
                                        </small>
                                    </div>
                                </div>

                                {{-- Informasi Status User --}}
                                <div class="border-top pt-4 mt-3 mb-5">
                                    <h5 class="fw-semibold mb-4 d-flex align-items-center">
                                        <i class="lni lni-info-circle text-primary me-2"></i> Informasi Status User
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-primary rounded-circle p-2 me-3">
                                                    <i class="lni lni-id-card text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">User ID</small>
                                                    <strong class="text-primary">#{{ $user->id }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-info rounded-circle p-2 me-3">
                                                    <i class="lni lni-image text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Avatar</small>
                                                    @if($user->profile_picture)
                                                        <span class="badge bg-success">Custom</span>
                                                    @else
                                                        <span class="badge bg-info">Auto-generated</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-warning rounded-circle p-2 me-3">
                                                    <i class="lni lni-verified text-dark"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Email</small>
                                                    @if ($user->email_verified_at)
                                                        <span class="badge bg-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Belum Verifikasi</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded h-100">
                                                <div class="bg-success rounded-circle p-2 me-3">
                                                    <i class="lni lni-key text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Password</small>
                                                    <span class="badge bg-success">Terenkripsi</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($user->email_verified_at)
                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                                    <i class="lni lni-calendar text-primary me-3 fs-4"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Tanggal Verifikasi</small>
                                                        <strong>{{ \Carbon\Carbon::parse($user->email_verified_at)->format('d M Y H:i') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                                    <i class="lni lni-timer text-primary me-3 fs-4"></i>
                                                    <div>
                                                        <small class="text-muted d-block">Terakhir Login</small>
                                                        <strong>{{ $user->updated_at->format('d M Y H:i') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Informasi Timestamp --}}
                                <div class="border-top pt-4 mt-3 mb-5">
                                    <h5 class="fw-semibold mb-4 d-flex align-items-center">
                                        <i class="lni lni-history text-primary me-2"></i> Informasi Timestamp
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="bg-secondary rounded-circle p-2 me-3">
                                                    <i class="lni lni-calendar text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Dibuat Pada</small>
                                                    <strong>{{ $user->created_at->format('d M Y H:i:s') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="bg-dark rounded-circle p-2 me-3">
                                                    <i class="lni lni-reload text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Diperbarui Pada</small>
                                                    <strong>{{ $user->updated_at->format('d M Y H:i:s') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Catatan Avatar --}}
                                <div class="alert alert-light border mb-5">
                                    <div class="d-flex">
                                        <i class="lni lni-bulb text-warning me-3 mt-1 fs-4"></i>
                                        <div>
                                            <h6 class="fw-semibold mb-2">Catatan Avatar:</h6>
                                            <ul class="mb-0 text-muted">
                                                <li>Avatar auto-generated dibuat berdasarkan nama user</li>
                                                <li>Upload foto custom untuk mengganti avatar saat ini</li>
                                                <li>Foto custom akan dihapus jika checkbox "Hapus foto custom" dicentang</li>
                                                <li>Sistem akan kembali ke avatar auto-generated jika tidak ada foto custom</li>
                                            </ul>
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
                                            <button type="button" class="btn btn-outline-danger px-4" id="resetBtn">
                                                <i class="lni lni-eraser me-2"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                                <i class="lni lni-save me-2"></i> Perbarui User
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
        /* ... (CSS tetap sama seperti sebelumnya) ... */
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simpan nilai default untuk reset
            const defaultValues = {
                name: "{{ old('name', $user->name) }}",
                email: "{{ old('email', $user->email) }}",
                role: "{{ old('role', $user->role) }}",
                password: "",
                password_confirmation: "",
                profile_picture: null,
                remove_profile_picture: false
            };

            const originalEmail = "{{ $user->email }}";
            const originalEmailVerified = "{{ $user->email_verified_at ? 'true' : 'false' }}";

            // Validasi password match
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');

            function validatePassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password || confirmPassword) {
                    if (password && confirmPassword && password !== confirmPassword) {
                        confirmPasswordInput.classList.add('is-invalid');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> Password Tidak Cocok';
                        submitBtn.classList.remove('btn-primary');
                        submitBtn.classList.add('btn-danger');
                        return false;
                    } else if ((password && !confirmPassword) || (!password && confirmPassword)) {
                        confirmPasswordInput.classList.add('is-invalid');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="lni lni-warning me-2"></i> Isi Kedua Kolom Password';
                        submitBtn.classList.remove('btn-primary');
                        submitBtn.classList.add('btn-danger');
                        return false;
                    } else {
                        confirmPasswordInput.classList.remove('is-invalid');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="lni lni-save me-2"></i> Perbarui User';
                        submitBtn.classList.remove('btn-danger');
                        submitBtn.classList.add('btn-primary');
                        return true;
                    }
                } else {
                    confirmPasswordInput.classList.remove('is-invalid');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="lni lni-save me-2"></i> Perbarui User';
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
                        showAlert('Foto custom akan dihapus. Klik Simpan untuk melanjutkan.', 'warning');
                    } else {
                        profilePictureInput.disabled = false;
                    }
                });
            }

            // Fungsi reset form
            document.getElementById('resetBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan yang belum disimpan akan hilang.')) {
                    resetForm();
                    showAlert('Form telah direset ke nilai awal', 'info');
                }
            });

            function resetForm() {
                // Reset text inputs
                document.getElementById('name').value = defaultValues.name;
                document.getElementById('email').value = defaultValues.email;
                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';

                // Reset select
                const roleSelect = document.getElementById('role');
                roleSelect.value = defaultValues.role || '';

                // Reset file input
                profilePictureInput.value = '';
                profilePictureInput.disabled = false;
                imagePreview.classList.add('d-none');

                // Reset checkbox
                if (removePhotoCheckbox) {
                    removePhotoCheckbox.checked = false;
                }

                // Reset validation states
                document.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                document.querySelectorAll('.was-validated').forEach(el => {
                    el.classList.remove('was-validated');
                });

                // Reset toggle password icons
                document.querySelectorAll('.toggle-password i').forEach(icon => {
                    icon.classList.remove('lni-eye-off');
                    icon.classList.add('lni-eye');
                });

                document.querySelectorAll('.password-input').forEach(input => {
                    input.type = 'password';
                });

                // Reset email warning
                checkEmailChange();

                // Reset submit button
                validatePassword();

                // Focus ke field pertama
                document.getElementById('name').focus();
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

                const form = document.getElementById('editUserForm');
                form.insertBefore(alertDiv, form.firstChild);

                // Hapus alert setelah 3 detik
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 3000);
            }

            // Validasi form
            const form = document.getElementById('editUserForm');
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);

            // Validasi awal
            validatePassword();

            // Jika email berubah dan sudah terverifikasi, tampilkan warning
            const emailInput = document.getElementById('email');

            function checkEmailChange() {
                const emailWarningDiv = document.getElementById('emailVerificationWarning');

                if (emailInput.value !== originalEmail) {
                    if (originalEmailVerified === 'true') {
                        if (!emailWarningDiv) {
                            const warningDiv = document.createElement('div');
                            warningDiv.id = 'emailVerificationWarning';
                            warningDiv.className = 'alert alert-warning mt-2 p-3';
                            warningDiv.innerHTML = `
                                <div class="d-flex align-items-start">
                                    <i class="lni lni-warning me-2 text-warning fs-5"></i>
                                    <div>
                                        <h6 class="fw-semibold mb-1">Perhatian</h6>
                                        <p class="mb-0">Email sudah terverifikasi. Mengganti email akan memerlukan verifikasi ulang dan user perlu login kembali.</p>
                                    </div>
                                </div>
                            `;
                            emailInput.parentElement.parentElement.appendChild(warningDiv);
                        }
                    }
                } else {
                    if (emailWarningDiv) {
                        emailWarningDiv.remove();
                    }
                }
            }

            emailInput.addEventListener('input', checkEmailChange);
            checkEmailChange(); // Cek saat halaman load
        });
    </script>
@endsection
