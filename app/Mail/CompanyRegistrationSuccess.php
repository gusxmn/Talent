<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyRegistrationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $company;

    /**
     * Create a new message instance.
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('noreply@inotalhub.com', 'InotalHub')
                    ->subject('Pendaftaran Perusahaan Berhasil - InotalHub')
                    ->view('emails.company_registration_success')
                    ->with([
                        'companyName' => $this->company->nama_perusahaan,
                        'userName' => $this->company->nama_lengkap,
                        'email' => $this->company->email,
                        'loginUrl' => url('/login-perusahaan'),
                        'registrationDate' => $this->company->created_at->format('d F Y'),
                    ]);
    }
}