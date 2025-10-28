<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bina Desa - Beranda</title>
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #1b1b18;
            color: white;
            padding: 1rem 0;
        }
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }
        .nav-menu a:hover {
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .hero {
            text-align: center;
            padding: 4rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin: 2rem 0;
            border-radius: 10px;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .login-btn {
            background: #f53003;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <h2>Bina Desa</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="{{ route('login') }}" class="login-btn">Login Admin</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="hero">
            <h1>Selamat Datang di Bina Desa</h1>
            <p>Platform digital untuk membangun desa yang lebih baik dan sejahtera</p>
        </section>

        <section id="tentang">
            <h2>Tentang Bina Desa</h2>
            <p>Bina Desa adalah platform yang didedikasikan untuk mendukung pembangunan dan kemajuan desa melalui teknologi digital.</p>
        </section>

        <section id="layanan">
            <h2>Layanan Kami</h2>
            <div class="features">
                <div class="feature-card">
                    <h3>Administrasi Desa</h3>
                    <p>Sistem administrasi desa yang terintegrasi dan modern</p>
                </div>
                <div class="feature-card">
                    <h3>Data Warga</h3>
                    <p>Pengelolaan data warga yang terstruktur dan aman</p>
                </div>
                <div class="feature-card">
                    <h3>Pelayanan Publik</h3>
                    <p>Layanan publik yang mudah diakses oleh masyarakat</p>
                </div>
            </div>
        </section>

        <section id="kontak">
            <h2>Kontak</h2>
            <p>Hubungi kami untuk informasi lebih lanjut tentang Bina Desa.</p>
        </section>
    </main>

    <footer style="background: #1b1b18; color: white; text-align: center; padding: 2rem; margin-top: 4rem;">
        <p>&copy; 2024 Bina Desa. All rights reserved.</p>
    </footer>
</body>
</html>
