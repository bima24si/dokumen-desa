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
    <title>Tambah User</title>
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
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </nav>

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Tambah User</h2>
                        <p>Form untuk menambahkan user baru</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">

                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}"
                                            placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"
                                            placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role Pengguna</label>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User
                                                (Akses Terbatas)</option>
                                            <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga
                                                (Akses Desa)</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                                (Akses Penuh)</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="photo" class="form-label">Foto Profil</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            id="photo" name="photo" accept="image/*">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder="Masukkan password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Masukkan ulang password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Data
                                    </button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </form>
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
