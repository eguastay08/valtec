<?php
namespace App\Services;
 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Models\Bloque;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Banner;
use App\Models\Moneda;
use App\Models\Menu;
use App\Models\Medio_Pago;
use App\Models\Tag;
use App\Models\Noticia;
use App\Models\Noticia_Categoria;
use App\Models\Noticia_Tag;

use Carbon\Carbon;

class FrontService
{

    public function getBloqueDataFron()
    {
        $bloques = Bloque::getBloquesFront();
        
        foreach($bloques as $key=>$b):
            // $config = json_decode($b[$key]['config'], true);
            $config = json_decode($bloques[$key]['config'], true);
            $bloques[$key]['config'] = $config;

            if($b['codigo'] == 'CARROUSEL'):

                if(isset($config['categoria'])):

                    $nroitems = isset($config['nro_items']) ? $config['nro_items'] : 10;
                    $url = Categoria::getUrlxCategoria($config['categoria']);
                    $bloques[$key]['data']['url'] = 'categorias/'.$url->url;
                    $bloques[$key]['data']['categoria'] = Categoria::getCategoriaBloqueFront($config['categoria']);
                    $bloques[$key]['data']['productos'] = Producto::getProductosGlobalFront($config['categoria'], $nroitems);
                    // $bloques[$key]['data']['productos'] = Producto::();

                endif;

            endif;

            if($b['codigo'] == 'PRODUCTS'):

                if(isset($config['categoria'])):

                    $nroitems = isset($config['nro_items']) ? $config['nro_items'] : 10;
                    $url = Categoria::getUrlxCategoria($config['categoria']);
                    $bloques[$key]['data']['url'] = 'categorias/'.$url->url;
                    $bloques[$key]['data']['categoria'] = Categoria::getCategoriaBloqueFront($config['categoria']);
                    $bloques[$key]['data']['productos'] = Producto::getProductosGlobalFront($config['categoria'], $nroitems);

                endif;

            endif;

            if($b['codigo'] == 'OPINIONS'):

                $bloques[$key]['data']['opiniones'] = 'opiniones';

            endif;

            if($b['codigo'] == 'NOTICIAS'):

                $bloques[$key]['data']['noticias'] = Noticia::getNoticiasFront();

            endif;

            if($b['codigo'] == 'BANNERS'):


                $bloques[$key]['data']['banners'] = Banner::getBannerGlobalFront($b['bloque_id']);

            endif;

        endforeach;

        return $bloques;
    }

    public function getMonedaFront()
    {
        $monedas = Moneda::getMonedaFront();

        return $monedas;
    }

    public function getMenusxIdParent($parent_id)
    {
        $menus = Menu::getMenusxParent($parent_id);

        return $menus;
    }

    public function getProductoDetalle($producto)
    {
        $producto = Producto::getProductoDetalle($producto);

        return $producto;
    }   

    public function getMenusFront()
    {
        $menus = Menu::getMenus();

        return $menus;
    }

    public function getProductDataUrl($url)
    {
        $data = Producto::getProductDataUrl($url);

        return $data;
    }

    public function getProductoxUrl($url)
    {
        $producto = Producto::getProductoxUrl($url);
        
        return $producto;
    }

    public function getMediosPagoFront()
    {
        $mediospago = Medio_Pago::getMedioPagosFront();

        return $mediospago;
    }

    public function getProductosRelacionadosFront($url)
    {
        $productos_relacionads = Producto::getProductosRelacionados($url);

        return $productos_relacionads;
    }

    public function getCategoriasTreeFront()
    {
        $categorias = Categoria::get_tree();

        return $categorias;
    }

    public function getTagsFront()
    {
        $tags = Tag::getTagsFront();

        return $tags;
    }

    public function getTagTitle($url)
    {
        $data = Tag::getTagTitle($url);

        return $data;
    }

    public function getCatxUrl($url, $sub)
    {
        $data = Categoria::getCatxUrl($url, $sub);

        return $data;
    }

    public function getTagxUrl($url)
    {
        $data = Tag::getTagxUrl($url);

        return $data;
    }

