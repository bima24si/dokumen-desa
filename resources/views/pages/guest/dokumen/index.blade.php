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
		<title>Jenis Dokumen</title>
	</head>

	<body>

			<!-- Start Header/Navigation -->
		@include('layouts.guest.navbar')
		<!-- End Header/Navigation -->

		<!-- Start Content Section -->
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<!-- Header -->
					<div class="row mb-4">
						<div class="col-md-6">
							<h2 class="section-title">Jenis Dokumen</h2>
							<p>List data jenis dokumen</p>
						</div>
						<div class="col-md-6 text-end">
							<a href="{{ route('dokumen.create') }}" class="btn btn-primary">
								<i class="fas fa-plus me-2"></i>Tambah Jenis Dokumen
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
											<th>Nama Jenis</th>
											<th>Deskripsi</th>
											<th width="120">Aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($dataJenisDokumen as $item)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $item->nama_jenis }}</td>
												<td>{{ $item->deskripsi ?? '-' }}</td>
												<td>
													<div class="btn-group" role="group">
														<a href="{{ route('dokumen.edit', $item->jenis_id) }}"
														   class="btn btn-warning btn-sm">
															<i class="fas fa-edit"></i>
														</a>
														<form action="{{ route('dokumen.destroy', $item->jenis_id) }}"
															  method="POST"
															  onsubmit="return confirm('Hapus jenis dokumen ini?')">
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
