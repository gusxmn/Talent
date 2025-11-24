@extends('admin.layout')

@section('title', 'Manajemen Desa/Kelurahan')
@section('content')

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
    
    :root {
        --header-color: #1e3a8a;
        --table-bg: #ffffff;
        --table-text: #212529;
        --table-border: #dee2e6;
        --table-hover: #f8f9fa;
        --border-color: #dee2e6;
    }

    .main-title {
        color: var(--table-text);
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 5px;
        padding-top: 8px;
    }

    .page-title {
        color: var(--table-text);
        font-weight: 500;
        font-size: 1rem;
        margin-bottom: 0;
        opacity: 0.8;
    }

    .header-section {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .header-icon {
        font-size: 2rem;
        color: var(--header-color);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background: rgba(30, 58, 138, 0.1);
        border-radius: 8px;
    }

    .form-control, .form-select {
        background-color: #ffffff;
        border: 1px solid #ced4da;
        color: #212529;
        font-size: 13px;
        padding: 8px 12px;
    }

    .btn-search, .btn-tambah {
        background-color: var(--header-color);
        border-color: var(--header-color);
        color: white;
        font-size: 13px;
        padding: 8px 12px;
    }

    .btn-search:hover, .btn-tambah:hover {
        background-color: #1530aa;
        border-color: #1530aa;
    }

    .table-container {
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table-wrapper {
        background: white;
        border: 1px solid var(--table-border);
    }

    .table {
        margin: 0;
        font-size: 13px;
    }

    .table thead {
        background-color: var(--header-color);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table thead th {
        color: white;
        padding: 12px 10px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        border: none;
        vertical-align: middle;
    }

    .table tbody td {
        padding: 10px;
        vertical-align: middle;
        border-color: var(--table-border);
        font-size: 13px;
    }

    .table tbody tr:hover {
        background-color: var(--table-hover);
    }

    .col-no { width: 50px; }
    .col-kode { width: 100px; }
    .col-kecamatan { width: 180px; }
    .col-nama { width: auto; }
    .col-jenis { width: 100px; }
    .col-status { width: 90px; }
    .col-actions { width: 90px; }

    .badge {
        font-size: 11px;
        padding: 5px 8px;
    }

    .btn-sm {
        padding: 5px 8px;
        font-size: 12px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
    }

    .btn-warning {
        background-color: #fbbf24;
        border-color: #fbbf24;
        color: #000;
    }

    .btn-warning:hover {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }

    .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .footer-section {
        background-color: var(--header-color);
        color: white;
        padding: 12px 15px;
        border-top: 1px solid var(--table-border);
    }

    .footer-info {
        font-size: 12px;
    }

    .pagination-filter {
        width: 80px;
    }

    .pagination-filter .form-select {
        font-size: 11px;
        padding: 5px 8px;
        color: #212529;
        background-color: white;
    }

    .pagination {
        margin: 0;
        gap: 3px;
    }

    .pagination .page-link {
        padding: 4px 8px;
        font-size: 11px;
        color: #1e3a8a;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #1e3a8a;
        border-color: #1e3a8a;
    }

    .toast-container-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 350px;
    }

    .toast-success-custom {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(40, 167, 69, 0.3);
        padding: 16px;
        color: white;
    }

    .modal {
        z-index: 10000;
    }

    .modal-backdrop {
        z-index: 9999;
    }

    .divider {
        border: none;
        border-top: 1px solid var(--border-color);
        margin: 15px 0;
    }

    @media (max-width: 768px) {
        .col-kecamatan { width: 120px; }
        .col-nama { width: auto; }
        .table { font-size: 12px; }
    }
</style>

<div class="container-fluid py-4 px-4">
    {{-- HEADER SECTION --}}
    <div class="header-section">
        <div class="header-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="flex-grow-1">
            <h1 class="main-title">Manajemen Desa/Kelurahan</h1>
            <h2 class="page-title">Total Data: {{ $desas->total() }} Desa</h2>
        </div>
    </div>
    
    {{-- TOAST NOTIFICATION --}}
    @if(session('success'))
    <div class="toast-container-custom">
        <div class="toast toast-success-custom show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="font-size: 20px;"></i>
                <div>
                    <strong>Berhasil!</strong><br>
                    <small>{{ session('success') }}</small>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- FILTER & SEARCH FORM --}}
    <form method="GET" action="{{ route('admin.reference.desa.index') }}" id="filterForm" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama desa, kode..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <div class="col-md-4">
                <select name="kecamatan_id" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="">-- Semua Kecamatan --</option>
                    @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-3">
                <a href="{{ route('admin.reference.desa.create') }}" class="btn btn-tambah w-100">
                    <i class="fas fa-plus me-1"></i>Tambah Desa
                </a>
            </div>
        </div>
        <input type="hidden" name="per_page" id="per_page" value="{{ request('per_page', 10) }}">
    </form>

    <hr class="divider">

    {{-- TABLE --}}
    <div class="table-container">
        <div class="table-wrapper table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-kode">KODE</th>
                        <th class="col-kecamatan">KECAMATAN</th>
                        <th class="col-nama">NAMA DESA</th>
                        <th class="col-jenis">JENIS</th>
                        <th class="col-status">STATUS</th>
                        <th class="col-actions text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($desas as $index => $desa)
                        <tr>
                            <td class="col-no">{{ $desas->firstItem() + $index }}</td>
                            <td class="col-kode">{{ $desa->kode_desa }}</td>
                            <td class="col-kecamatan" title="{{ $desa->kecamatan->nama_kecamatan ?? 'N/A' }}">
                                {{ Str::limit($desa->kecamatan->nama_kecamatan ?? 'N/A', 20) }}
                            </td>
                            <td class="col-nama" title="{{ $desa->nama_desa }}">
                                {{ $desa->nama_desa }}
                            </td>
                            <td class="col-jenis">
                                <span class="badge bg-info">{{ $desa->jenis ?? 'Desa' }}</span>
                            </td>
                            <td class="col-status">
                                <span class="badge {{ $desa->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $desa->status ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="col-actions text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.reference.desa.edit', $desa->id) }}" 
                                       class="btn btn-warning btn-action" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-action btn-delete"
                                            data-delete-url="{{ route('admin.reference.desa.destroy', $desa->id) }}"
                                            data-item-name="{{ $desa->nama_desa }}"
                                            data-item-id="{{ $desa->id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox mb-2" style="font-size: 2rem; opacity: 0.5;"></i><br>
                                Tidak ada data desa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FOOTER --}}
        @if($desas->count() > 0)
        <div class="footer-section d-flex justify-content-between align-items-center">
            <div class="footer-info">
                Menampilkan <strong>{{ $desas->count() }}</strong> dari <strong>{{ $desas->total() }}</strong> data
            </div>
            <div class="d-flex gap-2 align-items-center">
                <select name="per_page_footer" class="form-select pagination-filter" onchange="changePage(this.value)">
                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                    <option value="500" {{ request('per_page', 10) == 500 ? 'selected' : '' }}>500</option>
                </select>
                @if($desas->hasPages())
                <nav>
                    {{ $desas->appends(request()->query())->links('vendor.pagination.custom') }}
                </nav>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                </h5>
            </div>
            <div class="modal-body p-4">
                <p class="mb-3">Apakah Anda yakin ingin menghapus desa berikut?</p>
                <div class="alert alert-light border border-danger">
                    <p class="mb-0 text-danger fw-bold" id="deleteItemName" style="font-size: 1.1rem;"></p>
                    <small class="text-muted">ID: <span id="deleteItemId"></span></small>
                </div>
                <div class="alert alert-warning" style="font-size: 0.9rem;">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Catatan:</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('deleteItemName').textContent = this.getAttribute('data-item-name');
                document.getElementById('deleteItemId').textContent = this.getAttribute('data-item-id');
                document.getElementById('deleteForm').action = this.getAttribute('data-delete-url');
            });
        });

        const toast = document.querySelector('.toast-success-custom');
        if (toast) {
            setTimeout(() => {
                toast.style.display = 'none';
            }, 4000);
        }
    });

    function changePage(value) {
        document.getElementById('per_page').value = value;
        document.getElementById('filterForm').submit();
    }
</script>

@endsection
