<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Kampus/Sekolah | InotalHub</title>

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
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-university"></i> Informasi Kampus/Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama Kampus/Sekolah:</strong><br>{{ Auth::guard('campus')->user()->nama_kampus }}</p>
                                <p><strong>Email:</strong><br>{{ Auth::guard('campus')->user()->email }}</p>
                                <p><strong>Jabatan:</strong><br>{{ Auth::guard('campus')->user()->jabatan }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Provinsi:</strong><br>{{ Auth::guard('campus')->user()->provinsi }}</p>
                                <p><strong>Kota:</strong><br>{{ Auth::guard('campus')->user()->kota }}</p>
                                <p><strong>Jenis Institusi:</strong><br>{{ Auth::guard('campus')->user()->jenis_institusi }}</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p><strong>Alamat Lengkap:</strong><br>{{ Auth::guard('campus')->user()->alamat_lengkap }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>