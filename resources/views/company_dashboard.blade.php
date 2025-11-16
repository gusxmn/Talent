<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Perusahaan | Next Employer</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>

        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

    .title-section {
        text-align: center;
        padding: 2rem 0;
    }

    .status-alert {
        max-width: 600px;
        margin: 0 auto 2rem auto;
    }

    .welcome-card {
        max-width: 600px;
        margin: 0 auto;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .email-notification {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-left: 4px solid #0d47a1;
    }

    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar_company')

    <div class="title-section">
    <!-- Notifikasi Login Berhasil -->
    @if(session('login_success'))
        <div class="alert alert-success status-alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x me-3"></i>
                <div>
                    <h5 class="mb-1">{{ session('login_success') }}</h5>
                </div>
            </div>
        </div>
    @endif

    <!-- Notifikasi Registrasi Berhasil -->
    @if(session('registration_success'))
        <div class="alert alert-success status-alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x me-3"></i>
                <div>
                    <h5 class="mb-1">Akun Perusahaan Anda Telah Berhasil Dibuat</h5>
                    <p class="mb-0">{{ session('registration_success') }}</p>
                    <small class="mt-1 d-block text-muted">
                        <i class="fas fa-info-circle me-1"></i> 
                        Periksa folder spam jika email tidak ditemukan di inbox utama.
                    </small>
                </div>
            </div>
        </div>
    @endif

    <div class="card welcome-card">
        <div class="card-body text-center py-5">
            <i class="fas fa-building fa-3x text-primary mb-3"></i>
            <h3 class="card-title">Selamat Datang di Dashboard Perusahaan</h3>

            @auth('company')
            <div class="mt-4 p-3 bg-light rounded">
                <h6>Informasi Perusahaan Anda:</h6>
                <p class="mb-1"><strong>{{ auth()->guard('company')->user()->nama_perusahaan }}</strong></p>
                <p class="mb-1 text-muted">{{ auth()->guard('company')->user()->industri }}</p>
                <p class="mb-0 text-muted small">{{ auth()->guard('company')->user()->email }}</p>
            </div>
            @endauth
            
            <div class="mt-4">
                <a href="#" class="btn btn-primary me-2">
                    <i class="fas fa-briefcase me-1"></i>Kelola Lowongan
                </a>
                <a href="#" class="btn btn-outline-primary">
                    <i class="fas fa-building me-1"></i>Lihat Profil
                </a>
            </div>

            <!-- Informasi Email untuk Registrasi -->
            @if(session('registration_success'))
                <div class="mt-4 p-3 border rounded">
                    <h6><i class="fas fa-envelope-open-text me-2"></i>Periksa Email Anda</h6>
                    <p class="small text-muted mb-2">
                        Email konfirmasi telah dikirim ke: <strong>{{ auth()->guard('company')->user()->email }}</strong>
                    </p>
                    <p class="small text-muted mb-0">
                        Email berisi detail akun dan panduan penggunaan platform.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>