<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'producto_id';

    public $timestamps = false;

    protected $fillable = ['producto','descripcion_producto','precio_compra','precio_anterior','precio','precio_oferta','monedas','con_stock','stock','url','video','sku','agotado','descuento','fecha_finalizacion','envio_domicilio','recojo','contraentrega','estado','oculto','usuario_registra','fecha_registro','usuario_modifica','fecha_modifica'];

    public function Producto_ProductoCategoria(){
        return $this->HasMany(Producto_m_Categoria::class);
    }

    public function Producto_ProductoTag(){
        return $this->HasMany(Producto_m_Tag::class);
    }

    public function Producto_ProductoImg(){
        return $this->HasMany(Producto_Imagen::class);
    }

    public function Producto_ProductoCodigo(){
        return $this->HasMany(Producto_codigo::class);
    }

     // Obtener Listado de Productos con sus Imágenes
    public static function getProductswithImage($nproducto = '', $ncategorias = '', $oferta = '_all_', $carrousel = '_all_', $estado = '_all_')
    {

        $productos =  DB::table('productos as p')
        ->select('p.producto_id','p.producto','p.descripcion_producto','p.precio_compra','p.precio_anterior','p.precio','p.monedas','p.con_stock','p.stock','p.precio_oferta',
        'p.sku','p.agotado','p.descuento','p.fecha_finalizacion','p.estado','pi.url as imgproducto',DB::raw('group_concat(c.categoria) as categorias'))
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('p.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('p.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->join('categorias as c', function($join)
        {
            $join->on('c.categoria_id', '=', 'pc.categoria_id');
            $join->where('c.oculto',0);
        });

        if (isset($nproducto) && $nproducto != ''):
            $productos ->where('p.producto','LIKE','%'.$nproducto."%");
        endif;    

        if (isset($ncategorias) && $ncategorias!=''):
            $productos->whereIn('pc.categoria_id', $ncategorias);
        endif;

        if (isset($oferta) && $oferta!='_all_'):

            $productos->where('p.oferta',$oferta);
        endif;

        if (isset($carrousel) && $carrousel!='_all_'):

            $productos->where('p.carrousel',$carrousel);
        endif;

        
        if (isset($estado) && $estado!='_all_'):

            $productos->where('p.estado',$estado);
        endif;
    
        $productos= $productos->where('p.oculto',0)
                            ->groupBy('p.producto_id')
                            ->orderBy('p.producto','ASC')->paginate(10);

        return $productos;
    }

    // Obtener Listado de Productos para el index principal
    public static function getProductosGlobalFront($categoria_id, $nroitems)
    {      
        $productos = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.agotado','productos.sku','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('productos.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->where('pc.categoria_id',$categoria_id)
        ->where('productos.estado',1)
        ->where('productos.oculto',0)
        // ->orderBy('productos.producto','asc')
        ->orderBy('productos.fecha_registro', 'DESC')
        ->take($nroitems)->get();

        return $productos;
        
    }   

    
    // Obtener Listado de Productos con descuento para el index principal
    public static function getProductosDescuentoGlobalFront($nroitems)
    {      
        $productos = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.agotado','productos.sku','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('productos.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->where('productos.estado',1)
        ->where('productos.oculto',0)
        ->where('productos.descuento','>',0)
        // ->orderBy('productos.producto','asc')
        ->orderBy('productos.fecha_registro', 'DESC')
        ->take($nroitems)->get();

        return $productos;
        
    }   

    //Obtener el detalle o descripción del producto por ID
    public static function getProductoDetalle($producto)
    {
        $data= Producto::select('productos.producto_id','productos.producto','productos.descripcion_producto','productos.sku','productos.url','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.agotado','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->where('productos.producto_id',$producto)
        ->where('productos.estado',1)
        ->where('productos.oculto',0)
        // ->orderBy('productos.producto','asc')
        ->orderBy('productos.fecha_registro', 'DESC')
        ->first()->toArray();
        
        $productosdata = preg_replace('/<iframe.*?\/iframe>/i','', $data);

        return $productosdata;


    }

    //Obtener el id del producto por el parámetro URL
    public static function getProductDataUrl($url)
    {
        $data = Producto::select('producto_id')
                ->where('url',$url)
                ->where('estado',1)
                ->where('oculto',0)
                ->first();

        return $data;
    }

    // Obtener toda la información del Producto por parámetro URL
    public static function getProductoxUrl($url)
    {
        $arrayProducto= Producto::select('productos.producto_id','productos.producto','productos.descripcion_producto','productos.url','productos.video','productos.precio', 'productos.descuento', 'productos.precio_oferta','productos.fecha_finalizacion',
        'productos.con_stock','productos.stock','productos.sku','productos.agotado','productos.envio_domicilio','productos.recojo','productos.contraentrega','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->where('productos.url',$url)
        ->where('productos.estado',1)
        ->where('productos.oculto',0)
        // ->orderBy('productos.producto','asc')
        ->orderBy('productos.fecha_registro', 'DESC')
        ->first()->toArray();

        $imagenesProducto = self::getImagenesProducto($arrayProducto['producto_id']);

        // $arrayimg = array();
        
        // foreach($imagenesProducto as $k=>$imgp):
        //         $arrayimg['producto__imagens_id'] = $imgp->producto__imagens_id;
        //         $arrayimg['producto_id'] = $imgp->producto_id;
        //         $arrayimg['url'] = $imgp->url;
        // endforeach;

        $arrayProducto['imagenes'] = $imagenesProducto;

        $categoriasProducto = self::getCategoriasProducto($arrayProducto['producto_id']);

        $arrayProducto['categorias'] = $categoriasProducto;

        
        $tagsProducto = self::getEtiquetaProducto($arrayProducto['producto_id']);

        $arrayProducto['tags'] = $tagsProducto;

        // foreach($arrayProducto as $ap)
        // {
        //     $imagenesProducto = self::getImagenesProducto($ap['producto_id']);
        //     $arrayProducto[$i]['imagenes'] = $imagenesProducto;
        //     $i++;
        // }

        return $arrayProducto;
    }

    // Obtener todas las imágenes del producto por ID del producto
    public static function getImagenesProducto($producto_id)
    {
        $dataimages = DB::table('producto__imagens')
                            ->select('producto__imagens_id', 'producto_id', 'url')
                            ->where('producto_id', $producto_id) 
                            ->where('principal',0)->orderBy('fecha_registro','desc')
                            ->get()->toArray();

        
        return $dataimages;
    }

    // Obtener todas las categorías del Producto por ID del producto
    public static function getCategoriasProducto($producto_id)
    {
        $datacategorias = DB::table('producto_m__categorias as pc')
                            ->select('pc.producto_m__categoria_id', 'pc.producto_id', 'pc.categoria_id', 'c.categoria', 'c.url')
                            ->join('categorias as c', function($join)
                            {
                                $join->on('c.categoria_id', '=', 'pc.categoria_id');
                                $join->where('c.estado',1);
                                $join->where('c.oculto',0);
                            })
                            ->where('pc.producto_id', $producto_id) 
                            ->where('pc.oculto',0)->orderBy('pc.fecha_registro','desc')
                            ->get()->toArray();

        
        return $datacategorias;
    }

    // Obtener todas las Etiquetas del Producto por ID del producto
    public static function getEtiquetaProducto($producto_id)
    {
        $dataTags = DB::table('producto_m__tags as pt')
                        ->select('pt.producto_m__tag_id', 'pt.producto_id', 'pt.tag_id', 't.tag')
                        ->join('tags as t', function($join)
                        {
                            $join->on('t.tag_id', '=', 'pt.tag_id');
                            $join->where('t.estado',1);
                            $join->where('t.oculto',0);
                        })
                        ->where('pt.producto_id', $producto_id) 
                        ->where('pt.oculto',0)->orderBy('pt.fecha_registro','desc')
                        ->get()->toArray();

        
        return $dataTags;
    }

    // Obtener todos los productos pertenecientes a la misma cantegoría del producto seleccionado por URL
    public static function getProductosRelacionados($url)
    {
        $categorias_producto = DB::table('productos as p')
                                ->select('p.producto_id', 'pc.categoria_id')
                                ->join('producto_m__categorias as pc', function($join)
                                {
                                    $join->on('p.producto_id', '=', 'pc.producto_id');
                                    $join->where('pc.oculto',0);
                                })
                                ->where('p.url', $url) 
                                ->where('p.oculto',0)->orderBy('pc.categoria_id','asc')
                                ->get()->toArray();

        $array_categorias = array();
        $array_producto_id = array();
        // $producto_id = $categorias_producto[0]->producto_id;
        foreach($categorias_producto as $cp):
                $array_producto_id[] = $cp->producto_id;
                $array_categorias[] = $cp->categoria_id;
        endforeach;


       $productos_relacionados = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.sku','productos.agotado','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('productos.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->whereIn('pc.categoria_id',$array_categorias)
        ->whereNotIn('productos.producto_id',$array_producto_id)
        ->where('productos.estado',1)
        ->where('productos.oculto',0)
        ->orderBy('productos.fecha_registro', 'DESC')
        ->groupBy('productos.producto_id')
        ->take(12)->get();

        // var_dump($categorias_producto[0]->producto_id);
        return $productos_relacionados;

    }

    // Obtener Listado de Productos por Categoría
    
    public static function getProductosGlobalxUrlCategoria($url, $sub, $precioD, $precioH, $productobuscar , $order)
    {      
        $categoria_id = DB::table('categorias')
                    ->select('categoria_id')
                    ->where('url', $url)
                    ->where('estado',1)
                    ->where('oculto',0)
                    ->first();

        $subcategoria_id = '';


        if($sub!=''):
            $subcategoria_id = DB::table('categorias')
            ->select('categoria_id')
            ->where('parent_id',$categoria_id->categoria_id)
            ->where('url', $url.'/'.$sub)
            ->where('estado',1)
            ->where('oculto',0)
            ->first();
        endif;   

        $productos = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.sku','productos.agotado','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('productos.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->join('categorias as c', function($join)
        {
            $join->on('pc.categoria_id', '=', 'c.categoria_id');
            $join->where('c.oculto',0);
        });

        if($subcategoria_id != ''):  
            $productos->where('c.categoria_id',$subcategoria_id->categoria_id);
        else:
           $productos->where('c.categoria_id',$categoria_id->categoria_id);
        endif;

        if($productobuscar!=""):
            $productos ->where('productos.producto','LIKE','%'.$productobuscar."%");
        endif;

        $productos = $productos ->where('productos.estado',1)
                                ->where('productos.oculto',0);

        if($precioD!="" && $precioH==""):
            $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta >= '.$precioD.',productos.precio >='.$precioD.')');
        elseif($precioD=="" && $precioH!=""):
            $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta <= '.$precioH.',productos.precio <='.$precioH.')');
        elseif($precioD!="" && $precioH !=""):
            $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta BETWEEN '.$precioD.' and '.$precioH.', productos.precio BETWEEN '.$precioD.' and '.$precioH.')');
        endif;
        
                               
        
        // if($precioD!="" || $precioH !=""):
        //     $preciooferta = ($precioD=='') ? intval($precioD) +  1 : $precioD;
        //     var_dump($preciooferta);
        //     // $preciorangos = explode('-',$precio);
        //     // $preciodesde = $preciorangos[0];
        //     // $preciohasta = $preciorangos[1];
        //     // $productos->havingRaw('productos.precio BETWEEN '.$preciodesde.' and '.$preciohasta.' OR productos.precio_oferta BETWEEN 1 and '.$preciohasta);
        //     // $productos->havingRaw('productos.precio BETWEEN '.$precioD.' and '.$precioH.' OR productos.precio_oferta BETWEEN 1 and '.$precioH);
            
        // endif;  
            
        // var_dump($order);
        // ->orderBy('productos.producto','asc')
        switch($order) {
            case('precioasc'):
                $productos->orderBy('productos.precio', 'ASC');
                break;
            case('preciodesc'):
                $productos->orderBy('productos.precio', 'DESC');
                break;
            case('alfasc'):
                $productos->orderBy('productos.producto', 'ASC');
                break;
            case('alfdesc'):
                $productos->orderBy('productos.producto', 'DESC');
                break;
            default:
                $productos->orderBy('productos.fecha_registro', 'DESC');
        }

        // $productos->take(20)->get();
        // $productos = $productos->orderBy('productos.fecha_registro', 'DESC')
        // ->take(20)->get();

        // if($order != ""):
        // else:
        //     $productos->orderBy('productos.fecha_registro', 'DESC');
        // endif;

        //  $productos = $productos->orderBy('productos.fecha_registro', 'DESC')
        // ->paginate(20);
        $productos = $productos->paginate(20);

        return $productos;
        
    }   

    // Obtener Listado de Productos por Etiqueta

    public static function getProductosGlobalxEtiqueta($url, $precioD, $precioH, $productobuscar, $order)
    {
        $productos = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
                    'productos.stock','productos.sku','productos.agotado','productos.estado','productos.url','pi.url as imgproducto')
                    ->leftJoin('producto__imagens as pi', function($join)
                    {
                        $join->on('productos.producto_id', '=', 'pi.producto_id');
                        $join->where('pi.principal',1);
                    })
                    ->join('producto_m__tags as pt', function($join)
                    {
                        $join->on('productos.producto_id', '=', 'pt.producto_id');
                        $join->where('pt.oculto',0);
                    })
                    ->join('tags as t', function($join)
                    {
                        $join->on('pt.tag_id', '=', 't.tag_id');
                        $join->where('t.oculto',0);
                    });

        if($productobuscar!=""):
            $productos->where('productos.producto','LIKE','%'.$productobuscar."%");
        endif;

        // if($url != ""):
        //     $productos->where('t.url',$url);
        // endif;

        $productos = $productos ->where('t.url',$url)
                                ->where('productos.estado',1)
                                ->where('productos.oculto',0);

        // $productos = $productos->where('productos.estado',1)
        //                         ->where('productos.oculto',0);

        if($precioD!="" && $precioH==""):
            $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta >= '.$precioD.',productos.precio >='.$precioD.')');
        elseif($precioD=="" && $precioH!=""):
            $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta <= '.$precioH.',productos.precio <='.$precioH.')');
        elseif($precioD!="" && $precioH !=""):
            $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta BETWEEN '.$precioD.' and '.$precioH.', productos.precio BETWEEN '.$precioD.' and '.$precioH.')');
        endif;

        switch($order) {
            case('precioasc'):
                $productos->orderBy('productos.precio', 'ASC');
                break;
            case('preciodesc'):
                $productos->orderBy('productos.precio', 'DESC');
                break;
            case('alfasc'):
                $productos->orderBy('productos.producto', 'ASC');
                break;
            case('alfdesc'):
                $productos->orderBy('productos.producto', 'DESC');
                break;
            default:
                $productos->orderBy('productos.fecha_registro', 'DESC');
        }

        $productos = $productos->paginate(20);

        return $productos;

    }

    // Obtener Listado de Productos al usar el filtro de búsqueda(Por Nombre, Por precio, por Orden). 

    public static function getProductosGlobal($precioD, $precioH, $productobuscar, $order)
    {
        $productos = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.sku','productos.agotado','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        });

        if($productobuscar!=""):
        $productos->where('productos.producto','LIKE','%'.$productobuscar."%");
        endif;

        $productos = $productos->where('productos.estado',1)
                                ->where('productos.oculto',0);

        if($precioD!="" && $precioH==""):
        $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta >= '.$precioD.',productos.precio >='.$precioD.')');
        elseif($precioD=="" && $precioH!=""):
        $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta <= '.$precioH.',productos.precio <='.$precioH.')');
        elseif($precioD!="" && $precioH !=""):
        $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta BETWEEN '.$precioD.' and '.$precioH.', productos.precio BETWEEN '.$precioD.' and '.$precioH.')');
        endif;

        switch($order) {
            case('precioasc'):
                $productos->orderBy('productos.precio', 'ASC');
                break;
            case('preciodesc'):
                $productos->orderBy('productos.precio', 'DESC');
                break;
            case('alfasc'):
                $productos->orderBy('productos.producto', 'ASC');
                break;
            case('alfdesc'):
                $productos->orderBy('productos.producto', 'DESC');
                break;
            default:
                $productos->orderBy('productos.fecha_registro', 'DESC');
        }

        $productos = $productos->paginate(20);

        return $productos;

    }

    public static function getProductosGlobalxOfertas($precioD, $precioH, $productobuscar, $order)
    {
        $productos = Producto::select('productos.producto_id', 'productos.producto','productos.precio', 'productos.descuento', 'productos.precio_oferta',
        'productos.stock','productos.sku','productos.agotado','productos.estado','productos.url','pi.url as imgproducto')
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('productos.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        });

        if($productobuscar!=""):
        $productos->where('productos.producto','LIKE','%'.$productobuscar."%");
        endif;

        $productos = $productos->where('productos.estado',1)
                                ->where('productos.descuento','>',0)
                                ->where('productos.oculto',0);

        if($precioD!="" && $precioH==""):
        $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta >= '.$precioD.',productos.precio >='.$precioD.')');
        elseif($precioD=="" && $precioH!=""):
        $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta <= '.$precioH.',productos.precio <='.$precioH.')');
        elseif($precioD!="" && $precioH !=""):
        $productos->havingRaw('IF(precio_oferta > 0,productos.precio_oferta BETWEEN '.$precioD.' and '.$precioH.', productos.precio BETWEEN '.$precioD.' and '.$precioH.')');
        endif;

        switch($order) {
            case('precioasc'):
                $productos->orderBy('productos.precio', 'ASC');
                break;
            case('preciodesc'):
                $productos->orderBy('productos.precio', 'DESC');
                break;
            case('alfasc'):
                $productos->orderBy('productos.producto', 'ASC');
                break;
            case('alfdesc'):
                $productos->orderBy('productos.producto', 'DESC');
                break;
            default:
                $productos->orderBy('productos.fecha_registro', 'DESC');
        }

        $productos = $productos->paginate(20);

        return $productos;
    }

    //Buscar Producto desde el buscador
    public static function getProductsSearch($productoBuscar)
    {
        $nproducto = (string) $productoBuscar;
        $productos = Producto::select('productos.producto_id','productos.producto','productos.url','pi.url as imgproducto')
                    ->leftJoin('producto__imagens as pi', function($join)
                    {
                        $join->on('productos.producto_id', '=', 'pi.producto_id');
                        $join->where('pi.principal',1);
                    })
                    ->where('estado',1)
                    ->where('oculto',0)
                    ->where('productos.producto','LIKE','%'.$nproducto.'%')
                    ->orderBy('productos.producto','ASC')
                    ->take(5)
                    ->get();
        return $productos;

        // var_dump($productos);
    }

    // Obtener Max Precio
    public static function getMaxPrecioxProducto($productobuscar)
    {
        $precioMaxProducto = Producto::where('productos.estado',1)
                                        -> where('productos.oculto',0);
        if($productobuscar!=""):
            $precioMaxProducto->where('producto','LIKE','%'.$productobuscar."%");
        endif;

        $precioMaxProducto = $precioMaxProducto -> max('precio');

        return $precioMaxProducto;


    }

    //Obtener el Max Precio de los productos en ofertas
    public static function getMaxPrecioProductosOfertas($productobuscar)
    {
        $precioMaxProductosOferta = Producto::where('productos.estado',1)
            ->where('productos.descuento','>',0)-> where('productos.oculto',0);
        if($productobuscar!=""):
        $precioMaxProductosOferta->where('producto','LIKE','%'.$productobuscar."%");
        endif;

        $precioMaxProductosOferta = $precioMaxProductosOferta -> max('precio');

        return $precioMaxProductosOferta;
    }

    // Obtener Precio Máxico 
    public static function getPrecioXProducto($data_producto)
    {
        $data = Producto::select('productos.producto_id','productos.producto','productos.url', 'productos.descuento', 'productos.precio', 'productos.precio_oferta', 'productos.agotado','pi.url as imgproducto')
                        ->leftJoin('producto__imagens as pi', function($join)
                        {
                            $join->on('productos.producto_id', '=', 'pi.producto_id');
                            $join->where('pi.principal',1);
                        })
                        ->where('productos.producto_id',$data_producto)
                        ->where('productos.oculto',0)
                        ->first();

        return $data;
    }

    // Obtener Stock del Producto por ID

    public static function getStock($producto_id)
    {
        $stock =  Producto::select('stock')->where('producto_id', $producto_id)->first();
        return $stock;
    }

     // Obtener Precio Max de los Productos por la Categoría
    public static function getMaxPrecioProductosxCategoria($url, $sub)
    {
        $categoria_id = DB::table('categorias')
        ->select('categoria_id')
        ->where('url', $url)
        ->where('estado',1)
        ->where('oculto',0)
        ->first();

        $subcategoria_id = '';

        if($sub!=''):
        $subcategoria_id = DB::table('categorias')
        ->select('categoria_id')
        ->where('parent_id',$categoria_id->categoria_id)
        ->where('url', $sub)
        ->where('estado',1)
        ->where('oculto',0)
        ->first();
        endif;   

        $maxprecio = DB::table('productos as p')     
                    ->join('producto_m__categorias as pc', function($join)
                    {
                        $join->on('p.producto_id', '=', 'pc.producto_id');
                        $join->where('pc.oculto',0);
                    })
                    ->join('categorias as c', function($join)
                    {
                        $join->on('pc.categoria_id', '=', 'c.categoria_id');
                        $join->where('c.oculto',0);
                    });

        if($subcategoria_id != ''):  
            $maxprecio = $maxprecio->where('c.categoria_id',$subcategoria_id->categoria_id);
        else:
           $maxprecio = $maxprecio->where('c.categoria_id',$categoria_id->categoria_id);
        endif;

        $maxprecio = $maxprecio ->where('p.estado',1)
                                ->where('p.oculto',0)
                                ->max('p.precio');



        return $maxprecio;
        
    }
     // Obtener Precio Max de los Productos por Etiqueta
    public static function getMaxPrecioProductosxEtiqueta($url)
    {
        $tag_id = DB::table('tags')
        ->select('tag_id')
        ->where('url', $url)
        ->where('estado',1)
        ->where('oculto',0)
        ->first();

        $maxprecio = DB::table('productos as p')     
                    ->join('producto_m__tags as pt', function($join)
                    {
                        $join->on('p.producto_id', '=', 'pt.producto_id');
                        $join->where('pt.oculto',0);
                    })
                    ->join('tags as t', function($join)
                    {
                        $join->on('pt.tag_id', '=', 't.tag_id');
                        $join->where('t.oculto',0);
                    });

        $maxprecio = $maxprecio->where('t.tag_id',$tag_id->tag_id);

        $maxprecio = $maxprecio ->where('p.estado',1)
                                ->where('p.oculto',0)
                                ->max('p.precio');



        return $maxprecio;
    }

    // Obtener el nro de productos con descuento del sistema

    public static function getCountProductosDescuentos()
    {
        $nroproducto = Producto::where('descuento','>',0)->where('estado',1)->where('oculto',0)->count();
        return $nroproducto;
    }

    // Listado de Productos con sus Imágenespara Reporte
    public static function getProductswithImageReporte()
    {

        $productos =  DB::table('productos as p')
        ->select('p.producto_id','p.producto','p.descripcion_producto','p.precio_compra','p.precio','p.con_stock','p.stock','p.precio_oferta',
        'p.sku','p.descuento','p.fecha_finalizacion','p.estado','pi.url as imgproducto',DB::raw('group_concat(c.categoria) as categorias'),
        DB::raw('count(pcod.codigo) as codigos'))
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('p.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->leftJoin('producto_codigos as pcod', function($join)
        {
            $join->on('p.producto_id', '=', 'pcod.producto_id');
            $join->where('pcod.estado',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('p.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->join('categorias as c', function($join)
        {
            $join->on('c.categoria_id', '=', 'pc.categoria_id');
            $join->where('c.oculto',0);
        });
    
        $productos= $productos->where('p.oculto',0)
                            ->groupBy('p.producto_id')
                            ->orderBy('p.producto','ASC')->get();

        return $productos;
    }

    // Listado de Productos sin Stock
    public static function getProductsReporteSinStock()
    {
        $productos =  DB::table('productos as p')
        ->select('p.producto_id','p.producto','p.descripcion_producto','p.precio_compra','p.precio','p.con_stock','p.stock','p.precio_oferta',
        'p.sku','p.descuento','p.fecha_finalizacion','p.estado','pi.url as imgproducto',DB::raw('group_concat(c.categoria) as categorias'))
        ->leftJoin('producto__imagens as pi', function($join)
        {
            $join->on('p.producto_id', '=', 'pi.producto_id');
            $join->where('pi.principal',1);
        })
        ->join('producto_m__categorias as pc', function($join)
        {
            $join->on('p.producto_id', '=', 'pc.producto_id');
            $join->where('pc.oculto',0);
        })
        ->join('categorias as c', function($join)
        {
            $join->on('c.categoria_id', '=', 'pc.categoria_id');
            $join->where('c.oculto',0);
        });
    
        $productos= $productos->where('p.con_stock','=',1)->where('p.stock','=',0)->where('p.oculto',0)
                            ->groupBy('p.producto_id')
                            ->orderBy('p.producto','ASC')->get();

        return $productos;
    }

     // Listado de Productos digitales sin Stock
     public static function getProductsDigitalsReporteSinStock()
     {
         $productos =  DB::table('productos as p')
         ->select('p.producto_id','p.producto','p.descripcion_producto','p.precio_compra','p.con_stock','p.precio','p.precio_oferta',
         'p.sku','p.descuento','p.fecha_finalizacion','p.estado','pi.url as imgproducto',DB::raw('group_concat(c.categoria) as categorias'),
        //  DB::raw('count(pcod.codigo) as codigos')
        DB::raw('(SELECT COUNT(codigo) from producto_codigos where producto_id = p.producto_id AND estado = 1) as codigos') )
         ->leftJoin('producto__imagens as pi', function($join)
         {
             $join->on('p.producto_id', '=', 'pi.producto_id');
             $join->where('pi.principal',1);
         })
        //  ->leftJoin('producto_codigos as pcod', function($join)
        //  {
        //      $join->on('p.producto_id', '=', 'pcod.producto_id');
        //     //  $join->where('pcod.estado','!=',1);
        //  })
         ->join('producto_m__categorias as pc', function($join)
         {
             $join->on('p.producto_id', '=', 'pc.producto_id');
             $join->where('pc.oculto',0);
         })
         ->join('categorias as c', function($join)
         {
             $join->on('c.categoria_id', '=', 'pc.categoria_id');
             $join->where('c.oculto',0);
         });
     
         $productos= $productos->where('p.con_stock','=',0)->where('p.oculto',0)
                             ->groupBy('p.producto_id')
                             ->orderBy('p.producto','ASC')
                             ->having('codigos', '=', 0)->get();
 
         return $productos;
     }
 
     // Listado de Productos con Descuento
     public static function getProductsDescuento()
     {
 
         $productos =  DB::table('productos as p')
         ->select('p.producto_id','p.producto','p.descripcion_producto','p.precio_compra','p.precio','p.con_stock','p.stock','p.precio_oferta',
         'p.sku','p.descuento','p.fecha_finalizacion','p.estado','pi.url as imgproducto',DB::raw('group_concat(c.categoria) as categorias'),
         DB::raw('count(pcod.codigo) as codigos'))
         ->leftJoin('producto__imagens as pi', function($join)
         {
             $join->on('p.producto_id', '=', 'pi.producto_id');
             $join->where('pi.principal',1);
         })
         ->leftJoin('producto_codigos as pcod', function($join)
         {
             $join->on('p.producto_id', '=', 'pcod.producto_id');
             $join->where('pcod.estado',1);
         })
         ->join('producto_m__categorias as pc', function($join)
         {
             $join->on('p.producto_id', '=', 'pc.producto_id');
             $join->where('pc.oculto',0);
         })
         ->join('categorias as c', function($join)
         {
             $join->on('c.categoria_id', '=', 'pc.categoria_id');
             $join->where('c.oculto',0);
         });
     
         $productos= $productos->where('p.descuento','>',0)->where('p.oculto',0)
                             ->groupBy('p.producto_id')
                             ->orderBy('p.producto','ASC')->get();
 
         return $productos;
     }
}
