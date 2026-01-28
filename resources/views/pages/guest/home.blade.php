@extends('layouts.guest.app')
@include('layouts.guest.wa-float')

@section('content')
<section class="main-content">

    {{-- HERO SECTION --}}
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-7">
                    <div class="intro-excerpt">
                        <h1 class="display-4 fw-bold text-primary mb-3">Selamat Datang di DokdesKu</h1>
                        <h2 class="h3 text-secondary mb-4">Website Resmi Dokumen Desa</h2>
                        <p class="lead mb-4">
                            Selamat datang di platform digital terpadu untuk pengelolaan dokumen desa.
                            Kami hadir untuk memudahkan akses dan pengelolaan berbagai dokumen administrasi
                            desa secara transparan, efisien, dan terorganisir.
                        </p>
                        <p class="mb-4">
                            Dengan sistem yang terintegrasi, masyarakat dapat dengan mudah mengakses
                            informasi dan dokumen penting desa kapan saja dan di mana saja.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#dokumen" class="btn btn-primary btn-lg px-4 py-2">
                                <i class="fas fa-file-alt me-2"></i>Jelajahi Dokumen
                            </a>
                            {{-- Cek apakah route 'tentang' ada --}}
                            <a href="{{ Route::has('tentang') ? route('tentang') : '#' }}" class="btn btn-outline-primary btn-lg px-4 py-2">
                                <i class="fas fa-info-circle me-2"></i>Tentang Kami
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-img-wrap text-center">
                        <img src="https://www.masterplandesa.com/wp-content/uploads/2025/06/Pedesaan.jpg"
                             class="img-fluid rounded-3 shadow"
                             alt="Desa Digital"
                             style="max-height: 500px; width: 125%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FEATURES SECTION --}}
    <div class="features-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title mb-3">Mengapa Memilih DokdesKu?</h2>
                    <p class="lead text-muted">Platform terpercaya untuk pengelolaan dokumen desa yang modern</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-bolt fa-2x text-primary"></i>
                        </div>
                        <h4 class="feature-title">Akses Cepat</h4>
                        <p class="feature-description">
                            Temukan dokumen yang Anda butuhkan dengan cepat melalui sistem pencarian yang teroptimasi
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt fa-2x text-success"></i>
                        </div>
                        <h4 class="feature-title">Aman & Terpercaya</h4>
                        <p class="feature-description">
                            Data dan dokumen terlindungi dengan sistem keamanan berlapis untuk privasi Anda
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-mobile-alt fa-2x text-warning"></i>
                        </div>
                        <h4 class="feature-title">Responsif</h4>
                        <p class="feature-description">
                            Akses platform dari berbagai perangkat dengan tampilan yang optimal di semua ukuran layar
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LAYANAN SURAT SECTION (BARU DITAMBAHKAN) --}}
    <div class="surat-section py-5" style="background-color: #f9fbfd;">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title mb-3">Cek Persyaratan Surat</h2>
                    <p class="lead text-muted">Klik pada jenis surat untuk melihat persyaratan yang dibutuhkan</p>
                </div>
            </div>

            <div class="row g-3">
                {{-- Pastikan variabel $dataSurat dikirim dari Controller --}}
                @if(isset($dataSurat))
                    @forelse($dataSurat as $surat)
                    <div class="col-md-6 col-lg-3">
                        {{-- Card Tombol --}}
                        <div class="card h-100 shadow-sm border-0 surat-card" 
                             data-bs-toggle="modal" 
                             data-bs-target="#modalSurat{{ $surat->id }}"
                             style="cursor: pointer; transition: 0.3s;">
                            <div class="card-body d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-square bg-light text-primary rounded-circle p-3">
                                        <i class="fas fa-envelope-open-text fa-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $surat->nama_surat }}</h6>
                                    <small class="text-muted">Klik untuk detail</small>
                                </div>
                            </div>
                        </div>

                        {{-- Modal untuk setiap surat --}}
                        <div class="modal fade" id="modalSurat{{ $surat->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-file-alt me-2"></i> {{ $surat->nama_surat }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <h6 class="fw-bold mb-3 text-secondary">Persyaratan Dokumen:</h6>
                                        <div class="alert alert-light border">
                                            {{-- Mencetak HTML (ul/li) dari database --}}
                                            {!! $surat->persyaratan !!}
                                        </div>
                                        <div class="mt-3 small text-muted">
                                            <i class="fas fa-info-circle me-1"></i> Pastikan semua dokumen asli dibawa saat pengajuan.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada data layanan surat.</p>
                    </div>
                    @endforelse
                @else
                    <div class="col-12 text-center">
                        <div class="alert alert-warning">
                            <strong>Perhatian:</strong> Variabel <code>$dataSurat</code> belum dikirim dari Controller.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    {{-- DEVELOPER SECTION --}}
    <div class="developer-section py-5 bg-white border-top">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title mb-3">Identitas Pengembang</h2>
                    <p class="text-muted">Tim di balik pengembangan DokdesKu</p>
                </div>
            </div>

            <div class="row justify-content-center g-4">
                {{-- Developer 1 --}}
                <div class="col-md-6 col-lg-5">
                    <div class="developer-card p-4 bg-white rounded-4 shadow-sm h-100 text-center position-relative overflow-hidden border">
                        <div class="dev-bg-shape"></div>
                        <div class="position-relative z-index-1">
                            <div class="dev-img-container mb-4 mx-auto">
                                <img src="{{ asset('assets-guest/images/person_1.jpg') }}" alt="Muhammad Rizky Gunawan" class="img-fluid rounded-circle border border-4 border-white shadow" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h3 class="h4 fw-bold mb-1 text-dark">Muhammad Rizky Gunawan</h3>
                            <p class="text-primary fw-bold mb-1">NIM: 2457301097</p>
                            <p class="text-muted small mb-4">Program Studi Sistem Informasi</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="social-btn linkedin"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-btn github"><i class="fab fa-github"></i></a>
                                <a href="#" class="social-btn instagram"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Developer 2 --}}
                <div class="col-md-6 col-lg-5">
                    <div class="developer-card p-4 bg-white rounded-4 shadow-sm h-100 text-center position-relative overflow-hidden border">
                        <div class="dev-bg-shape"></div>
                        <div class="position-relative z-index-1">
                            <div class="dev-img-container mb-4 mx-auto">
                                <img src="{{ asset('assets-guest/images/person_2.jpg') }}" alt="Bima Al Arsy Rabbani" class="img-fluid rounded-circle border border-4 border-white shadow" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h3 class="h4 fw-bold mb-1 text-dark">Bima Al Arsy Rabbani</h3>
                            <p class="text-primary fw-bold mb-1">NIM: 2457301027</p>
                            <p class="text-muted small mb-4">Program Studi Sistem Informasi</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="social-btn linkedin"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-btn github"><i class="fab fa-github"></i></a>
                                <a href="#" class="social-btn instagram"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STYLE SECTION --}}
