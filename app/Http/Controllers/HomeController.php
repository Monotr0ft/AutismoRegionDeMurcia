<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $parrafo1 = Pagina::where('titulo', 'Home parrafo 1')->first();
        $parrafo2 = Pagina::where('titulo', 'Home parrafo 2')->first();
        return view('autismo.paginas.home', ['parrafo1' => $parrafo1, 'parrafo2' => $parrafo2]);
    }
}
