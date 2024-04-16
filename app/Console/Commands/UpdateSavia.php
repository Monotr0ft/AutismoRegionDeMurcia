<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateSavia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:savia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update savia field in stock_plantas table';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::connection('mysql-arba')->table('stock_plantas')
            ->whereNotNull('fecha_planta')
            ->update([
                'savia' => DB::raw('FLOOR(TIMESTAMPDIFF(MONTH, fecha_planta, NOW()) / 12)')
            ]);
    }
}
