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
    <title>Edit Riwayat Perubahan</title>
</head>

<body>

    @include('layouts.guest.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('riwayat-perubahan.index') }}">Riwayat Perubahan</a></li>
                        <li class="breadcrumb-item active">Edit Riwayat</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Edit Riwayat Perubahan</h2>
                        <p>Form untuk mengubah data log riwayat</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <form action="{{ route('riwayat-perubahan.update', $riwayat->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="aksi" class="form-label">Jenis Aksi</label>
                                        <select name="aksi" id="aksi" class="form-select @error('aksi') is-invalid @enderror" required>
                                            <option value="Tambah" {{ old('aksi', $riwayat->aksi) == 'Tambah' ? 'selected' : '' }}>Tambah</option>
                                            <option value="Ubah" {{ old('aksi', $riwayat->aksi) == 'Ubah' ? 'selected' : '' }}>Ubah</option>
                                            <option value="Hapus" {{ old('aksi', $riwayat->aksi) == 'Hapus' ? 'selected' : '' }}>Hapus</option>
                                            <option value="Validasi" {{ old('aksi', $riwayat->aksi) == 'Validasi' ? 'selected' : '' }}>Validasi</option>
                                            <option value="Lainnya" {{ old('aksi', $riwayat->aksi) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('aksi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="entitas" class="form-label">Entitas</label>
                                        <input type="text" class="form-control @error('entitas') is-invalid @enderror"
                                               id="entitas" name="entitas"
                                               value="{{ old('entitas', $riwayat->entitas) }}"
                                               placeholder="Contoh: Dokumen Hukum No. 12" required>
                                        @error('entitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                                  id="keterangan" name="keterangan" rows="4"
                                                  placeholder="Jelaskan perubahan yang dilakukan..." required>{{ old('keterangan', $riwayat->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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
    @include('layouts.guest.footer')
    {{-- start js --}}
    @include('layouts.guest.js')
    {{-- end js --}}
</body>
</html>
