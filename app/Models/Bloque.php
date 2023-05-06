<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;

    protected $table = 'bloques';

    protected $primaryKey = 'bloque_id';

    public $timestamps = false;

    protected $fillable = ['bloque_tipo_id','config','titulo','icono','nombre_icono','size_icono','posicion','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public function getBloques()
    {
        // $bloque = Bloque::join('bloque_tipos', 'bloques.bloque_tipo_id', '=', 'bloque_tipos.bloque_tipo_id')
        //                     ->get(['bloques.bloque_id','bloques.bloque_tipo_id','bloque_tipos.nombre','bloques.config','bloques.titulo','bloques.icono','bloques.estado','bloques.posicion']);
        $bloque = Bloque::select('bloques.bloque_id','bloques.bloque_tipo_id','bloque_tipos.nombre','bloques.config','bloques.titulo','bloques.icono','bloques.estado','bloques.posicion')
                            ->join('bloque_tipos', 'bloques.bloque_tipo_id', '=', 'bloque_tipos.bloque_tipo_id')
                            ->where('bloques.oculto',0)
                            ->whereNotIn('bloques.bloque_id',[23])
                            ->orderBy('bloques.posicion','asc')
                            ->get();
        return $bloque;
    }

    public function countBloque()
    {
        $bloque = Bloque::where('oculto',0)->count();
        return $bloque;
    }

    public function latestPosition()
    {
        $bloque = Bloque::select('posicion')->where('oculto',0)->max('posicion');
        return $bloque;
    }

    public function getBloqueByPosition($posicion)
    {
        $bloque = Bloque::select('bloque_id')->where('posicion',$posicion)->first();
        return $bloque;
    }

    public function getBloqueTipoxBanner()
    {
        $data = Bloque::select('bloques.bloque_id', 'bloques.titulo')
                        ->join('bloque_tipos', function($join)
                        {
                            $join->on('bloques.bloque_tipo_id', '=', 'bloque_tipos.bloque_tipo_id');
                            $join->where('bloque_tipos.codigo','BANNERS');
                        })
                        ->where('bloques.estado',1)
                        ->where('bloques.oculto',0)
                        ->orderBy('bloques.titulo','asc')
                        ->get();

        return $data;
    }

    public static function getBloquesFront()
    {
        $bloques = Bloque::select('bloques.bloque_id', 'bloques.bloque_tipo_id','bloque_tipos.codigo', 'bloques.config','bloques.titulo','bloques.icono')
        ->join('bloque_tipos', function($join)
        {
            $join->on('bloques.bloque_tipo_id', '=', 'bloque_tipos.bloque_tipo_id');
            $join->where('bloque_tipos.oculto',0);
        })
        ->where('bloques.estado',1)
        ->where('bloques.oculto',0)
        ->whereNotIn('bloques.bloque_id', [23])
        ->orderBy('bloques.posicion','asc')
        ->get()->toArray();

        return $bloques;
    }
}
