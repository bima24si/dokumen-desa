@extends('layouts.guest.app')

@section('title', 'Jenis Dokumen')

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">Jenis Dokumen</h1>
                    <p class="mb-0">Kelola semua jenis dokumen desa</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('jenis-dokumen.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Tambah Jenis Dokumen
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

        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('jenis-dokumen.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="filter_nama" class="form-label">Filter Nama Jenis</label>
                        <select name="filter_nama" id="filter_nama" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach ($allJenis as $jenis)
                                <option value="{{ $jenis->nama_jenis }}"
                                    {{ request('filter_nama') == $jenis->nama_jenis ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="search" class="form-label">Pencarian</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Cari jenis dokumen..." aria-label="Search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-grid">
            @forelse ($dataJenisDokumen as $item)
                <div class="card-custom">
                    <div class="card-header-custom">
                        <h5>{{ $item->nama_jenis }}</h5>
                    </div>
                    <div class="card-body-custom">
                        <div class="card-item">
                            <div class="card-label">ID Jenis</div>
                            <div class="card-value">{{ $item->id }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Deskripsi</div>
                            <div class="card-value">{{ $item->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Dibuat</div>
                            <div class="card-value">{{ $item->created_at ? $item->created_at->format('d M Y') : 'N/A' }}
                            </div>
                        </div>

                        <div class="card-divider"></div>

                        <div class="card-actions">
                            <a href="{{ route('jenis-dokumen.show', $item->id) }}" class="btn-action btn-detail text-primary">
                                <i class="fas fa-eye"></i> Detail
                            </a>

                            <a href="{{ route('jenis-dokumen.edit', $item->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>Edit
                            </a>

                            <form action="{{ route('jenis-dokumen.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus jenis dokumen ini?')" class="d-inline">
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
                            <i class="fas fa-folder-open"></i>
                            <h4>Belum ada jenis dokumen</h4>
                            <p>Mulai dengan menambahkan jenis dokumen pertama</p>
                            <a href="{{ route('jenis-dokumen.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus me-2"></i>Tambah Jenis Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $dataJenisDokumen->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
