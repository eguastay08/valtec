<div class="row">

    <div class="col-12">

        <div class="table-responsive">

            <table id="table-pago" class="table table-borderless">
                <thead class="table-light">
                    <tr>
                        <th colspan="2" class="text-center thfont" scope="col">Producto</th>
                        <th class="text-center thfont" scope="col">Precio</th>
                        <th class="text-center thfont" scope="col">Cantidad</th>
                        <th class="text-center thfont" scope="col">Total</th>
                        <th colspan="2" class="text-center thfont" style="width:10%;" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @isset($cart_content)
                        @if(count($cart_content)>0)
                            @php $ci = 1; @endphp
                            @foreach($cart_content as $cart)

                                <?php $parameteritemcart=Hashids::encode($cart['id']);?>

                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                    <td class="w-15">
                                        
                                        <img class="cart__image" src="{{asset($cart->attributes->image)}}" alt="{{$cart->name}}" title="{{$cart->name}}" height="80px" width="80px" />
                                    </td>
                                    <td class="w-30">
                                        <p style="font-size:12px;">{{$cart->name}}</p>
                                    </td>
                                    <td style="width: 15%">
                                        <span style="font-size:15px;">{{$moneda[0]['prefijo']}} {{number_format((float)$cart->price, 2, '.', '')}}</span>
                                    </td>
                                    <td class="text-right w-5">
                                        <div class="form-group">
                                            <input class="form-control boder-default text-right" type="number" name="qtyTablePago" id="qtyTablePago{{$ci}}" value="{{$cart->quantity}}" pattern="[0-9]*" min="0">
                                        </div>
                                    </td>
                                    <td class="text-right" style="width: 15%">
                                        <span class="money" style="font-size:15px;">{{$moneda[0]['prefijo']}} {{number_format((float)$cart->quantity * $cart->price, 2, '.', '')}}</span>
                                    </td>
                                    
                                    <td class="text-center w-5">
                                        <input type="hidden" name="id_edit" value="{{$cart->id}}">
                                        <button type="button" class="btn btn-dark cart__remove" style="border:none !important;" title="Actualizar Cantidad" onclick="UpdateItemCartTablePago(<?php echo "'".$parameteritemcart."'"; ?>, <?php echo "'".$ci."'"; ?>)"><i class="fas fa-edit"></i></button> 
                                    </td>

                                    <td class="text-center w-5">
                                        <button type="button" style="border:none !important;" class="btn btn-danger" title="Remove tem" onclick="RemoveItemCart(<?php echo "'".$parameteritemcart."'"; ?>)"><i class="fas fa-trash"></i></button>
                                    </td>

                                </tr>

                                @php $ci++ @endphp

                            @endforeach
                        @endif
                    @endisset

                </tbody>

            </table>

        </div>

    </div>

</div>

@isset($cart_content)
    @if(count($cart_content)>0)

        <div class="row mt-3">

            <div class="col-12 mb-4">
                
                <h5 class="mb-3">Tienes un Cupón?</h5>
                
                <label class="mb-3">Ingresa el código del Cupón de descuento, en caso tengas uno.</label>

                <div class="input-group mb-3">
                    <input type="text" class="form-control boder-default" aria-describedby="basic-addon2" name="txtcoupon" id="txtcoupon" value="{{isset($discount_array['cupon']) ? $discount_array['cupon'] : ''}}">
                    <button type="button" class="btn btn-dark" onclick="CuponValue()"><i class="fas fa-plus"></i> Aplicar Cupón</button>
                </div>

                    <!-- <div class="mt-3">Descuento Especial:</div>
                    <div class="mt-3">Compras mayores a: 3: <b>-5%</b></div>
                    <div class="mt-1">Compras mayores a: 5: <b>-10%</b></div>
                    <div class="mt-1">Compras mayores a: 10: <b>-15%</b></div> -->

            </div>

            <div class="col-12">
                <div class="solid-border">	
                    <div class="row border-bottom pb-2">
                        <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                        <span class="col-12 col-sm-6 text-right"><span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_subtotal, 2, '.', '')}}</span></span>
                    </div>
                    <div class="row border-bottom pb-2 pt-2">
                        <span class="col-12 col-sm-6 cart__subtotal-title">Descuento ({{isset($discount_array['atributos']['discount']) ? $discount_array['atributos']['discount'].'%' : '0%'}})</span>
                        <span class="col-12 col-sm-6 text-right" style="color:red;">{{isset($discount_array['value_descuento']) ? '-'.number_format((float)$discount_array['value_descuento'], 2, '.', '') : '0.00'}}</span>
                    </div>

                    <div class="row pb-2 pt-2">
                        <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Total</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_total, 2, '.', '')}}</span></span>
                    </div>
                
                </div>

            </div>

        </div>

    @endif

@endisset