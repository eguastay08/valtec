<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $primaryKey = 'slider_id';

    public $timestamps = false;

    protected $fillable = ['url','link','popup','posicion','nombre_img','size_img','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public function getSlider($popup, $estado)
    {
        $slider = Slider::select('slider_id', 'url', 'link','popup','posicion','nombre_img','size_img','estado','oculto');
        
        if (isset($popup) && $popup != '_all_'):
            $slider ->where('popup',$popup);
        endif;    

        if (isset($estado) && $estado != '_all_'):
            $slider ->where('estado',$estado);
        endif;    

        $slider = $slider->where('oculto',0)->orderBy('posicion', 'asc')->paginate(10);

        return $slider;
    }

    public function countSlider()
    {
        $slider = Slider::where('oculto',0)->count();
        return $slider;
    }

    public function latestPosition()
    {
        $slider = Slider::select('posicion')->where('oculto',0)->max('posicion');
        return $slider;
    }

    public function getSliderPositionCount($posicion)
    {
        $slider = Slider::where('posicion',$posicion)->where('oculto',0)->count();
        return $slider;
    }

    public function getSliderForPosition($posicion)
    {
        $slider = Slider::select('slider_id')->where('posicion',$posicion)->first();
        return $slider;
    }

    public function existImageSlider($slider_id, $filename)
    {
        $slider = Slider::where('nombre_img', $filename)->where('slider_id',$slider_id)->count();
        return $slider;
    }

    public static function getSlidersFront()
    {
        $sliders = Slider::select('slider_id','url','link','popup')->where('popup',0)->where('estado',1)->where('oculto',0)->orderBy('posicion', 'asc')->get();
        return $sliders;
    }

    public static function getPopupsFront()
    {
        $sliders = Slider::select('slider_id','url','link','popup')->where('popup',1)->where('estado',1)->where('oculto',0)->orderBy('posicion', 'asc')->get();
        return $sliders;
    }

}
