<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <center>
        <table id="bodyTable" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 0 5px;" align="center" height="100%" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr>
                <td id="bodyCell" align="center" valign="top" style="padding:0">
                    <!-- BEGIN TEMPLATE // -->
                    <table id="templateContainer" style="max-width:600px" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                       
                        <tr>
                            <td style="padding:12px 10px;text-align:center;background:#1b1b1b" align="center" valign="top">
                                <a href="{{ url('/') }}"><img class="logo-img" src="{{asset('assets/images/logo.png')}}" style="display:block;margin:0 auto" alt="logo" height="auto" border="0" width="350"/></a>
                            </td>
                        </tr>
    
                        <tr>
                            <td align="center" valign="top" style="border:5px solid #1b1b1b">
                            
                                <!-- BEGIN BODY // -->

                                <table cellpadding="0" cellspacing="0" style="padding:10px 0;border-top: 1px solid #f1f1f1;margin:4px 0">
                                        <tr>
                                            <td style="width:252px"><img src="{{asset('assets/images/cliente.jpg')}}" style="display:block;margin:0 auto" alt="Logo" border="0" height="40"></td>
                                        </tr>
                                    </table>
                                    <table id="templateBody" style="padding: 0;" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="padding:10px;background:#fff">
                                            <table style="font-family: Helvetica, Arial;border:1px solid #fff;border-collapse:collapse;font-size:13px;" width="100%" cellpadding="8">
                                                <tr>
                                                    <td style="border-top:5px solid #fff;background:#333333;color:#fff;text-align:right" width="135"><b>NOMBRE</b> </td>
                                                    <td style="border-top:5px solid #fff;background:#e0e0e0;color:#000;text-transform:uppercase">{{$data['nombre']}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="border-top:5px solid #fff;background:#333333;color:#fff;text-align:right"><b>EMAIL</b> </td>
                                                    <td style="border-top:5px solid #fff;background:#e0e0e0;color:#000;text-transform:uppercase;text-decoration:none !important">{{$data['email']}}</td>
                                                </tr>

                                                <tr>
                                                    <td style="border-top:5px solid #fff;background:#333333;color:#fff;text-align:right"><b>FECHA DE PAGO</b> </td>
                                                    <td style="border-top:5px solid #fff;background:#e0e0e0;color:#000;text-transform:uppercase">{{$data['fecha_pago']}}</td>
                                                </tr>
                                                
                                                @isset($medio_pago)
                                                 
                                                <tr>
                                                    <td style="border-top:5px solid #fff;background:#333333;color:#fff;text-align:right"><b>MEDIO DE PAGO</b> </td>
                                                    <td style="border-top:5px solid #fff;background:#e0e0e0;color:#000;text-transform:uppercase">{{$medio_pago}}</td>
                                                </tr>
                                                @endisset

                                                <tr>
                                                    <td style="border-top:5px solid #fff;background:#333333;color:#fff;text-align:right"><b>INFO. ADICIONAL</b> </td>
                                                    <td style="border-top:5px solid #fff;background:#e0e0e0;color:#000;text-transform:uppercase">{{ $data['info'] }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style="text-align:center;">
                                        <td style="padding:0 10px">
                                            <center>
                                                <table style="padding:10px; margin:0 auto; text-align:center;color:#444;font-family: Helvetica, Arial, sans-serif;font-weight:normal;width:100%;border-bottom:1px solid #333;border-top:1px solid #333;">
                                                    <tr>
                                                        <td>DETALLE DE COMPRA</td>
                                                    </tr>
                                                </table>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 10px;background:#fff">
                                            <table style="font-family: Helvetica, Arial;border:1px solid rgb(33, 33, 33);border-collapse:collapse;font-size:12px" width="100%" cellpadding="8" bgcolor="#fff">
                                                <thead>
                                                    <tr style="background:#e0e0e0">
                                                        <th style="border:1px solid #e0e0e0;">Imagen</th>
                                                        <th style="border:1px solid #e0e0e0;">Producto</th>
                                                        <th style="border:1px solid #e0e0e0;width:70px">Precio</th>
                                                        <th style="border:1px solid #e0e0e0;">Cantidad</th>
                                                        <th style="border:1px solid #e0e0e0;width:70px">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['productos_carrito'] as $products)
                                                    <tr>
                                                        @if(isset($products->attributes->image))
                                                        <td style="border:1px solid #ddd;" valign="top"><img src="{{asset($products->attributes->image)}}" width="50" height="60"></td>
                                                        @elseif(isset($products->image))
                                                        <td style="border:1px solid #ddd;" valign="top"><img src="{{asset($products->image)}}" width="50" height="60"></td>
                                                        @endif
                                                        <td style="border:1px solid #ddd;"><b>{{$products->name}}</b><br></td>
                                                        <td style="border:1px solid #ddd;text-align:right">{{number_format((float)$products->price, 2, '.', '')}}</td>
                                                        <td style="border:1px solid #ddd;text-align:right">{{$products->quantity}}</td>
                                                        <td style="border:1px solid #ddd;text-align:right">{{number_format((float)$products->quantity * $products->price, 2, '.', '')}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <table style="font-family: Helvetica, Arial;border:1px solid #e0e0e0;border-collapse:collapse;font-size:12px;margin-bottom:10px" width="100%" cellpadding="8" bgcolor="#fff">
                                                <tbody>
                                                    <tr>
                                                        <td style="border:1px solid #e0e0e0;text-align:right"><b>Subtotal:</b> </td>
                                                        <td style="border:1px solid #e0e0e0;text-align:right;width:70px">{{number_format((float)$data['subtotal_orden'],2, '.', '')}}</td>
                                                    </tr>
                                                     <tr>
                                                        <td style="border:1px solid #e0e0e0;text-align:right"><b>Cupón de descuento:</b> </td>
                                                        <td style="border:1px solid #e0e0e0;text-align:right;">{{$data['cupon_name']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #e0e0e0;text-align:right"><b>Descuento ({{$data['descuento_cupon']}}):</b> </td>
                                                        <td style="border:1px solid #e0e0e0;text-align:right">{{number_format((float)$data['descuento'],2, '.', '')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border:1px solid #e0e0e0;text-align:right"><b>Total:</b> </td>
                                                        <td style="border:1px solid #e0e0e0;text-align:right">{{number_format((float)$data['total_orden'],2, '.', '')}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br><br>
                                            Si usted pagó por <b>MercadoPago</b>, su orden se enviará al correo de dicha cuenta.
                                        </td>
                                    </tr>