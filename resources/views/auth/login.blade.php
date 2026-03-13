<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #4e73df; border: none; }
        .btn-primary:hover { background-color: #2e59d9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Selamat Datang</h3>
                        <p class="text-muted">Silakan masuk ke akun Anda</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success small">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger small">{{ session('error') }}</div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <span class="small text-muted">Belum punya akun? <a href="{{ url('/register') }}" class="text-decoration-none">Daftar sekarang</a></span>
                    </div>
                </div>
                <p class="text-center mt-4 text-muted small">&copy; 2026 Website Galeri Foto</p>
            </div>
        </div>
    </div>
</body>
</html>