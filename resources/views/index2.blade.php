@extends('template')


@section('content')

    @isset($sliders)
   	<!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section">
        <div class="home-slideshow">

            @if(count($sliders)>0)
                @foreach($sliders as $sl)
                    <div class="slide">
                        <div class="blur-up lazyload style-div-slider">
                            <a href="{{$sl->link}}" target="_blank" class="bri-banner"><img class="blur-up lazyload" data-src="{{asset($sl->url)}}" src="{{asset($sl->url)}}" alt="Belle Best Selling" title="Belle Best Selling"/></a>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- <img class="blur-up lazyload" data-src="assets/images/slideshow-banners/home4-banner.jpg" src="assets/images/slideshow-banners/home4-banner.jpg" alt="Belle Best Selling" title="Belle Best Selling" />
            <div class="slideshow__text-wrap slideshow__overlay classic middle">
                <div class="slideshow__text-content middle">
                    <div class="wrap-caption center">
                        <h2 class="h1 mega-title slideshow__title">Belle Best Selling</h2>
                        <span class="mega-subtitle slideshow__subtitle">Unique products by the world's top  designer</span>
                        <span class="btn">Explore now</span>
                    </div>
                </div>
            </div> -->
            
        </div>
    </div>
    <!--End Home slider-->
    @endisset

    @isset($bloques)

        @if(count($bloques)>0)

            @foreach($bloques as $bloque)
                
                @if($bloque['codigo'] == "BANNERS")
                
                    <div class="container-fluid pt-15 pb-15">

                        @include('front-partials.banners-front',  ['banners' => $bloque['data']['banners']])

                    </div>

                @endif

                @if($bloque['codigo'] == "CARROUSEL")

                    @if(count($bloque['data']['productos'])>0)

                        <div class="container-fluid pt-15 pb-15 mt-4">

                            <div class="title-row">

                                @if($bloque['icono']!="")

                                    <img src="{{asset($bloque['icono'])}}" style="height: 34px;margin-right: 10px;">

                                @endif

                                {{ $bloque['titulo'] }}
                                <div class="line-style"></div>
                                <div class="button-row">
                                    <a href="{{asset($bloque['data']['url'])}}" class="btn btn-more-title btn-ver-todo"><i class="fas fa-eye"></i> Ver Todo</a>
                                </div>

                            </div>
                           
                            <div class="section" style="padding-top:0 !important;"> 

                                @if($bloque['data']['productos'])
                                    @include('front-partials.products-front',  ['productos' => $bloque['data']['productos'], 'carrousel' => 1])
                                @endif

                            </div>

                        </div>

                    @endif  

                @endif

                @if($bloque['codigo'] == "PRODUCTS")

                    @if(count($bloque['data']['productos'])>0)

                        <div class="container-fluid pt-15 pb-15 mt-4">

                            <div class="title-row">

                                @if($bloque['icono']!="")

                                    <img src="{{asset($bloque['icono'])}}" style="height: 34px;margin-right: 10px;">

                                @endif

                                {{ $bloque['titulo'] }}
                                <div class="line-style"></div>
                                <div class="button-row">
                                    <a href="{{asset($bloque['data']['url'])}}" class="btn btn-more-title btn-ver-todo"><i class="fas fa-eye"></i> Ver Todo</a>
                                </div>

                            </div>

                            <div class="section" style="padding-top:0 !important;"> 

                                @if($bloque['data']['productos'])
                                    @include('front-partials.products-front',  ['productos' => $bloque['data']['productos'], 'carrousel' => 0])
                                @endif

                            </div>

                        </div>

                    @endif

                @endif

                @if($bloque['codigo'] == "OPINIONS")

                    <div class="container-fluid pt-15 pb-15 mt-4">

                        <div class="title-row">

                            @if($bloque['icono']!="")

                                <img src="{{asset($bloque['icono'])}}" style="height: 34px;margin-right: 10px;">

                            @endif

                            {{ $bloque['titulo'] }}
                            <div class="line-style"></div>
                            

                        </div>

                    </div>

                @endif

                @if($bloque['codigo'] == "NOTICIAS")

                <div class="container-fluid pt-15 pb-15 mt-4">

                    <div class="title-row">

                        @if($bloque['icono']!="")

                            <img src="{{asset($bloque['icono'])}}" style="height: 34px;margin-right: 10px;">

                        @endif

                       Noticias
                        <div class="line-style"></div>
                        <div class="button-row">
                            <a href="{{asset('noticias')}}" class="btn btn-more-title btn-ver-todo"><i class="fas fa-eye"></i> Ver Todo</a>
                        </div>

                    </div>

                    <div class="section" style="padding-top:0 !important;"> 
                        @if($bloque['data']['noticias'])
                            @include('front-partials.noticias-front',  ['noticias' => $bloque['data']['noticias']])
                        @endif

                    </div>

                </div>

                @endif

            @endforeach


        @endif

    @endisset



@endsection

@section('scripts')

    <script>

        window.MostrarDetalleProducto = function(producto, moneda)
        {
            $('#content_quickview').modal('show');
            url=$('meta[name=app-url]').attr("content") + "/producto/detalle/" +producto;
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                console.log(data.producto);
                let moneda = '{{ $moneda[0]["prefijo"] }}';
                $('#productdetalletitle').html(data.producto);
                $('#imgdetalleProducto').attr('src', data.imgproducto);
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

    </script>

@endsection