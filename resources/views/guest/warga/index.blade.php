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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('assets-guest/css/tiny-slider.css') }}" rel="stylesheet">
		<link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">
		<title>Data Warga</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">Data<span>Warga</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('dokumen.indexgi') }}">Home</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="{{ route('warga.index') }}">Data Warga</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('dokumen.index') }}">Dokumen</a>
						</li>
					</ul>
				</div>
			</div>

		</nav>
		<!-- End Header/Navigation -->

		<!-- Start Content Section -->
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<!-- Header -->
					<div class="row mb-4">
						<div class="col-md-6">
							<h2 class="section-title">Data Warga</h2>
							<p>List data seluruh warga</p>
						</div>
						<div class="col-md-6 text-end">
							<a href="{{ route('warga.create') }}" class="btn btn-primary">
								<i class="fas fa-plus me-2"></i>Tambah Warga
							</a>
						</div>
					</div>

					<!-- Alert -->
					@if (session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<!-- Table -->
					<div class="card border-0 shadow">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead class="thead-dark">
										<tr>
											<th>No KTP</th>
											<th>Nama</th>
											<th>Jenis Kelamin</th>
											<th>Agama</th>
											<th>Pekerjaan</th>
											<th>Telp</th>
											<th>Email</th>
											<th width="120">Aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($dataWarga as $item)
											<tr>
												<td>{{ $item->no_ktp }}</td>
												<td>{{ $item->nama }}</td>
												<td>{{ $item->jenis_kelamin }}</td>
												<td>{{ $item->agama }}</td>
												<td>{{ $item->pekerjaan }}</td>
												<td>{{ $item->telp }}</td>
												<td>{{ $item->email }}</td>
												<td>
													<div class="btn-group" role="group">
														<a href="{{ route('warga.edit', $item->warga_id) }}"
														   class="btn btn-warning btn-sm">
															<i class="fas fa-edit"></i>
														</a>
														<form action="{{ route('warga.destroy', $item->warga_id) }}"
															  method="POST"
															  onsubmit="return confirm('Hapus data ini?')">
															@csrf
															@method('DELETE')
															<button type="submit" class="btn btn-danger btn-sm">
																<i class="fas fa-trash"></i>
															</button>
														</form>
													</div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content Section -->

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">
				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center">
								<span class="me-1"><i class="fas fa-envelope"></i></span>
								<span>Subscribe to Newsletter</span>
							</h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Data<span>Warga</span></a></div>
						<p class="mb-4">Sistem manajemen data warga yang efisien dan terintegrasi.</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="{{ route('home') }}">Home</a></li>
									<li><a href="{{ route('warga.index') }}">Data Warga</a></li>
									<li><a href="{{ route('dokumen.index') }}">Dokumen</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer Section -->

		<script src="{{ asset('assets-guest/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets-guest/js/tiny-slider.js') }}"></script>
		<script src="{{ asset('assets-guest/js/custom.js') }}"></script>
	</body>
</html>
