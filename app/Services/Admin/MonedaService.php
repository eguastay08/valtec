<?php
namespace App\Services\Admin;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use DB;

class MonedaService
{
    public function addArrayDataMoneda($request)
    {   
        
        $data = [
            "nombre" =>  $request->nombre,
            "codigo" => $request->codigo,
            "prefijo" => $request->prefijo,
            "sufijo" =>$request->sufijo,
            "tipo_cambio"=>$request->tipo_cambio,
            "estado" => 0,
            "oculto" => 0,
            "usuario_registro" => $request->usuario,
            "fecha_registro" => now()
        ];
        
        return $data;

    }

    public function updateArrayDataMoneda($request)
    {
        $data = [
            "nombre" =>  $request->nombre,
            "codigo" => $request->codigo,
            "prefijo" => $request->prefijo,
            "sufijo" =>$request->sufijo,
            "tipo_cambio"=>$request->tipo_cambio,
            "usuario_modifica" => $request->usuario,
            "fecha_modifica" => now()
        ];
        
        return $data;
    }

    public function desactiveMonedas()
    {
        DB::table('monedas')->update(array('estado'=>0));
    }

}