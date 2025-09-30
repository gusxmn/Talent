<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
      background-color: #4e73df;
      color: #fff;
      min-height: 100vh;
      width: 250px;
      transition: all 0.5s ease;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      position: fixed;
      z-index: 1000;
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
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Sidebar -->
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
          @if(Auth::user()->role === 'super admin')
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users-cog"></i> <span>Manajemen User</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users-cog"></i> <span>Manajemen job</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link d-flex" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-cog"></i> <span>Pengaturan</span>
                <i class="fas fa-chevron-right dropdown-arrow"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="{{ route('admin.lokasi.index') }}">
                    <i class="fas fa-map-marker-alt"></i> manajemen Lokasi
                  </a>
                </li>
              </ul>
            </li>
          @endif
        @endauth

        <li class="nav-item mt-5">
          <a class="nav-link" href="{{ route('logout') }}">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- End Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <button id="sidebarToggle" class="btn btn-link rounded-circle me-3">
          <i class="fa fa-bars"></i>
        </button>
        <h3 class="page-title">@yield('title', 'PUSING ')</h3>

        <ul class="navbar-nav ms-auto">
          @auth
            <button id="darkModeToggle" class="dark-toggle">
              <i class="fas fa-moon"></i>
            </button>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="me-2 d-none d-lg-inline text-gray-600 profile-text">{{ Auth::user()->name }}</span>
                <i class="fas fa-user-circle text-primary ms-2 profile-icon"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                  Lihat Profil
                </a>
                <div class="dropdown-divider"></div>
              </div>
            </li>
          @endauth
        </ul>
      </nav>
      <!-- End Navbar -->

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
    </div>
    <!-- End Content Wrapper -->
  </div>

  <!-- Scripts -->
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
        darkToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
      }
    });
  </script>
</body>
</html>