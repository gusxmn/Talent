<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #1abc9c;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(180deg, var(--secondary-color) 0%, var(--dark-color) 100%);
            color: white;
            min-height: 100vh;
            width: 260px;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .user-info {
            background-color: rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
            display: flex;
            align-items: center;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }
        .user-details h5 {
            margin-bottom: 0;
            font-weight: 600;
        }
        .user-details p {
            margin-bottom: 0;
            font-size: 0.85rem;
            opacity: 0.8;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .nav-link:hover {
            transform: translateX(5px);
        }
        .logout-link {
            color: #ff6b6b !important;
            margin-top: 20px;
        }
        .logout-link:hover {
            background-color: rgba(255,107,107,0.1) !important;
        }
        .content-area {
            padding: 30px;
            background-color: #f8f9fa;
            flex-grow: 1;
        }
        .content-header {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .page-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 5px;
        }
        .breadcrumb {
            margin-bottom: 0;
            background-color: transparent;
            padding: 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                width: 100%;
            }
            .content-area {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-0">
        <div class="sidebar-header">
            <h4 class="mb-0"><i class="fas fa-cogs me-2"></i> Panel Admin</h4>
        </div>

        <!-- Informasi Pengguna -->
        @auth
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-details">
                <h5>{{ Auth::user()->name }}</h5>
                <p>{{ Auth::user()->role }}</p>
            </div>
        </div>
        @endauth

        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            {{-- Menu Setting hanya untuk super admin --}}
            @auth
                @if(Auth::user()->role === 'super admin')
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i> Manajemen User
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting') }}" 
                       class="nav-link {{ request()->routeIs('admin.setting') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                </li>
                @endif
            @endauth

            <li class="nav-item mt-4">
                <a href="{{ route('logout') }}" class="nav-link logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="content-area">
        <!-- Header Konten -->
        <div class="content-header">
            <h3 class="page-title">@yield('title', 'PUSING ')</h3>
            <nav aria-label="breadcrumb">
                @yield('breadcrumb')
            </nav>
        </div>

        <!-- Konten Dinamis -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