<style>
    /* Hero Section */
    .hero {
        padding: 80px 0;
        background: linear-gradient(135deg, #407942 0%, #2a602d 100%);
    }
    .intro-excerpt h1 { font-size: 3rem; color: #030506; font-weight: 700; }
    .intro-excerpt h2 { color: #ffffff; font-weight: 400; }
    .text-secondary { --bs-text-opacity: 1; color: rgb(255 255 255) !important; }
    .text-primary { color: #1b0303 !important; }
    
    /* Feature Cards */
    .feature-card, .doc-card, .developer-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }
    .feature-card:hover, .doc-card:hover, .developer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .feature-icon { margin-bottom: 1rem; }
    .feature-title, .doc-title { color: #000000; font-weight: 600; margin-bottom: 1rem; }
    .feature-description { color: #000000; line-height: 1.6; }
    
    /* Doc Cards specific */
    .doc-card { overflow: hidden; }
    .doc-card-header { background: linear-gradient(135deg, #166d45 0%, #3ab65f 100%); color: white; padding: 25px; text-align: center; }
    .doc-icon { font-size: 2.5rem; margin-bottom: 15px; display: block; }
    .doc-title { margin: 0; font-size: 1.2rem; }
    .doc-card-body { padding: 25px; }
    .doc-description { color: #6c757d; line-height: 1.6; margin-bottom: 20px; }
    .doc-badge { background: #e3f2fd; color: #1976d2; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; }
    .doc-card-footer { padding: 20px 25px; border-top: 1px solid #e9ecef; text-align: center; }
    .doc-btn { background: transparent; color: #15a36a; border: 2px solid #166d45; padding: 8px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s ease; }
    .doc-btn:hover { background: #166d45; color: white; }
    
    /* Developer Section */
    .dev-bg-shape { position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(22, 109, 69, 0.05) 0%, rgba(255,255,255,0) 70%); z-index: 0; }
    .social-btn { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem; transition: all 0.3s ease; text-decoration: none; }
    .social-btn:hover { transform: translateY(-3px); color: white; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
    .social-btn.linkedin { background-color: #0077b5; }
    .social-btn.github { background-color: #333; }
    .social-btn.instagram { background-color: #e4405f; }
    .empty-doc-state { color: #6c757d; }
    
    /* STYLE BARU UNTUK SECTION SURAT */
    .surat-card:hover {
        transform: translateY(-5px);
        background-color: #fff;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        border: 1px solid #166d45 !important;
    }
    .icon-square {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e3f2fd;
    }

    @media (max-width: 768px) {
        .hero { padding: 60px 0; text-align: center; }
        .intro-excerpt h1 { font-size: 2.2rem; }
        .doc-card-header { padding: 20px; }
    }
</style>
@endsection