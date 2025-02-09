<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$web_title->valor}}</title>
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="autor" content="VALTECGDA">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Somos una empresa dedicada a la comercialización de productos de entretinimiento">
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/iconfonts/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css?v=2.0') }}">
    <link href="{{ asset('assets/css/custom-styles.css?v=20230516193800') }}" rel="stylesheet">

    <!-- Slick Js -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick/slick-theme.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/OwlCarousel/dist/assets/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/alertifyjs/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/alertifyjs/css/themes/bootstrap.css') }}">

    <link href="{{ asset('assets/vendor/noUiSlider/dist/nouislider.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/drift-main/dist/drift-basic.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/flipdown-master/dist/flipdown.css') }}" rel="stylesheet">


</head>

<body class="style_fondo_bg">

     <!-- Loader -->
     <div id="loader">
     
    </div>

    @include('header2')

    <main class="as-main" style="margin-top:0px; --sticky-margin-top:0;">

        <!-- Mejorar el SEO -->
        <h1 class="d-none">VALTEC</h1>

        
        @section('content')
        @show
        
    </main>

    <span class="ir-arriba ir-arriba-style">
        <i class="fas fa-arrow-up"></i>
    </span>

    @include('footer')

    @include('front-partials.detalle-producto-modal')

    
    @isset($popups)

        @if(count($popups) > 0)

            <div id="PopupSlider" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">

                            @if(count($popups)>1)

                                <div id="carouselPopup" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @php $j = 0 @endphp
                                        @foreach($popups as $pop)

                                            @if($j == 0)
                                                <div class="carousel-item active">
                                                    <a href="{{$pop->link}}" target="_blank"><img class="d-block w-100" src="{{asset($pop->url)}}" alt="Popup" title="Popup"/></a>
                                                </div>
                                            @else
                                                <div class="carousel-item">
                                                    <a href="{{$pop->link}}" target="_blank"><img class="d-block w-100" src="{{asset($pop->url)}}" alt="Popup" title="Popup"/></a>
                                                </div>
                                            @endif
                                        
                                            @php $j++ @endphp
                                        @endforeach

                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPopup" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselPopup" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                  
                                </div>   

                            @else 

                                @foreach($popups as $pop)

                                    <a href="{{$pop->link}}" target="_blank"><img class="d-block w-100" src="{{asset($pop->url)}}" alt="Popup" title="Popup"/></a>
                               
                                @endforeach

                            @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal" style="background-color:#dfdede;border-radius:24px;color:#000;">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    @endisset


    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/slick/slick/slick.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/OwlCarousel/dist/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/alertifyjs/alertify.js') }}"></script>

    <script src="{{ asset('assets/vendor/noUiSlider/dist/nouislider.min.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js?v=1.0') }}"></script>
    <script src="{{ asset('assets/js/cart.js?v=1.0') }}"></script>

    <?php
   #Iniciando la variable de control que permitirá mostrar o no el modal
   $exibirModal = false;
   #Verificando si existe o no la cookie
 if(!isset($_COOKIE["mostrarModal"])){
   # Caso no exista la cookie entra aqui
   # Creamos la cookie con la duración que queramos
 
    //$expirar = 3600; // muestra cada 1 hora
    //$expirar = 10800; // muestra cada 3 horas
    //$expirar = 21600; //muestra cada 6 horas
    $expirar = 43200; //muestra cada 12 horas
    //$expirar = 86400;  // muestra cada 24 horas
    setcookie('mostrarModal', 'SI', (time() + $expirar)); // mostrará cada 12 horas.
    # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
    $exibirModal = true;
 }
?>

    <?php if($exibirModal === true): ?>
   <script>
      $(window).load(function() {
     
     // id de nuestro modal
     $("#PopupSlider").modal("show");
     });
   </script>
   <?php endif; ?>

    <!-- <script type="text/javascript">
        $(window).load(function() {
            $('#PopupSlider').modal('show');
        });
    </script> -->
  
    @section('scripts')
    @show


</body>

</html>