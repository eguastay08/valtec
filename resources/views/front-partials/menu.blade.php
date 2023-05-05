<div id="overlay" class="overlay-menu" onclick="closeNav()"></div>

<!-- Menu Sibebar -->
<div class="as-sidenav-main" id="as-sidebar-main">

  <div class="as-sidenav-header">

    <button type="button" class="btn text-reset" onclick="closeNav()">
      <a href="#">
        <i class="fas fa-arrow-alt-circle-left"></i>
        &nbsp;Cerrar Menú
      </a>
    </button>

  </div>

  <div class="as-sidenav-body" id="as-sidenav-content">
    <ul class="navbar-nav as-nav__menu w-100" role="navigation">

      <!-- Buscador -->
      <li class="nav-item p-2 as-search__menu">
        <form action="{{ url('productos/') }}">
          <div class="input-group">
            <input type="text" class="form-control" name="q" value="" placeholder="Buscar Producto y más.." aria-label="Search" autocomplete="off">
            <div class="input-group-append">
                <button class="btn btn-search-mobile" type="submit">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </button>
            </div>
          </div>
        </form>
      </li>
      <!-- Fin del Buscador -->

      @foreach($menus as $k=>$m)
        <?php $encryptDataMenu=Hashids::encode($m['menu_id']);?> 
        <li class="nav-item">
          <a @if(!$m['sub_menu']) href="#" @endif class="nav-link as-menu_lv1 as-menu-link-sty as-menu-links-style px-3 @if($m['sub_menu'])as-menu-drop as-menu-lvl1 @endif" title="{{$m['nombre']}}" data-title="{{$m['nombre']}}" data-url =<?php echo "'".$encryptDataMenu."'"; ?>>
            @if($m['icono']!="")
              <img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px;" />&nbsp;
            @endif         
            <span>{{$m['nombre']}}</span>
            @if($m['sub_menu'])
              <span class="toggle__icon ms-auto">
                <i class="fas fa-chevron-down" aria-hidden="true"></i>
              </span>
            @endif
          </a>
        </li> 
      @endforeach

    <div style="height:48px;"></div>

    </ul>
  </div>

  <div class="as-sidenav-body-sub" id="as-sidenav-content-sub">

    <div class="as-submenu-close d-flex mb-3">

      <button id="as-submenu" type="button" class="btn text-reset">
        <span>
          <i class="fas fa-arrow-left"></i>
          &nbsp;MENÚ PRINCIPAL
        </span>
      </button>
    </div>
   

    <div class="as-submenu-header mb-2" id="as-submenu-title">
       
    </div>
    <ul class="navbar-nav as-nav__menu w-100" role="navigation" id="as-nav__ul">
      
    </ul>
  </div>
   
</div>
<!-- Fin Menu Sidebar -->