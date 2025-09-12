<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    /* Warna-warna khusus */
    .text-green { color: #28a745; }
    .bg-green { background-color: #28a745; }
    .btn-green:hover { background-color: #218838; }
    .text-orange-custom { color: #FF6633; }
    .text-custom-gray { color: #6c757d; }
    .text-red-custom { color: #e11c25; }
    .text-dark-gray { color: #495057; }

    /* 🔹 Navbar gaya Jobstreet */
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

    .navbar .nav-link:hover { color: #0d47a1; }
    .navbar .nav-link.active {
        color: #0d47a1;
        font-weight: 600;
        border-bottom: 2px solid #0d47a1;
    }

    .navbar .nav-item {
        display: flex;
        align-items: center;
    }

    .badge-baru {
        background-color: #e0f2f1;
        color: #00796b;
        font-weight: 600;
        padding: 0.25em 0.7em;
        border-radius: 9999px;
        margin-left: 0.25rem;
        font-size: 0.75rem;
    }

    .dropdown-toggle::after { display: none; }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

    /* ✨ Tambahan CSS untuk Tombol Daftar dan Masuk ✨ */
    /* Efek hover untuk tombol 'Daftar' */
    .btn-primary-custom {
        transition: all 0.3s ease; /* Menambahkan transisi untuk efek yang halus */
    }
    .btn-primary-custom:hover {
        background-color: #fff; /* Mengubah latar belakang menjadi putih saat hover */
        color: #0d47a1; /* Mengubah warna teks menjadi biru saat hover */
        border-color: #0d47a1; /* Mempertahankan warna border biru */
    }

    /* Efek hover untuk tombol 'Masuk' */
    .btn-outline-primary-custom {
        transition: all 0.3s ease; /* Menambahkan transisi untuk efek yang halus */
    }
    .btn-outline-primary-custom:hover {
        background-color: #0d47a1; /* Mengubah latar belakang menjadi biru saat hover */
        color: #fff; /* Mengubah warna teks menjadi putih saat hover */
        border-color: #0d47a1; /* Mempertahankan warna border biru */
    }
    /* ✨ Akhir Tambahan CSS ✨ */


    @media (max-width: 992px) {
        .navbar .nav-link.active {
            border-bottom: none;
        }
    }

    /* 🔹 Bagian Search Header */
    .search-header {
        background: url('{{ asset('images/Header.png') }}') no-repeat center center;
        background-size: cover;
        padding: 3rem 0;
        min-height: 200px;
        color: #fff;
        display: flex;
        align-items: center;
    }

    .search-box .form-control,
    .search-box .form-select {
        border-radius: 6px;
        border: none;
        padding: 0.75rem 1rem;
    }

    /* Kolom input kata kunci lebih pendek */
    .input-keyword {
        width: 250px; /* ubah sesuai kebutuhan */
    }

    /* Gaya tombol Cari yang baru */
    .btn-pink {
        background-color: #e6007e;
        color: #fff;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease-in-out;
        width: 80px;
    }

    .btn-pink:hover {
        background-color: #c7006c;
        color: #fff;
        transform: translateY(-2px);
    }

    .search-label {
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    .search-options-wrapper {
        text-align: right;
        margin-top: 1rem;
        padding-right: 0.5rem; /* geser sedikit ke kiri dari tepi */
    }

    .more-options {
        font-size: 0.9rem;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        padding-right: 100px; /* geser sedikit ke kiri dari tepi */
    }

    .more-options:hover {
        color: #e6007e;
    }

    /* Hero section */
    .hero-section {
        position: relative;
        padding: 5rem 0;
        background-color: #f6f8f5;
        overflow: hidden;
    }

    .hero-background-image {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: url('{{ asset('images/hero-image.png') }}');
        background-size: contain;
        background-position: right 0px;
        background-repeat: no-repeat;
        opacity: 0.3;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        color: #495057;
        font-weight: 500;
    }

    .hero-text {
        color: #6c757d;
    }


    /* Kategori pekerjaan */
    .category-card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        text-align: center;
        padding: 0.75rem;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .category-card .card-title {
        font-size: 1rem;
    }

    .category-heading {
        color: #495057;
    }
    
    /* Gaya untuk tag "Dibutuhkan Segera" - Disesuaikan kembali dengan gambar */
    .dibutuhkan-segera-tag {
        display: inline-block;
        background-color: #f7f7f7; /* Latar belakang putih keabu-abuan yang sangat terang */
        color: #007bff; /* Warna teks biru Bootstrap default */
        border: 1px solid #cce5ff; /* Warna border biru yang sedikit lebih gelap dari latar belakang */
        border-radius: 9999px; /* Sudut sangat membulat, meniru badge */
        padding: 0.2rem 1rem; /* Padding lebih kecil, lebih mirip gambar */
        margin: 0.25rem; /* Jarak antar tag lebih rapat */
        font-size: 0.9rem; /* Ukuran font lebih kecil */
        font-weight: 400; /* Berat font normal */
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        text-decoration: none;
    }

    .dibutuhkan-segera-tag:hover {
        background-color: #e2e6ea; /* Warna latar belakang sedikit lebih gelap saat hover */
        color: #0056b3; /* Warna teks biru yang lebih gelap saat hover */
        border-color: #b8daff; /* Warna border sedikit lebih gelap saat hover */
    }

    /* Perusahaan terpercaya */
    .trusted-companies .logo-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        row-gap: 0.2rem;
    }

    .trusted-companies .logo-wrapper {
        flex-basis: 22%;
        max-width: 22%;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 75px;
    }

    .trusted-companies .logo {
        max-width: 90%;
        max-height: 70px;
        width: auto;
        height: auto;
        opacity: 0.8;
    }

    .trusted-companies .logo:hover {
        opacity: 1;
    }

    /* Gaya baru untuk card logo */
    .logo-card {
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 8px;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: none;
    }

    .logo-card:hover {
        transform: translateY(-5px);
        background-color: rgba(255, 255, 255, 0.4);
        border-color: rgba(224, 224, 224, 0.4);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
    }

    /* Penyesuaian untuk "Lihat Lainnya" */
    .see-more-offset {
        margin-left: 20px;
    }

    /* Statistik */
    .stats-section {
        background-color: #f6f8f5;
    }

    .stats-title {
        color: #495057;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 600;
    }

    .stats-text {
        color: #6c757d;
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

    /* 👇 CSS Kustom untuk Dropdown Klasifikasi 👇 */
    .dropdown-menu-scrollable {
        max-height: 300px;
        overflow-y: auto;
        padding: 0;
        min-width: 400px;
    }

    .dropdown-item-custom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 1rem;
        color: #212529;
    }

    .dropdown-item-custom:hover,
    .dropdown-item-custom:focus {
        background-color: #f8f9fa;
    }

    .dropdown-item-custom input[type="checkbox"] {
        margin-right: 0.5rem;
    }

    .dropdown-item-custom .count {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .search-box .btn.dropdown-toggle {
        background-color: #fff;
        color: #212529;
        border: none;
        box-shadow: none;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
    }

    .search-box .btn.dropdown-toggle:focus {
        box-shadow: none;
    }

    /* ✨ Optimalisasi CSS untuk animasi panah ✨ */
    .dropdown-toggle .bi-chevron-down {
        transition: transform 0.3s ease-in-out; /* Transisi untuk rotasi */
    }

    .dropdown-toggle[aria-expanded="true"] .bi-chevron-down {
        transform: rotate(180deg); /* Rotasi saat dropdown terbuka */
    }
    </style>

</head>

<body style="background-color: #f6f8f5;">

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid mx-lg-5">
            {{-- Mengubah href untuk kembali ke halaman utama --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo"
                    class="d-inline-block align-text-top me-2" style="height: 30px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Lowongan Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sumber Daya Karir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Explore Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link text-primary" href="#">Untuk Perusahaan</a></li>
                </ul>

                <div class="d-flex align-items-center">
                    <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                    <a href="{{ url('/masuk') }}"  class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                    <a href="#" class="nav-link text-primary ms-3 d-none d-lg-block">Untuk Perusahaan</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="search-header">
        <div class="container">
            <form class="row g-2 align-items-end search-box">
                <div class="col-12 col-md-4">
                    <label class="search-label">Pekerjaan apa?</label>
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci">
                </div>
                <div class="col-12 col-md-3">
                    <label class="search-label">&nbsp;</label>
                    <div class="dropdown w-100">
                        <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownKlasifikasi">
                            Semua klasifikasi
                            <i class="bi bi-chevron-down"></i> </button>
                        <ul class="dropdown-menu dropdown-menu-scrollable w-100" aria-labelledby="dropdownKlasifikasi">
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="devOps-infrastructure">
                                        <label class="form-check-label" for="devOps-infrastructure">DevOps & Infrastructure</label>
                                    </div>
                                    <span class="count">1,248</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="analyst-consultant">
                                        <label class="form-check-label" for="analyst-consultant">Analyst & Consultant</label>
                                    </div>
                                    <span class="count">5,677</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="project-management">
                                        <label class="form-check-label" for="project-management">Project Management</label>
                                    </div>
                                    <span class="count">1,914</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="ui/ux-design">
                                        <label class="form-check-label" for="ui/ux-design">UI/UX Design</label>
                                    </div>
                                    <span class="count">3,593</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="database-management">
                                        <label class="form-check-label" for="database-management">Database Management</label>
                                    </div>
                                    <span class="count">86</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="frontend-developer">
                                        <label class="form-check-label" for="frontend-developer">Frontend Developer</label>
                                    </div>
                                    <span class="count">451</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="mobile-developer">
                                        <label class="form-check-label" for="mobile-developer">Mobile Developer</label>
                                    </div>
                                    <span class="count">6,823</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="backend-developer">
                                        <label class="form-check-label" for="backend-developer">Backend Developer</label>
                                    </div>
                                    <span class="count">5,326</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="cybersecurity">
                                        <label class="form-check-label" for="cybersecurity">Cybersecurity</label>
                                    </div>
                                    <span class="count">1,738</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                <div class="col-12 col-md-3">
                    <label class="search-label">Di mana?</label>
                    <input type="text" class="form-control" placeholder="Masukkan kota atau wilayah">
                </div>
                <div class="col-12 col-md-2 d-grid">
                    <button type="submit" class="btn btn-pink">
                        Cari
                    </button>
                </div>
            </form>

            <div class="search-options-wrapper">
                <a href="#" class="more-options">Opsi lainnya <i class="bi bi-sliders"></i></a>
            </div>
        </div>
    </section>

    <section class="hero-section text-center text-md-start">
        <div class="hero-background-image"></div>
        <div class="hero-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 mb-4 mb-md-0">
                        <h1 class="display-6 mb-3 hero-title">
                            Temukan kesempatan karir yang Anda impikan
                        </h1>
                        <p class="lead mb-4 hero-text">
                            Lebih dari 100+ posisi pekerjaan terverifikasi tersedia di perusahaan kami.
                            <br class="d-none d-md-block">
                            Bergabunglah bersama tim profesional kami dan raih karir Anda ke level selanjutnya.
                        </p>
                    </div>
                    <div class="col-md-5 d-none d-md-block"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="fs-4 mb-4 fw-bold category-heading">Kategori pekerjaan</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">DevOps & Infrastructure</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Analyst & Consultant</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Project Management</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">UI/UX Design</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Database Management</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Frontend Developer</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Mobile Developer</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Backend Developer</h5>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 category-card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h5 class="card-title mb-0">Cybersecurity</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="fs-4 fw-bold mb-4 text-dark-gray">Dibutuhkan segera</h2>
                    <div class="d-flex flex-wrap">
                        <a href="#" class="dibutuhkan-segera-tag">DevOps Engineer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Data Analyst</a>
                        <a href="#" class="dibutuhkan-segera-tag">Project Manager</a>
                        <a href="#" class="dibutuhkan-segera-tag">UI Designer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Database Administrator</a>
                        <a href="#" class="dibutuhkan-segera-tag">Frontend Developer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Mobile Developer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Backend Developer</a>
                        <a href="#" class="dibutuhkan-segera-tag">Security Architect</a>
                        <a href="#" class="dibutuhkan-segera-tag">Cloud Engineer</a>
                        <a href="#" class="dibutuhkan-segera-tag">IT Consultant</a>
                        <a href="#" class="dibutuhkan-segera-tag">Product Manager</a>
                        <a href="#" class="dibutuhkan-segera-tag">iOS Developer</a>
                    </div>
                </div>

                <div class="col-md-7 trusted-companies">
                    <h2 class="fs-4 fw-bold mb-4 text-dark-gray">Perusahaan terpercaya, merekrut</h2>
                    <div class="logo-container">
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/bukalapak.png') }}" alt="Bukalapak" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/shopee.png') }}" alt="Shopee" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/gojek.png') }}" alt="Gojek" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/telkom.png') }}" alt="Telkom Indonesia" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/jnt.png') }}" alt="J&T Express" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/traveloka.png') }}" alt="Traveloka" class="logo">
                            </div>
                        </div>
                        <div class="logo-wrapper">
                            <div class="logo-card">
                                <img src="{{ asset('images/xendit.png') }}" alt="Xendit" class="logo">
                            </div>
                        </div>
                    </div>
                    <div class="text-start mt-3">
                        <a href="#" class="text-decoration-none see-more-offset">Lihat Lainnya.....</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 text-center stats-section">
        <div class="container">
            <h2 class="fs-4 fw-normal stats-title mb-2">Statistik Website Kami</h2>
            <p class="stats-text mb-5">
                Berikut adalah data keberhasilan kami dalam merekrut talenta terbaik
            </p>
            <div class="row">
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">50</h3>
                    <p class="stats-text fw-semibold">Pelamar</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">10</h3>
                    <p class="stats-text fw-semibold">Lowongan Terbuka</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">30</h3>
                    <p class="stats-text fw-semibold">Posisi Terpenuhi</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <h3 class="stats-number text-green">75</h3>
                    <p class="stats-text fw-semibold">Karyawan</p>
                </div>
            </div>
        </div>
    </section>

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
                        <li><a href="#" class="footer-link">Tentang Perusahaan</a></li>
                        <li><a href="#" class="footer-link">Kontak</a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>