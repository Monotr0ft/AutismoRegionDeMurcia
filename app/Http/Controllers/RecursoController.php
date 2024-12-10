<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;
use App\Models\Etiqueta;

class RecursoController extends Controller
{
    function index()
    {
        $recursos = Recurso::all();
        return view('autismo.dashboard.paginas.recursos.index', ['recursos' => $recursos]);
    }

    function show($id)
    {
        $recurso = Recurso::find($id);
        return view('autismo.dashboard.paginas.recursos.show', ['recurso' => $recurso]);
    }

    function store(Request $request)
    {
        $recurso = new Recurso();
        $recurso->titulo = $request->titulo;
        switch ($request->tipo) {
            case 'urlTipo':
                $recurso->url = str_replace(['http://', 'https://'], '', $request->url);
                break;
            case 'archivoTipo':
                $recurso->archivo = $request->archivo;
                break;
        }
        $recurso->save();

        if ($request->has('etiquetas')) {
            $recurso->etiquetas()->sync($request->etiquetas);
        }

        return redirect()->route('dashboard.recursos');
    }

    function update(Request $request, $id)
    {
        $recurso = Recurso::find($id);
        // TODO - Implementar la lógica para actualizar un recurso
        return redirect()->route('dashboard.recursos');
    }

    function destroy($id)
    {
        $recurso = Recurso::find($id);
        if ($recurso) {
            $recurso->delete();
        }
        return redirect()->route('dashboard.recursos');
    }

    function getCreate()
    {
        $etiquetas = Etiqueta::all();
        return view('autismo.dashboard.paginas.recursos.create', ['etiquetas' => $etiquetas]);
    }

    function getEdit($id)
    {
        $etiquetas = Etiqueta::all();
        $recurso = Recurso::find($id);
        return view('autismo.dashboard.paginas.recursos.edit', ['etiquetas' => $etiquetas, 'recurso' => $recurso]);
    }

    function getRecursos()
    {
        $recursos = Recurso::all();
        $etiquetas = Etiqueta::all();
        return view('autismo.paginas.recursos', ['recursos' => $recursos, 'etiquetas' => $etiquetas]);
    }
}
