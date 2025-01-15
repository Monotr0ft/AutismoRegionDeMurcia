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
        $noticias = Noticia::all();
        return view('autismo.dashboard.paginas.noticias.index', ['noticias' => $noticias]);
    }

    public function store(Request $request)
    {
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->url = str_replace(['http://', 'https://'], '', $request->url);
        $noticia->fecha = $request->fecha;
        $newsletter = Newsletter::all();
        foreach ($newsletter as $email) {
            Mail::to($email->email)->send(new NotificacionNuevaNoticia($email->token));
        }
        $noticia->save();
        return redirect()->route('dashboard.noticias');
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::find($id);
        $noticia->titulo = $request->titulo;
        $noticia->url = str_replace(['http://', 'https://'], '', $request->url);
        $noticia->fecha = $request->fecha;
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
        $noticias = Noticia::all()->sortByDesc('fecha');
        return view('autismo.paginas.noticias', ['noticias' => $noticias]);
    }

}
