@extends('admin.layout')

@section('content')

{{-- 1. Area Judul Form (Area Hijau) --}}
<div class="judul-form-area text-white p-3" style="background-color: #28a745;">
    <h4 class="mb-0 fw-bold">Tambah Lowongan Magang</h4>
</div>
{{-- Akhir Area Judul Form --}}

{{-- 2. Area Form Isian (Area Abu-abu Muda) --}}
<div class="form-isian-area p-4" style="background-color: #e9ecef;">

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Bungkus semua field form dalam div abu-abu gelap --}}
    <div class="p-4 rounded shadow-sm" style="background-color: #cccccc;">
        <form action="{{ route('admin.magang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- Judul dan Perusahaan --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul Magang</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Perusahaan</label>
                    <input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan') }}" required>
                </div>

                {{-- Posisi dan Durasi --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Posisi</label>
                    <input type="text" name="posisi" class="form-control" value="{{ old('posisi') }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Durasi</label>
                    <input type="text" name="durasi" class="form-control" placeholder="Contoh: 6 Bulan" value="{{ old('durasi') }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Kuota</label>
                    <input type="number" name="kuota" class="form-control" min="1" value="{{ old('kuota') }}" required>
                </div>

                {{-- Tanggal Mulai dan Selesai --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                </div>
            </div>

            {{-- Logo Perusahaan --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Logo Perusahaan</label>
                    <input type="file" name="logo_perusahaan" class="form-control" accept="image/*">
                </div>
                
                {{-- Status --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" selected>Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            {{-- Lokasi (Dropdown Bertingkat) --}}
            <div class="mb-3 p-3 border rounded" style="background-color: #e0e0e0;">
                <label class="form-label fw-bold">Lokasi Magang <span class="text-danger">*</span></label>
                
                {{-- Display selected location --}}
                <div class="alert alert-info py-2 mb-3" id="location-display" style="display: none;">
                    <small class="fw-bold">Lokasi terpilih:</small>
                    <span id="location-text">-</span>
                </div>

                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="form-label small">Provinsi</label>
                        <select id="provinsi" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text small">Pilih provinsi terlebih dahulu</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Kabupaten/Kota</label>
                        <select id="kabupaten" class="form-select form-select-sm" disabled required>
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                        <div class="form-text small">Pilih kabupaten/kota</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Kecamatan</label>
                        <select id="kecamatan" class="form-select form-select-sm" disabled required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                        <div class="form-text small">Pilih kecamatan</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Desa/Kelurahan</label>
                        <select id="desa" class="form-select form-select-sm" disabled>
                            <option value="">-- Pilih Desa --</option>
                        </select>
                        <div class="form-text small">Pilih desa/kelurahan (opsional)</div>
                    </div>
                </div>
                
                {{-- Loading indicator --}}
                <div id="loading-indicator" class="mt-2" style="display: none;">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <small class="text-muted ms-2">Memuat data...</small>
                </div>

                {{-- Hidden fields untuk menyimpan ID wilayah --}}
                <input type="hidden" name="provinsi_id" id="province_id" value="{{ old('provinsi_id') }}">
                <input type="hidden" name="kabupaten_id" id="regency_id" value="{{ old('kabupaten_id') }}">
                <input type="hidden" name="kecamatan_id" id="district_id" value="{{ old('kecamatan_id') }}">
                <input type="hidden" name="desa_id" id="village_id" value="{{ old('desa_id') }}">
                <input type="hidden" name="location" id="location" value="{{ old('location') }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="5" class="form-control" required>{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Tombol Simpan dan Batal (Area tombol abu-abu tua berbentuk oval) --}}
            <div class="d-flex justify-content-end pt-3">
                <a href="{{ route('admin.magang.index') }}" class="btn text-white me-3" style="background-color: #343a40; border-radius: 20px; min-width: 100px;">
                    Batal
                </a>
                <button type="submit" class="btn text-white" style="background-color: #08417a; border-radius: 20px; min-width: 100px;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
{{-- Akhir Area Form Isian --}}

{{-- Script Dropdown Lokasi dengan AJAX --}}
<script>
    const provinsiEl = document.getElementById('provinsi');
    const kabupatenEl = document.getElementById('kabupaten');
    const kecamatanEl = document.getElementById('kecamatan');
    const desaEl = document.getElementById('desa');
    const provinceIdInput = document.getElementById('province_id');
    const regencyIdInput = document.getElementById('regency_id');
    const districtIdInput = document.getElementById('district_id');
    const villageIdInput = document.getElementById('village_id');
    const locationInput = document.getElementById('location');
    const locationDisplay = document.getElementById('location-display');
    const locationText = document.getElementById('location-text');
    const loadingIndicator = document.getElementById('loading-indicator');

    // Reset dropdown dependen
    function resetDependentDropdowns(level) {
        if (level === 'provinsi') {
            kabupatenEl.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
            kabupatenEl.disabled = true;
            kecamatanEl.disabled = true;
            desaEl.disabled = true;
            
            regencyIdInput.value = '';
            districtIdInput.value = '';
            villageIdInput.value = '';
        } else if (level === 'kabupaten') {
            kecamatanEl.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
            kecamatanEl.disabled = true;
            desaEl.disabled = true;
            
            districtIdInput.value = '';
            villageIdInput.value = '';
        } else if (level === 'kecamatan') {
            desaEl.innerHTML = '<option value="">-- Pilih Desa --</option>';
            desaEl.disabled = true;
            villageIdInput.value = '';
        }
    }

    // Tampilkan loading
    function showLoading() {
        loadingIndicator.style.display = 'block';
    }

    // Sembunyikan loading
    function hideLoading() {
        loadingIndicator.style.display = 'none';
    }

    // Load data via AJAX
    async function loadWilayah(url, targetElement, level) {
        showLoading();
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            
            targetElement.innerHTML = `<option value="">-- Pilih ${level} --</option>`;
            data.forEach(item => {
                targetElement.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
            targetElement.disabled = false;
        } catch (error) {
            console.error('Error loading wilayah:', error);
            targetElement.innerHTML = `<option value="">-- Error loading data --</option>`;
        } finally {
            hideLoading();
        }
    }

    // Update lokasi yang dipilih
    function updateLocationDisplay() {
        const provName = provinsiEl.options[provinsiEl.selectedIndex]?.text || '';
        const kabName = kabupatenEl.options[kabupatenEl.selectedIndex]?.text || '';
        const kecName = kecamatanEl.options[kecamatanEl.selectedIndex]?.text || '';
        const desaName = desaEl.options[desaEl.selectedIndex]?.text || '';
        
        const selectedParts = [];
        if (desaName && desaName !== '-- Pilih Desa --') selectedParts.unshift(desaName);
        if (kecName && kecName !== '-- Pilih Kecamatan --') selectedParts.unshift(kecName);
        if (kabName && kabName !== '-- Pilih Kabupaten --') selectedParts.unshift(kabName);
        if (provName && provName !== '-- Pilih Provinsi --') selectedParts.unshift(provName);
        
        if (selectedParts.length > 0) {
            const fullLocation = selectedParts.join(', ');
            locationText.textContent = fullLocation;
            locationInput.value = fullLocation;
            locationDisplay.style.display = 'block';
        } else {
            locationDisplay.style.display = 'none';
            locationInput.value = '';
        }
    }

    // Event listeners
    provinsiEl.addEventListener('change', function () {
        const provinceId = this.value;
        provinceIdInput.value = provinceId;
        resetDependentDropdowns('provinsi');
        
        if (provinceId) {
            loadWilayah(`/admin/api/magang/regencies/${provinceId}`, kabupatenEl, 'Kabupaten/Kota');
        }
        updateLocationDisplay();
    });

    kabupatenEl.addEventListener('change', function () {
        const regencyId = this.value;
        regencyIdInput.value = regencyId;
        resetDependentDropdowns('kabupaten');
        
        if (regencyId) {
            loadWilayah(`/admin/api/magang/districts/${regencyId}`, kecamatanEl, 'Kecamatan');
        }
        updateLocationDisplay();
    });

    kecamatanEl.addEventListener('change', function () {
        const districtId = this.value;
        districtIdInput.value = districtId;
        resetDependentDropdowns('kecamatan');
        
        if (districtId) {
            loadWilayah(`/admin/api/magang/villages/${districtId}`, desaEl, 'Desa/Kelurahan');
        }
        updateLocationDisplay();
    });

    desaEl.addEventListener('change', function () {
        const villageId = this.value;
        villageIdInput.value = villageId;
        updateLocationDisplay();
    });

    // Initialize form
    document.addEventListener('DOMContentLoaded', function() {
        // Update tampilan lokasi jika ada data old
        updateLocationDisplay();
    });
</script>

<style>
    /* Styling kustom untuk form */
    .form-label {
        font-weight: 600; /* Sedikit lebih tebal */
    }
    .form-text {
        font-size: 0.75rem; /* Teks bantuan lebih kecil */
    }
    
    #location-display {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
    }
</style>
@endsection