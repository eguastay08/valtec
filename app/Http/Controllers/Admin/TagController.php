<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use App\Models\Tag;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use PDF;

use App\Exports\TagExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Configuracion;

use App\Services\Admin\{
    ImageService,
    TagService
};

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.tags.index');
    }

    public function index(Request $request)
    {
        //
        $tagbuscar = $request->get('tag');
        $estadoTag = $request->get('estado');

        $tags =  DB::table('tags');

        if (isset($tagbuscar) && $tagbuscar != '') {
            $tags ->where('tag','LIKE','%'.$tagbuscar."%");
        }     

        if (isset($estadoTag) && $estadoTag!='_all_') {
            $tags->where('estado',$estadoTag );
        }

        $tags = $tags->where('oculto',0)->orderBy('tag','ASC')->paginate(5);
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()) {

            return view('admin.data.load_etiquetas_data', compact('tags'));
        
        }

        return view('admin.modules.tags', compact('tags','desarrollador'));
        
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
            return redirect('/admin/tags');
        endif;

        $rules = [
            'tag'=>'required|max:40|unique:tags,tag'
        ];

        $messages = [
            'tag.required' => 'El campo Etiqueta es requerido',
            'tag.max' => 'El campo Etiqueta debe contener como máximo 40 carácteres',
            'tag.unique' => 'Ya existe esta Etiqueta'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $urltag = Str::slug($request->tag);
            $estado = $request->estado == "true" ? "1":"0";
            $oculto =0;

            $tag = new Tag;
            $tag->tag=e(trim($request->tag));
            $tag->url=$urltag;
            $tag->estado = $estado;
            $tag->oculto = $oculto;
            $tag->usuario_registra = $request->usuario;
            $tag->fecha_registro=now();

            if($request->imgEtiqueta!=""):
                $arrayimgTag = explode("|*|", $request->imgEtiqueta);
                $urlimagen = "assets/images/tags/".$arrayimgTag[0];
                $tag->nombre_img = $arrayimgTag[0];
                $tag->size_img = $arrayimgTag[1];
                $tag->img = $urlimagen;
            endif;

            if($tag->save()):
                if($request->imgEtiqueta!=""):
                    echo TagService::moveImgEtiqueta($arrayimg[0]);
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
    public function show($etiqueta_id)
    {
        //
        $decrypt_id = Hashids::decode($etiqueta_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/tags');
        endif;
        $tag = DB::table('tags')->where('tag_id',$decrypt_id)->get();
        return response()->json(['tag' => $tag]);
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
    public function update(Request $request, $etiqueta_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;

        $decrypt_id = Hashids::decode($request->tag_id);

        $rules = [
            'tag'=>'required|max:40|unique:tags,tag,'.$decrypt_id[0].',tag_id'
        ];

        $messages = [
            'tag.required' => 'El campo Etiqueta es requerido',
            'tag.max' => 'El campo Etiqueta debe contener como máximo 40 carácteres',
            'tag.unique' => 'Ya existe registrado esta Etiqueta'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            // $tagdecrypt = Hashids::decode($request->tag_id);
            $slugtag = Str::slug($request->tag);
            $estado = $request->estado == "true" ? "1":"0";
            $oculto =0;

            $tag = Tag::find($decrypt_id[0]);
            $tag->tag=e(trim($request->tag));
            $tag->url=$slugtag;
            $tag->estado =$estado;
            $tag->oculto =$oculto;
            $tag->usuario_modifica = '46749322';
            $tag->fecha_modifica=now();

            if($request->imgEtiqueta!=""):
                $arrayimgTag = explode("|*|", $request->imgEtiqueta);
                $urlimagen = "assets/images/tags/".$arrayimgTag[0];
                $tag->nombre_img = $arrayimgTag[0];
                $tag->size_img = $arrayimgTag[1];
                $tag->img = $urlimagen;
            endif;

            if($tag->save()):

                if($request->imgEtiqueta != ""):
                    $arrayimge = explode("|*|", $request->imgEtiqueta);
                    if($arrayimge[2]=="1"):
                        if($request->imgEtiquetaActual!=""):
                            echo TagService::existImageEtiqueta($request->imgCategoriaActual);
                        endif;
                        echo TagService::moveImgEtiqueta($arrayimge[0]);
                    endif;
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
    public function destroy(Request $request, $etiqueta_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;

        $decrypt_id = Hashids::decode($etiqueta_id);
        $tag = Tag::find($decrypt_id[0]);
        $oculto = 1;
        $tag->oculto = $oculto;
        $tag->usuario_modifica = '46749322';
        $tag->fecha_modifica=now();
        if($tag->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $etiqueta_id)
    {
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;
        
        $decrypt_id = Hashids::decode($etiqueta_id);
        $tag = Tag::find($decrypt_id[0]);
        $activo = 1;
        $tag->estado = $activo;
        $tag->usuario_modifica = '46749322';
        $tag->fecha_modifica=now();
        if($tag->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $etiqueta_id)
    {
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;

        $decrypt_id = Hashids::decode($etiqueta_id);
        $tag = Tag::find($decrypt_id[0]);
        $desactivar = 0;
        $tag->estado = $desactivar;
        $tag->usuario_modifica = '46749322';
        $tag->fecha_modifica=now();
        if($tag->save()):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    
    public function subirImagenTmp(Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;


        $rules = [
                'imagen'=>'mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        $messages = [
                
                'imagen.max'=>'El Tamaño de la Imagen no debe ser mayor a 2MB',
                'imagen.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF, .WEBP',
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
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;

        $data = ImageService::eliminarImagenTmp($request);
        if($data):
                return response()->json(['code' => '200']);
        else:
                return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
        endif;     
    }

    
    public function eliminarImagen(Request $request)
    {   
        if(!$request->ajax()):
            return redirect('/admin/tags');
        endif;
        
        $decrypt_id = Hashids::decode($request->image_id);
        // $url = public_path('admin/images/sliders/'.$request->filename);
        $url = public_path('assets/images/tags/'.$request->filename);
        $image = ImageService::eliminarImg($url);
        Tag::where("tag_id", $decrypt_id[0])->update(["img" => "", "nombre_img" => "", "size_img" => ""]);
        return response()->json(['code' => '200']);
    }

    public function generarPdf(Request $request)
    {
        $tags = Tag::where('oculto',0)->orderBy('tag','ASC')->get();

        // $data = [
        //     'title' => 'Listado de Etiquetas',
        //     'date' => date('m/d/Y'),
        //     'tags' => $tags
        // ];
          
        $pdf = PDF::loadView('admin/pdf/tags_pdf', array('tags' =>  $tags))
        ->setPaper('a4', 'portrait');
    
        return $pdf->download('reporte_etiquetas.pdf');
 
    }

    public function generarExcel()
    {
        return Excel::download(new TagExport, 'Reporte_Etiquetas.xlsx');
    }
}
