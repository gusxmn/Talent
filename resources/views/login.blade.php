<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        /* CSS Navbar */
        .navbar {
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navbar-logo {
            height: 30px;
            width: auto;
            margin-right: 1.5rem;
        }

        .navbar .nav-link {
            color: #2c2c2c;
            margin-right: 1rem;
            font-weight: 400;
        }

        .navbar .nav-link:hover {
            color: #0d47a1;
        }

        .btn-outline-primary {
            border-radius: 4px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-outline-primary:hover {
            background-color: #0d47a1;
            color: #fff;
        }

        .btn-primary {
            border-radius: 4px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            color: #fff;
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-primary:hover {
            background-color: #0a3d8b;
            border-color: #0a3d8b;
        }

        .nav-link.text-primary {
            font-weight: 600;
            color: #0d47a1 !important;
        }

        /* Tambahan CSS untuk Tombol Daftar dan Masuk - Sama seperti home.blade.php */
        .btn-primary-custom {
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #fff;
            color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-outline-primary-custom {
            transition: all 0.3s ease;
        }

        .btn-outline-primary-custom:hover {
            background-color: #0d47a1;
            color: #fff;
            border-color: #0d47a1;
        }

        @media (max-width: 992px) {
            .navbar .nav-link.active {
                border-bottom: none;
            }
        }

        /* CSS Tambahan untuk Halaman Login */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            padding: 32px;
        }

        .title-glints {
            font-size: 30px;
            font-weight: 700;
            line-height: 1.2;
            color: #2c2c2c;
            text-align: center;
            margin-bottom: 24px;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-bottom: 10px;
        }

        .social-buttons img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .social-buttons .facebook-logo {
            width: 70px;
            height: 70px;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #8c8f95;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e1e4e8;
        }

        .divider:not(:empty)::before {
            margin-right: .75em;
        }

        .divider:not(:empty)::after {
            margin-left: .75em;
        }

        .email-link {
            color: #007AFF;
            font-weight: 600;
            text-decoration: underline;
            padding: 12px 0;
            display: block;
            text-align: center;
            margin-bottom: 24px;
        }

        .info-box {
            background-color: #f5f6f8;
            padding: 16px;
            border-radius: 4px;
            font-size: 16px;
            color: #6c757d;
            text-align: left;
        }

        .info-box a {
            color: #007AFF;
            font-weight: 500;
            text-decoration: underline;
        }

        .footer-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            font-size: 16px;
            color: #6c757d;
        }

        .footer-line a {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
        }

        .text-link {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
        }

        .company-link {
            font-size: 16px;
            color: #6c757d;
            text-align: center;
        }

        .company-link a {
            color: #007AFF;
            text-decoration: underline;
            font-weight: 500;
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid mx-lg-5">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="d-inline-block align-text-top me-2" style="height: 30px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Lowongan Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sumber Daya Karir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Explore Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Perusahaan</a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link text-primary" href="#">Untuk Perusahaan</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                    <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3" onclick="window.location.reload();">Masuk</a>
                    <a href="#" class="nav-link text-primary ms-3 d-none d-lg-block">Untuk Perusahaan</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten Form Login --}}
    <div class="d-flex flex-column align-items-center pt-5">
         <h2 class="title-glints">Selamat Datang Kembali!</h2>
        <p class="text-center">Masuk ke akun Talenthub kamu</p>
        <div class="login-container bg-white rounded shadow-sm">
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-danger">Masuk</button>
                </div>
            </form>

            <p class="text-center mb-3">
                <a href="#" class="text-link">Lupa Password?</a>
            </p>
            
            <p class="divider">atau</p>

            <div class="social-buttons">
                <a href="#">
                    <img src="{{ asset('images/logo google.png') }}" alt="Google">
                </a>
                <a href="#">
                    <img src="{{ asset('images/logo facebook.png') }}" alt="Facebook" class="facebook-logo">
                </a>
            </div>

            <hr class="my-4">

            <div class="footer-line">
                <span>Belum punya akun?</span>
                <a href="{{ url('/daftar') }}">Daftar</a>
            </div>

            <p class="company-link mt-3 mb-0">
                Untuk perusahaan, kunjungi <a href="#">laman berikut.</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>