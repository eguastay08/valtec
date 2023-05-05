@extends('template')

@section('content')

@if(!isset($type))
    <script>window.location = "/";</script>
@endif

<div class="container-xxl container-fluid">

    <div class="row d-flex justify-content-center">
        
        <div class="col-12 pb-10">
            <h3 class="mt-4 text-center">COMPRA RÁPIDA</h3>
            <hr>
        </div>

        <div class="col-8">

            <div style="padding-right: 10px;padding-left: 10px;padding-bottom: 10px;padding-top: 15px;margin-bottom: 30px;">
                    
                @isset($type)
                    @if($type=="s")

                        <h3 class="text-center" style="color: #6dca00;"><i class="far fa fa-check-circle" style="font-size:100px;"></i></h3>
                        <h3 class="text-center" style="color: #6dca00; font-size:24px;">GRACIAS POR REALIZAR TU COMPRA</h3>
                        <p class="text-center" style="font-size:16px;">{{$mensaje_ok->valor}}<br>{{$horario_atencion->valor}}</p>

                    @elseif($type=="ca")

                    <h3 class="text-center" style="color: #0B94F;"><i class="fas fa-ban" style="font-size:100px;"></i></h3>
                    <h3 class="text-center" style="color: #0B94F; font-size:24px;">Cancelado</h3>
                    <p class="text-center" style="font-size:16px;">Se ha cancelado la compra, esperamos que vuelvas pronto</p>

                      
                    @elseif($type=="c")

                        <h3 class="text-center" style="color: #6dca00;"><i class="far fa fa-check-circle" style="font-size:100px;"></i></h3>
                        <h3 class="text-center" style="color: #6dca00; font-size:24px;">GRACIAS POR PONERTE EN CONTACTO CON NOSOTROS</h3>
                        <p class="text-center" style="font-size:16px;">Nos pondremos en contato contigo a la brevedad posible</p>

                    
                    @elseif($type=="f")

                        <h3 class="text-center" style="color: #ca0000;"><i class="fas fa-times-circle" style="font-size:100px;"></i></h3>
                        <h3 class="text-center" style="color: #ca0000; font-size:24px;">HUBO UN PROBLEMA</h3>
                        <p class="text-center" style="font-size:16px;">{{$mensaje_fail->valor}}</p>

                    @elseif($type=="p")

                        <h3 class="text-center" style="color: #EFC30F;"><i class="fas fa-exclamation-circle" style="font-size:100px;"></i></h3>
                        <h3 class="text-center" style="color: #EFC30F; font-size:24px;">AVISO IMPORTANTE</h3>
                        <p class="text-center" style="font-size:16px;">{{$mensaje_pending->valor}}</p>

                    @endif
                @endisset

                <div class="text-center" style="margin-top:25px;">
                    <a href="{{url('/')}}" class="btn btn-round btn-dark bradius"><i class="fa fa-home"></i> Ir al inicio</a>
                </div> 

            </div>

        </div>
        
    </div>

</div>

@endsection

