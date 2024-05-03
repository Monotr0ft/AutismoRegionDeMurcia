<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperarContrasenia extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre, $apellidos, $token;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $apellidos, $token)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recuperar Contrasenia',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.recuperarcontrasenia',
            with: [
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'url' => url('/arba/cambiocontrasenia/' . $this->token),
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
