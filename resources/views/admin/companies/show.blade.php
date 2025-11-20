@extends('admin.layout')

<style>
/* === Penyeragaman ukuran logo perusahaan di halaman SHOW === */
.logo-container {
    width: 180px; /* sebelumnya 150px */
    height: 180px; /* sebelumnya 150px */
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
                        <!-- Kolom Kiri - Data Perusahaan -->
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Data Perusahaan</h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Perusahaan</label>
                                <p>{{ $company->nama_perusahaan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Industri</label>
                                <p>{{ $company->industri }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah Karyawan</label>
                                <p>{{ $company->jumlah_karyawan }}</p>
                            </div>

                            <!-- 🔽 Tambahkan Tanggal Bergabung di bawah Jumlah Karyawan -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Bergabung</label>
                                <p>{{ $company->created_at->format('d F Y') }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Logo Perusahaan</label>
                                <div class="logo-container">
                                    @if ($company->logo)
                                        <img src="{{ Storage::url($company->logo) }}" 
                                             alt="{{ $company->nama_perusahaan }}">
                                    @else
                                        <div class="text-muted text-center">
                                            <i class="fas fa-building fa-2x"></i>
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
                                <p>{{ $company->nama_lengkap }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jabatan</label>
                                <p>{{ $company->jabatan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p>{{ $company->email }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">No. HP</label>
                                <p>{{ $company->no_hp }}</p>
                            </div>

                            <h5 class="border-bottom pb-2 mb-3 mt-4">Lokasi Perusahaan</h5>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Provinsi</label>
                                <p>{{ $company->provinsi }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kota</label>
                                <p>{{ $company->kota }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Kecamatan</label>
                                <p>{{ $company->kecamatan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Desa/Kelurahan</label>
                                <p>{{ $company->desa_kelurahan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Lengkap</label>
                                <p>{{ $company->alamat_lengkap }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- 🔻 Hapus bagian Status Akun & Judul Status -->
                    <!-- (bagian ini dihapus sepenuhnya sesuai permintaan) -->

                    <!-- Tombol Aksi -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">
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