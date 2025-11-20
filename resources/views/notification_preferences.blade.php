<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Talenthub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background-color: #f7f7f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .page-content-wrapper {
            flex-grow: 1;
            background-color: #fff;
        }

        .pt-15 {
            padding-top: 5rem !important;
        }

        @media (max-width: 992px) {
            .pt-15 {
                padding-top: 3rem !important;
            }
        }

        .setting-card {
            border-radius: 0;
            box-shadow: none;
            border: 1px solid #cfcbcbff;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 0;
            font-size: 1rem;
        }

        .page-heading {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 15px;
        }

        .page-description {
            font-size: 1rem;
            color: #495057;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .section-sub-heading {
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 15px;
        }

        .notification-section {
            padding: 20px 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .notification-section:last-of-type {
            border-bottom: none;
        }

        .card-content {
            padding: 0 0;
        }

        .notification-section-item {
            padding: 0 0;
        }

        .notification-section h6 {
            font-size: 1rem;
            font-weight: 600;
            color: #2c2c2c;
            margin-bottom: 5px;
        }

        .notification-section p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .notification-toggle-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .notification-email-label {
            font-size: 1rem;
            color: #495057;
            font-weight: 500;
            margin-right: -20px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .form-switch {
            margin-left: 0;
        }

        .form-switch .form-check-input {
            width: 48px;
            height: 24px;
            margin-left: 0;
            background-color: #e9ecef;
            border-color: #dee2e6;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        /* PERUBAHAN: Tombol Simpan Perubahan dengan warna biru dan tanpa efek hover */
        .btn-simpan-perubahan {
            background-color: #0d47a1;
            color: #fff;
            border: 1px solid #0d47a1;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 4px;
            transition: none;
            font-size: 0.9rem;
            text-transform: uppercase;
            cursor: pointer;
        }

        /* PERUBAHAN: Menghapus efek hover secara permanen */
        .btn-simpan-perubahan:hover,
        .btn-simpan-perubahan:active,
        .btn-simpan-perubahan:focus {
            background-color: #0d47a1;
            color: #fff;
            border: 1px solid #0d47a1;
        }

        .btn-tersimpan {
            background-color: #28a745;
            color: #fff;
            border: 1px solid #28a745;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 4px;
            transition: none;
            font-size: 0.9rem;
            text-transform: uppercase;
            cursor: default;
        }

        /* PERUBAHAN: Menghapus efek hover untuk tombol tersimpan */
        .btn-tersimpan:hover,
        .btn-tersimpan:active,
        .btn-tersimpan:focus {
            background-color: #28a745;
            color: #fff;
            border: 1px solid #28a745;
        }

        .save-button-container {
            padding: 20px 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .setting-card {
                padding: 0;
            }
            .notification-section {
                padding: 15px 15px;
            }
            .save-button-container {
                padding: 15px 15px;
            }
            .notification-email-label {
                margin-right: 5px;
            }
        }
    </style>
</head>

<body>

    @include('partials.navbar')
    
    <div class="page-content-wrapper">
        <div class="account-setting-container">
            <div class="container">

                @include('partials.setting_account')
                
                    <div class="col-lg-8 col-md-7">

                        <h4 class="page-heading">Preferensi Notifikasi</h4>
                        <p class="page-description">
                            Talenthub akan tetap mengirimkan notifikasi penting ke akun kamu diluar dari pengaturan notifikasi yang tersedia.
                        </p>
                        <h6 class="section-sub-heading">Notifikasi yang kamu terima</h6>

                        <div class="setting-card">

                            <div class="card-content">

                                <div class="notification-section">
                                    <div class="row align-items-center notification-section-item">
                                        <div class="col-12">
                                            <h6>Status Lamaran</h6>
                                            <p>Dapatkan update dari lamaranmu, seperti perubahan status lamaran dan pesan masuk dari HRD</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="notification-toggle-group">
                                                <label class="notification-email-label" for="statusLamaranEmailSwitch">Notifikasi email</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="statusLamaranEmailSwitch" data-key="statusLamaranEmail" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="notification-section">
                                    <div class="row align-items-center notification-section-item">
                                        <div class="col-12">
                                            <h6>Rekomendasi Pekerjaan</h6>
                                            <p>Terima notifikasi rekomendasi lowongan pekerjaan yang sesuai dengan profil kamu.</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="notification-toggle-group">
                                                <label class="notification-email-label" for="rekomendasiKerjaEmailSwitch">Notifikasi email</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="rekomendasiKerjaEmailSwitch" data-key="rekomendasiKerjaEmail" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="save-button-container text-center pt-3">
                                    <button type="button" class="btn-simpan-perubahan" id="btnSimpanPerubahan">SIMPAN PERUBAHAN</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const switches = document.querySelectorAll('.form-check-input[data-key]');
            const btnSimpan = document.getElementById('btnSimpanPerubahan');
            
            function loadNotificationStatus() {
                switches.forEach(switchEl => {
                    const key = switchEl.getAttribute('data-key');
                    const savedStatus = localStorage.getItem(key);
                    if (savedStatus !== null) {
                        switchEl.checked = (savedStatus === 'true');
                    } else {
                        switchEl.checked = switchEl.defaultChecked;
                    }
                });
            }

            function saveNotificationStatus() {
                let changesMade = false;
                switches.forEach(switchEl => {
                    const key = switchEl.getAttribute('data-key');
                    const newStatus = switchEl.checked;
                    const currentSavedStatus = localStorage.getItem(key);

                    if (currentSavedStatus === null && newStatus !== switchEl.defaultChecked) {
                        changesMade = true;
                    } else if (currentSavedStatus !== null && newStatus.toString() !== currentSavedStatus) {
                        changesMade = true;
                    }
                    
                    localStorage.setItem(key, newStatus);
                });

                if (changesMade) {
                    btnSimpan.textContent = 'PERUBAHAN TERSIMPAN';
                    btnSimpan.classList.remove('btn-simpan-perubahan');
                    btnSimpan.classList.add('btn-tersimpan');
                    btnSimpan.disabled = true;
                }
            }

            function checkForChanges() {
                let isDirty = false;
                switches.forEach(switchEl => {
                    const key = switchEl.getAttribute('data-key');
                    const savedStatus = localStorage.getItem(key);
                    
                    const currentStatus = switchEl.checked.toString();
                    const initialStatus = (savedStatus !== null) ? savedStatus : switchEl.defaultChecked.toString();

                    if (currentStatus !== initialStatus) {
                        isDirty = true;
                    }
                });
                
                if (isDirty) {
                    btnSimpan.textContent = 'SIMPAN PERUBAHAN';
                    btnSimpan.classList.add('btn-simpan-perubahan');
                    btnSimpan.classList.remove('btn-tersimpan');
                    btnSimpan.disabled = false;
                } else {
                    btnSimpan.textContent = 'SIMPAN PERUBAHAN';
                    btnSimpan.classList.add('btn-simpan-perubahan');
                    btnSimpan.classList.remove('btn-tersimpan');
                    btnSimpan.disabled = true;
                }
            }
            
            loadNotificationStatus();
            
            btnSimpan.disabled = true;
            
            switches.forEach(switchEl => {
                switchEl.addEventListener('change', checkForChanges);
            });
            
            btnSimpan.addEventListener('click', saveNotificationStatus);
        });
    </script>

</body>
</html>