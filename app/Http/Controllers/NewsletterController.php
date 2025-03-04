<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribe;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:newsletters,email'
            ]);
    
            $newsletter = new Newsletter();
    
            $newsletter->email = $request->email;

            $newsletter->token = Str::random(60);

            Mail::to($request->email)->send(new NewsletterSubscribe($newsletter->token));
    
            $newsletter->save();
    
            return redirect()->back()->with('success', '¡Gracias por suscribirte a nuestro boletín!');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['newsletter_error' => '¡Ha ocurrido un error! Por favor, intenta de nuevo.']);
        }
    }

    public function unsubscribe($token)
    {
        $newsletter = Newsletter::where('token', $token)->first();

        if ($newsletter) {
            $newsletter->delete();
            return redirect()->route('home')->with('success', '¡Te has desuscripto correctamente!');
        }

        return redirect()->route('home')->withErrors('¡Ha ocurrido un error! Por favor, intenta de nuevo.');
    }

}
