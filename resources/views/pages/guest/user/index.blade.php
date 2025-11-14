<<<<<<< HEAD
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
=======
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Data User</h1>
            <!-- PERBAIKAN DI SINI: route('user.create') -->
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                @if($dataUser->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataUser as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <!-- PERBAIKAN: route('user.edit') -->
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus?')"
                                                    {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">Belum ada data user</p>
                @endif
            </div>
        </div>
    </div>
</body>
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
</html>
