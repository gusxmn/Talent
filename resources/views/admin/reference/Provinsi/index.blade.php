@extends('admin.layout')

@section('title', 'Manajemen Provinsi')
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

    /* SUB JUDUL DAFTAR PROVINSI */
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
        border-collapse: collapse; 
        color: var(--table-text) !important; 
    }

    .table-responsive, .shadow-sm, .table, .table-hover, .table-light, thead {
        background-color: transparent !important;
        border: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    /* HEADER - NEMPEL LANGSUNG KE BODY */
    .tbl-header{
        background-color: var(--header-color) !important; 
        border: 1px solid var(--header-color); 
        border-bottom: none;
        border-radius: 5px 5px 0 0; 
        margin-bottom: 0 !important;
    }
    
    /* CONTENT BODY - NEMPEL LANGSUNG KE HEADER */
    .tbl-content{
        height:280px;
        overflow-x: hidden; 
        overflow-y: auto;
        margin-top: 0 !important;
        background-color: var(--table-bg) !important;
        border: 1px solid var(--table-border);
        border-top: none !important;
        border-radius: 0 0 5px 5px; 
    }

    /* TABLE HEADER */
    th{
        padding: 12px 8px !important;
        text-align: left !important;
        font-weight: 600 !important;
        font-size: 11px !important; 
        color: #fff !important;
        text-transform: uppercase !important;
        vertical-align: middle;
        border-bottom: none !important; 
        background-color: transparent !important;
    }

    /* TABLE DATA */
    td{
        padding: 10px 8px !important;
        text-align: left !important;
        vertical-align:middle !important;
        font-weight: 300 !important;
        font-size: 10px !important;
        color: var(--table-text) !important;
        border-bottom: solid 1px var(--table-border) !important;
        border-top: none !important; 
        background-color: transparent !important; 
    }
    
    /* KOLOM NO YANG LEBIH KECIL DAN RAPI */
    .col-no {
        width: 4% !important;
        text-align: center !important;
        padding: 10px 4px !important;
    }
    
    /* KOLOM KODE PROVINSI */
    .col-kode {
        width: 10% !important;
    }
    
    /* KOLOM PROVINSI */
    .col-provinsi {
        width: 26% !important;
    }
    
    /* KOLOM NAMA PENGISI */
    .col-pengisi {
        width: 26% !important;
    }
    
    /* KOLOM TINDAKAN */
    .col-actions {
        width: 24% !important;
        text-align: center !important;
    }
    
    /* ROW HOVER EFFECT */
    .table-hover tbody tr:hover {
        background-color: var(--table-hover) !important;
    }
    
    /* FOOTER - NEMPEL LANGSUNG KE BODY */
    .table tfoot {
        border-top: none !important;
        background-color: var(--footer-color) !important;
        border-radius: 0 0 5px 5px; 
        color: white !important;
        margin-top: 0 !important;
    }
    .table tfoot td {
        background-color: transparent !important; 
        color: #fff !important;
        border: none !important;
        padding: 10px 12px !important;
    }
    .table tfoot .text-muted {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    .table tfoot strong {
        color: #fff !important;
    }

    /* FORM CONTROLS - PUTIH */
    .form-control, .form-select {
        background-color: #ffffff !important; 
        border: 1px solid #ced4da !important;
        color: #212529 !important;
        font-size: 11px !important;
        padding: 6px 10px !important;
    }

    /* TOMBOL PENCARIAN - BIRU */
    .btn-search {
        background-color: var(--header-color) !important; 
        border-color: var(--header-color) !important;
        color: white !important;
        padding: 6px 12px !important;
        font-size: 11px !important;
    }
    .btn-search:hover {
        background-color: #1e3a8a !important;
        border-color: #1e3a8a !important;
    }

    /* TOMBOL TAMBAH - BIRU */
    .btn-tambah {
        background-color: var(--header-color) !important; 
        border-color: var(--header-color) !important;
        color: white !important;
        padding: 6px 12px !important;
        font-size: 11px !important;
    }
    .btn-tambah:hover {
        background-color: #1e3a8a !important;
        border-color: #1e3a8a !important;
    }

    /* CONTAINER TABEL - NO GAP */
    .table-container {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color);
    }

    /* STYLE UNTUK FILTER PAGINATION DI FOOTER */
    .footer-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    
    .pagination-filter-footer {
        min-width: 100px;
    }
    .pagination-filter-footer .form-select {
        background-color: #ffffff !important;
        border: 1px solid #ced4da !important;
        color: #212529 !important;
        cursor: pointer;
        font-size: 10px !important;
        padding: 3px 6px !important;
        height: 26px !important;
    }
    
    /* TOMBOL TINDAKAN YANG LEBIH KECIL */
    .btn-action {
        padding: 3px 6px !important;
        font-size: 10px !important;
        min-width: 26px;
        height: 26px;
    }
    
    /* TEXT INFO FOOTER */
    .footer-info {
        font-size: 10px !important;
    }

    /* GARIS PEMISAH - DARK MODE SUPPORT */
    .divider {
        border: none;
        border-top: 1px solid var(--border-color);
        margin: 20px 0;
    }

    /* PAGINATION CUSTOM STYLE - DIPERBAIKI */
    .table-pagination {
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .table-pagination .pagination {
        margin: 0 !important;
        justify-content: flex-end;
        gap: 2px;
        flex-wrap: nowrap;
    }
    
    .table-pagination .page-link {
        font-size: 10px !important;
        padding: 4px 8px !important;
        min-width: 28px;
        height: 26px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        color: #0d6efd;
        text-decoration: none;
        border-radius: 4px;
    }
    
    .table-pagination .page-item.active .page-link {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }
    
    .table-pagination .page-item.disabled .page-link {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
        cursor: not-allowed;
    }
    
    .table-pagination .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #0a58ca;
    }
    
    /* STYLE KHUSUS UNTUK PAGINATION DENGAN ICON */
    .pagination-icon-only .page-link span {
        display: none;
    }
    
    /* FIX SIDEBAR BACKGROUND */
    .sidebar {
        background-color: #2c2e35 !important;
    }
    
    .sidebar .nav-link {
        color: #ffffff !important;
    }
    
    .sidebar .nav-link.active {
        background-color: #0d6efd !important;
    }
    
    /* PAGINATION COMPACT */
    .pagination-compact .page-item {
        margin: 0 1px;
    }
    
    .pagination-compact .page-link {
        min-width: 24px;
        height: 24px;
        padding: 2px 6px !important;
        font-size: 9px !important;
    }

    /* CUSTOM BUTTON COLORS */
    .btn-warning {
        background-color: #fbbf24 !important;
        border-color: #fbbf24 !important;
        color: #000 !important;
    }
    .btn-warning:hover {
        background-color: #f59e0b !important;
        border-color: #f59e0b !important;
    }

    .btn-danger {
        background-color: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #fff !important;
    }
    .btn-danger:hover {
        background-color: #dc2626 !important;
        border-color: #dc2626 !important;
    }

    .btn-info {
        background-color: #06b6d4 !important;
        border-color: #06b6d4 !important;
        color: #fff !important;
    }
    .btn-info:hover {
        background-color: #0891b2 !important;
        border-color: #0891b2 !important;
    }

    /* TOAST NOTIFICATION POSITION - DIPERBAIKI */
    .toast-container-custom {
        position: fixed;
        top: 0px;
        right: 20px;
        z-index: 9999;
        min-width: 350px;
    }
    
    .toast-success-custom {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        box-shadow: 0 8px 24px rgba(40, 167, 69, 0.3) !important;
        padding: 16px !important;
        min-height: 80px;
        display: flex;
        align-items: center;
        animation: slideDown 0.4s ease-out;
    }
    
    .toast-success-custom .toast-body {
        padding: 0 !important;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* MODAL STYLES - ENSURE MODAL APPEARS ON TOP */
    .modal {
        z-index: 10000 !important;
    }
    
    .modal-backdrop {
        z-index: 9999 !important;
        opacity: 0.5 !important;
    }
    
    .modal.show {
        display: flex !important;
    }
    
    .modal.fade .modal-dialog {
        transition: transform 0.4s ease-out, opacity 0.4s ease-out;
    }
    
    .modal.show .modal-dialog {
        transform: none;
        animation: modalSlideIn 0.4s ease-out;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* LOADING STATE UNTUK DELETE BUTTON */
    .btn-delete-loading {
        position: relative;
        pointer-events: none;
    }
    
    .btn-delete-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin: -8px 0 0 -8px;
        border: 2px solid transparent;
        border-top: 2px solid #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="container mt-4">
    
    {{-- HEADER SECTION - SEJAJAR DENGAN ICON --}}
    <div class="header-section">
        <div class="header-icon">
            <i class="fas fa-map-marked-alt"></i>
        </div>
        <div class="header-text">
            <h1 class="main-title">Manajemen Provinsi</h1>
            <h2 class="page-title">Daftar Provinsi</h2>
        </div>
    </div>
    
    {{-- TOAST NOTIFICATION - POSISI LEBIH ATAS DAN RAPI --}}
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

    {{-- FORM KONTROL DENGAN FIXED LAYOUT --}}
    <form method="GET" action="{{ route('admin.reference.provinsi.index') }}" class="mb-4" id="filterForm">
        <div class="row g-3 align-items-end">
            {{-- KOLOM PENCARIAN - TANPA LABEL --}}
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Cari berdasarkan kode, provinsi, atau nama pengisi..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            {{-- TOMBOL TAMBAH --}}
            <div class="col-md-3">
                <a href="{{ route('admin.reference.provinsi.create') }}" class="btn btn-primary w-100 btn-tambah">
                    <i class="fas fa-plus me-1"></i>Tambah Provinsi
                </a>
            </div>
        </div>

        {{-- INPUT HIDDEN UNTUK MENJAGA PARAMETER PENCARIAN --}}
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        
        {{-- INPUT HIDDEN UNTUK PER PAGE --}}
        <input type="hidden" name="per_page" id="per_page" value="{{ request('per_page', 10) }}">
    </form>

    {{-- GARIS PEMISAH --}}
    <hr class="divider">

    {{-- TABEL CONTAINER - NO GAP --}}
    <div class="table-container">
        <div class="table-responsive">
            
            {{-- HEADER - NEMPEL LANGSUNG --}}
            <div class="tbl-header">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-kode">KODE</th>
                            <th class="col-nama">NAMA PROVINSI</th>
                            <th class="col-status">STATUS</th>
                            <th class="col-actions">TINDAKAN</th> 
                        </tr>
                    </thead>
                </table>
            </div>

            {{-- CONTENT BODY - NEMPEL LANGSUNG KE HEADER --}}
            <div class="tbl-content">
                <table class="table table-hover"> 
                    <tbody>
                        @forelse($provinsis as $index => $provinsi)
                            <tr class="align-middle"> 
                                <td class="col-no">{{ $index + 1 }}</td>
                                <td class="col-kode">{{ $provinsi->kode_provinsi ?? '-' }}</td>
                                <td class="col-nama">{{ $provinsi->nama_provinsi ?? $provinsi->name }}</td>
                                <td class="col-status">
                                    <span class="badge {{ $provinsi->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $provinsi->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="col-actions">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.reference.provinsi.edit', $provinsi->id) }}" title="Edit"
                                           class="btn btn-warning btn-sm btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-action"
                                                data-bs-toggle="modal" data-bs-target="#modal_{{ md5($provinsi->id) }}"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3" style="font-size: 11px !important;">Tidak ada data provinsi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- FOOTER - NEMPEL LANGSUNG KE BODY --}}
        @if(count($provinsis) > 0)
        <div class="table-responsive">
            <table class="table" style="table-layout: fixed;"> 
                <tfoot>
                    <tr>
                        <td colspan="5" class="p-2">
                            <div class="footer-controls">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-muted footer-info">
                                        Total: <strong>{{ count($provinsis) }}</strong> data provinsi
                                    </div>
                                    <div class="pagination-filter-footer">
                                        <select name="per_page_footer" id="per_page_footer" class="form-select">
                                            <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 Data</option>
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data</option>
                                            <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20 Data</option>
                                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 Data</option>
                                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 Data</option>
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- PAGINATION DI KANAN BAWAH - SUDAH DIPERBAIKI --}}
                                @if($provinsis->hasPages())
                                <div class="table-pagination">
                                    <ul class="pagination pagination-compact pagination-icon-only mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($provinsis->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left fa-xs"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $provinsis->previousPageUrl() }}" rel="prev">
                                                    <i class="fas fa-chevron-left fa-xs"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements - Sederhana --}}
                                        @php
                                            $current = $provinsis->currentPage();
                                            $last = $provinsis->lastPage();
                                        @endphp

                                        {{-- Tampilkan maksimal 5 halaman --}}
                                        @for ($i = max(1, $current - 2); $i <= min($last, $current + 2); $i++)
                                            @if ($i == $current)
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $i }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $provinsis->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endfor

                                        {{-- Next Page Link --}}
                                        @if ($provinsis->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $provinsis->nextPageUrl() }}" rel="next">
                                                    <i class="fas fa-chevron-right fa-xs"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-right fa-xs"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
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

