<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre, $asunto, $mensaje, $email;

    public function __construct($nombre, $asunto, $mensaje, $email = null)
    {
        $this->nombre = $nombre;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
        $this->email = $email;
    }

    public function build()
    {
        if ($this->email) {
            return $this->from(env('MAIL_FROM_ADDRESS'), $this->nombre)
                ->subject($this->asunto)
                ->view('emails.contactoemail')
                ->with([
                    'nombre' => $this->nombre,
                    'email' => $this->email,
                    'mensaje' => $this->mensaje,
                ]);
        }else {
            return $this->from(env('MAIL_FROM_ADDRESS'), 'ARM')
                ->subject($this->asunto)
                ->view('emails.contactoemail')
                ->with([
                    'nombre' => $this->nombre,
                    'mensaje' => $this->mensaje,
                ]);
        }
    }
}
