<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talenthub - Lowongan Kerja di Indonesia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        /* Styling yang TIDAK diperlukan di navbar.blade.php/footer.blade.php dipindahkan ke sini atau file CSS terpisah */

        /* --- Style Lowongan Kerja --- */
        .job-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .job-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .job-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .salary {
            color: #0d6efd;
            font-weight: bold;
        }
        .skills span {
            display: inline-block;
            background: #e9ecef;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.85rem;
            margin: 2px;
        }
        .apply-btn {
            background: #0d6efd;
            color: #fff;
            font-weight: bold;
            padding: 6px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .apply-btn:hover {
            background: #0b5ed7;
            color: #fff;
        }

        /* --- Style Sidebar Filter --- */
        .sidebar {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
        }
        .filter-section {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .filter-title {
            font-weight: bold;
            font-size: 1rem;
            color: #333;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .filter-options .form-check {
            margin-bottom: 5px;
        }
        .priority-btn {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #495057;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.2s;
            margin-right: 5px;
        }
        .priority-btn.active {
            background-color: #eaf3ff;
            border-color: #0d6efd;
            color: #0d6efd;
            font-weight: bold;
        }
        .page-header-sidebar {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
    </style>
</head>
<body>

    {{-- 1. IMPORT NAVBAR --}}
    @include('partials.navbar')

    <div class="container my-4">
        <div class="row">

            {{-- Sidebar Filter (Tetap di job.blade.php karena ini adalah konten spesifik) --}}
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="page-header-sidebar">
                        Lowongan Kerja di Indonesia
                    </div>
                    {{-- Konten Filter Prioritaskan --}}
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapsePrioritas" aria-expanded="true">
                            Prioritaskan
                            <i class="fas fa-chevron-up"></i>
                        </div>
                        <div class="collapse show" id="collapsePrioritas">
                            <div class="d-flex flex-wrap">
                                <button class="priority-btn active">Paling Relevan</button>
                                <button class="priority-btn">Baru Ditambahkan</button>
                            </div>
                        </div>
                    </div>
                    {{-- Konten Filter Tipe Pekerjaan --}}
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseTipePekerjaan" aria-expanded="true">
                            Tipe Pekerjaan
                            <i class="fas fa-chevron-up"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseTipePekerjaan">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="full_time" id="tipePenuhWaktu">
                                <label class="form-check-label" for="tipePenuhWaktu">Penuh Waktu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="kontrak" id="tipeKontrak">
                                <label class="form-check-label" for="tipeKontrak">Kontrak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="magang" id="tipeMagang">
                                <label class="form-check-label" for="tipeMagang">Magang</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="part_time" id="tipeParuhWaktu">
                                <label class="form-check-label" for="tipeParuhWaktu">Paruh Waktu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="freelance" id="tipeFreelance">
                                <label class="form-check-label" for="tipeFreelance">Freelance</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="harian" id="tipeHarian">
                                <label class="form-check-label" for="tipeHarian">Harian</label>
                            </div>
                        </div>
                    </div>
                    {{-- Konten Filter Kebijakan Kerja --}}
                    <div class="filter-section">
                        <div class="filter-title" data-bs-toggle="collapse" data-bs-target="#collapseKebijakanKerja" aria-expanded="true">
                            Kebijakan Kerja
                            <i class="fas fa-chevron-up"></i>
                        </div>
                        <div class="collapse show filter-options" id="collapseKebijakanKerja">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="kantor" id="kerjaKantor">
                                <label class="form-check-label" for="kerjaKantor">Kerja di kantor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="hybrid" id="kerjaHybrid">
                                <label class="form-check-label" for="kerjaHybrid">Kerja di kantor / rumah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="remote" id="kerjaRemote">
                                <label class="form-check-label" for="kerjaRemote">Kerja Remote/dari rumah</label>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-sm btn-primary w-100 mt-2">Terapkan Filter</button>
                </div>
            </div>
            
            {{-- Kolom Konten Utama Lowongan --}}
            <div class="col-lg-9">
                <h2 class="mb-4 d-none d-lg-block">Lowongan Kerja Tersedia</h2>

                <div class="job-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="job-title">Talent Host Live</div>
                            <p class="text-muted mb-1">Aquila - Indramayu, Jawa Barat</p>
                            <p class="salary">Rp 3 jt - 3,5 jt</p>
                        </div>
                        <div>
                            <a href="#" class="apply-btn">Lamar</a>
                        </div>
                    </div>
                    <p class="mb-1">
                        <strong>Persyaratan:</strong> Kerja di kantor · 1 - 3 tahun pengalaman · Minimal SMA/SMK · 20-30 tahun · Perempuan saja
                    </p>
                    <div class="skills">
                        <span>Teamwork</span>
                        <span>Public Speaking</span>
                        <span>Communicative</span>
                        <span>Positive Attitude</span>
                        <span>Attention to Detail</span>
                        <span>Live Streaming</span>
                    </div>
                    <p class="text-muted small mt-2">Tayang 4 bulan lalu · Diperbarui 9 hari lalu</p>
                </div>

                <div class="job-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="job-title">Video Editor</div>
                            <p class="text-muted mb-1">Perusahaan Premium - Jakarta</p>
                            <p class="salary">Gaji Tidak Ditampilkan</p>
                        </div>
                        <div>
                            <a href="#" class="apply-btn">Lamar</a>
                        </div>
                    </div>
                    <p class="mb-1">
                        <strong>Persyaratan:</strong> Kontrak · 1 - 3 tahun pengalaman · Minimal D3/S1
                    </p>
                    <div class="skills">
                        <span>Editing</span>
                        <span>Creativity</span>
                        <span>Teamwork</span>
                    </div>
                    <p class="text-muted small mt-2">Tayang 2 minggu lalu · Diperbarui 3 hari lalu</p>
                </div>

            </div>
        </div>
    </div>

    {{-- 2. IMPORT FOOTER --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>