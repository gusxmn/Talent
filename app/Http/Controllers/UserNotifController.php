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
        $notifications = $user->notifications()->latest()->get();

        return view('user.notif.my', compact('notifications'));
    }

    /**
     * 🔔 API untuk notifikasi user (JSON)
     */
    public function getMyNotificationsApi()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->take(10)->get();
        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * 🔔 Tandai notifikasi user sebagai dibaca (API)
     */
    public function markAsReadApi($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai sebagai dibaca.'
        ]);
    }
}
