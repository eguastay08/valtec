<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            // El usuario no está autenticado
            return redirect('/login');
        }

        $user = Auth::user();

        // Obtener el ID del rol basado en el nombre del rol
        $roleId = DB::table('roles')->where('name', $roleName)->value('id');

        if (!$roleId) {
            // Si el rol no existe, puedes manejar el error aquí (opcional)
            return redirect('/unauthorized');
        }

        // Verificar si el usuario tiene ese rol
        $hasRole = DB::table('model_has_roles')
                     ->where('role_id', $roleId)
                     ->where('model_id', $user->id)
                     ->where('model_type', get_class($user)) // Asumiendo que es el modelo User
                     ->exists();

        if (!$hasRole) {
            // El usuario no tiene el rol requerido
            return redirect('/unauthorized');
        }

        // Si el usuario tiene el rol, continuar con la solicitud
        return $next($request);
    }
}
