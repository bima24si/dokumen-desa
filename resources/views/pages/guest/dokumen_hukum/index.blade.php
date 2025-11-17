<!-- [file name]: index.blade.php -->
@extends('layouts.guest.app')

@section('title', 'Dokumen Hukum')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Dokumen Hukum</h1>
                <p class="mb-0">Kelola semua dokumen hukum desa</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Dokumen Hukum
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

    <!-- Cards Grid -->
    <div class="card-grid">
        @forelse ($dataDokumenHukum as $item)
            <div class="card-custom">
                <div class="card-header-custom">
                    <h5>{{ $item->judul }}</h5>
                    <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>
                <div class="card-body-custom">
                    <div class="card-item">
                        <div class="card-label">Nomor</div>
                        <div class="card-value">{{ $item->nomor }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Jenis</div>
                        <div class="card-value">{{ $item->jenisDokumen->nama_jenis }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Kategori</div>
                        <div class="card-value">{{ $item->kategoriDokumen->nama_kategori ?? 'Tidak ada kategori' }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Tanggal</div>
                        <div class="card-value">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                    </div>

                    <div class="card-item">
                        <div class="card-label">Ringkasan</div>
                        <div class="card-value">{{ Str::limit($item->ringkasan, 100) ?: 'Tidak ada ringkasan' }}</div>
                    </div>

                    <div class="card-divider"></div>

                    <div class="card-actions">
                        <a href="{{ route('dokumen-hukum.show', $item->dokumen_id) }}" class="btn-action btn-detail">
                            <i class="fas fa-eye"></i>Detail
                        </a>
                        <a href="{{ route('dokumen-hukum.edit', $item->dokumen_id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form action="{{ route('dokumen-hukum.destroy', $item->dokumen_id) }}" method="POST"
                              onsubmit="return confirm('Hapus dokumen hukum ini?')" class="d-inline">
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
                        <i class="fas fa-file-contract"></i>
                        <h4>Belum ada dokumen hukum</h4>
                        <p>Mulai dengan menambahkan dokumen hukum pertama</p>
                        <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-2"></i>Tambah Dokumen Hukum
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
