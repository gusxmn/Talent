<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-width, initial-scale=1.0">
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* === SECTION BANDINGKAN GAJI KAMU === */
        .career-salary-section {
            width: 100%;
            padding: 0;
            margin: 50px auto;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
        }

        .salary-card {
            background: #0b0b54;
            color: #fff;
            border-radius: 16px;
            padding: 50px 60px;
            width: calc(100% - 80px);
            box-sizing: border-box;
            text-align: left;
        }

        .salary-card h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .salary-card p {
            font-size: 18px;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .salary-card label {
            font-size: 16px;
            font-weight: 500;
            display: block;
            margin-bottom: 8px;
            color: #fff;
        }

        .salary-card .form-control {
            border: none;
            border-radius: 8px;
            height: 48px;
            font-size: 16px;
            padding-left: 16px;
            color: #333;
            width: 70%;
        }

        .salary-card .form-control::placeholder {
            color: #888;
        }

        /* === CAREER SUGGESTIONS SECTION === */
        .career-suggestions {
            width: 100%;
            padding: 0 40px;
            margin: 60px auto;
            margin-top: 100px;
            margin-bottom: 60px;
        }

        .career-suggestions .row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .career-suggestion-card {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            min-height: 120px;
        }

        .career-suggestion-card img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .career-suggestion-card h5 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #333;
        }

        .career-suggestion-card p {
            font-size: 16px;
            color: #555;
            margin: 0;
            line-height: 1.4;
        }

        /* === SLIDER STYLE UNTUK LIHAT IDE KARIER === */
        .career-idea-slider {
            position: relative;
            max-width: 1200px;
            margin: 100px auto 80px auto;
            overflow: visible;
            border-radius: 12px;
        }

        .career-idea-header {
            /* MODIFIKASI: Diubah dari flex space-between ke block untuk tata letak vertikal */
            display: block; 
            /* margin-bottom akan dipindahkan ke elemen highlight-text-wrapper */
            margin-bottom: 0; 
        }

        .career-idea-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #222;
            /* TAMBAH: Jarak antara h2 dan baris highlight */
            margin-bottom: 10px; 
        }

        /* ========================================================== */
        /* CSS BARU UNTUK GARIS MERAH DAN TEXT HEADER KEDUA */
        /* ========================================================== */

        .highlight-text-wrapper {
            display: flex;
            align-items: center;
            /* MODIFIKASI: Mengatur posisi teks agar 'Memiliki sebuah...' berada di tengah secara visual */
            /* Menghitung sisa ruang di antara h2 dan career-stats-row */
            margin-top: 20px; /* Tambahkan sedikit jarak dari h2 */
            margin-bottom: 30px; /* Jarak ke baris stats di bawahnya */
        }

        .highlight-line {
            width: 4px;
            height: 20px;
            background-color: #e6007a; /* Warna merah */
            margin-right: 15px;
            border-radius: 2px;
        }

        .highlight-text-wrapper p {
            color: #222;
            font-size: 18px; /* Ukuran font disesuaikan seperti gambar */
            margin: 0;
        }

        .highlight-text-wrapper p span {
            /* MODIFIKASI: Mengatur tulisan "industri" menjadi bold hitam dan underline */
            color: #222; /* Warna hitam */
            font-weight: 700; /* Bold */
            text-decoration: underline; /* Garis bawah */
            text-decoration-color: #222; /* Warna garis bawah (Hitam) */
            text-underline-offset: 4px; /* Jarak garis bawah dari teks (Opsional, untuk tampilan lebih baik) */
        }

        /* ========================================================== */
        /* CSS BARU UNTUK BARIS "50+ peran" dan Sortir */
        /* ========================================================== */

        .career-stats-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Jarak dari card slider */
            margin-bottom: 20px; 
        }

        .career-stats-row p {
            /* MODIFIKASI: Memperbesar sedikit ukuran font 50+ peran */
            font-size: 18px; 
            font-weight: 400;
            color: #444;
            margin: 0;
        }

        /* TAMBAH: Untuk membuat angka 50+ menjadi bold */
        .career-stats-row p strong {
            font-weight: 700;
            color: #222;
        }

        .sort-option {
            /* MODIFIKASI: Memperbesar sedikit ukuran font Sortir berdasarkan Gaji */
            font-size: 18px;
            color: #222;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .sort-option i {
            font-size: 14px; /* Perbesar sedikit simbol dropdown */
            color: #222;
        }


        /* === CSS Card Body BARU/MODIFIKASI === */

        .career-card-body {
            padding: 15px 20px;
        }

        /* Baris Pertama: Nama Jabatan (H5) */
        .career-card-body h5 {
            /* MODIFIKASI: Mengubah ukuran dan bobot sesuai gambar */
            font-size: 17px; /* Ukuran yang lebih besar */
            font-weight: 600;
            margin-bottom: 8px; /* Jarak dengan baris gaji */
            color: #222;
        }

        /* Container untuk Baris Kedua (Gaji bulanan biasa & Nominal) */
        .salary-row {
            display: flex; /* Membuat teks gaji dan nominal dalam satu baris */
            align-items: baseline; /* Agar teks sejajar di bagian bawah */
            gap: 5px; /* Jarak antara teks gaji dan nominal */
        }

        /* Teks 'Gaji bulanan biasa' (P) */
        .career-card-body p {
            /* MODIFIKASI: Mengubah ukuran dan warna agar lebih kecil dan pudar */
            font-size: 15px;
            color: #444;
            margin: 0;
            flex-shrink: 0; /* Pastikan teks ini tidak mengecil */
        }

        /* Nominal Gaji (Salary) */
        .career-card-body .salary {
            /* MODIFIKASI: Mengubah ukuran font agar lebih besar dan lebih gelap dari teks gaji */
            font-size: 15px;
            font-weight: 600;
            color: #222;
            margin: 0; /* Hapus margin atas/bawah yang lama */
        }


        /* === Sisa CSS Slider (Tidak Berubah Signifikan) === */

        .career-slides-wrapper {
            overflow: hidden;
            border-radius: 12px;
            position: relative;
        }

        .career-idea-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .career-slide {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            min-width: 100%;
        }

        .career-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .career-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .career-card:hover {
            transform: translateY(-4px);
        }

        /* === NAVIGATION ARROWS === */
        .career-btn {
            position: absolute;
            top: 60%;
            transform: translateY(-50%);
            background: white;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .career-btn:hover {
            background: #f1f1f1;
        }

        .career-btn.left {
            left: -60px;
        }

        .career-btn.right {
            right: -60px;
        }

        /* === DOTS === */
        .career-dots {
            text-align: center;
            margin-top: 25px; 
            position: relative;
            z-index: 5;
        }

        .career-dots span {
            display: inline-block;
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #d1d1d1;
            border-radius: 50%;
            cursor: pointer;
        }

        .career-dots .active {
            background-color: #0b0b54;
        }

        /* === RESPONSIVE === */
        @media (max-width: 992px) {
            .career-suggestions .row {
                grid-template-columns: 1fr;
            }

            .career-slide {
                grid-template-columns: repeat(2, 1fr);
            }

            .career-btn.left {
                left: -35px;
            }

            .career-btn.right {
                right: -35px;
            }
        }

        @media (max-width: 768px) {
            .career-slide {
                grid-template-columns: 1fr;
            }

            .career-btn.left {
                left: -25px;
            }

            .career-btn.right {
                right: -25px;
            }
        }
        
         /* === Career Industry Section === */
    .career-industries {
        width: 100%;
        padding: 0 40px;
        margin: 80px auto;
        margin-top: 100px;
        text-align: left;
    }

    .career-industries h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .career-industries .subtitle {
        font-size: 18px;
        color: #666;
        margin-bottom: 25px;
    }

    /* Grid untuk tombol agar rata */
    .industry-list {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 kolom per baris */
        gap: 20px;
    }

    .industry-list button {
        border: 1px solid #dcdcdc;
        border-radius: 999px;
        background: #fff;
        padding: 12px 15px;
        font-size: 16px;
        font-weight: 500; /* agak bold tapi tidak terlalu tebal */
        color: #222;
        cursor: pointer;
        transition: background 0.2s ease;
        width: 100%; /* semua tombol full mengikuti grid */
        text-align: center;
    }

    .industry-list button:hover {
        background: #f5f5f5;
    }

    .see-more {
        text-align: center;
        margin-top: 25px;
    }

    .see-more a {
        font-size: 18px;
        font-weight: 500;
        color: #333;
        text-decoration: none;
    }

    .see-more a:hover {
        text-decoration: none;
    }

            /* === Career Change Section (Merubah Karir) === */
    .career-change-section {
        width: 100%;
        padding: 0 40px;
        margin: 80px auto;
        margin-top: 100px;  
    }

    .change-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .change-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .change-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .change-header a:hover {
        text-decoration: underline;
    }

    .change-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .change-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-height: 230px;
        display: flex;
        flex-direction: column;
    }

    .change-card img {
        width: 100%;
        height: 180px; /* semua gambar dipaksa sama */
        object-fit: cover;
        flex-shrink: 0;
    }

    .change-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .change-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }


    /* ========================================================== */
    /* SECTION BANDINGKAN GAJI KAMU (DISESUAIKAN) */
    /* ========================================================== */

    .salary-comparison-section {
        width: 100%; /* Menggunakan width: 100% agar padding 40px berfungsi sebagai batas */
        /* Menghapus max-width: 1200px agar padding 40px dari body tetap berlaku. */
        /* Jika Anda ingin max-width tetap ada, gunakan max-width: 1200px; margin: 0 auto; dan padding: 0 40px; */
        
        /* Disesuaikan dari .career-change-section */
        padding: 0 40px; 
        margin: 80px auto; /* Bottom margin 80px */
        margin-top: 100px; /* Top margin 100px */
        box-sizing: border-box;
    }

    .salary-comparison-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        margin-bottom: 25px; /* Jarak ke form */
    }

    .comparison-form-new {
        display: flex;
        gap: 20px; /* Jarak antar kolom */
        align-items: flex-end; /* Agar tombol rata dengan input */
    }

    /* Kolom Input Gaji dan Posisi */
    .form-column-new {
        display: flex;
        flex-direction: column;
        /* Memberi flex-grow 1 untuk input dan 0 untuk tombol, total proporsi 1:1:Tombol */
        flex: 1; 
    }

    .form-column-new label {
        font-size: 16px;
        font-weight: 500;
        color: #222;
        margin-bottom: 8px; /* Jarak antara label dan input */
    }

    /* Base style untuk semua input */
    .comparison-form-new input {
        border: 1px solid #bfc5d2;
        border-radius: 8px;
        /* Input di dalam container gaji akan memiliki padding 0, yang lain 10px 14px */
        padding: 10px 14px; 
        font-size: 16px;
        outline: none;
        height: 48px; /* Tinggi yang sama dengan gambar */
        box-sizing: border-box;
        transition: border-color 0.2s ease;
        width: 100%;
    }

    .comparison-form-new input:focus {
        border-color: #0b0b54;
    }

    /* Input Gaji - Container untuk Rp dan Input */
    .salary-input-container {
        display: flex;
        align-items: center;
        /* Border dipindahkan ke container untuk tampilan satu kesatuan */
        border: 1px solid #bfc5d2; 
        border-radius: 8px;
        height: 48px;
        padding: 0 14px; /* Padding vertikal 0, horizontal 14px */
    }

    .salary-input-container:focus-within {
        border-color: #0b0b54;
    }

    .salary-input-container span {
        font-size: 16px;
        color: #444;
        font-weight: 500;
        margin-right: 8px; /* Jarak antara Rp dan nominal */
        /* Membuat border tipis di antara 'Rp' dan input */
        padding-right: 8px; 
        border-right: 1px solid #bfc5d2; 
        line-height: 1; 
        height: 100%;
        display: flex;
        align-items: center;
    }

    .salary-input-container input#monthly-salary-new {
        /* Menimpa padding dan border default input untuk input gaji */
        border: none;
        padding: 0; 
        font-size: 16px;
        outline: none;
        flex-grow: 1;
        color: #222;
        height: auto; 
    }

    /* Tombol Bandingkan Gaji */
    .comparison-button-new {
        /* Lebar tombol kira-kira sama dengan input */
        flex: 0 0 25%; /* Lebar tetap, sesuai dengan proporsi kolom di gambar */
        max-width: 250px; 
        background: #f3f4f6; /* Warna abu-abu muda */
        color: #222;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
        height: 48px; /* Tinggi yang sama dengan input */
        box-sizing: border-box;
    }

    .comparison-button-new:hover {
        background: #e6e7e8;
    }

    /* Responsif */
    @media (max-width: 992px) {
        .comparison-form-new {
            flex-wrap: wrap; 
        }

        .form-column-new {
            flex: 1 1 45%; 
        }

        .comparison-button-new {
            flex: 1 1 100%; 
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .form-column-new {
            flex: 1 1 100%; 
        }
    }
    
        /* === Salary Trend Section (Tren Gaji & Profesi) === */
    .salary-trend-section {
        width: 100%;
        padding: 0 40px;
        margin: 80px auto;
        margin-top: 100px;
    }

    .salary-trend-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .salary-trend-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .salary-trend-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .salary-trend-header a:hover {
        text-decoration: underline;
    }

    .salary-trend-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .salary-trend-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-height: 230px;
        display: flex;
        flex-direction: column;
    }

    .salary-trend-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .salary-trend-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .salary-trend-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }



    /* ========================================================== */
    /* CSS UNTUK BAGIAN SUMBER DAYA DAN TEMPLAT (SUDAH SEJAJAR) */
    /* ========================================================== */
    .resource-template-section {
        width: 100%;                 /* sama seperti .salary-trend-section */
        padding: 0 40px;             /* sejajar kanan-kiri */
        margin: 80px auto;           /* jarak bawah sama */
        margin-top: 100px;           /* jarak atas sama */
        box-sizing: border-box;
    }

    .resource-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .resource-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .resource-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .resource-header a:hover {
        text-decoration: underline;
    }

    /* === Card Container === */
    .resource-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
        flex-wrap: nowrap;
    }

    /* === Card === */
    .resource-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-height: 230px;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .resource-card:hover {
        transform: translateY(-2px);
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
    }

    /* === Gambar Card === */
    .resource-card img {
        width: 100%;
        height: 180px; /* Sama persis dengan .salary-trend-card img */
        object-fit: cover;
        flex-shrink: 0;
    }

    /* === Body Card === */
    .resource-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .resource-card-body p {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    /* === Responsif === */
    @media (max-width: 992px) {
        .resource-cards-row {
            flex-wrap: wrap;
        }
        .resource-card {
            flex: 0 0 calc(33.33% - 15px);
            max-width: calc(33.33% - 15px);
        }
    }

    @media (max-width: 768px) {
        .resource-card {
            flex: 0 0 calc(50% - 10px);
            max-width: calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .resource-card {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    
    /* === Subscription Section (Berlangganan Panduan Karir) === */
    .career-subscribe-section {
        width: 100%; /* mengikuti lebar salary-trend-section */
        padding: 0 40px; /* sama seperti salary-trend-section */
        margin: 100px auto;
        box-sizing: border-box;
    }

    .career-subscribe-card {
        background: #fff;
        border: 1px solid #dcdcdc;
        border-radius: 16px;
        padding: 40px 50px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        width: 100%;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .career-subscribe-card:hover {
        transform: translateY(-3px);
    }

    .career-subscribe-section h2 {
        font-size: 24px;
        font-weight: 600;
        color: #1c1c1c;
        margin-bottom: 10px;
    }

    .career-subscribe-section p {
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
    }

    .subscribe-form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
    }

    .subscribe-form .form-group {
        flex: 1;
        min-width: 200px;
        display: flex;
        flex-direction: column;
    }

    .subscribe-form label {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }

    .subscribe-form input {
        border: 1px solid #bfc5d2;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 16px;
        outline: none;
        transition: border 0.2s ease;
        width: 100%;
    }

    .subscribe-form input:focus {
        border-color: #0b0b54;
    }

    .subscribe-form button {
        background: #f3f4f6;
        color: #1c1c1c;
        border: none;
        border-radius: 8px;
        padding: 10px 30px;
        font-size: 16px;
        font-weight: 600;
        align-self: flex-end;
        cursor: pointer;
        transition: background 0.3s ease;
        height: 42px;
    }

    .subscribe-form button:hover {
        background: #e6e7e8;
    }

    .career-subscribe-section small {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
    }

    /* === Garis bawah permanen pada link === */
    .career-subscribe-section small a {
        color: #0b0b54;
        text-decoration: underline; /* underline permanen */
        font-weight: 500;
    }

    .career-subscribe-section small a:hover {
        text-decoration: underline; /* tetap underline saat hover */
    }

    </style>
</head>

<body>
    @include('partials.navbar')
    @include('partials.header_career')

    {{-- === SECTION: BANDINKAN GAJI KAMU === --}}
    <section class="career-salary-section">
        <div class="salary-card">
            <h2>Bandingkan gaji kamu</h2>
            <p>Cari karir untuk mempelajari tentang deskripsi karir, tren lowongan, persyaratan, dan lainnya.</p>
            <form action="#" method="GET">
                <div>
                    <label for="posisi">Posisi pekerjaan kamu</label>
                    <input type="text" id="posisi" class="form-control" placeholder="mis. perawat, guru, akuntan">
                </div>
            </form>
        </div>
    </section>

    {{-- === SECTION: CAREER OPTIONS === --}}
    <section class="career-suggestions">
        <div class="row">
            <div class="career-suggestion-card">
                <img src="/images/icon6.png" alt="Ikon Ide perubahan karier">
                <div>
                    <h5>Ide perubahan karier</h5>
                    <p>Temukan karier baru yang sesuai dengan preferensi Anda.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="/images/icon7.png" alt="Ikon Telusuri karier berdasarkan industri">
                <div>
                    <h5>Telusuri karier berdasarkan industri</h5>
                    <p>Jelajahi tren pekerjaan dan gaji di berbagai karier dari setiap industri.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="/images/icon1.png" alt="Ikon Bandingkan gaji">
                <div>
                    <h5>Bandingkan gaji</h5>
                    <p>Periksa dan bandingkan wawasan gaji untuk karier yang Anda minati.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="/images/icon8.png" alt="Kehidupan kerja Anda">
                <div>
                    <h5>Tren pekerjaan dan gaji</h5>
                    <p>Baca artikel terbaru kami tentang tren pekerjaan dan gaji di berbagai industri.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- === SECTION: Lihat Ide Karir === --}}
    <section class="career-idea-slider">
        <div class="career-idea-header">
            <div>
                <h2>Lihat ide karier</h2>
                
                <div class="highlight-text-wrapper">
                    <div class="highlight-line"></div>
                    <p>Memiliki sebuah <span style="font-weight: 700; color: #222; text-decoration: underline; text-underline-offset: 4px;">industri</span> dalam pikiran Anda?</p>
                </div>
                
            </div>
        </div>

        <div class="career-stats-row">
            <p><strong>16</strong> peran</p> 
            <div class="sort-option">
                Sortir berdasarkan Gaji
                <i class="fa fa-chevron-down"></i> </div>
        </div>

        <div class="career-slides-wrapper">
            <div class="career-idea-slides" id="careerSlides">
                <div class="career-slide">
                    <div class="career-card"><img src="/images/wakil_presiden.png"><div class="career-card-body"><h5>Wakil Presiden</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 42.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/direktur_operasi.png"><div class="career-card-body"><h5>Direktur Operasi</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 35.000.000</div></div></div></div>
                    <div class="career-card"><img src="/images/direktur_utama.png"><div class="career-card-body"><h5>Direktur Utama</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 33.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/direktur_keuangan.png"><div class="career-card-body"><h5>Direktur Keuangan</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 26.250.000</div></div></div></div>
                </div>

                <div class="career-slide">
                    <div class="career-card"><img src="/images/manajer_umum.png"><div class="career-card-body"><h5>Manajer Umum</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 22.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manajer_komersial.png"><div class="career-card-body"><h5>Manajer Komersial</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 21.250.000</div></div></div></div>
                    <div class="career-card"><img src="/images/nasional_sales_manager.png"><div class="career-card-body"><h5>Nasional Sales Manager</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 21.000.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manager_perencanaan.png"><div class="career-card-body"><h5>Manager Perencanaan</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 20.000.000</div></div></div></div>
                </div>

                <div class="career-slide">
                    <div class="career-card"><img src="/images/manajer_konstruksi.png"><div class="career-card-body"><h5>Manajer Konstruksi</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 19.000.000</div></div></div></div>
                    <div class="career-card"><img src="/images/divisi_manager.png"><div class="career-card-body"><h5>Divisi Manager</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 18.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manajer_penjualan_regional.png"><div class="career-card-body"><h5>Manajer Penjualan Regional</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 18.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manager_humas.png"><div class="career-card-body"><h5>Manager Humas</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 17.565.000</div></div></div></div>
                </div>

                <div class="career-slide">
                    <div class="career-card"><img src="/images/kontroler_keuangan.png"><div class="career-card-body"><h5>Kontroler Keuangan</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 17.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manajer_kepatuhan.png"><div class="career-card-body"><h5>Manajer Kepatuhan</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 17.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manajer_pengadaan.png"><div class="career-card-body"><h5>Manajer Pengadaan</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 17.500.000</div></div></div></div>
                    <div class="career-card"><img src="/images/manajer_pengembangan_bisnis.png"><div class="career-card-body"><h5>Manajer Pengembangan Bisnis</h5><div class="salary-row"><p>Gaji bulanan biasa</p><div class="salary">Rp 17.500.000</div></div></div></div>
                </div>
            </div>
        </div>

        <div class="career-btn left" onclick="moveCareerSlide(-1)" id="careerBtnLeft" style="display:none;">
            <i class="fa fa-chevron-left"></i>
        </div>
        <div class="career-btn right" onclick="moveCareerSlide(1)" id="careerBtnRight">
            <i class="fa fa-chevron-right"></i>
        </div>

        <div class="career-dots" id="careerDots"></div>
    </section>

    <!-- === Career Industry Section === -->
    <div class="career-industries">
        <h2>Telusuri karir berdasarkan industri</h2>
        <p class="subtitle">Eksplorasi gaji dan tren pekerjaan berbagai karir dari setiap industri.</p>
        
        <div class="industry-list">
            <button>Administrasi & Dukungan Perkantoran</button>
            <button>Akuntansi</button>
            <button>Asuransi & Dana Pensiun</button>
            <button>Call Center & Layanan Konsumen</button>
            <button>CEO & Manajemen Umum</button>
            <button>Desain & Arsitektur</button>
            <button>Hospitaliti & Pariwisata</button>
            <button>Hukum</button>
            <button>Kesehatan & Medis</button>
            <button>Keterampilan & Jasa</button>
        </div>

        <div class="see-more">
            <a href="#">Lihat semua industri <i class="fa fa-chevron-down"></i></a>
        </div>
    </div>

        <!-- === Career Change Section (Merubah Karir) === -->
    <div class="career-change-section">
        <div class="change-header">
            <h2>Merubah karir</h2>
            <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
        </div>

        <div class="change-cards-row">
            <div class="change-card">
                <img src="/images/resign.png" alt="Resign 1">
                <div class="change-card-body">
                    <h4>Rincian Hak-hak Karyawan Resign yang Harus Kamu Pahami</h4>
                </div>
            </div>
            <div class="change-card">
                <img src="/images/resign1.png" alt="Resign 2">
                <div class="change-card-body">
                    <h4>Pelajari di Sini! Proses Administrasi Karyawan Resign</h4>
                </div>
            </div>
            <div class="change-card">
                <img src="/images/kantoran9.png" alt="Karier Baru">
                <div class="change-card-body">
                    <h4>Cara Pindah Jalur Karier dan Tantangan Umum yang Sering...</h4>
                </div>
            </div>
            <div class="change-card">
                <img src="/images/kantoran10.png" alt="Contoh Instansi">
                <div class="change-card-body">
                    <h4>Kumpulan Contoh Instansi untuk Pilihan Berkarier</h4>
                </div>
            </div>
        </div>
    </div>

    
     <!-- === Bandingkan Gaji Section === -->
     <section class="salary-comparison-section">
    <div class="salary-comparison-header">
        <h2>Bandingkan gaji kamu</h2>
    </div>

    <form class="comparison-form-new">
        
        <div class="form-column-new">
            <label for="monthly-salary-new">Gaji bulanan kamu</label>
            <div class="salary-input-container">
                <span>Rp</span>
                <input type="text" id="monthly-salary-new" name="monthly-salary" placeholder="">
            </div>
        </div>
        
        <div class="form-column-new">
            <label for="job-position-new">Posisi pekerjaan kamu</label>
            <input type="text" id="job-position-new" name="job-position" 
                   placeholder="mis. perawat, guru, akuntan">
        </div>

        <button type="submit" class="comparison-button-new">
            Bandingkan gaji kamu
        </button>
    </form>
    </section>

     <!-- === Salary Trend Section (Tren Gaji & Profesi) === -->
<div class="salary-trend-section">
    <div class="salary-trend-header">
        <h2>Tren gaji & profesi</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="salary-trend-cards-row">
        <div class="salary-trend-card">
            <img src="/images/kantoran11.png" alt="Gaji Hotel">
            <div class="salary-trend-card-body">
                <h4>Kisaran Gaji Karyawan Hotel dari Resepsionis hingga Jabatan...</h4>
            </div>
        </div>

        <div class="salary-trend-card">
            <img src="/images/kantoran12.png" alt="UMP 2025">
            <div class="salary-trend-card-body">
                <h4>Daftar Lengkap UMP 2025 Terbaru untuk Setiap Provinsi di...</h4>
            </div>
        </div>

        <div class="salary-trend-card">
            <img src="/images/uang.png" alt="UMK Jawa Barat 2025">
            <div class="salary-trend-card-body">
                <h4>Daftar UMK Jawa Barat 2025 Terbaru, Mana yang Tertinggi?</h4>
            </div>
        </div>

        <div class="salary-trend-card">
            <img src="/images/uang1.png" alt="Perbedaan UMR UMK UMP">
            <div class="salary-trend-card-body">
                <h4>Perbedaan UMR, UMK dan UMP: Mana yang Jadi Acuan?</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Resource & Template Section (Sumber Daya dan Templat) === -->
<div class="resource-template-section">
    <div class="resource-header">
        <h2>Sumber daya dan templat</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="resource-cards-row">
        <div class="resource-card">
            <img src="/images/cv.png" alt="Contoh CV">
            <div class="resource-card-body">
                <p>10 Contoh CV Lulusan SMA dan Tips Membuatnya</p>
            </div>
        </div>

        <div class="resource-card">
            <img src="/images/surat1.png" alt="Surat Peringatan">
            <div class="resource-card-body">
                <p>10+ Contoh Surat Peringatan Karyawan: SP1, SP2, SP3</p>
            </div>
        </div>

        <div class="resource-card">
            <img src="/images/surat.png" alt="Surat Perintah Tugas">
            <div class="resource-card-body">
                <p>10+ Contoh Surat Perintah Tugas yang Biasa Dipakai di Dunia Kerja</p>
            </div>
        </div>

        <div class="resource-card">
            <img src="/images/guru.png" alt="CV Guru">
            <div class="resource-card-body">
                <p>Contoh CV Guru (GRATIS Template)</p>
            </div>
        </div>
    </div>
</div>

<!-- === Subscription Section (Berlangganan Panduan Karir) === -->
<div class="career-subscribe-section">
    <div class="career-subscribe-card">
        <h2>Berlangganan Panduan Karir</h2>
        <p>Dapatkan saran karier dari ahli yang dikirimkan ke kotak masuk Anda.</p>

        <form class="subscribe-form">
            <div class="form-group">
                <label for="firstname">Nama depan</label>
                <input type="text" id="firstname" name="firstname" placeholder="">
            </div>
            <div class="form-group">
                <label for="lastname">Nama belakang</label>
                <input type="text" id="lastname" name="lastname" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="">
            </div>
            <button type="submit">Berlangganan</button>
        </form>

        <small>
            Dengan memberikan informasi pribadi Anda, Anda menyetujui 
            <a href="#">Pemberitahuan Pengumpulan</a> dan 
            <a href="#">Kebijakan Privasi</a>. Jika Anda berusia di bawah 21 tahun, Anda memiliki izin dari orang tua agar Talenthub dan afiliasinya memproses data pribadi Anda. 
            Anda dapat berhenti berlangganan kapan saja.
        </small>
    </div>
</div>



    @include('partials.footer')

       {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        let currentCareerSlide = 0;
        const careerSlides = document.querySelectorAll('.career-slide');
        const totalCareerSlides = careerSlides.length;
        const slidesContainer = document.getElementById('careerSlides');
        const btnLeft = document.getElementById('careerBtnLeft');
        const btnRight = document.getElementById('careerBtnRight');
        const dotsContainer = document.getElementById('careerDots');

        // Generate dots
        for (let i = 0; i < totalCareerSlides; i++) {
            const dot = document.createElement('span');
            dot.addEventListener('click', () => goToCareerSlide(i));
            dotsContainer.appendChild(dot);
        }

        updateCareerDots();

        function updateCareerSlider() {
            slidesContainer.style.transform = `translateX(-${currentCareerSlide * 100}%)`;
            updateCareerDots();

            btnLeft.style.display = currentCareerSlide === 0 ? 'none' : 'block';
            btnRight.style.display = currentCareerSlide === totalCareerSlides - 1 ? 'none' : 'block';
        }

        function moveCareerSlide(direction) {
            currentCareerSlide = Math.min(Math.max(currentCareerSlide + direction, 0), totalCareerSlides - 1);
            updateCareerSlider();
        }

        function goToCareerSlide(index) {
            currentCareerSlide = index;
            updateCareerSlider();
        }

        function updateCareerDots() {
            const dots = dotsContainer.querySelectorAll('span');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentCareerSlide);
            });
        }

        updateCareerSlider();
    </script>
</body>

</html>
