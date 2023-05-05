<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Vinkla\Hashids\Facades\Hashids;

use App\Models\Moneda;

use App\Services\Admin\{
    MonedaService,
	ImageService
};

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.moneda.index');
    }

    public function index(Request $request)
    {
        //
        $monedas = Moneda::getMonedas();

        if($request->ajax()):
            return view('admin.data.load_monedas_data', compact('monedas'));
        endif;

        return view('admin.modules.monedas', compact('monedas'));
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
            return redirect('/admin/monedas');
        endif;

        $rules = [
            'nombre' => 'required',
            'codigo' => 'required|max:10',
            'tipo_cambio' => 'required|numeric',
        ];
        
        $messages = [
            'nombre.required' => 'El Nombre de la Moneda es requerido',
            'codigo.required' => 'El Código de la Moneda es requerido',
            'codigo.max' => 'El código de la moneda debe contener como máximo 10 carácteres',
            'tipo_cambio.required'=>'El tipo de Cambio de la moneda es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = MonedaService::addArrayDataMoneda($request);

            if(Moneda::create($data)):
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
    public function show($moneda_id)
    {
        //
        $decrypt_id = Hashids::decode($moneda_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/monedas');
        endif;
        $moneda = Moneda::find($decrypt_id[0]);
        return response()->json($moneda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/admin/404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $moneda_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/monedas');
        endif;

        $decrypt_id = Hashids::decode($moneda_id);

        $rules = [
            'nombre' => 'required',
            'codigo' => 'required|max:10',
            'tipo_cambio' => 'required|numeric',
        ];
        
        $messages = [
            'nombre.required' => 'El Nombre de la Moneda es requerido',
            'codigo.required' => 'El Código de la Moneda es requerido',
            'codigo.max' => 'El código de la moneda debe contener como máximo 10 carácteres',
            'tipo_cambio.required'=>'El tipo de Cambio de la moneda es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = MonedaService::updateArrayDataMoneda($request);

            $moneda = Moneda::find($decrypt_id[0]);

            if($moneda->update($data)):
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
    public function destroy(Request $request, $moneda_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/monedas');
        endif;

        $decrypt_id = Hashids::decode($moneda_id);
        $moneda = Moneda::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($moneda->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $moneda_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/monedas');
        endif;

        $decrypt_id = Hashids::decode($moneda_id);
        echo MonedaService::desactiveMonedas();
        $moneda = Moneda::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($moneda->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $moneda_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/monedas');
        endif;
        
        $decrypt_id = Hashids::decode($moneda_id);
        $moneda = Moneda::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($moneda->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

}
