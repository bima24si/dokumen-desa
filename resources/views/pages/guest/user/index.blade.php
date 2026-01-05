@extends('layouts.guest.app')

@section('title', 'Data Users')

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">Data Users</h1>
                    <p class="mb-0">Kelola semua user sistem</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('user.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Tambah User
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $totalUsers ?? 0 }}</h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $totalUsers ?? 0 }}</h3>
                            <p>User Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $totalUsers ?? 0 }}</h3>
                            <p>Semua User</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('user.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="search" class="form-label">Pencarian User</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Cari nama atau email user..." aria-label="Search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            @if (request()->has('search') && request('search') != '')
                                <a href="{{ route('user.index', request()->except('search', 'page')) }}"
                                    class="btn btn-outline-secondary" title="Clear Search">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        @if (request()->hasAny(['search']))
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-refresh me-1"></i> Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        @if (request()->hasAny(['search']))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan hasil
                @if (request('search'))
                    pencarian "<strong>{{ request('search') }}</strong>"
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-grid">
            @forelse ($dataUser as $user)
                <div class="card-custom">
                    <div class="card-header-custom">
                        <div class="d-flex align-items-center w-100">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets-guest/images/no-image.jpg') }}"
                                    alt="{{ $user->name }}" class="rounded-circle border"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            </div>

                            <div class="flex-grow-1 min-width-0">
                                <h5 class="mb-0 text-truncate" title="{{ $user->name }}">
                                    {{ $user->name }}
                                </h5>
                            </div>

                            @if (auth()->id() == $user->id)
                                <div class="flex-shrink-0 ms-2">
                                    <span class="badge bg-primary">Akun Saya</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body-custom">
                        <div class="card-item">
                            <div class="card-label">Role</div>
                            <div class="card-value">
                                @php
                                    $role = strtolower($user->role);
                                    $badgeClass = match ($role) {
                                        'admin' => 'bg-danger',
                                        'warga' => 'bg-success',
                                        default => 'bg-info',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($role) }}
                                </span>
                            </div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Email</div>
                            <div class="card-value text-break">{{ $user->email }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Dibuat</div>
                            <div class="card-value">{{ $user->created_at->format('d M Y') }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Diupdate</div>
                            <div class="card-value">{{ $user->updated_at->format('d M Y') }}</div>
                        </div>

                        <div class="card-divider"></div>

                        <div class="card-actions">
                            <a href="{{ route('user.show', $user->id) }}" class="btn-action btn-detail">
                                <i class="fas fa-eye"></i>Detail
                            </a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>Edit
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Hapus user ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete"
                                    {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                    <i class="fas fa-trash"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card-custom">
                        <div class="empty-state">
                            <i class="fas fa-user-circle"></i>
                            <h4>Belum ada data user</h4>
                            <p>
                                @if (request()->hasAny(['search']))
                                    Tidak ditemukan user dengan kriteria yang dicari
                                @else
                                    Mulai dengan menambahkan user pertama
                                @endif
                            </p>
                            <a href="{{ route('user.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus me-2"></i>Tambah User
                            </a>
                            @if (request()->hasAny(['search']))
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary mt-2">
                                    <i class="fas fa-refresh me-2"></i>Tampilkan Semua User
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $dataUser->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        /* Stat Card Styles */
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card .card-body {
            display: flex;
            align-items: center;
            padding: 1.5rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 1.5rem;
        }

        .stat-info h3 {
            margin: 0;
            font-weight: bold;
            color: #2c3e50;
        }

        .stat-info p {
            margin: 0;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        /* Card Grid Styles */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card-custom {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
            display: flex;
            flex-direction: column;
        }

        .card-custom:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header-custom {
            padding: 1.25rem 1.25rem 0;
            /* Flex layout now handled by Bootstrap classes inside HTML for better control */
        }

        .card-header-custom h5 {
            margin: 0;
            font-size: 1.1rem;
            color: #2c3e50;
            line-height: 1.4;
        }

        .card-body-custom {
            padding: 1rem 1.25rem 1.25rem;
            flex: 1;
        }

        .card-item {
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .card-label {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.875rem;
            min-width: 80px;
        }

        .card-value {
            color: #2c3e50;
            font-size: 0.875rem;
            text-align: right;
            flex: 1;
            margin-left: 1rem;
        }

        /* Helper for text truncation */
        .min-width-0 {
            min-width: 0;
        }

        .card-divider {
            height: 1px;
            background: #e9ecef;
            margin: 1rem 0;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 0.375rem 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s;
        }

        .btn-detail {
            background: #e3f2fd;
            color: #1976d2;
        }

        .btn-edit {
            background: #fff3e0;
            color: #f57c00;
        }

        .btn-delete {
            background: #ffebee;
            color: #d32f2f;
        }

        .btn-action:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-action:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .empty-state h4 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            margin-bottom: 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr;
            }

            .card-actions {
                justify-content: center;
            }

            .btn-action {
                flex: 1;
                justify-content: center;
                min-width: 100px;
            }

            .stat-card .card-body {
                padding: 1rem;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }
    </style>
@endsection
