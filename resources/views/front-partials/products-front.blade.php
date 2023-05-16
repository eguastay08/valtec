@isset($productos)

    @if($carrousel==1)

        <div style="overflow:hidden">

            <div class="row pb-15" style="padding-left:2px;">

                <div class="autoplay-cr owl-carousel owl-theme owl-loaded owl-drag mb-3 h-100">
                    
                    @if(count($productos) > 0)

                        @foreach($productos as $producto)

                            <?php $encryptProduct=Hashids::encode($producto['producto_id']);?> 

                            <div class="item-producto shadow-box d-flex flex-column" style="height:99% !important;">
                                
                                <div class="product-image">

                                    <a href="{{ url('producto/'.$producto['url']) }}" class="text-decoration-none">

                                        <!-- Imagen Producto -->
                                        <img class="img-fluid" data-src="{{asset($producto['imgproducto'])}}" src="{{asset($producto['imgproducto'])}}" alt="Imagen Producto" title="{{$producto['producto']}}">
                                        <!-- Fin Imagen Producto -->

                                        <!-- Descuento producto -->
                                        @if($producto['descuento'] > 0)
                                            <div class="descuento-tag rounded"><span class="lbl-discount"><p>-{{$producto['descuento']}}%</p></span></div>
                                        @endif
                                        <!-- Fin Descuento Producto -->

                                    </a>

                                </div>

                                
                                <div class="product-title mb-1">
                                    <!-- product name -->
                                    <a href="{{ url('producto/'.$producto['url']) }}" class="grid-producto-nombre mt-auto" title="{{$producto['producto']}}">
                                        <h3 class="grid-producto-title">{{$producto['producto']}}</h3>
                                    </a>
                                    <!-- End product name -->
                                </div>

                                <div class="product-details text-center mt-auto">
                                    <!-- product price -->
                                    <div class="text-center product-price">
                                        @if($producto['precio_oferta']!= '0.00')
                                            <div class="old-price">{{$moneda[0]['prefijo'].' '.$producto['precio']}}</div>
                                            <div class="price">{{$moneda[0]['prefijo'].' '.$producto['precio_oferta']}}</div>
                                        @else 
                                            <div class="price">{{$moneda[0]['prefijo'].' '.$producto['precio']}}</div>
                                        @endif
                                    </div>
                                    <!-- End product price -->
                                    <!-- Color Variant -->

                                    @if($producto['agotado']==0)

                                        <div class="text-center" style="padding: 0 2px !important;">
                                            <a href="{{ url('producto/'.$producto['url']) }}" class="btn btn-addto-cart btn-shop btn-block border-button style-btn-comprar" type="button" tabindex="0"><i class="fas fa-shopping-cart"></i> Comprar</a>
                                        </div>

                                    @else 
                                        <div class="text-center" style="padding: 0 2px !important;">
                                            <span class="btn label-agotado btn-block" style="margin-top: 1px; margin-bottom: 1px; font-size:13px; padding-top:5px; padding-bottom: 5px;"><i class="fas fa-exclamation-circle"></i> Agotado</span>
                                        </div>
                                      
                                     
                                    @endif

                                    <div class="detalles-product mt-2" style="padding-left:15px !important; padding-right:15px !important;">
                                        <a type="button" class="btn-styledetalles"  onclick="MostrarDetalleProducto(<?php echo "'".$encryptProduct."'"; ?>, '{{asset($producto['imgproducto'])}}')"><i class="fas fa-search"></i> Ver detalles</a>                                    
                                    </div>
                                </div>

                            </div>


                        @endforeach
                        
                    @endif
            

                </div>

            </div>

        </div>

    @else 

        <div class="row pb-15"> 

                @if(count($productos) > 0)

                    @foreach($productos as $producto)

                        <?php $encryptProduct=Hashids::encode($producto['producto_id']);?>  

                        <div class="col-lg-2 col-md-3 col-6 mb-4">

                            <div class="grid-producto h-100 d-flex flex-column">

                                <div class="product-image">

                                    <a href="{{ url('producto/'.$producto['url']) }}" class="text-decoration-none">

                                        <!-- Imagen Producto -->
                                        <img class="img-fluid" data-src="{{asset($producto['imgproducto'])}}" src="{{asset($producto['imgproducto'])}}" alt="Imagen Producto" title="{{$producto['producto']}}">
                                        <!-- Fin Imagen Producto -->

                                        <!-- Descuento producto -->
                                        @if($producto['descuento'] > 0)
                                            <div class="descuento-tag rounded"><span class="lbl-discount"><p>-{{$producto['descuento']}}%</p></span></div>
                                        @endif
                                        <!-- Fin Descuento Producto -->

                                    </a>

                                </div>

                                <div class="product-title mb-1">
                                    <!-- product name -->
                                    <a href="{{ url('producto/'.$producto['url']) }}" class="grid-producto-nombre mt-auto" title="{{$producto['producto']}}">
                                        <h3 class="grid-producto-title">{{$producto['producto']}}</h3>
                                    </a>
                                    <!-- End product name -->
                                </div>

                                <div class="product-details text-center mt-auto">
                                    <!-- product price -->
                                    <div class="text-center product-price">
                                        @if($producto['precio_oferta']!= '0.00')
                                            <div class="old-price">{{$moneda[0]['prefijo'].' '.$producto['precio']}}</div>
                                            <div class="price">{{$moneda[0]['prefijo'].' '.$producto['precio_oferta']}}</div>
                                        @else 
                                            <div class="price">{{$moneda[0]['prefijo'].' '.$producto['precio']}}</div>
                                        @endif
                                    </div>
                                    <!-- End product price -->
                                    <!-- Color Variant -->

                                    @if($producto['agotado']==0)

                                        <div class="text-center" style="padding: 0 2px !important;">
                                            <a href="{{ url('producto/'.$producto['url']) }}" class="btn btn-addto-cart btn-shop btn-block border-button style-btn-comprar" type="button" tabindex="0"><i class="fas fa-shopping-cart"></i> Comprar</a>
                                        </div>

                                    @else 
                                        <div class="text-center" style="padding: 0 2px !important;">
                                            <span class="btn label-agotado btn-block" style="margin-top: 1px; margin-bottom: 1px; font-size:13px; padding-top:5px; padding-bottom: 5px;"><i class="fas fa-exclamation-circle"></i> Agotado</span>
                                        </div>
                                      
                                     
                                    @endif

                                    <div class="detalles-product mt-2" style="padding-left:15px !important; padding-right:15px !important;">
                                        <a type="button" class="btn-styledetalles"  onclick="MostrarDetalleProducto(<?php echo "'".$encryptProduct."'"; ?>, '{{asset($producto['imgproducto'])}}')"><i class="fas fa-search"></i> Ver detalles</a>                                    
                                    </div>
                                </div>
    
                                <!-- End Variant -->
                            </div>

                        </div>

                    @endforeach

                @endif


        </div>

    @endif

@endisset