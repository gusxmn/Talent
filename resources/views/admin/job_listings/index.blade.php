@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Lowongan</h1>

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

    {{-- Form Pencarian & Filter --}}
    <form method="GET" action="{{ route('admin.job_listings.index') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label for="search" class="form-label">Cari</label>
            <input type="text" name="search" id="search" class="form-control"
                   placeholder="Cari posisi / perusahaan..."
                   value="{{ request('search') }}">
        </div>

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

        <div class="col-md-2">
            <label for="per_page" class="form-label">Tampil</label>
            <select name="per_page" id="per_page" class="form-select" onchange="this.form.submit()">
                <option value="5" {{ request('per_page', $jobs->perPage()) == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page', $jobs->perPage()) == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('per_page', $jobs->perPage()) == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('per_page', $jobs->perPage()) == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>

        <div class="col-md-2 text-end">
            <a href="{{ route('admin.job_listings.create') }}" class="btn btn-success w-100">+ Tambah</a>
        </div>
    </form>

    {{-- Tabel Lowongan dengan Pagination di Dalam --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Posisi</th>
                    <th>Perusahaan</th>
                    <th>Lokasi</th>
                    <th>Tipe</th>
                    <th>Gaji</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $index => $job)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}</td>
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
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-3">
                                <!-- Edit -->
                                <a href="{{ route('admin.job_listings.edit', $job->id) }}" title="Edit"
                                   style="color: #ffc107; font-size: 1.25rem;">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Hapus -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $job->id }}"
                                        title="Hapus"
                                        style="color: #dc3545; background: none; border: none; font-size: 1.25rem;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="deleteModal{{ $job->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                            <p>Yakin ingin menghapus lowongan <strong>{{ $job->title }}</strong> di <strong>{{ $job->company }}</strong>?</p>
                                            <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.job_listings.destroy', $job->id) }}" method="POST">
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
                        <td colspan="10" class="text-center text-muted py-3">Tidak ada data lowongan</td>
                    </tr>
                @endforelse
            </tbody>
            
            {{-- FOOTER TABEL untuk Pagination --}}
            @if($jobs->hasPages() || $jobs->total() > 0)
            <tfoot class="table-light">
                <tr>
                    <td colspan="10" class="p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- Info jumlah data --}}
                            <div class="text-muted small">
                                Menampilkan <strong>{{ $jobs->firstItem() ?? 0 }}</strong> - 
                                <strong>{{ $jobs->lastItem() ?? 0 }}</strong> dari 
                                <strong>{{ $jobs->total() }}</strong> data
                            </div>
                            
                            {{-- Pagination --}}
                            <div>
                                {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

{{-- Style tambahan --}}
<style>
    .fa-edit:hover {
        color: #ffda6a !important;
        transform: scale(1.15);
        transition: 0.2s ease;
    }
    .fa-trash:hover {
        color: #ff6b6b !important;
        transform: scale(1.15);
        transition: 0.2s ease;
    }
    .table tfoot {
        border-top: 2px solid #dee2e6;
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection