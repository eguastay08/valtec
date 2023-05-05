<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB, Validator;
use Illuminate\Support\Facades\File;
use Vinkla\Hashids\Facades\Hashids;

use App\Models\Bloque;
use App\Models\Banner_Estilo;
use App\Models\Banner;

use App\Services\Admin\{
	BannerService,
	ImageService
};


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.banners.index');
    }
        
    public function index(Request $request)
    {
        //
        $estado = isset($request->estado) ? $request->estado : '_all_';

        $bloques = Bloque::getBloqueTipoxBanner();
        $bannerEstilos = Banner_Estilo::getBannerEstilo();
        $banners = Banner::getBanners($estado);

        if ($request->ajax()):
            return view('admin.data.load_banners_data', compact('bloques', 'bannerEstilos', 'banners'));
        endif;

        return view('admin.modules.banners', compact('bloques','bannerEstilos', 'banners'));
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
            return redirect('/admin/banners');
        endif;

        $rules = [
            'tamanioBanner' => 'required',
            'ubicacionBanner' => 'required',
            'estiloBanner' => 'required'
        ];
        
        $messages = [
            'tamanioBanner.required' => 'El Tamaño del Banner es requerido',
            'ubicacionBanner.required' => 'La Ubicación del Banner es requerido',
            'estiloBanner.required' => 'El Estilo del Banner es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $countBanner = Banner::countBanner($request->ubicacionBanner);

            if($countBanner>0):
                $valuePosicion = Banner::latestPositionBannerByStyle($request->ubicacionBanner);
                $posicion = intval($valuePosicion)+1;
            else:
                $posicion = 1;
            endif;

            $data = BannerService::addArrayDataBanner($request, $posicion);

            if(Banner::create($data)):
                if( $data['nombreBannerImg'] != '' ):
                    echo BannerService::moveBanner($data['nombreBannerImg']);
                endif;

                if( $data['nombreBannerSuperpuestoImg'] != '' ):
                    echo BannerService::moveBanner($data['nombreBannerSuperpuestoImg']);
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
    public function show($banner_id)
    {
        //
        $decrypt_id = Hashids::decode($banner_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/banners');
        endif;
        $banner = Banner::find($decrypt_id[0]);
        return response()->json($banner);
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
    public function update(Request $request, $banner_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;

        $decrypt_id = Hashids::decode($banner_id);
        $rules = [
            'tamanioBanner' => 'required',
            'ubicacionBanner' => 'required',
            'estiloBanner' => 'required'
        ];
        
        $messages = [
            'tamanioBanner.required' => 'El Tamaño del Banner es requerido',
            'ubicacionBanner.required' => 'La Ubicación del Banner es requerido',
            'estiloBanner.required' => 'El Estilo del Banner es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $databannerposicion = Banner::getBannerPosicionCount($request->posicionBanner);

            if($databannerposicion>0):

                if($request->posicionBanner != $request->hdd_posicionBanner_actual):
                    $banner = Banner::getBannerByPosition($request->posicionBanner);
                    Banner::where("banner_id", $banner->banner_id)->update(["posicion" => $request->hdd_posicionBanner_actual]);
                endif;

                $data = BannerService::updateArrayDataBanner($request,$decrypt_id[0]);

                $banner = Banner::find($decrypt_id[0]);

                if($banner->update($data)):
                    if( $data['temporal_banner'] != 0 && $data['nombreBannerImg'] != '' ):
                        if($data['bannerImgActual']!=""):
                            echo BannerService::existImageBanner($data['bannerImgActual']);
                        endif;
                        echo BannerService::moveBanner($data['nombreBannerImg']);
                    endif;
    
                    if( $data['temporal_banner_superpuesto'] != 0 && $data['nombreBannerSuperpuestoImg'] != '' ):
                        if($data['bannerSuperpuestoActual']!=""):
                            echo BannerService::existImageBanner($data['bannerSuperpuestoActual']);
                        endif;
                        echo BannerService::moveBanner($data['nombreBannerSuperpuestoImg']);
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
    public function destroy(Request $request, $banner_id)
    {
        //
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;

        $decrypt_id = Hashids::decode($banner_id);
        $banner = Banner::find($decrypt_id[0]);
        $data = [
            "oculto"=>1,
        ];
        if($banner->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function desactivar(Request $request, $banner_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;

        $decrypt_id = Hashids::decode($banner_id);
        $banner = Banner::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($banner->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $banner_id)
    {
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;

        $decrypt_id = Hashids::decode($banner_id);
        $banner = Banner::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($banner->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function subirImagenTmp(Request $request)
    {
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;

        $rules = [
            'imagen'=>'mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        $messages = [
                
                'imagen.size'=>'El Tamaño de la Imagen principal no debe ser mayor a 2MB',
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
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;

       $data = ImageService::eliminarImagenTmp($request);
       if($data):
            return response()->json(['code' => '200']);
       else:
            return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
       endif;     
    }

    public function eliminarimg(Request $request)
    {   
        if (!$request->ajax()):
            return redirect('/admin/banners');
        endif;
        
        $decrypt_id = Hashids::decode($request->image_id);
        $bannerimg = BannerService::eliminarBannerImg($decrypt_id[0], $request->filename, $request->superpuesto);
        return response()->json(['code' => '200']);
    }
}
