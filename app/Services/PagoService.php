<?php
namespace App\Services;
 
use Illuminate\Http\Request;

use App\Mail\OrdenMailable;
use Illuminate\Support\Facades\Mail;
use App\Models\Ordens;
use App\Models\Ordens_Detalle;

class PagoService
{
   /**
    * The function `mailSuccessPago` sends an email to the customer with details about a successful
    * payment for an order.
    * 
    * @param orden_id The order ID of the payment success.
    */
    public static function mailSuccessPago($orden_id)
    {
        $ordenData = Ordens::getOrdendata($orden_id);
        $ordenProductos = Ordens_Detalle::getProductosOrdenEmail($orden_id);

        $subject = "VALTECGDA - Aviso de Pago Compra Rápida #".$ordenData->n_operacion;
        
        $datamail = [
            "nombre"=>$ordenData->nombres,
            "info" => $ordenData->informacion_adicional,
            "email" => $ordenData->email,
            "fecha_pago"=>$ordenData->fecha_pago,
            "productos_carrito"=>$ordenProductos,
            "subtotal_orden" => $ordenData->subtotal,
            "descuento" => $ordenData->descuento,
            "cupon_name" => $ordenData->cupon,
            "descuento_cupon" => (int)$ordenData->porcentaje,
            "total_orden"=>$ordenData->total,
            "nro_orden"=> $ordenData->n_operacion
        ];

        $orden = new OrdenMailable($datamail, $subject);
        Mail::to($ordenData->email)->send($orden);

    }
}