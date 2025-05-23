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
        $primero = null;

        foreach ($paragraphs as $paragraph) {
            $texto = trim(str_replace("\xC2\xA0", ' ', $paragraph->textContent));
            if (!empty($texto)) {
                if ($primero) {
                    $segundo = $doc->saveHTML($paragraph);
                    $segundoTexto = strip_tags($segundo);
                    $longitud = mb_strlen($segundoTexto);

                    if ($longitud < 80) {
                        // Si es corto, no poner puntos suspensivos
                        $segundoConPuntos = $segundoTexto;
                    } elseif ($longitud < 200) {
                        // Si es medio, cortar a la mitad y añadir ...
                        $mitad = (int)($longitud / 2);
                        $segundoConPuntos = mb_substr($segundoTexto, 0, $mitad) . '...';
                    } else {
                        // Si es largo, cortar a un cuarto y añadir ...
                        $cuarto = (int)($longitud / 4);
                        $segundoConPuntos = mb_substr($segundoTexto, 0, $cuarto) . '...';
                    }
                    return $primero . $segundoConPuntos;
                }
                $primero = $doc->saveHTML($paragraph);
            }
        }

        if ($primero) {
            return $primero;
        }

        return '';
    }
}
