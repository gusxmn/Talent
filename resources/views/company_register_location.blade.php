<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pasang Iklan Lowongan Kerja Gratis | Next Employer</title>

    <link rel="icon" type="image/png" href="{{ asset('1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

    <style>
        body {
            background-color: #f7f9fb;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar {
            font-size: 1rem; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
        }
        .navbar-logo {
            height: 38px;
            width: auto;
        }
        .btn-login {
            border-radius: 6px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: #0d47a1 !important;
            background-color: #fff;
            border: 2px solid #0d47a1;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #0d47a1;
            color: #fff !important;
            border: 2px solid #0d47a1;
        }

        /* === PROGRESS STEP === */
        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            text-align: center;
        }

        .progress-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            right: -50%;
            width: 100%;
            height: 4px;
            background-color: #28a745;
            z-index: 0;
            transition: background-color 0.3s ease;
        }

        .circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #28a745;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            z-index: 1;
            position: relative;
        }

        .progress-label {
            margin-top: 8px;
            font-size: 0.9rem;
            color: #28a745;
            font-weight: 600;
        }

        /* FORM STYLING */
        .company-profile-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 0;
            max-width: 600px;
            margin: 2rem auto;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1.5rem 2rem 1rem 2rem;
            border-bottom: 1px solid #eee;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0;
            color: #333;
        }
        
        .card-body {
            padding: 1.5rem 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: none;
        }
        
        .required-star {
            color: #e53935;
        }
        
        .form-control {
            border-radius: 2px;
            border: 1px solid #999;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        
        .form-control:focus {
            border-color: #333;
            box-shadow: none;
        }

        .custom-select-wrapper {
            position: relative;
        }
        
        .custom-select {
            border-radius: 2px;
            border: 1px solid #999;
            padding: 0.75rem;
            font-size: 0.95rem;
            width: 100%;
            background-color: white;
            appearance: none;
            cursor: pointer;
        }
        
        .custom-select:focus {
            border-color: #333;
            box-shadow: none;
            outline: none;
        }

        .custom-arrow {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            pointer-events: none;
            transition: transform 0.3s ease-in-out;
        }

        .custom-arrow i {
            color: #666;
            font-size: 0.9rem;
            transition: transform 0.3s ease-in-out;
        }

        .custom-select-wrapper.open .custom-arrow i {
            transform: rotate(180deg);
        }
        
        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            width: auto;
            float: right;
            margin-top: 0;
        }
        
        .btn-primary:hover {
            background-color: #0a3a8a;
            border-color: #0a3a8a;
        }
        
        .btn-secondary {
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            margin-right: 10px;
        }
        
        .form-footer::after {
            content: "";
            display: table;
            clear: both;
        }

        .placeholder-option {
            color: #999;
        }

        /* Styling untuk form lokasi */
        .location-row {
            display: flex;
            gap: 1rem;
        }
        
        .location-col {
            flex: 1;
        }
        
        .full-width {
            width: 100%;
        }
        
        .char-counter {
            text-align: right;
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.25rem;
        }

        /* Error styling */
        .alert-danger {
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
            <a href="/" class="navbar-brand d-flex align-items-center py-2">
                <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
            </a>
            <a href="{{ url('/') }}" class="btn-login">Keluar</a>
        </div>
    </nav>

    <!-- === PROGRESS BAR === -->
    <div class="container progress-container">
        <div class="progress-step active">
            <div class="circle">1</div>
            <div class="progress-label">Data Diri</div>
        </div>
        <div class="progress-step active">
            <div class="circle">2</div>
            <div class="progress-label">Data Perusahaan</div>
        </div>
        <div class="progress-step active">
            <div class="circle">3</div>
            <div class="progress-label">Lokasi Perusahaan</div>
        </div>
    </div>

    <!-- Form Lokasi Perusahaan -->
    <div class="container my-5">
        <div class="company-profile-card">
            <div class="card-header">
                <h1 class="card-title">Lokasi Perusahaan</h1>
            </div>
            
            <div class="card-body">
                <!-- Display Session Errors -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Display Validation Errors -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form id="locationForm" action="{{ route('company.register.step3') }}" method="POST">
                    @csrf
                    
                    <!-- Form Lokasi Perusahaan -->
                    <div class="location-row">
                        <div class="location-col">
                            <div class="form-group">
                                <div class="custom-select-wrapper" id="provinsiWrapper">
                                    <select class="custom-select @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" required>
                                        <option value="" selected disabled class="placeholder-option">Pilih Provinsi</option>
                                        <!-- Opsi provinsi akan diisi oleh JavaScript -->
                                    </select>
                                    <div class="custom-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('provinsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="location-col">
                            <div class="form-group">
                                <div class="custom-select-wrapper" id="kotaWrapper">
                                    <select class="custom-select @error('kota') is-invalid @enderror" id="kota" name="kota" required disabled>
                                        <option value="" selected disabled class="placeholder-option">Pilih Kota</option>
                                        <!-- Opsi kota akan diisi oleh JavaScript -->
                                    </select>
                                    <div class="custom-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('kota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" id="alamatLengkap" name="alamat_lengkap" placeholder="Alamat lengkap (gedung & lantai, jalan, kelurahan, kecamatan, dst.)*" rows="3" maxlength="255" required>{{ old('alamat_lengkap') }}</textarea>
                        <div class="char-counter">
                            <span id="charCount">0</span> / 255
                        </div>
                        @error('alamat_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-footer">
                        <a href="{{ route('company.register.cancel') }}" class="btn btn-secondary" onclick="return confirm('Batalkan pendaftaran? Data yang sudah diisi akan hilang.')">
                            Batalkan
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitButton">
                            Buat Perusahaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinsiKota = {
                "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Depok", "Cimahi"],
                "Jawa Tengah": ["Semarang", "Surakarta", "Tegal", "Pekalongan", "Salatiga"],
                "Jawa Timur": ["Surabaya", "Malang", "Kediri", "Madiun", "Blitar"],
                "DKI Jakarta": ["Jakarta Pusat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Barat", "Jakarta Utara"],
                "Banten": ["Serang", "Tangerang", "Cilegon", "Tangerang Selatan"]
            };

            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota');
            const alamatTextarea = document.getElementById('alamatLengkap');
            const charCount = document.getElementById('charCount');
            const submitButton = document.getElementById('submitButton');
            const form = document.getElementById('locationForm');

            // Isi dropdown provinsi
            for (const provinsi in provinsiKota) {
                const option = document.createElement('option');
                option.value = provinsi;
                option.textContent = provinsi;
                // Set selected jika ada data old
                if (provinsi === "{{ old('provinsi') }}") {
                    option.selected = true;
                }
                provinsiSelect.appendChild(option);
            }

            // Isi dropdown kota berdasarkan provinsi yang dipilih
            function isiKota(provinsi) {
                kotaSelect.innerHTML = '<option value="" selected disabled class="placeholder-option">Pilih Kota</option>';
                kotaSelect.disabled = false;

                if (provinsiKota[provinsi]) {
                    provinsiKota[provinsi].forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota;
                        option.textContent = kota;
                        // Set selected jika ada data old
                        if (kota === "{{ old('kota') }}") {
                            option.selected = true;
                        }
                        kotaSelect.appendChild(option);
                    });
                }
            }

            // Trigger perubahan provinsi jika ada data old
            if ("{{ old('provinsi') }}") {
                isiKota("{{ old('provinsi') }}");
            }

            provinsiSelect.addEventListener('change', function() {
                const selectedProvinsi = this.value;
                isiKota(selectedProvinsi);
            });

            // Hitung karakter alamat
            alamatTextarea.addEventListener('input', () => {
                charCount.textContent = alamatTextarea.value.length;
            });

            // Set char count awal jika ada data old
            charCount.textContent = alamatTextarea.value.length;

            // Form submission handling
            form.addEventListener('submit', function(e) {
                const provinsi = provinsiSelect.value;
                const kota = kotaSelect.value;
                const alamat = alamatTextarea.value.trim();

                if (!provinsi || !kota || !alamat) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field sebelum melanjutkan!');
                    return;
                }

                // Show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
            });
        });
    </script>

</body>
</html>