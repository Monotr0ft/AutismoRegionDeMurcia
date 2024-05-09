<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificarEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre, $apellidos, $email;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $apellidos, $email)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verificar Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.verificaremail',
            with: [
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'url' => url('/arba/verificaremail/' . $this->email),
            ],
        );
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
