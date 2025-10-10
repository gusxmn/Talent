<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin</title>

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
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    #wrapper {
      display: flex;
      min-height: 100vh;
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
      transition: all 0.3s ease;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      position: fixed;
      z-index: 1000;
      animation: rainbowBG 15s linear infinite;
      left: 0;
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
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 120px;
    }

    .sidebar-brand img {
      width: 100px;
      height: auto;
  object-fit: contain;
  margin-bottom: 0; /* hindari jarak vertikal kalau sejajar horizontal */
}


    .sidebar-brand h5 {
      font-weight: 700;
      margin: 0;
      text-transform: uppercase;
      font-size: 1.1rem;
      transition: all 0.5s ease;
    }

    .sidebar-nav {
      height: calc(100vh - 120px);
      overflow-y: auto;
      padding-bottom: 2rem;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
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
      transition: all 0.3s ease;
    }
    
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        transform: translateX(5px);
    }

    .nav-link i {
      margin-right: 0.8rem;
      font-size: 1.2rem;
      width: 20px;
      text-align: center;
    }

    /* Ikon dropdown custom */
    .dropdown-arrow {
      margin-left: auto;
      color: #fff;
      transition: transform 0.3s ease;
      font-size: 0.8rem;
    }
    .nav-link[aria-expanded="false"] .dropdown-arrow {
      transform: rotate(0deg);
    }
    .nav-link[aria-expanded="true"] .dropdown-arrow {
      transform: rotate(90deg);
    }

    /* Dropdown menu di sidebar */
    .sidebar-nav .dropdown-menu {
      background-color: rgba(59, 96, 196, 0.9);
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
      transition: all 0.3s ease;
    }

    .sidebar-nav .dropdown-menu .dropdown-item i {
      margin-right: 0.75rem;
      width: 20px;
    }
    
    .sidebar-nav .dropdown-menu .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }
    
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
      transition: all 0.3s ease;
      width: calc(100% - 250px);
    }

    .navbar {
      background-color: #fff;
      padding: 0.75rem 2rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .navbar-custom {
      padding-left: 1rem;
      padding-right: 2rem;
    }

    .navbar-nav {
      display: flex;
      align-items: center;
      flex-direction: row;
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
      min-height: calc(100vh - 80px);
    }

    #sidebarToggle {
      background: none;
      border: none;
      color: #4e73df;
      font-size: 1.5rem;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    #sidebarToggle:hover {
      transform: scale(1.1);
    }

    .profile-text {
      font-size: 1.1rem;
      font-weight: 500;
    }

    .profile-icon {
      font-size: 2.25rem !important;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .profile-icon:hover {
      transform: scale(1.1);
    }

    /* Dark Mode Toggle Button */
    .dark-toggle {
        background: none;
        border: none;
        color: #555;
        font-size: 1.25rem;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 50%;
    }
    .dark-toggle:hover {
        color: #4e73df;
        background-color: rgba(78, 115, 223, 0.1);
    }
    body.dark-mode .dark-toggle {
        color: #ddd;
    }
    body.dark-mode .dark-toggle:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Notification Button */
    .notification-btn {
        background: none;
        border: none;
        color: #555;
        font-size: 1.25rem;
        cursor: pointer;
        margin-right: 1rem;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 50%;
        position: relative;
    }
    .notification-btn:hover {
        color: #4e73df;
        background-color: rgba(78, 115, 223, 0.1);
    }
    body.dark-mode .notification-btn {
        color: #ddd;
    }
    body.dark-mode .notification-btn:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #e74c3c;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ====================
        TOGGLE STYLES
        ==================== */
    #wrapper.toggled #sidebar-wrapper {
      width: 70px;
    }
    #wrapper.toggled #content-wrapper {
      margin-left: 70px;
      width: calc(100% - 70px);
    }

    #wrapper.fully-closed #sidebar-wrapper {
      width: 0;
      transform: translateX(-100%);
    }
    #wrapper.fully-closed #content-wrapper {
      margin-left: 0;
      width: 100%;
    }

    #wrapper.toggled .sidebar-brand h5,
    #wrapper.toggled .sidebar-nav .nav-link span,
    #wrapper.toggled .dropdown-arrow {
      display: none;
    }
    #wrapper.toggled .sidebar-nav .dropdown-menu {
      display: none !important; 
    }
    #wrapper.toggled .sidebar-brand {
      justify-content: center;
      padding: 1rem 0;
    }
    #wrapper.toggled .nav-link i {
      margin: 0 auto;
    }
    #wrapper.toggled .nav-item {
        padding: 0 5px;
    }
    #wrapper.toggled .nav-link {
        justify-content: center;
        padding: 1rem 0;
    }

    #wrapper.fully-closed .sidebar-brand,
    #wrapper.fully-closed .sidebar-nav {
      opacity: 0;
      visibility: hidden;
    }

    /* ====================
        RESPONSIVE
        ==================== */
    @media (max-width: 768px) {
      #sidebar-wrapper {
        width: 250px;
        transform: translateX(-100%);
      }
      
      #content-wrapper {
        margin-left: 0;
        width: 100%;
      }
      
      #wrapper.toggled #sidebar-wrapper {
        transform: translateX(0);
        width: 250px;
      }
      
      #wrapper.toggled #content-wrapper {
        margin-left: 0;
        width: 100%;
      }
      
      #wrapper.fully-closed #sidebar-wrapper {
        transform: translateX(-100%);
      }

      .navbar {
        padding: 0.75rem 1rem;
      }
      
      .navbar-custom {
        padding-left: 0.5rem;
        padding-right: 1rem;
      }
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#" class="text-white text-decoration-none d-flex flex-column align-items-center">
          <img src="{{ asset('images/inotal.png') }}" alt="Inotal Logo">
          <div class="brand-text">
            <h5>Panel Admin</h5>
          </div>
        </a>
      </div>

      <ul class="nav flex-column sidebar-nav mt-3">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
          </a>
        </li>

        @auth
          {{-- BLOK UNTUK ROLE ADMIN & SUPER ADMIN --}}
          @if(in_array(Auth::user()->role, ['admin', 'super admin']))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.job_listings.*') ? 'active' : '' }}" 
                   href="{{ route('admin.job_listings.index') }}">
                   <i class="fas fa-briefcase"></i> <span>Lowongan Kerja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.applicants.*') ? 'active' : '' }}" 
                   href="{{ route('admin.applicants.index') }}">
                   <i class="fas fa-user-tie"></i> <span>Manajemen Pelamar</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}" 
                   href="{{ route('admin.schedules.index') }}">
                   <i class="fas fa-calendar-alt"></i> <span>Manajemen Jadwal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                   href="{{ route('admin.reports.index') }}">
                   <i class="fas fa-chart-bar"></i> <span>Laporan & Analitik</span>
                </a>
            </li>
          @endif

          {{-- BLOK KHUSUS UNTUK ROLE SUPER ADMIN --}}
          @if(Auth::user()->role === 'super admin')
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users-cog"></i> <span>Manajemen User</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.lokasi.index') ? 'active' : '' }}" href="{{ route('admin.lokasi.index') }}">
                <i class="fas fa-map-marker-alt"></i> <span>Manajemen Lokasi</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link d-flex collapsed" href="#pengaturanCollapse" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="pengaturanCollapse">
                <i class="fas fa-cog"></i> <span>Pengaturan</span>
                <i class="fas fa-chevron-right dropdown-arrow"></i>
              </a>
              <div class="collapse" id="pengaturanCollapse">
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#"><i class="fas fa-sliders-h"></i> Pengaturan Umum</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-shield-alt"></i> Keamanan</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-bell"></i> Notifikasi</a>
                </div>
              </div>
            </li>
          @endif
        @endauth

        <li class="nav-item mt-auto">
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

    <!-- Content Wrapper -->
    <div id="content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="d-flex align-items-center">
          <button id="sidebarToggle" class="btn btn-link rounded-circle me-3">
            <i class="fa fa-bars"></i>
          </button>
          <h3 class="page-title mb-0">@yield('title', 'Masih pusing')</h3>
        </div>

        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
          @auth
            <button id="darkModeToggle" class="dark-toggle">
              <i class="fas fa-moon"></i>
            </button>
            
            <button id="notificationToggle" class="notification-btn">
              <i class="fas fa-bell"></i>
              <span class="notification-badge">3</span>
            </button>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-none d-lg-flex flex-column text-start me-2">
                  <span class="fw-bold">{{ Auth::user()->name }}</span>
                  <span class="small text-warning">{{ strtoupper(Auth::user()->role) }}</span>
                </div>
                <i class="fas fa-user-circle text-primary profile-icon"></i>
              </a>
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
      const notificationToggle = document.getElementById('notificationToggle');
      const wrapper = document.getElementById('wrapper');
      const body = document.body;

      // State management untuk sidebar
      let sidebarState = 'open'; // 'open', 'collapsed', 'closed'

      // Sidebar toggle dengan 3 status
      sidebarToggle.addEventListener('click', function () {
        if (sidebarState === 'open') {
          // Buka -> Mode ikon
          wrapper.classList.add('toggled');
          wrapper.classList.remove('fully-closed');
          sidebarState = 'collapsed';
        } else if (sidebarState === 'collapsed') {
          // Mode ikon -> Tutup sepenuhnya
          wrapper.classList.remove('toggled');
          wrapper.classList.add('fully-closed');
          sidebarState = 'closed';
        } else {
          // Tutup -> Buka
          wrapper.classList.remove('fully-closed');
          wrapper.classList.remove('toggled');
          sidebarState = 'open';
        }

        // Tutup dropdown yang terbuka saat men-toggle sidebar
        const openDropdown = document.querySelector('.sidebar-nav .dropdown-menu.show');
        if (openDropdown) {
          const collapseElement = bootstrap.Collapse.getInstance(openDropdown.closest('.collapse'));
          if (collapseElement) {
            collapseElement.hide();
          }
        }
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

      // Notification toggle
      notificationToggle.addEventListener('click', function () {
        // Di sini bisa ditambahkan logika untuk menampilkan notifikasi
        console.log('Notification clicked');
        // Contoh: toggle dropdown notifikasi
        const notificationBadge = this.querySelector('.notification-badge');
        if (notificationBadge) {
          notificationBadge.style.display = 'none';
        }
      });

      // Load saved theme
      if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        if (darkToggle) {
          darkToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
        }
      }

      // Handle responsive behavior
      function handleResponsive() {
        if (window.innerWidth <= 768) {
          // Di mobile, defaultnya sidebar tertutup
          if (!wrapper.classList.contains('toggled') && !wrapper.classList.contains('fully-closed')) {
            wrapper.classList.add('fully-closed');
            sidebarState = 'closed';
          }
        }
      }

      // Initial responsive check
      handleResponsive();

      // Listen for window resize
      window.addEventListener('resize', handleResponsive);

      // Smooth scrolling untuk sidebar
      const sidebarNav = document.querySelector('.sidebar-nav');
      if (sidebarNav) {
        sidebarNav.addEventListener('wheel', function(e) {
          e.preventDefault();
          this.scrollTop += e.deltaY;
        });
      }
    });
  </script>
</body>
</html>