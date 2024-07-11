<?php
namespace App\Services\Admin;
 
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Services\Admin\ImageService;

class BannerService
{
    public static function addArrayDataBanner($request, $posicion)
    {
        $estado = $request->chkEstadoBanner == "on" ? "1":"0";
        $oculto =0;
        $nombreBannerImg = "";
        $nombreBannerSuperpuestoImg = "";

        $data = [
            "bloque_id" =>  $request->ubicacionBanner,
            "banner__estilo_id" => $request->estiloBanner,
            "titulo" =>$request->txtTituloBanner,
            "link" => $request->txtLinkBanner,
            "columnas"=> $request->tamanioBanner
        ];

        if(isset($request->imgBanner) && $request->imgBanner!= ""):

            $arrayBannerImg = explode("|*|", $request->imgBanner);
            // $url = "admin/images/banners/".$arrayBannerImg[0];
            $url = "assets/images/banners/".$arrayBannerImg[0];
            $nombreBannerImg = $arrayBannerImg[0];

            $data['banner'] = $url;
            $data['nombre_banner'] = $arrayBannerImg[0];
            $data['size_banner'] = $arrayBannerImg[1];
        endif;

        if($request->estiloBanner == 2):

            if(isset($request->imgBannerSuperpuesto) && $request->imgBannerSuperpuesto!= ""):
                $arrayBannerSuperpuestoImg = explode("|*|", $request->imgBannerSuperpuesto);
                // $url = "admin/images/banners/".$arrayBannerSuperpuestoImg[0];
                $url = "assets/images/banners/".$arrayBannerSuperpuestoImg[0];
                $nombreBannerSuperpuestoImg = $arrayBannerSuperpuestoImg[0];
    
                $data['banner_superpuesto'] = $url;
                $data['nombre_banner_superpuesto'] = $arrayBannerSuperpuestoImg[0];
                $data['size_banner_superpuesto'] = $arrayBannerSuperpuestoImg[1];
            endif;

        endif;

        $data['nombreBannerImg'] = $nombreBannerImg;
        $data['nombreBannerSuperpuestoImg'] = $nombreBannerSuperpuestoImg;
        $data['posicion'] = $posicion;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_registro'] = '46749322';
        $data['fecha_registro'] = now();

        return $data;

    }

    public static function updateArrayDataBanner($request,$banner_id)
    {
        $estado = $request->chkEstadoBanner == "on" ? "1":"0";
        $oculto =0;
        $nombreBannerImg = "";
        $nombreBannerSuperpuestoImg = "";
        $temporalBanner = 0;
        $temporalBannerS = 0;

        $data = [
            "bloque_id" =>  $request->ubicacionBanner,
            "banner__estilo_id" => $request->estiloBanner,
            "titulo" =>$request->txtTituloBanner,
            "link" => $request->txtLinkBanner,
            "columnas"=> $request->tamanioBanner
        ];

        if(isset($request->imgBanner) && $request->imgBanner!= ""):

            $arrayBannerImg = explode("|*|", $request->imgBanner);
            // $url = "admin/images/banners/".$arrayBannerImg[0];
            $url = "assets/images/banners/".$arrayBannerImg[0];
            $nombreBannerImg = $arrayBannerImg[0];
            $temporalBanner = $arrayBannerImg[2];

            $data['banner'] = $url;
            $data['nombre_banner'] = $arrayBannerImg[0];
            $data['size_banner'] = $arrayBannerImg[1];
        endif;

        if($request->estiloBanner == 1):
            if($request->bannerSuperpuestoActual!=""):
                echo self::existImageBanner($request->bannerSuperpuestoActual);
                Banner::where("banner_id", $banner_id)->update(["banner_superpuesto" => "", "nombre_banner_superpuesto" => "", "size_banner_superpuesto" => ""]);  
            endif;
        endif;

        if($request->estiloBanner == 2):

            if(isset($request->imgBannerSuperpuesto) && $request->imgBannerSuperpuesto!= ""):
                $arrayBannerSuperpuestoImg = explode("|*|", $request->imgBannerSuperpuesto);
                $url = "assets/images/banners/".$arrayBannerSuperpuestoImg[0];
                // $url = "admin/images/banners/".$arrayBannerSuperpuestoImg[0];
                $nombreBannerSuperpuestoImg = $arrayBannerSuperpuestoImg[0];
    
                $data['banner_superpuesto'] = $url;
                $data['nombre_banner_superpuesto'] = $arrayBannerSuperpuestoImg[0];
                $data['size_banner_superpuesto'] = $arrayBannerSuperpuestoImg[1];
                $temporalBannerS = $arrayBannerSuperpuestoImg[2];
            endif;

        endif;

        $data['bannerImgActual']= $request->bannerImgActual;
        $data['bannerSuperpuestoActual'] = $request->bannerSuperpuestoActual;
        $data['temporal_banner'] = $temporalBanner;
        $data['temporal_banner_superpuesto'] = $temporalBannerS;
        $data['nombreBannerImg'] = $nombreBannerImg;
        $data['nombreBannerSuperpuestoImg'] = $nombreBannerSuperpuestoImg;
        $data['posicion'] = $request->posicionBanner;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_modifica'] = '46749322';
        $data['fecha_modifica'] = now();

        return $data;


    }

    public static function moveBanner($filename)
    {
        // $destino =  public_path('admin/images/banners/');
        $destino =  public_path('assets/images/banners/');
        echo ImageService::moveimage($filename ,$destino);
    }

    public static function existImageBanner($filename)
    {
        $url = public_path($filename);
        echo ImageService::eliminarImg($url);
    }

    public static function eliminarBannerImg($banner_id, $filename, $superpuesto)
    {
        // $url = public_path('admin/images/banners/'.$filename);
        $url = public_path('assets/images/banners/'.$filename);
        $image = ImageService::eliminarImg($url);
        if($superpuesto == 1):
            Banner::where("banner_id", $banner_id)->update(["banner_superpuesto" => "", "nombre_banner_superpuesto" => "", "size_banner_superpuesto" => ""]);   
        else:
            Banner::where("banner_id", $banner_id)->update(["banner" => "", "nombre_banner" => "", "size_banner" => ""]);
        endif;
    }
}