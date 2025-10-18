<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* CSS Umum */
        body {
            background-color: #ffff;
        }

        /* === SLIDER STYLE (Berdasarkan permintaan) === */
        .article-slider {
            position: relative;
            max-width: 1200px;
            margin: 50px auto 60px auto;
            overflow: visible;
            border-radius: 12px;
        }

        .article-slides-wrapper {
            overflow: hidden;
            border-radius: 12px;
        }

        .article-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .article-slide {
            min-width: 100%;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .article-slide img {
            width: 50%;
            height: 350px; /* Memaksa semua gambar memiliki ukuran yang sama */
            object-fit: cover; /* Memastikan gambar menutupi area tanpa terdistorsi */
        }

        .article-content {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .article-content h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .article-content a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .article-content a:hover {
            text-decoration: underline;
        }

        /* Navigation Arrows (Berdasarkan permintaan) */
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .slider-btn:hover {
            background: #f1f1f1;
        }

        .slider-btn.left {
            left: -50px;
        }

        .slider-btn.right {
            right: -50px;
        }
        
        /* Adjustments for smaller screens */
        @media (max-width: 1200px) {
            .slider-btn.left {
                left: 10px; /* Geser panah ke dalam jika lebar layar kurang dari max-width */
            }
            .slider-btn.right {
                right: 10px; /* Geser panah ke dalam jika lebar layar kurang dari max-width */
            }
        }
        
        @media (max-width: 768px) {
            .article-slide {
                flex-direction: column;
            }
            .article-slide img, .article-content {
                width: 100%;
                height: 250px; /* Tinggi gambar disesuaikan */
            }
            .article-content {
                padding: 20px;
                height: auto;
            }
        }

        /* Pagination dots (Berdasarkan permintaan) */
        .slider-dots {
            text-align: center;
            margin-top: -40px;
        }

        .slider-dots span {
            display: inline-block;
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #d1d1d1;
            border-radius: 50%;
            cursor: pointer;
        }

        .slider-dots .active {
            background-color: #0b0b54;
        }

        /* === CAREER SUGGESTIONS SECTION (DISESUAIKAN AGAR SAMA DENGAN 3 CARDS SECTION) === */
        .career-suggestions {
            width: 100%;
            padding: 60px 40px; /* Sama dengan .career-cards → jarak kiri-kanan 40px */
            margin: 30px auto 60px auto; /* Sama persis dengan .career-cards */
            margin-top: 30px;
            box-sizing: border-box;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            min-height: 120px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .career-suggestion-card:hover {
            transform: translateY(-2px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
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

        /* Responsif agar tampil rapi di layar kecil */
        @media (max-width: 992px) {
            .career-suggestions {
                padding: 40px 20px; /* tetap proporsional dengan versi besar */
                margin-top: 60px;
                margin-bottom: 60px;
            }
            .career-suggestions .row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .career-suggestions {
                padding: 40px 15px;
            }
        }

                /* === SARAN KARIR TERBARU SECTION (DISESUAIKAN DENGAN .career-cards) === */
        .career-latest-advice-section {
            width: 100%; /* Lebar penuh */
            padding: 60px 40px; /* Sama seperti .career-cards → 40px kanan–kiri, 60px atas–bawah */
            margin: 30px auto 60px auto; /* Jarak antar section sama seperti .career-cards */
            margin-top: -50px;
            box-sizing: border-box; 
            background: #fff; /* opsional: untuk menjaga konsistensi tampilan section */
        }

        /* Wrapper agar isi di tengah */
        .advice-wrapper {
            width: 100%;
            margin: 0 auto;
        }

        /* Header bagian atas */
        .advice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 0; 
        }

        .advice-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .advice-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .advice-header a:hover {
            text-decoration: underline;
        }

        /* Card Utama/Besar */
        .main-advice-card {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .main-advice-card img {
            width: 60%; 
            height: 350px; 
            object-fit: cover;
            flex-shrink: 0;
        }

        .main-advice-content {
            width: 40%; 
            padding: 50px 40px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-advice-content h3 {
            font-size: 26px; 
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
            line-height: 1.3;
        }

        .main-advice-content a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            margin-top: 10px;
            font-size: 16px;
        }

        .main-advice-content a:hover {
            text-decoration: underline;
        }

        /* 4 Kartu Kecil di Bawah */
        .small-advice-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            padding: 0;
        }

        .small-advice-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            flex: 1; 
            max-width: calc(25% - 15px);
            min-height: 250px; 
            display: flex;
            flex-direction: column;
        }

        .small-advice-card img {
            width: 100%;
            height: 150px; 
            object-fit: cover;
            flex-shrink: 0;
        }

        .small-advice-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .small-advice-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

        /* Responsif */
        @media (max-width: 992px) {
            .main-advice-card {
                flex-direction: column;
            }

            .main-advice-card img,
            .main-advice-content {
                width: 100%;
                height: auto;
            }

            .main-advice-card img {
                height: 250px;
            }

            .main-advice-content {
                padding: 30px 20px;
            }

            .small-advice-cards-row {
                flex-wrap: wrap;
                gap: 15px;
            }

            .small-advice-card {
                max-width: calc(50% - 7.5px);
                min-height: auto;
            }

            .small-advice-card img {
                height: 180px;
            }

            .career-latest-advice-section {
                padding: 40px 20px;
                margin: 20px auto 40px auto;
            }
        }

        @media (max-width: 576px) {
            .small-advice-card {
                max-width: 100%;
            }

            .small-advice-card img {
                height: 200px;
            }

            .career-latest-advice-section {
                padding: 30px 15px;
                margin: 20px auto 40px auto;
            }
        }

                /* === APPLY JOB SECTION (Melamar pekerjaan) === */
        .apply-job-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 30px;
        }

        .apply-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .apply-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .apply-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .apply-header a:hover {
            text-decoration: underline;
        }

        .apply-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .apply-card {
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

        .apply-card img {
            width: 100%;
            height: 180px; /* Memastikan semua gambar sama tinggi */
            object-fit: cover; /* Agar gambar tidak terdistorsi */
            flex-shrink: 0;
        }

        .apply-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .apply-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

        /* Responsif agar rapi di layar kecil */
        @media (max-width: 992px) {
            .apply-cards-row {
                flex-wrap: wrap;
                gap: 15px;
            }

            .apply-card {
                flex: 1 1 calc(50% - 15px);
                min-height: 200px;
            }

            .apply-card img {
                height: 160px;
            }
        }

        @media (max-width: 576px) {
            .apply-cards-row {
                flex-direction: column;
            }

            .apply-card {
                width: 100%;
            }

            .apply-card img {
                height: 200px;
            }
        }

                /* === Resume Section (Seperti JobStreet) === */
        .resume-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 100px;
        }

        .resume-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .resume-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .resume-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .resume-header a:hover {
            text-decoration: underline;
        }

        .resume-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .resume-card {
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

        .resume-card img {
            width: 100%;
            height: 180px; /* Paksa semua gambar sama ukuran */
            object-fit: cover;
            flex-shrink: 0;
        }

        .resume-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .resume-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

                /* === Cover Letters Section (Seperti JobStreet) === */
        .cover-letter-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 100px;
        }

        .cover-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .cover-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .cover-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .cover-header a:hover {
            text-decoration: underline;
        }

        .cover-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .cover-card {
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

        .cover-card img {
            width: 100%;
            height: 180px; /* Semua gambar sama tinggi */
            object-fit: cover;
            flex-shrink: 0;
        }

        .cover-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .cover-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

                /* === Interview Section (Seperti JobStreet) === */
        .interview-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 100px;
        }

        .interview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .interview-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .interview-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .interview-header a:hover {
            text-decoration: underline;
        }

        .interview-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .interview-card {
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

        .interview-card img {
            width: 100%;
            height: 180px; /* Paksa semua gambar sama tinggi */
            object-fit: cover;
            flex-shrink: 0;
        }

        .interview-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .interview-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

          /* === Interview Practice Section === */
        .interview-practice-section {
            width: 95%; /* beri ruang di kanan dan kiri */
            background-color: #5564cc; /* warna biru seperti di gambar */
            border-radius: 16px;
            margin: 80px auto;
            margin-top: 100px;  
            padding: 80px 100px; /* perbesar isi card */
            box-sizing: border-box;
        }

        .interview-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 60px; /* beri jarak lebih lebar antara teks dan gambar */
        }

        .interview-text {
            flex: 1;
            color: #fff;
        }

        .interview-text h2 {
            font-size: 30px; /* lebih besar */
            font-weight: 600;
            margin-bottom: 15px;
        }

        .interview-text p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #f0f0f0;
            white-space: nowrap; /* supaya kalimat tidak turun ke baris baru */
        }

        .interview-text button {
            background: #fff;
            color: #0b0b54;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .interview-text button:hover {
            background: #f5f5f5;
        }

        .interview-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .interview-image img {
            max-width: 100%;
            height: auto;
            width: 420px; /* ikon lebih besar dari sebelumnya */
            object-fit: contain;
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

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Header Pencarian (Jobstreet Style) --}}
    @include('partials.header_career')
    
    {{-- Main Content - Slider Section --}}
    <div class="article-slider">
        <div class="article-slides-wrapper">
            <div class="article-slides">
                {{-- Slide 1: Negosiasi Gaji (Ganti dengan konten dari image_0a09a7.png) --}}
                <div class="article-slide">
                    <img src="{{ asset('images/interview.png') }}" alt="Slide 1: Wawancara Kerja" loading="lazy">
                    <div class="article-content">
                        <h3>3 Cara Negosiasi Gaji saat Interview Kerja Lengkap dengan Contohnya</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                {{-- Slide 2: Kapan Anda Siap Bekerja? (Ganti dengan konten dari image_0a09e4.png) --}}
                <div class="article-slide">
                    <img src="{{ asset('images/interview1.png') }}" alt="Slide 2: Negosiasi Gaji" loading="lazy">
                    <div class="article-content">
                        <h3>Kapan Anda Siap Bekerja? Ini 13+ Contoh Jawaban dan Tipsnya</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                {{-- Slide 3: Panel Interview (Ganti dengan konten dari image_0a0a05.png) --}}
                <div class="article-slide">
                    <img src="{{ asset('images/interview2.png') }}" alt="Slide 3: Panel Interview" loading="lazy">
                    <div class="article-content">
                        <h3>Panel Interview: Arti, Tujuan, Contoh Pertanyaan, dan Strateginya</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                {{-- Slide 4: Jurusan Pariwisata (Ganti dengan konten dari image_0a0a26.png) --}}
                <div class="article-slide">
                    <img src="{{ asset('images/interview3.png') }}" alt="Slide 4: Jurusan Pariwisata" loading="lazy">
                    <div class="article-content">
                        <h3>Prospek Kerja dan Pertanyaan Interview Jurusan Pariwisata</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation Arrows (Fa Icon) --}}
        <div class="slider-btn left" onclick="moveSlide(-1)" id="btnLeft" style="display:none;">
            <i class="fa fa-chevron-left"></i>
        </div>
        <div class="slider-btn right" onclick="moveSlide(1)" id="btnRight">
            <i class="fa fa-chevron-right"></i>
        </div>
    </div>

    {{-- Pagination Dots --}}
    <div class="slider-dots" id="sliderDots"></div>
    
    <!-- === CAREER SUGGESTIONS SECTION === -->
    <div class="career-suggestions">
        <div class="row">
            <div class="career-suggestion-card">
                <img src="{{ asset('images/resume.png') }}" alt="Ikon Resume">
                <div>
                    <h5>Resume</h5>
                    <p>Baca artikel terbaru kami dengan tip tentang yang harus disertakan dalam resume Anda.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="{{ asset('images/resume1.png') }}" alt="Ikon Surat lamaran kerja">
                <div>
                    <h5>Surat lamaran kerja</h5>
                    <p>Baca artikel terbaru kami tentang cara menulis surat lamaran kerja yang menarik.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="{{ asset('images/resume2.png') }}" alt="Ikon Alat praktik wawancara">
                <div>
                    <h5>Alat praktik wawancara</h5>
                    <p>Persiapkan wawancara Anda selanjutnya dengan latihan pertanyaan umum.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="{{ asset('images/icon7.png') }}" alt="Ikon Telusuri karier berdasarkan industri">
                <div>
                    <h5>Telusuri karier berdasarkan industri</h5>
                    <p>Jelajahi tren pekerjaan dan gaji di berbagai karier dari setiap industri.</p>
                </div>
            </div>
        </div>
    </div>

        {{-- === SARAN KARIR TERBARU SECTION (Mencari pekerjaan untukmu) === --}}
    <div class="career-latest-advice-section">
        <div class="advice-wrapper">
            <div class="advice-header">
                <h2>Mencari pekerjaan untukmu</h2>
                <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
            </div>

            {{-- Card Utama --}}
            <div class="main-advice-card">
                <img src="{{ asset('images/fisika.png') }}" alt="Prospek Kerja Jurusan Fisika">
                <div class="main-advice-content">
                    <h3>Prospek Kerja Jurusan Fisika dan Kisaran Gajinya</h3>
                    <a href="#">Cari tahu selengkapnya</a>
                </div>
            </div>

            {{-- 4 Kartu Kecil --}}
            <div class="small-advice-cards-row">
                <div class="small-advice-card">
                    <img src="{{ asset('images/sosiologi.png') }}" alt="Prospek Kerja Jurusan Sosiologi">
                    <div class="small-advice-card-body">
                        <h4>Prospek Kerja Jurusan Sosiologi dan Kisaran Gajinya</h4>
                    </div>
                </div>

                <div class="small-advice-card">
                    <img src="{{ asset('images/medis.png') }}" alt="Prospek Kerja Jurusan Rekam Medis">
                    <div class="small-advice-card-body">
                        <h4>9 Prospek Kerja Jurusan Rekam Medis dan Kisaran Gajinya</h4>
                    </div>
                </div>

                <div class="small-advice-card">
                    <img src="{{ asset('images/jurnalistik.png') }}" alt="Prospek Kerja Jurusan Jurnalistik">
                    <div class="small-advice-card-body">
                        <h4>14+ Prospek Kerja Jurusan Jurnalistik: Kisaran Gaji, Skill, da...</h4>
                    </div>
                </div>

                <div class="small-advice-card">
                    <img src="{{ asset('images/hotel.png') }}" alt="Prospek Kerja Jurusan Perhotelan SMK">
                    <div class="small-advice-card-body">
                        <h4>19+ Prospek Kerja Jurusan Perhotelan SMK: Kisaran Gaji da...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- === APPLY JOB SECTION (Melamar pekerjaan) === -->
    <div class="apply-job-section">
        <div class="apply-header">
            <h2>Melamar pekerjaan</h2>
            <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
        </div>

        <div class="apply-cards-row">
            <div class="apply-card">
                <img src="{{ asset('images/laptop.png') }}" alt="Melamar Dua Posisi">
                <div class="apply-card-body">
                    <h4>Bolehkah Melamar Dua Posisi di Satu Perusahaan? Cek di Sini!</h4>
                </div>
            </div>

            <div class="apply-card">
                <img src="{{ asset('images/laptop1.png') }}" alt="Contoh Subjek Email">
                <div class="apply-card-body">
                    <h4>20+ Contoh Subjek Email Lamaran Kerja & Cara Mengisinya</h4>
                </div>
            </div>

            <div class="apply-card">
                <img src="{{ asset('images/laptop2.png') }}" alt="Cara Melamar Kerja Lewat Email">
                <div class="apply-card-body">
                    <h4>Cara Melamar Kerja Lewat Email: Inilah Contoh dan Tipsnya</h4>
                </div>
            </div>

            <div class="apply-card">
                <img src="{{ asset('images/laptop3.png') }}" alt="Ghost Job">
                <div class="apply-card-body">
                    <h4>5 Cara Menghindari Ghost Job saat Melamar Kerja</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- === Resume Section (Seperti JobStreet) === -->
