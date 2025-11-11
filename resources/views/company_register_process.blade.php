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
        
        .form-footer::after {
            content: "";
            display: table;
            clear: both;
        }

        .placeholder-option {
            color: #999;
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
        <div class="progress-step">
            <div class="circle">3</div>
            <div class="progress-label">Lokasi Perusahaan</div>
        </div>
    </div>

    <!-- Form Profil Perusahaan -->
    <div class="container my-5">
        <div class="company-profile-card">
            <div class="card-header">
                <h1 class="card-title">Profil Perusahaan</h1>
            </div>
            
            <div class="card-body">

                   <form id="companyForm" action="{{ route('company.register.step2') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="namaPerusahaan" name="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan anda" value="{{ old('nama_perusahaan') }}" required>
                        @error('nama_perusahaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-select-wrapper" id="jumlahKaryawanWrapper">
                            <select class="custom-select" id="jumlahKaryawan" name="jumlah_karyawan" required>
                                <option value="" selected disabled class="placeholder-option">Pilih jumlah karyawan</option>
                                <option value="1-10" {{ old('jumlah_karyawan') == '1-10' ? 'selected' : '' }}>1 - 10 karyawan</option>
                                <option value="11-50" {{ old('jumlah_karyawan') == '11-50' ? 'selected' : '' }}>11 - 50 karyawan</option>
                                <option value="51-200" {{ old('jumlah_karyawan') == '51-200' ? 'selected' : '' }}>51 - 200 karyawan</option>
                                <option value="201-500" {{ old('jumlah_karyawan') == '201-500' ? 'selected' : '' }}>201 - 500 karyawan</option>
                                <option value="501-1000" {{ old('jumlah_karyawan') == '501-1000' ? 'selected' : '' }}>501 - 1000 karyawan</option>
                                <option value="1000+" {{ old('jumlah_karyawan') == '1000+' ? 'selected' : '' }}>1000+ karyawan</option>
                            </select>
                            <div class="custom-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        @error('jumlah_karyawan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-select-wrapper" id="industriWrapper">
                            <select class="custom-select" id="industri" name="industri" required>
                                <option value="" selected disabled class="placeholder-option">Pilih jenis industri</option>
                                <option value="Teknologi Informasi" {{ old('industri') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                                <option value="Keuangan" {{ old('industri') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="Kesehatan" {{ old('industri') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Pendidikan" {{ old('industri') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Manufaktur" {{ old('industri') == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                                <option value="Perdagangan" {{ old('industri') == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                            </select>
                            <div class="custom-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        @error('industri')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="logo-section">
                        <div class="logo-square" id="logoUploadArea">
                            <i class="fas fa-plus"></i>
                            <div class="logo-text">Unggah</div>
                            <img id="logoPreview" class="logo-preview" alt="Preview Logo">
                            <input type="file" id="logoInput" name="logo" class="file-input" accept="image/*" required>
                        </div>
                        <div class="logo-label">Logo Perusahaan</div>
                    </div>
                    @error('logo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    
                    <hr>
                    
                    <div class="form-footer">
                        <a href="{{ route('company.register.cancel') }}" class="btn btn-secondary" onclick="return confirm('Batalkan pendaftaran?')">
                                Batalkan
                        </a>
                        <button type="submit" class="btn btn-primary">Selanjutnya</button>
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

            // Validasi form
            const form = document.getElementById('companyForm');
            form.addEventListener('submit', function(event) {
                const nama = document.getElementById('namaPerusahaan').value.trim();
                const karyawan = document.getElementById('jumlahKaryawan').value;
                const industri = document.getElementById('industri').value;
                const logo = logoInput.files.length > 0;

                if (!nama || !karyawan || !industri || !logo) {
                    event.preventDefault();
                    alert('Harap isi semua kolom dan unggah logo perusahaan terlebih dahulu sebelum melanjutkan.');
                }
            });
        });
    </script>

</body>
</html>
