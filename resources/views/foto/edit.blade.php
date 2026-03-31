<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; padding: 40px 0; }
        .card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); overflow: hidden; }
        .img-preview-container { background: #0f172a; padding: 20px; text-align: center; }
        .img-preview { border-radius: 12px; max-height: 250px; object-fit: contain; box-shadow: 0 8px 20px rgba(0,0,0,0.3); }
        .form-control, .form-select { border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc; padding: 12px 15px; }
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); background: white; }
        .btn-warning { background-color: #f59e0b; color: white; border: none; border-radius: 10px; font-weight: 600; }
        .btn-warning:hover { background-color: #d97706; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="img-preview-container">
                        <img src="{{ asset('storage/' . $foto->lokasi_file) }}" class="img-preview" alt="Preview">
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                            <i class="bi bi-pencil-square fs-3 text-warning me-3"></i>
                            <h4 class="fw-bold mb-0">Edit Informasi Foto</h4>
                        </div>
                        
                        <form action="{{ route('foto.update', $foto->foto_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="judul_foto" class="form-label small fw-semibold text-secondary">Judul Foto</label>
                                <input type="text" name="judul_foto" class="form-control" value="{{ $foto->judul_foto }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi_foto" class="form-label small fw-semibold text-secondary">Deskripsi</label>
                                <textarea name="deskripsi_foto" class="form-control" rows="4" required>{{ $foto->deskripsi_foto }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="album_id" class="form-label small fw-semibold text-secondary">Pindahkan ke Album</label>
                                <select name="album_id" class="form-select" required>
                                    @foreach($albums as $album)
                                        <option value="{{ $album->album_id }}" {{ $foto->album_id == $album->album_id ? 'selected' : '' }}>
                                            {{ $album->nama_album }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="{{ route('foto.index') }}" class="btn btn-light rounded-3 fw-medium px-4">Batal</a>
                                <button type="submit" class="btn btn-warning px-4 py-2">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>