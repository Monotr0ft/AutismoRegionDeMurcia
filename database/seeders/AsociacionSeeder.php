<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsociacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asociaciones')->truncate();
        foreach ($this->asociaciones as $asociacion) {
            if (isset($asociacion['redes_sociales'])) {
                $asociacion['redes_sociales'] = json_encode($asociacion['redes_sociales']);
            }
            \App\Models\Asociacion::create($asociacion);
        }
    }

    private $asociaciones = [
        [
            'nombre' => 'ABAMUR',
            'tipo' => 'Asociación',
            'direccion' => 'Avda. Alto de las Atalayas, nº 21, BJ, Cabezo de Torres',
            'email' => 'abamur@abamur.org',
            'web' => 'www.abamur.org',
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ante nisi, tristique molestie lectus non, dignissim tempor massa. Donec purus quam, tempor sit amet ex in, congue congue nisl. Nullam fringilla viverra suscipit. Mauris vitae ligula id dolor euismod luctus nec ut ipsum. Ut malesuada lectus sed magna posuere commodo. Nulla ac tristique nibh, eget fringilla ex. Morbi sagittis lorem augue, in cursus quam faucibus id. Morbi placerat augue a ultrices dictum. Curabitur euismod in mi quis aliquet.',
            'es_regional' => true,
            'publicar' => true
        ],
        [
            'nombre' => 'ASPERMUR',
            'tipo' => 'Asociación',
            'direccion' => 'C/Ermita vieja, 31. C.P.30.006 Puente Tocinos',
            'telefono' => 639966880,
            'email' => 'info@aspermur.org',
            'web' => 'www.aspermur.org',
            'redes_sociales' => ['www.facebook.com/Aspermur', 'www.twitter.com/Aspermur'],
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ante nisi, tristique molestie lectus non, dignissim tempor massa. Donec purus quam, tempor sit amet ex in, congue congue nisl. Nullam fringilla viverra suscipit. Mauris vitae ligula id dolor euismod luctus nec ut ipsum. Ut malesuada lectus sed magna posuere commodo. Nulla ac tristique nibh, eget fringilla ex. Morbi sagittis lorem augue, in cursus quam faucibus id. Morbi placerat augue a ultrices dictum. Curabitur euismod in mi quis aliquet.',
            'es_regional' => true,
            'publicar' => true
        ],
        [
            'nombre' => 'ASTEAMUR',
            'tipo' => 'Asociación',
            'direccion' => 'C/Greco, 5, 30006',
            'telefono' => 868661952,
            'email' => 'info@asteamur.org',
            'web' => 'www.asteamur.org',
            'redes_sociales' => ['www.facebook.com/asteamur', 'www.twitter.com/asteamur', 'www.instagram.com/asteamur/?hl=es', 'www.youtube.com/channel/UCAla2csPEctPM0SfWRHHPmA', 'www.linkedin.com/company/asteamur/?originalSubdomain=es'],
            'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus dui, congue vitae convallis nec, ornare sed libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque egestas justo sed libero fermentum mattis. Donec viverra, est ut molestie hendrerit, magna nisl tempus quam, ac efficitur elit ex et nibh. Aliquam dictum velit et odio finibus pellentesque. Sed sit amet suscipit ligula. Pellentesque tincidunt elit eu augue dignissim, ac egestas est elementum. Fusce venenatis, sapien non ultricies posuere, elit velit interdum enim, vel maximus mi augue vel odio. Suspendisse turpis enim, lobortis vel leo quis, molestie vestibulum libero. Curabitur lacinia iaculis sem quis faucibus. Curabitur vel risus eget est mollis scelerisque non ac tortor. Sed et nunc feugiat, efficitur augue vitae, aliquet lectus. Fusce vehicula sem nisi, quis congue odio blandit at. Sed convallis augue id sapien tristique, non eleifend est tincidunt. Quisque faucibus ex pellentesque turpis malesuada tristique. In augue quam, commodo nec commodo ut, consectetur eu eros.',
            'es_regional' => true,
            'publicar' => true
        ]
    ];

}
