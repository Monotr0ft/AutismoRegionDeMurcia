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
        ],
        [
            'titulo' => 'Home parrafo 1',
            'contenido' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis porttitor lectus id bibendum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec odio eros, maximus id rutrum nec, egestas quis sem. Sed urna felis, bibendum ut rhoncus at, euismod eu orci. Morbi venenatis neque a nisl suscipit, id feugiat libero ultrices. Duis vel nisl sit amet nulla scelerisque vulputate. In facilisis nisl purus, a gravida diam pharetra eget. Sed vitae malesuada felis. Morbi nec fringilla mi, eget fermentum dui. Quisque sit amet mattis elit.</p>'
        ],
        [
            'titulo' => 'Home parrafo 2',
            'contenido' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis porttitor lectus id bibendum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec odio eros, maximus id rutrum nec, egestas quis sem. Sed urna felis, bibendum ut rhoncus at, euismod eu orci. Morbi venenatis neque a nisl suscipit, id feugiat libero ultrices. Duis vel nisl sit amet nulla scelerisque vulputate. In facilisis nisl purus, a gravida diam pharetra eget. Sed vitae malesuada felis. Morbi nec fringilla mi, eget fermentum dui. Quisque sit amet mattis elit.</p>'
        ]
    ];
}
