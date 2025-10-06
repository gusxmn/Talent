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

    .navbar { font-size: 1rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); }
    .navbar-logo { height: 38px; width: auto; }

    .progress-wrapper { width: 100%; background-color: #f8f9fa; border-bottom: 1px solid #dee2e6; padding: 3px 0; }

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

    .custom-select { position: relative; width: 100%; font-size: 1.05rem; }
    .select-box {
      border: 1.7px solid #000; border-radius: 5px; padding: 14px;
      background: #fff; cursor: pointer; text-align: left;
    }
    .select-box::after {
      content: "\f078"; font-family: "Font Awesome 6 Free"; font-weight: 900;
      position: absolute; right: 14px; top: 50%; transform: translateY(-50%) rotate(0deg);
      color: #555; transition: transform 0.3s ease;
    }
    /* animasi panah saat aktif */
    .custom-select.open .select-box::after {
      transform: translateY(-50%) rotate(180deg);
    }

    .options {
      position: absolute; top: 100%; left: 0; right: 0;
      background: #fff; border: 1px solid #ccc; border-radius: 5px;
      margin-top: 5px; max-height: 1000px; overflow-y: auto;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: none; z-index: 1000;
      font-size: 1.05rem;
    }
    .options div {
      padding: 12px; cursor: pointer; text-align: left;
      transition: background-color 0.2s, color 0.2s;
    }
    .options div:hover { background-color: #e9f5ff; color: #007bff; }

    .btn-lanjutkan {
      background-color: #A9A9A9; border-color: #A9A9A9; color: #FFFFFF;
      font-weight: 600; cursor: not-allowed; pointer-events: none;
      padding: 10px 22px; font-size: 1rem;
    }
    .btn-lanjutkan.active {
      background-color: #007bff; border-color: #007bff; color: #FFFFFF;
      cursor: pointer; pointer-events: auto;
    }

    .add-field {
      display: block; width: 100%; padding: 14px;
      border: 2px dashed #ccc; border-radius: 6px;
      color: #555; font-weight: 500; background: #fff; cursor: pointer;
      margin-bottom: 25px; text-align: center; font-size: 1.05rem;
    }
    .add-field:hover { background: #f1f1f1; }

    .remove-btn { background: none; border: none; color: #000; font-size: 1.6rem; cursor: pointer; margin-left: 10px; }

    .job-select { display: flex; flex-direction: column; gap: 10px; }
    .job-header { display: flex; align-items: center; gap: 10px; }

    .subjobs { text-align: left; margin-left: 8px; display: none; font-size: 1.05rem; }
    .subjobs label { display: block; margin-bottom: 8px; }
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
            role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
      </div>
    </div>
  </div>

  <div class="content-container">
    <div class="outer-circle">
      <div class="inner-circle">
        <img src="{{ asset('images/orang.png') }}" alt="Profil Pengguna" class="profile-pic">
      </div>
    </div>
    <h2 class="fw-bold mb-2">Bagus! Apa jenis pekerjaan yang kamu cari?</h2>

    <div class="info-box d-flex align-items-start">
      <i class="bi bi-info-circle-fill"></i>
      <span>Informasi ini membantu Talenthub merekomendasikan pekerjaan yang pas untukmu.</span>
    </div>

    <form action="{{ url('/tipe-pekerjaan') }}" method="GET" id="jobForm"  class="mt-4 w-100">
      <div id="jobFields">
        <div class="mb-3 job-select default-field">
          <div class="job-header">
            <div class="custom-select">
              <div class="select-box">Pilih fungsi pekerjaan*</div>
              <div class="options">
                <div>DevOps & Infrastructure</div>
                <div>Analyst & Consultant</div>
                <div>Project Management</div>
                <div>UI/UX Design</div>
                <div>Database Management</div>
                <div>Frontend Developer</div>
                <div>Mobile Developer</div>
                <div>Backend Developer</div>
                <div>Cybersecurity</div>
              </div>
            </div>
            <button type="button" class="remove-btn default-remove d-none">
              <i class="fa-solid fa-square-xmark"></i>
            </button>
          </div>
          <div class="subjobs"></div>
        </div>
      </div>

      <button type="button" class="add-field" id="addJobField">+ Tambahkan bidang pekerjaan</button>

      <div class="d-grid">
        <button type="submit" id="btnLanjutkan" class="btn btn-lanjutkan" disabled>LANJUTKAN</button>
      </div>
    </form>
  </div>

  <script>
    const jobFields = document.getElementById("jobFields");
    const addJobField = document.getElementById("addJobField");
    const btnLanjutkan = document.getElementById("btnLanjutkan");
    const defaultRemoveBtn = document.querySelector(".default-remove");

    const optionsHTML = `
      <div>DevOps & Infrastructure</div>
      <div>Analyst & Consultant</div>
      <div>Project Management</div>
      <div>UI/UX Design</div>
      <div>Database Management</div>
      <div>Frontend Developer</div>
      <div>Mobile Developer</div>
      <div>Backend Developer</div>
      <div>Cybersecurity</div>
    `;

    const jobMap = {
      "DevOps & Infrastructure": ["DevOps Engineer", "Site Reliability Engineer (SRE)", "Cloud Engineer", "Infrastructure Engineer"],
      "Analyst & Consultant": ["Business Analyst", "Data Analyst", "IT Consultant", "Financial Analyst"],
      "Project Management": ["Project Manager", "Scrum Master", "Product Owner"],
      "UI/UX Design": ["UI Designer", "UX Designer", "UX Researcher", "Product Designer"],
      "Database Management": ["Database Administrator (DBA)", "Data Engineer", "Database Developer"],
      "Frontend Developer": ["Frontend Developer", "Web Designer", "Frontend Engineer"],
      "Mobile Developer": ["Android Developer", "iOS Developer", "React Native Developer", "Flutter Developer"],
      "Backend Developer": ["Backend Developer", "Full Stack Developer", "Backend Engineer"],
      "Cybersecurity": ["Cybersecurity Analyst", "Penetration Tester", "Security Architect", "Incident Responder"]
    };

    function createField() {
      const field = document.createElement("div");
      field.classList.add("mb-3", "job-select");
      field.innerHTML = `
        <div class="job-header">
          <div class="custom-select">
            <div class="select-box">Pilih fungsi pekerjaan*</div>
            <div class="options">${optionsHTML}</div>
          </div>
          <button type="button" class="remove-btn"><i class="fa-solid fa-square-xmark"></i></button>
        </div>
        <div class="subjobs"></div>
      `;
      return field;
    }

    addJobField.addEventListener("click", () => {
      const newField = createField();
      jobFields.appendChild(newField);
      defaultRemoveBtn.classList.remove("d-none");
      checkSelection(); // tombol tetap nonaktif sampai isi valid
    });

    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("select-box")) {
        const customSelect = e.target.closest(".custom-select");
        const options = customSelect.querySelector(".options");
        const isOpen = options.style.display === "block";

        // tutup semua dropdown lain
        document.querySelectorAll(".custom-select").forEach(sel => {
          sel.classList.remove("open");
          sel.querySelector(".options").style.display = "none";
        });

        if (!isOpen) {
          options.style.display = "block";
          customSelect.classList.add("open");
          adjustDropdownToViewport(options);
        }
      } else {
        document.querySelectorAll(".custom-select").forEach(sel => {
          sel.classList.remove("open");
          sel.querySelector(".options").style.display = "none";
        });
      }
    });

    document.addEventListener("click", (e) => {
      if (e.target.closest(".options div")) {
        const selected = e.target.textContent;
        const customSelect = e.target.closest(".custom-select");
        const selectBox = customSelect.querySelector(".select-box");
        const subjobs = e.target.closest(".job-select").querySelector(".subjobs");
        selectBox.textContent = selected;
        customSelect.querySelector(".options").style.display = "none";
        customSelect.classList.remove("open");
        renderSubjobs(selected, subjobs);
        checkSelection();
      }
    });

    function renderSubjobs(job, container) {
      container.innerHTML = "<p class='mb-2'>Pilih setidaknya 1 bidang yang kamu minati:</p>";
      jobMap[job].forEach(sub => {
        container.innerHTML += `<label><input type="checkbox" class="subjob-checkbox"> ${sub}</label>`;
      });
      container.style.display = "block";
    }

    document.addEventListener("change", (e) => {
      if (e.target.classList.contains("subjob-checkbox")) {
        checkSelection();
      }
    });

    document.addEventListener("click", (e) => {
      if (e.target.closest(".remove-btn")) {
        const field = e.target.closest(".job-select");
        if (field.classList.contains("default-field")) {
          const extraFields = jobFields.querySelectorAll(".job-select:not(.default-field)");
          if (extraFields.length > 0) extraFields[0].remove();
        } else {
          field.remove();
        }
        if (jobFields.querySelectorAll(".job-select:not(.default-field)").length === 0) {
          defaultRemoveBtn.classList.add("d-none");
        }
        checkSelection();
      }
    });

    // LOGIKA BARU -> semua field harus pilih fungsi + minimal 1 subjob
    function checkSelection() {
      let allValid = true;
      document.querySelectorAll(".job-select").forEach(field => {
        const selectBox = field.querySelector(".select-box").textContent.trim();
        const subChecked = field.querySelectorAll(".subjob-checkbox:checked");
        if (selectBox === "Pilih fungsi pekerjaan*" || subChecked.length === 0) {
          allValid = false;
        }
      });
      if (allValid) {
        btnLanjutkan.classList.add("active");
        btnLanjutkan.disabled = false;
      } else {
        btnLanjutkan.classList.remove("active");
        btnLanjutkan.disabled = true;
      }
    }

    const DROPDOWN_BOTTOM_PADDING = 20;
    function adjustDropdownToViewport(optionsEl) {
      if (!optionsEl) return;
      const selectBox = optionsEl.closest(".custom-select").querySelector(".select-box");
      const rect = selectBox.getBoundingClientRect();
      const availableBelow = window.innerHeight - rect.bottom - DROPDOWN_BOTTOM_PADDING;
      const cssMax = 1000;
      const finalMax = Math.max(150, Math.min(cssMax, availableBelow));
      optionsEl.style.maxHeight = finalMax + 'px';
      optionsEl.style.overflowY = 'auto';
    }

    window.addEventListener('resize', () => {
      document.querySelectorAll('.options').forEach(opt => {
        if (getComputedStyle(opt).display !== 'none') adjustDropdownToViewport(opt);
      });
    });
    window.addEventListener('orientationchange', () => {
      document.querySelectorAll('.options').forEach(opt => {
        if (getComputedStyle(opt).display !== 'none') adjustDropdownToViewport(opt);
      });
    });
  </script>
</body>
</html>