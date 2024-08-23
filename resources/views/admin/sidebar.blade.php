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

          @can('admin.preguntas.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/preguntas_frecuentes') }}">
              <i class="far fa-question-circle menu-icon"></i>
              <span class="menu-title">Preguntas Frecuentes</span>
            </a>
          </li> 
          @endcan

          @can('admin.ordenes.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/ordenes') }}">
              <i class="fas fa-money-check-alt menu-icon"></i>
              <span class="menu-title">Órdenes</span>
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


          @can('admin.roles.index')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/roles') }}">
            <i class="fas fa-bezier-curve menu-icon"></i>
              <span class="menu-title">Roles</span>
            </a>
          </li> 
          @endcan

          <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/reportes') }}">
            <i class="fas fa-file-pdf menu-icon"></i>
              <span class="menu-title">Reportes</span>
            </a>
          </li> 

        </ul>
      </nav>