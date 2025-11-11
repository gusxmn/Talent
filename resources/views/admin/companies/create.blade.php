@extends('admin.layout')

@section('title', 'Tambah Perusahaan Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-building me-2"></i>Tambah Perusahaan Baru
                        </h4>
                        <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                    <!-- Menampilkan Pesan Error Validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Menampilkan Pesan Sukses -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Kolom Kiri - Data Pendaftar -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">Data Pendaftar</h5>
                                
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label required">Nama Lengkap</label>
                                    <input type="text" 
                                           class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                           id="nama_lengkap" 
                                           name="nama_lengkap" 
                                           value="{{ old('nama_lengkap') }}" 
                                           placeholder="Masukkan nama lengkap pendaftar" 
                                           required>
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="no_hp" class="form-label required">No. HP</label>
                                    <input type="text" 
                                           class="form-control @error('no_hp') is-invalid @enderror" 
                                           id="no_hp" 
                                           name="no_hp" 
                                           value="{{ old('no_hp') }}" 
                                           placeholder="Contoh: 081234567890" 
                                           required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jabatan" class="form-label required">Jabatan</label>
                                    <input type="text" 
                                           class="form-control @error('jabatan') is-invalid @enderror" 
                                           id="jabatan" 
                                           name="jabatan" 
                                           value="{{ old('jabatan') }}" 
                                           placeholder="Contoh: Director, HR Manager, dll." 
                                           required>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label required">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="company@example.com" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label required">Password</label>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Minimal 8 karakter" 
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan - Data Perusahaan -->
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-3">Data Perusahaan</h5>
                                
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label required">Nama Perusahaan</label>
                                    <input type="text" 
                                           class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                           id="nama_perusahaan" 
                                           name="nama_perusahaan" 
                                           value="{{ old('nama_perusahaan') }}" 
                                           placeholder="Masukkan nama perusahaan" 
                                           required>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_karyawan" class="form-label required">Jumlah Karyawan</label>
                                    <input type="number" 
                                           class="form-control @error('jumlah_karyawan') is-invalid @enderror" 
                                           id="jumlah_karyawan" 
                                           name="jumlah_karyawan" 
                                           value="{{ old('jumlah_karyawan') }}" 
                                           placeholder="Contoh: 50" 
                                           required>
                                    @error('jumlah_karyawan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="industri" class="form-label required">Industri</label>
                                    <input type="text" 
                                           class="form-control @error('industri') is-invalid @enderror" 
                                           id="industri" 
                                           name="industri" 
                                           value="{{ old('industri') }}" 
                                           placeholder="Contoh: Teknologi, Manufaktur, Retail, dll." 
                                           required>
                                    @error('industri')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="provinsi" class="form-label required">Provinsi</label>
                                    <input type="text" 
                                           class="form-control @error('provinsi') is-invalid @enderror" 
                                           id="provinsi" 
                                           name="provinsi" 
                                           value="{{ old('provinsi') }}" 
                                           placeholder="Contoh: Jawa Barat" 
                                           required>
                                    @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kota" class="form-label required">Kota</label>
                                    <input type="text" 
                                           class="form-control @error('kota') is-invalid @enderror" 
                                           id="kota" 
                                           name="kota" 
                                           value="{{ old('kota') }}" 
                                           placeholder="Contoh: Bandung" 
                                           required>
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="mb-3">
                            <label for="alamat_lengkap" class="form-label required">Alamat Lengkap</label>
                            <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                                      id="alamat_lengkap" 
                                      name="alamat_lengkap" 
                                      rows="3" 
                                      placeholder="Masukkan alamat lengkap perusahaan" 
                                      required>{{ old('alamat_lengkap') }}</textarea>
                            @error('alamat_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Logo Perusahaan -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Perusahaan</label>
                            <input type="file" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/svg">
                            
                            <!-- Preview Logo -->
                            <img id="logoPreview" class="preview-logo mt-2" src="#" alt="Preview Logo">
                            
                            <div class="form-text">
                                Format yang didukung: JPEG, PNG, JPG, GIF, SVG. Maksimal 2MB.
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Perusahaan Aktif
                                </label>
                            </div>
                            <div class="form-text">
                                Centang untuk menandai perusahaan sebagai aktif.
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-3">
                            <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perusahaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .required:after {
        content: " *";
        color: red;
    }
    .preview-logo {
        max-width: 150px;
        max-height: 150px;
        display: none;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
    }
    h5 {
        color: #2c3e50;
        font-weight: 600;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview Logo
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logoPreview');
        
        if (logoInput) {
            logoInput.addEventListener('change', function(event) {
                const [file] = event.target.files;
                
                if (file) {
                    logoPreview.style.display = 'block';
                    logoPreview.src = URL.createObjectURL(file);
                    
                    // Clean up URL object when preview is removed
                    logoPreview.onload = function() {
                        URL.revokeObjectURL(logoPreview.src);
                    }
                } else {
                    logoPreview.style.display = 'none';
                    logoPreview.src = '#';
                }
            });
        }

        // Validasi form sebelum submit
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = this.querySelectorAll('[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        if (!field.classList.contains('is-invalid')) {
                            field.classList.add('is-invalid');
                        }
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field yang wajib diisi!');
                }
            });

            // Remove invalid class when user starts typing in required fields
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        }
    });
</script>
@endsection