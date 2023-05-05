<?php
namespace App\Services\Admin;

use App\Models\Descuento;
use Illuminate\Http\Request;

class DescuentoService
{

    public function addArrayDataDescuento($request)
    {   
        $estado = $request->chkEstadoDescuento == "on" ? "1":"0";
        $oculto =0;
        $nroProductos = $request->nroProductos == NULL ? 0 : $request->nroProductos;

        $data = [
            "cupon" =>  trim($request->txtcupon),
            "porcentaje" => $request->txtporcentajes,
            "usado" =>0,
            "uso" => $request->cboUsoDescuento,
            "nro_productos"=> $nroProductos,
            "estado" => $estado,
            "oculto" => $oculto,
            "usuario_registro" => $request->hdd_usuario,
            "fecha_registro" => now()
        ];

        return $data;

    }

    public function updateArrayDataDescuento($request)
    {   
        $estado = $request->chkEstadoDescuento == "on" ? "1":"0";
        $oculto =0;
        $nroProductos = $request->nroProductos == NULL ? 0 : $request->nroProductos;

        $data = [
            "cupon" =>  trim($request->txtcupon),
            "porcentaje" => $request->txtporcentajes,
            "usado" =>0,
            "uso" => $request->cboUsoDescuento,
            "nro_productos"=> $nroProductos,
            "estado" => $estado,
            "oculto" => $oculto,
            "usuario_modifica" => $request->hdd_usuario,
            "fecha_modifica" => now()
        ];

        return $data;
    }   

}

?>