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

        /* CSS Tambahan untuk Halaman Daftar */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .registration-container {
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
            {{-- Mengubah href untuk kembali ke halaman utama --}}
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
                    {{-- Mengubah href untuk mengarahkan ke halaman daftar --}}
                    <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom" onclick="window.location.reload();">Daftar</a>
                    <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                    <a href="#" class="nav-link text-primary ms-3 d-none d-lg-block">Untuk Perusahaan</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten Form Pendaftaran --}}
    <div class="d-flex flex-column align-items-center pt-5">
        <h2 class="title-glints">Mari bergabung<br>dengan Talenthub</h2>
        <div class="registration-container bg-white rounded shadow-sm">
            {{-- Mengubah action form agar mengarah ke halaman minat pekerjaan --}}
            <form action="{{ url('/minat-pekerjaan') }}" method="GET">
                <div class="mb-3">
                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaLengkap" placeholder="Masukkan Nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                </div>
                <div class="mb-3">
                    <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="konfirmasiPassword" placeholder="Masukkan Ulang Passwordnya Disini" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger">Daftar</button>
                </div>
            </form>

            <hr class="my-4">

            <div class="info-box">
                Dengan mendaftar, saya setuju dengan <a href="#">Ketentuan Layanan</a>
            </div>

            <div class="footer-line mt-4">
                <span>Sudah punya akun ?</span>
                <a href="{{ url('/masuk') }}">Masuk</a>
            </div>

            <p class="company-link mt-3 mb-0">
                Untuk perusahaan, kunjungi <a href="#">laman berikut.</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>