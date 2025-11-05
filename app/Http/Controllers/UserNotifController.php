<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotifController extends Controller
{
    /**
     * 🔔 Halaman notifikasi milik user login
     */
    public function myNotifications()
    {
        $user = auth()->user();

        // Gunakan paginate agar bisa pakai links() di view
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.notif.my', compact('notifications'));
    }

    /**
     * 🔔 API untuk ambil notifikasi user (JSON)
     */
    public function getMyNotificationsApi()
    {
        $user = auth()->user();
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * 🔔 Tandai 1 notifikasi sebagai dibaca
     */
    public function markRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    /**
     * 🔔 Tandai semua notifikasi sebagai dibaca
     */
    public function markAllRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
