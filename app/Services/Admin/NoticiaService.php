<?php
namespace App\Services\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Noticia;
use App\Models\Noticia_Imagens;
use App\Services\Admin\ImageService;

class NoticiaService
{
    public static function ArrayNoticiaAdd($request)
    {
        $urlNoticia = Str::slug($request->tituloNoticia);
        $estado = $request->chkEstadoNoticia == "on" ? "1":"0";
        $oculto =0;
        $regex = '@<p([^>]*)>\s*\n*\t*(&nbsp;)*\s*\n*\t*</p>@';
        $text = preg_replace($regex, '', $request->descripcionNoticia);

        $data = [
            "noticia" =>$request->tituloNoticia,
            // "descripcion_producto" =>html_entity_decode($request->descripcionNoticia),
            "descripcion" => $text,
            "url"=>$urlNoticia,
            "estado"=>$estado,
            "oculto"=>$oculto,
            "usuario_registra"=>$request->hddusuario,
            "fecha_registro"=>now()
        ];

        return $data;

    }

    public static function ArrayNoticiaUpdate($request)
    {
        $urlNoticia = Str::slug($request->tituloNoticia);
        $estado = $request->chkEstadoNoticia == "on" ? "1":"0";
        $oculto =0;
        $regex = '@<p([^>]*)>\s*\n*\t*(&nbsp;)*\s*\n*\t*</p>@';
        $text = preg_replace($regex, '', $request->descripcionNoticia);

        $data = [
            "noticia" =>$request->tituloNoticia,
            // "descripcion_producto" =>html_entity_decode($request->descripcionNoticia),
            "descripcion" => $text,
            "url"=>$urlNoticia,
            "estado"=>$estado,
            "oculto"=>$oculto,
            "usuario_modifica"=>$request->hddusuario,
            "fecha_modifica"=>now()
        ];

        return $data;

    }

    public static function existImageNoticiaPrincipal($noticia_id, $idImgNoticia)
    {
        $countImage = Noticia_Imagens::existNoticiaImage($idImgNoticia);
        if($countImage>0):
            $noticia_img_principal = Noticia_Imagens::find($idImgNoticia);
            $filename = $noticia_img_principal->imagen;
            if($noticia_img_principal->delete()):
                $url = public_path('assets/images/noticias/'.$noticia_id.'/'.$filename);
                echo ImageService::eliminarImg($url);
            endif;      
        endif;
    }

    public static function moveNoticiaImage($filename, $noticia_id)
    {
        // $destino =  public_path('admin/images/productos/'.$producto_id);
        $destino =  public_path('assets/images/noticias/'.$noticia_id);
        echo ImageService::moveimage($filename ,$destino);
    }
    
}