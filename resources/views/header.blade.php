<!--Search Form Drawer-->
<!-- <div class="search">
    <div class="search__form">
        <form class="search-bar__form" action="#">
            <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
            <input class="search__input" type="search" name="q" value="" placeholder="Buscar Producto..." aria-label="Search" autocomplete="off">
        </form>
        <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
    </div>
</div> -->
<!--End Search Form Drawer-->

<!--Top Header-->
<div class="top-header style-header-bg">

    <!--Search Form Drawer-->
    <div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="{{ url('productos/') }}" method="get">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="q" value="" placeholder="Ingrese Producto y Presione Enter.." aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
    </div>
    <!--End Search Form Drawer-->

    <div class="container-fluid">
        <div class="row">
            <div class="logo col-md-8 d-none d-lg-block">
                <a href="{{ url('/') }}"><img class="logo-img" src="{{asset('admin_assets/images/logo-lolstore.png')}}" alt="logo" /></a>
            </div>

               <!--Mobile Logo-->
               <div class="col-12 col-sm-12 col-md-12 col-lg-2 d-block d-lg-none mobile-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{asset('admin_assets/images/logo-lolstore.png')}}" alt="Logo" title="" />
                    </a>
                </div>

             
            <!--Mobile Logo-->

            <!-- <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                <div class="text-center"><p class="top-header_middle-text"> Worldwide Express Shipping</p></div>
            </div> -->

            <div class="col-md-4 d-flex flex-row-reverse text-right">
                <!-- <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span> -->
                <ul class="customer-links list-inline align-self-center">
                    <li><a href="#" target="_blank" class="style-social-links"><i class="fab fa-whatsapp"></i></a></li>
                    <li><a href="#" target="_blank" class="style-social-links"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" target="_blank" class="style-social-links"><i class="fab fa-facebook-messenger"></i></a></li>
                    <li><a href="#" target="_blank" class="style-social-links"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#" target="_blank" class="style-social-links"><i class="fab fa-tiktok"></i></a></li>
                    <li><a href="#" target="_blank" class="style-social-links"><i class="fab fa-youtube"></i></a></li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--End Top Header-->

