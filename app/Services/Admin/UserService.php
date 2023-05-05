<?php
namespace App\Services\Admin;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Admin\ImageService;
use DB, Validator,Hash;

class UserService
{

    public function addArrayUsuario($request)
    {
        $estado = $request->chkEstadoUsuario == "on" ? "1":"0";
        $oculto =0;

        $arrayUsuario = array();
        
        $data = [
            "nombres" =>trim($request->nombreUsuario),
            "apellidos" =>trim($request->apellidoUsuario),
            "usuario"=>trim($request->txtUsuario),
            "email"=>trim($request->emailUsuario),
            "direccion"=>trim($request->direccionUsuario),
            "telefono"=>trim($request->telefonoUsuario),
        ];

        if(isset($request->fotousuario) && $request->fotousuario!= ""):
            $arrayFotoUsuario = explode("|*|", $request->fotousuario);
            $url = "admin_assets/images/usuarios/".$arrayFotoUsuario[0];

            $data["foto"] = $url;
            $data["foto_name"] = $arrayFotoUsuario[0];
            $data["foto_size"] = $arrayFotoUsuario[1];
        endif;

        $data["password"] = Hash::make(trim($request->input('contraseniaUsuario')));
        $data["estado"] = $estado;
        $data["oculto"] = $oculto;
        $data['usuario_registro'] = '46749322';
        $data['fecha_registro'] = now();
        $data['remember_token'] = Str::random(10);
        return $data;

    }

    public function updateArrayUsuario($request, $password)
    {
        $estado = $request->chkEstadoUsuario == "on" ? "1":"0";
        $oculto =0;
        $temporalFotoUsuario = 0;

        $arrayUsuario = array();         
        $data = [
            "nombres" =>trim($request->nombreUsuario),
            "apellidos" =>trim($request->apellidoUsuario),
            "usuario"=>trim($request->txtUsuario),
            "email"=>trim($request->emailUsuario),
            "direccion"=>trim($request->direccionUsuario),
            "telefono"=>trim($request->telefonoUsuario),
        ];

        if(isset($request->fotousuario) && $request->fotousuario!= ""):
            $arrayFotoUsuario = explode("|*|", $request->fotousuario);
            $url = "admin_assets/images/usuarios/".$arrayFotoUsuario[0];

            $data["foto"] = $url;
            $data["foto_name"] = $arrayFotoUsuario[0];
            $data["foto_size"] = $arrayFotoUsuario[1];
            $temporalFotoUsuario = $arrayFotoUsuario[2];
        endif;

        $data['fotoactual'] = $request->fotoActualUsuario;
        $data["temporalfoto"] = $temporalFotoUsuario;
        $data["password"] = $password;
        $data["estado"] = $estado;
        $data["oculto"] = $oculto;
        $data['usuario_modifica'] = '46749322';
        $data['fecha_modifica'] = now();

        return $data;
    
    }
    
    public function moveFoto($filename)
    {
        $destino =  public_path('admin_assets/images/usuarios/');
        echo ImageService::moveimage($filename ,$destino);
    }

    public function exitsFotoUsuario($filename)
    {
        $url = public_path($filename);
        echo ImageService::eliminarImg($url);
    }

    public function eliminarFotoUsuario($user_id, $filename)
    {
        $url = public_path('admin_assets/images/usuarios/'.$filename);
        $image = ImageService::eliminarImg($url);
        User::where("user_id", $user_id)->update(["foto" => "", "foto_name" => "", "foto_size" => ""]);
    }
    
    public function getRolxUser($user_id)
    {
        $data = DB::table('model_has_roles')->where('model_id', $user_id)->pluck('role_id')->toArray();

        return $data;
    }

    public function CountRolesByUser($id)
    {
        $count = DB::table('model_has_roles')->where('model_id', $id)->count();

        return $count;
    }

    public function DeleteRolesByUser($id)
    {
        $deleted = DB::table('model_has_roles')->where('model_id', $id)->delete();
    }

}