<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use App\Models\Noticia_Categoria;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

use App\Services\Admin\{
	CategoriaService
};

use App\Models\Configuracion;

class NoticiaCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.noticias_categorias.index');
    }

    public function index(Request $request)
    {
        //  
        $NoticiaCategoriabuscar = $request->get('noticia_categoria');
        $estadocNoticiaCategoria = $request->get('estado');

        $padres_nc = Noticia_Categoria::getListParentsNoticias();

        $noticias_categoria = Noticia_Categoria::where('parent_id',0);

        if (isset($NoticiaCategoriabuscar) && $NoticiaCategoriabuscar != ''):
            $noticias_categoria ->where('noticia_categoria','LIKE','%'.$NoticiaCategoriabuscar."%");
        endif;     

        if (isset($estadocNoticiaCategoria) && $estadocNoticiaCategoria!='_all_'):
            $noticias_categoria->where('estado',$estadocNoticiaCategoria );
        endif;

        $noticias_categoria = $noticias_categoria->where('oculto',0)->orderBy('noticia_categoria','ASC')->paginate(5);

        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_noticias_categorias_data', compact('noticias_categoria','padres_nc'));
        endif;

        return view('admin.modules.noticias_categorias', compact('noticias_categoria','padres_nc', 'desarrollador'));
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
            return redirect('/admin/noticia_categoria');
        endif;

        $rules = [
            'noticia_categoria'=>'required|max:40'
        ];

        $messages = [
            'noticia_categoria.required' => 'El campo Categoria de la Noticia es requerido',
            'noticia_categoria.max' => 'El campo Categoria de la Noticia debe contener como máximo 40 carácteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
 
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
 
        else:

            $slugnoticiacategoria = Str::slug($request->noticia_categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;

            if($request->noticiacategoriapadre!="0"):

                $nparentNoticiaCategoria = Noticia_Categoria::getParentsNCExits($request->noticiacategoriapadre, $slugnoticiacategoria);

                if($nparentNoticiaCategoria>0):
                
                    return response()->json(['errors'=>$validator->errors(), 'code' => '427']);
        
                else:

                    $data = [
                        "noticia_categoria"=>trim($request->noticia_categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->noticiacategoriapadre,
                        "url"=>$slugnoticiacategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_registra"=>$request->usuario,
                        "fecha_registro"=>now()
                    ];

                   if(Noticia_Categoria::create($data)):
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                   else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                   endif;

                
                endif;

            else:
                
                $existNoticiaCategoria = Noticia_Categoria::getNoticiaCategoryExits('url', $slugnoticiacategoria);

                if($existNoticiaCategoria>0):

                    return response()->json(['errors'=>$validator->errors(), 'code' => '426']);

                else:

                  $data = [
                        "noticia_categoria"=>trim($request->noticia_categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->noticiacategoriapadre,
                        "url"=>$slugnoticiacategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_registra"=>$request->usuario,
                        "fecha_registro"=>now()
                    ];

                   if(Noticia_Categoria::create($data)):
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
    public function show($noticia_categoria_id)
    {
        //
        $decrypt_id = Hashids::decode($noticia_categoria_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/noticia_categoria');
        endif;
        $noticiaCategoria = Noticia_Categoria::find($decrypt_id[0]);
        return response()->json($noticiaCategoria);
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
    public function update(Request $request, $noticia_categoria_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/noticia_categoria');
        endif;

        $decrypt_id = Hashids::decode($noticia_categoria_id);

        $rules = [
            'noticia_categoria'=>'required|max:40'
        ];

        $messages = [
            'noticia_categoria.required' => 'El campo Categoria de la Noticia es requerido',
            'noticia_categoria.max' => 'El campo Categoria de la Noticia debe contener como máximo 40 carácteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        
        if($validator->fails()):

            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        
        else:

            $slugnoticiaCategoria = Str::slug($request->noticia_categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;

            if($request->parent_actual!=$request->noticiacategoriapadre): 

                $existNoticiaCategoria = Noticia_Categoria::getParentsNCExits($request->noticiacategoriapadre, $slugnoticiaCategoria);
                
                if($existNoticiaCategoria>0):

                    return response()->json(['errors'=>$validator->errors(), 'code' => '426']);

                else:

                    $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);

                    $data = [
                        "noticia_categoria"=>trim($request->noticia_categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->noticiacategoriapadre,
                        "url"=>$slugnoticiaCategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_registra"=>$request->usuario,
                        "fecha_modifica"=>now()
                    ];

                    if($noticia_categoria->update($data)):
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                    else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                    endif;


                endif;

            else:

                if($request->slug_actual!=$slugnoticiaCategoria):

                    $existnc = Noticia_Categoria::getNoticiaCategoryExits($slugnoticiaCategoria);

                    if($existnc>0):
                        
                        return response()->json(['errors'=>$validator->errors(), 'code' => '427']);

                    else:

                       $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);

                        $data = [
                            "noticia_categoria"=>trim($request->noticia_categoria),
                            "descripcion"=>$request->descripcion,
                            "parent_id"=>$request->noticiacategoriapadre,
                            "url"=>$slugnoticiaCategoria,
                            "estado"=>$activo,
                            "oculto"=>$oculto,
                            "usuario_registra"=>$request->usuario,
                            "fecha_modifica"=>now()
                        ];
    
                        if($noticia_categoria->update($data)):
                            return response()->json(['msg'=>'sucess', 'code' => '200']);
                        else:
                            return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                        endif;

                    endif;
                else:
                    $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
                    
                    $data = [
                        "noticia_categoria"=>trim($request->noticia_categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$request->noticiacategoriapadre,
                        "url"=>$slugnoticiaCategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_registra"=>$request->usuario,
                        "fecha_modifica"=>now()
                    ];
               
                    if($noticia_categoria->update($data)):
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
    public function destroy(Request $request, $noticia_categoria_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/noticia_categoria');
        endif;

        $decrypt_id = Hashids::decode($noticia_categoria_id);
        $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($noticia_categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $noticia_categoria_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticia_categoria');
        endif;

        $decrypt_id = Hashids::decode($noticia_categoria_id);
        $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($noticia_categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $noticia_categoria_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticia_categoria');
        endif;
        
        $decrypt_id = Hashids::decode($noticia_categoria_id);
        $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($noticia_categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

}
