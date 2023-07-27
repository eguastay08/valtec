<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ordens_Estado;

class OrdenEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $orden_estados = [
            [
                "estado"=>"Aprobado",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "estado"=>"Pendiente",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [ 
                "estado"=>"Rechazado",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [ 
                "estado"=>"Atendido",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [ 
                "estado"=>"Cancelado",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [ 
                "estado"=>"En Proceso Paypal",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [ 
                "estado"=>"Pendiente Verificación",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [ 
                "estado"=>"Pendiente Mercado Pago",
                "oculto"=>0,
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
        ];

        Ordens_Estado::insert($orden_estados);


    }

}
