@extends('template')

@section('content')

    <div class="container-xxl container-fluid">

        @isset($bannerPago)
           <div class="row mb-4">

                @foreach($bannerPago as $bp)

                    
                    <div class="col-md-{{$bp['columnas']}} col-12">

                        <a href="{{ !empty($bp['link']) ? $bp['link']:''}}" {{$bp['link']!="" ? $bp['link'] : ''}} class="as-banner-row">

                    <img id="banner-{{$bp['banner_id']}}" class="img-fluid banner-main bradius" data-src="{{asset($bp['banner'])}}" src="{{asset($bp['banner'])}}" style="width: 100%;">

                    @if($bp['banner__estilo_id'] == 2)
                        <img id="banner-super-{{$bp['banner_id']}}" class="img-fluid banner-hoover bradius" data-src="{{asset($bp['banner_superpuesto'])}}" src="{{asset($bp['banner_superpuesto'])}}" style="width: 100%;">
                    @endif

                    </a>

                    </div>

                @endforeach

           </div>
        @endisset
  
        <div class="row">

            <div class="col-12 pb-10 mb-20">
                <h3 class="mt-4 text-center">COMPRA RÁPIDA</h3>
                <hr>
            </div>

        </div>
        

        <form id="pagform" class="pform" method="POST">

            <div class="row">

            
                <!-- <div class="d-flex justify-content-center"> -->

                    <div class="col-md-6 col-12 pb-15 pt-15">
                        <!-- Start steep -->
                        <div class="progressbar">
                            <div class="progress progress-style" id="progress"></div>
                            
                            <div
                            class="progress-step progress-step-active step-user"
                            data-title="Datos Personales"></div>
                            <div class="progress-step step-payway" data-title="Medios de Pago"></div>
                            <div class="progress-step step-finish" data-title="Confirmación"></div>
                        </div>
                        <!-- End steep -->

                        <!-- step one -->
                        <div class="form-step form-step-active"> 

                            <div class="row">

                                <div class="col-12">
                                    <h6 class="text-center"><strong><i class="fas fa-user"></i> Ingrese Datos Personales</strong></h6>
                                </div>

                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Nombre y Apellidos</label>
                                        <input type="text" class="form-control boder-default" name="pagonombresapellidos" id="pagonombresapellidos">
                                        <span id="error-nomapellido" style="color:#FF0000;font-size:14px;"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Teléfono / Whatsapp / Facebook</label>
                                        <input type="text" class="form-control boder-default" name="pagoinformacionadicional" id="pagoinformacionadicional">
                                        <span id="error-tele" style="color:#FF0000;font-size:14px;"></span>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Correo Electrónico</label>
                                        <input type="email" class="form-control boder-default" name="pagoemail" id="pagoemail">
                                        <span id="error-email" style="color:#FF0000;font-size:14px;"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Validar Correo Electrónico</label>
                                        <input type="text" class="form-control boder-default" id="pagoemailverificar" name="pagoemailverificar">
                                        <span id="error-validateEmail" style="color:#FF0000;font-size:14px;"></span>
                                    </div>      
                                </div>
                                <div class="col-lg-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Provincia</label>
                                        <select name="billing_state" id="billing_state" class="form-select" aria-label="Default select example" autocomplete="address-level1" data-placeholder="Elige una opción…" data-input-classes="" data-label="Provincia" tabindex="-1" aria-hidden="true">
    <option value="">Elige una opción…</option>
    <option value="Azuay">Azuay</option>
    <option value="Bolívar">Bolívar</option>
    <option value="Cañar">Cañar</option>
    <option value="Carchi">Carchi</option>
    <option value="Chimborazo">Chimborazo</option>
    <option value="Cotopaxi">Cotopaxi</option>
    <option value="El Oro">El Oro</option>
    <option value="Esmeraldas">Esmeraldas</option>
    <option value="Galápagos">Galápagos</option>
    <option value="Guayas">Guayas</option>
    <option value="Imbabura">Imbabura</option>
    <option value="Loja">Loja</option>
    <option value="Los Ríos">Los Ríos</option>
    <option value="Manabí">Manabí</option>
    <option value="Morona-Santiago">Morona-Santiago</option>
    <option value="Napo">Napo</option>
    <option value="Orellana">Orellana</option>
    <option value="Pastaza">Pastaza</option>
    <option value="Pichincha">Pichincha</option>
    <option value="Santa Elena">Santa Elena</option>
    <option value="Santo Domingo de los Tsáchilas">Santo Domingo de los Tsáchilas</option>
    <option value="Sucumbíos">Sucumbíos</option>
    <option value="Tungurahua">Tungurahua</option>
    <option value="Zamora-Chinchipe">Zamora-Chinchipe</option>
