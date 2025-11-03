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
            background-color: #fff;
            }

        .setting-card {
            /* Sesuai Gambar: Tanpa border-radius, border abu-abu */
            border-radius: 0;
            box-shadow: none;
            border: 1px solid #cfcbcbff;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 0 20px 20px 20px;
        }

        .setting-card-header {
            /* Sesuai Gambar: Background abu-abu muda, padding, margin negatif */
            background-color: #F2F2F2;
            padding: 15px 20px;
            margin: 0 -20px 20px -20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
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

        /* CSS KHUSUS AKUN TERHUBUNG */
        
        /* Menyesuaikan jarak padding agar seperti gambar */
        .account-link-section {
            padding: 0; 
        }

        /* Wrapper untuk Nama/Email dan Tombol Putuskan */
        .account-link-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-top: 10px; 
            padding-bottom: 10px;
        }

        .account-info {
            font-size: 1rem;
            line-height: 1.4;
        }

        .account-info strong {
            display: block;
            font-weight: 600;
            color: #2c2c2c;
            /* Nama ditampilkan sesuai format database (casing) */
            text-transform: none; 
            margin-bottom: 0;
        }

        .account-info span {
            /* Email (misal: ilhamwiguna2005@gmail.com) */
            color: #6c757d;
            font-size: 1rem; 
            display: block;
        }

        .disconnect-link {
            font-size: 0.95rem;
            color: #0d47a1; /* Biru */
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            white-space: nowrap;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .disconnect-link i {
            font-size: 0.9rem;
            margin-left: 5px;
            color: #0d47a1;
        }
        
        /* Garis Pemisah */
        .separator {
            /* Disesuaikan agar jaraknya sama seperti pada gambar Empty State */
            border-top: 1px solid #e0e0e0;
            margin: 5px 0 20px 0; 
        }
        
        /* Empty State */
        .empty-state-alert {
            /* Disesuaikan agar lebih menyerupai gambar */
            display: flex;
            align-items: center;
            padding: 5px 0 10px 0; /* Menambah padding bawah sedikit agar ada jarak dengan separator */
            font-size: 1rem;
            color: #6c757d;
        }
        
        /* Ikon Tanda Seru - PERUBAHAN WARNA SESUAI PERMINTAAN (ABU-ABU GELAP) */
        .empty-state-alert i {
            margin-right: 8px;
            color: #6c757d; 
            font-size: 1rem;
        }

        /* Button Facebook */
        .btn-facebook-custom {
            background-color: #0d47a1; /* Warna Facebook */
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            width: auto; 
            /* Hapus transition jika ingin benar-benar instan, tapi saya pertahankan */
            transition: background-color 0.3s; 
        }
        
        /* PERUBAHAN UTAMA: Menghilangkan efek hover pada tombol Facebook */
        .btn-facebook-custom:hover {
            background-color: #0d47a1; /* Tetap sama seperti warna normal */
            color: #fff; /* Tetap sama seperti warna normal */
            cursor: pointer; /* Pastikan cursor tetap pointer */
        }
        
        /* Logo Facebook yang sudah diperbesar */
        .btn-facebook-custom img {
            width: 22px; 
            height: 22px; 
            margin-right: 10px; 
        }

        @media (max-width: 768px) {
            .setting-card {
                padding: 0 15px 15px 15px;
            }

            .setting-card-header {
                margin: 0 -15px 15px -15px;
            }
        }
    </style>
</head>

<body>

    {{-- Asumsi partials.navbar sudah tersedia --}}
    @include('partials.navbar') 

    <div class="page-content-wrapper">
        <div class="account-setting-container">
            <div class="container">

                {{-- Asumsi partials.setting_account sudah tersedia (sidebar) --}}
                <div class="row">
                    @include('partials.setting_account') 

                    {{-- Konten Utama Akun Terhubung --}}
                    <div class="col-lg-8 col-md-7">

                        <div class="setting-card">
                            
                            <div class="setting-card-header">
                                <h5>Akun Terhubung</h5>
                            </div>
                            
                            @php
                                $user = Auth::user();
                                // SIMULASI: Set $isDisconnected menjadi TRUE untuk menampilkan Empty State
                                // Anda perlu mengatur variabel ini di controller Anda setelah proses disconnect
                                $isDisconnected = $isDisconnected ?? true; 
                                
                                // Status koneksi akun utama
                                $isMainAccountConnected = !$isDisconnected;
                            @endphp

                            <p class="mb-2">
                                Kamu dapat masuk melalui salah satu akun di bawah ini:
                            </p>

                            <div class="account-link-section">
                                @if ($isMainAccountConnected)
                                    {{-- SKENARIO 1: AKUN TERHUBUNG --}}
                                    <div class="account-link-item">
                                        <div class="account-info">
                                            {{-- Nama sesuai database (tanpa strtoupper) --}}
                                            <strong>{{ $user->name ?? 'Wiguna Ilham' }}</strong>
                                            <span>{{ $user->email ?? 'ilhamwiguna2005@gmail.com' }}</span>
                                        </div>
                                        
                                        {{-- Tombol Putuskan Akun (Simulasi) --}}
                                        {{-- MENGHILANGKAN onsubmit="return confirm(...)" agar tidak ada pop-up --}}
                                        <form method="POST" action="{{ route('account.dummy.disconnect') }}" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="disconnect-link">
                                                Putuskan akun 
                                                <i class="fas fa-question-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    {{-- Garis Pemisah untuk Skenario Terhubung --}}
                                    <div class="separator"></div>
                                @else
                                    {{-- SKENARIO 2: EMPTY STATE (Tampilan yang diminta) --}}
                                    <div class="empty-state-alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>Kamu belum memiliki akun yang terhubung.</span>
                                    </div>

                                    {{-- Garis Pemisah untuk Skenario Empty State (HARUS BERADA DI BAWAH TEKS) --}}
                                    <div class="separator"></div>
                                @endif
                                
                                
                                {{-- BAGIAN BAWAH: HUBUNGKAN AKUN --}}
                                <p class="mb-3">
                                    Akun mana yang ingin kamu hubungkan?
                                </p>

                                {{-- Tombol Facebook --}}
                                <button type="button" class="btn btn-facebook-custom">
                                    <img src="{{ asset('images/logo facebook.png') }}" alt="Facebook Logo">
                                    FACEBOOK
                                </button>
                            </div>

                        </div>
                    </div>
                    {{-- Akhir Konten Utama --}}
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>