<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | raszzGallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; display: flex; align-items: center; min-height: 100vh; }
        .login-card { border: none; border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); overflow: hidden; }
        .login-left { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); color: white; padding: 40px; display: flex; flex-direction: column; justify-content: center; text-align: center; }
        .login-right { padding: 50px 40px; background: white; }
        .form-control { border-radius: 12px; padding: 12px 16px; border: 1px solid #e2e8f0; background: #f8fafc; }
        .form-control:focus { border-color: #6366f1; background: white; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
        .btn-primary { background-color: #1e293b; border: none; border-radius: 12px; font-weight: 600; padding: 12px; transition: all 0.3s; }
        .btn-primary:hover { background-color: #0f172a; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card login-card row flex-row">
                    <div class="col-md-5 login-left d-none d-md-flex">
                        <h2 class="fw-bold mb-3">raszzGallery</h2>
                        <p class="opacity-75">Simpan, bagikan, dan kenang setiap momen berharga Anda dalam kualitas terbaik.</p>
                    </div>
                    <div class="col-md-7 login-right">
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark">Selamat Datang 👋</h3>
                            <p class="text-muted">Silakan masuk ke akun Anda untuk melanjutkan</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-3 small">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-3 small">{{ session('error') }}</div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label small fw-semibold text-secondary">Password</label>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Masuk ke Akun</button>
                        </form>
                        
                        <div class="text-center mt-4 pt-3 border-top">
                            <span class="text-muted small">Belum punya akun? <a href="{{ url('/register') }}" class="text-primary text-decoration-none fw-bold">Daftar sekarang</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>