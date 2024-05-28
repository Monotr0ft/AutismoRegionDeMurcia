<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionNuevaAsociacion extends Mailable
{
    use Queueable, SerializesModels;

    public $asociacion, $token;

    /**
     * Create a new message instance.
     */
    public function __construct($asociacion, $token)
    {
        $this->asociacion = $asociacion;
        $this->token = $token;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'ARM')
            ->subject('¡Hay una nueva asociación disponible!')
            ->view('emails.notificacionnuevaasociacion')
            ->with([
                'url' => env('APP_URL') . '/asociaciones',
                'asociacion' => $this->asociacion,
                'token' => $this->token,
            ]);
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
