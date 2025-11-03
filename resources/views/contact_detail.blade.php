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
            background-color: #fff;
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
            /* DIUBAH MENJADI PUTIH */
            background-color: #fff; 
        }

        .setting-card {
            /* PERUBAHAN: Hapus border-radius agar sudut menjadi lancip */
            border-radius: 0; 
            box-shadow: none;
            border: 1px solid #cfcbcbff;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 0 20px 20px 20px; 
        }
        
        /* CSS UNTUK HEADER KARTU */
        .setting-card-header {
            /* DIUBAH MENJADI PUTIH (dulu #f7f7f7) */
            background-color: #F2F2F2; 
            padding: 15px 20px; 
            margin: 0 -20px 20px -20px; 
            /* PERUBAHAN: Hapus border-radius agar sudut header menjadi lancip */
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom: 1px solid #e0e0e0; 
        }
        
        .setting-card-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c2c2c;
            margin: 0; 
            padding: 0; 
            border-bottom: none; 
        }
        /* AKHIR CSS BARU */


        .form-control-glints {
            height: 45px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            color: #495057;
        }

        .form-control-glints:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 0 0.25rem rgba(13, 71, 161, 0.25);
            outline: 0;
        }

        .btn-update-whatsapp {
            background-color: #0d47a1;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .btn-update-whatsapp:hover {
            background-color: #003380;
            color: #fff;
        }

        .alert-settings {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .alert-success-custom {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        /* CSS UNTUK BOX INFO WHATSAPP (dari permintaan sebelumnya) */
        .whatsapp-info-box {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 4px;
            background-color: #e6f7ff;
            border: 1px solid #b3e6ff;
            font-size: 0.9rem;
            color: #005c8a;
            margin-top: 15px;
        }

        .whatsapp-info-box img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            flex-shrink: 0;
        }
        
        .whatsapp-info-box span {
            flex-grow: 1;
        }
        /* AKHIR CSS BOX INFO WHATSAPP */

        @media (max-width: 768px) {
            .setting-card {
                padding: 0 15px 15px 15px;
            }
            .setting-card-header {
                margin: 0 -15px 15px -15px;
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

                    <div class="setting-card">
                        
                        {{-- PERUBAHAN HTML: Tambahkan div pembungkus untuk header --}}
                        <div class="setting-card-header">
                            <h5>Nomor WhatsApp</h5>
                        </div>
                        {{-- AKHIR PERUBAHAN HTML --}}

                        @if (session('success_whatsapp'))
                            <div class="alert alert-success-custom alert-settings" role="alert">
                                {{ session('success_whatsapp') }}
                            </div>
                        @endif

                        @error('whatsapp')
                            <div class="alert alert-danger alert-settings" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        @php
                            // ... Logika PHP untuk menampilkan nomor WhatsApp
                            $userWhatsapp = Auth::user()->whatsapp;
                            $displayWhatsapp = '';
                            if (!empty($userWhatsapp)) {
                                if (substr($userWhatsapp, 0, 1) === '+') {
                                    $displayWhatsapp = $userWhatsapp;
                                }
                                else if (substr($userWhatsapp, 0, 1) === '8') {
                                    $displayWhatsapp = '0' . $userWhatsapp;
                                } else {
                                    $displayWhatsapp = $userWhatsapp;
                                }
                            }
                        @endphp

                        <form method="POST" action="{{ route('account.update.whatsapp') }}" class="row g-3">
                            @csrf

                            {{-- START: Pembungkus yang sama (col-md-6) untuk input dan info box --}}
                            <div class="col-md-6">
                                <label for="whatsapp_number" class="form-label visually-hidden">Nomor WhatsApp</label>
                                <div class="mb-3">
                                    <input type="text" id="whatsapp_number" name="whatsapp"
                                        class="form-control form-control-glints @error('whatsapp') is-invalid @enderror"
                                        placeholder="Contoh: 0812xxxxxxxx atau +62812xxxxxxxx"
                                        value="{{ old('whatsapp', $displayWhatsapp) }}"
                                        maxlength="15"
                                        required>
                                </div>
                                
                                {{-- KOTAK INFO WHATSAPP DIMASUKKAN KE DALAM COL-MD-6 --}}
                                <div class="whatsapp-info-box">
                                    <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp Icon">
                                    <span>Pastikan nomor WhatsApp kamu aktif agar dapat dihubungi perusahaan</span>
                                </div>
                                {{-- END KOTAK INFO WHATSAPP --}}

                            </div>
                            {{-- END: Pembungkus col-md-6 --}}
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-update-whatsapp">UPDATE WHATSAPP NUMBER</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Skrip JavaScript untuk membatasi input nomor WhatsApp (tidak ada perubahan)
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappInput = document.getElementById('whatsapp_number');

            if (whatsappInput) {
                whatsappInput.addEventListener('keydown', function(event) {
                    const key = event.key;

                    if (
                        key === 'ArrowLeft' ||
                        key === 'ArrowRight' ||
                        key === 'Delete' ||
                        key === 'Backspace' ||
                        key === 'Tab' ||
                        event.metaKey || event.ctrlKey
                    ) {
                        return;
                    }

                    if (!(/[0-9\+]/).test(key)) {
                        event.preventDefault();
                    }

                    if (key === '+') {
                        if (this.value.includes('+') || this.selectionStart !== 0) {
                            event.preventDefault();
                        }
                    }
                });

                whatsappInput.addEventListener('paste', function(event) {
                    const pastedText = (event.clipboardData || window.clipboardData).getData('text');
                    let cleanedText = pastedText.replace(/[^0-9+]/g, '');

                    if (cleanedText.startsWith('+')) {
                        cleanedText = '+' + cleanedText.substring(1).replace(/\+/g, '');
                    } else {
                        cleanedText = cleanedText.replace(/\+/g, '');
                    }

                    if (cleanedText.length > this.maxLength) {
                        cleanedText = cleanedText.substring(0, this.maxLength);
                    }

                    event.preventDefault();
                    document.execCommand('insertText', false, cleanedText);
                });
            }
        });
    </script>

</body>
</html>