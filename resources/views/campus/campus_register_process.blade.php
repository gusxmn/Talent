<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pasang Iklan Intership Gratis | Talenthub</title>

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
            background-color: #d3d3d3;
            z-index: 0;
            transition: background-color 0.3s ease;
        }

        .progress-step.active:not(:last-child)::after {
            background-color: #28a745;
        }

        .progress-step.active:nth-child(2)::after {
            background-color: #d3d3d3;
        }

        .circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #d3d3d3;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            z-index: 1;
            position: relative;
        }

        .progress-step.active .circle {
            background-color: #28a745;
        }

        .progress-label {
            margin-top: 8px;
            font-size: 0.9rem;
            color: #999;
        }

        .progress-step.active .progress-label {
            color: #28a745;
            font-weight: 600;
        }

        /* FORM STYLING */
        .campus-profile-card {
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
        
        .logo-section {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .logo-square {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            border: 1px dashed #ccc;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .logo-square:hover {
            background-color: #eeeeee;
        }
        
        .logo-square i {
            font-size: 1.5rem;
            color: #888;
            margin-bottom: 0.3rem;
        }
        
        .logo-text {
            font-size: 0.8rem;
            color: #666;
            text-align: center;
        }
        
        .logo-label {
            font-size: 1rem;
            color: #555;
            align-self: center;
        }
        
        .logo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }
        
        .file-input {
            display: none;
        }
        
        .form-group {
            margin-bottom: 1rem;
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

        hr {
            margin: 1rem 0;
            border-top: 1px solid #eee;
        }
        
        .btn-primary {
            background-color: #00b14f;
            border-color: #00b14f;
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            width: auto;
            float: right;
            margin-top: 0;
        }
        
        .btn-primary:hover {
            background-color: #009944;
            border-color: #009944;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            width: auto;
            margin-top: 0;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .form-footer::after {
            content: "";
            display: table;
            clear: both;
        }

        .placeholder-option {
            color: #999;
        }

        .alert {
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px 15px;
            border-radius: 4px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 4px;
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
            <a href="{{ route('campus.register.cancel') }}" class="btn-login" onclick="return confirm('Batalkan pendaftaran? Data yang sudah diisi akan hilang.')">
                Keluar
            </a>
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
            <div class="progress-label">Data Kampus/Sekolah</div>
        </div>
        <div class="progress-step">
            <div class="circle">3</div>
            <div class="progress-label">Lokasi Kampus/Sekolah</div>
        </div>
    </div>

    <!-- Form Profil Kampus -->
    <div class="container my-5">
        <div class="campus-profile-card">
            <div class="card-header">
                <h1 class="card-title">Profil Kampus/Sekolah</h1>
            </div>
            
            <div class="card-body">

                <form id="campusForm" action="{{ route('campus.register.step2') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="namaKampus" name="nama_kampus" class="form-control @error('nama_kampus') is-invalid @enderror" placeholder="Masukkan nama kampus/sekolah anda" value="{{ old('nama_kampus') }}" required>
                        @error('nama_kampus')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-select-wrapper" id="jumlahMahasiswaWrapper">
                            <select class="custom-select @error('jumlah_pegawai') is-invalid @enderror" id="jumlahMahasiswa" name="jumlah_pegawai" required>
                                <option value="" selected disabled class="placeholder-option">Pilih jumlah pegawai</option>
                                <option value="1-100" {{ old('jumlah_pegawai') == '1-100' ? 'selected' : '' }}>1 - 100 pegawai</option>
                                <option value="101-500" {{ old('jumlah_pegawai') == '101-500' ? 'selected' : '' }}>101 - 500 pegawai</option>
                                <option value="501-1000" {{ old('jumlah_pegawai') == '501-1000' ? 'selected' : '' }}>501 - 1000 pegawai</option>
                                <option value="1001-5000" {{ old('jumlah_pegawai') == '1001-5000' ? 'selected' : '' }}>1001 - 5000 pegawai</option>
                                <option value="5001-10000" {{ old('jumlah_pegawai') == '5001-10000' ? 'selected' : '' }}>5001 - 10000 pegawai</option>
                                <option value="10000+" {{ old('jumlah_pegawai') == '10000+' ? 'selected' : '' }}>10000+ pegawai</option>
                            </select>
                            <div class="custom-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        @error('jumlah_pegawai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-select-wrapper" id="jenisInstitusiWrapper">
                            <select class="custom-select @error('jenis_institusi') is-invalid @enderror" id="jenisInstitusi" name="jenis_institusi" required>
                                <option value="" selected disabled class="placeholder-option">Pilih jenis institusi</option>
                                <option value="Universitas" {{ old('jenis_institusi') == 'Universitas' ? 'selected' : '' }}>Universitas</option>
                                <option value="Institut" {{ old('jenis_institusi') == 'Institut' ? 'selected' : '' }}>Institut</option>
                                <option value="Sekolah Tinggi" {{ old('jenis_institusi') == 'Sekolah Tinggi' ? 'selected' : '' }}>Sekolah Tinggi</option>
                                <option value="Politeknik" {{ old('jenis_institusi') == 'Politeknik' ? 'selected' : '' }}>Politeknik</option>
                                <option value="SMA/SMK" {{ old('jenis_institusi') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="SMP" {{ old('jenis_institusi') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SD" {{ old('jenis_institusi') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="Lainnya" {{ old('jenis_institusi') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <div class="custom-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        @error('jenis_institusi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="logo-section">
                        <div class="logo-square" id="logoUploadArea">
                            <i class="fas fa-plus"></i>
                            <div class="logo-text">Unggah</div>
                            <img id="logoPreview" class="logo-preview" alt="Preview Logo">
                            <input type="file" id="logoInput" name="logo" class="file-input @error('logo') is-invalid @enderror" accept="image/*" required>
                        </div>
                        <div class="logo-label">Logo Kampus/Sekolah</div>
                    </div>
                    @error('logo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <hr>
                    
                    <div class="form-footer">

                            <!-- Tombol Sebelumnya -->
                        <a href="{{ route('campus.register') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                        </a>
                        
                        <!-- Tombol Selanjutnya -->
                        <button type="submit" class="btn btn-primary">
                            Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoUploadArea = document.getElementById('logoUploadArea');
            const logoInput = document.getElementById('logoInput');
            const logoPreview = document.getElementById('logoPreview');

            logoUploadArea.addEventListener('click', function() {
                logoInput.click();
            });

            logoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreview.src = e.target.result;
                        logoPreview.style.display = 'block';
                        const icons = logoUploadArea.querySelectorAll('i, .logo-text');
                        icons.forEach(icon => icon.style.display = 'none');
                    };
                    reader.readAsDataURL(file);
                }
            });

            const selectWrappers = document.querySelectorAll('.custom-select-wrapper');
            selectWrappers.forEach(wrapper => {
                const select = wrapper.querySelector('select');
                select.addEventListener('click', () => {
                    wrapper.classList.toggle('open');
                });
                select.addEventListener('blur', () => {
                    wrapper.classList.remove('open');
                });
            });

            // === VALIDASI CLIENT SIDE ===
            const form = document.getElementById('campusForm');
            form.addEventListener('submit', function(event) {
                const nama = document.getElementById('namaKampus').value.trim();
                const mahasiswa = document.getElementById('jumlahMahasiswa').value;
                const institusi = document.getElementById('jenisInstitusi').value;
                const logo = logoInput.files.length > 0;

                if (!nama || !mahasiswa || !institusi || !logo) {
                    event.preventDefault();
                    alert('Harap isi semua kolom dan unggah logo kampus/sekolah terlebih dahulu sebelum melanjutkan.');
                }
            });
        });
    </script>
</body>
</html>