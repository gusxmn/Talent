<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil - InotalHub</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            background-color: #f7f9fc;
        }
        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .welcome-text {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        .info-item {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        .info-label {
            font-weight: 600;
            color: #2d3748;
            min-width: 120px;
        }
        .steps {
            margin: 30px 0;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 3px solid #667eea;
        }
        .step-number {
            background: #667eea;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
        }
        .step-content h4 {
            margin: 0 0 5px 0;
            color: #2d3748;
        }
        .step-content p {
            margin: 0;
            color: #718096;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.3);
            color: white !important;
        }
        .footer {
            background: #f8f9fa;
            padding: 25px;
            text-align: center;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 5px 0;
        }
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎉 Pendaftaran Berhasil!</h1>
            <p>Selamat datang di InotalHub - Platform Pencarian Kerja Terbaik</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="welcome-text">
                Halo <strong>{{ $userName }}</strong>,
            </div>
            
            <p>Selamat! Pendaftaran perusahaan <strong>{{ $companyName }}</strong> di InotalHub telah berhasil diproses. Akun Anda sekarang aktif dan siap digunakan.</p>
            
            <div class="info-box">
                <div class="info-item">
                    <span class="info-label">Nama Perusahaan:</span> {{ $companyName }}
                </div>
                <div class="info-item">
                    <span class="info-label">Email Login:</span> {{ $email }}
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Bergabung:</span> {{ $registrationDate }}
                </div>
            </div>

            <div class="steps">
                <h3 style="color: #2d3748; margin-bottom: 20px;">Mulai Gunakan InotalHub:</h3>
                
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Login ke Dashboard</h4>
                        <p>Akses dashboard perusahaan Anda untuk mengelola semua fitur</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Lengkapi Profil Perusahaan</h4>
                        <p>Tambahkan informasi lengkap untuk menarik lebih banyak talenta</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Pasang Lowongan Kerja</h4>
                        <p>Mulai pasang lowongan dan temukan kandidat terbaik</p>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="button">🚀 Login ke Dashboard Sekarang</a>
            </div>

            <p style="color: #718096; font-size: 14px; text-align: center; margin-top: 20px;">
                Jika tombol di atas tidak bekerja, salin dan tempel link berikut di browser Anda:<br>
                <span style="color: #667eea; word-break: break-all;">{{ $loginUrl }}</span>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="logo">InotalHub</div>
            <p>Platform Pencarian Kerja dan Talent Terpercaya</p>
            <p>&copy; {{ date('Y') }} InotalHub. All rights reserved.</p>
        </div>
    </div>
</body>
</html>