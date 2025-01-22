<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Noticia;

class NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('noticias')->truncate();
        foreach ($this->noticias as $noticia) {
            Noticia::create($noticia);
        }
    }

    private $noticias = [
        [
            'titulo' => 'Derechos Sociales impulsa el primer plan específico para el Trastorno del Espectro del Autismo',
            'url' => 'www.laopiniondemurcia.es/sociedad/2024/04/02/derechos-sociales-impulsa-primer-plan-100539383.html',
            'fecha' => '2024-04-02'
        ],
        [
            'titulo' => 'Una de cada 100 personas en la Región de Murcia tiene un trastorno del espectro autista',
            'url' => 'www.orm.es/noticias-2024/una-de-cada-100-personas-en-la-region-de-murcia-tiene-un-trastorno-del-espectro-autista/',
            'fecha' => '2024-04-02'
        ]
    ];
}
