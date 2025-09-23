<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
            <h4 class="mb-4">Panel Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>

                {{-- Menu Setting hanya untuk super admin --}}
                @if(Auth::user()->role === 'super admin')
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.setting') }}" class="nav-link text-white">Setting</a>
                </li>
                @endif

                <li class="nav-item mt-4">
                    <a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Konten -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

</body>
</html>
