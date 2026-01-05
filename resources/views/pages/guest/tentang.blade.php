@extends('layouts.guest.app')
@include('layouts.guest.wa-float')

@section('content')
    <section class="main-content">

        <div class="hero py-5 bg-light">
            <div class="container">
                <div class="row justify-content-between align-items-center flex-column-reverse flex-lg-row">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="intro-excerpt">
                            <span class="d-block text-primary fw-bold text-uppercase letter-spacing-2 mb-2">Tentang Kami</span>
                            <h1 class="mb-4 display-5 fw-bold text-dark">Sistem Informasi <br> <span class="text-primary">Dokumen Desa</span></h1>
                            <p class="mb-4 text-secondary lead">
                                Solusi digital untuk mempermudah administrasi desa. Kami menghadirkan layanan pengajuan surat dan pengelolaan arsip yang <strong>cepat, transparan, dan dapat diakses dari mana saja.</strong>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="#cara-kerja" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">Pelajari Alur</a>
                                <a href="{{ route('dokumen.index') }}" class="btn btn-outline-dark btn-lg rounded-pill px-4">Cari Dokumen</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="position-relative">
                            <div class="bg-shape"></div>
                            <img src="{{ asset('assets-guest/images/dash.png') }}"
                                 class="img-fluid rounded-4 shadow-lg position-relative z-index-1"
                                 alt="Dashboard Dokumen Desa"
                                 style="width: 100%; border: 5px solid rgba(255,255,255,0.5);">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section py-5" id="cara-kerja">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-7 text-center">
                        <h2 class="section-title mb-2">Bagaimana Cara Kerjanya?</h2>
                        <p class="text-muted">Tiga langkah mudah untuk mendapatkan dokumen Anda</p>
                    </div>
                </div>

                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="step-card p-4 h-100 border rounded-4 bg-white position-relative">
                            <div class="step-icon bg-primary-soft text-primary mb-3 mx-auto">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                            <h4 class="h5 fw-bold">1. Buat Akun</h4>
                            <p class="text-muted small mb-0">Daftarkan diri Anda menggunakan NIK untuk mendapatkan akses penuh ke layanan mandiri.</p>
                            <div class="d-none d-md-block position-absolute top-50 end-0 translate-middle-y me-n3 text-muted opacity-25">
                                <i class="fas fa-chevron-right fa-2x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="step-card p-4 h-100 border rounded-4 bg-white position-relative">
                            <div class="step-icon bg-warning-soft text-warning mb-3 mx-auto">
                                <i class="fas fa-file-signature fa-2x"></i>
                            </div>
                            <h4 class="h5 fw-bold">2. Ajukan Surat</h4>
                            <p class="text-muted small mb-0">Pilih jenis surat yang dibutuhkan, isi formulir, dan kirim pengajuan secara online.</p>
                            <div class="d-none d-md-block position-absolute top-50 end-0 translate-middle-y me-n3 text-muted opacity-25">
                                <i class="fas fa-chevron-right fa-2x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="step-card p-4 h-100 border rounded-4 bg-white">
                            <div class="step-icon bg-success-soft text-success mb-3 mx-auto">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <h4 class="h5 fw-bold">3. Selesai & Unduh</h4>
                            <p class="text-muted small mb-0">Pantau status validasi. Setelah disetujui, dokumen digital siap diunduh.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section py-5 bg-white border-top">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="visi-card bg-primary text-white p-5 rounded-4 shadow position-relative overflow-hidden">
                            <div class="position-relative z-index-1">
                                <h3 class="fw-bold mb-3"><i class="fas fa-eye me-2"></i> Visi Kami</h3>
                                <p class="lead mb-0" style="opacity: 0.9;">
                                    "Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan modern melalui digitalisasi arsip."
                                </p>
                            </div>
                            <i class="fas fa-quote-right position-absolute bottom-0 end-0 mb-n2 me-3 text-white opacity-10" style="font-size: 8rem;"></i>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="ps-lg-4">
                            <h3 class="fw-bold mb-4 text-dark"><i class="fas fa-bullseye text-primary me-2"></i> Misi Utama</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="icon-square bg-light text-primary rounded-3 me-3 p-2">
                                            <i class="fas fa-bolt"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Pelayanan Cepat</h6>
                                            <p class="small text-muted mb-0">Memangkas birokrasi yang berbelit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="icon-square bg-light text-primary rounded-3 me-3 p-2">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Data Aman</h6>
                                            <p class="small text-muted mb-0">Arsip tersimpan digital dengan aman.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="icon-square bg-light text-primary rounded-3 me-3 p-2">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Akses Mudah</h6>
                                            <p class="small text-muted mb-0">Dapat diakses seluruh lapisan warga.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="icon-square bg-light text-primary rounded-3 me-3 p-2">
                                            <i class="fas fa-leaf"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Ramah Lingkungan</h6>
                                            <p class="small text-muted mb-0">Mengurangi penggunaan kertas (Paperless).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <style>
        /* Tipografi */
        .letter-spacing-2 { letter-spacing: 2px; }

        /* Hero Styling */
        .bg-shape {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100%;
            height: 100%;
            background: rgba(59, 93, 80, 0.1); /* Warna primary transparan */
            border-radius: 1.5rem;
            z-index: 0;
        }

        /* Step Cards */
        .step-card {
            transition: all 0.3s ease;
        }
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-color: transparent !important;
        }

        /* Icons */
        .step-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .bg-primary-soft { background-color: rgba(59, 93, 80, 0.1); }
        .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
        .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }

        /* Icon Square for Misi */
        .icon-square {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
