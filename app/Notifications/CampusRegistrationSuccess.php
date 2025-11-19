<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class CampusRegistrationSuccess extends Notification implements ShouldQueue
{
    use Queueable;

    public $campusName;
    public $userName;
    public $email;
    public $registrationDate;

    /**
     * Create a new notification instance.
     */
    public function __construct($campusName, $userName, $email, $registrationDate)
    {
        $this->campusName = $campusName;
        $this->userName = $userName;
        $this->email = $email;
        $this->registrationDate = $registrationDate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $loginUrl = route('campus.login');

        Log::info('Sending campus registration email to: ' . $this->email);

        return (new MailMessage)
            ->subject('Pendaftaran Kampus/Sekolah Berhasil - InotalHub')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('emails.campus_registration_success', [
                'userName' => $this->userName,
                'campusName' => $this->campusName,
                'email' => $this->email,
                'registrationDate' => $this->registrationDate,
                'loginUrl' => $loginUrl,
                'jenisInstitusi' => $notifiable->jenis_institusi, // ← tambahan penting
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'campus_name' => $this->campusName,
            'user_name' => $this->userName,
            'email' => $this->email,
            'registration_date' => $this->registrationDate,
        ];
    }
}