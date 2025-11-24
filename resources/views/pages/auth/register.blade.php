<!DOCTYPE html>
<html lang="id">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header h1 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e5e9;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-register {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;

        }

        .btn-register:hover {
            transform: translateY(-2px);
        }

        .alert {
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .form-info {
            background-color: #e7f3ff;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #0066cc;
        }

        .form-info ul {
            margin-left: 1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>👤 Daftar Akun Baru</h1>
            <p>Silakan buat akun baru Anda</p>
        </div>

        <!-- Informasi ketentuan registrasi -->
        <div class="form-info">
            <strong>Ketentuan Registrasi:</strong>
            <ul>
                <li>Semua kolom wajib diisi</li>
                <li>Nama minimal 3 karakter</li>
                <li>Email harus valid dan unik</li>
                <li>Password minimal 8 karakter</li>
                <li>Password harus mengandung huruf kapital dan angka</li>
                <li>Konfirmasi password harus sama dengan password</li>
            </ul>
        </div>

        <!-- Menampilkan error validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">

            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap:</label>

                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap" required>

            </div>

            <div class="form-group">
                <label for="email">Email:</label>

                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>

                <input type="password" id="password" name="password"
                       placeholder="Masukkan password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Masukkan ulang password" required>
            </div>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('auth.index') }}">Masuk di sini</a>
        </div>
    </div>
</body>
</html>
