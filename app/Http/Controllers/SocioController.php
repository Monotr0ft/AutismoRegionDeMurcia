<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Socio;
use App\Models\DireccionArba;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $socio = new Socio;
        $direccion = new DireccionArba;

        $socio->nombre = $request->nombre;
        $socio->apellido1 = $request->apellido_1;
        $socio->apellido2 = $request->apellido_2;
        $socio->dni = $request->dni;
        $socio->telefono = $request->telefono;
        $socio->email = $request->email;
        $socio->fecha_alta = $request->fecha_alta;
        if($request->junta_directiva === "on"){
            $socio->junta_directiva = 1;
            $socio->posicion = $request->cargo;
        }else {
            $socio->junta_directiva = 0;
        }

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

        $socio->save();

        return redirect('/arba/dashboard');

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
        return view('arba.socio.create');
    }

}
