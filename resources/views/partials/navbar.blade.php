<style>
    /* Navbar */
    .navbar {
        font-size: 0.95rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
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
        transition: color 0.2s ease;
        position: relative;
    }
    .navbar .nav-link:hover { color: #0d47a1; }
    .navbar .nav-link.active {
        color: #0d47a1;
        font-weight: 600;
    }

    /* underline interaktif */
    .nav-underline {
        position: absolute;
        bottom: 0;
        height: 2px;
        background: #0d47a1;
        transition: all 0.3s ease;
    }

    @media (max-width: 992px) {
        .nav-underline { display: none; }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" 
                 class="d-inline-block align-text-top me-2" style="height: 30px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 position-relative" id="navMenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}" 
                       href="{{ route('jobs.index') }}">Lowongan Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('sumber-daya-karir') ? 'active' : '' }}" 
                       href="/sumber-daya-karir">Sumber Daya Karir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('explore-perusahaan') ? 'active' : '' }}" 
                       href="/explore-perusahaan">Explore Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tentang-perusahaan') ? 'active' : '' }}" 
                       href="/tentang-perusahaan">Tentang Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" 
                       href="/kontak">Kontak</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-primary {{ request()->is('untuk-perusahaan') ? 'active' : '' }}" 
                       href="/untuk-perusahaan">Untuk Perusahaan</a>
                </li>
                <!-- underline bar -->
                <span class="nav-underline" id="navUnderline"></span>
            </ul>

            <div class="d-flex align-items-center">
                <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                <a href="{{ url('/untuk-perusahaan') }}" 
                   class="nav-link text-primary ms-3 d-none d-lg-block {{ request()->is('untuk-perusahaan') ? 'active' : '' }}">
                   Untuk Perusahaan
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Ambil elemen underline
    const underline = document.getElementById('navUnderline');
    const navLinks = document.querySelectorAll('#navMenu .nav-link');

    function moveUnderline(el) {
        const rect = el.getBoundingClientRect();
        const parentRect = el.parentElement.parentElement.getBoundingClientRect();
        underline.style.width = rect.width + "px";
        underline.style.left = (rect.left - parentRect.left) + "px";
    }

    // Set posisi awal sesuai link yang active (Laravel)
    const activeLink = document.querySelector('#navMenu .nav-link.active');
    if (activeLink) moveUnderline(activeLink);

    // Saat klik pindahkan underline
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            moveUnderline(this);
        });
    });

    // Responsif: pindahkan underline saat resize
    window.addEventListener('resize', () => {
        const active = document.querySelector('#navMenu .nav-link.active');
        if (active) moveUnderline(active);
    });
</script>