    public function getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar, $order)
    {

        $productosxcategoria = Producto::getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar, $order);

        return $productosxcategoria;
    }

    public function getMaxPrecioProductosxCategoria($url, $sub)
    {
        $maxprecioProductosxCategoria = Producto::getMaxPrecioProductosxCategoria($url, $sub);

        return $maxprecioProductosxCategoria;
    }

    public function getMaxPrecioProductosxEtiqueta($url)
    {
        $maxprecioProductosxEtiqueta= Producto::getMaxPrecioProductosxEtiqueta($url);

        return $maxprecioProductosxEtiqueta;
    }
    
    public function getProductosGlobalxEtiqueta($url, $precioD, $precioH, $productobuscar, $order)
    {
        $productosxEtiquetas = Producto::getProductosGlobalxEtiqueta($url, $precioD, $precioH, $productobuscar, $order);

        return $productosxEtiquetas;
    }

    public function getProductosGlobal($precioD, $precioH, $productobuscar, $order)
    {
        $productosdata = Producto::getProductosGlobal($precioD, $precioH, $productobuscar, $order);

        return $productosdata;
    }

    public function getProductsSearch($producto)
    {
        $data  = Producto::getProductsSearch($producto);

        return $data;
    }

    public function getMaxPrecioxProducto($producto)
    {
        $data = Producto::getMaxPrecioxProducto($producto);

        return $data;
    }

    public function getNoticiasGlobal()
    {
        $noticiasData = Noticia::getNoticiasGlobal();

        return $noticiasData;
    }

    public function getNoticiaxUrl($url)
    {
        $noticia = Noticia::getNoticiaxUrl($url);
        
        return $noticia;
    }

    public function getNoticeUrlData($url)
    {
        $noticia = Noticia::getNoticeUrlData($url);
        
        return $noticia;
    }

    public function getNotCatxUrl($url, $sub)
    {
        $data = Noticia_Categoria::getNotCatxUrl($url, $sub);

        return $data;
    }

    public function getNoticiasCategoriasTreeFront()
    {
        $noticias_categorias = Noticia_Categoria::get_treeNoticiasCategories();

        return $noticias_categorias;
    }

    public function getNotTagxUrl($url)
    {
        $data = Noticia_Tag::getNotTagxUrl($url);

        return $data;
    }

    public function getNoticiasTagsFront()
    {
        $tags = Noticia_Tag::getNoticiasTagsFront();

        return $tags;
    }

    public function getNoticiasRelacionadosFront($url)
    {
        $noticias_relacionadas = Noticia::getNoticiasRelacionadas($url);

        return $noticias_relacionadas;
    }

    public function getNoticiasxCategoriaFront($url, $sub)
    {

        $noticiasxcategoria = Noticia::getNoticiasxCategoriaFront($url, $sub);

        return $noticiasxcategoria;
    }

    public function getNoticiasByEtiquetaFront($url)
    {
        $noticiasxEtiquetas = Noticia::getNoticiasByEtiquetaFront($url);

        return $noticiasxEtiquetas;
    }

    public function getImgCat($id, $sub = '')
    {
        $data = Categoria::getImgCat($id, $sub);

        return $data;
                            
    }

    public function getPaymentDescription($paymentId){
        
        $medioPagoDescription = Medio_Pago::getPaymentDescription($paymentId);

        return $medioPagoDescription;

    }

    public function getBannerPago()
    {
        $bannerPago = Banner::BannerPago();

        return $bannerPago;
    }

    public function highlightKeywords($text, $keyword)
    {
        $wordsAry = explode(" ", $keyword);
        $wordsCount = count($wordsAry);
    
        for ($i = 0; $i < $wordsCount; $i ++) {
            $highlighted_text = "<span style='font-weight:bold !important;'>$wordsAry[$i]</span>";
            $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
        }
    
        return $text;
    }


    public function ConvertFechaToString($inputfecha)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($inputfecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $fechaString = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        return $fechaString;
    }
     
    public function ConvertDatetoTime($inputfecha)
    {
        $hora = Carbon::parse($inputfecha)->format('g:i A');
        // $hora = Carbon::createFromFormat('H:i:s',$inputfecha)->format('h:i');
        return $hora;
    }




    // public function getMediosPago()
    // {
    //     $medios_pago = 
    // }

}