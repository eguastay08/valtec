<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                @if(Auth::user()->foto != "")
                  <img src="{{ asset(Auth::user()->foto) }}" alt="profile"/>
                @else 
                  <img src="{{ asset('admin_assets/images/boy2.png') }}" alt="profile"/>
                @endif
              </div>
              <div class="profile-name">
              Bienvenido(a) 
                <p class="name">
                 {{Auth::user()->usuario}}
                </p>
                <!-- <p class="designation">
                  Super Admin
                </p> -->
              </div>
            </div>
          </li>

          @can('admin.inicio')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/') }}">
              <i class="fas fa-home menu-icon"></i>
              <span class="menu-title">Inicio</span>
            </a>
          </li>   
          @endcan

          @can('admin.categorias.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/categorias') }}">
            <i class="fas fa-cubes menu-icon"></i>
              <span class="menu-title">Categorías</span>
            </a>
          </li>
          @endcan

          @can('admin.productos.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/productos') }}">
              <i class="fas fa-dolly-flatbed menu-icon"></i>
              <span class="menu-title">Productos</span>
            </a>
          </li>    
          @endcan

          @can('admin.sliders.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/sliders') }}">
            <i class="fas fa-camera-retro menu-icon"></i>
              <span class="menu-title">Sliders</span>
            </a>
          </li>   
          @endcan

          @can('admin.banners.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/banners') }}">
              <i class="fas fa-images menu-icon"></i>
              <span class="menu-title">Banners</span>
            </a>
          </li>    
          @endcan

          @can('admin.tags.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/tags') }}">
              <i class="fas fa-tags menu-icon"></i>
              <span class="menu-title">Etiquetas</span>
            </a>
          </li>   
          @endcan 

          @can('admin.disenio.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/disenio') }}">
              <i class="fas fa-palette menu-icon"></i>
              <span class="menu-title">Diseño</span>
            </a>
          </li>   
          @endcan 

          @can('admin.preguntas.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/preguntas_frecuentes') }}">
              <i class="far fa-question-circle menu-icon"></i>
              <span class="menu-title">Preguntas Frecuentes</span>
            </a>
          </li> 
          @endcan

          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/ordenes') }}">
              <i class="fas fa-money-check-alt menu-icon"></i>
              <span class="menu-title">Órdenes</span>
            </a>
          </li> 

          @can('admin.medios_pago.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/medios_pagos') }}">
              <i class="fas fa-hand-holding-usd menu-icon"></i>
              <span class="menu-title">Medios de pago</span>
            </a>
          </li> 
          @endcan
          
          @can('admin.moneda.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/monedas') }}">
              <i class="fas fa-coins menu-icon"></i>
              <span class="menu-title">Monedas</span>
            </a>
          </li> 
          @endcan

          @can('admin.menu.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/menus') }}">
              <i class="fas fa-ellipsis-h menu-icon"></i>
              <span class="menu-title">Menu</span>
            </a>
          </li> 
          @endcan

          @can('admin.descuentos.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/descuentos') }}">
              <i class="fas fa-percent menu-icon"></i>
              <span class="menu-title">Descuentos</span>
            </a>
          </li> 
          @endcan

          @can('admin.noticias_categorias.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/noticia_categoria') }}">
              <i class="fab fa-hacker-news-square menu-icon"></i>
              <span class="menu-title">Noticias Categorías</span>
            </a>
          </li> 
          @endcan

          @can('admin.noticias_etiquetas.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/noticia_tag') }}">
              <i class="fas fa-hashtag menu-icon"></i>
              <span class="menu-title">Noticias Etiquetas</span>
            </a>
          </li> 
          @endcan

          @can('admin.noticias.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/noticias') }}">
              <i class="fas fa-newspaper menu-icon"></i>
              <span class="menu-title">Noticias</span>
            </a>
          </li> 
          @endcan

          @can('admin.suscripciones.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/suscripciones') }}">
              <i class="far fa-paper-plane menu-icon"></i>
              <span class="menu-title">Suscripciones</span>
            </a>
          </li> 
          @endcan

          @can('admin.libro_reclamaciones.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/libro_reclamaciones') }}">
              <i class="fas fa-book menu-icon"></i>
              <span class="menu-title">Libro de Reclamaciones</span>
            </a>
          </li> 
          @endcan

          @can('admin.usuarios.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/usuarios') }}">
              <i class="fas fa-users menu-icon"></i>
              <span class="menu-title">Usuarios</span>
            </a>
          </li> 
          @endcan

          @can('admin.estilos.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/estilos') }}">
            <i class="fas fa-paint-roller menu-icon"></i>
              <span class="menu-title">Estilos</span>
            </a>
          </li> 
          @endcan

          @can('admin.configuracion.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/configuraciones') }}">
              <i class="fas fa-cog menu-icon"></i>
              <span class="menu-title">Cofiguraciones</span>
            </a>
          </li> 
          @endcan

          @can('admin.roles.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/roles') }}">
            <i class="fas fa-bezier-curve menu-icon"></i>
              <span class="menu-title">Roles</span>
            </a>
          </li> 
          @endcan

        </ul>
      </nav>