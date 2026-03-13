<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Album Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .form-card { max-width: 500px; margin: 80px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h4 class="fw-bold mb-4 text-center">Buat Album Baru</h4>
            <form action="{{ route('album.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Album</label>
                    <input type="text" name="nama_album" class="form-control" placeholder="Contoh: Liburan 2024" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi Album</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan cerita singkat tentang album ini..." required></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2">Simpan Album</button>
                    <a href="{{ url('/album') }}" class="btn btn-light py-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>