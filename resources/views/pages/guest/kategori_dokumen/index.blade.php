@extends('layouts.guest.app')

@section('title', 'Kategori Dokumen')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Kategori Dokumen</h1>
                <p class="mb-0">Kelola semua kategori dokumen desa</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori
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

    @if (session('error'))
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter dan Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('kategori-dokumen.index') }}" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama kategori atau deskripsi..."
                               aria-label="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request()->has('search') && request('search') != '')
                            <a href="{{ route('kategori-dokumen.index', array_merge(request()->except('search'))) }}"
                               class="btn btn-outline-secondary" title="Clear Search">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="sort" class="form-label">Urutkan Berdasarkan</label>
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="dokumen_terbanyak" {{ request('sort') == 'dokumen_terbanyak' ? 'selected' : '' }}>Dokumen Terbanyak</option>
                        <option value="dokumen_ter sedikit" {{ request('sort') == 'dokumen_ter sedikit' ? 'selected' : '' }}>Dokumen Ter sedikit</option>
                    </select>
                </div>

                <div class="col-md-3">
                    @if(request()->hasAny(['search', 'sort']))
                        <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Info Hasil Filter -->
    @if(request()->hasAny(['search', 'sort']))
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        Menampilkan hasil
        @if(request('search'))
            pencarian "<strong>{{ request('search') }}</strong>"
        @endif
        @if(request('search') && request('sort')) dan @endif
        @if(request('sort'))
            @php
                $sortLabels = [
                    'nama' => 'Nama A-Z',
                    'nama_desc' => 'Nama Z-A',
                    'terbaru' => 'Terbaru',
                    'terlama' => 'Terlama',
                    'dokumen_terbanyak' => 'Dokumen Terbanyak',
                    'dokumen_ter sedikit' => 'Dokumen Ter sedikit'
                ];
            @endphp
            urutan "<strong>{{ $sortLabels[request('sort')] ?? request('sort') }}</strong>"
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Statistik Kategori -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $dataKategoriDokumen->total() }}</h3>
                        <p>Total Kategori</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalDokumen ?? 0 }}</h3>
                        <p>Total Dokumen</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $rataRataDokumen ?? 0 }}</h3>
                        <p>Rata-rata Dokumen</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $kategoriTerbanyak ?? 0 }}</h3>
                        <p>Dokumen Terbanyak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="card-grid">
        @forelse ($dataKategoriDokumen as $item)
            <div class="card-custom">
                <div class="card-header-custom">
                    <h5>{{ $item->nama }}</h5>
                    <span class="badge bg-primary">{{ $item->dokumen_hukum_count }} Dokumen</span>
                </div>
                <div class="card-body-custom">
                    <div class="card-item">
                        <div class="card-label">ID Kategori</div>
                        <div class="card-value">#{{ $item->kategori_id }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Deskripsi</div>
                        <div class="card-value">{{ $item->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Dibuat</div>
                        <div class="card-value">{{ $item->created_at ? $item->created_at->format('d M Y') : 'N/A' }}</div>
                    </div>

                    <div class="card-divider"></div>

                    <div class="card-actions">
                        <a href="{{ route('kategori-dokumen.show', $item->kategori_id) }}" class="btn-action btn-detail">
                            <i class="fas fa-eye"></i>Detail
                        </a>
                        <a href="{{ route('kategori-dokumen.edit', $item->kategori_id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form action="{{ route('kategori-dokumen.destroy', $item->kategori_id) }}" method="POST"
                              onsubmit="return confirm('Hapus kategori dokumen ini?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete"
                                    {{ $item->dokumen_hukum_count > 0 ? 'disabled' : '' }}
                                    title="{{ $item->dokumen_hukum_count > 0 ? 'Tidak dapat menghapus kategori yang memiliki dokumen' : '' }}">
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
                        <i class="fas fa-tags"></i>
                        <h4>Belum ada kategori dokumen</h4>
                        <p>
                            @if(request()->hasAny(['search', 'sort']))
                                Tidak ditemukan kategori dengan kriteria yang dicari
                            @else
                                Mulai dengan menambahkan kategori dokumen pertama
                            @endif
                        </p>
                        <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-2"></i>Tambah Kategori
                        </a>
                        @if(request()->hasAny(['search', 'sort']))
                            <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-outline-secondary mt-2">
                                <i class="fas fa-refresh me-2"></i>Tampilkan Semua Kategori
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $dataKategoriDokumen->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
.stat-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
</style>
@endsection
