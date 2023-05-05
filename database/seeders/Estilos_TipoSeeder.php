<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estilo_Tipo;

class Estilos_TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estilos_tipo = [
            [
                "nombre"=>"Color de texto",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Color de fondo",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
        ];

        Estilo_Tipo::insert($estilos_tipo);

    }
}
