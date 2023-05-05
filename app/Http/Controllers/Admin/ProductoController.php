<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\File;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Tag;
use App\Models\Producto_Imagen;
use App\Models\Producto_codigo;
use App\Models\Producto_m_Categoria;
use App\Models\Producto_m_Tag;

use App\Services\Admin\{
	ProductoService,
	ImageService
};

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.productos.index');
    }
    
    public function index(Request $request)
    {
        $nproducto = isset($request->producto) ? $request->producto : '';
        $ncategorias = isset($request->categoria) ? $request->categoria : '';
        $oferta = isset($request->oferta) ? $request->oferta : '_all_';
        $carrousel = isset($request->carrousel) ? $request->carrousel : '_all_';
        $estado  = isset($request->estado) ? $request->estado : '_all_';

        $productos = Producto::getProductswithImage($nproducto, $ncategorias, $oferta, $carrousel, $estado);
        $categorias = Categoria::get_tree_select();

        if ($request->ajax()):
            return view('admin.data.load_productos_data', compact('productos', 'categorias'));
        endif;

        return view('admin.modules.productos', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::get_tree_select();

        $tags = Tag::where('estado',1)->where('oculto',0)->get();

        return view('admin.modules.crud-productos', compact('categorias','tags'));
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
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;


        $rules = [
            'categoriaProducto' => 'required',
            'nombreProducto' => 'required|unique:productos,producto',
            'skuProducto' => 'required|unique:productos,sku',
            // 'imagenProducto'=>'mimes:jpeg,png,jpg,gif|max:2048',
            // 'galeriaProducto.*'=>'mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
        $messages = [
            'categoriaProducto.required' => 'El campo Categoría del Producto es requerido',
            'nombreProducto.required' => 'El campo Nombre del Producto es requerido',
            'nombreProducto.unique' => 'Ya existe el Producto',
            'skuProducto.required'=> 'El Campo SKU (Código del Producto es requerido)',
            'skuProducto.unique' => 'Ya existe el SKU (Código) registrado',
            // 'imagenProducto.size'=>'El Tamaño de la Imagen principal no debe ser mayor a 2MB',
            // 'imagenProducto.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF',
            // 'galeriaProducto.*.size'=>'El Tamaño de la Imagen Galería no debe ser mayor a 2MB',
            // 'galeriaProducto.*.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = ProductoService::ArrayProductoAdd($request);

            if($producto=Producto::create($data)):
                $lastid = $producto->producto_id;
                if(isset($request->categoriaProducto) && count($request->categoriaProducto)>0):

                    foreach($request->categoriaProducto as $cat):
                        
                        $dataCategoria = [
                            "producto_id"=>$lastid,
                            "categoria_id"=>$cat,
                            "oculto"=>0,
                            "usuario_registra"=>'46749322',
                            "fecha_registro"=>now()
                        ];

                        Producto_m_Categoria::create($dataCategoria);

                    endforeach;
                endif;

                if(isset($request->etiquetasProducto) && count($request->etiquetasProducto)>0):
                    foreach($request->etiquetasProducto as $tag):

                        $dataEtiqueta = [
                            "producto_id"=>$lastid,
                            "tag_id"=>$tag,
                            "oculto"=>0,
                            "usuario_registra"=>'46749322',
                            "fecha_registro"=>now()
                        ];

                        Producto_m_Tag::create($dataEtiqueta);
    
                    endforeach;
                endif;


                if(isset($request->imgproducto)):

                    $arrayimg = explode("|*|", $request->imgproducto);
                    $urlimagen = "assets/images/productos/".$lastid."/".$arrayimg[0];

                    $dataImagenPrincipal = [
                        "producto_id"=>$lastid,
                        "nombre"=>$arrayimg[0],
                        "size"=>$arrayimg[1],
                        "url"=>$urlimagen,
                        "principal"=>1,
                        "usuario_registra"=>'46749322',
                        "fecha_registro"=>now()
                    ];

                   if(Producto_Imagen::create($dataImagenPrincipal)):
                        if($arrayimg[2] == '1'):
                            echo ProductoService::moveImage($arrayimg[0], $lastid);
                        endif;
                   endif;

                endif;

                if(isset($request->imagenes) && count($request->imagenes)>0):
                    $i = 1;
                    foreach($request->imagenes as $filegaleria):
                        $arrayGaleria = explode("|*|", $filegaleria);
                        $urlfiles = "assets/images/productos/".$lastid."/".$arrayGaleria[0];

                        $dataGaleriaProducto = [
                            "producto_id"=>$lastid,
                            "nombre"=>$arrayGaleria[0],
                            "size"=>$arrayGaleria[1],
                            "url"=>$urlfiles,
                            "principal"=>0,
                            "usuario_registra"=>'46749322',
                            "fecha_registro"=>now()
                        ];

                        if(Producto_Imagen::create($dataGaleriaProducto)):
                            if($arrayGaleria[2] == '1'):
                                echo ProductoService::moveImage($arrayGaleria[0], $lastid);
                            endif;
                        endif;
                        $i++;
                    endforeach;
                endif;

                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/productos')]);

            else:
                return response()->json(['errors'=>$validator->errors(), 'code' => '424']);
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
        return redirect('/admin/404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($producto_id)
    {
      
        $decrypt_id = Hashids::decode($producto_id); //-->desencripto el id

        $dataP = Producto::where('producto_id', $decrypt_id)->where('oculto',0)->first();

        if($dataP == NULL):
            return redirect('/admin/productos');
        endif;

        $producto = Producto::find($decrypt_id)->first();

        $producto_categorias = Producto_m_Categoria::where('producto_id', $decrypt_id)
                                ->where('oculto',0)->pluck('categoria_id')->toArray();

        $productos_etiquetas = Producto_m_Tag::where('producto_id', $decrypt_id)
                                ->where('oculto',0)->pluck('tag_id')->toArray();

        // $categorias = Categoria::getCategoriesWithParents();
        $categorias = Categoria::get_tree_select();

        $tags = Tag::where('estado',1)->where('oculto',0)->get();

        $imgproductoprincipal = Producto_Imagen::where('producto_id', $decrypt_id)->where('principal',1)->first();
        $imgproductogaleria = Producto_Imagen::where('producto_id', $decrypt_id)->where('principal',0)->get();

        return view('admin.modules.crud-productos', compact('producto', 'categorias', 'tags', 'producto_categorias', 'productos_etiquetas', 'imgproductoprincipal','imgproductogaleria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $producto_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $rules = [
            'categoriaProducto' => 'required',
            'nombreProducto' => 'required|unique:productos,producto,'.$producto_id.',producto_id',
            'skuProducto'=>'required|unique:productos,sku,'.$producto_id.',producto_id',
        ];
        
        $messages = [
            'categoriaProducto.required' => 'El campo Categoría del Producto es requerido',
            'nombreProducto.required' => 'El campo Nombre del Producto es requerido',
            'nombreProducto.unique' => 'Ya existe el Producto',
            'skuProducto.required'=> 'El Campo SKU (Código del Producto es requerido)',
            'skuProducto.unique' => 'Ya existe el SKU (Código) registrado',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $data = ProductoService::ArrayProductoUpdate($request, $producto_id);     

            $producto = Producto::find($producto_id);

            if($producto->update($data)):

                if(isset($request->categoriaProducto) && count($request->categoriaProducto)>0):

                    Producto_m_Categoria::where("producto_id", $producto_id)->update(["oculto" => 1]);

                    foreach($request->categoriaProducto as $cat):

                        $existCategoria = Producto_m_Categoria::where("producto_id", $producto_id)->where("categoria_id",$cat)->count();

                        if($existCategoria>0):
                            Producto_m_Categoria::where("producto_id", $producto_id)->where("categoria_id",$cat)->update(["oculto" => 0]);
                        else:
                            $dataCategoria = [
                                "producto_id"=>$producto_id,
                                "categoria_id"=>$cat,
                                "oculto"=>0,
                                "usuario_registra"=>'46749322',
                                "fecha_registro"=>now()
                            ];
    
                            Producto_m_Categoria::create($dataCategoria);
                        endif;
                    
                    endforeach;
                endif;

                if(isset($request->etiquetasProducto) && count($request->etiquetasProducto)>0):

                    Producto_m_Tag::where("producto_id", $producto_id)->update(["oculto" => 1]);

                    foreach($request->etiquetasProducto as $tag):

                        $existTags = Producto_m_Tag::where("producto_id", $producto_id)->where("tag_id",$tag)->count();

                        if($existTags>0):
                            Producto_m_Tag::where("producto_id", $producto_id)->where("tag_id",$tag)->update(["oculto" => 0]);
                        else:

                            $dataEtiqueta = [
                                "producto_id"=>$producto_id,
                                "tag_id"=>$tag,
                                "oculto"=>0,
                                "usuario_registra"=>'46749322',
                                "fecha_registro"=>now()
                            ];

                            Producto_m_Tag::create($dataEtiqueta);

                        endif;
    
                    endforeach;
                endif;

                if(isset($request->imgproducto)):

                    $arrayimg = explode("|*|", $request->imgproducto);

                    if($arrayimg[2] == 1):

                        $urlimagen = "assets/images/productos/".$producto_id."/".$arrayimg[0];

                        $dataImagenPrincipal = [
                            "producto_id"=>$producto_id,
                            "nombre"=>$arrayimg[0],
                            "size"=>$arrayimg[1],
                            "url"=>$urlimagen,
                            "principal"=>1,
                            "usuario_registra"=>'46749322',
                            "fecha_registro"=>now()
                        ];
    
                       if(Producto_Imagen::create($dataImagenPrincipal)):
                            if($arrayimg[2] == '1'):
                                if($request->idImgProducto!=""):
                                    echo ProductoService::existImagePrincipal($producto_id, $request->idImgProducto);
                                endif;
                                echo ProductoService::moveImage($arrayimg[0], $producto_id);
                            endif;
                       endif;

                    endif;

                endif;

                if(isset($request->imagenes) && count($request->imagenes)>0):
                    $i = 1;
                    foreach($request->imagenes as $filegaleria):
                        $arrayGaleria = explode("|*|", $filegaleria);

                        if($arrayGaleria[2] == 1):

                            $urlfiles = "assets/images/productos/".$producto_id."/".$arrayGaleria[0];

                            $dataGaleriaProducto = [
                                "producto_id"=>$producto_id,
                                "nombre"=>$arrayGaleria[0],
                                "size"=>$arrayGaleria[1],
                                "url"=>$urlfiles,
                                "principal"=>0,
                                "usuario_registra"=>'46749322',
                                "fecha_registro"=>now()
                            ];

                            if(Producto_Imagen::create($dataGaleriaProducto)):
                                if($arrayGaleria[2] == '1'):
                                    echo ProductoService::moveImage($arrayGaleria[0], $producto_id);
                                endif;
                            endif;

                        endif;

                        $i++;
                    endforeach;
                endif;

                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/productos')]);
            
            else:
            
                return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
            
            endif;


        endif;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        Producto_m_Categoria::where("producto_id", $producto_id)->update(["oculto" => 1]);

        Producto_m_Tag::where("producto_id", $producto_id)->update(["oculto" => 1]);

        Producto_codigo::where("producto_id", $producto_id)->update(["oculto" => 1]);

        $producto = Producto::find($producto_id);
        $data = [
            "oculto"=>1,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
        //
    }

    public function desactivar(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }
    
    public function activar(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function agotado(Request $request,$producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $agotado = $request->agotado == 0 ? 1: 0;
        $data = [
            "agotado"=>$agotado,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function carrousel(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $carrousel = $request->carrousel == 0 ? 1: 0;
        $data = [
            "carrousel"=>$carrousel,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function oferta(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $oferta = $request->oferta == 0 ? 1: 0;
        $data = [
            "oferta"=>$oferta,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function estreno(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $estreno = $request->estreno == 0 ? 1: 0;
        $data = [
            "estreno"=>$estreno,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }
    
    public function promo_dia(Request $request, $producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($producto_id);
        $producto = Producto::find($decrypt_id[0]);
        $promo_dia = $request->promo_dia == 0 ? 1: 0;
        $data = [
            "promo_dia"=>$promo_dia,
        ];
        if($producto->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function getCodigosProducto(Request $request, $producto_id)
    {

        $decrypt_id = Hashids::decode($producto_id);

        if(count($decrypt_id) == 0):
            return redirect('/admin/productos');
        endif;

        $estadoCodigoProducto = isset($request->estado) ? $request->estado : '_all_';

        $producto = Producto::select('producto_id','producto')->where('producto_id',$decrypt_id[0])->get();

        $codigos_productos = Producto_codigo::getCodigosByProducto($decrypt_id[0],$estadoCodigoProducto);

        if ($request->ajax()) {
            return view('admin.data.load_codigos_productos_data', compact('producto', 'codigos_productos'));
        }

        return view('admin.modules.codigos-productos',compact('producto', 'codigos_productos'));
    }

    public function storeCodigoProducto(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $rules = [
            'codigo_producto' => 'required|unique:producto_codigos,codigo',
        ];
        
        $messages = [
            'codigo_producto.required' => 'El campo Código del Producto es requerido',
            'codigo_producto.unique' => 'Ya existe el Código',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $producto_id = Hashids::decode($request->producto_id);
            $data =  [
                "producto_id" => $producto_id[0],
                "codigo" => strtoupper($request->codigo_producto),
                "descripcion" => $request->descripcion_codigo,
                "estado"=>1,
                "oculto"=>0,
                "fecha_registro"=>now()
            ];

            if(Producto_codigo::create($data)):
                $productoU = Producto::find($producto_id[0]);
                $dataU = [
                    'agotado'=> 0
                ];
                $productoU->update($dataU);
                return response()->json(['msg'=>'sucess', 'code' => '200']);
           else:
                return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
           endif;

        endif;
        // return $request->codigo_producto;exit;
    }

    public function showCodigoProducto($codigo_producto_id)
    {
        $decrypt_id = Hashids::decode($codigo_producto_id);

        $producto_codigo = Producto_codigo::find($decrypt_id);
        return response()->json($producto_codigo);
    }

    public function editCodigoProducto(Request $request, $codigo_producto_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($codigo_producto_id);
        $producto_id = Hashids::decode($request->producto_id);

        $rules = [
            'codigo_producto' => 'required|unique:producto_codigos,codigo,'.$decrypt_id[0].',producto_codigos_id',
        ];
        
        $messages = [
            'codigo_producto.required' => 'El campo Código del Producto es requerido',
            'codigo_producto.unique' => 'Ya existe el Código',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $data =  [
                "producto_id" => $producto_id[0],
                "codigo" => strtoupper($request->codigo_producto),
                "descripcion" => $request->descripcion_codigo,
                "estado"=>1,
                "oculto"=>0,
                "fecha_modifica"=>now()
            ];

            $codigo_producto = Producto_codigo::find($decrypt_id[0]);

            if($codigo_producto->update($data)):
                return response()->json(['msg'=>'sucess', 'code' => '200']);
           else:
                return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
           endif;
        endif;
    }

    public function deleteCodigoProducto($codigo_producto_id, Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $decrypt_id = Hashids::decode($codigo_producto_id);
        $decrypt_param_prod = Hashids::decode($request->producto_id);
        $codigoproducto = Producto_codigo::find($decrypt_id[0]);

        $data = [
            "oculto"=>1,
        ];
        if($codigoproducto->update($data)):
            $nrocod_pod = Producto_codigo::where('producto_id',$decrypt_param_prod[0])
            ->where('oculto',0)->count();
            if($nrocod_pod == 0):
                $prodcutoData = Producto::find($decrypt_param_prod[0]);
                $dataPd = [
                    'agotado'=> 1
                ];
                $prodcutoData->update($dataPd);
            endif;
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;  
    }

    public function subirImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;


        $rules = [
                'imagen'=>'mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        $messages = [
                
                'imagen.max'=>'El Tamaño de la Imagen no debe ser mayor a 2MB',
                'imagen.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF, .WEBP',
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
            // $pathtmp = public_path('admin/images/tmp/');
            // $fileNames = time().'_'.$request->indice.'_'.$request->imagen->getClientOriginalName();
            // $sizefiles = $request->imagen->getSize();
            // $urlfiles = "admin/images/tmp/".$fileNames;
            // if (!file_exists($pathtmp)):
            //     mkdir($pathtmp, 0777, true);
            // endif;
    
            // $request->imagen->move($pathtmp, $fileNames);
    
            // $data = [
            //     "name" => $fileNames,
            //     "size"=> $sizefiles,
            //     "url"=>$urlfiles,
            // ];
            // return response()->json(['data'=>$data, 'code' => '200']);
            // return response()->json( [$data] );

        endif;
       
    }

    public function eliminarImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $data = ImageService::eliminarImagenTmp($request);
        if($data):
             return response()->json(['code' => '200']);
        else:
             return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
        endif;     
    }

    public function eliminarImagen(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/productos');
        endif;

        $producto_img = Producto_Imagen::find($request->image_id);

        if($producto_img->delete()):
            // $url = public_path('admin/images/productos/'.$request->producto_id.'/'.$request->filename);
            $url = public_path('assets/images/productos/'.$request->producto_id.'/'.$request->filename);
            $image = ImageService::eliminarImg($url);
            // if( File::exists(public_path('admin/images/productos/'.$request->producto_id.'/'.$request->filename))):
            //     File::delete(public_path('admin/images/productos/'.$request->producto_id.'/'.$request->filename));
            // endif;
            return response()->json(['code' => '200']);
        else:
            return response()->json(['code' => '205']);
        endif;
    }

    // public function moveImage($filename, $producto_id)
    // {
    //     // $origen = public_path('admin/images/tmp');
    //     $destino =  public_path('admin/images/productos/'.$producto_id);
    //     echo ImageService::moveIconoImg($filename ,$destino);
    // }

    // public function existImagePrincipal($idImgProducto)
    // {
    //     $countImage = Producto_Imagen::existImage($request->idImgProducto);
    //     if($countImage>0):
    //         $producto_img_principal = Producto_Imagen::find($request->idImgProducto);
    //         $filename = $producto_img_principal->nombre;
    //         if($producto_img_principal->delete()):
    //             $url = public_path('admin/images/productos/'.$producto_id.'/'.$filename);
    //             $image = ImageService::eliminarImg($url);
    //         endif;      
    //     endif;
    // }

    // public function deleteImagen(Request $request)
    // {
    //     $imageProducto = Producto_Imagen::find($request->key);
    //     if($imageProducto->delete()):
    //         return $this->deletefile($request->producto_id, $request->nombreimg);
    //     endif;
    //     return true;
    // }

    // public function deletefile($producto_id, $nameImagen)
    // {
    //     if( File::exists(public_path('admin/images/productos/'.$producto_id.'/'.$nameImagen))):
    //         File::delete(public_path('admin/images/productos/'.$producto_id.'/'.$nameImagen));
    //     endif;
    // }
}
