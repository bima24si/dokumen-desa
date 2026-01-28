<!-- [file name]: create.blade.php -->
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
    <title>Tambah Dokumen Hukum</title>
    <style>
        .file-preview {
            background-color: #f8f9fa;
            border: 1px dashed #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        .file-number-display {
            font-size: 1.2rem;
            font-weight: bold;
            color: #0d6efd;
            background-color: #e7f1ff;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .attachment-container {
            border: 2px solid #f0f0f0;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            background-color: #f9f9f9;
        }
        .btn-add-attachment {
            margin-top: 10px;
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
        .remove-attachment {
            color: #dc3545;
            cursor: pointer;
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
                        <li class="breadcrumb-item active">Tambah Dokumen Hukum</li>
                    </ol>
                </nav>

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="section-title">Tambah Dokumen Hukum</h2>
                        <p>Form untuk menambahkan dokumen hukum baru dengan nomor unik file</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <form action="{{ route('dokumen-hukum.store') }}" method="POST" enctype="multipart/form-data" id="dokumenForm">
                            @csrf

                            <!-- Nomor File Unik Preview -->
                            <div class="file-preview mb-4">
                                <div class="file-number-display" id="fileNumberDisplay">
                                    {{ $fileNumber ?? DokumenHukum::generateFileNumber('utama') }}
                                </div>
                                <small class="text-muted">Nomor unik file akan digunakan untuk identifikasi dokumen</small>
                            </div>

                            <!-- File Type & File Number -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="file_type" class="form-label">Tipe Dokumen</label>
                                        <select class="form-control @error('file_type') is-invalid @enderror"
                                                id="file_type" name="file_type" required onchange="updateFileNumber()">
                                            <option value="">Pilih Tipe Dokumen</option>
                                            <option value="utama" {{ old('file_type') == 'utama' ? 'selected' : 'selected' }}>File Utama</option>
                                            <option value="lampiran" {{ old('file_type') == 'lampiran' ? 'selected' : '' }}>Lampiran</option>
                                        </select>
                                        <small class="form-text text-muted">Pilih apakah dokumen utama atau lampiran</small>
                                        @error('file_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="file_number" class="form-label">Nomor File (Opsional)</label>
                                        <input type="text" class="form-control @error('file_number') is-invalid @enderror"
                                               id="file_number" name="file_number" value="{{ old('file_number') }}"
                                               placeholder="Biarkan kosong untuk generate otomatis">
                                        <small class="form-text text-muted">Kosongkan untuk generate otomatis</small>
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
                                                <option value="{{ $jenis->id }}" {{ old('jenis_id') == $jenis->id ? 'selected' : '' }}>
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
                                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
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
                                               id="nomor" name="nomor" value="{{ old('nomor') }}"
                                               placeholder="Masukkan nomor dokumen" required>
                                        <small class="form-text text-muted">Contoh: SK/001/2024</small>
                                        @error('nomor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                               id="judul" name="judul" value="{{ old('judul') }}"
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
                                               id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
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
                                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : 'selected' }}>Aktif</option>
                                            <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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
                                                  placeholder="Masukkan ringkasan dokumen">{{ old('ringkasan') }}</textarea>
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
                                        <label for="file" class="form-label">File Dokumen Utama</label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                               id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                                        <small class="form-text text-muted">
                                            Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX (Maks: 5MB)
                                        </small>
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i> Simpan Data
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

        function updateFileNumber() {
            const fileType = document.getElementById('file_type').value;
            if (fileType) {
                fetch(`/api/generate-file-number/${fileType}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('fileNumberDisplay').textContent = data.file_number;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Show/hide attachments section based on file type
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
                    Lampiran ${attachmentCounter}
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
            updateFileNumber();
        });
    </script>
</body>
</html>
