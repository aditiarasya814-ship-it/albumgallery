<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; padding: 40px 0; }
        .register-card { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); background: #ffffff; padding: 40px; }
        .form-control { border-radius: 10px; padding: 12px 16px; border: 1px solid #e2e8f0; background: #f8fafc; }
        .form-control:focus { border-color: #10b981; background: white; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
        .btn-success { background-color: #10b981; border: none; border-radius: 10px; font-weight: 600; padding: 12px; transition: all 0.3s; }
        .btn-success:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(16,185,129,0.2); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="register-card">
                    <div class="text-center mb-4 pb-2 border-bottom">
                        <h3 class="fw-bold" style="color: #1e293b;">Buat Akun Baru</h3>
                        <p class="text-muted">Bergabunglah dan mulai bagikan karyamu</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 border-0 bg-danger bg-opacity-10 text-danger py-3">
                            <ul class="mb-0 small fw-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-secondary">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Pilih username" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-secondary">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" placeholder="Sesuai KTP/Identitas" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 5 karakter" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-secondary">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat domisili..." required>{{ old('alamat') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-2">Daftar Sekarang</button>
                    </form>

                    <div class="text-center mt-4 pt-3">
                        <span class="small text-muted">Sudah punya akun? <a href="{{ url('/login') }}" class="text-success text-decoration-none fw-bold">Login di sini</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>