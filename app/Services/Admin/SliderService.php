<?php
namespace App\Services\Admin;
 
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Services\Admin\ImageService;

class SliderService
{
    public static function addArraySliderData($request, $arraySliderImg)
    {
        $estado = $request->estado == "true" ? "1":"0";
        $oculto =0;

        $urlslider = "assets/images/sliders/".$arraySliderImg[0];

        $countSlider = Slider::countSlider();

        if($countSlider>0):
            $valuePosicion = Slider::latestPosition();
            $posicion = intval($valuePosicion)+1;
        else:
            $posicion = 1;
        endif;
        
        $data = [
            "url" =>$urlslider,
            "link" => $request->link,
            "popup"=>$request->popup,
            "posicion"=>$posicion,
            "nombre_img"=>$arraySliderImg[0],
            "size_img"=>$arraySliderImg[1],
            "estado"=>$estado,
            "oculto"=>$oculto,
            "usuario_registro"=>'46749322',
            "fecha_registro"=>now()
        ];

        return $data;
    }

    public static function updateArraySliderData($request, $arraySliderImgEdit)
    {
        $estado = $request->estado == "true" ? "1":"0";
        $oculto =0;

        $urlslider = "assets/images/sliders/".$arraySliderImgEdit[0];
        // var_dump($request->imgSlider);exit;

        if($request->posicion != $request->posicion_actual):
            $slider = Slider::getSliderForPosition($request->posicion);
            Slider::where("slider_id", $slider->slider_id)->update(["posicion" => $request->posicion_actual]);
        endif;

        $data = [
            "url" =>$urlslider,
            "link" => $request->link,
            "popup"=>$request->popup,
            "posicion"=>$request->posicion,
            "nombre_img"=>$arraySliderImgEdit[0],
            "size_img"=>$arraySliderImgEdit[1],
            "estado"=>$estado,
            "oculto"=>$oculto,
            "usuario_modifica"=>'46749322',
            "fecha_modifica"=>now()
        ];

        return $data;

    }

    public static function moveSlider($filename)
    {
        $destino =  public_path('assets/images/sliders/');
        echo ImageService::moveimage($filename ,$destino);
    }

    public static function existImageSlider($slider_id,$filename)
    {
        $url = public_path('assets/images/sliders/'.$filename);
        echo ImageService::eliminarImg($url);
        // $countImageSlider = Slider::existImageSlider($slider_id, $filename);
        // if($countImageSlider>0):
           
        // endif;
    }
   
}