<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Talenthub</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <style>
    /* Navbar */
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

    /* Body & Container */
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .registration-box {
      max-width: 700px;
      margin: 20px auto;
      background: #fff;
      border-radius: 6px;
      padding: 40px 50px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .title-glints {
      font-size: 28px;
      font-weight: 700;
      text-align: center;
      margin: 40px auto 20px;
    }

    .title-glints span {
      color: #00b14f;
    }

    /* Input style */
    .form-control,
    .input-group-text {
      height: 48px;
      font-size: 14px;
    }

    .row .col {
      margin-bottom: 20px;
    }

    /* Lokasi Dropdown */
    .dropdown-location {
      position: relative;
    }

    .dropdown-location .caret-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      color: #555;
      cursor: pointer;
      pointer-events: auto;
    }

    .dropdown-list {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: #fff;
      border: 1px solid #ccc;
      border-top: none;
      z-index: 1000;
      max-height: 180px;
      overflow-y: auto;
      display: none;
    }

    .dropdown-list div {
      padding: 8px 12px;
      cursor: pointer;
    }

    .dropdown-list div:hover {
      background-color: #f0f0f0;
    }

    /* Button */
    .btn-daftar {
      background-color: #e60000;
      color: #fff;
      font-weight: 600;
      height: 48px;
      border: none;
      font-size: 15px;
      width: 200px;
      margin: 0 auto;
      display: block;
    }

    .btn-daftar:hover {
      background-color: #c70000;
    }

    /* Footer text */
    .company-link,
    .terms,
    .footer-line {
      text-align: center;
      margin-top: 25px;
      font-size: 15px;
      line-height: 1.6;
    }

    .company-link a,
    .terms a {
      text-decoration: underline;
      font-weight: 500;
    }

    .footer-line a {
      font-weight: 600;
      color: #0d47a1;
      text-decoration: none;
    }

    .footer-line a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="d-inline-block align-text-top me-2" style="height: 30px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
          <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3"
            onclick="window.location.reload();">Masuk</a>
          <a href="#" class="nav-link text-primary ms-3 d-none d-lg-block">Untuk Perusahaan</a>
        </div>
      </div>
    </div>
  </nav>

  {{-- Judul --}}
  <h2 class="title-glints">Mari buat profil <br>Talenthub kamu.</h2>

  {{-- Konten --}}
  <div class="registration-box">
    <form action="{{ url('/minat-pekerjaan') }}" method="GET">
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nama depan" required>
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Nama Belakang" required>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <input type="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="col">
          <input type="password" class="form-control" placeholder="Buat kata sandi" required>
        </div>
      </div>

      <div class="row">
        <div class="col dropdown-location">
          <input type="text" class="form-control" id="locationInput" placeholder="Masukkan lokasimu (Kota & Negara)" autocomplete="off" required>
             <i class="bi bi-chevron-down caret-icon" id="locationCaret"></i>
          <div class="dropdown-list" id="locationDropdown"></div>
        </div>
        <div class="col">
          <div class="input-group">
            <span class="input-group-text">+62</span>
            <input type="text" class="form-control" placeholder="Nomor WhatsApp" required>
          </div>
        </div>
      </div>

      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-daftar">DAFTAR</button>
      </div>
    </form>

    <p class="company-link">Untuk perusahaan, kunjungi <a href="#">halaman ini</a></p>
    <p class="terms">Dengan mendaftar, saya setuju dengan <a href="#">Ketentuan Layanan</a></p>

    <div class="footer-line">
      <span>Sudah punya akun Talenthub ?</span>
      <a href="{{ url('/masuk') }}"> Masuk</a>
    </div>
  </div>

  <script>
    const locations = [
      "Jakarta Pusat, DKI Jakarta",
      "Jakarta Selatan, DKI Jakarta",
      "Jakarta Barat, DKI Jakarta",
      "Jakarta Utara, DKI Jakarta",
      "Jakarta Timur, DKI Jakarta",
      "Bandung, Jawa Barat",
      "Bogor, Jawa Barat",
      "Depok, Jawa Barat",
      "Bekasi, Jawa Barat",
      "Tangerang, Banten",
      "Serang, Banten",
      "Yogyakarta, DI Yogyakarta",
      "Surabaya, Jawa Timur",
      "Malang, Jawa Timur",
      "Sidoarjo, Jawa Timur",
      "Semarang, Jawa Tengah",
      "Solo, Jawa Tengah",
      "Medan, Sumatera Utara",
      "Padang, Sumatera Barat",
      "Denpasar, Bali"
    ];

    const input = document.getElementById("locationInput");
    const dropdown = document.getElementById("locationDropdown");
    const caret = document.getElementById("locationCaret");

    // Filter saat ketik
    input.addEventListener("input", function () {
      const value = this.value.toLowerCase();
      dropdown.innerHTML = "";
      if (value) {
        const filtered = locations.filter(loc => loc.toLowerCase().includes(value));
        filtered.forEach(loc => {
          const div = document.createElement("div");
          div.textContent = loc;
          div.addEventListener("click", function () {
            input.value = loc;
            dropdown.style.display = "none";
          });
          dropdown.appendChild(div);
        });
        dropdown.style.display = filtered.length ? "block" : "none";
      } else {
        dropdown.style.display = "none";
      }
    });

    // Klik caret → tampilkan semua lokasi
    caret.addEventListener("click", function () {
      dropdown.innerHTML = "";
      locations.forEach(loc => {
        const div = document.createElement("div");
        div.textContent = loc;
        div.addEventListener("click", function () {
          input.value = loc;
          dropdown.style.display = "none";
        });
        dropdown.appendChild(div);
      });
      dropdown.style.display = "block";
    });

    // Klik luar → tutup dropdown
    document.addEventListener("click", function (e) {
      if (!e.target.closest(".dropdown-location")) {
        dropdown.style.display = "none";
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
