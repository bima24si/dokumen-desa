<!doctype html>
<html lang="en">
<head>
    @include('layouts.guest.wa-float')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    {{-- start css --}}
    @include('layouts.guest.css')
    {{-- end css --}}

    <title>Detail Kategori Dokumen</title>
</head>

<body>

    @include('layouts.guest.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kategori-dokumen.index') }}">Kategori Dokumen</a></li>
                        <li class="breadcrumb-item active">Detail Kategori</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Detail Kategori Dokumen</h2>
                        <p>Informasi lengkap kategori</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <div class="row align-items-center mb-5">
                            <div class="col-auto">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 32px;">
                                    <i class="fas fa-tags"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h3 class="mb-1">{{ $dataKategoriDokumen->nama }}</h3>
                                <p class="text-muted mb-0">ID Kategori: #{{ $dataKategoriDokumen->kategori_id }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-primary border-bottom pb-2 mb-3">Informasi Kategori</h5>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-muted fw-bold text-uppercase">Nama Kategori</label>
                                <div class="fs-5">{{ $dataKategoriDokumen->nama }}</div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-muted fw-bold text-uppercase">Jumlah Dokumen Terkait</label>
                                <div class="fs-5">
                                    <span class="badge bg-info text-dark">
                                        {{ $dataKategoriDokumen->dokumen_hukum_count ?? 0 }} Dokumen
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="small text-muted fw-bold text-uppercase">Deskripsi</label>
                                <div class="p-3 bg-light rounded mt-1">
                                    {{ $dataKategoriDokumen->deskripsi ?: 'Tidak ada deskripsi untuk kategori ini.' }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-muted fw-bold text-uppercase">Dibuat Pada</label>
                                <div>{{ $dataKategoriDokumen->created_at ? $dataKategoriDokumen->created_at->format('d F Y, H:i') : '-' }}</div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-muted fw-bold text-uppercase">Terakhir Diupdate</label>
                                <div>{{ $dataKategoriDokumen->updated_at ? $dataKategoriDokumen->updated_at->format('d F Y, H:i') : '-' }}</div>
                            </div>
                        </div>

                        <div class="row mt-4 pt-4 border-top">
                            <div class="col-12 text-center">
                                <a href="{{ route('kategori-dokumen.edit', $dataKategoriDokumen->kategori_id) }}" class="btn btn-warning btn-lg text-white">
                                    <i class="fas fa-edit me-2"></i> Edit Data
                                </a>

                                <form action="{{ route('kategori-dokumen.destroy', $dataKategoriDokumen->kategori_id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg"
                                        {{ ($dataKategoriDokumen->dokumen_hukum_count ?? 0) > 0 ? 'disabled' : '' }}
                                        title="{{ ($dataKategoriDokumen->dokumen_hukum_count ?? 0) > 0 ? 'Tidak dapat menghapus kategori yang memiliki dokumen' : '' }}">
                                        <i class="fas fa-trash me-2"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.guest.footer')
    {{-- start js --}}
    @include('layouts.guest.js')
    {{-- end js --}}
</body>
</html>
