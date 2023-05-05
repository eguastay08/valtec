<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibroReclamaciones;
use Vinkla\Hashids\Facades\Hashids;

class LibroReclamacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('auth');
    //  $this->middleware('can:admin.categorias.show');
    }

    public function index(Request $request)
    {
        //
        $libro_reclamaciones = LibroReclamaciones::where('oculto',0)->orderBy('libro_reclamacion_id','ASC')->paginate(20);

        if ($request->ajax()):
            return view('admin.data.load_libro_reclamaciones_data', compact('libro_reclamaciones'));
        endif;
        
        return view('admin.modules.libro_reclamaciones',compact('libro_reclamaciones'));
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
        //}
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
        $decrypt_id = Hashids::decode($id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/libro_reclamaciones');
        endif;
        $libro_reclamacion = LibroReclamaciones::find($decrypt_id[0]);
        return response()->json($libro_reclamacion);
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
            return redirect('/admin/libro_reclamaciones');
        endif;

        $decrypt_id = Hashids::decode($id);
        $libro_reclamacion = LibroReclamaciones::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($libro_reclamacion->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }
}
