<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Profil Kandidat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* CSS sederhana untuk memberikan ruang pada body */
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            border-bottom: none;
        }
    </style>
</head>
<body>

@include('partials.navbar') {{-- Asumsi navbar partial ada di resources/views/partials/navbar.blade.php --}}

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">📝 Buat Profil Kandidat Baru</h4>
                </div>
                <div class="card-body">
                    {{-- Form akan POST ke route candidate_profiles.store --}}
                    {{-- CATATAN: Jika Anda ingin mengunggah file CV, Anda harus menambahkan enctype="multipart/form-data" --}}
                    <form method="POST" action="{{ route('candidate_profiles.store') }}">
                        @csrf
                        
                        {{-- Field user_id (Sembunyikan dan Isi Otomatis) --}}
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="">Pilih...</option>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                                @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <h5 class="mt-4">Lokasi & Alamat</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}">
                                @error('province') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Kota/Kabupaten</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}">
                                @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <h5 class="mt-4">Gaji & Preferensi Kerja</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="expected_salary_min" class="form-label">Gaji Ekspektasi Min. (Rp)</label>
                                <input type="number" class="form-control @error('expected_salary_min') is-invalid @enderror" id="expected_salary_min" name="expected_salary_min" value="{{ old('expected_salary_min') }}">
                                @error('expected_salary_min') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="expected_salary_max" class="form-label">Gaji Ekspektasi Maks. (Rp)</label>
                                <input type="number" class="form-control @error('expected_salary_max') is-invalid @enderror" id="expected_salary_max" name="expected_salary_max" value="{{ old('expected_salary_max') }}">
                                @error('expected_salary_max') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="job_level" class="form-label">Level Jabatan</label>
                                <input type="text" class="form-control @error('job_level') is-invalid @enderror" id="job_level" name="job_level" value="{{ old('job_level') }}">
                                @error('job_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="work_type_preference" class="form-label">Tipe Pekerjaan</label>
                                <input type="text" class="form-control @error('work_type_preference') is-invalid @enderror" id="work_type_preference" name="work_type_preference" value="{{ old('work_type_preference') }}">
                                @error('work_type_preference') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="job_preferences" class="form-label">Preferensi Industri</label>
                                <input type="text" class="form-control @error('job_preferences') is-invalid @enderror" id="job_preferences" name="job_preferences" value="{{ old('job_preferences') }}">
                                @error('job_preferences') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <h5 class="mt-4">Tentang Diri & Tautan</h5>
                        <hr>
                        <div class="col-12 mb-3">
                            <label for="about_me" class="form-label">Tentang Saya</label>
                            <textarea class="form-control @error('about_me') is-invalid @enderror" id="about_me" name="about_me" rows="4">{{ old('about_me') }}</textarea>
                            @error('about_me') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="portfolio_url" class="form-label">URL Portofolio</label>
                                <input type="url" class="form-control @error('portfolio_url') is-invalid @enderror" id="portfolio_url" name="portfolio_url" value="{{ old('portfolio_url') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="linkedin_url" class="form-label">URL LinkedIn</label>
                                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="github_url" class="form-label">URL GitHub</label>
                                <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url" name="github_url" value="{{ old('github_url') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="website_url" class="form-label">URL Website Pribadi</label>
                                <input type="url" class="form-control @error('website_url') is-invalid @enderror" id="website_url" name="website_url" value="{{ old('website_url') }}">
                            </div>
                            
                            {{-- Input File CV jika Anda ingin mengaktifkan upload: --}}
                            {{-- <div class="col-12">
                                <label for="cv_file" class="form-label">Upload CV (PDF)</label>
                                <input type="file" class="form-control @error('cv_file') is-invalid @enderror" id="cv_file" name="cv_file" accept=".pdf">
                                @error('cv_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div> --}}
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Simpan Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer') {{-- Asumsi footer partial ada di resources/views/partials/footer.blade.php --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>