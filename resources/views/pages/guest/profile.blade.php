@extends('layouts.guest.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center py-4">
                    <h3 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profil Saya</h3>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        {{-- Bagian Avatar / Icon --}}
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                <i class="fas fa-user fa-4x text-secondary"></i>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'warga' ? 'success' : 'primary') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>

                        {{-- Bagian Data Diri --}}
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 130px;">Nama Lengkap</th>
                                    <td>: {{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Terdaftar Sejak</th>
                                    <td>: {{ $user->created_at->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Login</th>
                                    <td>
                                        : <span class="text-success fw-bold">
                                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Baru saja' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <hr>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('home.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                {{-- Tombol Edit (Opsional, jika nanti ingin dibuatkan) --}}
                                {{-- <a href="#" class="btn btn-primary">
                                    <i class="fas fa-edit me-1"></i> Edit Profil
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
