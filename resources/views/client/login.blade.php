<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="routeName" content="{{ Route::currentRouteName() }}">
  <meta name="app-url" content="{{ url('/') }}">
  <title>VALTEC - Inicio de Sesión</title>
  <!-- plugins:css -->
  
  <link href="{{ asset('admin_assets/vendors/iconfonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/vendors/css/vendor.bundle.addons.css') }}" rel="stylesheet">
  
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
              
            <div class="auth-form-light text-left">
             
              <div class="p-3 d-flex justify-content-center">
                <img src="{{asset('admin_assets/images/logo-ecommerce.png')}}" alt="logo" width="350px"/>
              </div>

              <!-- <div class="brand-logo" style="background-color:red;">
                <img src="../../images/logo.svg" alt="logo">
              </div> -->
             
              <div class="my-2 d-flex justify-content-center p-3" style="color:#3a3f51;"><h4> ... :: Inicio Sesión <b>Cliente</b> :: ...</h4> </div>
          
                <!-- <form class="pt-3" method="POST" action="{{ route('admin.login') }}"> -->

              {!! Form::open(['url'=>'/login']) !!}


                  @csrf
                  
                  <div class="form-group pl-4 pr-4">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fas fa-user"></i></div>
                          </div>
                          <input type="text" class="form-control form-control-lg" id="LoginUsuario" name="LoginUsuario" placeholder="Ingrese el Usuario">
                      </div>
                  </div>

                  <div class="form-group pl-4 pr-4">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fas fa-lock"></i></div>
                          </div>
                          <input type="password" class="form-control form-control-lg" id="LoginPassword" name="LoginPassword" placeholder="Ingrese la Contraseña">
                      </div>
                  </div>
                  
                  <div class="mt-3 d-flex justify-content-center pb-4">
                      <div class="text-center g-recaptcha" data-sitekey="6LeQZQ0qAAAAAGofMbS-m-Na--FmeDFkblBBwhu9"></div>
                  </div>

                  <div class="mt-3 pl-4 pr-4 pb-2">
                      <button type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn">Ingresar</button>
                  </div>
                  <div class="mt-3 pl-4 pr-4 pb-2">
                      <a href="/register" class="btn btn-block btn-secondary btn-lg font-weight-medium auth-form-btn">Registrarse</a>
                  </div>
                  <div class="mt-2 text-center">
                      <a href="/forgot-password" class="text-muted">¿Olvidé la contraseña?</a>
                  </div>



              <!-- </form> -->
              {!! Form::close() !!}

                @if(Session::has('message'))
                  <div class="container">
                      <div class="alert alert-danger" style="display:none;">
                          {{ Session::get('message') }}
                          @if ($errors->any())
                          <ul>
                            @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                          @endif
                      </div>
                  </div>
                @endif

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
  <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
  <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>

  <script>
    $('.alert').slideDown();
    setTimeout(function(){ $('.alert').slideUp(); }, 20000);
  </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
</html>
