@extends('template')

@section('content')

<div class="container-fluid">

    <div class="col-12">
        <h3 class="underline text-center mt-4 pb-10 mb-20 mx-5">OPINIONES</h3>
        <hr>
    </div>

    
    <div style="padding:0 20px;" class="text-center mb-20 btn-opinion">
        <button id="btn-opinion" type="button" class="btn btn-sm" style="border-radius: 40px !important;"><i class="fas fa-comment"></i> Escribir una opinión</button>
    </div>

    <div class="row hide" id="form-opinion">
        <div class="col-12">
            <form method="POST" id="frmOpinion">
                
                <h4 class="underlined pb-10 mb-20 mt-10">Déjanos una opinión</h4>
                
                <div class="form-group">
                    <label for="">Comentario</label>
                    <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Calificación</label>
                    <select class="form-control" name="calificacion">
                        <option value="">Seleccione</option>
                        @for($i = 5; $i > 0; $i--)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
              
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="{{$captchakey->valor}}"></div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="save btn btn-secondary"><i class="fab fa-facebook-square"></i> Comentar</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>



<script>

    function onSubmit(token) {
        document.getElementById("frmOpinion").submit();
    }

    $("#btn-opinion").click(function(){
        $('#form-opinion').removeClass('hide');
        $('#btn-opinion').addClass('hide');
    }); 


</script>

@endsection