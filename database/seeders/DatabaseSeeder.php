<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        Schema::connection('mysql-arba')->disableForeignKeyConstraints();
        $this->call(ArbaUserSeeder::class);
        $this->call(AsociacionSeeder::class);
        $this->call(StockPlantasSeeder::class);
        $this->call(SocioSeeder::class);
        Model::reguard();
        Schema::enableForeignKeyConstraints();
        Schema::connection('mysql-arba')->enableForeignKeyConstraints();
    }
}
