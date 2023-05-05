<!DOCTYPE html>
<html class="no-js" lang="es">

<!-- belle/home4-fullwidth.html   11 Nov 2019 12:24:38 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>{{$web_title->valor}}</title>
<meta name="app-url" content="{{ url('/') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

<link rel="stylesheet" href="{{ asset('assets/iconfonts/fontawesome-free/css/all.min.css') }}">
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom-styles.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<link rel="stylesheet" href="{{ asset('assets/vendor/alertifyjs/css/alertify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/alertifyjs/css/themes/bootstrap.css') }}">

</head>
<body class="template-index belle home4-fullwidth style_fondo_bg">

    <!-- Messenger Plugin de chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin de chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "106483864492001");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_ES/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>


    <div id="pre-loader">
        <img src="{{ asset('assets/images/loader.gif') }}" alt="Cargando..." />
    </div>

    <div class="pageWrapper">
        
        @include('header')

        <div id="page-content">

            @section('content')
            @show

        </div>

         @include('footer')

        <!--Scoll Top-->
        <!-- <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span> -->
        <!--End Scoll Top-->

        <!--Quick View popup-->

        @include('front-partials.detalle-producto-modal')
    
        <!--End Quick View popup-->

        @isset($popups)

            @if(count($popups) > 0)

            <div id="PopupSlider" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Atención</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if(count($popups)>1)
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
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
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>   
                            @else 
                                @foreach($popups as $pop)
                                <a href="{{$pop->link}}" target="_blank"><img class="d-block w-100" src="{{asset($pop->url)}}" alt="Popup" title="Popup"/></a>
                                @endforeach
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#dfdede;border-radius:24px;color:#000;">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            @endif

        @endisset

    
        <!-- Newsletter Popup -->
        <div class="newsletter-wrap" id="popup-container">
        <div id="popup-window">
            <a class="btn closepopup"><i class="icon icon anm anm-times-l"></i></a>
            <!-- Modal content-->
            <div class="display-table splash-bg">
            <div class="display-table-cell width40"><img src="{{ asset('assets/images/newsletter-img.jpg') }}" alt="Join Our Mailing List" title="Join Our Mailing List" /> </div>
            <div class="display-table-cell width60 text-center">
                <div class="newsletter-left">
                <h2>Join Our Mailing List</h2>
                <p>Sign Up for our exclusive email list and be the first to know about new products and special offers</p>
                <form action="#" method="post">
                    <div class="input-group">
                    <input type="email" class="input-group__field newsletter__input" name="EMAIL" value="" placeholder="Email address" required="">
                    <span class="input-group__btn">
                    <button type="submit" class="btn newsletter__submit" name="commit" id="subscribeBtn"> <span class="newsletter__submit-text--large">Subscribe</span> </button>
                    </span> </div>
                </form>
                <ul class="list--inline site-footer__social-icons social-icons">
                    <li><a class="social-icons__link" href="#" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a class="social-icons__link" href="#" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a class="social-icons__link" href="#" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    <li><a class="social-icons__link" href="#" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a class="social-icons__link" href="#" title="YouTube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <li><a class="social-icons__link" href="#" title="Vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- End Newsletter Popup -->
    
        <!-- Including Jquery -->
        <script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/jquery.cookie.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/wow.min.js') }}"></script>
        <!-- Including Javascript -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/lazysizes.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script src="{{ asset('assets/vendor/alertifyjs/alertify.js') }}"></script>
        
        <!--For Newsletter Popup-->
        
        <script>
            jQuery(document).ready(function(){  

                @isset($popups)
                    @if(count($popups) > 0)
                        $('#PopupSlider').modal('show');
                    @endif
                @endisset



       
            //     var pageHeight = jQuery(document).height();
            //     jQuery('#modalOverly').css("height", pageHeight);
            //     jQuery('#popup-container').show();

            // jQuery('.closepopup').on('click', function () {
            //     jQuery('#popup-container').fadeOut();
            //     jQuery('#modalOverly').fadeOut();
            // });
            
            // var visits = jQuery.cookie('visits') || 0;
            // visits++;
            // jQuery.cookie('visits', visits, { expires: 1, path: '/' });
            // console.debug(jQuery.cookie('visits')); 
            // if ( jQuery.cookie('visits') > 1 ) {
            //     jQuery('#modalOverly').hide();
            //     jQuery('#popup-container').hide();
            // } else {
            //     var pageHeight = jQuery(document).height();
            //     jQuery('<div id="modalOverly"></div>').insertBefore('body');
            //     jQuery('#modalOverly').css("height", pageHeight);
            //     jQuery('#popup-container').show();
            // }
            // if (jQuery.cookie('noShowWelcome')) { jQuery('#popup-container').hide(); jQuery('#active-popup').hide(); }
            // }); 
            
            // jQuery(document).mouseup(function(e){
            // var container = jQuery('#popup-container');
            // if( !container.is(e.target)&& container.has(e.target).length === 0)
            // {
            //     container.fadeOut();
            //     jQuery('#modalOverly').fadeIn(200);
            //     jQuery('#modalOverly').hide();
            // }
            });

            window.seguirComprando = function()
            {
               $('#header-cart').css('display','none');
            }
        </script>

        @section('scripts')
        @show

    </div>


</body>
</html>