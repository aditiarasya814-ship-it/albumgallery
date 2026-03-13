<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Foto Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .form-container { max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h4 class="fw-bold mb-4">Unggah Foto</h4>
            <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Foto</label>
                    <input type="text" name="judul_foto" class="form-control" required placeholder="Contoh: Pemandangan Sore">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi_foto" class="form-control" rows="3" required placeholder="Ceritakan tentang foto ini..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Album</label>
                    <select name="album_id" class="form-select" required>
                        <option value="" selected disabled>Pilih Album...</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->album_id }}">{{ $album->nama_album }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">File Foto</label>
                    <input type="file" name="lokasi_file" class="form-control" required>
                    <div class="form-text text-danger">*Format: JPG, PNG, JPEG (Maks 2MB)</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Foto</button>
                    <a href="{{ url('/foto') }}" class="btn btn-light px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>