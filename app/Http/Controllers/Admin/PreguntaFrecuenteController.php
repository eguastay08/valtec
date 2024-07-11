<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Pregunta_Frecuente;
use App\Services\Admin\Pregunta_FrecuenteService;
use App\Models\Configuracion;

class PreguntaFrecuenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.preguntas.index');
    }

    public function index(Request $request)
    {
        //
        $estado = isset($request->estado) ? $request->estado : '_all_';

        $preguntas_frecuentes = Pregunta_Frecuente::getPreguntasFrecuentes($estado);
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_preguntas_frecuentes_data', compact('preguntas_frecuentes'));
        endif;

        return view('admin.modules.preguntas_frecuentes', compact('preguntas_frecuentes','desarrollador'));
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
            return redirect('/admin/preguntas_frecuentes');
        endif;

        $rules = [
            'pregunta' => 'required',
        ];
        
        $messages = [
            'pregunta.required' => 'El campo Pregunta es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $countPreguntaFrecuente = Pregunta_Frecuente::countPregunta();

            if($countPreguntaFrecuente>0):
                $valuePosicion = Pregunta_Frecuente::latestPositionPregunta();
                $posicion = intval($valuePosicion)+1;
            else:
                $posicion = 1;
            endif; 
            
            $data = Pregunta_FrecuenteService::addArrayDataPreguntaFrecuente($request, $posicion);

            if(Pregunta_Frecuente::create($data)):
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
    public function show($pregunta_frecuente_id)
    {
        //
        $decrypt_id = Hashids::decode($pregunta_frecuente_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/preguntas_frecuentes');
        endif;
        $pregunta_frecuente = Pregunta_Frecuente::find($decrypt_id[0]);
        return response()->json($pregunta_frecuente);
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
    public function update(Request $request, $pregunta_frecuente_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/preguntas_frecuentes');
        endif;

        $decrypt_id = Hashids::decode($pregunta_frecuente_id);
        $rules = [
            'pregunta' => 'required',
        ];
        
        $messages = [
            'pregunta.required' => 'El campo Pregunta es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $dataPreguntaPosicion = Pregunta_Frecuente::getCountByPregunta($request->posicion);

            if($dataPreguntaPosicion>0):

                if($request->posicion != $request->posicion_actual):
                    $pregunta = Pregunta_Frecuente::getPreguntaByPosition($request->posicion);
                    Pregunta_Frecuente::where("pregunta_frecuente_id", $pregunta->pregunta_frecuente_id)->update(["posicion" => $request->posicion_actual]);
                endif;

                $data = Pregunta_FrecuenteService::updateArrayDataPreguntaFrecuente($request);

                $pregunta_frecuente = Pregunta_Frecuente::find($decrypt_id[0]);

                if($pregunta_frecuente->update($data)):
                    return response()->json(['msg'=>'sucess', 'code' => '200']);
                else:
                    return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
                endif;

            else:
                return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
            endif;

        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $pregunta_frecuente_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/preguntas_frecuentes');
        endif;

        $decrypt_id = Hashids::decode($pregunta_frecuente_id);
        $pregunta = Pregunta_Frecuente::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($pregunta->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $pregunta_frecuente_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/preguntas_frecuentes');
        endif;

        $decrypt_id = Hashids::decode($pregunta_frecuente_id);
        $pregunta = Pregunta_Frecuente::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($pregunta->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $pregunta_frecuente_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/preguntas_frecuentes');
        endif;
        
        $decrypt_id = Hashids::decode($pregunta_frecuente_id);
        $pregunta = Pregunta_Frecuente::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($pregunta->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

}
