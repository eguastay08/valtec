@extends('template')

@section('content')

<div class="container-xxl container-fluid">

    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-4 pb-10 mb-20 mx-5">FORMULARIO CONTACTO</h3>
            <hr>
        </div>
    </div>

    <div class="row">

       
        <div class="col-8 offset-2  mt-3">
            
            <form action="" class="cform" method="POST">

                <div class="form-group row">
                    <div class="col-6">
                        <label>Nombre y Apellidos:</label>
                        <input type="text" class="form-control boder-default" name="namecontacto">
                    </div>
                    <div class="col-6">
                        <label>Email:</label>
                        <input type="text" class="form-control boder-default" name="emailcontacto">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label>Asunto:</label>
                        <input type="text" class="form-control boder-default" name="asuntoContacto">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label>Mensaje:</label>
                        <textarea name="mensaje" class="form-control boder-default" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <div class="g-recaptcha" data-sitekey="{{$captchakey->valor}}"></div>
                </div>
                
                <div class="form-group mt-3">
                    <button type="submit" id="btnContacto" class="save btn btn-secondary"><i class="fas fa-comment"></i> Enviar</button>
                </div>

            </form>

        </div>
   

    </div>

</div>

@endsection


@section('scripts')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>

    function onSubmit(token) {
        document.getElementById("frmOpinion").submit();
    }

    $('.cform').submit(function(event){
        event.preventDefault();
        $("#btnContacto").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "/forms/contacto";
        dataContacto = $(this).serialize();
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: dataContacto,
                success: function(response) {
                    $("#btnContacto").prop('disabled', false);
                    if(response.code == "200")
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
                    else 
                    {
                        alertify.alert('<h4>Se ha producido un Error al procesar el formulario</h4>')
                            .set('title', 'Importante').set('closable', true); 
                    }
                }
            });
    });

</script>

@endsection