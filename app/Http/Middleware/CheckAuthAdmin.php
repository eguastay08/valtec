<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                // Verifica si el usuario está autenticado
                if (Auth::check()) {
                    return $next($request);
                }
        
                // Redirige a la página de inicio de sesión si el usuario no está autenticado
                return redirect('/admin/login');
    }
}
