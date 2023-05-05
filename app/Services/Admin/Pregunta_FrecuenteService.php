<?php
namespace App\Services\Admin;
 
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Pregunta_FrecuenteService
{
    public function addArrayDataPreguntaFrecuente($request, $posicion)
    {
        $estado = $request->estado == "true" ? "1":"0";
        $oculto =0;

        $data = [
            "pregunta" =>  trim($request->pregunta),
            "respuesta" => trim($request->respuesta),
            "posicion" =>$posicion,
            "estado" => $estado,
            "oculto"=> $oculto,
            "usuario_registro" =>'46749322',
            "fecha_registro" =>NOW()
        ];
        
        return $data;
    }

    public function updateArrayDataPreguntaFrecuente($request)
    {
        $estado = $request->estado == "true" ? "1":"0";
        $oculto =0;

        $data = [
            "pregunta" =>  trim($request->pregunta),
            "respuesta" => trim($request->respuesta),
            "posicion" =>$request->posicion,
            "estado" => $estado,
            "oculto"=> $oculto,
            "usuario_modifica" =>'46749322',
            "fecha_modifica" =>NOW()
        ];
        
        return $data;
    }
}
