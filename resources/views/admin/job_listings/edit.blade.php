@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Lowongan: {{ $jobListing->title }}</h1>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="editForm" action="{{ route('admin.job_listings.update', $jobListing->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm p-4 border-0">
        @csrf
        @method('PUT')

        <div class="row g-3">

            {{-- Judul & Perusahaan --}}
            <div class="col-md-6">
                <label class="form-label">Judul Lowongan</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $jobListing->title) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Perusahaan</label>
                <input type="text" name="company" class="form-control" value="{{ old('company', $jobListing->company) }}" required>
            </div>

            {{-- Logo --}}
            <div class="col-12">
                <label class="form-label">Logo Perusahaan</label><br>
                @if ($jobListing->company_logo)
                    <img src="{{ asset('storage/' . $jobListing->company_logo) }}" alt="Logo" class="img-thumbnail mb-2" style="max-width: 120px;">
                @endif
                <input type="file" name="company_logo" class="form-control">
            </div>

            {{-- Lokasi bertingkat (prefill & hidden input) --}}
            <div class="col-12">
                <label class="form-label">Lokasi</label>
                <div class="row g-2 mb-2">
                    <div class="col-md-3">
                        <select id="provinsi" class="form-select">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($lokasi->unique('provinsi') as $l)
                                <option value="{{ $l->provinsi }}">{{ $l->provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="kabupaten" class="form-select" disabled>
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="kecamatan" class="form-select" disabled>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="desa" class="form-select" disabled>
                            <option value="">-- Pilih Desa --</option>
                        </select>
                    </div>
                </div>
                {{-- Hidden input yang dikirimkan ke server --}}
                <input type="hidden" name="location" id="location" value="{{ old('location', $jobListing->location) }}" required>
                <div class="form-text">Pilih provinsi → kabupaten → kecamatan → desa. Lokasi akan tersimpan otomatis.</div>
            </div>

            {{-- Gaji --}}
            <div class="col-md-6">
                <label class="form-label">Gaji Minimum</label>
                <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min', $jobListing->salary_min) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Gaji Maksimum</label>
                <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max', $jobListing->salary_max) }}">
            </div>

            {{-- job_type & type --}}
            <div class="col-md-6">
                <label class="form-label">Jenis Pekerjaan (job_type)</label>
                <select name="job_type" class="form-select" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="penuh_waktu" {{ old('job_type', $jobListing->job_type) == 'penuh_waktu' ? 'selected' : '' }}>Penuh Waktu</option>
                    <option value="paruh_waktu" {{ old('job_type', $jobListing->job_type) == 'paruh_waktu' ? 'selected' : '' }}>Paruh Waktu</option>
                    <option value="kontrak" {{ old('job_type', $jobListing->job_type) == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                    <option value="magang" {{ old('job_type', $jobListing->job_type) == 'magang' ? 'selected' : '' }}>Magang</option>
                    <option value="freelance" {{ old('job_type', $jobListing->job_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="harian" {{ old('job_type', $jobListing->job_type) == 'harian' ? 'selected' : '' }}>Harian</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tipe Sistem (type)</label>
                <select name="type" class="form-select" required>
                    <option value="full-time" {{ old('type', $jobListing->type) == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                    <option value="part-time" {{ old('type', $jobListing->type) == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                    <option value="contract" {{ old('type', $jobListing->type) == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ old('type', $jobListing->type) == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>

            {{-- work_policy, experience_level, education_level --}}
            <div class="col-md-4">
                <label class="form-label">Kebijakan Kerja (work_policy)</label>
                <select name="work_policy" class="form-select" required>
                    <option value="kerja_di_kantor" {{ old('work_policy', $jobListing->work_policy) == 'kerja_di_kantor' ? 'selected' : '' }}>Kerja di Kantor</option>
                    <option value="hybrid" {{ old('work_policy', $jobListing->work_policy) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="remote" {{ old('work_policy', $jobListing->work_policy) == 'remote' ? 'selected' : '' }}>Remote</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Level Pengalaman (experience_level)</label>
                <select name="experience_level" class="form-select" required>
                    <option value="tidak_berpengalaman" {{ old('experience_level', $jobListing->experience_level) == 'tidak_berpengalaman' ? 'selected' : '' }}>Tidak Berpengalaman</option>
                    <option value="fresh_graduate" {{ old('experience_level', $jobListing->experience_level) == 'fresh_graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                    <option value="kurang_dari_setahun" {{ old('experience_level', $jobListing->experience_level) == 'kurang_dari_setahun' ? 'selected' : '' }}>Kurang dari Setahun</option>
                    <option value="1_3_tahun" {{ old('experience_level', $jobListing->experience_level) == '1_3_tahun' ? 'selected' : '' }}>1-3 Tahun</option>
                    <option value="3_5_tahun" {{ old('experience_level', $jobListing->experience_level) == '3_5_tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                    <option value="5_10_tahun" {{ old('experience_level', $jobListing->experience_level) == '5_10_tahun' ? 'selected' : '' }}>5-10 Tahun</option>
                    <option value="lebih_dari_10_tahun" {{ old('experience_level', $jobListing->experience_level) == 'lebih_dari_10_tahun' ? 'selected' : '' }}>Lebih dari 10 Tahun</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Tingkat Pendidikan (education_level)</label>
                <select name="education_level" class="form-select" required>
                    <option value="s3" {{ old('education_level', $jobListing->education_level) == 's3' ? 'selected' : '' }}>S3</option>
                    <option value="s2" {{ old('education_level', $jobListing->education_level) == 's2' ? 'selected' : '' }}>S2</option>
                    <option value="s1" {{ old('education_level', $jobListing->education_level) == 's1' ? 'selected' : '' }}>S1</option>
                    <option value="d1_d4" {{ old('education_level', $jobListing->education_level) == 'd1_d4' ? 'selected' : '' }}>D1-D4</option>
                    <option value="sma_smk" {{ old('education_level', $jobListing->education_level) == 'sma_smk' ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="smp" {{ old('education_level', $jobListing->education_level) == 'smp' ? 'selected' : '' }}>SMP</option>
                    <option value="sd" {{ old('education_level', $jobListing->education_level) == 'sd' ? 'selected' : '' }}>SD</option>
                </select>
            </div>

            {{-- Deskripsi/qualifications/skills/requirements --}}
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $jobListing->description) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Kualifikasi</label>
                <textarea name="qualifications" class="form-control" rows="2">{{ old('qualifications', $jobListing->qualifications) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Keterampilan (skills)</label>
                <textarea name="skills" class="form-control" rows="2">{{ old('skills', $jobListing->skills) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Persyaratan</label>
                <textarea name="requirements" class="form-control" rows="2">{{ old('requirements', $jobListing->requirements) }}</textarea>
            </div>

            {{-- Deadline & Publikasi --}}
            <div class="col-md-6">
                <label class="form-label">Batas Lamaran</label>
                <input type="date" name="deadline" value="{{ old('deadline', optional($jobListing->deadline)->format('Y-m-d')) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status Publikasi</label>
                <select name="is_public" class="form-select">
                    <option value="1" {{ old('is_public', $jobListing->is_public) ? 'selected' : '' }}>Publik</option>
                    <option value="0" {{ old('is_public', $jobListing->is_public) == 0 ? 'selected' : '' }}>Tidak Publik</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="col-12 text-end mt-3">
                <a href="{{ route('admin.job_listings.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

{{-- Script Dropdown Lokasi (prefill + set hidden input sebelum submit) --}}
<script>
    const lokasiData = @json($lokasi);
    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');
    const locationInput = document.getElementById('location');
    const formEl = document.getElementById('editForm');

    function unique(arr) {
        return [...new Set(arr)];
    }

    (function prefill() {
        const existing = locationInput.value || '';
        if (!existing) return;
        const parts = existing.split(' - ').map(s => s.trim());
        const [prov, kab, kec, desa] = parts;

        if (prov) provinsiEl.value = prov;
        provinsiEl.dispatchEvent(new Event('change'));

        setTimeout(() => {
            if (kab) kabupatenEl.value = kab;
            kabupatenEl.dispatchEvent(new Event('change'));
            setTimeout(() => {
                if (kec) kecamatanEl.value = kec;
                kecamatanEl.dispatchEvent(new Event('change'));
                setTimeout(() => {
                    if (desa) desaEl.value = desa;
                    updateLocation();
                }, 150);
            }, 150);
        }, 150);
    })();

    provinsiEl.addEventListener('change', function () {
        kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
        kabupatenEl.disabled = true;
        kecamatanEl.disabled = true;
        desaEl.disabled = true;

        if (this.value) {
            const list = lokasiData.filter(l => l.provinsi === this.value).map(l => l.kabupaten);
            unique(list).forEach(k => {
                kabupatenEl.innerHTML += `<option value="${k}">${k}</option>`;
            });
            kabupatenEl.disabled = false;
        }
        updateLocation();
    });

    kabupatenEl.addEventListener('change', function () {
        kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
        kecamatanEl.disabled = true;
        desaEl.disabled = true;

        if (this.value) {
            const list = lokasiData.filter(l => l.provinsi === provinsiEl.value && l.kabupaten === this.value).map(l => l.kecamatan);
            unique(list).forEach(k => {
                kecamatanEl.innerHTML += `<option value="${k}">${k}</option>`;
            });
            kecamatanEl.disabled = false;
        }
        updateLocation();
    });

    kecamatanEl.addEventListener('change', function () {
        desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
        desaEl.disabled = true;

        if (this.value) {
            const list = lokasiData.filter(l => l.provinsi === provinsiEl.value && l.kabupaten === kabupatenEl.value && l.kecamatan === this.value).map(l => l.desa);
            unique(list).forEach(d => {
                desaEl.innerHTML += `<option value="${d}">${d}</option>`;
            });
            desaEl.disabled = false;
        }
        updateLocation();
    });

    desaEl.addEventListener('change', updateLocation);

    function updateLocation() {
        const full = [provinsiEl.value, kabupatenEl.value, kecamatanEl.value, desaEl.value].filter(Boolean).join(' - ');
        locationInput.value = full;
    }

    formEl.addEventListener('submit', function (e) {
        updateLocation();
        if (!locationInput.value) {
            e.preventDefault();
            alert('Silakan pilih lokasi lengkap (Provinsi, Kabupaten, Kecamatan, Desa) sebelum menyimpan.');
            provinsiEl.focus();
            return false;
        }
    });
</script>
@endsection
