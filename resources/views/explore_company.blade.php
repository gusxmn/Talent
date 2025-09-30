<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Section Header Explore */
        .explore-wrapper {
            padding: 0 1rem;
            margin-bottom: 3rem;
        }

        .explore-header {
            background: url("{{ asset('images/Header1.png') }}") no-repeat center center;
            background-size: cover;
            border-radius: 20px;
            padding: 4.5rem 3rem;
            margin-top: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            position: relative;
        }

        @media (min-width: 992px) {
            .image-section {
                position: absolute; 
                top: 50px;          
                right: 200px;       
                margin: 0 !important;
            }
        }

        .explore-title {
            font-size: 2.3rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
        }

        .explore-subtitle {
            font-size: 1.2rem;
            color: #fff;
            margin-top: 0.5rem;
            margin-bottom: 2rem;
        }

        .search-box {
            max-width: 370px;
            width: 100%;
            position: relative;
            --right-extend: 230px;
            max-width: calc(370px + var(--right-extend));
        }

        .search-input {
            border-radius: 8px;
            padding: 0.9rem 1rem 0.9rem 40px;
            font-size: 1rem;
            border: 1px solid #ddd;
            width: 100%;
        }

        .search-input:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 6px rgba(13, 71, 161, 0.3);
        }

        .search-box .bi-search {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 1.2rem;
        }

        .employee-image {
            border-radius: 50%;
            object-fit: cover;
            width: 250px;
            height: 250px;
        }

        .text-section {
            position: relative;
        }

        /* Explore Companies Section - PENYESUAIAN CARD DAN CAROUSEL */
        .companies-section {
            padding: 2rem 0; 
        }
        .companies-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 0 3rem; 
        }
        .companies-header > div {
            text-align: left;
        }
        .companies-header h2 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }
        .companies-header p {
            font-size: 1.1rem; 
            margin: 0;
            color: #555;
        }
        
        #companiesCarousel {
            padding: 0 3rem; 
            position: relative;
        }
        
        .companies-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            background: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 230px;
            align-items: center;
        }

        .companies-card.highlighted {
            border: 2px solid #0d47a1; 
            box-shadow: 0 0 0 3px #bbdefb; 
        }

        .companies-card .logo-container {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            width: 100%;
        }

        .companies-card img {
            max-height: 60px;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        .companies-card h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .companies-card .rating {
            font-size: 0.9rem;
            color: #444;
            margin: 0.5rem 0 1rem 0;
            white-space: nowrap; 
        }
        .companies-card .rating .bi-star-fill {
            color: #e91e63;
        }
        .companies-card .btn-jobs {
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            background-color: #e3f2fd;
            color: #0d47a1;
            border: none;
            padding: 0.4rem 0.8rem;
            margin-top: auto;
            white-space: nowrap;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 3rem; 
            height: 3rem; 
            top: 50%;
            transform: translateY(calc(-50% - 25px)); 
            opacity: 1; 
            margin: 0;
            background: #fff; 
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15); 
            z-index: 10; 
        }
        
        .carousel-control-prev {
            left: 0; 
        }

        .carousel-control-next {
            right: 0; 
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 65% 65%; 
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
        
        .carousel-control-prev.disabled,
        .carousel-control-next.disabled {
            display: none !important; 
        }

        .carousel-indicators {
            position: relative; 
            margin-top: 2rem;
        }
        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #bbb;
        }
        .carousel-indicators .active {
            background-color: #0d47a1;
        }

        /* Perbesar tombol tulis ulasan */
        .companies-header .btn-primary {
            font-size: 1.05rem;
            padding: 0.7rem 1.4rem;
        }

        /* Styling untuk bagian baru "Dapatkan gambaran yang jelas sebelum melamar" */
        .pre-apply-section {
            padding: 1rem 1rem; /* MENGURANGI padding-top untuk menaikkan section */
            text-align: center;
            background-color: #fff; 
        }
        .pre-apply-section h2 {
            font-size: 2rem; 
            font-weight: 700;
            margin-bottom: 3rem; 
            color: #333;
        }
        .pre-apply-card {
            text-align: center;
            padding: 1.5rem; 
        }
        .pre-apply-card img {
            width: 120px; 
            height: 120px; 
            object-fit: contain;
            margin-bottom: 1.5rem; 
        }
        .pre-apply-card h3 {
            font-size: 1.3rem; 
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem; 
        }
        .pre-apply-card p {
            font-size: 1rem; 
            color: #666;
            margin: 0;
        }

  .community-section {
            background-color: #fff;
            padding: 1rem 1rem;
            font-family: Arial, sans-serif;
        }
        .community-section a {
            display: block;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }
        .community-section a:hover {
            text-decoration: underline;
        }
        .community-section a i {
            margin-left: 8px;
        }

        /* Tambahkan jarak antar section */
        .top-companies {
            margin-top: 5rem; /* jarak lebih besar dari sebelumnya */
        }

        .top-companies h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* supaya link perusahaan berjajar horizontal */
        .top-companies .company-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem; /* jarak antar perusahaan */
        }

        .top-companies a {
            color: #0d47a1;
            text-decoration: underline; /* underline permanen */
            font-size: 0.95rem;
            margin: 0;
        }

        .top-companies a:hover {
            text-decoration: underline; /* biar underline tetap ada saat hover */
        }

    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    <div class="explore-wrapper">
        <div class="explore-header">
            <div class="text-section">
                <h1 class="explore-title">
                    Temukan perusahaan yang tepat<br>
                    untuk Anda
                </h1>
                <p class="explore-subtitle">Semua yang perlu diketahui tentang perusahaan, di satu tempat</p>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control search-input" placeholder="Cari perusahaan">
                </div>
            </div>

            <div class="image-section">
                <img src="{{ asset('images/employee.png') }}" alt="Employee" class="employee-image">
            </div>
        </div>
    </div>

    <div class="companies-section">
        <div class="companies-header">
            <div>
                <h2>Explore companies</h2>
                <p>Temukan lowongan baru, ulasan, budaya perusahaan, fasilitas, dan tunjangan.</p>
            </div>
            <a href="#" class="btn btn-primary">
                <i class="fa-solid fa-pen me-2"></i> Tulis ulasan
            </a>
        </div>

        <div id="companiesCarousel" class="carousel slide" data-bs-interval="false">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row g-3">
                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/bukalapak.png') }}" alt="Bukalapak">
                                </div>
                                <h5>Bukalapak</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.3 • 150 Ulasan</p>
                                <button class="btn btn-jobs">30 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/shopee.png') }}" alt="Shopee">
                                </div>
                                <h5>Shopee</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.4 • 200 Ulasan</p>
                                <button class="btn btn-jobs">45 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/gojek.png') }}" alt="Gojek">
                                </div>
                                <h5>Gojek</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.4 • 293 Ulasan</p>
                                <button class="btn btn-jobs">50 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia">
                                </div>
                                <h5>Tokopedia</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.2 • 180 Ulasan</p>
                                <button class="btn btn-jobs">40 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/telkom.png') }}" alt="Telkom">
                                </div>
                                <h5>Telkom</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.1 • 210 Ulasan</p>
                                <button class="btn btn-jobs">60 Pekerjaan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row g-3">
                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/jnt.png') }}" alt="J&T">
                                </div>
                                <h5>J&T</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.0 • 100 Ulasan</p>
                                <button class="btn btn-jobs">20 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/traveloka.png') }}" alt="Traveloka">
                                </div>
                                <h5>Traveloka</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.5 • 170 Ulasan</p>
                                <button class="btn btn-jobs">35 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/xendit.png') }}" alt="Xendit">
                                </div>
                                <h5>Xendit</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.3 • 120 Ulasan</p>
                                <button class="btn btn-jobs">25 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/pertamina.png') }}" alt="Pertamina">
                                </div>
                                <h5>Pertamina</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.4 • 250 Ulasan</p>
                                <button class="btn btn-jobs">70 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/kimia.png') }}" alt="Kimia Farma">
                                </div>
                                <h5>Kimia Farma</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.2 • 90 Ulasan</p>
                                <button class="btn btn-jobs">15 Pekerjaan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row g-3">
                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/garuda.png') }}" alt="Garuda">
                                </div>
                                <h5>Garuda</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.3 • 140 Ulasan</p>
                                <button class="btn btn-jobs">28 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/djarum.png') }}" alt="Djarum">
                                </div>
                                <h5>Djarum</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.1 • 110 Ulasan</p>
                                <button class="btn btn-jobs">18 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/bca.png') }}" alt="BCA">
                                </div>
                                <h5>BCA</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.5 • 300 Ulasan</p>
                                <button class="btn btn-jobs">55 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/asabri.png') }}" alt="Asabri">
                                </div>
                                <h5>Asabri</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.0 • 60 Ulasan</p>
                                <button class="btn btn-jobs">10 Pekerjaan</button>
                            </div>
                        </div>

                        <div class="col-6 col-md">
                            <div class="companies-card">
                                <div class="logo-container">
                                    <img src="{{ asset('images/adhimix.png') }}" alt="Adhimix">
                                </div>
                                <h5>Adhimix</h5>
                                <p class="rating"><i class="bi bi-star-fill"></i> 4.2 • 80 Ulasan</p>
                                <button class="btn btn-jobs">12 Pekerjaan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev disabled" id="prevButton" type="button" data-bs-target="#companiesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" id="nextButton" type="button" data-bs-target="#companiesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <div class="carousel-indicators mt-3">
                <button type="button" data-bs-target="#companiesCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#companiesCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#companiesCarousel" data-bs-slide-to="2"></button>
            </div>
        </div>
    </div>
    
    <div class="pre-apply-section">
        <div class="container">
            <h2 class="mb-5">Dapatkan gambaran yang jelas sebelum melamar</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="pre-apply-card">
                        <img src="{{ asset('images/heart.png') }}" alt="Budaya dan nilai">
                        <h3>Budaya dan nilai</h3>
                        <p>Cari tahu tentang budaya perusahaan</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="pre-apply-card">
                        <img src="{{ asset('images/line.png') }}" alt="Penilaian dan ulasan">
                        <h3>Penilaian dan ulasan</h3>
                        <p>Baca ulasan dari karyawan</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="pre-apply-card">
                        <img src="{{ asset('images/gift.png') }}" alt="Tunjangan dan keuntungan">
                        <h3>Tunjangan dan keuntungan</h3>
                        <p>Temukan keuntungan yang penting bagi Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Bagian baru sesuai gambar -->
    <div class="community-section container">
        <a href="#">Lihat pedoman komunitas <i class="bi bi-arrow-right"></i></a>
        <a href="#">Informasi untuk perusahaan <i class="bi bi-arrow-right"></i></a>

        <div class="top-companies">
            <h5>Perusahaan teratas</h5>
            <div class="company-list">
                <a href="#">Bukalapak</a>
                <a href="#">Traveloka</a>
                <a href="#">kimia Farma</a>
                <a href="#">Gojek</a>
                <a href="#">Shopee</a>
                <a href="#">Lihat semua <i class="bi bi-chevron-down"></i></a>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('companiesCarousel');
            if (!carousel) return; 

            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const carouselItems = carousel.querySelectorAll('.carousel-item');
            const totalItems = carouselItems.length;

            function updateCarouselControls() {
                const activeItem = carousel.querySelector('.carousel-item.active');
                const activeIndex = Array.from(carouselItems).indexOf(activeItem);

                if (activeIndex === 0) {
                    prevButton.classList.add('disabled');
                    nextButton.classList.remove('disabled');
                } 
                else if (activeIndex === totalItems - 1) {
                    prevButton.classList.remove('disabled');
                    nextButton.classList.add('disabled');
                } 
                else {
                    prevButton.classList.remove('disabled');
                    nextButton.classList.remove('disabled');
                }
            }

            carousel.addEventListener('slid.bs.carousel', updateCarouselControls);
            updateCarouselControls(); 
        });
    </script>
</body>
</html>