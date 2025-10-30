<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bina Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        body {
            background-color: #f3f5fb;
            font-family: 'Poppins', sans-serif;
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh;
        }
        .card {
            background: #fff; border: none;
            width: 420px; padding: 35px 30px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        h3 { font-weight: 600; color: #1b1c1e; text-align: center; margin-bottom: 10px; }
        .subtitle { text-align: center; color: #6c757d; margin-bottom: 25px; }
        .form-control { background-color: #f7f8fc; border: 1px solid #d6d9e0; border-radius: 10px; }
        .form-control:focus { border-color: #7280ff; box-shadow: 0 0 6px rgba(114,128,255,0.3); }
        .btn-primary { background-color: #7280ff; border: none; border-radius: 10px; font-weight: 500; }
        .btn-primary:hover { background-color: #5a6bff; }
        a { color: #7280ff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h3>Bina Desa</h3>
        <p class="subtitle">Buat akun baru untuk melanjutkan</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan nama" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Buat password">
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </form>
    </div>
</body>
</html>
