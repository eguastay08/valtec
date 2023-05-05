<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        '/webhooks',
        //rutas del menu 
        '/getMenus',
        //rutas del carrito
        '/load-car',
        '/add-cart',
        '/update-cart',
        '/remove-cart',
        '/clear',
        '/cupones',
        //realizar pago
        '/forms/pago',
        //guardar libro de reclamacion
        '/forms/libro_reclamaciones',
        //suscripcion
        '/suscripcion',
        //productos
        'productos/',
        //search produtos
        'productos/search',
    ];
}
