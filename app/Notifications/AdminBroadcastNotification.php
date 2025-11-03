<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminBroadcastNotification extends Notification
{
    use Queueable;

    // --- DEKLARASI PROPERTI DITAMBAHKAN DI SINI ---
    public $title; // Membuat properti publik
    public $message; // Membuat properti publik
    // ----------------------------------------------

    /**
     * Buat notifikasi baru.
     */
    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Tentukan channel pengiriman notifikasi.
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; 
    }

    /**
     * Format data yang disimpan di tabel notifications.
     */
    public function toDatabase($notifiable)
    {
        return [
            'title'   => $this->title,
            'message' => $this->message,
            'sender'  => 'Admin',
        ];
    }

    /**
     * Tentukan representasi notifikasi dalam bentuk email.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    // Error terjadi di sini karena properti tidak dideklarasikan
                    ->subject('Pemberitahuan Admin: ' . $this->title) 
                    ->greeting('Halo ' . $notifiable->name . ',') 
                    ->line($this->message)
                    ->action('Kunjungi Aplikasi', url('/')) 
                    ->line('Terima kasih!');
    }
}