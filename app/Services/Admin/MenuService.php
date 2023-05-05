<?php
namespace App\Services\Admin;
 
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class MenuService
{
    public function addArrayDataMenu($request)
    {
        $estado = $request->chkEstadoMenu == "on" ? "1":"0";
        $oculto =0;
        $link = $request->textLinkMenu == "" ? "#":$request->textLinkMenu;
        $posicion = '';
        $nombremenuicono = '';
        
        $countMenu = Menu::countMenuxPadre($request->cbopadre);

        if($countMenu>0):
            $valPosicionMenu = Menu::latestPositionxPadre($request->cbopadre);
            $posicion = intval($valPosicionMenu)+1;
        else:
            $posicion = 1;
        endif;

        $data = [
            "nombre" =>$request->txtNombreMenu,
            "link" => $link,
            "padre"=>$request->cbopadre,
        ];

        if(isset($request->imgMenu)):
            $arrayMenuIcon = explode("|*|", $request->imgMenu);
            // $urlbloque = "admin/images/iconos/".$arrayBloqueIcono[0];
            $urlmenuicon = "assets/images/menu_iconos/".$arrayMenuIcon[0];
            $nombremenuicono = $arrayMenuIcon[0];
            $data['icono'] = $urlmenuicon;
            $data['nombre_icono'] = $nombremenuicono;
            $data['size_icono'] = $arrayMenuIcon[1];
        endif;

        $data['posicion'] = $posicion;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_registro'] = $request->usuario;
        $data['fecha_registro'] = now();

        // "posicion"=> $posicion,
        // "estado"=>$estado,
        // "oculto"=>$oculto,
        // "usuario_registro"=>$request->usuario,
        // "fecha_registro"=>now()

        return $data;
    }

    public function updateArrayDataMenu($request)
    {
        $estado = $request->chkEstadoMenu == "on" ? "1":"0";
        $oculto =0;
        $link = $request->textLinkMenu == "" ? "#":$request->textLinkMenu;
        $posicion = '';
        $nombreicono = '';
        $temporal = 0;

        if($request->cbopadre != $request->padremenu_id):
            $countMenu = Menu::countMenuxPadre($request->cbopadre);
            if($countMenu>0):
                $valPosicionMenu = Menu::latestPositionxPadre($request->cbopadre);
                $posicion = intval($valPosicionMenu)+1;
            else:
                $posicion = 1;
            endif;
        else:
            $posicion = $request->hdd_menu_posicion;
        endif;
          
        $data = [
            "nombre" =>$request->txtNombreMenu,
            "link" => $link,
            "padre"=>$request->cbopadre,
            // "posicion"=> $posicion,
            // "estado"=>$estado,
            // "oculto"=>$oculto,
            // "usuario_modifica"=>$request->usuario,
            // "fecha_modifica"=>now()
        ];

        if(isset($request->imgMenu)):
            $arrayMenuIcon = explode("|*|", $request->imgMenu);
            // $urlbloque = "admin/images/iconos/".$arrayBloqueIcono[0];
            $urlmenuicon = "assets/images/menu_iconos/".$arrayMenuIcon[0];
            $nombremenuicono = $arrayMenuIcon[0];
            $temporal = $arrayMenuIcon[2];
            $nombreicono = $nombremenuicono;
            if($arrayMenuIcon[2]==1):
                $data['icono'] = $urlmenuicon;
                $data['nombre_icono'] = $nombremenuicono;
                $data['size_icono'] = $arrayMenuIcon[1];
                if($request->iconoactualMenu!=""):
                    echo self::eliminarIcon($request->iconoactualMenu);
                endif;
            endif;
        endif;
        $data['nombreicono'] = $nombreicono;
        $data['temporal'] = $temporal;
        $data['posicion'] = $posicion;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_registro'] = $request->usuario;
        $data['fecha_registro'] = now();

        return $data;
    }

    public function eliminarIcon($icono)
    {   
        // $url = public_path('admin/images/iconos/'.$icono);
        $url = public_path('assets/images/menu_iconos/'.$icono);
        echo ImageService::eliminarImg($url);
    }

    public function moveImage($filename)
    {
        // $destino =  public_path('admin/images/iconos/');
        $destino =  public_path('assets/images/menu_iconos/');
        echo ImageService::moveimage($filename ,$destino);
    }
}