<!--Header-->
<div class="header-wrap animated h-nav style-nav hidden-nav">
    <div class="container-fluid" style="height:100%;">        
        <div class="row align-self-center" style="min-height: 100%;">
            <div class="col-lg-10 col-md-7 col-7 my-auto">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r mobile-menu-icon"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                    <ul id="siteNav" class="site-nav mediumhidearrow">
                       
                        <li class="lvl1"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
                        @foreach($menus as $k=>$m)
                            @if(!$m['sub_menu'])
                                <li class="lvl1"><a href="{{url($m['link'])}}">@if($m['icono']!="")<img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px; margin-right:2px; margin-bottom:4px;" /> @endif {{$m['nombre']}}</a></li>
                            @else 
                                <li class="lvl1 parent dropdown"><a href="{{url($m['link'])}}">@if($m['icono']!="")<img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px; margin-right:2px; margin-bottom:4px;" /> @endif {{$m['nombre']}} <i class="anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown no-border">
                                        @foreach($m['sub_menu'] as $k=>$me)
                                            <li class="no-border"><a href="{{url($me['link'])}}" class="site-nav style-nav-dropdown">@if($me['icono']!="")<img src="{{asset($me['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px; margin-right:2px; margin-bottom:4px;" /> @endif {{$me['nombre']}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                       
                    </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
         
            <div class="col-lg-2 col-md-5 col-5 my-auto">

                <!-- Copia -->
                <div class="site-cart">
                    <a href="#" role="button" class="site_carrito carrito" title="Cart" data-toggle="modal" data-target="#ModalCart">
                        <i class="icon anm anm-cart-1-l"></i>
                        <span id="CartCount" class="site-header__cart-count counter" data-cart-render="item_count">{{count($cart_content)}}</span>
                    </a>
                </div>

                <div class="site-header__search">
                    <button type="button" class="search-trigger buscar"><i class="icon anm anm-search-l"></i></button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal right fade" id="ModalCart" tabindex="-1" role="dialog" aria-labelledby="ModalCart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            @isset($cart_content)
                @if(count($cart_content)>0)
                    <div class="modal-header">
                        <h3 class="modal-title font-weight-bold" id="myModalLabel2">CARRITO</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
            @endisset

            @isset($cart_content)
                @if(count($cart_content)>0)

                    <div class="modal-body">
                        <div class="contItemscard">
                            @foreach($cart_content as $cart)
                                <section class="CardProduct">
                                    <div class="containerCardProduct fadeIn">
                                        <div class="detailProductCart">
                                            <div class="imgProductCart">
                                                <picture>
                                                    <img clas="img-fluid" src="{{asset($cart->attributes->image)}}" alt="{{$cart->name}}" title="{{$cart->name}}" />
                                                </picture>
                                            </div>
                                            <div class="infoProductCart">
                                                <a class="productName" href="cart.html">{{$cart->name}}</a>
                                                <div class="productPrice">
                                                    <span class="text-muted">Precio</span>
                                                    <span class="money">{{$moneda[0]['prefijo']}} {{number_format((float)$cart->price, 2, '.', '')}}</span>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>

                                        <div class="containerButtonsProduct d-flex justify-content-between">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id_edit" value="{{$cart->id}}">
                                            <div class="quantityButtons d-flex justify-content-between">
                                                
                                                    <div class="quantityButtonsText">
                                                        <div class="input-group input-group-sm qntgroup">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-secondary rounded-btn btncntd b-minus" id="append-btn-start">
                                                                    <i class="fas fa-minus" aria-hidden="true"></i>
                                                                </button>
                                                            </div>                                    
                                                            <input type="text" class="form-control text-center cntdvl" id="Quantity" name="quantity" value="{{$cart->quantity}}" aria-describedby="basic-addon1">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn btn-secondary rounded-btn btncntd b-plus" id="append-btn-end">
                                                                    <i class="fas fa-plus" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                    
                                                    <div class="quantityButtonsBtn d-flex flex-row-reverse">
                                                        <button type="submit" class="btn edit-i remove rounded-btn" title="Actualizar"><i class="anm anm-edit" aria-hidden="true"></i></button>
                                                    </div>
                                            
                                            </div>
                                            </form>

                                            <div class="buttonsProduct d-flex">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id_remove" value="{{$cart->id}}">
                                                    <button href="#" class="btn remove rounded-btn" title="Eliminar Producto" style="background-color:red !important;"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            @endforeach
                        </div>
                        
                        <!--Minicart Popup-->
                    </div>

                    <div class="modal-footer">

                        <div class="divSubtotal">
                            <h5>Subtotal: <span class="product-price"><span class="money" style="font-weight:300">{{$moneda[0]['prefijo']}} {{number_format((float)$cart_total, 2, '.', '')}}</span></span></h5>
                        </div>
                        <br>

                        <div class="btntotal">
                        <button type="button" class="btn btn-secondary rounded-btn" data-dismiss="modal">Seguir Comprando</button>
                        <a href="{{url('pago')}}" class="btn btn-secondary rounded-btn" style="background-color:rgb(250, 129, 5) !important;">Pagar</a>
                    
                        </div>
                    </div>

                @else 

                    <div class="modal-body">
                        <div class="divCartEmpty">
                            <i class="fas fa-shopping-basket" aria-hidden="true"></i>
                            <p>Tú Carro esta vacío</p>
                            <button class="btn btn-primary rounded-btn" style="background-color:rgb(250, 129, 5) !important;width:50%;" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                @endif
            @endisset

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!--Mobile Menu-->
<div class="mobile-nav-wrapper style-nav-mobile" role="navigation">
    <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Cerrar Menú</div>
    <ul id="MobileNav" class="mobile-nav site-nav">
        <li class="lvl1"><a href="{{ url('/') }}" class="links-mobile"><i class="fas fa-home"></i></a></li>
        @foreach($menus as $k=>$m)
            @if(!$m['sub_menu'])
                <li class="lvl1 no-border"><a href="#" class="links-mobile">@if($m['icono']!="")<img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px; margin-right:2px; margin-bottom:4px;" /> @endif {{$m['nombre']}}</a></li>
            @else 
                <li class="no-border"><a href="{{$m['link']}}" class="site-nav links-mobile">@if($m['icono']!="")<img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px; margin-right:2px; margin-bottom:4px;" /> @endif {{$m['nombre']}}<i class="anm anm-plus-l links-mobile"></i></a>
                    <ul class="no-border">
                        @foreach($m['sub_menu'] as $k=>$me)
                            <li class="no-border"><a href="{{$me['link']}}" class="site-nav style-nav-dropdown">@if($me['icono']!="")<img src="{{asset($me['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px; margin-right:2px; margin-bottom:4px;" /> @endif {{$me['nombre']}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
        
    </ul>
</div>
<!--End Mobile Menu-->