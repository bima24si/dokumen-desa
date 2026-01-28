@extends('layouts.guest.app')

@section('title', 'Riwayat Perubahan')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Riwayat Perubahan</h1>
                <p class="mb-0">Log aktivitas sistem dan perubahan data desa</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('riwayat-perubahan.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Manual
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-primary"><i class="fas fa-list"></i></div>
                    <div class="stat-info">
                        <h3>{{ $riwayats->total() }}</h3>
                        <p>Total Log</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-success"><i class="fas fa-plus"></i></div>
                    <div class="stat-info">
                        <h3>{{ $riwayats->where('aksi', 'Tambah')->count() }}</h3>
                        <p>Data Baru</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon bg-danger"><i class="fas fa-trash"></i></div>
                    <div class="stat-info">
                        <h3>{{ $riwayats->where('aksi', 'Hapus')->count() }}</h3>
                        <p>Data Dihapus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-grid">
        @forelse ($riwayats as $item)
            <div class="card-custom">
                <div class="card-header-custom d-flex justify-content-between">
                    <h5 class="mb-0">{{ $item->entitas }}</h5>
                    <span class="badge {{ $item->aksi == 'Tambah' ? 'bg-success' : ($item->aksi == 'Hapus' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $item->aksi }}
                    </span>
                </div>
                <div class="card-body-custom">
                    <div class="card-item">
                        <div class="card-label">User</div>
                        <div class="card-value">{{ $item->user->name ?? 'Sistem' }}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">Keterangan</div>
                        <div class="card-value">{{ Str::limit($item->keterangan, 80) }}</div>
                    </div>
                    <div class="card-item">
                        <div class="card-label">Waktu</div>
                        <div class="card-value">{{ $item->created_at->format('d M Y | H:i') }}</div>
                    </div>

                    <div class="card-divider"></div>
                    <div class="card-actions">
                        <a href="{{ route('riwayat-perubahan.edit', $item->id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('riwayat-perubahan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus log?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Tidak ada riwayat perubahan ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $riwayats->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
/* Masukkan CSS yang sama dengan Index Kategori Anda di sini */
.card-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
.card-custom { background: #fff; border-radius: 10px; border: 1px solid #eee; }
/* ... (Copy CSS lainnya dari index kategori) */
</style>
@endsection
