<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medio_Pago extends Model
{
    use HasFactory;

    protected $table = 'medio_pagos';

    protected $primaryKey = 'medio_pago_id';

    public $timestamps = false;

    protected $fillable = ['nombre','descripcion','deposito','transferencia','billetera_digital','pago_online','imagen','nombre_img','size_img','estado','oculto','usuario_registro','fecha_registro','usuario_modifica','fecha_modifica'];

    public static function getMedioPagos($mediopago, $estado)
    {
        $mediospagoData = Medio_Pago::select('medio_pago_id', 'nombre', 'descripcion','deposito','transferencia','billetera_digital','pago_online','imagen','nombre_img','size_img','estado','oculto');
        
        if (isset($mediopago) && $mediopago != ''):
            $mediospagoData ->where('nombre','LIKE','%'.$mediopago."%");
        endif;     

        if (isset($estado) && $estado != '_all_'):
            $mediospagoData ->where('estado',$estado);
        endif;    

        $mediospagoData = $mediospagoData->where('oculto',0)->orderBy('nombre', 'asc')->paginate(10);

        return $mediospagoData;
    }

    public static function getMedioPagosFront()
    {
        $mediospagoData = Medio_Pago::select('medio_pago_id','nombre','data_value','descripcion','deposito','transferencia','billetera_digital','pago_online','imagen')
                                        ->where('estado',1)->where('oculto',0)->orderBy('fecha_registro')->get();

        return $mediospagoData;
    }

    public static function getPaymentDescription($payment_id)
    {
        $mediospagoData = Medio_Pago::select('medio_pago_id','nombre','descripcion','pago_online')
        ->where('estado',1)->where('oculto',0)->where('medio_pago_id',$payment_id)->get();

        return $mediospagoData;
    }

    public static function getIsOnline($payment_id)
    {
        $data =  Medio_Pago::select('pago_online')
        ->where('estado',1)->where('oculto',0)->where('medio_pago_id',$payment_id)->first();

        return $data;
    }
    
    public static function getDataValue($medio_pago_id)
    {
        $data =  Medio_Pago::select('data_value')
        ->where('estado',1)->where('oculto',0)->where('medio_pago_id',$medio_pago_id)->first();

        return $data;
    }
    

}
