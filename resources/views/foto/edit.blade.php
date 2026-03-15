<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto | SNAPGALLERY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); }
        .btn-primary { border-radius: 10px; padding: 10px 20px; }
        .img-preview { border-radius: 10px; max-height: 200px; object-fit: cover; }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h4 class="fw-bold text-primary mb-4">Edit Informasi Foto</h4>
                    
                    <form action="{{ route('foto.update', $foto->foto_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 text-center">
                            <label class="form-label d-block text-start text-muted small">Pratinjau Foto</label>
                            <img src="{{ asset('storage/' . $foto->lokasi_file) }}" class="img-preview mb-2" alt="Preview">
                        </div>

                        <div class="mb-3">
                            <label for="judul_foto" class="form-label small fw-bold">Judul Foto</label>
                            <input type="text" name="judul_foto" class="form-control" value="{{ $foto->judul_foto }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_foto" class="form-label small fw-bold">Deskripsi</label>
                            <textarea name="deskripsi_foto" class="form-control" rows="3" required>{{ $foto->deskripsi_foto }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="album_id" class="form-label small fw-bold">Pindahkan ke Album</label>
                            <select name="album_id" class="form-select" required>
                                @foreach($albums as $album)
                                    <option value="{{ $album->album_id }}" {{ $foto->album_id == $album->album_id ? 'selected' : '' }}>
                                        {{ $album->nama_album }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('foto.index') }}" class="text-secondary text-decoration-none">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>