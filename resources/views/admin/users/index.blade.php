@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen User</h2>

    {{-- Toast Notifikasi --}}
    @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index:1080;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Berhasil</strong>
                    <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    {{-- KPI Box --}}
    <div class="row mb-4">
        {{-- Total Admin --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAdmin }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Wawancara --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Wawancara</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalWawancara }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pemimpin --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pemimpin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPemimpin }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-crown fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total User --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    {{-- Bar Pencarian & Tambah User --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

    {{-- Form Pencarian --}}
    <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex w-100 w-md-auto" style="max-width: 420px;">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   class="form-control border-start-0 shadow-none" 
                   placeholder="Cari user...">
            <button type="submit" class="btn btn-primary px-4">
                Cari
            </button>
        </div>
    </form>

    {{-- Tombol Tambah --}}
    <a href="{{ route('admin.users.create') }}" class="btn btn-success d-flex align-items-center px-4">
        <i class="fas fa-plus me-2"></i> Tambah User
    </a>
</div>

<style>
    .btn-success, .btn-primary {
        transition: all 0.2s ease-in-out;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #198754;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2);
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.1rem rgba(13, 110, 253, 0.25);
    }
</style>


    {{-- Tabel User dengan Pagination di Dalam --}}
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width:170px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $user)
                            <tr>
                                <td class="text-center">{{ $users->firstItem() + $i }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            {{ $user->name }}
                                            <div class="small text-muted">ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $roleColors = [
                                            'admin' => 'primary',
                                            'pemimpin' => 'info',
                                            'user' => 'success', 
                                            'wawancara' => 'warning'
                                        ];
                                        $roleIcons = [
                                            'admin' => 'user-shield',
                                            'pemimpin' => 'crown',
                                            'user' => 'user',
                                            'wawancara' => 'comments'
                                        ];
                                        $color = $roleColors[$user->role] ?? 'secondary';
                                        $icon = $roleIcons[$user->role] ?? 'user';
                                    @endphp
                                    <span class="badge bg-{{ $color }}">
                                        <i class="fas fa-{{ $icon }} me-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal"
                                                data-id="{{ $user->id }}"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-users fa-3x mb-3"></i>
                                        <p>Belum ada user.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                    {{-- FOOTER TABEL untuk Pagination --}}
                    @if($users->hasPages() || $users->total() > 0)
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="6" class="p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- Dropdown jumlah data tampil (kiri) --}}
                                    <form action="{{ route('admin.users.index') }}" method="GET" id="perPageForm" class="d-flex align-items-center">
                                        @if(request('search'))
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                        @endif
                                        <label for="per_page" class="me-2 small">Tampilkan</label>
                                        <select name="per_page" id="per_page" class="form-select form-select-sm" style="width: auto;" onchange="document.getElementById('perPageForm').submit()">
                                            <option value="5"  {{ request('per_page', $perPage) == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ request('per_page', $perPage) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ request('per_page', $perPage) == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('per_page', $perPage) == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ request('per_page', $perPage) == 100 ? 'selected' : '' }}>100</option>
                                        </select>
                                        <label for="per_page" class="ms-2 small">data</label>
                                    </form>

                                    {{-- Pagination (kanan) --}}
                                    <div>
                                        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
            <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
        </div>
        <p class="text-center">Apakah Anda yakin ingin menghapus user ini?</p>
        <p class="text-center text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> Batal
        </button>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Hapus
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toast auto tampil
    var toastEl = document.getElementById('liveToast');
    if (toastEl && typeof bootstrap !== 'undefined') {
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    // Modal konfirmasi hapus
    var confirmModal = document.getElementById('confirmDeleteModal');
    if (confirmModal) {
        confirmModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            if (!button) return;
            var id = button.getAttribute('data-id');
            var form = document.getElementById('deleteForm');
            form.action = "{{ url('admin/users') }}/" + id;
        });
    }
});
</script>

<style>
.card {
    border: none;
    border-radius: 0.5rem;
}
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}
.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection