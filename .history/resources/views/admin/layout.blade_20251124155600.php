<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel admin next jobz</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ====================
        GLOBAL STYLES
        ==================== */
    :root {
      --sidebar-width: 250px;
      --sidebar-collapsed: 70px;
      --transition-speed: 0.3s;
      --easing: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    * {
      transition: color var(--transition-speed) var(--easing),
                 background-color var(--transition-speed) var(--easing),
                 border-color var(--transition-speed) var(--easing);
    }

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

    /* ====================
        SIDEBAR STYLES - IMPROVED
        ==================== */
    #sidebar-wrapper {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      min-height: 100vh;
      width: var(--sidebar-width);
      transition: all var(--transition-speed) var(--easing);
      box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
      position: fixed;
      z-index: 1000;
      left: 0;
      overflow: hidden;
    }

    .sidebar-brand {
      padding: 1.5rem 1rem;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.15);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 120px;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
    }

    .sidebar-brand img {
      width: 70px;
      height: 70px;
      object-fit: contain;
      margin-bottom: 0.8rem;
      border-radius: 8px;
      /* Remove animation */
      transition: none;
      filter: brightness(1) contrast(1);
    }

    .sidebar-brand h5 {
      font-weight: 600;
      margin: 0;
      font-size: 1rem;
      letter-spacing: 0.5px;
    }

    .sidebar-nav {
      height: calc(100vh - 120px);
      overflow-y: auto;
      overflow-x: hidden;
      padding: 1rem 0;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 2px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.5);
    }

    .nav-item {
      padding: 0 0.8rem;
      margin-bottom: 0.3rem;
    }

    .nav-link {
      display: flex;
      align-items: center;
      padding: 0.8rem 1rem;
      color: rgba(255, 255, 255, 0.9);
      position: relative;
      transition: all var(--transition-speed) var(--easing);
      border-radius: 6px;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 400;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 3px;
      background: #fff;
      transform: scaleY(0);
      transition: transform var(--transition-speed) var(--easing);
      border-radius: 0 2px 2px 0;
    }

    .nav-link.active {
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
      font-weight: 500;
    }

    .nav-link.active::before {
      transform: scaleY(1);
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
      transform: translateX(3px);
    }

    .nav-link i {
      margin-right: 0.8rem;
      font-size: 1.1rem;
      width: 20px;
      text-align: center;
      transition: all var(--transition-speed) var(--easing);
    }

    /* Ikon dropdown custom */
    .dropdown-arrow {
      margin-left: auto;
      color: rgba(255, 255, 255, 0.7);
      transition: transform var(--transition-speed) var(--easing);
      font-size: 0.7rem;
    }

    .nav-link[aria-expanded="true"] .dropdown-arrow {
      transform: rotate(90deg);
      color: #fff;
    }

    /* PERBAIKAN KHUSUS: Reference Menu Styles - LEBIH RAPIH DAN PRESISI */
    .reference-menu {
      background-color: rgba(0, 0, 0, 0.1);
      border-radius: 6px;
      margin: 0.5rem 0;
      overflow: hidden;
    }

    .reference-submenu {
      list-style: none;
      padding: 0;
      margin: 0;
      max-height: 0;
      overflow: hidden;
      transition: max-height var(--transition-speed) var(--easing);
    }

    .reference-submenu.show {
      max-height: 300px;
    }

    .reference-item {
      padding: 0;
      opacity: 0;
      transform: translateY(-5px);
      transition: all var(--transition-speed) var(--easing);
    }

    .reference-submenu.show .reference-item {
      opacity: 1;
      transform: translateY(0);
    }

    /* Stagger animation untuk reference items */
    .reference-submenu.show .reference-item:nth-child(1) { transition-delay: 0.03s; }
    .reference-submenu.show .reference-item:nth-child(2) { transition-delay: 0.06s; }
    .reference-submenu.show .reference-item:nth-child(3) { transition-delay: 0.09s; }
    .reference-submenu.show .reference-item:nth-child(4) { transition-delay: 0.12s; }

    .reference-link {
      color: rgba(255, 255, 255, 0.8);
      padding: 0.65rem 1rem 0.65rem 3rem;
      display: flex;
      align-items: center;
      text-decoration: none;
      transition: all var(--transition-speed) var(--easing);
      border-left: 2px solid transparent;
      font-size: 0.82rem;
      position: relative;
      min-height: 40px;
    }

    .reference-link::before {
      content: '';
      position: absolute;
      left: 1.8rem;
      top: 50%;
      transform: translateY(-50%);
      width: 5px;
      height: 5px;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      transition: all var(--transition-speed) var(--easing);
    }

    /* PERBAIKAN DETAIL: Icon reference submenu yang sangat rapih */
    .reference-link i {
      margin-right: 0.75rem;
      font-size: 0.8rem;
      width: 16px;
      text-align: center;
      transition: all var(--transition-speed) var(--easing);
      opacity: 0.8;
      line-height: 1;
      position: relative;
      top: 0;
    }

    .reference-link:hover, 
    .reference-link.active {
      color: #fff;
      background-color: rgba(255, 255, 255, 0.12);
      border-left-color: #fff;
      padding-left: 3.1rem;
    }

    .reference-link:hover::before, 
    .reference-link.active::before {
      background: #fff;
      transform: translateY(-50%) scale(1.3);
    }

    .reference-link:hover i,
    .reference-link.active i {
      opacity: 1;
      transform: scale(1.08);
      color: #fff;
    }

    .reference-link.active {
      font-weight: 500;
      background-color: rgba(255, 255, 255, 0.15);
    }

    /* Badge styles */
    .badge {
      font-size: 0.7rem;
      padding: 0.2rem 0.4rem;
      margin-left: auto;
    }

    /* ====================
        CONTENT & NAVBAR - IMPROVED
        ==================== */
    #content-wrapper {
      flex-grow: 1;
      margin-left: var(--sidebar-width);
      background-color: #f4f6f9;
      min-height: 100vh;
      transition: all var(--transition-speed) var(--easing);
      width: calc(100% - var(--sidebar-width));
    }

    .navbar {
      background-color: #fff;
      padding: 0.8rem 2rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 999;
      transition: all var(--transition-speed) var(--easing);
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

    .main-content {
      padding: 2rem;
      min-height: calc(100vh - 80px);
    }

    /* PERBAIKAN KHUSUS: Sidebar Toggle Button yang lebih rapih */
    #sidebarToggle {
      background: rgba(78, 115, 223, 0.1);
      border: none;
      color: #4e73df;
      font-size: 1.1rem;
      cursor: pointer;
      transition: all var(--transition-speed) var(--easing);
      width: 44px;
      height: 44px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
      position: relative;
      padding: 0;
    }

    #sidebarToggle:hover {
      background: rgba(78, 115, 223, 0.2);
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }

    #sidebarToggle i {
      transition: transform var(--transition-speed) var(--easing);
      font-size: 1.15rem;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      line-height: 1;
    }

    .page-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #2d3748;
      margin: 0;
    }

    body.dark-mode .page-title {
      color: #ddd;
    }

    .profile-text {
      font-size: 1rem;
      font-weight: 500;
    }

    .profile-icon {
      font-size: 2rem !important;
      cursor: pointer;
      transition: all var(--transition-speed) var(--easing);
      color: #4e73df;
    }

    .profile-icon:hover {
      transform: scale(1.05);
    }

    .dark-toggle {
        background: rgba(0, 0, 0, 0.05);
        border: none;
        color: #555;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all var(--transition-speed) var(--easing);
        padding: 0;
        border-radius: 10px;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .dark-toggle:hover {
        color: #4e73df;
        background-color: rgba(78, 115, 223, 0.1);
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }

    body.dark-mode .dark-toggle {
        color: #ddd;
        background: rgba(255, 255, 255, 0.1);
    }

    body.dark-mode .dark-toggle:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.2);
    }

    .notification-btn {
        background: rgba(0, 0, 0, 0.05);
        border: none;
        color: #555;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all var(--transition-speed) var(--easing);
        padding: 0;
        border-radius: 10px;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .notification-btn:hover {
        color: #ec650a;
        background-color: rgba(236, 101, 10, 0.1);
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }

    body.dark-mode .notification-btn {
        color: #ddd;
        background: rgba(255, 255, 255, 0.1);
    }

    body.dark-mode .notification-btn:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.2);
    }

    .notification-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 2px 6px rgba(231, 76, 60, 0.4);
    }

    /* Dropdown Styles */
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        margin-top: 0.5rem;
    }

    .notification-dropdown {
        min-width: 320px;
        max-width: 350px;
        padding: 0;
    }

    .notification-list {
        max-height: 250px;
        overflow-y: auto;
    }

    /* ====================
        TOGGLE STYLES - IMPROVED
        ==================== */
    #wrapper.toggled #sidebar-wrapper {
      width: var(--sidebar-collapsed);
    }
    
    #wrapper.toggled #content-wrapper {
      margin-left: var(--sidebar-collapsed);
      width: calc(100% - var(--sidebar-collapsed));
    }

    #wrapper.fully-closed #sidebar-wrapper {
      width: 0;
      transform: translateX(-100%);
    }
    
    #wrapper.fully-closed #content-wrapper {
      margin-left: 0;
      width: 100%;
    }

    /* Improved collapsed state */
    #wrapper.toggled .sidebar-brand h5,
    #wrapper.toggled .sidebar-nav .nav-link span,
    #wrapper.toggled .dropdown-arrow,
    #wrapper.toggled .reference-link span,
    #wrapper.toggled .badge {
      opacity: 0;
      visibility: hidden;
      width: 0;
      height: 0;
      margin: 0;
      padding: 0;
    }
    
    #wrapper.toggled .reference-submenu {
      display: none !important;
    }
    
    #wrapper.toggled .sidebar-brand {
      justify-content: center;
      padding: 1rem 0;
      height: 80px;
    }
    
    #wrapper.toggled .sidebar-brand img {
      width: 40px;
      height: 40px;
      margin-bottom: 0;
    }
    
    #wrapper.toggled .nav-link i {
      margin: 0 auto;
      font-size: 1.2rem;
    }
    
    #wrapper.toggled .nav-item {
        padding: 0 0.5rem;
    }
    
    #wrapper.toggled .nav-link {
        justify-content: center;
        padding: 0.8rem 0;
        border-radius: 6px;
    }

    #wrapper.toggled .reference-link {
        padding: 0.7rem 0;
        justify-content: center;
    }

    #wrapper.toggled .reference-link i {
        margin: 0;
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
      :root {
        --sidebar-width: 250px;
        --sidebar-collapsed: 0px;
      }

      #sidebar-wrapper {
        width: var(--sidebar-width);
        transform: translateX(-100%);
      }
      
      #content-wrapper {
        margin-left: 0;
        width: 100%;
      }
      
      #wrapper.toggled #sidebar-wrapper {
        transform: translateX(0);
        width: var(--sidebar-width);
      }
      
      #wrapper.toggled #content-wrapper {
        margin-left: 0;
        width: 100%;
      }
      
      #wrapper.fully-closed #sidebar-wrapper {
        transform: translateX(-100%);
      }

      .navbar {
        padding: 0.8rem 1rem;
      }
      
      .navbar-custom {
        padding-left: 0.5rem;
        padding-right: 1rem;
      }

      .notification-dropdown {
        min-width: 280px;
        max-width: 300px;
        position: fixed;
        right: 1rem;
        left: auto;
      }

      .main-content {
        padding: 1.5rem;
      }
    }

    /* Animation for page transitions */
    .main-content > * {
      animation: fadeInUp 0.5s var(--easing) both;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(15px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* PERBAIKAN: Text admin tidak hilang - lebih baik */
    .user-info {
      display: flex;
      flex-direction: column;
      text-align: right;
      margin-right: 12px;
    }

    .user-name {
      font-weight: 600;
      color: #2d3748;
      font-size: 0.95rem;
      line-height: 1.2;
    }

    .user-role {
      font-size: 0.75rem;
      color: #ec650a;
      font-weight: 500;
      line-height: 1.2;
    }

    body.dark-mode .user-name {
      color: #ddd;
    }

    /* PERBAIKAN: Icon sejajar dan rapih - alignment sempurna */
    .icon-group {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin-right: 1.5rem;
    }

    /* PERBAIKAN: Sidebar toggle lebih rapih dan sejajar */
    .sidebar-toggle-container {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    /* PERBAIKAN: Navbar items alignment yang lebih baik */
    .navbar-right-section {
      display: flex;
      align-items: center;
      gap: 0;
    }

    /* PERBAIKAN: Menghilangkan margin yang tidak perlu */
    .nav-item.dropdown.no-arrow {
      margin: 0;
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#" class="text-white text-decoration-none d-flex flex-column align-items-center">
          <img src="{{ asset('images/inotal.png') }}" alt="INOTAL Logo">
          <div class="brand-text">
            <h5>PANEL ADMIN</h5>
          </div>
        </a>
      </div>

      <ul class="nav flex-column sidebar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
          </a>
        </li>

        @auth
        {{-- BLOK KHUSUS UNTUK ROLE WAWANCARA --}}
        @if(Auth::user()->role === 'wawancara')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('wawancara.jadwal.index') ? 'active' : '' }}" 
                   href="{{ route('wawancara.jadwal.index') }}">
                    <i class="fas fa-calendar-alt"></i> <span>Lihat Jadwal</span>
                </a>
            </li>
        @endif
        
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
                <a class="nav-link {{ request()->routeIs('admin.calendar.*') ? 'active' : '' }}" 
                   href="{{ route('admin.calendar.index') }}">
                   <i class="fas fa-calendar-alt"></i> <span>Manajemen Jadwal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                   href="{{ route('admin.reports.index') }}">
                   <i class="fas fa-chart-bar"></i> <span>Laporan</span>
                </a>
            </li>

            <!-- PERBAIKAN DETAIL: Reference Menu yang sangat rapih -->
            <li class="nav-item">
                <div class="reference-menu">
                    <a class="nav-link {{ request()->routeIs('admin.reference.*') ? 'active' : '' }}" 
                       id="referenceToggle" role="button">
                       <i class="fas fa-book"></i> <span>Reference</span>
                       <i class="fas fa-chevron-right dropdown-arrow ms-auto"></i>
                    </a>
                    
                    <ul class="reference-submenu {{ request()->routeIs('admin.reference.*') ? 'show' : '' }}" 
                        id="referenceSubmenu">
                        <li class="reference-item">
                            <a class="reference-link {{ request()->routeIs('admin.reference.provinsi.*') ? 'active' : '' }}" 
                               href="{{ route('admin.reference.provinsi.index') }}">
                                <i class="fas fa-map-marker-alt fa-fw"></i> <span>Provinsi</span>
                            </a>
                        </li>
                        <li class="reference-item">
                            <a class="reference-link {{ request()->routeIs('admin.reference.kabupaten.*') ? 'active' : '' }}" 
                               href="{{ route('admin.reference.kabupaten.index') }}">
                                <i class="fas fa-city fa-fw"></i> <span>Kab/Kota</span>
                            </a>
                        </li>
                        <li class="reference-item">
                            <a class="reference-link {{ request()->routeIs('admin.reference.kecamatan.*') ? 'active' : '' }}" 
                               href="{{ route('admin.reference.kecamatan.index') }}">
                                <i class="fas fa-map fa-fw"></i> <span>Kecamatan</span>
                            </a>
                        </li>
                        <li class="reference-item">
                            <a class="reference-link {{ request()->routeIs('admin.reference.desa.*') ? 'active' : '' }}" 
                               href="{{ route('admin.reference.desa.index') }}">
                                <i class="fas fa-home fa-fw"></i> <span>Desa/Kelurahan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.notif.*') ? 'active' : '' }}" 
                   href="{{ route('admin.notif.index') }}">
                   <i class="fas fa-bell"></i> <span>Notifikasi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.magang.*') ? 'active' : '' }}" 
                   href="{{ route('admin.magang.index') }}">
                   <i class="fas fa-briefcase"></i> <span>Lowongan magang</span>
                </a>
            </li>

            {{-- Navigasi untuk Pesan Masuk --}}
            <li class="nav-item">
                @php
                    try {
                        $countNewMessages = \App\Models\ContactMessage::whereNull('read_at')->count();
                    } catch (\Throwable $e) {
                        $countNewMessages = 0;
                    }
                @endphp

                <a class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}" 
                   href="{{ route('admin.contact-messages.index') }}">
                   <i class="fas fa-envelope"></i> <span>Kontak</span>
                   @if($countNewMessages > 0)
                       <span class="badge bg-danger ms-auto">{{ $countNewMessages }}</span>
                   @endif
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

            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}" href="{{ route('admin.companies.index') }}">
                <i class="fas fa-building"></i> <span>Perusahaan</span>
              </a>
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
        <div class="sidebar-toggle-container">
          <button id="sidebarToggle" class="btn btn-link">
            <i class="fa fa-bars"></i>
          </button>
          <h3 class="page-title">@yield('title', 'Dashboard')</h3>
        </div>

        <div class="navbar-right-section">
          @auth
            <div class="icon-group">
              <button id="darkModeToggle" class="dark-toggle">
                <i class="fas fa-moon"></i>
              </button>
              
              <!-- Notification Dropdown -->
              <button id="notificationToggle" class="notification-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="notification-badge" style="display: none;">0</span>
              </button>
              
              <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in notification-dropdown" 
                   id="notificationDropdown" aria-labelledby="notificationToggle">
                <div class="dropdown-header d-flex justify-content-between align-items-center">
                  <strong>Notifikasi</strong>
                  <a href="{{ route('admin.notif.my') }}" class="small text-primary">Lihat Semua</a>
                </div>
                <div class="dropdown-divider"></div>
                <div class="notification-list">
                  <div class="text-center p-3">
                    <div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 small text-muted">Memuat notifikasi...</p>
                  </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center small text-muted" href="javascript:void(0)" onclick="loadNotifications()">
                  <i class="fas fa-sync-alt me-1"></i> Refresh
                </a>
              </div>
            </div>

            <div class="nav-item dropdown no-arrow">
              <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-info">
                  <span class="user-name">{{ Auth::user()->name }}</span>
                  <span class="user-role">{{ strtoupper(Auth::user()->role) }}</span>
                </div>
                <i class="fas fa-user-circle profile-icon"></i>
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
            </div>
          @endauth
        </div>
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
      const referenceToggle = document.getElementById('referenceToggle');
      const referenceSubmenu = document.getElementById('referenceSubmenu');
      const wrapper = document.getElementById('wrapper');
      const body = document.body;

      // State management untuk sidebar
      let sidebarState = 'open';

      // Sidebar toggle dengan 3 status
      sidebarToggle.addEventListener('click', function () {
        const icon = sidebarToggle.querySelector('i');
        
        if (sidebarState === 'open') {
          // Buka -> Mode ikon
          wrapper.classList.add('toggled');
          wrapper.classList.remove('fully-closed');
          sidebarState = 'collapsed';
          icon.style.transform = 'translate(-50%, -50%) rotate(90deg)';
        } else if (sidebarState === 'collapsed') {
          // Mode ikon -> Tutup sepenuhnya
          wrapper.classList.remove('toggled');
          wrapper.classList.add('fully-closed');
          sidebarState = 'closed';
          icon.style.transform = 'translate(-50%, -50%) rotate(0deg)';
        } else {
          // Tutup -> Buka
          wrapper.classList.remove('fully-closed');
          wrapper.classList.remove('toggled');
          sidebarState = 'open';
          icon.style.transform = 'translate(-50%, -50%) rotate(0deg)';
        }

        // Tutup reference menu saat men-toggle sidebar
        if (referenceSubmenu.classList.contains('show')) {
          referenceSubmenu.classList.remove('show');
          referenceToggle.querySelector('.dropdown-arrow').style.transform = 'rotate(0deg)';
        }
      });

      // Reference Menu Toggle
      referenceToggle.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        const isExpanded = referenceSubmenu.classList.contains('show');
        const arrow = referenceToggle.querySelector('.dropdown-arrow');
        
        if (isExpanded) {
          // Tutup dengan animasi
          referenceSubmenu.classList.remove('show');
          arrow.style.transform = 'rotate(0deg)';
        } else {
          // Buka dengan animasi
          referenceSubmenu.classList.add('show');
          arrow.style.transform = 'rotate(90deg)';
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
          if (!wrapper.classList.contains('toggled') && !wrapper.classList.contains('fully-closed')) {
            wrapper.classList.add('fully-closed');
            sidebarState = 'closed';
          }
        }
      }

      // Initial responsive check
      handleResponsive();
      window.addEventListener('resize', handleResponsive);

      async function loadNotifications() {
        // Load notifications
      }

      window.loadNotifications = loadNotifications;
      setTimeout(loadNotifications, 500);
    });
  </script>
</body>
</html>