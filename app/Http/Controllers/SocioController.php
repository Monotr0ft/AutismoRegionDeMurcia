<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\DireccionArba;
use App\Models\ArbaUser;
use Illuminate\Support\Facades\Hash;

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
        $socio = new Socio;
        $direccion = new DireccionArba;

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

        return redirect('/arba/socio');

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

    public function getUser() {
        $socios = Socio::whereNull('user_id')->get();
        return view('arba.socio.user', ['socios' => $socios]);
    }

    public function postUser() {
        $socio = Socio::find(request('socio_id'));
        $user = new ArbaUser;
        $user->name = $socio->nombre;
        $user->email = $socio->email;
        $user->password = Hash::make(request('contraseña'));
        $user->save();
        $socio->user_id = $user->id;
        $socio->save();
        return redirect('/arba/dashboard');
    }

}
