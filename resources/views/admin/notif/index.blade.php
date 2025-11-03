@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-secondary">Kirim Notifikasi ke Pengguna</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form kirim notifikasi --}}
    <form action="{{ route('admin.notif.send') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Pilih Pengguna</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Notifikasi</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul notifikasi" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Tulis pesan notifikasi..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Kirim Notifikasi
        </button>
    </form>
</div>
@endsection
