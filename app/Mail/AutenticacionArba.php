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

    public $email, $nombre, $password, $apellidos;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $nombre, $password, $apellidos)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->apellidos = $apellidos;
    }

    public function build()
    {
        return $this->to($this->email)
                    ->subject('Autenticación en ARBA')
                    ->markdown('emails.autenticacionarba')
                    ->with([
                        'nombre' => $this->nombre,
                        'password' => $this->password,
                        'apellidos' => $this->apellidos
                    ]);
    }
}
