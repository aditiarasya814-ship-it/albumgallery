<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Album | Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .container { margin-top: 30px; }
        .card-album { border: none; border-radius: 12px; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card-album:hover { transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid mx-5">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/foto') }}">SNAPGALLERY</a>
            <div class="d-flex">
                <a href="{{ url('/foto') }}" class="btn btn-outline-primary btn-sm me-2">Kembali ke Galeri</a>
                <a href="{{ url('/album/create') }}" class="btn btn-primary btn-sm">Buat Album Baru</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Koleksi Album Saya</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($albums as $album)
            <div class="col-md-4 mb-4">
                <div class="card card-album h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-bold">{{ $album->nama_album }}</h5>
                            <i class="bi bi-folder2-open text-primary fs-4"></i>
                        </div>
                        <p class="text-muted small">{{ $album->deskripsi }}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-dark">{{ $album->fotos_count }} Foto</span>
                            <form action="{{ route('album.destroy', $album->album_id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Hapus album ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Kamu belum memiliki album.</p>
                <a href="{{ url('/album/create') }}" class="btn btn-primary">Mulai Buat Album</a>
            </div>
            @endforelse
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>