
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
            <title>Tambah Jenis Dokumen</title>
        </head>

        <body>

            <!-- Start Header/Navigation -->
            @include('layouts.guest.navbar')
            <!-- End Header/Navigation -->

            <!-- Start Content Section -->
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('dokumen.index') }}">Jenis Dokumen</a></li>
                                <li class="breadcrumb-item active">Tambah Jenis Dokumen</li>
                            </ol>
                        </nav>

                        <!-- Header -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h2 class="section-title">Tambah Jenis Dokumen</h2>
                                <p>Form untuk menambahkan jenis dokumen baru</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="card border-0 shadow">
                            <div class="card-body p-5">
                                <form action="{{ route('dokumen.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="nama_jenis" class="form-label">Nama Jenis</label>
                                                <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror"
                                                    id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis') }}"
                                                    placeholder="Masukkan nama jenis" required>
                                                @error('nama_jenis')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                                        id="deskripsi" name="deskripsi" rows="3"
                                                        placeholder="Masukkan deskripsi jenis dokumen">{{ old('deskripsi') }}</textarea>
                                                @error('deskripsi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fas fa-save me-2"></i> Simpan Data
                                            </button>
                                            <a href="{{ route('dokumen.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                                <i class="fas fa-times me-2"></i> Batal
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content Section -->

            <!-- Start Footer Section -->
            @include('layouts.guest.footer')
            <!-- End Footer Section -->

            {{-- start js --}}
            @include('layouts.guest.js')
            {{-- end js --}}
        </body>
    </html>
