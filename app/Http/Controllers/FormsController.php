<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\Configuracion;
use App\Mail\ContactoMailable;

class FormsController extends Controller
{
    //
    public function ContactoForm(Request $request)
    {

        $rules = [
            'namecontacto' => 'required',
            'emailcontacto' => 'required|email',
            'asuntoContacto' => 'required',
            'mensaje' => 'required',
            'g-recaptcha-response'=>'required'
        ];

        $messages = [
            'namecontacto.required' => 'El Campo Nombres y Apellidos es requerido',
            'emailcontacto.required' => 'El Campo Email es requerido',
            'emailcontacto.email' => 'El Email debe ser en un formato válido',
            'asuntoContacto.required'=> 'El Campo Asunto es requerido',
            'mensaje.required' => 'El Campo Mensaje es requerido',
            'g-recaptcha-response.required' => 'El captcha es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors(), 'code' => '422']);
        else:
            $ip = $_SERVER['REMOTE_ADDR'];
            $captcha = $_POST['g-recaptcha-response'];
            $secretKey = Configuracion::get_valorxvariable('go_secret_key');
            $responsecatpcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey->valor.'&response='.$captcha.'&remoteip='.$ip);
            $valiCaptcha = json_decode($responsecatpcha, TRUE);

            if(!$valiCaptcha['success']):
                return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
            else:
                 //  Send mail to admin
                 $subject = "VALTECGDA - Contacto";

                 $datacontacto = [
                    'name' => $request->namecontacto,
                    'email' =>$request->emailcontacto,
                    'subject' => $request->asuntoContacto,
                    'message' => $request->mensaje,
                ];
        
                 $contacto = new ContactoMailable($datacontacto, $subject);
                 Mail::to('admin@LolStore.com')->send($contacto);

                // \Mail::send('confirmacion-mail', array(
                //     'name' => $request->namecontacto,
                //     'email' =>$request->emailcontacto,
                //     'subject' => $request->asuntoContacto,
                //     'message' => $request->mensaje,
                // ), function($message) use ($request){
                //     $message->from($request->email);
                //     $message->to('mtavila07@gmail.com', 'Admin')->subject($request->get('subject'));
                // });

                return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/confirmacion_correo?type=c')]);

                // return redirect()->back()->with(['success' => 'Contact Form Submit Successfully']);
            
            endif;
        
        endif;

    }
}
