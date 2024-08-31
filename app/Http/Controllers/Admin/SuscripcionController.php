<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suscripcion;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Configuracion;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()  
     {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.suscripciones.index');
     }

    public function index(Request $request)
    {
        //
        $categoriabuscar = $request->get('categoria');
        $estadocategoria = $request->get('estado');

        $suscripciones = Suscripcion::where('oculto',0)->orderBy('email','ASC')->paginate(20);
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_suscritos_data', compact('suscripciones'));
        endif;
        
        return view('admin.modules.suscripciones',compact('suscripciones','desarrollador'));
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
        return redirect('/admin/404');
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
    public function destroy(Request $request, $id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/suscripciones');
        endif;
        $decrypt_id = Hashids::decode($id);
        $suscripcion = Suscripcion::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($suscripcion->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }
}
