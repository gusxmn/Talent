@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Lokasi</h2>

    {{-- Toast Notifikasi --}}
    @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
            <div id="liveToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Header: Pencarian & Tambah Lokasi --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- Form Pencarian --}}
        <form action="{{ route('admin.lokasi.index') }}" method="GET" class="d-flex">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Cari lokasi...">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>

        {{-- Tombol Tambah Lokasi --}}
        <a href="{{ route('admin.lokasi.create') }}" class="btn btn-primary">+ Tambah Lokasi</a>
    </div>

    {{-- Tabel Lokasi dengan Pagination di Dalam --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Negara</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Desa</th>
                    <th>Kode Pos</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lokasi as $key => $row)
                    <tr>
                        <td>{{ $lokasi->firstItem() + $key }}</td>
                        <td>{{ $row->negara }}</td>
                        <td>{{ $row->provinsi }}</td>
                        <td>{{ $row->kabupaten }}</td>
                        <td>{{ $row->kecamatan }}</td>
                        <td>{{ $row->kelurahan }}</td>
                        <td>{{ $row->desa }}</td>
                        <td>{{ $row->kode_pos }}</td>
                        <td>
                            <a href="{{ route('admin.lokasi.show', $row->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.lokasi.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.lokasi.destroy', $row->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada data lokasi</td>
                    </tr>
                @endforelse
            </tbody>
            
            {{-- FOOTER TABEL untuk Pagination --}}
            @if($lokasi->hasPages() || $lokasi->total() > 0)
            <tfoot class="table-light">
                <tr>
                    <td colspan="9" class="p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- Dropdown jumlah data --}}
                            <form action="{{ route('admin.lokasi.index') }}" method="GET" class="d-flex align-items-center">
                                <label for="perPage" class="me-2 small">Tampilkan</label>
                                <select name="perPage" id="perPage" class="form-select form-select-sm me-2" style="width: auto;" onchange="this.form.submit()">
                                    @foreach([10,25,50,100] as $size)
                                        <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="small">data</span>
                                <input type="hidden" name="q" value="{{ request('q') }}">
                            </form>

                            {{-- Pagination (kanan) --}}
                            <div>
                                {{ $lokasi->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Konfirmasi hapus pakai SweetAlert
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            let form = this.closest('form');
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Toast auto muncul
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('liveToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });
</script>
@endsection