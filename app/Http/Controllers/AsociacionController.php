<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asociacion;
use App\Models\Newsletter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionNuevaAsociacion;

class AsociacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asociaciones = Asociacion::orderBy('nombre', 'asc')->get();
        return view('autismo.dashboard.paginas.asociaciones.index', ['asociaciones' => $asociaciones]);
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
        return redirect()->route('dashboard.asociaciones');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asociacion = Asociacion::find($id);
        if (!$asociacion) {
            return redirect()->route('dashboard.asociaciones');
        }
        return view('autismo.dashboard.paginas.asociaciones.show', ['asociacion' => $asociacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $asociacion = Asociacion::find($id);
        if ($asociacion) {
            $asociacion->nombre = $request->nombre;
            $asociacion->descripcion = $request->descripcion;
            $asociacion->telefono = $request->telefono;
            $asociacion->email = $request->email;
            $asociacion->web = $request->web;
            if ($request->nueva_direccion === '1') {
                $provincia = $request->input('provincia');
                $municipio = $request->input('municipio');
                $localidad = $request->input('localidad');
                $tipo_calle = $request->input('tipo_calle');
                $nombre_calle = $request->input('nombre_calle');
                $numero = $request->input('numero');
                if ($request->has('ampliacion')) {
                    $ampliacion = $request->input('ampliacion');
                }
                $municipioASCII = iconv('UTF-8', 'ASCII//TRANSLIT', $municipio);
                $localidadASCII = iconv('UTF-8', 'ASCII//TRANSLIT', $localidad);
                $codigo_postal = $request->input('codigo_postal');
                if ($ampliacion) {
                    if ($municipioASCII != $localidadASCII) {
                        $direccion = $tipo_calle . ' ' . $nombre_calle . ', ' . $numero . ', ' . $ampliacion . ', ' . $codigo_postal . ', ' . $localidad . ', ' . $municipio . ' (' . $provincia . ')';
                    }else {
                        $direccion = $tipo_calle . ' ' . $nombre_calle . ', ' . $numero . ', ' . $ampliacion . ', ' . $codigo_postal . ', ' . $municipio . ' (' . $provincia . ')';
                    }
                }else {
                    if ($municipioASCII != $localidadASCII) {
                        $direccion = $tipo_calle . ' ' . $nombre_calle . ', ' . $numero . ', ' . $codigo_postal . ', ' . $localidad . ', ' . $municipio . ' (' . $provincia . ')';
                    }else {
                        $direccion = $tipo_calle . ' ' . $nombre_calle . ', ' . $numero . ', ' . $codigo_postal . ', ' . $municipio . ' (' . $provincia . ')';
                    }
                }
                $asociacion->direccion = $direccion;
            }
            if ($request->hasFile('logo')) {
                if (File::exists(public_path($asociacion->logo))) {
                    File::delete(public_path($asociacion->logo));
                }
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
        return redirect()->route('dashboard.asociaciones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asociacion = Asociacion::find($id);
        if ($asociacion) {
            if (File::exists(public_path($asociacion->logo))) {
                File::delete(public_path($asociacion->logo));
            }
            $asociacion->delete();
        }
        return redirect()->route('dashboard.asociaciones');
    }

    public function getAsociaciones()
    {
        $asociaciones = Asociacion::where('publicar', true)->orderBy('nombre', 'asc')->get();
        return view('autismo.paginas.asociaciones', ['asociaciones' => $asociaciones]);
    }

    public function getCreate()
    {
        return view('autismo.paginas.asociaciones.create');
    }

    public function getEdit(string $id)
    {
        $asociacion = Asociacion::find($id);
        if (!$asociacion) {
            return redirect()->route('dashboard.asociaciones');
        }
        return view('autismo.dashboard.paginas.asociaciones.edit', ['asociacion' => $asociacion]);
    }

    public function publicar(string $id)
    {
        $asociacion = Asociacion::find($id);
        if ($asociacion) {
            $asociacion->publicar = 1;
            $newsletters = Newsletter::all();
            foreach ($newsletters as $email) {
                Mail::to($email->email)->send(new NotificacionNuevaAsociacion($asociacion, $email->token));
            }
            $asociacion->save();
        }
        return redirect()->route('dashboard.asociaciones');
    }

    public function ocultar(string $id)
    {
        $asociacion = Asociacion::find($id);
        if ($asociacion) {
            $asociacion->publicar = 0;
            $asociacion->save();
        }
        return redirect()->route('dashboard.asociaciones');
    }
}
