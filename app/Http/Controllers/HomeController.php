<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;
use DOMDocument;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $parrafo1 = Pagina::where('titulo', '¿Qué es Autismo Región de Murcia?')->first();
        $parrafo2 = Pagina::where('titulo', '¿Qué es el Autismo?')->first();

        $primerParrafo = $this->extraerPrimerParrafoConContenido($parrafo1->contenido);
        $segundoParrafo = $this->extraerPrimerParrafoConContenido($parrafo2->contenido);

        return view('autismo.paginas.home', ['parrafo1' => $primerParrafo, 'parrafo2' => $segundoParrafo]);
    }

    /**
     * Extrae el primer párrafo con contenido de un texto HTML.
     *
     * @param string $html El contenido HTML del que se extraerá el primer párrafo.
     * @return string El primer párrafo con contenido.
     */
    private function extraerPrimerParrafoConContenido($html)
    {
        libxml_use_internal_errors(true); // Ignorar errores de HTML mal formado

        $doc = new DOMDocument();
        $doc->loadHTML('<?xml encoding="UTF-8">' . $html);
        $paragraphs = $doc->getElementsByTagName('p');

        foreach ($paragraphs as $paragraph) {
            $texto = trim($paragraph->textContent);
            if (!empty($texto) && $texto !== '&nbsp;') {
                return $doc->saveHTML($paragraph);
            }
        }

        return '';
    }
}
