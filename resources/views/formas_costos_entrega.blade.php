@extends('template')

@section('content')

<div class="as-breadcrumb" aria-label="breadcrumb">
    <nav class="container-xxl">
        <ol class="breadcrumb as-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" title="E-Shop">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Formas y costos de entrega
            </li>
        </ol>
    </nav>
</div>

<div class="container-xxl container-fluid">

    <div class="row">

        <div class="col-10 offset-1">

            <div class="accordion" id="accordionFormasCostoEntrega">

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Recojo en Tienda
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFormasCostoEntrega">
                    <div class="accordion-body">

                        <p>Ubicación: Av. Prueba prueba Test mundo nunca jamás </p> 

                        <p>Referencia: Frente a la Municipalidad Provincial</p>

                        <p>Horario: Lunes a Sábados de 11:00 am a 8:00 pm</p>

                        <p>Google maps : https://www.google.com/maps/@-12.0463012,-77.0478524,13.61z</p>

                        <p>Waze : Eshop Ecommerce</p>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Envío Regular
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFormasCostoEntrega">
                    <div class="accordion-body">

                        <p>Ubicación: Av. Prueba prueba Test mundo nunca jamás </p> 

                        <p>Referencia: Cruce de av. Gamarra con av. Republica de Francia.</p>

                        <p>Horario: Lunes a Sábados de 12:00 am a 4:00 pm </p>

                        <p>Google maps : https://www.google.com/maps/@-12.0463012,-77.0478524,13.61z</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Envío Express
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFormasCostoEntrega">
                    <div class="accordion-body">
                        <p>Ubicación: Av. Prueba prueba Test mundo nunca jamás</p>

                        <p>Referencia: Cruce de av. San Martin con av. Republica de Italia.</p>

                        <p>Horario: Lunes a Sábados de 12:00 am a 4:00 pm </p>

                        <p>Google maps : https://www.google.com/maps/@-12.0463012,-77.0478524,13.61z</p>
                    </div>
                </div>
            </div>

            </div>

        </div>

    </div>

</div>

@endsection