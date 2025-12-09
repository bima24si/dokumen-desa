<!-- [file name]: edit.blade.php -->
<!doctype html>
<html lang="en">
<head>
    @include('layouts.guest.wa-float')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    {{-- start css --}}
    @include('layouts.guest.css')
    {{-- end css --}}
    <title>Edit Dokumen Hukum</title>
    <style>
        .file-info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .current-file {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }
        .file-badge {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .badge-utama {
            background-color: #0d6efd;
            color: white;
        }
        .badge-lampiran {
            background-color: #6c757d;
            color: white;
        }
        .attachment-container {
            border: 2px solid #f0f0f0;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            background-color: #f9f9f9;
        }
        .attachment-item {
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .existing-attachment {
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <!-- Start Header/Navigation -->
    @include('layouts.guest.navbar')
    <!-- End Header/Navigation -->

    <!-- Start Content Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dokumen-hukum.index') }}">Dokumen Hukum</a></li>
                        <li class="breadcrumb-item active">Edit Dokumen Hukum</li>
                    </ol>
                </nav>

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Edit Dokumen Hukum</h2>
                        <p>Form untuk mengubah dokumen hukum</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <!-- File Information -->
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi File
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nomor File:</strong> {{ $dataDokumenHukum->file_number }}</p>
                                <p><strong>Tipe File:</strong>
                                    <span class="badge file-badge badge-{{ $dataDokumenHukum->file_type }}">
                                        {{ ucfirst($dataDokumenHukum->file_type) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if($dataDokumenHukum->mainFile)
                                    <p><strong>File Saat Ini:</strong></p>
                                    <div class="current-file">
                                        <div>
                                            <i class="fas fa-file me-2"></i>
                                            {{ $dataDokumenHukum->mainFile->name }}
                                        </div>
                                        <a href="{{ route('dokumen-hukum.download', $dataDokumenHukum->file_number) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Existing Attachments -->
                        @if($dataDokumenHukum->file_type === 'utama' && $dataDokumenHukum->attachments->count() > 0)
                            <div class="mt-3">
                                <p><strong>Lampiran Saat Ini:</strong></p>
                                @foreach($dataDokumenHukum->attachments as $attachment)
                                    <div class="existing-attachment">
                                        <i class="fas fa-paperclip me-2"></i>
                                        {{ $attachment->name }}
                                        <a href="{{ route('dokumen-hukum.download', $dataDokumenHukum->file_number) }}?attachment_id={{ $attachment->id }}"
                                           class="btn btn-sm btn-outline-secondary float-end">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form -->
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <form action="{{ route('dokumen-hukum.update', $dataDokumenHukum->dokumen_id) }}" method="POST" enctype="multipart/form-data" id="dokumenForm">
                            @method('PUT')
                            @csrf

                            <!-- File Type & File Number -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="file_type" class="form-label">Tipe Dokumen</label>
                                        <select class="form-control @error('file_type') is-invalid @enderror"
                                                id="file_type" name="file_type" required onchange="toggleAttachments()">
                                            <option value="">Pilih Tipe Dokumen</option>
                                            <option value="utama" {{ old('file_type', $dataDokumenHukum->file_type) == 'utama' ? 'selected' : '' }}>File Utama</option>
                                            <option value="lampiran" {{ old('file_type', $dataDokumenHukum->file_type) == 'lampiran' ? 'selected' : '' }}>Lampiran</option>
                                        </select>
                                        @error('file_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="file_number" class="form-label">Nomor File</label>
                                        <input type="text" class="form-control @error('file_number') is-invalid @enderror"
                                               id="file_number" name="file_number" value="{{ old('file_number', $dataDokumenHukum->file_number) }}"
                                               placeholder="Masukkan nomor file" required>
                                        @error('file_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="jenis_id" class="form-label">Jenis Dokumen</label>
                                        <select class="form-control @error('jenis_id') is-invalid @enderror"
                                                id="jenis_id" name="jenis_id" required>
                                            <option value="">Pilih Jenis Dokumen</option>
                                            @foreach($dataJenisDokumen as $jenis)
                                                <option value="{{ $jenis->id }}" {{ old('jenis_id', $dataDokumenHukum->jenis_id) == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror"
                                                id="kategori_id" name="kategori_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($dataKategoriDokumen as $kategori)
                                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id', $dataDokumenHukum->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="nomor" class="form-label">Nomor Dokumen</label>
                                        <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                               id="nomor" name="nomor" value="{{ old('nomor', $dataDokumenHukum->nomor) }}"
                                               placeholder="Masukkan nomor dokumen" required>
                                        @error('nomor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                               id="judul" name="judul" value="{{ old('judul', $dataDokumenHukum->judul) }}"
                                               placeholder="Masukkan judul dokumen" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                               id="tanggal" name="tanggal" value="{{ old('tanggal', $dataDokumenHukum->tanggal) }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                            <option value="aktif" {{ old('status', $dataDokumenHukum->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="tidak_aktif" {{ old('status', $dataDokumenHukum->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="ringkasan" class="form-label">Ringkasan</label>
                                        <textarea class="form-control @error('ringkasan') is-invalid @enderror"
                                                  id="ringkasan" name="ringkasan" rows="4"
                                                  placeholder="Masukkan ringkasan dokumen">{{ old('ringkasan', $dataDokumenHukum->ringkasan) }}</textarea>
                                        @error('ringkasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Main File Upload -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="file" class="form-label">Ganti File Dokumen</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                        <small class="form-text text-muted">
                                            Kosongkan jika tidak ingin mengganti file.
                                            Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX (Maks: 5MB)
                                        </small>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Attachments (Only for Main File) -->
                            <div class="row" id="attachmentsSection" style="display: {{ $dataDokumenHukum->file_type === 'utama' ? 'block' : 'none' }};">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label">Tambah Lampiran Baru (Opsional)</label>
                                        <div class="attachment-container">
                                            <div id="attachmentList">
                                                <!-- New attachments will be added here dynamically -->
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm btn-add-attachment" onclick="addAttachment()">
                                                <i class="fas fa-plus me-1"></i>Tambah Lampiran
                                            </button>
                                            <small class="form-text text-muted d-block mt-2">
                                                Format: PDF, DOC, DOCX, JPG, JPEG, PNG (Maks: 2MB per file)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
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
    <!-- End Content Section -->

    <!-- Start Footer Section -->
    @include('layouts.guest.footer')
    <!-- End Footer Section -->

    {{-- start js --}}
    @include('layouts.guest.js')
    {{-- end js --}}

    <script>
        let attachmentCounter = 0;

        function toggleAttachments() {
            const fileType = document.getElementById('file_type').value;
            const attachmentsSection = document.getElementById('attachmentsSection');

            if (fileType === 'utama') {
                attachmentsSection.style.display = 'block';
            } else {
                attachmentsSection.style.display = 'none';
                // Clear attachments if switching to lampiran
                document.getElementById('attachmentList').innerHTML = '';
                attachmentCounter = 0;
            }
        }

        function addAttachment() {
            attachmentCounter++;
            const attachmentList = document.getElementById('attachmentList');
            const attachmentItem = document.createElement('div');
            attachmentItem.className = 'attachment-item';
            attachmentItem.id = `attachment-${attachmentCounter}`;

            attachmentItem.innerHTML = `
                <div>
                    <i class="fas fa-paperclip me-2"></i>
                    Lampiran Baru ${attachmentCounter}
                </div>
                <div>
                    <input type="file" name="attachments[]" class="form-control form-control-sm d-inline-block w-auto me-2"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAttachment(${attachmentCounter})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            attachmentList.appendChild(attachmentItem);
        }

        function removeAttachment(id) {
            const attachmentElement = document.getElementById(`attachment-${id}`);
            if (attachmentElement) {
                attachmentElement.remove();
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Add some styling for badges
            const style = document.createElement('style');
            style.textContent = `
                .badge-utama { background-color: #0d6efd !important; }
                .badge-lampiran { background-color: #6c757d !important; }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
