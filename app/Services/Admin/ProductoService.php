<?php
namespace App\Services\Admin;
 
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Producto_Imagen;
use App\Models\Producto_codigo;
use App\Services\Admin\ImageService;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\File;

class ProductoService
{
    public function ArrayProductoAdd($request)
    {
        $urlproducto = Str::slug($request->nombreProducto);
        $precioCompra = $request->txtPrecioCompraProducto != '' ? $request->txtPrecioCompraProducto : "0.00";
        $condescuento =  $request->checkdescuento == "on" ? "1":"0";
        $precio = $request->txtPrecioProducto != '' ? $request->txtPrecioProducto : "0.00";
        $constock =  $request->chkStock == "on" ? "1":"0";
        $urlvideo = $request->videoProducto;
        $estado = $request->chkEstadoProducto == "on" ? "1":"0";
        $oculto =0;

        $arrayProducto = array();

        $data = [
            "producto" =>$request->nombreProducto,
            "descripcion_producto" =>html_entity_decode($request->descripcion_producto),
            "precio_compra"=>$precioCompra,
        ];
        
        if($condescuento == 1):
            $PrecioconDescuento = ($precio * $request->descuentoProducto) / 100;
            $precioFinal = $precio - $PrecioconDescuento;
            // $data['precio_anterior'] = $precio;
            $data['precio_anterior'] = '';
            $data['precio'] = $precio;
            $data['precio_oferta'] = $precioFinal;
            $data['descuento'] = $request->descuentoProducto;
            $data['fecha_finalizacion'] = $request->fechafinalizacion;
        else:
            $data['precio'] = $precio;
            $data['precio_oferta'] = 0.00;
            $data['descuento'] = 0;
        endif;

        $data['monedas'] = (int) $request->txtMonedasProducto;
        $data['con_stock'] = $constock;
        if($constock == 1):
            $data['stock'] = (int) $request->stockProducto;
            if($data['stock'] == 0):
                $data['agotado'] = 1;
            endif;
        else:
            $data['stock'] = 0;
            $data['agotado'] = 1;
        endif;
        
        $data['url'] = $urlproducto;
        $data['video'] = $urlvideo;
        $data['carrousel'] = $request->carouselProducto;
        $data['sku'] = $request->skuProducto;
        // $data['estreno'] = $request->EstrenoProducto;
        // $data['oferta'] = $request->OfertaProducto;
        // $data['promo_dia'] = $request->promodiaProducto;
        $data['envio_domicilio'] = $request->enviodomicilioProducto;
        $data['recojo'] = $request->recojoProducto;
        $data['contraentrega'] = $request->contraentregaProducto;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_registra'] = '46749322';
        $data['fecha_registro'] = now();

        return $data;
    }

    public function ArrayProductoUpdate($request, $producto_id)
    {
        $urlproducto = Str::slug($request->nombreProducto);
        $precioCompra = $request->txtPrecioCompraProducto != '' ? $request->txtPrecioCompraProducto : "0.00";
        $condescuento =  $request->checkdescuento == "on" ? "1":"0";
        $precio = $request->txtPrecioProducto != '' ? $request->txtPrecioProducto : "0.00";
        $constock =  $request->chkStock == "on" ? "1":"0";
        $urlvideo = $request->videoProducto;
        $estado = $request->chkEstadoProducto == "on" ? "1":"0";
        $oculto =0;
        $precioanterior = Producto::where('producto_id',$producto_id)->first();
        $data = [
            "producto"=>trim(strtoupper($request->nombreProducto)),
            "descripcion_producto"=>htmlspecialchars_decode($request->descripcion_producto),
            "precio_compra"=>$precioCompra
        ];

        if($condescuento==1):
            $PrecioconDescuento = ($precio * $request->descuentoProducto) / 100;
            $precioFinal = $precio - $PrecioconDescuento;
            if($precio != $precioanterior->precio):
                $data['precio_anterior'] = $precioanterior->precio;
                $data['precio'] = $precio;
            else:
                $data['precio'] = $precio;
            endif;
       
            $data['precio_oferta'] = $precioFinal;
            $data['descuento'] = $request->descuentoProducto;
            $data['fecha_finalizacion'] = $request->fechafinalizacion;
        else:

            if($precio != $precioanterior->precio):
                $data['precio_anterior'] = $precioanterior->precio;
                $data['precio'] = $precio;
            else:
                $data['precio'] = $precio;
            endif;
            
            $data['precio_oferta'] = 0.00;
            $data['descuento'] = 0;
            $data['fecha_finalizacion'] = null;
        endif;

        $data['monedas'] = (int) $request->txtMonedasProducto;
        $data['con_stock'] = $constock;
        if($constock == 1):
            $data['stock'] = (int) $request->stockProducto;
        else:
            $data['stock'] = 0;
        endif;
        
        $data['url'] = $urlproducto;
        $data['video'] = $urlvideo;
        $data['sku'] = $request->skuProducto;
        // $data['carrousel'] = $request->carouselProducto;
        // $data['estreno'] = $request->EstrenoProducto;
        // $data['oferta'] = $request->OfertaProducto;
        // $data['promo_dia'] = $request->promodiaProducto;
        $data['envio_domicilio'] = $request->enviodomicilioProducto;
        $data['recojo'] = $request->recojoProducto;
        $data['contraentrega'] = $request->contraentregaProducto;
        $data['estado'] = $estado;
        $data['oculto'] = $oculto;
        $data['usuario_modifica'] = '46749322';
        $data['fecha_modifica'] = Now();

        return $data;
    }

