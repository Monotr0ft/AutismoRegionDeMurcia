<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribe;

class NewsletterController extends Controller
{
    
    public function store(Request $request)
    {
        //try {
            $request->validate([
                'email' => 'required|email|unique:newsletters,email'
            ]);
    
            $newsletter = new Newsletter();
    
            $newsletter->email = $request->email;

            Mail::to($request->email)->send(new NewsletterSubscribe());
    
            $newsletter->save();
    
            return redirect()->back()->with('success', '¡Gracias por suscribirte a nuestro boletín!');
        /*}catch (\Exception $e) {
            return redirect()->back()->withErrors('¡Ha ocurrido un error! Por favor, intenta de nuevo.');
        }*/
    }

}