</select>
                                        <span id="error-billing_state" style="color:#FF0000;font-size:14px;"></span>
                                    </div>
                                </div> 
                                <div class="col-lg-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Ciudad</label>
                                        <input type="text" class="form-control boder-default" id="city" name="city" placeholder="Nombre de la Ciudad">
                                        <span id="error-city" style="color:#FF0000;font-size:14px;"></span>
                                    </div>      
                                </div>   
                                <div class="col-lg-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Dirección de la calle</label>
                                        <input type="text" class="form-control boder-default" id="address" name="address" placeholder="Nombre de la calle y número de la casa">
                                        <span id="error-address" style="color:#FF0000;font-size:14px;"></span>
                                    </div>      
                                </div>
                                <div class="col-lg-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control boder-default" id="address2" name="address2" placeholder="Apartamento, habitación, etc. (opcional)">
                                    </div>      
                                </div>
                                <div class="col-lg-12 col-sm-12 mt-3">
                                    <div class="form-group">
                                        <label>Notas del pedido (opcional)</label>
                                        <textarea name="order_comments" class="form-control boder-default" id="order_comments" placeholder="Notas sobre tu pedido, por ejemplo, notas especiales para la entrega." rows="2" cols="5"></textarea>
                                    </div>      
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-form-step btn-next btn-next-first btn-dark" style="border-radius:24px;"><i class="fas fa-chevron-right"></i> Continuar</a>
                                </div>
                            </div>
                        </div>

                        <!-- step two -->
                        <div class="form-step">

                            <div class="row">

                                <div class="col-12">
                                    <h6 class="text-center"><strong><i class="far fa-money-bill-alt"></i> Seleccione Método de Pago</strong></h6>
                                </div>

                                <div class="medios_pago_div mt-4">

                                    <ul class="nav nav-tabs d-flex justify-content-center" id="TabMediopago" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="billetera-tab" data-bs-toggle="tab" data-bs-target="#billetera" data-tab ="billetera" type="button" role="tab" aria-controls="billetera" aria-selected="true" activado = "1">Billetera Digital</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="transferencia-tab" data-bs-toggle="tab" data-bs-target="#transferencia" data-tab ="transferencia" type="button" role="tab" aria-controls="transferencia" aria-selected="false" activado = "0">Transferencias Bancarias</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="efectivo-tab" data-bs-toggle="tab" data-bs-target="#efectivo" data-tab ="efectivo" type="button" role="tab" aria-controls="efectivo" aria-selected="false" activado = "0">En efectivo</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pagoOnline-tab" data-bs-toggle="tab" data-bs-target="#pagoOnline" data-tab ="pagoOnline" type="button" role="tab" aria-controls="pagoOnline" aria-selected="false" activado = "0">Pagos en Línea</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        
                                        <div class="tab-pane fade show active payment_tab" id="billetera" role="tabpanel" aria-labelledby="billetera-tab" activado ="1">

                                            @isset($mediosPago)

                                                @if(count($mediosPago)>0)

                                                    <div class="form-group pt-15 pb-15 text-center">
                                                        
                                                        @php $contador = 1 @endphp

                                                        @foreach($mediosPago as $mp)

                                                            @if($mp->billetera_digital==1)

                                                                <?php $encryptPayMentID=Hashids::encode($mp->medio_pago_id);?> 

                                                            
                                                                <div class="radio-inline" activado ="0">
                                                                    <input type="radio" name="payment" id="payment{{$contador}}" value="{{$encryptPayMentID}}" data-payment="{{$mp->nombre}}" online="0" class="input-hidden" onclick="showDescriptionPayment(<?php echo "'".$encryptPayMentID."'"; ?>);">
                                                                    <label class="lblchkpayment" for="payment{{$contador}}"><img src="{{asset($mp->imagen)}}" style="height: 100%"></label>
                                                                </div>

                                                            @endif

                                                            @php $contador = $contador + 1 @endphp

                                                        @endforeach

                                                    </div>  

                                                @endif

                                            @endisset

                                        </div>
                                        <div class="tab-pane fade payment_tab" id="transferencia" role="tabpanel" aria-labelledby="transferencia-tab" activado ="0">

                                            @isset($mediosPago)

                                                @if(count($mediosPago)>0)

                                                    <div class="form-group pt-15 pb-15 text-center">
                                                        
                                                        @php $contador2 = 1 @endphp

                                                        @foreach($mediosPago as $mp)

                                                            @if($mp->transferencia==1)

                                                                <?php $encryptPayMentID=Hashids::encode($mp->medio_pago_id);?> 

                                                                <div class="radio-inline">
                                                                    <input type="radio" name="payment" id="payment{{$contador2}}" value="{{$encryptPayMentID}}"  data-payment="{{$mp->nombre}}" online="0" class="input-hidden" onclick="showDescriptionPayment(<?php echo "'".$encryptPayMentID."'"; ?>);">
                                                                    <label class="lblchkpayment" for="payment{{$contador2}}"><img src="{{asset($mp->imagen)}}" style="height: 100%"></label>
                                                                </div>
                                                            @endif

                                                            @php $contador2 = $contador2 + 1 @endphp

                                                        @endforeach

                                                    </div>  

                                                @endif

                                            @endisset

                                        </div>
                                        <div class="tab-pane fade payment_tab" id="efectivo" role="tabpanel" aria-labelledby="efectivo-tab" activado ="0">
                                            
                                            @isset($mediosPago)

                                                @if(count($mediosPago)>0)

                                                    <div class="form-group pt-15 pb-15 text-center">
                                                        
                                                        @php $contador3 = 1 @endphp

                                                        @foreach($mediosPago as $mp)

                                                            @if($mp->deposito==1)

                                                                <?php $encryptPayMentID=Hashids::encode($mp->medio_pago_id);?> 

                                                                <div class="radio-inline" activado ="0">
                                                                    <input type="radio" name="payment" id="payment{{$contador3}}" value="{{$encryptPayMentID}}"  data-payment="{{$mp->nombre}}" online="0" class="input-hidden" onclick="showDescriptionPayment(<?php echo "'".$encryptPayMentID."'"; ?>);">
                                                                    <label class="lblchkpayment" for="payment{{$contador3}}"><img src="{{asset($mp->imagen)}}" style="height: 100%"></label>
                                                                </div>

                                                            @endif

                                                            @php $contador3 = $contador3 + 1 @endphp

                                                        @endforeach

                                                    </div>  

                                                @endif

                                            @endisset

                                        </div>
                                        <div class="tab-pane fade payment_tab" id="pagoOnline" role="tabpanel" aria-labelledby="pagoOnline-tab" activado ="0">

                                            @isset($mediosPago)

                                                @if(count($mediosPago)>0)

                                                    <div class="form-group pt-15 pb-15 text-center">
                                                        
                                                        @php $contador4 = 1 @endphp

                                                        @foreach($mediosPago as $mp)

                                                            @if($mp->pago_online==1)

                                                                <?php $encryptPayMentID=Hashids::encode($mp->medio_pago_id);?> 

                                                                <div class="radio-inline" activado ="0">
                                                                    <input type="radio" name="payment" id="payment{{$contador4}}" value="{{$encryptPayMentID}}"  data-payment="{{$mp->nombre}}" online="1" class="input-hidden" onclick="showDescriptionPayment(<?php echo "'".$encryptPayMentID."'"; ?>);">
                                                                    <label class="lblchkpayment" for="payment{{$contador4}}"><img src="{{asset($mp->imagen)}}" style="height: 100%"></label>
                                                                </div>
                                                            @endif

                                                            @php $contador4 = $contador4 + 1 @endphp

                                                        @endforeach

                                                    </div>  

                                                @endif

                                            @endisset

                                        </div>
                                    </div>

                                    <div id="dvdetailspayment" class="col-12 mb-10 hide">
                                        <div class="panel panel-info-payment">
                                            <div class="panel-body panel-text text-justify" id="paymentDetails">

                                            </div>
                                        </div>
                                    </div>

                                    <div id="comprobantefechaDiv" class="row mt-4">
                                            
                                        <div id="comprobanteDV" class="col-md-8 col-12">
                                            <div class="form-group">
                                                <label>Comprobante de pago (foto ó captura de pantalla)</label>
                                                <input type="file" class="form-control boder-default mt-2" name="comprobantepago" id="comprobantepago">
                                                <div id="comprobante-preview" class="mt-2">

                                                </div>
                                            </div>
                                        </div>

                                        <div id="fechapagoDV" class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label>Fecha de pago</label>
                                                <input type="date" class="form-control boder-default mt-2" name="fechapago" id="datePay" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>

                                        <input type="hidden" name="opayment" value="0">

                                    </div>

                                </div>
                        
                                <div class="col-12 mt-4 d-flex justify-content-end">

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-form-step btn-prev me-4 btn-dark" style="border-radius:24px;"><i class="fas fa-chevron-left"></i> Anterior</a>
                                        <button type="button" class="btn btn-form-step btn-next btn-dark" style="border-radius:24px;"><i class="fas fa-chevron-right"></i> Continuar</a> 
                                
                                    </div>
                                </div>

                            </div>
                            
                            

                        </div>
                        <!-- step three -->
                        <div class="form-step">
                            
                            <div class="row">
                            
                                <div class="col-12">
                                    <h6 class="text-center"><strong><i class="fas fa-check"></i> Verifique la Información Ingresada</strong></h6>
                                </div>

                                <div class="col-12 mt-3">
                                    
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="input-group">
                                                <label for="lblnomapepago"><strong>Nombre y Apellidos:</strong></label>
                                                <p id="lblnomapepago"></p>
                                            </div>

                                            <div class="input-group mt-4">
                                                <label for="lblinfo"><strong>Teléfono / Whatsapp / Facebook:</strong></label>
                                                <p id="lblinfo"></p>
                                            </div>

                                            <div class="input-group mt-4">
                                                <label for="lblemail"><strong>Correo Electrónico:</strong></label>
                                                <p id="lblemail"></p>
                                            </div>
                                            <div class="input-group mt-4">
                                                <label for="lblProvincia"><strong>Provincia:</strong></label>
                                                <p id="lblProvincia"></p>
                                            </div>
                                            <div class="input-group mt-4">
                                                <label for="lblCiudad"><strong>Ciudad:</strong></label>
                                                <p id="lblCiudad"></p>
                                            </div>
                                            <div class="input-group mt-4">
                                                <label for="lblAddress"><strong>Dirección de la calle:</strong></label>
                                                <p id="lblAddress"></p>
                                            </div>
                                            <div class="input-group mt-4">
                                                <label for="lblAddress2"><strong>Apartamento, habitación, etc.:</strong></label>
                                                <p id="lblAddress2"></p>
                                            </div>
                                            <div class="input-group mt-4">
                                                <label for="lblOrderComents"><strong>Notas del pedido (opcional):</strong></label>
                                                <p id="lblOrderComents"></p>
                                            </div>

                                            <div class="input-group mt-4">
                                                <label for="lblPayment"><strong>Medio Pago:</strong></label>
                                                <p id="lblPayment"></p>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="g-recaptcha" data-sitekey="{{$captchakey->valor}}"></div>
                                </div>

                                <div class="col-12 mt-4">
                                    <a href="{{url('terminos_condiciones')}}" target="_blank"><i class="fas fa-link"></i> Términos y Condiciones</a>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="form-group">
                                        <p>
                                            <input type="checkbox" name="aceptochk">
                                            Acepto Términos y Condiciones de uso
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 mt-4 d-flex justify-content-end">
                                <button type="button" class="btn btn-form-step btn-prev  btn-dark me-4" style="border-radius:24px;"><i class="fas fa-chevron-left"></i> Anterior</a>
                                <button type="submit" id="btnpagar" class="btn btn-pagar-style" style="border-radius:24px;">Realizar Compra</button>
                            </div>
                            
                             

                        </div>

                    </div>

                    <div class="col-md-6 col-12 pb-15 pt-15">
                        <div class="resumen-pedido">
                            @include('front-partials.table-pago-data')
                        </div>
                    </div>

                <!-- </div> -->
            

            </div>
            </form>

        <div class="cho-container"></div>

    </div>

