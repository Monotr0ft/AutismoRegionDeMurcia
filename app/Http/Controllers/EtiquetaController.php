<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiqueta;

class EtiquetaController extends Controller
{  
    function index()
    {
        $etiquetas = Etiqueta::all()->sortBy('nombre');
        return view('autismo.dashboard.paginas.etiquetas.index', ['etiquetas' => $etiquetas]);
    }

    function store(Request $request)
    {
        $etiqueta = new Etiqueta();
        $etiqueta->nombre = $request->nombre;
        $etiqueta->save();
        return redirect()->route('dashboard.etiquetas');
    }

    function update(Request $request, $id)
    {
        $etiqueta = Etiqueta::find($id);
        $etiqueta->nombre = $request->nombre;
        $etiqueta->save();
        return redirect()->route('dashboard.etiquetas');
    }

    function destroy($id)
    {
        $etiqueta = Etiqueta::find($id);
        if ($etiqueta) {
            $etiqueta->delete();
        }
        return redirect()->route('dashboard.etiquetas');
    }

    function getCreate()
    {
        return view('autismo.dashboard.paginas.etiquetas.create');
    }

    function getEdit($id)
    {
        $etiqueta = Etiqueta::find($id);
        if (!$etiqueta) {
            return redirect()->route('dashboard.etiquetas');
        }
        return view('autismo.dashboard.paginas.etiquetas.edit', ['etiqueta' => $etiqueta]);
    }
}
