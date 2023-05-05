<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

use App\Models\Descuento;

use Vinkla\Hashids\Facades\Hashids;

use App\Services\{
	FrontService
};

use Cart;

class CartController extends Controller
{
    //
    public function add_to_cart(Request $request)
    {
        $sessionKey = md5(uniqid(rand(), true));
        $decrypt_id = Hashids::decode($request->producto_id);

        $cantidad = $request->cantidad;
        $producto_id = $decrypt_id[0];

        $producto = Producto::find($producto_id);

        $data['quantity'] = $cantidad;
        $data['id'] = $producto_id;
        $data['name'] = $producto->producto;
        $data['price'] = $producto->precio_oferta > 0 ? $producto->precio_oferta : $producto->precio;
        $data['attributes']['image'] = $request->producto_imagen;
        $data['attributes']['url'] = $producto->url;

        // \Cart::session($sessionKey);

        \Cart::add($data);

        $nroproducts = count(Cart::getContent());


        return response()->json(['msg'=>'sucess', 'code' => '200', 'nroproductos' => $nroproducts]);
        
        // return redirect()->back(); -->original

    }

    public function update(Request $request){
        $decrypt_id = Hashids::decode($request->id_edit);

        \Cart::update($decrypt_id[0],
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        // return redirect()->back();
        return response()->json(['msg'=>'sucess', 'code' => '200']);
    }

    public function remove(Request $request)
    {

        $decrypt_id = Hashids::decode($request->id_remove);

        \Cart::remove($decrypt_id[0]);
        // return redirect()->back();
        $nroproducts = count(Cart::getContent());

        $moneda = FrontService::getMonedaFront();

        if(isset($request->coupon)):
            $cuponvalue = Descuento::getCuponxValue($request->coupon);
            
            if($nroproducts < $cuponvalue['0']['nro_productos']):
                \Cart::clearCartConditions();
            endif;

        else:
       
            if($nroproducts == 0):
                \Cart::clearCartConditions();
            endif;

        endif;

        $cart_total = Cart::getTotal();
       

        return response()->json(['msg'=>'sucess', 'code' => '200', 'nroproductos' => $nroproducts, 'totalval' => $cart_total, 'moneda' => $moneda[0]['prefijo']]);
    }

    public function clear(Request $request)
    {
        \Cart::clear();

        return redirect()->back();
    }

    public function cupones(Request $request)
    {
        $cupon = trim($request->coupon);

        $cuponvalue = Descuento::getCuponxValue($cupon);

        $moneda = FrontService::getMonedaFront();

        $nroitems = count( Cart::getContent());
        
        if(count($cuponvalue)>0):
            if($nroitems >= $cuponvalue['0']['nro_productos']):
                
                $condition = new \Darryldecode\Cart\CartCondition(array(
                        'name' => $cuponvalue['0']['cupon'],
                        'type' => 'tax',
                        'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                        'value' => '-'.$cuponvalue['0']['porcentaje'].'%',
                        'attributes' => array( // attributes field is optional
                            'discount' => $cuponvalue['0']['porcentaje'],
                            'cupon_id' => $cuponvalue['0']['descuento_id']
                    )
                ));
                    
                \Cart::condition($condition);
    
            else:
                \Cart::clearCartConditions();
            endif;
        else:
            \Cart::clearCartConditions();
        endif;

        $cart_total = Cart::getTotal();

        return response()->json(['msg'=>'sucess', 'code' => '200', 'total' => $cart_total, 'moneda' => $moneda[0]['prefijo']]);
        // return redirect()->back();

        // return redirect()->route('pago')->with([ 'descuento_value' => $descuento_value ]);
        // return redirect()->route('pago', [$descuento_value]);
        // return redirect()->back()->with('descuento_value',$descuento_value);
        // if($cupon != ""):
        //     $condition = new \Darryldecode\Cart\CartCondition(array(
        //         'name' => 'VAT 12.5%',
        //         'type' => 'tax',
        //         'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
        //         'value' => '-5%',
        //         'attributes' => array( // attributes field is optional
        //             'description' => 'Value added tax',
        //             'more_data' => 'more data here'
        //         )
        //     ));
            
        //     \Cart::condition($condition);
        // else:
            
        //     \Cart::clearCartConditions();
       
        // endif;

        // return redirect()->back();
            
     
    }

    public function loadCart()
    {
        $cart_content = Cart::getContent();
        // $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        $moneda = FrontService::getMonedaFront();

        return view('front-partials.cart-data', compact('cart_content','cart_total', 'moneda'));
    }

    public function loadTablePago()
    {
        $moneda = FrontService::getMonedaFront();
        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        // echo count(Cart::getContent());
        $cart_subtotal = Cart::getSubTotal();
        $cart_total = Cart::getTotal();

        $descuento = Cart::getConditions();
        $discount_array = array();
        foreach($descuento as $desc):
            $discount_array['cupon'] = $desc->getName();
            $discount_array['valor'] = $desc->getValue();
            $discount_array['atributos'] = $desc->getAttributes();
            $valor_descuento = ($cart_subtotal * $discount_array['atributos']['discount'])/100;
            $discount_array['value_descuento'] = $valor_descuento;
        endforeach;

        return view('front-partials.table-pago-data', compact('cart_content','cart_total', 'cart_subtotal','moneda','discount_array'));
    }

}
