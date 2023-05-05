<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;
use Validator,Hash;

use App\Models\User;
use App\Models\Configuracion;

class ConnectController extends Controller
{
    //  
    public function __construct()
    {
        $this->middleware('guest')->except('getLogout');
    }


    public function getLogin()
    {
        $captchakey = Configuracion::get_valorxvariable('go_site_key');

        return view('admin.login', compact('captchakey'));
    }
    
    public function postLogin(Request $request)
    {
        $rules = [
            'LoginUsuario' => 'required',
            'LoginPassword' => 'required|min:6',
            'g-recaptcha-response'=>'required'
        ];

        $messages = [
            'LoginUsuario.required' => 'El usuario es requerido',
            'LoginPassword.required' => 'La contraseña es requerida',
            'LoginPassword.min' => 'La contrseña debe tener mínimo 6 carácteres',
            'g-recaptcha-response.required' => 'El captcha es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error.')->with('typealert','danger');
        else:

            $credentials = (['usuario' =>$request->input('LoginUsuario'), 'password'=>$request->input('LoginPassword')]);
            
            // if(Auth::atempt(['usuario'=>$request->input('LoginUsuario'), 'password'=>$request->input('LoginPassword')], true)):

            //     return redirect('/admin');

            // else:

            //     return back()->with('message','Las credenciales son incorrectas.')->with('typealert','danger');

            // endif;

                
            if (auth()->attempt($credentials)):

                return redirect()->route('admin.dashboard');

            else:
                return back()->with('message','Las credenciales son incorrectas.')->with('typealert','danger');
            endif;

        endif;

    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('/admin/login');
    }

}
