<!-- [file name]: index.blade.php -->
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

    <!-- Cards Grid -->
    <div class="card-grid">
        @forelse ($dataKategoriDokumen as $item)
            <div class="card-custom">
                <div class="card-header-custom">
                    <h5>{{ $item->nama }}</h5>
                    <span class="badge bg-primary">{{ $item->dokumenHukum->count() }} Dokumen</span>
                </div>
                <div class="card-body-custom">
                    <div class="card-item">
                        <div class="card-label">ID Kategori</div>
                        <div class="card-value">{{ $item->kategori_id }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Deskripsi</div>
                        <div class="card-value">{{ $item->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Dibuat</div>
                        <div class="card-value">{{ $item->created_at->format('d M Y') }}</div>
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
                        <i class="fas fa-tags"></i>
                        <h4>Belum ada kategori dokumen</h4>
                        <p>Mulai dengan menambahkan kategori dokumen pertama</p>
                        <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-2"></i>Tambah Kategori
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
