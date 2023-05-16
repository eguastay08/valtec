@extends('template')

@section('content')

    <div class="as-breadcrumb" aria-label="breadcrumb">
        <nav class="container-xxl">
            <ol class="breadcrumb as-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/')}}" title="E-Shop">Inicio</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                   Producto
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    {{$producto['producto']}}
                </li>
            </ol>
        </nav>
    </div>

    <div class="container-xxl container-fluid as-product">
        @php $encryptProductoId=Hashids::encode($producto['producto_id']); @endphp
       

        <div class="row">

            <div class="col-md-6 col-12">
                <div class="row">
                    <section class="col-12">
                            <!-- <div class="slider-for"> -->
                        <div class="slider-for">
                            <picture>
                                <img id="productimage" class="img-fluid" src="{{ asset($producto['imgproducto']) }}?w=400" data-zoom="{{ asset($producto['imgproducto']) }}?w=1200" />    
                            </picture>
                            @foreach($producto['imagenes'] as $pimg)
                            <picture>
                                <img id="productimage" class="img-fluid" src="{{ asset($pimg->url) }}?w=400" data-zoom="{{ asset($pimg->url) }}?w=800" />    
                            </picture>
                              
                            @endforeach

                        </div>

                        <div class="slider-nav-thumbnails slider-nav-style mt-3" id="product-gallery">

                            <picture class="picture-thumbnail">
                                <img class="img-fluid img-thumbnail" src="{{ asset($producto['imgproducto']) }}" />
                            </picture>
                             
                            @if(count($producto['imagenes'])>0)
                                  
                                  @php $si = 1 @endphp
                                  @foreach($producto['imagenes'] as $proimg)
                                    <picture class="picture-thumbnail">
                                        <img class="img-fluid img-thumbnail" src="{{ asset($proimg->url) }}" />
                                    </picture>
                                      @php $si++ @endphp
                                  @endforeach
                                  
                              @endif

                        </div>

                    
                            <!-- </div> -->
                    </section>
                </div>
            </div>

            <div class="col-md-6 col-12">

                <article class="mt-3">

                    <h1 class="as-producto_title">{{ $producto['producto'] }}</h1>
                                                                                                          
                    @if($producto['sku']!="")
                        <p>SKU: {{$producto['sku']}}</p>
                    @endif

                    <div class="product-stock mb-2"> 
                        @if($producto['agotado'] == 0)
                            <span class="badge bg-success mb-2">Disponible</span>
                        @else 
                            <span class="badge bg-danger mb-2">Agotado</span>
                        @endif
                    </div>

                    <div class="product-single__description rte">
                        {!! $producto['descripcion_producto'] !!}
                    </div>

                    <h4>Categorias:</h4>

                    <ul class="category-products mb-3">
                        @if(count($producto['categorias'])>0)
                            @foreach($producto['categorias'] as $kv => $pca)
                                <li><a href="{{url('categorias/'.$pca->url)}}">{{$pca->categoria}}</a></li>
                            @endforeach
                        @endif
                    </ul>                  
                            
                </article>

                @if($producto['con_stock'] == 0)

                    <div class="pay-way d-flex justify-content-center mt-4">

                        <div class="dv-payway d-flex align-items-center bdv-settings p-3">
                            <img src="{{ asset('assets/images/digital-formato.png') }}" alt="Entrega a Domicilio" width="80" height="60">
                            <div><p>Formato Digital</p></div>
                        </div>

                    </div>

                @else 

                    <div class="row mt-4">

                        @if($producto['envio_domicilio'] == 1)

                            <div class="col-md-4 col-12 pay-way">

                                <div class="dv-payway d-flex align-items-center bdv-settings p-3">
                                    <img src="{{ asset('assets/images/delivery-truck.png') }}" alt="Entrega a Domicilio" width="64" height="55">
                                    <div><p>Despacho a Domicilio</p><p class="text-center" style="color:green; font-size:12px !important;">Disponible</p></div>
                                </div>
                                
                            </div>

                        @endif

                        @if($producto['recojo'] == 1)

                            <div class="col-md-4 col-12 pay-way">

                                <div class="dv-payway d-flex align-items-center bdv-settings p-3">
                                    <img src="{{ asset('assets/images/shop.png') }}" alt="Retiro en Tienda" width="64" height="55">
                                    <div><p>Retiro en Tienda</p><p class="text-center" style="color:green; font-size:12px !important;">Disponible</p></div>
                                </div>

                            </div>

                        @endif


                        @if($producto['contraentrega'] == 1)

                            <div class="col-md-4 col-12 pay-way">

                                <div class="dv-payway d-flex align-items-center bdv-settings p-3">
                                    <img src="{{ asset('assets/images/contraentrega.png') }}" alt="Pago ContraEntrega" width="64" height="55">
                                    <div><p>Pago ContraEntrega</p><p class="text-center" style="color:green; font-size:12px !important;">Disponible</p></div>
                                </div>

                            </div>

                        @endif

                    </div>
                

                @endif

                <div class="card card-product-price mx-34 mt-4">

                    <div class="card-header">
                        <h5 class="card-title text-center fw-bold">Medios de Pago</h5>
                    </div>

                    <div class="card-body" style="padding-left:25px !important; padding-right:25px !important;">
                        @if(count($mediosPago)>0)

                            @foreach($mediosPago as $mp)
                                <img src="{{asset($mp['imagen'])}}" alt="" style="height: 40px;margin: 4px;">
                            @endforeach

                        @endif

                        <div class="precios_div">
                            @if($producto['descuento']>0)
                                @php $dif = strtotime($producto['fecha_finalizacion']); @endphp
                            @endif
                            @include('front-partials.precio_oferta-front')
                        </div>

                    </div>

                </div>

            </div>

        </div>

        @if($producto['video'] != "")
        
            <div class="row d-flex justify-content-center mt-4">

                <div class="col-lg-7 col-md-y6 col-12"> 
                    <div class="product-video">
                        {!! $producto['video'] !!}
                    </div>
                </div>

            </div>

        @endif

        @if(count($productos_relacionados) > 0)

            <div class="row mt-4">
                <div class="col">
                    <h3 class="underline pt-10 pb-10 mb-20 text-center">También te puede Interesar</h3>
                </div>
            </div>

            <div class="row mt-4">

                @php $monedaactiva = $moneda[0]['prefijo']; @endphp
            
                @foreach($productos_relacionados as $producto_relacionado)

                    <?php $encryptProductRelacionado=Hashids::encode($producto_relacionado['producto_id']);?> 

                    <div class="col-md-c6 col-sm-c4 col-6 mt-3">

                        <div class="grid-producto h-100 d-flex flex-column">

                            <div class="product-image">

                                <a href="{{ url('producto/'.$producto_relacionado['url']) }}" class="text-decoration-none">

                                    <!-- Imagen Producto -->
                                    <img class="img-fluid" data-src="{{asset($producto_relacionado['imgproducto'])}}" src="{{asset($producto_relacionado['imgproducto'])}}" alt="Imagen Producto" title="{{$producto_relacionado['producto']}}">
                                    <!-- Fin Imagen Producto -->

                                    <!-- Descuento producto -->
                                    @if($producto_relacionado['descuento'] > 0)
                                        <div class="descuento-tag rounded"><span class="lbl-discount"><p>-{{$producto_relacionado['descuento']}}%</p></span></div>
                                    @endif
                                    <!-- Fin Descuento Producto -->

                                </a>

                            </div>

                            <div class="product-title mb-2">
                                <!-- product name -->
                                <a href="{{ url('producto/'.$producto_relacionado['url']) }}" class="grid-producto-nombre mt-auto" title="{{$producto_relacionado['producto']}}">
                                    <h3 class="grid-producto-title">{{$producto_relacionado['producto']}}</h3>
                                </a>
                                <!-- End product name -->
                            </div>

                            <div class="product-details text-center mt-auto">
                                <!-- product price -->
                                <div class="text-center product-price">
                                    @if($producto_relacionado['precio_oferta']!= '0.00')
                                        <div class="old-price">{{$moneda[0]['prefijo'].' '.$producto_relacionado['precio']}}</div>
                                        <div class="price">{{$moneda[0]['prefijo'].' '.$producto_relacionado['precio_oferta']}}</div>
                                    @else 
                                        <div class="price">{{$moneda[0]['prefijo'].' '.$producto_relacionado['precio']}}</div>
                                    @endif
                                </div>
                                <!-- End product price -->
                                <!-- Color Variant -->

                                @if($producto_relacionado['agotado']==0)

                                    <div class="text-center" style="padding: 0 2px !important;">
                                        <a href="{{ url('producto/'.$producto_relacionado['url']) }}" class="btn btn-addto-cart btn-shop btn-block border-button style-btn-comprar" type="button" tabindex="0"><i class="fas fa-shopping-cart"></i> Comprar</a>
                                    </div>

                                @else 
                                    <div class="text-center" style="padding: 0 2px !important;">
                                        <span class="btn label-agotado btn-block" style="margin-top: 1px; margin-bottom: 1px; font-size:13px; padding-top:5px; padding-bottom: 5px;"><i class="fas fa-exclamation-circle"></i> Agotado</span>
                                    </div>
                                
                                
                                @endif

                                <div class="detalles-product mt-2" style="padding-left:15px !important; padding-right:15px !important;">
                                    <a type="button" class="btn-styledetalles"  onclick="MostrarDetalleProductsG(<?php echo "'".$encryptProductRelacionado."'"; ?>, '{{asset($producto_relacionado['imgproducto'])}}')"><i class="fas fa-search"></i> Ver detalles</a>                                    
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>

                    </div>

                @endforeach

            
            </div>

        @endif
    </div>

@endsection

@section('scripts')


<!-- <script src="{{ asset('assets/vendor/elevatezoom/jquery.elevateZoom.min.js') }}"></script> -->
<script src="{{ asset('assets/vendor/drift-main/dist/Drift.min.js') }}"></script>
<script src="{{ asset('assets/vendor/flipdown-master/src/flipdown.js') }}"></script>

<script>
    @if($producto['descuento']>0)
        // Set up FlipDown -- recibe la fecha fin en segundos.
        var flipdown = new FlipDown(<?php echo $dif; ?>, {headings: ["Días", "Horas", "Minutos", "Segundos"],})

        // Start the countdown
        .start()

        // Do something when the countdown ends
        .ifEnded(() => {
            url=$('meta[name=app-url]').attr("content") + "/producto/precio_oferta";
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "POST",
                    data: {
                        data_producto: <?php echo '"'.$encryptProductoId.'"'; ?>
                    },
                    success: function(response) {
                        // console.log(response);
                        $('.precios_div').html(response);
                    }
            });
            console.log('The countdown has ended!');
        });
    @endif

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        asNavFor: '.slider-nav-thumbnails'
    });
    
    $('.slider-nav-thumbnails').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: false,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }

            ]
    });

    // var options = {
    //     paneContainer: document.querySelector(".slider-for"),
    //     hoverDelay: 2,
    //     sourceAttribute: 'data-zoom',
    //     zoomFactor: 2,
    //     handleTouch: true,
    //     inlinePane: 900,
    //     inlineOffsetX: 0,
	//     inlineOffsetY: 0,
    //     containInline: false, 
    // }

    // new Drift(document.querySelector("#productimage"), options );

    let DrifAllImg = document.querySelectorAll('#productimage');
    let pane = document.querySelector(".slider-for");

    $(DrifAllImg).each(function(i, el){
        let drift = new Drift(
        el, {
            zoomFactor: 1.8,
            paneContainer: pane,
            inlinePane: false,
            handleTouch: false,
            showCloseButton: false,
            showWhitespaceAtEdges: false,
            hoverDelay: 80,
            hoverBoundingBox: false,
            appendToSelector: null,
        }
        );
    })

    window.MostrarDetalleProductsG = function(producto, img)
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

    
    // $("#getting-started").countdown('2023/05/15', function(event) {
    //     $(this).text(
    //     event.strftime('%D Días %H:%M:%S')
    //     );
    // });

    // $('#getting-started').countdown({
    //     targetDate: {
    //         'day':         13,
    //         'month':     5,
    //         'year':     2023,
    //         'hour':     15,
    //         'min':         14,
    //         'sec':         0
    //     },
    //     omitWeeks: true,
    //     onComplete: function() {
    //        alert('FIN DE LA CUENTA');
    //     }
    // });


</script>

@endsection