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
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <!-- Nama Perusahaan -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label required">Nama Perusahaan</label>
                                    <input type="text" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" 
                                           name="nama" 
                                           value="{{ old('nama') }}" 
                                           placeholder="Masukkan nama perusahaan" 
                                           required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Industri -->
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

                                <!-- Website -->
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" 
                                           class="form-control @error('website') is-invalid @enderror" 
                                           id="website" 
                                           name="website" 
                                           value="{{ old('website') }}" 
                                           placeholder="https://example.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="company@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Telepon -->
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" 
                                           class="form-control @error('telepon') is-invalid @enderror" 
                                           id="telepon" 
                                           name="telepon" 
                                           value="{{ old('telepon') }}" 
                                           placeholder="+62 XXX-XXXX-XXXX">
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
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

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" 
                                              name="alamat" 
                                              rows="3" 
                                              placeholder="Masukkan alamat lengkap perusahaan">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label required">Deskripsi Perusahaan</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="5" 
                                      placeholder="Jelaskan tentang perusahaan, visi misi, dan layanan/produk yang ditawarkan..." 
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-3">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas"></i>Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas"></i>Simpan
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