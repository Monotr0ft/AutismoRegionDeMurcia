<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\ContactoMail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('autismo.paginas.contacto');
    }

    public function send(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json()['success']) {
            return back()->withErrors(['captcha' => 'Captcha inválido'])->withInput();
        }

        $nombre = $request->name;
        $asunto = $request->subject;
        $email = $request->email;
        $mensaje = $request->message;

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactoMail($nombre, $asunto, $mensaje, $email));
            return back()->with('success', 'Mensaje enviado correctamente. Te contactaremos pronto.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.'])->withInput();
        }
    }
}
