@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Lowongan Baru</h1>

    {{-- Notifikasi error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.job_listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="mb-3">
            <label class="form-label">Judul Lowongan</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        {{-- Perusahaan --}}
        <div class="mb-3">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="company" class="form-control" value="{{ old('company') }}" required>
        </div>

        {{-- Logo --}}
        <div class="mb-3">
            <label class="form-label">Logo Perusahaan</label>
            <input type="file" name="company_logo" class="form-control" accept="image/*">
        </div>

        {{-- Lokasi --}}
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <div class="row g-2">
                <div class="col-md-3">
                    <select id="provinsi" class="form-select" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($lokasi->unique('provinsi') as $l)
                            <option value="{{ $l->provinsi }}">{{ $l->provinsi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="kabupaten" class="form-select" disabled required>
                        <option value="">-- Pilih Kabupaten --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="kecamatan" class="form-select" disabled required>
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="desa" class="form-select" disabled required>
                        <option value="">-- Pilih Desa --</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="location" id="location" value="{{ old('location') }}">
        </div>

        {{-- Gaji --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Gaji Minimum</label>
                <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Gaji Maksimum</label>
                <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max') }}">
            </div>
        </div>

        {{-- Jenis Pekerjaan --}}
        <div class="mb-3">
            <label class="form-label">Jenis Pekerjaan</label>
            <select name="job_type" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="penuh_waktu" {{ old('job_type') == 'penuh_waktu' ? 'selected' : '' }}>Penuh Waktu</option>
                <option value="paruh_waktu" {{ old('job_type') == 'paruh_waktu' ? 'selected' : '' }}>Paruh Waktu</option>
                <option value="kontrak" {{ old('job_type') == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                <option value="magang" {{ old('job_type') == 'magang' ? 'selected' : '' }}>Magang</option>
                <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                <option value="harian" {{ old('job_type') == 'harian' ? 'selected' : '' }}>Harian</option>
            </select>
        </div>

        {{-- Kebijakan Kerja --}}
        <div class="mb-3">
            <label class="form-label">Kebijakan Kerja</label>
            <select name="work_policy" class="form-select" required>
                <option value="">-- Pilih Kebijakan --</option>
                <option value="kerja_di_kantor" {{ old('work_policy') == 'kerja_di_kantor' ? 'selected' : '' }}>Kerja di Kantor</option>
                <option value="hybrid" {{ old('work_policy') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                <option value="remote" {{ old('work_policy') == 'remote' ? 'selected' : '' }}>Remote</option>
            </select>
        </div>

        {{-- Level Pengalaman --}}
        <div class="mb-3">
            <label class="form-label">Level Pengalaman</label>
            <select name="experience_level" class="form-select" required>
                <option value="">-- Pilih Level --</option>
                <option value="tidak_berpengalaman" {{ old('experience_level') == 'tidak_berpengalaman' ? 'selected' : '' }}>Tidak Berpengalaman</option>
                <option value="fresh_graduate" {{ old('experience_level') == 'fresh_graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                <option value="kurang_dari_setahun" {{ old('experience_level') == 'kurang_dari_setahun' ? 'selected' : '' }}>Kurang dari Setahun</option>
                <option value="1_3_tahun" {{ old('experience_level') == '1_3_tahun' ? 'selected' : '' }}>1–3 Tahun</option>
                <option value="3_5_tahun" {{ old('experience_level') == '3_5_tahun' ? 'selected' : '' }}>3–5 Tahun</option>
                <option value="5_10_tahun" {{ old('experience_level') == '5_10_tahun' ? 'selected' : '' }}>5–10 Tahun</option>
                <option value="lebih_dari_10_tahun" {{ old('experience_level') == 'lebih_dari_10_tahun' ? 'selected' : '' }}>Lebih dari 10 Tahun</option>
            </select>
        </div>

        {{-- Pendidikan Minimal --}}
        <div class="mb-3">
            <label class="form-label">Pendidikan Minimal</label>
            <select name="education_level" class="form-select" required>
                <option value="">-- Pilih Pendidikan --</option>
                <option value="s3" {{ old('education_level') == 's3' ? 'selected' : '' }}>S3</option>
                <option value="s2" {{ old('education_level') == 's2' ? 'selected' : '' }}>S2</option>
                <option value="s1" {{ old('education_level') == 's1' ? 'selected' : '' }}>S1</option>
                <option value="d1_d4" {{ old('education_level') == 'd1_d4' ? 'selected' : '' }}>D1–D4</option>
                <option value="sma_smk" {{ old('education_level') == 'sma_smk' ? 'selected' : '' }}>SMA/SMK</option>
                <option value="smp" {{ old('education_level') == 'smp' ? 'selected' : '' }}>SMP</option>
                <option value="sd" {{ old('education_level') == 'sd' ? 'selected' : '' }}>SD</option>
            </select>
        </div>

        {{-- Persyaratan --}}
        <div class="mb-3">
            <label class="form-label">Persyaratan</label>
            <textarea name="requirements" class="form-control" rows="3">{{ old('requirements') }}</textarea>
        </div>

        {{-- Keahlian --}}
        <div class="mb-3">
            <label class="form-label">Keahlian yang Dibutuhkan</label>
            <textarea name="skills" class="form-control" rows="3">{{ old('skills') }}</textarea>
        </div>

        {{-- Kualifikasi --}}
        <div class="mb-3">
            <label class="form-label">Kualifikasi Tambahan</label>
            <textarea name="qualifications" class="form-control" rows="3">{{ old('qualifications') }}</textarea>
        </div>

        {{-- Deadline --}}
        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
        </div>

        {{-- Publik --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_public" value="1" {{ old('is_public') ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke Publik</label>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi Pekerjaan</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.job_listings.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Lowongan</button>
        </div>
    </form>
</div>

{{-- Script Dropdown Lokasi --}}
<script>
    const lokasiData = @json($lokasi);

    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');
    const locationInput = document.getElementById('location');

    provinsiEl.addEventListener('change', function () {
        kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
        kabupatenEl.disabled = true;
        kecamatanEl.disabled = true;
        desaEl.disabled = true;

        if (this.value) {
            const kabupatenList = lokasiData.filter(l => l.provinsi === this.value).map(l => l.kabupaten);
            [...new Set(kabupatenList)].forEach(kab => {
                kabupatenEl.innerHTML += `<option value="${kab}">${kab}</option>`;
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
            const kecamatanList = lokasiData.filter(l => l.provinsi === provinsiEl.value && l.kabupaten === this.value).map(l => l.kecamatan);
            [...new Set(kecamatanList)].forEach(kec => {
                kecamatanEl.innerHTML += `<option value="${kec}">${kec}</option>`;
            });
            kecamatanEl.disabled = false;
        }
        updateLocation();
    });

    kecamatanEl.addEventListener('change', function () {
        desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
        desaEl.disabled = true;

        if (this.value) {
            const desaList = lokasiData.filter(l =>
                l.provinsi === provinsiEl.value &&
                l.kabupaten === kabupatenEl.value &&
                l.kecamatan === this.value
            ).map(l => l.desa);

            [...new Set(desaList)].forEach(ds => {
                desaEl.innerHTML += `<option value="${ds}">${ds}</option>`;
            });
            desaEl.disabled = false;
        }
        updateLocation();
    });

    desaEl.addEventListener('change', updateLocation);

    function updateLocation() {
        const prov = provinsiEl.value;
        const kab = kabupatenEl.value;
        const kec = kecamatanEl.value;
        const desa = desaEl.value;
        let fullLocation = [prov, kab, kec, desa].filter(Boolean).join(' - ');
        locationInput.value = fullLocation;
    }
</script>
@endsection
