
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasExampleLabel">

<div class="offcanvas-header justify-content-center p-0">

  <button type="button" class="btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
    <i class="fas fa-arrow-alt-circle-left"></i>
    Menú Principal
  </button>

</div>

<div class="offcanvas-body p-0">

  <nav class="navbar navbar-light as-nav__main">

    <div class="container-fluid p-0">

      <ul class="navbar-nav as-nav__menu w-100" role="navigation">

        <!-- Buscador Menú -->

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
      
        <!-- Fin Buscador -->

        @foreach($menus as $k=>$m)
          @if(!$m['sub_menu'])
            <li class="nav-item">
              <a href="#" class="nav-link as-menu_lv1 menu-lv1-sty px-3" title="{{$m['nombre']}}">
                @if($m['icono']!="")
                  <img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px;" /> 
                @endif         
                <span>{{$m['nombre']}}</span>
              </a>
            </li>
          @else
            <li class="nav-item">
              <a href="#" class="nav-link as-menu_lv1 menu-lv1-sty px-3" title="{{$m['nombre']}}">
                @if($m['icono']!="")
                  <img src="{{asset($m['icono'])}}" alt="Menu Icono" title="Menu Icon" style="height:18px;" /> 
                @endif         
                <span>{{$m['nombre']}}</span>
                <span class="toggle__icon ms-auto">
                  <i class="fas fa-chevron-down" aria-hidden="true"></i>
                </span>
              </a>
              <ul class="as-menu_lv2 dropdown-menu">
                <li><a class="nav-link" href="#">Submenu item 1 </a></li>
                <li><a class="nav-link" href="#">Submenu item 2 </a></li>
                <li><a class="nav-link" href="#">Submenu item 3 </a>
                </li>
                  </ul>
            </li>
          @endif
        @endforeach 
      </ul> 

    </div>

  </nav>

</div>
</div>