<div class="resume-section">
    <div class="resume-header">
        <h2>Resumes</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="resume-cards-row">
        <div class="resume-card">
            <img src="/images/cv1.png" alt="CV 1">
            <div class="resume-card-body">
                <h4>Cara Membuat CV Lamaran Kerja yang Menarik dan Profesional</h4>
            </div>
        </div>
        <div class="resume-card">
            <img src="/images/cv2.png" alt="CV 2">
            <div class="resume-card-body">
                <h4>Resume Lamaran Kerja: Ini Contoh dan Cara Membuatnya</h4>
            </div>
        </div>
        <div class="resume-card">
            <img src="/images/cv3.png" alt="CV 3">
            <div class="resume-card-body">
                <h4>Cara Membuat CV yang Ringkas dan Efektif untuk Melamar Kerja</h4>
            </div>
        </div>
        <div class="resume-card">
            <img src="/images/cv4.png" alt="CV 4">
            <div class="resume-card-body">
                <h4>3 Contoh CV Customer Service yang Menarik dan Cara...</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Cover Letters Section (Seperti JobStreet) === -->
<div class="cover-letter-section">
    <div class="cover-header">
        <h2>Cover letters</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="cover-cards-row">
        <div class="cover-card">
            <img src="/images/cover.png" alt="Cover 1">
            <div class="cover-card-body">
                <h4>10+ Contoh Application Letter yang Menarik dan Cara...</h4>
            </div>
        </div>
        <div class="cover-card">
            <img src="/images/cover1.png" alt="Cover 2">
            <div class="cover-card-body">
                <h4>10+ Contoh Surat Lamaran Kerja Tulis Tangan untuk Kerja di Pabrik</h4>
            </div>
        </div>
        <div class="cover-card">
            <img src="/images/cover2.png" alt="Cover 3">
            <div class="cover-card-body">
                <h4>29+ Contoh Surat Lamaran Kerja yang Baik dan Benar</h4>
            </div>
        </div>
        <div class="cover-card">
            <img src="/images/cover3.png" alt="Cover 4">
            <div class="cover-card-body">
                <h4>13 Contoh Surat Lamaran Kerja Tulis Tangan & Tips Membuatnya</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Interview Section (Seperti JobStreet) === -->
