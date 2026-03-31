<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Beranda | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .navbar { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .navbar-brand { font-weight: 800; background: linear-gradient(135deg, #2563eb, #db2777); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; background: white; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 20px 30px rgba(0,0,0,0.08); }
        .img-wrapper { position: relative; overflow: hidden; aspect-ratio: 4/3; }
        .card-img-top { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .card:hover .card-img-top { transform: scale(1.05); }
        .role-badge { position: absolute; top: 12px; left: 12px; z-index: 2; font-size: 0.7rem; padding: 5px 10px; border-radius: 20px; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); }
        .action-btns .btn { border-radius: 20px; padding: 4px 12px; font-weight: 600; font-size: 0.85rem; }
        .user-avatar { width: 24px; height: 24px; border-radius: 50%; background: #e2e8f0; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; color: #64748b; margin-right: 6px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top py-3 mb-4">
        <div class="container">
            <a class="navbar-brand fs-4" href="{{ url('/foto') }}">raszzGallery</a>
            <div class="d-flex align-items-center ms-auto gap-2 gap-md-3">
                <a href="{{ url('/foto/create') }}" class="btn btn-primary rounded-pill fw-medium px-3"><i class="bi bi-cloud-upload me-1"></i> <span class="d-none d-md-inline">Unggah</span></a>
                
                @if(Auth::user()->role == 'admin')
                    <a href="{{ url('/album') }}" class="btn btn-light rounded-pill border fw-medium px-3"><i class="bi bi-folder me-1"></i> <span class="d-none d-md-inline">Album</span></a>
                @endif

                <div class="dropdown">
                    <button class="btn btn-light rounded-pill border fw-medium dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <div class="user-avatar text-uppercase fw-bold text-dark">{{ substr(Auth::user()->username, 0, 1) }}</div>
                        <span class="d-none d-md-inline">{{ Auth::user()->username }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2">
                        <li><h6 class="dropdown-header">Login sebagai {{ ucfirst(Auth::user()->role) }}</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-medium"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success bg-success bg-opacity-10 border-0 text-success rounded-3 mb-4 d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i> {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($fotos as $foto)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card h-100">
                        <div class="img-wrapper">
                            @if($foto->user->role == 'admin')
                                <span class="badge text-white role-badge"><i class="bi bi-star-fill text-warning me-1"></i> Admin Post</span>
                            @endif
                            <a href="{{ route('foto.show', $foto->foto_id) }}">
                                <img src="{{ asset('storage/' . $foto->lokasi_file) }}" class="card-img-top" alt="{{ $foto->judul_foto }}">
                            </a>
                        </div>
                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $foto->judul_foto }}">{{ $foto->judul_foto }}</h6>
                            <p class="text-muted small mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $foto->deskripsi_foto }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="text-secondary small fw-medium d-flex align-items-center text-truncate pe-2">
                                    <div class="user-avatar text-uppercase bg-light border">{{ substr($foto->user->nama_lengkap, 0, 1) }}</div>
                                    <span class="text-truncate">{{ explode(' ', $foto->user->nama_lengkap)[0] }}</span>
                                </div>
                                <div class="action-btns d-flex gap-1">
                                    <form action="{{ route('foto.like', $foto->foto_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm bg-danger bg-opacity-10 text-danger border-0">
                                            <i class="bi bi-heart{{ $foto->likes->where('user_id', Auth::id())->count() ? '-fill' : '' }}"></i> 
                                            {{ $foto->likes->count() }}
                                        </button>
                                    </form>
                                    <a href="{{ route('foto.show', $foto->foto_id) }}" class="btn btn-sm bg-primary bg-opacity-10 text-primary border-0">
                                        <i class="bi bi-chat-text"></i> {{ $foto->komentars->count() }}
                                    </a>
                                </div>
                            </div>

                            @if(Auth::user()->role == 'admin' || $foto->user_id == Auth::id())
                                <div class="pt-2 border-top d-flex gap-2 mt-auto">
                                    <a href="{{ route('foto.edit', $foto->foto_id) }}" class="btn btn-sm btn-light border flex-grow-1 text-secondary fw-medium rounded-3">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('foto.destroy', $foto->foto_id) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border border-danger text-danger w-100 fw-medium rounded-3 bg-danger bg-opacity-10 hover-bg-danger" onclick="return confirm('Hapus foto ini secara permanen?')">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 my-5">
                    <div class="mb-4 text-muted opacity-50">
                        <i class="bi bi-camera" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="fw-bold text-dark">Belum ada foto</h4>
                    <p class="text-muted">Jadilah yang pertama mengunggah momen indahmu di sini.</p>
                    <a href="{{ url('/foto/create') }}" class="btn btn-primary rounded-pill px-4 py-2 mt-2"><i class="bi bi-cloud-upload me-2"></i>Unggah Foto Sekarang</a>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>