<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use DB, Validator;
use App\Models\Noticia_Categoria;

use App\Models\Configuracion;

class NoticiaSubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.noticias_categorias.visualizar');
    }

    public function index()
    {
        //
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
            return redirect('/admin/categorias/noticia_categoria');
        endif;

        $rules = [
            'noticia_categoria'=>'required|max:40'
        ];

        $messages = [
            'noticia_categoria.required' => 'El campo Noticia SubCategoria es requerido',
            'noticia_categoria.max' => 'El campo Noticia SubCategoria debe contener como máximo 40 carácteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            
            $slugnoticiasubcategoria = Str::slug($request->noticia_categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;
            $parent_id = Hashids::decode($request->noticiacategoriapadre);

            $exitsSubcat = DB::table('noticia_categorias')->where('parent_id', $parent_id)->where('url',$slugnoticiasubcategoria)->where('oculto',0)->count();

            if($exitsSubcat>0):
                return response()->json(['errors'=>$validator->errors(), 'code' => '427']);
            else:
             
                $data = [
                    "noticia_categoria"=>trim($request->noticia_categoria),
                    "descripcion"=>$request->descripcion,
                    "parent_id"=>$parent_id[0],
                    "url"=>$slugnoticiasubcategoria,
                    "estado"=>$activo,
                    "oculto"=>$oculto,
                    "usuario_registra"=>$request->usuario,
                    "fecha_registro"=>now()
                ];

                // var_dump($data);exit;

               if(Noticia_Categoria::create($data)):
                    return response()->json(['msg'=>'sucess', 'code' => '200']);
               else:
                    return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
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
        $noticiaSubCategoria = Noticia_Categoria::find($decrypt_id[0]);
        return response()->json($noticiaSubCategoria);
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
            return redirect('/admin/categorias/noticia_categoria');
        endif;

        $rules = [
            'noticia_categoria'=>'required|max:40'
        ];

        $messages = [
            'noticia_categoria.required' => 'El campo Noticia SubCategoria es requerido',
            'noticia_categoria.max' => 'El campo Noticia SubCategoria debe contener como máximo 40 carácteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $decrypt_id = Hashids::decode($request->noticia_categoria_id);
            $decrypt_parentid = Hashids::decode($request->parent_subactual);
            $slugsubnoticiacategoria = Str::slug($request->noticia_categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;

            if($request->slug_subactual!=$slugsubnoticiacategoria):
                $existc = DB::table('noticia_categorias')->where('parent_id', $decrypt_parentid[0])->where('url',$slugsubnoticiacategoria)->where('oculto',0)->count();

                if($existc>0):
                    return response()->json(['errors'=>$validator->errors(), 'code' => '427']);
                else:
                    $noticia_subcategoria = Noticia_Categoria::find($decrypt_id[0]);

                    $data = [
                        "noticia_categoria"=>trim($request->noticia_categoria),
                        "descripcion"=>$request->descripcion,
                        "parent_id"=>$decrypt_parentid[0],
                        "url"=>$slugsubnoticiacategoria,
                        "estado"=>$activo,
                        "oculto"=>$oculto,
                        "usuario_modifica"=>$request->usuario,
                        "fecha_modifica"=>now()
                    ];

                    if($noticia_subcategoria->update($data)):
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                    else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                    endif;

                   
                endif;
            else:
                
                $noticia_subcategoria = Noticia_Categoria::find($decrypt_id[0]);

                $data = [
                    "noticia_categoria"=>trim($request->noticia_categoria),
                    "descripcion"=>$request->descripcion,
                    "parent_id"=>$decrypt_parentid[0],
                    "url"=>$request->slug_subactual,
                    "estado"=>$activo,
                    "oculto"=>$oculto,
                    "usuario_modifica"=>$request->usuario,
                    "fecha_modifica"=>now()
                ];

                if($noticia_subcategoria->update($data)):
                    return response()->json(['msg'=>'sucess', 'code' => '200']);
                else: 
                    return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
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
    public function destroy($noticia_categoria_id, Request $request)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/categorias/noticia_categoria');
        endif;
        $decrypt_id = Hashids::decode($noticia_categoria_id);
        $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
        $oculto = 1;
        $data = [
            "oculto"=>1,
            "usuario_modifica"=>$request->usuario,
            "fecha_modifica"=>now()
        ];
        if($noticia_categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar($noticia_categoria_id, Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias/noticia_categoria');
        endif;

        $decrypt_id = Hashids::decode($noticia_categoria_id);
        $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
            "usuario_modifica"=>$request->usuario,
            "fecha_modifica"=>now()
        ];
        if($noticia_categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar($noticia_categoria, Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias/noticia_categoria');
        endif;
        
        $decrypt_id = Hashids::decode($noticia_categoria);
        $noticia_categoria = Noticia_Categoria::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
            "usuario_modifica"=>$request->usuario,
            "fecha_modifica"=>now()
        ];
        if($noticia_categoria->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function listarSubCategoriasNoticias($encryp_id, Request $request)
    {
        // $hashids = new Hashids();
        $noticiacategoria_id = Hashids::decode($encryp_id);
        // $categoria_id = Crypt::decrypt($encrypt_id);
        $padresNoticias = DB::table('noticia_categorias')->select('noticia_categoria_id','noticia_categoria')->where('parent_id',0)->where('estado',1)->where('oculto',0)->orderBy('noticia_categoria')->get();
        $Noticiacategoria = DB::table('noticia_categorias')->select('noticia_categoria_id','noticia_categoria')->where('noticia_categoria_id',$noticiacategoria_id)->first();
        $subcategoriasNoticias = DB::table('noticia_categorias')->where('parent_id',$noticiacategoria_id)->where('oculto',0);
        if(isset($request->noticia_categoria) && $request->noticia_categoria != ''):
            $subcategoriasNoticias->where('noticia_categoria','LIKE','%'.$request->noticia_categoria."%");
        endif;
        
        $subcategoriasNoticias = $subcategoriasNoticias->orderBy('noticia_categoria')->paginate(10);

        $desarrollador = Configuracion::get_valorxvariable('desarrollador');
        
        if ($request->ajax()) {
            return view('admin.data.load_noticias_subcategorias_data', compact('subcategoriasNoticias', 'Noticiacategoria', 'padresNoticias'));
        }

        // return view('admin.almacen.subcategorias',$data);
        return view('admin.modules.noticias_subcategorias', compact('subcategoriasNoticias', 'Noticiacategoria', 'padresNoticias'));
    }
}
