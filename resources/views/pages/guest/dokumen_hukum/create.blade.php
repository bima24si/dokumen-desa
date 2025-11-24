<!-- [file name]: create.blade.php -->
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
    <title>Tambah Dokumen Hukum</title> <!-- PERBAIKAN: Judul -->
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
                        <li class="breadcrumb-item"><a href="{{ route('dokumen-hukum.index') }}">Dokumen Hukum</a></li> <!-- PERBAIKAN: Route -->
                        <li class="breadcrumb-item active">Tambah Dokumen Hukum</li> <!-- PERBAIKAN: Text -->
                    </ol>
                </nav>

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Tambah Dokumen Hukum</h2> <!-- PERBAIKAN: Judul -->
                        <p>Form untuk menambahkan dokumen hukum baru</p> <!-- PERBAIKAN: Deskripsi -->
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-secondary"> <!-- PERBAIKAN: Route -->
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <form action="{{ route('dokumen-hukum.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_id" class="form-label">Jenis Dokumen</label>
                                        <select class="form-control @error('jenis_id') is-invalid @enderror"
                                                id="jenis_id" name="jenis_id" required>
                                            <option value="">Pilih Jenis Dokumen</option>
                                            @foreach($dataJenisDokumen as $jenis)
                                                <option value="{{ $jenis->id }}" {{ old('jenis_id') == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror"
                                                id="kategori_id" name="kategori_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($dataKategoriDokumen as $kategori)
                                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}> <!-- PERBAIKAN: kategori_id -->
                                                    {{ $kategori->nama }} <!-- PERBAIKAN: nama (bukan nama_kategori) -->
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nomor" class="form-label">Nomor Dokumen</label>
                                        <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                               id="nomor" name="nomor" value="{{ old('nomor') }}"
                                               placeholder="Masukkan nomor dokumen" required>
                                        @error('nomor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                               id="judul" name="judul" value="{{ old('judul') }}"
                                               placeholder="Masukkan judul dokumen" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                               id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="ringkasan" class="form-label">Ringkasan</label>
                                        <textarea class="form-control @error('ringkasan') is-invalid @enderror"
                                                  id="ringkasan" name="ringkasan" rows="4"
                                                  placeholder="Masukkan ringkasan dokumen">{{ old('ringkasan') }}</textarea>
                                        @error('ringkasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="file" class="form-label">File Dokumen</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="file" name="file" accept=".pdf,.doc,.docx">
                                        <small class="form-text text-muted">Format: PDF, DOC, DOCX (Maks: 2MB)</small>
                                        @error('file')
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
                                    <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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
