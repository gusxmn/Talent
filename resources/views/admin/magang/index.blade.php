@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-secondary fw-bold">Daftar Lowongan Magang</h1>

    {{-- Toast Notifikasi Sukses --}}
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 70px;">
        <div id="liveToast"
             class="toast align-items-center text-white bg-success border-0 shadow-lg"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    {{-- Pastikan Font Awesome (fa-check-circle) sudah dimuat --}}
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    {{ session('success') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    {{-- Script Toast --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('liveToast');
            if (toastEl && typeof bootstrap !== 'undefined') {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 4000,
                    animation: true
                });
                toast.show();
            }
        });
    </script>

    {{-- KONTROL BARU: Pencarian Sederhana, Tampil, dan Tambah --}}
    <form method="GET" action="{{ route('admin.magang.index') }}" class="row g-3 mb-4 align-items-end">
        
        {{-- Input Pencarian --}}
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control"
                       placeholder="Cari Berdasarkan semua kategori"
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> {{-- Icon Cari --}}
                </button>
            </div>
        </div>

        {{-- Dropdown Tampil Per Halaman --}}
        <div class="col-md-2 ms-auto">
            <label for="per_page" class="form-label visually-hidden">Tampil</label>
            <div class="input-group">
                <select name="per_page" id="per_page" class="form-select" onchange="this.form.submit()">
                    {{-- Menggunakan variabel $magang dari kode awal --}}
                    <option value="5" {{ request('per_page', $magang->perPage()) == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page', $magang->perPage()) == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page', $magang->perPage()) == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page', $magang->perPage()) == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
        </div>

        {{-- Tombol Tambah --}}
        <div class="col-md-2">
            <a href="{{ route('admin.magang.create') }}" class="btn btn-dark w-100">Tambah</a>
        </div>
        
    </form>
    {{-- END KONTROL BARU --}}

    {{-- Tabel Lowongan --}}
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover bg-white"> 
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 8%;">Logo</th>
                    <th style="width: 20%;">Judul</th>
                    <th style="width: 20%;">Perusahaan</th>
                    <th style="width: 15%;">Kabupaten</th>
                    <th style="width: 8%;">Durasi</th>
                    <th style="width: 8%;">Status</th>
                    <th class="text-center" style="width: 10%;">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($magang as $item)
                    {{-- Memastikan rata tengah vertikal --}}
                    <tr class="align-middle"> 
                        <td class="text-center">{{ $loop->iteration + ($magang->currentPage() - 1) * $magang->perPage() }}</td>
                        <td class="text-center">
                            @if($item->logo_perusahaan)
                                <img src="{{ asset('storage/' . $item->logo_perusahaan) }}" 
                                     class="rounded-circle border" 
                                     alt="Logo" 
                                     style="width:50px; height:50px; object-fit:cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->perusahaan }}</td>
                        <td>
                            @if($item->regency)
                                {{ $item->regency->name }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->durasi }}</td>
                        <td class="text-center">
                            @if($item->status)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        
                        {{-- **Tindakan (Aksi) Rapi dan Horizontal** --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.magang.edit', $item->id) }}" title="Edit"
                                   class="btn btn-warning btn-sm" style="color: white;">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"
                                        title="Hapus"
                                        class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                            <p>Yakin ingin menghapus lowongan <strong>{{ $item->judul }}</strong> dari <strong>{{ $item->perusahaan }}</strong>?</p>
                                            <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.magang.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger px-4">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-3">Tidak ada data magang</td>
                    </tr>
                @endforelse
            </tbody>
            
            {{-- FOOTER TABEL untuk Pagination --}}
            @if($magang->hasPages() || $magang->total() > 0)
            <tfoot class="table-light">
                <tr>
                    <td colspan="8" class="p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- Info jumlah data --}}
                            <div class="text-muted small">
                                Menampilkan <strong>{{ $magang->firstItem() ?? 0 }}</strong> - 
                                <strong>{{ $magang->lastItem() ?? 0 }}</strong> dari 
                                <strong>{{ $magang->total() }}</strong> data
                            </div>
                            
                            {{-- Pagination --}}
                            <div>
                                {{ $magang->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

{{-- Style tambahan untuk hover ikon --}}
<style>
    /* Mengembalikan warna tombol ke Bootstrap default, dan hanya menambahkan sedikit hover effect */
    .btn-warning {
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
    }
    .btn-warning:hover {
        background-color: #e0a800 !important;
        border-color: #d39e00 !important;
    }
    .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    .btn-danger:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
    }
    .table tfoot {
        border-top: 2px solid #dee2e6;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection