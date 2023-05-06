<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $primaryKey = 'banner_id';

    public $timestamps = false;

    protected $fillable = ['bloque_id','banner__estilo_id','titulo','link','columnas','posicion','banner','nombre_banner','size_banner','banner_superpuesto','nombre_banner_superpuesto','size_banner_superpuesto','estado','oculto','usuario_registro','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function countBanner($bloque)
    {
        $banner = Banner::where('bloque_id',$bloque)->where('oculto',0)->count();
        return $banner;
    }

    public static function latestPositionBannerByStyle($bloque)
    {
        $banner = Banner::select('posicion')->where('bloque_id',$bloque)->where('oculto',0)->max('posicion');
        return $banner;
    }

    public static function getBannerByPosition($posicion)
    {
        $banner = Banner::select('banner_id')->where('posicion',$posicion)->first();
        return $banner;
    }

    public static function getBanners($estado)
    {
        $banners= Banner::select('banners.*','bloques.titulo as nombrebloque')
                ->join('bloques', function($join)
                {
                    $join->on('banners.bloque_id', '=', 'bloques.bloque_id');
                    // $join->where('bloque_tipos.codigo','BANNERS');
                });
        
        if (isset($estado) && $estado != '_all_'):
            $banners->where('banners.estado',$estado);
        endif;  

        $banners = $banners->where('banners.oculto',0)
                ->orderBy('banners.bloque_id', 'ASC')
                ->orderBy('banners.posicion', 'ASC')
                ->paginate(10);

        return $banners;
    }

    public static function getBannerPosicionCount($posicion)
    {
        // $count = Banner::where('posicion',$posicion)->whereNotIn('banner_id', $banner_id)->count(); 
        $count = Banner::where('posicion',$posicion)->where('oculto',0)->count(); 
        return $count;
    }

    public static function getBannerGlobalFront($bloque_id)
    {
        $banners = Banner::select('banners.banner_id', 'banners.bloque_id', 'banners.banner__estilo_id','banners.titulo',
            'banners.link','banners.banner','banners.banner_superpuesto','banners.columnas','banners.posicion', 'banners.estado', 'bl.titulo as bloque_titulo')
            ->join('bloques as bl', function($join)
            {
                $join->on('banners.bloque_id', '=', 'bl.bloque_id');
                $join->where('bl.oculto',0);
            })
            ->join('bloque_tipos as blt', function($join)
            {
                $join->on('bl.bloque_tipo_id', '=', 'blt.bloque_tipo_id');
                $join->where('blt.oculto',0);
            })
            ->where('banners.bloque_id',$bloque_id)
            ->where('banners.estado',1)
            ->where('banners.oculto',0)
            ->orderBy('banners.posicion', 'ASC')
            ->get()->toArray();


        return $banners;
    }

    public static function BannerPago()
    {
        $data = Banner::select('banner_id','bloque_id','banner__estilo_id','titulo','link','banner','banner_superpuesto','columnas','posicion')
        ->where('bloque_id',23)
        ->where('estado',1)
        ->where('oculto',0)
        ->orderBy('posicion', 'ASC')
        ->get()->toArray();

        return $data;
    }

}
