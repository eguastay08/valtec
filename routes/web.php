<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NoticiaSubCategoriaController; 
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\BloqueController;         
use App\Http\Controllers\Admin\LibroReclamacionesController;  
use App\Http\Controllers\Admin\NoticiaTagController;           
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoriaController;     
use App\Http\Controllers\Admin\MedioPagoController;           
use App\Http\Controllers\Admin\OrdenController;                
use App\Http\Controllers\Admin\SubCategoriaController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\SuscripcionController;
use App\Http\Controllers\Admin\ConnectController;        
use App\Http\Controllers\Admin\MonedaController;              
use App\Http\Controllers\Admin\PreguntaFrecuenteController;    
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DescuentoController;      
use App\Http\Controllers\Admin\NoticiaCategoriaController;    
use App\Http\Controllers\Admin\ProductoController;             
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EstiloController;         
use App\Http\Controllers\Admin\NoticiaController;             
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SuscripcionFrontController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\WebHooksController;
use App\Http\Controllers\opinionesFrontController;
use App\Http\Controllers\pagoControllerbkp4;
use App\Http\Controllers\LibroReclamacionesFrontController;

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

// Rutas principales del frontend
Route::get('/', [FrontController::class, 'getIndex']);

Route::get('/getMenus', [FrontController::class, 'getAsNavMenus']);

Route::get('producto/detalle/{id}', [FrontController::class, 'getProductoDetalle']);

Route::post('producto/precio_oferta', [FrontController::class, 'postPrecioOfertaProducto']);

Route::get('producto/{url}', [FrontController::class, 'getProductFront']);

Route::get('productos', [FrontController::class, 'getProductsFront']);

Route::get('productos/search', [FrontController::class, 'getProductsSearch']);

Route::get('categorias', function(){
    return redirect('/');
});

Route::get('etiquetas', function(){
    return redirect('/');
});

Route::get('categorias/{url}', [FrontController::class, 'getCategoriaFront']);

Route::get('categorias/{url}/{sub}', [FrontController::class, 'getCategoriaFront2']);

Route::get('etiquetas/{url}', [FrontController::class, 'getEtiquetaFront']);

Route::post('suscripcion', [SuscripcionFrontController::class, 'sendSuscripcion']);

Route::get('collections/ofertas', [FrontController::class, 'getProductosOfertas']);

Route::get('nosotros', [FrontController::class, 'getNosotros']);
Route::get('terminos_condiciones', [FrontController::class, 'getTerminos_Condiciones']);
Route::get('preguntas_frecuentes', [FrontController::class, 'getPreguntasFrecuentes']);
Route::get('pasos_compra', [FrontController::class, 'getPasosCompra']);
Route::get('formas-y-costos-de-entrega', [FrontController::class, 'getFormasCostosEntrega']);
Route::get('medios_pago', [FrontController::class, 'medioPagosFront']);
Route::get('politica_privacidad', [FrontController::class, 'getPoliticasPrivacidad']);
Route::get('libro-de-reclamaciones', [FrontController::class, 'getLibro_Reclamaciones']);

Route::get('noticias/{url}', [FrontController::class, 'getNoticiaFront']);
Route::get('noticias', [FrontController::class, 'getNoticiasFront']);

Route::get('noticia_categorias/{url}', [FrontController::class, 'getNoticiaByCategoriesFront']);
Route::get('noticia_categorias/{url}/{sub}', [FrontController::class, 'getNoticiaByCategoriesFront']);

Route::get('noticia_etiquetas/{url}', [FrontController::class, 'getNoticiaByEtiquetaFront']);

Route::get('contacto', [FrontController::class, 'contactForm']);

Route::get('opiniones', [FrontController::class, 'getOpiniones']);

