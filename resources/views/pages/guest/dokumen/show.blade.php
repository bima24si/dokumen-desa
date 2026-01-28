@extends('layouts.guest.app')

@section('title', 'Detail Jenis Dokumen')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Detail Jenis Dokumen</h1>
            <p class="text-muted mb-0">Informasi lengkap mengenai jenis dokumen ini</p>
        </div>
        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary fw-bold">Informasi Utama</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="small text-muted text-uppercase fw-bold">Nama Jenis</label>
                        <p class="fs-5 fw-bold text-dark">{{ $jenisDokumen->nama_jenis }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted text-uppercase fw-bold">Deskripsi</label>
                        <p class="text-secondary">
                            {{ $jenisDokumen->deskripsi ?: '-' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted text-uppercase fw-bold">Tanggal Dibuat</label>
                        <p class="mb-0">{{ $jenisDokumen->created_at->format('d F Y, H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted text-uppercase fw-bold">Terakhir Diupdate</label>
                        <p class="mb-0">{{ $jenisDokumen->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-grid gap-2">
                   <a href="{{ route('jenis-dokumen.edit', $jenisDokumen->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary fw-bold">Dokumen Terkait</h5>
                    <span class="badge bg-primary rounded-pill">{{ $jenisDokumen->dokumens->count() }} File</span>
                </div>
                <div class="card-body p-0">
                    @if($jenisDokumen->dokumens->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Nama Dokumen</th>
                                        <th>Diupload</th>
                                        <th class="text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jenisDokumen->dokumens as $dok)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold">{{ $dok->nama_dokumen ?? 'Nama tidak tersedia' }}</div>
                                            </td>
                                        <td class="small text-muted">
                                            {{ $dok->created_at->format('d M Y') }}
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="#" class="btn btn-sm btn-light border">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="far fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada dokumen yang menggunakan jenis ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
