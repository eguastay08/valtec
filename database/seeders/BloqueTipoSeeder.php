<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bloque_tipo;

class BloqueTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $bloques_tipo = [
            [
                "codigo"=>"PRODUCTS",
                "nombre"=>"Productos",
                "parametros"=>"['categoria','items','titulo','icono']",
                "estado"=>1,
                "oculto"=>0,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
            [
                "codigo"=>"CARROUSEL",
                "nombre"=>"Carrousel",
                "parametros"=>"['categoria','items','titulo','icono']",
                "estado"=>1,
                "oculto"=>0,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
            [
                "codigo"=>"OPINIONS",
                "nombre"=>"Opiniones",
                "parametros"=>"['icono']",
                "estado"=>1,
                "oculto"=>1,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
            [
                "codigo"=>"BANNERS",
                "nombre"=>"Banner",
                "parametros"=>"['titulo']",
                "estado"=>1,
                "oculto"=>0,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
            [
                "codigo"=>"NOTICIAS",
                "nombre"=>"Noticias",
                "parametros"=>"['icono']",
                "estado"=>1,
                "oculto"=>0,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
            [
                "codigo"=>"OFERTAS",
                "nombre"=>"Ofertas",
                "parametros"=>"['icono']",
                "estado"=>1,
                "oculto"=>1,
                "usuario_registro"=>"46749322",
                "fecha_registro"=>now()
            ],
        ];

        Bloque_tipo::insert($bloques_tipo);


    }
}
