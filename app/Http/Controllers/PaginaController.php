<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;

class PaginaController extends Controller
{
    public function index()
    {
        $paginas = Pagina::all();
        return view('autismo.dashboard.paginas.paginas.index', ['paginas' => $paginas]);
    }

    public function show($id)
    {
        $pagina = Pagina::find($id);
        if (!$pagina) {
            return redirect()->route('dashboard.paginas');
        }
        return view('autismo.dashboard.paginas.paginas.show', ['pagina' => $pagina]);
    }

    public function getCreate()
    {
        return view('autismo.dashboard.paginas.paginas.create');
    }

    public function getEdit($id)
    {
        $pagina = Pagina::find($id);
        if (!$pagina) {
            return redirect()->route('dashboard.paginas');
        }
        return view('autismo.dashboard.paginas.paginas.edit', ['pagina' => $pagina]);
    }

    public function store(Request $request)
    {
        $pagina = new Pagina();
        $pagina->titulo = $request->titulo;
        $pagina->contenido = $request->contenido;
        $pagina->save();
        return redirect()->route('dashboard.paginas');
    }

    public function edit($id, Request $request)
    {
        $pagina = Pagina::find($id);
        if ($pagina) {
            $pagina->titulo = $request->titulo;
            $pagina->contenido = $request->contenido;
            $pagina->save();
        }
        return redirect()->route('dashboard.paginas');
    }

    public function delete($id)
    {
        $pagina = Pagina::find($id);
        if ($pagina) {
            $pagina->delete();
        }
        return redirect()->route('dashboard.paginas');
    }

    public function arm()
    {
        $pagina = Pagina::where('id', 1)->first();
        return view('autismo.paginas.queesarm', ['pagina' => $pagina]);
    }

    public function autismo()
    {
        $pagina = Pagina::where('id', 2)->first();
        return view('autismo.paginas.queesautismo', ['pagina' => $pagina]);
    }

}
