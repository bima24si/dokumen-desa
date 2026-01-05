<!doctype html>
<html lang="en">
<head>
    @include('layouts.guest.wa-float')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Lampiran Dokumen</title>
    @include('layouts.guest.css')
</head>

<body>
    @include('layouts.guest.navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('lampiran-dokumen.index') }}">Lampiran Dokumen</a></li>
                        <li class="breadcrumb-item active">Tambah Lampiran</li>
                    </ol>
                </nav>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Tambah Lampiran Dokumen</h2>
                        <p>Form untuk mengupload file lampiran baru</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <form action="{{ route('lampiran-dokumen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="dokumen_id" class="form-label">Dokumen Induk <span class="text-danger">*</span></label>
                                        <select class="form-select @error('dokumen_id') is-invalid @enderror"
                                                id="dokumen_id" name="dokumen_id" required>
                                            <option value="">-- Pilih Dokumen --</option>
                                            @foreach($dokumenList as $dokumen)
                                                {{-- PERBAIKAN PENTING: Gunakan $dokumen->id, BUKAN $dokumen->dokumen_id --}}
                                                <option value="{{ $dokumen->id }}" {{ old('dokumen_id') == $dokumen->id ? 'selected' : '' }}>
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
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                                  id="keterangan" name="keterangan" rows="4"
                                                  placeholder="Masukkan deskripsi file...">{{ old('keterangan') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="file" class="form-label">File Lampiran <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="file" name="file" required>
                                        <div class="form-text text-muted small mt-1">
                                            Maksimal 10MB. Format: PDF, DOCX, JPG, PNG.
                                        </div>
                                    </div>

                                    <div class="mb-4" id="filePreview" style="display: none;">
                                        <label class="form-label">Preview File</label>
                                        <div class="p-3 border rounded bg-light text-center">
                                            <i class="fas fa-file fa-3x text-primary mb-2" id="fileIcon"></i>
                                            <p class="mb-0 fw-bold" id="fileName">Filename.ext</p>
                                            <small class="text-muted" id="fileSize">0 KB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Data
                                    </button>
                                    <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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
    @include('layouts.guest.js')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file');
        const filePreview = document.getElementById('filePreview');
        const fileIcon = document.getElementById('fileIcon');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');

        const icons = {
            'pdf': 'fa-file-pdf text-danger',
            'doc': 'fa-file-word text-primary', 'docx': 'fa-file-word text-primary',
            'xls': 'fa-file-excel text-success', 'xlsx': 'fa-file-excel text-success',
            'jpg': 'fa-file-image text-info', 'png': 'fa-file-image text-info'
        };

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const ext = file.name.split('.').pop().toLowerCase();

                fileIcon.className = `fas ${icons[ext] || 'fa-file text-secondary'} fa-3x mb-2`;
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
                filePreview.style.display = 'block';
            } else {
                filePreview.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>
