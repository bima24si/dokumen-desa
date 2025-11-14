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
<<<<<<< HEAD
    @include('layouts.guest.wa-float')

=======
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

<<<<<<< HEAD
        {{-- start css --}}
        @include('layouts.guest.css')
        {{-- end css --}}
		<title>Tambah User</title>
=======
		{{-- start css --}}
        @include('layouts.guest.css')
        {{-- end css --}}
		<title>Tambah Data Warga</title>
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
	</head>

	<body>

<<<<<<< HEAD
		<!-- Start Header/Navigation -->
=======
		<<!-- Start Header/Navigation -->
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
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
<<<<<<< HEAD
							<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
							<li class="breadcrumb-item active">Tambah User</li>
=======
							<li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
							<li class="breadcrumb-item active">Tambah Warga</li>
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
						</ol>
					</nav>

					<!-- Header -->
					<div class="row mb-4">
						<div class="col-md-6">
<<<<<<< HEAD
							<h2 class="section-title">Tambah User</h2>
							<p>Form untuk menambahkan user baru</p>
						</div>
						<div class="col-md-6 text-end">
							<a href="{{ route('user.index') }}" class="btn btn-secondary">
=======
							<h2 class="section-title">Tambah Data Warga</h2>
							<p>Form untuk menambahkan data warga baru</p>
						</div>
						<div class="col-md-6 text-end">
							<a href="{{ route('warga.index') }}" class="btn btn-secondary">
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
								<i class="fas fa-arrow-left me-2"></i>Kembali
							</a>
						</div>
					</div>

					<!-- Form -->
					<div class="card border-0 shadow">
						<div class="card-body p-5">
<<<<<<< HEAD
							<form action="{{ route('user.store') }}" method="POST">
=======
							<form action="{{ route('warga.store') }}" method="POST">
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
								@csrf
								<div class="row">
									<div class="col-md-6">
										<div class="mb-4">
<<<<<<< HEAD
											<label for="name" class="form-label">Nama Lengkap</label>
											<input type="text" class="form-control @error('name') is-invalid @enderror"
												   id="name" name="name" value="{{ old('name') }}"
												   placeholder="Masukkan nama lengkap" required>
											@error('name')
=======
											<label for="no_ktp" class="form-label">No KTP</label>
											<input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
												   id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
												   placeholder="Masukkan No KTP" required>
											@error('no_ktp')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>

										<div class="mb-4">
											<label for="nama" class="form-label">Nama Lengkap</label>
											<input type="text" class="form-control @error('nama') is-invalid @enderror"
												   id="nama" name="nama" value="{{ old('nama') }}"
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
												<option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
												<option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
											</select>
											@error('jenis_kelamin')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>

									<div class="col-md-6">
										<div class="mb-4">
											<label for="agama" class="form-label">Agama</label>
											<input type="text" class="form-control @error('agama') is-invalid @enderror"
												   id="agama" name="agama" value="{{ old('agama') }}"
												   placeholder="Masukkan agama" required>
											@error('agama')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>

										<div class="mb-4">
											<label for="pekerjaan" class="form-label">Pekerjaan</label>
											<input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
												   id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
												   placeholder="Masukkan pekerjaan" required>
											@error('pekerjaan')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>

										<div class="mb-4">
											<label for="telp" class="form-label">Telepon</label>
											<input type="text" class="form-control @error('telp') is-invalid @enderror"
												   id="telp" name="telp" value="{{ old('telp') }}"
												   placeholder="Masukkan nomor telepon" required>
											@error('telp')
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
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
									</div>
<<<<<<< HEAD

									<div class="col-md-6">
										<div class="mb-4">
											<label for="password" class="form-label">Password</label>
											<input type="password" class="form-control @error('password') is-invalid @enderror"
												   id="password" name="password"
												   placeholder="Masukkan password" required>
											@error('password')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="form-text text-muted">
												Password minimal 3 karakter dan harus mengandung huruf kapital
											</small>
										</div>

										<div class="mb-4">
											<label for="password_confirmation" class="form-label">Konfirmasi Password</label>
											<input type="password" class="form-control @error('password') is-invalid @enderror"
												   id="password_confirmation" name="password_confirmation"
												   placeholder="Masukkan ulang password" required>
										</div>
									</div>
=======
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
								</div>

								<div class="row mt-4">
									<div class="col-12 text-center">
										<button type="submit" class="btn btn-primary btn-lg">
											<i class="fas fa-save me-2"></i> Simpan Data
										</button>
<<<<<<< HEAD
										<a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
=======
										<a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
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
