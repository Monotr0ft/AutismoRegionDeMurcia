<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserEdit extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $razon, $admin;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $razon, $admin)
    {
        $this->user = $user;
        $this->razon = $razon;
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'ARM')
            ->subject('Se ha editado una cuenta de usuario')
            ->view('emails.usuarioeditado')
            ->with([
                'user' => $this->user,
                'razon' => $this->razon,
                'admin' => $this->admin,
            ])
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()
                    ->addTextHeader('Content-Type', 'text/html');
            });
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
