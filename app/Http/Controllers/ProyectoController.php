<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\File;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('arba.dashboard.proyecto.index', ['proyectos' => $proyectos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $proyecto = new Proyecto();
            $proyecto->nombre = $request->nombre;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $nombre = time() . $logo->getClientOriginalName();
                $logo->storeAs('public/logosArba', $nombre);
                if (!File::exists(public_path('assets/img/logosArba'))) {
                    File::makeDirectory(public_path('assets/img/logosArba'), 0777, true);
                }
                File::move(storage_path('app/public/logosArba/' . $nombre), public_path('assets/img/logosArba/' . $nombre));
                $proyecto->logo = 'assets/img/logosArba/' . $nombre;
            }
            $proyecto->ubicacion = $request->ubicacion;
            $proyecto->coordenadas = $request->coordenadas;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->save();
            return redirect('/arba/proyecto')->with('success', 'Proyecto creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el proyecto');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect('/arba/proyecto')->with('error', 'Proyecto no encontrado');
        }
        return view('arba.dashboard.proyecto.show', ['proyecto' => $proyecto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect('/arba/proyecto')->with('error', 'Proyecto no encontrado');
        }
        try {
            $proyecto->nombre = $request->nombre;
            if ($request->hasFile('logo')) {
                if ($proyecto->logo) {
                    File::delete(public_path($proyecto->logo));
                }
                $logo = $request->file('logo');
                $nombre = time() . $logo->getClientOriginalName();
                $logo->storeAs('public/logosArba', $nombre);
                if (!File::exists(public_path('assets/img/logosArba'))) {
                    File::makeDirectory(public_path('assets/img/logosArba'), 0777, true);
                }
                File::move(storage_path('app/public/logosArba/' . $nombre), public_path('assets/img/logosArba/' . $nombre));
                $proyecto->logo = 'assets/img/logosArba/' . $nombre;
            }
            $proyecto->ubicacion = $request->ubicacion;
            $proyecto->coordenadas = $request->coordenadas;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->save();
            return redirect('/arba/proyecto')->with('success', 'Proyecto actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el proyecto');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect()->back()->with('error', 'Proyecto no encontrado');
        }
        if ($proyecto->logo) {
            File::delete(public_path($proyecto->logo));
        }
        $proyecto->delete();
        return redirect()->back()->with('success', 'Proyecto eliminado correctamente');
    }

    public function getCreate()
    {
        return view('arba.dashboard.proyecto.create');
    }

    public function getEdit(string $id)
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return redirect('/arba/proyecto')->with('error', 'Proyecto no encontrado');
        }
        return view('arba.dashboard.proyecto.edit', ['proyecto' => $proyecto]);
    }
}
