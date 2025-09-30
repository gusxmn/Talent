@extends('admin.layout')

@section('title',)

@push('styles')
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    body {
        background-color: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .page-header { border-bottom: 1px solid #eaeaea; padding-bottom: 1rem; margin-bottom: 2rem; }
    .form-card { border: none; border-radius: 12px; box-shadow: var(--card-shadow); transition: all 0.3s ease; }
    .form-card:hover { box-shadow: var(--hover-shadow); }
    .form-label { font-weight: 600; color: #495057; margin-bottom: 0.5rem; }
    .form-control, .form-select { border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid #dee2e6; transition: all 0.3s; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25); }
    .btn-primary { background-color: var(--primary-color); border-color: var(--primary-color); border-radius: 8px; padding: 0.75rem 1.5rem; font-weight: 600; transition: all 0.3s; }
    .btn-primary:hover { background-color: var(--secondary-color); border-color: var(--secondary-color); transform: translateY(-2px); }
    .btn-secondary { border-radius: 8px; padding: 0.75rem 1.5rem; font-weight: 600; transition: all 0.3s; }
    .btn-secondary:hover { transform: translateY(-2px); }
    .alert { border-radius: 8px; border: none; }
    .form-check-input:checked { background-color: var(--primary-color); border-color: var(--primary-color); }
    .password-toggle { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6c757d; cursor: pointer; }
    .password-container { position: relative; }
    .role-icon { width: 24px; height: 24px; margin-right: 8px; display: inline-flex; align-items: center; justify-content: center; border-radius: 4px; background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color); }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1 text-primary">Tambah User Baru</h3>
                <p class="text-muted">Tambahkan pengguna baru ke dalam sistem</p>
            </div>
            
        </div>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="card shadow-sm p-4 form-card">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <h6 class="mb-0 fw-bold">Terjadi Kesalahan</h6>
                </div>
                <ul class="mt-2 mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Nama & Email --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                </div>
            </div>
        </div>

        {{-- Password --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <div class="password-container">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="button" class="password-toggle" id="togglePassword"><i class="bi bi-eye"></i></button>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <div class="password-container">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                    <button type="button" class="password-toggle" id="togglePasswordConfirmation"><i class="bi bi-eye"></i></button>
                </div>
            </div>
        </div>

        {{-- Role & Status --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Role Pengguna</label>
                <select name="role" class="form-select" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pimpinan" {{ old('role') == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                    <option value="testdev" {{ old('role') == 'testdev' ? 'selected' : '' }}>TestDev</option>
                    <option value="wawancara" {{ old('role') == 'wawancara' ? 'selected' : '' }}>Wawancara</option>
                    <option value="super admin" {{ old('role') == 'super admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>
            <div class="col-md-6 mb-3 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                    <label class="form-check-label fw-medium">Aktifkan Akun</label>
                    <div class="form-text">Akun yang tidak aktif tidak dapat login ke sistem</div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-2"></i>Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="bi bi-x-lg me-2"></i>Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('bi-eye','bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('bi-eye-slash','bi-eye');
        }
    });
    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordInput = document.getElementById('passwordConfirmation');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('bi-eye','bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('bi-eye-slash','bi-eye');
        }
    });
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('passwordConfirmation').value;
        if (password !== passwordConfirmation) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');
            document.getElementById('passwordConfirmation').focus();
        }
    });
</script>
@endpush
