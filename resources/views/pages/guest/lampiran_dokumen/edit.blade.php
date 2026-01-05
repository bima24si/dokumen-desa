<!doctype html>
<html lang="en">

<head>
    @include('layouts.guest.wa-float')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <title>Edit Lampiran Dokumen</title>

    {{-- start css --}}
    @include('layouts.guest.css')
    {{-- end css --}}
</head>

<body>

    @include('layouts.guest.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('lampiran-dokumen.index') }}">Lampiran</a></li>
                        <li class="breadcrumb-item active">Edit Lampiran</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Edit Lampiran Dokumen</h2>
                        <p>Form untuk memperbarui data dan file lampiran</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">

                        {{-- SOLUSI ERROR URL GENERATION: Passing ID langsung sebagai parameter kedua --}}
                        <form action="{{ route('lampiran-dokumen.update', $lampiranDokumen) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="dokumen_id" class="form-label">Dokumen Induk <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('dokumen_id') is-invalid @enderror"
                                            id="dokumen_id" name="dokumen_id" required>
                                            <option value="">-- Pilih Dokumen --</option>
                                            @foreach ($dokumenList as $dokumen)
                                                <option value="{{ $dokumen->dokumen_id }}"
                                                    {{ old('dokumen_id', $lampiranDokumen->dokumen_id) == $dokumen->dokumen_id ? 'selected' : '' }}>
                                                    {{ $dokumen->judul }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dokumen_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                            rows="5" placeholder="Deskripsi singkat tentang file ini">{{ old('keterangan', $lampiranDokumen->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">File Saat Ini</label>
                                        <div class="p-3 border rounded bg-light d-flex align-items-center">
                                            <i
                                                class="{{ $lampiranDokumen->file_icon ?? 'fas fa-file' }} fa-2x me-3 text-primary"></i>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h6 class="mb-0 text-truncate"
                                                    title="{{ $lampiranDokumen->nama_file }}">
                                                    {{ $lampiranDokumen->nama_file }}
                                                </h6>
                                                <small class="text-muted">
                                                    {{ $lampiranDokumen->ukuran_file_formatted ?? 'Ukuran tidak tersedia' }}
                                                </small>
                                            </div>
                                            @if (Route::has('lampiran-dokumen.download'))
                                                <a href="{{ route('lampiran-dokumen.download', $lampiranDokumen->lampiran_id) }}"
                                                    class="btn btn-sm btn-outline-primary ms-2" title="Download">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="file" class="form-label">Ganti File (Opsional)</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                            id="file" name="file">
                                        <div class="form-text text-muted">
                                            Biarkan kosong jika tidak ingin mengganti file.
                                        </div>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div id="filePreview" class="alert alert-info d-none">
                                        <i class="fas fa-info-circle me-2"></i>File baru dipilih: <strong
                                            id="fileName"></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('lampiran-dokumen.index') }}"
                                        class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.guest.footer')
    {{-- start js --}}
    @include('layouts.guest.js')

    <script>
        // Script sederhana untuk menampilkan nama file yang baru dipilih
        document.getElementById('file').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const previewBox = document.getElementById('filePreview');
            const nameSpan = document.getElementById('fileName');

            if (fileName) {
                nameSpan.textContent = fileName;
                previewBox.classList.remove('d-none');
            } else {
                previewBox.classList.add('d-none');
            }
        });
    </script>
    {{-- end js --}}
</body>

</html>
