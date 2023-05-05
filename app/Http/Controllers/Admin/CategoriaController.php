<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use App\Models\Categoria;
use App\Http\Requests\Admin\CategoriaStoreRequest;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

use App\Services\Admin\{
	CategoriaService,
    ImageService
};

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.categorias.index');
    }

    public function index(Request $request)
    {
        $categoriabuscar = $request->get('categoria');
        $estadocategoria = $request->get('estado');

        $padres = Categoria::getListParents();

        $categorias = Categoria::where('parent_id',0);

        if (isset($categoriabuscar) && $categoriabuscar != ''):
            $categorias ->where('categoria','LIKE','%'.$categoriabuscar."%");
        endif;     

        if (isset($estadocategoria) && $estadocategoria!='_all_'):
            $categorias->where('estado',$estadocategoria );
        endif;

        $categorias = $categorias->where('oculto',0)->orderBy('categoria','ASC')->paginate(5);

        if ($request->ajax()):
            return view('admin.data.load_categorias_data', compact('categorias','padres'));
        endif;

        return view('admin.modules.categorias', compact('categorias','padres'));

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('/admin/404');
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
            return redirect('/admin/categorias');
        endif;

        $rules = [
            'categoria'=>'required|max:40'
        ];

        $messages = [
            'categoria.required' => 'El campo Categoria es requerido',
            'categoria.max' => 'El campo Categoria debe contener como máximo 40 carácteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            
            $slugcategoria = Str::slug($request->categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;
            $urlimagen = '';


            if($request->categoriapadre!="0"):

                $nparentcategoria = Categoria::getParentsExits($request->categoriapadre, $slugcategoria);
                // $nparentcategoria = Categoria::where('parent_id',$request->categoriapadre)
                //                     ->where('url',$slugcategoria)->where('oculto',0)->count();
                
                if($nparentcategoria>0):
                
                    return response()->json(['errors'=>$validator->errors(), 'code' => '427']);
                
                else:

                    $data = [
                        "categoria"=>trim($request->categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->categoriapadre,
                        "url"=>$slugcategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_registra"=>$request->usuario,
                        "fecha_registro"=>now()
                    ];

                    if($request->bannerImgCategoria!=""):
                        $arrayimg = explode("|*|", $request->bannerImgCategoria);
                        $urlimagen = "assets/images/categorias/".$arrayimg[0];
                        $data["nombre_img"] = $arrayimg[0];
                        $data["size_img"] = $arrayimg[1];
                        $data['img'] = $urlimagen;
                    endif;

                   if(Categoria::create($data)):
                    
                        if($request->bannerImgCategoria!=""):
                        
                            if($urlimagen!=""):
                                echo CategoriaService::moveImgCategoria($arrayimg[0]);
                            endif;
                         
                        endif;

                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                   else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                   endif;
  
                endif;

            else:

                // $existCategoria =  Categoria::where('url',$slugcategoria)->where('oculto',0)->count();
                $existCategoria = Categoria::getCategoryExits('url', $slugcategoria);

                if($existCategoria>0):
                    return response()->json(['errors'=>$validator->errors(), 'code' => '426']);
                else:
                    $data = [
                        "categoria"=>trim($request->categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->categoriapadre,
                        "url"=>$slugcategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_registra"=>$request->usuario,
                        "fecha_registro"=>now()
                    ];

                    if($request->bannerImgCategoria!=""):
                        $arrayimg = explode("|*|", $request->bannerImgCategoria);
                        $urlimagen = "assets/images/categorias/".$arrayimg[0];
                        $data["nombre_img"] = $arrayimg[0];
                        $data["size_img"] = $arrayimg[1];
                        $data['img'] = $urlimagen;
                    endif;


                   if(Categoria::create($data)):
                    
                        if($urlimagen!=""):
                            echo CategoriaService::moveImgCategoria($arrayimg[0]);
                        endif;
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                   else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                   endif;
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
    public function show($categoria_id)
    {
        $decrypt_id = Hashids::decode($categoria_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/categorias');
        endif;
        $categoria = Categoria::find($decrypt_id[0]);
        return response()->json($categoria);
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
        return redirect('/admin/404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoria_id)
    {
        if(!$request->ajax()):
            return redirect('/admin/categorias');
        endif;

        $decrypt_id = Hashids::decode($categoria_id);

        $rules = [
            'categoria'=>'required|max:40'
        ];

        $messages = [
            'categoria.required' => 'El campo Categoria es requerido',
            'categoria.max' => 'El campo Categoria debe contener como máximo 40 carácteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        
        if($validator->fails()):

            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        
        else:

            $slugcategoria = Str::slug($request->categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;

            if($request->parent_actual!=$request->categoriapadre): //--> cuando cambia de categoria padre

                // $existcategoriau = Categoria::where('url',$slugcategoria)
                //                     ->where('parent_id',$request->categoriapadre)->where('oculto',0)->count();

                $existcategoriau = Categoria::getParentsExits($request->categoriapadre, $slugcategoria);
                // $nparentcategoria = Categoria::where('parent_id',$request->categoriapadre)
                //                     ->where('url',$slugcategoria)->where('oculto',0)->count();

                if($existcategoriau>0):

                    return response()->json(['errors'=>$validator->errors(), 'code' => '426']);

                else:

                    $categoria = Categoria::find($decrypt_id[0]);

                    $data = [
                        "categoria"=>trim($request->categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->categoriapadre,
                        "url"=>$slugcategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_modifica"=>'46749322',
                        "fecha_modifica"=>now()
                    ];

                    if($request->imgcategoria!=""):
                        $arrayimg = explode("|*|", $request->imgcategoria);
                        $urlimagen = "assets/images/categorias/".$arrayimg[0];
                        $data["nombre_img"] = $arrayimg[0];
                        $data["size_img"] = $arrayimg[1];
                        $data['img'] = $urlimagen;
                    endif;


                    if($categoria->update($data)):
                        if($request->imgcategoria != ""):
                            $arrayimgc = explode("|*|", $request->imgcategoria);
                            if($arrayimgc[2]=="1"):
                                if($request->imgCategoriaActual!=""):
                                    echo CategoriaService::existImageCategoria($request->imgCategoriaActual);
                                endif;
                                echo CategoriaService::moveImgCategoria($arrayimgc[0]);
                            endif;
                        endif;
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                    else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                    endif;


                endif;
            else:
                
                if($request->slug_actual!=$slugcategoria):

                    // $existc = Categoria::where('url',$slugcategoria)->where('oculto',0)->count();
                    $existc = Categoria::getCategoryExits($slugcategoria);

                    if($existc>0):
                        
                        return response()->json(['errors'=>$validator->errors(), 'code' => '427']);

                    else:

                       $categoria = Categoria::find($decrypt_id[0]);

                        $data = [
                            "categoria"=>trim($request->categoria),
                            "descripcion"=>$request->descripcion,
                            "parent_id"=>$request->categoriapadre,
                            "url"=>$slugcategoria,
                            "estado"=>$activo,
                            "oculto"=>$oculto,
                            "usuario_modifica"=>'46749322',
                            "fecha_modifica"=>now()
                        ];

                        if($request->imgcategoria!=""):
                            $arrayimg = explode("|*|", $request->imgcategoria);
                            $urlimagen = "assets/images/categorias/".$arrayimg[0];
                            $data["nombre_img"] = $arrayimg[0];
                            $data["size_img"] = $arrayimg[1];
                            $data['img'] = $urlimagen;
                        endif;
    
                        if($categoria->update($data)):
                            if($request->imgcategoria != ""):
                                $arrayimgc = explode("|*|", $request->imgcategoria);
                                if($arrayimgc[2]=="1"):
                                    if($request->imgCategoriaActual!=""):
                                        echo CategoriaService::existImageCategoria($request->imgCategoriaActual);
                                    endif;
                                    echo CategoriaService::moveImgCategoria($arrayimgc[0]);
                                endif;
                            endif;
                            return response()->json(['msg'=>'sucess', 'code' => '200']);
                        else:
                            return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                        endif;

                        // $categoria = Categoria::find($categoria_id);
                        // $categoria->categoria=e(trim($request->categoria));
                        // $categoria->descripcion=e($request->descripcion);
                        // $categoria->parent_id = e($request->categoriapadre);
                        // $categoria->url=$slugcategoria;
                        // $categoria->estado =$activo;
                        // $categoria->oculto =$oculto;
                        // $categoria->usuario_modifica = '46749322';
                        // $categoria->fecha_modifica=now();
                        // if($categoria->save()):
                        //     return response()->json(['msg'=>'sucess', 'code' => '200']);
                        // else: 
                        //     return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                        // endif;            
                    endif;
                else:
                    $categoria = Categoria::find($decrypt_id[0]);
                    
                    $data = [
                        "categoria"=>trim($request->categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->categoriapadre,
                        "url"=>$slugcategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_modifica"=>'46749322',
                        "fecha_modifica"=>now()
                    ];

                    if($request->imgcategoria!=""):
                        $arrayimg = explode("|*|", $request->imgcategoria);
                        $urlimagen = "assets/images/categorias/".$arrayimg[0];
                        $data["nombre_img"] = $arrayimg[0];
                        $data["size_img"] = $arrayimg[1];
                        $data['img'] = $urlimagen;
                    endif;
                    
                    // $categoria->categoria=e(trim($request->categoria));
                    // $categoria->descripcion=e($request->descripcion);
                    // $categoria->parent_id = e($request->categoriapadre);
                    // $categoria->url=$slugcategoria;
                    // $categoria->estado =$activo;
                    // $categoria->oculto =$oculto;
                    // $categoria->usuario_modifica = '46749322';
                    // $categoria->fecha_modifica=now();
                    if($categoria->update($data)):
                        if($request->imgcategoria != ""):
                            $arrayimgc = explode("|*|", $request->imgcategoria);
                            if($arrayimgc[2]=="1"):
                                if($request->imgCategoriaActual!=""):
                                    echo CategoriaService::existImageCategoria($request->imgCategoriaActual);
                                endif;
                                echo CategoriaService::moveImgCategoria($arrayimgc[0]);
                            endif;
                        endif;
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                    else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                    endif;  

                endif;
            endif;


        endif;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $categoria_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/categorias');
        endif;

        $decrypt_id = Hashids::decode($categoria_id);
        $categoria = Categoria::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $categoria_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias');
        endif;

        $decrypt_id = Hashids::decode($categoria_id);
        $categoria = Categoria::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $categoria_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias');
        endif;

        $decrypt_id = Hashids::decode($categoria_id);
        $categoria = Categoria::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function subirImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias');
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
        endif;
       
    }

    public function eliminarImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias');
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
            return redirect('/admin/categorias');
        endif;
        
        $decrypt_id = Hashids::decode($request->image_id);
        // $url = public_path('admin/images/sliders/'.$request->filename);
        $url = public_path('assets/images/categorias/'.$request->filename);
        $image = ImageService::eliminarImg($url);
        Categoria::where("categoria_id", $decrypt_id[0])->update(["img" => "", "nombre_img" => "", "size_img" => ""]);
        return response()->json(['code' => '200']);
    }


}
