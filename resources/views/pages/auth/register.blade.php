<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
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

        .password-requirements {
            background-color: #f8f9fa;
            padding: 0.75rem;
            border-radius: 5px;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #6c757d;
            border-left: 4px solid #667eea;
        }

        .password-requirements ul {
            margin-left: 1rem;
            margin-bottom: 0;
        }

        .password-requirements li {
            margin-bottom: 0.25rem;
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
            margin-top: 1rem;
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

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e1e5e9;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
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

        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
        }

        .weak {
            background-color: #dc3545;
            width: 33%;
        }

        .medium {
            background-color: #ffc107;
            width: 66%;
        }

        .strong {
            background-color: #28a745;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-header">
            <h1>📝 Daftar Akun</h1>
            <p>Buat akun baru untuk mengakses sistem</p>
        </div>

        <!-- Informasi ketentuan pendaftaran -->
        <div class="form-info">
            <strong>Ketentuan Pendaftaran:</strong>
            <ul>
                <li>Semua field wajib diisi</li>
                <li>Username minimal 3 karakter</li>
                <li>Password minimal 8 karakter</li>
                <li>Password harus mengandung huruf kapital dan angka</li>
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

        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Masukkan alamat email" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                    placeholder="Masukkan username" required>
                <small style="display: block; margin-top: 5px; color: #6c757d;">Minimal 3 karakter</small>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required
                    placeholder="Masukkan password">
                <div class="password-strength">
                    <div class="password-strength-bar" id="password-strength-bar"></div>
                </div>
                <div class="password-requirements">
                    <strong>Persyaratan password:</strong>
                    <ul>
                        <li id="length-requirement">Minimal 8 karakter</li>
                        <li id="capital-requirement">Mengandung huruf kapital</li>
                        <li id="number-requirement">Mengandung angka</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn-register">Daftar</button>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('auth.login') }}">Login di sini</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('password-strength-bar');
            const lengthRequirement = document.getElementById('length-requirement');
            const capitalRequirement = document.getElementById('capital-requirement');
            const numberRequirement = document.getElementById('number-requirement');

            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                let strength = 0;

                // Reset requirements
                lengthRequirement.style.color = '#6c757d';
                capitalRequirement.style.color = '#6c757d';
                numberRequirement.style.color = '#6c757d';

                // Check length
                if (password.length >= 8) {
                    strength += 1;
                    lengthRequirement.style.color = '#28a745';
                }

                // Check capital letter
                if (/[A-Z]/.test(password)) {
                    strength += 1;
                    capitalRequirement.style.color = '#28a745';
                }

                // Check number
                if (/[0-9]/.test(password)) {
                    strength += 1;
                    numberRequirement.style.color = '#28a745';
                }

                // Update strength bar
                strengthBar.className = 'password-strength-bar';
                if (strength === 1) {
                    strengthBar.classList.add('weak');
                } else if (strength === 2) {
                    strengthBar.classList.add('medium');
                } else if (strength === 3) {
                    strengthBar.classList.add('strong');
                }
            });
        });
    </script>
</body>

</html>
