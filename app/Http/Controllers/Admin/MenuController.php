<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Menu;

use App\Services\Admin\{
	MenuService,
    ImageService
};

use App\Models\Configuracion;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.menu.index');
    }

    public function index(Request $request)
    {
        //
        $menupadres = Menu::getPadresMenu();

        $menus = Menu::getMenus();
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_menus_data', compact('menus', 'menupadres'));
        endif;

        return view('admin.modules.menus', compact('menus','menupadres', 'desarrollador'));
    }

    public function listarMenuPadres(Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $menupadres = Menu::getPadresMenu();
        
        if($request->ajax()):
            return view('admin.partials.select-menus-padres', compact('menupadres'));
        endif;
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
            return redirect('/admin/menus');
        endif;


        $rules = [
            'txtNombreMenu' => 'required',
        ];
        
        $messages = [
            'txtNombreMenu.required' => 'El Nombre del Menu es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = MenuService::addArrayDataMenu($request);

            if(Menu::create($data)):
                if(isset($data['nombre_icono'])):
                    if( $data['nombre_icono'] != '' ):
                        echo MenuService::moveImage($data['nombre_icono']);
                    endif;
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
    public function show($menu_id)
    {
        //
        $decrypt_id = Hashids::decode($menu_id);
        if(count($decrypt_id) == 0):
            return redirect('/admin/menus');
        endif;

        $menu = Menu::find($decrypt_id[0]);
        return response()->json($menu);
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
    public function update(Request $request, $menu_id)
    {        
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($menu_id);

        $rules = [
            'txtNombreMenu' => 'required',
        ];
        
        $messages = [
            'txtNombreMenu.required' => 'El Nombre del Menu es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            
            $data = MenuService::updateArrayDataMenu($request);

            $menu = Menu::find($decrypt_id[0]);

            if($menu->update($data)):
                if($data['temporal'] != 0):
                    echo MenuService::moveImage($data['nombre_icono']);
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
    public function destroy(Request $request, $menu_id)
    {
        //
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($menu_id);
        $menu = Menu::find($decrypt_id[0]);
        $data = [
            "oculto"=>1
        ];
        if($menu->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;  
    }

    public function decryptMenu(Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($request->padre);
        return $decrypt_id[0];
    }

    public function desactivar(Request $request, $menu_id)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($menu_id);
        $menu = Menu::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($menu->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function activar(Request $request, $menu_id)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($menu_id);
        $menu = Menu::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($menu->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function down($menu_id,Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($menu_id);
        $posicionactual = $request->posicion;
        $posicion = intval($posicionactual)+1;
        $menuposicion = Menu::getMenuByPosition($posicion, $request->padre);
        if($menuposicion):
            Menu::where("menu_id", $menuposicion->menu_id)->update(["posicion" =>$posicionactual]);
        endif;
        $menu = Menu::find($decrypt_id[0]);
        $data = [
            "posicion"=>$posicion,
        ];
        if($menu->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    

    }

    public function up($menu_id,Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($menu_id);
        $posicionactual = $request->posicion;
        $posicion = intval($posicionactual)-1;
        $menuposicion = Menu::getMenuByPosition($posicion, $request->padre);
        if($menuposicion):
            Menu::where("menu_id", $menuposicion->menu_id)->update(["posicion" =>$posicionactual]);
        endif;
        $menu = Menu::find($decrypt_id[0]);
        $data = [
            "posicion"=>$posicion,
        ];
        if($menu->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif;    
    }

    public function subirImagenTmp(Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/menus');
        endif;

        $rules = [
            'imagen'=>'mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
                
                'imagen.size'=>'El Tamaño de la Imagen principal no debe ser mayor a 2MB',
                'imagen.mimes'=>'La extensión de la Imagen principal debe ser JPEG, PNG, JPG, GIF',
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
            return redirect('/admin/menus');
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
            return redirect('/admin/menus');
        endif;

        $decrypt_id = Hashids::decode($request->image_id);
        $url = public_path('assets/images/menu_iconos/'.$request->filename);
        $image = ImageService::eliminarImg($url);
        Bloque::where("bloque_id", $decrypt_id[0])->update(["icono" => "", "nombre_icono" => "", "size_icono" => ""]);
        return response()->json(['code' => '200']);
    }



}
