@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-secondary">Edit Lowongan Magang</h2>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('admin.magang.update', $magang->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Judul Magang</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $magang->judul) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Perusahaan</label>
                <input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan', $magang->perusahaan) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Posisi</label>
                <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $magang->posisi) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Durasi</label>
                <input type="text" name="durasi" class="form-control" placeholder="Contoh: 6 Bulan" value="{{ old('durasi', $magang->durasi) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Kuota</label>
                <input type="number" name="kuota" class="form-control" min="1" value="{{ old('kuota', $magang->kuota) }}" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $magang->tanggal_mulai?->format('Y-m-d')) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $magang->tanggal_selesai?->format('Y-m-d')) }}">
            </div>

            {{-- Logo Perusahaan --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Logo Perusahaan</label>
                <input type="file" name="logo_perusahaan" class="form-control">
                @if($magang->logo_perusahaan)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $magang->logo_perusahaan) }}" alt="Logo" width="80" class="rounded border">
                    </div>
                @endif
            </div>

            {{-- Lokasi Dinamis --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Provinsi</label>
                <select name="provinsi_id" id="provinsi" class="form-select">
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $prov)
                        <option value="{{ $prov->id }}" {{ $magang->provinsi_id == $prov->id ? 'selected' : '' }}>{{ $prov->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kabupaten</label>
                <select name="kabupaten_id" id="kabupaten" class="form-select">
                    <option value="">Pilih Kabupaten</option>
                    @foreach($regencies as $kab)
                        <option value="{{ $kab->id }}" {{ $magang->kabupaten_id == $kab->id ? 'selected' : '' }}>{{ $kab->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan" class="form-select">
                    <option value="">Pilih Kecamatan</option>
                    @foreach($districts as $kec)
                        <option value="{{ $kec->id }}" {{ $magang->kecamatan_id == $kec->id ? 'selected' : '' }}>{{ $kec->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Desa</label>
                <select name="desa_id" id="desa" class="form-select">
                    <option value="">Pilih Desa</option>
                    @foreach($villages as $des)
                        <option value="{{ $des->id }}" {{ $magang->desa_id == $des->id ? 'selected' : '' }}>{{ $des->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi', $magang->deskripsi) }}</textarea>
            </div>

            {{-- Status Aktif / Nonaktif --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="1" {{ $magang->status ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$magang->status ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('admin.magang.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

{{-- Script AJAX untuk dropdown lokasi --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsi = document.getElementById('provinsi');
    const kabupaten = document.getElementById('kabupaten');
    const kecamatan = document.getElementById('kecamatan');
    const desa = document.getElementById('desa');

    provinsi.addEventListener('change', function () {
        kabupaten.innerHTML = '<option value="">Memuat...</option>';
        fetch(`/admin/get-regencies/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kabupaten.innerHTML = '<option value="">Pilih Kabupaten</option>';
                data.forEach(item => kabupaten.innerHTML += `<option value="${item.id}">${item.name}</option>`);
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                desa.innerHTML = '<option value="">Pilih Desa</option>';
            });
    });

    kabupaten.addEventListener('change', function () {
        kecamatan.innerHTML = '<option value="">Memuat...</option>';
        fetch(`/admin/get-districts/${this.value}`)
            .then(res => res.json())
            .then(data => {
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                data.forEach(item => kecamatan.innerHTML += `<option value="${item.id}">${item.name}</option>`);
                desa.innerHTML = '<option value="">Pilih Desa</option>';
            });
    });

    kecamatan.addEventListener('change', function () {
        desa.innerHTML = '<option value="">Memuat...</option>';
        fetch(`/admin/get-villages/${this.value}`)
            .then(res => res.json())
            .then(data => {
                desa.innerHTML = '<option value="">Pilih Desa</option>';
                data.forEach(item => desa.innerHTML += `<option value="${item.id}">${item.name}</option>`);
            });
    });
});
</script>
@endsection
