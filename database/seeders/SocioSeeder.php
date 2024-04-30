<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('mysql-arba')->table('direcciones_arba')->truncate();
        DB::connection('mysql-arba')->table('socios')->truncate();
        DB::connection('mysql-arba')->table('direcciones_arba')->insert([
            'tipo_via' => 'Calle',
            'nombre_via' => 'Goya',
            'numero' => 1,
            'ampliacion' => 'A',
            'codigo_postal' => 30360,
            'municipio' => 'La Unión',
            'localidad' => 'La Unión',
            'provincia' => 'Murcia',
        ]);
        DB::connection('mysql-arba')->table('socios')->insert([
            'nombre' => 'Ricardo',
            'apellido1' => 'Fresno',
            'apellido2' => 'Alcántara',
            'dni' => '22954099F',
            'telefono' => '665042899',
            'direccion' => 1,
            'email' => 'fresno.ricardo@gmail.com',
            'activo' => 1,
            'fecha_alta' => '2020-04-02',
            'junta_directiva' => 1,
            'posicion' => 'Vocal',
            'acceso_web' => 1,
            'administracion' => 1,
            'vivero' => 0,
            'partes_trabajo' => 0,
            'user_id' => 2,
        ]);
    }
}
