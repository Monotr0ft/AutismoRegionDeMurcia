<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Mail\NotificacionNuevaNoticia;
use Illuminate\Support\Facades\Mail;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::all()->sortByDesc('fecha');
        return view('autismo.dashboard.paginas.noticias.index', ['noticias' => $noticias]);
    }

    public function store(Request $request)
    {
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->url = str_replace(['http://', 'https://'], '', $request->url);
        $noticia->fecha = $request->fecha;
        $noticia->comentario = $request->comentario ?? null;
        $noticia->publicar = false; // Default value for 'publicar'
        $noticia->save();
        return redirect()->route('dashboard.noticias');
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::find($id);
        $noticia->titulo = $request->titulo;
        $noticia->url = str_replace(['http://', 'https://'], '', $request->url);
        $noticia->fecha = $request->fecha;
        $noticia->comentario = $request->comentario ?? null;
        $noticia->save();
        return redirect()->route('dashboard.noticias');
    }

    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        if ($noticia) {
            $noticia->delete();
        }
        return redirect()->route('dashboard.noticias');
    }   

    public function getCreate()
    {
        return view('autismo.dashboard.paginas.noticias.create');
    }

    public function getEdit($id)
    {
        $noticia = Noticia::find($id);
        if (!$noticia) {
            return redirect()->route('dashboard.noticias');
        }
        return view('autismo.dashboard.paginas.noticias.edit', ['noticia' => $noticia]);
    }

    public function getNoticias()
    {
        $noticias = Noticia::all()->where('publicar', true)->sortByDesc('fecha');
        return view('autismo.paginas.noticias', ['noticias' => $noticias]);
    }

    public function publicar($id)
    {
        $noticia = Noticia::find($id);
        if ($noticia) {
            $noticia->publicar = true;
            $noticia->save();
        }
        $newsletter = Newsletter::all();
        foreach ($newsletter as $email) {
            Mail::to($email->email)->send(new NotificacionNuevaNoticia($email->token));
        }
        return redirect()->route('dashboard.noticias');
    }

    public function ocultar($id)
    {
        $noticia = Noticia::find($id);
        if ($noticia) {
            $noticia->publicar = false;
            $noticia->save();
        }
        return redirect()->route('dashboard.noticias');
    }

}
