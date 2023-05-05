@extends('template')

@section('content')

<div class="container-xxl container-fluid">

    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-4 pb-10 mb-20 mx-5">LIBRO DE RECLAMACIONES</h3>
            <hr>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8 offset-md-2 col-12 mt-3">

            <form class="lrform" method="POST">

                <div class="form-group row">
                    <div class="col-12">
                        <label>Tipo Documento:</label>
                        <select class="form-control boder-default" name="tipo_docLR" id="tipo_docLR" title="Tipo Documento" required>
                            <option value="1">RUC</option>
                            <option value="2">DNI</option>
                            <option value="3">Pasaporte</option>
                            <option value="4">CE</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Número Documento:</label>
                        <input type="text" class="form-control boder-default" name="nro_docLR" id="nro_docLR" title="Número de Documento" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Nombres y Apellidos:</label>
                        <input type="text" class="form-control boder-default" name="nom_apeLR" id="nom_apeLR" title="Nombres y Apellidos" required>
                    </div>
                </div>
                
                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Dirección:</label>
                        <input type="text" class="form-control boder-default" name="direccionLR" id="direccionLR" title="Dirección" required>
                    </div>
                </div>
                  
                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Teléfono:</label>
                        <input type="text" class="form-control boder-default" name="telefonoLR" id="telefonoLR" title="Teléfono" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Correo:</label>
                        <input type="text" class="form-control boder-default" placeholder="formato de correo ejemplo@email.com" name="correoLR" id="correoLR" title="formato de correo ejemplo@email.com" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Identificación del Bien Contratado:</label>
                        <select class="form-control boder-default" name="id_bien_LR" id="id_bien_LR" title="Identificación del Bien Contratado" required>
                            <option value="1">Producto</option>
                            <option value="0">Servicio</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Monto Reclamado S/.:</label>
                        <input type="text" class="form-control boder-default" name="monto_reclamadoLR" id="monto_reclamadoLR" title="Monto reclamado S/" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12">
                        <label>Tipo:</label>
                        <select class="form-control boder-default" name="tipoLR" id="tipoLR" title="Tipo" required>
                            <option value="1">Reclamo</option>
                            <option value="2">Queja</option>
                            <option value="3">Sugerencia</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-3">

                    <div class="col-12">
                        <label>Detalle del Cliente:</label>
                        <textarea class="form-control boder-default ml-2" name="detalle_clienteLR" id="detalle_clienteLR" cols="20" rows="7" title="Detalle del cliente" required></textarea>
                    </div>

                </div>

                <div class="form-group row mt-4">

                    <div class="col-12">
                        <div class="g-recaptcha" data-sitekey="{{$captchakey->valor}}"></div>
                    </div>
                
                </div>

                <div class="form-group mt-3">
                    <button type="submit" id="btnLibroReclamaciones" class="save btn btn-dark bradius"><i class="fas fa-comment"></i> Enviar</button>
                </div>
               
            </form>

        </div>

    </div>

</div>

@endsection


@section('scripts')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>

        $('.lrform').submit(function(event){
            event.preventDefault();
            $("#btnLibroReclamaciones").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/forms/libro_reclamaciones";
            dataLibro = $(this).serialize();

          
            // alertify.confirm('Se ha procedido a guardar el registro, muchas gracias por ponerte en contacto con nosotros!!!', function(){ alertify.success('gaaa'); });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: dataLibro,
                success: function(response) {
                    $("#btnLibroReclamaciones").prop('disabled', false);
                    if(response.code == "200")
                    {
                        $('#tipo_docLR').val(1);
                        $('#nro_docLR').val("");
                        $('#nom_apeLR').val("");
                        $('#direccionLR').val("");
                        $('#telefonoLR').val("");
                        $('#correoLR').val("");
                        $('#id_bien_LR').val(1);
                        $('#monto_reclamadoLR').val("");
                        $('#tipoLR').val(1);
                        $('#detalle_clienteLR').val("");
                        
                        alertify.alert()
                        .setting({
                            'label':'Ok',
                            'closable':false,
                            'title':'Éxito',
                            'message': 'Se ha procedido a guardar el registro, muchas gracias por ponerte en contacto con nosotros!!!' ,
                            'onok': function(){ alertify.success( window.location = response.url);}
                        }).show();

                        // alertify.confirm('Se ha procedido a guardar el registro, muchas gracias por ponerte en contacto con nosotros!!!', function(){ alertify.success( window.location = response.url); });
                        // window.location = response.url;
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
                    }
                    else  if(response.code == "423")
                    {
                        alertify.alert('<h4>Error al Verificar el Captcha</h4>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                    else 
                    {
                        alertify.alert('<h4>Se ha producido un Error al procesar el Registro</h4>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                }
            });

        });

    </script>

@endsection