@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Lowongan</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form Pencarian & Filter --}}
    <form method="GET" action="{{ route('admin.job_listings.index') }}" class="row g-3 mb-4 align-items-end">
        {{-- Pencarian --}}
        <div class="col-md-3">
            <label for="search" class="form-label">Cari</label>
            <input type="text" name="search" id="search" class="form-control"
                placeholder="Cari posisi / perusahaan..."
                value="{{ request('search') }}">
        </div>

        {{-- Filter Lokasi --}}
        <div class="col-md-3">
            <label for="location" class="form-label">Lokasi</label>
            <select name="location" id="location" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Lokasi</option>
                @foreach(\App\Models\Lokasi::all() as $loc)
                    <option value="{{ $loc->nama_lokasi }}" {{ request('location') == $loc->nama_lokasi ? 'selected' : '' }}>
                        {{ $loc->nama_lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Jenis Pekerjaan --}}
        <div class="col-md-2">
            <label for="type" class="form-label">Tipe</label>
            <select name="type" id="type" class="form-select" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                <option value="internship" {{ request('type') == 'internship' ? 'selected' : '' }}>Magang</option>
            </select>
        </div>

        {{-- Data per halaman --}}
        <div class="col-md-2">
            <label for="per_page" class="form-label">Tampil</label>
            <select name="per_page" id="per_page" class="form-select" onchange="this.form.submit()">
                <option value="5" {{ request('per_page', $jobs->perPage()) == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page', $jobs->perPage()) == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('per_page', $jobs->perPage()) == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('per_page', $jobs->perPage()) == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>

        {{-- Tombol Tambah --}}
        <div class="col-md-2 text-end">
            <a href="{{ route('admin.job_listings.create') }}" class="btn btn-success w-100">+ Tambah</a>
        </div>
    </form>

    {{-- Tabel dengan Pagination di Dalam --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Posisi</th>
                    <th>Perusahaan</th>
                    <th>Lokasi</th>
                    <th>Tipe</th>
                    <th>Gaji</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td class="text-center">{{ $job->id }}</td>
                        <td class="text-center">
                            @if($job->company_logo && file_exists(public_path('storage/' . $job->company_logo)))
                                <img src="{{ asset('storage/' . $job->company_logo) }}" class="rounded" style="width:50px; height:50px; object-fit:contain;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->company }}</td>
                        <td>{{ $job->location }}</td>
                        <td><span class="badge bg-info text-dark">{{ ucfirst($job->type) }}</span></td>
                        <td>{{ $job->formatted_salary }}</td>
                        <td>{{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : '-' }}</td>
                        <td>
                            @if($job->is_public)
                                <span class="badge bg-success">Publik</span>
                            @else
                                <span class="badge bg-secondary">Privat</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.job_listings.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $job->id }}">
                                Hapus
                            </button>

                            {{-- Modal Konfirmasi Hapus --}}
                            <div class="modal fade" id="deleteModal{{ $job->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus lowongan <strong>{{ $job->title }}</strong> di <strong>{{ $job->company }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.job_listings.destroy', $job->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">Belum ada lowongan.</td>
                    </tr>
                @endforelse
            </tbody>
            
            {{-- FOOTER TABEL untuk Pagination --}}
            @if ($jobs->total() > 0)
            <tfoot class="table-light">
                <tr>
                    <td colspan="10" class="p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Menampilkan <strong>{{ $jobs->firstItem() }}</strong> - 
                                <strong>{{ $jobs->lastItem() }}</strong> dari 
                                <strong>{{ $jobs->total() }}</strong> data.
                            </div>
                            {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection