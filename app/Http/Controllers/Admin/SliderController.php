<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

use App\Models\Slider;


use App\Services\Admin\{
	SliderService,
	ImageService
};


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.sliders.index');
    }

    public function index(Request $request)
    {
        //
        $popup = isset($request->popup) ? $request->popup : '_all_';
        $estado = isset($request->estado) ? $request->estado : '_all_';

        $sliders = Slider::getSlider($popup,$estado);

        if ($request->ajax()):
            return view('admin.data.load_sliders_data', compact('sliders'));
        endif;

        return view('admin.modules.sliders', compact('sliders'));
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
            return redirect('/admin/sliders');
        endif;

        $rules = [
            'imgSlider' => 'required',
        ];
        
        $messages = [
            'imgSlider.required' => 'La imagen del Slider es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $arraySliderImg = explode("|*|", $request->imgSlider);
            $data = SliderService::addArraySliderData($request, $arraySliderImg);

            if(Slider::create($data)):
                echo SliderService::moveSlider($arraySliderImg[0]);
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
    public function show($slider_id)
    {
        //
        $decrypt_id = Hashids::decode($slider_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/sliders');
        endif;
        $slider = Slider::find($decrypt_id[0]);
        return response()->json($slider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $slider_id)
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
    public function update(Request $request, $slider_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $rules = [
            'imgSlider' => 'required',
        ];
        
        $messages = [
            'imgSlider.required' => 'La imagen del Slider es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $dataposicion = Slider::getSliderPositionCount($request->posicion);

            if($dataposicion>0):
                $arraySliderImgEdit = explode("|*|", $request->imgSlider);
                $data = SliderService::updateArraySliderData($request, $arraySliderImgEdit);

                $slider = Slider::find($decrypt_id[0]);

                if($slider->update($data)):
                    if($arraySliderImgEdit[2]=="1"):
                        if($request->sliderImgName!=""):
                            echo SliderService::existImageSlider($decrypt_id[0],$request->sliderImgName);
                        endif;
                        echo SliderService::moveSlider($arraySliderImgEdit[0]);
                    endif;
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
    public function destroy(Request $request, $slider_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $slider = Slider::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($slider->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $slider_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $slider = Slider::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($slider->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $slider_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $slider = Slider::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($slider->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function sliderPopup(Request $request, $slider_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;

        $decrypt_id = Hashids::decode($slider_id);
        $slider = Slider::find($decrypt_id[0]);
        $popup = $request->popup == 0 ? 1: 0;
        $data = [
            "popup"=>$popup,
        ];
        if($slider->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function subirImagenTmp(Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;

        $rules = [
            'imagen'=>'mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        $messages = [
                
                'imagen.max'=>'El Tamaño de la Imagen no debe ser mayor a 2MB',
                'imagen.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF, WEBP',
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
            return redirect('/admin/sliders');
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
        if(!$request->ajax()):
            return redirect('/admin/sliders');
        endif;
        
        $decrypt_id = Hashids::decode($request->image_id);
        // $url = public_path('admin/images/sliders/'.$request->filename);
        $url = public_path('assets/images/sliders/'.$request->filename);
        $image = ImageService::eliminarImg($url);
        Slider::where("slider_id", $decrypt_id[0])->update(["url" => "", "nombre_img" => "", "size_img" => ""]);
        return response()->json(['code' => '200']);
    }

}
