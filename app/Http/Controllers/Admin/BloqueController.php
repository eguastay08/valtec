<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use Illuminate\Support\Facades\File;
use Vinkla\Hashids\Facades\Hashids;


use App\Models\Bloque_tipo;
use App\Models\Categoria;
use App\Models\Bloque;
use App\Models\Configuracion;

use App\Services\Admin\{
	BloqueService,
	ImageService
};





class BloqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.disenio.index');
    }

    public function index(Request $request)
    {
        //
        $tipoBloques = Bloque_tipo::select('bloque_tipo_id', 'nombre')->where('bloque_tipos.codigo', '!=', 'OFERTAS')->where('estado',1)->where('oculto',0)->get();
        $categorias = Categoria::get_tree_select();
        // $bloques = Bloque::select('bloque_tipo_id','config','titulo','icono','estado','posicion')->where('oculto',0)->get();
        $bloques = Bloque::getBloques();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_bloques_data', compact('tipoBloques', 'categorias','bloques'));
        endif;

        return view('admin.modules.diseno', compact('tipoBloques','categorias','bloques', 'desarrollador'));
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
            return redirect('/admin/disenio');
        endif;

        $rules = [
            'tipobloque' => 'required',
        ];
        
        $messages = [
            'tipobloque.required' => 'El Tipo de Bloque es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $tipobloque = $request->tipobloque;

            if($tipobloque==1 || $tipobloque==2 || $tipobloque==4):
                if($request->titulobloque== ""):
                    return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
                    exit;
                endif;
            endif;

            $countBloque = Bloque::countBloque();

            if($countBloque>0):
                $valuePosicion = Bloque::latestPosition();
                $posicion = intval($valuePosicion)+1;
            else:
                $posicion = 1;
            endif;

            $data = BloqueService::addArrayData($request, $tipobloque, $posicion);

            if(Bloque::create($data)):
                if( $data['nombreicono'] != '' ):
                    echo BloqueService::moveImage($data['nombreicono']);
                endif;
                return response()->json(['msg'=>'sucess', 'code' => '200']);
            else:
                    return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
            endif;

        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($bloque_id)
    {
        //
        $decrypt_id = Hashids::decode($bloque_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/disenio');
        endif;
        $bloque = Bloque::find($decrypt_id[0]);
        return response()->json($bloque);
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
    public function update(Request $request, $bloque_id)
    {
        //
        
        if(!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($bloque_id);

        $rules = [
            'tipobloque' => 'required',
        ];
        
        $messages = [
            'tipobloque.required' => 'El Tipo de Bloque es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $tipobloque = $request->tipobloque;

            if($tipobloque==1 || $tipobloque==2 || $tipobloque==4):
                if($request->titulobloque== ""):
                    return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
                    exit;
                endif;
            endif;

            $data = BloqueService::updateArrayData($request, $tipobloque);
        
            $bloque = Bloque::find($decrypt_id[0]);

            if($bloque->update($data)):
                if($data['temporal'] != 0):
                    echo BloqueService::moveImage($data['nombreicono']);
                endif;
                return response()->json(['msg'=>'sucess', 'code' => '200']);
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
    public function destroy(Request $request, $bloque_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($bloque_id);
        $bloque = Bloque::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($bloque->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $bloque_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($bloque_id);
        $bloque = Bloque::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($bloque->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $bloque_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($bloque_id);
        $bloque = Bloque::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($bloque->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function down($bloque_id,Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($bloque_id);
        $posicionactual = $request->posicion;
        $posicion = intval($posicionactual)+1;
        $bloqueposicion = Bloque::getBloqueByPosition($posicion);
        if($bloqueposicion):
            Bloque::where("bloque_id", $bloqueposicion->bloque_id)->update(["posicion" =>$posicionactual]);
        endif;
        $bloque = Bloque::find($decrypt_id[0]);
        $data = [
            "posicion"=>$posicion,
        ];
        if($bloque->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    

    }

    public function up($bloque_id,Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($bloque_id);
        $posicionactual = $request->posicion;
        $posicion = intval($posicionactual)-1;
        $bloqueposicion = Bloque::getBloqueByPosition($posicion);
        if($bloqueposicion):
            Bloque::where("bloque_id", $bloqueposicion->bloque_id)->update(["posicion" =>$posicionactual]);
        endif;
        $bloque = Bloque::find($decrypt_id[0]);
        $data = [
            "posicion"=>$posicion,
        ];
        if($bloque->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function subirImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $rules = [
            'imagen'=>'mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
                
                'imagen.size'=>'El Tamaño de la Imagen principal no debe ser mayor a 2MB',
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
            return redirect('/admin/disenio');
        endif;

       $data = ImageService::eliminarImagenTmp($request);
       if($data):
            return response()->json(['code' => '200']);
       else:
            return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
       endif;     
    }

    public function eliminarImg(Request $request)
    {   
        if (!$request->ajax()):
            return redirect('/admin/disenio');
        endif;

        $decrypt_id = Hashids::decode($request->image_id);
        $url = public_path('assets/images/iconos/'.$request->filename);
        // $url = public_path('admin/images/iconos/'.$request->filename);
        $image = ImageService::eliminarImg($url);
        Bloque::where("bloque_id", $decrypt_id[0])->update(["icono" => "", "nombre_icono" => "", "size_icono" => ""]);
        return response()->json(['code' => '200']);
    }
}
