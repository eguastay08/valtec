<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\File;

use App\Models\Noticia_Categoria;
use App\Models\Noticia_Tag;
use App\Models\Noticia;
use App\Models\Noticia_m_Noticia_Categoria;
use App\Models\Noticia_m_Noticia_Tags;
use App\Models\Noticia_Imagens;

use App\Services\Admin\{
	ImageService,
    NoticiaService
};

use Carbon\Carbon;

use App\Models\Configuracion;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.noticias.index');
    }
    

    public function index(Request $request)
    {
        //
        $ntitulo = isset($request->ntitulo) ? $request->ntitulo : '';
        $ncat = isset($request->ncat) ? $request->ncat : '';
        $nestado  = isset($request->nestado) ? $request->nestado : '_all_';

        $noticias = Noticia::getNoticiasWithImage($ntitulo, $ncat, $nestado);
        $noticias_categorias = Noticia_Categoria::get_tree_select_noticias_categorias();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_noticias_data', compact('noticias', 'noticias_categorias'));
        endif;

        return view('admin.modules.noticias', compact('noticias', 'noticias_categorias','desarrollador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $noticias_categorias = Noticia_Categoria::get_tree_select_noticias_categorias();
        $noticias_tags = Noticia_Tag::where('estado',1)->where('oculto',0)->get();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');
        // $noticias_tags = Tag::where('estado',1)->where('oculto',0)->get();

        return view('admin.modules.crud-noticias', compact('noticias_categorias','noticias_tags', 'desarrollador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticias');
        endif;

        $rules = [
            'categoriaNoticia' => 'required',
            'tituloNoticia' => 'required',
        ];
        
        $messages = [
            'categoriaNoticia.required' => 'El Campo Categoría de la Noticia es requerida',
            'tituloNoticia.required' => 'El campo Título de la Noticia es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $usuario = $request->hddusuario;
            $data = NoticiaService::ArrayNoticiaAdd($request);

            if($noticia=Noticia::create($data)):

                $lastid = $noticia->noticia_id;

                // Categoria Noticia
                if(isset($request->categoriaNoticia) && count($request->categoriaNoticia)>0):

                    foreach($request->categoriaNoticia as $cn):
                        
                        $dataNoticiaCategoria = [
                            "noticia_id"=>$lastid,
                            "noticia_categoria_id"=>$cn,
                            "oculto"=>0,
                            "usuario_registra"=>$usuario,
                            "fecha_registro"=>now()
                        ];

                        Noticia_m_Noticia_Categoria::create($dataNoticiaCategoria);

                    endforeach;
                endif;

                // Tag Noticia
                if(isset($request->tagsNoticia) && count($request->tagsNoticia)>0):
                    foreach($request->tagsNoticia as $tn):

                        $dataEtiqueta = [
                            "noticia_id"=>$lastid,
                            "noticia_tag_id"=>$tn,
                            "oculto"=>0,
                            "usuario_registra"=>$usuario,
                            "fecha_registro"=>now()
                        ];

                        Noticia_m_Noticia_Tags::create($dataEtiqueta);
    
                    endforeach;
                endif;

                // Imagenes Noticia
                if(isset($request->imgnoticia)):

                    $arrayimg = explode("|*|", $request->imgnoticia);
                    $urlimagen = "assets/images/noticias/".$lastid."/".$arrayimg[0];

                    $dataImagenNoticiaPrincipal = [
                        "noticia_id"=>$lastid,
                        "imagen"=>$arrayimg[0],
                        "size"=>$arrayimg[1],
                        "url"=>$urlimagen,
                        "principal"=>1,
                        "usuario_registro"=>$usuario,
                        "fecha_registro"=>now()
                    ];

                   if(Noticia_Imagens::create($dataImagenNoticiaPrincipal)):
                        if($arrayimg[2] == '1'):
                            echo NoticiaService::moveNoticiaImage($arrayimg[0], $lastid);
                        endif;
                   endif;

                endif;
                
                // Galería Noticia
                if(isset($request->imagenesNoticias) && count($request->imagenesNoticias)>0):
                    $i = 1;
                    foreach($request->imagenesNoticias as $filegaleriaN):
                        $arrayGaleria = explode("|*|", $filegaleriaN);
                        $urlfiles = "assets/images/noticias/".$lastid."/".$arrayGaleria[0];

                        $dataGaleriaNoticia = [
                            "noticia_id"=>$lastid,
                            "imagen"=>$arrayGaleria[0],
                            "size"=>$arrayGaleria[1],
                            "url"=>$urlfiles,
                            "principal"=>0,
                            "usuario_registro"=>$usuario,
                            "fecha_registro"=>now()
                        ];

                        if(Noticia_Imagens::create($dataGaleriaNoticia)):
                            if($arrayGaleria[2] == '1'):
                                echo NoticiaService::moveImage($arrayGaleria[0], $lastid);
                            endif;
                        endif;
                        $i++;
                    endforeach;
                endif;

                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/noticias')]);
                
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
    public function edit($noticia_id)
    {
        //
        $decrypt_id = Hashids::decode($noticia_id);

        $dataN = Noticia::where('noticia_id', $decrypt_id)->where('oculto',0)->first();

        if($dataN == NULL):
            return redirect('/admin/noticias');
        endif;

        $noticia = Noticia::find($decrypt_id)->first();

        $noticiascategorias_Array = Noticia_m_Noticia_Categoria::where('noticia_id', $decrypt_id)
        ->where('oculto',0)->pluck('noticia_categoria_id')->toArray();

        $noticiasetiquetas_Array = Noticia_m_Noticia_Tags::where('noticia_id', $decrypt_id)
        ->where('oculto',0)->pluck('noticia_tag_id')->toArray();

        $noticias_categorias = Noticia_Categoria::get_tree_select_noticias_categorias();

        $noticias_tags = Noticia_Tag::where('estado',1)->where('oculto',0)->get();

        $imgnoticiaprincipal = Noticia_Imagens::where('noticia_id', $decrypt_id)->where('principal',1)->first();
        $imgnoticiagaleria = Noticia_Imagens::where('noticia_id', $decrypt_id)->where('principal',0)->get();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        return view('admin.modules.crud-noticias', compact('noticia', 'noticias_categorias', 'noticias_tags', 'noticiascategorias_Array', 'noticiasetiquetas_Array', 'imgnoticiaprincipal','imgnoticiagaleria', 'desarrollador'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $noticia_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/noticias');
        endif;

        $rules = [
            'categoriaNoticia' => 'required',
            'tituloNoticia' => 'required',
        ];
        
        $messages = [
            'categoriaNoticia.required' => 'El Campo Categoría de la Noticia es requerida',
            'tituloNoticia.required' => 'El campo Título de la Noticia es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $usuario = $request->hddusuario;
            $data = NoticiaService::ArrayNoticiaUpdate($request);
            
            $noticia = Noticia::find($noticia_id);

            if($noticia->update($data)):

                if(isset($request->categoriaNoticia) && count($request->categoriaNoticia)>0):

                    Noticia_m_Noticia_Categoria::where("noticia_id", $noticia_id)->update(["oculto" => 1]);

                    foreach($request->categoriaNoticia as $ncat):

                        $existNoticiaCategoria = Noticia_m_Noticia_Categoria::where("noticia_id", $noticia_id)->where("noticia_categoria_id",$ncat)->count();

                        if($existNoticiaCategoria>0):
                            Noticia_m_Noticia_Categoria::where("noticia_id", $noticia_id)->where("noticia_categoria_id",$ncat)->update(["oculto" => 0]);
                        else:
                            $dataNoticiaCategoria = [
                                "noticia_id"=>$noticia_id,
                                "noticia_categoria_id"=>$ncat,
                                "oculto"=>0,
                                "usuario_registra"=>$usuario,
                                "fecha_registro"=>now()
                            ];
    
                            Noticia_m_Noticia_Categoria::create($dataNoticiaCategoria);
                        endif;
                    
                    endforeach;
                endif;


                if(isset($request->tagsNoticia) && count($request->tagsNoticia)>0):

                    Noticia_m_Noticia_Tags::where("noticia_id", $noticia_id)->update(["oculto" => 1]);

                    foreach($request->tagsNoticia as $ntag):

                        $existNoticiaTags = Noticia_m_Noticia_Tags::where("noticia_id", $noticia_id)->where("noticia_tag_id",$ntag)->count();

                        if($existNoticiaTags>0):
                            Noticia_m_Noticia_Tags::where("noticia_id", $noticia_id)->where("noticia_tag_id",$ntag)->update(["oculto" => 0]);
                        else:

                            $dataNoticiaEtiqueta = [
                                "noticia_id"=>$noticia_id,
                                "noticia_tag_id"=>$ntag,
                                "oculto"=>0,
                                "usuario_registra"=>$usuario,
                                "fecha_registro"=>now()
                            ];

                            Noticia_m_Noticia_Tags::create($dataNoticiaEtiqueta);

                        endif;
    
                    endforeach;
                endif;

                if(isset($request->imgnoticia)):

                    $arrayImgNoticia = explode("|*|", $request->imgnoticia);

                    if($arrayImgNoticia[2] == 1):

                        $urlimagen = "assets/images/noticias/".$noticia_id."/".$arrayImgNoticia[0];

                        $dataImagenNoticiaPrincipal = [
                            "noticia_id"=>$noticia_id,
                            "imagen"=>$arrayImgNoticia[0],
                            "size"=>$arrayImgNoticia[1],
                            "url"=>$urlimagen,
                            "principal"=>1,
                            "usuario_registro"=>$usuario,
                            "fecha_registro"=>now()
                        ];
    
                       if(Noticia_Imagens::create($dataImagenNoticiaPrincipal)):
                            if($arrayImgNoticia[2] == '1'):
                                if($request->idImgNoticia!=""):
                                    echo NoticiaService::existImagePrincipal($noticia_id, $request->idImgNoticia);
                                endif;
                                echo NoticiaService::moveNoticiaImage($arrayImgNoticia[0], $noticia_id);
                            endif;
                       endif;

                    endif;

                endif;

                if(isset($request->imagenesNoticias) && count($request->imagenesNoticias)>0):
                    $i = 1;
                    foreach($request->imagenesNoticias as $filegaleriaN):
                        $arrayGaleriaN = explode("|*|", $filegaleriaN);

                        if($arrayGaleriaN[2] == 1):

                            $urlfiles = "assets/images/noticias/".$noticia_id."/".$arrayGaleriaN[0];

                            $dataGaleriaNoticia = [
                                "noticia_id"=>$noticia_id,
                                "imagen"=>$arrayGaleriaN[0],
                                "size"=>$arrayGaleriaN[1],
                                "url"=>$urlfiles,
                                "principal"=>0,
                                "usuario_registro"=>$usuario,
                                "fecha_registro"=>now()
                            ];

                            if(Noticia_Imagens::create($dataGaleriaNoticia)):
                                if($arrayGaleriaN[2] == '1'):
                                    echo NoticiaService::moveNoticiaImage($arrayGaleriaN[0], $noticia_id);
                                endif;
                            endif;

                        endif;

                        $i++;
                    endforeach;
                endif;

                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/noticias')]);
            
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
    public function destroy(Request $request, $noticia_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/noticias');
        endif;

        $decrypt_id = Hashids::decode($noticia_id);

        Noticia_m_Noticia_Categoria::where("noticia_id", $decrypt_id[0])->update(["oculto" => 1]);

        Noticia_m_Noticia_Tags::where("noticia_id", $decrypt_id[0])->update(["oculto" => 1]);

        $noticia = Noticia::find($decrypt_id[0]);

        $data = [
            "oculto"=>1,
        ];

        if($noticia->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $noticia_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticias');
        endif;

        $decrypt_id = Hashids::decode($noticia_id);
        $noticia = Noticia::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($noticia->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }
    
    public function activar(Request $request, $noticia_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticias');
        endif;

        $decrypt_id = Hashids::decode($noticia_id);
        $noticia = Noticia::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($noticia->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }


    public function subirImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticias');
        endif;


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

    public function eliminarImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticias');
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
            return redirect('/admin/noticias');
        endif;

        $noticia_img = Noticia_Imagens::find($request->image_id);
        if($noticia_img->delete()):
            $url = public_path('assets/images/noticias/'.$request->id.'/'.$request->filename);
            $image = ImageService::eliminarImg($url);
            return response()->json(['code' => '200']);
        else:
            return response()->json(['code' => '205']);
        endif;
    }

    public function upload_img_desc(Request $request)
    {
        // if (!$request->ajax()):
        //     return redirect('/admin/noticias');
        // endif;

        if($request->hasFile('upload')) 
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('assets/images/noticias/'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/images/noticias/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
