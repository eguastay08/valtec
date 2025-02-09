@extends('template')


@section('content')

    
    <section class="as-categorias">

        <div class="as-breadcrumb" aria-label="breadcrumb">
            <nav class="container-xxl">
                <ol class="breadcrumb as-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('/')}}" title="E-Shop">Inicio</a>
                    </li>
                    @if($sub!="")
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{url('categorias/'.$categoriaTitle['url'])}}" title="{{$categoriaTitle['categoria']}}">{{$categoriaTitle['categoria']}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$subtitleCategoria['categoria']}}
                        </li>
                    @else 
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$categoriaTitle['categoria']}}
                        </li>
                    @endif
                </ol>
            </nav>
        </div>

        <div class="container-xxl container-fluid">

            <div class="row">


                @if($bannercat['img'])

                    <div class="d-flex justify-content-center">
                        <img class="img-fluid image-categoria" src="{{asset($bannercat['img'])}}" alt="{{$titulo_catFront}}" height="438">
                    </div>
                @endif

                <div class="col-auto me-auto">
                    <button id="btnFilters" class="btn btn-dark d-lg-none d-xl-block d-xl-none d-xxl-none d-xxl-block bradius mb-4" collapse="false"><i class="fa fa-filter"></i> Filtrar</button>
                </div>

                <h1 class="col-lg-9 offset-lg-3 as-categorias-title as-page-title-style">{{$titulo_catFront}}</h1>

                <aside class="col-lg-3">

                    <div id="filter-params">

                        <div class="as-categorias-fitler">
                            <form id="as-categorias-fitler-form" action="{{ url('categorias/'.$url_lista) }}" method="get">
                                <div class="row mb-3">
                                    <h3 class="col-12 pb-10 u"><span>Filtros</span></h3>
                                    <div class="form-group col-lg-12 col-md-12 col-12 mt-3">
                                        <p style="font-weight:bold !important;">PRODUCTO</p>
                                        <input type="text" class="form-control custom-form-input" name="productBusc" id="productBusc"
                                        placeholder="Ingrese el Producto" value="{{$productobuscar != "" ? $productobuscar : ''}}">
                                    </div>
                                
                                    <div class="col-12 mt-25">
                                        <p style="font-weight:bold !important;">PRECIO</p>
                                    </div>

                                    <div class="col-12 mt-2 px-4">
                                        <div id="precioSlider" class="slider-precio-style noUiSlider"></div>
                                        <div class="precioSlideRange d-flex justify-content-between">
                                            <span class="precioMinRange" id="priceMin"></span>
                                            <span class="precioMaxRange" id="priceMax"></span>
                                        </div>
                                        <input type="hidden" name="preciod" id="preciod" value="{{$precioD != "" ? $precioD : ''}}">
                                        <input type="hidden" name="precioh" id="precioh" value="{{$precioH != "" ? $precioH : ''}}">
        
                                    </div>

                                    <div class="col-12 text-right mt-25">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-dark btn--small bradius btn-buscarfilter btn-buscarfilter-style"><i class="fas fa-filter"></i> Búsqueda</button>
                                        <!-- <button type="button"class="btn btn-dark btn--small bradius" id="btnReset" name="btnReset" value="reset"><i class="fas fa-redo-alt"></i> Limpiar</button> -->
                                        <button type="button"class="btn btn-dark btn--small bradius" id="btnReset"><i class="fab fa-digital-ocean"></i> Limpiar</button>
                                    </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="as-categoria-tree">
                            <div class="row mb-3 mt-25">
                                <h3 class="col-12 pb-10 u"><span>Categorías</span></h3>
                                <div class="col-lg-12 col-md-12 col-12 mt-3">
                                    <ul class="as-categoria-tree-list">
                                        @isset($categorias)
                                            @foreach($categorias as $ke=>$c)

                                                @if(!$c['sub_menu'])
                                                    <li class="mb-2"><span class="{{ $c['url'] == $url_actual ? 'stylecatactive style-category-nav-active' : 'stylecat style-category-nav'}} d-block">
                                                        <a href="{{url('categorias/'.$c['url'])}}" class="site-nav {{ $c['url'] == $url_actual ? 'as-categoria-tag-active' : ''}}">{{$c['categoria']}}</a></span>
                                                    </li> 
                                                @else
                                                    <li>
                                                        <span class="{{ $c['url'] == $url_actual ? 'stylecatactive style-category-nav-active' : 'stylecat style-category-nav'}} d-flex justify-content-between align-items-center">
                                                            <a href="{{url('categorias/'.$c['url'])}}" class="site-nav {{ $c['url'] == $url_actual ? 'as-categoria-tag-active' : ''}}">{{$c['categoria']}}</a>
                                                            <a class="drop-arrow" desplegado ="{{ $c['url'] == $url_actual ? '1' : '0'}}">
                                                                <i class="fas fa-plus ct-show {{ $c['url'] == $url_actual ? 'hide' : ''}}"></i>
                                                                <i class="fas fa-minus ct-hide {{ $c['url'] == $url_actual ? 'show' : 'hide'}}"></i>
                                                            </a>
                                                            </span>
                                                            <ul class="sublinks {{ $c['url'] == $url_actual ? 'active-sublinks' : ''}}">
                                                                @foreach($c['sub_menu'] as $kc=>$catsub)
                                                                    <li class="level2">
                                                                        <a href="{{url('categorias/'.$catsub['url'])}}" class="site-nav {{ $catsub['url'] == $sub_actual ? 'level2-active fw-bold' : 'level2style'}}">{{$catsub['categoria']}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                    </li>
                                                    
                                                @endif

                                            @endforeach
                                        @endisset
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="as-etiquetas-tree">
                            <div class="row mb-3 mt-25">
                                <h3 class="col-12 pb-10 u"><span>Etiquetas</span></h3>
                                <div class="col-lg-12 col-md-12 col-12 mt-3">
                                    <ul class="as-tags-tree-list">

                                    @isset($etiquetas)
                                        @foreach($etiquetas as $e)
                                            <li><a href="{{url('etiquetas/'.$e->url)}}" title="{{$e->tag}}">{{$e->tag}}</a></li>
                                        @endforeach
                                    @endisset

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </aside>

                <article class="col-lg-9">
                    <div class="row pb-3">

                        <div class="col-md-8 col-sm-6"></div>

                        <div class="col-md-4 col-sm-6 d-flex justify-content-between align-items-center">

                            @php $var = '' @endphp
                            @if(isset($productobuscar))
                                @php $var = "productBusc=".$productobuscar; @endphp
                            @endif
                            @if(isset($precioD))
                                @php $var .= "&preciod=".$precioD; @endphp
                            @endif
                            @if(isset($precioH))
                                @php $var .= "&precioh=".$precioH."&"; @endphp
                            @endif
                            <label>Ordenar:</label>
                            <select name="SortBy" id="SortBy" class="form-control custom-form-input w-45 ms-3" onchange="location = this.value">
                                <option value="{{url('categorias/'.$url_lista.'?'.$var.'order=defecto')}}" {{$order=='defecto' ? 'selected="selected"' : ''}}>Por defecto</option>
                                <option value="{{url('categorias/'.$url_lista.'?'.$var.'order=precioasc')}}" {{$order=='precioasc' ? 'selected="selected"' : ''}}>Precio Ascendente</option>
                                <option value="{{url('categorias/'.$url_lista.'?'.$var.'order=preciodesc')}}" {{$order=='preciodesc' ? 'selected="selected"' : ''}}>Precio Descendente</option>
                                <option value="{{url('categorias/'.$url_lista.'?'.$var.'order=alfasc')}}" {{$order=='alfasc' ? 'selected="selected"' : ''}}>Alfabéticamente (A-Z)</option>
                                <option value="{{url('categorias/'.$url_lista.'?'.$var.'order=alfdesc')}}" {{$order=='alfdesc' ? 'selected="selected"' : ''}}>Alfabéticamente (Z-A)</option>
                            </select>
                            <input class="collection-header__default-sort" type="hidden" value="manual">

                        </div>

                    </div>

                    <div class="row">

                        @if(count($productosxcategorias) > 0)

                            @foreach($productosxcategorias as $productosxcategoria)

                                <?php $encryptProductCategoria=Hashids::encode($productosxcategoria['producto_id']);?> 

                                <div class="col-md-c5 col-sm-c3 col-6 mt-3">
              
                                    <div class="grid-producto h-100 d-flex flex-column">

                                        <div class="product-image">

                                            <a href="{{ url('producto/'.$productosxcategoria['url']) }}" class="text-decoration-none">

                                                <!-- Imagen Producto -->
                                                <img class="img-fluid" data-src="{{asset($productosxcategoria['imgproducto'])}}" src="{{asset($productosxcategoria['imgproducto'])}}" alt="Imagen Producto" title="{{$productosxcategoria['producto']}}">
                                                <!-- Fin Imagen Producto -->

                                                <!-- Descuento producto -->
                                                @if($productosxcategoria['descuento'] > 0)
                                                    <div class="descuento-tag rounded"><span class="lbl-discount"><p>-{{$productosxcategoria['descuento']}}%</p></span></div>
                                                @endif
                                                <!-- Fin Descuento Producto -->

                                            </a>

                                        </div>

                                        <div class="product-title mb-2">
                                            <!-- product name -->
                                            <a href="{{ url('producto/'.$productosxcategoria['url']) }}" class="grid-producto-nombre mt-auto" title="{{$productosxcategoria['producto']}}">
                                                <h3 class="grid-producto-title">{{$productosxcategoria['producto']}}</h3>
                                            </a>
                                            <!-- End product name -->
                                        </div>

                                        <div class="product-details text-center mt-auto">
                                            <!-- product price -->
                                            <div class="text-center product-price">
                                                @if($productosxcategoria['precio_oferta']!= '0.00')
                                                    <div class="old-price">{{$moneda[0]['prefijo'].' '.$productosxcategoria['precio']}}</div>
                                                    <div class="price">{{$moneda[0]['prefijo'].' '.$productosxcategoria['precio_oferta']}}</div>
                                                @else 
                                                    <div class="price">{{$moneda[0]['prefijo'].' '.$productosxcategoria['precio']}}</div>
                                                @endif
                                            </div>
                                            <!-- End product price -->
                                            <!-- Color Variant -->

                                            @if($productosxcategoria['agotado']==0)

                                                <div class="text-center" style="padding: 0 2px !important;">
                                                    <a href="{{ url('producto/'.$productosxcategoria['url']) }}" class="btn btn-addto-cart btn-shop btn-block border-button style-btn-comprar" type="button" tabindex="0"><i class="fas fa-shopping-cart"></i> Comprar</a>
                                                </div>

                                            @else 
                                                <div class="text-center" style="padding: 0 2px !important;">
                                                    <span class="btn label-agotado btn-block" style="margin-top: 1px; margin-bottom: 1px; font-size:13px; padding-top:5px; padding-bottom: 5px;"><i class="fas fa-exclamation-circle"></i> Agotado</span>
                                                </div>
                                            
                                            
                                            @endif

                                            <div class="detalles-product mt-2" style="padding-left:15px !important; padding-right:15px !important;">
                                                <a type="button" class="btn-styledetalles"  onclick="MostrarDetalleProCat(<?php echo "'".$encryptProductCategoria."'"; ?>, '{{asset($productosxcategoria['imgproducto'])}}')"><i class="fas fa-search"></i> Ver detalles</a>                                    
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>

                                </div>

                            @endforeach

                        @else 

                            <div class="col">

                                <h2 class="display-4">Lo Sentimos</h2>
                                <p class="lead">No encontramos el producto que estas buscando en esta Categoría</p>
                                <p class="lead">
                                    <a class="btn btn-primary btn-lg bradius btn-principal btn-principal-style" href="{{url('/')}}">Volver al inicio</a>
                                </p>

                            </div>

                        @endif

                    </div>

                    {{ $productosxcategorias->appends(request()->query())->onEachSide(1)->links('front-partials.pagination-front') }}

                </article>

            </div>

        </div>

    </section>


@endsection

@section('scripts')

    <script>

        // Data para UI Slider de los Precios
        // console.log({{$precioMaxCat}});

        let dataPrecioInicio = 0;
        let dataPrecioFin = 0;
        <?php if($precioD != "") { ?>
            dataPrecioInicio = <?php echo $precioD ?>;
        <?php } ?>

        <?php if($precioH != "") { ?>
            dataPrecioFin = <?php echo $precioH ?>;
        <?php } 
        else {?>
            dataPrecioFin = <?php echo $precioMaxCat ?>; 
        <?php 
        }
        ?>

        let precioSlider = document.getElementById('precioSlider');
        let PriceMin = document.getElementById('priceMin');
        let PriceMax = document.getElementById('priceMax');
        let precioD = document.getElementById('preciod');
        let precioH = document.getElementById('precioh');
        let rangemax = <?php echo $precioMaxCat ?>; 
 
        noUiSlider.create(precioSlider, {
            // options here
            start: [dataPrecioInicio, dataPrecioFin],
            range: {
                'min': [0],
                'max': [rangemax]
            },
            step: 1,
            tooltips: false,
            connect: true,
        });

        precioSlider.noUiSlider.on('update', function (values, handle) {

            let value = values[handle];

            if (handle) {
                PriceMax.innerHTML  = value;
                precioH.value = value;
                
            } else {
                PriceMin.innerHTML  = value;
                precioD.value = value;
            }
        });

        // Limpiar Filtros
        $('#btnReset').click(function(){
        //   console.log({{$url_lista}});
            let caturl = '<?php echo $url_lista ?>';
            let url=$('meta[name=app-url]').attr("content") + "/categorias/" + caturl;
            window.location.href = url;
        })
        
        // Fin de la data para UI Slider de los Precios

        window.MostrarDetalleProCat = function(producto, img)
        {
            $('#content_quickview').modal('show');
            url=$('meta[name=app-url]').attr("content") + "/producto/detalle/" +producto;
            $.ajax({
                url: url,
                method:'GET'
            }).done(function (data) {
                // console.log(img);
                let moneda = '{{ $moneda[0]["prefijo"] }}';
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

    </script>

@endsection