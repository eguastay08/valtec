<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use App\Models\Noticia_Tag;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class NoticiaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.noticias_etiquetas.index');
    }

    public function index(Request $request)
    {
        //
        $noticiatagbuscar = $request->get('noticia_tag');
        $estadonoticiaTag = $request->get('estado');

        $noticia_tags =  DB::table('noticia_tags');

        if (isset($noticiatagbuscar) && $noticiatagbuscar != '') {
            $noticia_tags ->where('noticia_tag','LIKE','%'.$noticiatagbuscar."%");
        }     

        if (isset($estadonoticiaTag) && $estadonoticiaTag!='_all_') {
            $noticia_tags->where('estado',$estadonoticiaTag );
        }

        $noticia_tags = $noticia_tags->where('oculto',0)->orderBy('noticia_tag','ASC')->paginate(10);

        if ($request->ajax()) {

            return view('admin.data.load_noticias_tag_data', compact('noticia_tags'));       
        }

        return view('admin.modules.noticias_tags', compact('noticia_tags'));
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
        if (!$request->ajax()):
            return redirect('/admin/noticia_tag');
        endif;
        // var_dump($request->all());
        $rules = [
            'noticia_tag'=>'required|max:40|unique:noticia_tags,noticia_tag'
        ];

        $messages = [
            'noticia_tag.required' => 'El campo Noticia Etiqueta es requerido',
            'noticia_tag.max' => 'El campo Noticia Etiqueta debe contener como máximo 40 carácteres',
            'noticia_tag.unique' => 'Ya existe esta Etiqueta para la Noticia'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $urlNoticiaTag = Str::slug($request->noticia_tag);
            $estadoNoticiaTag = $request->activo == "true" ? "1":"0";
            $oculto = 0;

            $noticia_tag = new Noticia_Tag;
            $noticia_tag->noticia_tag=e(trim($request->noticia_tag));
            $noticia_tag->url=$urlNoticiaTag;
            $noticia_tag->estado = $estadoNoticiaTag;
            $noticia_tag->oculto = $oculto;
            $noticia_tag->usuario_registra = $request->usuario;
            $noticia_tag->fecha_registro=now();
            if($noticia_tag->save()):
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
    public function show($noticia_tag_id)
    {
        //
        $decrypt_id = Hashids::decode($noticia_tag_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/noticia_tag');
        endif;
        $noticia_tag = DB::table('noticia_tags')->where('noticia_tag_id',$decrypt_id)->get();
        return response()->json(['noticia_tag' => $noticia_tag]);
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
    public function update(Request $request, $noticia_tag_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/noticia_tag');
        endif;

        $decrypt_id = Hashids::decode($request->noticia_tag_id);

        $rules = [
            'noticia_tag'=>'required|max:40|unique:noticia_tags,noticia_tag,'.$decrypt_id[0].',noticia_tag_id'
        ];

        $messages = [
            'noticia_tag.required' => 'El campo Etiqueta Noticia es requerido',
            'noticia_tag.max' => 'El campo Etiqueta Noticia debe contener como máximo 40 carácteres',
            'noticia_tag.unique' => 'Ya existe registrado esta Etiqueta para la Noticia'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            // $tagdecrypt = Hashids::decode($request->tag_id);
            $urlNoticiaTag = Str::slug($request->noticia_tag);
            $estadoNoticiaTag = $request->activo == "true" ? "1":"0";
            $oculto = 0;

            $noticia_tag = Noticia_Tag::find($decrypt_id[0]);
            $noticia_tag->noticia_tag=e(trim($request->noticia_tag));
            $noticia_tag->url=$urlNoticiaTag;
            $noticia_tag->estado = $estadoNoticiaTag;
            $noticia_tag->oculto = $oculto;
            $noticia_tag->usuario_modifica = $request->usuario;
            $noticia_tag->fecha_modifica=now();
            if($noticia_tag->save()):
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
    public function destroy($noticia_tag_id, Request $request)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/noticia_tag');
        endif;

        $decrypt_id = Hashids::decode($noticia_tag_id);
        $noticia_tag = Noticia_Tag::find($decrypt_id[0]);
        $oculto = 1;
        $noticia_tag->oculto = $oculto;
        $noticia_tag->usuario_modifica = $request->usuario;
        $noticia_tag->fecha_modifica=now();
        if($noticia_tag->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar($noticia_tag_id, Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticia_tag');
        endif;

        $decrypt_id = Hashids::decode($noticia_tag_id);
        $noticia_tag = Noticia_Tag::find($decrypt_id[0]);
        $activo = 1;
        $noticia_tag->estado = $activo;
        $noticia_tag->usuario_modifica = $request->usuario;
        $noticia_tag->fecha_modifica=now();
        if($noticia_tag->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar($noticia_tag_id, Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/noticia_tag');
        endif;
        
        $decrypt_id = Hashids::decode($noticia_tag_id);
        $noticia_tag = Noticia_Tag::find($decrypt_id[0]);
        $desactivar = 0;
        $noticia_tag->estado = $desactivar;
        $noticia_tag->usuario_modifica = $request->usuario;
        $noticia_tag->fecha_modifica=now();
        if($noticia_tag->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }
}
