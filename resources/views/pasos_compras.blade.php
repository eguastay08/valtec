@extends('template')

@section('content')

    <div class="as-breadcrumb" aria-label="breadcrumb">
        <nav class="container-xxl">
            <ol class="breadcrumb as-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}" title="E-Shop">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                   Pasos de Compra
                </li>
            </ol>
        </nav>
    </div>

    <div class="container-xxl container-fluid">

        <div class="row">

            <div class="col-10 offset-1">

                <p>Puedes comprar tus productos donde te encuentres, utilizando una computadora o dispositivo móvil a través de EShop Ecommerce
                Para poder realizar una compra online de los productos de tu preferencia, no es necesario tener una cuenta con nosotros.</p>

                <p>Tendrás dos opciones para recibir tu pedido: recojo en tienda (sin ningún costo) o envío a domicilio (con costo adicional)
        Luego se procede a elegir el medio de pago. Para ello trabajamos con VISA, MASTERCARD, YAPE, MERCADO PAGO, PLIN.
            En tu cuenta, podrás darle seguimiento a tus pedidos. Si tienes alguna consulta o reclamo de tu pedido, puedes comunicarte a eshop.store@gmail.com  o al +51 999999999</p>

            </div>

        </div>

    </div>

@endsection