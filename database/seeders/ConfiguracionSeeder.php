<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $configuraciones = [
            [
                "nombre"=>"Nombre de la web",
                "variable"=>"website_title",
                "valor"=>"VALTECGDA | Venta de juegos digitales PS3 PS4 PS5",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Email de envio",
                "variable"=>"email_from",
                "valor"=>"ecommerce@e-digitalmail.com",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Asunto de email",
                "variable"=>"email_subject",
                "valor"=>"Storegamesperu.com -",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Email de notificaciones",
                "variable"=>"email_to",
                "valor"=>"onlinecorpml@gmail.com",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Mantenimiento",
                "variable"=>"maintenance",
                "valor"=>"0",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"URL Facebook para la web",
                "variable"=>"url_facebook",
                "valor"=>"https://www.facebook.com/Storegamesperucom-546115698917735/",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Youtube Usuario",
                "variable"=>"youtube_user",
                "valor"=>"channel/UCEV1IIYPQLIAF--IVMxoKVQ",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Horario Atención",
                "variable"=>"horario_atencion",
                "valor"=>"L - S de 10am a 8pm - Feriados Horario Normal - Los Pedidos del Domingo se envian el dia Lunes. ",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Whatsapp",
                "variable"=>"whatsapp",
                "valor"=>"+51 987 477 559",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Email Soporte",
                "variable"=>"email_support",
                "valor"=>"soporte@storegamesperu.com",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Google Analytics ID",
                "variable"=>"google_analytics_id",
                "valor"=>"",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Redirigir SSL",
                "variable"=>"redirect_ssl",
                "valor"=>"0",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"URL Messenger",
                "variable"=>"url_messenger",
                "valor"=>"https://m.me/Storegamesperu.comps3ps4",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Email copia ventas",
                "variable"=>"email_sales",
                "valor"=>"techdigitalml@gmail.com",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Recaptcha Secret Key",
                "variable"=>"go_secret_key",
                "valor"=>"6LeQZQ0qAAAAADVmQ6CgR9adpAvjgRHvfvVelbfz",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Recaptcha Site Key",
                "variable"=>"go_site_key",
                "valor"=>"6LeQZQ0qAAAAAGofMbS-m-Na--FmeDFkblBBwhu9",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Chat Whatsapp",
                "variable"=>"chat_whatsapp",
                "valor"=>"1",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"URL Instagram",
                "variable"=>"url_instagram",
                "valor"=>"https://www.instagram.com/storegamesperups3ps4/",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Mostrar títulos de productos",
                "variable"=>"mostrar_titulo_producto",
                "valor"=>"0",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Descripción de la tienda",
                "variable"=>"descripcion_tienda",
                "valor"=>"Somos una tienda virtual que brinda a sus clientes la mejor atención y servicios. Además tenemos promociones cada semana!",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"URL Tiktok",
                "variable"=>"url_tiktok",
                "valor"=>"https://www.tiktok.com/@jhothsa",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"URL Telegram",
                "variable"=>"url_telegram",
                "valor"=>"https://telegram.com",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Icono Home",
                "variable"=>"icono_home",
                "valor"=>"1",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Mensaje Ok Carrito",
                "variable"=>"mensaje_ok_carrito",
                "valor"=>"Hemos recibido su pedido correctamente y se ha enviado el detalle de compra a su correo. Si usted pagó fuera del horario de atención, el pedido se atenderá durante la siguiente jornada laboral. Debido a la alta demanda por fiestas puede que algunos pedidos sufran algún retraso, no se preocupe, su compra está 100% asegurada y será enviada en orden de llegada.",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Mensaje Fail Carrito",
                "variable"=>"mensaje_fail_carrito",
                "valor"=>"Ocurrió un error al momento de validar su pedido, si el problema persiste, contactar de inmediato para verificar el origen del problema",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Mensaje Pending Carrito",
                "variable"=>"mensaje_pending_carrito",
                "valor"=>"Se está procesando tú pago, en unas horas cuando se valide tu pedido correctamente, nos pondremos en contacto por el Email de Mercado Pago.",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
            [
                "nombre"=>"Desarrollador",
                "variable"=>"desarrollador",
                "valor"=>"Martin Avila Yarlequé",
                "system"=>"0",
                "usuario_registro"=>"admin",
                "fecha_registro"=>now()
            ],
        ];

        Configuracion::insert($configuraciones);
    }
}
