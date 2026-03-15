<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .navbar { background-color: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); }
        .card-img-top { height: 250px; object-fit: cover; border-radius: 8px 8px 0 0; }
        .card { border: none; border-radius: 12px; transition: transform 0.2s; position: relative; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); }
        /* Badge Role */
        .role-badge { position: absolute; top: 10px; left: 10px; z-index: 10; font-size: 0.7rem; padding: 4px 8px; border-radius: 20px; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/foto') }}">SNAPGALLERY</a>
            <div class="d-flex align-items-center">
                <a href="{{ url('/foto/create') }}" class="btn btn-primary btn-sm me-3"><i class="bi bi-plus-lg"></i> Unggah Foto</a>
                
                @if(Auth::user()->role == 'admin')
                    <a href="{{ url('/album') }}" class="btn btn-outline-secondary btn-sm me-3">Kelola Album</a>
                @endif

                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->username }} ({{ ucfirst(Auth::user()->role) }})
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($fotos as $foto)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($foto->user->role == 'admin')
                            <span class="badge bg-primary role-badge text-white">Admin Post</span>
                        @endif

                        <a href="{{ route('foto.show', $foto->foto_id) }}">
                            <img src="{{ asset('storage/' . $foto->lokasi_file) }}" class="card-img-top" alt="{{ $foto->judul_foto }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $foto->judul_foto }}</h5>
                            <p class="card-text text-muted small mb-3">
                                {{ \Illuminate\Support\Str::limit($foto->deskripsi_foto, 80) }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="small text-secondary fw-semibold">
                                    <i class="bi bi-person-circle"></i> {{ $foto->user->nama_lengkap }}
                                </span>
                                <div>
                                    <form action="{{ route('foto.like', $foto->foto_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                            <i class="bi bi-heart{{ $foto->likes->where('user_id', Auth::id())->count() ? '-fill' : '' }}"></i> 
                                            {{ $foto->likes->count() }}
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('foto.show', $foto->foto_id) }}" class="btn btn-sm btn-outline-primary border-0">
                                        <i class="bi bi-chat"></i> {{ $foto->komentars->count() }}
                                    </a>
                                </div>
                            </div>

                            @if(Auth::user()->role == 'admin' || $foto->user_id == Auth::id())
                                <div class="pt-2 border-top d-flex gap-2">
                                    <a href="{{ route('foto.edit', $foto->foto_id) }}" class="btn btn-sm btn-warning text-white flex-grow-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('foto.destroy', $foto->foto_id) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus foto ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Belum ada foto yang diunggah.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>