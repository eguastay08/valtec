<link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
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
                <h3 class="mt-4 text-center"> DETALLE ORDEN N° {{$orden['n_operacion']}}</h3>
                <hr>
            </div>

        </div>
        <div class="content-wrapper">

<div class="row">

    <div class="col-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <h3 class="card-title">Datos de la Orden</h3>

                <div class="row">

                    <div class="col-md-6 col-12">

                        <div class="form-group">
                            <input type="hidden" name="hddproducto_id" id="hddproducto_id" value="{{ isset($orden) ? $orden->orden_id : '' }}">
                            <label for="nombresOrden"><b>Nombres:</b></label>
                            <input type="text" class="form-control ml-2" id="nombresOrden"  readonly name="nombresOrden" value="{{ isset($orden) ? $orden->nombres : '' }}">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombresOrden"><b>Email:</b></label>
                            <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" value="{{ isset($orden) ? $orden->email : '' }}">
                        </div>    
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombresOrden"><b>Fecha de Pago:</b></label>
                            <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" value="{{ isset($orden) ? $orden->fecha_pago : '' }}">
                        </div>    
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombresOrden"><b>Cupon:</b></label>
                            <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" value="{{ isset($orden) ? $orden->cupon : '' }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombresOrden"><b>Información adicional:</b></label>
                            <textarea name="" id="" class="form-control ml-2" readonly cols="30" rows="5">
                                Telefono: {{$orden->informacion_adicional}}
                                Provincia: {{$orden->provincia}}
                                Ciudad: {{$orden->ciudad}}
                                Dirección: {{$orden->direccion}} {{$orden->direccion2}}
                                Comentario: {{$orden->comentario}}
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="row mb-5">

                    <table class="table table-condensed" id="cart-table">
                        <thead>
                            <tr>
                                <th colspan="2">Producto</th>
                                <th style="width:90px;" class="hidden-xs">Precio</th>
                                <th style="width:70px;">Cantidad</th>
                                <th style="width:90px;">Total</th>
                                <th style="width:90px;">Código Online</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($orden_detalle)

                                @if(count($orden_detalle) > 0)

                                    @foreach($orden_detalle as $od)
                                        
                                        <tr>
                                        <td><img src="{{URL::asset($od->image)}}" alt="Imagen Producto" style="width: 60px;height:70px;"></td>
                                            <td>{{$od->producto}}</td>
                                            <td>{{$od->precio}}</td>
                                            <td>{{$od->cantidad}}</td>
                                            <td>{{$od->subtotal}}</td>
                                            @if($od->codigo_producto != "")
                                                <td><img class="img-fluid" src="{{asset('admin_assets/images/code-prod.png')}}" title="Códigos de Producto" alt="Códigos de Producto" style="cursor:pointer;width:24px;height:24px;" onclick="visualizarCodigo({{$od->codigo_producto}})"></td>
                                            @endif
                                        </tr>
                                    @endforeach

                                @endif

                            @endisset
                        </tbody>
                    </table>

                </div>

                <div class="row">

                    <div class="col-md-4 col-12">   
                        <div class="form-group">
                            <label for="nombresOrden"><b>Subtotal:</b></label>
                            <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($orden) ? $orden->subtotal : '' }}">
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="nombresOrden"><b>Descuento:</b></label>
                            <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($orden) ? $orden->descuento : '' }}">
                        </div>    
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="nombresOrden"><b>Total:</b></label>
                            <input type="text" class="form-control ml-2" id="emailOrdens"  readonly name="emailOrdens" placeholder="Ingrese el Nombre del Producto.." value="{{ isset($orden) ? $orden->total : '' }}">
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">
                <div class="form-group">
                    <a class="btn btn-secondary btn-icon-split" style="color:black;" href="{{ url('/orders') }}"> <span class="icon text-white-50"><img src="{{ url('admin_assets/images/back.png') }}" width="24px"></span><span class="text">Volver</span></a>                                                
                </div>
            </div>

        </div>
    </div>


</div>

</div>


</div>

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