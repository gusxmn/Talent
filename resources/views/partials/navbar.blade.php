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
                <li class="nav-item"><a class="nav-link" href="/tentang-perusahaan">Tentang Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link" href="/kontak">Kontak</a></li>
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