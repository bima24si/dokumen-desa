@extends('layouts.guest.app')

@section('title', 'Lampiran Dokumen')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Lampiran Dokumen</h1>
                <p class="mb-0">Kelola semua arsip file dan lampiran dokumen desa</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('lampiran-dokumen.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Lampiran
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
                        <i class="fas fa-paperclip"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalLampiran }}</h3>
                        <p>Total File</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ number_format($totalUkuran / 1048576, 2) }} MB</h3>
                        <p>Total Ukuran</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalLampiran > 0 ? number_format($totalUkuran / $totalLampiran / 1024, 2) : 0 }} KB</h3>
                        <p>Rata-rata Size</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('lampiran-dokumen.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama file..."
                               aria-label="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Dokumen Induk</label>
                    <select name="dokumen_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Dokumen</option>
                        @foreach($dokumenList as $dok)
                            <option value="{{ $dok->id }}" {{ request('dokumen_id') == $dok->id ? 'selected' : '' }}>
                                {{ Str::limit($dok->judul, 20) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tipe File</label>
                    <select name="tipe_file" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tipe</option>
                        @foreach($tipeFileList as $tipe)
                            <option value="{{ $tipe }}" {{ request('tipe_file') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    @if(request()->hasAny(['search', 'dokumen_id', 'tipe_file']))
                        <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card-grid">
        @forelse ($lampiran as $item)
            <div class="card-custom">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center overflow-hidden">
                        <i class="{{ $item->file_icon }} me-2"></i>
                        <h5 class="mb-0 text-truncate" style="max-width: 170px;" title="{{ $item->nama_file }}">
                            {{ Str::limit($item->nama_file, 18) }}
                        </h5>
                    </div>
                    <span class="badge bg-primary">
                        {{ strtoupper(pathinfo($item->nama_file, PATHINFO_EXTENSION)) }}
                    </span>
                </div>

                <div class="card-body-custom">
                    <div class="card-item">
                        <div class="card-label">Dokumen</div>
                        <div class="card-value fw-bold text-dark">
                            {{ $item->dokumen ? Str::limit($item->dokumen->judul, 20) : '-' }}
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Ukuran</div>
                        <div class="card-value">{{ $item->ukuran_file_formatted }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Diupload</div>
                        <div class="card-value">{{ $item->created_at->format('d M Y') }}</div>
                    </div>

                    @if($item->keterangan)
                    <div class="card-item">
                        <div class="card-label">Ket</div>
                        <div class="card-value text-muted small">
                            {{ Str::limit($item->keterangan, 20) }}
                        </div>
                    </div>
                    @endif

                    <div class="card-divider"></div>

                    <div class="card-actions">
                        <a href="{{ route('lampiran-dokumen.download', $item->lampiran_id) }}" class="btn-action text-success">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                        <a href="{{ route('lampiran-dokumen.edit', $item->lampiran_id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('lampiran-dokumen.destroy', $item->lampiran_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus file ini permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5" style="grid-column: 1 / -1;">
                <div class="empty-state">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h4>Belum ada lampiran dokumen</h4>
                    <p class="text-muted">Mulai dengan menambahkan lampiran dokumen pertama</p>
                    <a href="{{ route('lampiran-dokumen.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-2"></i>Tambah Lampiran
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $lampiran->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
/* CSS ini disamakan dengan style yang ada di Kategori Dokumen */

/* Header Style */
.page-header {
    background:#126334 0%, #0d751d 100%; /* Sesuaikan jika Kategori menggunakan warna lain */
    color: white;
    padding: 2rem 0;
    margin-bottom: 2rem;
}

/* Stat Cards */
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
    width: 60px; height: 60px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-right: 15px;
    color: white; font-size: 1.5rem;
}
.stat-info h3 { margin: 0; font-weight: bold; color: #2c3e50; }
.stat-info p { margin: 0; color: #7f8c8d; font-size: 0.9rem; }

/* Card Grid System (Sama persis dengan Kategori) */
.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}
.card-custom {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #eee;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    transition: transform 0.2s;
    display: flex;
    flex-direction: column;
}
.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.card-header-custom {
    padding: 1rem 1.25rem;
    background: #f8f9fa;
    border-bottom: 1px solid #eee;
    border-radius: 10px 10px 0 0;
}
.card-header-custom h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.card-body-custom {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-item {
    margin-bottom: 0.75rem;
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
}
.card-label { color: #6c757d; }
.card-value { font-weight: 600; color: #333; text-align: right; }

.card-divider {
    height: 1px;
    background: #eee;
    margin: 1rem -1.25rem;
}

.card-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: auto;
}

/* Tombol Aksi Custom */
.btn-action {
    padding: 0.4rem 0.8rem;
    border-radius: 5px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    background: transparent;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.btn-action:hover { background: #f0f0f0; }
.btn-detail { color: #17a2b8; } /* Kategori menggunakan ini */
.btn-edit { color: #ffc107; }
.btn-delete { color: #dc3545; }

/* Empty State */
.empty-state { text-align: center; padding: 2rem; }
.empty-state i { margin-bottom: 1rem; color: #dee2e6; }
.empty-state h4 { color: #6c757d; margin-bottom: 0.5rem; }
</style>
@endsection
