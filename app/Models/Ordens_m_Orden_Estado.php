<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordens_m_Orden_Estado extends Model
{
    use HasFactory;

    protected $table = 'ordens_m_orden_estados';

    protected $primaryKey = 'orden_m_orden_estado_id';

    public $timestamps = false;

    protected $fillable = ['orden_id','orden_estado_id','estado','oculto','usuario_registro','fecha_registro'];

    public static function PendienteOrder($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id,
            "orden_estado_id" => 2,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"admin",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }

    public static function aprobarOrden($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id[0],
            "orden_estado_id" => 1,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"admin",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }

    public static function reachazarOrden($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id[0],
            "orden_estado_id" => 3,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"admin",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }

    public static function atenderOrden($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id[0],
            "orden_estado_id" => 4,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"admin",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }

    public static function OrdenCancelada($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id,
            "orden_estado_id" => 5,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"Usuario",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }

    public static function PendienteVerificacion($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id,
            "orden_estado_id" => 7,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"admin",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }

    public static function OrdenPendienteMP($orden_id)
    {
        $data = [
            "estado" => 0
        ];
        Ordens_m_Orden_Estado::where('orden_id', $orden_id)
                        ->update($data);
                     
        // $ordens_estado = Ordens_m_Orden_Estado::find($orden_id);
        // $ordens_estado->update($data);
        $dataestado = [
            "orden_id" => $orden_id,
            "orden_estado_id" => 8,
            "estado" => 1,
            "oculto" => 0,
            "usuario_registro"=>"Usuario",
            "fecha_registro" => now()
        ];
        return $dataestado;
    }
}