// Rutas del carrito de compras
Route::get('load-cart', [CartController::class, 'loadCart']);
Route::post('add-cart', [CartController::class, 'add_to_cart']);
Route::post('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::post('remove-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cupones', [CartController::class, 'cupones'])->name('cart.cupones');
Route::get('load-table-pago', [CartController::class, 'loadTablePago']);

// Rutas de pago
Route::get('payment_description/{url}', [FrontController::class, 'getPaymentDescription']);

Route::post('/comprobante/imgTmp', [PagoController::class, 'imgTmp']);

Route::post('/forms/pago', [PagoController::class, 'store']);
Route::post('forms/contacto', [FormsController::class, 'ContactoForm']);

Route::post('/forms/libro_reclamaciones', [LibroReclamacionesFrontController::class, 'storeLibro']);

Route::get('confirmacion_pago', [FrontController::class, 'getConfirmacion_pago'])->name('pago.confirmacion');

Route::get('confirmacion_correo', [FrontController::class, 'getConfirmacion_Correo'])->name('email.confirmacion');

Route::post('webhooks', [WebHooksController::class, '__invoke']); // Usualmente, un controlador de webhook se define como un método __invoke

// Rutas de pagos con MercadoPago
Route::get('/payment/{order}', [PagoController::class, 'paymentorder'])->name('order.paymentorder');
Route::get('/payment/payphone/{order}', [PagoController::class, 'paymentorderpayphone'])->name('order.paymentorderpayphone');
Route::get('/payment/fail/{order}', [PagoController::class, 'failOrder'])->name('order.failureorder');
Route::get('/payment/pending/{order}', [PagoController::class, 'pendindOrder'])->name('order.pendingorder');
Route::get('/order/pay/{order}', [PagoController::class, 'MercadoPagoSuccess'])->name('mercadopago.success');
Route::get('/order/fail/{order}', [PagoController::class, 'MercadoPagoFail'])->name('mercadopago.fail');
Route::get('/order/pending/{order}', [PagoController::class, 'MercadoPagoPending'])->name('mercadopago.pending');

// Rutas de autenticación y registro
Route::get('/register', [ConnectController::class, 'getRegister'])->name('register.getRegister');
Route::post('/register', [ConnectController::class, 'postRegister'])->name('register.postRegister');
Route::get('/login', [ConnectController::class, 'getLogin'])->name('login.getLogin');
Route::post('/login', [ConnectController::class, 'postLogin'])->name('login.postLogin');
Route::get('/logout', [ConnectController::class, 'getLogout'])->name('logout.getLogout');


// CartController Routes
Route::controller(CartController::class)->group(function () {
    Route::get('load-cart', 'loadCart');
    Route::post('add-cart', 'add_to_cart');
    Route::post('/update-cart', 'update')->name('cart.update');
    Route::post('remove-cart', 'remove')->name('cart.remove');
    Route::post('/clear', 'clear')->name('cart.clear');
    Route::post('/cupones', 'cupones')->name('cart.cupones');
    Route::get('load-table-pago', 'loadTablePago');
});

// Suscripción Routes
Route::post('suscripcion', [SuscripcionFrontController::class, 'sendSuscripcion']);

// FormsController Routes
Route::post('forms/contacto', [FormsController::class, 'ContactoForm']);
Route::post('/forms/libro_reclamaciones', [LibroReclamacionesFrontController::class, 'storeLibro']);

// PagoController Routes
Route::controller(PagoController::class)->group(function () {
    Route::post('/comprobante/imgTmp', 'imgTmp');
    Route::post('/forms/pago', 'store');
});

// Redirecciones simples
Route::get('categorias', fn() => redirect('/'));
Route::get('etiquetas', fn() => redirect('/'));

// Rutas de registro y login
Route::controller(ConnectController::class)->group(function () {
    Route::get('/register', 'getRegister')->name('register.getRegister');
    Route::post('/register', 'postRegister')->name('register.postRegister');
    Route::get('/login', 'getLogin')->name('login.getLogin');
    Route::post('/login', 'postLogin')->name('login.postLogin');
    Route::get('/logout', 'getLogout')->name('logout.getLogout');
});

// Rutas protegidas por middleware
Route::middleware(['role:client'])->group(function () {
});
Route::get('pago', [FrontController::class, 'getPagoFront'])->name('pago');

Route::prefix('admin')->group(function () {

    // Rutas de Login
    Route::get('/login', [ConnectController::class, 'getLogin'])->name('login');
    Route::post('/login', [ConnectController::class, 'postLogin'])->name('admin.login');
    Route::get('/logout', [ConnectController::class, 'getLogout'])->name('logout');

    Route::get('/', [HomeController::class, 'getDashboard'])->name('admin.dashboard');

    // Módulo Categorías
    Route::resource('categorias', CategoriaController::class);
    Route::post('categorias/activar/{id}', [CategoriaController::class, 'activar']);
    Route::post('categorias/desactivar/{id}', [CategoriaController::class, 'desactivar']);
    Route::post('categorias/subirImagenTmp', [CategoriaController::class, 'subirImagenTmp']);
    Route::post('categorias/eliminarImagenTmp', [CategoriaController::class, 'eliminarImagenTmp']);
    Route::post('categorias/eliminarImagen', [CategoriaController::class, 'eliminarImagen']);
    Route::post('categorias/eliminarImagen/{key}', [CategoriaController::class, 'deleteImagen']);
    Route::get('pdf/ReporteCategoriaPdf', [CategoriaController::class, 'generarPdf']);
    Route::get('Excel/ReporteCategoriaExcel', [CategoriaController::class, 'generarExcel']);
    Route::get('categorias/subcategoria/{id}', [SubCategoriaController::class, 'listarSubCategorias']);
    Route::resource('subcategoria', SubCategoriaController::class);
    Route::post('subcategoria/activar/{id}', [SubCategoriaController::class, 'activar']);
    Route::post('subcategoria/desactivar/{id}', [SubCategoriaController::class, 'desactivar']);

    // Módulo TAGS
    Route::resource('tags', TagController::class);
    Route::post('tags/activar/{id}', [TagController::class, 'activar']);
    Route::post('tags/desactivar/{id}', [TagController::class, 'desactivar']);
    Route::post('tags/subirImagenTmp', [TagController::class, 'subirImagenTmp']);
    Route::post('tags/eliminarImagenTmp', [TagController::class, 'eliminarImagenTmp']);
    Route::post('tags/eliminarImagen', [TagController::class, 'eliminarImagen']);
    Route::post('tags/eliminarImagen/{key}', [TagController::class, 'deleteImagen']);
    Route::get('pdf/ReporteTagPdf', [TagController::class, 'generarPdf']);
    Route::get('Excel/ReporteTagExcel', [TagController::class, 'generarExcel']);

    // Módulo Productos
    Route::resource('productos', ProductoController::class, ['as' => 'admin']);
    Route::post('productos/activar/{id}', [ProductoController::class, 'activar']);
    Route::post('productos/desactivar/{id}', [ProductoController::class, 'desactivar']);
    Route::post('productos/agotado/{id}', [ProductoController::class, 'agotado']);
    Route::post('productos/carrousel/{id}', [ProductoController::class, 'carrousel']);
    Route::post('productos/oferta/{id}', [ProductoController::class, 'oferta']);
    Route::post('productos/estreno/{id}', [ProductoController::class, 'estreno']);
    Route::post('productos/promo_dia/{id}', [ProductoController::class, 'promo_dia']);
    Route::get('productos/codigos_producto/{id}', [ProductoController::class, 'getCodigosProducto']);
    Route::post('productos/codigos_producto/store', [ProductoController::class, 'storeCodigoProducto']);
    Route::get('productos/codigos_producto/show/{id}', [ProductoController::class, 'showCodigoProducto']);
    Route::put('productos/codigos_producto/update/{id}', [ProductoController::class, 'editCodigoProducto']);
    Route::delete('productos/codigos_producto/delete/{id}', [ProductoController::class, 'deleteCodigoProducto']);
    Route::post('productos/subirImagenTmp', [ProductoController::class, 'subirImagenTmp']);
    Route::post('productos/eliminarImagenTmp', [ProductoController::class, 'eliminarImagenTmp']);
    Route::post('productos/eliminarImagen', [ProductoController::class, 'eliminarImagen']);
    Route::post('productos/eliminarImagen/{key}', [ProductoController::class, 'deleteImagen']);

    // Módulo Sliders
    Route::resource('sliders', SliderController::class);
    Route::post('sliders/activar/{id}', [SliderController::class, 'activar']);
    Route::post('sliders/desactivar/{id}', [SliderController::class, 'desactivar']);
    Route::post('sliders/popup/{id}', [SliderController::class, 'sliderPopup']);
    Route::post('sliders/subirImagenTmp', [SliderController::class, 'subirImagenTmp']);
    Route::post('sliders/eliminarImagenTmp', [SliderController::class, 'eliminarImagenTmp']);
    Route::post('sliders/eliminarimg', [SliderController::class, 'eliminarImg']);

    // Módulo Banners
    Route::resource('banners', BannerController::class);
    Route::post('banners/activar/{id}', [BannerController::class, 'activar']);
    Route::post('banners/desactivar/{id}', [BannerController::class, 'desactivar']);
    Route::post('banners/subirImagenTmp', [BannerController::class, 'subirImagenTmp']);
    Route::post('banners/eliminarImagenTmp', [BannerController::class, 'eliminarImagenTmp']);
    Route::post('banners/eliminarimg', [BannerController::class, 'eliminarImg']);

    // Módulo Diseño
    Route::resource('disenio', BloqueController::class);
    Route::post('disenio/activar/{id}', [BloqueController::class, 'activar']);
    Route::post('disenio/desactivar/{id}', [BloqueController::class, 'desactivar']);
    Route::post('disenio/up/{id}', [BloqueController::class, 'up']);
    Route::post('disenio/down/{id}', [BloqueController::class, 'down']);
    Route::post('disenio/subirImagenTmp', [BloqueController::class, 'subirImagenTmp']);
    Route::post('disenio/eliminarImagenTmp', [BloqueController::class, 'eliminarImagenTmp']);
    Route::post('disenio/eliminarimg', [BloqueController::class, 'eliminarImg']);

    // Módulo Preguntas Frecuentes
    Route::resource('preguntas_frecuentes', PreguntaFrecuenteController::class);
    Route::post('preguntas_frecuentes/activar/{id}', [PreguntaFrecuenteController::class, 'activar']);
    Route::post('preguntas_frecuentes/desactivar/{id}', [PreguntaFrecuenteController::class, 'desactivar']);

    // Módulo Órdenes
    Route::resource('ordenes', OrdenController::class, ['as' => 'admin']);
    Route::post('ordenes/aprobar/{id}', [OrdenController::class, 'aprobar']);
    Route::post('ordenes/rechazar/{id}', [OrdenController::class, 'rechazar']);
    Route::post('ordenes/atender/{id}', [OrdenController::class, 'atender']);
    Route::get('ordenes/detalle/{codigos}', [OrdenController::class, 'getCodigos']);

    // Módulo Medios de Pago
    Route::resource('medios_pagos', MedioPagoController::class, ['as' => 'admin']);
    Route::post('medios_pagos/activar/{id}', [MedioPagoController::class, 'activar']);
    Route::post('medios_pagos/desactivar/{id}', [MedioPagoController::class, 'desactivar']);
    Route::post('medios_pagos/subirImagenTmp', [MedioPagoController::class, 'subirImagenTmp']);
    Route::post('medios_pagos/eliminarImagenTmp', [MedioPagoController::class, 'eliminarImagenTmp']);
    Route::post('medios_pagos/eliminarimg', [MedioPagoController::class, 'eliminarImg']);
    Route::post('ckeditor/upload', [MedioPagoController::class, 'upload'])->name('ckeditor.upload');
    Route::post('tiny/upload', [MedioPagoController::class, 'upload_tiny'])->name('tiny.uploadtiny');

    // Módulo Moneda
    Route::resource('monedas', MonedaController::class);
    Route::post('monedas/activar/{id}', [MonedaController::class, 'activar']);
    Route::post('monedas/desactivar/{id}', [MonedaController::class, 'desactivar']);

    // Módulo Menú
    Route::resource('menus', MenuController::class);
    Route::post('menus/listarMenuPadres', [MenuController::class, 'listarMenuPadres']);
    Route::post('menus/decrypt', [MenuController::class, 'decryptMenu']);
    Route::post('menus/activar/{id}', [MenuController::class, 'activar']);
    Route::post('menus/desactivar/{id}', [MenuController::class, 'desactivar']);
    Route::post('menus/up/{id}', [MenuController::class, 'up']);
    Route::post('menus/down/{id}', [MenuController::class, 'down']);
    Route::post('menus/subirImagenTmp', [MenuController::class, 'subirImagenTmp']);
    Route::post('menus/eliminarImagenTmp', [MenuController::class, 'eliminarImagenTmp']);
    Route::post('menus/eliminarimg', [MenuController::class, 'eliminarImg']);

    // Módulo Estilos
    Route::resource('estilos', EstiloController::class)->only('index', 'store');

    // Módulo Configuraciones
    Route::resource('configuraciones', ConfiguracionController::class)->only('index', 'store');

    // Módulo Descuentos
    Route::resource('descuentos', DescuentoController::class);
    Route::post('descuentos/activar/{id}', [DescuentoController::class, 'activar']);
    Route::post('descuentos/desactivar/{id}', [DescuentoController::class, 'desactivar']);

    // Módulo Noticias Categorías
    Route::resource('noticia_categoria', NoticiaCategoriaController::class);
    Route::post('noticia_categoria/activar/{id}', [NoticiaCategoriaController::class, 'activar']);
    Route::post('noticia_categoria/desactivar/{id}', [NoticiaCategoriaController::class, 'desactivar']);
    Route::get('noticia_categoria/subcategorias_noticias/{id}', [NoticiaSubCategoriaController::class, 'listarSubCategoriasNoticias']);
    Route::resource('noticia_categoria/subcategorias_noticia', NoticiaSubCategoriaController::class);
    Route::post('noticia_categoria/subcategorias_noticia/activar/{id}', [NoticiaSubCategoriaController::class, 'activar']);
    Route::post('noticia_categoria/subcategorias_noticia/desactivar/{id}', [NoticiaSubCategoriaController::class, 'desactivar']);

    // Módulo Noticias Tags
    Route::resource('noticia_tag', NoticiaTagController::class);
    Route::post('noticia_tag/activar/{id}', [NoticiaTagController::class, 'activar']);
    Route::post('noticia_tag/desactivar/{id}', [NoticiaTagController::class, 'desactivar']);

    // Módulo Noticias
    Route::resource('noticias', NoticiaController::class, ['as' => 'admin']);
    Route::post('noticias/activar/{id}', [NoticiaController::class, 'activar']);
    Route::post('noticias/desactivar/{id}', [NoticiaController::class, 'desactivar']);
    Route::post('noticias/subirImagenTmp', [NoticiaController::class, 'subirImagenTmp']);
    Route::post('noticias/eliminarImagenTmp', [NoticiaController::class, 'eliminarImagenTmp']);
    Route::post('noticias/eliminarImagen', [NoticiaController::class, 'eliminarImagen']);
    Route::post('noticias/eliminarImagen/{key}', [NoticiaController::class, 'deleteImagen']);
    Route::post('noticias/upload_img_desc', [NoticiaController::class, 'upload_img_desc'])->name('noticias.upload_img_desc');

    // Módulo Suscripciones
    Route::resource('suscripciones', SuscripcionController::class, ['as' => 'admin']);

    // Módulo Libro de Reclamaciones
    Route::resource('libro_reclamaciones', LibroReclamacionesController::class, ['as' => 'admin']);

    // Módulo Usuarios
    Route::resource('usuarios', UserController::class, ['as' => 'admin']);
    Route::post('usuarios/activar/{id}', [UserController::class, 'activar']);
    Route::post('usuarios/desactivar/{id}', [UserController::class, 'desactivar']);
    Route::post('usuarios/subirImagenTmp', [UserController::class, 'subirImagenTmp']);
    Route::post('usuarios/eliminarImagenTmp', [UserController::class, 'eliminarImagenTmp']);
    Route::post('usuarios/eliminarFoto', [UserController::class, 'eliminarFoto']);

    // Módulo Roles
    Route::resource('roles', RolController::class, ['as' => 'admin']);
    Route::post('roles/activar/{id}', [RolController::class, 'activar']);
    Route::post('roles/desactivar/{id}', [RolController::class, 'desactivar']);

    Route::get('reportes', [ReporteController::class, 'getReportes']);
    Route::post('reportes', [ReporteController::class, 'postReportes']);
    Route::get('reportes/excel1', [ReporteController::class, 'generarExcel1']);
    Route::get('reportes/excel2', [ReporteController::class, 'generarExcel2']);
    Route::get('reportes/excel3', [ReporteController::class, 'generarExcel3']);
    Route::get('reportes/excel4', [ReporteController::class, 'generarExcel4']);
    Route::get('reportes/excel5', [ReporteController::class, 'generarExcel5']);
    Route::get('reportes/excel6', [ReporteController::class, 'generarExcel6']);
    Route::get('reportes/excel7', [ReporteController::class, 'generarExcel7']);
    Route::get('reportes/excel8', [ReporteController::class, 'generarExcel8']);

    Route::any('/{catchall}', [HomeController::class, 'get404AdminNotFound'])->where('catchall', '.*');
});

// Ruta para manejar errores 404 en el frontend
Route::any('{catchall}', [FrontController::class, 'get404NotFound'])->where('catchall', '.*');

// Ruta de inicio
Route::get('/home', [HomeController::class, 'index'])->name('home');
