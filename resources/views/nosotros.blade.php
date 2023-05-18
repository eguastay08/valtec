@extends('template')

@section('content')

    <div class="as-breadcrumb" aria-label="breadcrumb">
        <nav class="container-xxl">
            <ol class="breadcrumb as-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}" title="E-Shop">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Nosotros
                </li>
            </ol>
        </nav>
    </div>

    <div class="container-xxl container-fluid">

        <div class="row">

            <div class="col-10 offset-1">

                <p>Somos una empresa dedicada a la comercialización de productos de entretenimiento, de capital 100% peruano, con tiendas física en uno de los  principales puntos estratégicos en lima y con cobertura a nivel nacional mediante nuestra página web.</p>

                <p><strong>Visión de EShop Ecommerce Store:</strong></p>

                <p>Ser la plataforma retail de la industria del entretenimiento electrónico, coleccionables y afines a la cultura pop en el Perú, buscando generar valor en la experiencia de compra de nuestros clientes.</p>
                
                <p><strong>Misión de EShop Ecommerce Store:</strong></p>
                
                <p>Convertirnos en la marca líder en la industria del entretenimiento , coleccionables y afines a la cultura pop, llevando experiencias y servicio diferenciado al hogar de nuestros clientes.</p>

                <p><strong>Propósito:</strong></p>

                <p>Excelencia en el servicio en cada uno de los puntos de contacto entre EShop Ecommerce Store y sus clientes, buscando experiencias positivas de compra; sin perder de vista la rentabilidad del negocio que garantice la continuidad en el tiempo.</p>

            </div>

        </div>

    </div>

@endsection