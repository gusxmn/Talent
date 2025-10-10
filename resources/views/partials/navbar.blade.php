<style>
    /* === Navbar === */
    .navbar {
        font-size: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
        z-index: 10;
    }

    .navbar-logo {
        height: 38px;
        width: auto;
        margin-right: 1.5rem;
    }

    .navbar .nav-link {
        color: #2c2c2c;
        margin-right: 1rem;
        font-weight: 400;
        transition: color 0.2s ease;
        position: relative;
        white-space: nowrap;
    }

    .navbar .nav-link:hover {
        color: #0d47a1;
    }

    .navbar .nav-link.active {
        color: #0d47a1;
        font-weight: 600;
    }

    .navbar .nav-item {
        display: flex;
        align-items: center;
    }

    /* === Underline Animasi === */
    .nav-underline {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 2px;
        background: #0d47a1;
        border-radius: 2px;
        transition: all 0.25s ease;
        width: 0;
        opacity: 0;
    }

    /* === Tombol Daftar & Masuk === */
    .btn-primary,
    .btn-outline-primary {
        border-radius: 4px;
        padding: 0.35rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary {
        color: #fff;
        background-color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-primary:hover {
        background-color: #fff;
        color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-outline-primary {
        color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-outline-primary:hover {
        background-color: #0d47a1;
        color: #fff;
        border-color: #0d47a1;
    }

    /* === Ikon & Profil User === */
    .nav-icon {
        font-size: 1.2rem;
        color: #2c2c2c;
        margin-right: 1rem;
        cursor: pointer;
        transition: color 0.2s;
    }

    .nav-icon:hover {
        color: #0d47a1;
    }

    .user-profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f5e7c6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: #333;
        margin-left: 0.5rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.15);
    }

    .user-dropdown-name {
        font-weight: 600;
        color: #2c2c2c;
        margin: 0 0.3rem 0 0.8rem;
        white-space: nowrap;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-toggle::after {
        display: none;
    }

    .nav-link.company-link {
        color: #0d47a1 !important;
        font-weight: 600 !important;
    }

    .nav-link.company-link:hover,
    .nav-link.company-link.active {
        color: #0d47a1 !important;
        border: none !important;
    }

    @media (max-width: 992px) {
        .navbar .nav-link.active {
            border-bottom: none;
        }
        .nav-underline { display: none; }
        .user-dropdown-name { display: none !important; }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">
        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="navbar-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 position-relative" id="navMenu">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}" href="{{ route('jobs.index') }}">Lowongan Kerja</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('sumber-daya-karir') ? 'active' : '' }}" href="/sumber-daya-karir">Sumber Daya Karir</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('explore-perusahaan') ? 'active' : '' }}" href="/explore-perusahaan">Explore Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('tentang-perusahaan') ? 'active' : '' }}" href="/tentang-perusahaan">Tentang Perusahaan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="/kontak">Kontak</a></li>
                <li class="nav-item d-lg-none"><a class="nav-link company-link {{ request()->is('untuk-perusahaan') ? 'active' : '' }}" href="/untuk-perusahaan">Untuk Perusahaan</a></li>
                <span class="nav-underline" id="navUnderline"></span>
            </ul>

            <div class="d-flex align-items-center">
                @auth
                    <i class="fas fa-bell nav-icon" title="Notifikasi"></i>
                    <i class="fas fa-comment-dots nav-icon" title="Pesan"></i>

                    <div class="dropdown">
                        <a class="user-dropdown-toggle dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <div class="user-profile-icon"><i class="fas fa-user"></i></div>
                            <span class="user-dropdown-name d-none d-lg-inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ms-1 d-none d-lg-inline" style="font-size: 0.75rem; color: #6c757d;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><div class="dropdown-item disabled text-dark">Login sebagai: <b>{{ Auth::user()->name }}</b></div></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/profil') }}">Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pengaturan') }}">Pengaturan Akun</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                    <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                    <a href="{{ url('/untuk-perusahaan') }}" class="nav-link company-link ms-3 d-none d-lg-block {{ request()->is('untuk-perusahaan') ? 'active' : '' }}">Untuk Perusahaan</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const underline = document.getElementById("navUnderline");
    const navLinks = document.querySelectorAll("#navMenu .nav-link:not(.company-link)");

    function moveUnderline(el) {
        const rect = el.getBoundingClientRect();
        const parentRect = el.closest("#navMenu").getBoundingClientRect();
        underline.style.width = `${rect.width}px`;
        underline.style.left = `${rect.left - parentRect.left}px`;
        underline.style.opacity = "1";
    }

    // tampil di link aktif saat load
    const activeLink = document.querySelector("#navMenu .nav-link.active");
    if (activeLink) moveUnderline(activeLink);

    // gerak pas hover
    navLinks.forEach(link => {
        link.addEventListener("mouseenter", () => moveUnderline(link));
        link.addEventListener("click", () => moveUnderline(link));
    });

    // kembali ke link aktif saat mouse keluar
    document.getElementById("navMenu").addEventListener("mouseleave", () => {
        const active = document.querySelector("#navMenu .nav-link.active");
        if (active) moveUnderline(active);
        else underline.style.opacity = "0";
    });

    // update posisi saat resize
    window.addEventListener("resize", () => {
        const active = document.querySelector("#navMenu .nav-link.active");
        if (active) moveUnderline(active);
    });
});
</script>