{{-- MODALS SECTION - OUTSIDE TABLE CONTAINER --}}
@forelse($provinsis as $provinsi)
    @php
        $modalId = 'modal_' . md5($provinsi->id);
        $formId = 'form_' . md5($provinsi->id);
    @endphp
    <div class="modal fade" id="{{ $modalId }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <form method="POST" id="{{ $formId }}" action="{{ route('admin.reference.provinsi.destroy', $provinsi->id) }}">
                    @csrf
                    @method('DELETE')
                    
                    <div class="modal-header bg-danger text-white py-3">
                        <h5 class="modal-title fw-bold">⚠️ Konfirmasi Penghapusan</h5>
                    </div>
                    <div class="modal-body py-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-exclamation-triangle text-danger" style="font-size: 48px; opacity: 0.8;"></i>
                        </div>
                        <p class="text-center mb-2 fs-6">Anda akan menghapus provinsi:</p>
                        <div class="alert alert-danger alert-light text-center py-2 mb-3" style="border-left: 4px solid #dc3545;">
                            <h5 class="mb-0 text-dark fw-bold">{{ $provinsi->name }}</h5>
                        </div>
                        <p class="text-center text-muted small mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Tindakan ini tidak dapat dibatalkan dan data akan hilang selamanya.
                        </p>
                    </div>
                    <div class="modal-footer py-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i> Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@empty
