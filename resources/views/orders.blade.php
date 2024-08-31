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
                <h3 class="mt-4 text-center">MIS ÓRDENES</h3>
                <hr>
            </div>

        </div>
        <div class="content-wrapper">

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                <i class="fas fa-money-check-alt"></i>
                    Listado de Órdenes
                </h4>
                <section class="tbl_ordenes">
                    @if(isset($ordenes) && count($ordenes) > 0)
                        
                        @include('load_ordenes_data')
                    
                    @else 
                    
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha de Pago</th>
                                        <th>Información Adicional</th>
                                        <th>Ip</th>
                                        <th>Medio de Pago</th>
                                        <th>N° Operación</th>
                                        <th>Cupon</th>
                                        <th>Subtotal</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center" colspan="13">No se encontraron registros</td>
                                    </tr>
                            
                                </tbody>
                            </table>
                        </div>
                    
                    @endif
                </section>
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