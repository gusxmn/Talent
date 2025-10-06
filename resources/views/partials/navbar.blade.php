<style>
    /* Navbar */
    .navbar {
        font-size: 1rem; /* samakan ukuran teks navbar */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .navbar-logo {
        height: 38px; /* samakan tinggi logo */
        width: auto;
        margin-right: 1.5rem;
    }
    .navbar .nav-link {
        color: #2c2c2c;
        margin-right: 1rem;
        font-weight: 400;
        white-space: nowrap; /* cegah judul jadi 2 baris */
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

    /* Tombol Daftar dan Masuk */
    .btn-primary-custom { transition: all 0.3s ease; }
    .btn-primary-custom:hover {
        background-color: #fff;
        color: #0d47a1;
        border-color: #0d47a1;
    }
    .btn-outline-primary-custom { transition: all 0.3s ease; }
    .btn-outline-primary-custom:hover {
        background-color: #0d47a1;
        color: #fff;
        border-color: #0d47a1;
    }

    @media (max-width: 992px) {
        .navbar .nav-link.active { border-bottom: none; }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">
        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="d-inline-block align-text-top navbar-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="lowongan-kerja">Lowongan Kerja</a></li>
                <li class="nav-item"><a class="nav-link" href="sumber-daya-karir">Sumber Daya Karir</a></li>
                <li class="nav-item"><a class="nav-link" href="explore-perusahaan">Explore Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="tentang-perusahaan">Tentang Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="kontak">Kontak</a></li>
                <li class="nav-item d-lg-none"><a class="nav-link text-primary" href="#">Untuk Perusahaan</a></li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                <a href="{{ url('/untuk-perusahaan') }}" class="nav-link text-primary ms-3 d-none d-lg-block">Untuk Perusahaan</a>
            </div>
        </div>
    </div>
</nav>






