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
                          
                            @if($mp->billetera_digital == 1)

                                @php $contador = $contador + 1 @endphp

                                @if($contador == 1)
                                    <div class="col-12 text-center mb-2"><h5><i class="fas fa-wallet"></i> BILLETERAS DIGITAL</h5></div>
                                @endif

                                <div id="mediopagodiv{{$contador}}" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv" data-color="#000" onclick="mostrarinfo({{$contador}});">
                                    <div style="overflow: hidden;" class="d-flex">
                                        <div class="payment-image pull-left">
                                            <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                        </div>
                                        <div class="pull-left payment-text">
                                            {{$mp->nombre}} (Billetera Digital)
                                        </div>  
                                    </div>
                                    <div id="details{{$contador}}" class="details-pago payment-details mt-4 mb-4 p-4" style="display:none;">
                                      {!!$mp->descripcion!!}
                                    </div>
                                </div>

                            @endif

                           

                        @endforeach

                        @php $contador2 = 0 @endphp

                        @foreach($mediosPago as $mp)
                            
                            @if($mp->transferencia == 1)
                                @php $contador2 = $contador2 + 1 @endphp
                                @if($contador2 == 1)
                                    <div class="col-12 text-center mt-4 mb-2"><h5><i class="fas fa-exchange-alt"></i> TRANSFERENCIAS BANCARIOS</h5></div>
                                @endif
                                <div id="mediopagodivdeposito{{$contador2}}" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv2" data-color="#000" onclick="mostrarInfoTransfer({{$contador2}});">
                                    <div style="overflow: hidden;" class="d-flex">
                                        <div class="payment-image pull-left">
                                            <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                        </div>
                                        <div class="pull-left payment-text">
                                            {{$mp->nombre}} (Transferencia Bancaria)
                                        </div>
                                    </div>
                                    <div id="detailsTransfer{{$contador2}}" class="details-pago2 payment-details mt-4 mb-4 p-4" style="display:none">
                                    {!!$mp->descripcion!!}
                                    </div>
                                </div>
                        
                            @endif

                        @endforeach

                        @php $contador3 = 0 @endphp

                        @foreach($mediosPago as $mp)
                            
                            @if($mp->deposito == 1)
                                @php $contador3 = $contador3 + 1 @endphp
                                @if($contador3 == 1)
                                    <div class="col-12 text-center mt-4 mb-2"><h5><i class="far fa-money-bill-alt"></i> DEPÓSITOS BANCARIOS</h5></div>
                                @endif
                                <div id="mediopagodivdeposito{{$contador3}}" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv2" data-color="#000" onclick="mostrarinfodeposito({{$contador3}});">
                                    <div style="overflow: hidden;" class="d-flex">
                                        <div class="payment-image pull-left">
                                            <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                        </div>
                                        <div class="pull-left payment-text">
                                            {{$mp->nombre}} (Depósito Bancario)
                                        </div>
                                    </div>
                                    <div id="detailstdeposito{{$contador3}}" class="details-pago3 payment-details mt-4 mb-4 p-4" style="display:none">
                                    {!!$mp->descripcion!!}
                                    </div>
                                </div>
                        
                            @endif

                        @endforeach

                        @php $contador4 = 0 @endphp

                        @foreach($mediosPago as $mp)
                            
                            @if($mp->pago_online == 1)
                                @php $contador4 = $contador4 + 1 @endphp
                                @if($contador4 == 1)
                                    <div class="col-12 text-center mt-4 mb-2"><h5><i class="fas fa-credit-card"></i>  PAGOS ONLINE</h5></div>
                                @endif
                                <div id="mediopagodivdeposito{{$contador4}}" style="cursor:pointer" class="col-12 list-group-item payment-link mediopagodiv2" data-color="#000" onclick="mostrarInfoPagoOnline({{$contador4}});">
                                    <div style="overflow: hidden;" class="d-flex">
                                        <div class="payment-image pull-left">
                                            <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                        </div>
                                        <div class="pull-left payment-text">
                                            {{$mp->nombre}} (Pago Online)
                                        </div>
                                    </div>
                                    <div id="detailsPagoOnline{{$contador4}}" class="details-pago4 payment-details mt-4 mb-4 p-4" style="display:none">
                                    {!!$mp->descripcion!!}
                                    </div>
                                </div>

                            @endif

                        @endforeach


                    @endif
                @endisset

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
            $('.payment-details').css('display','none');
            $('#details'+value).css('display','block');
            $('.mediopagodiv').removeClass('border-medio');
            $('#mediopagodiv'+value).addClass('border-medio');
        }

        window.mostrarInfoTransfer = function(value)
        {
            $('.details-pago2').css('display','none');
            $('.payment-details').css('display','none');
            $('#detailsTransfer'+value).css('display','block');
            $('.mediopagodiv').removeClass('border-medio');
            $('#mediopagodiv'+value).addClass('border-medio');
        }

        window.mostrarinfodeposito = function(value)
        {
            $('.details-pago3').css('display','none');
            $('.payment-details').css('display','none');
            $('#detailstdeposito'+value).css('display','block');
            $('.mediopagodiv').removeClass('border-medio');
            $('#mediopagodivdeposito'+value).addClass('border-medio');
        }

        window.mostrarInfoPagoOnline = function(value)
        {
            $('.details-pago4').css('display','none');
            $('.payment-details').css('display','none');
            $('#detailsPagoOnline'+value).css('display','block');
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


</script>


@endsection