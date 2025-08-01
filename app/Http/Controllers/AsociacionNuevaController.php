<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsociacionNueva;
use App\Models\Asociacion;
use App\Models\Newsletter;
use App\Mail\NotificacionNuevaAsociacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
use Illuminate\Support\Facades\Http;

class AsociacionNuevaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asociaciones = AsociacionNueva::orderBy('nombre', 'asc')->get();
        return view('autismo.dashboard.paginas.asociacionesnuevas.index', ['asociaciones' => $asociaciones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json()['success']) {
            return back()->withErrors(['captcha' => 'Captcha inválido'])->withInput();
        }
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
        $asociacion = new AsociacionNueva();
        $asociacion->nombre = $request->nombre;
        $asociacion->descripcion = $request->descripcion;
        if ($request->has('telefono')) {
            $telefono = $request->telefono;
            // Quitar espacios y convertir a número
            $telefonoSinEspacios = str_replace(' ', '', (string)$telefono);
            $asociacion->telefono = is_numeric($telefonoSinEspacios) ? (int)$telefonoSinEspacios : 0;
        } else {
            $asociacion->telefono = 0;
        }
        $asociacion->direccion = $direccion;
        $asociacion->email = $request->email;
        $asociacion->web = str_replace(['https://', 'http://'], '', $request->web);
        $asociacion->publicar = 0;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $nombre = $logo->getClientOriginalName();
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
            if ($request->has('telefono')) {
                $telefono = $request->telefono;
                // Quitar espacios y convertir a número
                $telefonoSinEspacios = str_replace(' ', '', (string)$telefono);
                $asociacion->telefono = is_numeric($telefonoSinEspacios) ? (int)$telefonoSinEspacios : 0;
            } else {
                $asociacion->telefono = 0;
            }
            $asociacion->email = $request->email;
            $asociacion->web = $request->web;
            if ($request->nueva_direccion === "1") {
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
                if ($asociacion->logo) {
                    File::delete(public_path($asociacion->logo));
                }
                $logo = $request->file('logo');
                $nombre = $logo->getClientOriginalName();
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
            if ($asociacion->logo) {
                File::delete(public_path($asociacion->logo));
            }
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
        $newsletter = Newsletter::all();
        foreach ($newsletter as $email) {
            Mail::to($email->email)->send(new NotificacionNuevaAsociacion($asociacion, $email->token));
        }
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
