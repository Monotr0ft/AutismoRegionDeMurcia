<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\DireccionArba;
use App\Models\ArbaUser;
use Illuminate\Support\Facades\Hash;
use App\Mail\AutenticacionArba;
use Illuminate\Support\Facades\Mail;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socios = Socio::with('direccionArba')->get();
        return view('arba.socio.index', ['socios' => $socios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //try {
            $socio = new Socio;

            $socio->nombre = $request->nombre;
            $socio->apellido1 = $request->apellido_1;
            $socio->apellido2 = $request->apellido_2;
            $socio->dni = $request->dni;
            $socio->telefono = $request->telefono;
            $socio->email = $request->email;
            $socio->fecha_alta = $request->fecha_alta;
            if($request->juntaDirectiva === "on"){
                $socio->junta_directiva = 1;
                $socio->posicion = $request->cargo;
            }else {
                $socio->junta_directiva = 0;
            }

            if ($request->direcciones == 0) {
                $direccion = new DireccionArba;
                $direccion->tipo_via = $request->tipo_calle;
                $direccion->nombre_via = $request->nombre_calle;
                $direccion->numero = $request->numero;
                $direccion->ampliacion = $request->ampliacion;
                $direccion->codigo_postal = $request->codigo_postal;
                $direccion->municipio = $request->municipio;
                $direccion->localidad = $request->localidad;
                $direccion->provincia = $request->provincia;
                $direccion->save();
                $socio->direccion = $direccion->id;
            }else {
                $socio->direccion = $request->direcciones;
            }
            if ($request->acceso_web === "on") {
                $socio->acceso_web = 1;
                $user = new ArbaUser;
                $user->name = $socio->nombre;
                $user->email = $socio->email;
                $user->password = Hash::make($request->password);
                Mail::send(new AutenticacionArba($socio->email, $socio->nombre, request('contraseña'), $socio->apellido1.' '.$socio->apellido2));
                $user->save();
                $socio->user_id = $user->id;
                if ($request->administracion === "on") {
                    $socio->administracion = 1;
                }
                if ($request->vivero === "on") {
                    $socio->vivero = 1;
                }
                if ($request->partes_trabajo === "on") {
                    $socio->partes_trabajo = 1;
                }
            }else {
                $socio->acceso_web = 0;
            }

            $socio->save();

            return redirect('/arba/socio');
        //} catch (\Exception $e) {
            //return redirect('/arba/socio/create');
        //}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $socio = Socio::with('direccionArba')->find($id);
        if (!$socio) {
            return redirect('/arba/socio');
        }
        return view('arba.socio.show', ['socio' => $socio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $socio = Socio::find($id);

            $socio->nombre = $request->nombre;
            $socio->apellido1 = $request->apellido_1;
            $socio->apellido2 = $request->apellido_2;
            $socio->dni = $request->dni;
            $socio->telefono = $request->telefono;
            $socio->email = $request->email;
            $socio->fecha_alta = $request->fecha_alta;
            if($request->juntaDirectiva === "on"){
                $socio->junta_directiva = 1;
                $socio->posicion = $request->cargo;
            }else {
                $socio->junta_directiva = 0;
            }
            if ($request->estado === "on") {
                $socio->activo = 1;
            }else {
                $socio->activo = 0;
                $socio->fecha_baja = $request->fecha_baja;
            }
            if ($request->acceso_web === "on") {
                $socio->acceso_web = 1;
            }else {
                $socio->acceso_web = 0;
            }
            if ($request->administracion === "on") {
                $socio->administracion = 1;
            }else {
                $socio->administracion = 0;
            }
            if ($request->vivero === "on") {
                $socio->vivero = 1;
            }else {
                $socio->vivero = 0;
            }
            if ($request->partes_trabajo === "on") {
                $socio->partes_trabajo = 1;
            }else {
                $socio->partes_trabajo = 0;
            }
            if ($request->direcciones == 0) {
                $direccion = new DireccionArba;
                $direccion->tipo_via = $request->tipo_calle;
                $direccion->nombre_via = $request->nombre_calle;
                $direccion->numero = $request->numero;
                $direccion->ampliacion = $request->ampliacion;
                $direccion->codigo_postal = $request->codigo_postal;
                $direccion->municipio = $request->municipio;
                $direccion->localidad = $request->localidad;
                $direccion->provincia = $request->provincia;
                $direccion->save();
                $socio->direccion = $direccion->id;
            }else {
                $socio->direccion = $request->direcciones;
            }

            $socio->save();

            return redirect('/arba/socio');
        } catch (\Exception $e) {
            return redirect('/arba/socio/edit/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socio = Socio::find($id);
        if ($socio->user_id) {
            $user = ArbaUser::find($socio->user_id);
            $user->delete();
        }
        $socio->delete();
        return redirect('/arba/socio');
    }

    public function getCreate()
    {
        $direcciones = DireccionArba::all();
        return view('arba.socio.create', ['direcciones' => $direcciones]);
    }

    public function getEdit(string $id) {
        $socio = Socio::with('direccionArba')->find($id);
        if (!$socio) {
            return redirect('/arba/socio');
        }
        $direcciones = DireccionArba::all();
        return view('arba.socio.edit', ['socio' => $socio, 'direcciones' => $direcciones]);
    }

    public function getUser() {
        $socios = Socio::whereNull('user_id')->get();
        return view('arba.socio.user', ['socios' => $socios]);
    }

    public function postUser() {
        $socio = Socio::find(request('socio_id'));
        if (!$socio) {
            return redirect('/arba/socio/usuario');
        }
        $user = new ArbaUser;
        $user->name = $socio->nombre;
        $user->email = $socio->email;
        $user->password = Hash::make(request('contraseña'));
        Mail::send(new AutenticacionArba($socio->email, $socio->nombre, request('contraseña'), $socio->apellido1.' '.$socio->apellido2));
        $user->save();
        $socio->user_id = $user->id;
        $socio->acceso_web = 1;
        $socio->save();
        return redirect('/arba/socio');
    }

}