    public function verificarStock($producto_id)
    {
        $is_stock = Producto::select('con_stock')->where('producto_id', $producto_id)->first();

        if((int)$is_stock->con_stock != 0):

            $stock = Producto::getStock($producto_id);
            return $stock->stock;
        
        else:

            $countcodigos = Producto_codigo::where('producto_id', $producto_id)
                            ->where('estado',1)
                            ->where('oculto',0)
                            ->count();

            return $countcodigos;

        endif;
    }

    public function actualizarStock($producto_id, $cantidad)
    {
        $constock = Producto::select('con_stock')->where('producto_id', $producto_id)->first();
        // var_dump($constock);
        if((int)$constock->con_stock != 0):
            //si en caso el producto es con stock, se procede a restar
            $stringcodigos = '';
            $stock = Producto::getStock($producto_id);
            $nuevostock = (int)$stock->stock - $cantidad;
            $producto = Producto::find($producto_id);
            $data = [
                    'stock' => $nuevostock
            ];
            $producto->update($data);

            return $stringcodigos;
        else:
            $stringcodigos = array();
            //dentro de un FOR , por si el mismo producto se vende 2 veces en la misma orden
            for($i=0;$i<$cantidad;$i++):

                $codigo_id = Producto_codigo::select('producto_codigos_id')
                            ->where('producto_id', $producto_id)
                            ->where('estado',1)
                            ->where('oculto',0)
                            ->orderBy('producto_codigos_id','asc')
                            ->first();

                $data = [
                    'estado' => 2
                ];
                $stringcodigos[$i] = $codigo_id->producto_codigos_id;
                $codigo_producto = Producto_codigo::find($codigo_id->producto_codigos_id);
                $codigo_producto->update($data);
                
                $contarcodigos = Producto_codigo::where('producto_id', $producto_id)
                                ->where('estado',1)
                                ->where('oculto',0)
                                ->count();

                if($contarcodigos==0)
                {
                        $producto = Producto::find($producto_id);
                        $data = [
                                'agotado' => 1
                        ];
                        $producto->update($data);
                }

            endfor;

            return json_encode($stringcodigos, JSON_FORCE_OBJECT);

        endif;
    }

    public function withStock($producto_id)
    {
        $constock = Producto::select('con_stock')->where('producto_id', $producto_id)->first();
        return $constock;
    }

    public function getCodigoDisponible($producto_id, $cantidad)
    {
        $codigosProductos = array();

        for($i=0;$i<$cantidad;$i++):
            
        endfor;
    }

    public function existImageprincipal($producto_id, $idImgProducto)
    {
        $countImage = Producto_Imagen::existImage($idImgProducto);
        if($countImage>0):
            $producto_img_principal = Producto_Imagen::find($idImgProducto);
            $filename = $producto_img_principal->nombre;
            if($producto_img_principal->delete()):
                // $url = public_path('admin/images/productos/'.$producto_id.'/'.$filename);
                $url = public_path('assets/images/productos/'.$producto_id.'/'.$filename);
                // $image = ImageService::eliminarImg($url);
                echo ImageService::eliminarImg($url);
            endif;      
        endif;
    }

    public function moveImage($filename, $producto_id)
    {
        // $destino =  public_path('admin/images/productos/'.$producto_id);
        $destino =  public_path('assets/images/productos/'.$producto_id);
        echo ImageService::moveimage($filename ,$destino);
    }

}