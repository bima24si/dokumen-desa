@extends('layouts.guest.app')
@include('layouts.guest.wa-float')

@section('content')
<section class="main-content">

    <!-- Start Hero Section -->
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
                            <a href="{{ route('tentang') }}" class="btn btn-outline-primary btn-lg px-4 py-2">
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
    <!-- End Hero Section -->

    <!-- Start Features Section -->
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
    <!-- End Features Section -->

    <!-- Start Dokumen Section -->
    <div class="product-section py-5" id="dokumen">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title mb-3">Kategori Dokumen Tersedia</h2>
                    <p class="lead text-muted">Jelajahi berbagai jenis dokumen desa yang telah terorganisir</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse($dataJenisDokumen as $data)
                <div class="col-md-6 col-lg-4">
                    <div class="doc-card h-100">
                        <div class="doc-card-header">
                            <i class="fas fa-folder doc-icon"></i>
                            <h5 class="doc-title">{{ $data->nama_jenis }}</h5>
                        </div>
                        <div class="doc-card-body">
                            <p class="doc-description">
                                {{ $data->deskripsi ?: 'Kategori dokumen penting untuk administrasi desa' }}
                            </p>
                            <div class="doc-meta">
                                <span class="doc-badge">
                                    <i class="fas fa-file me-1"></i> Dokumen Tersedia
                                </span>
                            </div>
                        </div>
                        <div class="doc-card-footer">
                            <a href="#" class="btn doc-btn">
                                <i class="fas fa-eye me-2"></i>Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <div class="empty-doc-state py-5">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum Ada Kategori Dokumen</h4>
                        <p class="text-muted">Kategori dokumen akan segera tersedia</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if($dataJenisDokumen->count() > 0)
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('dokumen.index') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-list me-2"></i>Lihat Semua Kategori
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- End Dokumen Section -->


</section>

<style>
    /* Hero Section */
    .hero {
        padding: 80px 0;
        background: linear-gradient(135deg, #407942 0%, #2a602d 100%);
    }

    .intro-excerpt h1 {
        font-size: 3rem;
        color: #030506;
        font-weight: 700;
    }

    .intro-excerpt h2 {
        color: #ffffff;
        font-weight: 400;
    }

    /* Feature Cards */
    .feature-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .feature-icon {
        margin-bottom: 1rem;
    }

    .feature-title {
        color: #000000;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .feature-description {
        color: #000000;
        line-height: 1.6;
    }

    /* Document Cards */
    .doc-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        overflow: hidden;
    }

    .doc-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }

    .doc-card-header {
        background: linear-gradient(135deg, #166d45 0%, #3ab65f 100%);
        color: white;
        padding: 25px;
        text-align: center;
    }

    .doc-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }

    .doc-title {
        margin: 0;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .doc-card-body {
        padding: 25px;
    }

    .doc-description {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .doc-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .doc-card-footer {
        padding: 20px 25px;
        border-top: 1px solid #e9ecef;
        text-align: center;
    }

    .doc-btn {
        background: transparent;
        color: #15a36a;
        border: 2px solid #166d45;
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .doc-btn:hover {
        background: #166d45;
        color: white;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #15a36a 0%, #166d45 100%) !important;
    }

    .text-secondary {
    --bs-text-opacity: 1;
    color: rgb(255 255 255) !important;
    }
.text-primary {
    color: #ededed !important;
}

    /* Empty State */
    .empty-doc-state {
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero {
            padding: 60px 0;
            text-align: center;
        }

        .intro-excerpt h1 {
            font-size: 2.2rem;
        }

        .doc-card-header {
            padding: 20px;
        }
    }
</style>

@endsection
