<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* ====================
        GLOBAL STYLES
        ==================== */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
      color: #333;
    }

    #wrapper {
      display: flex;
    }

    /* DARK MODE */
    body.dark-mode {
      background-color: #1e1e2f;
      color: #ddd;
    }
    body.dark-mode #content-wrapper {
      background-color: #2b2b3c;
      color: #ddd;
    }
    body.dark-mode .navbar {
      background-color: #2f2f44;
      color: #ddd;
    }
    body.dark-mode .navbar .nav-link,
    body.dark-mode .profile-text {
      color: #ddd !important;
    }
    body.dark-mode .nav-link:hover,
    body.dark-mode .nav-link.active {
      background-color: rgba(255, 255, 255, 0.15);
    }

    /* ====================
        SIDEBAR STYLES
        ==================== */
    #sidebar-wrapper {
  background: linear-gradient(0deg, 
    red, orange, yellow, green, blue, indigo, violet
  );
  background-size: 100% 400%;
  color: #fff;
  min-height: 100vh;
  width: 250px;
  transition: all 0.5s ease;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
  position: fixed;
  z-index: 1000;

  /* animasi gradasi pelangi */
  animation: rainbowBG 15s linear infinite;
}

@keyframes rainbowBG {
  0%   { background-position: 50% 100%; }
  50%  { background-position: 50% 0%; }
  100% { background-position: 50% 100%; }
}


    .sidebar-brand {
      padding: 1.5rem 1rem;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar-brand h4 {
      font-weight: 700;
      margin: 0 0 0 0.5rem;
      text-transform: uppercase;
      font-size: 1.25rem;
      transition: all 0.5s ease;
    }

    .sidebar-brand i {
      font-size: 1.5rem;
    }

    .nav-item {
      padding: 0 1rem;
    }

    .nav-link {
      display: flex;
      align-items: center;
      padding: 1rem;
      color: #fff;
      position: relative;
    }
    
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
    }


    .nav-link i {
      margin-right: 0.8rem;
      font-size: 1.2rem;
      width: 20px;
    }

    /* Ikon dropdown custom */
    .dropdown-arrow {
      margin-left: auto;
      margin-right: -1rem !important; /* ruang dari batas kanan sidebar */
      color: #fff;
      transition: transform 0.3s ease; /* animasi rotasi */
    }
    .nav-link[aria-expanded="false"] .dropdown-arrow {
      transform: rotate(0deg); /* ke kanan > */
    }
    .nav-link[aria-expanded="true"] .dropdown-arrow {
      transform: rotate(90deg); /* ke bawah v */
    }

    /* Dropdown menu di sidebar */
    .sidebar-nav .dropdown-menu {
      background-color: #3b60c4;
      border: none;
      padding: 0;
      margin-top: 0;
      width: 100%;
      position: static !important;
      transform: none !important;
    }

    .sidebar-nav .dropdown-menu .dropdown-item {
      color: #fff;
      padding: 0.75rem 1rem 0.75rem 3.2rem;
      background-color: transparent;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
    }

    .sidebar-nav .dropdown-menu .dropdown-item i {
      margin-right: 0.75rem;
      width: 20px;
    }
    
    .sidebar-nav .dropdown-menu .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    /* Ganti warna saat aktif di dropdown item */
    .sidebar-nav .dropdown-menu .dropdown-item.active {
        background-color: rgba(255, 255, 255, 0.2); 
        font-weight: bold;
    }


    /* ====================
        CONTENT & NAVBAR
        ==================== */
    #content-wrapper {
      flex-grow: 1;
      margin-left: 250px;
      background-color: #f4f6f9;
      min-height: 100vh;
      transition: margin-left 0.5s ease;
    }

    .navbar {
      background-color: #fff;
      padding: 0.75rem 2rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }

    .navbar-custom {
      padding-left: 1rem;
      padding-right: 2rem;
      justify-content: space-between;
    }

    .navbar-nav .nav-item .nav-link {
      color: #555;
      padding: 0;
      background: none;
      display: flex;
      align-items: center;
    }

    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .main-content {
      padding: 2rem;
    }

    #sidebarToggle {
      background: none;
      border: none;
      color: #4e73df;
      font-size: 1.5rem;
      cursor: pointer;
    }

    .profile-text {
      font-size: 1.1rem;
      font-weight: 500;
    }

    .profile-icon {
      font-size: 2.25rem !important;
      cursor: pointer;
    }

    /* Dark Mode Toggle Button */
    .dark-toggle {
        background: none;
        border: none;
        color: #555;
        font-size: 1.25rem;
        cursor: pointer;
        margin-right: 1.5rem;
        transition: color 0.2s;
    }
    .dark-toggle:hover {
        color: #4e73df;
    }
    body.dark-mode .dark-toggle {
        color: #ddd;
    }
    body.dark-mode .dark-toggle:hover {
        color: #fff;
    }


    /* ====================
        TOGGLE STYLES
        ==================== */
    #wrapper.toggled #sidebar-wrapper {
      width: 70px;
    }
    #wrapper.toggled #content-wrapper {
      margin-left: 70px;
    }
    #wrapper.toggled .sidebar-brand h4,
    #wrapper.toggled .sidebar-nav .nav-link span {
      display: none;
    }
    #wrapper.toggled .sidebar-nav .dropdown-menu {
      /* Harus di-toggle via JS untuk mode toggled/icon-only */
      display: none !important; 
    }
    #wrapper.toggled .sidebar-brand {
      justify-content: center;
    }
    #wrapper.toggled .nav-link i {
      margin: 0 auto;
    }
    #wrapper.toggled .dropdown-arrow {
      display: none;
    }
    #wrapper.toggled .nav-item {
        padding: 0 5px; /* Kurangi padding saat di-toggle */
    }
    #wrapper.toggled .nav-link {
        justify-content: center;
        padding: 1rem 0;
    }


    /* ====================
        RESPONSIVE
        ==================== */
    @media (max-width: 768px) {
      #sidebarToggle {
        display: block;
      }
      #sidebar-wrapper {
        margin-left: -250px;
      }
      #content-wrapper {
        margin-left: 0;
      }
      #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
      }
      #wrapper.toggled #content-wrapper {
        margin-left: 250px;
      }
      /* Nonaktifkan mode icon-only saat tampilan kecil */
      #wrapper.toggled .sidebar-nav .nav-link span {
        display: inline;
      }
      #wrapper.toggled #sidebar-wrapper {
        width: 250px; 
      }
      #wrapper.toggled #content-wrapper {
        margin-left: 250px;
      }
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <div id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#" class="text-white text-decoration-none d-flex align-items-center">
          <i class="fas fa-cogs"></i>
          <h4>Panel Admin</h4>
        </a>
      </div>

      <ul class="nav flex-column sidebar-nav mt-3">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
          </a>
        </li>

        @auth
          {{-- ====================================== --}}
          {{-- BLOK UNTUK ROLE ADMIN & SUPER ADMIN --}}
          {{-- Dianggap untuk semua staf di Admin Panel (kecuali Super Admin Khusus) --}}
          @if(in_array(Auth::user()->role, ['admin', 'super admin']))
          
            {{-- Manajemen Job --}}
            <li class="nav-item">
                {{-- Gunakan route yang sudah ada --}}
                <a class="nav-link {{ request()->routeIs('admin.job_listings.*') ? 'active' : '' }}" 
                   href="{{ route('admin.job_listings.index') }}">
                   <i class="fas fa-briefcase"></i> <span>Manajemen Lowongan</span>
                </a>
            </li>

            {{-- Manajemen Pelamar --}}
            <li class="nav-item">
                {{-- Anda perlu membuat route ini: admin.applicants.index --}}
                <a class="nav-link {{ request()->routeIs('admin.applicants.*') ? 'active' : '' }}" 
                   href="{{ route('admin.applicants.index') }}">
                   <i class="fas fa-user-tie"></i> <span>Manajemen Pelamar</span>
                </a>
            </li>

            {{-- Manajemen Jadwal --}}
            <li class="nav-item">
                {{-- Anda perlu membuat route ini: admin.schedules.index --}}
                <a class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}" 
                   href="{{ route('admin.schedules.index') }}">
                   <i class="fas fa-calendar-alt"></i> <span>Manajemen Jadwal</span>
                </a>
            </li>

            {{-- Laporan --}}
            <li class="nav-item">
                {{-- Anda perlu membuat route ini: admin.reports.index --}}
                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                   href="{{ route('admin.reports.index') }}">
                   <i class="fas fa-chart-bar"></i> <span>Laporan & Analitik</span>
                </a>
            </li>
          @endif
          {{-- ====================================== --}}
          

          {{-- ====================================== --}}
          {{-- BLOK KHUSUS UNTUK ROLE SUPER ADMIN --}}
          @if(Auth::user()->role === 'super admin')
            
            {{-- Manajemen User --}}
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users-cog"></i> <span>Manajemen User</span>
              </a>
            </li>

            {{-- Pengaturan (Dropdown) --}}
            <li class="nav-item dropdown">
              {{-- Pastikan data-bs-target menunjuk ke id collapse --}}
              <a class="nav-link d-flex collapsed" href="#pengaturanCollapse" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.lokasi.*') ? 'true' : 'false' }}" aria-controls="pengaturanCollapse">
                <i class="fas fa-cog"></i> <span>Pengaturan</span>
                <i class="fas fa-chevron-right dropdown-arrow"></i>
              </a>
              <ul class="dropdown-menu collapse {{ request()->routeIs('admin.lokasi.*') ? 'show' : '' }}" id="pengaturanCollapse">
                <li>
                  <a class="dropdown-item {{ request()->routeIs('admin.lokasi.*') ? 'active' : '' }}" href="{{ route('admin.lokasi.index') }}">
                    <i class="fas fa-map-marker-alt"></i> Manajemen Lokasi
                  </a>
                </li>
              </ul>
            </li>
          @endif
          {{-- ====================================== --}}
          
        @endauth

        <li class="nav-item mt-5">
          <a class="nav-link" href="{{ route('logout') }}" 
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
    <div id="content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <button id="sidebarToggle" class="btn btn-link rounded-circle me-3">
          <i class="fa fa-bars"></i>
        </button>
        {{-- Mengambil judul halaman dari @yield('title') --}}
        <h3 class="page-title">@yield('title', 'masih pusing')</h3>

        <ul class="navbar-nav ms-auto">
          @auth
            <button id="darkModeToggle" class="dark-toggle">
              <i class="fas fa-moon"></i>
            </button>
            <li class="nav-item dropdown no-arrow">
    <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!-- Nama & Role -->
        <div class="d-none d-lg-flex flex-column text-start me-2">
            <span class="fw-bold">{{ Auth::user()->name }}</span>
            <span class="small text-warning">{{ strtoupper(Auth::user()->role) }}</span>
        </div>
        <!-- Icon User -->
        <i class="fas fa-user-circle text-primary profile-icon fs-3"></i>
    </a>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
            Lihat Profil
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form-dropdown').submit();">
            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
            Logout
        </a>
        <form id="logout-form-dropdown" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>

          @endauth
        </ul>
      </nav>
      <div class="main-content">
        @yield('content')
      </div>
    </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarToggle = document.getElementById('sidebarToggle');
      const darkToggle = document.getElementById('darkModeToggle');
      const wrapper = document.getElementById('wrapper');
      const body = document.body;

      // Sidebar toggle
      sidebarToggle.addEventListener('click', function () {
        wrapper.classList.toggle('toggled');
        // Saat ditoggle ke mode icon-only, pastikan dropdown ditutup
        if (wrapper.classList.contains('toggled')) {
            const openDropdown = document.querySelector('.sidebar-nav .dropdown-menu.show');
            if (openDropdown) {
                // Collapse the open dropdown
                new bootstrap.Collapse(openDropdown, { toggle: false }).hide();
            }
        }
      });
      
      // Mengatasi masalah dropdown saat di-toggle (khusus untuk mode sidebar icon-only)
      const sidebarLinks = document.querySelectorAll('#sidebar-wrapper .nav-link');
      sidebarLinks.forEach(link => {
          link.addEventListener('click', function() {
              if (wrapper.classList.contains('toggled') && this.classList.contains('collapsed')) {
                  // Jika di mode icon-only dan mengklik dropdown, jangan lakukan apa-apa (biarkan Bootstrap yang menangani)
              } else if (wrapper.classList.contains('toggled') && !this.classList.contains('collapsed')) {
                  // Jika di mode icon-only dan menutup dropdown, pastikan tidak ada aksi tambahan
              } else {
                  // Perilaku normal di mode sidebar penuh
              }
          });
      });

      // Dark mode toggle
      darkToggle.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        const icon = darkToggle.querySelector('i');
        if (body.classList.contains('dark-mode')) {
          icon.classList.replace('fa-moon', 'fa-sun');
          localStorage.setItem('theme', 'dark');
        } else {
          icon.classList.replace('fa-sun', 'fa-moon');
          localStorage.setItem('theme', 'light');
        }
      });

      // Load saved theme
      if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        // Pastikan darkToggle ada sebelum diakses
        if (darkToggle) {
             darkToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
        }
      }
    });
  </script>
</body>
</html>