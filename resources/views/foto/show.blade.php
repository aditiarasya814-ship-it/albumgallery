<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $foto->judul_foto }} | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .back-btn { background: white; border: 1px solid #e2e8f0; border-radius: 12px; font-weight: 600; color: #64748b; transition: 0.2s; }
        .back-btn:hover { background: #f1f5f9; color: #0f172a; }
        .photo-container { background: #000; border-radius: 20px; overflow: hidden; display: flex; align-items: center; justify-content: center; min-height: 400px; }
        .img-detail { width: 100%; max-height: 70vh; object-fit: contain; }
        .detail-card { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); height: 100%; display: flex; flex-direction: column; }
        .comment-box { flex-grow: 1; overflow-y: auto; padding-right: 10px; margin-bottom: 15px; max-height: 400px; scrollbar-width: thin; }
        .comment-item { background: #f8fafc; border-radius: 12px; padding: 12px 15px; margin-bottom: 12px; border: 1px solid #f1f5f9; }
        .comment-input-group .form-control { border-radius: 20px 0 0 20px; background: #f8fafc; border-color: #e2e8f0; padding-left: 20px; }
        .comment-input-group .btn { border-radius: 0 20px 20px 0; padding-left: 20px; padding-right: 20px; font-weight: 600; }
        .uploader-avatar { width: 45px; height: 45px; background: linear-gradient(135deg, #6366f1, #a855f7); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="mb-4">
            <a href="{{ url('/foto') }}" class="btn back-btn px-4 py-2"><i class="bi bi-arrow-left me-2"></i> Kembali ke Galeri</a>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-7 col-xl-8">
                <div class="photo-container shadow-sm mb-4">
                    <img src="{{ asset('storage/'.$foto->lokasi_file) }}" class="img-detail" alt="{{ $foto->judul_foto }}">
                </div>
                
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h2 class="fw-bold text-dark mb-2">{{ $foto->judul_foto }}</h2>
                    <p class="text-secondary fs-6 mb-4">{{ $foto->deskripsi_foto }}</p>
                    
                    <hr class="text-muted opacity-25">
                    
                    <div class="d-flex align-items-center mt-3">
                        <div class="uploader-avatar me-3 text-uppercase">
                            {{ substr($foto->user->nama_lengkap, 0, 1) }}
                        </div>
                        <div>
                            <p class="mb-0 text-muted small">Diunggah oleh</p>
                            <h6 class="mb-0 fw-bold">{{ $foto->user->nama_lengkap }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-xl-4">
                <div class="detail-card p-4">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <i class="bi bi-chat-square-dots-fill fs-4 text-primary me-2"></i>
                        <h5 class="fw-bold mb-0">Komentar ({{ $foto->komentars->count() }})</h5>
                    </div>
                    
                    <div class="comment-box">
                        @forelse($foto->komentars as $komentar)
                            <div class="comment-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong class="text-dark fs-6">{{ $komentar->user->username }}</strong>
                                    <span class="text-muted" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($komentar->tanggal_komentar)->diffForHumans() ?? $komentar->tanggal_komentar }}</span>
                                </div>
                                <p class="mb-0 text-secondary" style="font-size: 0.9rem;">{{ $komentar->isi_komentar }}</p>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-chat-slash text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                                <p class="text-muted mt-3 fw-medium">Jadilah yang pertama berkomentar!</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-auto pt-3 border-top">
                        <form action="{{ route('foto.komentar', $foto->foto_id) }}" method="POST">
                            @csrf
                            <div class="input-group comment-input-group">
                                <input type="text" name="isi_komentar" class="form-control" placeholder="Tulis pendapatmu..." required autocomplete="off">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-send-fill"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>