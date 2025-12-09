<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">DokdesKu<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">

            <div class="navbar-nav mx-auto py-0 align-items-center">

                {{-- 1. Home (Semua Bisa Akses) --}}
                <a href="{{ route('home.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}">
                    <i class="fas fa-home me-1"></i>Home
                </a>

                {{-- 2. Tentang (Semua Bisa Akses) --}}
                <a href="{{ route('tentang') }}"
                    class="nav-item nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                    <i class="fas fa-info-circle me-1"></i>Tentang
                </a>

                {{-- 3. Dokumen Hukum (Semua User Login Bisa Lihat Linknya) --}}
                @auth
                    <a href="{{ route('dokumen-hukum.index') }}"
                        class="nav-item nav-link {{ request()->routeIs('dokumen-hukum.*') ? 'active' : '' }}">
                        <i class="fas fa-book me-2"></i>Dokumen Hukum
                    </a>
                @endauth

                {{-- 4. Dropdown Layanan (TAMPILKAN SEMUA MENU ADMIN KE SEMUA USER) --}}
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('warga*', 'user*', 'kategori*', 'jenis*') ? 'active' : '' }}"
                            href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-concierge-bell me-1"></i>Layanan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="layananDropdown">

                            {{-- Menu 1: Kelola Warga (Akses dibatasi Middleware) --}}
                            <li>
                                <a href="{{ route('warga.index') }}" class="dropdown-item">
                                    <i class="fas fa-users me-2"></i>Kelola Data Warga
                                </a>
                            </li>

                            {{-- Menu 2: Kelola User (Akses dibatasi Middleware) --}}
                            <li>
                                <a href="{{ route('user.index') }}" class="dropdown-item">
                                    <i class="fas fa-user-cog me-2"></i>Kelola Data User
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- Menu 3: Kategori Dokumen (Akses Admin Saja) --}}
                            <li>
                                <a href="{{ route('kategori-dokumen.index') }}" class="dropdown-item">
                                    <i class="fas fa-tags me-2"></i>Kategori Dokumen
                                </a>
                            </li>

                            {{-- Menu 4: Jenis Dokumen (Akses Admin Saja) --}}
                            <li>
                                <a href="{{ route('jenis-dokumen.index') }}" class="dropdown-item">
                                    <i class="fas fa-file-alt me-2"></i>Jenis Dokumen
                                </a>
                            </li>

                        </ul>
                    </div>
                @endauth
            </div>

            {{-- Bagian Kanan (Profil / Login) --}}
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">

                @auth
                    {{-- JIKA SUDAH LOGIN --}}
                    <div class="nav-item dropdown">
                        <div class="user-icon dropdown-toggle align-items-center" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; color: white;">
                            <i class="fas fa-user me-2"></i>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </div>
                        <ul class="dropdown-menu user-dropdown dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user-circle me-2"></i>Profil Saya
                                </a>
                            </li>
                            {{-- Menampilkan Waktu Terakhir Login --}}
                            <li>
                                <span class="dropdown-item-text text-muted" style="font-size: 0.8rem;">
                                    <i class="fas fa-history me-1"></i>Login: <br>
                                    <strong>
                                        {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->diffForHumans() : 'Baru saja' }}
                                    </strong>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- JIKA BELUM LOGIN (GUEST) --}}
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary px-4 text-white" href="{{ route('login-form') }}"
                            style="background-color: #3b5d50; border-radius: 20px;">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
