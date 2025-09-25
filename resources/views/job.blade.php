<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Talenthub</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
    }
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
  </style>
</head>
<body>

  <!-- Navbar -->
  @include('partials.navbar')

  <!-- Konten Utama -->
  <div class="container my-4">
    <h2 class="mb-4">Lowongan Kerja Tersedia</h2>

    <!-- Job Card 1 -->
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

    <!-- Job Card 2 -->
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

  <!-- Footer -->
  @include('partials.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
