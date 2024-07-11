<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordens_Detalle extends Model
{
    use HasFactory;

    protected $table = 'ordens_detalles';

    protected $primaryKey = 'orden_detalle_id';

    public $timestamps = false;

    protected $fillable = ['orden_id','producto_id','cantidad','precio','subtotal','codigo_producto','oculto','usuario_registro','fecha_registro'];

    public static function getOrdenDetalle($orden_id)
    {
        $ordendetalle = Ordens_Detalle::select('ordens_detalles.orden_detalle_id','ordens_detalles.orden_id',
                                                 'ordens_detalles.producto_id', 'pro.producto','pi.url as image','ordens_detalles.cantidad',
                                                 'ordens_detalles.precio','ordens_detalles.subtotal',
                                                  'ordens_detalles.codigo_producto')
                                        ->join('productos as pro', function($join)
                                        {
                                            $join->on('ordens_detalles.producto_id', '=', 'pro.producto_id');
                                        })
                                        ->leftJoin('producto__imagens as pi', function($join)
                                        {
                                            $join->on('ordens_detalles.producto_id', '=', 'pi.producto_id');
                                            $join->where('pi.principal',1);
                                        })
                                        ->where('ordens_detalles.orden_id', $orden_id)    
                                        ->orderBy('ordens_detalles.orden_detalle_id','asc')
                                        ->get();

        return $ordendetalle;
        
    }

    public static function getProductosxOrden($orden_id)
    {
        $ordenproducto = Ordens_Detalle::select('orden_detalle_id','orden_id','producto_id','cantidad', 'codigo_producto')
                        ->where('orden_id', $orden_id)    
                        ->get()->toArray();

        return $ordenproducto;
    }

    public static function getProductosOrdenEmail($orden_id)
    {
        $productos = Ordens_Detalle::select('ordens_detalles.orden_detalle_id','ordens_detalles.orden_id',
                                        'ordens_detalles.producto_id','ordens_detalles.cantidad as quantity', 'ordens_detalles.precio as price',
                                        'ordens_detalles.subtotal','pro.producto as name','pi.url as image')
                                    ->join('productos as pro', function($join)
                                    {
                                        $join->on('ordens_detalles.producto_id', '=', 'pro.producto_id');
                                    })
                                    ->leftJoin('producto__imagens as pi', function($join)
                                        {
                                            $join->on('ordens_detalles.producto_id', '=', 'pi.producto_id');
                                            $join->where('pi.principal',1);
                                        })
                                    ->where('orden_id', $orden_id)    
                                    ->get();

        return $productos;
    }

    public static function aproCodigos($codigos)
    {
        $codigoArray = json_decode($codigos);
        return $codigoArray;
    }

}
