<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArbaUserSeeder extends Seeder
{

    protected $connection = 'mysql-arba';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ArbaUser::factory()->create([
            'name' => 'admin',
            'email' => 'admin@arba.es',
        ]);

    }
}
