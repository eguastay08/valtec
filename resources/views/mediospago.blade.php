@extends('template')

@section('content')

<div class="as-breadcrumb" aria-label="breadcrumb">
    <nav class="container-xxl">
        <ol class="breadcrumb as-breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}" title="E-Shop">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Medios de Pago
            </li>
        </ol>
    </nav>
</div>

<div class="container-xxl container-fluid">

    <div class="row">

        <div class="col-10 offset-1">
            <h3 class="text-center mt-2 pb-10 mb-20 mx-5">MEDIOS DE PAGO</h3>
            <hr>

            <div id="accordionMediosdePago" class="accordion mt-4">

                @isset($mediosPago)
                    @if(count($mediosPago)>0)

                        @php $contador = 0 @endphp
                        @foreach($mediosPago as $mp)
                            @php $contador = $contador + 1 @endphp
                            @if($mp->transferencia == 1)

                                @if($contador == 1)
                                    <div class="col-12 text-center mb-2"><h5><i class="fas fa-exchange-alt"></i> TRANSFERENCIA BANCARIA</h5></div>
                                @endif

                                <div id="mediopagodiv{{$contador}}" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv" data-color="#000" onclick="mostrarinfo({{$contador}});">
                                    <div style="overflow: hidden;" class="d-flex">
                                        <div class="payment-image pull-left">
                                            <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                        </div>
                                        <div class="pull-left payment-text">
                                            <!-- {$medio_pago[$i]['nombre']} {if $medio_pago[$i]['informacion_adicional']} - {$medio_pago[$i]['informacion_adicional']}{/if} <span>({'subtitulo_transferencias_pago'|text:$texts})</span> -->
                                            {{$mp->nombre}} (Transferencias Bancarias)
                                        </div>  
                                    </div>
                                    <div id="details{{$contador}}" class="details-pago payment-details mt-4 mb-4" style="display:none;">
                                      {!!$mp->descripcion!!}
                                    </div>
                                </div>

                            @endif
                        @endforeach

                        @php $contador2 = 0 @endphp
                            @foreach($mediosPago as $mp)
                                
                                @if($mp->deposito == 1)
                                @php $contador2 = $contador2 + 1 @endphp
                                    @if($contador2 == 1)
                                        <div class="col-12 text-center mt-4 mb-2"><h5><i class="far fa-money-bill-alt"></i> DEPÓSITO BANCARIO</h5></div>
                                    @endif
                                        <div id="mediopagodivdeposito{{$contador2}}" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv2" data-color="#000" onclick="mostrarinfodeposito({{$contador2}});">
                                            <div style="overflow: hidden;" class="d-flex">
                                                <div class="payment-image pull-left">
                                                    <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                                </div>
                                                <div class="pull-left payment-text">
                                                    <!-- {$medio_pago[$i]['nombre']} {if $medio_pago[$i]['informacion_adicional']} - {$medio_pago[$i]['informacion_adicional']}{/if} <span>({'subtitulo_transferencias_pago'|text:$texts})</span> -->
                                                    {{$mp->nombre}} (Depósito Bancario)
                                                </div>
                                            </div>
                                            <div id="detailstdeposito{{$contador2}}" class="details-pago2 payment-details mt-4 mb-4" style="display:none">
                                            {!!$mp->descripcion!!}
                                            </div>
                                        </div>
                            
                                @endif

                            @endforeach

                    @endif
                @endisset

                <div class="col-12 text-center mt-3 mb-2">
                    <h5><i class="fas fa-credit-card"></i> PAGOS ONLINE</h5>
                </div>
                <div id="mediopagoonline" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv3" onclick="pagoonlinedetalle();">
                    <div style="overflow: hidden;" class="d-flex">
                        <div class="payment-image pull-left">
                            <img src="{{asset('assets/images/medios_pago_online/paypal.png')}}" style="height: 100%">
                        </div>
                        <div class="pull-left payment-text">
                            Paypal (Pagos Online)
                        </div>
                        <div id="detailstonline" class="details-pago3 payment-details mt-4 mb-4" style="display:none">
                            <br>
                            <ol>
                                <li> - El pedido se enviara al correo registrado en su cuenta paypal y dentro de nuestro horario de atención.</li>
                                <li> - Horario de atencion : De L - S de 10am a 8pm - Los Pedidos del Domingo se envian el dia Lunes.</li>
                                <li> - Cargo adicional 10%.</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>

        window.mostrarinfo = function(value)
        {
            // console.log(value);
            $('.details-pago').css('display','none');
            $('#details'+value).css('display','block');
            $('.mediopagodiv').removeClass('border-medio');
            $('#mediopagodiv'+value).addClass('border-medio');
        }

        window.mostrarinfodeposito = function(value)
        {
            $('.details-pago2').css('display','none');
            $('#detailstdeposito'+value).css('display','block');
            $('.mediopagodiv').removeClass('border-medio');
            $('#mediopagodivdeposito'+value).addClass('border-medio');
        }

        window.pagoonlinedetalle = function()
        {
            $('.details-pago3').css('display','none');
            $('#detailstonline').css('display','block');
            $('.mediopagodiv3').removeClass('border-medio');
            $('#mediopagoonline').addClass('border-medio');
        }

    // $('.mediopagodiv').mouseover(function() {
    //     let value = $(this).attr("data-count");
    //     $('.details-pago').css('display','none');
    //     $('#details'+value).css('display','block');
    //     $('.mediopagodiv').removeClass('border-medio');
    //     $(this).addClass('border-medio');
        
    // });

    // $('.mediopagodiv2').mouseover(function() {
    //     let value = $(this).attr("data-count");
    //     $('.details-pago2').css('display','none');
    //     $('#detailst'+value).css('display','block');
    //     $('.mediopagodiv2').removeClass('border-medio');
    //     $(this).addClass('border-medio');
        
    // });

</script>


@endsection