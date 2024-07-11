<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Bloque;
use App\Models\Configuracion;
use App\Models\Categoria;
use App\Models\Pregunta_Frecuente;
use App\Models\Noticia;
use App\Models\Noticia_Categoria;
use App\Models\Noticia_Tag;
use Vinkla\Hashids\Facades\Hashids;
use Cart;

// use App\Services\Admin\{
	// CategoriaService
// };
use App\Services\{
	FrontService
};

class FrontController extends Controller
{
    //
    public function getIndex()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
      
        $sliders = Slider::getSlidersFront();

        $popups = Slider::getPopupsFront();
        
        $bloques = FrontService::getBloqueDataFron();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $treecategoria = Categoria::get_frontCategoria();

        $cart_content = Cart::getContent();
        $cart_total = Cart::getTotal();
        
        $nroproductosofertas =  FrontService::getCountProductosDescuentos();

        return view('index', compact('sliders', 'popups', 'bloques', 'moneda','nroproductosofertas', 'menus', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content','cart_total'));
    }

    public function getAsNavMenus(Request $request)
    {
        $decrypt_id = Hashids::decode($request['url']);
        $submenus = FrontService::getMenusxIdParent($decrypt_id[0]);
        return $submenus;
    }


    public function getProductoDetalle($producto_id)
    {
        $decrypt_id = Hashids::decode($producto_id);
        $producto = FrontService::getProductoDetalle($decrypt_id[0]);
        return $producto;
    }

    public function postPrecioOfertaProducto(Request $request)
    {
        $decrypt_id = Hashids::decode($request['data_producto']);
        $updatePrecio = FrontService::updatePrecioProducto($decrypt_id[0]);
        $moneda = FrontService::getMonedaFront();
        $producto = FrontService::getPrecioXProducto($decrypt_id[0]);
        // return $request['data_producto'];
        return view('front-partials.precio_oferta-front', compact('moneda', 'producto'));
    }

    public function getProductFront($url)
    {

        $prodctxURL = FrontService::getProductDataUrl($url);
        if($prodctxURL===NULL):
            return redirect('/');
        endif;

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $producto = FrontService::getProductoxUrl($url);

        $mediosPago = FrontService::getMediosPagoFront();

        $productos_relacionados = FrontService::getProductosRelacionadosFront($url);

        $treecategoria = Categoria::get_frontCategoria();

        $cart_content = Cart::getContent();
        // $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        return view('producto', compact('moneda', 'menus', 'producto', 'mediosPago', 'productos_relacionados','web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content','cart_total'));
    }

    public function getCategoriaFront($url, Request $request)
    {
        $sub = '';
        $catxUrl = FrontService::getCatxUrl($url, $sub);
        if($catxUrl===NULL):
            return redirect('/');
        endif;

        $precioD = '';
        $precioH = '';
        $productobuscar = '';
        $order = '';
        $subtitleCategoria = '';
        $titulo_catFront = '';
        $precioMaxCat = 0;
        $bannercat = '';

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $categorias = FrontService::getCategoriasTreeFront();

        $etiquetas = FrontService::getTagsFront();

        $treecategoria = Categoria::get_frontCategoria();
        
        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();
  
        // if(!$request->input('btnReset')):

            if($request->input('preciod')):
                $precioD = $request->input('preciod');
            endif;
    
            if($request->input('precioh')):
                $precioH = $request->input('precioh');
            endif;
    
            if($request->input('productBusc')):
                $productobuscar = $request->input('productBusc');
            endif;
    
            if($request->input('order')):
                $order = $request->input('order');
            endif;
         
        // endif;

        $categoriaTitle = Categoria::getCategoriaTitleFront($url);

        $productosxcategorias = FrontService::getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar, $order);

        $precioMaxCat = FrontService::getMaxPrecioProductosxCategoria($url, $sub);

      
        $url_actual = $url;
        
        $sub_actual = $sub;

        // var_dump($categoriaTitle);exit;
        //  var_dump($url.'/'.$sub); exit;
        

        if($sub != ""):
            $url_lista = $url.'/'.$sub;
            $subtitleCategoria = Categoria::subCategoriaTitleFront($categoriaTitle['categoria_id'], $url_lista);
            $titulo_catFront = $categoriaTitle['categoria'] . ' / ' . $subtitleCategoria['categoria'];
            $bannercat = FrontService::getImgCat($categoriaTitle['categoria_id'], $url_lista);
        else:
            $url_lista = $url;
            $titulo_catFront = $categoriaTitle['categoria'];
            $bannercat = FrontService::getImgCat($categoriaTitle['categoria_id']);
        endif;

        return view('categorias', compact('moneda', 'sub','categoriaTitle', 'subtitleCategoria','titulo_catFront','bannercat','menus','categorias', 'etiquetas', 'productosxcategorias', 'url_actual', 'sub_actual', 'url_lista', 'precioD', 'precioH', 'productobuscar', 'order', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total', 'precioMaxCat'));
    }

    public function getCategoriaFront2($url, $sub, Request $request)
    {
        $catxUrl = FrontService::getCatxUrl($url, $sub);
        if($catxUrl===NULL):
            return redirect('/');
        endif;

        $precioD = '';
        $precioH = '';
        $productobuscar = '';
        $order = '';
        $subtitleCategoria = '';
        $titulo_catFront = '';
        $precioMaxCat = 0;
        $bannercat = '';

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $categorias = FrontService::getCategoriasTreeFront();

        $etiquetas = FrontService::getTagsFront();

        $treecategoria = Categoria::get_frontCategoria();
        
        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();
  
        // if(!$request->input('btnReset')):

            if($request->input('preciod')):
                $precioD = $request->input('preciod');
            endif;
    
            if($request->input('precioh')):
                $precioH = $request->input('precioh');
            endif;
    
            if($request->input('productBusc')):
                $productobuscar = $request->input('productBusc');
            endif;
    
            if($request->input('order')):
                $order = $request->input('order');
            endif;
         
        // endif;

        $categoriaTitle = Categoria::getCategoriaTitleFront($url);

        $productosxcategorias = FrontService::getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar, $order);

        $precioMaxCat = FrontService::getMaxPrecioProductosxCategoria($url, $sub);

      
        $url_actual = $url;
        
        $sub_actual = $sub;

        // var_dump($categoriaTitle);exit;
        //  var_dump($url.'/'.$sub); exit;
        

        if($sub != ""):
            $url_lista = $url.'/'.$sub;
            $subtitleCategoria = Categoria::subCategoriaTitleFront($categoriaTitle['categoria_id'], $url_lista);
            $titulo_catFront = $categoriaTitle['categoria'] . ' / ' . $subtitleCategoria['categoria'];
            $bannercat = FrontService::getImgCat($categoriaTitle['categoria_id'], $url_lista);
        else:
            $url_lista = $url;
            $titulo_catFront = $categoriaTitle['categoria'];
            $bannercat = FrontService::getImgCat($categoriaTitle['categoria_id']);
        endif;

        return view('categorias', compact('moneda', 'sub','categoriaTitle', 'subtitleCategoria','titulo_catFront','bannercat','menus','categorias', 'etiquetas', 'productosxcategorias', 'url_actual', 'sub_actual', 'url_lista', 'precioD', 'precioH', 'productobuscar', 'order', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total', 'precioMaxCat'));
    }

    public function getEtiquetaFront($url = '', Request $request)
    {

        $tagxUrl = FrontService::getTagxUrl($url);
        if($tagxUrl===NULL):
            return redirect('/');
        endif;

        $precioD = '';
        $precioH = '';
        $productobuscar = '';
        $order = '';
        $page = '';
        if($request->input('page')):
            $page = $request->input('page');
        endif;
        
        if($request->input('preciodtag')):
            $precioD = $request->input('preciodtag');
        endif;

        if($request->input('preciohtag')):
            $precioH = $request->input('preciohtag');
        endif;

        if($request->input('productBuscTag')):
            $productobuscar = $request->input('productBuscTag');
        endif;

        if($request->input('orderTag')):
            $order = $request->input('orderTag');
        endif;

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $treecategoria = Categoria::get_frontCategoria();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $categorias = FrontService::getCategoriasTreeFront();

        $etiquetas = FrontService::getTagsFront();

        $productosxtag = FrontService::getProductosGlobalxEtiqueta($url, $precioD, $precioH, $productobuscar, $order);

        $titleTag = FrontService::getTagTitle($url);

        $precioMaxTag = FrontService::getMaxPrecioProductosxEtiqueta($url);

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        $url_lista = $url;

        return view('etiquetas', compact('moneda', 'precioMaxTag','titleTag','menus', 'categorias', 'etiquetas', 'productosxtag', 'url', 'url_lista', 'precioD', 'precioH','productobuscar', 'order', 'page', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total'));
    }

    public function getProductosOfertas(Request $request)
    {

        $precioD = '';
        $precioH = '';
        $productobuscar = '';
        $order = '';
        $page = '';
        if($request->input('page')):
            $page = $request->input('page');
        endif;
        
        if($request->input('preciodOferta')):
            $precioD = $request->input('preciodOferta');
        endif;

        if($request->input('preciohOferta')):
            $precioH = $request->input('preciohOferta');
        endif;

        if($request->input('productofertaBusc')):
            $productobuscar = $request->input('productofertaBusc');
        endif;

        if($request->input('orderProductOferta')):
            $order = $request->input('orderProductOferta');
        endif;

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $treecategoria = Categoria::get_frontCategoria();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $categorias = FrontService::getCategoriasTreeFront();

        $etiquetas = FrontService::getTagsFront();

        $productosxOfertas = FrontService::getProductosGlobalxOfertas($precioD, $precioH, $productobuscar, $order);

        $precioMaxOfertas = FrontService::getMaxPrecioProductosOfertas($productobuscar);
        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        return view('productosOfertas', compact('moneda', 'precioMaxOfertas','menus', 'categorias', 'etiquetas', 'productosxOfertas','precioD', 'precioH','productobuscar', 'order', 'page', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total'));
    }
    

    public function getProductsSearch(Request $request)
    {   
        $productostring = $request->producto;
        $aproductosdata = array(); //nuevo array con la data de productos filtrados
        $productosArray = FrontService::getProductsSearch($productostring);
        $i = 0;
        foreach($productosArray as $pa):
            $aproductosdata[$i]['producto_id'] = $productosArray[$i]['producto_id'];
            $aproductosdata[$i]['producto'] = $productosArray[$i]['producto'];
            $aproductosdata[$i]['url'] = $productosArray[$i]['url'];
            $aproductosdata[$i]['imgproducto'] = $productosArray[$i]['imgproducto'];
            $aproductosdata[$i]['format_producto'] = FrontService::highlightKeywords($productosArray[$i]['producto'], $productostring);
            //  $aproductosdata[$i]['format_producto'] =html_entity_decode($productosArray[$i]['producto']);
            // $wordsAry = explode(" ", $productosArray[$i]['producto']);
            // $wordsCount = count($wordsAry);
            // $text ='';
            // for ($c = 0; $c < $wordsCount; $c ++):
            //     // if(strtolower(trim($request->producto)) == strtolower(trim($wordsAry[$c]))):
            //     if(stripos(trim($request->producto), trim($wordsAry[$c])) !== FALSE):
            //         $bold_text = "<span style='font-weight:bold!important;'>$wordsAry[$c]</span>";
            //         $text = str_ireplace($wordsAry[$c], $bold_text, $wordsAry);
            //         $stringval = implode(" ",$text);
            //         echo $wordsAry[$c];exit;
            //         $aproductosdata[$i]['format_producto'] = $stringval;
            //     endif;
            // endfor;
            $i++;
        endforeach;
        
        if ($request->ajax()):
            return view('front-partials.search-producto', compact('productosArray','productostring','aproductosdata'));
        endif;
    }

    public function getProductsFront(Request $request)
    {
        $precioD = '';
        $precioH = '';
        $productobuscar = '';
        $order = '';

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $treecategoria = Categoria::get_frontCategoria();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $categorias = FrontService::getCategoriasTreeFront();

        $etiquetas = FrontService::getTagsFront();

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        if($request->input('q')):
            $productobuscar = $request->input('q');
        else:
            if($request->input('productBusc')):
                $productobuscar = $request->input('productBusc');
            endif;
        endif;

        if($request->input('preciodP')):
            $precioD = $request->input('preciodP');
        endif;

        if($request->input('preciohP')):
            $precioH = $request->input('preciohP');
        endif;

        if($request->input('orderProduct')):
            $order = $request->input('orderProduct');
        endif;

        $precioMaxPro = FrontService::getMaxPrecioxProducto($productobuscar);

        $productosdata = FrontService::getProductosGlobal($precioD, $precioH, $productobuscar, $order);
  
        return view('products', compact('moneda', 'menus', 'precioMaxPro','categorias', 'etiquetas', 'productosdata', 'precioD', 'precioH', 'productobuscar','order', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total'));
    }

    public function getPagoFront(Request $request)
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $treecategoria = Categoria::get_frontCategoria();
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        // echo count(Cart::getContent());
        $cart_subtotal = Cart::getSubTotal();
        $cart_total = Cart::getTotal();
        $mediosPago = FrontService::getMediosPagoFront();
        $captchakey = Configuracion::get_valorxvariable('go_site_key');
        $bannerPago = FrontService::getBannerPago();
        $cadena64 = base64_encode('38198949:testpassword_dWEVUFGw7WYRfWFxEGJQKgjwfQzKrVnFdQQzjJ55kFlV5');
        
        $descuento = Cart::getConditions();
        $discount_array = array();
        foreach($descuento as $desc):
            $discount_array['cupon'] = $desc->getName();
            $discount_array['valor'] = $desc->getValue();
            $discount_array['atributos'] = $desc->getAttributes();
            $valor_descuento = ($cart_subtotal * $discount_array['atributos']['discount'])/100;
            $discount_array['value_descuento'] = $valor_descuento;
        endforeach;

   

        return view('pago', compact('moneda','menus','web_title','descripcion_tienda','horario_atencion','bannerPago',
        'treecategoria','cart_content','cart_subtotal','cart_total', 'mediosPago', 'captchakey', 'discount_array', 'cadena64'));
        
    }

    public function getTerminos_Condiciones()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $treecategoria = Categoria::get_frontCategoria();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();
        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        return view('terminos_condiciones', compact('web_title', 'descripcion_tienda', 'horario_atencion', 'treecategoria', 'moneda',
                                                    'menus', 'cart_content','cart_total'));
    }

    public function getConfirmacion_pago(Request $request)
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $mensaje_ok = Configuracion::get_valorxvariable('mensaje_ok_carrito');
        $mensaje_fail = Configuracion::get_valorxvariable('mensaje_fail_carrito');
        $mensaje_pending = Configuracion::get_valorxvariable('mensaje_pending_carrito');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $menus = FrontService::getMenusFront();

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $moneda = FrontService::getMonedaFront();

        $type=$request->input('type');

        $treecategoria = Categoria::get_frontCategoria();

        return view('confirmacion_pago', compact('web_title','cart_content','cart_total','moneda','descripcion_tienda','horario_atencion','menus','treecategoria', 'type', 'mensaje_ok', 'mensaje_fail', 'mensaje_pending'));
    }

    public function getOpiniones()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $treecategoria = Categoria::get_frontCategoria();
        $captchakey = Configuracion::get_valorxvariable('go_site_key');

        return view('opiniones', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','treecategoria','captchakey'));
    }

    public function getNosotros()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        // $treecategoria = Categoria::get_frontCategoria();
        return view('nosotros', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','cart_content')); 
    }

    public function getFormasCostosEntrega()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        // $treecategoria = Categoria::get_frontCategoria();
        return view('formas_costos_entrega', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','cart_content')); 
    }

    public function getPreguntasFrecuentes()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $treecategoria = Categoria::get_frontCategoria();
        $preguntasFrecuentes = Pregunta_Frecuente::preguntasFrecuentesFront();

        return view('preguntas_frecuentes', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','treecategoria','preguntasFrecuentes', 'cart_content'));
    }

    public function getPasosCompra()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        // $treecategoria = Categoria::get_frontCategoria();
        return view('pasos_compras', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','cart_content'));
    }

    public function contactForm()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $treecategoria = Categoria::get_frontCategoria();
        $captchakey = Configuracion::get_valorxvariable('go_site_key');

        return view('contacto', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','treecategoria','captchakey', 'cart_content'));
    }

    public function medioPagosFront()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $treecategoria = Categoria::get_frontCategoria();
        $mediosPago = FrontService::getMediosPagoFront();

        return view('mediospago', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','treecategoria', 'mediosPago','cart_content'));
    }

    public function getPoliticasPrivacidad()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        // $treecategoria = Categoria::get_frontCategoria();
        return view('politica_privacidad', compact('web_title','descripcion_tienda','horario_atencion','menus','moneda','cart','cart_total','cart_content'));
    }

    public function getConfirmacion_Correo(Request $request)
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $mensaje_ok = Configuracion::get_valorxvariable('mensaje_ok_carrito');
        $mensaje_fail = Configuracion::get_valorxvariable('mensaje_fail_carrito');
        $mensaje_pending = Configuracion::get_valorxvariable('mensaje_pending_carrito');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $menus = FrontService::getMenusFront();

        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $moneda = FrontService::getMonedaFront();

        $type=$request->input('type');

        $treecategoria = Categoria::get_frontCategoria();

        return view('confirmacion_correo', compact('web_title','cart','cart_content','cart_total','moneda','descripcion_tienda','horario_atencion','menus','treecategoria', 'type', 'mensaje_ok', 'mensaje_fail', 'mensaje_pending'));
    }

    public function getNoticiasFront()
    {
        
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $treecategoria = Categoria::get_frontCategoria();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $noticias_categorias = FrontService::getNoticiasCategoriasTreeFront();

        $noticias_etiquetas = FrontService::getNoticiasTagsFront();

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        $noticias = FrontService::getNoticiasGlobal();
        
        return view('noticias', compact('moneda', 'menus', 'noticias','noticias_categorias','noticias_etiquetas','web_title','descripcion_tienda','horario_atencion','cart_content','cart_total', 'treecategoria'));
    }

    public function getNoticiaFront($url)
    {
        $noticeUrl = FrontService::getNoticeUrlData($url);
        if($noticeUrl===NULL):
            return redirect('/');
        endif;


        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $moneda = FrontService::getMonedaFront();

        $noticia = FrontService::getNoticiaxUrl($url);

        $noticias_categorias = FrontService::getNoticiasCategoriasTreeFront();

        $noticias_etiquetas = FrontService::getNoticiasTagsFront();

        $noticias_relacionadas = FrontService::getNoticiasRelacionadosFront($url);

        $menus = FrontService::getMenusFront();

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        $treecategoria = Categoria::get_frontCategoria();

        $fechaNoticia = FrontService::ConvertFechaToString($noticia["fecha_registro"]);
        $horaNoticia = FrontService::ConvertDatetoTime($noticia["fecha_registro"]);


        return view('noticia', compact('moneda', 'menus', 'noticia','noticias_categorias','noticias_etiquetas','noticias_relacionadas','fechaNoticia', 'horaNoticia','web_title','descripcion_tienda','horario_atencion','cart_content','cart_total', 'treecategoria'));

    }
    
    public function getNoticiaByCategoriesFront($url, $sub = '')
    {

        $notCatxUrl = FrontService::getNotCatxUrl($url, $sub);
        if($notCatxUrl===NULL):
            return redirect('/');
        endif;

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $moneda = FrontService::getMonedaFront();

        $noticias_categorias = FrontService::getNoticiasCategoriasTreeFront();

        $noticias_etiquetas = FrontService::getNoticiasTagsFront();

        $titulo_cat = Noticia_Categoria::getNoticiaCategoriaxUrl($url);

        $menus = FrontService::getMenusFront();

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        $treecategoria = Categoria::get_frontCategoria();

        $noticiasxcategoria = FrontService::getNoticiasxCategoriaFront($url, $sub);

        $url_actual = $url;
        
        $sub_actual = $sub;

        $noticia_categoria_title = $titulo_cat[0]['noticia_categoria'];

        if($sub != ""):
            $url_lista = $url.'/'.$sub;
            $titulo_sub = Noticia_Categoria::getNoticiaCategoriaxUrl($sub);
            $noticia_categoria_title = $noticia_categoria_title.' / '.$titulo_sub[0]['noticia_categoria'];
        else:
            $url_lista = $url;
        endif;


        return view('noticias_categoria', compact('web_title','noticiasxcategoria','noticia_categoria_title','descripcion_tienda', 'horario_atencion', 'moneda', 'noticias_categorias', 'noticias_etiquetas', 'menus', 'cart_content','cart_total','url_actual', 'sub_actual','url_lista','treecategoria'));


    }

    public function getNoticiaByEtiquetaFront($url, Request $request)
    {

        $notTagxUrl = FrontService::getNotTagxUrl($url);
        if($notTagxUrl===NULL):
            return redirect('/');
        endif;

        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');

        $treecategoria = Categoria::get_frontCategoria();

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $noticias_categorias = FrontService::getNoticiasCategoriasTreeFront();

        $noticias_etiquetas = FrontService::getNoticiasTagsFront();

        $noticiasxtag = FrontService::getNoticiasByEtiquetaFront($url);

        $noticia_tag_title = Noticia_Tag::getNoticiaTagxUrl($url);

        $cart_content = Cart::getContent();
        $cart_content = $cart_content->sort();
        $cart_total = Cart::getTotal();

        return view('noticias_etiquetas', compact('moneda', 'menus', 'noticia_tag_title', 'noticias_categorias', 'noticias_etiquetas', 'noticiasxtag', 'url', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total'));
    }

    public function sendSuscripcion(Request $request)
    {
        $data = FrontService::sendSuscripcion($request->email);

        return $data;
    }

    public function getLibro_Reclamaciones()
    {
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $moneda = FrontService::getMonedaFront();
        $menus = FrontService::getMenusFront();
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
        $cart_content = Cart::getContent();
        $cart = $cart_content->sort();
        $cart_total = Cart::getTotal();
        $treecategoria = Categoria::get_frontCategoria();
        $captchakey = Configuracion::get_valorxvariable('go_site_key');

        return view('libro_reclamaciones', compact('captchakey','moneda', 'menus', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content', 'cart_total'));
    }

    public function getPaymentDescription($mediopagoid)
    {
        $decrypt_id = Hashids::decode($mediopagoid);
        $descripcion_payment = FrontService::getPaymentDescription($decrypt_id[0]);
        return $descripcion_payment;
    }

    public function get404NotFound()
    {
        
        $web_title = Configuracion::get_valorxvariable('website_title');
        $descripcion_tienda = Configuracion::get_valorxvariable('descripcion_tienda');
        $horario_atencion = Configuracion::get_valorxvariable('horario_atencion');
      

        $moneda = FrontService::getMonedaFront();

        $menus = FrontService::getMenusFront();

        $treecategoria = Categoria::get_frontCategoria();

        $cart_content = Cart::getContent();
        $cart_total = Cart::getTotal();

        return view('404', compact('moneda', 'menus', 'web_title','descripcion_tienda','horario_atencion','treecategoria', 'cart_content','cart_total'));
    }
    

}
