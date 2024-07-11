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

  /**
   * The function `getBloqueDataFron()` retrieves data for different types of blocks (carousels,
   * products, opinions, news, banners) to be displayed on the front-end.
   * 
   * @return an array of bloques.
   */
    public static function getBloqueDataFron()
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

            if($b['codigo'] == 'OFERTAS'):

                $nroitems = 10;
                $bloques[$key]['data']['productos'] = Producto::getProductosDescuentoGlobalFront($nroitems);

            endif;

        endforeach;

        return $bloques;
    }

   /**
    * The function "getMonedaFront" returns an array of currency objects for use in the front-end.
    * 
    * @return an array of Moneda objects.
    */
    public static function getMonedaFront()
    {
        $monedas = Moneda::getMonedaFront();

        return $monedas;
    }

    /**
     * The function "getMenusxIdParent" retrieves menus based on their parent ID.
     * 
     * @param parent_id The parent_id parameter is used to specify the ID of the parent menu item. The
     * function retrieves all the menus that have this parent ID.
     * 
     * @return the menus that have the specified parent_id.
     */
    public static function getMenusxIdParent($parent_id)
    {
        $menus = Menu::getMenusxParent($parent_id);

        return $menus;
    }

    // Obtener el nro de productos con descuento del sistema

    public static function getCountProductosDescuentos()
    {
        $nroProductos = Producto::getCountProductosDescuentos();

        return $nroProductos;
    }

    // Obtener  productos con descuento del sistema
    public static function getProductosDescuentos()
    {
        $productos = Producto::getProductosDescuentos();

        return $productos;
    }

    public static function getProductosGlobalxOfertas($precioD, $precioH, $productobuscar, $order)
    {
        $productosdata = Producto::getProductosGlobalxOfertas($precioD, $precioH, $productobuscar, $order);

        return $productosdata;
    }

   /**
    * The function "getProductoDetalle" retrieves the details of a product in PHP.
    * 
    * @param producto The parameter "producto" is the identifier or key of the product for which you
    * want to retrieve the details.
    * 
    * @return the variable ``, which is the result of calling the `getProductoDetalle` method
    * on the `Producto` class.
    */
    public static function getProductoDetalle($producto)
    {
        $producto = Producto::getProductoDetalle($producto);

        return $producto;
    }   

   /**
    * The function "getMenusFront" returns an array of menus.
    * 
    * @return the menus.
    */
    public static function getMenusFront()
    {
        $menus = Menu::getMenusFront();

        return $menus;
    }

  /**
   * The function `getProductDataUrl` in PHP retrieves product data from a given URL.
   * 
   * @param url The URL of the product data.
   * 
   * @return the data obtained from the `getProductDataUrl` method of the `Producto` class.
   */
    public static function getProductDataUrl($url)
    {
        $data = Producto::getProductDataUrl($url);

        return $data;
    }

   /**
    * The function `getProductoxUrl` in PHP retrieves a product based on its URL.
    * 
    * @param url The parameter "url" is a string that represents the URL of a product.
    * 
    * @return the product that matches the given URL.
    */
    public static function getProductoxUrl($url)
    {
        $producto = Producto::getProductoxUrl($url);
        
        return $producto;
    }

    /**
     * The function "getMediosPagoFront" returns an array of payment methods for the front-end.
     * 
     * @return the result of the method call `Medio_Pago::getMedioPagosFront()`.
     */
    public static function getMediosPagoFront()
    {
        $mediospago = Medio_Pago::getMedioPagosFront();

        return $mediospago;
    }

  /**
   * The function "getProductosRelacionadosFront" returns an array of related products based on a given
   * URL.
   * 
   * @param url The URL of the product for which you want to retrieve related products.
   * 
   * @return the variable , which contains the related products obtained from the
   * getProductosRelacionados method.
   */
    public static function getProductosRelacionadosFront($url)
    {
        $productos_relacionads = Producto::getProductosRelacionados($url);

        return $productos_relacionads;
    }

    /**
     * The function getCategoriasTreeFront returns a tree structure of categories in PHP.
     * 
     * @return the tree structure of categories.
     */
    public static function getCategoriasTreeFront()
    {
        $categorias = Categoria::get_tree();

        return $categorias;
    }

   /**
    * The function "getTagsFront" returns an array of tags from the front-end.
    * 
    * @return the tags obtained from the `getTagsFront()` method of the `Tag` class.
    */
    public static function getTagsFront()
    {
        $tags = Tag::getTagsFront();

        return $tags;
    }

    /**
     * The function `getTagTitle` takes a URL as input and returns the tag title associated with that URL.
     * 
     * @param url The URL parameter is a string that represents the URL of a webpage.
     * 
     * @return the data obtained from the `getTagTitle` method of the `Tag` class.
     */

    public static function getTagTitle($url)
    {
        $data = Tag::getTagTitle($url);

        return $data;
    }

   /**
    * The function "getCatxUrl" retrieves data from the "Categoria" class based on a given URL and
    * subcategory.
    * 
    * @param url The URL parameter is a string that represents the URL of a category.
    * @param sub The "sub" parameter is a string that represents a subcategory.
    * 
    * @return the data obtained from the `getCatxUrl` method of the `Categoria` class.
    */
    public static function getCatxUrl($url, $sub = '')
    {
        $data = Categoria::getCatxUrl($url, $sub);

        return $data;
    }

   /**
    * The function `getTagxUrl` retrieves data from a specific URL using the `Tag` class.
    * 
    * @param url The URL of the webpage for which you want to retrieve the tag information.
    * 
    * @return the data obtained from the `getTagxUrl` method of the `Tag` class.
    */
    public static function getTagxUrl($url)
    {
        $data = Tag::getTagxUrl($url);

        return $data;
    }

    /**
     * The function `getProductosGlobalxUrlCategoria` retrieves products based on a given URL,
     * subcategory, price range, product to search for, and order.
     * 
     * @param url The URL of the category page where the products are listed.
     * @param sub The "sub" parameter is used to filter the products by a specific subcategory within
     * the given category URL.
     * @param precioD The parameter "precioD" represents the minimum price range for the products to be
     * searched. It is used to filter the products based on their price, where only the products with a
     * price greater than or equal to "precioD" will be included in the search results.
     * @param precioH The parameter "precioH" represents the maximum price range for the products.
     * @param productobuscar The parameter "productobuscar" is used to specify a keyword or search term
     * to filter the products. It is used to search for products that match the specified keyword or
     * search term.
     * @param order The "order" parameter is used to specify the order in which the products should be
     * returned. It can be used to sort the products based on certain criteria such as price,
     * popularity, or any other relevant attribute.
     * 
     * @return the variable .
     */
    public static function getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar, $order)
    {

        $productosxcategoria = Producto::getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar, $order);

        return $productosxcategoria;
    }

   /**
    * The function getMaxPrecioProductosxCategoria retrieves the maximum price of products for a given
    * category.
    * 
    * @param url The URL is a string that represents the category of products. It is used to filter the
    * products and retrieve only those that belong to the specified category.
    * @param sub The "sub" parameter is a variable that represents the subcategory of a product
    * category. It is used to filter the products based on their subcategory.
    * 
    * @return the maximum price of products for a given category.
    */
    public static function getMaxPrecioProductosxCategoria($url, $sub)
    {
        $maxprecioProductosxCategoria = Producto::getMaxPrecioProductosxCategoria($url, $sub);

        return $maxprecioProductosxCategoria;
    }

    /**
     * The function getMaxPrecioProductosxEtiqueta retrieves the maximum price of products based on a
     * given URL.
     * 
     * @param url The parameter "url" is a string that represents the URL of a webpage.
     * 
     * @return the maximum price of products for a given URL.
     */
    public static function getMaxPrecioProductosxEtiqueta($url)
    {
        $maxprecioProductosxEtiqueta= Producto::getMaxPrecioProductosxEtiqueta($url);

        return $maxprecioProductosxEtiqueta;
    }
    
   /**
    * The function `getProductosGlobalxEtiqueta` retrieves products based on a given URL, price range,
    * product name, and order.
    * 
    * @param url The URL of the website where the products are located.
    * @param precioD The parameter "precioD" represents the minimum price of the products to be
    * searched for.
    * @param precioH The parameter "precioH" represents the maximum price for the products to be
    * searched.
    * @param productobuscar The parameter "productobuscar" is a string that represents the product to
    * search for. It is used as a filter to retrieve only the products that match the specified name or
    * keyword.
    * @param order The "order" parameter is used to specify the order in which the products should be
    * returned. It can have the following values:
    * 
    * @return the variable , which is the result of calling the static method
    * getProductosGlobalxEtiqueta() on the Producto class.
    */
    public static function getProductosGlobalxEtiqueta($url, $precioD, $precioH, $productobuscar, $order)
    {
        $productosxEtiquetas = Producto::getProductosGlobalxEtiqueta($url, $precioD, $precioH, $productobuscar, $order);

        return $productosxEtiquetas;
    }

   /**
    * The function `getProductosGlobal` retrieves products based on price range, search term, and
    * order.
    * 
    * @param precioD The minimum price range for the products to be searched.
    * @param precioH The parameter "precioH" represents the maximum price range for the products to be
    * searched.
    * @param productobuscar This parameter is used to search for products based on a specific keyword
    * or name. It is used to filter the products that match the given search term.
    * @param order The "order" parameter is used to specify the order in which the products should be
    * returned. It can have the following values:
    * 
    * @return the variable , which is the result of calling the static method
    * getProductosGlobal() on the class Producto.
    */
    public static function getProductosGlobal($precioD, $precioH, $productobuscar, $order)
    {
        $productosdata = Producto::getProductosGlobal($precioD, $precioH, $productobuscar, $order);

        return $productosdata;
    }

    /**
     * The function "getProductsSearch" in PHP retrieves products based on a search query.
     * 
     * @param producto The parameter "producto" is the search term or keyword that is used to search for
     * products.
     * 
     * @return the data obtained from the `getProductsSearch` method of the `Producto` class.
     */

    public static function getProductsSearch($producto)
    {
        $data  = Producto::getProductsSearch($producto);

        return $data;
    }

    /**
     * The function getMaxPrecioxProducto retrieves the maximum price for a given product.
    * 
    * @param producto The parameter "producto" is the name or identifier of a product.
    * 
    * @return the data obtained from the `getMaxPrecioxProducto` method of the `Producto` class.
    */
    public static function getMaxPrecioxProducto($producto)
    {
        $data = Producto::getMaxPrecioxProducto($producto);

        return $data;
    }

    public static function getMaxPrecioProductosOfertas($producto)
    {
        $data = Producto::getMaxPrecioProductosOfertas($producto);

        return $data;
    }

   /**
    * The function "getNoticiasGlobal" retrieves global news data from the database.
    * 
    * @return the data of global news articles.
    */
    public static function getNoticiasGlobal()
    {
        $noticiasData = Noticia::getNoticiasGlobal();

        return $noticiasData;
    }

    /**
     * The function "getNoticiaxUrl" retrieves a news article based on its URL.
     * 
     * @param url The parameter "url" is a string that represents the URL of a news article.
     * 
     * @return the variable , which is the result of calling the static method getNoticiaxUrl()
     * on the Noticia class.
     */

    public static function getNoticiaxUrl($url)
    {
        $noticia = Noticia::getNoticiaxUrl($url);
        
        return $noticia;
    }

   /**
    * The function "getNoticeUrlData" retrieves the data of a notice based on its URL.
    * 
    * @param url The URL of the notice that you want to retrieve data for.
    * 
    * @return the data of a notice (or news article) with the given URL.
    */

    public static function getNoticeUrlData($url)
    {
        $noticia = Noticia::getNoticeUrlData($url);
        
        return $noticia;
    }

   /**
    * The function "getNotCatxUrl" retrieves data from the "Noticia_Categoria" class based on a given
    * URL and subcategory.
    * 
    * @param url The URL of the news category.
    * @param sub The "sub" parameter is a string that represents the subcategory of the news category.
    * 
    * @return the data obtained from the Noticia_Categoria::getNotCatxUrl(, ) method.
    */
    public static function getNotCatxUrl($url, $sub)
    {
        $data = Noticia_Categoria::getNotCatxUrl($url, $sub);

        return $data;
    }

   /**
    * The function "getNoticiasCategoriasTreeFront" returns a tree structure of news categories.
    * 
    * @return the tree structure of noticias categories.
    */
    public static function getNoticiasCategoriasTreeFront()
    {
        $noticias_categorias = Noticia_Categoria::get_treeNoticiasCategories();

        return $noticias_categorias;
    }

    /**
     * The function "getNotTagxUrl" retrieves data from the database based on a given URL.
     * 
     * @param url The URL of the news article.
     * 
     * @return the data obtained from the `getNotTagxUrl` method of the `Noticia_Tag` class.
     */
    public static function getNotTagxUrl($url)
    {
        $data = Noticia_Tag::getNotTagxUrl($url);

        return $data;
    }

  /**
   * The function "getNoticiasTagsFront" returns the tags associated with news articles.
   * 
   * @return the tags of the noticias (news) from the front-end.
   */
    public static function getNoticiasTagsFront()
    {
        $tags = Noticia_Tag::getNoticiasTagsFront();

        return $tags;
    }

    /**
     * The function "getNoticiasRelacionadosFront" returns the related news for a given URL.
     * 
     * @param url The parameter "url" is a string that represents the URL of a news article.
     * 
     * @return the variable , which is the result of calling the method
     * getNoticiasRelacionadas() on the Noticia class.
     */
    public static function getNoticiasRelacionadosFront($url)
    {
        $noticias_relacionadas = Noticia::getNoticiasRelacionadas($url);

        return $noticias_relacionadas;
    }

   /**
    * The function "getNoticiasxCategoriaFront" retrieves news articles based on a given URL and
    * subcategory.
    * 
    * @param url The URL is a string that represents the category of the news. It is used to filter the
    * news articles based on their category.
    * @param sub The "sub" parameter is a variable that represents the subcategory of the news
    * category. It is used to filter the news articles based on the specified subcategory.
    * 
    * @return the variable .
    */
    public static function getNoticiasxCategoriaFront($url, $sub)
    {

        $noticiasxcategoria = Noticia::getNoticiasxCategoriaFront($url, $sub);

        return $noticiasxcategoria;
    }

    /**
     * The function "getNoticiasByEtiquetaFront" retrieves noticias (news) by a given etiqueta (tag)
     * from the front-end.
     * 
     * @param url The parameter "url" is a string that represents the URL of a webpage.
     * 
     * @return the variable .
     */
    public static function getNoticiasByEtiquetaFront($url)
    {
        $noticiasxEtiquetas = Noticia::getNoticiasByEtiquetaFront($url);

        return $noticiasxEtiquetas;
    }

 /**
  * The function "getImgCat" retrieves the image category data for a given ID and subcategory.
  * 
  * @param id The id parameter is used to specify the category id for which you want to retrieve the
  * image.
  * @param sub The "sub" parameter is an optional parameter that can be passed to the function. It is
  * used to specify a subcategory within a category. If a subcategory is specified, the function will
  * retrieve the image associated with that subcategory. If no subcategory is specified, the function
  * will retrieve the
  * 
  * @return the data obtained from the `getImgCat` method of the `Categoria` class.
  */
    public static function getImgCat($id, $sub = '')
    {
        $data = Categoria::getImgCat($id, $sub);

        return $data;
                            
    }

  /**
   * The function "getPaymentDescription" returns the description of a payment method based on its ID.
   * 
   * @param paymentId The paymentId parameter is the identifier of the payment for which you want to
   * retrieve the payment description.
   * 
   * @return the description of a payment method based on the payment ID.
   */
    public static function getPaymentDescription($paymentId){
        
        $medioPagoDescription = Medio_Pago::getPaymentDescription($paymentId);

        return $medioPagoDescription;

    }

 /**
  * The function "getBannerPago" returns the banner for payment.
  * 
  * @return the variable .
  */
    public static function getBannerPago()
    {
        $bannerPago = Banner::BannerPago();

        return $bannerPago;
    }

   /**
    * The function "updatePrecioProducto" updates the price and discount of a product in a database.
    * 
    * @param data_producto The parameter "data_producto" is the ID of the product that needs to be
    * updated.
    * 
    * @return a boolean value of true.
    */

    public static function updatePrecioProducto($data_producto)
    {
        $data =  [
            "precio_oferta" => 0.00,
            "descuento" => 0,
            "fecha_finalizacion" => null,
            "fecha_modifica"=>now()
        ];    

        $producto = Producto::find($data_producto);

        $producto->update($data);

        return true;
      
    }

   /**
    * The function `getPrecioXProducto` retrieves the price of a product based on the given product
    * data.
    * 
    * @param data_producto The parameter "data_producto" is the data of the product for which you want
    * to retrieve the price. It could be an object or an array containing the necessary information
    * about the product, such as its ID or name.
    * 
    * @return the data obtained from the `getPrecioXProducto` method of the `Producto` class.
    */
    public static function getPrecioXProducto($data_producto)
    {
        $data = Producto::getPrecioXProducto($data_producto);

        return $data;
    }

   /**
    * The function `highlightKeywords` takes a text and a keyword as input, and returns the text with
    * the keyword highlighted in bold.
    * 
    * @param text The text is the string in which you want to highlight the keywords.
    * @param keyword The keyword parameter is a string that represents the keyword or keywords that you
    * want to highlight in the text.
    * 
    * @return the highlighted text with the specified keyword.
    */
    public static function highlightKeywords($text, $keyword)
    {
        // $wordsAry = explode(" ", $keyword);
        // $wordsCount = count($wordsAry);
    
        // for ($i = 0; $i < $wordsCount; $i ++) {
        //     $highlighted_text = "<span style='font-weight:bold !important;'>$wordsAry[$i]</span>";
        //     $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
        // }
    
        // return $text;
        
        $highlighted = preg_filter('/' . preg_quote($keyword, '/') . '/i', '<b><span style="font-weight:bold !important;">$0</span></b>', $text);
        if (!empty($highlighted)) {
            $text = $highlighted;
        }
        return $text;
    }


    /**
     * The function "ConvertFechaToString" takes a date input and converts it into a string format with the
     * day, month, and year.
     * 
     * @param inputfecha The inputfecha parameter is a date string that needs to be converted to a specific
     * format.
     * 
     * @return a string representation of the input date in the format "day de month de year".
     */
    public static function ConvertFechaToString($inputfecha)
    {
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($inputfecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $fechaString = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        return $fechaString;
    }
     
    /**
     * The function "ConvertDatetoTime" takes a date input and returns the time in a specific format.
     * 
     * @param inputfecha The inputfecha parameter is a date string that needs to be converted to a time
     * string.
     * 
     * @return the time in the format "g:i A".
     */
    public static function ConvertDatetoTime($inputfecha)
    {
        $hora = Carbon::parse($inputfecha)->format('g:i A');
        // $hora = Carbon::createFromFormat('H:i:s',$inputfecha)->format('h:i');
        return $hora;
    }

}