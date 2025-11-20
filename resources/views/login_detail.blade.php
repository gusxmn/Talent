<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* CSS Umum/Global */
        body {
            background-color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .page-content-wrapper {
            flex-grow: 1;
            /* DIUBAH MENJADI PUTIH */
            background-color: #fff;
        }
        
        /* CSS untuk Bagian Detail Login (Content Kanan) */
        .setting-card {
            /* PERUBAHAN: Hapus border-radius agar sudut menjadi lancip */
            border-radius: 0; 
            /* PERUBAHAN: Border lebih tebal/menonjol */
            box-shadow: none;
            border: 1px solid #cfcbcbff; /* Border lebih jelas */
            margin-bottom: 20px;
            background-color: #fff;
            padding: 0 20px 20px 20px; 
        }

        /* CSS BARU UNTUK HEADER KARTU */
        .setting-card-header {
            /* DIUBAH MENJADI PUTIH (dulu #f7f7f7) */
            background-color: #F2F2F2; 
            padding: 15px 20px; 
            margin: 0 -20px 20px -20px; 
            /* PERUBAHAN: Hapus border-radius agar sudut header menjadi lancip */
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            /* PERUBAHAN: Sesuaikan border bawah */
            border-bottom: 1px solid #e0e0e0; 
        }
        
        .setting-card-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c2c2c;
            margin: 0; 
            padding: 0; 
            border-bottom: none; 
        }
        /* AKHIR CSS BARU */

        /* Hapus atau ubah class lama .setting-card h5 jika tidak digunakan lagi */
        /* .setting-card h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        } */

        .form-control-glints {
            height: 45px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            color: #495057;
        }

        .form-control-glints:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
            outline: 0;
        }

        .input-group-password {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            color: #6c757d;
            font-size: 1.1rem;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #333;
        }

        .input-group>.form-control-glints:not(:last-child) {
            border-top-right-radius: 4px !important;
            border-bottom-right-radius: 4px !important;
            padding-right: 40px;
        }

        /* PERUBAHAN: Tombol Ganti Kata Sandi - Warna biru, tulisan putih, tanpa hover */
        .btn-ganti-sandi {
            background-color: #0d47a1; /* Diubah menjadi biru */
            color: #fff; /* Diubah menjadi putih */
            font-weight: 600;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            transition: none; /* Hapus efek transisi */
            font-size: 0.9rem;
        }

        /* PERUBAHAN: Hapus efek hover pada tombol Ganti Kata Sandi */
        .btn-ganti-sandi:hover {
            background-color: #0d47a1; /* Tetap sama dengan warna normal */
            color: #fff; /* Tetap sama dengan warna normal */
        }

        /* PERUBAHAN: Tombol Perbarui Email - Warna biru, tulisan putih, tanpa hover */
        .btn-perbarui-email {
            background-color: #0d47a1; /* Diubah menjadi biru */
            color: #fff; /* Diubah menjadi putih */
            border: 1px solid #0d47a1; /* Border biru */
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 4px;
            transition: none; /* Hapus efek transisi */
            font-size: 0.9rem;
            white-space: nowrap;
        }

        /* PERUBAHAN: Hapus efek hover pada tombol Perbarui Email */
        .btn-perbarui-email:hover {
            background-color: #0d47a1; /* Tetap sama dengan warna normal */
            color: #fff; /* Tetap sama dengan warna normal */
            border-color: #0d47a1; /* Tetap sama dengan warna normal */
        }

        .email-verified-text {
            font-size: 1rem;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .email-verified-text i {
            color: #4CAF50;
            font-size: 1.1rem;
            margin-right: 8px;
            flex-shrink: 0;
        }

        .email-verified-status {
            font-size: 0.9rem;
            font-weight: 400;
            display: block;
            margin-left: 24px;
            margin-top: 2px;
            color: #6c757d !important;
        }

        .current-email-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .alert-settings {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .alert-success-custom {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        @media (max-width: 768px) {
            .setting-card {
                padding: 0 15px 15px 15px; /* UBAH: Sesuaikan padding untuk mobile */
            }
            .setting-card-header {
                margin: 0 -15px 15px -15px; /* UBAH: Sesuaikan margin negatif untuk mobile */
            }

            .btn-perbarui-email {
                width: 100%;
                margin-top: 10px;
            }

            .col-lg-6.d-flex.flex-column {
                display: block !important;
            }
        }
    </style>
</head>

<body>

    @include('partials.navbar') {{-- Asumsi file partials/navbar ada --}}

    <div class="page-content-wrapper">
        <div class="account-setting-container">
            <div class="container">

                {{-- Memuat Sidebar dan Judul "Pengaturan Akun" dari partials --}}
                @include('partials.setting_account')

                {{-- KONTEN DETAIL LOGIN (Ganti Kata Sandi & Perbarui Email) --}}
                <div class="col-lg-8 col-md-7">

                    {{-- CARD GANTI KATA SANDI --}}
                    <div class="setting-card">
                        {{-- PERUBAHAN: Bungkus h5 dengan setting-card-header --}}
                        <div class="setting-card-header">
                            <h5>Ganti Kata Sandi</h5>
                        </div>
                        {{-- AKHIR PERUBAHAN --}}
                        
                        {{-- BLOK BARU: Tampilkan pesan berhasil ganti kata sandi --}}
                        @if (session('success_password'))
                            <div class="alert alert-success-custom alert-settings" role="alert">
                                {{ session('success_password') }}
                            </div>
                        @endif

                        {{-- BLOK BARU: Tampilkan pesan error validasi kata sandi --}}
                        @if ($errors->has('new_password') || $errors->has('confirm_password'))
                            <div class="alert alert-danger alert-settings" role="alert">
                                @foreach ($errors->all() as $error)
                                    @if (Str::contains($error, 'Kata sandi') || Str::contains($error, 'Konfirmasi'))
                                        <div>{{ $error }}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('account.update.password') }}" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-password mb-3">
                                    <input type="password" id="new_password" name="new_password"
                                        class="form-control form-control-glints @error('new_password') is-invalid @enderror"
                                        placeholder="Masukkan kata sandi baru" required>
                                    <i class="fas fa-eye-slash toggle-password" data-target="new_password"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-password mb-3">
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control form-control-glints @error('confirm_password') is-invalid @enderror"
                                        placeholder="Konfirmasi kata sandi" required>
                                    <i class="fas fa-eye-slash toggle-password" data-target="confirm_password"></i>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn-ganti-sandi text-uppercase">GANTI KATA SANDI</button>
                            </div>
                        </form>
                    </div>

                    {{-- CARD PERBARUI EMAIL --}}
                    <div class="setting-card">
                        {{-- PERUBAHAN: Bungkus h5 dengan setting-card-header --}}
                        <div class="setting-card-header">
                            <h5>Perbarui Email</h5>
                        </div>
                        {{-- AKHIR PERUBAHAN --}}

                        {{-- BLOK BARU: Tampilkan pesan berhasil perbarui email --}}
                        @if (session('success_email'))
                            <div class="alert alert-success-custom alert-settings" role="alert">
                                {{ session('success_email') }}
                            </div>
                        @endif

                        {{-- BLOK BARU: Tampilkan pesan error validasi email --}}
                        @error('new_email')
                            <div class="alert alert-danger alert-settings" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('account.update.email') }}">
                            @csrf

                            <div class="row g-3">

                                <div class="col-lg-6 col-md-12 col-sm-12 current-email-group">
                                    <div class="email-verified-text">
                                        <i class="fas fa-check-circle"></i>
                                        {{ Auth::user()->email }}
                                    </div>

                                    <span class="email-verified-status">
                                        Alamat email telah diverifikasi.
                                    </span>
                                </div>

                                <div
                                    class="col-lg-6 col-md-12 col-sm-12 d-flex flex-column justify-content-start">

                                    {{-- PERUBAHAN 1: Ganti mb-2 menjadi mb-3 (Sesuai kode awal Anda) --}}
                                    <div class="mb-3">
                                        <input type="email" name="new_email"
                                            class="form-control form-control-glints @error('new_email') is-invalid @enderror"
                                            placeholder="Masukkan email baru" required>
                                    </div>

                                    {{-- PERUBAHAN 2: Tambahkan mt-3 untuk menyamakan jarak dengan bagian Ganti Kata Sandi (Sesuai kode awal Anda) --}}
                                    <div class="d-flex justify-content-start mt-3">
                                        <button type="submit" class="btn-perbarui-email text-uppercase">PERBARUI
                                            EMAIL</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logika JavaScript asli
        try {
            const userDropdownContainer = document.getElementById('userDropdownContainer');
            
            if (userDropdownContainer) {
                const chevronIcon = userDropdownContainer.querySelector('.chevron-icon');
                if (chevronIcon) {
                    userDropdownContainer.addEventListener('show.bs.dropdown', () => chevronIcon.classList.add('open'));
                    userDropdownContainer.addEventListener('hide.bs.dropdown', () => chevronIcon.classList.remove('open'));
                }
            }
        } catch (e) {
            console.warn("Kemungkinan 'userDropdownContainer' sudah dideklarasikan di partials.navbar atau file lain. Mengabaikan blok ini untuk mencegah Uncaught SyntaxError.");
        }
        
        
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordIcons = document.querySelectorAll('.toggle-password');

            togglePasswordIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    const isPasswordVisible = passwordInput.getAttribute('type') === 'password';
                    const newType = isPasswordVisible ? 'text' : 'password';
                    passwordInput.setAttribute('type', newType);

                    if (newType === 'text') {
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });
        });
    </script>

</html>