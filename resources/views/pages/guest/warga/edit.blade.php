<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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

    <title>Edit Data Warga</title>
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

                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i
                                        class="fas fa-home"></i></a></li>

                            <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
                            <li class="breadcrumb-item active">Edit Warga</li>
                        </ol>
                    </nav>

                    <!-- Header -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h2 class="section-title">Edit Data Warga</h2>
                            <p>Form untuk mengubah data warga</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="card border-0 shadow">
                        <div class="card-body p-5">
                            <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="no_ktp" class="form-label">No KTP</label>
                                            <input type="text"
                                                class="form-control @error('no_ktp') is-invalid @enderror"
                                                id="no_ktp" name="no_ktp"
                                                value="{{ old('no_ktp', $dataWarga->no_ktp) }}"
                                                placeholder="Masukkan No KTP" required>
                                            @error('no_ktp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                name="nama" value="{{ old('nama', $dataWarga->nama) }}"
                                                placeholder="Masukkan nama lengkap" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="agama" class="form-label">Agama</label>
                                            <input type="text"
                                                class="form-control @error('agama') is-invalid @enderror" id="agama"
                                                name="agama" value="{{ old('agama', $dataWarga->agama) }}"
                                                placeholder="Masukkan agama" required>
                                            @error('agama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                            <input type="text"
                                                class="form-control @error('pekerjaan') is-invalid @enderror"
                                                id="pekerjaan" name="pekerjaan"
                                                value="{{ old('pekerjaan', $dataWarga->pekerjaan) }}"
                                                placeholder="Masukkan pekerjaan" required>
                                            @error('pekerjaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="telp" class="form-label">Telepon</label>
                                            <input type="text"
                                                class="form-control @error('telp') is-invalid @enderror" id="telp"
                                                name="telp" value="{{ old('telp', $dataWarga->telp) }}"
                                                placeholder="Masukkan nomor telepon" required>
                                            @error('telp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email"
                                                value="{{ old('email', $dataWarga->email) }}"
                                                placeholder="Masukkan email" required>
                                            @error('email')
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
                                        <a href="{{ route('warga.index') }}"
                                            class="btn btn-outline-secondary btn-lg ms-2">
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
