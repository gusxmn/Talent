<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Talenthub</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

  <style>
    body {
      background-color: #f7f9fb;
      font-family: Arial, sans-serif;
    }

    /* NAVBAR */
    .navbar {
      font-size: 0.95rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      background: #fff;
      border-bottom: 1px solid #dee2e6;
      padding: 0.7rem 1.5rem;
    }
    .navbar-logo {
      height: 30px;
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

    /* REGISTER CONTAINER */
    .register-container {
      max-width: 700px;
      min-height: 490px;
      margin: 40px auto 60px auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      display: flex;
      overflow: hidden;
    }

    /* Kiri */
    .register-left {
      background: #e9f6fd;
      padding: 30px 20px;
      max-width: 220px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      text-align: left;
      gap: 25px;
      flex-shrink: 0;
    }
    .register-left .feature {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 0;
    }
    .register-left .feature img {
      width: 50px;
      height: 50px;
      margin-bottom: 10px;
      flex-shrink: 0;
    }
    .register-left .feature img.people-img {
      width: 65px;
      height: 65px;
    }
    .register-left .feature h6 {
      margin: 0;
      font-weight: 600;
      font-size: 14px;
      line-height: 1.4;
      color: #333;
    }

    /* Kanan */
    .register-right {
      padding: 45px 50px;
      flex: 1;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .register-right h3 {
      font-weight: bold;
      margin-bottom: 25px;
      font-size: 30px;
      line-height: 1.4;
    }
    .register-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ddd;
      border-radius: 25px;
      padding: 12px 20px;
      margin: 8px 0;
      cursor: pointer;
      font-weight: 500;
      font-size: 1rem;
      background: #fff;
      width: 100%;
      transition: 0.3s;
      text-decoration: none;
      color: #333;
    }
    .register-btn:hover {
      background: #f8f9fa;
    }
    .register-btn img {
      width: 24px;
      height: 24px;
      margin-right: 12px;
    }

    /* Social login */
    .social-login {
      margin-top: 20px;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 12px;
      justify-content: center;
      width: 100%;
    }
    .social-login span {
      color: #666;
      font-weight: 500;
      font-size: 0.85rem;
    }
    .social-login a img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid #ccc;
      background: #fff;
      transition: 0.3s;
      object-fit: contain;
      padding: 5px;
    }
    .social-login a img.linkedin,
    .social-login a img.facebook {
      padding: 1px;
    }
    .social-login a img:hover {
      background: #f5f5f5;
    }

    /* Terms */
    .terms {
      margin-top: 10px;
      font-size: 0.85rem;
      color: #6c757d;
      line-height: 1.5;
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

    /* Login link */
    .login-link {
      margin-top: 15px;
      font-size: 1 rem;
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

    /* QR Code Floating */
    .qr-code-float {
      position: fixed;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
      z-index: 1000;
      width: 150px;
    }
    .qr-code-float img {
      width: 100px;
      height: auto;
      margin-bottom: 10px;
    }
    .qr-code-float p {
      font-size: 14px;
      line-height: 1.4;
      color: #333;
      font-weight: 500;
      margin: 0;
    }

    /* Footer */
    .footer-bg {
      background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), url('{{ asset('images/gedung.png') }}');
      background-size: cover;
      background-position: center;
      position: relative;
      color: #fff;
    }
    .footer-logo {
      height: 120px;
      width: auto;
      display: block;
    }
    .footer-link {
      color: #fff;
      text-decoration: none;
    }
    .footer-link:hover {
      color: #28a745;
    }
    .alamat-icon-wrapper {
      display: flex;
      align-items: flex-start;
      margin-bottom: 0.5rem;
    }
    .alamat-text {
      flex-grow: 1;
      margin-left: 0.5rem;
    }
    .text-red-custom {
      color: #dc3545;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a href="/" class="navbar-brand d-flex align-items-center">
        <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
      </a>
      <a href="{{ url('/login-perusahaan') }}" class="btn-login">Masuk</a>
    </div>
  </nav>

  <!-- REGISTER CONTAINER -->
  <div class="register-container">
    <!-- Kiri -->
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

    <!-- Kanan -->
    <div class="register-right">
      <h3>Pasang Iklan Lowongan<br>Kerja Gratis!</h3>

      <div class="register-btn">
        <img src="{{ asset('images/googles.png') }}" alt="Google">
        Daftar dengan Google
      </div>

      <!-- Ubah jadi link ke daftar-perusahaan -->
      <a href="http://127.0.0.1:8000/daftar-perusahaan" class="register-btn">
        <img src="{{ asset('images/gmail.png') }}" alt="Email">
        Daftar dengan Email
      </a>

      <div class="social-login">
        <span>Atau dengan</span>
        <a href="#"><img src="{{ asset('images/logo linkedin.png') }}" alt="LinkedIn" class="linkedin"></a>
        <a href="#"><img src="{{ asset('images/logo facebook.png') }}" alt="Facebook" class="facebook"></a>
      </div>

      <div class="terms">
        Dengan melanjutkan, anda menyetujui
        <a href="#">Perjanjian Pengguna</a>,
        <a href="#">Kebijakan Privasi</a> dan
        <a href="#">Syarat Ketentuan Layanan</a>
      </div>

      <div class="login-link">
        Sudah punya akun? <a href="{{ url('/login-perusahaan') }}">Login di sini</a>
      </div>
    </div>
  </div>

  <!-- QR Code Floating -->
  <div class="qr-code-float">
    <img src="{{ asset('images/qr code.png') }}" alt="QR Code Glints App">
    <p>Rekrut Cepat<br>dengan Talenthub App</p>
  </div>

  <!-- FOOTER -->
  <footer class="py-5 footer-bg text-white">
    <div class="container">
      <div class="row">

        <div class="col-md-4 mb-4 mb-md-0">
          <div class="mb-3">
            <img src="{{ asset('images/inotal.png') }}" alt="INOTAL SISTEMA INTERNASIONAL"
              class="footer-logo">
          </div>
          <p class="mb-1">PT INOTAL SISTEMA INTERNASIONAL</p>
          <p>Langkah Mudah Menuju Masa Depan Karier</p>
        </div>

        <div class="col-md-4 mb-4 mb-md-0">
          <h5 class="fw-bold mb-3 text-red-custom">Navigasi</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="footer-link">Lowongan Kerja</a></li>
            <li><a href="#" class="footer-link">Sumber Daya Karir</a></li>
            <li><a href="#" class="footer-link">Explore Perusahaan</a></li>
            <li><a href="untuk-perusahaan" class="footer-link">Tentang Perusahaan</a></li>
            <li><a href="kontak" class="footer-link">Kontak</a></li>
          </ul>
        </div>

        <div class="col-md-4">
          <h5 class="fw-bold mb-3 text-red-custom">Alamat</h5>
          <ul class="list-unstyled">
            <li>
              <p class="alamat-icon-wrapper">
                <i class="bi bi-geo-alt-fill me-2 text-red-custom"></i>
                <span class="alamat-text">
                  Jl. Pratista Utara III No.2,<br>
                  Antapani Kidul,<br>
                  Kec. Antapani, Kota Bandung,<br>
                  Jawa Barat, Indonesia 4029
                </span>
              </p>
            </li>
            <li>
              <p class="mb-1 d-flex align-items-start">
                <i class="bi bi-telephone-fill me-2 text-red-custom"></i>
                <span>+(62) 82115179879</span>
              </p>
            </li>
            <li>
              <p class="mb-1 d-flex align-items-start">
                <i class="bi bi-envelope-fill me-2 text-red-custom"></i>
                <span>corporate@inotal.tech</span>
              </p>
            </li>
          </ul>
        </div>

      </div>

      <hr class="my-4" style="border-color: #6c757d;">

      <div class="text-center">
        Copyright ©2025 INOTAL SISTEMA INTERNASIONAL
      </div>
    </div>
  </footer>

</body>
</html>
