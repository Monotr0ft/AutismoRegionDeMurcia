<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArbaUser;
use Illuminate\Support\Facades\DB;

class ArbaUserSeeder extends Seeder
{

    protected $connection = 'mysql-arba';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('mysql-arba')->table('users_arba')->truncate();
        DB::connection('mysql-arba')->table('password_reset_tokens_arba')->truncate();
        DB::connection('mysql-arba')->table('personal_access_tokens_arba')->truncate();
        DB::connection('mysql-arba')->table('failed_jobs_arba')->truncate();
        DB::connection('mysql-arba')->table('password_resets_arba')->truncate();
        ArbaUser::factory()->create([
            'name' => 'admin',
            'email' => 'admin@arba.es',
        ]);

    }
}
