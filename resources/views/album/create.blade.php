<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Album Baru | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%); 
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .form-card { 
            background: rgba(255, 255, 255, 0.95); 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            border: 1px solid rgba(255,255,255,0.5);
            backdrop-filter: blur(10px);
        }
        .form-control { border-radius: 10px; padding: 12px 15px; border: 1px solid #e2e8f0; }
        .form-control:focus { border-color: #6366f1; box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25); }
        .btn-primary { background-color: #6366f1; border: none; border-radius: 10px; font-weight: 600; transition: all 0.3s; }
        .btn-primary:hover { background-color: #4f46e5; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(99,102,241,0.3); }
        .btn-light { border-radius: 10px; font-weight: 600; background-color: #f8fafc; border: 1px solid #e2e8f0; }
        .btn-light:hover { background-color: #e2e8f0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="form-card">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="color: #1e293b;">Buat Album Baru</h4>
                        <p class="text-muted small">Kelola koleksi foto Anda dalam satu tempat</p>
                    </div>
                    <form action="{{ route('album.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small">Nama Album</label>
                            <input type="text" name="nama_album" class="form-control" placeholder="Contoh: Liburan 2024" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary small">Deskripsi Album</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan cerita singkat tentang album ini..." required></textarea>
                        </div>
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary py-2.5">Simpan Album</button>
                            <a href="{{ url('/album') }}" class="btn btn-light py-2.5">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>