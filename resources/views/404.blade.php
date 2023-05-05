@extends('template')


@section('content')


    <div class="as-breadcrumb" aria-label="breadcrumb">
        <nav class="container-xxl">
            <ol class="breadcrumb as-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}" title="E-Shop">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Página no encontrada
                </li>
            </ol>
        </nav>
    </div>

    <div class="container-xxl container-fluid">

        <div class="row">

            <div class="col">

                <h2 class="display-4">Lo Sentimos</h2>
                <p class="lead">No encontramos el contenido que estas buscando</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg bradius btn-principal btn-principal-style" href="{{url('/')}}">Volver al inicio</a>
                </p>

            </div>


        </div>

    </div>

@endsection