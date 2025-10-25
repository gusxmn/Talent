<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    // Properti untuk menyimpan data dari formulir
    public $data;

    /**
     * Buat instance pesan baru.
     *
     * @param array $data Data formulir kontak
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Dapatkan amplop pesan.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Subjek email akan menggunakan subjek dari formulir
            subject: 'Pesan Baru dari Formulir Kontak: ' . $this->data['subject'],
            // Alamat Balasan diatur ke email pengirim dari formulir
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->data['email'], $this->data['name']),
            ],
        );
    }

    /**
     * Dapatkan definisi konten pesan.
     */
    public function content(): Content
    {
        return new Content(
            // Menggunakan template Blade untuk tampilan email
            markdown: 'emails.contact-us',
            // Variabel 'data' yang akan dikirim ke template email
            with: [
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
                'subject' => $this->data['subject'],
                'msg' => $this->data['message'],
            ],
        );
    }

    /**
     * Dapatkan attachment untuk pesan.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
