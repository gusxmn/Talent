@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4 text-secondary">🔔 Daftar Notifikasi Saya</h2>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Jika tidak ada notifikasi --}}
    @if($notifications->isEmpty())
        <div class="alert alert-info">Belum ada notifikasi.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="list-group">
                    @foreach($notifications as $notif)
                        <li class="list-group-item d-flex justify-content-between align-items-start 
                            {{ is_null($notif->read_at) ? 'list-group-item-warning' : '' }}">
                            
                            <div>
                                <h6 class="fw-bold mb-1">{{ $notif->data['title'] ?? 'Notifikasi' }}</h6>
                                <p class="mb-1">{{ $notif->data['message'] ?? '' }}</p>
                                <small class="text-muted">
                                    Dikirim: {{ $notif->created_at->diffForHumans() }}
                                </small>
                            </div>

                            <div>
                                @if(is_null($notif->read_at))
                                    <form action="{{ route('admin.notif.read', $notif->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm btn-outline-success">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-success">Dibaca</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@endsection
