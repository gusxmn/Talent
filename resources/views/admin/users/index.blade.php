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

    {{-- Bar pencarian --}}
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex" style="max-width: 400px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari user...">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    {{-- Tabel User --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
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
                        <td>{{ $users->firstItem() + $i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button"
                                    class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    data-id="{{ $user->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination + Filter --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        {{-- Dropdown jumlah data tampil (kiri) --}}
        <form action="{{ route('admin.users.index') }}" method="GET" id="perPageForm" class="d-flex align-items-center">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <label for="per_page" class="me-2">Tampilkan</label>
            <select name="per_page" id="per_page" class="form-select form-select-sm" onchange="document.getElementById('perPageForm').submit()">
                <option value="5"  {{ request('per_page', $perPage) == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page', $perPage) == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page', $perPage) == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page', $perPage) == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page', $perPage) == 100 ? 'selected' : '' }}>100</option>
            </select>
            <label for="per_page" class="me-2">data </label>
        </form>

        {{-- Pagination (kanan) --}}
        <div>
            {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
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
        Apakah Anda yakin ingin menghapus user ini?
      </div>
      <div class="modal-footer">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
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
@endsection
