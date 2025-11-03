<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami | Next Jobz</title>

    <link rel="icon" type="image/png" href="{{ asset('123.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f6f8f5;
        }

        /* Map Section */
        .map-container {
            background-color: #fff;
            padding: 0;
        }

        #map {
            height: 450px;
            width: 100%;
            border-radius: 0;
            border: none;
            box-shadow: none;
        }

        /* Konten Utama (Form dan Info) */
        .contact-section {
            background-color: #fff;
            padding: 50px 0;
        }

        .contact-content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .contact-form-wrapper {
            width: 45%;
            padding-right: 3rem;
        }

        .contact-info-wrapper {
            width: 45%;
            padding-left: 3rem;
        }

        /* Modifikasi Card */
        .contact-card {
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: none;
        }

        @media (max-width: 991px) {
            .contact-form-wrapper,
            .contact-info-wrapper {
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
            }

            .contact-form-wrapper {
                padding-bottom: 30px;
                margin-bottom: 30px;
            }
        }

        .contact-form-heading {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .contact-form-subheading {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .contact-form-text {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        /* Input */
        .form-control-custom {
            background-color: #f5f5f5;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            margin-bottom: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            box-shadow: none;
        }

        .form-control-custom:focus {
            background-color: #f5f5f5;
            border-color: #bdbdbd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .form-control-custom::placeholder {
            color: #a0a0a0;
        }

        .form-control-custom.is-invalid {
            border-color: #e57373;
        }

        /* Tombol Kirim */
        .btn-kirim {
            width: 100%;
            background-color: #e00028;
            color: #fff;
            font-weight: normal;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            transition: box-shadow 0.3s ease;
        }

        .btn-kirim:hover {
            background-color: #e00028;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Informasi Kontak */
        .contact-info-heading {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            color: #888;
            font-size: 1.2rem;
            margin-right: 1rem;
            width: 20px;
            text-align: center;
        }

        .info-text {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="map-container">
        <div id="map"></div>
    </div>

    <div class="contact-section">
        <div class="container">
            <div class="row contact-content">
                <div class="col-lg-6 contact-form-wrapper">
    <h2 class="contact-form-heading">Hubungi Kami</h2>
    <h3 class="contact-form-subheading">Punya Pertanyaan ?</h3>
    <p class="contact-form-text">
        Apabila Anda memiliki pertanyaan terkait lowongan kerja, atau informasi lainnya, silahkan hubungi kami melalui formulir di bawah ini:
    </p>

    {{-- Form yang sudah disesuaikan dengan Laravel --}}
    <form action="{{ route('contact.store') }}" method="POST">
        @csrf 

        {{-- Notifikasi Sukses/Error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Input Nama --}}
        <div class="mb-3">
            <input type="text" name="nama" class="form-control form-control-custom @error('nama') is-invalid @enderror" placeholder="Nama Anda" value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input Email --}}
        <div class="mb-3">
            <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror" placeholder="Alamat Email Anda" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input Subjek --}}
        <div class="mb-3">
            <input type="text" name="subjek" class="form-control form-control-custom @error('subjek') is-invalid @enderror" placeholder="Subjek" value="{{ old('subjek') }}">
            @error('subjek')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input Pesan --}}
        <div class="mb-3">
            <textarea name="pesan" class="form-control form-control-custom @error('pesan') is-invalid @enderror" rows="4" placeholder="Pesan Anda">{{ old('pesan') }}</textarea>
            @error('pesan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Kirim --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-kirim">Kirim Pesan</button>
        </div>
    </form>
</div>

                <div class="col-lg-6 contact-info-wrapper">
                    <div class="contact-card">
                        <h2 class="contact-info-heading">Informasi Kontak</h2>

                        <div class="info-item">
                            <i class="fas fa-map-marker-alt info-icon"></i>
                            <div class="info-text">
                                Jl. Pratista Utara III No.2,<br>
                                Antapani Kidul,<br>
                                Kec. Antapani, Kota Bandung,<br>
                                Jawa Barat, Indonesia 4029
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-envelope info-icon"></i>
                            <div class="info-text">Email: corporate@inotal.tech</div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-phone-alt info-icon"></i>
                            <div class="info-text">Phone: +(62) 82115179879</div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-clock info-icon"></i>
                            <div class="info-text">
                                Jam Operasional:<br>
                                Senin - Jumat, 08.00 - 16.00 WIB
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const map = L.map('map').setView([-6.912543, 107.647209], 18);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            const latitude = -6.912543;
            const longitude = 107.647209;
            const location = [latitude, longitude];

            L.marker(location).addTo(map)
                .bindPopup("<b>PT INOTAL SISTEMA INTERNASIONAL</b><br>Jl. Pratista Utara III No.2, Antapani.")
                .openPopup();

            map.setView(location, 18);
        });
    </script>
</body>

</html>