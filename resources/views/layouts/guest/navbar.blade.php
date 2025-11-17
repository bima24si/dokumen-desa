<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="index.html">DokdesKu<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <!-- Menu Navigasi Utama -->
            <div class="navbar-nav mx-auto py-0 align-items-center">
                <a href="{{ url('/home') }}"
                    class="nav-item nav-link {{ request()->is('home.index') ? 'active' : '' }}">
                    <i class="fas fa-home me-1"></i>Home
                </a>

                <a href="{{ url('/tentang') }}"
                    class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">
                    <i class="fas fa-info-circle me-1"></i>Tentang
                </a>


                <a href="{{ route('dokumen.index') }}"
                    class="nav-item nav-link {{ request()->is('dokumen.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Dokumen
                </a>


                <!-- Dropdown Menu Layanan -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-concierge-bell me-1"></i>Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                        <li>
                            <a href="{{ route('warga.index') }}"
                                class="dropdown-item {{ request()->is('warga.*') ? 'active' : '' }}">
                                <i class="fas fa-users me-2"></i>Data Warga
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('user.index') }}"
                                class="dropdown-item {{ request()->is('user.*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog me-2"></i>Data User
                            </a>
                        </li>

                             <li>
                            <a href="{{ route('kategori-dokumen.index') }}"
                                class="dropdown-item {{ request()->is('kategori-dokumen*') ? 'active' : '' }}">
                                <i class="fas fa-tags me-2"></i>Kategori Dokumen
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('dokumen-hukum.index') }}"
                                class="dropdown-item {{ request()->is('dokumen-hukum*') ? 'active' : '' }}">
                                <i class="fas fa-file-contract me-2"></i>Dokumen Hukum
                            </a>
                        </li>



                        {{-- <li>
                            <a href="{{ route('lembaga.index') }}"
                                class="dropdown-item {{ request()->is('lembaga*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog me-2"></i>Data Lembaga Desa
                            </a>

                        </li>

                        <li>
                        <li>
                            <a href="{{ route('jabatan-lembaga.index') }}"
                                class="dropdown-item {{ request()->is('jabatan-lembaga*') ? 'active' : '' }}">
                                <i class="fas fa-user-tie me-2"></i>Data Jabatan Lembaga
                            </a>
                        </li>
                        </li> --}}
                    </ul>
                </div>


                <a href="#" class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">
                    <i class="fas fa-address-book me-1"></i>Kontak
                </a>
            </div>

            </ul>
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <div class="nav-item dropdown">
                    <div class="user-icon dropdown-toggle align-items-center" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i>
                        <span class="user-name">Guest</span>
                    </div>
                    <ul class="dropdown-menu user-dropdown dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user-circle me-2"></i>Profil Saya
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i>Pengaturan
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt me-2"></i>Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>


    </div>
</nav>
