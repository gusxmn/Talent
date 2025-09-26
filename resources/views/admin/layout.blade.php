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
        }

        #wrapper {
            display: flex;
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
            margin: 0;
            text-transform: uppercase;
            font-size: 1.25rem;
            margin-left: 0.5rem;
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
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            opacity: 1;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .nav-link i {
            margin-right: 0.8rem;
            font-size: 1.2rem;
            width: 20px;
        }

        /* ====================
           CONTENT & NAVBAR STYLES
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
            transition: color 0.3s;
            padding: 0;
            border-radius: 0;
            background: none;
            display: flex;
            align-items: center;
        }

        .navbar-nav .nav-item .nav-link:hover {
            opacity: 1;
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
           TOGGLE FUNCTIONALITY STYLES
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

        #wrapper.toggled .sidebar-brand {
            justify-content: center;
        }

        #wrapper.toggled .nav-link i {
            margin-right: 0;
            margin-left: auto;
            margin-right: auto;
        }

        /* ====================
           MEDIA QUERIES (RESPONSIVE)
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
                    <a class="nav-link {{ request()->routeIs('admin.setting') ? 'active' : '' }}" href="{{ route('admin.setting') }}">
                        <i class="fas fa-cog"></i> <span>Pengaturan</span>
                    </a>
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
        <div id="content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                <button id="sidebarToggle" class="btn btn-link rounded-circle me-3">
                    <i class="fa fa-bars"></i>
                </button>

                <ul class="navbar-nav ms-auto">
                    @auth
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
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                Logout
                            </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const wrapper = document.getElementById('wrapper');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    wrapper.classList.toggle('toggled');
                });
            }
        });
    </script>
</body>
</html>