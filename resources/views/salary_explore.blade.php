<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajahi Gaji | Next Jobz</title>
    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajahi Gaji | Next Jobz</title>
    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* CSS Umum */
        body {
            background-color: #fff;
        }

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
            margin-bottom: 25px;
        }

        .salary-form {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 20px;
        }

        .salary-form .form-group {
            flex: 1;
            min-width: 250px;
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
        }

        .salary-card .btn-compare {
            background-color: #fff;
            color: #0b0b54;
            border: none;
            border-radius: 8px;
            height: 48px;
            font-size: 16px;
            font-weight: 600;
            padding: 0 30px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .salary-card .btn-compare:hover {
            background-color: #f1f1f1;
        }

        /* === SECTION KARIER DAN GAJI (4 KOTAK) === */
        .career-info-section {
            width: 100%;
            padding: 0;
            margin: 100px auto 60px auto;
            display: flex;
            justify-content: center;
            box-sizing: border-box;
        }

        .career-info-container {
            width: calc(100% - 80px);
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 20px;
        }

        .career-info-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: box-shadow 0.3s ease;
        }

        .career-info-card:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .career-info-card img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .career-info-text h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .career-info-text p {
            font-size: 16px;
            color: #555;
            margin: 0;
            line-height: 1.4;
        }

        /* === SECTION: KARIER DENGAN GAJI TINGGI === */
        .career-highsalary-section {
            width: 100%;
            padding: 0;
            margin: 100px auto 60px auto;
            display: flex;
            justify-content: center;
            box-sizing: border-box;
        }

        .career-highsalary-container {
            width: calc(100% - 80px);
        }

        .career-highsalary-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .career-highsalary-header p {
            color: #555;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .career-highsalary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .career-highsalary-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .career-highsalary-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .career-highsalary-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .career-highsalary-body {
            padding: 15px 18px 18px 18px;
        }

        .career-highsalary-body h3 {
            font-size: 17px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        /* --- baris kedua: label & nominal gaji sejajar --- */
        .career-highsalary-salaryline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2px;
        }

        .career-highsalary-salaryline p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }

        .career-highsalary-salaryline .salary {
            font-size: 15px;
            font-weight: 500;
            color: #333;
            margin: 0;
        }

        .career-highsalary-footer {
            text-align: center;
            margin-top: 28px;
        }

        .career-highsalary-footer a {
            color: #0b0b54;
            font-weight: 600;
            text-decoration: none;
            font-size: 17px;
        }

        .career-highsalary-footer a:hover {
            text-decoration: none;
        }

        @media (max-width: 992px) {
            .career-info-container {
                grid-template-columns: 1fr;
            }
            .career-highsalary-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .salary-card {
                padding: 40px 30px;
            }
            .salary-form {
                flex-direction: column;
            }
            .career-info-container,
            .career-highsalary-container {
                width: calc(100% - 40px);
            }
            .career-highsalary-grid {
                grid-template-columns: 1fr;
            }
        }

        /* === Career Industry Section === */
        .career-industries {
            width: 100%;
            padding: 0 40px;
            margin: 60px auto;
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
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
        }

        .industry-list button {
            border: 1px solid #dcdcdc;
            border-radius: 999px;
            background: #fff;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: 500;
            color: #222;
            cursor: pointer;
            transition: background 0.2s ease;
            width: 100%;
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

        /* === Career Change Section (Merubah Karir) - TATA LETAK REFERENSI === */
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
            height: 180px;
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
        
        /* === TREN GAJI & PROFESI SECTION (BARU) - DUPLIKASI GAYA DARI .career-change-section === */
        .career-salarytrend-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 100px;
        }

        .salarytrend-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .salarytrend-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .salarytrend-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .salarytrend-header a:hover {
            text-decoration: underline;
        }

        .salarytrend-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .salarytrend-card {
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

        .salarytrend-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .salarytrend-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .salarytrend-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

        /* Responsif untuk card baru */
        @media (max-width: 992px) {
            .change-cards-row, .salarytrend-cards-row {
                flex-wrap: wrap;
            }
            .change-card, .salarytrend-card {
                max-width: calc(50% - 10px);
                min-height: auto;
            }
        }
        @media (max-width: 576px) {
            .change-card, .salarytrend-card {
                max-width: 100%;
            }
        }

        /* === Interview Practice Section === */
        .interview-practice-section {
            width: 95%;
            background-color: #5564cc;
            border-radius: 16px;
            margin: 80px auto;
            margin-top: 100px;
            padding: 80px 100px;
            box-sizing: border-box;
        }

        .interview-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 60px;
        }

        .interview-text {
            flex: 1;
            color: #fff;
        }

        .interview-text h2 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .interview-text p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #f0f0f0;
            white-space: nowrap;
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
            width: 420px;
            object-fit: contain;
        }

        /* ========================================================== */
        /* CSS UNTUK BAGIAN SUMBER DAYA DAN TEMPLAT (SUDAH SEJAJAR) */
        /* ========================================================== */
        .resource-template-section {
            width: 100%;
            padding: 0 40px;
            margin: 80px auto;
            margin-top: 100px;
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
            height: 180px;
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

        /* === Saran Gaji Section (Sama seperti JobStreet) === */
        .salary-advice-section {
            width: 100%;
            padding: 60px 40px;
            margin: 30px auto 60px auto;
            margin-top: -50px;
            box-sizing: border-box;
            background: #fff;
        }

        .salary-advice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .salary-advice-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .salary-advice-header a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .salary-advice-header a:hover {
            text-decoration: underline;
        }

        .salary-advice-cards-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .salary-advice-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-height: 230px;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .salary-advice-card:hover {
            transform: translateY(-3px);
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
        }

        .salary-advice-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .salary-advice-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .salary-advice-card-body h4 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin: 0;
        }

        @media (max-width: 992px) {
            .salary-advice-cards-row {
                flex-wrap: wrap;
            }
            .salary-advice-card {
                flex: 1 1 calc(50% - 10px);
            }
        }

        @media (max-width: 576px) {
            .salary-advice-card {
                flex: 1 1 100%;
            }
        }

        /* === Subscription Section (Berlangganan Panduan Karir) === */
        .career-subscribe-section {
            width: 100%;
            padding: 60px 40px;
            margin: 30px auto 60px auto;
            margin-top: -70px;
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
            text-decoration: underline;
            font-weight: 500;
        }

        .career-subscribe-section small a:hover {
            text-decoration: underline;
        }
    </style>
