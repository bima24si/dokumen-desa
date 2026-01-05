<!doctype html>
<html lang="en">

@extends('layouts.guest.app')

@section('title', 'Data Warga')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
                        <li class="breadcrumb-item active">Detail Warga</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Detail Data Warga</h2>
                        <p>Informasi lengkap data warga</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <div class="row align-items-center mb-5">
                            <div class="col-auto">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 32px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h3 class="mb-1">{{ $warga->nama }}</h3>
                                <p class="text-muted mb-0">{{ $warga->pekerjaan }}</p>
                            </div>
                            <div class="col-auto">
                                <span class="badge {{ $warga->jenis_kelamin == 'Laki-laki' ? 'bg-info' : 'bg-pink' }} fs-6 px-3 py-2">
                                    {{ $warga->jenis_kelamin }}
                                </span>
                            </div>
                        </div>

                        <h5 class="mb-4 text-primary border-bottom pb-2">Informasi Pribadi</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="ps-0 text-muted" width="35%">No. KTP</th>
                                        <td class="fw-bold">{{ $warga->no_ktp }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0 text-muted">Agama</th>
                                        <td>{{ $warga->agama }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="ps-0 text-muted" width="35%">Bergabung</th>
                                        <td>{{ $warga->created_at->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0 text-muted">Terakhir Update</th>
                                        <td>{{ $warga->updated_at->diffForHumans() }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <h5 class="mb-4 text-primary border-bottom pb-2">Informasi Kontak</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary"><i class="fas fa-phone fa-lg"></i></div>
                                    <div>
                                        <div class="small text-muted">Nomor Telepon</div>
                                        <div class="fw-bold">{{ $warga->telp }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary"><i class="fas fa-envelope fa-lg"></i></div>
                                    <div>
                                        <div class="small text-muted">Alamat Email</div>
                                        <div class="fw-bold">{{ $warga->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12 text-center">
                                <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-lg text-white">
                                    <i class="fas fa-edit me-2"></i> Edit Data
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
