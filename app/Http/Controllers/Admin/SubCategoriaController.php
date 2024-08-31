<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Categoria;
use DB, Validator;
use Illuminate\Support\Str;
use App\Models\Configuracion;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.categorias.show');
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
            
            $slugsubcategoria = Str::slug($request->categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;
            $parent_id = Hashids::decode($request->categoriapadre);

            $url_parent = Categoria::select('categoria','url')->where('categoria_id',$parent_id)->where('oculto',0)->first();
            
            $url_lista = $url_parent['url'].'/'.$slugsubcategoria;

            $exitsSubcat = DB::table('categorias')->where('parent_id', $parent_id)->where('url',$slugsubcategoria)->where('oculto',0)->count();

            if($exitsSubcat>0):
                return response()->json(['errors'=>$validator->errors(), 'code' => '427']);
            else:
                // var_dump($parent_id[0]);exit;
                $categoria = new Categoria;
                $categoria->categoria=e($request->categoria);
                $categoria->descripcion=e($request->descripcion);
                $categoria->parent_id=e($parent_id[0]);
                $categoria->url=$url_lista;
                $categoria->estado = $activo;
                $categoria->oculto = $oculto;
                $categoria->usuario_registra = '46749322';
                $categoria->fecha_registro=now();
                if($categoria->save()):
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
    public function show($categoria_id)
    {
        //
        $decrypt_id = Hashids::decode($categoria_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/categorias');
        endif;
        $categoria = DB::table('categorias')->where('categoria_id',$decrypt_id)->get();
        return response()->json(['categoria' => $categoria]);
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
            $decrypt_id = Hashids::decode($request->categoria_id);
            $decrypt_parentid = Hashids::decode($request->parent_actual);
            $slugcategoria = Str::slug($request->categoria);
            $activo = $request->activo == "true" ? "1":"0";
            $oculto =0;
            $url_parent = Categoria::select('categoria','url')->where('categoria_id',$decrypt_parentid[0])->where('oculto',0)->first();
            $url_lista = $url_parent['url'].'/'.$slugcategoria;

            if($request->slug_actual!=$slugcategoria):

                $existc = DB::table('categorias')->where('url',$slugcategoria)->where('oculto',0)->count();

                if($existc>0):
                    return response()->json(['errors'=>$validator->errors(), 'code' => '427']);
                else:
                    $categoria = Categoria::find($decrypt_id[0]);
                    $categoria->categoria=e(trim($request->categoria));
                    $categoria->descripcion=e($request->descripcion);
                    $categoria->parent_id = e($decrypt_parentid[0]);
                    $categoria->url=$url_lista;
                    $categoria->estado =$activo;
                    $categoria->oculto =$oculto;
                    $categoria->usuario_modifica = '46749322';
                    $categoria->fecha_modifica=now();
                    if($categoria->save()):
                        return response()->json(['msg'=>'sucess', 'code' => '200']);
                    else: 
                        return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                    endif;            
                endif;

            else:

                $categoria = Categoria::find($decrypt_id[0]);
                $categoria->categoria=e(trim($request->categoria));
                $categoria->descripcion=e($request->descripcion);
                $categoria->parent_id = e($decrypt_parentid[0]);
                $categoria->$request->slug_actual;
                $categoria->estado =$activo;
                $categoria->oculto =$oculto;
                $categoria->usuario_modifica = '46749322';
                $categoria->fecha_modifica=now();
                if($categoria->save()):
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
    public function destroy(Request $request, $categoria_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/categorias');
        endif;

        $decrypt_id = Hashids::decode($categoria_id);
        $categoria = Categoria::find($decrypt_id[0]);
        $oculto = 1;
        $categoria->oculto = $oculto;
        if($categoria->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function listarSubCategorias($encryp_id, Request $request)
    {
        // $hashids = new Hashids();
        $categoria_id = Hashids::decode($encryp_id);
        $datacat = DB::table('categorias')->select('categoria_id')->where('categoria_id',$categoria_id)->where('oculto',0)->first();
        if($datacat == NULL):
            return redirect('/admin/categorias');
        endif;
        // $categoria_id = Crypt::decrypt($encrypt_id);
        $padres = DB::table('categorias')->select('categoria_id','categoria')->where('parent_id',0)->where('estado',1)->where('oculto',0)->orderBy('categoria')->get();
        $categoria = DB::table('categorias')->select('categoria_id','categoria','url')->where('categoria_id',$categoria_id)->first();
        $subcategorias = DB::table('categorias')->where('parent_id',$categoria_id)->where('oculto',0);
        if(isset($request->categoria) && $request->categoria != ''):
            $subcategorias->where('categoria','LIKE','%'.$request->categoria."%");
        endif;
        
        $subcategorias = $subcategorias->orderBy('categoria')->paginate(5);
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()) {
            return view('admin.data.load_subcategorias_data', compact('subcategorias', 'categoria', 'padres'));
        }

        // return view('admin.almacen.subcategorias',$data);
        return view('admin.modules.subcategorias', compact('subcategorias', 'categoria', 'padres','desarrollador'));
    }

    public function activar(Request $request, $categoria_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/categorias');
        endif;

        $decrypt_id = Hashids::decode($categoria_id);
        $categoria = Categoria::find($decrypt_id[0]);
        $activo = 1;
        $categoria->estado = $activo;
        if($categoria->save()):
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
        $desactivar = 0;
        $categoria->estado = $desactivar;
        if($categoria->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }


}
