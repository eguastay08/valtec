<?php
namespace App\Services\Admin;
 
use App\Models\Bloque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Services\Admin\ImageService;

class BloqueService
{
    public static function addArrayData($request, $tipobloque, $posicion)
    {
        $estado = $request->chkEstadoBloque == "on" ? "1":"0";
        $oculto =0;
        $jsonData="";
        $nombreicono = "";

        if($tipobloque==1 || $tipobloque==2):
            $arrayDatos = array();
            $arrayDatos['categoria'] = $request->categoriaBloque;
            $arrayDatos['nro_items'] = $request->nroitems;
            $jsonData = json_encode($arrayDatos);
            $data = [
                "bloque_tipo_id" =>$tipobloque,
                "config" => $jsonData,
                "titulo"=>$request->titulobloque,
            ];
            if(isset($request->imgBloque)):
                $arrayBloqueIcono = explode("|*|", $request->imgBloque);
                // $urlbloque = "admin/images/iconos/".$arrayBloqueIcono[0];
                $urlbloque = "assets/images/iconos/".$arrayBloqueIcono[0];
                $nombreicono = $arrayBloqueIcono[0];
                $data['icono'] = $urlbloque;
                $data['nombre_icono'] = $nombreicono;
                $data['size_icono'] = $arrayBloqueIcono[1];
            endif;

        elseif($tipobloque == 3 || $tipobloque==5):
            $data = [
                "bloque_tipo_id" =>$tipobloque,
            ];
            if(isset($request->imgBloque)):
                $arrayBloqueIcono = explode("|*|", $request->imgBloque);
                // $urlbloque = "admin/images/iconos/".$arrayBloqueIcono[0];
                $urlbloque = "assets/images/iconos/".$arrayBloqueIcono[0];
                $nombreicono = $arrayBloqueIcono[0];
                $data['icono'] = $urlbloque;
                $data['nombre_icono'] = $nombreicono;
                $data['size_icono'] = $arrayBloqueIcono[1];
            endif;

        elseif($tipobloque == 4):
            $data = [
                "bloque_tipo_id" =>$tipobloque,
                "titulo"=>$request->titulobloque,
            ];

        endif;
    
        $data['nombreicono'] = $nombreicono;
        $data['posicion'] = $posicion;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_registro'] = '46749322';
        $data['fecha_registro'] = now();

        return $data;
    }

    public static function updateArrayData($request, $tipobloque)
    {
        $jsonData = '';
        $nombreicono = '';
        $temporal = 0;
        $estado = $request->chkEstadoBloque == "on" ? "1":"0";
        $oculto =0;

        if($tipobloque==1 || $tipobloque==2):
            $arrayDatos = array();
            $arrayDatos['categoria'] = $request->categoriaBloque;
            $arrayDatos['nro_items'] = $request->nroitems;
            $jsonData = json_encode($arrayDatos);
            $data = [
                "bloque_tipo_id" =>$tipobloque,
                "config" => $jsonData,
                "titulo"=>$request->titulobloque,
            ];
            if(isset($request->imgBloque)):
                $arrayBloqueIcono = explode("|*|", $request->imgBloque);
                // $urlbloque = "admin/images/iconos/".$arrayBloqueIcono[0];
                $urlbloque = "assets/images/iconos/".$arrayBloqueIcono[0];
                $nombreicono = $arrayBloqueIcono[0];
                $temporal = $arrayBloqueIcono[2];
                if($arrayBloqueIcono[2]==1):
                    $data['icono'] = $urlbloque;
                    $data['nombre_icono'] = $nombreicono;
                    $data['size_icono'] = $arrayBloqueIcono[1];
                    if($request->iconactualbloque!=""):
                        echo self::eliminarIcon($request->iconactualbloque);
                    endif;
                endif;
            endif;

        elseif($tipobloque == 3 || $tipobloque==5):
            $data = [
                "bloque_tipo_id" =>$tipobloque,
                "config" =>"",
                "titulo"=>"",
            ];
            if(isset($request->imgBloque)):
                $arrayBloqueIcono = explode("|*|", $request->imgBloque);
                // $urlbloque = "admin/images/iconos/".$arrayBloqueIcono[0];
                $urlbloque = "assets/images/iconos/".$arrayBloqueIcono[0];
                $nombreicono = $arrayBloqueIcono[0];
                $temporal = $arrayBloqueIcono[2];
                if($arrayBloqueIcono[2]==1):
                    $data['icono'] = $urlbloque;
                    $data['nombre_icono'] = $nombreicono;
                    $data['size_icono'] = $arrayBloqueIcono[1];
                    if($request->iconactualbloque!=""):
                        echo self::eliminarIcon($request->iconactualbloque);
                    endif;
                endif;
            endif;

        elseif($tipobloque == 4):
            $data = [
                "bloque_tipo_id" =>$tipobloque,
                "config"=>"",
                "titulo"=>"",
                "titulo"=>$request->titulobloque,
                "icono"=>"",
                "nombre_icono"=>"",
                "size_icono"=>""
            ];
            
            if($request->iconactualbloque!=""):
                echo self::eliminarIcon($request->iconactualbloque);
            endif;
        
        endif;
       
        $data['nombreicono'] = $nombreicono;
        $data['temporal'] = $temporal;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_modifica'] = '46749322';
        $data['fecha_modifica'] = now();
        return $data;
        // return array($data, $nombreicono);
    } 

    public static function eliminarIcon($icono)
    {   
        // $url = public_path('admin/images/iconos/'.$icono);
        $url = public_path('assets/images/iconos/'.$icono);
        echo ImageService::eliminarImg($url);
    }

    public static function moveImage($filename)
    {
        // $destino =  public_path('admin/images/iconos/');
        $destino =  public_path('assets/images/iconos/');
        echo ImageService::moveimage($filename ,$destino);
    }
   
}