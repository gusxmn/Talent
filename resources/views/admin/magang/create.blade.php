@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-secondary">Tambah Lowongan Magang</h2>

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

    {{-- Form Tambah --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.magang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Judul Magang</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Perusahaan</label>
                        <input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Posisi</label>
                        <input type="text" name="posisi" class="form-control" value="{{ old('posisi') }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Durasi</label>
                        <input type="text" name="durasi" class="form-control" value="{{ old('durasi') }}" placeholder="3 Bulan" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Kuota</label>
                        <input type="number" name="kuota" class="form-control" value="{{ old('kuota') }}" min="1" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" rows="5" class="form-control" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- Lokasi Dinamis --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Provinsi</label>
                        <select name="provinsi_id" id="provinsi" class="form-select">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Kabupaten</label>
                        <select name="kabupaten_id" id="kabupaten" class="form-select">
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Kecamatan</label>
                        <select name="kecamatan_id" id="kecamatan" class="form-select">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Desa</label>
                        <select name="desa_id" id="desa" class="form-select">
                            <option value="">-- Pilih Desa --</option>
                        </select>
                    </div>

                    {{-- Upload Logo --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Logo Perusahaan</label>
                        <input type="file" name="logo_perusahaan" class="form-control" accept="image/*">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Script AJAX Lokasi Dinamis --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinsi = document.getElementById('provinsi');
    const kabupaten = document.getElementById('kabupaten');
    const kecamatan = document.getElementById('kecamatan');
    const desa = document.getElementById('desa');

    provinsi.addEventListener('change', function() {
        fetch(`/admin/api/magang/regencies/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kabupaten.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                data.forEach(item => {
                    kabupaten.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
                kecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                desa.innerHTML = '<option value="">-- Pilih Desa --</option>';
            });
    });

    kabupaten.addEventListener('change', function() {
        fetch(`/admin/api/magang/districts/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                data.forEach(item => {
                    kecamatan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
                desa.innerHTML = '<option value="">-- Pilih Desa --</option>';
            });
    });

    kecamatan.addEventListener('change', function() {
        fetch(`/admin/api/magang/villages/${this.value}`)
            .then(res => res.json())
            .then(data => {
                desa.innerHTML = '<option value="">-- Pilih Desa --</option>';
                data.forEach(item => {
                    desa.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
            });
    });
});
</script>
@endsection
