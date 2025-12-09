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

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalDokumen }}</h3>
                        <p>Total Dokumen</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $dokumenAktif }}</h3>
                        <p>Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-file-import"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $dokumenUtama ?? 0 }}</h3>
                        <p>File Utama</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-paperclip"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $dokumenLampiran ?? 0 }}</h3>
                        <p>Lampiran</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Search Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('dokumen-hukum.index') }}" class="row g-3 align-items-end">
                    <!-- Search by File Number -->
                    <div class="col-md-4">
                        <label for="file_number_search" class="form-label">Cari Nomor File</label>
                        <div class="input-group">
                            <input type="text" name="file_number" class="form-control"
                                   value="{{ request('file_number') }}" placeholder="Masukkan nomor file...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- File Type Filter -->
                    <div class="col-md-3">
                        <label for="file_type" class="form-label">Tipe File</label>
                        <select name="file_type" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="utama" {{ request('file_type') == 'utama' ? 'selected' : '' }}>File Utama</option>
                            <option value="lampiran" {{ request('file_type') == 'lampiran' ? 'selected' : '' }}>Lampiran</option>
                        </select>
                    </div>

                    <!-- Jenis Dokumen Filter -->
                    <div class="col-md-3">
                        <label for="jenis_id" class="form-label">Jenis Dokumen</label>
                        <select name="jenis_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach ($dataJenisDokumen as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ request('jenis_id') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <div class="col-md-2">
                        @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
                            <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-refresh me-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Hasil Filter -->
        @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan hasil
                @if (request('file_number'))
                    pencarian nomor file "<strong>{{ request('file_number') }}</strong>"
                @endif
                @if (request('file_type'))
                    {{ request('file_number') ? 'dan' : '' }} tipe "<strong>{{ ucfirst(request('file_type')) }}</strong>"
                @endif
                @if (request('jenis_id'))
                    @php
                        $selectedJenis = $dataJenisDokumen->firstWhere('id', request('jenis_id'));
                    @endphp
                    {{ (request('file_number') || request('file_type')) ? 'dan' : '' }} jenis "<strong>{{ $selectedJenis->nama_jenis ?? '' }}</strong>"
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Cards Grid -->
        <div class="card-grid">
            @forelse ($dataDokumenHukum as $item)
                <div class="card-custom">
                    <div class="card-header-custom">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5>{{ Str::limit($item->judul, 60) }}</h5>
                            <div class="d-flex flex-column align-items-end">
                                <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }} mb-1">
                                    {{ ucfirst($item->status) }}
                                </span>
                                <span class="badge bg-{{ $item->file_type == 'utama' ? 'info' : 'warning' }}">
                                    {{ ucfirst($item->file_type) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        <div class="card-item">
                            <div class="card-label">Nomor File</div>
                            <div class="card-value">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-hashtag me-1"></i>{{ $item->file_number }}
                                </span>
                            </div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Nomor Dokumen</div>
                            <div class="card-value">{{ $item->nomor }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Jenis</div>
                            <div class="card-value">{{ $item->jenisDokumen->nama_jenis }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Kategori</div>
                            <div class="card-value">{{ $item->kategoriDokumen->nama ?? 'Tidak ada kategori' }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Tanggal</div>
                            <div class="card-value">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                        </div>

                        <div class="card-divider"></div>

                        <div class="card-actions">
                            <a href="{{ route('dokumen-hukum.show', $item->dokumen_id) }}" class="btn-action btn-detail">
                                <i class="fas fa-eye"></i>Detail
                            </a>
                            @if($item->mainFile)
                                <a href="{{ route('dokumen-hukum.download', $item->file_number) }}"
                                   class="btn-action btn-download" target="_blank">
                                    <i class="fas fa-download"></i>Download
                                </a>
                            @endif
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
                            <p>
                                @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
                                    Tidak ditemukan dokumen dengan kriteria yang dicari
                                @else
                                    Mulai dengan menambahkan dokumen hukum pertama
                                @endif
                            </p>
                            <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus me-2"></i>Tambah Dokumen Hukum
                            </a>
                            @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
                                <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary mt-2">
                                    <i class="fas fa-refresh me-2"></i>Tampilkan Semua Dokumen
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $dataDokumenHukum->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 24px;
        }
        .stat-info h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .stat-info p {
            margin: 5px 0 0;
            color: #666;
        }
        .card-custom .badge {
            font-size: 0.7rem;
            padding: 4px 8px;
        }
        .btn-download {
            background-color: #17a2b8;
            color: white;
        }
        .btn-download:hover {
            background-color: #138496;
            color: white;
        }
    </style>

@endsection
