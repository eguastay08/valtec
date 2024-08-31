<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Descuento;
use App\Models\Configuracion;

use App\Services\Admin\{
	DescuentoService
};

//juhyhyhsssss
class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.descuentos.index');
    }

    public function index(Request $request)
    {
        //
        $descuentos = Descuento::getDescuento();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_descuentos_data', compact('descuentos'));
        endif;

        return view('admin.modules.descuentos', compact('descuentos', 'desarrollador'));
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
            return redirect('/admin/descuentos');
        endif;

        $rules = [
            'txtcupon' => 'required',
            'txtporcentajes' => 'numeric|min:1',
            'cboUsoDescuento' => 'required'
        ];
        
        $messages = [
            'txtcupon.required' => 'El Cupón de Descuento es requerido',
            'txtporcentajes.numeric'=> 'El porcentaje de Descuento debe ser númerico',
            'txtporcentajes.min' => 'El porcentaje de Descuento debe tener como valor mínimo 1',
            'cboUsoDescuento.required' => 'El Uso del Descuento es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = DescuentoService::addArrayDataDescuento($request);

            if(Descuento::create($data)):
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
    public function show($descuento_id)
    {
        //
        $decrypt_id = Hashids::decode($descuento_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/descuentos');
        endif;

        $descuento = Descuento::find($decrypt_id[0]);
        return response()->json($descuento);
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
    public function update(Request $request, $descuento_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/descuentos');
        endif;

        $decrypt_id = Hashids::decode($descuento_id);
        $rules = [
            'txtcupon' => 'required',
            'txtporcentajes' => 'numeric|min:1',
            'cboUsoDescuento' => 'required'
        ];
        
        $messages = [
            'txtcupon.required' => 'El Cupón de Descuento es requerido',
            'txtporcentajes.numeric'=> 'El porcentaje de Descuento debe ser númerico',
            'txtporcentajes.min' => 'El porcentaje de Descuento debe tener como valor mínimo 1',
            'cboUsoDescuento.required' => 'El Uso del Descuento es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            
            $data = DescuentoService::updateArrayDataDescuento($request);

            $descuento = Descuento::find($decrypt_id[0]);

            if($descuento->update($data)):
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
    public function destroy(Request $request, $descuento_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/descuentos');
        endif;

        $decrypt_id = Hashids::decode($descuento_id);
        $descuento = Banner::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($descuento->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    
    public function desactivar(Request $request, $descuento_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/descuentos');
        endif;

        $decrypt_id = Hashids::decode($descuento_id);
        $descuento = Descuento::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($descuento->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $descuento_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/descuentos');
        endif;
        
        $decrypt_id = Hashids::decode($descuento_id);
        $descuento = Descuento::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($descuento->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }
}
