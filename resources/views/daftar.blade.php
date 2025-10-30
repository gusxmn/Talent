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
        /* Mengimpor font Serif untuk judul */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

        body {
            /* Latar belakang halaman diubah menjadi putih total */
            background-color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Styling untuk container utama */
        .main-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            position: relative;
            
            /* Padding atas dipertahankan (40px) agar dekat dengan navbar */
            padding: 40px 20px 50px; 
        }

        /* Elemen wave dan card telah dihilangkan */
        .wave-background {
            display: none;
        }

        /* Konten utama sekarang hanya berfungsi sebagai wrapper yang terpusat */
        .main-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
            text-align: center;
            background-color: transparent;
            padding: 0;
            box-shadow: none;
        }

        /* Styling untuk judul utama */
        .title-glints {
            font-family: 'Playfair Display', serif;
            font-size: 56px;
            font-weight: 700;
            text-align: center;
            margin: 0 0 20px;
            line-height: 1.1;

            /* Diatur sebagai parent untuk garis ::after */
            display: inline-block;
            position: relative;
            padding-bottom: 25px;
            /* Memberi ruang di bawah judul */
        }

        /* Membuat garis bawah (underline) kustom */
        .title-glints::after {
            content: '';
            display: block;
            /* Lebar 100% dari teks judul */
            width: 100%;
            height: 2px;
            /* Ketebalan garis */
            background-color: #333;
            /* Warna garis */
            position: absolute;
            bottom: 0;
            /* Menempatkan garis di bawah teks */
            left: 0;
        }

        /* Styling untuk teks deskripsi */
        .description-text {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            /* Disesuaikan margin agar berjarak dengan garis baru */
            margin-bottom: 40px;
            margin-top: 20px;
        }

        /* Container untuk tombol */
        .btn-container {
            display: flex;
            justify-content: center; /* Memastikan tombol dan gambar ada di tengah */
            align-items: flex-start;
            
            /* Jarak antar tombol dipertahankan (120px) */
            gap: 120px; 
            
            max-width: none; 
            width: 100%;
            margin: 0 auto;
        }

        /* **STYLING GAMBAR/ILUSTRASI** */
        .registration-img {
            /* **PENYESUAIAN 1: Ukuran gambar dikecilkan (110px -> 95px)** */
            width: 95px;
            height: 95px;
            object-fit: contain;
            margin-bottom: 15px;
            display: block;
        }

        /* Container untuk setiap pilihan (Kampus/Perusahaan) */
        .choice-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex-shrink: 0;
        }

        .btn-choose {
            /* **PENYESUAIAN 2: Lebar tombol dikecilkan (260px -> 240px)** */
            width: 240px; 
            /* **PENYESUAIAN 3: Tinggi tombol dikecilkan (65px -> 55px)** */
            height: 55px;
            /* **PENYESUAIAN 4: Ukuran font dikecilkan (18px -> 17px)** */
            font-size: 17px;
            font-weight: 600;
            border-radius: 30px;
            border: none;
            transition: all 0.3s ease;
        }

        /* Tombol DAFTAR PERUSAHAAN -> BIRU SOLID */
        .btn-company {
            background-color: #0d47a1;
            color: #fff;
            border: none;
        }

        .btn-company:hover {
            background-color: #0b3d8b;
            color: #fff;
        }

        /* Tombol DAFTAR KAMPUS -> HIJAU SOLID */
        .btn-campus {
            background-color: #00b14f;
            color: #fff;
            border: none;
        }

        .btn-campus:hover {
            background-color: #029a45;
            color: #fff;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    <div class="main-container">
        {{-- Elemen Background Wave telah disembunyikan di CSS --}}
        <div class="wave-background"></div>

        <div class="main-content">
            {{-- Garis bawah kustom diterapkan menggunakan ::after --}}
            <h2 class="title-glints">Pilih jenis pendaftaran</h2>

            <p class="description-text">
                Silakan pilih jenis pendaftaran yang sesuai untuk melanjutkan ke proses registrasi.
                Pilih Daftar Perusahaan jika Anda ingin melamar pekerjaan, atau pilih Daftar Kampus jika Anda ingin melamar pemagangan.
            </p>

            {{-- Struktur Flexbox untuk mengatur jarak --}}
            <div class="btn-container">
                <div class="choice-item">
                    {{-- GAMBAR KAMPUS DITAMBAHKAN --}}
                    <img src="images/kampus.png" alt="Ilustrasi Kampus" class="registration-img">
                    {{-- Tombol Daftar Kampus: HIJAU SOLID --}}
                    <a href="/registrasi-kampus" class="btn btn-choose btn-campus d-flex align-items-center justify-content-center">
                        Daftar Kampus
                    </a>
                </div>
                <div class="choice-item">
                    {{-- GAMBAR PERUSAHAAN DITAMBAHKAN --}}
                    <img src="images/perusahaan.png" alt="Ilustrasi Perusahaan" class="registration-img">
                    {{-- Tombol Daftar Perusahaan: BIRU SOLID --}}
                    <a href="/registrasi-perusahaan" class="btn btn-choose btn-company d-flex align-items-center justify-content-center">
                        Daftar Perusahaan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>