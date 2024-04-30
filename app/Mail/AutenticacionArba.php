<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class AutenticacionArba extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($email ,$user)
    {
        $this->email = $email;
        $this->user = $user;
    }

    public function build()
    {
        return $this->from('info@arba.es', 'ARBA')
                    ->to($this->email)
                    ->subject('Autenticación en ARBA')
                    ->markdown('emails.autenticacionarba');
    }
}
