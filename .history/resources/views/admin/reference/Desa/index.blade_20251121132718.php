@extends('admin.layout')

@section('title', 'Manajemen Desa/Kelurahan')
@section('content')

{{-- =================================================================== --}}
{{-- CUSTOM STYLES SEDERHANA --}}
{{-- =================================================================== --}}
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
    
    /* VARIABEL WARNA */
    :root {
        --dark-bg: #2c2e35;
        --dark-input: #3b3d45;
        --header-color: #1e3a8a;
        --footer-color: #1e3a8a;
        --table-bg: #ffffff;
        --table-text: #212529;
        --table-border: #dee2e6;
        --table-hover: #f8f9fa;
        --text-primary: #000000;
        --border-color: #dee2e6;
    }

    /* Dark mode support */
    body.dark-mode {
        --text-primary: #ffffff;
        --border-color: #495057;
    }

    /* Force dark mode for admin panel */
    body {
        --text-primary: #000000;
        --border-color: #dee2e6;
    }

    body.dark-mode {
        --text-primary: #ffffff;
        --border-color: #6c757d;
    }

    /* JUDUL UTAMA */
    .main-title {
        color: var(--text-primary) !important;
        font-weight: 700 !important;
        font-size: 1.8rem !important;
        margin-bottom: 5px !important;
        text-align: left !important;
        line-height: 1.2;
        padding-top: 8px;
    }

    /* SUB JUDUL DAFTAR DESA */
    .page-title {
        color: var(--text-primary) !important;
        font-weight: 500 !important;
        font-size: 1.1rem !important;
        margin-bottom: 0 !important;
        text-align: left !important;
        opacity: 0.9;
        line-height: 1.3;
        padding-bottom: 5px;
    }

    /* HEADER SECTION - SEJAJAR DENGAN ICON */
    .header-section {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding-top: 5px;
    }

    /* ICON SIDE */
    .header-icon {
        font-size: 2rem !important;
        color: var(--header-color) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background: rgba(30, 58, 138, 0.1);
        border-radius: 8px;
        margin-top: 8px;
    }

    /* TEXT SIDE */
    .header-text {
        flex: 1;
        padding-top: 5px;
    }

    /* STYLE TABEL - NO GAP */
    table{
        width:100%;
        table-layout: fixed;
        margin:0;
        color: var(--table-text) !important; 
    }

    /* RESPONSIVE CONTAINER */
    .table-responsive, .shadow-sm, .table, .table-hover, .table-light, thead {
        border-radius: 10px;
    }

    /* TABLE CONTAINER */
    .table-container {
        box-shadow: 0 2px 8px 0 rgba(34, 34, 34, 0.15);
        border-radius: 10px;
        overflow: hidden;
        background-color: var(--table-bg) !important;
        border: 1px solid var(--table-border);
    }

    /* TABLE HEADER */
    .tbl-header {
        background-color: var(--header-color);
        overflow: auto;
    }

    .tbl-header thead th {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px 8px !important;
        color: white !important;
        text-align: center;
        border: none !important;
        white-space: nowrap;
    }

    /* TABLE DATA */
    .tbl-content {
        overflow: auto;
        max-height: 650px;
    }

    .tbl-content tbody td {
        font-size: 12px;
        padding: 10px 8px !important;
        color: var(--table-text) !important;
        border-bottom: solid 1px var(--table-border) !important;
        text-align: center;
    }

    /* COLUMN WIDTHS */
    .col-no { width: 5%; min-width: 50px; }
    .col-kode { width: 10%; min-width: 90px; }
    .col-nama { width: 25%; text-align: left !important; }
    .col-kecamatan { width: 20%; text-align: left !important; }
    .col-jenis { width: 10%; min-width: 80px; }
    .col-status { width: 10%; min-width: 80px; }
    .col-actions { width: 12%; min-width: 90px; }

    /* TABLE HOVER */
    .table-hover tbody tr:hover {
        background-color: var(--table-hover) !important;
    }

    .table-hover tbody tr:hover td {
        background-color: var(--table-hover) !important;
    }

    /* DIVIDER */
    .divider {
        margin: 20px 0;
        border: none;
        border-top: 1px solid var(--border-color);
    }

    /* BUTTON STYLES */
    .btn-search {
        background-color: var(--header-color);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 0 4px 4px 0;
    }

    .btn-search:hover {
        background-color: #1530ab;
        color: white;
    }

    .btn-tambah {
        background-color: var(--header-color);
        color: white;
        font-weight: 500;
    }

    .btn-tambah:hover {
        background-color: #1530ab;
        color: white;
    }

    /* FOOTER CONTROLS */
    .footer-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        padding: 10px 0;
        background-color: var(--table-bg);
    }

    .footer-info {
        font-size: 12px;
        white-space: nowrap;
    }

    .pagination-filter-footer {
        min-width: 120px;
    }

    .pagination-filter-footer .form-select {
        font-size: 12px;
        padding: 6px 8px;
    }

    .table-pagination {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .pagination {
        margin: 0;
        gap: 3px;
    }

    /* BTN ACTION */
    .btn-action {
        padding: 5px 8px;
        border-radius: 4px;
    }

    /* TOAST STYLES */
    .toast-container-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast-success-custom {
        background-color: #28a745;
        border-radius: 8px;
    }

    .toast-body {
        padding: 12px 16px !important;
    }

    /* INPUT GROUP */
    .input-group {
        border-radius: 4px;
        overflow: hidden;
    }

    .input-group .form-control {
        border-radius: 4px 0 0 4px;
        border: 1px solid #dee2e6;
        font-size: 12px;
    }

    .input-group .form-control:focus {
        border-color: var(--header-color);
        box-shadow: 0 0 0 0.2rem rgba(30, 58, 138, 0.25);
    }

    .form-select {
        font-size: 12px;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }

    .form-select:focus {
        border-color: var(--header-color);
        box-shadow: 0 0 0 0.2rem rgba(30, 58, 138, 0.25);
    }

    /* TYPE BADGE */
    .type-desa {
        background-color: #e6f5e3;
        color: #2d5016;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
    }

    .type-kelurahan {
        background-color: #fff3cd;
        color: #856404;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
    }
</style>

<div class="container-fluid py-4 px-4">
    {{-- HEADER SECTION --}}
    <div class="header-section">
        <div class="header-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="header-text">
            <h1 class="main-title">Manajemen Desa/Kelurahan</h1>
            <h2 class="page-title">Daftar Desa/Kelurahan</h2>
        </div>
    </div>
    
    {{-- TOAST NOTIFICATION --}}
    @if(session('success'))
    <div class="toast-container-custom">
        <div id="successToast" class="toast toast-success-custom" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="toast-body text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3" style="font-size: 24px;"></i>
                        <div>
                            <strong class="d-block mb-1">Berhasil!</strong>
                            <small>{{ session('success') }}</small>
                        </div>
                    </div>
                    <div class="ms-3" id="toastTimer" style="font-size: 12px; min-width: 20px; text-align: right;">4s</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- FORM KONTROL --}}
    <form method="GET" action="{{ route('admin.reference.desa.index') }}" class="mb-4" id="filterForm">
        <div class="row g-3 align-items-end">
            {{-- FILTER KECAMATAN --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            {{-- TOMBOL TAMBAH --}}
            <div class="col-md-3">
                <a href="{{ route('admin.reference.desa.create') }}" class="btn btn-primary w-100 btn-tambah">
                    <i class="fas fa-plus me-1"></i>Tambah Desa
                </a>
            </div>
        </div>

        {{-- INPUT HIDDEN --}}
        <input type="hidden" name="per_page" id="per_page" value="{{ request('per_page', 10) }}">
    </form>

    {{-- GARIS PEMISAH --}}
    <hr class="divider">

    {{-- TABEL CONTAINER --}}
    <div class="table-container">
        <div class="table-responsive">
            
            {{-- HEADER --}}
            <div class="tbl-header">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-kode">KODE</th>
                            <th class="col-nama">NAMA DESA/KELURAHAN</th>
                            <th class="col-jenis">JENIS</th>
                            <th class="col-kecamatan">KECAMATAN</th>
                            <th class="col-status">STATUS</th>
                            <th class="col-actions">TINDAKAN</th> 
                        </tr>
                    </thead>
                </table>
            </div>

            {{-- CONTENT BODY --}}
            <div class="tbl-content">
                <table class="table table-hover"> 
                    <tbody>
                        @forelse($desas as $index => $desa)
                            <tr class="align-middle"> 
                                <td class="col-no">{{ $desas->firstItem() + $index }}</td>
                                <td class="col-kode">{{ $desa->kode_desa }}</td>
                                <td class="col-nama">{{ $desa->nama_desa }}</td>
                                <td class="col-jenis">
                                    <span class="type-{{ strtolower($desa->jenis) }}">
                                        {{ $desa->jenis }}
                                    </span>
                                </td>
                                <td class="col-kecamatan">{{ $desa->kecamatan->nama_kecamatan ?? '-' }}</td>
                                <td class="col-status">
                                    <span class="badge bg-success">Aktif</span>
                                </td>
                                <td class="col-actions">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.reference.desa.edit', $desa->id) }}" title="Edit"
                                           class="btn btn-warning btn-sm btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-action btn-delete"
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
                                <td colspan="7" class="text-center text-muted py-3" style="font-size: 11px !important;">Tidak ada data desa/kelurahan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- FOOTER --}}
        @if(count($desas) > 0)
        <div class="table-responsive">
            <table class="table" style="table-layout: fixed;"> 
                <tfoot>
                    <tr>
                        <td colspan="7" class="p-2">
                            <div class="footer-controls">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-muted footer-info">
                                        Total: <strong>{{ $desas->total() }}</strong> data desa/kelurahan
                                    </div>
                                    <div class="pagination-filter-footer">
                                        <select name="per_page_footer" id="per_page_footer" class="form-select" onchange="changePage(this.value)">
                                            <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 Data</option>
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data</option>
                                            <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20 Data</option>
                                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 Data</option>
                                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 Data</option>
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- PAGINATION --}}
                                @if($desas->hasPages())
                                <div class="table-pagination">
                                    {{ $desas->appends(request()->query())->links('vendor.pagination.custom') }}
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection