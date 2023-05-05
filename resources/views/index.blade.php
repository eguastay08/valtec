@extends('template')

@section('content')

    @php $monedaactiva = $moneda[0]['prefijo']; @endphp

    <div class="container-fluid container-xxl">

        @isset($sliders)

            @if(count($sliders)>0)

                <div class="slider-main">

                    @foreach($sliders as $sl)
                        <div class="slider-item">
                            <img class="img-fluid d-block w-100" src="{{asset($sl->url)}}" title="{{asset($sl->nombre_img)}}">
                        </div>
                    @endforeach
            
                </div>

            @endif

        @endisset

        @isset($bloques)

            @if(count($bloques)>0)

                @foreach($bloques as $bloque) 

                    <!-- Bloque para Banners -->
                    @if($bloque['codigo'] == "BANNERS")
                        
                        
                        @include('front-partials.banners-front',  ['banners' => $bloque['data']['banners']])

                    
                    @endif

                    <!-- Fin Bloque para Banners -->

                    <!-- Bloque para Carrousel de Productos -->

                    @if($bloque['codigo'] == "CARROUSEL")

                            @if(count($bloque['data']['productos'])>0)

                                <div class="title-bloque d-flex justify-content-center align-items-center">

                                    @if($bloque['icono']!="")
    
                                        <img src="{{asset($bloque['icono'])}}" style="height: 34px; margin-right: 10px;">

                                    @endif

                                    {{ $bloque['titulo'] }}
                                    <div class="line-style"></div>
                                    <div class="button-row">
                                        <a href="{{asset($bloque['data']['url'])}}" class="btn btn-ver-todo border-button"><i class="fas fa-eye"></i> Ver Todo</a>
                                    </div>

                                </div>

                                @if($bloque['data']['productos'])
                                    @include('front-partials.products-front',  ['productos' => $bloque['data']['productos'], 'carrousel' => 1])
                                @endif

                            @endif  

                    @endif

                    <!-- Fin Bloque para Carrousel de Productos -->

                    <!-- BLoque para rows productos -->


                    @if($bloque['codigo'] == "PRODUCTS")

                        @if(count($bloque['data']['productos'])>0)

                            <div class="title-bloque d-flex justify-content-center align-items-center">

                                @if($bloque['icono']!="")

                                    <img src="{{asset($bloque['icono'])}}" style="height: 34px; margin-right: 10px;">

                                @endif

                                {{ $bloque['titulo'] }}
                                <div class="line-style"></div>
                                <div class="button-row">
                                    <a href="{{asset($bloque['data']['url'])}}" class="btn btn-ver-todo border-button fw-bold"><i class="fas fa-eye"></i> Ver Todo</a>
                                </div>

                            </div>

                        
                            @if($bloque['data']['productos'])
                                @include('front-partials.products-front',  ['productos' => $bloque['data']['productos'], 'carrousel' => 0])
                            @endif
                        

                        @endif
                        

                    @endif

                    <!-- Fin de bloque para productos -->

                    @if($bloque['codigo'] == "NOTICIAS")

                        @if(count($bloque['data']['noticias'])>0)

                            
                            <div class="title-bloque d-flex justify-content-center align-items-center">

                                @if($bloque['icono']!="")

                                    <img src="{{asset($bloque['icono'])}}" style="height: 34px; margin-right: 10px;">

                                @endif

                                NOTICIAS

                                <div class="line-style"></div>
                                <div class="button-row">
                                    <a href="{{url('noticias')}}" class="btn btn-ver-todo border-button fw-bold"><i class="fas fa-eye"></i> Ver Todo</a>
                                </div>

                            </div>

                            @if($bloque['data']['noticias'])
                                @include('front-partials.noticias-front',  ['noticias' => $bloque['data']['noticias']])
                            @endif


                        @endif

                    @endif

                @endforeach

            @endif

        @endisset

        @include('front-partials.suscribirse-front')

    </section>

@endsection

@section('scripts')

<script>

    $(document).ready(function(){

        $(".owl-carousel").owlCarousel({
            items: 6,
            margin: 10,
            loop: true,
            smartSpeed: 250,
            nav: true,
            dots:false,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3500,
            autoplayHoverPause:true,
            responsive:{
                0: {
                    items: 2,
                    nav:true,
                    loop:true
                },
                420:
                {
                    items: 2,
                    nav:true,
                    loop:true
                },
                600:{
                    items:3,
                    nav:true,
                    loop:true
                },
                768: {
                items: 4,
                nav:true,
                loop:true
                },
                1024: {
                items: 6,
                nav:true,
                loop:true
                },
                1100: {
                items: 6,
                nav:true,
                loop:true
                }		
            }

        });

        $('.btn-suscripcion-form').click(function() {
            let email_suscripcion = $('#email_suscripcion').val();
            const url=$('meta[name=app-url]').attr("content") + "/suscripcion";
            let data =  {
                email_suscripcion:email_suscripcion
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#btnpagar").prop('disabled', false);
                    if(response.code == "200")
                    {   
                        alertify.alert('<h2><center>GRACIAS, HEMOS RECIBIDO SU INFORMACIÓN CORRECTAMENTE.!!!</center> </h2>')
                            .set('title', 'Aviso').set('closable', true); 
                        $('#email_suscripcion').val("");
                    }
                    
                    else if(response.code == "422")
                    {
                        let errors = response.errors;
                        let listvalidation = '';
                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                listvalidation += '<li>' + value + '</li>';
                            }

                        }); 

                        alertify.alert('<ul>'+listvalidation+'</ul>')
                            .set('title', 'Importante').set('closable', true); 
                        // $('.alertify-message').append($.parseHTML('<whatever><html><you><want>'));
                    }
                 
                }
            });
        });

        window.MostrarDetalleProducto = function(producto, img)
        {
            $('#content_quickview').modal('show');
            url=$('meta[name=app-url]').attr("content") + "/producto/detalle/" +producto;
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                // console.log(img);
                let moneda = '{{ $monedaactiva }}';
                $('#productdetalletitle').html(data.producto);
                $('#imgdetalleProducto').attr('src', img);
                $('#descripcion_productoDetalle').html("");
                $('#descripcion_productoDetalle').html(data.descripcion_producto);
                if(data.precio_oferta != '0.00')
                {
                  $('#precios_producto_detalle').html("");
                  $('#precios_producto_detalle').html('<span class="visually-hidden">Precio</span>'+
                                                        '<s id="ComparePrice-product-template"><span class="money" style="color:red;">'+moneda+' '+data.precio+'</span></s><br>'+
                                                        '<span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single"><span id="ProductPrice-product-template"><span class="money" style="color:black;">'+moneda+' '+data.precio_oferta+'</span></span></span>');  
                }
                else 
                {
                    $('#precios_producto_detalle').html("");
                    $('#precios_producto_detalle').html('<span class="visually-hidden">Precio</span>'+
                                                        '<span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single"><span id="ProductPrice-product-template"><span class="money" style="color:black;">'+moneda+' '+data.precio+'</span></span></span>');  
                }

                
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }

    });


</script>

@endsection