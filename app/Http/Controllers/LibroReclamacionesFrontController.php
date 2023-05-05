<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\LibroReclamaciones;
use App\Models\Configuracion;

class LibroReclamacionesFrontController extends Controller
{
    //
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeLibro(Request $request)
    {
        // echo 'gaaa';
        $rules = [
            'tipo_docLR' => 'required',
            'nro_docLR' => 'required',
            'nom_apeLR' => 'required',
            'direccionLR' => 'required',
            'telefonoLR' =>'required',
            'correoLR' => 'required|email',
            'id_bien_LR' => 'required',
            'monto_reclamadoLR' => 'required',
            'tipoLR' => 'required',
            'detalle_clienteLR' => 'required',
            'g-recaptcha-response'=>'required'
        ];

        $messages = [
            'tipo_docLR.required'=> 'El Campo Tipo de Documento es requerido',
            'nro_docLR.required' => 'El Campo Número de Documento es requerido',
            'nom_apeLR.required' => 'El Campo Nombres y Apellidos es requerido',
            'direccionLR.required' => 'El Campo Dirección es requerido',
            'telefonoLR.required' => 'El Campo Teléfono es requerido',
            'correoLR.required' => 'El Campo Correo es requerido',
            'correoLR.email' => 'El Correo debe ser en un formato válido',
            'id_bien_LR.required' => 'El Campo Identificación del Bien Contratado es requerido',
            'monto_reclamadoLR.required' => 'El Campo Monto Reclamado es requerido',
            'tipoLR.required' => 'El Campo Tipo es requerido',
            'detalle_clienteLR.required' => 'El Campo Detalle del Cliente es requerido',
            'g-recaptcha-response.required' => 'El captcha es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $ip = $_SERVER['REMOTE_ADDR'];
               //validar el captcha
               $captcha = $_POST['g-recaptcha-response'];
               $secretKey = Configuracion::get_valorxvariable('go_secret_key');
               $responsecatpcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey->valor.'&response='.$captcha.'&remoteip='.$ip);
               $valiCaptcha = json_decode($responsecatpcha, TRUE);
   
               if(!$valiCaptcha['success']):
                   return response()->json(['errors'=>$validator->errors(), 'code' => '423']);
               else:
                    $data = [
                        "tipo_doc" =>$request->tipo_docLR,
                        "nro_documento"=>$request->nro_docLR,
                        "nombre_apellidos" => $request->nom_apeLR,
                        "direccion" => $request->direccionLR,
                        "telefono" => $request->telefonoLR,
                        "correo"=>$request->correoLR,
                        "id_bien_contratado" => $request->id_bien_LR,
                        "monto_reclamado"=>$request->monto_reclamadoLR,
                        "tipo"=>$request->tipoLR,
                        "detalle_cliente"=>$request->detalle_clienteLR,
                        "oculto" => 0,
                        // "ip"=>$ip,
                        "fecha_registro"=>now()
                    ];

                    if(LibroReclamaciones::create($data)):
                        return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/')]);
                    else:
                        return response()->json(['errors'=>$validator->errors(), 'code' => '424']);
                    endif;

               endif;
        endif;
    }
}
