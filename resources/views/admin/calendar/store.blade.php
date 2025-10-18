@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">Tambah Jadwal Baru</h1>

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
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('calendar.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul Kegiatan</label>
                    <input type="text" name="title" id="title" class="form-control" 
                           placeholder="Contoh: Interview Frontend Developer" required>
                </div>

                <div class="mb-3">
                    <label for="start" class="form-label fw-semibold">Waktu Mulai</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end" class="form-label fw-semibold">Waktu Selesai</label>
                    <input type="datetime-local" name="end" id="end" class="form-control">
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('calendar.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
