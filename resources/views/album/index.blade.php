<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Album | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .navbar { background-color: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.03); border-bottom: 1px solid #f1f5f9; }
        .navbar-brand { background: linear-gradient(45deg, #6366f1, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800; letter-spacing: -0.5px; }
        .card-album { border: 1px solid #e2e8f0; border-radius: 16px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #ffffff; }
        .card-album:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: #cbd5e1; }
        .album-icon { width: 50px; height: 50px; background: #e0e7ff; color: #6366f1; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .btn-primary { background-color: #6366f1; border: none; border-radius: 8px; font-weight: 500; }
        .btn-primary:hover { background-color: #4f46e5; }
        .btn-outline-primary { color: #6366f1; border-color: #e0e7ff; background: #e0e7ff; border-radius: 8px; font-weight: 500; }
        .btn-outline-primary:hover { background: #c7d2fe; color: #4f46e5; border-color: #c7d2fe; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/foto') }}">raszzGallery</a>
            <div class="d-flex gap-2">
                <a href="{{ url('/foto') }}" class="btn btn-outline-primary btn-sm px-3 py-2">Kembali ke Galeri</a>
                <a href="{{ url('/album/create') }}" class="btn btn-primary btn-sm px-3 py-2"><i class="bi bi-plus-lg me-1"></i> Buat Album</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold mb-1">Koleksi Album Saya</h3>
                <p class="text-muted mb-0">Kelola dan atur foto-foto Anda dengan rapi.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($albums as $album)
            <div class="col-md-6 col-lg-4">
                <div class="card card-album h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="album-icon">
                                <i class="bi bi-folder-fill"></i>
                            </div>
                            <form action="{{ route('album.destroy', $album->album_id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger opacity-75 hover-opacity-100" onclick="return confirm('Hapus album ini secara permanen?')" title="Hapus Album">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                        <h5 class="card-title fw-bold text-dark mb-2">{{ $album->nama_album }}</h5>
                        <p class="text-muted small mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $album->deskripsi }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                                <i class="bi bi-image me-1"></i> {{ $album->fotos_count }} Foto
                            </span>
                            <a href="#" class="btn btn-link text-decoration-none text-primary p-0 small fw-semibold">Buka Album <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4 border border-dashed border-2">
                    <div class="album-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2.5rem; background: #f8fafc; color: #cbd5e1;">
                        <i class="bi bi-folder-x"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Belum Ada Album</h5>
                    <p class="text-muted mb-4">Mulai kumpulkan momen berharga Anda dengan membuat album pertama.</p>
                    <a href="{{ url('/album/create') }}" class="btn btn-primary px-4 py-2"><i class="bi bi-plus-lg me-1"></i> Buat Album Sekarang</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>