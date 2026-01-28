@extends('layouts.guest.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Tombol Kembali --}}
            <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary mb-4">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge bg-primary mb-2">{{ $dataDokumenHukum->jenisDokumen->nama_jenis ?? 'Umum' }}</span>
                            <h2 class="h3 mb-1 fw-bold">{{ $dataDokumenHukum->judul }}</h2>
                            <p class="text-muted mb-0">Nomor: {{ $dataDokumenHukum->nomor }}</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Tanggal Penetapan</small>
                            <span class="fw-bold">{{ \Carbon\Carbon::parse($dataDokumenHukum->tanggal)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Informasi Dasar --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-uppercase text-muted small">Kategori</h6>
                            <p class="fs-5">{{ $dataDokumenHukum->kategoriDokumen->nama_kategori ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-uppercase text-muted small">Status</h6>
                            @if($dataDokumenHukum->status == 'aktif')
                                <span class="badge bg-success">Berlaku / Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Berlaku</span>
                            @endif
                        </div>
                    </div>

                    {{-- Ringkasan --}}
                    <div class="mb-5">
                        <h5 class="fw-bold border-bottom pb-2 mb-3">Ringkasan Dokumen</h5>
                        <div class="text-secondary" style="line-height: 1.8;">
                            {!! nl2br(e($dataDokumenHukum->ringkasan ?? 'Tidak ada ringkasan.')) !!}
                        </div>
                    </div>

                    {{-- AREA DOWNLOAD --}}
                    <div class="row g-4">
                        {{-- 1. File Utama --}}
                        <div class="col-md-6">
                            <div class="card h-100 bg-light border-0">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="fas fa-file-pdf text-danger fa-3x"></i>
                                    </div>
                                    <h6 class="fw-bold">Dokumen Utama</h6>

                                    @if($dataDokumenHukum->mainFile)
                                        <p class="small text-muted text-truncate px-3">{{ $dataDokumenHukum->mainFile->file_name }}</p>
                                        <a href="{{ route('dokumen-hukum.download', $dataDokumenHukum->file_number) }}" class="btn btn-danger w-100">
                                            <i class="fas fa-download me-2"></i>Download Dokumen
                                        </a>
                                    @else
                                        <p class="text-muted fst-italic">File utama belum diunggah.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                       
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
