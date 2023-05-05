<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner_Estilo;

class BannerEstiloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $bannerEstilos = [
            [
                "nombre"=>"Banner Normal",
                "oculto"=>0,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Banner con Hover",
                "oculto"=>0,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
        ];

        Banner_Estilo::insert($bannerEstilos);

    }
}
