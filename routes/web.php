<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);


Route::get('/', 'FrontController@getIndex');

Route::get('/getMenus', 'FrontController@getAsNavMenus');

Route::get('producto/detalle/{id}', 'FrontController@getProductoDetalle');

Route::post('producto/precio_oferta', 'FrontController@postPrecioOfertaProducto');

Route::get('producto/{url}', 'FrontController@getProductFront');

Route::get('productos', 'FrontController@getProductsFront');

Route::get('productos/search', 'FrontController@getProductsSearch');

Route::get('categorias', function(){
    return redirect('/');
});

Route::get('etiquetas', function(){
    return redirect('/');
});

Route::get('categorias/{url}', 'FrontController@getCategoriaFront');

Route::get('categorias/{url}/{sub}', 'FrontController@getCategoriaFront2');

Route::get('etiquetas/{url}', 'FrontController@getEtiquetaFront');
Route::post('suscripcion', 'SuscripcionFrontController@sendSuscripcion');

Route::get('collections/ofertas', 'FrontController@getProductosOfertas');

Route::get('nosotros', 'FrontController@getNosotros');
Route::get('terminos_condiciones', 'FrontController@getTerminos_Condiciones');
Route::get('preguntas_frecuentes', 'FrontController@getPreguntasFrecuentes');
Route::get('pasos_compra', 'FrontController@getPasosCompra');
Route::get('formas-y-costos-de-entrega', 'FrontController@getFormasCostosEntrega');
Route::get('medios_pago', 'FrontController@medioPagosFront');
Route::get('politica_privacidad', 'FrontController@getPoliticasPrivacidad');
Route::get('libro-de-reclamaciones','FrontController@getLibro_Reclamaciones');

Route::get('noticias/{url}', 'FrontController@getNoticiaFront');
Route::get('noticias', 'FrontController@getNoticiasFront');

Route::get('noticia_categorias/{url}', 'FrontController@getNoticiaByCategoriesFront');
Route::get('noticia_categorias/{url}/{sub}', 'FrontController@getNoticiaByCategoriesFront');

Route::get('noticia_etiquetas/{url}', 'FrontController@getNoticiaByEtiquetaFront');

Route::get('contacto', 'FrontController@contactForm');

Route::get('opiniones', 'FrontController@getOpiniones');


Route::get('load-cart', 'CartController@loadCart');
Route::post('add-cart', 'CartController@add_to_cart');
Route::post('/update-cart', 'CartController@update')->name('cart.update');
// Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::post('remove-cart', 'CartController@remove')->name('cart.remove');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
Route::post('/cupones', 'CartController@cupones')->name('cart.cupones');
Route::get('load-table-pago', 'CartController@loadTablePago');


Route::get('payment_description/{url}', 'FrontController@getPaymentDescription');

Route::post('/comprobante/imgTmp', 'PagoController@imgTmp');

Route::post('/forms/pago', 'PagoController@store');
Route::post('forms/contacto', 'FormsController@ContactoForm');

Route::post('/forms/libro_reclamaciones', 'LibroReclamacionesFrontController@storeLibro');


Route::get('confirmacion_pago', 'FrontController@getConfirmacion_pago')->name('pago.confirmacion');

Route::get('confirmacion_correo', 'FrontController@getConfirmacion_Correo')->name('email.confirmacion');

Route::post('webhooks', 'WebHooksController');

// Route::post('/oder/pay', 'PagoController@pay')->name('orders.pay');


Route::get('/payment/{order}', 'PagoController@paymentorder')->name('order.paymentorder');
Route::get('/payment/payphone/{order}', 'PagoController@paymentorderpayphone')->name('order.paymentorderpayphone');
Route::get('/payment/fail/{order}', 'PagoController@failOrder')->name('order.failureorder');
Route::get('/payment/pending/{order}', 'PagoController@pendindOrder')->name('order.pendingorder');
// Route::post('/forms/pago_online', 'PagoController@pago_online');
Route::get('/order/pay/{order}','PagoController@MercadoPagoSuccess')->name('mercadopago.success');
Route::get('/order/fail/{order}','PagoController@MercadoPagoFail')->name('mercadopago.fail');
Route::get('/order/pending/{order}','PagoController@MercadoPagoPending')->name('mercadopago.pending');


