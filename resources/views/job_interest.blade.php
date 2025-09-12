<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Talenthub</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      font-size: 0.95rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .navbar-logo {
      height: 28px;
      width: auto;
    }

    .progress-bar-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background-color: #e9ecef;
    }

    .progress-bar-fill {
      height: 100%;
      width: 33%;
      background-color: #007bff;
    }

    .content-container {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      max-width: 480px;
      margin: 0 auto;
      text-align: center;
      padding: 20px;
    }

    .profile-pic {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 16px;
    }

    h2 {
      font-size: 1.4rem;
    }

    .info-box {
      background-color: #e9f5ff;
      color: #004085;
      padding: 0.75rem;
      border-radius: 0.25rem;
      text-align: left;
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .info-box .bi {
      margin-right: 8px;
    }

    .form-select,
    .add-field {
      font-size: 0.95rem;
      padding: 10px;
    }

    .btn-lanjutkan {
      background-color: #d3d3d3;
      border-color: #d3d3d3;
      color: #fff;
      font-weight: 600;
      cursor: not-allowed;
      pointer-events: none;
    }

    .btn-lanjutkan.active {
      background-color: #007bff;
      border-color: #007bff;
      cursor: pointer;
      pointer-events: auto;
    }

    .add-field {
      display: block;
      width: 100%;
      padding: 10px;
      border: 2px dashed #ccc;
      border-radius: 6px;
      color: #555;
      font-weight: 500;
      background: #fff;
      cursor: pointer;
      margin-bottom: 20px;
      text-align: center;
    }

    .add-field:hover {
      background: #f1f1f1;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white border-bottom">
    <div class="container-fluid mx-lg-5 position-relative">
      <div class="progress-bar-container">
        <div class="progress-bar-fill"></div>
      </div>
      <a class="navbar-brand d-flex align-items-center py-2" href="/">
        <img src="{{ asset('images/logo_inotal.png') }}" alt="Inotal Logo"
          class="d-inline-block align-text-top navbar-logo">
      </a>
    </div>
  </nav>

  <!-- Konten Utama -->
  <div class="content-container">
    <img src="{{ asset('images/orang.png') }}" alt="Profil Pengguna" class="profile-pic">
    <h2 class="fw-bold mb-2">Bagus! Apa jenis pekerjaan yang kamu cari?</h2>

    <div class="info-box d-flex align-items-start">
      <i class="bi bi-info-circle-fill fs-6"></i>
      <span>Informasi ini membantu Glints merekomendasikan pekerjaan yang pas untukmu.</span>
    </div>

    <form action="#" method="POST" id="jobForm" class="mt-3 w-100">
      <div id="jobFields">
        <div class="mb-3 job-select">
          <select class="form-select job-dropdown" required>
            <option value="">Pilih fungsi pekerjaan*</option>
            <option>Software Engineer</option>
            <option>UI/UX Designer</option>
            <option>Data Analyst</option>
            <option>Project Manager</option>
            <option>Marketing Specialist</option>
            <option>Sales Executive</option>
            <option>HR Specialist</option>
            <option>Customer Support</option>
          </select>
        </div>
      </div>

      <button type="button" class="add-field" id="addJobField">+ Tambahkan bidang pekerjaan</button>

      <div class="d-grid">
        <button type="submit" id="btnLanjutkan" class="btn btn-lanjutkan" disabled>LANJUTKAN</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const jobFields = document.getElementById("jobFields");
    const addJobField = document.getElementById("addJobField");
    const btnLanjutkan = document.getElementById("btnLanjutkan");

    // Tambahkan dropdown baru
    addJobField.addEventListener("click", () => {
      const newField = document.createElement("div");
      newField.classList.add("mb-3", "job-select");
      newField.innerHTML = `
        <select class="form-select job-dropdown" required>
          <option value="">Pilih fungsi pekerjaan*</option>
          <option>Software Engineer</option>
          <option>UI/UX Designer</option>
          <option>Data Analyst</option>
          <option>Project Manager</option>
          <option>Marketing Specialist</option>
          <option>Sales Executive</option>
          <option>HR Specialist</option>
          <option>Customer Support</option>
        </select>
      `;
      jobFields.appendChild(newField);
      checkSelection();
    });

    // Cek jika minimal ada 1 pekerjaan dipilih
    document.addEventListener("change", (e) => {
      if (e.target.classList.contains("job-dropdown")) {
        checkSelection();
      }
    });

    function checkSelection() {
      const dropdowns = document.querySelectorAll(".job-dropdown");
      let valid = false;
      dropdowns.forEach((dropdown) => {
        if (dropdown.value !== "") valid = true;
      });

      if (valid) {
        btnLanjutkan.classList.add("active");
        btnLanjutkan.disabled = false;
      } else {
        btnLanjutkan.classList.remove("active");
        btnLanjutkan.disabled = true;
      }
    }
  </script>
</body>

</html>
