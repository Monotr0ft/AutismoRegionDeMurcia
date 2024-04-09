<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asociacion;

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
        //
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

}
