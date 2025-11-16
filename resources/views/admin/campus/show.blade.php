@extends('admin.layout')

<style>
/* === Penyeragaman ukuran logo kampus di halaman SHOW === */
.logo-container {
    width: 180px; /* sama dengan company */
    height: 180px; /* sama dengan company */
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
}

.logo-container img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* ✅ menjaga proporsi logo */
}
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri - Data Kampus -->
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Data Kampus/Sekolah</h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Kampus/Sekolah</label>
                                <p>{{ $campus->nama_kampus }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Institusi</label>
                                <p>{{ $campus->jenis_institusi }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah Pegawai</label>
                                <p>{{ $campus->jumlah_pegawai }}</p>
                            </div>

                            <!-- Tanggal Bergabung -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Bergabung</label>
                                <p>{{ $campus->created_at->format('d F Y') }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Logo Kampus/Sekolah</label>
                                <div class="logo-container">
                                    @if ($campus->logo_path)
                                        <img src="{{ asset('storage/' . $campus->logo_path) }}" 
                                             alt="{{ $campus->nama_kampus }}">
                                    @else
                                        <div class="text-muted text-center">
                                            <i class="fas fa-school fa-2x"></i>
                                            <br>
                                            <small>Tidak ada logo</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Data Pendaftar & Lokasi -->
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Data Pendaftar</h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <p>{{ $campus->nama_lengkap }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jabatan</label>
                                <p>{{ $campus->jabatan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p>{{ $campus->email }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">No. HP</label>
                                <p>{{ $campus->no_hp }}</p>
                            </div>

                            <h5 class="border-bottom pb-2 mb-3 mt-4">Lokasi Kampus/Sekolah</h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Provinsi</label>
                                <p>{{ $campus->provinsi }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kota</label>
                                <p>{{ $campus->kota }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kecamatan</label>
                                <p>{{ $campus->kecamatan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Desa/Kelurahan</label>
                                <p>{{ $campus->desa_kelurahan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Lengkap</label>
                                <p>{{ $campus->alamat_lengkap }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.campus.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection