<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <div class="container mt-5 mb-5">

        <h1 class="mb-4">Edit Profil</h1>

        {{-- ERROR VALIDATION --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- KIRI --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control"
                            value="{{ old('role', $user->role) }}">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1"
                            {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control"
                            value="{{ old('lokasi', $user->lokasi) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control"
                            value="{{ old('whatsapp', $user->whatsapp) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-select">
                            <option value="">Pilih</option>
                            <option value="laki-laki" {{ old('gender', $user->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('gender', $user->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                </div>

                {{-- KANAN --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Link GitHub</label>
                        <input type="url" class="form-control" name="link_github"
                            value="{{ old('link_github', $user->link_github) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Link Portofolio</label>
                        <input type="url" class="form-control" name="link_portofolio"
                            value="{{ old('link_portofolio', $user->link_portofolio) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Skills</label>
                        <textarea class="form-control" name="skills" rows="3">{{ old('skills', $user->skills) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tentang Anda</label>
                        <textarea class="form-control" name="tentang_anda" rows="3">{{ old('tentang_anda', $user->tentang_anda) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" name="asal_sekolah"
                            value="{{ old('asal_sekolah', $user->asal_sekolah) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                        @if($user->avatar)
                        <small class="text-muted d-block mt-1">
                            Avatar saat ini:
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" width="50">
                        </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload CV</label>
                        <input type="file" name="upload_cv" class="form-control" accept=".pdf,.doc,.docx">
                        @if($user->upload_cv)
                        <small class="text-muted d-block mt-1">
                            CV saat ini:
                            <a href="{{ asset('storage/cvs/' . $user->upload_cv) }}" target="_blank">Lihat</a>
                        </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Ijazah</label>
                        <input type="file" name="upload_ijazah" class="form-control" accept=".pdf,.doc,.docx">
                        @if($user->upload_ijazah)
                        <small class="text-muted d-block mt-1">
                            Ijazah saat ini:
                            <a href="{{ asset('storage/ijazahs/' . $user->upload_ijazah) }}" target="_blank">Lihat</a>
                        </small>
                        @endif
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary mt-3">Batal</a>

        </form>
    </div>

    {{-- FOOTER --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