@endsection

@section('scripts')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        // const mp = new MercadoPago('TEST-fb98f022-db5f-4ffd-9599-34d2aab158a5');

        function onSubmit(token) {
            document.getElementById("pago-form").submit();
        }

        // const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
        //     locale: 'es-AR'
        // });

        const pasteBox = document.getElementById("pagoemailverificar");
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

        window.showDescriptionPayment = function(encrypt_id)
        {
            url=$('meta[name=app-url]').attr("content")  + "/payment_description/"+encrypt_id;

            $.ajax({
                url: url,
                method:'GET',
            }).done(function (data) {
                console.log(data[0]['pago_online']);
                if(data[0]['pago_online'] == 1)
                {
                    $('input[name=opayment]').val("1");
                }
                else 
                {
                    $('input[name=opayment]').val("0");
                }
                $('#dvdetailspayment').removeClass('hide');
                $('#paymentDetails').html(data[0]['descripcion']);
            }).fail(function () {
                console.log("Failed to load data!");
            });
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
            $('#loader').addClass('bloqueo');
            // $('#loader').css('display','block');
            alertify.alert('<h5>Se está procesando su pago</h5>')
                     .set('title', 'Aviso').set('closable', false); 

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: dataPago,
                success: function(response) {
                    $('#loader').removeClass('bloqueo');
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

        });

    </script>

@endsection 