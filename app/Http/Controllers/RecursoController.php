<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionNuevoRecurso;
use App\Models\Newsletter;
use App\Models\Recurso;
use App\Models\Etiqueta;

class RecursoController extends Controller
{
    function index()
    {
        $recursos = Recurso::all();
        return view('autismo.dashboard.paginas.recursos.index', ['recursos' => $recursos]);
    }

    function store(Request $request)
    {
        $recurso = new Recurso();
        $recurso->titulo = $request->titulo;
        $recurso->descripcion = $request->descripcion;
        if ($request->url) {
            $recurso->url = str_replace(['http://', 'https://'], '', $request->url);
        } else {
            $recurso->url = null;
        }
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombre = $request->titulo . '.pdf';
            $archivo->storeAs('public/archivos', $nombre);
            if (!File::exists(public_path('assets/archivos'))) {
                File::makeDirectory(public_path('assets/archivos'), 0777, true);
            }
            File::move(storage_path('app/public/archivos/' . $nombre), public_path('assets/archivos/' . $nombre));
            $recurso->archivo = 'assets/archivos/' . $nombre;
        }else {
            $recurso->archivo = null;
        }
        $recurso->save();

        if ($request->has('etiquetas')) {
            $recurso->etiquetas()->sync($request->etiquetas);
        }

        $newsletter = Newsletter::all();
        foreach($newsletter as $email) {
            Mail::to($email->email)->send(new NotificacionNuevoRecurso($email->token));
        }

        return redirect()->route('dashboard.recursos');
    }

    function update(Request $request, $id)
    {
        $recurso = Recurso::find($id);
        $recurso->titulo = $request->titulo;
        $recurso->descripcion = $request->descripcion;
        if ($request->url) {
            $recurso->url = str_replace(['http://', 'https://'], '', $request->url);
        } else {
            $recurso->url = null;
        }
        if ($request->hasFile('archivo')) {
            if ($recurso->archivo) {
                File::delete(public_path($recurso->archivo));
            }
            $archivo = $request->file('archivo');
            $nombre = $request->titulo . '.pdf';
            $archivo->storeAs('public/archivos', $nombre);
            if (!File::exists(public_path('assets/archivos'))) {
                File::makeDirectory(public_path('assets/archivos'), 0777, true);
            }
            File::move(storage_path('app/public/archivos/' . $nombre), public_path('assets/archivos/' . $nombre));
            $recurso->archivo = 'assets/archivos/' . $nombre;
        }
        $recurso->save();

        if ($request->has('etiquetas')) {
            $recurso->etiquetas()->sync($request->etiquetas);
        }
        return redirect()->route('dashboard.recursos');
    }

    function destroy($id)
    {
        $recurso = Recurso::find($id);
        if ($recurso) {
            if ($recurso->archivo) {
                File::delete(public_path($recurso->archivo));
            }
            $recurso->delete();
        }
        return redirect()->route('dashboard.recursos');
    }

    function getCreate()
    {
        $etiquetas = Etiqueta::all()->sortBy('nombre');
        return view('autismo.dashboard.paginas.recursos.create', ['etiquetas' => $etiquetas]);
    }

    function getEdit($id)
    {
        $etiquetas = Etiqueta::all()->sortBy('nombre');
        $recurso = Recurso::find($id);
        return view('autismo.dashboard.paginas.recursos.edit', ['etiquetas' => $etiquetas, 'recurso' => $recurso]);
    }

    function getRecursos()
    {
        $recursos = Recurso::all();
        $etiquetas = Etiqueta::all()->sortBy('nombre');
        return view('autismo.paginas.recursos', ['recursos' => $recursos, 'etiquetas' => $etiquetas]);
    }
}
