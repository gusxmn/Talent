<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Warna-warna khusus */
        .text-green { color: #28a745; }
        .bg-green { background-color: #28a745; }
        .btn-green:hover { background-color: #218838; }
        .text-orange-custom { color: #FF6633; }
        .text-custom-gray { color: #6c757d; }
        .text-red-custom { color: #e11c25; }
        .text-dark-gray { color: #495057; }

        /* Navbar */
        .navbar {
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .navbar-logo {
            height: 30px;
            width: auto;
            margin-right: 1.5rem;
        }
        .navbar .nav-link {
            color: #2c2c2c;
            margin-right: 1rem;
            font-weight: 400;
        }
        .navbar .nav-link:hover { color: #0d47a1; }
        .navbar .nav-link.active {
            color: #0d47a1;
            font-weight: 600;
            border-bottom: 2px solid #0d47a1;
        }
        .navbar .nav-item {
            display: flex;
            align-items: center;
        }
        .badge-baru {
            background-color: #e0f2f1;
            color: #00796b;
            font-weight: 600;
            padding: 0.25em 0.7em;
            border-radius: 9999px;
            margin-left: 0.25rem;
            font-size: 0.75rem;
        }
        .dropdown-toggle::after { display: none; }
        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-outline-primary {
            border-radius: 4px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            color: #0d47a1;
            border-color: #0d47a1;
        }
        .btn-outline-primary:hover {
            background-color: #0d47a1;
            color: #fff;
        }
        .btn-primary {
            border-radius: 4px;
            padding: 0.35rem 1rem;
            font-weight: 600;
            color: #fff;
            background-color: #0d47a1;
            border-color: #0d47a1;
        }
        .btn-primary:hover {
            background-color: #0a3d8b;
            border-color: #0a3d8b;
        }
        .nav-link.text-primary {
            font-weight: 600;
            color: #0d47a1 !important;
        }

        /* Tombol Daftar dan Masuk */
        .btn-primary-custom { transition: all 0.3s ease; }
        .btn-primary-custom:hover {
            background-color: #fff;
            color: #0d47a1;
            border-color: #0d47a1;
        }
        .btn-outline-primary-custom { transition: all 0.3s ease; }
        .btn-outline-primary-custom:hover {
            background-color: #0d47a1;
            color: #fff;
            border-color: #0d47a1;
        }

        @media (max-width: 992px) {
            .navbar .nav-link.active { border-bottom: none; }
        }

        /* Search Header */
        .search-header {
            background: url('{{ asset('images/Header.png') }}') no-repeat center center;
            background-size: cover;
            padding: 3rem 0;
            min-height: 200px;
            color: #fff;
            display: flex;
            align-items: center;
        }
        .search-box .form-control,
        .search-box .form-select {
            border-radius: 6px;
            border: none;
            padding: 0.75rem 1rem;
        }
        .input-keyword { width: 250px; }
        .btn-pink {
            background-color: #e6007e;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            width: 80px;
        }
        .btn-pink:hover {
            background-color: #c7006c;
            color: #fff;
            transform: translateY(-2px);
        }
        .search-label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }
        .search-options-wrapper {
            text-align: right;
            margin-top: 1rem;
            padding-right: 0.5rem;
        }
        .more-options {
            font-size: 0.9rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            padding-right: 100px;
        }
        .more-options:hover { color: #e6007e; }

        /* Hero section */
        .hero-section {
            position: relative;
            padding: 5rem 0;
            background-color: #f6f8f5;
            overflow: hidden;
        }
        .hero-background-image {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: url('{{ asset('images/hero-image.png') }}');
            background-size: contain;
            background-position: right 0px;
            background-repeat: no-repeat;
            opacity: 0.3;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero-title {
            color: #495057;
            font-weight: 500;
        }
        .hero-text { color: #6c757d; }

        /* Kategori pekerjaan */
        .category-card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            text-align: center;
            padding: 0.75rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .category-card .card-title { font-size: 1rem; }
        .category-heading { color: #495057; }

        /* Tag "Dibutuhkan Segera" */
        .dibutuhkan-segera-tag {
            display: inline-block;
            background-color: #f7f7f7;
            color: #007bff;
            border: 1px solid #cce5ff;
            border-radius: 9999px;
            padding: 0.2rem 1rem;
            margin: 0.25rem;
            font-size: 0.9rem;
            font-weight: 400;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            text-decoration: none;
        }
        .dibutuhkan-segera-tag:hover {
            background-color: #e2e6ea;
            color: #0056b3;
            border-color: #b8daff;
        }

        /* Perusahaan terpercaya */
        .trusted-companies .logo-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            row-gap: 0.2rem;
        }
        .trusted-companies .logo-wrapper {
            flex-basis: 22%;
            max-width: 22%;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 75px;
        }
        .trusted-companies .logo {
            max-width: 90%;
            max-height: 70px;
            width: auto;
            height: auto;
            opacity: 0.8;
        }
        .trusted-companies .logo:hover { opacity: 1; }
        .logo-card {
            background-color: transparent;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: none;
        }
        .logo-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.4);
            border-color: rgba(224, 224, 224, 0.4);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }
        .see-more-offset { margin-left: 20px; }

        /* Glints Section */
        .glints-section { background-color: #fff; }
        .glints-section h2 {
            font-size: 2.25rem;
            font-weight: 700;
        }
        .glints-section p {
            font-size: 1.1rem;
            color: #6c757d;
        }
        .testimonial-card {
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            height: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .testimonial-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1.5rem;
        }
        .testimonial-card blockquote {
            font-size: 1rem;
            color: #495057;
            margin-bottom: 1.5rem;
        }
        .testimonial-author {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 0.25rem;
        }
        .testimonial-role {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* Statistik */
        .stats-section { background-color: #f6f8f5; }
        .stats-title { color: #495057; }
        .stats-number {
            font-size: 2.5rem;
            font-weight: 600;
        }
        .stats-text { color: #6c757d; }

        /* Footer */
        .footer-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), url('{{ asset('images/gedung.png') }}');
            background-size: cover;
            background-position: center;
            position: relative;
            color: #fff;
        }
        .footer-logo {
            height: 120px;
            width: auto;
            display: block;
        }
        .footer-link {
            color: #fff;
            text-decoration: none;
        }
        .footer-link:hover { color: #28a745; }
        .alamat-icon-wrapper {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }
        .alamat-text {
            flex-grow: 1;
            margin-left: 0.5rem;
        }

        /* Dropdown Klasifikasi */
        .dropdown-menu-scrollable {
            max-height: 300px;
            overflow-y: auto;
            padding: 0;
            min-width: 400px;
        }
        .dropdown-item-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            color: #212529;
            transition: background-color 0.2s, color 0.2s;
        }
        .dropdown-item-custom:hover,
        .dropdown-item-custom:focus {
            background-color: #e9f5ff;
            color: #007bff;
        }
        .search-box .btn.dropdown-toggle {
            background-color: #fff;
            color: #212529;
            border: none;
            box-shadow: none;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
        }
        .search-box .btn.dropdown-toggle:focus { box-shadow: none; }
        .dropdown-toggle .bi-chevron-down { transition: transform 0.3s ease-in-out; }
        .dropdown-toggle[aria-expanded="true"] .bi-chevron-down { transform: rotate(180deg); }
    </style>
</head>

<body style="background-color: #f6f8f5;">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>