// Route::get('/', function () {
//     // return view('welcome');
  
// });

    //rutas Register
    Route::get('/register', 'Client\ConnectController@getRegister')->name('register');
    Route::Post('/register', 'Client\ConnectController@postRegister')->name('register');
    //rutas Login
    Route::get('/login', 'Client\ConnectController@getLogin')->name('login');
    Route::Post('/login', 'Client\ConnectController@postLogin')->name('login');
    Route::get('/logout', 'Client\ConnectController@getLogout')->name('logout');


Route::group(['middleware' => ['role:client']], function () {
    Route::get('pago', 'FrontController@getPagoFront')->name('pago');
});

//rutas para los módulos de Administración

Route::prefix('admin')->group(function () {

    //rutas Login
    Route::get('/login', 'Admin\ConnectController@getLogin')->name('login');
    Route::Post('/login', 'Admin\ConnectController@postLogin')->name('admin.login');
    Route::get('/logout', 'Admin\ConnectController@getLogout')->name('logout');

    Route::get('/', 'Admin\HomeController@getDashboard')->name('admin.dashboard');

    // --  Módulo Categorías  -- 

    Route::resource('categorias', 'Admin\CategoriaController');
    // Route::get('categorias/get_categorias_ajax_data', 'Admin\CategoriaController@get_ajax_categoria_data');
    Route::post('categorias/activar/{id}', 'Admin\CategoriaController@activar');
    Route::post('categorias/desactivar/{id}', 'Admin\CategoriaController@desactivar');
    Route::post('categorias/subirImagenTmp', 'Admin\CategoriaController@subirImagenTmp');
    Route::post('categorias/eliminarImagenTmp', 'Admin\CategoriaController@eliminarImagenTmp');
    Route::post('categorias/eliminarImagen', 'Admin\CategoriaController@eliminarImagen');
    Route::post('categorias/eliminarImagen/{key}', 'Admin\CategoriaController@deleteImagen');

    Route::get('pdf/ReporteCategoriaPdf', 'Admin\CategoriaController@generarPdf');

    Route::get('Excel/ReporteCategoriaExcel', 'Admin\CategoriaController@generarExcel');

    Route::get('categorias/subcategoria', function(){
        // return redirect('admin/categorias');
        echo 'ga';
    });

    Route::get('categorias/subcategoria/{id}', 'Admin\SubCategoriaController@listarSubCategorias');
    Route::resource('subcategoria', 'Admin\SubCategoriaController');
    
    Route::post('subcategoria/activar/{id}', 'Admin\SubCategoriaController@activar');
    Route::post('subcategoria/desactivar/{id}', 'Admin\SubCategoriaController@desactivar');

    // - -Fin Módulo Categorías -- 

    
    // --  Módulo TAGS -- 

    Route::resource('tags', 'Admin\TagController');
    Route::post('tags/activar/{id}', 'Admin\TagController@activar');
    Route::post('tags/desactivar/{id}', 'Admin\TagController@desactivar');
    Route::post('tags/subirImagenTmp', 'Admin\TagController@subirImagenTmp');
    Route::post('tags/eliminarImagenTmp', 'Admin\TagController@eliminarImagenTmp');
    Route::post('tags/eliminarImagen', 'Admin\TagController@eliminarImagen');
    Route::post('tags/eliminarImagen/{key}', 'Admin\TagController@deleteImagen');
    
    Route::get('pdf/ReporteTagPdf', 'Admin\TagController@generarPdf');

    Route::get('Excel/ReporteTagExcel', 'Admin\TagController@generarExcel');
    // - -Fin Módulo TAGS -- 

    // --  Módulo Productos -- 

    Route::resource('productos', 'Admin\ProductoController', [ 'as' => 'admin' ]);
    Route::post('productos/activar/{id}', 'Admin\ProductoController@activar');
    Route::post('productos/desactivar/{id}', 'Admin\ProductoController@desactivar');
    Route::post('productos/agotado/{id}', 'Admin\ProductoController@agotado');
    Route::post('productos/carrousel/{id}', 'Admin\ProductoController@carrousel');
    Route::post('productos/oferta/{id}', 'Admin\ProductoController@oferta');
    Route::post('productos/estreno/{id}', 'Admin\ProductoController@estreno');
    Route::post('productos/promo_dia/{id}', 'Admin\ProductoController@promo_dia');
    Route::get('productos/codigos_producto/{id}', 'Admin\ProductoController@getCodigosProducto');
    Route::post('productos/codigos_producto/store', 'Admin\ProductoController@storeCodigoProducto');
    Route::get('productos/codigos_producto/show/{id}','Admin\ProductoController@showCodigoProducto');
    Route::put('productos/codigos_producto/update/{id}','Admin\ProductoController@editCodigoProducto');
    Route::delete('productos/codigos_producto/delete/{id}','Admin\ProductoController@deleteCodigoProducto');
    Route::post('productos/subirImagenTmp', 'Admin\ProductoController@subirImagenTmp');
    Route::post('productos/eliminarImagenTmp', 'Admin\ProductoController@eliminarImagenTmp');
    Route::post('productos/eliminarImagen', 'Admin\ProductoController@eliminarImagen');
    Route::post('productos/eliminarImagen/{key}', 'Admin\ProductoController@deleteImagen');

    // - -Fin Módulo Productos -- 

    // --  Módulo Sliders -- 

    Route::resource('sliders', 'Admin\SliderController');
    Route::post('sliders/activar/{id}', 'Admin\SliderController@activar');
    Route::post('sliders/desactivar/{id}', 'Admin\SliderController@desactivar');
    Route::post('sliders/popup/{id}', 'Admin\SliderController@sliderPopup');
    Route::post('sliders/subirImagenTmp', 'Admin\SliderController@subirImagenTmp');
    Route::post('sliders/eliminarImagenTmp', 'Admin\SliderController@eliminarImagenTmp');
    Route::post('sliders/eliminarimg', 'Admin\SliderController@eliminarImg');
   
    // - -Fin Módulo Sliders -- 

    // --  Módulo Baners -- 

    Route::resource('banners', 'Admin\BannerController');
    Route::post('banners/activar/{id}', 'Admin\BannerController@activar');
    Route::post('banners/desactivar/{id}', 'Admin\BannerController@desactivar');
    Route::post('banners/subirImagenTmp', 'Admin\BannerController@subirImagenTmp');
    Route::post('banners/eliminarImagenTmp', 'Admin\BannerController@eliminarImagenTmp');
    Route::post('banners/eliminarimg', 'Admin\BannerController@eliminarImg');
            
    // - -Fin Módulo Baners -- 

    //Módulo Diseño

    Route::resource('disenio', 'Admin\BloqueController');
    Route::post('disenio/activar/{id}', 'Admin\BloqueController@activar');
    Route::post('disenio/desactivar/{id}', 'Admin\BloqueController@desactivar');
    Route::post('disenio/up/{id}', 'Admin\BloqueController@up');
    Route::post('disenio/down/{id}', 'Admin\BloqueController@down');
    Route::post('disenio/subirImagenTmp', 'Admin\BloqueController@subirImagenTmp');
    Route::post('disenio/eliminarImagenTmp', 'Admin\BloqueController@eliminarImagenTmp');
    Route::post('disenio/eliminarimg', 'Admin\BloqueController@eliminarImg');
    
    // - -Fin Módulo Diseño --


    //Módulo Preguntas Frecuentes

    Route::resource('preguntas_frecuentes', 'Admin\PreguntaFrecuenteController');
    Route::post('preguntas_frecuentes/activar/{id}', 'Admin\PreguntaFrecuenteController@activar');
    Route::post('preguntas_frecuentes/desactivar/{id}', 'Admin\PreguntaFrecuenteController@desactivar');

    // - -Fin Módulo Preguntas Frecuentes --


    //Módulo de Órdenes
    Route::resource('ordenes', 'Admin\OrdenController',  [ 'as' => 'admin' ]);
    Route::post('ordenes/aprobar/{id}', 'Admin\OrdenController@aprobar');
    Route::post('ordenes/rechazar/{id}', 'Admin\OrdenController@rechazar');
    Route::post('ordenes/atender/{id}', 'Admin\OrdenController@atender');
    Route::get('ordenes/detalle/{codigos}', 'Admin\OrdenController@getCodigos');
    //Fin Módulo de Órdenes

    //Módulo Preguntas Frecuentes
    Route::resource('medios_pagos', 'Admin\MedioPagoController', [ 'as' => 'admin' ]);
    Route::post('medios_pagos/activar/{id}', 'Admin\MedioPagoController@activar');
    Route::post('medios_pagos/desactivar/{id}', 'Admin\MedioPagoController@desactivar');
    Route::post('medios_pagos/subirImagenTmp', 'Admin\MedioPagoController@subirImagenTmp');
    Route::post('medios_pagos/eliminarImagenTmp', 'Admin\MedioPagoController@eliminarImagenTmp');
    Route::post('medios_pagos/eliminarimg', 'Admin\MedioPagoController@eliminarImg');


    Route::post('ckeditor/upload', 'Admin\MedioPagoController@upload')->name('ckeditor.upload');
    Route::post('tiny/upload', 'Admin\MedioPagoController@upload_tiny')->name('tiny.uploadtiny');
    
    // - -Fin Módulo Preguntas Frecuentes --

    //Módulo Moneda

    Route::resource('monedas', 'Admin\MonedaController');
    Route::post('monedas/activar/{id}', 'Admin\MonedaController@activar');
    Route::post('monedas/desactivar/{id}', 'Admin\MonedaController@desactivar');

    // - -Fin Módulo Moneda --

    //Módulo Menu
    Route::resource('menus', 'Admin\MenuController');
    Route::post('menus/listarMenuPadres', 'Admin\MenuController@listarMenuPadres');
    Route::post('menus/decrypt','Admin\MenuController@decryptMenu');
    Route::post('menus/activar/{id}', 'Admin\MenuController@activar');
    Route::post('menus/desactivar/{id}', 'Admin\MenuController@desactivar');
    Route::post('menus/up/{id}', 'Admin\MenuController@up');
    Route::post('menus/down/{id}', 'Admin\MenuController@down');
    Route::post('menus/subirImagenTmp', 'Admin\MenuController@subirImagenTmp');
    Route::post('menus/eliminarImagenTmp', 'Admin\MenuController@eliminarImagenTmp');
    Route::post('menus/eliminarimg', 'Admin\MenuController@eliminarImg');
    //Fin Módulo Menu


    //Módulo Estilos
    Route::resource('estilos', 'Admin\EstiloController')->only('index','store');
    //Fin Estilos


    //Módulo Configuraciones
    Route::resource('configuraciones', 'Admin\ConfiguracionController')->only('index','store');
    //fin configuraciones


    //Módulo Descuentos
    Route::resource('descuentos', 'Admin\DescuentoController');
    Route::post('descuentos/activar/{id}', 'Admin\DescuentoController@activar');
    Route::post('descuentos/desactivar/{id}', 'Admin\DescuentoController@desactivar');
    //fin Descuento


    //Módulo Noticias Categorias
    Route::resource('noticia_categoria', 'Admin\NoticiaCategoriaController');
    Route::post('noticia_categoria/activar/{id}', 'Admin\NoticiaCategoriaController@activar');
    Route::post('noticia_categoria/desactivar/{id}', 'Admin\NoticiaCategoriaController@desactivar');

    Route::get('noticia_categoria/subcategorias_noticias/{id}', 'Admin\NoticiaSubCategoriaController@listarSubCategoriasNoticias');
    Route::resource('noticia_categoria/subcategorias_noticia', 'Admin\NoticiaSubCategoriaController');
    Route::post('noticia_categoria/subcategorias_noticia/activar/{id}', 'Admin\NoticiaSubCategoriaController@activar');
    Route::post('noticia_categoria/subcategorias_noticia/desactivar/{id}', 'Admin\NoticiaSubCategoriaController@desactivar');

    //fin Noticias Categorias


    //Módulo Noticias Tags
    Route::resource('noticia_tag', 'Admin\NoticiaTagController');
    Route::post('noticia_tag/activar/{id}', 'Admin\NoticiaTagController@activar');
    Route::post('noticia_tag/desactivar/{id}', 'Admin\NoticiaTagController@desactivar');
    //fin Noticias Tags


    //Módulo Noticias Noticias
    Route::resource('noticias', 'Admin\NoticiaController', [ 'as' => 'admin' ]);
    Route::post('noticias/activar/{id}', 'Admin\NoticiaController@activar');
    Route::post('noticias/desactivar/{id}', 'Admin\NoticiaController@desactivar');
    Route::post('noticias/subirImagenTmp', 'Admin\NoticiaController@subirImagenTmp');
    Route::post('noticias/eliminarImagenTmp', 'Admin\NoticiaController@eliminarImagenTmp');
    Route::post('noticias/eliminarImagen', 'Admin\NoticiaController@eliminarImagen');
    Route::post('noticias/eliminarImagen/{key}', 'Admin\NoticiaController@deleteImagen');
    Route::post('noticias/upload_img_desc', 'Admin\NoticiaController@upload_img_desc')->name('noticias.upload_img_desc');
    //fin Noticias Noticias

    // Modulo suscripciones
    Route::resource('suscripciones', 'Admin\SuscripcionController', [ 'as' => 'admin' ]);

    // Módulo Libro de Reclamaciones
    Route::resource('libro_reclamaciones', 'Admin\LibroReclamacionesController', [ 'as' => 'admin' ]);

    //Módulo Usuarios
    Route::resource('usuarios', 'Admin\UserController',[ 'as' => 'admin' ]);
    Route::post('usuarios/activar/{id}', 'Admin\UserController@activar');
    Route::post('usuarios/desactivar/{id}', 'Admin\UserController@desactivar');
    Route::post('usuarios/subirImagenTmp', 'Admin\UserController@subirImagenTmp');
    Route::post('usuarios/eliminarImagenTmp', 'Admin\UserController@eliminarImagenTmp');
    Route::post('usuarios/eliminarFoto', 'Admin\UserController@eliminarFoto');
    // - -Fin Módulo Usuarios --


    //Módulo Roles
    Route::resource('roles', 'Admin\RolController',[ 'as' => 'admin' ]);
    Route::post('roles/activar/{id}', 'Admin\RolController@activar');
    Route::post('roles/desactivar/{id}', 'Admin\RolController@desactivar');

    Route::get('reportes', 'Admin\ReporteController@getReportes');
    Route::post('reportes', 'Admin\ReporteController@postReportes');

    
    Route::get('reportes/excel1', 'Admin\ReporteController@generarExcel1');
    Route::get('reportes/excel2', 'Admin\ReporteController@generarExcel2');
    Route::get('reportes/excel3', 'Admin\ReporteController@generarExcel3');
    Route::get('reportes/excel4', 'Admin\ReporteController@generarExcel4');
    Route::get('reportes/excel5', 'Admin\ReporteController@generarExcel5');
    Route::get('reportes/excel6', 'Admin\ReporteController@generarExcel6');
    Route::get('reportes/excel7', 'Admin\ReporteController@generarExcel7');
    Route::get('reportes/excel8', 'Admin\ReporteController@generarExcel8');

    Route::any('/{catchall}', 'Admin\HomeController@get404AdminNotFound')->where('catchall', '.*');
     // - -Fin Roles --

    // Route::get('/roles', 'Admin\RolesController@getRoles')->name('admin.roles');
    // Route::post('/roles', 'Admin\RolesController@store');
    // Route::get('/roles/{id}', 'Admin\RolesController@show');
    // Route::post('/roles/{id}', 'Admin\RolesController@update');

});

Route::any('{catchall}', 'FrontController@get404NotFound')->where('catchall', '.*');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
