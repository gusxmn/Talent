<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifikasi Saya - {{ config('app.name', 'Laravel') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ==== GAYA UTAMA ==== */
        .notification-item {
            border-left: 4px solid #eff1f3;
            transition: all 0.3s ease;
        }
        .notification-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
        .notification-item.unread {
            background-color: #e7f3ff;
            border-left-color: #17a2b8;
            cursor: pointer;
        }
        .notification-item.read {
            background-color: #f8f9fa;
            border-left-color: #6c757d;
        }
        .notification-time {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        .badge-notification {
            position: relative;
            top: -2px;
        }

        /* ==== AKSI (MATA + TITIK TIGA) ==== */
        .notification-item h6 {
            font-weight: 600;
            flex: 1;
        }

        .notification-item .btn-sm {
            padding: 4px 8px;
        }

        .notification-item .dropdown .btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .notification-actions .btn i {
            font-size: 15px;
        }
    </style>
</head>

<body>
    @include('partials.navbar')
    
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-bell me-2"></i>Notifikasi Saya</h2>
                    
                    <div class="d-flex gap-2">
                        @if($notifications->count() > 0)
                            @if($notifications->where('read_at', null)->count() > 0)
                                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-check-double me-1"></i>Tandai Semua Dibaca
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('notifications.deleteAll') }}" method="POST" onsubmit="return confirm('PERINGATAN! Anda yakin ingin MENGHAPUS SEMUA notifikasi? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash me-1"></i>Hapus Semua
                                </button>
                            </form>
                        @endif
                        
                        <button class="btn btn-outline-secondary btn-sm" onclick="refreshNotifications()">
                            <i class="fas fa-sync-alt me-1"></i>Refresh
                        </button>
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            Daftar Notifikasi 
                            @if($notifications->where('read_at', null)->count() > 0)
                                <span class="badge bg-primary badge-notification">{{ $notifications->where('read_at', null)->count() }}</span>
                            @endif
                        </h5>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($notifications->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($notifications as $notification)
                                    <div class="list-group-item p-3 notification-item {{ $notification->read_at ? 'read' : 'unread' }}">
                                        <div class="d-flex align-items-start">
                                            <div class="notification-icon {{ $notification->read_at ? 'bg-light text-secondary' : 'bg-info text-white' }}">
                                                <i class="fas {{ $notification->data['icon'] ?? 'fa-bell' }}"></i>
                                            </div>
                                            
                                            <div class="flex-grow-1">
                                                <!-- Bagian Judul dan Aksi -->
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <h6 class="mb-1">{{ $notification->data['title'] ?? 'Notifikasi' }}</h6>

                                                    <div class="notification-actions">
                                                        @if(isset($notification->data['link']))
                                                            <a href="{{ $notification->data['link'] }}" 
                                                               class="btn btn-sm btn-outline-info" 
                                                               title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endif

                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary" 
                                                                    type="button" 
                                                                    data-bs-toggle="dropdown" 
                                                                    aria-expanded="false"
                                                                    title="Opsi Lain">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                
                                                                    <li>
    <a href="{{ route('notifications.show', $notification->id) }}" class="dropdown-item">
        <i class="fas fa-eye me-2"></i>lihat detail
    </a>
</li>
                                                                
                                                                <li>
                                                                    <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger">
                                                                            <i class="fas fa-trash me-2"></i>Hapus
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Pesan Notifikasi -->
                                                <p class="mb-1">{{ $notification->data['message'] ?? 'Tidak ada pesan' }}</p>
                                                
                                                <!-- Waktu & Status -->
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <small class="notification-time">
                                                        <i class="far fa-clock me-1"></i>
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </small>
                                                    
                                                    @if(!$notification->read_at)
                                                        <span class="badge bg-info">Baru</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada notifikasi</h5>
                                <p class="text-muted">Anda tidak memiliki notifikasi saat ini.</p>
                            </div>
                        @endif
                    </div>
                    
                    @if($notifications->hasPages())
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-center">
                                {{ $notifications->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function refreshNotifications() {
            window.location.reload();
        }
    </script>
</body>
</html>