</head>
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Header Pencarian --}}
    @include('partials.header_career')

    {{-- === SECTION: BANDINKAN GAJI KAMU === --}}
    <section class="career-salary-section">
        <div class="salary-card">
            <h2>Bandingkan gaji kamu</h2>
            <form action="#" method="GET" class="salary-form">
                <div class="form-group">
                    <label for="gaji">Gaji bulanan kamu</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" id="gaji" class="form-control" value="5.750.000">
                    </div>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi pekerjaan kamu</label>
                    <input type="text" id="posisi" class="form-control" placeholder="mis. perawat, guru, akuntan">
                </div>
                <button type="submit" class="btn-compare">Bandingkan gaji kamu</button>
            </form>
        </div>
    </section>

    {{-- === SECTION: INFORMASI KARIER DAN GAJI === --}}
    <section class="career-info-section">
        <div class="career-info-container">
            <div class="career-info-card">
                <img src="{{ asset('images/icon2.png') }}" alt="Karier dengan gaji tinggi">
                <div class="career-info-text">
                    <h3>Karier dengan gaji tinggi</h3>
                    <p>Pelajari selengkapnya tentang karier dengan bayaran tertinggi di Indonesia.</p>
                </div>
            </div>

            <div class="career-info-card">
                <img src="{{ asset('images/icon7.png') }}" alt="Telusuri karier berdasarkan industri">
                <div class="career-info-text">
                    <h3>Telusuri karier berdasarkan industri</h3>
                    <p>Jelajahi tren pekerjaan dan gaji di berbagai karier dari setiap industri.</p>
                </div>
            </div>

            <div class="career-info-card">
                <img src="{{ asset('images/icon8.png') }}" alt="Tren pekerjaan dan gaji">
                <div class="career-info-text">
                    <h3>Tren pekerjaan dan gaji</h3>
                    <p>Baca artikel terbaru kami tentang tren pekerjaan dan gaji di berbagai industri.</p>
                </div>
            </div>

            <div class="career-info-card">
                <img src="{{ asset('images/resume2.png') }}" alt="Alat praktik wawancara">
                <div class="career-info-text">
                    <h3>Alat praktik wawancara</h3>
                    <p>Persiapkan wawancara Anda selanjutnya dengan latihan pertanyaan umum.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- === SECTION: KARIER DENGAN GAJI TINGGI === --}}
    <section class="career-highsalary-section">
        <div class="career-highsalary-container">
            <div class="career-highsalary-header">
                <h2>Karier dengan gaji tinggi</h2>
                <p>Jelajahi karier bergaji tinggi dengan gaji per bulan khususnya di atas Rp 10 jt.</p>
            </div>

            <div class="career-highsalary-grid">
                <div class="career-highsalary-card">
                    <img src="{{ asset('images/direktur_utama.png') }}" alt="Direktur Utama">
                    <div class="career-highsalary-body">
                        <h3>Direktur Utama</h3>
                        <div class="career-highsalary-salaryline">
                            <p>Gaji bulanan biasa</p>
                            <div class="salary">Rp 62.500.000</div>
                        </div>
                    </div>
                </div>

                <div class="career-highsalary-card">
                    <img src="{{ asset('images/direktur_operasi.png') }}" alt="Direktur Operasi">
                    <div class="career-highsalary-body">
                        <h3>Direktur Operasi</h3>
                        <div class="career-highsalary-salaryline">
                            <p>Gaji bulanan biasa</p>
                            <div class="salary">Rp 35.000.000</div>
                        </div>
                    </div>
                </div>

                <div class="career-highsalary-card">
                    <img src="{{ asset('images/direktur_keuangan.png') }}" alt="Direktur Keuangan">
                    <div class="career-highsalary-body">
                        <h3>Direktur Keuangan</h3>
                        <div class="career-highsalary-salaryline">
                            <p>Gaji bulanan biasa</p>
                            <div class="salary">Rp 27.500.000</div>
                        </div>
                    </div>
                </div>

                <div class="career-highsalary-card">
                    <img src="{{ asset('images/manajer_umum.png') }}" alt="Manajer Umum">
                    <div class="career-highsalary-body">
                        <h3>Manajer Umum</h3>
                        <div class="career-highsalary-salaryline">
                            <p>Gaji bulanan biasa</p>
                            <div class="salary">Rp 25.500.000</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="career-highsalary-footer">
                <a href="#">Telusuri semua <i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
    </section>

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

    <div class="career-salarytrend-section">
        <div class="salarytrend-header">
            <h2>Tren gaji & profesi</h2>
            <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
        </div>

        <div class="salarytrend-cards-row">
            <div class="salarytrend-card">
                <img src="/images/kantoran11.png" alt="Karyawan Hotel">
                <div class="salarytrend-card-body">
                    <h4>Kisaran Gaji Karyawan Hotel dari Resepsionis hingga Jabatan...</h4>
                </div>
            </div>
            <div class="salarytrend-card">
                <img src="/images/kantoran12.png" alt="UMP 2025">
                <div class="salarytrend-card-body">
                    <h4>Daftar Lengkap UMP 2025 Terbaru untuk Setiap Provinsi di...</h4>
                </div>
            </div>
            <div class="salarytrend-card">
                <img src="/images/uang.png" alt="UMK Jawa Barat">
                <div class="salarytrend-card-body">
                    <h4>Daftar UMK Jawa Barat 2025 Terbaru, Mana yang Tertinggi?</h4>
                </div>
            </div>
            <div class="salarytrend-card">
                <img src="/images/uang1.png" alt="Perbedaan UMR, UMK, dan UMP">
                <div class="salarytrend-card-body">
                    <h4>Perbedaan UMR, UMK dan UMP: Mana yang Jadi Acuan?</h4>
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
    
        <!-- === Saran Gaji Section (Sama seperti JobStreet) === -->
    <div class="salary-advice-section">
        <div class="salary-advice-header">
            <h2>Saran gaji</h2>
            <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
        </div>

        <div class="salary-advice-cards-row">
            <div class="salary-advice-card">
                <img src="{{ asset('images/kantoran13.png') }}" alt="Kenaikan Gaji">
                <div class="salary-advice-card-body">
                    <h4>Kenaikan Gaji: Ini Cara Negosiasi, Alasan, dan Persentasenya</h4>
                </div>
            </div>

            <div class="salary-advice-card">
                <img src="{{ asset('images/uang4.png') }}" alt="Gaji Prorata">
                <div class="salary-advice-card-body">
                    <h4>Gaji Prorata: Pengertian, Jenis, Rumus, dan Cara Hitung</h4>
                </div>
            </div>

            <div class="salary-advice-card">
                <img src="{{ asset('images/uang3.png') }}" alt="UMK Adalah">
                <div class="salary-advice-card-body">
                    <h4>UMK Adalah Standar Gaji Minimum: Ini Pentingnya UMK...</h4>
                </div>
            </div>

            <div class="salary-advice-card">
                <img src="{{ asset('images/uang2.png') }}" alt="Passive Income">
                <div class="salary-advice-card-body">
                    <h4>20+ Contoh Passive Income untuk Karyawan & Tips...</h4>
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

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>