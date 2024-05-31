<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaginasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('paginas')->truncate();
        foreach ($this->paginas as $pagina) {
            if (isset($pagina['redes_sociales'])) {
                $pagina['redes_sociales'] = json_encode($pagina['redes_sociales']);
            }
            \App\Models\Pagina::create($pagina);
        }
    }

    private $paginas = [
        [
            'titulo' => '¿Qué es Autismo Región de Murcia?',
            'contenido' => '<p>Escribir aquí el contenido de la página</p>'
        ],
        [
            'titulo' => '¿Qué es el Autismo?',
            'contenido' => '<p>Escribir aquí el contenido de la página</p>'
        ]
    ];
}
