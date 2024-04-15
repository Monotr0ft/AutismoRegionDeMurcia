<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asociacion;
use Illuminate\Support\Facades\File;

class AsociacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asociaciones = Asociacion::where('publicar', true)->get();
        return view('autismo.paginas.asociaciones', ['asociaciones' => $asociaciones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asociacion = new Asociacion();
        $asociacion->nombre = $request->nombre;
        $asociacion->descripcion = $request->descripcion;
        $asociacion->direccion = $request->direccion;
        $asociacion->telefono = $request->telefono;
        $asociacion->email = $request->email;
        $asociacion->web = $request->web;
        $asociacion->publicar = 0;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $nombre = time() . $logo->getClientOriginalName();
            $logo->storeAs('public/logos', $nombre);
            if (!File::exists(public_path('assets/img/logos'))) {
                File::makeDirectory(public_path('assets/img/logos'), 0777, true);
            }
            File::move(storage_path('app/public/logos/' . $nombre), public_path('assets/img/logos/' . $nombre));
            $asociacion->logo = 'assets/img/logos/' . $nombre;
        }
        if ($request->regional == 1) {
            $asociacion->es_regional = 1;
        } else {
            $asociacion->es_regional = 0;
        }
        if ($request->has('redes_sociales')) {
            $redes_sociales = $request->input('redes_sociales');
            foreach ($redes_sociales as $key => $url) {
                $redes_sociales[$key] = str_replace(['https://', 'http://'], '', $url);
            }
            $asociacion->redes_sociales = json_encode($redes_sociales);
        }
        $asociacion->save();
        return redirect()->route('asociaciones');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getCreate()
    {
        return view('autismo.paginas.asociaciones.create');
    }

}
