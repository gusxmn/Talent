@extends('admin.layout')

@section('title', 'Detail Jadwal')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Jadwal</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ ucfirst(str_replace('_', ' ', $schedule->type)) }}
            </h5>

            <p><strong>Nama Pelamar:</strong> 
                {{ $schedule->application && $schedule->application->user 
                    ? $schedule->application->user->name 
                    : '-' }}
            </p>

            <p><strong>Lowongan:</strong> 
                {{ $schedule->application && $schedule->application->jobListing 
                    ? $schedule->application->jobListing->title 
                    : '-' }}
            </p>

            <p><strong>Waktu Mulai:</strong> {{ $schedule->start_time }}</p>
            <p><strong>Waktu Selesai:</strong> {{ $schedule->end_time ?? '-' }}</p>
            <p><strong>Lokasi:</strong> {{ $schedule->location }}</p>
            <p><strong>Catatan:</strong> {{ $schedule->notes ?? '-' }}</p>
            <p><strong>Dibuat Oleh:</strong> {{ $schedule->creator->name ?? '-' }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
