<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Foto | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; padding: 40px 0; }
        .form-container { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.03); }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #e2e8f0; padding: 12px 15px; background: #f8fafc; }
        .form-control:focus, .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); background: white; }
        .upload-area { border: 2px dashed #cbd5e1; border-radius: 15px; padding: 30px; text-align: center; background: #f8fafc; transition: 0.3s; position: relative; }
        .upload-area:hover { border-color: #3b82f6; background: #eff6ff; }
        .upload-area input[type="file"] { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .btn-primary { background-color: #3b82f6; border: none; border-radius: 10px; font-weight: 600; }
        .btn-primary:hover { background-color: #2563eb; transform: translateY(-1px); }
        .btn-light { border-radius: 10px; font-weight: 600; background-color: #f1f5f9; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="form-container">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                            <i class="bi bi-cloud-arrow-up-fill fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Unggah Foto Baru</h4>
                            <p class="text-muted small mb-0">Tambahkan momen terbaik ke galerimu</p>
                        </div>
                    </div>

                    <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-secondary">File Foto</label>
                            <div class="upload-area">
                                <i class="bi bi-images text-muted" style="font-size: 2.5rem;"></i>
                                <p class="mt-2 mb-1 fw-medium">Klik atau Seret file ke sini</p>
                                <p class="text-muted small mb-0">Format: JPG, PNG, JPEG (Maks 2MB)</p>
                                <input type="file" name="lokasi_file" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Judul Foto</label>
                            <input type="text" name="judul_foto" class="form-control" required placeholder="Contoh: Senja di Pantai Kuta">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Deskripsi</label>
                            <textarea name="deskripsi_foto" class="form-control" rows="3" required placeholder="Ceritakan kisah di balik foto ini..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-secondary">Simpan di Album</label>
                            <select name="album_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Album --</option>
                                @foreach($albums as $album)
                                    <option value="{{ $album->album_id }}">{{ $album->nama_album }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-3 pt-2">
                            <button type="submit" class="btn btn-primary py-2.5 px-4 flex-grow-1">Simpan Foto</button>
                            <a href="{{ url('/foto') }}" class="btn btn-light py-2.5 px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>