<div class="interview-section">
    <div class="interview-header">
        <h2>Interview pekerjaan</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="interview-cards-row">
        <div class="interview-card">
            <img src="/images/interview.png" alt="Interview 1">
            <div class="interview-card-body">
                <h4>3 Cara Negosiasi Gaji saat Interview Kerja Lengkap dengan Contohnya</h4>
            </div>
        </div>
        <div class="interview-card">
            <img src="/images/interview1.png" alt="Interview 2">
            <div class="interview-card-body">
                <h4>Kapan Anda Siap Bekerja? Ini 13+ Contoh Jawaban dan Tipsnya</h4>
            </div>
        </div>
        <div class="interview-card">
            <img src="/images/interview2.png" alt="Interview 3">
            <div class="interview-card-body">
                <h4>Panel Interview: Arti, Tujuan, Contoh Pertanyaan, dan Strateginya</h4>
            </div>
        </div>
        <div class="interview-card">
            <img src="/images/interview3.png" alt="Interview 4">
            <div class="interview-card-body">
                <h4>Prospek Kerja dan Pertanyaan Interview Jurusan Pariwisata</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Interview Practice Section === -->
<div class="interview-practice-section">
    <div class="interview-content">
        <div class="interview-text">
            <h2>Bersiap-siap untuk wawancara?</h2>
            <p>Bangun rasa percaya diri Anda dengan latihan menjawab pertanyaan umum.</p>
            <button>Alat praktik wawancara</button>
        </div>
        <div class="interview-image">
            <img src="/images/icon5.png" alt="Alat Praktik Wawancara">
        </div>
    </div>
</div>

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

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Slider Logic (Berdasarkan permintaan) --}}
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.article-slide');
        const totalSlides = slides.length;
        const slidesContainer = document.querySelector('.article-slides');
        const btnLeft = document.getElementById('btnLeft');
        const btnRight = document.getElementById('btnRight');
        const dotsContainer = document.getElementById('sliderDots');

        // Generate dots
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('span');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
        
        // Memastikan tombol panah dan dot diperbarui saat pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            updateSlider();
        });


        function updateSlider() {
            slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
            updateDots();

            // Logika untuk menampilkan/menyembunyikan tombol
            btnLeft.style.display = currentSlide === 0 ? 'none' : 'block';
            btnRight.style.display = currentSlide === totalSlides - 1 ? 'none' : 'block';
        }

        function moveSlide(direction) {
            currentSlide = Math.min(Math.max(currentSlide + direction, 0), totalSlides - 1);
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function updateDots() {
            const dots = dotsContainer.querySelectorAll('span');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        updateSlider(); // Panggil pertama kali untuk inisialisasi
    </script>
</body>
</html>