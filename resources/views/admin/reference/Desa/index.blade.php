@extends('admin.layout')

@section('title', 'Reference - Desa/Kelurahan')
@section('content')

<style>
    /* Same styles as previous */
    .col-no { text-align: center; width: 5%; }
    .col-kode { text-align: center; width: 10%; }
    .col-nama { text-align: left; width: 20%; padding-left: 10px !important; }
    .col-jenis { text-align: center; width: 10%; }
    .col-kecamatan { text-align: left; width: 15%; padding-left: 10px !important; }
    .col-kabupaten { text-align: left; width: 15%; padding-left: 10px !important; }
    .col-kodepos { text-align: center; width: 10%; }
    .col-status { text-align: center; width: 10%; }
    .col-aksi { text-align: center; width: 10%; }

    .type-desa {
        background-color: #ecfdf5;
        color: #047857;
    }

    .type-kelurahan {
        background-color: #fef3c7;
        color: #92400e;
    }
</style>

<div class="container mt-4">

    {{-- Judul Halaman --}}
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Daftar Desa/Kelurahan</h2>
            <p class="text-muted">Kelola data desa dan kelurahan di Indonesia</p>
        </div>
    </div>

    {{-- Submenu Navigation --}}
    <div class="submenu-nav">
        <div class="submenu-items">
            <div class="submenu-item">
                <a href="{{ route('admin.reference.provinsi.index') }}" 
                   class="submenu-link">
                    <i class="fas fa-map-marker-alt"></i>
                    Provinsi
                </a>
            </div>
            <div class="submenu-item">
                <a href="{{ route('admin.reference.kabupaten.index') }}" 
                   class="submenu-link">
                    <i class="fas fa-city"></i>
                    Kab/Kota
                </a>
            </div>
            <div class="submenu-item">
                <a href="{{ route('admin.reference.kecamatan.index') }}" 
                   class="submenu-link">
                    <i class="fas fa-map"></i>
                    Kecamatan
                </a>
            </div>
            <div class="submenu-item">
                <a href="{{ route('admin.reference.desa.index') }}" 
                   class="submenu-link active">
                    <i class="fas fa-home"></i>
                    Desa/Kelurahan
                </a>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Filter --}}
    <form method="GET" action="{{ route('admin.reference.desa.index') }}" id="filterForm" class="mb-3">
        <div class="row g-2 align-items-end">
            {{-- Search --}}
            <div class="col-md-4">
                <label class="form-label fw-bold text-dark" style="font-size: 12px;">Pencarian</label>
                <div class="input-group">
                    <input type="text" name="search" class="form-control" style="font-size: 12px; padding: 6px;"
                        placeholder="Cari berdasarkan nama desa/kelurahan..."
                        value="{{ request('search') }}" />
                    <button class="btn btn-dark" style="padding: 6px 12px;"><i class="fas fa-search"></i></button>
                </div>
            </div>

            {{-- Filter Kecamatan --}}
            <div class="col-md-3">
                <label class="form-label fw-bold text-dark" style="font-size: 12px;">Kecamatan</label>
                <select name="kecamatan_id" class="form-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }} - {{ $kecamatan->kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tambah Desa --}}
            <div class="col-md-2 ms-auto">
                <label class="form-label invisible">x</label>
                <a href="{{ route('admin.reference.desa.create') }}" class="btn btn-dark w-100" style="font-size: 12px; padding: 6px;">
                    <i class="fas fa-plus me-1"></i> Tambah Desa
                </a>
            </div>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-container">
        {{-- Header --}}
        <div class="tbl-header">
            <table>
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-kode">Kode</th>
                        <th class="col-nama">Nama Desa/Kelurahan</th>
                        <th class="col-jenis">Jenis</th>
                        <th class="col-kecamatan">Kecamatan</th>
                        <th class="col-kabupaten">Kabupaten</th>
                        <th class="col-kodepos">Kode Pos</th>
                        <th class="col-status">Status</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>

        {{-- Body --}}
        <div class="tbl-content">
            <table>
                <tbody>
                    @forelse($desas as $desa)
                    <tr>
                        <td class="col-no">{{ $loop->iteration + ($desas->currentPage() - 1) * $desas->perPage() }}</td>
                        <td class="col-kode">{{ $desa->kode_desa }}</td>
                        <td class="col-nama">{{ $desa->nama_desa }}</td>
                        <td class="col-jenis">
                            <span class="type-badge {{ $desa->jenis == 'Desa' ? 'type-desa' : 'type-kelurahan' }}">
                                <i class="fas {{ $desa->jenis == 'Desa' ? 'fa-tree' : 'fa-building' }}"></i>
                                {{ $desa->jenis }}
                            </span>
                        </td>
                        <td class="col-kecamatan">{{ $desa->kecamatan->nama_kecamatan }}</td>
                        <td class="col-kabupaten">{{ $desa->kecamatan->kabupaten->nama_kabupaten }}</td>
                        <td class="col-kodepos">{{ $desa->kodepos ?: '-' }}</td>
                        <td class="col-status">
                            <span class="status-badge {{ $desa->status ? 'status-active' : 'status-inactive' }}">
                                <i class="fas {{ $desa->status ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                {{ $desa->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="col-aksi">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.reference.desa.edit', $desa->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.reference.desa.delete', $desa->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus desa/kelurahan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Tidak ada data desa/kelurahan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        @if($desas->hasPages())
        <table>
            <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- Per Page --}}
                            <div style="width:120px;">
                                <select name="per_page" id="per_page" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5 Data</option>
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Data</option>
                                    <option value="15" {{ request('per_page', 10) == 15 ? 'selected' : '' }}>15 Data</option>
                                </select>
                            </div>

                            {{-- Pagination --}}
                            <div>
                                <nav>
                                    {{ $desas->links() }}
                                </nav>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
    </div>
</div>

@endsection