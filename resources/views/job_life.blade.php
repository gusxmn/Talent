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
            height: 350px;
            object-fit: cover;
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

        @media (max-width: 1200px) {
            .slider-btn.left {
                left: 10px;
            }

            .slider-btn.right {
                right: 10px;
            }
        }

        @media (max-width: 768px) {
            .article-slide {
                flex-direction: column;
            }

            .article-slide img,
            .article-content {
                width: 100%;
                height: 250px;
            }

            .article-content {
                padding: 20px;
                height: auto;
            }
        }

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

        /* === CAREER SUGGESTIONS SECTION (Baru, sama seperti contoh) === */
        .career-suggestions {
            width: 100%;
            padding: 60px 40px;
            margin: 30px auto 60px auto;
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

        @media (max-width: 992px) {
            .career-suggestions {
                padding: 40px 20px;
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

            /* === PENGEMBANGAN KARIR SECTION === */
    .career-development-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .development-wrapper {
        width: 100%;
        margin: 0 auto;
    }

    .development-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .development-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .development-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 20px;
        display: flex;
        align-items: center;
    }

    .development-header a:hover {
        text-decoration: underline;
    }

    /* Kartu utama */
    .main-development-card {
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

    .main-development-card img {
        width: 60%;
        height: 350px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .main-development-content {
        width: 40%;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .main-development-content h3 {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
        line-height: 1.3;
    }

    .main-development-content a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        margin-top: 10px;
        font-size: 16px;
    }

    .main-development-content a:hover {
        text-decoration: underline;
    }

    /* 4 kartu kecil */
    .small-development-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
        padding: 0;
    }

    .small-development-card {
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

    .small-development-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .small-development-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .small-development-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    /* Responsif */
    @media (max-width: 992px) {
        .main-development-card {
            flex-direction: column;
        }

        .main-development-card img,
        .main-development-content {
            width: 100%;
            height: auto;
        }

        .main-development-card img {
            height: 250px;
        }

        .main-development-content {
            padding: 30px 20px;
        }

        .small-development-cards-row {
            flex-wrap: wrap;
            gap: 15px;
        }

        .small-development-card {
            max-width: calc(50% - 7.5px);
            min-height: auto;
        }

        .small-development-card img {
            height: 180px;
        }

        .career-development-section {
            padding: 40px 20px;
        }
    }

    @media (max-width: 576px) {
        .small-development-card {
            max-width: 100%;
        }

        .small-development-card img {
            height: 200px;
        }

        .career-development-section {
            padding: 30px 15px;
        }
    }

        /* === KESEJAHTERAAN DI TEMPAT KERJA SECTION === */
    .wellbeing-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .wellbeing-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .wellbeing-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .wellbeing-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .wellbeing-header a:hover {
        text-decoration: underline;
    }

    .wellbeing-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .wellbeing-card {
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

    .wellbeing-card img {
        width: 100%;
        height: 180px; /* Paksa semua gambar sama ukuran */
        object-fit: cover;
        flex-shrink: 0;
    }

    .wellbeing-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .wellbeing-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    @media (max-width: 992px) {
        .wellbeing-cards-row {
            flex-wrap: wrap;
        }

        .wellbeing-card {
            flex: 1 1 calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .wellbeing-card {
            flex: 1 1 100%;
        }
    }

        /* === Hubungan Kerja Section (Seperti JobStreet) === */
    .work-relationship-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .work-relationship-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .work-relationship-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .work-relationship-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .work-relationship-header a:hover {
        text-decoration: underline;
    }

    .work-relationship-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .work-relationship-card {
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

    .work-relationship-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
    }

    .work-relationship-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .work-relationship-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .work-relationship-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
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
        height: 180px; /* Paksa semua gambar sama */
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

        /* === Keterampilan di Tempat Kerja Section (Sama seperti JobStreet) === */
    .work-skills-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .work-skills-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .work-skills-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .work-skills-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .work-skills-header a:hover {
        text-decoration: underline;
    }

    .work-skills-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .work-skills-card {
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

    .work-skills-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
    }

    .work-skills-card img {
        width: 100%;
        height: 180px; /* Samakan semua ukuran gambar */
        object-fit: cover;
        flex-shrink: 0;
    }

    .work-skills-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .work-skills-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    @media (max-width: 992px) {
        .work-skills-cards-row {
            flex-wrap: wrap;
        }

        .work-skills-card {
            flex: 1 1 calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .work-skills-card {
            flex: 1 1 100%;
        }
    }

        /* === Kepemimpinan Section (Sama seperti JobStreet) === */
    .leadership-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .leadership-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .leadership-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .leadership-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .leadership-header a:hover {
        text-decoration: underline;
    }

    .leadership-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .leadership-card {
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

    .leadership-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
    }

    .leadership-card img {
        width: 100%;
        height: 180px; /* Paksa semua gambar sama ukuran */
        object-fit: cover;
        flex-shrink: 0;
    }

    .leadership-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .leadership-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    @media (max-width: 992px) {
        .leadership-cards-row {
            flex-wrap: wrap;
        }

        .leadership-card {
            flex: 1 1 calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .leadership-card {
            flex: 1 1 100%;
        }
    }

        /* === Kehilangan Pekerjaan Section (Sama seperti JobStreet) === */
    .jobloss-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .jobloss-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .jobloss-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .jobloss-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .jobloss-header a:hover {
        text-decoration: underline;
    }

    .jobloss-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .jobloss-card {
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

    .jobloss-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
    }

    .jobloss-card img {
        width: 100%;
        height: 180px; /* Paksa semua gambar sama ukuran */
        object-fit: cover;
        flex-shrink: 0;
    }

    .jobloss-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .jobloss-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    @media (max-width: 992px) {
        .jobloss-cards-row {
            flex-wrap: wrap;
        }

        .jobloss-card {
            flex: 1 1 calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .jobloss-card {
            flex: 1 1 100%;
        }
    }

        /*Resign Section (Sama seperti JobStreet)*/
        .resign-section {
        width: 100%;
        padding: 60px 40px;
        margin: 30px auto 60px auto;
        margin-top: -50px;
        box-sizing: border-box;
        background: #fff;
    }

    .resign-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .resign-header h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .resign-header a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .resign-header a:hover {
        text-decoration: underline;
    }

    .resign-cards-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .resign-card {
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

    .resign-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
    }

    .resign-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .resign-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .resign-card-body h4 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin: 0;
    }

    @media (max-width: 992px) {
        .resign-cards-row {
            flex-wrap: wrap;
        }

        .resign-card {
            flex: 1 1 calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .resign-card {
            flex: 1 1 100%;
        }
    }

    /* === Subscription Section (Berlangganan Panduan Karir) === */
    .career-subscribe-section {
        width: 100%; /* mengikuti lebar salary-trend-section */
        padding: 0 40px; /* sama seperti salary-trend-section */
        margin: 100px auto;
        margin-top: -50px;
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

    {{-- Header Pencarian --}}
    @include('partials.header_career')

    {{-- === SLIDER SECTION === --}}
    <div class="article-slider">
        <div class="article-slides-wrapper">
            <div class="article-slides">
                <div class="article-slide">
                    <img src="{{ asset('images/kantoran13.png') }}" alt="Slide 1">
                    <div class="article-content">
                        <h3>Kenaikan Gaji: Ini Cara Negosiasi, Alasan, dan Persentasenya</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                <div class="article-slide">
                    <img src="{{ asset('images/kantoran14.png') }}" alt="Slide 2">
                    <div class="article-content">
                        <h3>Soft Skill dan Hard Skill yang Dibutuhkan untuk Hospitality Resort</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                <div class="article-slide">
                    <img src="{{ asset('images/kantoran15.png') }}" alt="Slide 3">
                    <div class="article-content">
                        <h3>12 Skill Administrasi Kantor & Tips Meningkatkannya</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
                <div class="article-slide">
                    <img src="{{ asset('images/kantoran16.png') }}" alt="Slide 4">
                    <div class="article-content">
                        <h3>Regulasi dan Hak Pekerja Penyandang Disabilitas di Indonesia</h3>
                        <a href="#">Cari tahu selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-btn left" onclick="moveSlide(-1)" id="btnLeft" style="display:none;">
            <i class="fa fa-chevron-left"></i>
        </div>
        <div class="slider-btn right" onclick="moveSlide(1)" id="btnRight">
            <i class="fa fa-chevron-right"></i>
        </div>
    </div>

    <div class="slider-dots" id="sliderDots"></div>

    <!-- === CAREER SUGGESTIONS SECTION (Baru Ditambahkan) === -->
    <div class="career-suggestions">
        <div class="row">
            <div class="career-suggestion-card">
                <img src="{{ asset('images/icon10.png') }}" alt="Pengembangan karier">
                <div>
                    <h5>Pengembangan karier</h5>
                    <p>Baca artikel terbaru kami tentang cara praktis untuk mengembangkan karier Anda.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="{{ asset('images/icon11.png') }}" alt="Kesejahteraan di tempat kerja">
                <div>
                    <h5>Kesejahteraan di tempat kerja</h5>
                    <p>Baca artikel terbaru kami tentang cara untuk menjalani kehidupan kerja yang lebih sehat.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="{{ asset('images/icon6.png') }}" alt="Saran gaji">
                <div>
                    <h5>Saran gaji</h5>
                    <p>Baca artikel terbaru kami tentang menegosiasikan gaji yang lebih baik.</p>
                </div>
            </div>

            <div class="career-suggestion-card">
                <img src="{{ asset('images/icon9.png') }}" alt="Mengundurkan diri">
                <div>
                    <h5>Mengundurkan diri</h5>
                    <p>Baca artikel terbaru kami dengan tip dan panduan pengunduran diri.</p>
                </div>
            </div>
        </div>
    </div>

        <!-- === PENGEMBANGAN KARIR SECTION (baru, mirip JobStreet) === -->
    <div class="career-development-section">
        <div class="development-wrapper">
            <div class="development-header">
                <h2>Pengembangan karir</h2>
                <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
            </div>

            <!-- Kartu utama -->
            <div class="main-development-card">
                <img src="{{ asset('images/kelulusan.png') }}" alt="Double Degree">
                <div class="main-development-content">
                    <h3>Double Degree: Arti, Tips, dan Manfaatnya dalam Dunia Kerja</h3>
                    <a href="#">Cari tahu selengkapnya</a>
                </div>
            </div>

            <!-- 4 kartu kecil -->
            <div class="small-development-cards-row">
                <div class="small-development-card">
                    <img src="{{ asset('images/panah.png') }}" alt="OKR">
                    <div class="small-development-card-body">
                        <h4>Apa itu OKR? Ini Fungsi, Contoh, dan Cara Membuatnya</h4>
                    </div>
                </div>

                <div class="small-development-card">
                    <img src="{{ asset('images/cinta.png') }}" alt="Self Love">
                    <div class="small-development-card-body">
                        <h4>Self-love: Arti, Manfaat, dan Cara Melakukannya untuk Diri Sendiri</h4>
                    </div>
                </div>

                <div class="small-development-card">
                    <img src="{{ asset('images/diskusi.png') }}" alt="HSK Test">
                    <div class="small-development-card-body">
                        <h4>Mengenal HSK Test: Manfaat, Level, dan Tips Persiapannya</h4>
                    </div>
                </div>

                <div class="small-development-card">
                    <img src="{{ asset('images/koin.png') }}" alt="Sinking Fund">
                    <div class="small-development-card-body">
                        <h4>Mengenal Sinking Fund, Manfaat & Cara Menerapkannya</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="wellbeing-section">
        <div class="wellbeing-header">
            <h2>Kesejahteraan di tempat kerja</h2>
            <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
        </div>

        <div class="wellbeing-cards-row">
            <div class="wellbeing-card">
                <img src="{{ asset('images/hijab.png') }}" alt="Tips Puasa">
                <div class="wellbeing-card-body">
                    <h4>7 Tips Puasa Agar Tetap Semangat dan Produktif Bekerja</h4>
                </div>
            </div>

            <div class="wellbeing-card">
                <img src="{{ asset('images/surat2.png') }}" alt="Surat Izin">
                <div class="wellbeing-card-body">
                    <h4>24 Contoh Surat Izin Tidak Masuk Kerja Terlengkap</h4>
                </div>
            </div>

            <div class="wellbeing-card">
                <img src="{{ asset('images/hijab1.png') }}" alt="Auto Reply">
                <div class="wellbeing-card-body">
                    <h4>Menyusun Pesan Auto Reply Terbaik, Beserta Tips dan Contoh</h4>
                </div>
            </div>

            <div class="wellbeing-card">
                <img src="{{ asset('images/business.png') }}" alt="Business Casual">
                <div class="wellbeing-card-body">
                    <h4>Tips Tampil Business Casual Untuk Pria</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- === Hubungan Kerja Section (Seperti JobStreet) === -->
<div class="work-relationship-section">
    <div class="work-relationship-header">
        <h2>Hubungan kerja</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="work-relationship-cards-row">
        <div class="work-relationship-card">
            <img src="/images/meeting3.png" alt="Empathetic Listening">
            <div class="work-relationship-card-body">
                <h4>Apa Itu Empathetic Listening? Ini Arti, Contoh, dan Cara...</h4>
            </div>
        </div>

        <div class="work-relationship-card">
            <img src="/images/meeting2.png" alt="People Pleaser">
            <div class="work-relationship-card-body">
                <h4>People Pleaser: Arti dan Dampaknya di Dunia Kerja</h4>
            </div>
        </div>

        <div class="work-relationship-card">
            <img src="/images/meeting1.png" alt="Sikap Asertif">
            <div class="work-relationship-card-body">
                <h4>Sikap Asertif: Definisi, Cara Melatih, dan Penerapannya di...</h4>
            </div>
        </div>

        <div class="work-relationship-card">
            <img src="/images/meeting.png" alt="Meeting">
            <div class="work-relationship-card-body">
                <h4>Meeting: Apa itu, Manfaat, Jenis-Jenis, dan Etikanya</h4>
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

<!-- === Keterampilan di Tempat Kerja Section (Baru, Sama seperti JobStreet) === -->
<div class="work-skills-section">
    <div class="work-skills-header">
        <h2>Keterampilan di tempat kerja</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="work-skills-cards-row">
        <div class="work-skills-card">
            <img src="{{ asset('images/kantoran14.png') }}" alt="Soft Skill Hospitality">
            <div class="work-skills-card-body">
                <h4>Soft Skill dan Hard Skill yang Dibutuhkan untuk Hospitality</h4>
            </div>
        </div>

        <div class="work-skills-card">
            <img src="{{ asset('images/kantoran15.png') }}" alt="Administrasi Kantor">
            <div class="work-skills-card-body">
                <h4>12 Skill Administrasi Kantor & Tips Meningkatkannya</h4>
            </div>
        </div>

        <div class="work-skills-card">
            <img src="{{ asset('images/kantoran18.png') }}" alt="Auditor Investigasi">
            <div class="work-skills-card-body">
                <h4>Beragam Skill yang Harus Dikuasai Auditor Investigasi</h4>
            </div>
        </div>

        <div class="work-skills-card">
            <img src="{{ asset('images/kantoran17.png') }}" alt="Skill Presentasi">
            <div class="work-skills-card-body">
                <h4>Skill Presentasi di Dunia Kerja: Manfaat, Tips, dan Cara...</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Kepemimpinan Section (Sama seperti JobStreet) === -->
<div class="leadership-section">
    <div class="leadership-header">
        <h2>Kepemimpinan</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="leadership-cards-row">
        <div class="leadership-card">
            <img src="{{ asset('images/kantoran19.png') }}" alt="Team Building">
            <div class="leadership-card-body">
                <h4>Mengenal Apa Itu Team Building: Proses Penting di Tempat Kerja</h4>
            </div>
        </div>

        <div class="leadership-card">
            <img src="{{ asset('images/kantoran22.png') }}" alt="Meeting">
            <div class="leadership-card-body">
                <h4>Meeting: Pengertian, Jenis, Fungsi, dan Tujuannya di Dunia...</h4>
            </div>
        </div>

        <div class="leadership-card">
            <img src="{{ asset('images/kantoran20.png') }}" alt="Naik Jabatan">
            <div class="leadership-card-body">
                <h4>Naik Jabatan? Siapa Takut! Ketahui 10 Tips agar Cepat Dapa...</h4>
            </div>
        </div>

        <div class="leadership-card">
            <img src="{{ asset('images/kantoran21.png') }}" alt="Volunteering">
            <div class="leadership-card-body">
                <h4>Bagaimana Kegiatan Volunteering Mampu Latih Kepemimpinan...</h4>
            </div>
        </div>
    </div>
</div>

<!-- === Kehilangan Pekerjaan Section (Sama seperti JobStreet) === -->
<div class="jobloss-section">
    <div class="jobloss-header">
        <h2>Kehilangan pekerjaan</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="jobloss-cards-row">
        <div class="jobloss-card">
            <img src="{{ asset('images/kantoran23.png') }}" alt="Layoff">
            <div class="jobloss-card-body">
                <h4>Regulasi Layoff: Hak Karyawan dan Dasar Hukum</h4>
            </div>
        </div>

        <div class="jobloss-card">
            <img src="{{ asset('images/interview4.png') }}" alt="Resign Interview">
            <div class="jobloss-card-body">
                <h4>Cara Efektif Menjawab Alasan Resign Saat Interview Kerja</h4>
            </div>
        </div>

        <div class="jobloss-card">
            <img src="{{ asset('images/kantoran24.png') }}" alt="Surat Resign">
            <div class="jobloss-card-body">
                <h4>Tips Menulis Surat Resign yang Profesional</h4>
            </div>
        </div>

        <div class="jobloss-card">
            <img src="{{ asset('images/kantoran25.png') }}" alt="Ganti Profesi">
            <div class="jobloss-card-body">
                <h4>Tips dan Pilihan Ganti Profesi Setelah Kerja di Startup</h4>
            </div>
        </div>
    </div>
</div>


<!-- === Resign Section (Sama seperti JobStreet) === -->
<div class="resign-section">
    <div class="resign-header">
        <h2>Resign</h2>
        <a href="#">Telusuri semua <i class="fa fa-chevron-right ms-2"></i></a>
    </div>

    <div class="resign-cards-row">
        <div class="resign-card">
            <img src="{{ asset('images/wa.png') }}" alt="Resign WA">
            <div class="resign-card-body">
                <h4>Cara Mengajukan Resign Lewat WA: Kata-Kata dan Tipsnya</h4>
            </div>
        </div>

        <div class="resign-card">
            <img src="{{ asset('images/email.png') }}" alt="Email Resign">
            <div class="resign-card-body">
                <h4>10 Contoh Email Resign: Format, Tips, dan Cara Buatnya</h4>
            </div>
        </div>

        <div class="resign-card">
            <img src="{{ asset('images/kantoran26.png') }}" alt="Notice Period">
            <div class="resign-card-body">
                <h4>Notice Period: Arti, Berapa Lama, dan Contoh Cara Jawabnya</h4>
            </div>
        </div>

        <div class="resign-card">
            <img src="{{ asset('images/resign2.png') }}" alt="Surat Pengunduran Diri">
            <div class="resign-card-body">
                <h4>12 Contoh Surat Pengunduran Diri Kerja yang Baik dan Sopan</h4>
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

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.article-slide');
        const totalSlides = slides.length;
        const slidesContainer = document.querySelector('.article-slides');
        const btnLeft = document.getElementById('btnLeft');
        const btnRight = document.getElementById('btnRight');
        const dotsContainer = document.getElementById('sliderDots');

        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('span');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateSlider();
        });

        function updateSlider() {
            slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
            updateDots();
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

        updateSlider();
    </script>

</body>
</html>
