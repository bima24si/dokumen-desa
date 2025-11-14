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
		<title>Data Users</title>
	</head>

	<body>

		<<!-- Start Header/Navigation -->
		@include('layouts.guest.navbar')
		<!-- End Header/Navigation -->

		<!-- Start Content Section -->
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<!-- Header -->
					<div class="row mb-4">
						<div class="col-md-6">
							<h2 class="section-title">Data Users</h2>
							<p>List data seluruh users</p>
						</div>
						<div class="col-md-6 text-end">
							<a href="{{ route('user.create') }}" class="btn btn-primary">
								<i class="fas fa-plus me-2"></i>Tambah User
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
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th width="120">Aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($dataUser as $user)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->email }}</td>
												<td>
													<div class="btn-group" role="group">
														<a href="{{ route('user.edit', $user->id) }}"
														   class="btn btn-warning btn-sm">
															<i class="fas fa-edit"></i>
														</a>
														<form action="{{ route('user.destroy', $user->id) }}"
															  method="POST"
															  onsubmit="return confirm('Hapus user ini?')">
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
		@include('layouts.guest.footer')
		<!-- End Footer Section -->

		{{-- start js --}}
		@include('layouts.guest.js')
        {{-- end js --}}
	</body>
</html>
