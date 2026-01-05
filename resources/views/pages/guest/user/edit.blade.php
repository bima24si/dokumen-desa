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
    <title>Edit User</title>

</head>

<body>

    @include('layouts.guest.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Edit User</h2>
                        <p>Form untuk mengubah data user</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">

                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}"
                                            placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}"
                                            placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role Pengguna</label>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                                            <option value="user" {{ strtolower(old('role', $user->role)) == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="warga" {{ strtolower(old('role', $user->role)) == 'warga' ? 'selected' : '' }}>Warga</option>
                                            <option value="admin" {{ strtolower(old('role', $user->role)) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="photo" class="form-label">Foto Profil</label>

                                        <div class="mb-2">
                                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets-guest/images/no-image.jpg') }}"
                                                 alt="Current Photo"
                                                 class="img-thumbnail"
                                                 style="height: 100px; width: 100px; object-fit: cover;">
                                        </div>

                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            id="photo" name="photo" accept="image/*">

                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                             id="password" name="password" placeholder="Kosongkan jika tidak diubah">
                                         @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Password minimal 6 karakter
                                        </small>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Ulangi password baru">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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
