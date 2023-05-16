<h5 class="mt-3 text-center">Precio:</h5>

<div class="text-center price-product">
    @if($producto['descuento']>0)
        <div class="d-flex justify-content-center align-items-center"><div class="oldPrice">{{$moneda[0]['prefijo'].' '.$producto['precio']}}</div> <span class="tag-discount"> -{{$producto['descuento']}}% </span></div>
        <div class="Price mt-3">{{$moneda[0]['prefijo'].' '.$producto['precio_oferta']}}</div>
    @else 
        <div class="Price mt-2">{{$moneda[0]['prefijo'].' '.$producto['precio']}}</div>
    @endif
</div>

<div class="product-buttons text-center mt-2">

    @php $parameter=Hashids::encode($producto['producto_id']); @endphp
       
    @if($producto['agotado']==0)

        <input type="hidden" id="pcantidad" name="pcantidad" value="1">
        <input type="hidden" id="pkey" name="pkey" value="<?php echo $parameter ?>">
        <input type="hidden" id="producto_imagen" name="producto_imagen" value="{{$producto['imgproducto']}}">
        <button type="button" class="btn btn-stylec style-btn-comprar btn-block bradius btnComprarCart"><i class="fas fa-shopping-cart"></i> Comprar</button>

    @else 

        <span class="btn btn-agotado btn-block disabled bradius"><i class="fas fa-exclamation-circle"></i> Agotado</span>

    @endif


    <a type="button" class="btn btn-stylec btn-wtsp-send bradius d-block mt-3" href="https://api.whatsapp.com/send?phone=+51997308677&text=Hola%2C+deseo+información+de+este+producto%3A%0A{{$producto['producto']}}%0A{{url('/producto/'.$producto['url'])}}" target="_blank"><i class="fab fa-whatsapp"></i> ¿Necesitas Ayuda?</a>

</div>

@if($producto['descuento']>0)
   
    <div id="flipdown" class="flipdown mt-2" style="margin:auto;"></div>

    <div class="oferta-message d-flex justify-content-center fw-bold mt-2">
        OFERTA LIMITADA
    </div>
@endif