<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArbaUser;

class ArbaUserSeeder extends Seeder
{

    protected $connection = 'mysql-arba';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArbaUser::factory()->create([
            'name' => 'admin',
            'email' => 'admin@arba.es',
        ]);

    }
}
