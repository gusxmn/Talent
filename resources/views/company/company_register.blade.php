<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftarkan Perusahaan anda | Next Employer </title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    <style>
        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar {
            font-size: 1rem; /* disamakan */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem; /* lebih mendekati ukuran bootstrap default */
        }
        .navbar-logo {
            height: 38px; /* disamakan */
            width: auto;
        }
        .btn-login {
            border-radius: 6px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: #0d47a1 !important;
            background-color: #fff;
            border: 2px solid #0d47a1;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #0d47a1;
            color: #fff !important;
            border: 2px solid #0d47a1;
        }

        /* === PROGRESS STEP === */
        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            text-align: center;
        }

        .progress-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            right: -50%;
            width: 100%;
            height: 4px;
            background-color: #d3d3d3;
            z-index: 0;
            transition: background-color 0.3s ease;
        }

        .progress-step.active:not(:last-child)::after {
            background-color: #0d47a1;
        }

        .progress-step.active:nth-child(1)::after {
            background-color: #d3d3d3;
        }

        .progress-step.active:nth-child(2)::after {
            background-color: #d3d3d3;
        }

        .circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #d3d3d3;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            z-index: 1;
            position: relative;
        }

        .progress-step.active .circle {
            background-color: #0d47a1;
        }

        .progress-label {
            margin-top: 8px;
            font-size: 0.9rem;
            color: #999;
        }

        .progress-step.active .progress-label {
            color: #0d47a1;
            font-weight: 600;
        }

        /* === KHUSUS UNTUK LANGKAH KEDUA === */
        .progress-step:nth-child(2) .circle {
            background-color: #d3d3d3 !important;
            color: white;
        }

        .progress-step:nth-child(2) .progress-label {
            color: #d3d3d3 !important;
            font-weight: 600;
        }

        /* REGISTER / LOGIN CONTAINER - DISESUAIKAN SAMA DENGAN HALAMAN PERUSAHAAN */
        .register-container {
            max-width: 650px; /* DISESUAIKAN SAMA */
            min-height: 450px; /* DISESUAIKAN SAMA */
            margin: 35px auto 50px auto; /* DISESUAIKAN SAMA */
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            overflow: hidden;
        }

        /* Kiri - DISESUAIKAN SAMA */
        .register-left {
            background: #e9f6fd;
            padding: 28px 18px; /* DISESUAIKAN SAMA */
            max-width: 200px; /* DISESUAIKAN SAMA */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            text-align: left;
            gap: 22px; /* DISESUAIKAN SAMA */
            flex-shrink: 0;
        }
        .register-left .feature {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 0;
        }
        .register-left .feature img {
            width: 45px; /* DISESUAIKAN SAMA */
            height: 45px; /* DISESUAIKAN SAMA */
            margin-bottom: 9px; /* DISESUAIKAN SAMA */
            flex-shrink: 0;
        }
        .register-left .feature img.people-img {
            width: 60px; /* DISESUAIKAN SAMA */
            height: 60px; /* DISESUAIKAN SAMA */
        }
        .register-left .feature h6 {
            margin: 0;
            font-weight: 600;
            font-size: 13.5px; /* DISESUAIKAN SAMA */
            line-height: 1.35; /* DISESUAIKAN SAMA */
            color: #333;
        }

        /* Kanan - DISESUAIKAN SAMA */
        .register-right {
            padding: 40px 45px; /* DISESUAIKAN SAMA */
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .register-right h3 {
            font-weight: bold;
            margin-bottom: 22px; /* DISESUAIKAN SAMA */
            font-size: 23px; /* DISESUAIKAN SAMA */
            line-height: 1.35; /* DISESUAIKAN SAMA */
        }

        /* Form - Disesuaikan dengan halaman login perusahaan */
        .form-label {
            align-self: flex-start;
            margin-bottom: 5px;
            font-weight: normal;
            color: black;
        }
        .form-control {
            border-radius: 2px; /* Diubah dari 6px menjadi 2px */
            padding: 10px 15px;
            font-size: 1rem;
            color: #333;
            height: auto;
            border: 1px solid #999; /* Diubah ketebalan border menjadi 1px solid #999 */
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            font-size: 1.25rem;
        }
        .forgot-password {
            display: block;
            text-align: left;
            margin-top: 8px;
            font-size: 0.85rem;
            color: black;
            text-decoration: underline;
            font-weight: normal;
        }
        .btn-submit {
            background-color: #0d47a1;
            color: #fff;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: normal;
            font-size: 1rem;
            border: none;
            width: 180px;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background-color: #0d47a1;
        }

        /* Social login - DISESUAIKAN SAMA */
        .social-login {
            margin-top: 18px; /* DISESUAIKAN SAMA */
            margin-bottom: 14px; /* DISESUAIKAN SAMA */
            display: flex;
            align-items: center;
            gap: 11px; /* DISESUAIKAN SAMA */
            justify-content: center;
            width: 100%;
        }
        .social-login span {
            color: #666;
            font-weight: 500;
            font-size: 0.83rem; /* DISESUAIKAN SAMA */
        }
        .social-login a img {
            width: 38px; /* DISESUAIKAN SAMA */
            height: 38px; /* DISESUAIKAN SAMA */
            border-radius: 50%;
            border: 1px solid #ccc;
            background: #fff;
            transition: 0.3s;
            object-fit: contain;
            padding: 4.5px; /* DISESUAIKAN SAMA */
        }
        .social-login a img.linkedin,
        .social-login a img.facebook,
        .social-login a img.google-icon {
            padding: 1px;
        }
        .social-login a img:hover {
            background: #f5f5f5;
        }

        /* Terms - DISESUAIKAN SAMA */
        .terms {
            margin-top: 9px; /* DISESUAIKAN SAMA */
            font-size: 0.83rem; /* DISESUAIKAN SAMA */
            color: #6c757d;
            line-height: 1.45; /* DISESUAIKAN SAMA */
            max-width: 90%;
        }
        .terms a {
            color: #000;
            font-weight: normal;
            text-decoration: none;
        }
        .terms a:hover {
            text-decoration: underline;
        }

        /* Login link - DISESUAIKAN SAMA */
        .login-link {
            margin-top: 14px; /* DISESUAIKAN SAMA */
            font-size: 0.98rem; /* DISESUAIKAN SAMA */
            color: #6c757d;
        }
        .login-link a {
            color: #4393fc;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        /* QR Code Floating - DISESUAIKAN SAMA */
        .qr-code-float {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 14px; /* DISESUAIKAN SAMA */
            text-align: center;
            z-index: 1000;
            width: 140px; /* DISESUAIKAN SAMA */
        }
        .qr-code-float img {
            width: 95px; /* DISESUAIKAN SAMA */
            height: auto;
            margin-bottom: 9px; /* DISESUAIKAN SAMA */
        }
        .qr-code-float p {
            font-size: 13.5px; /* DISESUAIKAN SAMA */
            line-height: 1.35; /* DISESUAIKAN SAMA */
            color: #333;
            font-weight: 500;
            margin: 0;
        }

        /* Custom Dropdown */
        .custom-dropdown {
            position: relative;
            width: 100%;
        }
        .custom-dropdown select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #999;
            border-radius: 2px;
            background-color: #fff;
            font-size: 1rem;
            color: #333;
            cursor: pointer;
        }
        .custom-dropdown::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #666;
            transition: transform 0.3s ease;
        }
        .custom-dropdown.open::after {
            transform: translateY(-50%) rotate(180deg);
        }

        /* Error styling */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
            text-align: left;
        }

        .alert {
            border-radius: 6px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
            <a href="/" class="navbar-brand d-flex align-items-center py-2">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
            </a>
            <a href="{{ route('company.login') }}" class="btn-login">Masuk</a>
        </div>
    </nav>

    <!-- === PROGRESS BAR === -->
    <div class="container progress-container">
        <div class="progress-step active">
            <div class="circle">1</div>
            <div class="progress-label">Data Diri</div>
        </div>
        <div class="progress-step active">
            <div class="circle">2</div>
            <div class="progress-label">Data Perusahaan</div>
        </div>
        <div class="progress-step">
            <div class="circle">3</div>
            <div class="progress-label">Lokasi Perusahaan</div>
        </div>
    </div>

    <div class="register-container">
        <div class="register-left">
            <div class="feature">
                <img src="{{ asset('images/people.png') }}" alt="People" class="people-img">
                <h6>Akses 9 Juta+<br>Talenta</h6>
            </div>
            <div class="feature">
                <img src="{{ asset('images/chat.png') }}" alt="Chat">
                <h6>Chat dan Rekrut<br>Talenta Langsung</h6>
            </div>
            <div class="feature">
                <img src="{{ asset('images/ai.png') }}" alt="AI">
                <h6>Rekrutmen Cepat<br>dengan Bantuan AI</h6>
            </div>
        </div>

        <div class="register-right">
            <h3>Pasang Iklan Lowongan<br>Kerja Gratis!</h3>

            <!-- Display Session Errors -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Display Validation Errors -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="formDaftarPerusahaan" action="{{ route('company.register.step1') }}" method="POST" style="width: 100%;">
                @csrf
                <div class="mb-3 text-start">
                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Ketik nama lengkap Anda" value="{{ old('nama_lengkap') }}" required>
                    @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="Ketik nomor HP Anda" value="{{ old('no_hp') }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Kolom Jabatan di Perusahaan (Dropdown) -->
                <div class="mb-3 text-start">
                    <div class="custom-dropdown">
                        <select id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" required>
                            <option value="" disabled selected>Jabatan Anda Di Perusahaan</option>
                            <option value="owner/pemilik" {{ old('jabatan') == 'owner/pemilik' ? 'selected' : '' }}>Owner/Pemilik</option>
                            <option value="direktur" {{ old('jabatan') == 'direktur' ? 'selected' : '' }}>Direktur</option>
                            <option value="manajer HRD" {{ old('jabatan') == 'manajer HRD' ? 'selected' : '' }}>Manajer HRD</option>
                            <option value="staf HRD" {{ old('jabatan') == 'staf HRD' ? 'selected' : '' }}>Staf HRD</option>
                            <option value="supervisor" {{ old('jabatan') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="lainnya" {{ old('jabatan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3 text-start">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <div class="password-container">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password baru" required>
                        <i class="fa-regular fa-eye password-toggle" data-target="password"></i>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <div class="password-container">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                        <i class="fa-regular fa-eye password-toggle" data-target="password_confirmation"></i>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-submit" id="submitButton">Lanjutkan</button>
            </form>
            
            <div class="social-login">
                <span>Atau dengan</span>
                <a href="#"><img src="{{ asset('images/googles.png') }}" alt="Google" class="google-icon"></a>
            </div>

            <div class="terms">
                Dengan melanjutkan, anda menyetujui
                <a href="#">Perjanjian Pengguna</a>,
                <a href="#">Kebijakan Privasi</a> dan
                <a href="#">Syarat Ketentuan Layanan</a>
            </div>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('company.login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <div class="qr-code-float">
        <img src="{{ asset('images/qr code.png') }}" alt="QR Code Glints App">
        <p>Rekrut Cepat<br>dengan Talenthub App</p>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility untuk kedua kolom password
        const passwordToggles = document.querySelectorAll('.password-toggle');
        
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Dropdown functionality
        const dropdowns = document.querySelectorAll('.custom-dropdown select');
        
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('focus', function() {
                this.parentElement.classList.add('open');
            });
            
            dropdown.addEventListener('blur', function() {
                this.parentElement.classList.remove('open');
            });
            
            dropdown.addEventListener('change', function() {
                this.parentElement.classList.remove('open');
            });
        });

        // Update validasi form untuk menyesuaikan dengan field baru
        const form = document.getElementById('formDaftarPerusahaan');
        const submitButton = document.getElementById('submitButton');
        
        form.addEventListener('submit', function (e) {
            const nama = document.getElementById('nama_lengkap').value.trim();
            const hp = document.getElementById('no_hp').value.trim();
            const jabatan = document.getElementById('jabatan').value;
            const email = document.getElementById('email').value.trim();
            const pass = document.getElementById('password').value.trim();
            const passConfirmation = document.getElementById('password_confirmation').value.trim();

            if (nama === '' || hp === '' || jabatan === '' || email === '' || pass === '' || passConfirmation === '') {
                e.preventDefault();
                alert('Semua kolom harus diisi sebelum melanjutkan!');
                return;
            }

            if (pass !== passConfirmation) {
                e.preventDefault();
                alert('Konfirmasi password tidak sesuai!');
                return;
            }

            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>