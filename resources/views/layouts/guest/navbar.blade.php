<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">DokdesKu<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">

            <div class="navbar-nav mx-auto py-0 align-items-center">

                {{-- Home index --}}
                <a href="{{ route('home.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}">
                    <i class="fas fa-home me-1"></i>Home
                </a>

                {{-- Tentang --}}
                <a href="{{ route('tentang') }}"
                    class="nav-item nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                    <i class="fas fa-info-circle me-1"></i>Tentang
                </a>

                {{-- Dokumen (Publik - Semua bisa lihat) --}}
                <a href="{{ route('dokumen-hukum.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('dokumen-hukum.*') ? 'active' : '' }}">
                    <i class="fas fa-book me-2"></i>Dokumen
                </a>

                {{-- Dropdown Layanan (Hanya Muncul Jika SUDAH LOGIN) --}}
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('warga*', 'user*', 'kategori*', 'jenis*') ? 'active' : '' }}"
                           href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-concierge-bell me-1"></i>Layanan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="layananDropdown">

                            {{-- ========================================== --}}
                            {{-- MENU KHUSUS ADMIN (AKSES SEMUA CRUD) --}}
                            {{-- ========================================== --}}
                            @if(Auth::user()->role == 'admin')
                                {{-- 1. Kelola Warga --}}
                                <li>
                                    <a href="{{ route('warga.index') }}" class="dropdown-item">
                                        <i class="fas fa-users me-2"></i>Kelola Data Warga
                                    </a>
                                </li>
                                {{-- 2. Kelola User --}}
                                <li>
                                    <a href="{{ route('user.index') }}" class="dropdown-item">
                                        <i class="fas fa-user-cog me-2"></i>Kelola Data User
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                {{-- 3. Kelola Dokumen Hukum --}}
                                <li>
                                    <a href="{{ route('dokumen-hukum.index') }}" class="dropdown-item">
                                        <i class="fas fa-file-contract me-2"></i>Kelola Dokumen Hukum
                                    </a>
                                </li>
                                {{-- 4. Kelola Kategori Dokumen --}}
                                <li>
                                    <a href="{{ route('kategori-dokumen.index') }}" class="dropdown-item">
                                        <i class="fas fa-tags me-2"></i>Kategori Dokumen
                                    </a>
                                </li>
                                {{-- 5. Kelola Jenis Dokumen --}}
                                <li>
                                    <a href="{{ route('jenis-dokumen.index') }}" class="dropdown-item">
                                        <i class="fas fa-file-alt me-2"></i>Jenis Dokumen
                                    </a>
                                </li>
                            @endif

                            {{-- ========================================== --}}
                            {{-- MENU KHUSUS WARGA --}}
                            {{-- ========================================== --}}
                            @if(Auth::user()->role == 'warga')
                                <li>
                                    <a href="{{ route('warga.index') }}" class="dropdown-item">
                                        <i class="fas fa-user me-2"></i>Data Warga Saya
                                    </a>
                                </li>
                            @endif

                            {{-- ========================================== --}}
                            {{-- MENU KHUSUS USER --}}
                            {{-- ========================================== --}}
                            @if(Auth::user()->role == 'user')
                                <li>
                                    <a href="{{ route('user.index') }}" class="dropdown-item">
                                        <i class="fas fa-user-cog me-2"></i>Data User Saya
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                @endauth
            </div>

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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-circle me-2"></i>Profil Saya
                                </a>
                            </li>
                            {{-- Menampilkan Role --}}
                            <li>
                                <span class="dropdown-item-text text-muted" style="font-size: 0.8rem;">
                                    Role: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                {{-- Link Logout --}}
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
