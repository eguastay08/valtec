@isset($aproductosdata)

    @if(count($aproductosdata)>0)
        <ul id="products-list" style="display:none;">
            @foreach($aproductosdata as $apd)
                
                <li>
                    <div class="itemsearch-product">
                        <a href="{{ url('producto/'.$apd['url']) }}">
                            <div class="d-flex align-items-center" style="overflow:hidden">
                                <div class="width:65px;">
                                    <img class="img-fluid" src="{{asset($apd['imgproducto'])}}" alt="Imagen Producto" title="{{$apd['producto']}}">
                                </div>
                                <span class="me-2" style="font-size:14px;">
                                    {!! $apd['format_producto'] !!}
                                </span>
                            </div>
                        </a>
                    </div>
                </li>
            
            @endforeach
            <li class="more">
                @isset($productostring)
                    <div class="itemsearch-product" style="text-align:center !important;">
                        <a href="{{ url('productos?q='.$productostring) }}" class="text-center" style="padding: 5px 0;font-size:16px !important;">
                        <b><span class="fas fa-eye"></span>&nbsp;Ver todo</b>
                        </a>
                    </div>
                @endisset
            
            </li>
                
        </ul>
    @endif

@endisset