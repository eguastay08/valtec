<!--<aside class="as-header-top style-header-top-bg">

    <div class="container social-links d-flex flex-row-reverse">
       <a href="https://api.whatsapp.com/send?phone=51997308677" target="_blank" class="style-social-links"><i class="fab fa-whatsapp"></i></a>
       <a href="#" target="_blank" class="style-social-links"><i class="fab fa-facebook-f"></i></a>
       <a href="#" target="_blank" class="style-social-links"><i class="fab fa-facebook-messenger"></i></a>
       <a href="#" target="_blank" class="style-social-links"><i class="fab fa-instagram"></i></a>
       <a href="#" target="_blank" class="style-social-links"><i class="fab fa-tiktok"></i></a>
       <a href="#" target="_blank" class="style-social-links"><i class="fab fa-youtube"></i></a>
    </div>

</aside>    -->

<header class="as-header">
    <div class="container-xxl">
        <div class="as-grid-header d-grid align-items-center p-relative style-header-bg">
            <!-- Logo -->
            <a class="navbar-brand as-grid-header__logo me-0" href="{{ url('/') }}" title="E-Shop">
                <img class="img-fluid" src="{{asset('assets/images/logo.png')}}" alt="E-Shop" title="E-Shop" style="width: 168px; height: auto; transition: all 0.25s ease 0s;" />
            </a>
            <!-- Button -->
           
            <!-- <button class="navbar-toggler as-grid-header__menu collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                <i class="fas fa-bars"></i>
            </button> -->
            <button class="navbar-toggler as-grid-header__menu collapsed style-btn-menu" type="button"  onclick="openNav()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- search -->
            <form action="{{ url('productos/') }}" class="as-grid-header__search" method="get">
                <div class="input-group">
                    <input class="form-control header-search" type="search" name="q" value="" placeholder="Buscar Producto y más.." aria-label="Search" autocomplete="off">
                    <div class="productos-search">
                        @include('front-partials.search-producto')
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-search-mobile" type="submit">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>

            <a href="#" role="button" class="btn btn-cart as-grid-header__cart" data-bs-toggle="modal" data-bs-target="#ModalCart">
                <i class="fas fa-shopping-basket" aria-hidden="true"></i>
                <span id="CartCount" class="cart-counter counter" data-cart-render="item_count">{{count($cart_content)}}</span>
            </a>  
            <a href="#" role="button" class="btn btn-cart as-grid-header__user" data-bs-toggle="modal" data-bs-target="#ModalUser">
                <i class="fas fa-user" aria-hidden="true"></i>
            </a>
            <a href="/orders" role="button" class="btn btn-cart as-grid-header__orders">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
            </a>               
        </div>
    </div>
</header>

<div class="cartmodal">

@include('front-partials.modal-cart')

</div>

<div class="usermodal">

@include('front-partials.modal-user')

</div>

@include('front-partials.menu')