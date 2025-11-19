<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengajuan Proposal | InotalHub</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 20px auto;
            max-width: 800px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin: 20px auto;
            max-width: 800px;
        }

        .pengajuan-proposal-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .pengajuan-proposal-title {
            font-size: 3rem;
            font-weight: 700;
            color: #2c2c2c;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .pengajuan-proposal-title {
                font-size: 2.5rem;
            }

        }

    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar_campus')

    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Konten Utama - Lowongan Pekerjaan -->
    <div class="container">
        <div class="pengajuan-proposal-container">
            <div>
                <h1 class="pengajuan-proposal-title">
                    Pengajuan Proposal
                </h1>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



