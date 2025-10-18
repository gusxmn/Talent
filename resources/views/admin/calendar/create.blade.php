@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Tambah Jadwal Baru</h2>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Jadwal --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('calendar.store') }}" method="POST">
                @csrf

                {{-- Judul Kegiatan --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul Kegiatan</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        placeholder="Contoh: Interview Frontend Developer"
                        value="{{ old('title') }}"
                        required
                    >
                </div>

                {{-- Waktu Mulai --}}
                <div class="mb-3">
                    <label for="start" class="form-label fw-semibold">Waktu Mulai</label>
                    <input
                        type="datetime-local"
                        name="start"
                        id="start"
                        class="form-control"
                        value="{{ old('start') }}"
                        required
                    >
                </div>

                {{-- Waktu Selesai --}}
                <div class="mb-3">
                    <label for="end" class="form-label fw-semibold">Waktu Selesai</label>
                    <input
                        type="datetime-local"
                        name="end"
                        id="end"
                        class="form-control"
                        value="{{ old('end') }}"
                    >
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('calendar.index') }}" class="btn btn-secondary me-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
