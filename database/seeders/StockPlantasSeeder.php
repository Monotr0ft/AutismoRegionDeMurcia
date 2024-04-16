<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockPlantasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::connection('mysql-arba')->table('stock_plantas')->truncate();
        DB::connection('mysql-arba')->table('plantas')->truncate();
        DB::connection('mysql-arba')->table('lugares')->truncate();
        DB::connection('mysql-arba')->table('ubicaciones')->truncate();
        DB::connection('mysql-arba')->table('contenedores')->truncate();
        
        foreach ($this->plantas as $planta) {
            DB::connection('mysql-arba')->table('plantas')->insert($planta);
        }
        foreach ($this->lugares as $lugar) {
            DB::connection('mysql-arba')->table('lugares')->insert($lugar);
        }
        foreach ($this->ubicaciones as $ubicacion) {
            DB::connection('mysql-arba')->table('ubicaciones')->insert($ubicacion);
        }
        foreach ($this->contenedores as $contenedor) {
            DB::connection('mysql-arba')->table('contenedores')->insert($contenedor);
        }
    }

    private $plantas = [
        [
            'nombre_comun' => 'Lentisco',
            'nombre_cientifico' => 'Pistacia lentiscus',
        ],
        [
            'nombre_comun' => 'Palmito',
            'nombre_cientifico' => 'Chamaerops humilis',
        ],
        [
            'nombre_comun' => 'Cornical',
            'nombre_cientifico' => 'Periploca angustifolia',
        ],
    ];

    private $lugares = [
        [
            'nombre' => 'Invernadero',
        ],
        [
            'nombre' => 'Umbráculo',
        ],
    ];

    private $ubicaciones = [
        [
            'nombre' => 'Mesa 1',
        ],
        [
            'nombre' => 'Mesa 2',
        ],
    ];

    private $contenedores = [
        [
            'nombre' => 'Bandeja 12 alveolos',
        ],
        [
            'nombre' => 'Bandeja 6 alveolos',
        ],
        [
            'nombre' => 'Bandeja 40 alveolos',
        ]
    ];
}
