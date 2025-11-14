 <nav
            class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark"
            arial-label="Furni navigation bar"
        >
            <div class="container">
                <a class="navbar-brand" href="index.html"
                    >DokdesKu<span>.</span></a
                >

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarsFurni"
                    aria-controls="navbarsFurni"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsFurni">
                    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item active">
							<a class="nav-link " href="{{ route('home.index') }}">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('warga.index') }}">Warga</a>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('dokumen.index') }}">Dokumen</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('user.index') }}">Users</a>
						</li>
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

