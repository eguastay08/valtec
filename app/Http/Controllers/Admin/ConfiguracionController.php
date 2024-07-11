<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.configuracion.index');
    }


    public function index()
    {
        //
        $configuraciones = Configuracion::get_Configuraciones();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        return view('admin.modules.configuraciones', compact('configuraciones', 'desarrollador'));
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
        // $i = 0;
        $configuracion_id = $request->configuracion_id;
        $valor = $request->valor;

        foreach($configuracion_id as $key=>$c):
              if(isset($configuracion_id[$key])):
                $configuracion = Configuracion::find($c);
                $data = [
                    "valor" => $valor[$key],
                    "usuario_modifica" => $request->usuario,
                    "fecha_modifica" => now()
                ];
                
                $configuracion->update($data);
              endif;
        endforeach;

        return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/configuraciones')]);

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
    public function update(Request $request, $id)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return redirect('/admin/404');
    }
}
