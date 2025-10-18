<style>
    /* === Navbar === */
    .navbar {
        font-size: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
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
        border-bottom: 2px solid #0d47a1;
    }

    .navbar .nav-item {
        display: flex;
        align-items: center;
    }

    /* underline interaktif */
    .nav-underline {
        position: absolute;
        bottom: 0;
        height: 2px;
        background: #0d47a1;
        transition: all 0.3s ease;
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

    .btn-primary-custom,
    .btn-outline-primary-custom {
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background-color: #fff;
        color: #0d47a1;
        border-color: #0d47a1;
    }

    .btn-outline-primary-custom:hover {
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
        position: relative;
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

    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .user-dropdown-toggle:hover {
        text-decoration: none;
        color: inherit;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* hapus panah default bootstrap */
    .dropdown-toggle::after {
        display: none;
    }

    /* === Warna khusus menu "Untuk Perusahaan" === */
    .nav-link.company-link {
        color: #0d47a1 !important;
        font-weight: 600 !important;
        display: flex;
        align-items: center;
        height: 100%;
    }

    .nav-link.company-link:hover,
    .nav-link.company-link:focus,
    .nav-link.company-link.active {
        color: #0d47a1 !important;
        border: none !important;
    }

    /* perbaikan posisi saat halaman daftar */
    .navbar .d-flex.align-items-center {
        gap: 0.75rem;
    }

    .navbar .nav-link.company-link.ms-3 {
        margin-top: 0 !important;
        display: flex;
        align-items: center;
        padding-top: 0.25rem;
    }

    /* === Glints Style Dropdown === */
    .glints-dropdown {
        min-width: 12rem;
        padding: 0.2rem 0;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-top: 8px !important;
    }

    .glints-dropdown .dropdown-item {
        font-size: 0.875rem;
        color: #2c2c2c;
        padding: 0.65rem 1rem;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .glints-dropdown .dropdown-item:hover,
    .glints-dropdown .dropdown-item:focus {
        background-color: #f8f9fa;
        color: #0d47a1;
    }

    .glints-dropdown .dropdown-item i {
        font-size: 1rem;
        margin-right: 0.8rem;
        width: 1.1rem;
        text-align: center;
    }

    .glints-dropdown .dropdown-divider {
        margin: 0.2rem 0;
    }

    .glints-dropdown .dropdown-item.logout-item {
        color: #2c2c2c;
    }

    .glints-dropdown .dropdown-item.logout-item:hover {
        color: #0d47a1;
    }

    /* === Animasi panah dropdown === */
    .chevron-icon {
        transition: transform 0.3s ease;
        font-size: 0.7rem;
        color: #6c757d;
    }

    .chevron-icon.open {
        transform: rotate(180deg);
    }

    @media (max-width: 992px) {
        .navbar .nav-link.active {
            border-bottom: none;
        }
        .nav-underline { 
            display: none; 
        }
        .user-dropdown-name,
        .chevron-icon {
            display: none !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">

        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="navbar-logo d-inline-block align-text-top">
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
                       href="{{ route('jobs.index') }}">
                        Lowongan Kerja
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link
                        {{ request()->is('sumber-daya-karir') ||
                           request()->is('sumber-daya-karir/jelajahi-karier') ||
                           request()->is('sumber-daya-karir/pencarian-lowongan-kerja') ||
                           request()->is('sumber-daya-karir/kehidupan-kerja') ||
                           request()->is('sumber-daya-karir/jelajahi-gaji')
                            ? 'active' : '' }}"
                       href="/sumber-daya-karir">
                       Sumber Daya Karir
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('explore-perusahaan') ? 'active' : '' }}"
                       href="/explore-perusahaan">
                        Explore Perusahaan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tentang-perusahaan') ? 'active' : '' }}"
                       href="/tentang-perusahaan">
                        Tentang Perusahaan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}"
                       href="/kontak">
                        Kontak
                    </a>
                </li>

                <li class="nav-item d-lg-none">
                    <a class="nav-link company-link {{ request()->is('untuk-perusahaan') ? 'active' : '' }}"
                       href="/untuk-perusahaan">
                        Untuk Perusahaan
                    </a>
                </li>

                <span class="nav-underline" id="navUnderline"></span>
            </ul>

            <div class="d-flex align-items-center">

                @auth
                    {{-- HANYA tampilkan ikon & dropdown jika ROLE adalah "user" --}}
                    @if (Auth::user()->role === 'user')
                        
                        <i class="fas fa-bell nav-icon" title="Notifikasi"></i>
                        <i class="fas fa-comment-dots nav-icon" title="Pesan"></i>

                        <div class="dropdown" id="userDropdownContainer">
                            <a class="user-dropdown-toggle" href="#" role="button"
                               id="userDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">

                                <div class="user-profile-icon">
                                    <i class="fas fa-user"></i>
                                </div>

                                <span class="user-dropdown-name d-none d-lg-inline">
                                    {{ Auth::user()->name }}
                                </span>

                                <i class="fas fa-chevron-down ms-1 d-none d-lg-inline chevron-icon"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end glints-dropdown" aria-labelledby="userDropdownToggle">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/profil') }}">
                                        <i class="fas fa-user-circle"></i> PROFIL SAYA
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/lamaran-saya') }}">
                                        <i class="fas fa-file-alt"></i> LAMARAN SAYA
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/pengaturan-akun') }}">
                                        <i class="fas fa-cog"></i> PENGATURAN AKUN
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-item">
                                            <i class="fas fa-power-off"></i> KELUAR
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @else
                        {{-- Jika bukan role "user", kembalikan ke tampilan seperti pengunjung biasa --}}
                        <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                        <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                        <a href="{{ url('/untuk-perusahaan') }}"
                           class="nav-link company-link ms-3 d-none d-lg-block {{ request()->is('untuk-perusahaan') ? 'active' : '' }}">
                           Untuk Perusahaan
                        </a>
                    @endif

                @else
                    {{-- BELUM LOGIN --}}
                    <a href="{{ url('/daftar') }}" class="btn btn-primary btn-primary-custom">Daftar</a>
                    <a href="{{ url('/masuk') }}" class="btn btn-outline-primary btn-outline-primary-custom ms-3">Masuk</a>
                    <a href="{{ url('/untuk-perusahaan') }}"
                       class="nav-link company-link ms-3 d-none d-lg-block {{ request()->is('untuk-perusahaan') ? 'active' : '' }}">
                       Untuk Perusahaan
                    </a>
                @endauth

            </div>
        </div>
    </div>
</nav>

<script>
    const underline = document.getElementById('navUnderline');
    const navLinks = document.querySelectorAll('#navMenu .nav-link');

    function moveUnderline(el) {
        const rect = el.getBoundingClientRect();
        const parentRect = el.parentElement.parentElement.getBoundingClientRect();
        underline.style.width = rect.width + "px";
        underline.style.left = (rect.left - parentRect.left) + "px";
    }

    const activeLink = document.querySelector('#navMenu .nav-link.active');
    if (activeLink) moveUnderline(activeLink);

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            moveUnderline(this);
        });
    });

    window.addEventListener('resize', () => {
        const active = document.querySelector('#navMenu .nav-link.active');
        if (active) moveUnderline(active);
    });

    // dropdown user animasi chevron
    const userDropdownContainer = document.getElementById('userDropdownContainer');
    const chevronIcon = userDropdownContainer ? userDropdownContainer.querySelector('.chevron-icon') : null;

    if (userDropdownContainer && chevronIcon) {
        userDropdownContainer.addEventListener('show.bs.dropdown', () => chevronIcon.classList.add('open'));
        userDropdownContainer.addEventListener('hide.bs.dropdown', () => chevronIcon.classList.remove('open'));
    }
</script>
