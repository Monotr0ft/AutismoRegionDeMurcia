<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsociacionNueva;
use App\Models\Asociacion;
use Illuminate\Support\Facades\File;

class AsociacionNuevaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asociaciones = AsociacionNueva::all();
        return view('autismo.dashboard.paginas.asociacionesnuevas.index', ['asociaciones' => $asociaciones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asociacion = new AsociacionNueva();
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
        $asociacion = AsociacionNueva::find($id);
        if (!$asociacion) {
            return redirect()->route('dashboard.asociacionesnuevas');
        }
        return view('autismo.dashboard.paginas.asociacionesnuevas.show', ['asociacion' => $asociacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $asociacion = AsociacionNueva::find($id);
        if ($asociacion) {
            $asociacion->nombre = $request->nombre;
            $asociacion->descripcion = $request->descripcion;
            $asociacion->direccion = $request->direccion;
            $asociacion->telefono = $request->telefono;
            $asociacion->email = $request->email;
            $asociacion->web = $request->web;
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
            if ($request->es_regional == 1) {
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
        }
        return redirect()->route('dashboard.asociacionesnuevas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asociacion = AsociacionNueva::find($id);
        if ($asociacion) {
            $asociacion->delete();
        }
        return redirect()->route('dashboard.asociacionesnuevas');
    }

    public function getEdit(string $id)
    {
        $asociacion = AsociacionNueva::find($id);
        if (!$asociacion) {
            return redirect()->route('dashboard.asociacionesnuevas');
        }
        return view('autismo.dashboard.paginas.asociacionesnuevas.edit', ['asociacion' => $asociacion]);
    }

    public function publicar(string $id)
    {
        $asociacionNueva = AsociacionNueva::find($id);
        if ($asociacionNueva) {
            $asociacionNueva->publicar = 1;
            $asociacionNueva->save();
        }
        $asociacion = new Asociacion();
        $asociacion->nombre = $asociacionNueva->nombre;
        $asociacion->descripcion = $asociacionNueva->descripcion;
        $asociacion->direccion = $asociacionNueva->direccion;
        $asociacion->telefono = $asociacionNueva->telefono;
        $asociacion->email = $asociacionNueva->email;
        $asociacion->web = $asociacionNueva->web;
        $asociacion->logo = $asociacionNueva->logo;
        $asociacion->es_regional = $asociacionNueva->es_regional;
        $asociacion->redes_sociales = $asociacionNueva->redes_sociales;
        $asociacion->publicar = 1;
        $asociacion->save();
        $asociacionNueva->delete();
        return redirect()->route('dashboard.asociacionesnuevas');
    }
    
    public function ocultar(string $id)
    {
        $asociacionNueva = AsociacionNueva::find($id);
        if ($asociacionNueva) {
            $asociacionNueva->publicar = 0;
            $asociacionNueva->save();
        }
        return redirect()->route('dashboard.asociacionesnuevas');
    }
}
