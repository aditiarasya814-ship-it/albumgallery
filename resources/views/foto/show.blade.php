<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto | Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .img-detail { width: 100%; max-height: 500px; object-fit: contain; background: #000; border-radius: 12px; }
        .comment-box { height: 300px; overflow-y: auto; border: 1px solid #eee; padding: 15px; border-radius: 8px; background: #fff; }
    </style>
</head>
<body>
    <div class="container my-5">
        <a href="{{ url('/foto') }}" class="btn btn-light mb-4"><i class="bi bi-arrow-left"></i> Kembali</a>
        
        <div class="row">
            <div class="col-md-7">
                <img src="{{ asset('storage/'.$foto->lokasi_file) }}" class="img-detail" alt="{{ $foto->judul_foto }}">
                <div class="mt-3">
                    <h3 class="fw-bold">{{ $foto->judul_foto }}</h3>
                    <p class="text-muted">{{ $foto->deskripsi_foto }}</p>
                    <hr>
                    <p class="small text-secondary">Diunggah oleh: <strong>{{ $foto->user->nama_lengkap }}</strong></p>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Komentar ({{ $foto->komentars->count() }})</h5>
                        
                        <div class="comment-box mb-3">
                            @forelse($foto->komentars as $komentar)
                                <div class="mb-3 border-bottom pb-2">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-primary small">{{ $komentar->user->username }}</strong>
                                        <span class="text-muted" style="font-size: 0.7rem;">{{ $komentar->tanggal_komentar }}</span>
                                    </div>
                                    <p class="mb-0 small">{{ $komentar->isi_komentar }}</p>
                                </div>
                            @empty
                                <p class="text-center text-muted mt-5 small">Belum ada komentar.</p>
                            @endforelse
                        </div>

                        <form action="{{ route('foto.komentar', $foto->foto_id) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="isi_komentar" class="form-control form-control-sm" placeholder="Tulis komentar..." required>
                                <button class="btn btn-primary btn-sm" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>