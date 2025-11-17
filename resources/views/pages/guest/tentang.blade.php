@extends('layouts.guest.app')
@include('layouts.guest.wa-float')

@section('content')
<section class="main-content">

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="intro-excerpt">
                        <h1>Tentang Kami</h1>
                        <p class="mb-4">
                            Website Dokumen Desa merupakan platform digital yang dibangun untuk memudahkan masyarakat
                            dalam mengakses berbagai jenis dokumen dan informasi penting desa secara transparan dan efisien.
                        </p>
                        <p class="mb-4">
                            Kami berkomitmen untuk memberikan pelayanan terbaik dalam pengelolaan dokumen desa
                            yang mudah diakses oleh seluruh lapisan masyarakat.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-img-wrap text-center">
                        <img src="https://www.masterplandesa.com/wp-content/uploads/2025/06/Pedesaan.jpg"
                             class="img-fluid rounded"
                             alt="Desa Mandiri"
                             style="max-height: 350px; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Visi Misi Section -->
    <div class="product-section" id="visi-misi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title">Visi & Misi Kami</h2>
                    <p class="mb-4">Landasan utama dalam pengembangan sistem dokumen desa</p>
                </div>
            </div>

            <div class="row gcr-row justify-content-center">
                <!-- Visi Card -->
                <div class="col-md-6 mb-4">
                    <div class="gcr-card h-100">
                        <div class="gcr-header">
                            <div class="icon-wrapper">
                                <i class="fas fa-eye text-primary"></i>
                            </div>
                            <div class="header-text">
                                <h6 class="name">Visi</h6>
                            </div>
                        </div>
                        <div class="gcr-footer">
                            <p class="date">
                                Menjadi platform terdepan dalam pengelolaan dokumen desa yang transparan,
                                akuntabel, dan mudah diakses oleh seluruh masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Misi Card -->
                <div class="col-md-6 mb-4">
                    <div class="gcr-card h-100">
                        <div class="gcr-header">
                            <div class="icon-wrapper">
                                <i class="fas fa-bullseye text-success"></i>
                            </div>
                            <div class="header-text">
                                <h6 class="name">Misi</h6>
                            </div>
                        </div>
                        <div class="gcr-footer">
                            <ul class="misi-list">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Memudahkan akses dokumen bagi masyarakat
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Meningkatkan transparansi pengelolaan dokumen
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Melestarikan arsip dokumen desa secara digital
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Memberikan pelayanan yang cepat dan tepat
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Mengoptimalkan teknologi untuk efisiensi administrasi
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Visi Misi Section -->

    {{-- <!-- Start Product Section -->
    <div class="product-section" id="fitur">
        <div class="container">
            <div class="row">
                <!-- Header -->
                <div class="col-md-12 col-lg-6 mb-5 mb-lg-0 text-center">
                    <h2 class="section-title">Fitur Unggulan Platform</h2>
                    <p class="mb-4">Kami menyediakan berbagai fitur untuk mendukung kebutuhan administrasi desa yang modern dan efisien.</p>
                </div>
            </div>

            <div class="row gcr-row mt-4">
                <!-- Feature 1 -->
                <div class="col-md-6 mb-4">
                    <a href="#" class="gcr-card-link">
                        <div class="gcr-card">
                            <div class="gcr-header">
                                <img src="https://via.placeholder.com/48" alt="Kategori Dokumen" class="profile-img" />
                                <div class="header-text">
                                    <h6 class="name">Kategori Dokumen</h6>
                                </div>
                            </div>
                            <div class="gcr-footer">
                                <p class="date">Dokumen terorganisir dalam berbagai kategori untuk memudahkan pencarian dan akses</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 mb-4">
                    <a href="#" class="gcr-card-link">
                        <div class="gcr-card">
                            <div class="gcr-header">
                                <img src="https://via.placeholder.com/48" alt="Pencarian Cepat" class="profile-img" />
                                <div class="header-text">
                                    <h6 class="name">Pencarian Cepat</h6>
                                </div>
                            </div>
                            <div class="gcr-footer">
                                <p class="date">Fitur pencarian yang powerful untuk menemukan dokumen dengan mudah dan akurat</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 mb-4">
                    <a href="#" class="gcr-card-link">
                        <div class="gcr-card">
                            <div class="gcr-header">
                                <img src="https://via.placeholder.com/48" alt="Keamanan Data" class="profile-img" />
                                <div class="header-text">
                                    <h6 class="name">Keamanan Data</h6>
                                </div>
                            </div>
                            <div class="gcr-footer">
                                <p class="date">Dokumen penting terlindungi dengan sistem keamanan berlapis dan terenkripsi</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 mb-4">
                    <a href="#" class="gcr-card-link">
                        <div class="gcr-card">
                            <div class="gcr-header">
                                <img src="https://via.placeholder.com/48" alt="Akses Mudah" class="profile-img" />
                                <div class="header-text">
                                    <h6 class="name">Akses Mudah</h6>
                                </div>
                            </div>
                            <div class="gcr-footer">
                                <p class="date">Dapat diakses kapan saja dan dimana saja melalui berbagai perangkat</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Team Section -->
    <div class="why-choose-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title">Tim Pengembang</h2>
                    <p>Dibangun oleh tim yang berdedikasi untuk kemajuan desa digital</p>
                </div>
            </div>

            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="feature text-center">
                        <div class="icon mb-3">
                            <img src="https://via.placeholder.com/80" class="rounded-circle" alt="Team Member">
                        </div>
                        <h3>John Doe</h3>
                        <p class="text-muted">Lead Developer</p>
                        <p>Bertanggung jawab dalam pengembangan sistem dan maintenance platform</p>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature text-center">
                        <div class="icon mb-3">
                            <img src="https://via.placeholder.com/80" class="rounded-circle" alt="Team Member">
                        </div>
                        <h3>Jane Smith</h3>
                        <p class="text-muted">UI/UX Designer</p>
                        <p>Mendesain interface yang user-friendly dan mudah digunakan masyarakat</p>
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <div class="feature text-center">
                        <div class="icon mb-3">
                            <img src="https://via.placeholder.com/80" class="rounded-circle" alt="Team Member">
                        </div>
                        <h3>Mike Johnson</h3>
                        <p class="text-muted">Data Analyst</p>
                        <p>Mengelola dan menganalisis data dokumen untuk pengembangan fitur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Team Section -->

    <!-- Start Contact Info -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Kontak Kami</h2>
                    <p>Hubungi kami untuk informasi lebih lanjut</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="contact-info text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <h3>Alamat</h3>
                        <p>Jl. Desa No. 123<br>Kecamatan Contoh<br>Kabupaten Sample, 12345</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="contact-info text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-phone fa-2x text-success"></i>
                        </div>
                        <h3>Telepon</h3>
                        <p>+62 123 4567 8900</p>
                    </div>
                </div>
                <div class="col-md-4 mb-0">
                    <div class="contact-info text-center">
                        <div class="icon mb-3">
                            <i class="fas fa-envelope fa-2x text-warning"></i>
                        </div>
                        <h3>Email</h3>
                        <p>info@dokumendesa.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Info --> --}}

</section>



@endsection
