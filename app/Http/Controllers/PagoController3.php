<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;
use App\Models\Configuracion;
use App\Models\Ordens;
use App\Models\Ordens_Detalle;
use App\Models\Ordens_m_Orden_Estado;

use App\Services\Admin\{
	ImageService,
    ProductoService
};

use MercadoPago;  
use Cart;

use App\Mail\OrdenMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;



class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {  
      // MercadoPago\SDK::setClientId(config('services.mercadopago.client_id'));  
      // MercadoPago\SDK::setClientSecret(config('services.mercadopago.client_secret'));   
      MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
    }  

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
     
        //
        // $ip = $_SERVER['REMOTE_ADDR'];
        // $captcha = $_POST['g-recaptcha-response'];
        // $secretKey = Configuracion::get_valorxvariable('go_secret_key');
        // $responsecatpcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey->valor.'&response='.$captcha.'&remoteip='.$ip);

        // echo $request->opayment;
        // ProductoService::actualizarStock("63", "2");
        $rules = [
            'pagonombresapellidos' => 'required',
            'pagoinformacionadicional' => 'required',
            'pagoemail' => 'required|email',
            'pagoemailverificar' => 'required|email|same:pagoemail',
            'aceptochk' =>'accepted',
            'payment' => 'required',
            'g-recaptcha-response'=>'required'
        ];

        if($request->opayment != 1):
            $rules['comprobanteimg']='required';
            $rules['fechapago']='required';
        endif;
        
        $messages = [
            'pagonombresapellidos.required' => 'El Campo Nombres y Apellidos es requerido',
            'pagoinformacionadicional.required'=> 'El Campo Teléfono/ Whatsapp / Facebook es requerido',
            'pagoemail.required' => 'El Campo Email es requerido',
            'pagoemail.email' => 'El Email debe ser en un formato válido',
            'pagoemailverificar.required' => 'El Campo Verificar Email es requerido',
            'pagoemailverificar.email' => 'El Email de verificación debe ser en un formato válido',
            'pagoemailverificar.same' => 'Los correos Electrónicos no coinciden.',
            'aceptochk.accepted' => 'Debe Aceptar los Términos y Condiciones de uso',
            'payment.required' => 'Debe Seleccionar un medio de Pago',
            'g-recaptcha-response.required' => 'El captcha es requerido'
        ];

        if($request->opayment != 1):
            $messages['comprobanteimg.required'] = 'El Comprobante es requerido';
            $messages['fechapago.required'] = 'La Fecha de Pago es Requerida';
        endif;

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $ip = $_SERVER['REMOTE_ADDR'];
            
            //validar el captcha
            $captcha = $_POST['g-recaptcha-response'];
            $secretKey = Configuracion::get_valorxvariable('go_secret_key');
            $responsecatpcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey->valor.'&response='.$captcha.'&remoteip='.$ip);
            $valiCaptcha = json_decode($responsecatpcha, TRUE);

            if(!$valiCaptcha['success']):
                return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
            else:

                if($request->opayment == 1):

                    return response()->json(['msg'=>'sucess', 'code' => '201']);

                elseif($request->opayment == 0):

                    $productos_carrito = Cart::getContent();

                    if(count($productos_carrito)>0):
    
                        $nordens = Ordens::countOrdens();
                        if($nordens > 0):
                            $ultimoorden_id = Ordens::getNroOrden();
                            // $nro_Orden = str_pad('0000000000',11,(int)$ultimoorden_id+1);
                            $nro_Orden = str_pad((int)$ultimoorden_id+1,11,'0', STR_PAD_LEFT);
                        else:
                            $nro_Orden = '00000000001';
                        endif;
    
                        $imgComprobante = explode("|*|", $request->comprobanteimg);
                        $cart_subtotal = Cart::getSubTotal();
                        $cart_total = Cart::getTotal();
    
                    
                        $descuento_id = NULL;
                        $descuento = 0.00;
                        $descuento_cupon = "";
                        $cupon_name = "";
                        $descs = Cart::getConditions();
                        if($descs):
                            $discount_array = array();
                            foreach($descs as $desc):
                                $cupon_name = $desc->getName();
                                $descuento_cupon = $desc->getValue();
                                $discount_array['atributos'] = $desc->getAttributes();
                                $descuento_id = $discount_array['atributos']['cupon_id'];
                                $valor_descuento = ($cart_subtotal * $discount_array['atributos']['discount'])/100;
                                $descuento = $valor_descuento;
                            endforeach;
                        endif;            
                    
                        $data = [
                            "nombres" =>$request->pagonombresapellidos,
                            "informacion_adicional"=>$request->pagoinformacionadicional,
                            "email" => $request->pagoemail,
                            "fecha_pago"=>$request->fechapago,
                            "n_operacion"=>$nro_Orden,
                            "descuento_id" => $descuento_id,
                            "comprobante"=>$imgComprobante[0],
                            "subtotal"=>$cart_subtotal,
                            "descuento"=>$descuento,
                            "total"=>$cart_total,
                            "ip"=>$ip,
                            "fecha_registro"=>now()
                        ];
    
                        if($request->opayment != 1):
                            $data['medio_pago_id'] = $request->payment;
                        else:
                            $data['medio_pago_online_id'] = $request->payment;
                        endif;
    
                        if($orden = Ordens::create($data)):
                                
                            $lastorden_id = $orden->orden_id;
                            $lastnro_orden = $orden->n_operacion;
                            foreach($productos_carrito as $procar):
    
                                $cantidad = $procar->quantity;
                                $precio = number_format((float)$procar->price, 2, '.', '');
                                
                                $verificarStock = ProductoService::verificarStock($procar->id);
    
                                if($cantidad > $verificarStock):
                                    
                                    $detalleproductoscount = Ordens_Detalle::where('orden_id',$lastorden_id)->where('oculto',0)->count();
                                    if($detalleproductoscount>0):
                                        Ordens_Detalle::where('orden_id',$lastorden_id)->delete();
                                    endif;
                                    Ordens::where('orden_id',$lastorden_id)->delete();
                                    return response()->json(['errors'=>$validator->errors(), 'code' => '427', 'producto' => $procar->name]);
                                    exit;
                                
                                else:
    
                                    $dataordendetalle = [
                                        "orden_id"=>$lastorden_id,
                                        "producto_id"=>$procar->id,
                                        "cantidad"=>$cantidad,
                                        "precio"=>$precio,
                                        "subtotal"=>$precio * $cantidad,
                                        "oculto" => 0,
                                        "usuario_registro"=>'0',
                                        "fecha_registro"=>now()
                                    ];
    
                                    ProductoService::actualizarStock($procar->id, $cantidad);
            
                                    Ordens_Detalle::create($dataordendetalle);
                            
                                endif;
        
                            endforeach;
    
                            $dataEstado = [
                                "orden_id" => $lastorden_id,
                                "orden_estado_id" => 2,
                                "oculto" => 0,
                                "usuario_registra"=>'0',
                                "fecha_registro"=>now()
                            ];
    
                            Ordens_m_Orden_Estado::create($dataEstado);
    
                            $datamail = [
                                "nombre"=>$request->pagonombresapellidos,
                                "info" => $request->pagoinformacionadicional,
                                "email" => $request->pagoemail,
                                "fecha_pago"=>$request->fechapago,
                                "productos_carrito"=>$productos_carrito,
                                "subtotal_orden" => $cart_subtotal,
                                "descuento" => $descuento,
                                "cupon_name" => $cupon_name,
                                "descuento_cupon" => $descuento_cupon,
                                "total_orden"=>$cart_total,
                                "nro_orden"=> $lastnro_orden
                            ];

                            if($request->opayment == 1):
                                return response()->json(['msg'=>'sucess', 'code' => '201']);
                            else:
                                self::moveComprobante($imgComprobante[0]);
    
                                $subject = "VALTECGDA - Aviso de Pago Compra Rápida #".$lastnro_orden;
        
                                $orden = new OrdenMailable($datamail, $subject);
                                Mail::to($request->pagoemail)->send($orden);
                                
                                \Cart::clear();
        
                                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/confirmacion_pago?type=s')]);
        
                            endif;
    
                            // self::moveComprobante($imgComprobante[0]);
    
                            // $subject = "VALTECGDA - Aviso de Pago Compra Rápida #".$lastnro_orden;
    
                            // $orden = new OrdenMailable($datamail, $subject);
                            // Mail::to($request->pagoemail)->send($orden);
                            
                            // \Cart::clear();
    
                            // return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/confirmacion_pago?type=s')]);
    
                        endif;
                        
                    else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '426']);
                    endif;
                else:
                    return response()->json(['errors'=>$validator->errors(), 'code' => '430']);
                endif;

            endif;

        //         // if(isset($cartproduct)):
        //         //     echo 'ga';
        //         // else:
        //         //     return response()->json(['errors'=>$validator->errors(), 'code' => '426']);
        //         // endif;
          
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pay(Request $request)
    {
        // $payment_id =  $request->get('payment_id');
        // $response = Http::get('https://api.mercadopago.com/v1/payments/'.$payment_id.'?access_token=TEST-5058370091006238-101813-146751339a9368590655e4c4665695ef-433123023');    
        // return $response;
    }

    public function paymentorder($order, Request $request)
    {
       $payment_id =  $request->get('payment_id');
        $response = Http::get('https://api.mercadopago.com/v1/payments/'.$payment_id.'?access_token=TEST-5058370091006238-101813-146751339a9368590655e4c4665695ef-433123023');    
        return $response;
    }   

    public function imgTmp(Request $request)
    {
        $rules = [
            'imagen'=>'mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
                
                'imagen.max'=>'El Tamaño de la Imagen no debe ser mayor a 2MB',
                'imagen.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $data = ImageService::subirImagenTmp($request);
            if($data):
                return response()->json(['data'=>$data, 'code' => '200']);
            else:
                return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
            endif;

        endif;
    }

    public function moveComprobante($comprobante)
    {
        $destino =  public_path('assets/images/comprobantes/');
        echo ImageService::moveimage($comprobante ,$destino);
    }
}
