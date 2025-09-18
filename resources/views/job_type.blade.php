<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Talenthub</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      flex-direction: column;
      font-size: 1.1rem;
    }

    .navbar { font-size: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .navbar-logo { height: 38px; width: auto; }

    .progress-wrapper { 
      width: 100%; 
      background-color: #f8f9fa; 
      border-bottom: 1px solid #dee2e6; 
      padding: 3px 0; 
    }

    .progress .progress-bar { width: 80% !important; }

    .content-container {
      flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;
      max-width: 700px; margin: 0 auto; text-align: center; padding: 50px 35px;
    }

    .outer-circle {
      width: 120px; height: 120px;
      background-color: #e7e6e6ff;
      border-radius: 50%;
      display: flex; justify-content: center; align-items: center;
      margin-bottom: 25px;
    }
    .inner-circle {
      width: 95px; height: 95px;
      background-color: #808080;
      border-radius: 50%;
      display: flex; justify-content: center; align-items: center;
    }
    .profile-pic {
      width: 85px; height: 85px;
      border-radius: 50%; object-fit: cover;
    }

    h2 { font-size: 1.9rem; }

    .info-box {
      background-color: #e9f5ff; color: #004085; padding: 1.2rem; border-radius: 0.4rem;
      text-align: left; margin-top: 25px; font-size: 1.05rem;
    }
    .info-box .bi { margin-right: 12px; font-size: 1.2rem; }

    /* Custom dropdown */
    .custom-select { position: relative; width: 100%; font-size: 1.05rem; }
    .select-box {
      border: 1.7px solid #000; border-radius: 5px; padding: 14px;
      background: #fff; cursor: pointer; text-align: left;
      position: relative;
    }
    .select-box::after {
      content: "\f078"; font-family: "Font Awesome 6 Free"; font-weight: 900;
      position: absolute; right: 14px; top: 50%; 
      transform: translateY(-50%) rotate(0deg); 
      color: #555;
      transition: transform 0.3s ease;
    }
    .select-box.open::after {
      transform: translateY(-50%) rotate(180deg); /* animasi panah */
    }

    .options {
      position: absolute; top: 100%; left: 0; right: 0;
      background: #fff; border: 1px solid #ccc; border-radius: 5px;
      margin-top: 5px; margin-bottom: 30px;
      max-height: 1500px; /* super panjang */
      overflow-y: auto;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      display: none; z-index: 1000;
      font-size: 1.05rem;
    }
    .options div {
      padding: 12px; cursor: pointer; text-align: left;
      transition: background-color 0.2s, color 0.2s;
    }
    .options div:hover { background-color: #e9f5ff; color: #007bff; }

    .btn-selesai {
      background-color: #A9A9A9; border-color: #A9A9A9; color: #FFFFFF;
      font-weight: 600; cursor: not-allowed; pointer-events: none;
      padding: 10px 22px; font-size: 1rem; text-transform: uppercase;
    }
    .btn-selesai.active {
      background-color: #007bff; border-color: #007bff; color: #FFFFFF;
      cursor: pointer; pointer-events: auto;
    }

    .btn-kembali {
      border: none;
      background: transparent;
      color: #007bff;
      font-weight: 500;
      font-size: 1.05rem;
      display: flex;
      align-items: center;
      cursor: pointer;
    }
    .btn-kembali i {
      margin-right: 6px;
    }

    .section-title {
      color: #6c757d;
      font-weight: normal;
      margin-bottom: 8px;
    }

    /* Chip kota terpilih */
    .selected-cities { 
      margin-top: 8px; 
      display: flex; 
      flex-direction: column; /* ubah jadi ke bawah */
      gap: 8px; 
    }
    .city-chip {
      background: #e9ecef;
      border-radius: 20px;
      padding: 8px 14px;
      display: flex; align-items: center;
      justify-content: space-between;
      font-size: 1rem;
    }
    .city-chip button {
      border: none; background: transparent;
      font-size: 1.2rem; margin-left: 8px; cursor: pointer;
    }
    .text-danger { 
      font-size: 1.1rem;  /* lebih besar */
      margin-top: 6px; 
      font-weight: 600;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5">
      <a class="navbar-brand d-flex align-items-center py-2" href="/">
        <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo" class="d-inline-block align-text-top navbar-logo">
      </a>
    </div>
  </nav>

  <div class="progress-wrapper">
    <div class="progress" style="height: 7px;">
      <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
            role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
      </div>
    </div>
  </div>

  <div class="content-container">
    <div class="outer-circle">
      <div class="inner-circle">
        <img src="{{ asset('images/orang.png') }}" alt="Profil Pengguna" class="profile-pic">
      </div>
    </div>
    <h2 class="fw-bold mb-2">Seperti apa preferensi pekerjaan yang kamu mau?</h2>

    <div class="info-box d-flex align-items-start">
      <i class="bi bi-info-circle-fill"></i>
      <span>Informasi ini membantu Talenthub merekomendasikan kesempatan yang pas untukmu.</span>
    </div>

    <form action="#" method="POST" id="typeForm" class="mt-4 w-100 text-start">

      <p class="section-title">Tipe pekerjaan*</p>
      <div class="row mb-3">
        <div class="col-6">
          <label><input type="checkbox" class="job-type"> Penuh Waktu</label><br>
          <label><input type="checkbox" class="job-type"> Paruh Waktu</label><br>
          <label><input type="checkbox" class="job-type"> Harian</label>
        </div>
        <div class="col-6">
          <label><input type="checkbox" class="job-type"> Freelance</label><br>
          <label><input type="checkbox" class="job-type"> Magang</label>
        </div>
      </div>

      <p class="section-title">Preferensi kota kerja*</p>
      <div class="custom-select mb-1">
        <div class="select-box">Nama kota</div>
        <div class="options">
          <div>Kota Bandung</div>
          <div>Kota Bekasi</div>
          <div>Kota Depok</div>
          <div>Kota Bogor</div>
          <div>Kota Cimahi</div>
          <div>Kota Cirebon</div>
          <div>Kota Sukabumi</div>
          <div>Kota Tasikmalaya</div>
          <div>Kota Banjar</div>
          <div>Kabupaten Garut</div>
          <div>Kabupaten Sumedang</div>
          <div>Kabupaten Indramayu</div>
          <div>Kabupaten Kuningan</div>
          <div>Kabupaten Majalengka</div>
          <div>Kabupaten Cianjur</div>
          <div>Kabupaten Purwakarta</div>
          <div>Kabupaten Subang</div>
          <div>Kabupaten Karawang</div>
        </div>
      </div>
      <small class="text-danger" id="cityWarning" style="display:none;">Isi 1 - 3 lokasi kerja saja</small>
      <div class="selected-cities" id="selectedCities"></div>

      <div class="form-check mb-3 mt-2">
        <input class="form-check-input" type="checkbox" id="remoteCheck">
        <label class="form-check-label" for="remoteCheck">Bersedia bekerja remote</label>
      </div>

      <!-- Tombol Navigasi -->
      <div class="d-flex justify-content-between align-items-center mt-4">
        <button type="button" class="btn-kembali" id="btnKembali">
          <i class="bi bi-arrow-left"></i> Kembali
        </button>
        <button type="submit" id="btnSelesai" class="btn btn-selesai" disabled>SELESAI</button>
      </div>
    </form>
  </div>

  <script>
    const btnSelesai = document.getElementById("btnSelesai");
    const btnKembali = document.getElementById("btnKembali");
    const jobTypes = document.querySelectorAll(".job-type");
    const selectBox = document.querySelector(".select-box");
    const options = document.querySelector(".options");
    const selectedCitiesDiv = document.getElementById("selectedCities");
    const cityWarning = document.getElementById("cityWarning");

    let selectedCities = [];

    // Event tombol kembali
    btnKembali.addEventListener("click", () => {
      window.history.back();
    });

    // Event tombol selesai → arahkan ke halaman utama
    document.getElementById("typeForm").addEventListener("submit", function(e) {
      e.preventDefault(); // cegah reload default
      window.location.href = "/"; // arahkan ke halaman utama
    });

    // buka tutup dropdown
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("select-box")) {
        const isOpen = options.style.display === "block";
        if (isOpen) {
          options.style.display = "none";
          selectBox.classList.remove("open"); // panah ke atas
        } else {
          options.style.display = "block";
          selectBox.classList.add("open"); // panah ke bawah

          const rect = options.getBoundingClientRect();
          const viewportHeight = window.innerHeight;
          const spaceBelow = viewportHeight - rect.top;

          if (spaceBelow < 400) {
            options.style.maxHeight = (spaceBelow - 10) + "px"; 
          } else {
            options.style.maxHeight = "1500px"; // panjang besar
          }
        }
      } else if (e.target.closest(".options div")) {
        const city = e.target.textContent;
        if (!selectedCities.includes(city)) {
          selectedCities.push(city); // tetap tambah meskipun sudah lebih dari 3
          renderCities();
          if (selectedCities.length > 3) {
            cityWarning.style.display = "block"; // tetap munculkan error
          } else {
            cityWarning.style.display = "none";
          }
        }
        options.style.display = "none";
        selectBox.classList.remove("open"); // tutup animasi panah
        checkValid();
      } else {
        options.style.display = "none";
        selectBox.classList.remove("open"); // pastikan panah kembali
      }
    });

    function renderCities() {
      selectedCitiesDiv.innerHTML = "";
      selectedCities.forEach((city, index) => {
        const chip = document.createElement("div");
        chip.className = "city-chip";
        chip.innerHTML = `${city} <button type="button">&times;</button>`;
        chip.querySelector("button").addEventListener("click", () => {
          selectedCities.splice(index, 1);
          renderCities();
          checkValid();
          if (selectedCities.length <= 3) {
            cityWarning.style.display = "none";
          }
        });
        selectedCitiesDiv.appendChild(chip);
      });
    }

    // cek validasi
    jobTypes.forEach(cb => cb.addEventListener("change", checkValid));

    function checkValid() {
      const checked = [...jobTypes].some(cb => cb.checked);
      if (checked && selectedCities.length >= 1 && selectedCities.length <= 3) {
        btnSelesai.classList.add("active");
        btnSelesai.disabled = false;
      } else {
        btnSelesai.classList.remove("active");
        btnSelesai.disabled = true;
      }

      if (selectedCities.length <= 3) {
        cityWarning.style.display = "none";
      }
    }
  </script>
</body>
</html>
