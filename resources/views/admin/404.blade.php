@extends('admin.master')

@section('title', 'Página no Encontrada')

@section('content')

    <div class="content-wrapper">

        <div class="page-header row">

            <h3 class="page-title">
                Página No Encontrada
            </h3>

            <div class="template-demo mt-20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom"">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="colorfont"> <i class="fas fa-fw fa-home"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Página no Encontrada</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <div class="card">
                    
                    <div class="d-flex justify-content-center">
                        <div class="card-body text-center">
                            <h2 class="mt-4 mb-4">Lo Sentimos</h2>
                            <img class="img-fluid" src="{{asset('assets/images/404.png')}}" alt="Página No Encontrada" title="Página No Encontrada" style="width: 268px; height: auto; transition: all 0.25s ease 0s;" />
                            <p class="mt-4 mb-4" style="font-size:24px;">No hemos podido encontrar el contenido que estas buscando</p>
                            <a class="btn btn-dark btn-lg bradius mt-4" href="{{ url('/admin') }}">Volver al Inicio</a>
                        </div>
                    </div>

                </div>

            </div>


        </div>

    </div>

@endsection