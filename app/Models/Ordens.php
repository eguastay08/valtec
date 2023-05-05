<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordens extends Model
{
    use HasFactory;

    protected $table = 'ordens';

    protected $primaryKey = 'orden_id';

    public $timestamps = false;

    protected $fillable = ['medio_pago_id','nombres','informacion_adicional','email','fecha_pago','n_operacion','descuento_id','comprobante','subtotal','descuento','total','ip','fecha_registro'];

    public function countOrdens()
    {
        $orden = Ordens::count();
        return $orden;
    }

    public function getNroOrden()
    {
        // $orden = Ordens::select('orden_id')->max('orden_id');
        $orden = Ordens::whereNotNull('medio_pago_id')->max('orden_id');
        return $orden;
    }

    public function getOrdenes()
    {
        $ordenes =  Ordens::select('ordens.orden_id','ordens.nombres','ordens.informacion_adicional','ordens.email', 'ordens.comprobante',
                            'ordens.fecha_pago','ordens.subtotal','ordens.descuento','ordens.total','ordens.ip', 'ordens.n_operacion',
                            'ordens.fecha_registro','oee.orden_estado_id','oest.estado','des.cupon', 'mp.nombre as mediopago')
                            ->leftJoin('descuentos as des', function($join)
                            {
                                $join->on('ordens.descuento_id', '=', 'des.descuento_id');
                            })
                            ->leftJoin('medio_pagos as mp', function($join)
                            {
                                $join->on('ordens.medio_pago_id', '=', 'mp.medio_pago_id');
                            })
                            // ->leftJoin('medios_pago_online as mpo', function($join)
                            // {
                            //     $join->on('ordens.medio_pago_online_id', '=', 'mpo.medio_pago_online_id');
                            // })
                            ->join('ordens_m_orden_estados as oee', function($join)
                            {
                                $join->on('ordens.orden_id', '=', 'oee.orden_id');
                                $join->where('oee.estado',1);
                            })
                            ->join('ordens_estados as oest', function($join)
                            {
                                $join->on('oee.orden_estado_id', '=', 'oest.orden_estado_id');
                                $join->where('oest.oculto',0);
                            })
                            ->orderBy('orden_id','ASC')
                            ->paginate(20);
        return $ordenes;
    }

    public function getOrdendata($orden_id)
    {
        $ordendata = Ordens::select('ordens.nombres', 'ordens.email', 'ordens.fecha_pago', 'ordens.informacion_adicional', 'ordens.subtotal',
                                    'ordens.descuento', 'ordens.total', 'desc.cupon', 'ordens.n_operacion', 'desc.porcentaje')
                            ->leftJoin('descuentos as desc', function($join)
                            {
                                $join->on('ordens.descuento_id', '=', 'desc.descuento_id');
                            })
                            ->where('orden_id', $orden_id)
                            ->first();
        return $ordendata;
    }

}
