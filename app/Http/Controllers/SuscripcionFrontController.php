<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Suscripcion;
use Vinkla\Hashids\Facades\Hashids;

class SuscripcionFrontController extends Controller
{
    //
    public function sendSuscripcion(Request $request)
    {
        $rules = [
            'email_suscripcion' => 'required|email',
        ];

        $messages = [
            'email_suscripcion.required' => 'El Campo Email es requerido',
            'email_suscripcion.email' => 'El Email debe ser en un formato válido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:

            $data =[
                "email" => $request->email_suscripcion,
                "oculto"=> 0
            ];

            if(Suscripcion::create($data)):
                return response()->json(['msg'=>'sucess', 'code' => '200']);
            else:
                return response()->json(['msg'=>'error', 'code' => '201']);
            endif;

          
        endif;

    }
}
