@extends('layouts.guest.app')

@section('title', 'Data Warga')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Data Warga</h1>
                <p class="mb-0">Kelola semua data warga desa</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('warga.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Warga
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter dan Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('warga.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>



                <div class="col-md-4">
                    <label for="search" class="form-label">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama, NIK, pekerjaan..."
                               aria-label="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request()->has('search') && request('search') != '')
                            <a href="{{ route('warga.index', array_merge(request()->except('search'))) }}"
                               class="btn btn-outline-secondary" title="Clear Search">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-md-2">
                    @if(request()->hasAny(['jenis_kelamin', 'agama', 'search']))
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="card-grid">
        @forelse ($dataWarga as $item)
            <div class="card-custom">
                <div class="card-header-custom">
                    <h5>{{ $item->nama }}</h5>
                </div>
                <div class="card-body-custom">
                    <div class="card-item">
                        <div class="card-label">No KTP</div>
                        <div class="card-value">{{ $item->no_ktp }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Jenis Kelamin</div>
                        <div class="card-value">{{ $item->jenis_kelamin }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Agama</div>
                        <div class="card-value">{{ $item->agama }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Pekerjaan</div>
                        <div class="card-value">{{ $item->pekerjaan ?: '-' }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Kontak</div>
                        <div class="card-value">
                            @if($item->telp)
                                {{ $item->telp }}<br>
                            @endif
                            @if($item->email)
                                {{ $item->email }}
                            @else
                                Tidak ada kontak
                            @endif
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Dibuat</div>
                        <div class="card-value">{{ $item->created_at->format('d M Y') }}</div>
                    </div>

                    <div class="card-divider"></div>

                    <div class="card-actions">
                        <a href="{{ route('warga.show', $item->warga_id) }}" class="btn-action btn-detail">
                            <i class="fas fa-eye"></i>Detail
                        </a>
                        <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                              onsubmit="return confirm('Hapus data warga ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
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
                        <i class="fas fa-users"></i>
                        <h4>Belum ada data warga</h4>
                        <p>Mulai dengan menambahkan data warga pertama</p>
                        <a href="{{ route('warga.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-2"></i>Tambah Warga
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $dataWarga->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
