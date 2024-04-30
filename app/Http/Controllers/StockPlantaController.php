<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use App\Models\StockPlanta;
use App\Models\Planta;
use App\Models\Ubicacion;
use App\Models\Contenedor;
use DateTime;
use DateInterval;

class StockPlantaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock_plantas = StockPlanta::all();
        return view('arba.stock.index', ['stock_plantas' => $stock_plantas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stock_planta = new StockPlanta();
        $stock_planta->planta_id = $request->planta;
        $stock_planta->lugar_id = $request->lugar;
        $stock_planta->ubicacion_id = $request->ubicacion;
        $stock_planta->contenedor_id = $request->contenedor;
        $stock_planta->fecha_planta = $request->fecha_planta;
        $fecha_planta = new DateTime($request->fecha_planta);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_planta->diff($fecha_actual);
        $stock_planta->savia = floor($diferencia->y);
        $stock_planta->stock = $request->stock;
        $stock_planta->save();
        return redirect()->route('arba.stock');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock_planta = StockPlanta::find($id);
        if (!$stock_planta) {
            return redirect()->route('arba.stock');
        }
        return view('arba.stock.show', ['stock_planta' => $stock_planta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stock_planta = StockPlanta::find($id);
        if ($stock_planta) {
            $stock_planta->planta_id = $request->planta;
            $stock_planta->lugar_id = $request->lugar;
            $stock_planta->ubicacion_id = $request->ubicacion;
            $stock_planta->contenedor_id = $request->contenedor;
            $stock_planta->fecha_planta = $request->fecha_planta;
            $fecha_planta = new DateTime($request->fecha_planta);
            $fecha_actual = new DateTime();
            $diferencia = $fecha_planta->diff($fecha_actual);
            $stock_planta->savia = floor($diferencia->y);
            $stock_planta->stock = $request->stock;
            $stock_planta->save();
        }
        return redirect()->route('arba.stock');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock_planta = StockPlanta::find($id);
        if ($stock_planta) {
            $stock_planta->delete();
        }
        return redirect()->route('arba.stock');
    }

    public function getCreate()
    {
        $plantas = Planta::all();
        $lugares = Lugar::all();
        $ubicaciones = Ubicacion::all();
        $contenedores = Contenedor::all();
        return view('arba.stock.create', ['plantas' => $plantas, 'lugares' => $lugares, 'ubicaciones' => $ubicaciones, 'contenedores' => $contenedores]);
    }

    public function getEdit(string $id)
    {
        $stock_planta = StockPlanta::find($id);
        if (!$stock_planta) {
            return redirect()->route('arba.stock');
        }
        $plantas = Planta::all();
        $lugares = Lugar::all();
        $ubicaciones = Ubicacion::all();
        $contenedores = Contenedor::all();
        return view('arba.stock.edit', ['stock_planta' => $stock_planta, 'plantas' => $plantas, 'lugares' => $lugares, 'ubicaciones' => $ubicaciones, 'contenedores' => $contenedores]);
    }
}