@endforelse

{{-- JAVASCRIPT UNTUK FILTER DAN DELETE --}}
<script>
    // FUNGSI UNTUK FILTER PAGINATION DI FOOTER
    function handlePaginationFooterChange() {
        const perPageValue = document.getElementById('per_page_footer').value;
        document.getElementById('per_page').value = perPageValue;
        document.getElementById('filterForm').submit();
    }

    // Event listener saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk filter pagination di footer
        const perPageFooterSelect = document.getElementById('per_page_footer');
        if (perPageFooterSelect) {
            perPageFooterSelect.addEventListener('change', handlePaginationFooterChange);
        }
        
        // Sync nilai dropdown di footer
        const perPageValue = "{{ request('per_page', 10) }}";
        if (perPageFooterSelect) {
            perPageFooterSelect.value = perPageValue;
        }
        
        // Toast notification
        const toastEl = document.getElementById('successToast');
        if (toastEl && typeof bootstrap !== 'undefined') {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 4000,
                animation: true
            });
            toast.show();
            
            // Countdown timer
            let countdown = 4;
            const timerEl = document.getElementById('toastTimer');
            if (timerEl) {
                const timerInterval = setInterval(function() {
                    countdown--;
                    if (countdown > 0) {
                        timerEl.textContent = countdown + 's';
                    } else {
                        timerEl.textContent = '';
                        clearInterval(timerInterval);
                    }
                }, 1000);
            }
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(window).on("load resize", function() {
        var $tblContent = $('.tbl-content');
        var $tblHeader = $('.tbl-header');
        
        var scrollWidth = $tblContent.width() - $tblContent[0].clientWidth;
        $tblHeader.css({'padding-right': scrollWidth});
    }).resize();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection