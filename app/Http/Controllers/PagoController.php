<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\File;
use App\Models\Configuracion;
use App\Models\Ordens;
use App\Models\Ordens_Detalle;
use App\Models\Ordens_m_Orden_Estado;
use App\Models\Producto_codigo;
use App\Models\Producto;
use App\Models\Moneda;
use App\Models\Medio_Pago;

use App\Services\Admin\{
	ImageService,
    ProductoService
};

use App\Services\PagoService;

use MercadoPago;  
use Omnipay\Omnipay;
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
    private $gateway;

    public function __construct()  
    {  
        // MercadoPago\SDK::setClientId(config('services.mercadopago.client_id'));  
        // MercadoPago\SDK::setClientSecret(config('services.mercadopago.client_secret'));   
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Datos Paypal
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId("ASVZ0-vziXOVycPZhMMQe0RHmcCmrGDwDN1QZK4y4jejTJRnxQfybsRWc79rL5QUXrElvhDlsCZhQ4US");
        $this->gateway->setSecret("EOYg8SBs-r-ypOWYdGDu15Q4CAWqMSlWhmbAoBs6ZQI8TtxXdPalxSWI3q2Ene4rH05WHKOJ4F0KOPh0");
        $this->gateway->setTestMode(true);
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
        $rules = [
            'pagonombresapellidos' => 'required',
            'pagoinformacionadicional' => 'required',
            'pagoemail' => 'required|email',
            'pagoemailverificar' => 'required|email|same:pagoemail',
            'aceptochk' =>'accepted',
            'payment' => 'required',
            'billing_state'=>'required',
            'city'=>'required',
            'address'=>'required',
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
            'g-recaptcha-response.required' => 'El captcha es requerido',
            'billing_state.required' => 'El Campo Provincia es requerido',
            'city.required' => 'El Campo Ciudad es requerido',
            'address.required' => 'El Campo Dirección es requerido',
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
            $decript_medio_pago_id = Hashids::decode($request->payment);
            $is_online = Medio_Pago::getIsOnline($decript_medio_pago_id[0]); //para saber si el método es pago online o no

            if(false):
                return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
            else:

                $productos_carrito = Cart::getContent();

                if(count($productos_carrito)>0):

                    $nordens = Ordens::countOrdens();

                    if($nordens > 0):
                        $ultimoorden_id = Ordens::getNroOrden(); //obtener el ultimo ID de ORDEN
                        // $nro_Orden = str_pad('0000000000',11,(int)$ultimoorden_id+1);
                        // $nro_Orden = str_pad((int)$ultimoorden_id+1,30,'0', STR_PAD_LEFT);
                        $newidorder =   $ultimoorden_id + 1;
                        $nro_Orden = 'ESID-0'.(string) $newidorder;
                    else:
                        $nro_Orden = 'ESID-01';
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
                        "medio_pago_id" => $decript_medio_pago_id[0],
                        "nombres" =>$request->pagonombresapellidos,
                        "informacion_adicional"=>$request->pagoinformacionadicional,
                        "email" => $request->pagoemail,
                        "provincia"=>$request->billing_state,
                        "ciudad"=>$request->city,
                        "direccion"=>$request->address,
                        "direccion2"=>$request->address2,
                        "comentario"=>$request->order_comments,
                        "descuento_id" => $descuento_id,
                        "comprobante"=>$imgComprobante[0],
                        "subtotal"=>$cart_subtotal,
                        "descuento"=>$descuento,
                        "total"=>$cart_total,
                        "ip"=>$ip,
                        "fecha_registro"=>now()
                    ];

                    if($request->opayment != 1):
                  
                        // $data['email'] = $request->pagoemail;
                        $data['fecha_pago'] = $request->fechapago;
                        $data['n_operacion'] = $nro_Orden;
                    endif;

                    if($orden = Ordens::create($data)):
                            
                        $lastorden_id = $orden->orden_id;
                        $lastnro_orden = $orden->n_operacion;
                        foreach($productos_carrito as $procar):

                            $cantidad = $procar->quantity;
                            $precio = number_format((float)$procar->price, 2, '.', '');
                            
                            $verificarStock = ProductoService::verificarStock($procar->id);

                            if($cantidad > (int) $verificarStock):
                                
                                $detalleproductoscount = Ordens_Detalle::where('orden_id',$lastorden_id)->where('oculto',0)->count();
                                if($detalleproductoscount>0):
                                    Ordens_Detalle::where('orden_id',$lastorden_id)->delete();
                                endif;
                                Ordens::where('orden_id',$lastorden_id)->delete();
                                return response()->json(['errors'=>$validator->errors(), 'code' => '427', 'producto' => $procar->name]);
                                exit;
                            
                            else:
                            
                                $codigosProducto = ProductoService::actualizarStock($procar->id, $cantidad);

                                $dataordendetalle = [
                                    "orden_id"=>$lastorden_id,
                                    "producto_id"=>$procar->id,
                                    "cantidad"=>$cantidad,
                                    "precio"=>$precio,
                                    "subtotal"=>$precio * $cantidad,
                                    "codigo_producto"=>$codigosProducto,
                                    "oculto" => 0,
                                    "usuario_registro"=>'admin',
                                    "fecha_registro"=>now()
                                ];
        
                                Ordens_Detalle::create($dataordendetalle);
                        
                            endif;
    
                        endforeach;

                        if($is_online['pago_online'] == 1):
                            $oestado_id = 6; //En proceso 
                        else:
                            $oestado_id = 2; //Pendiente
                        endif;


                        $dataEstado = [
                            "orden_id" => $lastorden_id,
                            "orden_estado_id" => $oestado_id,
                            "estado"=>1,
                            "oculto" => 0,
                            "usuario_registro"=>'admin',
                            "fecha_registro"=>now()
                        ];

                    
                        Ordens_m_Orden_Estado::create($dataEstado);
                        
                        if($is_online['pago_online'] == 1):
                            $cart_total = Cart::getTotal();
                            $tipo_cambio = Moneda::getTipoCambio();
                            if($tipo_cambio[0]["tipo_cambio"]!=='0.00'){
                                $valorConvertido = $cart_total / $tipo_cambio[0]["tipo_cambio"];
                            }else{
                                $valorConvertido = $cart_total;
                            }
                            $valor_Dolares = number_format($valorConvertido, 2, '.', '' );
                            $medioPago = Medio_Pago::getDataValue($decript_medio_pago_id[0]);
                            
                            if($medioPago->data_value == 'paypal'):
                                try {
                                    //code...
                                    $response = $this->gateway->purchase(array(
                                        'amount'=>$valor_Dolares,
                                        'items' => array(
                                            array(
                                                'name'=>'Pago Online - VALEC',
                                                'price' => $valor_Dolares,
                                                'description'=>'VALTEC',
                                                'quantity'=>1,
                                            )
                                        ),
                                        'currency'=>"USD",
                                        'returnUrl'=> route('order.paymentorder', $lastorden_id),
                                        'cancelUrl'=> route('order.failureorder', $lastorden_id)
                                    ))->send();

                                    if($response->isRedirect()):
                                        \Cart::clear();
                                        $url =  $response->getRedirectUrl();
                                        return response()->json(['msg'=>'sucess', 'code' => '201', 'url'=>$url]);
                                    
                                    else: 
                                    
                                        return "Error en paypal : ". $response->getMessage();

                                    endif;

                                } catch (\Throwable $th) {
                                    return "Error en paypal : ".$th->getMessage();
                                }
                            elseif($medioPago->data_value == 'payphone'):
                                try{
                                    $parametros = [
                                        "amount" => str_replace('.', '', $valor_Dolares),
                                        "amountWithoutTax" => str_replace('.', '', $valor_Dolares),
                                        "clientTransactionID" => $lastorden_id,
                                        "responseUrl" => route('order.paymentorderpayphone', $lastorden_id),
                                        "cancellationUrl" => route('order.failureorder', $lastorden_id)
                                    ];

                                    $ch = curl_init('https://pay.payphonetodoesposible.com/api/button/Prepare');

                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                        'Authorization: Bearer Q8lavPcjqVIg_B-k19fLlS9kFHEGwzfQqQ287tqt4vNSkTx7ivhZdmCfUOo5wpYWkg5Xh76Vgqh4RnnppyrafelREuEUnfVCrBEm066gb6VwXAfs6KCDUzuvpRlWqF8TJNAbronwzEbrcjF-T2qUtJFU3We6Zuq0j9kqCcRthacRA47jn0X1NKhjkOIV8TPKP_aMaI2yj2j7Bt-PCaKwSFmUk50IkDhFaP30dyJ9MKENPWQpRo3d2OpUacXrzVudXu73t6ZTdx7J564DH0UxTuGXL0Hiz6gZpaRvurTZ4A3I8RObwCgx-nJs95eRm5jM5YHRFkbcG-WKyfU_Ja0X2IWLa9Q',
                                        'Content-Type: application/json'
                                    ]);
                                    curl_setopt($ch, CURLOPT_POST, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parametros));

                                    $response = curl_exec($ch);

                                    if (curl_errno($ch)) {
                                        return "Error en payphone curl : ". $response->getMessage();
                                    } else {
                                        $respuesta = json_decode($response, true);
                                        if (isset($respuesta['payWithCard'])) {
                                            \Cart::clear();
                                            $url =  $respuesta['payWithCard'];
                                            return response()->json(['msg'=>'sucess', 'code' => '201', 'url'=>$url]);
                                            exit;
                                        } else {
                                            return "Error en payphone : ". $response->getMessage();
                                        }
                                    }
                                    curl_close($ch);
                                } catch (\Throwable $th) {
                                    return "Error en payphone global : ".$th->getMessage();
                                }


                            elseif($medioPago->data_value == 'mercado-pago'):
                            
                                 // SDK de Mercado Pago
                                require base_path('/vendor/autoload.php');
                                // Agrega credenciales
                                MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

                                // Crea un objeto de preferencia
                                $preference = new MercadoPago\Preference();

                                // Crea un ítem en la preferencia
                                $numItem = 0;
                                $namemp = '';
                                $arrayItems = array();
                                $cart_content = Cart::getContent();
                                $cart_subtotal = Cart::getSubTotal();
                                $cart_total = Cart::getTotal();

                                foreach($cart_content as $cc)
                                {
                                    $namemp .= $cc->name." (".$cc->quantity.")";
                                    if($numItem < count($cart_content))
                                    {
                                        $namemp .= ", ";
                                    }
                                }   

                                $item = new MercadoPago\Item();
                                $item->title = $namemp;
                                $item->quantity = 1;
                                $item->unit_price = $cart_total;

                                $arrayItems[] = $item;
                                $numItem++;

                                $preference->back_urls = array(
                                    "success"=>route('mercadopago.success',$lastorden_id),
                                    "failure"=>route('mercadopago.fail', $lastorden_id),
                                    "pending"=>route('mercadopago.pending', $lastorden_id),
                                );

                                $preference->auto_return = "approved";

                                $preference->items = $arrayItems;
                                $preference->save();

                                $link = $preference->init_point;
                                
                                \Cart::clear();

                                return response()->json(['msg'=>'sucess', 'code' => '201', 'url'=>$link]);

                            endif;

                        elseif($is_online['pago_online'] == 0):

                            self::moveComprobante($imgComprobante[0]);
                            
                            PagoService::mailSuccessPago($lastorden_id);
                            
                            \Cart::clear();
    
                            return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/confirmacion_pago?type=s')]);
    
                        else:

                            return response()->json(['errors'=>$validator->errors(), 'code' => '430']);

                        endif;

                    endif;
                    
                else:
                    return response()->json(['errors'=>$validator->errors(), 'code' => '426']);
                endif;


            endif;

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

    //MercadoPago
    public function MercadoPagoSuccess($lastorden_id, Request $request)
    {
        if($request->input('payment_id')):

            $data = [
                "fecha_pago"=>now(),
                "n_operacion"=>$request->input('payment_id')
            ];

            $order = Ordens::find($lastorden_id);

            if($order->update($data)):
                    
                $type = "type=s";

               $ordenpendiente = Ordens_m_Orden_Estado::PendienteVerificacion($lastorden_id);

                Ordens_m_Orden_Estado::create($ordenpendiente);

                PagoService::mailSuccessPago($lastorden_id);

                return \Redirect::route('pago.confirmacion', $type);
            else:
                $type = "type=f";
                
                echo self::failOrder($lastorden_id);

                return \Redirect::route('pago.confirmacion', $type);
            endif;


        endif;
    }

    public function MercadoPagoFail($lastorden_id, Request $request)
    {
        $type = "type=f";
                    
        echo self::failOrder($lastorden_id);

        return \Redirect::route('pago.confirmacion', $type);
    }

    public function MercadoPagoPending($lastorden_id, Request $request)
    {
        $type = "type=p";
        $orden = Ordens_m_Orden_Estado::OrdenPendienteMP($lastorden_id);
        Ordens_m_Orden_Estado::create($orden);
        return \Redirect::route('pago.confirmacion', $type);
    }

    //paypal

    public function pay(Request $request)
    {
        // $payment_id =  $request->get('payment_id');
        // $response = Http::get('https://api.mercadopago.com/v1/payments/'.$payment_id.'?access_token=TEST-5058370091006238-101813-146751339a9368590655e4c4665695ef-433123023');    
        // return $response;
        
        //example Paypal
        // $cart_total = Cart::getTotal();
        // try {
        //     //code...
        //     $response = $this->gateway->purchase(array(
        //         'amount'=>$cart_total,
        //         'currency'=>env('PAYPAL_CURRENCY'),
        //         'returnUrl'=> url('success'),
        //         'cancelUrl'=> url('error')
        //     ))->send();

        //     if($response->isRedirect()):
        //        $url =  $response->getRedirectUrl();
        //     //    print $url;
        //         return response()->json(['msg'=>'sucess', 'code' => '201', 'url'=>$url]);
        //         //  $response->redirect();
        //         // return 'ga';
            
        //     else: 
            
        //         return $response->getMessage();

        //     endif;

        // } catch (\Throwable $th) {
        //     return $th->getMessage();
        // }
    }

    //paypal
    public function paymentorder($lastorden_id, Request $request)
    {

        if($request->input('paymentId') && $request->input('PayerID')):

            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference'=>$request->input('paymentId')
            ));

            $response = $transaction->send();

            if($response->isSuccessful()):

                $arr_body = $response->getData();

                // var_dump($arr['transactions'][0]['related_resources'][0]['sale']['create_time']);exit;
                $data = [
                    "email"=>$arr_body['payer']['payer_info']['email'],
                    "fecha_pago"=>$arr_body['transactions'][0]['related_resources'][0]['sale']['create_time'],
                    // "n_operacion"=>$arr['id']
                    "n_operacion"=>$arr_body['id']
                ];
                $order = Ordens::find($lastorden_id);

                if($order->update($data)):
                    
                    $type = "type=s";

                   $ordenpendiente = Ordens_m_Orden_Estado::PendienteVerificacion($lastorden_id);

                    Ordens_m_Orden_Estado::create($ordenpendiente);

                    PagoService::mailSuccessPago($lastorden_id);

                    return \Redirect::route('pago.confirmacion', $type);
                else:
                    $type = "type=f";
                    
                    echo self::failOrder($lastorden_id);

                    return \Redirect::route('pago.confirmacion', $type);
                endif;

            else:
                
                echo self::failOrder($lastorden_id);

                return $response->getMessage();

            endif;

        endif;

    }   

    public function paymentorderpayphone($lastorden_id, Request $request)
    {
        
        if($request->input('id') && $request->input('clientTransactionId')):
            $transaccion = $request->input('id');
            $client = $request->input('clientTransactionId');

            $data_array = array(
                "id"=> (int)$transaccion,
                "clientTxId"=>$client 
            );
            $data = json_encode($data_array);

            //Iniciar Llamada
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://pay.payphonetodoesposible.com/api/button/V2/Confirm");
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer urzG0xF9B_NSQjT_eHDg7obrIaMGFuec0P0dyfheKbkc2SY__5LjPVpf6FkMTuZcaqMzNL4hL-WZ9Ul-CsJS8cY9EHodCZNyBDW4nmVRe6TaellbWATsn9aYEkH9KXh2lA9361DTJ9kLg_EpnsPiA2U_UMlETLaCmzGQnMbGpne_YvXga3ly-OGRA2z7DCGbHBRbNLrawa1PKoZXP7PdRl8dRKP9QpbuFvlcA5II9aoUj8y91iewuHAX_xFNG2Vz0xHAUTgU_iiIvKrghc8nb3VE2UmVq5vx6f_kM08jIMJIYw7G4ll3BhQ1LWKraWydjGQf1Q", "Content-Type:application/json"),
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result);

            //En la variable result obtienes todos los parámetros de respuesta

            if($result->transactionStatus=='Approved'):
                // var_dump($arr['transactions'][0]['related_resources'][0]['sale']['create_time']);exit;
                $data = [
                    "email"=>$result->email,
                    "fecha_pago"=>$result->date,
                    // "n_operacion"=>$arr['id']
                    "n_operacion"=>$result->clientTransactionId
                ];
                $order = Ordens::find($lastorden_id);

                if($order->update($data)):
                    
                    $type = "type=s";

                   $ordenpendiente = Ordens_m_Orden_Estado::PendienteVerificacion($lastorden_id);

                    Ordens_m_Orden_Estado::create($ordenpendiente);

                    PagoService::mailSuccessPago($lastorden_id);

                    return \Redirect::route('pago.confirmacion', $type);
                else:
                    $type = "type=f";
                    
                    echo self::failOrder($lastorden_id);

                    return \Redirect::route('pago.confirmacion', $type);
                endif;

            else:
                
                echo self::failOrder($lastorden_id);

                return $response->getMessage();

            endif;

        endif;

    }   

    public function failOrder($lastorden_id)
    {
        //Método solo para pagos por medio online
        $type = "type=ca";

        $orden = Ordens_m_Orden_Estado::OrdenCancelada($lastorden_id);

        $productosOrden = Ordens_Detalle::getProductosxOrden($lastorden_id);

        foreach($productosOrden as $po):
                $constock = ProductoService::withStock($po['producto_id']);
                if($constock->con_stock != 0):
                    $stock = Producto::getStock($po['producto_id']);
                    $nuevo_stock = (int)$stock->stock + (int)$po['cantidad'];
                    $producto = Producto::find($po['producto_id']);
                    $dataStock = [
                            'stock' => $nuevo_stock
                    ];
                    $producto->update($dataStock);
                else:
                    $arrayCodigos = json_decode($po['codigo_producto']);
                    foreach($arrayCodigos as $ac):
                        $data = [
                            "estado"=>1
                        ];
                        $codigoProducto = Producto_codigo::find($ac);
                        $codigoProducto->update($data);
                    endforeach;
                endif;
        endforeach;       
        Ordens_m_Orden_Estado::create($orden);
        return \Redirect::route('pago.confirmacion', $type);

    }

    public function pendindOrder()
    {

        // $type = "type=pending";
        // return \Redirect::route('pago.confirmacion', $type);
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
