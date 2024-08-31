<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;
use Validator,Hash;

use App\Models\User;
use App\Models\Configuracion;

class ClientConnectController extends Controller
{
    //  
    public function __construct()
    {
        $this->middleware('guest')->except('getLogout');
    }


    public function getLogin()
    {
        $captchakey = Configuracion::get_valorxvariable('go_site_key');

        return view('client.login', compact('captchakey'));
    }

    public function getRegister()
    {
        $captchakey = Configuracion::get_valorxvariable('go_site_key');

        return view('client.register', compact('captchakey'));
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

            $credentials = ([
                'usuario' =>$request->input('LoginUsuario'), 
                'password'=>$request->input('LoginPassword'),
            ]);                
            if (auth()->attempt($credentials)):

                return redirect()->route('/');

            else:
                return back()->with('message','Las credenciales son incorrectas.')->with('typealert','danger');
            endif;

        endif;

    }

    public function postRegister(Request $request)
{
    // Definir las reglas de validación
    $rules = [
        'RegisterNombres' => 'required|string|max:255',
        'RegisterApellidos' => 'required|string|max:255',
        'RegisterEmail' => 'required|email|unique:users,email|max:255',
        'RegisterDireccion' => 'required|string|max:255',
        'RegisterTelefono' => 'required|string|max:20',
        'password' => 'required|string|min:6|confirmed',
    ];

    // Definir los mensajes de error personalizados
    $messages = [
        'RegisterNombres.required' => 'Los nombres son requeridos',
        'RegisterApellidos.required' => 'Los apellidos son requeridos',
        'RegisterEmail.required' => 'El correo electrónico es requerido',
        'RegisterEmail.email' => 'Debe ingresar un correo electrónico válido',
        'RegisterEmail.unique' => 'El correo electrónico ya está registrado',
        'RegisterDireccion.required' => 'La dirección es requerida',
        'RegisterTelefono.required' => 'El teléfono es requerido',
        'password.required' => 'La contraseña es requerida',
        'password.min' => 'La contraseña debe tener mínimo 6 caracteres',
        'password.confirmed' => 'Las contraseñas no coinciden',
    ];

    // Ejecutar la validación
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        // Si la validación falla, redirigir de vuelta con errores
        return back()->withErrors($validator)
                     ->with('message', 'Se ha producido un error.')
                     ->with('typealert', 'danger');
    } else {
        // Si la validación es exitosa, crear un nuevo usuario
        $user = new User();
        $user->nombres = $request->input('RegisterNombres');
        $user->apellidos = $request->input('RegisterApellidos');
        $user->email = $request->input('RegisterEmail');
        $user->direccion = $request->input('RegisterDireccion');
        $user->telefono = $request->input('RegisterTelefono');
        $user->password = bcrypt($request->input('password'));
        $user->usuario = $request->input('RegisterEmail');
        $user->estado =0;


        if ($user->save()) {
            // Si el usuario se guarda correctamente, redirigir al inicio de sesión
            $user->roles()->sync(100);
            $user->sendEmailVerificationNotification();

            // Redirigir al usuario a la página de login con un mensaje de éxito
            return redirect()->route('client.login')
                             ->with('message', 'Su cuenta ha sido creada exitosamente. Revise su correo para verificar su cuenta.')
                             ->with('typealert', 'success');
        } else {
            // Si ocurre un error al guardar, redirigir de vuelta con un mensaje de error
            return back()->with('message', 'Hubo un problema al crear su cuenta.')
                         ->with('typealert', 'danger');
        }
    }
}


    public function getLogout()
    {
        Auth::logout();

        return redirect('/');
    }

}
