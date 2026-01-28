<!doctype html>
<html lang="en">

@extends('layouts.guest.app')

@section('title', 'Data Warga')

@include('layouts.guest.wa-float')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Users</a></li>
                        <li class="breadcrumb-item active">Detail User</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Detail User</h2>
                        <p>Informasi lengkap pengguna sistem</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-4 text-center border-end">
                                <div class="mb-4">
                                    {{-- Logika Foto: Cek jika ada foto di storage, jika tidak pakai default --}}
                                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets-guest/images/no-image.jpg') }}"
                                        alt="{{ $user->name }}"
                                        class="img-fluid rounded-circle shadow-sm"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                </div>

                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p class="text-muted mb-3">{{ $user->email }}</p>

                                {{-- Badge Role --}}
                                @php
                                    $role = strtolower($user->role);
                                    $badgeClass = match ($role) {
                                        'admin' => 'bg-danger',
                                        'warga' => 'bg-success',
                                        default => 'bg-info',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} fs-6 px-4 py-2 rounded-pill">
                                    {{ ucfirst($role) }}
                                </span>
                            </div>

                            <div class="col-md-8 ps-md-5">
                                <h5 class="text-primary mb-4 border-bottom pb-2">Informasi Akun</h5>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Nama Lengkap</div>
                                    <div class="col-sm-8 fw-bold">{{ $user->name }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Alamat Email</div>
                                    <div class="col-sm-8 fw-bold">{{ $user->email }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Role Akses</div>
                                    <div class="col-sm-8">
                                        {{ ucfirst($user->role) }}
                                    </div>
                                </div>

                                <h5 class="text-primary mb-4 mt-5 border-bottom pb-2">Informasi Sistem</h5>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Tanggal Bergabung</div>
                                    <div class="col-sm-8 fw-bold">
                                        {{ $user->created_at->format('d F Y, H:i') }}
                                        <small class="text-muted ms-2">({{ $user->created_at->diffForHumans() }})</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">Terakhir Diupdate</div>
                                    <div class="col-sm-8 fw-bold">
                                        {{ $user->updated_at->format('d F Y, H:i') }}
                                    </div>
                                </div>

                                <div class="mt-5 d-flex gap-2">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning text-white">
                                        <i class="fas fa-edit me-2"></i>Edit Data
                                    </a>

                                    {{-- Tombol Hapus (Disembunyikan jika melihat akun sendiri) --}}
                                    @if(auth()->id() != $user->id)
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash me-2"></i>Hapus User
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
