<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <div class="container mt-5 mb-5">

        <h1 class="mb-4">Profil Pengguna</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Avatar --}}
                @if($user->avatar)
                <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                     class="img-thumbnail mb-3"
                     style="width:150px;" alt="Avatar">
                @endif

                <h4 class="card-title">{{ $user->name }}</h4>

                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
                <p><strong>Status Aktif:</strong> {{ $user->is_active ? 'Ya' : 'Tidak' }}</p>
                <p><strong>Lokasi:</strong> {{ $user->lokasi ?? 'Tidak diisi' }}</p>
                <p><strong>WhatsApp:</strong> {{ $user->whatsapp ?? 'Tidak diisi' }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $user->gender ?? 'Tidak diisi' }}</p>

                <p><strong>Link GitHub:</strong>
                    @if($user->link_github)
                        <a href="{{ $user->link_github }}" target="_blank">{{ $user->link_github }}</a>
                    @else
                        Tidak diisi
                    @endif
                </p>

                <p><strong>Link Portofolio:</strong>
                    @if($user->link_portofolio)
                        <a href="{{ $user->link_portofolio }}" target="_blank">{{ $user->link_portofolio }}</a>
                    @else
                        Tidak diisi
                    @endif
                </p>

                <p><strong>Skills:</strong> {{ $user->skills ?? 'Tidak diisi' }}</p>
                <p><strong>Tentang Anda:</strong> {{ $user->tentang_anda ?? 'Tidak diisi' }}</p>
                <p><strong>Asal Sekolah:</strong> {{ $user->asal_sekolah ?? 'Tidak diisi' }}</p>

                {{-- CV --}}
                @if($user->upload_cv)
                <p><strong>CV:</strong>
                    <a href="{{ asset('storage/cvs/' . $user->upload_cv) }}" target="_blank">
                        Unduh CV
                    </a>
                </p>
                @endif

                {{-- Ijazah --}}
                @if($user->upload_ijazah)
                <p><strong>Ijazah:</strong>
                    <a href="{{ asset('storage/ijazahs/' . $user->upload_ijazah) }}" target="_blank">
                        Unduh Ijazah
                    </a>
                </p>
                @endif

            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>

    </div>

    {{-- FOOTER --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
