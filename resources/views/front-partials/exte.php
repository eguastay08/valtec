@extends('template')

@section('content')

    <div class="container-fluid">
  
        <div class="row d-flex justify-content-center">

            <div class="col-12 pb-10 mb-20">
                <h3 class="mt-4 underline text-center">COMPRA RÁPIDA</h3>
                <hr>
            </div>

            <div class="breadcrumbs-pago">
                <ul>
                    <li>
                        <span>
                            <i class="fas fa-shopping-cart icon" aria-hidden="true"></i>
                            <p>Detalle de Compra</p>
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="fas fa-user icon" aria-hidden="true"></i>
                            <p>Datos Personales</p>
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="far fa-money-bill-alt icon" aria-hidden="true"></i>
                            <p>Medios de Pago</p>
                        </span>
                    </li>
                </ul>
            </div>

        </div>

        <div id="accordionExample">

            <h4 class="panel-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><b>Detalle de la Compra</b></h4>
            <div id="collapseOne" class="collapse panel-content show" data-parent="#accordionExample">
                <div class="row mt-5">

                    <div class="col-12 col-md-12 col-lg-12">

                    
                            <div class="table-responsive">
                            <table class="table">
                                <thead class="cart__row cart__header">
                                    <tr>
                                        <th colspan="2" class="text-center">Producto</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Total</th>
                                        <th colspan="2" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($cart_content)
                                        @if(count($cart_content)>0)
                                            @foreach($cart_content as $cart)
                                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                                    <td class="cart__image-wrapper cart-flex-item">
                                                        
                                                        <a><img class="cart__image" src="{{asset($cart->attributes->image)}}" alt="Elastic Waist Dress - Navy / Small"></a>
                                                    </td>
                                                    <td class="cart__meta small--text-left cart-flex-item">
                                                        <div class="list-view-item__title">
                                                            <a>{{$cart->name}}</a>
                                                        </div>
                                                    </td>
                                                    <td class="cart__price-wrapper cart-flex-item">
                                                        <span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart->price, 2, '.', '')}}</span>
                                                    </td>
                                                    <form action="{{ route('cart.update') }}" method="post" class="cart style2">
                                                    {{ csrf_field() }}
                                                        <td class="cart__update-wrapper cart-flex-item text-right">
                                                            <div class="cart__qty text-center">
                                                                <div class="qtyField">
                                                                    <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                                                                    <input class="cart__qty-input qty" type="text" name="quantity" id="qty" value="{{$cart->quantity}}" pattern="[0-9]*">
                                                                    <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cart__price-wrapper cart-flex-item">
                                                            <span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart->quantity * $cart->price, 2, '.', '')}}</span>
                                                        </td>
                                                    
                                                        <td class="text-center">
                                                            <input type="hidden" name="id_edit" value="{{$cart->id}}">
                                                            <button type="submit" style="display:inline; border:none !important;" class="btn btn--secondary cart__remove" title="Actualizar Item"><i class="icon icon anm anm-edit"></i></button>                                                    </td>    
                                                        </td>

                                                    </form>

                                                    <td class="text-center">
                                                        <form action="{{ route('cart.remove') }}" method="POST">
                                                        {{ csrf_field() }}
                                                            <input type="hidden" name="id_remove" value="{{$cart->id}}">
                                                            <button href="#" style="display:inline;  border:none !important;" class="btn btn--secondary cart__remove" title="Remove tem"><i class="icon icon anm anm-times-l"></i></button>
                                                            <!-- <button href="#" class="btn remove" title="Eliminar Producto" style="width:10% !important; padding:0.5px !important;background-color:red !important;"><i class="anm anm-times-l" aria-hidden="true"></i></button> -->
                                                        </form>
                                                    </td>
                                                   
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endisset
                                </tbody>
                               
                            </table>
                            </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 mb-4">
                        <h5>Tienes un Cupón?</h5>
                        <form action="{{ route('cart.cupones') }}" method="post">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="address_zip">Ingresa el código del Cupón de descuento, si es que contarás con uno.</label>
                                <input type="text" name="coupon" value="{{isset($discount_array['cupon']) ? $discount_array['cupon'] : ''}}">
                            </div>
                            <div class="actionRow">
                                <div><button type="submit" class="btn btn-secondary btn--small">Aplicar Cupón</button></div>
                            </div>

                            <!-- <div class="mt-3">Descuento Especial:</div>
                            <div class="mt-3">Compras mayores a: 3: <b>-5%</b></div>
                            <div class="mt-1">Compras mayores a: 5: <b>-10%</b></div>
                            <div class="mt-1">Compras mayores a: 10: <b>-15%</b></div> -->
                        </form>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 cart__footer">
                        <div class="solid-border">	
                            <div class="row border-bottom pb-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                                <span class="col-12 col-sm-6 text-right"><span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_subtotal, 2, '.', '')}}</span></span>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Descuento ({{isset($discount_array['atributos']['discount']) ? $discount_array['atributos']['discount'].'%' : '0%'}})</span>
                                <span class="col-12 col-sm-6 text-right" style="color:red;">{{isset($discount_array['value_descuento']) ? '-'.number_format((float)$discount_array['value_descuento'], 2, '.', '') : '0.00'}}</span>
                            </div>
                            <!-- <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Shipping</span>
                                <span class="col-12 col-sm-6 text-right">Free shipping</span>
                            </div> -->
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Total</strong></span>
                                <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_total, 2, '.', '')}}</span></span>
                            </div>
                            <!-- <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div> -->
                            <!-- <p class="cart_tearm">
                            <label>
                                <input type="checkbox" name="tearm" class="checkbox" value="tearm" required="">
                                I agree with the terms and conditions
                            </label>
                            </p>
                            <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Proceed To Checkout" disabled="disabled">
                            <div class="paymnet-img"><img src="assets/images/payment-img.jpg" alt="Payment"></div>
                            <p><a href="#;">Checkout with Multiple Addresses</a></p> -->
                        </div>

                    </div>

                </div>
            </div>

            <form id="pagform" class="pform" action="" method="POST">

            {{ csrf_field() }}
                
                <h4 class="panel-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><b>Datos Personales</b></h4>
                <div id="collapseTwo" class="collapse panel-content" data-parent="#accordionExample">

                    <div class="row">
                        
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Nombre y Apellidos</label>
                                <input type="text" class="form-control" name="pagonombresapellidos">
                                @isset($cart_content)
                                    @if(count($cart_content)>0)
                                        <input type="hidden" name="cartproduct" value="{{$cart_content}}">
                                    @endif
                                @endisset
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Teléfono / Whatsapp / Facebook</label>
                                <input type="text" class="form-control" name="pagoinformacionadicional">
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Correo Electrónico</label>
                                <input type="email" class="form-control" name="pagoemail">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Validar Correo Electrónico</label>
                                <input type="text" class="form-control" id="no-paste" name="pagoemailverificar">
                            </div>
                        </div>

                    </div>

                </div>

                <h4 class="panel-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><b>Medios de Pago</b></h4>
                <div id="collapseThree" class="collapse panel-content" data-parent="#accordionExample">
                    <div class="row">
                    
                        @isset($mediosPago)
                            @if(count($mediosPago)>0)

                                @php $contador = 0 @endphp
                                @foreach($mediosPago as $mp)
                                    @php $contador = $contador + 1 @endphp
                                    @if($mp->transferencia == 1)
                                        @if($contador == 1)
                                            <div class="col-12 text-center mb-2"><h5><i class="fas fa-exchange-alt"></i> TRANSFERENCIA BANCARIA</h5></div>
                                        @endif
                                            <div style="cursor:pointer" class="col-12 list-group-item payment-link" data-color="#000" onclick="mostrarinfo({{$contador}});">
                                                <div style="overflow: hidden;">
                                                    <div class="pull-left payment-text">
                                                        <div class="payment-layer"></div>
                                                        <input type="radio" name="payment" id="payment{{$contador}}" value="{{$mp->medio_pago_id}}" online="0">
                                                    </div>
                                                    <div class="payment-image pull-left">
                                                        <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                                    </div>
                                                    <div class="pull-left payment-text">
                                                        <!-- {$medio_pago[$i]['nombre']} {if $medio_pago[$i]['informacion_adicional']} - {$medio_pago[$i]['informacion_adicional']}{/if} <span>({'subtitulo_transferencias_pago'|text:$texts})</span> -->
                                                        {{$mp->nombre}} (Transferencias Bancarias)
                                                    </div>
                                                </div>
                                                <div id="details{{$contador}}" class="payment-details" style="display:none">
                                                    <pre>{{strip_tags($mp->descripcion)}}</pre>
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
                                            <div style="cursor:pointer" class="col-12 list-group-item payment-link" data-color="#000" onclick="mostrarinfot({{$contador2}});">
                                                <div style="overflow: hidden;">
                                                    <div class="pull-left payment-text">
                                                        <div class="payment-layer"></div>
                                                        <input type="radio" name="payment" id="paymentt{{$contador2}}" value="{{$mp->medio_pago_id}}" online="0">
                                                    </div>
                                                    <div class="payment-image pull-left">
                                                        <img src="{{asset($mp->imagen)}}" style="height: 100%">
                                                    </div>
                                                    <div class="pull-left payment-text">
                                                        <!-- {$medio_pago[$i]['nombre']} {if $medio_pago[$i]['informacion_adicional']} - {$medio_pago[$i]['informacion_adicional']}{/if} <span>({'subtitulo_transferencias_pago'|text:$texts})</span> -->
                                                        {{$mp->nombre}} (Depósito Bancario)
                                                    </div>
                                                </div>
                                                <div id="detailst{{$contador2}}" class="payment-details" style="display:none">
                                                    <pre>{{strip_tags($mp->descripcion)}}</pre>
                                                </div>
                                            </div>
                                
                                    @endif

                                @endforeach

                            @endif

                        @endisset
                        <input type="hidden" name="opayment" value="0">
                        <div class="col-12 text-center mt-3 mb-2">
                            <h5><i class="fas fa-credit-card"></i> PAGOS ONLINE</h5>
                        </div>

                        <div style="cursor:pointer" class="col-12 list-group-item payment-link" onclick="pagoonlined();">
                            <div style="overflow: hidden;">
                                <div class="pull-left payment-text">
                                    <div class="payment-layer"></div>
                                    <input type="radio" name="payment" id="payment-online1" value="1" online="1">
                                </div>
                                <div class="payment-image pull-left">
                                    <img src="{{asset('assets/images/medios_pago_online/paypal.png')}}" style="height: 100%">
                                </div>
                                <div class="pull-left payment-text">
                                    Paypal (Pagos Online)
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row justify-content-end">

                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 cart__footer mt-5">
                            <div class="solid-border">	
                                <div class="row border-bottom pb-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                                    <span class="col-12 col-sm-6 text-right"><span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_subtotal, 2, '.', '')}}</span></span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Descuento ({{isset($discount_array['atributos']['discount']) ? $discount_array['atributos']['discount'].'%' : '0%'}})</span>
                                    <span class="col-12 col-sm-6 text-right" style="color:red;">{{isset($discount_array['value_descuento']) ? '-'.number_format((float)$discount_array['value_descuento'], 2, '.', '') : '0.00'}}</span>
                                </div>
                            
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Total</strong></span>
                                    <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_total, 2, '.', '')}}</span></span>
                                </div>
                            
                            </div>

                        </div>
                    </div>

                    <div class="row mt-4">
                        <div id="comprobanteDV" class="col-lg-7 col-sm-12">
                            <div class="form-group">
                                <label>Comprobante de pago (foto ó captura de pantalla)</label>
                                <input type="file" class="form-control form-control-sm" name="comprobantepago" id="comprobantepago">
                                <div id="comprobante-preview" class="mt-2">

                                </div>
                            </div>
                        </div>

                        <div id="fechapagoDV" class="col-lg-5 col-sm-12">
                            <div class="form-group">
                                <label>Fecha de pago</label>
                                <input type="date" class="form-control" name="fechapago">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="g-recaptcha" data-sitekey="{{$captchakey->valor}}"></div>
                        </div>

                        <div class="col-12 mt-4">
                        <a href="{{url('terminos_condiciones')}}" target="_blank"><i class="fas fa-link"></i> Términos y Condiciones</a>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <p>
                                    <input type="checkbox" name="aceptochk">
                                    Acepto Términos y Condciones de uso
                                </p>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" id="btnpagar" class="btn btn-success">Realizar Compra</button>
                        </div>

                      

                    </div>
                </div>

            </form>

            <div class="cho-container"></div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- <script src="https://sdk.mercadopago.com/js/v2"></script> -->

    <script>
        // const mp = new MercadoPago('TEST-fb98f022-db5f-4ffd-9599-34d2aab158a5');

        function onSubmit(token) {
            document.getElementById("pago-form").submit();
        }

        // const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
        //     locale: 'es-AR'
        // });

        const pasteBox = document.getElementById("no-paste");
        pasteBox.onpaste = e => {
            e.preventDefault();
            return false;
        };

        //proceso para generar ID de manera aleatoria
        const chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        function generateRandomId(length) {
            let result = '';
            const charactersLength = chars.length;
            for ( let i = 0; i < length; i++ ) {
                result += chars.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        window.mostrarinfo = function(value)
        {
            $('#payment'+value).prop("checked", true);
            $('.payment-details').css('display','none');
            $('#details'+value).css('display','block');
            $('#comprobanteDV').removeClass('hide');
            $('#fechapagoDV').removeClass('hide');
            $('input[name=opayment]').val("0");
        }

        window.mostrarinfot = function(value)
        {
            $('#paymentt'+value).prop("checked", true);
            $('.payment-details').css('display','none');
            $('#detailst'+value).css('display','block');
            $('#comprobanteDV').removeClass('hide');
            $('#fechapagoDV').removeClass('hide');
            $('input[name=opayment]').val("0");
        }

        window.pagoonlined = function()
        {
            $('#payment-online1').prop("checked",true);
            $('#comprobanteDV').addClass('hide');
            $('#fechapagoDV').addClass('hide');
            $('input[name=opayment]').val("1");
            
        }

        $('#comprobantepago').change(function(){
            let comprobante = $('input[name="comprobantepago"]')[0].files;
            let url = $('meta[name=app-url]').attr("content") +  "/comprobante/imgTmp";
            let comprobantepago = new FormData();
            let id = generateRandomId(3);
            comprobantepago.append("imagen",comprobante[0]);
            comprobantepago.append("indice",1);
            $('#comprobante-preview').html("");
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: comprobantepago,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function(response) {
                    if(response.code==200)
                    {
                        let urlraiz = $('meta[name=app-url]').attr("content") + "/";
                        let urlimage = urlraiz + response.data.url;
                        let img_id = 'comprobanteimg' + id;
                        // previewtmpimage_col3(urlimage, 'imgProducto_preview',img_id, response.data.name, response.data.size, 'imgproducto', 'imagen-action', 'producto_id');
                        $('#comprobante-preview').append("<div class='img-div col-md-3 col-6' id='comprobanteimg"+id+"'>" +
                                "<img src='"+urlimage+"' class='img-fluid image img-thumbnail' title='"+response.data.name+"' height='200px'>"+
                                "<input value='"+response.data.name+"|*|"+response.data.size+"' name='comprobanteimg' type='hidden'>" +
                                "</div>");
                        document.getElementById('comprobantepago').value="";
                    }
                    else  if(response.code == "422")
                    {
                        document.getElementById('comprobantepago').value="";
                        let errors = response.errors;
                        let imgvalidation = '';

                        $.each(errors, function(index, value) {

                            if (typeof value !== 'undefined' || typeof value !== "") 
                            {
                                imgvalidation += '<li>' + value + '</li>';
                            }

                        }); 

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            html: '<ul>'+
                            imgvalidation  + 
                                    '</ul>'
                        });
                    }
                    else
                    {
                        document.getElementById('comprobantepago').value="";

                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR...',
                            text: 'Se ha producido un error al intentar actualizar el registro!'
                        })
                    }
                },
                error: function(response) {
                    document.getElementById('comprobantepago').value="";
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR...',
                        text: 'Se ha producido un error al intentar actualizar el registro!'
                    })
                }
            });
            
            
        });

        $('.pform').submit(function(event){
            event.preventDefault();
            $("#btnpagar").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/forms/pago";
            dataPago = $(this).serialize();
            // let payment = $('input[name=opayment]').val();
            // // let valmediopago = $('input[name=payment]:radio:checked').attr('online');
            // // let formData = new FormData($("#pagform")[0]); 
            // // formData.append('online',valmediopago);
            // if(payment == 1)
            // {
            //     checkout.open();
            // }
            // else 
            // {

            // }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: dataPago,
                success: function(response) {
                    $("#btnpagar").prop('disabled', false);
                    if(response.code == "200")
                    {
                        window.location = response.url;
                    }
                    else if(response.code == "201")
                    {
                        window.location = response.url;
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
                    else  if(response.code == "425")
                    {
                        alertify.alert('<h4>Error al Verificar el Captcha</h4>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                    else  if(response.code == "426")
                    {
                        alertify.alert('<h4>Debe agregar un producto</h4>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                    else  if(response.code == "427")
                    {
                        alertify.alert('<h4>No se ha podido Completar su Orden</h4><br><p>El Siguiente Producto:'+response.producto+' No tiene suficiente Stock, Porfavor Verifique el Detalle de su Orden</p>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                    else 
                    {
                        alertify.alert('<h4>Se ha producido un Error al procesar el Pago</h4>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                }
            });

            // let formData = $('#contact_form').serializeArray();
            // $formData.push({})
          
        });

    </script>

@endsection 