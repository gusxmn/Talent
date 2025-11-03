<style>
    /* CSS Khusus untuk Bagian Sidebar (Pengaturan Akun) dan Judul */
    .account-setting-container {
        padding: 40px 0;
    }

    .profile-card {
        /* PERUBAHAN: Ubah border-radius menjadi 0 untuk sudut lancip/kotak */
        border-radius: 0;
        /* PERUBAHAN: Border lebih tebal/menonjol, disamakan dengan card utama */
        box-shadow: none;
        border: 1px solid #cfcbcbff;
        overflow: hidden;
    }

    .profile-sidebar {
        background-color: #fff;
        padding: 24px;
    }

    .profile-info {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    /* Ukuran ikon profil diperbesar */
    .profile-avatar-lg {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background-color: #f5e7c6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #333;
        margin: 0 auto 15px;
        position: relative;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        flex-shrink: 0;
    }

    .profile-avatar-lg i.fas.fa-user {
        font-size: 3.5rem;
        color: #6c757d;
    }

    .profile-avatar-lg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c2c2c;
        margin-bottom: 5px;
    }

    .profile-info p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .btn-kelola-profil {
        background-color: #0d47a1;
        color: #fff;
        font-weight: 600;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        display: block;
        width: 100%;
        margin-top: 20px;
        transition: background-color 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-kelola-profil:hover {
        background-color: #003380;
        color: #fff;
    }

    /* Mengatur warna menu navigasi menjadi abu-abu */
    .profile-sidebar .list-unstyled a {
        color: #6c757d;
        text-decoration: none;
        display: block;
        padding: 8px 0;
        font-size: 1rem;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .profile-sidebar .list-unstyled a:hover {
        color: #0d47a1;
    }

    /* PERUBAHAN UTAMA: Jarak antar menu navigasi ditingkatkan dari 5px menjadi 15px */
    .list-unstyled li {
        margin-bottom: 15px; /* Ditingkatkan untuk jarak yang lebih besar */
    }

    /* CSS Tambahan untuk Centering Judul di atas Card Sidebar */
    .centered-title-container {
        max-width: 33.333333%; /* Ini adalah lebar col-lg-4 */
        margin: 0 auto; /* Tengah secara horizontal */
        text-align: center;
    }

    /* Responsive adjustments */
    @media (min-width: 992px) {
        .centered-title-container {
            margin-left: 0; /* Align ke kiri container row */
        }
    }
    
    @media (max-width: 991.98px) {
        .centered-title-container {
            max-width: 100%;
            margin: 0;
            text-align: left;
        }
    }
    
    @media (max-width: 768px) {
        .profile-card {
            margin-bottom: 20px;
        }

        .profile-sidebar {
            border-right: none;
            padding: 20px;
        }
    }
</style>

{{-- Judul "Pengaturan Akun" dipindahkan ke partials --}}
<div class="centered-title-container mb-4 d-none d-lg-block">
    <h1 style="font-size: 1.8rem; font-weight: 600; margin: 0;">Pengaturan Akun</h1>
</div>

<h1 class="mb-4 d-lg-none" style="font-size: 1.8rem; font-weight: 600;">Pengaturan Akun</h1>


<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="profile-card">
            <div class="profile-sidebar">
                @php
                    // Logika PHP untuk data pengguna
                    $user = Auth::user();
                    $name = $user->name ?? 'ilham wiguna'; 
                    $location = $user->lokasi ?? 'Indonesia';
                    
                    // Logika inisial
                    $nameParts = explode(' ', trim($name));
                    $initials = '';
                    if (count($nameParts) >= 2) {
                        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1));
                    } elseif (count($nameParts) == 1 && !empty($nameParts[0])) {
                        $initials = strtoupper(substr($nameParts[0], 0, 2));
                    }
                @endphp

                <div class="profile-info">
                    <div class="profile-avatar-lg">
                        @if (isset($user) && $user->avatar)
                            <img src="{{ $user->avatar }}" alt="Profile Avatar">
                        @else
                            @if (!empty($initials))
                                {{ $initials }}
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        @endif
                    </div>
                    <h4>{{ $name }}</h4>
                    <p>{{ $location }}</p>
                    <a href="{{ url('/profil') }}" class="btn-kelola-profil">
                        KELOLA PROFIL <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>

                <ul class="list-unstyled mt-4">
                    <li>
                        {{-- PERUBAHAN LINK: Menggunakan route name yang baru --}}
                        <a href="{{ route('account.settings') }}" class="text-decoration-none">DETAIL LOGIN</a>
                    </li>
                    <li>
                        {{-- PERUBAHAN: Mengarahkan ke rute kontak baru --}}
                        <a href="{{ route('account.contact') }}" class="text-decoration-none">KONTAK SAYA</a>
                    </li>
                    <li>
                        <a href="{{ route('account.linked') }}" class="text-decoration-none">AKUN TERHUBUNG</a>
                    </li>
                    <li>
                        <a href="{{ route('account.notifications') }}" class="text-decoration-none">PREFERENSI NOTIFIKASI</a>
                    </li>
                    <li>
                        <a href="{{ route('account.help.support') }}" class="text-decoration-none">BANTUAN & DUKUNGAN</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>