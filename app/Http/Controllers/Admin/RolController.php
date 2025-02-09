<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

//exportar modelo roles de spattie
use Spatie\Permission\Models\Role; 

//exportar modelo permisos de spattie
use Spatie\Permission\Models\Permission;

use App\Services\Admin\{
	RoleService
};

use App\Models\Configuracion;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()  
    {
        $this->middleware('check.auth.admin');
        $this->middleware('can:admin.roles.index');
    }

    public function index(Request $request)
    {
        //
        $rol = isset($request->rol) ? $request->rol : '';
        $estado = isset($request->estado) ? $request->estado : '_all_';

        $roles = RoleService::getRoles($rol, $estado);
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');

        if ($request->ajax()):
            return view('admin.data.load_roles_data', compact('roles'));
        endif;

        return view('admin.modules.roles', compact('roles','desarrollador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        
        $desarrollador = Configuracion::get_valorxvariable('desarrollador');
        
        return view('admin.modules.crud-roles', compact('permissions', 'desarrollador'));
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
        if(!$request->ajax()):
            return redirect('/admin/roles');
        endif;

        $rules = [
            'nombreRol' => 'required|unique:roles,name',
            'chkpermisos' => 'required',
        ];
        
        $messages = [
            'nombreRol.required' => 'El campo Nombre del Rol es requerido',
            'nombreRol.unique' => 'Ya existe el Rol',
            'chkpermisos.required' => 'Los Permisos son necesarios'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            
            $data = RoleService::addArrayRole($request);
            if($role = Role::create($data))
            {
                $role->permissions()->sync($request->chkpermisos);

                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/roles')]);
            }

        endif;
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
        $decrypt_id = Hashids::decode($id);

        $dataR = Role::where('id', $decrypt_id)->where('oculto',0)->first();

        if($dataR == NULL):
            return redirect('/admin/roles');
        endif;

        $rol = Role::find($decrypt_id)->first();

        $permissions = Permission::all();

        // $permissions_rol = Permission::where('producto_id', $decrypt_id)
        // ->where('oculto',0)->pluck('tag_id')->toArray();

        $permissions_rol = RoleService::getPermisosByrol($decrypt_id);

        $desarrollador = Configuracion::get_valorxvariable('desarrollador');
        
        return view('admin.modules.crud-roles', compact('permissions', 'rol', 'permissions_rol', 'desarrollador'));
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
        if(!$request->ajax()):
            return redirect('/admin/roles');
        endif;


        $rules = [
            'nombreRol' => 'required|unique:roles,name,'.$id.',id',
            'chkpermisos' => 'required',
        ];
        
        $messages = [
            'nombreRol.required' => 'El campo Nombre del Rol es requerido',
            'nombreRol.unique' => 'Ya existe el Rol',
            'chkpermisos.required' => 'Los Permisos son necesarios'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data = RoleService::addArrayRole($request);

            echo RoleService::DeletePermissionsByRol($id);

            $role = Role::find($id);

            if($role->update($data)):

                $role->permissions()->sync($request->chkpermisos);
                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/roles')]);
            
            endif;
        
        endif;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!$request->ajax()):
            return redirect('/admin/roles');
        endif;

        $decrypt_id = Hashids::decode($id);

        echo RoleService::DeletePermissionsByRol($decrypt_id);

        $role = Role::find($decrypt_id);

        $role_Eliminar = RoleService::deleteRol($decrypt_id);

        return response()->json(['msg'=>'sucess', 'code' => '200']);

        // if($role->delete()):
        //     return response()->json(['msg'=>'sucess', 'code' => '200']);
        // endif;
    }


    public function desactivar(Request $request, $id)
    {
        if(!$request->ajax()):
            return redirect('/admin/roles');
        endif;

        $decrypt_id = Hashids::decode($id);
        $role = Role::find($decrypt_id[0]);
        $data = [
            "estado"=>0,
        ];
        if($role->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }

    public function activar(Request $request, $id)
    {
        if(!$request->ajax()):
            return redirect('/admin/roles');
        endif;

        $decrypt_id = Hashids::decode($id);
        $role = Role::find($decrypt_id[0]);
        $data = [
            "estado"=>1,
        ];
        if($role->update($data)):
            return response()->json(['msg'=>'sucess', 'code' => '200']);
        endif; 
    }
}
