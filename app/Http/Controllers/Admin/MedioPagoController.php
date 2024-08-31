<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Vinkla\Hashids\Facades\Hashids;

use App\Models\Medio_Pago;

use App\Services\Admin\{
    MedioPagoService,
	ImageService
};

use App\Models\Configuracion;

class MedioPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.medios_pago.index');
    }

    public function index(Request $request)
    {
        //
        $mediopago = isset($request->mediopago) ? $request->mediopago : '';
        $estado = isset($request->estado) ? $request->estado : '_all_';

        $mediospago = Medio_Pago::getMedioPagos($mediopago,$estado);
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_medios_pago_data', compact('mediospago'));
        endif;

        return view('admin.modules.medios_pago', compact('mediospago', 'desarrollador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.crud-medios-pago');
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
            return redirect('/admin/medios_pagos');
        endif;

        $rules = [
            'txtNombreMedio' => 'required',
        ];
        
        $messages = [
            'txtNombreMedio.required' => 'El Nombre del Medio de Pago es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = MedioPagoService::addArrayDataMedioPago($request);

            if(Medio_Pago::create($data)):
                if($data['mediopagoimgnombre']!=""):
                    echo MedioPagoService::moveMedioPagoImg($data['mediopagoimgnombre']);
                endif;
                // return response()->json(['msg'=>'sucess', 'code' => '200']);
                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/medios_pagos')]);
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
    public function show($medio_pago_id)
    {
        //
        // $decrypt_id = Hashids::decode($medio_pago_id);
        // if(count($decrypt_id) == 0):
        //     return redirect('/admin/medios_pagos');
        // endif;
        // $mediopago = Medio_Pago::find($decrypt_id[0]);
        // return response()->json($mediopago);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($medio_pago_id)
    {
        $decrypt_id = Hashids::decode($medio_pago_id);

        $dataMP = Medio_Pago::where('medio_pago_id', $decrypt_id)->where('oculto',0)->first();

        if($dataMP == NULL):
            return redirect('/admin/medios_pagos');
        endif;
        
        $medio_pago = Medio_Pago::find($decrypt_id)->first();

        return view('admin.modules.crud-medios-pago', compact('medio_pago'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mediopago_id)
    {
        //

        if (!$request->ajax()):
            return redirect('/admin/medios_pagos');
        endif;

        $decrypt_id = Hashids::decode($mediopago_id);
        $rules = [
            'txtNombreMedio' => 'required',
        ];
        
        $messages = [
            'txtNombreMedio.required' => 'El Nombre del Medio de Pago es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $data = MedioPagoService::updateArrayDataMedioPaga($request);

            $mediopago = Medio_Pago::find($decrypt_id[0]);

            if($mediopago->update($data)):
                if($data['temporal']=="1"):
                    if($request->medioPagoImgActual!=""):
                        echo MedioPagoService::existImgMedioPago($decrypt_id[0],$request->medioPagoImgActual);
                    endif;
                    echo MedioPagoService::moveMedioPagoImg($data['mediopagoimgnombre']);
                endif;
                // return response()->json(['msg'=>'sucess', 'code' => '200']);
                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/medios_pagos')]);
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
    public function destroy(Request $request, $medio_pago_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/medios_pagos');
        endif;

        $decrypt_id = Hashids::decode($medio_pago_id);
        $mediopago = Medio_Pago::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
            "usuario_modifica" => $request->usuario
        ];
        if($mediopago->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $slider_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/medios_pagos');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $mediopago = Medio_Pago::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
            "usuario_modifica" => $request->usuario
        ];
        if($mediopago->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $slider_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/medios_pagos');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $mediopago = Medio_Pago::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
            "usuario_modifica" => $request->usuario
        ];
        if($mediopago->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function subirImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/medios_pagos');
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
            return redirect('/admin/medios_pagos');
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
            return redirect('/admin/medios_pagos');
        endif;

        $decrypt_id = Hashids::decode($request->image_id);
        $url = public_path('assets/images/medios_pago/'.$request->filename);
        $image = ImageService::eliminarImg($url);
        Medio_Pago::where("medio_pago_id", $decrypt_id[0])->update(["imagen" => "", "nombre_img" => "", "size_img" => ""]);
        return response()->json(['code' => '200']);
    }

    public function upload(Request $request)
    {
        // if (!$request->ajax()):
        //     return redirect('/admin/medios_pagos');
        // endif;

        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('assets/images/medios_pago/'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/images/medios_pago/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function upload_tiny(Request $request){
        if (!$request->ajax()):
            return redirect('/admin/medios_pagos');
        endif;
        
        // $fileName=$request->file('file')->getClientOriginalName();
        // $request->file('file')->move(public_path('assets/images/medios_pago/'), $fileName);
        // $url = asset('assets/images/medios_pago/'.$fileName); 
        // // $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
        // return response()->json(['location'=>"$url"]); 
        
        // /*$imgpath = request()->file('file')->store('uploads', 'public'); 
        // return response()->json(['location' => "/storage/$imgpath"]);*/
        $imgpath = request()->file('file')->store('uploads','public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }

}
