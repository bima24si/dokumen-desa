@extends('layouts.guest.app')

@section('title', 'Dokumen Hukum')

@section('content')
    {{-- Header --}}
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">Dokumen Hukum</h1>
                    <p class="mb-0">Kelola semua dokumen hukum desa</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Tambah Dokumen
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        {{-- Flash Messages --}}
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

        {{-- Filter Section --}}
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <form method="GET" action="{{ route('dokumen-hukum.index') }}" class="row g-3 align-items-end">
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
                    <div class="col-md-3">
                        <label for="file_type" class="form-label">Tipe File</label>
                        <select name="file_type" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="utama" {{ request('file_type') == 'utama' ? 'selected' : '' }}>File Utama</option>
                            <option value="lampiran" {{ request('file_type') == 'lampiran' ? 'selected' : '' }}>Lampiran</option>
                        </select>
                    </div>
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
                    <div class="col-md-2">
                        @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
                            <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-redo me-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $totalDokumen }}</h3>
                            <p>Total Dokumen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $dokumenAktif }}</h3>
                            <p>Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-file-import"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $dokumenUtama ?? 0 }}</h3>
                            <p>File Utama</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card h-100">
                    <div class="card-body">
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
        </div>

        {{-- Document Grid --}}
        <div class="card-grid">
            @forelse ($dataDokumenHukum as $item)
                <div class="card-custom">
                    <div class="card-header-custom">
                        {{--
                            FITUR POPOVER RINGKASAN
                            - tabindex="0" agar bisa diakses via keyboard (Tab)
                            - Str::limit pada content agar popover tidak terlalu besar
                        --}}
                        <h5 class="text-primary mb-1 popover-trigger"
                            tabindex="0"
                            role="button"
                            style="cursor: help; outline: none;"
                            data-bs-toggle="popover"
                            data-bs-trigger="hover focus"
                            data-bs-placement="top"
                            data-bs-title="{{ $item->judul }}"
                            data-bs-content="{{ $item->ringkasan ? Str::limit($item->ringkasan, 150) : 'Tidak ada ringkasan tersedia.' }}">
                            {{ Str::limit($item->judul, 40) }}
                        </h5>

                        <div class="mt-2">
                            <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }} me-1">
                                {{ ucfirst($item->status) }}
                            </span>
                            <span class="badge bg-{{ $item->file_type == 'utama' ? 'info' : 'warning' }}">
                                {{ ucfirst($item->file_type) }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body-custom">
                        <div class="card-item">
                            <div class="card-label">Nomor File</div>
                            <div class="card-value">
                                <span class="badge bg-light text-dark border">
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
                            <div class="card-value">{{ $item->jenisDokumen->nama_jenis ?? '-' }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Kategori</div>
                            <div class="card-value">{{ $item->kategoriDokumen->nama ?? '-' }}</div>
                        </div>

                        <div class="card-item">
                            <div class="card-label">Tanggal</div>
                            <div class="card-value">
                                {{-- Menggunakan translatedFormat agar bulan jadi Bahasa Indonesia (misal: May -> Mei) --}}
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <div class="card-divider"></div>

                        <div class="card-actions">
                            <a href="{{ route('dokumen-hukum.show', $item->dokumen_id) }}" class="btn-action btn-detail" title="Lihat Detail">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>

                            @if($item->mainFile || $item->file_number)
                                <a href="{{ route('dokumen-hukum.download', $item->file_number) }}"
                                   class="btn-action btn-download" target="_blank" title="Unduh File">
                                    <i class="fas fa-download me-1"></i>Unduh
                                </a>
                            @endif

                            <a href="{{ route('dokumen-hukum.edit', $item->dokumen_id) }}" class="btn-action btn-edit" title="Edit Dokumen">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>

                            <form action="{{ route('dokumen-hukum.destroy', $item->dokumen_id) }}" method="POST"
                                  onsubmit="return confirm('Hapus dokumen hukum ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus Dokumen">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 empty-container">
                    <div class="card-custom">
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada dokumen hukum</h4>
                            <p class="text-muted mb-4">
                                @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
                                    Tidak ditemukan dokumen dengan kriteria yang dicari
                                @else
                                    Mulai dengan menambahkan dokumen hukum pertama
                                @endif
                            </p>
                            <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Dokumen
                            </a>
                            @if (request()->hasAny(['search', 'jenis_id', 'file_type', 'file_number']))
                                <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $dataDokumenHukum->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- STYLE SECTION --}}
    <style>
        /* Empty State Helper */
        .empty-container {
            grid-column: 1 / -1;
        }

        /* Statistik Card Style */
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
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
            flex-shrink: 0;
        }
        .stat-info {
            overflow: hidden; /* Mencegah teks panjang merusak layout */
        }
        .stat-info h3 {
            margin: 0;
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.5rem;
        }
        .stat-info p {
            margin: 0;
            color: #7f8c8d;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        /* Grid Layout Styles */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }
        .card-custom {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .card-header-custom {
            padding: 1.25rem;
            border-bottom: 1px solid #f0f0f0;
            background: #fff;
            border-radius: 10px 10px 0 0;
        }
        .card-header-custom h5 {
            margin: 0;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.4;
        }
        .card-body-custom {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        .card-label {
            color: #7f8c8d;
            font-weight: 500;
        }
        .card-value {
            color: #2c3e50;
            font-weight: 600;
            text-align: right;
            max-width: 60%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-divider {
            height: 1px;
            background-color: #f0f0f0;
            margin: 1rem 0;
        }

        /* Button Actions Styles */
        .card-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: auto;
            flex-wrap: wrap;
        }
        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border: none;
            background: transparent;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-detail { color: #3b82f6; background: rgba(59, 130, 246, 0.1); }
        .btn-detail:hover { background: #3b82f6; color: white; }

        .btn-edit { color: #f59e0b; background: rgba(245, 158, 11, 0.1); }
        .btn-edit:hover { background: #f59e0b; color: white; }

        .btn-delete { color: #ef4444; background: rgba(239, 68, 68, 0.1); }
        .btn-delete:hover { background: #ef4444; color: white; }

        .btn-download { color: #10b981; background: rgba(16, 185, 129, 0.1); }
        .btn-download:hover { background: #10b981; color: white; }
    </style>

    {{-- SCRIPT SECTION --}}
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            // Cek apakah Bootstrap sudah dimuat untuk menghindari error
            if (typeof bootstrap !== 'undefined') {
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl, {
                        // Opsi tambahan jika diperlukan
                        html: false, // Set true jika ringkasan mengandung HTML
                        trigger: 'hover focus' // Memastikan trigger berfungsi ganda
                    });
                });
            } else {
                console.warn('Bootstrap JS belum dimuat sepenuhnya.');
            }
        });
    </script>
@endsection
