<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
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
        }

        .success-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .success-header {
            margin-bottom: 2rem;
        }

        .success-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #28a745;
        }

        .success-header h1 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .success-header p {
            color: #666;
            line-height: 1.6;
        }

        .user-info {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .user-info h3 {
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
        }

        .info-value {
            color: #28a745;
            font-weight: 500;
        }

        .btn-container {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-logout {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .welcome-message {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="success-header">
            <div class="success-icon">✅</div>
            <h1>Login Berhasil!</h1>
            <div class="welcome-message">Selamat datang di sistem kami</div>
            <p>Anda telah berhasil masuk ke akun Anda. Sekarang Anda dapat mengakses semua fitur yang tersedia.</p>
        </div>

        <div class="user-info">
            <h3>Informasi Login</h3>
            <div class="info-item">
                <span class="info-label">Username:</span>
                <span class="info-value">{{ session('username') ?? 'User' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Waktu Login:</span>
                <span class="info-value">{{ date('d/m/Y H:i:s') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value">Aktif</span>
            </div>
        </div>

        <div class="btn-container">
            <a href="../dokumen" class="btn btn-back">Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>
