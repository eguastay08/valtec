<?php
namespace App\Services\Admin;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Services\Admin\ImageService;

class MedioPagoService
{
    public static function addArrayDataMedioPago($request)
    {   
        
        $estado = $request->chkEstadoMedioPago  == "on" ? "1":"0";
        $oculto =0;
        $mediopagoimgnombre = "";
        // $descripcion = nl2br($request->descripcion);
        $regex = '@<p([^>]*)>\s*\n*\t*(&nbsp;)*\s*\n*\t*</p>@';
        $text = preg_replace($regex, '', $request->txtDescripcionMedioPago);

        $data = [
            "nombre" =>  $request->txtNombreMedio,
            // "descripcion" => preg_replace('/\s&nbsp;\s/ig', ' ', $descripcion),
            // "descripcion" => nl2br($request->descripcion),
            "descripcion" => $text,
            "deposito" =>$request->DepositoRadio,
            "transferencia" => $request->transferenciaRadio,
            "billetera_digital" => $request->BilleteraDigitalRadio,
            "pago_online" => $request->PagoOnlineRadio,
        ];

        if(isset($request->medioPagoImg) && $request->medioPagoImg!= ""):

            $arrayMedioPagoImg = explode("|*|", $request->medioPagoImg);
            $url = "assets/images/medios_pago/".$arrayMedioPagoImg[0];
            $mediopagoimgnombre = $arrayMedioPagoImg[0];

            $data['imagen'] = $url;
            $data['nombre_img'] = $arrayMedioPagoImg[0];
            $data['size_img'] = $arrayMedioPagoImg[1];
        endif;

        $data['mediopagoimgnombre'] = $mediopagoimgnombre;
        $data['estado']  = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_registro'] = $request->hddusuario;
        $data['fecha_registro'] = now();
        
        return $data;

    }

    public static function updateArrayDataMedioPaga($request)
    {
        $estado = $request->chkEstadoMedioPago  == "on" ? "1":"0";
        $oculto =0;
        $mediopagoimgnombre = "";
        $temporal = 0;
        // $descripcion = nl2br($request->descripcion);
        $regex = '@<p([^>]*)>\s*\n*\t*(&nbsp;)*\s*\n*\t*</p>@';
        $text = preg_replace($regex, '', $request->txtDescripcionMedioPago);
        // var_dump($text);exit;

        $data = [
            "nombre" =>  $request->txtNombreMedio,
            // "descripcion" => preg_replace('<p></p>', ' ', $descripcion),
            // "descripcion" => nl2br($request->descripcion),
            "descripcion" => $text,
            "deposito" =>$request->DepositoRadio,
            "transferencia" => $request->transferenciaRadio,
            "billetera_digital" => $request->BilleteraDigitalRadio,
            "pago_online" => $request->PagoOnlineRadio,
        ];

        if(isset($request->medioPagoImg) && $request->medioPagoImg!= ""):

            $arrayMedioPagoImg = explode("|*|", $request->medioPagoImg);
            $url = "assets/images/medios_pago/".$arrayMedioPagoImg[0];
            $mediopagoimgnombre = $arrayMedioPagoImg[0];
            $temporal = $arrayMedioPagoImg[2];
            $data['imagen'] = $url;
            $data['nombre_img'] = $arrayMedioPagoImg[0];
            $data['size_img'] = $arrayMedioPagoImg[1];
        endif;

        $data['mediopagoimgnombre'] = $mediopagoimgnombre;
        $data['temporal'] = $temporal;
        $data['estado']  = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_modifica'] = $request->hddusuario;
        $data['fecha_modifica'] = now();
        
        return $data;
    }

    public static function moveMedioPagoImg($filename)
    {
        $destino =  public_path('assets/images/medios_pago/');
        echo ImageService::moveimage($filename ,$destino);
    }

    public static function existImgMedioPago($slider_id,$filename)
    {
        $url = public_path('assets/images/medios_pago/'.$filename);
        echo ImageService::eliminarImg($url);
    }

}